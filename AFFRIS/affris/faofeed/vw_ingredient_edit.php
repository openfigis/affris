<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_ingredient_variables.php");


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
$templatefile = "vw_ingredient_edit.htm";


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
	$value = postvalue("value_IfeedNo");
	$type=postvalue("type_IfeedNo");
	if(FieldSubmitted("IfeedNo"))
	{
		$value=prepare_for_db("IfeedNo",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IfeedNo"]=$value;
	}


//	processibng IfeedNo - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Description1");
	$type=postvalue("type_Description1");
	if(FieldSubmitted("Description1"))
	{
		$value=prepare_for_db("Description1",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Description1"]=$value;
	}


//	processibng Description1 - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Description2");
	$type=postvalue("type_Description2");
	if(FieldSubmitted("Description2"))
	{
		$value=prepare_for_db("Description2",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Description2"]=$value;
	}


//	processibng Description2 - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Description3");
	$type=postvalue("type_Description3");
	if(FieldSubmitted("Description3"))
	{
		$value=prepare_for_db("Description3",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Description3"]=$value;
	}


//	processibng Description3 - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_IisDetail");
	$type=postvalue("type_IisDetail");
	if(FieldSubmitted("IisDetail"))
	{
		$value=prepare_for_db("IisDetail",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IisDetail"]=$value;
	}


//	processibng IisDetail - end
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
	$value = postvalue("value_CountryID");
	$type=postvalue("type_CountryID");
	if(FieldSubmitted("CountryID"))
	{
		$value=prepare_for_db("CountryID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["CountryID"]=$value;
	}


//	processibng CountryID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_ICountry");
	$type=postvalue("type_ICountry");
	if(FieldSubmitted("ICountry"))
	{
		$value=prepare_for_db("ICountry",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["ICountry"]=$value;
	}


//	processibng ICountry - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_IngredientSpecID");
	$type=postvalue("type_IngredientSpecID");
	if(FieldSubmitted("IngredientSpecID"))
	{
		$value=prepare_for_db("IngredientSpecID",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["IngredientSpecID"]=$value;
	}


//	processibng IngredientSpecID - end
	}
	$condition = !$inlineedit;

	if($condition)
	{
	$value = postvalue("value_Species");
	$type=postvalue("type_Species");
	if(FieldSubmitted("Species"))
	{
		$value=prepare_for_db("Species",$value,$type);
	}
	else
		$value=false;
	if($value!==false)
	{	



		$evalues["Species"]=$value;
	}


//	processibng Species - end
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
	header("Location: vw_ingredient_".$pageName."?".$keyGetQ);
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
		header("Location: vw_ingredient_list.php?a=return");
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
	$data["IfeedNo"]=$evalues["IfeedNo"];
	$data["Description1"]=$evalues["Description1"];
	$data["Description2"]=$evalues["Description2"];
	$data["Description3"]=$evalues["Description3"];
	$data["IisDetail"]=$evalues["IisDetail"];
	$data["IDSourceID"]=$evalues["IDSourceID"];
	$data["DataSource"]=$evalues["DataSource"];
	$data["CountryID"]=$evalues["CountryID"];
	$data["ICountry"]=$evalues["ICountry"];
	$data["IngredientSpecID"]=$evalues["IngredientSpecID"];
	$data["Species"]=$evalues["Species"];
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
	
	
	
	$jscode.="SUGGEST_TABLE='vw_ingredient_searchsuggest.php';\r\n";
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

	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$body["begin"]=$includes."
	<form name=\"editform\" id=\"editform\" encType=\"multipart/form-data\" method=\"post\" action=\"vw_ingredient_edit.php\" ".$onsubmit.">".
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
		$xt->assign("nextbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_ingredient_edit.php?".$nextlink."'\"");
		$resetlink.="$('#next').attr('style','');$('#next').attr('disabled','');";
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","align=\"absmiddle\" onclick=\"window.location.href='vw_ingredient_edit.php?".$prevlink."'\"");
		$resetlink.="$('#prev').attr('style','');$('#prev').attr('disabled','');";
	}
	else 
		$xt->assign("prev_button",false);
	$xt->assign("resetbutton_attrs","onclick=\"flag_but=0; resetEditors(); ".$resetlink."\"");

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_ingredient_list.php?a=return'\"");
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
$control_IfeedNo=array();
$control_IfeedNo["func"]="xt_buildeditcontrol";
$control_IfeedNo["params"] = array();
$control_IfeedNo["params"]["field"]="IfeedNo";
$control_IfeedNo["params"]["value"]=@$data["IfeedNo"];

$control_IfeedNo["params"]["id"]=$record_id;
if($inlineedit)
	$control_IfeedNo["params"]["mode"]="inline_edit";
else
	$control_IfeedNo["params"]["mode"]="edit";
$xt->assignbyref("IfeedNo_editcontrol",$control_IfeedNo);

//0
$control_Description1=array();
$control_Description1["func"]="xt_buildeditcontrol";
$control_Description1["params"] = array();
$control_Description1["params"]["field"]="Description1";
$control_Description1["params"]["value"]=@$data["Description1"];

$control_Description1["params"]["id"]=$record_id;
if($inlineedit)
	$control_Description1["params"]["mode"]="inline_edit";
else
	$control_Description1["params"]["mode"]="edit";
$xt->assignbyref("Description1_editcontrol",$control_Description1);

//0
$control_Description2=array();
$control_Description2["func"]="xt_buildeditcontrol";
$control_Description2["params"] = array();
$control_Description2["params"]["field"]="Description2";
$control_Description2["params"]["value"]=@$data["Description2"];

$control_Description2["params"]["id"]=$record_id;
if($inlineedit)
	$control_Description2["params"]["mode"]="inline_edit";
else
	$control_Description2["params"]["mode"]="edit";
$xt->assignbyref("Description2_editcontrol",$control_Description2);

//0
$control_Description3=array();
$control_Description3["func"]="xt_buildeditcontrol";
$control_Description3["params"] = array();
$control_Description3["params"]["field"]="Description3";
$control_Description3["params"]["value"]=@$data["Description3"];

$control_Description3["params"]["id"]=$record_id;
if($inlineedit)
	$control_Description3["params"]["mode"]="inline_edit";
else
	$control_Description3["params"]["mode"]="edit";
$xt->assignbyref("Description3_editcontrol",$control_Description3);

//0
$control_IisDetail=array();
$control_IisDetail["func"]="xt_buildeditcontrol";
$control_IisDetail["params"] = array();
$control_IisDetail["params"]["field"]="IisDetail";
$control_IisDetail["params"]["value"]=@$data["IisDetail"];

$control_IisDetail["params"]["id"]=$record_id;
if($inlineedit)
	$control_IisDetail["params"]["mode"]="inline_edit";
else
	$control_IisDetail["params"]["mode"]="edit";
$xt->assignbyref("IisDetail_editcontrol",$control_IisDetail);

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
$control_CountryID=array();
$control_CountryID["func"]="xt_buildeditcontrol";
$control_CountryID["params"] = array();
$control_CountryID["params"]["field"]="CountryID";
$control_CountryID["params"]["value"]=@$data["CountryID"];

$control_CountryID["params"]["id"]=$record_id;
if($inlineedit)
	$control_CountryID["params"]["mode"]="inline_edit";
else
	$control_CountryID["params"]["mode"]="edit";
$xt->assignbyref("CountryID_editcontrol",$control_CountryID);

//0
$control_ICountry=array();
$control_ICountry["func"]="xt_buildeditcontrol";
$control_ICountry["params"] = array();
$control_ICountry["params"]["field"]="ICountry";
$control_ICountry["params"]["value"]=@$data["ICountry"];

$control_ICountry["params"]["id"]=$record_id;
if($inlineedit)
	$control_ICountry["params"]["mode"]="inline_edit";
else
	$control_ICountry["params"]["mode"]="edit";
$xt->assignbyref("ICountry_editcontrol",$control_ICountry);

//0
$control_IngredientSpecID=array();
$control_IngredientSpecID["func"]="xt_buildeditcontrol";
$control_IngredientSpecID["params"] = array();
$control_IngredientSpecID["params"]["field"]="IngredientSpecID";
$control_IngredientSpecID["params"]["value"]=@$data["IngredientSpecID"];

$control_IngredientSpecID["params"]["id"]=$record_id;
if($inlineedit)
	$control_IngredientSpecID["params"]["mode"]="inline_edit";
else
	$control_IngredientSpecID["params"]["mode"]="edit";
$xt->assignbyref("IngredientSpecID_editcontrol",$control_IngredientSpecID);

//0
$control_Species=array();
$control_Species["func"]="xt_buildeditcontrol";
$control_Species["params"] = array();
$control_Species["params"]["field"]="Species";
$control_Species["params"]["value"]=@$data["Species"];

$control_Species["params"]["id"]=$record_id;
if($inlineedit)
	$control_Species["params"]["mode"]="inline_edit";
else
	$control_Species["params"]["mode"]="edit";
$xt->assignbyref("Species_editcontrol",$control_Species);


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
