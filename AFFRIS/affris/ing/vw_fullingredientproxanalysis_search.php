<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
add_nocache_headers();

include("include/vw_fullingredientproxanalysis_variables.php");
include("classes/searchcontrol.php");
include("classes/advancedsearchcontrol.php");
include("classes/panelsearchcontrol.php");
include("classes/searchclause.php");

$sessionPrefix = $strTableName;

//Basic includes js files
$includes="";
// predefined fields num
$predefFieldNum = 0;

$chrt_array=array();
$rpt_array=array();

//	check if logged in
if( (!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !@$chrt_array['status'] && !@$rpt_array['status'])
|| (@$rpt_array['status'] == "private" && @$rpt_array['owner'] != @$_SESSION["UserID"])
|| (@$chrt_array['status'] == "private" && @$chrt_array['owner'] != @$_SESSION["UserID"]) )
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

// id that used to add to controls names
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;
	
// for usual page show proccess
$mode=SEARCH_SIMPLE;
$templatefile = "vw_fullingredientproxanalysis_search.htm";

// for ajax query, used when page buffers new control
if(postvalue("mode")=="inlineLoadCtrl"){
	$mode = SEARCH_LOAD_CONTROL;
	$templatefile = "vw_fullingredientproxanalysis_inline_search.htm";
}	
	

$calendar = false;

////////////////////// time picker
$timepicker = false;

$params = array();
$params["id"] = $id;
$params["mode"] = $mode;
$params["calendar"] = $calendar;
$params["timepicker"] = $timepicker;
$params['xt'] = &$xt;
$params['shortTableName'] = 'vw_fullingredientproxanalysis';
$params['origTName'] = $strOriginalTableName;
$params['sessionPrefix'] = $sessionPrefix;
$params['tName'] = $strTableName;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;
$params['pageType']=PAGE_SEARCH;

//PAGE_SEARCH,$id,$calendar

$pageObject = new RunnerPage($params);

// create reusable searchControl builder instance
$searchControllerId = (postvalue('searchControllerId') ? postvalue('searchControllerId') : $pageObject->id);




//	Before Process event
if($eventObj->exists("BeforeProcessSearch"))
	$eventObj->BeforeProcessSearch($conn);

// add constants and files for simple view
if ($mode==SEARCH_SIMPLE)
{
	$searchControlBuilder = new AdvancedSearchControl($searchControllerId, $strTableName, $pageObject->searchClauseObj, $pageObject);
	// add onload event
	$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadSearch", '');
	$pageObject->addOnLoadJsEvent($onLoadJsCode);

	// add button events if exist
	$pageObject->addButtonHandlers();

	$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\" src=\"include/customlabels.js\"></script>\r\n";
	$includes .="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";	
	if ($pageObject->debugJSMode === true)
	{
		/*$includes.="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}
	else
	{
		$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
	}	

	// if not simple, this div already exist on page
	$includes.="<div id=\"search_suggest\" class=\"search_suggest\"></div>";	

	// search panel radio button assign
	$searchRadio = $searchControlBuilder->getSearchRadio();
	$xt->assign_section("all_checkbox_label", $searchRadio['all_checkbox_label'][0], $searchRadio['all_checkbox_label'][1]);
	$xt->assign_section("any_checkbox_label", $searchRadio['any_checkbox_label'][0], $searchRadio['any_checkbox_label'][1]);
	$xt->assignbyref("all_checkbox",$searchRadio['all_checkbox']);
	$xt->assignbyref("any_checkbox",$searchRadio['any_checkbox']);
		
	// search fields data
	
	if(GetLookupTable("IngredientID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IngredientID", $strTableName)] = GetTableURL(GetLookupTable("IngredientID", $strTableName));
	
	$pageObject->fillFieldToolTips("IngredientID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IngredientID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IngredientID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IngredientID_label","<label for=\"".GetInputElementId("IngredientID", $id)."\">","</label>");
	else 
		$xt->assign("IngredientID_label", true);
	
	$xt->assign("IngredientID_fieldblock", true);		
	$xt->assignbyref("IngredientID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IngredientID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IngredientID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IngredientID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IngredientID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IngredientID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IngredientID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("ElementTypeID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("ElementTypeID", $strTableName)] = GetTableURL(GetLookupTable("ElementTypeID", $strTableName));
	
	$pageObject->fillFieldToolTips("ElementTypeID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("ElementTypeID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "ElementTypeID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("ElementTypeID_label","<label for=\"".GetInputElementId("ElementTypeID", $id)."\">","</label>");
	else 
		$xt->assign("ElementTypeID_label", true);
	
	$xt->assign("ElementTypeID_fieldblock", true);		
	$xt->assignbyref("ElementTypeID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("ElementTypeID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("ElementTypeID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_ElementTypeID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("ElementTypeID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ElementTypeID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ElementTypeID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Description", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Description", $strTableName)] = GetTableURL(GetLookupTable("Description", $strTableName));
	
	$pageObject->fillFieldToolTips("Description");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Description");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Description";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Description_label","<label for=\"".GetInputElementId("Description", $id)."\">","</label>");
	else 
		$xt->assign("Description_label", true);
	
	$xt->assign("Description_fieldblock", true);		
	$xt->assignbyref("Description_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Description_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Description_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Description", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Description");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("UnitName", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("UnitName", $strTableName)] = GetTableURL(GetLookupTable("UnitName", $strTableName));
	
	$pageObject->fillFieldToolTips("UnitName");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("UnitName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "UnitName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("UnitName_label","<label for=\"".GetInputElementId("UnitName", $id)."\">","</label>");
	else 
		$xt->assign("UnitName_label", true);
	
	$xt->assign("UnitName_fieldblock", true);		
	$xt->assignbyref("UnitName_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("UnitName_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("UnitName_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_UnitName", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("UnitName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("UnitSymbol", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("UnitSymbol", $strTableName)] = GetTableURL(GetLookupTable("UnitSymbol", $strTableName));
	
	$pageObject->fillFieldToolTips("UnitSymbol");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("UnitSymbol");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "UnitSymbol";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("UnitSymbol_label","<label for=\"".GetInputElementId("UnitSymbol", $id)."\">","</label>");
	else 
		$xt->assign("UnitSymbol_label", true);
	
	$xt->assign("UnitSymbol_fieldblock", true);		
	$xt->assignbyref("UnitSymbol_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("UnitSymbol_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("UnitSymbol_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_UnitSymbol", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("UnitSymbol");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitSymbol", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitSymbol", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("UnitDecimal", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("UnitDecimal", $strTableName)] = GetTableURL(GetLookupTable("UnitDecimal", $strTableName));
	
	$pageObject->fillFieldToolTips("UnitDecimal");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("UnitDecimal");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "UnitDecimal";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("UnitDecimal_label","<label for=\"".GetInputElementId("UnitDecimal", $id)."\">","</label>");
	else 
		$xt->assign("UnitDecimal_label", true);
	
	$xt->assign("UnitDecimal_fieldblock", true);		
	$xt->assignbyref("UnitDecimal_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("UnitDecimal_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("UnitDecimal_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_UnitDecimal", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("UnitDecimal");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitDecimal", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"UnitDecimal", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("ETValue", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("ETValue", $strTableName)] = GetTableURL(GetLookupTable("ETValue", $strTableName));
	
	$pageObject->fillFieldToolTips("ETValue");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("ETValue");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "ETValue";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("ETValue_label","<label for=\"".GetInputElementId("ETValue", $id)."\">","</label>");
	else 
		$xt->assign("ETValue_label", true);
	
	$xt->assign("ETValue_fieldblock", true);		
	$xt->assignbyref("ETValue_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("ETValue_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("ETValue_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_ETValue", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("ETValue");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ETValue", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ETValue", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("IisDetail", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IisDetail", $strTableName)] = GetTableURL(GetLookupTable("IisDetail", $strTableName));
	
	$pageObject->fillFieldToolTips("IisDetail");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IisDetail");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IisDetail";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IisDetail_label","<label for=\"".GetInputElementId("IisDetail", $id)."\">","</label>");
	else 
		$xt->assign("IisDetail_label", true);
	
	$xt->assign("IisDetail_fieldblock", true);		
	$xt->assignbyref("IisDetail_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IisDetail_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IisDetail_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IisDetail", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IisDetail");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IisDetail", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IisDetail", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	
	//--------------------------------------------------------
	
	$pageObject->body["begin"] .= $includes;

	$pageObject->addCommonJs();
		
	$xt->assignbyref("body",$pageObject->body);
	
	$xt->assign("contents_block", true);
	
	$xt->assign("conditions_block",true);
	$xt->assign("search_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
	
	
	$xt->assign("searchbutton_attrs","id=\"searchButton".$id."\"");
	$xt->assign("resetbutton_attrs","id=\"resetButton".$id."\"");		
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
	

	if($eventObj->exists("BeforeShowSearch"))
		$eventObj->BeforeShowSearch($xt,$templatefile);
	// load controls for first page loading	
	
	
	$pageObject->fillSetCntrlMaps();
	
	$pageObject->body['end'] .= '<script>';
	$pageObject->body['end'] .= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
	$pageObject->body['end'] .= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
	$pageObject->body['end'] .= '</script>';
	
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJs()."</script>";	
	
	$xt->assignbyref("body",$pageObject->body);
	$xt->display($templatefile);
	exit();	
}
else if($mode==SEARCH_LOAD_CONTROL)
{	

	$searchControlBuilder = new PanelSearchControl($searchControllerId, $strTableName, $pageObject->searchClauseObj, $pageObject);
	$ctrlField = postvalue('ctrlField');	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $ctrlField, 0, '', false, true, '', '');	
	
	// build array for encode
	$resArr = array();
	$resArr['control1'] = trim($xt->call_func($ctrlBlockArr['searchcontrol']));
	$resArr['control2'] = trim($xt->call_func($ctrlBlockArr['searchcontrol1']));
	$resArr['comboHtml'] = trim($ctrlBlockArr['searchtype']);
	$resArr['delButt'] = trim($ctrlBlockArr['delCtrlButt']);
	$resArr['delButtId'] =  trim($searchControlBuilder->getDelButtonId($ctrlField, $id));
	$resArr['divInd'] = trim($id);	
	$resArr['fLabel'] = GetFieldLabel(GoodFieldName($strTableName),GoodFieldName($ctrlField));
	$resArr['ctrlMap'] = $pageObject->controlsMap['controls'];
	
	if (postvalue('isNeedSettings') == 'true')
	{
		$pageObject->fillSettings();
		$resArr['settings'] = $pageObject->jsSettings;
	}
		
	// return JSON
	echo my_json_encode($resArr);
	exit();
}
	

?>
