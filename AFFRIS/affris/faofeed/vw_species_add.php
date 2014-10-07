<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_species_variables.php");


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
	$templatefile = "vw_species_inline_add.htm";
else
	$templatefile = "vw_species_add.htm";

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
//	processing SpeciesID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_SpeciesID");
	$type=postvalue("type_SpeciesID");
	if (FieldSubmitted("SpeciesID"))
	{
		$value=prepare_for_db("SpeciesID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="SpeciesID";
		$avalues["SpeciesID"]=$value;
	}
	}
//	processibng SpeciesID - end
//	processing SpecName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_SpecName");
	$type=postvalue("type_SpecName");
	if (FieldSubmitted("SpecName"))
	{
		$value=prepare_for_db("SpecName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="SpecName";
		$avalues["SpecName"]=$value;
	}
	}
//	processibng SpecName - end
//	processing CommonName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_CommonName");
	$type=postvalue("type_CommonName");
	if (FieldSubmitted("CommonName"))
	{
		$value=prepare_for_db("CommonName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="CommonName";
		$avalues["CommonName"]=$value;
	}
	}
//	processibng CommonName - end
//	processing Hybrid - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Hybrid");
	$type=postvalue("type_Hybrid");
	if (FieldSubmitted("Hybrid"))
	{
		$value=prepare_for_db("Hybrid",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Hybrid";
		$avalues["Hybrid"]=$value;
	}
	}
//	processibng Hybrid - end
//	processing Variety - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Variety");
	$type=postvalue("type_Variety");
	if (FieldSubmitted("Variety"))
	{
		$value=prepare_for_db("Variety",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Variety";
		$avalues["Variety"]=$value;
	}
	}
//	processibng Variety - end
//	processing Family - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Family");
	$type=postvalue("type_Family");
	if (FieldSubmitted("Family"))
	{
		$value=prepare_for_db("Family",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Family";
		$avalues["Family"]=$value;
	}
	}
//	processibng Family - end
//	processing Group - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Group");
	$type=postvalue("type_Group");
	if (FieldSubmitted("Group"))
	{
		$value=prepare_for_db("Group",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Group";
		$avalues["Group"]=$value;
	}
	}
//	processibng Group - end
//	processing Genus - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Genus");
	$type=postvalue("type_Genus");
	if (FieldSubmitted("Genus"))
	{
		$value=prepare_for_db("Genus",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Genus";
		$avalues["Genus"]=$value;
	}
	}
//	processibng Genus - end
//	processing Environment - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Environment");
	$type=postvalue("type_Environment");
	if (FieldSubmitted("Environment"))
	{
		$value=prepare_for_db("Environment",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Environment";
		$avalues["Environment"]=$value;
	}
	}
//	processibng Environment - end
//	processing FeedHabit - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FeedHabit");
	$type=postvalue("type_FeedHabit");
	if (FieldSubmitted("FeedHabit"))
	{
		$value=prepare_for_db("FeedHabit",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FeedHabit";
		$avalues["FeedHabit"]=$value;
	}
	}
//	processibng FeedHabit - end
//	processing Country - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Country");
	$type=postvalue("type_Country");
	if (FieldSubmitted("Country"))
	{
		$value=prepare_for_db("Country",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Country";
		$avalues["Country"]=$value;
	}
	}
//	processibng Country - end
//	processing SpecYear - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_SpecYear");
	$type=postvalue("type_SpecYear");
	if (FieldSubmitted("SpecYear"))
	{
		$value=prepare_for_db("SpecYear",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="SpecYear";
		$avalues["SpecYear"]=$value;
	}
	}
//	processibng SpecYear - end








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
	header("Location: vw_species_".$pageName);
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
		$copykeys["SpeciesID"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["SpeciesID"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
	if(!$defvalues)
		$defvalues=array();
//	clear key fields
	$defvalues["SpeciesID"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
}




if($readavalues)
{
	$defvalues["SpeciesID"]=@$avalues["SpeciesID"];
	$defvalues["SpecName"]=@$avalues["SpecName"];
	$defvalues["CommonName"]=@$avalues["CommonName"];
	$defvalues["Hybrid"]=@$avalues["Hybrid"];
	$defvalues["Variety"]=@$avalues["Variety"];
	$defvalues["Family"]=@$avalues["Family"];
	$defvalues["Group"]=@$avalues["Group"];
	$defvalues["Genus"]=@$avalues["Genus"];
	$defvalues["Environment"]=@$avalues["Environment"];
	$defvalues["FeedHabit"]=@$avalues["FeedHabit"];
	$defvalues["Country"]=@$avalues["Country"];
	$defvalues["SpecYear"]=@$avalues["SpecYear"];
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
//	validate field - SpeciesID
	$validatetype="IsNumeric";
	$second_validatetype="IsRequired";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "SpeciesID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - SpecYear
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "SpecYear", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
	
	$jscode.="SUGGEST_TABLE='vw_species_searchsuggest.php';\r\n";
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	

	$xt->assign("SpeciesID_fieldblock",true);
	$xt->assign("SpecName_fieldblock",true);
	$xt->assign("CommonName_fieldblock",true);
	$xt->assign("Hybrid_fieldblock",true);
	$xt->assign("Variety_fieldblock",true);
	$xt->assign("Family_fieldblock",true);
	$xt->assign("Group_fieldblock",true);
	$xt->assign("Genus_fieldblock",true);
	$xt->assign("Environment_fieldblock",true);
	$xt->assign("FeedHabit_fieldblock",true);
	$xt->assign("Country_fieldblock",true);
	$xt->assign("SpecYear_fieldblock",true);
	
	$formname="editform";
	if($onsubmit)
		$onsubmit="onsubmit=\"".$onsubmit."\"";
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$body["begin"]=$includes.
		"<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_species_add.php\" ".$onsubmit.">".
		"<input type=hidden name=\"a\" value=\"added\">";
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_species_list.php?a=return'\"");
		$xt->assign("back_button",true);
	}
	else
	{
		$formname="editform".$id;
		$body["begin"]="<form name=\"editform".$id."\" id=\"editform".$id."\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_species_add.php\" ".$onsubmit." target=\"flyframe".$id."\">".
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



$control_SpeciesID=array();
$control_SpeciesID["func"]="xt_buildeditcontrol";
$control_SpeciesID["params"] = array();
$control_SpeciesID["params"]["field"]="SpeciesID";
$control_SpeciesID["params"]["value"]=@$defvalues["SpeciesID"];
$control_SpeciesID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_SpeciesID["params"]["mode"]="inline_add";
else
	$control_SpeciesID["params"]["mode"]="add";
	
$xt->assignbyref("SpeciesID_editcontrol",$control_SpeciesID);


$control_SpecName=array();
$control_SpecName["func"]="xt_buildeditcontrol";
$control_SpecName["params"] = array();
$control_SpecName["params"]["field"]="SpecName";
$control_SpecName["params"]["value"]=@$defvalues["SpecName"];
$control_SpecName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_SpecName["params"]["mode"]="inline_add";
else
	$control_SpecName["params"]["mode"]="add";
	
$xt->assignbyref("SpecName_editcontrol",$control_SpecName);


$control_CommonName=array();
$control_CommonName["func"]="xt_buildeditcontrol";
$control_CommonName["params"] = array();
$control_CommonName["params"]["field"]="CommonName";
$control_CommonName["params"]["value"]=@$defvalues["CommonName"];
$control_CommonName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_CommonName["params"]["mode"]="inline_add";
else
	$control_CommonName["params"]["mode"]="add";
	
$xt->assignbyref("CommonName_editcontrol",$control_CommonName);


$control_Hybrid=array();
$control_Hybrid["func"]="xt_buildeditcontrol";
$control_Hybrid["params"] = array();
$control_Hybrid["params"]["field"]="Hybrid";
$control_Hybrid["params"]["value"]=@$defvalues["Hybrid"];
$control_Hybrid["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Hybrid["params"]["mode"]="inline_add";
else
	$control_Hybrid["params"]["mode"]="add";
	
$xt->assignbyref("Hybrid_editcontrol",$control_Hybrid);


$control_Variety=array();
$control_Variety["func"]="xt_buildeditcontrol";
$control_Variety["params"] = array();
$control_Variety["params"]["field"]="Variety";
$control_Variety["params"]["value"]=@$defvalues["Variety"];
$control_Variety["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Variety["params"]["mode"]="inline_add";
else
	$control_Variety["params"]["mode"]="add";
	
$xt->assignbyref("Variety_editcontrol",$control_Variety);


$control_Family=array();
$control_Family["func"]="xt_buildeditcontrol";
$control_Family["params"] = array();
$control_Family["params"]["field"]="Family";
$control_Family["params"]["value"]=@$defvalues["Family"];
$control_Family["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Family["params"]["mode"]="inline_add";
else
	$control_Family["params"]["mode"]="add";
	
$xt->assignbyref("Family_editcontrol",$control_Family);


$control_Group=array();
$control_Group["func"]="xt_buildeditcontrol";
$control_Group["params"] = array();
$control_Group["params"]["field"]="Group";
$control_Group["params"]["value"]=@$defvalues["Group"];
$control_Group["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Group["params"]["mode"]="inline_add";
else
	$control_Group["params"]["mode"]="add";
	
$xt->assignbyref("Group_editcontrol",$control_Group);


$control_Genus=array();
$control_Genus["func"]="xt_buildeditcontrol";
$control_Genus["params"] = array();
$control_Genus["params"]["field"]="Genus";
$control_Genus["params"]["value"]=@$defvalues["Genus"];
$control_Genus["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Genus["params"]["mode"]="inline_add";
else
	$control_Genus["params"]["mode"]="add";
	
$xt->assignbyref("Genus_editcontrol",$control_Genus);


$control_Environment=array();
$control_Environment["func"]="xt_buildeditcontrol";
$control_Environment["params"] = array();
$control_Environment["params"]["field"]="Environment";
$control_Environment["params"]["value"]=@$defvalues["Environment"];
$control_Environment["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Environment["params"]["mode"]="inline_add";
else
	$control_Environment["params"]["mode"]="add";
	
$xt->assignbyref("Environment_editcontrol",$control_Environment);


$control_FeedHabit=array();
$control_FeedHabit["func"]="xt_buildeditcontrol";
$control_FeedHabit["params"] = array();
$control_FeedHabit["params"]["field"]="FeedHabit";
$control_FeedHabit["params"]["value"]=@$defvalues["FeedHabit"];
$control_FeedHabit["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FeedHabit["params"]["mode"]="inline_add";
else
	$control_FeedHabit["params"]["mode"]="add";
	
$xt->assignbyref("FeedHabit_editcontrol",$control_FeedHabit);


$control_Country=array();
$control_Country["func"]="xt_buildeditcontrol";
$control_Country["params"] = array();
$control_Country["params"]["field"]="Country";
$control_Country["params"]["value"]=@$defvalues["Country"];
$control_Country["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Country["params"]["mode"]="inline_add";
else
	$control_Country["params"]["mode"]="add";
	
$xt->assignbyref("Country_editcontrol",$control_Country);


$control_SpecYear=array();
$control_SpecYear["func"]="xt_buildeditcontrol";
$control_SpecYear["params"] = array();
$control_SpecYear["params"]["field"]="SpecYear";
$control_SpecYear["params"]["value"]=@$defvalues["SpecYear"];
$control_SpecYear["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_SpecYear["params"]["mode"]="inline_add";
else
	$control_SpecYear["params"]["mode"]="add";
	
$xt->assignbyref("SpecYear_editcontrol",$control_SpecYear);

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