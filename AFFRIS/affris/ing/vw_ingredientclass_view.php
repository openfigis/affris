<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/vw_ingredientclass_variables.php");

add_nocache_headers();

//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");
$xt = new Xtempl();


$query = $gQuery->Copy();

$filename = "";	
$message = "";
$key = array();
$next = array();
$prev = array();
$all = postvalue("all");
$pdf = postvalue("pdf");
$mypage = 1;

//Show view page as popUp or not
$inlineview = (postvalue("onFly") ? true : false);

//If show view as popUp, get parent Id
if($inlineview)
	$parId = postvalue("parId");
else
	$parId = 0;

//Set page id	
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

//$isNeedSettings = true;//($inlineview && postvalue("isNeedSettings") == 'true') || (!$inlineview);	
	
// assign an id			
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" =>$id, "tName"=>$strTableName);
$params["xt"] = &$xt;
//Get array of tabs for edit page
$params['useTabsOnView'] = useTabsOnView($strTableName);
if($params['useTabsOnView'])
	$params['arrViewTabs'] = GetViewTabs($strTableName);
$pageObject = new RunnerPage($params);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

// proccess big google maps

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadView", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);

// add button events if exist
$pageObject->addButtonHandlers();

//For show detail tables on master page view
$dpParams = array();
if($pageObject->isShowDetailTables)
{
	$ids = $id;
	$mKeys["vw_fullingredientelementanalysis"] = GetMasterKeysByDetailTable("vw_fullingredientelementanalysis", $strTableName);
	$dpParams['strTableNames'][] = "vw_fullingredientelementanalysis";
	$dpParams['ids'][] = ++$ids;
	$mKeys["vw_fullingredientproxanalysis"] = GetMasterKeysByDetailTable("vw_fullingredientproxanalysis", $strTableName);
	$dpParams['strTableNames'][] = "vw_fullingredientproxanalysis";
	$dpParams['ids'][] = ++$ids;
	$mKeys["vw_ingredientspecassociation"] = GetMasterKeysByDetailTable("vw_ingredientspecassociation", $strTableName);
	$dpParams['strTableNames'][] = "vw_ingredientspecassociation";
	$dpParams['ids'][] = ++$ids;
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
	$pageObject->AddJSFile("include/detailspreview");
}


//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn);

$strWhereClause = '';
$strHavingClause = '';
if(!$all)
{
//	show one record only
	$keys=array();
	$strWhereClause="";
	$keys["IngredientID"]=postvalue("editid1");
	$strWhereClause = KeyWhere($keys);
	$strSQL = gSQLWhere($strWhereClause);
}
else
{
	if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
	{
		$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
		$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
	}
	else
	{
		$strWhereClause=@$_SESSION[$strTableName."_where"];
		$strHavingClause=@$_SESSION[$strTableName."_having"];
		$strSQL=gSQLWhere($strWhereClause,$strHavingClause);
	}
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
}

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryView"))
	$eventObj->BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
{
	$strSQL=gSQLWhere($strWhereClause,$strHavingClause);
	if($all)
	{
		$numrows=gSQLRowCount($strWhereClause,$strHavingClause);
		$strSQL.=" ".trim($strOrderBy);
	}
}
else
{
//	changed $strSQL - old style	
	if($all)
	{
		$numrows=GetRowCount($strSQL);
	}
}

if(!$all)
{
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
}
else
{
//	 Pagination:
	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;
		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);
}

$data=db_fetch_array($rs);

if($eventObj->exists("ProcessValuesView"))
	$eventObj->ProcessValuesView($data);

$out="";
$first=true;

$templatefile="";
$fieldsArr = array();
$arr = array();
$arr['fName'] = "IName";
$arr['viewFormat'] = ViewFormat("IName", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IfeedNo";
$arr['viewFormat'] = ViewFormat("IfeedNo", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Description1";
$arr['viewFormat'] = ViewFormat("Description1", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Description2";
$arr['viewFormat'] = ViewFormat("Description2", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Description3";
$arr['viewFormat'] = ViewFormat("Description3", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "DataSource";
$arr['viewFormat'] = ViewFormat("DataSource", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "ICountry";
$arr['viewFormat'] = ViewFormat("ICountry", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Species";
$arr['viewFormat'] = ViewFormat("Species", $strTableName);
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IngredientClass";
$arr['viewFormat'] = ViewFormat("IngredientClass", $strTableName);
$fieldsArr[] = $arr;

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"IngredientID", "")));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["IngredientID"]));

////////////////////////////////////////////
//IName - 
	
	$value="";
	$value=DisplayLookupWizard("IName",$data["IName"],$data,$keylink,MODE_VIEW);
	$xt->assign("IName_value",$value);
	if(!$pageObject->isAppearOnTabs("IName"))
		$xt->assign("IName_fieldblock",true);
	else
		$xt->assign("IName_tabfieldblock",true);
////////////////////////////////////////////
//IfeedNo - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"IfeedNo", ""),"","",MODE_VIEW);
	$xt->assign("IfeedNo_value",$value);
	if(!$pageObject->isAppearOnTabs("IfeedNo"))
		$xt->assign("IfeedNo_fieldblock",true);
	else
		$xt->assign("IfeedNo_tabfieldblock",true);
////////////////////////////////////////////
//Description1 - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"Description1", ""),"","",MODE_VIEW);
	$xt->assign("Description1_value",$value);
	if(!$pageObject->isAppearOnTabs("Description1"))
		$xt->assign("Description1_fieldblock",true);
	else
		$xt->assign("Description1_tabfieldblock",true);
////////////////////////////////////////////
//Description2 - 
	
	$value="";
	$value=DisplayLookupWizard("Description2",$data["Description2"],$data,$keylink,MODE_VIEW);
	$xt->assign("Description2_value",$value);
	if(!$pageObject->isAppearOnTabs("Description2"))
		$xt->assign("Description2_fieldblock",true);
	else
		$xt->assign("Description2_tabfieldblock",true);
////////////////////////////////////////////
//Description3 - 
	
	$value="";
	$value=DisplayLookupWizard("Description3",$data["Description3"],$data,$keylink,MODE_VIEW);
	$xt->assign("Description3_value",$value);
	if(!$pageObject->isAppearOnTabs("Description3"))
		$xt->assign("Description3_fieldblock",true);
	else
		$xt->assign("Description3_tabfieldblock",true);
////////////////////////////////////////////
//DataSource - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"DataSource", ""),"","",MODE_VIEW);
	$xt->assign("DataSource_value",$value);
	if(!$pageObject->isAppearOnTabs("DataSource"))
		$xt->assign("DataSource_fieldblock",true);
	else
		$xt->assign("DataSource_tabfieldblock",true);
////////////////////////////////////////////
//ICountry - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"ICountry", ""),"","",MODE_VIEW);
	$xt->assign("ICountry_value",$value);
	if(!$pageObject->isAppearOnTabs("ICountry"))
		$xt->assign("ICountry_fieldblock",true);
	else
		$xt->assign("ICountry_tabfieldblock",true);
////////////////////////////////////////////
//Species - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"Species", ""),"","",MODE_VIEW);
	$xt->assign("Species_value",$value);
	if(!$pageObject->isAppearOnTabs("Species"))
		$xt->assign("Species_fieldblock",true);
	else
		$xt->assign("Species_tabfieldblock",true);
////////////////////////////////////////////
//IngredientClass - 
	
	$value="";
	$value = ProcessLargeText(GetData($data,"IngredientClass", ""),"","",MODE_VIEW);
	$xt->assign("IngredientClass_value",$value);
	if(!$pageObject->isAppearOnTabs("IngredientClass"))
		$xt->assign("IngredientClass_fieldblock",true);
	else
		$xt->assign("IngredientClass_tabfieldblock",true);

$jsKeysObj = 'window.recKeysObj = {';
	$jsKeysObj .= "'".jsreplace("IngredientID")."': '".(jsreplace(@$data["IngredientID"]))."', ";
$jsKeysObj = substr($jsKeysObj, 0, strlen($jsKeysObj)-2);
$jsKeysObj .= '};';
$pageObject->AddJsCode($jsKeysObj);	

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_VIEW;
	$options["mainMasterPageType"] = PAGE_VIEW;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
	}
	
	$dControlsMap = array();
	
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "vw_ingredientclass";		
			continue;
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $flyId++;
		$mkr=1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		// show page
		if(!$pdf && $listPageObject->isDispGrid())
		{
			//add detail settings to master settings
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];				
			$dControlsMap[$strTableName]['video'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['video'];
			$dControlsMap[$strTableName]['gMaps'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['gMaps'];
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $keySet=>$val)
			{
				if(!array_key_exists($keySet,$pageObject->settingsMap["globalSettings"]['shortTNames']))
					$pageObject->settingsMap["globalSettings"]['shortTNames'][$keySet] = $val;
			}		
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files	
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		}
		$xt->assign("displayDetailTable_".GoodFieldName($strTableName), array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}	
	$strTableName = "vw_ingredientclass";		
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"] && !$inlineview && !$pdf)
{
	$pageObject->getNextPrevRecordKeys($data,"Search",$next,$prev);
}	
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
if ($pageObject->googleMapCfg['isUseGoogleMap'])
{
	$pageObject->initGmaps();
}

$pageObject->addCommonJs();

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();
	
if(!$inlineview)
{
	$pageObject->body["begin"].= "<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"> </div>";
	$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
	$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	if ($pageObject->debugJSMode === true)
	{			
		/*$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
			"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
			"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
			$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";	
	}
	else
	{
		$pageObject->body["begin"].="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}
		$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $keys;
	$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
	$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
		
	$pageObject->body["end"].="<script>".$pageObject->PrepareJS()."</script>";	
	
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";		
	$pageObject->body['end']["object"] = &$pageObject;	
	
	$xt->assignbyref("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	$xt->assign("footer","");
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
	
	$pageObject->fillSetCntrlMaps();
	
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;	
}
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

if(!$pdf && !$all && !$inlineview)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
    $nextlink=$prevlink="";
	if(count($next))
    {
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\" onclick=\"window.location.href='vw_ingredientclass_view.php?".$nextlink."'\"");
	}
	else 
		$xt->assign("next_button",false);	
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\" onclick=\"window.location.href='vw_ingredientclass_view.php?".$prevlink."'\"");
	}
    else 
		$xt->assign("prev_button",false);
//End show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
}

$oldtemplatefile=$templatefile;
$templatefile = "vw_ingredientclass_view.htm";

if(!$all)
{
	if($eventObj->exists("BeforeShowView"))
		$eventObj->BeforeShowView($xt,$templatefile,$data);
	
	if(!$pdf)
	{
		if(!$inlineview)
			$xt->display($templatefile);
		else{
				$xt->load_template($templatefile);
				$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('flybody');
				if($pageObject->isShowDetailTables)
					$returnJSON['html'].= $xt->fetch_loaded('detail_tables');
				$returnJSON['idStartFrom'] = $id+1;
				echo (my_json_encode($returnJSON)); 
			}
	}	
	break;
}
}


?>
