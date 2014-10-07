<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_feed_variables.php");


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
	$templatefile = "vw_feed_inline_add.htm";
else
	$templatefile = "vw_feed_add.htm";

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
//	processing FName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FName");
	$type=postvalue("type_FName");
	if (FieldSubmitted("FName"))
	{
		$value=prepare_for_db("FName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FName";
		$avalues["FName"]=$value;
	}
	}
//	processibng FName - end
//	processing BrandName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_BrandName");
	$type=postvalue("type_BrandName");
	if (FieldSubmitted("BrandName"))
	{
		$value=prepare_for_db("BrandName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="BrandName";
		$avalues["BrandName"]=$value;
	}
	}
//	processibng BrandName - end
//	processing Technology - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Technology");
	$type=postvalue("type_Technology");
	if (FieldSubmitted("Technology"))
	{
		$value=prepare_for_db("Technology",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Technology";
		$avalues["Technology"]=$value;
	}
	}
//	processibng Technology - end
//	processing FeedYear - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FeedYear");
	$type=postvalue("type_FeedYear");
	if (FieldSubmitted("FeedYear"))
	{
		$value=prepare_for_db("FeedYear",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FeedYear";
		$avalues["FeedYear"]=$value;
	}
	}
//	processibng FeedYear - end
//	processing Stage - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Stage");
	$type=postvalue("type_Stage");
	if (FieldSubmitted("Stage"))
	{
		$value=prepare_for_db("Stage",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Stage";
		$avalues["Stage"]=$value;
	}
	}
//	processibng Stage - end
//	processing FCountryID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FCountryID");
	$type=postvalue("type_FCountryID");
	if (FieldSubmitted("FCountryID"))
	{
		$value=prepare_for_db("FCountryID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FCountryID";
		$avalues["FCountryID"]=$value;
	}
	}
//	processibng FCountryID - end
//	processing CountryOrigin - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_CountryOrigin");
	$type=postvalue("type_CountryOrigin");
	if (FieldSubmitted("CountryOrigin"))
	{
		$value=prepare_for_db("CountryOrigin",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="CountryOrigin";
		$avalues["CountryOrigin"]=$value;
	}
	}
//	processibng CountryOrigin - end
//	processing FIDSourceID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FIDSourceID");
	$type=postvalue("type_FIDSourceID");
	if (FieldSubmitted("FIDSourceID"))
	{
		$value=prepare_for_db("FIDSourceID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FIDSourceID";
		$avalues["FIDSourceID"]=$value;
	}
	}
//	processibng FIDSourceID - end
//	processing FisDetail - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FisDetail");
	$type=postvalue("type_FisDetail");
	if (FieldSubmitted("FisDetail"))
	{
		$value=prepare_for_db("FisDetail",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FisDetail";
		$avalues["FisDetail"]=$value;
	}
	}
//	processibng FisDetail - end
//	processing FDataSource - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FDataSource");
	$type=postvalue("type_FDataSource");
	if (FieldSubmitted("FDataSource"))
	{
		$value=prepare_for_db("FDataSource",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FDataSource";
		$avalues["FDataSource"]=$value;
	}
	}
//	processibng FDataSource - end
//	processing FeedTypeID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FeedTypeID");
	$type=postvalue("type_FeedTypeID");
	if (FieldSubmitted("FeedTypeID"))
	{
		$value=prepare_for_db("FeedTypeID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FeedTypeID";
		$avalues["FeedTypeID"]=$value;
	}
	}
//	processibng FeedTypeID - end
//	processing FeedType - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_FeedType");
	$type=postvalue("type_FeedType");
	if (FieldSubmitted("FeedType"))
	{
		$value=prepare_for_db("FeedType",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="FeedType";
		$avalues["FeedType"]=$value;
	}
	}
//	processibng FeedType - end




//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedingredient")
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
	header("Location: vw_feed_".$pageName);
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



if($readavalues)
{
	$defvalues["FeedID"]=@$avalues["FeedID"];
	$defvalues["FName"]=@$avalues["FName"];
	$defvalues["BrandName"]=@$avalues["BrandName"];
	$defvalues["Technology"]=@$avalues["Technology"];
	$defvalues["FeedYear"]=@$avalues["FeedYear"];
	$defvalues["Stage"]=@$avalues["Stage"];
	$defvalues["FCountryID"]=@$avalues["FCountryID"];
	$defvalues["CountryOrigin"]=@$avalues["CountryOrigin"];
	$defvalues["FIDSourceID"]=@$avalues["FIDSourceID"];
	$defvalues["FisDetail"]=@$avalues["FisDetail"];
	$defvalues["FDataSource"]=@$avalues["FDataSource"];
	$defvalues["FeedTypeID"]=@$avalues["FeedTypeID"];
	$defvalues["FeedType"]=@$avalues["FeedType"];
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
//	validate field - FeedYear
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FeedYear", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - FCountryID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FCountryID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - FIDSourceID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FIDSourceID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - FisDetail
	$validatetype="";
		$second_validatetype="IsRequired";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FisDetail", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - FeedTypeID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FeedTypeID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
	
	$jscode.="SUGGEST_TABLE='vw_feed_searchsuggest.php';\r\n";
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	

	$xt->assign("FeedID_fieldblock",true);
	$xt->assign("FName_fieldblock",true);
	$xt->assign("BrandName_fieldblock",true);
	$xt->assign("Technology_fieldblock",true);
	$xt->assign("FeedYear_fieldblock",true);
	$xt->assign("Stage_fieldblock",true);
	$xt->assign("FCountryID_fieldblock",true);
	$xt->assign("CountryOrigin_fieldblock",true);
	$xt->assign("FIDSourceID_fieldblock",true);
	$xt->assign("FisDetail_fieldblock",true);
	$xt->assign("FDataSource_fieldblock",true);
	$xt->assign("FeedTypeID_fieldblock",true);
	$xt->assign("FeedType_fieldblock",true);
	
	$formname="editform";
	if($onsubmit)
		$onsubmit="onsubmit=\"".$onsubmit."\"";
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$body["begin"]=$includes.
		"<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feed_add.php\" ".$onsubmit.">".
		"<input type=hidden name=\"a\" value=\"added\">";
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_feed_list.php?a=return'\"");
		$xt->assign("back_button",true);
	}
	else
	{
		$formname="editform".$id;
		$body["begin"]="<form name=\"editform".$id."\" id=\"editform".$id."\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feed_add.php\" ".$onsubmit." target=\"flyframe".$id."\">".
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


$control_FName=array();
$control_FName["func"]="xt_buildeditcontrol";
$control_FName["params"] = array();
$control_FName["params"]["field"]="FName";
$control_FName["params"]["value"]=@$defvalues["FName"];
$control_FName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FName["params"]["mode"]="inline_add";
else
	$control_FName["params"]["mode"]="add";
	
$xt->assignbyref("FName_editcontrol",$control_FName);


$control_BrandName=array();
$control_BrandName["func"]="xt_buildeditcontrol";
$control_BrandName["params"] = array();
$control_BrandName["params"]["field"]="BrandName";
$control_BrandName["params"]["value"]=@$defvalues["BrandName"];
$control_BrandName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_BrandName["params"]["mode"]="inline_add";
else
	$control_BrandName["params"]["mode"]="add";
	
$xt->assignbyref("BrandName_editcontrol",$control_BrandName);


$control_Technology=array();
$control_Technology["func"]="xt_buildeditcontrol";
$control_Technology["params"] = array();
$control_Technology["params"]["field"]="Technology";
$control_Technology["params"]["value"]=@$defvalues["Technology"];
$control_Technology["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Technology["params"]["mode"]="inline_add";
else
	$control_Technology["params"]["mode"]="add";
	
$xt->assignbyref("Technology_editcontrol",$control_Technology);


$control_FeedYear=array();
$control_FeedYear["func"]="xt_buildeditcontrol";
$control_FeedYear["params"] = array();
$control_FeedYear["params"]["field"]="FeedYear";
$control_FeedYear["params"]["value"]=@$defvalues["FeedYear"];
$control_FeedYear["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FeedYear["params"]["mode"]="inline_add";
else
	$control_FeedYear["params"]["mode"]="add";
	
$xt->assignbyref("FeedYear_editcontrol",$control_FeedYear);


$control_Stage=array();
$control_Stage["func"]="xt_buildeditcontrol";
$control_Stage["params"] = array();
$control_Stage["params"]["field"]="Stage";
$control_Stage["params"]["value"]=@$defvalues["Stage"];
$control_Stage["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Stage["params"]["mode"]="inline_add";
else
	$control_Stage["params"]["mode"]="add";
	
$xt->assignbyref("Stage_editcontrol",$control_Stage);


$control_FCountryID=array();
$control_FCountryID["func"]="xt_buildeditcontrol";
$control_FCountryID["params"] = array();
$control_FCountryID["params"]["field"]="FCountryID";
$control_FCountryID["params"]["value"]=@$defvalues["FCountryID"];
$control_FCountryID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FCountryID["params"]["mode"]="inline_add";
else
	$control_FCountryID["params"]["mode"]="add";
	
$xt->assignbyref("FCountryID_editcontrol",$control_FCountryID);


$control_CountryOrigin=array();
$control_CountryOrigin["func"]="xt_buildeditcontrol";
$control_CountryOrigin["params"] = array();
$control_CountryOrigin["params"]["field"]="CountryOrigin";
$control_CountryOrigin["params"]["value"]=@$defvalues["CountryOrigin"];
$control_CountryOrigin["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_CountryOrigin["params"]["mode"]="inline_add";
else
	$control_CountryOrigin["params"]["mode"]="add";
	
$xt->assignbyref("CountryOrigin_editcontrol",$control_CountryOrigin);


$control_FIDSourceID=array();
$control_FIDSourceID["func"]="xt_buildeditcontrol";
$control_FIDSourceID["params"] = array();
$control_FIDSourceID["params"]["field"]="FIDSourceID";
$control_FIDSourceID["params"]["value"]=@$defvalues["FIDSourceID"];
$control_FIDSourceID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FIDSourceID["params"]["mode"]="inline_add";
else
	$control_FIDSourceID["params"]["mode"]="add";
	
$xt->assignbyref("FIDSourceID_editcontrol",$control_FIDSourceID);


$control_FisDetail=array();
$control_FisDetail["func"]="xt_buildeditcontrol";
$control_FisDetail["params"] = array();
$control_FisDetail["params"]["field"]="FisDetail";
$control_FisDetail["params"]["value"]=@$defvalues["FisDetail"];
$control_FisDetail["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FisDetail["params"]["mode"]="inline_add";
else
	$control_FisDetail["params"]["mode"]="add";
	
$xt->assignbyref("FisDetail_editcontrol",$control_FisDetail);


$control_FDataSource=array();
$control_FDataSource["func"]="xt_buildeditcontrol";
$control_FDataSource["params"] = array();
$control_FDataSource["params"]["field"]="FDataSource";
$control_FDataSource["params"]["value"]=@$defvalues["FDataSource"];
$control_FDataSource["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FDataSource["params"]["mode"]="inline_add";
else
	$control_FDataSource["params"]["mode"]="add";
	
$xt->assignbyref("FDataSource_editcontrol",$control_FDataSource);


$control_FeedTypeID=array();
$control_FeedTypeID["func"]="xt_buildeditcontrol";
$control_FeedTypeID["params"] = array();
$control_FeedTypeID["params"]["field"]="FeedTypeID";
$control_FeedTypeID["params"]["value"]=@$defvalues["FeedTypeID"];
$control_FeedTypeID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FeedTypeID["params"]["mode"]="inline_add";
else
	$control_FeedTypeID["params"]["mode"]="add";
	
$xt->assignbyref("FeedTypeID_editcontrol",$control_FeedTypeID);


$control_FeedType=array();
$control_FeedType["func"]="xt_buildeditcontrol";
$control_FeedType["params"] = array();
$control_FeedType["params"]["field"]="FeedType";
$control_FeedType["params"]["value"]=@$defvalues["FeedType"];
$control_FeedType["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_FeedType["params"]["mode"]="inline_add";
else
	$control_FeedType["params"]["mode"]="add";
	
$xt->assignbyref("FeedType_editcontrol",$control_FeedType);

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