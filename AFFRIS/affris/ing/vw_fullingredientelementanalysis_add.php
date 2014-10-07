<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

add_nocache_headers();
include("include/vw_fullingredientelementanalysis_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');

//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	
	header("Location: login.php?message=expired"); 
	return;
}

$filename = "";
$status = "";
$message = "";
$mesClass = "";
$usermessage = "";
$error_happened = false;
$readavalues = false;

$keys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$popUpSave = false;

$sessionPrefix = $strTableName;

$onFly = false;
if(postvalue("onFly"))
	$onFly = true;

if(@$_REQUEST["editType"]=="inline")
	$inlineadd = ADD_INLINE;
elseif(@$_REQUEST["editType"]==ADD_POPUP)
{
	$inlineadd = ADD_POPUP;
	if(@$_POST["a"]=="added" && postvalue("field")=="" && postvalue("category")=="")
		$popUpSave = true;	
}
elseif(@$_REQUEST["editType"]=="addmaster")
	$inlineadd = ADD_MASTER;
elseif($onFly)
{
	$inlineadd = ADD_ONTHEFLY;
	$sessionPrefix = $strTableName."_add";
}
else
	$inlineadd = ADD_SIMPLE;

if($inlineadd == ADD_INLINE)
	$templatefile = "vw_fullingredientelementanalysis_inline_add.htm";
else
	$templatefile = "vw_fullingredientelementanalysis_add.htm";

$id = postvalue("id");	
if(intval($id)==0)
	$id = 1;

//If undefined session value for mastet table, but exist post value master table, than take second
//It may be happen only when use dpInline mode on page add
if(!@$_SESSION[$sessionPrefix."_mastertable"] && postvalue("mastertable"))
	$_SESSION[$sessionPrefix."_mastertable"] = postvalue("mastertable");

$xt = new Xtempl();
	
// assign an id		
$xt->assign("id",$id);
	
$auditObj = GetAuditObject($strTableName);

//array of params for classes
$params = array("pageType" => PAGE_ADD,"id" => $id,"mode" => $inlineadd);

////////////////////// data picker

////////////////////// time picker

$params['tName'] = $strTableName;
$params['strOriginalTableName'] = $strOriginalTableName;
$params['menuTablesArr'] = $menuTablesArr;
$params['xt'] = &$xt;
$params['needSearchClauseObj'] = false;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;
$params['pageAddLikeInline'] = ($inlineadd==ADD_INLINE);
$params['useTabsOnAdd'] = useTabsOnAdd($strTableName);
if($params['useTabsOnAdd'])
	$params['arrAddTabs'] = GetAddTabs($strTableName);
$pageObject = new RunnerPage($params);

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;

//Array of fields, which appear on add page
$addFields = $pageObject->getFieldsByPageType();

// add onload event
//$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadAdd", '');
//$pageObject->addOnLoadJsEvent($onLoadJsCode);

if ($inlineadd==ADD_SIMPLE)
{
	// add button events if exist
	$pageObject->addButtonHandlers();
}

$url_page=substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//For show detail tables on master page add
if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{
	$dpParams = array();
	if($pageObject->isShowDetailTables)
	{
		$ids = $id;
		$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
		if($inlineadd==ADD_SIMPLE)
			$pageObject->AddJSFile("include/detailspreview");	
	}
}

//	Before Process event
if($eventObj->exists("BeforeProcessAdd"))
	$eventObj->BeforeProcessAdd($conn);

// proccess captcha
if ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();	
	
// insert new record if we have to
if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
//	processing IngredientID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IngredientID_".$id);
		$type=postvalue("type_IngredientID_".$id);
		if (FieldSubmitted("IngredientID_".$id))
		{
				$value=prepare_for_db("IngredientID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IngredientID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IngredientID"]=$value;
		}
		}
//	processibng IngredientID - end
//	processing ElementID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_ElementID_".$id);
		$type=postvalue("type_ElementID_".$id);
		if (FieldSubmitted("ElementID_".$id))
		{
				$value=prepare_for_db("ElementID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "ElementID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["ElementID"]=$value;
		}
		}
//	processibng ElementID - end
//	processing EName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_EName_".$id);
		$type=postvalue("type_EName_".$id);
		if (FieldSubmitted("EName_".$id))
		{
				$value=prepare_for_db("EName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "EName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["EName"]=$value;
		}
		}
//	processibng EName - end
//	processing CommonName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_CommonName_".$id);
		$type=postvalue("type_CommonName_".$id);
		if (FieldSubmitted("CommonName_".$id))
		{
				$value=prepare_for_db("CommonName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "CommonName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["CommonName"]=$value;
		}
		}
//	processibng CommonName - end
//	processing TagName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_TagName_".$id);
		$type=postvalue("type_TagName_".$id);
		if (FieldSubmitted("TagName_".$id))
		{
				$value=prepare_for_db("TagName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "TagName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["TagName"]=$value;
		}
		}
//	processibng TagName - end
//	processing ElementTypeID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_ElementTypeID_".$id);
		$type=postvalue("type_ElementTypeID_".$id);
		if (FieldSubmitted("ElementTypeID_".$id))
		{
				$value=prepare_for_db("ElementTypeID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "ElementTypeID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["ElementTypeID"]=$value;
		}
		}
//	processibng ElementTypeID - end
//	processing Description - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Description_".$id);
		$type=postvalue("type_Description_".$id);
		if (FieldSubmitted("Description_".$id))
		{
				$value=prepare_for_db("Description",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Description"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Description"]=$value;
		}
		}
//	processibng Description - end
//	processing UnitID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_UnitID_".$id);
		$type=postvalue("type_UnitID_".$id);
		if (FieldSubmitted("UnitID_".$id))
		{
				$value=prepare_for_db("UnitID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "UnitID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["UnitID"]=$value;
		}
		}
//	processibng UnitID - end
//	processing UnitName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_UnitName_".$id);
		$type=postvalue("type_UnitName_".$id);
		if (FieldSubmitted("UnitName_".$id))
		{
				$value=prepare_for_db("UnitName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "UnitName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["UnitName"]=$value;
		}
		}
//	processibng UnitName - end
//	processing UnitSymbol - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_UnitSymbol_".$id);
		$type=postvalue("type_UnitSymbol_".$id);
		if (FieldSubmitted("UnitSymbol_".$id))
		{
				$value=prepare_for_db("UnitSymbol",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "UnitSymbol"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["UnitSymbol"]=$value;
		}
		}
//	processibng UnitSymbol - end
//	processing UnitDecimal - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_UnitDecimal_".$id);
		$type=postvalue("type_UnitDecimal_".$id);
		if (FieldSubmitted("UnitDecimal_".$id))
		{
				$value=prepare_for_db("UnitDecimal",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "UnitDecimal"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["UnitDecimal"]=$value;
		}
		}
//	processibng UnitDecimal - end
//	processing IValue - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IValue_".$id);
		$type=postvalue("type_IValue_".$id);
		if (FieldSubmitted("IValue_".$id))
		{
				$value=prepare_for_db("IValue",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IValue"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IValue"]=$value;
		}
		}
//	processibng IValue - end


//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$sessionPrefix."_mastertable"]=="vw_ingredientclass")
	{
		if(postvalue("masterkey1"))
			$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
		
		if($avalues["IngredientID"]=="")
			$avalues["IngredientID"]=prepare_for_db("IngredientID",$_SESSION[$sessionPrefix."_masterkey1"]);
			
	}


	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if($eventObj->exists("BeforeAdd"))
		$retval=$eventObj->BeforeAdd($avalues,$usermessage,(bool)$inlineadd);
	if($retval && $pageObject->isCaptchaOk)
	{
		$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields,$id,$pageObject))
		{
			$IsSaved=true;
//	after edit event
			if($auditObj || $eventObj->exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
			}
			
			if($auditObj)
				$auditObj->LogAdd($strTableName,$avalues,$keys);

			if($eventObj->exists("AfterAdd"))
				$eventObj->AfterAdd($avalues,$keys,(bool)$inlineadd);
				
			if($inlineadd==ADD_SIMPLE || $inlineadd==ADD_MASTER)
			{
				$permis = array();
				$keylink = "";$k = 0;
				foreach($keys as $idx=>$val)
				{
					if($k!=0)
						$keylink .="&";
					$keylink .="editid".(++$k)."=".htmlspecialchars(rawurlencode(@$val));
				}
				$permis = $pageObject->getPermissions();				
				if (count($keys))
				{
					$message .="</br>";
					if(GetTableData($strTableName,".edit",false) && $permis['edit'])
						$message .='&nbsp;<a href=\'vw_fullingredientelementanalysis_edit.php?'.$keylink.'\'>'."Edit".'</a>&nbsp;';
					if(GetTableData($strTableName,".view",false) && $permis['search'])
						$message .='&nbsp;<a href=\'vw_fullingredientelementanalysis_view.php?'.$keylink.'\'>'."View".'</a>&nbsp;';
				}
				$mesClass = "mes_ok";	
			}
		}
		elseif($inlineadd!=ADD_INLINE)
			$mesClass = "mes_not";	
	}
	else
	{
		$message = $usermessage;
		$status="DECLINED";
		$readavalues=true;
	}
}

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if (no_output_done() && $inlineadd==ADD_SIMPLE && $IsSaved)
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// redirect
	header("Location: vw_fullingredientelementanalysis_".$pageObject->getPageType().".php");
	// turned on output buffering, so we need to stop script
	exit();
}

if($inlineadd==ADD_MASTER && $IsSaved)
	$_SESSION["message"] = ($message ? $message : "");
	
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if($inlineadd==ADD_SIMPLE && isset($_SESSION["message"]))
{
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}

$defvalues=array();

//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["IngredientID"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["IngredientID"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["IngredientID"]="";
//call CopyOnLoad event
	if($eventObj->exists("CopyOnLoad"))
		$eventObj->CopyOnLoad($defvalues,$strWhere);
}
else
{
}

//	set default values for the foreign keys

if(@$_SESSION[$sessionPrefix."_mastertable"]=="vw_ingredientclass")
{
	if(postvalue("masterkey1"))
		$_SESSION[$sessionPrefix."_masterkey1"] = postvalue("masterkey1");
	
	$defvalues["IngredientID"] = @$_SESSION[$sessionPrefix."_masterkey1"];	
	
}

if($readavalues)
{
	$defvalues["IngredientID"]=@$avalues["IngredientID"];
	$defvalues["ElementID"]=@$avalues["ElementID"];
	$defvalues["EName"]=@$avalues["EName"];
	$defvalues["CommonName"]=@$avalues["CommonName"];
	$defvalues["TagName"]=@$avalues["TagName"];
	$defvalues["ElementTypeID"]=@$avalues["ElementTypeID"];
	$defvalues["Description"]=@$avalues["Description"];
	$defvalues["UnitID"]=@$avalues["UnitID"];
	$defvalues["UnitName"]=@$avalues["UnitName"];
	$defvalues["UnitSymbol"]=@$avalues["UnitSymbol"];
	$defvalues["UnitDecimal"]=@$avalues["UnitDecimal"];
	$defvalues["IValue"]=@$avalues["IValue"];
}

if($eventObj->exists("ProcessValuesAdd"))
	$eventObj->ProcessValuesAdd($defvalues);


//for basic files
$includes="";

if($inlineadd!=ADD_INLINE)
{
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$includes .="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
		if ($pageObject->debugJSMode===true)
		{
			/*$includes.="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
			$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
		}
		else 
			$includes .= "<script type=\"text/javascript\" src=\"include/runnerJS/RunnerBase.js\"></script>";
		
		$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
	
	if(!$pageObject->isAppearOnTabs("IngredientID"))
		$xt->assign("IngredientID_fieldblock",true);
	else
		$xt->assign("IngredientID_tabfieldblock",true);
	$xt->assign("IngredientID_label",true);
	if(isEnableSection508())
		$xt->assign_section("IngredientID_label","<label for=\"".GetInputElementId("IngredientID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("ElementID"))
		$xt->assign("ElementID_fieldblock",true);
	else
		$xt->assign("ElementID_tabfieldblock",true);
	$xt->assign("ElementID_label",true);
	if(isEnableSection508())
		$xt->assign_section("ElementID_label","<label for=\"".GetInputElementId("ElementID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("EName"))
		$xt->assign("EName_fieldblock",true);
	else
		$xt->assign("EName_tabfieldblock",true);
	$xt->assign("EName_label",true);
	if(isEnableSection508())
		$xt->assign_section("EName_label","<label for=\"".GetInputElementId("EName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("CommonName"))
		$xt->assign("CommonName_fieldblock",true);
	else
		$xt->assign("CommonName_tabfieldblock",true);
	$xt->assign("CommonName_label",true);
	if(isEnableSection508())
		$xt->assign_section("CommonName_label","<label for=\"".GetInputElementId("CommonName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("TagName"))
		$xt->assign("TagName_fieldblock",true);
	else
		$xt->assign("TagName_tabfieldblock",true);
	$xt->assign("TagName_label",true);
	if(isEnableSection508())
		$xt->assign_section("TagName_label","<label for=\"".GetInputElementId("TagName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("ElementTypeID"))
		$xt->assign("ElementTypeID_fieldblock",true);
	else
		$xt->assign("ElementTypeID_tabfieldblock",true);
	$xt->assign("ElementTypeID_label",true);
	if(isEnableSection508())
		$xt->assign_section("ElementTypeID_label","<label for=\"".GetInputElementId("ElementTypeID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Description"))
		$xt->assign("Description_fieldblock",true);
	else
		$xt->assign("Description_tabfieldblock",true);
	$xt->assign("Description_label",true);
	if(isEnableSection508())
		$xt->assign_section("Description_label","<label for=\"".GetInputElementId("Description", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("UnitID"))
		$xt->assign("UnitID_fieldblock",true);
	else
		$xt->assign("UnitID_tabfieldblock",true);
	$xt->assign("UnitID_label",true);
	if(isEnableSection508())
		$xt->assign_section("UnitID_label","<label for=\"".GetInputElementId("UnitID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("UnitName"))
		$xt->assign("UnitName_fieldblock",true);
	else
		$xt->assign("UnitName_tabfieldblock",true);
	$xt->assign("UnitName_label",true);
	if(isEnableSection508())
		$xt->assign_section("UnitName_label","<label for=\"".GetInputElementId("UnitName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("UnitSymbol"))
		$xt->assign("UnitSymbol_fieldblock",true);
	else
		$xt->assign("UnitSymbol_tabfieldblock",true);
	$xt->assign("UnitSymbol_label",true);
	if(isEnableSection508())
		$xt->assign_section("UnitSymbol_label","<label for=\"".GetInputElementId("UnitSymbol", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("UnitDecimal"))
		$xt->assign("UnitDecimal_fieldblock",true);
	else
		$xt->assign("UnitDecimal_tabfieldblock",true);
	$xt->assign("UnitDecimal_label",true);
	if(isEnableSection508())
		$xt->assign_section("UnitDecimal_label","<label for=\"".GetInputElementId("UnitDecimal", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IValue"))
		$xt->assign("IValue_fieldblock",true);
	else
		$xt->assign("IValue_tabfieldblock",true);
	$xt->assign("IValue_label",true);
	if(isEnableSection508())
		$xt->assign_section("IValue_label","<label for=\"".GetInputElementId("IValue", $id)."\">","</label>");
	
	
	
	if($inlineadd!=ADD_ONTHEFLY && $inlineadd!=ADD_POPUP)
	{
		$pageObject->body["begin"] .= $includes;
		if($pageObject->isShowDetailTables)
			$pageObject->body["begin"].= "<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"> </div>";
		$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
		$xt->assign("back_button",true);
		//$xt->assign('addForm', true);
	}
	else
	{		
		$xt->assign("cancelbutton_attrs", "id=\"cancelButton".$id."\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
	}
	$xt->assign("save_button",true);
}
$xt->assign("savebutton_attrs","id=\"saveButton".$id."\"");
if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
/*
if($inlineadd == ADD_ONTHEFLY || $inlineadd == ADD_POPUP)
{
	$xt->assign("message_block",true);
}
*/

$readonlyfields=array();

//	show readonly fields
$linkdata="";

if(@$_POST["a"]=="added" && $inlineadd==ADD_ONTHEFLY)
{
	if( !$error_happened && $status!="DECLINED")
	{
		$LookupSQL = "";
		$linkfield = "";
		$dispfield = "";
		if($LookupSQL)
			$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);

		$data=0;
		if(count($keys) && $LookupSQL)
		{
			$where=KeyWhere($keys);
			$LookupSQL.=" where ".$where;
			$rs=db_query($LookupSQL,$conn);
			$data=db_fetch_numarray($rs);
		}
		if($data)
		{
			$respData = array($linkfield=>@$data[0], $dispfield=>@$data[1]);
		}
		else
		{
			$respData = array($linkfield=>@$avalues[$linkfield], $dispfield=>@$avalues[$dispfield]);
		}		
		$returnJSON['success'] = true;
		$returnJSON['keys'] = $keys;
		$returnJSON['vals'] = $respData;
		$returnJSON['fields'] = $showFields;
	}
	else
	{
		$returnJSON['success'] = false;
		$returnJSON['message'] = $message;
	}
	echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
	exit();
}

if(@$_POST["a"]=="added" && ($inlineadd == ADD_INLINE || $inlineadd == ADD_MASTER || $inlineadd==ADD_POPUP)) 
{
	//Preparation   view values
	//	get current values and show edit controls
	$dispFieldAlias = "";
	$data=0;
	if(count($keys))
	{
		$where=KeyWhere($keys);
			
		$sqlHead = $gQuery->HeadToSql();
		$sqlGroupBy = $gQuery->GroupByToSql();
		$oHaving = $gQuery->Having();
		$sqlHaving = $oHaving->toSql($gQuery);
		
		$dispFieldAlias = postvalue('dispFieldAlias');
		$dispField = postvalue('dispField');
		
		if ($dispFieldAlias)
		{
			$sqlHead.=", ".($dispField)." as ".AddFieldWrappers($dispFieldAlias)." ";
		}
		$strSQL = gSQLWhere_having($sqlHead, $gsqlFrom, $gsqlWhereExpr, $sqlGroupBy, $sqlHaving, $where, '');		
		
		LogInfo($strSQL);
		$rs=db_query($strSQL,$conn);
		$data=db_fetch_array($rs);
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}
	//check if correct values added

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["IngredientID"]));
	
////////////////////////////////////////////
//	IngredientID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IngredientID", ""),"field=IngredientID".$keylink,"",MODE_LIST);
	$showValues["IngredientID"] = $value;
	$showFields[] = "IngredientID";
		$showRawValues["IngredientID"] = substr($data["IngredientID"],0,100);
	}	
//	ElementID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"ElementID", ""),"field=ElementID".$keylink,"",MODE_LIST);
	$showValues["ElementID"] = $value;
	$showFields[] = "ElementID";
		$showRawValues["ElementID"] = substr($data["ElementID"],0,100);
	}	
//	EName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"EName", ""),"field=EName".$keylink,"",MODE_LIST);
	$showValues["EName"] = $value;
	$showFields[] = "EName";
		$showRawValues["EName"] = substr($data["EName"],0,100);
	}	
//	CommonName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"CommonName", ""),"field=CommonName".$keylink,"",MODE_LIST);
	$showValues["CommonName"] = $value;
	$showFields[] = "CommonName";
		$showRawValues["CommonName"] = substr($data["CommonName"],0,100);
	}	
//	TagName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"TagName", ""),"field=TagName".$keylink,"",MODE_LIST);
	$showValues["TagName"] = $value;
	$showFields[] = "TagName";
		$showRawValues["TagName"] = substr($data["TagName"],0,100);
	}	
//	ElementTypeID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"ElementTypeID", ""),"field=ElementTypeID".$keylink,"",MODE_LIST);
	$showValues["ElementTypeID"] = $value;
	$showFields[] = "ElementTypeID";
		$showRawValues["ElementTypeID"] = substr($data["ElementTypeID"],0,100);
	}	
//	Description - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Description", ""),"field=Description".$keylink,"",MODE_LIST);
	$showValues["Description"] = $value;
	$showFields[] = "Description";
		$showRawValues["Description"] = substr($data["Description"],0,100);
	}	
//	UnitID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"UnitID", ""),"field=UnitID".$keylink,"",MODE_LIST);
	$showValues["UnitID"] = $value;
	$showFields[] = "UnitID";
		$showRawValues["UnitID"] = substr($data["UnitID"],0,100);
	}	
//	UnitName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"UnitName", ""),"field=UnitName".$keylink,"",MODE_LIST);
	$showValues["UnitName"] = $value;
	$showFields[] = "UnitName";
		$showRawValues["UnitName"] = substr($data["UnitName"],0,100);
	}	
//	UnitSymbol - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"UnitSymbol", ""),"field=UnitSymbol".$keylink,"",MODE_LIST);
	$showValues["UnitSymbol"] = $value;
	$showFields[] = "UnitSymbol";
		$showRawValues["UnitSymbol"] = substr($data["UnitSymbol"],0,100);
	}	
//	UnitDecimal - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"UnitDecimal", ""),"field=UnitDecimal".$keylink,"",MODE_LIST);
	$showValues["UnitDecimal"] = $value;
	$showFields[] = "UnitDecimal";
		$showRawValues["UnitDecimal"] = substr($data["UnitDecimal"],0,100);
	}	
//	IValue - Number
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IValue", "Number"),"field=IValue".$keylink,"",MODE_LIST);
	$showValues["IValue"] = $value;
	$showFields[] = "IValue";
		$showRawValues["IValue"] = substr($data["IValue"],0,100);
	}	
	
	// for custom expression for display field
	if ($dispFieldAlias)
	{
		$showValues[] = $data[$dispFieldAlias];	
		$showFields[] = $dispFieldAlias;
		$showRawValues[] = substr($data[$dispFieldAlias],0,100);
	}		
	
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_POPUP)
	{	
		if($IsSaved && count($showValues))
		{		
			$returnJSON['success'] = true;	
			if($HaveData){
				$returnJSON['noKeys'] = false;
			}else{
				$returnJSON['noKeys'] = true;
			}
				
			$returnJSON['keys'] = $keys;
			$returnJSON['vals'] = $showValues;
			$returnJSON['fields'] = $showFields;
			$returnJSON['rawVals'] = $showRawValues;
			$returnJSON['detKeys'] = $showDetailKeys;
			$returnJSON['userMess'] = $usermessage;
		}
		else
		{
			$returnJSON['success'] = false;
			$returnJSON['message'] = $message;
		}
		echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
		exit();
	}	
} 

/////////////////////////////////////////////////////////////
if($inlineadd==ADD_MASTER)
{		
	$respJSON = array();
	if(($_POST["a"]=="added" && $IsSaved))
	{
		$respJSON['success'] = true;
		$respJSON['fields'] = $showFields;
		$respJSON['vals'] = $showValues;
		if($onFly){
			if($HaveData)
				$returnJSON['noKeys'] = false;
			else
				$returnJSON['noKeys'] = true;
			$respJSON['keys'] = $keys;
			$respJSON['rawVals'] = $showRawValues;
			$respJSON['detKeys'] = $showDetailKeys;
			$respJSON['userMess'] = $usermessage;
		}
		$respJSON['mKeys'] = array();	
		for($i=0;$i<count($dpParams['ids']);$i++)
		{
			$data=0;
			if(count($keys))
			{
				$where=KeyWhere($keys);
							$strSQL = gSQLWhere($where);
				LogInfo($strSQL);
				$rs=db_query($strSQL,$conn);
				$data=db_fetch_array($rs);
			}
			if(!$data)
				$data=$avalues;
			
			$mKeyId = 1;
			foreach($mKeys[$dpParams['strTableNames'][$i]] as $mk)	
			{
				if($data[$mk])
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = $data[$mk];
				else
					$respJSON['mKeys'][$dpParams['strTableNames'][$i]]['masterkey'.$mKeyId++] = '';
			}		
		}
		if((isset($_SESSION[$strTableName."_count_captcha"])) or ($_SESSION[$strTableName."_count_captcha"]>0) or ($_SESSION[$strTableName."_count_captcha"]<5))
			$respJSON['hideCaptha'] = true;
	}
	else{
			$respJSON['success'] = false;
			if(!$pageObject->isCaptchaOk)
				$respJSON['captha'] = false;
			else		
				$respJSON['error'] = $message;
			if($onFly)
				$respJSON['message'] = $message;				
		}
	echo "<textarea>".htmlspecialchars(my_json_encode($respJSON))."</textarea>";	
	exit();
}

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////

//	validation stuff
$regex='';
$regexmessage='';
$regextype = '';
$control = array();

foreach($addFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))
	{		
		$control[$gfName] = array();
		$control[$gfName]["func"]="xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"]= $id;
		$control[$gfName]["params"]["field"]=$fName;
		$control[$gfName]["params"]["value"]=@$defvalues[$fName];
		if(UseRTE($fName))
			$_SESSION[$strTableName."_".$fName."_rte"]=@$defvalues[$fName];
		
		//	Begin Add validation
		$arrValidate = getValidation($fName,$strTableName);	
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation	
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	
	if(UseRTEFCK($fName) || UseRTEInnova($fName) || UseRTEBasic($fName))
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))	
			$control[$gfName]["params"]["mode"]="add";
		$controls["controls"]['mode'] = "add";
	}
	else
	{
		if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="inline_add";
			$controls["controls"]['mode'] = "inline_add";
		}
		else
		{
			if(!$detailKeys || !in_array($fName, $detailKeys) || $fName == postvalue("category"))	
				$control[$gfName]["params"]["mode"]="add";
			$controls["controls"]['mode'] = "add";
		}
	}
			
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$defvalues[$fName];
		
	// category control field
	$strCategoryControl = $pageObject->hasDependField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $addFields))
		$vals = array($fName => @$defvalues[$fName],$strCategoryControl => @$defvalues[$strCategoryControl]);
	else
		$vals = array($fName => @$defvalues[$fName]);
	
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
		$controls["controls"]['preloadData'] = $preload;
	
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker 	
	if(GetEditFormat($fName) == 'Time')	
		$pageObject->fillTimePickSettings($fName, @$defvalues[$fName]);
	
	if((($detailKeys && in_array($fName, $detailKeys)) || $fName == postvalue("category")) && array_key_exists($fName, $defvalues))
	{
		if((GetEditFormat($fName)==EDIT_FORMAT_LOOKUP_WIZARD || GetEditFormat($fName)==EDIT_FORMAT_RADIO) && GetpLookupType($fName) == LT_LOOKUPTABLE)
			$value=DisplayLookupWizard($fName,$defvalues[$fName],$defvalues,"",MODE_VIEW);
		elseif(NeedEncode($fName))
			$value = ProcessLargeText(GetData($defvalues,$fName, ViewFormat($fName)),"field=".rawurlencode(htmlspecialchars($fName)),"",MODE_VIEW);
		else
			$value = GetData($defvalues,$fName, ViewFormat($fName));
		
		$xt->assign($gfName."_editcontrol", $value);
	}
}
//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && ($inlineadd==ADD_SIMPLE || $inlineadd==ADD_POPUP))
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_ADD;
	$options["mainMasterPageType"] = PAGE_ADD;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;

	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		include("classes/searchclause.php");
	}
	
	$dControlsMap = array();
		
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $flyId++;
		$mkr=1;
		
		foreach($mKeys[$strTableName] as $mk)
		{
			if($defvalues[$mk])
				$options['masterKeysReq'][$mkr++] = $defvalues[$mk];
			else
				$options['masterKeysReq'][$mkr++] = '';
		}
		
		$listPageObject = ListPage::createListPage($strTableName,$options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		
		if($listPageObject->isDispGrid())
		{
			//add detail settings to master settings
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];		
			$dControlsMap[$strTableName]['gridRows'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['gridRows'];
			$dControlsMap[$strTableName]['video'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['video'];
			$dControlsMap[$strTableName]['gMaps'] = $listPageObject->controlsHTMLMap[$strTableName][PAGE_LIST][$dpParams['ids'][$d]]['gMaps'];
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $key=>$val)
			{
				if(!array_key_exists($key,$pageObject->jsSettings['global']['shortTNames']))
					$pageObject->jsSettings['global']['shortTNames'][$key] = $val;
			}	
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files	
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		}
		$xt->assign("displayDetailTable_".GoodFieldName($strTableName), array("func" => "showDetailTable","params" => array("dpObject" => $listPageObject, "dpParams" => $strTableName)));
	}
	$strTableName = "vw_fullingredientelementanalysis";
	$pageObject->controlsHTMLMap[$strTableName][PAGE_ADD][$id]['dControlsMap'] = $dControlsMap;	
}
/////////////////////////////////////////////////////////////

if($inlineadd == ADD_SIMPLE)
{
	$pageObject->body['end'] .= '<script>';
	$pageObject->body['end'] .= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
	$pageObject->body['end'] .= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
	$pageObject->body['end'] .= '</script>';
}
else{
		$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
		//if($isNeedSettings)
		$returnJSON['settings'] = $pageObject->jsSettings;	
	}

$pageObject->addCommonJs();

$jscode = $pageObject->PrepareJS();
if($inlineadd==ADD_SIMPLE)
{
	$pageObject->body["end"] .= "<script>".$jscode."</script>";
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
elseif($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_MASTER || $inlineadd==ADD_POPUP)
{ 
	$xt->assign("footer","");
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
}	

$xt->assign("style_block",true);
$pageObject->xt->assign("legend", true);

if($eventObj->exists("BeforeShowAdd"))
	$eventObj->BeforeShowAdd($xt,$templatefile);

if($inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('flybody');
	if($inlineadd==ADD_POPUP && $pageObject->isShowDetailTables)
		$returnJSON['html'].= $xt->fetch_loaded('detail_tables');
	$returnJSON['idStartFrom'] = $id+1;	
	echo (my_json_encode($returnJSON)); 
}
elseif ($inlineadd == ADD_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($addFields as $fName)
	{
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");	
	}	
	echo (my_json_encode($returnJSON)); 
}
else
	$xt->display($templatefile);

?>
