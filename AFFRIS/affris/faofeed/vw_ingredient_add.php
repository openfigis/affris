<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_ingredient_variables.php");


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
	$templatefile = "vw_ingredient_inline_add.htm";
else
	$templatefile = "vw_ingredient_add.htm";

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
//	processing IngredientID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IngredientID");
	$type=postvalue("type_IngredientID");
	if (FieldSubmitted("IngredientID"))
	{
		$value=prepare_for_db("IngredientID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IngredientID";
		$avalues["IngredientID"]=$value;
	}
	}
//	processibng IngredientID - end
//	processing IName - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IName");
	$type=postvalue("type_IName");
	if (FieldSubmitted("IName"))
	{
		$value=prepare_for_db("IName",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IName";
		$avalues["IName"]=$value;
	}
	}
//	processibng IName - end
//	processing IfeedNo - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IfeedNo");
	$type=postvalue("type_IfeedNo");
	if (FieldSubmitted("IfeedNo"))
	{
		$value=prepare_for_db("IfeedNo",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IfeedNo";
		$avalues["IfeedNo"]=$value;
	}
	}
//	processibng IfeedNo - end
//	processing Description1 - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Description1");
	$type=postvalue("type_Description1");
	if (FieldSubmitted("Description1"))
	{
		$value=prepare_for_db("Description1",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Description1";
		$avalues["Description1"]=$value;
	}
	}
//	processibng Description1 - end
//	processing Description2 - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Description2");
	$type=postvalue("type_Description2");
	if (FieldSubmitted("Description2"))
	{
		$value=prepare_for_db("Description2",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Description2";
		$avalues["Description2"]=$value;
	}
	}
//	processibng Description2 - end
//	processing Description3 - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Description3");
	$type=postvalue("type_Description3");
	if (FieldSubmitted("Description3"))
	{
		$value=prepare_for_db("Description3",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Description3";
		$avalues["Description3"]=$value;
	}
	}
//	processibng Description3 - end
//	processing IisDetail - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IisDetail");
	$type=postvalue("type_IisDetail");
	if (FieldSubmitted("IisDetail"))
	{
		$value=prepare_for_db("IisDetail",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IisDetail";
		$avalues["IisDetail"]=$value;
	}
	}
//	processibng IisDetail - end
//	processing IDSourceID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IDSourceID");
	$type=postvalue("type_IDSourceID");
	if (FieldSubmitted("IDSourceID"))
	{
		$value=prepare_for_db("IDSourceID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IDSourceID";
		$avalues["IDSourceID"]=$value;
	}
	}
//	processibng IDSourceID - end
//	processing DataSource - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_DataSource");
	$type=postvalue("type_DataSource");
	if (FieldSubmitted("DataSource"))
	{
		$value=prepare_for_db("DataSource",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="DataSource";
		$avalues["DataSource"]=$value;
	}
	}
//	processibng DataSource - end
//	processing CountryID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_CountryID");
	$type=postvalue("type_CountryID");
	if (FieldSubmitted("CountryID"))
	{
		$value=prepare_for_db("CountryID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="CountryID";
		$avalues["CountryID"]=$value;
	}
	}
//	processibng CountryID - end
//	processing ICountry - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_ICountry");
	$type=postvalue("type_ICountry");
	if (FieldSubmitted("ICountry"))
	{
		$value=prepare_for_db("ICountry",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="ICountry";
		$avalues["ICountry"]=$value;
	}
	}
//	processibng ICountry - end
//	processing IngredientSpecID - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_IngredientSpecID");
	$type=postvalue("type_IngredientSpecID");
	if (FieldSubmitted("IngredientSpecID"))
	{
		$value=prepare_for_db("IngredientSpecID",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="IngredientSpecID";
		$avalues["IngredientSpecID"]=$value;
	}
	}
//	processibng IngredientSpecID - end
//	processing Species - start
    
	$inlineEditOption = true;
	$inlineEditOption = $inlineedit!=ADD_INLINE;
	if($inlineEditOption)
	{
	$value = postvalue("value_Species");
	$type=postvalue("type_Species");
	if (FieldSubmitted("Species"))
	{
		$value=prepare_for_db("Species",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$blobfields[]="Species";
		$avalues["Species"]=$value;
	}
	}
//	processibng Species - end




//	insert masterkey value if exists and if not specified
	if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedingredient")
	{
		$avalues["IngredientID"]=prepare_for_db("IngredientID",$_SESSION[$strTableName."_masterkey1"]);
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
	header("Location: vw_ingredient_".$pageName);
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
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else
{
}

//	set default values for the foreign keys
if(@$_SESSION[$strTableName."_mastertable"]=="vw_feedingredient")
{
	$defvalues["IngredientID"]=@$_SESSION[$strTableName."_masterkey1"];
}



if($readavalues)
{
	$defvalues["IngredientID"]=@$avalues["IngredientID"];
	$defvalues["IName"]=@$avalues["IName"];
	$defvalues["IfeedNo"]=@$avalues["IfeedNo"];
	$defvalues["Description1"]=@$avalues["Description1"];
	$defvalues["Description2"]=@$avalues["Description2"];
	$defvalues["Description3"]=@$avalues["Description3"];
	$defvalues["IisDetail"]=@$avalues["IisDetail"];
	$defvalues["IDSourceID"]=@$avalues["IDSourceID"];
	$defvalues["DataSource"]=@$avalues["DataSource"];
	$defvalues["CountryID"]=@$avalues["CountryID"];
	$defvalues["ICountry"]=@$avalues["ICountry"];
	$defvalues["IngredientSpecID"]=@$avalues["IngredientSpecID"];
	$defvalues["Species"]=@$avalues["Species"];
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
//	validate field - IngredientID
	$validatetype="IsNumeric";
	$second_validatetype="IsRequired";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IngredientID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - IisDetail
	$validatetype="";
		$second_validatetype="IsRequired";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IisDetail", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - IDSourceID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IDSourceID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - CountryID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "CountryID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - IngredientSpecID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IngredientSpecID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
	
	$jscode.="SUGGEST_TABLE='vw_ingredient_searchsuggest.php';\r\n";
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<div id=\"search_suggest\"></div>\r\n";
	

	$xt->assign("IngredientID_fieldblock",true);
	$xt->assign("IName_fieldblock",true);
	$xt->assign("IfeedNo_fieldblock",true);
	$xt->assign("Description1_fieldblock",true);
	$xt->assign("Description2_fieldblock",true);
	$xt->assign("Description3_fieldblock",true);
	$xt->assign("IisDetail_fieldblock",true);
	$xt->assign("IDSourceID_fieldblock",true);
	$xt->assign("DataSource_fieldblock",true);
	$xt->assign("CountryID_fieldblock",true);
	$xt->assign("ICountry_fieldblock",true);
	$xt->assign("IngredientSpecID_fieldblock",true);
	$xt->assign("Species_fieldblock",true);
	
	$formname="editform";
	if($onsubmit)
		$onsubmit="onsubmit=\"".$onsubmit."\"";
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$body["begin"]=$includes.
		"<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_ingredient_add.php\" ".$onsubmit.">".
		"<input type=hidden name=\"a\" value=\"added\">";
		$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_ingredient_list.php?a=return'\"");
		$xt->assign("back_button",true);
	}
	else
	{
		$formname="editform".$id;
		$body["begin"]="<form name=\"editform".$id."\" id=\"editform".$id."\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_ingredient_add.php\" ".$onsubmit." target=\"flyframe".$id."\">".
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



$control_IngredientID=array();
$control_IngredientID["func"]="xt_buildeditcontrol";
$control_IngredientID["params"] = array();
$control_IngredientID["params"]["field"]="IngredientID";
$control_IngredientID["params"]["value"]=@$defvalues["IngredientID"];
$control_IngredientID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IngredientID["params"]["mode"]="inline_add";
else
	$control_IngredientID["params"]["mode"]="add";
	
$xt->assignbyref("IngredientID_editcontrol",$control_IngredientID);


$control_IName=array();
$control_IName["func"]="xt_buildeditcontrol";
$control_IName["params"] = array();
$control_IName["params"]["field"]="IName";
$control_IName["params"]["value"]=@$defvalues["IName"];
$control_IName["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IName["params"]["mode"]="inline_add";
else
	$control_IName["params"]["mode"]="add";
	
$xt->assignbyref("IName_editcontrol",$control_IName);


$control_IfeedNo=array();
$control_IfeedNo["func"]="xt_buildeditcontrol";
$control_IfeedNo["params"] = array();
$control_IfeedNo["params"]["field"]="IfeedNo";
$control_IfeedNo["params"]["value"]=@$defvalues["IfeedNo"];
$control_IfeedNo["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IfeedNo["params"]["mode"]="inline_add";
else
	$control_IfeedNo["params"]["mode"]="add";
	
$xt->assignbyref("IfeedNo_editcontrol",$control_IfeedNo);


$control_Description1=array();
$control_Description1["func"]="xt_buildeditcontrol";
$control_Description1["params"] = array();
$control_Description1["params"]["field"]="Description1";
$control_Description1["params"]["value"]=@$defvalues["Description1"];
$control_Description1["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Description1["params"]["mode"]="inline_add";
else
	$control_Description1["params"]["mode"]="add";
	
$xt->assignbyref("Description1_editcontrol",$control_Description1);


$control_Description2=array();
$control_Description2["func"]="xt_buildeditcontrol";
$control_Description2["params"] = array();
$control_Description2["params"]["field"]="Description2";
$control_Description2["params"]["value"]=@$defvalues["Description2"];
$control_Description2["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Description2["params"]["mode"]="inline_add";
else
	$control_Description2["params"]["mode"]="add";
	
$xt->assignbyref("Description2_editcontrol",$control_Description2);


$control_Description3=array();
$control_Description3["func"]="xt_buildeditcontrol";
$control_Description3["params"] = array();
$control_Description3["params"]["field"]="Description3";
$control_Description3["params"]["value"]=@$defvalues["Description3"];
$control_Description3["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Description3["params"]["mode"]="inline_add";
else
	$control_Description3["params"]["mode"]="add";
	
$xt->assignbyref("Description3_editcontrol",$control_Description3);


$control_IisDetail=array();
$control_IisDetail["func"]="xt_buildeditcontrol";
$control_IisDetail["params"] = array();
$control_IisDetail["params"]["field"]="IisDetail";
$control_IisDetail["params"]["value"]=@$defvalues["IisDetail"];
$control_IisDetail["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IisDetail["params"]["mode"]="inline_add";
else
	$control_IisDetail["params"]["mode"]="add";
	
$xt->assignbyref("IisDetail_editcontrol",$control_IisDetail);


$control_IDSourceID=array();
$control_IDSourceID["func"]="xt_buildeditcontrol";
$control_IDSourceID["params"] = array();
$control_IDSourceID["params"]["field"]="IDSourceID";
$control_IDSourceID["params"]["value"]=@$defvalues["IDSourceID"];
$control_IDSourceID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IDSourceID["params"]["mode"]="inline_add";
else
	$control_IDSourceID["params"]["mode"]="add";
	
$xt->assignbyref("IDSourceID_editcontrol",$control_IDSourceID);


$control_DataSource=array();
$control_DataSource["func"]="xt_buildeditcontrol";
$control_DataSource["params"] = array();
$control_DataSource["params"]["field"]="DataSource";
$control_DataSource["params"]["value"]=@$defvalues["DataSource"];
$control_DataSource["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_DataSource["params"]["mode"]="inline_add";
else
	$control_DataSource["params"]["mode"]="add";
	
$xt->assignbyref("DataSource_editcontrol",$control_DataSource);


$control_CountryID=array();
$control_CountryID["func"]="xt_buildeditcontrol";
$control_CountryID["params"] = array();
$control_CountryID["params"]["field"]="CountryID";
$control_CountryID["params"]["value"]=@$defvalues["CountryID"];
$control_CountryID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_CountryID["params"]["mode"]="inline_add";
else
	$control_CountryID["params"]["mode"]="add";
	
$xt->assignbyref("CountryID_editcontrol",$control_CountryID);


$control_ICountry=array();
$control_ICountry["func"]="xt_buildeditcontrol";
$control_ICountry["params"] = array();
$control_ICountry["params"]["field"]="ICountry";
$control_ICountry["params"]["value"]=@$defvalues["ICountry"];
$control_ICountry["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_ICountry["params"]["mode"]="inline_add";
else
	$control_ICountry["params"]["mode"]="add";
	
$xt->assignbyref("ICountry_editcontrol",$control_ICountry);


$control_IngredientSpecID=array();
$control_IngredientSpecID["func"]="xt_buildeditcontrol";
$control_IngredientSpecID["params"] = array();
$control_IngredientSpecID["params"]["field"]="IngredientSpecID";
$control_IngredientSpecID["params"]["value"]=@$defvalues["IngredientSpecID"];
$control_IngredientSpecID["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_IngredientSpecID["params"]["mode"]="inline_add";
else
	$control_IngredientSpecID["params"]["mode"]="add";
	
$xt->assignbyref("IngredientSpecID_editcontrol",$control_IngredientSpecID);


$control_Species=array();
$control_Species["func"]="xt_buildeditcontrol";
$control_Species["params"] = array();
$control_Species["params"]["field"]="Species";
$control_Species["params"]["value"]=@$defvalues["Species"];
$control_Species["params"]["id"]=$record_id;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY)
	$control_Species["params"]["mode"]="inline_add";
else
	$control_Species["params"]["mode"]="add";
	
$xt->assignbyref("Species_editcontrol",$control_Species);

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