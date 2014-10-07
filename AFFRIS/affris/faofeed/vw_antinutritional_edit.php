<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_antinutritional_variables.php");


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
$templatefile = "vw_antinutritional_edit.htm";


include('include/xtempl.php');
$xt = new Xtempl();



//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$keys["IngredientID"]=postvalue("editid1");

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
	$value = postvalue("value_IngredientID");
	$type=postvalue("type_IngredientID");
	if(FieldSubmitted("IngredientID"))
	{
		$value=prepare_for_db("IngredientID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IngredientID"]=$value;
	}

//	update key value
	if($value!==false)
		$keys["IngredientID"]=$value;

//	processibng IngredientID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_IName");
	$type=postvalue("type_IName");
	if(FieldSubmitted("IName"))
	{
		$value=prepare_for_db("IName",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IName"]=$value;
	}


//	processibng IName - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Description");
	$type=postvalue("type_Description");
	if(FieldSubmitted("Description"))
	{
		$value=prepare_for_db("Description",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Description"]=$value;
	}


//	processibng Description - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_AntiID");
	$type=postvalue("type_AntiID");
	if(FieldSubmitted("AntiID"))
	{
		$value=prepare_for_db("AntiID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["AntiID"]=$value;
	}


//	processibng AntiID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_AntiFactor");
	$type=postvalue("type_AntiFactor");
	if(FieldSubmitted("AntiFactor"))
	{
		$value=prepare_for_db("AntiFactor",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["AntiFactor"]=$value;
	}


//	processibng AntiFactor - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_ToxicLevel");
	$type=postvalue("type_ToxicLevel");
	if(FieldSubmitted("ToxicLevel"))
	{
		$value=prepare_for_db("ToxicLevel",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["ToxicLevel"]=$value;
	}


//	processibng ToxicLevel - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_TreatmentID");
	$type=postvalue("type_TreatmentID");
	if(FieldSubmitted("TreatmentID"))
	{
		$value=prepare_for_db("TreatmentID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["TreatmentID"]=$value;
	}


//	processibng TreatmentID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Treatment");
	$type=postvalue("type_Treatment");
	if(FieldSubmitted("Treatment"))
	{
		$value=prepare_for_db("Treatment",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Treatment"]=$value;
	}


//	processibng Treatment - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_IDSourceID");
	$type=postvalue("type_IDSourceID");
	if(FieldSubmitted("IDSourceID"))
	{
		$value=prepare_for_db("IDSourceID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IDSourceID"]=$value;
	}


//	processibng IDSourceID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_DataSource");
	$type=postvalue("type_DataSource");
	if(FieldSubmitted("DataSource"))
	{
		$value=prepare_for_db("DataSource",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["DataSource"]=$value;
	}


//	processibng DataSource - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_PartUsedID");
	$type=postvalue("type_PartUsedID");
	if(FieldSubmitted("PartUsedID"))
	{
		$value=prepare_for_db("PartUsedID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["PartUsedID"]=$value;
	}


//	processibng PartUsedID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_PartUsed");
	$type=postvalue("type_PartUsed");
	if(FieldSubmitted("PartUsed"))
	{
		$value=prepare_for_db("PartUsed",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["PartUsed"]=$value;
	}


//	processibng PartUsed - end
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
		$keyGetQ.="editid1=".rawurldecode($keys["IngredientID"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: vw_antinutritional_".$pageName."?".$keyGetQ);
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
		header("Location: vw_antinutritional_list.php?a=return");
		exit();
	}
	else
		$data=array();
}

$readonlyfields=array();


if($readevalues)
{
	$data["IngredientID"]=$evalues["IngredientID"];
	$data["IName"]=$evalues["IName"];
	$data["Description"]=$evalues["Description"];
	$data["AntiID"]=$evalues["AntiID"];
	$data["AntiFactor"]=$evalues["AntiFactor"];
	$data["ToxicLevel"]=$evalues["ToxicLevel"];
	$data["TreatmentID"]=$evalues["TreatmentID"];
	$data["Treatment"]=$evalues["Treatment"];
	$data["IDSourceID"]=$evalues["IDSourceID"];
	$data["DataSource"]=$evalues["DataSource"];
	$data["PartUsedID"]=$evalues["PartUsedID"];
	$data["PartUsed"]=$evalues["PartUsed"];
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
//	validate field - IngredientID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IngredientID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - AntiID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "AntiID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - TreatmentID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "TreatmentID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - IDSourceID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "IDSourceID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
						   4 => $lookup, 5 => $regex, 6 => $regexmessage, 7 => $regextype);
//	validate field - PartUsedID
	$validatetype="IsNumeric";
	$second_validatetype="";
	$strRTE='';
	$lookup='';	
	$arrValidate[] = array(0 => "PartUsedID", 1 => $validatetype, 2 => $second_validatetype, 3 => $strRTE,
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
	
	
	
	$jscode.="SUGGEST_TABLE='vw_antinutritional_searchsuggest.php';\r\n";
	$includes.="<div id=\"search_suggest\"></div>\r\n";

	$xt->assign("IngredientID_fieldblock",true);
	$xt->assign("IName_fieldblock",true);
	$xt->assign("Description_fieldblock",true);
	$xt->assign("AntiID_fieldblock",true);
	$xt->assign("AntiFactor_fieldblock",true);
	$xt->assign("ToxicLevel_fieldblock",true);
	$xt->assign("TreatmentID_fieldblock",true);
	$xt->assign("Treatment_fieldblock",true);
	$xt->assign("IDSourceID_fieldblock",true);
	$xt->assign("DataSource_fieldblock",true);
	$xt->assign("PartUsedID_fieldblock",true);
	$xt->assign("PartUsed_fieldblock",true);

	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$body["begin"]=$includes."
	<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_antinutritional_edit.php\" ".$onsubmit.">".
	"<input type=hidden name=\"a\" value=\"edited\">";
	$body["begin"].="<input type=\"hidden\" name=\"editid1\" value=\"".htmlspecialchars($keys["IngredientID"])."\">";
	$xt->assign("show_key1", htmlspecialchars(GetData($data,"IngredientID", "")));

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
	if(GetFieldIndex("IngredientID"))
		$key[]=GetFieldIndex("IngredientID");
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
				$next[1]=$row_next["IngredientID"];
		
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
				$prev[1]=$row_prev["IngredientID"];
		}
	}
}
	$nextlink=$prevlink="";$resetlink="";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_antinutritional_edit.php?".$nextlink."'\"");
		$resetlink.="$('#next').attr('style','');$('#next').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_antinutritional_edit.php?".$prevlink."'\"");
		$resetlink.="$('#prev').attr('style','');$('#prev').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs","onclick=\"flag_but=0; resetEditors(); ".$resetlink."\"");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_antinutritional_list.php?a=return'\"");
	$xt->assign("save_button",true);
	$xt->assign("reset_button",true);
	$xt->assign("back_button",true);
}

$showKeys[] = rawurlencode($keys["IngredientID"]);

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
$control_IngredientID=array();
$control_IngredientID["func"]="xt_buildeditcontrol";
$control_IngredientID["params"] = array();
$control_IngredientID["params"]["field"]="IngredientID";
$control_IngredientID["params"]["value"]=@$data["IngredientID"];

$control_IngredientID["params"]["id"]=$record_id;
if($inlineedit)
	$control_IngredientID["params"]["mode"]="inline_edit";
else
	$control_IngredientID["params"]["mode"]="edit";
$xt->assignbyref("IngredientID_editcontrol",$control_IngredientID);

//0
$control_IName=array();
$control_IName["func"]="xt_buildeditcontrol";
$control_IName["params"] = array();
$control_IName["params"]["field"]="IName";
$control_IName["params"]["value"]=@$data["IName"];

$control_IName["params"]["id"]=$record_id;
if($inlineedit)
	$control_IName["params"]["mode"]="inline_edit";
else
	$control_IName["params"]["mode"]="edit";
$xt->assignbyref("IName_editcontrol",$control_IName);

//0
$control_Description=array();
$control_Description["func"]="xt_buildeditcontrol";
$control_Description["params"] = array();
$control_Description["params"]["field"]="Description";
$control_Description["params"]["value"]=@$data["Description"];

$control_Description["params"]["id"]=$record_id;
if($inlineedit)
	$control_Description["params"]["mode"]="inline_edit";
else
	$control_Description["params"]["mode"]="edit";
$xt->assignbyref("Description_editcontrol",$control_Description);

//0
$control_AntiID=array();
$control_AntiID["func"]="xt_buildeditcontrol";
$control_AntiID["params"] = array();
$control_AntiID["params"]["field"]="AntiID";
$control_AntiID["params"]["value"]=@$data["AntiID"];

$control_AntiID["params"]["id"]=$record_id;
if($inlineedit)
	$control_AntiID["params"]["mode"]="inline_edit";
else
	$control_AntiID["params"]["mode"]="edit";
$xt->assignbyref("AntiID_editcontrol",$control_AntiID);

//0
$control_AntiFactor=array();
$control_AntiFactor["func"]="xt_buildeditcontrol";
$control_AntiFactor["params"] = array();
$control_AntiFactor["params"]["field"]="AntiFactor";
$control_AntiFactor["params"]["value"]=@$data["AntiFactor"];

$control_AntiFactor["params"]["id"]=$record_id;
if($inlineedit)
	$control_AntiFactor["params"]["mode"]="inline_edit";
else
	$control_AntiFactor["params"]["mode"]="edit";
$xt->assignbyref("AntiFactor_editcontrol",$control_AntiFactor);

//0
$control_ToxicLevel=array();
$control_ToxicLevel["func"]="xt_buildeditcontrol";
$control_ToxicLevel["params"] = array();
$control_ToxicLevel["params"]["field"]="ToxicLevel";
$control_ToxicLevel["params"]["value"]=@$data["ToxicLevel"];

$control_ToxicLevel["params"]["id"]=$record_id;
if($inlineedit)
	$control_ToxicLevel["params"]["mode"]="inline_edit";
else
	$control_ToxicLevel["params"]["mode"]="edit";
$xt->assignbyref("ToxicLevel_editcontrol",$control_ToxicLevel);

//0
$control_TreatmentID=array();
$control_TreatmentID["func"]="xt_buildeditcontrol";
$control_TreatmentID["params"] = array();
$control_TreatmentID["params"]["field"]="TreatmentID";
$control_TreatmentID["params"]["value"]=@$data["TreatmentID"];

$control_TreatmentID["params"]["id"]=$record_id;
if($inlineedit)
	$control_TreatmentID["params"]["mode"]="inline_edit";
else
	$control_TreatmentID["params"]["mode"]="edit";
$xt->assignbyref("TreatmentID_editcontrol",$control_TreatmentID);

//0
$control_Treatment=array();
$control_Treatment["func"]="xt_buildeditcontrol";
$control_Treatment["params"] = array();
$control_Treatment["params"]["field"]="Treatment";
$control_Treatment["params"]["value"]=@$data["Treatment"];

$control_Treatment["params"]["id"]=$record_id;
if($inlineedit)
	$control_Treatment["params"]["mode"]="inline_edit";
else
	$control_Treatment["params"]["mode"]="edit";
$xt->assignbyref("Treatment_editcontrol",$control_Treatment);

//0
$control_IDSourceID=array();
$control_IDSourceID["func"]="xt_buildeditcontrol";
$control_IDSourceID["params"] = array();
$control_IDSourceID["params"]["field"]="IDSourceID";
$control_IDSourceID["params"]["value"]=@$data["IDSourceID"];

$control_IDSourceID["params"]["id"]=$record_id;
if($inlineedit)
	$control_IDSourceID["params"]["mode"]="inline_edit";
else
	$control_IDSourceID["params"]["mode"]="edit";
$xt->assignbyref("IDSourceID_editcontrol",$control_IDSourceID);

//0
$control_DataSource=array();
$control_DataSource["func"]="xt_buildeditcontrol";
$control_DataSource["params"] = array();
$control_DataSource["params"]["field"]="DataSource";
$control_DataSource["params"]["value"]=@$data["DataSource"];

$control_DataSource["params"]["id"]=$record_id;
if($inlineedit)
	$control_DataSource["params"]["mode"]="inline_edit";
else
	$control_DataSource["params"]["mode"]="edit";
$xt->assignbyref("DataSource_editcontrol",$control_DataSource);

//0
$control_PartUsedID=array();
$control_PartUsedID["func"]="xt_buildeditcontrol";
$control_PartUsedID["params"] = array();
$control_PartUsedID["params"]["field"]="PartUsedID";
$control_PartUsedID["params"]["value"]=@$data["PartUsedID"];

$control_PartUsedID["params"]["id"]=$record_id;
if($inlineedit)
	$control_PartUsedID["params"]["mode"]="inline_edit";
else
	$control_PartUsedID["params"]["mode"]="edit";
$xt->assignbyref("PartUsedID_editcontrol",$control_PartUsedID);

//0
$control_PartUsed=array();
$control_PartUsed["func"]="xt_buildeditcontrol";
$control_PartUsed["params"] = array();
$control_PartUsed["params"]["field"]="PartUsed";
$control_PartUsed["params"]["value"]=@$data["PartUsed"];

$control_PartUsed["params"]["id"]=$record_id;
if($inlineedit)
	$control_PartUsed["params"]["mode"]="inline_edit";
else
	$control_PartUsed["params"]["mode"]="edit";
$xt->assignbyref("PartUsed_editcontrol",$control_PartUsed);


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
