<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
add_nocache_headers();

include("include/vw_ingredientspecassociation_variables.php");
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
$templatefile = "vw_ingredientspecassociation_search.htm";

// for ajax query, used when page buffers new control
if(postvalue("mode")=="inlineLoadCtrl"){
	$mode = SEARCH_LOAD_CONTROL;
	$templatefile = "vw_ingredientspecassociation_inline_search.htm";
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
$params['shortTableName'] = 'vw_ingredientspecassociation';
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
	
	if(GetLookupTable("SpeciesID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("SpeciesID", $strTableName)] = GetTableURL(GetLookupTable("SpeciesID", $strTableName));
	
	$pageObject->fillFieldToolTips("SpeciesID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("SpeciesID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "SpeciesID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("SpeciesID_label","<label for=\"".GetInputElementId("SpeciesID", $id)."\">","</label>");
	else 
		$xt->assign("SpeciesID_label", true);
	
	$xt->assign("SpeciesID_fieldblock", true);		
	$xt->assignbyref("SpeciesID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("SpeciesID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("SpeciesID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_SpeciesID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("SpeciesID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpeciesID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpeciesID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("IngredientSpecID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IngredientSpecID", $strTableName)] = GetTableURL(GetLookupTable("IngredientSpecID", $strTableName));
	
	$pageObject->fillFieldToolTips("IngredientSpecID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IngredientSpecID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IngredientSpecID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IngredientSpecID_label","<label for=\"".GetInputElementId("IngredientSpecID", $id)."\">","</label>");
	else 
		$xt->assign("IngredientSpecID_label", true);
	
	$xt->assign("IngredientSpecID_fieldblock", true);		
	$xt->assignbyref("IngredientSpecID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IngredientSpecID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IngredientSpecID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IngredientSpecID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IngredientSpecID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IngredientSpecID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IngredientSpecID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("CountryID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("CountryID", $strTableName)] = GetTableURL(GetLookupTable("CountryID", $strTableName));
	
	$pageObject->fillFieldToolTips("CountryID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("CountryID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "CountryID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("CountryID_label","<label for=\"".GetInputElementId("CountryID", $id)."\">","</label>");
	else 
		$xt->assign("CountryID_label", true);
	
	$xt->assign("CountryID_fieldblock", true);		
	$xt->assignbyref("CountryID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("CountryID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("CountryID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_CountryID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("CountryID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"CountryID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"CountryID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("IName", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IName", $strTableName)] = GetTableURL(GetLookupTable("IName", $strTableName));
	
	$pageObject->fillFieldToolTips("IName");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IName_label","<label for=\"".GetInputElementId("IName", $id)."\">","</label>");
	else 
		$xt->assign("IName_label", true);
	
	$xt->assign("IName_fieldblock", true);		
	$xt->assignbyref("IName_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IName_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IName_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IName", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("IfeedNo", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IfeedNo", $strTableName)] = GetTableURL(GetLookupTable("IfeedNo", $strTableName));
	
	$pageObject->fillFieldToolTips("IfeedNo");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IfeedNo");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IfeedNo";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IfeedNo_label","<label for=\"".GetInputElementId("IfeedNo", $id)."\">","</label>");
	else 
		$xt->assign("IfeedNo_label", true);
	
	$xt->assign("IfeedNo_fieldblock", true);		
	$xt->assignbyref("IfeedNo_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IfeedNo_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IfeedNo_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IfeedNo", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IfeedNo");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IfeedNo", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IfeedNo", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Description1", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Description1", $strTableName)] = GetTableURL(GetLookupTable("Description1", $strTableName));
	
	$pageObject->fillFieldToolTips("Description1");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Description1");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Description1";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Description1_label","<label for=\"".GetInputElementId("Description1", $id)."\">","</label>");
	else 
		$xt->assign("Description1_label", true);
	
	$xt->assign("Description1_fieldblock", true);		
	$xt->assignbyref("Description1_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Description1_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Description1_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Description1", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Description1");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description1", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description1", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Description2", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Description2", $strTableName)] = GetTableURL(GetLookupTable("Description2", $strTableName));
	
	$pageObject->fillFieldToolTips("Description2");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Description2");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Description2";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Description2_label","<label for=\"".GetInputElementId("Description2", $id)."\">","</label>");
	else 
		$xt->assign("Description2_label", true);
	
	$xt->assign("Description2_fieldblock", true);		
	$xt->assignbyref("Description2_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Description2_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Description2_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Description2", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Description2");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description2", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description2", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Description3", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Description3", $strTableName)] = GetTableURL(GetLookupTable("Description3", $strTableName));
	
	$pageObject->fillFieldToolTips("Description3");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Description3");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Description3";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Description3_label","<label for=\"".GetInputElementId("Description3", $id)."\">","</label>");
	else 
		$xt->assign("Description3_label", true);
	
	$xt->assign("Description3_fieldblock", true);		
	$xt->assignbyref("Description3_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Description3_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Description3_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Description3", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Description3");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description3", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Description3", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
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
	// search fields data
	
	if(GetLookupTable("IDSourceID", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("IDSourceID", $strTableName)] = GetTableURL(GetLookupTable("IDSourceID", $strTableName));
	
	$pageObject->fillFieldToolTips("IDSourceID");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("IDSourceID");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "IDSourceID";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("IDSourceID_label","<label for=\"".GetInputElementId("IDSourceID", $id)."\">","</label>");
	else 
		$xt->assign("IDSourceID_label", true);
	
	$xt->assign("IDSourceID_fieldblock", true);		
	$xt->assignbyref("IDSourceID_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("IDSourceID_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("IDSourceID_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_IDSourceID", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("IDSourceID");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IDSourceID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"IDSourceID", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("DataSource", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("DataSource", $strTableName)] = GetTableURL(GetLookupTable("DataSource", $strTableName));
	
	$pageObject->fillFieldToolTips("DataSource");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("DataSource");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "DataSource";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("DataSource_label","<label for=\"".GetInputElementId("DataSource", $id)."\">","</label>");
	else 
		$xt->assign("DataSource_label", true);
	
	$xt->assign("DataSource_fieldblock", true);		
	$xt->assignbyref("DataSource_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("DataSource_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("DataSource_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_DataSource", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("DataSource");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DataSource", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"DataSource", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("ICountry", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("ICountry", $strTableName)] = GetTableURL(GetLookupTable("ICountry", $strTableName));
	
	$pageObject->fillFieldToolTips("ICountry");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("ICountry");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "ICountry";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("ICountry_label","<label for=\"".GetInputElementId("ICountry", $id)."\">","</label>");
	else 
		$xt->assign("ICountry_label", true);
	
	$xt->assign("ICountry_fieldblock", true);		
	$xt->assignbyref("ICountry_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("ICountry_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("ICountry_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_ICountry", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("ICountry");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ICountry", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"ICountry", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Species", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Species", $strTableName)] = GetTableURL(GetLookupTable("Species", $strTableName));
	
	$pageObject->fillFieldToolTips("Species");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Species");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Species";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Species_label","<label for=\"".GetInputElementId("Species", $id)."\">","</label>");
	else 
		$xt->assign("Species_label", true);
	
	$xt->assign("Species_fieldblock", true);		
	$xt->assignbyref("Species_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Species_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Species_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Species", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Species");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Species", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Species", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("SpecName", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("SpecName", $strTableName)] = GetTableURL(GetLookupTable("SpecName", $strTableName));
	
	$pageObject->fillFieldToolTips("SpecName");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("SpecName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "SpecName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("SpecName_label","<label for=\"".GetInputElementId("SpecName", $id)."\">","</label>");
	else 
		$xt->assign("SpecName_label", true);
	
	$xt->assign("SpecName_fieldblock", true);		
	$xt->assignbyref("SpecName_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("SpecName_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("SpecName_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_SpecName", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("SpecName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpecName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpecName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("CommonName", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("CommonName", $strTableName)] = GetTableURL(GetLookupTable("CommonName", $strTableName));
	
	$pageObject->fillFieldToolTips("CommonName");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("CommonName");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "CommonName";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("CommonName_label","<label for=\"".GetInputElementId("CommonName", $id)."\">","</label>");
	else 
		$xt->assign("CommonName_label", true);
	
	$xt->assign("CommonName_fieldblock", true);		
	$xt->assignbyref("CommonName_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("CommonName_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("CommonName_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_CommonName", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("CommonName");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"CommonName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"CommonName", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Hybrid", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Hybrid", $strTableName)] = GetTableURL(GetLookupTable("Hybrid", $strTableName));
	
	$pageObject->fillFieldToolTips("Hybrid");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Hybrid");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Hybrid";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Hybrid_label","<label for=\"".GetInputElementId("Hybrid", $id)."\">","</label>");
	else 
		$xt->assign("Hybrid_label", true);
	
	$xt->assign("Hybrid_fieldblock", true);		
	$xt->assignbyref("Hybrid_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Hybrid_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Hybrid_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Hybrid", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Hybrid");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Hybrid", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Hybrid", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Variety", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Variety", $strTableName)] = GetTableURL(GetLookupTable("Variety", $strTableName));
	
	$pageObject->fillFieldToolTips("Variety");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Variety");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Variety";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Variety_label","<label for=\"".GetInputElementId("Variety", $id)."\">","</label>");
	else 
		$xt->assign("Variety_label", true);
	
	$xt->assign("Variety_fieldblock", true);		
	$xt->assignbyref("Variety_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Variety_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Variety_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Variety", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Variety");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Variety", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Variety", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Family", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Family", $strTableName)] = GetTableURL(GetLookupTable("Family", $strTableName));
	
	$pageObject->fillFieldToolTips("Family");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Family");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Family";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Family_label","<label for=\"".GetInputElementId("Family", $id)."\">","</label>");
	else 
		$xt->assign("Family_label", true);
	
	$xt->assign("Family_fieldblock", true);		
	$xt->assignbyref("Family_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Family_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Family_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Family", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Family");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Family", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Family", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Group", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Group", $strTableName)] = GetTableURL(GetLookupTable("Group", $strTableName));
	
	$pageObject->fillFieldToolTips("Group");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Group");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Group";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Group_label","<label for=\"".GetInputElementId("Group", $id)."\">","</label>");
	else 
		$xt->assign("Group_label", true);
	
	$xt->assign("Group_fieldblock", true);		
	$xt->assignbyref("Group_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Group_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Group_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Group", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Group");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Group", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Group", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Genus", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Genus", $strTableName)] = GetTableURL(GetLookupTable("Genus", $strTableName));
	
	$pageObject->fillFieldToolTips("Genus");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Genus");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Genus";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Genus_label","<label for=\"".GetInputElementId("Genus", $id)."\">","</label>");
	else 
		$xt->assign("Genus_label", true);
	
	$xt->assign("Genus_fieldblock", true);		
	$xt->assignbyref("Genus_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Genus_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Genus_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Genus", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Genus");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Genus", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Genus", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Environment", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Environment", $strTableName)] = GetTableURL(GetLookupTable("Environment", $strTableName));
	
	$pageObject->fillFieldToolTips("Environment");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Environment");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Environment";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Environment_label","<label for=\"".GetInputElementId("Environment", $id)."\">","</label>");
	else 
		$xt->assign("Environment_label", true);
	
	$xt->assign("Environment_fieldblock", true);		
	$xt->assignbyref("Environment_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Environment_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Environment_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Environment", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Environment");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Environment", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Environment", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("FeedHabit", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("FeedHabit", $strTableName)] = GetTableURL(GetLookupTable("FeedHabit", $strTableName));
	
	$pageObject->fillFieldToolTips("FeedHabit");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("FeedHabit");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "FeedHabit";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("FeedHabit_label","<label for=\"".GetInputElementId("FeedHabit", $id)."\">","</label>");
	else 
		$xt->assign("FeedHabit_label", true);
	
	$xt->assign("FeedHabit_fieldblock", true);		
	$xt->assignbyref("FeedHabit_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("FeedHabit_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("FeedHabit_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_FeedHabit", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("FeedHabit");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"FeedHabit", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"FeedHabit", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("Country", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("Country", $strTableName)] = GetTableURL(GetLookupTable("Country", $strTableName));
	
	$pageObject->fillFieldToolTips("Country");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("Country");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "Country";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("Country_label","<label for=\"".GetInputElementId("Country", $id)."\">","</label>");
	else 
		$xt->assign("Country_label", true);
	
	$xt->assign("Country_fieldblock", true);		
	$xt->assignbyref("Country_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("Country_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("Country_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_Country", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("Country");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Country", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"Country", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("SpecYear", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("SpecYear", $strTableName)] = GetTableURL(GetLookupTable("SpecYear", $strTableName));
	
	$pageObject->fillFieldToolTips("SpecYear");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("SpecYear");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "SpecYear";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("SpecYear_label","<label for=\"".GetInputElementId("SpecYear", $id)."\">","</label>");
	else 
		$xt->assign("SpecYear_label", true);
	
	$xt->assign("SpecYear_fieldblock", true);		
	$xt->assignbyref("SpecYear_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("SpecYear_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("SpecYear_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_SpecYear", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("SpecYear");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpecYear", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"SpecYear", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("lower", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("lower", $strTableName)] = GetTableURL(GetLookupTable("lower", $strTableName));
	
	$pageObject->fillFieldToolTips("lower");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("lower");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "lower";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("lower_label","<label for=\"".GetInputElementId("lower", $id)."\">","</label>");
	else 
		$xt->assign("lower_label", true);
	
	$xt->assign("lower_fieldblock", true);		
	$xt->assignbyref("lower_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("lower_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("lower_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_lower", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("lower");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"lower", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"lower", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
		$ctrlInd++;
	}
	// search fields data
	
	if(GetLookupTable("upper", $strTableName))
		$pageObject->settingsMap["globalSettings"]['shortTNames'][GetLookupTable("upper", $strTableName)] = GetTableURL(GetLookupTable("upper", $strTableName));
	
	$pageObject->fillFieldToolTips("upper");	
		
	$srchFields = $pageObject->searchClauseObj->getSearchCtrlParams("upper");
	$firstFieldParams = array();
	if (count($srchFields))
	{
		$firstFieldParams = $srchFields[0];
	}
	else
	{
		$firstFieldParams['fName'] = "upper";
		$firstFieldParams['eType'] = '';
		$firstFieldParams['value1'] = '';
		$firstFieldParams['opt'] = '';
		$firstFieldParams['value2'] = '';
		$firstFieldParams['not'] = false;
	}
	// create control	
	$ctrlBlockArr = $searchControlBuilder->buildSearchCtrlBlockArr($id, $firstFieldParams['fName'], 0, $firstFieldParams['opt'], $firstFieldParams['not'], false, $firstFieldParams['value1'], $firstFieldParams['value2']);	
		
	if(isEnableSection508())
		$xt->assign_section("upper_label","<label for=\"".GetInputElementId("upper", $id)."\">","</label>");
	else 
		$xt->assign("upper_label", true);
	
	$xt->assign("upper_fieldblock", true);		
	$xt->assignbyref("upper_editcontrol", $ctrlBlockArr['searchcontrol']);					
	$xt->assign("upper_notbox", $ctrlBlockArr['notbox']);		
	// create second control, if need it		
	$xt->assignbyref("upper_editcontrol1", $ctrlBlockArr['searchcontrol1']);		
	// create search type select
	$xt->assign("searchtype_upper", $ctrlBlockArr['searchtype']);	
	$isFieldNeedSecCtrl = $searchControlBuilder->isNeedSecondCtrl("upper");
	$ctrlInd = 0;
	if ($isFieldNeedSecCtrl) 
	{				
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"upper", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd, 1=>($ctrlInd+1)));
		$ctrlInd+=2;
	}
	else
	{	
		$pageObject->controlsMap["search"]["searchBlocks"][] = array('fName'=>"upper", 'recId'=>$id, 'ctrlsMap'=>array(0=>$ctrlInd));			
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
