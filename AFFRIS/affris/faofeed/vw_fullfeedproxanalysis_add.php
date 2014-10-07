<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_fullfeedproxanalysis_variables.php");


//	check if logged in

if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$pageName = "add.php";
$filename="";
$status="";
$message="";
$usermessage="";
$error_happened=false;
$readavalues=false;


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;

if(@$_REQUEST["editType"]=="inline")
	$inlineedit=ADD_INLINE;
elseif(@$_REQUEST["editType"]=="onthefly")
	$inlineedit=ADD_ONTHEFLY;
else
	$inlineedit=ADD_SIMPLE;
$keys=array();
if($inlineedit==ADD_INLINE)
	$templatefile = "vw_fullfeedproxanalysis_inline_add.htm";
else
	$templatefile = "vw_fullfeedproxanalysis_add.htm";

$id=postvalue("id");


include('include/xtempl.php');
$xt = new Xtempl();


//	Before Process event
if(function_exists("BeforeProcessAdd"))
	BeforeProcessAdd($conn);


// insert new record if we have to

if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$blobfields=array();
	$files_move=array();
	$files_save=array();
//	processing FeedID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FeedID");
	$type=postvalue("type_FeedID");
	if (FieldSubmitted("FeedID"))
	{
		$value=prepare_for_db("FeedID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FeedID";
		$avalues["FeedID"]=$value;
	}
	}
//	processibng FeedID - end
//	processing ElementTypeID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_ElementTypeID");
	$type=postvalue("type_ElementTypeID");
	if (FieldSubmitted("ElementTypeID"))
	{
		$value=prepare_for_db("ElementTypeID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="ElementTypeID";
		$avalues["ElementTypeID"]=$value;
	}
	}
//	processibng ElementTypeID - end
//	processing Description - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Description");
	$type=postvalue("type_Description");
	if (FieldSubmitted("Description"))
	{
		$value=prepare_for_db("Description",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Description";
		$avalues["Description"]=$value;
	}
	}
//	processibng Description - end
//	processing isShownDetail - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_isShownDetail");
	$type=postvalue("type_isShownDetail");
	if (FieldSubmitted("isShownDetail"))
	{
		$value=prepare_for_db("isShownDetail",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="isShownDetail";
		$avalues["isShownDetail"]=$value;
	}
	}
//	processibng isShownDetail - end
//	processing ETTagName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_ETTagName");
	$type=postvalue("type_ETTagName");
	if (FieldSubmitted("ETTagName"))
	{
		$value=prepare_for_db("ETTagName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="ETTagName";
		$avalues["ETTagName"]=$value;
	}
	}
//	processibng ETTagName - end
//	processing UnitID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_UnitID");
	$type=postvalue("type_UnitID");
	if (FieldSubmitted("UnitID"))
	{
		$value=prepare_for_db("UnitID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="UnitID";
		$avalues["UnitID"]=$value;
	}
	}
//	processibng UnitID - end
//	processing UnitName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_UnitName");
	$type=postvalue("type_UnitName");
	if (FieldSubmitted("UnitName"))
	{
		$value=prepare_for_db("UnitName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="UnitName";
		$avalues["UnitName"]=$value;
	}
	}
//	processibng UnitName - end
//	processing UnitSymbol - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_UnitSymbol");
	$type=postvalue("type_UnitSymbol");
	if (FieldSubmitted("UnitSymbol"))
	{
		$value=prepare_for_db("UnitSymbol",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="UnitSymbol";
		$avalues["UnitSymbol"]=$value;
	}
	}
//	processibng UnitSymbol - end
//	processing UnitDecimal - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_UnitDecimal");
	$type=postvalue("type_UnitDecimal");
	if (FieldSubmitted("UnitDecimal"))
	{
		$value=prepare_for_db("UnitDecimal",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="UnitDecimal";
		$avalues["UnitDecimal"]=$value;
	}
	}
//	processibng UnitDecimal - end
//	processing ETValue - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_ETValue");
	$type=postvalue("type_ETValue");
	if (FieldSubmitted("ETValue"))
	{
		$value=prepare_for_db("ETValue",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="ETValue";
		$avalues["ETValue"]=$value;
	}
	}
//	processibng ETValue - end




//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedingredient")
	{
		$avalues["FeedID"]=prepare_for_db("FeedID",$_SESSION[$strTableName."_masterkey1"]);
	}
	if(@$_SESSION[$strTableName."_mastertable"]=="vw_feed")
	{
		$avalues["FeedID"]=prepare_for_db("FeedID",$_SESSION[$strTableName."_masterkey1"]);
	}
	if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedspec")
	{
		$avalues["FeedID"]=prepare_for_db("FeedID",$_SESSION[$strTableName."_masterkey1"]);
	}




	$failed_inline_add=false;
//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
	
//	before Add event
	$retval = true;
	if(function_exists("BeforeAdd"))
		$retval=BeforeAdd($avalues,$usermessage,$inlineedit);
	if($retval)
	{
		if(DoInsertRecord($strOriginalTableName,$avalues,$blobfields))
		{
			$IsSaved=true;
//	after edit event
			if(function_exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
				AfterAdd($avalues,$keys,$inlineedit);
			}
		}
	}
	else
	{
		$message = $usermessage;
		$status="DECLINED";
		$readavalues=true;
	}
}

// PRG rule, to avoid POSTDATA resend
//if ($inlineedit==ADD_SIMPLE && @$_POST["a"]=="added"){
if (no_output_done() && $inlineedit==ADD_SIMPLE && $IsSaved){
 
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// redirect
	header("Location: vw_fullfeedproxanalysis_".$pageName);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if ($inlineedit==ADD_SIMPLE  && isset($_SESSION["message"])){
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
		$copykeys["FeedID"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["FeedID"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["FeedID"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
}

//	set default values for the foreign keys
if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedingredient")
{
	$defvalues["FeedID"]=@$_SESSION[$strTableName."_masterkey1"];
}
if(@$_SESSION[$strTableName."_mastertable"]=="vw_feed")
{
	$defvalues["FeedID"]=@$_SESSION[$strTableName."_masterkey1"];
}
if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedspec")
{
	$defvalues["FeedID"]=@$_SESSION[$strTableName."_masterkey1"];
}



if($readavalues)
{
	$defvalues["FeedID"]=@$avalues["FeedID"];
	$defvalues["ElementTypeID"]=@$avalues["ElementTypeID"];
	$defvalues["Description"]=@$avalues["Description"];
	$defvalues["isShownDetail"]=@$avalues["isShownDetail"];
	$defvalues["ETTagName"]=@$avalues["ETTagName"];
	$defvalues["UnitID"]=@$avalues["UnitID"];
	$defvalues["UnitName"]=@$avalues["UnitName"];
	$defvalues["UnitSymbol"]=@$avalues["UnitSymbol"];
	$defvalues["UnitDecimal"]=@$avalues["UnitDecimal"];
	$defvalues["ETValue"]=@$avalues["ETValue"];
}
//for basic files
$includes="";
//for javascript code
$jscode="";
$bodyonload="";
$onsubmit="";
//////////////////////////////////////////////////////////////////	
//	Begin Add validation params for InlineAdd or Add or AddOnTheFly	
//	validation stuff
	$onsubmit="$('#message_block').html('');";
	$regex='';
	$regexmessage='';
	$regextype = '';
	$RTEfunc="";
	$needvalidate=false;
	$arrValidate = array();
//	for inlineAdd
	$addValidateTypes = array();
	$addValidateFields = array();
	$addValidateUseRTE = array();
	$addValidateCBList = array();	
	$addValidateRegex = array();
	$addValidateRegexmes = array();
	$addValidateRegexmestype = array();
//	Begin Add validation	
//if use InnovaEditor or RTE on pages add or addonthefly when useRTE will be with  -  "_FLY"
//if use InnovaEditor or RTE on page InineAdd when useRTE will be with out  -  "_FLY"		
if($inlineedit!=ADD_INLINE) 
{
	if($inlineedit!=ADD_ONTHEFLY)
	{
		AddJSFile("validate");
		if(@$_REQUEST["language"])
			$language = $_REQUEST["language"];
		// may be elseif ?
		if(@$_SESSION["language"])
			$language = $_SESSION["language"];
		else
			$language = 'English';
		
		$jscode.="window.current_language='".jsreplace($language)."';\r\n";
		
		$jscode.="addValid = new validation();\r\n";	
	}
	else	
		$jscode.="window.addFlyValid".$id." = new validation();\r\n";
				
	$jscode.="window.TEXT_INLINE_FIELD_REQUIRED='".jsreplace("Required field")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_ZIPCODE='".jsreplace("Field should be a valid zipcode")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_EMAIL='".jsreplace("Field should be a valid email address")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_NUMBER='".jsreplace("Field should be a valid number")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_CURRENCY='".jsreplace("Field should be a valid currency")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_PHONE='".jsreplace("Field should be a valid phone number")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_PASSWORD1='".jsreplace("Field can not be 'password'")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_PASSWORD2='".jsreplace("Field should be at least 4 characters long")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_STATE='".jsreplace("Field should be a valid US state name")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_SSN='".jsreplace("Field should be a valid Social Security Number")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_DATE='".jsreplace("Field should be a valid date")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_TIME='".jsreplace("Field should be a valid time in 24-hour format")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_CC='".jsreplace("Field should be a valid credit card number")."';\r\n";
	$jscode.="window.TEXT_INLINE_FIELD_SSN='".jsreplace("Field should be a valid Social Security Number")."';\r\n";
}
//	validate field - FeedID
	$validatetype="IsNumeric";
	$second_validatetype="IsRequired";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FeedID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - ElementTypeID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "ElementTypeID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - UnitID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "UnitID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - UnitDecimal
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "UnitDecimal", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - ETValue
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "ETValue", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
for($i=0;$i<count($arrValidate);$i++)
{
	if($arrValidate[$i][1])
	{
		if($inlineedit!=ADD_INLINE)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
			{
				if ($arrValidate[$i][1]=="Regular expression")
					$jscode.="addFlyValid".$id.".addRegex($('#value_".$arrValidate[$i][0]."_".$id."'),'".$arrValidate[$i][1]."','".
						jsreplace($arrValidate[$i][5])."','".jsreplace($arrValidate[$i][6])."','".jsreplace($arrValidate[$i][7])."');\r\n";
				else		
					$jscode.="addFlyValid".$id.".add($('#value_".$arrValidate[$i][0]."_".$id."'),'".$arrValidate[$i][1]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";	
			}
			else
			{
				if ($arrValidate[$i][1]=="Regular expression")
					$bodyonload.="addValid.addRegex(document.editform['value_".$arrValidate[$i][0]."'],'".$arrValidate[$i][1]."','".
						jsreplace($arrValidate[$i][5])."','".jsreplace($arrValidate[$i][6])."','".jsreplace($arrValidate[$i][7])."');\r\n";
				else		
					$bodyonload.="addValid.add(document.editform['value_".$arrValidate[$i][0]."'],'".$arrValidate[$i][1]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";
			}
		}
		else{
				//	Add Inline validation params
				$addValidateTypes[] = $arrValidate[$i][1];
				$addValidateFields[] = $arrValidate[$i][0];
				$addValidateUseRTE[] = $arrValidate[$i][3];
				$addValidateCBList[] = $arrValidate[$i][4];
				$addValidateRegex[] = jsreplace($arrValidate[$i][5]);
				$addValidateRegexmes[] = jsreplace($arrValidate[$i][6]);
				$addValidateRegexmestype[] = jsreplace($arrValidate[$i][7]);
			}	
	}
	if($arrValidate[$i][2])
	{	
		if($inlineedit!=ADD_INLINE)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
			{	
				if($arrValidate[$i][3]=='INNOVA_FLY' || $arrValidate[$i][3]=='RTE_FLY')
				{
					$jscode.='$("td[@class^=\'editshade_lb\']").each(function(i){';
					$jscode.='if($("iframe[@name=\'value_'.$arrValidate[$i][0].'_'.$id.'\']",this).length)';
					$jscode.='addFlyValid'.$id.'.add($("iframe[@name=\'value_'.$arrValidate[$i][0].'_'.$id.'\']",this),"'.$arrValidate[$i][2].'","'.$arrValidate[$i][3].'","'.$arrValidate[$i][4].'");});';
				//	$func.='getDataFromRTEInnova($(\'#value_'.$arrValidate[$i][0].'_'.$id.'\'),\''.$arrValidate[$i][3].'\',$(\'#editform'.$id.'\'),\'value_'.$arrValidate[$i][0].'\');'; 
				}
				else
					$jscode.="addFlyValid".$id.".add($('".($arrValidate[$i][4]=='CBList' ? "input[@name=\"value_".$arrValidate[$i][0]."[]\"]" : "#value_".$arrValidate[$i][0]."_".$id)."'),'".$arrValidate[$i][2]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";
			}
			elseif($arrValidate[$i][3]=='INNOVA_FLY' || $arrValidate[$i][3]=='RTE_FLY')
			{
				$bodyonload.='$("td[@class^=\'editshade_lb\']").each(function(i){';
				$bodyonload.='if($("iframe[@name=\'value_'.$arrValidate[$i][0].'\']",this).length)';
				$bodyonload.='addValid.add($("iframe[@name=\'value_'.$arrValidate[$i][0].'\']",this),"'.$arrValidate[$i][2].'","'.$arrValidate[$i][3].'","'.$arrValidate[$i][4].'");});';
				//$func.='getDataFromRTEInnova($(\'#value_'.$arrValidate[$i][0].'\'),\''.$arrValidate[$i][3].'\',$(\'#editform\'),\'value_'.$arrValidate[$i][0].'\');'; 
			}
			else
				$bodyonload.="addValid.add(document.editform['".($arrValidate[$i][4]=='disp' ? "display_" : "")."value_".$arrValidate[$i][0].($arrValidate[$i][4]=='CBList' || $arrValidate[$i][4]=='list' ? "[]" : "")."'],'".$arrValidate[$i][2]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";
		}
		else{
				//	Add Inline validation params
				$addValidateTypes[] = $arrValidate[$i][2];
				$addValidateFields[] = $arrValidate[$i][0];
				$addValidateUseRTE[] = $arrValidate[$i][3];
				$addValidateCBList[] = $arrValidate[$i][4];
				$addValidateRegex[] = jsreplace($arrValidate[$i][5]);
				$addValidateRegexmes[] = jsreplace($arrValidate[$i][6]);
				$addValidateRegexmestype[] = jsreplace($arrValidate[$i][7]);
			}	
	}
}	
//	End Add validation params for InlineAdd or Add or AddOnTheFly
//////////////////////////////////////////////////////////////


////////////////////// time picker
//////////////////////
$body=array();


AddJSFile('customlabels');

$jscode.="window.locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
	"window.locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
	"window.bLoading=false;\r\n".
	"window.TEXT_PLEASE_SELECT='".jsreplace("Please select")."';\r\n";







if($inlineedit!=ADD_INLINE)
{
	if($needvalidate)
	{
		if($RTEfunc)
		{
			if($inlineedit==ADD_ONTHEFLY)
				$onsubmit="if(addFlyValid".$id.".validate()){".$RTEfunc."return true;}else return false;";
			else
				$onsubmit="if(addValid.validate()){".$RTEfunc."return true;}else return false;";	
		}
		else{	
				if($inlineedit==ADD_ONTHEFLY)
					$onsubmit="return addFlyValid".$id.".validate();";
				else
					$onsubmit.="return addValid.validate();";
			}
	}
	elseif($RTEfunc)
		$onsubmit=$RTEfunc."return true;";

	if($inlineedit!=ADD_ONTHEFLY)
	{
		$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
		AddJSFile("ajaxsuggest");		
		$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	}
	
	$jscode.="SUGGEST_TABLE='vw_fullfeedproxanalysis_searchsuggest.php';\r\n";
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	

	$xt->assign("FeedID_fieldblock",true);
	$xt->assign("ElementTypeID_fieldblock",true);
	$xt->assign("Description_fieldblock",true);
	$xt->assign("isShownDetail_fieldblock",true);
	$xt->assign("ETTagName_fieldblock",true);
	$xt->assign("UnitID_fieldblock",true);
	$xt->assign("UnitName_fieldblock",true);
	$xt->assign("UnitSymbol_fieldblock",true);
	$xt->assign("UnitDecimal_fieldblock",true);
	$xt->assign("ETValue_fieldblock",true);
	
	$formname="editform";
	if($onsubmit)
		$onsubmit="onsubmit=\"".$onsubmit."\"";
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$body["begin"]=$includes.
		"<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_fullfeedproxanalysis_add.php\" ".$onsubmit.">".
		"<input type=hidden name=\"a\" value=\"added\">";
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_fullfeedproxanalysis_list.php?a=return'\"");
		$xt->assign("back_button",true);
	}
	else
	{
		$formname="editform".$id;
		$body["begin"]="<form name=\"editform".$id."\" id=\"editform".$id."\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_fullfeedproxanalysis_add.php\" ".$onsubmit." target=\"flyframe".$id."\">".
		"<input type=hidden name=\"a\" value=\"added\">".
		"<input type=hidden name=\"editType\" value=\"onthefly\">".
		"<input type=hidden name=\"table\" value=\"".postvalue("table")."\">".
		"<input type=hidden name=\"field\" value=\"".postvalue("field")."\">".
		"<input type=hidden name=\"category\" value=\"".postvalue("category")."\">".
		"<input type=hidden name=\"id\" value=\"".$id."\">";
		$xt->assign("cancelbutton_attrs","onclick=\"RemoveFlyDiv('".$id."');\"");
		$xt->assign("cancel_button",true);
		$xt->assign("header","");
	}
	$xt->assign("save_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("resetbutton_attrs",'onclick="resetEditors();"');
}

if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
//$xt->assign("status",$status);

$readonlyfields=array();

//	show readonly fields

$linkdata="";
$record_id= postvalue("recordID");

if($inlineedit==ADD_ONTHEFLY)
	$record_id=$id;

	if($inlineedit==ADD_INLINE) 
	{
		$jscode.= "inlineAddValid".$record_id." = new validation();\r\n";
	} 
	else 
	{
		$jscode.="SetToFirstControl('".$formname."');";
		if($inlineedit==ADD_SIMPLE)
			$jscode.= $bodyonload;
	}
		

if(@$_POST["a"]=="added" && $inlineedit==ADD_ONTHEFLY && !$error_happened && $status!="DECLINED")
{
	$LookupSQL="";
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
	if(!$data)
	{
		$data=array(@$avalues[$linkfield],@$avalues[$dispfield]);
	}
	echo "<textarea id=\"data\">";
	echo "added";
	print_inline_array($data);
	echo "</textarea>";
	exit();
}


/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
$jscode.="\r\n window.rteIdArr=".jsreplace("new Object").";\r\n";



$control_FeedID=array();
$control_FeedID["func"]="xt_buildeditcontrol";
$control_FeedID["params"] = array();
$control_FeedID["params"]["field"]="FeedID";
$control_FeedID["params"]["value"]=@$defvalues["FeedID"];
$control_FeedID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FeedID["params"]["mode"]="inline_add";
else
	$control_FeedID["params"]["mode"]="add";
	
$xt->assignbyref("FeedID_editcontrol",$control_FeedID);


$control_ElementTypeID=array();
$control_ElementTypeID["func"]="xt_buildeditcontrol";
$control_ElementTypeID["params"] = array();
$control_ElementTypeID["params"]["field"]="ElementTypeID";
$control_ElementTypeID["params"]["value"]=@$defvalues["ElementTypeID"];
$control_ElementTypeID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_ElementTypeID["params"]["mode"]="inline_add";
else
	$control_ElementTypeID["params"]["mode"]="add";
	
$xt->assignbyref("ElementTypeID_editcontrol",$control_ElementTypeID);


$control_Description=array();
$control_Description["func"]="xt_buildeditcontrol";
$control_Description["params"] = array();
$control_Description["params"]["field"]="Description";
$control_Description["params"]["value"]=@$defvalues["Description"];
$control_Description["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Description["params"]["mode"]="inline_add";
else
	$control_Description["params"]["mode"]="add";
	
$xt->assignbyref("Description_editcontrol",$control_Description);


$control_isShownDetail=array();
$control_isShownDetail["func"]="xt_buildeditcontrol";
$control_isShownDetail["params"] = array();
$control_isShownDetail["params"]["field"]="isShownDetail";
$control_isShownDetail["params"]["value"]=@$defvalues["isShownDetail"];
$control_isShownDetail["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_isShownDetail["params"]["mode"]="inline_add";
else
	$control_isShownDetail["params"]["mode"]="add";
	
$xt->assignbyref("isShownDetail_editcontrol",$control_isShownDetail);


$control_ETTagName=array();
$control_ETTagName["func"]="xt_buildeditcontrol";
$control_ETTagName["params"] = array();
$control_ETTagName["params"]["field"]="ETTagName";
$control_ETTagName["params"]["value"]=@$defvalues["ETTagName"];
$control_ETTagName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_ETTagName["params"]["mode"]="inline_add";
else
	$control_ETTagName["params"]["mode"]="add";
	
$xt->assignbyref("ETTagName_editcontrol",$control_ETTagName);


$control_UnitID=array();
$control_UnitID["func"]="xt_buildeditcontrol";
$control_UnitID["params"] = array();
$control_UnitID["params"]["field"]="UnitID";
$control_UnitID["params"]["value"]=@$defvalues["UnitID"];
$control_UnitID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_UnitID["params"]["mode"]="inline_add";
else
	$control_UnitID["params"]["mode"]="add";
	
$xt->assignbyref("UnitID_editcontrol",$control_UnitID);


$control_UnitName=array();
$control_UnitName["func"]="xt_buildeditcontrol";
$control_UnitName["params"] = array();
$control_UnitName["params"]["field"]="UnitName";
$control_UnitName["params"]["value"]=@$defvalues["UnitName"];
$control_UnitName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_UnitName["params"]["mode"]="inline_add";
else
	$control_UnitName["params"]["mode"]="add";
	
$xt->assignbyref("UnitName_editcontrol",$control_UnitName);


$control_UnitSymbol=array();
$control_UnitSymbol["func"]="xt_buildeditcontrol";
$control_UnitSymbol["params"] = array();
$control_UnitSymbol["params"]["field"]="UnitSymbol";
$control_UnitSymbol["params"]["value"]=@$defvalues["UnitSymbol"];
$control_UnitSymbol["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_UnitSymbol["params"]["mode"]="inline_add";
else
	$control_UnitSymbol["params"]["mode"]="add";
	
$xt->assignbyref("UnitSymbol_editcontrol",$control_UnitSymbol);


$control_UnitDecimal=array();
$control_UnitDecimal["func"]="xt_buildeditcontrol";
$control_UnitDecimal["params"] = array();
$control_UnitDecimal["params"]["field"]="UnitDecimal";
$control_UnitDecimal["params"]["value"]=@$defvalues["UnitDecimal"];
$control_UnitDecimal["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_UnitDecimal["params"]["mode"]="inline_add";
else
	$control_UnitDecimal["params"]["mode"]="add";
	
$xt->assignbyref("UnitDecimal_editcontrol",$control_UnitDecimal);


$control_ETValue=array();
$control_ETValue["func"]="xt_buildeditcontrol";
$control_ETValue["params"] = array();
$control_ETValue["params"]["field"]="ETValue";
$control_ETValue["params"]["value"]=@$defvalues["ETValue"];
$control_ETValue["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_ETValue["params"]["mode"]="inline_add";
else
	$control_ETValue["params"]["mode"]="add";
	
$xt->assignbyref("ETValue_editcontrol",$control_ETValue);

PrepareJSCode($jscode,$record_id);

	if($inlineedit!=ADD_ONTHEFLY)
	{
		if($inlineedit==ADD_INLINE)
		{
			$jscode=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
			$xt->assignbyref("linkdata",$jscode);
		}
		$body["end"]="</form><script>".$jscode."</script>";
		$xt->assign("body",$body);
		$xt->assign("flybody",true);
	}
	else
	{
		if(!@$_POST["a"]=="added")
		{
			$jscode = str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$jscode);
			echo $jscode;
			echo "\n";
		}
		else if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
		{
			echo "<textarea id=\"data\">decli";
			echo htmlspecialchars($jscode);
			echo "</textarea>";
		}
		$body["end"]="</form>";
		$xt->assign("footer","");
		$xt->assign("flybody",$body);
		$xt->assign("body",true);
	}	

$xt->assign("style_block",true);


if(function_exists("BeforeShowAdd"))
	BeforeShowAdd($xt,$templatefile);

if($inlineedit==ADD_ONTHEFLY)
{
	$xt->load_template($templatefile);
	$xt->display_loaded("style_block");
	$xt->display_loaded("flybody");
}
else
	$xt->display($templatefile);


?>