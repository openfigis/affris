<?php 
include("include/dbcommon.php");

@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

add_nocache_headers();
include("include/vw_ingredientspecassociation_variables.php");
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
	$templatefile = "vw_ingredientspecassociation_inline_add.htm";
else
	$templatefile = "vw_ingredientspecassociation_add.htm";

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
//	processing IName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IName_".$id);
		$type=postvalue("type_IName_".$id);
		if (FieldSubmitted("IName_".$id))
		{
				$value=prepare_for_db("IName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IName"]=$value;
		}
		}
//	processibng IName - end
//	processing IfeedNo - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IfeedNo_".$id);
		$type=postvalue("type_IfeedNo_".$id);
		if (FieldSubmitted("IfeedNo_".$id))
		{
				$value=prepare_for_db("IfeedNo",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IfeedNo"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IfeedNo"]=$value;
		}
		}
//	processibng IfeedNo - end
//	processing Description1 - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Description1_".$id);
		$type=postvalue("type_Description1_".$id);
		if (FieldSubmitted("Description1_".$id))
		{
				$value=prepare_for_db("Description1",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Description1"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Description1"]=$value;
		}
		}
//	processibng Description1 - end
//	processing Description2 - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Description2_".$id);
		$type=postvalue("type_Description2_".$id);
		if (FieldSubmitted("Description2_".$id))
		{
				$value=prepare_for_db("Description2",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Description2"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Description2"]=$value;
		}
		}
//	processibng Description2 - end
//	processing Description3 - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Description3_".$id);
		$type=postvalue("type_Description3_".$id);
		if (FieldSubmitted("Description3_".$id))
		{
				$value=prepare_for_db("Description3",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Description3"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Description3"]=$value;
		}
		}
//	processibng Description3 - end
//	processing IisDetail - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IisDetail_".$id);
		$type=postvalue("type_IisDetail_".$id);
		if (FieldSubmitted("IisDetail_".$id))
		{
				$value=prepare_for_db("IisDetail",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IisDetail"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IisDetail"]=$value;
		}
		}
//	processibng IisDetail - end
//	processing IDSourceID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IDSourceID_".$id);
		$type=postvalue("type_IDSourceID_".$id);
		if (FieldSubmitted("IDSourceID_".$id))
		{
				$value=prepare_for_db("IDSourceID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IDSourceID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IDSourceID"]=$value;
		}
		}
//	processibng IDSourceID - end
//	processing DataSource - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_DataSource_".$id);
		$type=postvalue("type_DataSource_".$id);
		if (FieldSubmitted("DataSource_".$id))
		{
				$value=prepare_for_db("DataSource",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "DataSource"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["DataSource"]=$value;
		}
		}
//	processibng DataSource - end
//	processing CountryID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_CountryID_".$id);
		$type=postvalue("type_CountryID_".$id);
		if (FieldSubmitted("CountryID_".$id))
		{
				$value=prepare_for_db("CountryID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "CountryID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["CountryID"]=$value;
		}
		}
//	processibng CountryID - end
//	processing ICountry - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_ICountry_".$id);
		$type=postvalue("type_ICountry_".$id);
		if (FieldSubmitted("ICountry_".$id))
		{
				$value=prepare_for_db("ICountry",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "ICountry"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["ICountry"]=$value;
		}
		}
//	processibng ICountry - end
//	processing IngredientSpecID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_IngredientSpecID_".$id);
		$type=postvalue("type_IngredientSpecID_".$id);
		if (FieldSubmitted("IngredientSpecID_".$id))
		{
				$value=prepare_for_db("IngredientSpecID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "IngredientSpecID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["IngredientSpecID"]=$value;
		}
		}
//	processibng IngredientSpecID - end
//	processing Species - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Species_".$id);
		$type=postvalue("type_Species_".$id);
		if (FieldSubmitted("Species_".$id))
		{
				$value=prepare_for_db("Species",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Species"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Species"]=$value;
		}
		}
//	processibng Species - end
//	processing SpeciesID - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_SpeciesID_".$id);
		$type=postvalue("type_SpeciesID_".$id);
		if (FieldSubmitted("SpeciesID_".$id))
		{
				$value=prepare_for_db("SpeciesID",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "SpeciesID"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["SpeciesID"]=$value;
		}
		}
//	processibng SpeciesID - end
//	processing SpecName - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_SpecName_".$id);
		$type=postvalue("type_SpecName_".$id);
		if (FieldSubmitted("SpecName_".$id))
		{
				$value=prepare_for_db("SpecName",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "SpecName"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["SpecName"]=$value;
		}
		}
//	processibng SpecName - end
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
//	processing Hybrid - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Hybrid_".$id);
		$type=postvalue("type_Hybrid_".$id);
		if (FieldSubmitted("Hybrid_".$id))
		{
				$value=prepare_for_db("Hybrid",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Hybrid"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Hybrid"]=$value;
		}
		}
//	processibng Hybrid - end
//	processing Variety - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Variety_".$id);
		$type=postvalue("type_Variety_".$id);
		if (FieldSubmitted("Variety_".$id))
		{
				$value=prepare_for_db("Variety",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Variety"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Variety"]=$value;
		}
		}
//	processibng Variety - end
//	processing Family - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Family_".$id);
		$type=postvalue("type_Family_".$id);
		if (FieldSubmitted("Family_".$id))
		{
				$value=prepare_for_db("Family",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Family"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Family"]=$value;
		}
		}
//	processibng Family - end
//	processing Group - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Group_".$id);
		$type=postvalue("type_Group_".$id);
		if (FieldSubmitted("Group_".$id))
		{
				$value=prepare_for_db("Group",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Group"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Group"]=$value;
		}
		}
//	processibng Group - end
//	processing Genus - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Genus_".$id);
		$type=postvalue("type_Genus_".$id);
		if (FieldSubmitted("Genus_".$id))
		{
				$value=prepare_for_db("Genus",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Genus"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Genus"]=$value;
		}
		}
//	processibng Genus - end
//	processing Environment - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Environment_".$id);
		$type=postvalue("type_Environment_".$id);
		if (FieldSubmitted("Environment_".$id))
		{
				$value=prepare_for_db("Environment",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Environment"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Environment"]=$value;
		}
		}
//	processibng Environment - end
//	processing FeedHabit - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_FeedHabit_".$id);
		$type=postvalue("type_FeedHabit_".$id);
		if (FieldSubmitted("FeedHabit_".$id))
		{
				$value=prepare_for_db("FeedHabit",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "FeedHabit"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["FeedHabit"]=$value;
		}
		}
//	processibng FeedHabit - end
//	processing Country - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_Country_".$id);
		$type=postvalue("type_Country_".$id);
		if (FieldSubmitted("Country_".$id))
		{
				$value=prepare_for_db("Country",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "Country"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["Country"]=$value;
		}
		}
//	processibng Country - end
//	processing SpecYear - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_SpecYear_".$id);
		$type=postvalue("type_SpecYear_".$id);
		if (FieldSubmitted("SpecYear_".$id))
		{
				$value=prepare_for_db("SpecYear",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "SpecYear"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["SpecYear"]=$value;
		}
		}
//	processibng SpecYear - end
//	processing lower - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_lower_".$id);
		$type=postvalue("type_lower_".$id);
		if (FieldSubmitted("lower_".$id))
		{
				$value=prepare_for_db("lower",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "lower"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["lower"]=$value;
		}
		}
//	processibng lower - end
//	processing upper - start
	$inlineAddOption = true;
	$inlineAddOption = $inlineadd!=ADD_INLINE;
	if($inlineAddOption)
	{
		$value = postvalue("value_upper_".$id);
		$type=postvalue("type_upper_".$id);
		if (FieldSubmitted("upper_".$id))
		{
				$value=prepare_for_db("upper",$value,$type);
		}
		else
			$value=false;
		
		if(!($value===false))
		{
	
	
						if(0 && "upper"=="pass" && $url_page=="admin_users_")
				$value=md5($value);
			$avalues["upper"]=$value;
		}
		}
//	processibng upper - end


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
						$message .='&nbsp;<a href=\'vw_ingredientspecassociation_edit.php?'.$keylink.'\'>'."Edit".'</a>&nbsp;';
					if(GetTableData($strTableName,".view",false) && $permis['search'])
						$message .='&nbsp;<a href=\'vw_ingredientspecassociation_view.php?'.$keylink.'\'>'."View".'</a>&nbsp;';
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
	header("Location: vw_ingredientspecassociation_".$pageObject->getPageType().".php");
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
	$defvalues["lower"]=@$avalues["lower"];
	$defvalues["upper"]=@$avalues["upper"];
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
	
	if(!$pageObject->isAppearOnTabs("IName"))
		$xt->assign("IName_fieldblock",true);
	else
		$xt->assign("IName_tabfieldblock",true);
	$xt->assign("IName_label",true);
	if(isEnableSection508())
		$xt->assign_section("IName_label","<label for=\"".GetInputElementId("IName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IfeedNo"))
		$xt->assign("IfeedNo_fieldblock",true);
	else
		$xt->assign("IfeedNo_tabfieldblock",true);
	$xt->assign("IfeedNo_label",true);
	if(isEnableSection508())
		$xt->assign_section("IfeedNo_label","<label for=\"".GetInputElementId("IfeedNo", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Description1"))
		$xt->assign("Description1_fieldblock",true);
	else
		$xt->assign("Description1_tabfieldblock",true);
	$xt->assign("Description1_label",true);
	if(isEnableSection508())
		$xt->assign_section("Description1_label","<label for=\"".GetInputElementId("Description1", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Description2"))
		$xt->assign("Description2_fieldblock",true);
	else
		$xt->assign("Description2_tabfieldblock",true);
	$xt->assign("Description2_label",true);
	if(isEnableSection508())
		$xt->assign_section("Description2_label","<label for=\"".GetInputElementId("Description2", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Description3"))
		$xt->assign("Description3_fieldblock",true);
	else
		$xt->assign("Description3_tabfieldblock",true);
	$xt->assign("Description3_label",true);
	if(isEnableSection508())
		$xt->assign_section("Description3_label","<label for=\"".GetInputElementId("Description3", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IisDetail"))
		$xt->assign("IisDetail_fieldblock",true);
	else
		$xt->assign("IisDetail_tabfieldblock",true);
	$xt->assign("IisDetail_label",true);
	if(isEnableSection508())
		$xt->assign_section("IisDetail_label","<label for=\"".GetInputElementId("IisDetail", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IDSourceID"))
		$xt->assign("IDSourceID_fieldblock",true);
	else
		$xt->assign("IDSourceID_tabfieldblock",true);
	$xt->assign("IDSourceID_label",true);
	if(isEnableSection508())
		$xt->assign_section("IDSourceID_label","<label for=\"".GetInputElementId("IDSourceID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("DataSource"))
		$xt->assign("DataSource_fieldblock",true);
	else
		$xt->assign("DataSource_tabfieldblock",true);
	$xt->assign("DataSource_label",true);
	if(isEnableSection508())
		$xt->assign_section("DataSource_label","<label for=\"".GetInputElementId("DataSource", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("CountryID"))
		$xt->assign("CountryID_fieldblock",true);
	else
		$xt->assign("CountryID_tabfieldblock",true);
	$xt->assign("CountryID_label",true);
	if(isEnableSection508())
		$xt->assign_section("CountryID_label","<label for=\"".GetInputElementId("CountryID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("ICountry"))
		$xt->assign("ICountry_fieldblock",true);
	else
		$xt->assign("ICountry_tabfieldblock",true);
	$xt->assign("ICountry_label",true);
	if(isEnableSection508())
		$xt->assign_section("ICountry_label","<label for=\"".GetInputElementId("ICountry", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("IngredientSpecID"))
		$xt->assign("IngredientSpecID_fieldblock",true);
	else
		$xt->assign("IngredientSpecID_tabfieldblock",true);
	$xt->assign("IngredientSpecID_label",true);
	if(isEnableSection508())
		$xt->assign_section("IngredientSpecID_label","<label for=\"".GetInputElementId("IngredientSpecID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Species"))
		$xt->assign("Species_fieldblock",true);
	else
		$xt->assign("Species_tabfieldblock",true);
	$xt->assign("Species_label",true);
	if(isEnableSection508())
		$xt->assign_section("Species_label","<label for=\"".GetInputElementId("Species", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpeciesID"))
		$xt->assign("SpeciesID_fieldblock",true);
	else
		$xt->assign("SpeciesID_tabfieldblock",true);
	$xt->assign("SpeciesID_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpeciesID_label","<label for=\"".GetInputElementId("SpeciesID", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpecName"))
		$xt->assign("SpecName_fieldblock",true);
	else
		$xt->assign("SpecName_tabfieldblock",true);
	$xt->assign("SpecName_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpecName_label","<label for=\"".GetInputElementId("SpecName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("CommonName"))
		$xt->assign("CommonName_fieldblock",true);
	else
		$xt->assign("CommonName_tabfieldblock",true);
	$xt->assign("CommonName_label",true);
	if(isEnableSection508())
		$xt->assign_section("CommonName_label","<label for=\"".GetInputElementId("CommonName", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Hybrid"))
		$xt->assign("Hybrid_fieldblock",true);
	else
		$xt->assign("Hybrid_tabfieldblock",true);
	$xt->assign("Hybrid_label",true);
	if(isEnableSection508())
		$xt->assign_section("Hybrid_label","<label for=\"".GetInputElementId("Hybrid", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Variety"))
		$xt->assign("Variety_fieldblock",true);
	else
		$xt->assign("Variety_tabfieldblock",true);
	$xt->assign("Variety_label",true);
	if(isEnableSection508())
		$xt->assign_section("Variety_label","<label for=\"".GetInputElementId("Variety", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Family"))
		$xt->assign("Family_fieldblock",true);
	else
		$xt->assign("Family_tabfieldblock",true);
	$xt->assign("Family_label",true);
	if(isEnableSection508())
		$xt->assign_section("Family_label","<label for=\"".GetInputElementId("Family", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Group"))
		$xt->assign("Group_fieldblock",true);
	else
		$xt->assign("Group_tabfieldblock",true);
	$xt->assign("Group_label",true);
	if(isEnableSection508())
		$xt->assign_section("Group_label","<label for=\"".GetInputElementId("Group", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Genus"))
		$xt->assign("Genus_fieldblock",true);
	else
		$xt->assign("Genus_tabfieldblock",true);
	$xt->assign("Genus_label",true);
	if(isEnableSection508())
		$xt->assign_section("Genus_label","<label for=\"".GetInputElementId("Genus", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Environment"))
		$xt->assign("Environment_fieldblock",true);
	else
		$xt->assign("Environment_tabfieldblock",true);
	$xt->assign("Environment_label",true);
	if(isEnableSection508())
		$xt->assign_section("Environment_label","<label for=\"".GetInputElementId("Environment", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("FeedHabit"))
		$xt->assign("FeedHabit_fieldblock",true);
	else
		$xt->assign("FeedHabit_tabfieldblock",true);
	$xt->assign("FeedHabit_label",true);
	if(isEnableSection508())
		$xt->assign_section("FeedHabit_label","<label for=\"".GetInputElementId("FeedHabit", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("Country"))
		$xt->assign("Country_fieldblock",true);
	else
		$xt->assign("Country_tabfieldblock",true);
	$xt->assign("Country_label",true);
	if(isEnableSection508())
		$xt->assign_section("Country_label","<label for=\"".GetInputElementId("Country", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("SpecYear"))
		$xt->assign("SpecYear_fieldblock",true);
	else
		$xt->assign("SpecYear_tabfieldblock",true);
	$xt->assign("SpecYear_label",true);
	if(isEnableSection508())
		$xt->assign_section("SpecYear_label","<label for=\"".GetInputElementId("SpecYear", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("lower"))
		$xt->assign("lower_fieldblock",true);
	else
		$xt->assign("lower_tabfieldblock",true);
	$xt->assign("lower_label",true);
	if(isEnableSection508())
		$xt->assign_section("lower_label","<label for=\"".GetInputElementId("lower", $id)."\">","</label>");
	
	if(!$pageObject->isAppearOnTabs("upper"))
		$xt->assign("upper_fieldblock",true);
	else
		$xt->assign("upper_tabfieldblock",true);
	$xt->assign("upper_label",true);
	if(isEnableSection508())
		$xt->assign_section("upper_label","<label for=\"".GetInputElementId("upper", $id)."\">","</label>");
	
	
	
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
//	IName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IName", ""),"field=IName".$keylink,"",MODE_LIST);
	$showValues["IName"] = $value;
	$showFields[] = "IName";
		$showRawValues["IName"] = substr($data["IName"],0,100);
	}	
//	IfeedNo - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IfeedNo", ""),"field=IfeedNo".$keylink,"",MODE_LIST);
	$showValues["IfeedNo"] = $value;
	$showFields[] = "IfeedNo";
		$showRawValues["IfeedNo"] = substr($data["IfeedNo"],0,100);
	}	
//	Description1 - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Description1", ""),"field=Description1".$keylink,"",MODE_LIST);
	$showValues["Description1"] = $value;
	$showFields[] = "Description1";
		$showRawValues["Description1"] = substr($data["Description1"],0,100);
	}	
//	Description2 - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Description2", ""),"field=Description2".$keylink,"",MODE_LIST);
	$showValues["Description2"] = $value;
	$showFields[] = "Description2";
		$showRawValues["Description2"] = substr($data["Description2"],0,100);
	}	
//	Description3 - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Description3", ""),"field=Description3".$keylink,"",MODE_LIST);
	$showValues["Description3"] = $value;
	$showFields[] = "Description3";
		$showRawValues["Description3"] = substr($data["Description3"],0,100);
	}	
//	IisDetail - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IisDetail", ""),"field=IisDetail".$keylink,"",MODE_LIST);
	$showValues["IisDetail"] = $value;
	$showFields[] = "IisDetail";
		$showRawValues["IisDetail"] = substr($data["IisDetail"],0,100);
	}	
//	IDSourceID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IDSourceID", ""),"field=IDSourceID".$keylink,"",MODE_LIST);
	$showValues["IDSourceID"] = $value;
	$showFields[] = "IDSourceID";
		$showRawValues["IDSourceID"] = substr($data["IDSourceID"],0,100);
	}	
//	DataSource - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"DataSource", ""),"field=DataSource".$keylink,"",MODE_LIST);
	$showValues["DataSource"] = $value;
	$showFields[] = "DataSource";
		$showRawValues["DataSource"] = substr($data["DataSource"],0,100);
	}	
//	CountryID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"CountryID", ""),"field=CountryID".$keylink,"",MODE_LIST);
	$showValues["CountryID"] = $value;
	$showFields[] = "CountryID";
		$showRawValues["CountryID"] = substr($data["CountryID"],0,100);
	}	
//	ICountry - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"ICountry", ""),"field=ICountry".$keylink,"",MODE_LIST);
	$showValues["ICountry"] = $value;
	$showFields[] = "ICountry";
		$showRawValues["ICountry"] = substr($data["ICountry"],0,100);
	}	
//	IngredientSpecID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"IngredientSpecID", ""),"field=IngredientSpecID".$keylink,"",MODE_LIST);
	$showValues["IngredientSpecID"] = $value;
	$showFields[] = "IngredientSpecID";
		$showRawValues["IngredientSpecID"] = substr($data["IngredientSpecID"],0,100);
	}	
//	Species - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Species", ""),"field=Species".$keylink,"",MODE_LIST);
	$showValues["Species"] = $value;
	$showFields[] = "Species";
		$showRawValues["Species"] = substr($data["Species"],0,100);
	}	
//	SpeciesID - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"SpeciesID", ""),"field=SpeciesID".$keylink,"",MODE_LIST);
	$showValues["SpeciesID"] = $value;
	$showFields[] = "SpeciesID";
		$showRawValues["SpeciesID"] = substr($data["SpeciesID"],0,100);
	}	
//	SpecName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"SpecName", ""),"field=SpecName".$keylink,"",MODE_LIST);
	$showValues["SpecName"] = $value;
	$showFields[] = "SpecName";
		$showRawValues["SpecName"] = substr($data["SpecName"],0,100);
	}	
//	CommonName - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"CommonName", ""),"field=CommonName".$keylink,"",MODE_LIST);
	$showValues["CommonName"] = $value;
	$showFields[] = "CommonName";
		$showRawValues["CommonName"] = substr($data["CommonName"],0,100);
	}	
//	Hybrid - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Hybrid", ""),"field=Hybrid".$keylink,"",MODE_LIST);
	$showValues["Hybrid"] = $value;
	$showFields[] = "Hybrid";
		$showRawValues["Hybrid"] = substr($data["Hybrid"],0,100);
	}	
//	Variety - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Variety", ""),"field=Variety".$keylink,"",MODE_LIST);
	$showValues["Variety"] = $value;
	$showFields[] = "Variety";
		$showRawValues["Variety"] = substr($data["Variety"],0,100);
	}	
//	Family - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Family", ""),"field=Family".$keylink,"",MODE_LIST);
	$showValues["Family"] = $value;
	$showFields[] = "Family";
		$showRawValues["Family"] = substr($data["Family"],0,100);
	}	
//	Group - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Group", ""),"field=Group".$keylink,"",MODE_LIST);
	$showValues["Group"] = $value;
	$showFields[] = "Group";
		$showRawValues["Group"] = substr($data["Group"],0,100);
	}	
//	Genus - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Genus", ""),"field=Genus".$keylink,"",MODE_LIST);
	$showValues["Genus"] = $value;
	$showFields[] = "Genus";
		$showRawValues["Genus"] = substr($data["Genus"],0,100);
	}	
//	Environment - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Environment", ""),"field=Environment".$keylink,"",MODE_LIST);
	$showValues["Environment"] = $value;
	$showFields[] = "Environment";
		$showRawValues["Environment"] = substr($data["Environment"],0,100);
	}	
//	FeedHabit - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"FeedHabit", ""),"field=FeedHabit".$keylink,"",MODE_LIST);
	$showValues["FeedHabit"] = $value;
	$showFields[] = "FeedHabit";
		$showRawValues["FeedHabit"] = substr($data["FeedHabit"],0,100);
	}	
//	Country - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($inlineadd==ADD_INLINE || $inlineadd==ADD_ONTHEFLY || $inlineadd==ADD_POPUP)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"Country", ""),"field=Country".$keylink,"",MODE_LIST);
	$showValues["Country"] = $value;
	$showFields[] = "Country";
		$showRawValues["Country"] = substr($data["Country"],0,100);
	}	
//	SpecYear - 
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"SpecYear", ""),"field=SpecYear".$keylink,"",MODE_LIST);
	$showValues["SpecYear"] = $value;
	$showFields[] = "SpecYear";
		$showRawValues["SpecYear"] = substr($data["SpecYear"],0,100);
	}	
//	lower - Number
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"lower", "Number"),"field=lower".$keylink,"",MODE_LIST);
	$showValues["lower"] = $value;
	$showFields[] = "lower";
		$showRawValues["lower"] = substr($data["lower"],0,100);
	}	
//	upper - Number
	$display = false;
	if($inlineadd==ADD_MASTER)
		$display = true;
	if($display)
	{	
		$value="";
			$value = ProcessLargeText(GetData($data,"upper", "Number"),"field=upper".$keylink,"",MODE_LIST);
	$showValues["upper"] = $value;
	$showFields[] = "upper";
		$showRawValues["upper"] = substr($data["upper"],0,100);
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
	$strTableName = "vw_ingredientspecassociation";
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
