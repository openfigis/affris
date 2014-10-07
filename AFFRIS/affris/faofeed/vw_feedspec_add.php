<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_feedspec_variables.php");


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
	$templatefile = "vw_feedspec_inline_add.htm";
else
	$templatefile = "vw_feedspec_add.htm";

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
//	processing Feed - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Feed");
	$type=postvalue("type_Feed");
	if (FieldSubmitted("Feed"))
	{
		$value=prepare_for_db("Feed",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Feed";
		$avalues["Feed"]=$value;
	}
	}
//	processibng Feed - end
//	processing Brand - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Brand");
	$type=postvalue("type_Brand");
	if (FieldSubmitted("Brand"))
	{
		$value=prepare_for_db("Brand",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Brand";
		$avalues["Brand"]=$value;
	}
	}
//	processibng Brand - end
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
//	processing Feed Year - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Feed_Year");
	$type=postvalue("type_Feed_Year");
	if (FieldSubmitted("Feed Year"))
	{
		$value=prepare_for_db("Feed Year",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Feed Year";
		$avalues["Feed Year"]=$value;
	}
	}
//	processibng Feed Year - end
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
//	processing Country Origin - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Country_Origin");
	$type=postvalue("type_Country_Origin");
	if (FieldSubmitted("Country Origin"))
	{
		$value=prepare_for_db("Country Origin",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Country Origin";
		$avalues["Country Origin"]=$value;
	}
	}
//	processibng Country Origin - end
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
//	processing Details - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Details");
	$type=postvalue("type_Details");
	if (FieldSubmitted("Details"))
	{
		$value=prepare_for_db("Details",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Details";
		$avalues["Details"]=$value;
	}
	}
//	processibng Details - end
//	processing Data Source - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Data_Source");
	$type=postvalue("type_Data_Source");
	if (FieldSubmitted("Data Source"))
	{
		$value=prepare_for_db("Data Source",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Data Source";
		$avalues["Data Source"]=$value;
	}
	}
//	processibng Data Source - end
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
//	processing Type - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Type");
	$type=postvalue("type_Type");
	if (FieldSubmitted("Type"))
	{
		$value=prepare_for_db("Type",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Type";
		$avalues["Type"]=$value;
	}
	}
//	processibng Type - end
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
//	processing Species Name - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Species_Name");
	$type=postvalue("type_Species_Name");
	if (FieldSubmitted("Species Name"))
	{
		$value=prepare_for_db("Species Name",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Species Name";
		$avalues["Species Name"]=$value;
	}
	}
//	processibng Species Name - end
//	processing Common Name - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Common_Name");
	$type=postvalue("type_Common_Name");
	if (FieldSubmitted("Common Name"))
	{
		$value=prepare_for_db("Common Name",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Common Name";
		$avalues["Common Name"]=$value;
	}
	}
//	processibng Common Name - end
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
//	processing Habit - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Habit");
	$type=postvalue("type_Habit");
	if (FieldSubmitted("Habit"))
	{
		$value=prepare_for_db("Habit",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Habit";
		$avalues["Habit"]=$value;
	}
	}
//	processibng Habit - end
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
//	processing Species Year - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Species_Year");
	$type=postvalue("type_Species_Year");
	if (FieldSubmitted("Species Year"))
	{
		$value=prepare_for_db("Species Year",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Species Year";
		$avalues["Species Year"]=$value;
	}
	}
//	processibng Species Year - end








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
	header("Location: vw_feedspec_".$pageName);
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




if($readavalues)
{
	$defvalues["FeedID"]=@$avalues["FeedID"];
	$defvalues["Feed"]=@$avalues["Feed"];
	$defvalues["Brand"]=@$avalues["Brand"];
	$defvalues["Technology"]=@$avalues["Technology"];
	$defvalues["Feed Year"]=@$avalues["Feed Year"];
	$defvalues["Stage"]=@$avalues["Stage"];
	$defvalues["FCountryID"]=@$avalues["FCountryID"];
	$defvalues["Country Origin"]=@$avalues["Country Origin"];
	$defvalues["FIDSourceID"]=@$avalues["FIDSourceID"];
	$defvalues["Details"]=@$avalues["Details"];
	$defvalues["Data Source"]=@$avalues["Data Source"];
	$defvalues["FeedTypeID"]=@$avalues["FeedTypeID"];
	$defvalues["Type"]=@$avalues["Type"];
	$defvalues["SpeciesID"]=@$avalues["SpeciesID"];
	$defvalues["Species Name"]=@$avalues["Species Name"];
	$defvalues["Common Name"]=@$avalues["Common Name"];
	$defvalues["Hybrid"]=@$avalues["Hybrid"];
	$defvalues["Variety"]=@$avalues["Variety"];
	$defvalues["Family"]=@$avalues["Family"];
	$defvalues["Group"]=@$avalues["Group"];
	$defvalues["Genus"]=@$avalues["Genus"];
	$defvalues["Environment"]=@$avalues["Environment"];
	$defvalues["Habit"]=@$avalues["Habit"];
	$defvalues["Country"]=@$avalues["Country"];
	$defvalues["Species Year"]=@$avalues["Species Year"];
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
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FeedID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - Feed_Year
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "Feed_Year", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
//	validate field - FeedTypeID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "FeedTypeID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - SpeciesID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "SpeciesID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - Species_Year
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "Species_Year", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
	
	$jscode.="SUGGEST_TABLE='vw_feedspec_searchsuggest.php';\r\n";
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	

	$xt->assign("FeedID_fieldblock",true);
	$xt->assign("Feed_fieldblock",true);
	$xt->assign("Brand_fieldblock",true);
	$xt->assign("Technology_fieldblock",true);
	$xt->assign("Feed_Year_fieldblock",true);
	$xt->assign("Stage_fieldblock",true);
	$xt->assign("FCountryID_fieldblock",true);
	$xt->assign("Country_Origin_fieldblock",true);
	$xt->assign("FIDSourceID_fieldblock",true);
	$xt->assign("Details_fieldblock",true);
	$xt->assign("Data_Source_fieldblock",true);
	$xt->assign("FeedTypeID_fieldblock",true);
	$xt->assign("Type_fieldblock",true);
	$xt->assign("SpeciesID_fieldblock",true);
	$xt->assign("Species_Name_fieldblock",true);
	$xt->assign("Common_Name_fieldblock",true);
	$xt->assign("Hybrid_fieldblock",true);
	$xt->assign("Variety_fieldblock",true);
	$xt->assign("Family_fieldblock",true);
	$xt->assign("Group_fieldblock",true);
	$xt->assign("Genus_fieldblock",true);
	$xt->assign("Environment_fieldblock",true);
	$xt->assign("Habit_fieldblock",true);
	$xt->assign("Country_fieldblock",true);
	$xt->assign("Species_Year_fieldblock",true);
	
	$formname="editform";
	if($onsubmit)
		$onsubmit="onsubmit=\"".$onsubmit."\"";
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$body["begin"]=$includes.
		"<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feedspec_add.php\" ".$onsubmit.">".
		"<input type=hidden name=\"a\" value=\"added\">";
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_feedspec_list.php?a=return'\"");
		$xt->assign("back_button",true);
	}
	else
	{
		$formname="editform".$id;
		$body["begin"]="<form name=\"editform".$id."\" id=\"editform".$id."\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feedspec_add.php\" ".$onsubmit." target=\"flyframe".$id."\">".
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


$control_Feed=array();
$control_Feed["func"]="xt_buildeditcontrol";
$control_Feed["params"] = array();
$control_Feed["params"]["field"]="Feed";
$control_Feed["params"]["value"]=@$defvalues["Feed"];
$control_Feed["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Feed["params"]["mode"]="inline_add";
else
	$control_Feed["params"]["mode"]="add";
	
$xt->assignbyref("Feed_editcontrol",$control_Feed);


$control_Brand=array();
$control_Brand["func"]="xt_buildeditcontrol";
$control_Brand["params"] = array();
$control_Brand["params"]["field"]="Brand";
$control_Brand["params"]["value"]=@$defvalues["Brand"];
$control_Brand["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Brand["params"]["mode"]="inline_add";
else
	$control_Brand["params"]["mode"]="add";
	
$xt->assignbyref("Brand_editcontrol",$control_Brand);


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


$control_Feed_Year=array();
$control_Feed_Year["func"]="xt_buildeditcontrol";
$control_Feed_Year["params"] = array();
$control_Feed_Year["params"]["field"]="Feed Year";
$control_Feed_Year["params"]["value"]=@$defvalues["Feed Year"];
$control_Feed_Year["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Feed_Year["params"]["mode"]="inline_add";
else
	$control_Feed_Year["params"]["mode"]="add";
	
$xt->assignbyref("Feed_Year_editcontrol",$control_Feed_Year);


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


$control_Country_Origin=array();
$control_Country_Origin["func"]="xt_buildeditcontrol";
$control_Country_Origin["params"] = array();
$control_Country_Origin["params"]["field"]="Country Origin";
$control_Country_Origin["params"]["value"]=@$defvalues["Country Origin"];
$control_Country_Origin["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Country_Origin["params"]["mode"]="inline_add";
else
	$control_Country_Origin["params"]["mode"]="add";
	
$xt->assignbyref("Country_Origin_editcontrol",$control_Country_Origin);


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


$control_Details=array();
$control_Details["func"]="xt_buildeditcontrol";
$control_Details["params"] = array();
$control_Details["params"]["field"]="Details";
$control_Details["params"]["value"]=@$defvalues["Details"];
$control_Details["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Details["params"]["mode"]="inline_add";
else
	$control_Details["params"]["mode"]="add";
	
$xt->assignbyref("Details_editcontrol",$control_Details);


$control_Data_Source=array();
$control_Data_Source["func"]="xt_buildeditcontrol";
$control_Data_Source["params"] = array();
$control_Data_Source["params"]["field"]="Data Source";
$control_Data_Source["params"]["value"]=@$defvalues["Data Source"];
$control_Data_Source["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Data_Source["params"]["mode"]="inline_add";
else
	$control_Data_Source["params"]["mode"]="add";
	
$xt->assignbyref("Data_Source_editcontrol",$control_Data_Source);


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


$control_Type=array();
$control_Type["func"]="xt_buildeditcontrol";
$control_Type["params"] = array();
$control_Type["params"]["field"]="Type";
$control_Type["params"]["value"]=@$defvalues["Type"];
$control_Type["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Type["params"]["mode"]="inline_add";
else
	$control_Type["params"]["mode"]="add";
	
$xt->assignbyref("Type_editcontrol",$control_Type);


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


$control_Species_Name=array();
$control_Species_Name["func"]="xt_buildeditcontrol";
$control_Species_Name["params"] = array();
$control_Species_Name["params"]["field"]="Species Name";
$control_Species_Name["params"]["value"]=@$defvalues["Species Name"];
$control_Species_Name["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Species_Name["params"]["mode"]="inline_add";
else
	$control_Species_Name["params"]["mode"]="add";
	
$xt->assignbyref("Species_Name_editcontrol",$control_Species_Name);


$control_Common_Name=array();
$control_Common_Name["func"]="xt_buildeditcontrol";
$control_Common_Name["params"] = array();
$control_Common_Name["params"]["field"]="Common Name";
$control_Common_Name["params"]["value"]=@$defvalues["Common Name"];
$control_Common_Name["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Common_Name["params"]["mode"]="inline_add";
else
	$control_Common_Name["params"]["mode"]="add";
	
$xt->assignbyref("Common_Name_editcontrol",$control_Common_Name);


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


$control_Habit=array();
$control_Habit["func"]="xt_buildeditcontrol";
$control_Habit["params"] = array();
$control_Habit["params"]["field"]="Habit";
$control_Habit["params"]["value"]=@$defvalues["Habit"];
$control_Habit["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Habit["params"]["mode"]="inline_add";
else
	$control_Habit["params"]["mode"]="add";
	
$xt->assignbyref("Habit_editcontrol",$control_Habit);


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


$control_Species_Year=array();
$control_Species_Year["func"]="xt_buildeditcontrol";
$control_Species_Year["params"] = array();
$control_Species_Year["params"]["field"]="Species Year";
$control_Species_Year["params"]["value"]=@$defvalues["Species Year"];
$control_Species_Year["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Species_Year["params"]["mode"]="inline_add";
else
	$control_Species_Year["params"]["mode"]="add";
	
$xt->assignbyref("Species_Year_editcontrol",$control_Species_Year);

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