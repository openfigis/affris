<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_feed_variables.php");


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
$templatefile = "vw_feed_edit.htm";


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
	$value = postvalue("value_FName");
	$type=postvalue("type_FName");
	if(FieldSubmitted("FName"))
	{
		$value=prepare_for_db("FName",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FName"]=$value;
	}


//	processibng FName - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_BrandName");
	$type=postvalue("type_BrandName");
	if(FieldSubmitted("BrandName"))
	{
		$value=prepare_for_db("BrandName",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["BrandName"]=$value;
	}


//	processibng BrandName - end
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
	$value = postvalue("value_FeedYear");
	$type=postvalue("type_FeedYear");
	if(FieldSubmitted("FeedYear"))
	{
		$value=prepare_for_db("FeedYear",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FeedYear"]=$value;
	}


//	processibng FeedYear - end
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
	$value = postvalue("value_CountryOrigin");
	$type=postvalue("type_CountryOrigin");
	if(FieldSubmitted("CountryOrigin"))
	{
		$value=prepare_for_db("CountryOrigin",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["CountryOrigin"]=$value;
	}


//	processibng CountryOrigin - end
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
	$value = postvalue("value_FisDetail");
	$type=postvalue("type_FisDetail");
	if(FieldSubmitted("FisDetail"))
	{
		$value=prepare_for_db("FisDetail",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FisDetail"]=$value;
	}


//	processibng FisDetail - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_FDataSource");
	$type=postvalue("type_FDataSource");
	if(FieldSubmitted("FDataSource"))
	{
		$value=prepare_for_db("FDataSource",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FDataSource"]=$value;
	}


//	processibng FDataSource - end
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
	$value = postvalue("value_FeedType");
	$type=postvalue("type_FeedType");
	if(FieldSubmitted("FeedType"))
	{
		$value=prepare_for_db("FeedType",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["FeedType"]=$value;
	}


//	processibng FeedType - end
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
	header("Location: vw_feed_".$pageName."?".$keyGetQ);
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
		header("Location: vw_feed_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["FeedID"]=$evalues["FeedID"];
	$data["FName"]=$evalues["FName"];
	$data["BrandName"]=$evalues["BrandName"];
	$data["Technology"]=$evalues["Technology"];
	$data["FeedYear"]=$evalues["FeedYear"];
	$data["Stage"]=$evalues["Stage"];
	$data["FCountryID"]=$evalues["FCountryID"];
	$data["CountryOrigin"]=$evalues["CountryOrigin"];
	$data["FIDSourceID"]=$evalues["FIDSourceID"];
	$data["FisDetail"]=$evalues["FisDetail"];
	$data["FDataSource"]=$evalues["FDataSource"];
	$data["FeedTypeID"]=$evalues["FeedTypeID"];
	$data["FeedType"]=$evalues["FeedType"];
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
	
	
	
	$jscode.="SUGGEST_TABLE='vw_feed_searchsuggest.php';\r\n";
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

	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$body["begin"]=$includes."
	<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_feed_edit.php\" ".$onsubmit.">".
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
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_feed_edit.php?".$nextlink."'\"");
		$resetlink.="$('#next').attr('style','');$('#next').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_feed_edit.php?".$prevlink."'\"");
		$resetlink.="$('#prev').attr('style','');$('#prev').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs","onclick=\"flag_but=0; resetEditors(); ".$resetlink."\"");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_feed_list.php?a=return'\"");
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
$control_FName=array();
$control_FName["func"]="xt_buildeditcontrol";
$control_FName["params"] = array();
$control_FName["params"]["field"]="FName";
$control_FName["params"]["value"]=@$data["FName"];

$control_FName["params"]["id"]=$record_id;
if($inlineedit)
	$control_FName["params"]["mode"]="inline_edit";
else
	$control_FName["params"]["mode"]="edit";
$xt->assignbyref("FName_editcontrol",$control_FName);

//0
$control_BrandName=array();
$control_BrandName["func"]="xt_buildeditcontrol";
$control_BrandName["params"] = array();
$control_BrandName["params"]["field"]="BrandName";
$control_BrandName["params"]["value"]=@$data["BrandName"];

$control_BrandName["params"]["id"]=$record_id;
if($inlineedit)
	$control_BrandName["params"]["mode"]="inline_edit";
else
	$control_BrandName["params"]["mode"]="edit";
$xt->assignbyref("BrandName_editcontrol",$control_BrandName);

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
$control_FeedYear=array();
$control_FeedYear["func"]="xt_buildeditcontrol";
$control_FeedYear["params"] = array();
$control_FeedYear["params"]["field"]="FeedYear";
$control_FeedYear["params"]["value"]=@$data["FeedYear"];

$control_FeedYear["params"]["id"]=$record_id;
if($inlineedit)
	$control_FeedYear["params"]["mode"]="inline_edit";
else
	$control_FeedYear["params"]["mode"]="edit";
$xt->assignbyref("FeedYear_editcontrol",$control_FeedYear);

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
$control_CountryOrigin=array();
$control_CountryOrigin["func"]="xt_buildeditcontrol";
$control_CountryOrigin["params"] = array();
$control_CountryOrigin["params"]["field"]="CountryOrigin";
$control_CountryOrigin["params"]["value"]=@$data["CountryOrigin"];

$control_CountryOrigin["params"]["id"]=$record_id;
if($inlineedit)
	$control_CountryOrigin["params"]["mode"]="inline_edit";
else
	$control_CountryOrigin["params"]["mode"]="edit";
$xt->assignbyref("CountryOrigin_editcontrol",$control_CountryOrigin);

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
$control_FisDetail=array();
$control_FisDetail["func"]="xt_buildeditcontrol";
$control_FisDetail["params"] = array();
$control_FisDetail["params"]["field"]="FisDetail";
$control_FisDetail["params"]["value"]=@$data["FisDetail"];

$control_FisDetail["params"]["id"]=$record_id;
if($inlineedit)
	$control_FisDetail["params"]["mode"]="inline_edit";
else
	$control_FisDetail["params"]["mode"]="edit";
$xt->assignbyref("FisDetail_editcontrol",$control_FisDetail);

//0
$control_FDataSource=array();
$control_FDataSource["func"]="xt_buildeditcontrol";
$control_FDataSource["params"] = array();
$control_FDataSource["params"]["field"]="FDataSource";
$control_FDataSource["params"]["value"]=@$data["FDataSource"];

$control_FDataSource["params"]["id"]=$record_id;
if($inlineedit)
	$control_FDataSource["params"]["mode"]="inline_edit";
else
	$control_FDataSource["params"]["mode"]="edit";
$xt->assignbyref("FDataSource_editcontrol",$control_FDataSource);

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
$control_FeedType=array();
$control_FeedType["func"]="xt_buildeditcontrol";
$control_FeedType["params"] = array();
$control_FeedType["params"]["field"]="FeedType";
$control_FeedType["params"]["value"]=@$data["FeedType"];

$control_FeedType["params"]["id"]=$record_id;
if($inlineedit)
	$control_FeedType["params"]["mode"]="inline_edit";
else
	$control_FeedType["params"]["mode"]="edit";
$xt->assignbyref("FeedType_editcontrol",$control_FeedType);


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
