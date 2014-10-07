<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_feedspec_variables.php");


/////////////////////////////////////////////////////////////
//	check if logged in
/////////////////////////////////////////////////////////////
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

/////////////////////////////////////////////////////////////
//init variables
/////////////////////////////////////////////////////////////


$pageName = "edit.php";

$filename="";
$status="";
$message="";
$usermessage="";
$error_happened=false;
$readevalues=false;
$bodyonload="";
$key=array();
$next=array();
$prev=array();

$body=array();
$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$inlineedit = (postvalue("editType")=="inline") ? true : false;
$templatefile = "vw_feedspec_edit.htm";


include('include/xtempl.php');
$xt = new Xtempl();



//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$keys["FeedID"]=postvalue("editid1");

/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

if(@$_POST["a"]=="edited")
{
	$strWhereClause=KeyWhere($keys);
		$evalues=array();
	$efilename_values=array();
	$files_delete=array();
	$files_move=array();
	$files_save=array();
	$blobfields=array();

	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_FeedID");
	$type=postvalue("type_FeedID");
	if(FieldSubmitted("FeedID"))
	{
		$value=prepare_for_db("FeedID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FeedID"]=$value;
	}

//	update key value
	if($value!==false)
		$keys["FeedID"]=$value;

//	processibng FeedID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Feed");
	$type=postvalue("type_Feed");
	if(FieldSubmitted("Feed"))
	{
		$value=prepare_for_db("Feed",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Feed"]=$value;
	}


//	processibng Feed - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Brand");
	$type=postvalue("type_Brand");
	if(FieldSubmitted("Brand"))
	{
		$value=prepare_for_db("Brand",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Brand"]=$value;
	}


//	processibng Brand - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Technology");
	$type=postvalue("type_Technology");
	if(FieldSubmitted("Technology"))
	{
		$value=prepare_for_db("Technology",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Technology"]=$value;
	}


//	processibng Technology - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Feed_Year");
	$type=postvalue("type_Feed_Year");
	if(FieldSubmitted("Feed Year"))
	{
		$value=prepare_for_db("Feed Year",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Feed Year"]=$value;
	}


//	processibng Feed Year - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Stage");
	$type=postvalue("type_Stage");
	if(FieldSubmitted("Stage"))
	{
		$value=prepare_for_db("Stage",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Stage"]=$value;
	}


//	processibng Stage - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_FCountryID");
	$type=postvalue("type_FCountryID");
	if(FieldSubmitted("FCountryID"))
	{
		$value=prepare_for_db("FCountryID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FCountryID"]=$value;
	}


//	processibng FCountryID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Country_Origin");
	$type=postvalue("type_Country_Origin");
	if(FieldSubmitted("Country Origin"))
	{
		$value=prepare_for_db("Country Origin",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Country Origin"]=$value;
	}


//	processibng Country Origin - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_FIDSourceID");
	$type=postvalue("type_FIDSourceID");
	if(FieldSubmitted("FIDSourceID"))
	{
		$value=prepare_for_db("FIDSourceID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FIDSourceID"]=$value;
	}


//	processibng FIDSourceID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Details");
	$type=postvalue("type_Details");
	if(FieldSubmitted("Details"))
	{
		$value=prepare_for_db("Details",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Details"]=$value;
	}


//	processibng Details - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Data_Source");
	$type=postvalue("type_Data_Source");
	if(FieldSubmitted("Data Source"))
	{
		$value=prepare_for_db("Data Source",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Data Source"]=$value;
	}


//	processibng Data Source - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_FeedTypeID");
	$type=postvalue("type_FeedTypeID");
	if(FieldSubmitted("FeedTypeID"))
	{
		$value=prepare_for_db("FeedTypeID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FeedTypeID"]=$value;
	}


//	processibng FeedTypeID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Type");
	$type=postvalue("type_Type");
	if(FieldSubmitted("Type"))
	{
		$value=prepare_for_db("Type",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Type"]=$value;
	}


//	processibng Type - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_SpeciesID");
	$type=postvalue("type_SpeciesID");
	if(FieldSubmitted("SpeciesID"))
	{
		$value=prepare_for_db("SpeciesID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["SpeciesID"]=$value;
	}


//	processibng SpeciesID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Species_Name");
	$type=postvalue("type_Species_Name");
	if(FieldSubmitted("Species Name"))
	{
		$value=prepare_for_db("Species Name",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Species Name"]=$value;
	}


//	processibng Species Name - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Common_Name");
	$type=postvalue("type_Common_Name");
	if(FieldSubmitted("Common Name"))
	{
		$value=prepare_for_db("Common Name",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Common Name"]=$value;
	}


//	processibng Common Name - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Hybrid");
	$type=postvalue("type_Hybrid");
	if(FieldSubmitted("Hybrid"))
	{
		$value=prepare_for_db("Hybrid",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Hybrid"]=$value;
	}


//	processibng Hybrid - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Variety");
	$type=postvalue("type_Variety");
	if(FieldSubmitted("Variety"))
	{
		$value=prepare_for_db("Variety",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Variety"]=$value;
	}


//	processibng Variety - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Family");
	$type=postvalue("type_Family");
	if(FieldSubmitted("Family"))
	{
		$value=prepare_for_db("Family",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Family"]=$value;
	}


//	processibng Family - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Group");
	$type=postvalue("type_Group");
	if(FieldSubmitted("Group"))
	{
		$value=prepare_for_db("Group",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Group"]=$value;
	}


//	processibng Group - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Genus");
	$type=postvalue("type_Genus");
	if(FieldSubmitted("Genus"))
	{
		$value=prepare_for_db("Genus",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Genus"]=$value;
	}


//	processibng Genus - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Environment");
	$type=postvalue("type_Environment");
	if(FieldSubmitted("Environment"))
	{
		$value=prepare_for_db("Environment",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Environment"]=$value;
	}


//	processibng Environment - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Habit");
	$type=postvalue("type_Habit");
	if(FieldSubmitted("Habit"))
	{
		$value=prepare_for_db("Habit",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Habit"]=$value;
	}


//	processibng Habit - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Country");
	$type=postvalue("type_Country");
	if(FieldSubmitted("Country"))
	{
		$value=prepare_for_db("Country",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Country"]=$value;
	}


//	processibng Country - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Species_Year");
	$type=postvalue("type_Species_Year");
	if(FieldSubmitted("Species Year"))
	{
		$value=prepare_for_db("Species Year",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Species Year"]=$value;
	}


//	processibng Species Year - end
	}

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey]=$value;
//	do event
	$retval=true;
	if(function_exists("BeforeEdit"))
		$retval=BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,$inlineedit);
	if($retval)
	{		
		if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause))
		{
			$IsSaved=true;
//	after edit event
			if(function_exists("AfterEdit"))
			{
				foreach($dataold as $idx=>$val)
				{
					if(!array_key_exists($idx,$evalues))
						$evalues[$idx]=$val;
				}
				AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,$inlineedit);
			}
		}
	}
	else
	{
		$readevalues=true;
		$message = $usermessage;
		$status="DECLINED";
	}
}

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && !$inlineedit )
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["FeedID"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: vw_feedspec_".$pageName."?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if (!$inlineedit && isset($_SESSION["message"])){
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}



/////////////////////////////////////////////////////////////
//	read current values from the database
/////////////////////////////////////////////////////////////

$strWhereClause=KeyWhere($keys);

$strSQL=gSQLWhere($strWhereClause);

$strSQLbak = $strSQL;
//	Before Query event
if(function_exists("BeforeQueryEdit"))
	BeforeQueryEdit($strSQL,$strWhereClause);

if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);
LogInfo($strSQL);
$rs=db_query($strSQL,$conn);
$data=db_fetch_array($rs);

if(!$data)
{
	if(!$inlineedit)
	{
		header("Location: vw_feedspec_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["FeedID"]=$evalues["FeedID"];
	$data["Feed"]=$evalues["Feed"];
	$data["Brand"]=$evalues["Brand"];
	$data["Technology"]=$evalues["Technology"];
	$data["Feed Year"]=$evalues["Feed Year"];
	$data["Stage"]=$evalues["Stage"];
	$data["FCountryID"]=$evalues["FCountryID"];
	$data["Country Origin"]=$evalues["Country Origin"];
	$data["FIDSourceID"]=$evalues["FIDSourceID"];
	$data["Details"]=$evalues["Details"];
	$data["Data Source"]=$evalues["Data Source"];
	$data["FeedTypeID"]=$evalues["FeedTypeID"];
	$data["Type"]=$evalues["Type"];
	$data["SpeciesID"]=$evalues["SpeciesID"];
	$data["Species Name"]=$evalues["Species Name"];
	$data["Common Name"]=$evalues["Common Name"];
	$data["Hybrid"]=$evalues["Hybrid"];
	$data["Variety"]=$evalues["Variety"];
	$data["Family"]=$evalues["Family"];
	$data["Group"]=$evalues["Group"];
	$data["Genus"]=$evalues["Genus"];
	$data["Environment"]=$evalues["Environment"];
	$data["Habit"]=$evalues["Habit"];
	$data["Country"]=$evalues["Country"];
	$data["Species Year"]=$evalues["Species Year"];
}

/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////

//Array of includes js files	
//Basic includes js files
$includes="";
//javascript code
$jscode="";
//event for onsubmit
$onsubmit="";
//////////////////////////////////////////////////////////////////	
//	Begin Add validation params for InlineEdit or Edit	
//	validation stuff
	$onsubmit="$('#message_block').html('');";
	$regex='';
	$regexmessage='';
	$RTEfunc="";
	$regextype = "";
	$arrValidate = array();
//	for inlineEdit
	$editValidateTypes = array();
	$editValidateFields = array();
	$editValidateUseRTE = array();
	$editValidateCBList = array();
	$editValidateRegex = array();
	$editValidateRegexmes = array();	
	$editValidateRegexmestype = array();	
//	Begin Edit validation	
//if use InnovaEditor or RTE on page add when useRTE will be with  -  "_FLY"
//if use InnovaEditor or RTE on page InineEdit when useRTE will be with out  -  "_FLY"
if(!$inlineedit)
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
	
	$jscode.="editValid = new validation();\r\n";
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
		if(!$inlineedit)
		{
			if ($arrValidate[$i][1]=="Regular expression")
				$bodyonload.="editValid.addRegex(document.editform['value_".$arrValidate[$i][0]."'],'".$arrValidate[$i][1]."','".
					jsreplace($arrValidate[$i][5])."','".jsreplace($arrValidate[$i][6])."','".jsreplace($arrValidate[$i][7])."');\r\n";
			else
				$bodyonload.="editValid.add(document.editform['value_".$arrValidate[$i][0]."'],'".$arrValidate[$i][1]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";
		}
		else{
				//	Add Inline validation params
				$editValidateTypes[] = $arrValidate[$i][1];
				$editValidateFields[] = $arrValidate[$i][0];
				$editValidateUseRTE[] = $arrValidate[$i][3];
				$editValidateCBList[] = $arrValidate[$i][4];
				$editValidateRegex[] = jsreplace($arrValidate[$i][5]);
				$editValidateRegexmes[] = jsreplace($arrValidate[$i][6]);
				$editValidateRegexmestype[] = jsreplace($arrValidate[$i][7]);
			}
	}
	if($arrValidate[$i][2])
	{
		if(!$inlineedit)
		{
			if($arrValidate[$i][3]=='INNOVA_FLY' || $arrValidate[$i][3]=='RTE_FLY')
			{
				$bodyonload.='$("td[@class^=\'editshade_lb\']").each(function(i){';
				$bodyonload.='if($("iframe[@name=\'value_'.$arrValidate[$i][0].'\']",this).length)';
				$bodyonload.='editValid.add($("iframe[@name=\'value_'.$arrValidate[$i][0].'\']",this),"'.$arrValidate[$i][2].'","'.$arrValidate[$i][3].'","'.$arrValidate[$i][4].'");});';
			}
			else
				$bodyonload.="editValid.add(document.editform['".($arrValidate[$i][4]=='disp' ? "display_" : "")."value_".$arrValidate[$i][0].($arrValidate[$i][4]=='CBList' || $arrValidate[$i][4]=='list' ? "[]" : "")."'],'".$arrValidate[$i][2]."','".$arrValidate[$i][3]."','".$arrValidate[$i][4]."');\r\n";
		}
		else{
				//	Add Inline validation params	
				$editValidateTypes[] = $arrValidate[$i][2];
				$editValidateFields[] = $arrValidate[$i][0];
				$editValidateUseRTE[] = $arrValidate[$i][3];
				$editValidateCBList[] = $arrValidate[$i][4];
				$editValidateRegex[] = jsreplace($arrValidate[$i][5]);
				$editValidateRegexmes[] = jsreplace($arrValidate[$i][6]);
				$editValidateRegexmestype[] = jsreplace($arrValidate[$i][7]);
			}
	}		
}	
//	End Add validation params for InlineEdit or Edit
//////////////////////////////////////////////////////////////

////////////////////// time picker
//////////////////////

	
AddJSFile("customlabels");
$jscode.= "window.locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
	"window.locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
	"window.bLoading=false;\r\n".
	"window.TEXT_PLEASE_SELECT='".jsreplace("Please select")."';\r\n";	
	
	
	
	
if(!$inlineedit)
{
	if($bodyonload)
	{
		if($RTEfunc)
			$onsubmit="if(editValid.validate()){".$RTEfunc."return true;}else return false;";
		else
			$onsubmit="return editValid.validate();";
	}
	elseif($RTEfunc)
		$onsubmit=$RTEfunc."return true;";
	$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	AddJSFile("ajaxsuggest");	
	
	$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	
	
	
	$jscode.="SUGGEST_TABLE='vw_feedspec_searchsuggest.php';\r\n";
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

	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$body["begin"]=$includes."
	<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feedspec_edit.php\" ".$onsubmit.">".
	"<input type=hidden name=\"a\" value=\"edited\">";
	$body["begin"].="<input type=\"hidden\" name=\"editid1\" value=\"".htmlspecialchars($keys["FeedID"])."\">";
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"FeedID", "")));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
if(!@$_SESSION[$strTableName."_noNextPrev"])
{
	$where_next=$where_prev="";
	$order_next=$order_prev="";
	$arrFieldForSort=array();
	$arrHowFieldSort=array();
	$where=$_SESSION[$strTableName."_where"];
	if(GetFieldIndex("FeedID"))
		$key[]=GetFieldIndex("FeedID");
//if session mass sorting empty, then create it as a sheet
	if(@$_SESSION[$strTableName."_arrFieldForSort"] && @$_SESSION[$strTableName."_arrHowFieldSort"])
	{
		$arrFieldForSort=$_SESSION[$strTableName."_arrFieldForSort"];
		$arrHowFieldSort=$_SESSION[$strTableName."_arrHowFieldSort"];
		$lenArr=count($arrFieldForSort);
	}
	else
	{
		if(count($g_orderindexes))
		{
			for($i=0;$i<count($g_orderindexes);$i++)
			{
				$arrFieldForSort[]=$g_orderindexes[$i][0];
				$arrHowFieldSort[]=$g_orderindexes[$i][1];
			}
		}
		elseif($gstrOrderBy!='')
			$_SESSION[$strTableName."_noNextPrev"] = 1;
		if(count($key))
		{
			for($i=0;$i<count($key);$i++)
			{
				$idsearch=array_search($key[$i],$arrFieldForSort);
				if($idsearch===false)
				{
					$arrFieldForSort[]=$key[$i];
					$arrHowFieldSort[]="ASC";
				}
			}
		}
		$_SESSION[$strTableName."_arrFieldForSort"]=$arrFieldForSort;
		$_SESSION[$strTableName."_arrHowFieldSort"]=$arrHowFieldSort;
		$lenArr=count($arrFieldForSort);
	}
//if session order by empty, then create a line order		
	if(@$_SESSION[$strTableName."_order"]) 
		$order_next=$_SESSION[$strTableName."_order"];
	elseif($lenArr>0)
	{
		for($i=0;$i<$lenArr;$i++)
			$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
	}
//create a line where and order for the two queries
	if($lenArr>0 and count($key) and !$_SESSION[$strTableName."_noNextPrev"])
	{
		if($where)
			$where .=" and ";
		$scob="";
		$flag=0;
		for($i=0;$i<$lenArr;$i++)
		{
			$fieldName=GetFieldByIndex($arrFieldForSort[$i]);
			if($fieldName)
			{
				$order_prev .=($order_prev!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i].($arrHowFieldSort[$i]=="ASC" ? " DESC" : " ASC");
				$dbg=GetFullFieldName($fieldName);
				if(!is_null($data[$fieldName]))
				{
					$mdv=make_db_value($fieldName,$data[$fieldName]);
					$ga=($arrHowFieldSort[$i]=="ASC" ? ">" : "<");
					$gd=($arrHowFieldSort[$i]=="ASC" ? "<" : ">");
					$gasc=$dbg.$ga.$mdv;
					$gdesc=$dbg.$gd.$mdv;
					$gravn=($i!=$lenArr-1 ? $dbg."=".$mdv : "");
					$ganull=($ga=="<" ? " or ".$dbg." IS NULL" : "");
					$gdnull=($gd=="<" ? " or ".$dbg." IS NULL" : "");
				}
				else
				{
					$gasc=($arrHowFieldSort[$i]=="ASC" ? $dbg." IS NOT NULL" : "");
					$gdesc=($arrHowFieldSort[$i]=="ASC" ? "" : $dbg." IS NOT NULL");
					$gravn=($i!=$lenArr-1 ? $dbg." IS NULL" : "");
					$ganull=$gdnull="";
				}
				$where_next .=($where_next!="" ? " and (" : " (").($gasc=="" && $gravn=="" ? " 1=0 " : ($gasc!="" ? $gasc.$ganull : "").($gasc!="" && $gravn!="" ? " or " : "").$gravn." ");
				$where_prev .=($where_prev!="" ? " and (" : " (").($gdesc=="" && $gravn=="" ? " 1=0 " : ($gdesc!="" ? $gdesc.$gdnull : "").($gdesc!="" && $gravn!="" ? " or " : "").$gravn." ");
				$scob .=")";
			}
			else 
				$flag=1;
		}
		$where_next =$where_next.$scob;
		$where_prev =$where_prev.$scob;
		$where_next=whereAdd($where_next,SecuritySQL("Edit"));
		$where_prev=whereAdd($where_prev,SecuritySQL("Edit"));
		if($flag==1)
		{
			$order_next="";
			for($i=0;$i<$lenArr;$i++)
				$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
		$sql_next=gSQLWhere($where.$where_next).$order_next;
		$sql_prev=gSQLWhere($where.$where_prev).$order_prev;
		if($where_next!="" and $order_next!="" and $where_prev!="" and $order_prev!="")
		{
					$sql_next.=" limit 1";
			$sql_prev.=" limit 1";
		
			$res_next=db_query($sql_next,$conn);		
			if($row_next=db_fetch_array($res_next))
				$next[1]=$row_next["FeedID"];
		
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
				$prev[1]=$row_prev["FeedID"];
		}
	}
}
	$nextlink=$prevlink="";$resetlink="";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_feedspec_edit.php?".$nextlink."'\"");
		$resetlink.="$('#next').attr('style','');$('#next').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_feedspec_edit.php?".$prevlink."'\"");
		$resetlink.="$('#prev').attr('style','');$('#prev').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs","onclick=\"flag_but=0; resetEditors(); ".$resetlink."\"");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_feedspec_list.php?a=return'\"");
	$xt->assign("save_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
}

$showKeys[] = rawurlencode($keys["FeedID"]);

if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}

/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////
$record_id= postvalue("recordID");

	if($inlineedit) 
	{
		$jscode.= "inlineEditValid".$record_id." = new validation();\r\n";
	}
	else
		$jscode.= "flag_but=0;\r\n change();".$bodyonload."\r\n SetToFirstControl('editform');\r\n";
	

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////

$jscode.="\r\n window.rteIdArr=".jsreplace("new Object").";\r\n";

//0
$control_FeedID=array();
$control_FeedID["func"]="xt_buildeditcontrol";
$control_FeedID["params"] = array();
$control_FeedID["params"]["field"]="FeedID";
$control_FeedID["params"]["value"]=@$data["FeedID"];

$control_FeedID["params"]["id"]=$record_id;
if($inlineedit)
	$control_FeedID["params"]["mode"]="inline_edit";
else
	$control_FeedID["params"]["mode"]="edit";
$xt->assignbyref("FeedID_editcontrol",$control_FeedID);

//0
$control_Feed=array();
$control_Feed["func"]="xt_buildeditcontrol";
$control_Feed["params"] = array();
$control_Feed["params"]["field"]="Feed";
$control_Feed["params"]["value"]=@$data["Feed"];

$control_Feed["params"]["id"]=$record_id;
if($inlineedit)
	$control_Feed["params"]["mode"]="inline_edit";
else
	$control_Feed["params"]["mode"]="edit";
$xt->assignbyref("Feed_editcontrol",$control_Feed);

//0
$control_Brand=array();
$control_Brand["func"]="xt_buildeditcontrol";
$control_Brand["params"] = array();
$control_Brand["params"]["field"]="Brand";
$control_Brand["params"]["value"]=@$data["Brand"];

$control_Brand["params"]["id"]=$record_id;
if($inlineedit)
	$control_Brand["params"]["mode"]="inline_edit";
else
	$control_Brand["params"]["mode"]="edit";
$xt->assignbyref("Brand_editcontrol",$control_Brand);

//0
$control_Technology=array();
$control_Technology["func"]="xt_buildeditcontrol";
$control_Technology["params"] = array();
$control_Technology["params"]["field"]="Technology";
$control_Technology["params"]["value"]=@$data["Technology"];

$control_Technology["params"]["id"]=$record_id;
if($inlineedit)
	$control_Technology["params"]["mode"]="inline_edit";
else
	$control_Technology["params"]["mode"]="edit";
$xt->assignbyref("Technology_editcontrol",$control_Technology);

//0
$control_Feed_Year=array();
$control_Feed_Year["func"]="xt_buildeditcontrol";
$control_Feed_Year["params"] = array();
$control_Feed_Year["params"]["field"]="Feed Year";
$control_Feed_Year["params"]["value"]=@$data["Feed Year"];

$control_Feed_Year["params"]["id"]=$record_id;
if($inlineedit)
	$control_Feed_Year["params"]["mode"]="inline_edit";
else
	$control_Feed_Year["params"]["mode"]="edit";
$xt->assignbyref("Feed_Year_editcontrol",$control_Feed_Year);

//0
$control_Stage=array();
$control_Stage["func"]="xt_buildeditcontrol";
$control_Stage["params"] = array();
$control_Stage["params"]["field"]="Stage";
$control_Stage["params"]["value"]=@$data["Stage"];

$control_Stage["params"]["id"]=$record_id;
if($inlineedit)
	$control_Stage["params"]["mode"]="inline_edit";
else
	$control_Stage["params"]["mode"]="edit";
$xt->assignbyref("Stage_editcontrol",$control_Stage);

//0
$control_FCountryID=array();
$control_FCountryID["func"]="xt_buildeditcontrol";
$control_FCountryID["params"] = array();
$control_FCountryID["params"]["field"]="FCountryID";
$control_FCountryID["params"]["value"]=@$data["FCountryID"];

$control_FCountryID["params"]["id"]=$record_id;
if($inlineedit)
	$control_FCountryID["params"]["mode"]="inline_edit";
else
	$control_FCountryID["params"]["mode"]="edit";
$xt->assignbyref("FCountryID_editcontrol",$control_FCountryID);

//0
$control_Country_Origin=array();
$control_Country_Origin["func"]="xt_buildeditcontrol";
$control_Country_Origin["params"] = array();
$control_Country_Origin["params"]["field"]="Country Origin";
$control_Country_Origin["params"]["value"]=@$data["Country Origin"];

$control_Country_Origin["params"]["id"]=$record_id;
if($inlineedit)
	$control_Country_Origin["params"]["mode"]="inline_edit";
else
	$control_Country_Origin["params"]["mode"]="edit";
$xt->assignbyref("Country_Origin_editcontrol",$control_Country_Origin);

//0
$control_FIDSourceID=array();
$control_FIDSourceID["func"]="xt_buildeditcontrol";
$control_FIDSourceID["params"] = array();
$control_FIDSourceID["params"]["field"]="FIDSourceID";
$control_FIDSourceID["params"]["value"]=@$data["FIDSourceID"];

$control_FIDSourceID["params"]["id"]=$record_id;
if($inlineedit)
	$control_FIDSourceID["params"]["mode"]="inline_edit";
else
	$control_FIDSourceID["params"]["mode"]="edit";
$xt->assignbyref("FIDSourceID_editcontrol",$control_FIDSourceID);

//0
$control_Details=array();
$control_Details["func"]="xt_buildeditcontrol";
$control_Details["params"] = array();
$control_Details["params"]["field"]="Details";
$control_Details["params"]["value"]=@$data["Details"];

$control_Details["params"]["id"]=$record_id;
if($inlineedit)
	$control_Details["params"]["mode"]="inline_edit";
else
	$control_Details["params"]["mode"]="edit";
$xt->assignbyref("Details_editcontrol",$control_Details);

//0
$control_Data_Source=array();
$control_Data_Source["func"]="xt_buildeditcontrol";
$control_Data_Source["params"] = array();
$control_Data_Source["params"]["field"]="Data Source";
$control_Data_Source["params"]["value"]=@$data["Data Source"];

$control_Data_Source["params"]["id"]=$record_id;
if($inlineedit)
	$control_Data_Source["params"]["mode"]="inline_edit";
else
	$control_Data_Source["params"]["mode"]="edit";
$xt->assignbyref("Data_Source_editcontrol",$control_Data_Source);

//0
$control_FeedTypeID=array();
$control_FeedTypeID["func"]="xt_buildeditcontrol";
$control_FeedTypeID["params"] = array();
$control_FeedTypeID["params"]["field"]="FeedTypeID";
$control_FeedTypeID["params"]["value"]=@$data["FeedTypeID"];

$control_FeedTypeID["params"]["id"]=$record_id;
if($inlineedit)
	$control_FeedTypeID["params"]["mode"]="inline_edit";
else
	$control_FeedTypeID["params"]["mode"]="edit";
$xt->assignbyref("FeedTypeID_editcontrol",$control_FeedTypeID);

//0
$control_Type=array();
$control_Type["func"]="xt_buildeditcontrol";
$control_Type["params"] = array();
$control_Type["params"]["field"]="Type";
$control_Type["params"]["value"]=@$data["Type"];

$control_Type["params"]["id"]=$record_id;
if($inlineedit)
	$control_Type["params"]["mode"]="inline_edit";
else
	$control_Type["params"]["mode"]="edit";
$xt->assignbyref("Type_editcontrol",$control_Type);

//0
$control_SpeciesID=array();
$control_SpeciesID["func"]="xt_buildeditcontrol";
$control_SpeciesID["params"] = array();
$control_SpeciesID["params"]["field"]="SpeciesID";
$control_SpeciesID["params"]["value"]=@$data["SpeciesID"];

$control_SpeciesID["params"]["id"]=$record_id;
if($inlineedit)
	$control_SpeciesID["params"]["mode"]="inline_edit";
else
	$control_SpeciesID["params"]["mode"]="edit";
$xt->assignbyref("SpeciesID_editcontrol",$control_SpeciesID);

//0
$control_Species_Name=array();
$control_Species_Name["func"]="xt_buildeditcontrol";
$control_Species_Name["params"] = array();
$control_Species_Name["params"]["field"]="Species Name";
$control_Species_Name["params"]["value"]=@$data["Species Name"];

$control_Species_Name["params"]["id"]=$record_id;
if($inlineedit)
	$control_Species_Name["params"]["mode"]="inline_edit";
else
	$control_Species_Name["params"]["mode"]="edit";
$xt->assignbyref("Species_Name_editcontrol",$control_Species_Name);

//0
$control_Common_Name=array();
$control_Common_Name["func"]="xt_buildeditcontrol";
$control_Common_Name["params"] = array();
$control_Common_Name["params"]["field"]="Common Name";
$control_Common_Name["params"]["value"]=@$data["Common Name"];

$control_Common_Name["params"]["id"]=$record_id;
if($inlineedit)
	$control_Common_Name["params"]["mode"]="inline_edit";
else
	$control_Common_Name["params"]["mode"]="edit";
$xt->assignbyref("Common_Name_editcontrol",$control_Common_Name);

//0
$control_Hybrid=array();
$control_Hybrid["func"]="xt_buildeditcontrol";
$control_Hybrid["params"] = array();
$control_Hybrid["params"]["field"]="Hybrid";
$control_Hybrid["params"]["value"]=@$data["Hybrid"];

$control_Hybrid["params"]["id"]=$record_id;
if($inlineedit)
	$control_Hybrid["params"]["mode"]="inline_edit";
else
	$control_Hybrid["params"]["mode"]="edit";
$xt->assignbyref("Hybrid_editcontrol",$control_Hybrid);

//0
$control_Variety=array();
$control_Variety["func"]="xt_buildeditcontrol";
$control_Variety["params"] = array();
$control_Variety["params"]["field"]="Variety";
$control_Variety["params"]["value"]=@$data["Variety"];

$control_Variety["params"]["id"]=$record_id;
if($inlineedit)
	$control_Variety["params"]["mode"]="inline_edit";
else
	$control_Variety["params"]["mode"]="edit";
$xt->assignbyref("Variety_editcontrol",$control_Variety);

//0
$control_Family=array();
$control_Family["func"]="xt_buildeditcontrol";
$control_Family["params"] = array();
$control_Family["params"]["field"]="Family";
$control_Family["params"]["value"]=@$data["Family"];

$control_Family["params"]["id"]=$record_id;
if($inlineedit)
	$control_Family["params"]["mode"]="inline_edit";
else
	$control_Family["params"]["mode"]="edit";
$xt->assignbyref("Family_editcontrol",$control_Family);

//0
$control_Group=array();
$control_Group["func"]="xt_buildeditcontrol";
$control_Group["params"] = array();
$control_Group["params"]["field"]="Group";
$control_Group["params"]["value"]=@$data["Group"];

$control_Group["params"]["id"]=$record_id;
if($inlineedit)
	$control_Group["params"]["mode"]="inline_edit";
else
	$control_Group["params"]["mode"]="edit";
$xt->assignbyref("Group_editcontrol",$control_Group);

//0
$control_Genus=array();
$control_Genus["func"]="xt_buildeditcontrol";
$control_Genus["params"] = array();
$control_Genus["params"]["field"]="Genus";
$control_Genus["params"]["value"]=@$data["Genus"];

$control_Genus["params"]["id"]=$record_id;
if($inlineedit)
	$control_Genus["params"]["mode"]="inline_edit";
else
	$control_Genus["params"]["mode"]="edit";
$xt->assignbyref("Genus_editcontrol",$control_Genus);

//0
$control_Environment=array();
$control_Environment["func"]="xt_buildeditcontrol";
$control_Environment["params"] = array();
$control_Environment["params"]["field"]="Environment";
$control_Environment["params"]["value"]=@$data["Environment"];

$control_Environment["params"]["id"]=$record_id;
if($inlineedit)
	$control_Environment["params"]["mode"]="inline_edit";
else
	$control_Environment["params"]["mode"]="edit";
$xt->assignbyref("Environment_editcontrol",$control_Environment);

//0
$control_Habit=array();
$control_Habit["func"]="xt_buildeditcontrol";
$control_Habit["params"] = array();
$control_Habit["params"]["field"]="Habit";
$control_Habit["params"]["value"]=@$data["Habit"];

$control_Habit["params"]["id"]=$record_id;
if($inlineedit)
	$control_Habit["params"]["mode"]="inline_edit";
else
	$control_Habit["params"]["mode"]="edit";
$xt->assignbyref("Habit_editcontrol",$control_Habit);

//0
$control_Country=array();
$control_Country["func"]="xt_buildeditcontrol";
$control_Country["params"] = array();
$control_Country["params"]["field"]="Country";
$control_Country["params"]["value"]=@$data["Country"];

$control_Country["params"]["id"]=$record_id;
if($inlineedit)
	$control_Country["params"]["mode"]="inline_edit";
else
	$control_Country["params"]["mode"]="edit";
$xt->assignbyref("Country_editcontrol",$control_Country);

//0
$control_Species_Year=array();
$control_Species_Year["func"]="xt_buildeditcontrol";
$control_Species_Year["params"] = array();
$control_Species_Year["params"]["field"]="Species Year";
$control_Species_Year["params"]["value"]=@$data["Species Year"];

$control_Species_Year["params"]["id"]=$record_id;
if($inlineedit)
	$control_Species_Year["params"]["mode"]="inline_edit";
else
	$control_Species_Year["params"]["mode"]="edit";
$xt->assignbyref("Species_Year_editcontrol",$control_Species_Year);


PrepareJSCode($jscode,$record_id);
	
if($inlineedit)
{
	$jscode = str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$jscode);
	$xt->assignbyref("linkdata",$jscode);
}
else{
	$body["end"]="</form><script>".$jscode."</script>";	
	$xt->assignbyref("body",$body);
}

/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if(function_exists("BeforeShowEdit"))
	BeforeShowEdit($xt,$templatefile);
	
$xt->display($templatefile);

?>
