<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");
include("include/vw_ingredientclass_variables.php");
include('include/xtempl.php');
include('classes/runnerpage.php');
include("classes/searchclause.php");

add_nocache_headers();

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
if(postvalue("editType")=="inline")
	$inlineedit = EDIT_INLINE;
elseif(postvalue("editType")==EDIT_POPUP)
	$inlineedit = EDIT_POPUP;
else
	$inlineedit = EDIT_SIMPLE;			

$id = postvalue("id");
if(intval($id)==0)
	$id = 1;

$flyId = $id+1;	
$xt = new Xtempl();

// assign an id		
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_EDIT,"id" => $id);

////////////////////// data picker

////////////////////// time picker


$params['tName'] = $strTableName;
$params['xt'] = &$xt;
$params['mode'] = $inlineedit;
$params['includes_js']=$includes_js;
$params['includes_jsreq']=$includes_jsreq;
$params['includes_css']=$includes_css;
$params['locale_info']=$locale_info;
$params['pageEditLikeInline'] = ($inlineedit == EDIT_INLINE);
//Get array of tabs for edit page
$params['useTabsOnEdit'] = useTabsOnEdit($strTableName);
if($params['useTabsOnEdit'])
	$params['arrEditTabs'] = GetEditTabs($strTableName);
$pageObject = new RunnerPage($params);

//	For ajax request 
if($_REQUEST["action"]!="")
{
	if($pageObject->lockingObj)
	{
		$arrkeys = explode("&",refine($_REQUEST["keys"]));
		foreach($arrkeys as $ind=>$val)
			$arrkeys[$ind]=urldecode($val);
		
		if($_REQUEST["action"]=="unlock")
		{
			$pageObject->lockingObj->UnlockRecord($strTableName,$arrkeys,$_REQUEST["sid"]);
			exit();	
		}
		else if($_REQUEST["action"]=="lockadmin" && (IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP))
		{
			$pageObject->lockingObj->UnlockAdmin($strTableName,$arrkeys,$_REQUEST["startEdit"]=="yes");
			if($_REQUEST["startEdit"]=="no")
				echo "unlock";
			else if($_REQUEST["startEdit"]=="yes")
				echo "lock";
			exit();	
		}
		else if($_REQUEST["action"]=="confirm")
		{echo '<br>confirm';
			if(!$pageObject->lockingObj->ConfirmLock($strTableName,$arrkeys,$message));
				echo $message;
			exit();	
		}
	}
	else
		exit();
}

$filename = $status = $message = $mesClass = $usermessage = $strWhereClause = $bodyonload = "";
$showValues = $showRawValues = $showFields = $showDetailKeys = $key = $next = $prev = array();
$HaveData = $enableCtrlsForEditing = true;
$error_happened = $readevalues = $IsSaved = false;

$templatefile = "vw_ingredientclass_edit.htm";

$auditObj = GetAuditObject($strTableName);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

//Get detail table keys	
$detailKeys = $pageObject->detailKeysByM;

//Array of fields, which appear on edit page
$editFields = $pageObject->getFieldsByPageType();

// add onload event
$onLoadJsCode = GetTableData($pageObject->tName, ".jsOnloadEdit", '');
$pageObject->addOnLoadJsEvent($onLoadJsCode);

if($pageObject->lockingObj)
{
	$system_attrs = "style='display:none;'";
	$system_message = "";
}

if ($inlineedit!=EDIT_INLINE)
{
	// add button events if exist
	$pageObject->addButtonHandlers();
}

$url_page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,12);

//	Before Process event
if($eventObj->exists("BeforeProcessEdit"))
	$eventObj->BeforeProcessEdit($conn);

$keys = array();
$skeys = "";
$savedKeys = array();
$keys["IngredientID"]=urldecode(postvalue("editid1"));
$savedKeys["IngredientID"]=urldecode(postvalue("editid1"));
$skeys.=rawurlencode(postvalue("editid1"))."&";

if($skeys!="")
	$skeys = substr($skeys,0,-1);

//For show detail tables on master page edit
if($inlineedit!=EDIT_INLINE)	
{
	$dpParams = array();
	if($pageObject->isShowDetailTables)
	{
		$ids = $id;
					$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array('tableNames'=>$dpParams['strTableNames'], 'ids'=>$dpParams['ids']);
		$pageObject->AddJSFile("include/detailspreview");
	}	
}	
/////////////////////////////////////////////////////////////
//	process entered data, read and save
/////////////////////////////////////////////////////////////

// proccess captcha
if ($inlineedit!=EDIT_INLINE)
	if($pageObject->captchaExists())
		$pageObject->doCaptchaCode();

if(@$_POST["a"] == "edited")
{
	$strWhereClause = whereAdd($strWhereClause,KeyWhere($keys));
		$oldValuesRead = false;
	if($eventObj->exists("AfterEdit") || $eventObj->exists("BeforeEdit") || $auditObj)
	{
		//	read old values
		$rsold = db_query(gSQLWhere($strWhereClause), $conn);
		$dataold = db_fetch_array($rsold);
		$oldValuesRead = true;
	}
	$evalues = $efilename_values = $blobfields = array();
	

//	processing IngredientID - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IngredientID_".$id);
		$type = postvalue("type_IngredientID_".$id);
		if(FieldSubmitted("IngredientID_".$id))
		{
				$value = prepare_for_db("IngredientID",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IngredientID"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IngredientID"] = $value;
		
			}
	
		//	update key value
		if($value!==false)
			$keys["IngredientID"] = $value;
	}
//	processing IngredientID - end
//	processing IName - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IName_".$id);
		$type = postvalue("type_IName_".$id);
		if(FieldSubmitted("IName_".$id))
		{
				$value = prepare_for_db("IName",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IName"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IName"] = $value;
		
			}
	
		}
//	processing IName - end
//	processing IfeedNo - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IfeedNo_".$id);
		$type = postvalue("type_IfeedNo_".$id);
		if(FieldSubmitted("IfeedNo_".$id))
		{
				$value = prepare_for_db("IfeedNo",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IfeedNo"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IfeedNo"] = $value;
		
			}
	
		}
//	processing IfeedNo - end
//	processing Description1 - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_Description1_".$id);
		$type = postvalue("type_Description1_".$id);
		if(FieldSubmitted("Description1_".$id))
		{
				$value = prepare_for_db("Description1",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "Description1"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["Description1"] = $value;
		
			}
	
		}
//	processing Description1 - end
//	processing Description2 - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_Description2_".$id);
		$type = postvalue("type_Description2_".$id);
		if(FieldSubmitted("Description2_".$id))
		{
				$value = prepare_for_db("Description2",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "Description2"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["Description2"] = $value;
		
			}
	
		}
//	processing Description2 - end
//	processing Description3 - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_Description3_".$id);
		$type = postvalue("type_Description3_".$id);
		if(FieldSubmitted("Description3_".$id))
		{
				$value = prepare_for_db("Description3",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "Description3"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["Description3"] = $value;
		
			}
	
		}
//	processing Description3 - end
//	processing IisDetail - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IisDetail_".$id);
		$type = postvalue("type_IisDetail_".$id);
		if(FieldSubmitted("IisDetail_".$id))
		{
				$value = prepare_for_db("IisDetail",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IisDetail"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IisDetail"] = $value;
		
			}
	
		}
//	processing IisDetail - end
//	processing IDSourceID - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IDSourceID_".$id);
		$type = postvalue("type_IDSourceID_".$id);
		if(FieldSubmitted("IDSourceID_".$id))
		{
				$value = prepare_for_db("IDSourceID",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IDSourceID"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IDSourceID"] = $value;
		
			}
	
		}
//	processing IDSourceID - end
//	processing DataSource - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_DataSource_".$id);
		$type = postvalue("type_DataSource_".$id);
		if(FieldSubmitted("DataSource_".$id))
		{
				$value = prepare_for_db("DataSource",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "DataSource"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["DataSource"] = $value;
		
			}
	
		}
//	processing DataSource - end
//	processing CountryID - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_CountryID_".$id);
		$type = postvalue("type_CountryID_".$id);
		if(FieldSubmitted("CountryID_".$id))
		{
				$value = prepare_for_db("CountryID",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "CountryID"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["CountryID"] = $value;
		
			}
	
		}
//	processing CountryID - end
//	processing ICountry - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_ICountry_".$id);
		$type = postvalue("type_ICountry_".$id);
		if(FieldSubmitted("ICountry_".$id))
		{
				$value = prepare_for_db("ICountry",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "ICountry"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["ICountry"] = $value;
		
			}
	
		}
//	processing ICountry - end
//	processing IngredientSpecID - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IngredientSpecID_".$id);
		$type = postvalue("type_IngredientSpecID_".$id);
		if(FieldSubmitted("IngredientSpecID_".$id))
		{
				$value = prepare_for_db("IngredientSpecID",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IngredientSpecID"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IngredientSpecID"] = $value;
		
			}
	
		}
//	processing IngredientSpecID - end
//	processing Species - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_Species_".$id);
		$type = postvalue("type_Species_".$id);
		if(FieldSubmitted("Species_".$id))
		{
				$value = prepare_for_db("Species",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "Species"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["Species"] = $value;
		
			}
	
		}
//	processing Species - end
//	processing IngredientClassID - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IngredientClassID_".$id);
		$type = postvalue("type_IngredientClassID_".$id);
		if(FieldSubmitted("IngredientClassID_".$id))
		{
				$value = prepare_for_db("IngredientClassID",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IngredientClassID"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IngredientClassID"] = $value;
		
			}
	
		}
//	processing IngredientClassID - end
//	processing IngredientClass - begin
	$condition = $inlineedit!=EDIT_INLINE;//(!$inlineedit) edit simple mode

	if($condition)
	{
		$value = postvalue("value_IngredientClass_".$id);
		$type = postvalue("type_IngredientClass_".$id);
		if(FieldSubmitted("IngredientClass_".$id))
		{
				$value = prepare_for_db("IngredientClass",$value,$type);
		}
		else
			$value = false;
	
			if($value!==false)
		{	
	
	
	
	
	
			if(0 && "IngredientClass"=="pass" && $url_page=="admin_users_")
				$value = md5($value);
			$evalues["IngredientClass"] = $value;
		
			}
	
		}
//	processing IngredientClass - end

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey] = $value;
		
	if($pageObject->lockingObj)
	{
		$lockmessage = "";
		if(!$pageObject->lockingObj->ConfirmLock($strTableName,$savedKeys,$lockmessage))
		{
			$enableCtrlsForEditing = false;
			$system_attrs = "style='display:block;'";
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,false,$id);
				
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo "<textarea>".htmlspecialchars(my_json_encode($returnJSON))."</textarea>";
				exit();
			}
			else
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$system_message = $pageObject->lockingObj->GetLockInfo($strTableName,$savedKeys,true,$id);
				else
					$system_message = $lockmessage;
			}
			$status = "DECLINED";
			$readevalues = true;
		}
	}
	
	if($readevalues==false)
	{
	//	do event
		$retval = true;
		if($eventObj->exists("BeforeEdit"))
			$retval=$eventObj->BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,(bool)$inlineedit);
		if($retval && $pageObject->isCaptchaOk)
		{		
			if($inlineedit!=EDIT_INLINE)
				$_SESSION[$strTableName."_count_captcha"] = $_SESSION[$strTableName."_count_captcha"]+1;
				
			if(DoUpdateRecord($strOriginalTableName,$evalues,$blobfields,$strWhereClause,$id,$pageObject))
			{
				$IsSaved = true;
				
				//	after edit event
				if($pageObject->lockingObj && $inlineedit == EDIT_INLINE)
					$pageObject->lockingObj->UnlockRecord($strTableName,$savedKeys,"");
				if($auditObj || $eventObj->exists("AfterEdit"))
				{
					foreach($dataold as $idx=>$val)
					{
						if(!array_key_exists($idx,$evalues))
							$evalues[$idx] = $val;
					}
				}

				if($auditObj)
					$auditObj->LogEdit($strTableName,$evalues,$dataold,$keys);
				if($eventObj->exists("AfterEdit"))
					$eventObj->AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,(bool)$inlineedit);
							
				$mesClass = "mes_ok";	
			}
			elseif($inlineedit!=EDIT_INLINE)
				$mesClass = "mes_not";	
		}
		else
		{
			$message = $usermessage;
			$readevalues = true;
			$status = "DECLINED";
		}
	}
	if($readevalues)
		$keys = $savedKeys;
}
//else
{
	/////////////////////////
	//Locking recors
	/////////////////////////

	if($pageObject->lockingObj)
	{
		$enableCtrlsForEditing = $pageObject->lockingObj->LockRecord($strTableName,$keys);
		if(!$enableCtrlsForEditing)
		{
			if($inlineedit == EDIT_INLINE)
			{
				if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
					$lockmessage = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,false,$id);
				else
					$lockmessage = $pageObject->lockingObj->LockUser;
				$returnJSON['success'] = false;
				$returnJSON['message'] = $lockmessage;
				$returnJSON['enableCtrls'] = $enableCtrlsForEditing;
				$returnJSON['confirmTime'] = $pageObject->lockingObj->ConfirmTime;
				echo my_json_encode($returnJSON);
				exit();
			}
			
			$system_attrs = "style='display:block;'";
			$system_message = $pageObject->lockingObj->LockUser;
			
			if(IsAdmin() || $_SESSION["AccessLevel"] == ACCESS_LEVEL_ADMINGROUP)
			{
				$rb = $pageObject->lockingObj->GetLockInfo($strTableName,$keys,true,$id);
				if($rb!="")
					$system_message = $rb;
			}
		}
	}
}

if($pageObject->lockingObj && $inlineedit!=EDIT_INLINE)
	$pageObject->body["begin"] .='<div id="system_div'.$id.'" class="admin_message" '.$system_attrs.'>'.$system_message.'</div>';

$message = "<div class='message ".$mesClass."'>".$message."</div>";

// PRG rule, to avoid POSTDATA resend
if ($IsSaved && no_output_done() && $inlineedit == EDIT_SIMPLE)
{
	// saving message
	$_SESSION["message"] = ($message ? $message : "");
	// key get query
	$keyGetQ = "";
		$keyGetQ.="editid1=".rawurldecode($keys["IngredientID"])."&";
	// cut last &
	$keyGetQ = substr($keyGetQ, 0, strlen($keyGetQ)-1);	
	// redirect
	header("Location: vw_ingredientclass_".$pageObject->getPageType().".php?".$keyGetQ);
	// turned on output buffering, so we need to stop script
	exit();
}
// for PRG rule, to avoid POSTDATA resend. Saving mess in session
if ($inlineedit == EDIT_SIMPLE && isset($_SESSION["message"]))
{
	$message = $_SESSION["message"];
	unset($_SESSION["message"]);
}

/////////////////////////////////////////////////////////////
//	read current values from the database
/////////////////////////////////////////////////////////////
$query = $queryData_vw_ingredientclass->Copy();

$strWhereClause = KeyWhere($keys);
$strSQL = gSQLWhere($strWhereClause);

$strSQLbak = $strSQL;
//	Before Query event
if($eventObj->exists("BeforeQueryEdit"))
	$eventObj->BeforeQueryEdit($strSQL, $strWhereClause);

if($strSQLbak == $strSQL)
	$strSQL = gSQLWhere($strWhereClause);
	
LogInfo($strSQL);

$rs = db_query($strSQL, $conn);
$data = db_fetch_array($rs);
if(!$data)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		header("Location: vw_ingredientclass_list.php?a=return");
		exit();
	}
	else
		$data = array();
}

$readonlyfields = array();


if($readevalues)
{
	$data["IngredientID"] = $evalues["IngredientID"];
	$data["IName"] = $evalues["IName"];
	$data["IfeedNo"] = $evalues["IfeedNo"];
	$data["Description1"] = $evalues["Description1"];
	$data["Description2"] = $evalues["Description2"];
	$data["Description3"] = $evalues["Description3"];
	$data["IisDetail"] = $evalues["IisDetail"];
	$data["IDSourceID"] = $evalues["IDSourceID"];
	$data["DataSource"] = $evalues["DataSource"];
	$data["CountryID"] = $evalues["CountryID"];
	$data["ICountry"] = $evalues["ICountry"];
	$data["IngredientSpecID"] = $evalues["IngredientSpecID"];
	$data["Species"] = $evalues["Species"];
	$data["IngredientClassID"] = $evalues["IngredientClassID"];
	$data["IngredientClass"] = $evalues["IngredientClass"];
}

if($eventObj->exists("ProcessValuesEdit"))
	$eventObj->ProcessValuesEdit($data);

/////////////////////////////////////////////////////////////
//	assign values to $xt class, prepare page for displaying
/////////////////////////////////////////////////////////////
//Basic includes js files
$includes = "";
//javascript code
	
if($inlineedit != EDIT_INLINE)
{
	if($inlineedit == EDIT_SIMPLE)
	{
		$includes.= "<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
			
		if ($pageObject->debugJSMode === true)
		{
			/*$includes.="<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
				"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
			$includes.="<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
		}
		else
			$includes.= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
			
		$includes.= "<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
		$includes.= "<div id=\"search_suggest".$id."\"></div>\r\n";
		if($pageObject->isShowDetailTables)
			$includes.= "<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"> </div>";
		$pageObject->body["begin"].= $includes;
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
		
	if(!$pageObject->isAppearOnTabs("IngredientClassID"))
		$xt->assign("IngredientClassID_fieldblock",true);
	else
		$xt->assign("IngredientClassID_tabfieldblock",true);
	$xt->assign("IngredientClassID_label",true);
	if(isEnableSection508())
		$xt->assign_section("IngredientClassID_label","<label for=\"".GetInputElementId("IngredientClassID", $id)."\">","</label>");
		
	if(!$pageObject->isAppearOnTabs("IngredientClass"))
		$xt->assign("IngredientClass_fieldblock",true);
	else
		$xt->assign("IngredientClass_tabfieldblock",true);
	$xt->assign("IngredientClass_label",true);
	if(isEnableSection508())
		$xt->assign_section("IngredientClass_label","<label for=\"".GetInputElementId("IngredientClass", $id)."\">","</label>");
		

	$xt->assign("show_key1", htmlspecialchars(GetData($data,"IngredientID", "")));
	//$xt->assign('editForm',true);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if(!@$_SESSION[$strTableName."_noNextPrev"] && $inlineedit == EDIT_SIMPLE)
	{
		$next = array();
		$prev = array();
		$pageObject->getNextPrevRecordKeys($data,"Edit",$next,$prev);
	}
	$nextlink = $prevlink = "";
	if(count($next))
	{
		$xt->assign("next_button",true);
				$nextlink.= "editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
				$prevlink.= "editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\" align=\"absmiddle\"");
	}
	else 
		$xt->assign("prev_button",false);
	
	
	$xt->assign("resetbutton_attrs",'id="resetButton'.$id.'"');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//End Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
	if($inlineedit == EDIT_SIMPLE)
	{
		$xt->assign("back_button",true);
		$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
	}
	// onmouseover event, for changing focus. Needed to proper submit form
	$onmouseover = "this.focus();";
	$onmouseover = 'onmouseover="'.$onmouseover.'"';
	
	$xt->assign("save_button",true);
	if(!$enableCtrlsForEditing)
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\" disabled=\"true\" style='background-color:#dcdcdc' ".$onmouseover);
	else
		$xt->assign("savebutton_attrs", "id=\"saveButton".$id."\"".$onmouseover);
		
	$xt->assign("reset_button",true);
}

if($message)
{
	$xt->assign("message_block",true);
	$xt->assign("message",$message);
}
/////////////////////////////////////////////////////////////
//process readonly and auto-update fields
/////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////
//	prepare Edit Controls
/////////////////////////////////////////////////////////////
//	validation stuff
$regex = '';
$regexmessage = '';
$regextype = '';
$control = array();

foreach($editFields as $fName)
{
	$gfName = GoodFieldName($fName);
	$controls = array('controls'=>array());
	if (!$detailKeys || !in_array($fName, $detailKeys))
	{		
		$control[$gfName] = array();
		$control[$gfName]["func"]="xt_buildeditcontrol";
		$control[$gfName]["params"] = array();
		$control[$gfName]["params"]["id"] = $id;
		$control[$gfName]["params"]["field"] = $fName;
		$control[$gfName]["params"]["value"] = @$data[$fName];
		
		//	Begin Add validation
		$arrValidate = getValidation($fName,$strTableName);	
		$control[$gfName]["params"]["validate"] = $arrValidate;
		//	End Add validation	
		$additionalCtrlParams = array();
		$additionalCtrlParams["disabled"] = !$enableCtrlsForEditing;
		$control[$gfName]["params"]["additionalCtrlParams"] = $additionalCtrlParams;
	}
	$controls["controls"]['ctrlInd'] = 0;
	$controls["controls"]['id'] = $id;
	$controls["controls"]['fieldName'] = $fName;
	
	if($inlineedit == EDIT_INLINE)
	{
		if(!$detailKeys || !in_array($fName, $detailKeys))
			$control[$gfName]["params"]["mode"]="inline_edit";
		$controls["controls"]['mode'] = "inline_edit";
	}
	else{
			if (!$detailKeys || !in_array($fName, $detailKeys))
				$control[$gfName]["params"]["mode"] = "edit";
			$controls["controls"]['mode'] = "edit";
		}
                                                            	
	if(!$detailKeys || !in_array($fName, $detailKeys))
		$xt->assignbyref($gfName."_editcontrol",$control[$gfName]);
	elseif($detailKeys && in_array($fName, $detailKeys))
		$controls["controls"]['value'] = @$data[$fName];
		
	// category control field
	$strCategoryControl = $pageObject->hasDependField($fName);
	
	if($strCategoryControl!==false && in_array($strCategoryControl, $editFields))
		$vals = array($fName => @$data[$fName],$strCategoryControl => @$data[$strCategoryControl]);
	else
		$vals = array($fName => @$data[$fName]);
		
	$preload = $pageObject->fillPreload($fName, $vals);
	if($preload!==false)
		$controls["controls"]['preloadData'] = $preload;	
	
	$pageObject->fillControlsMap($controls);
	
	//fill field tool tips
	$pageObject->fillFieldToolTips($fName);
	
	// fill special settings for timepicker
	if(GetEditFormat($fName) == 'Time')	
		$pageObject->fillTimePickSettings($fName, $data[$fName]);
	
	if(ViewFormat($fName) == FORMAT_MAP)	
		$pageObject->googleMapCfg['isUseGoogleMap'] = true;
		
	if($detailKeys && in_array($fName, $detailKeys) && array_key_exists($fName, $data))
	{
		if((GetEditFormat($fName)==EDIT_FORMAT_LOOKUP_WIZARD || GetEditFormat($fName)==EDIT_FORMAT_RADIO) && GetpLookupType($fName) == LT_LOOKUPTABLE)
			$value=DisplayLookupWizard($fName,$data[$fName],$data,"",MODE_VIEW);
		elseif(NeedEncode($fName))
			$value = ProcessLargeText(GetData($data,$fName, ViewFormat($fName)),"field=".rawurlencode(htmlspecialchars($fName)),"",MODE_VIEW);
		else
			$value = GetData($data,$fName, ViewFormat($fName));
		
		$xt->assign($gfName."_editcontrol",$value);
	}
}
//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();
			
$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $keys;
$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
if($pageObject->lockingObj)
{
	$pageObject->jsSettings['tableSettings'][$strTableName]["sKeys"] = $skeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]["enableCtrls"] = $enableCtrlsForEditing;
	$pageObject->jsSettings['tableSettings'][$strTableName]["confirmTime"] = $pageObject->lockingObj->ConfirmTime;
}
//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && $inlineedit!=EDIT_INLINE)
{
	$options = array();
	//array of params for classes
	$options["mode"] = LIST_DETAILS;
	$options["pageType"] = PAGE_LIST;
	$options["masterPageType"] = PAGE_EDIT;
	$options["mainMasterPageType"] = PAGE_EDIT;
	$options['masterTable'] = $strTableName;
	$options['firstTime'] = 1;
	
	if(count($dpParams['ids']))
	{
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
		$xt->assign("detail_tables",true);	
	}
	
	$dControlsMap = array();
	
	$flyId = $ids+1;
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$strTableName = $dpParams['strTableNames'][$d];
		include("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "vw_ingredientclass";		
			continue;
		}
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $flyId++;
		$mkr=1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		// prepare code
		$listPageObject->prepareForBuildPage();
		$flyId = $listPageObject->recId+1;
		// show page
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
	$strTableName = "vw_ingredientclass";
	$pageObject->controlsHTMLMap[$strTableName][PAGE_EDIT][$id]['dControlsMap'] = $dControlsMap;	
}
/////////////////////////////////////////////////////////////	

if($inlineedit == EDIT_SIMPLE)
{
	$pageObject->jsSettings["global"]['idStartFrom'] =  $flyId + 1;
	$pageObject->body['end'].= '<script>';
	$pageObject->body['end'].= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
	$pageObject->body['end'].= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
	$pageObject->body['end'].= '</script>';
}
else{
		$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
		//if($isNeedSettings)
		$returnJSON['settings'] = $pageObject->jsSettings;	
	}
	
$pageObject->addCommonJs();

$jscode = $pageObject->PrepareJS();

if($inlineedit==EDIT_SIMPLE)
{
	$pageObject->body["end"].= "<script>".$jscode."</script>";
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);	
}
elseif($inlineedit==EDIT_POPUP){
		$xt->assign("footer","");
		$xt->assign("flybody",$pageObject->body);
		$xt->assign("body",true);
	}
	
$xt->assign("style_block",true);
$pageObject->xt->assign("legendBreak", '<br/>');



/////////////////////////////////////////////////////////////
//display the page
/////////////////////////////////////////////////////////////
if($eventObj->exists("BeforeShowEdit"))
	$eventObj->BeforeShowEdit($xt,$templatefile,$data);
if($inlineedit==EDIT_POPUP)
{
	$xt->load_template($templatefile);
	$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('flybody');
	if($pageObject->isShowDetailTables)
		$returnJSON['html'].= $xt->fetch_loaded('detail_tables');
	$returnJSON['idStartFrom'] = $flyId + 1;
	echo (my_json_encode($returnJSON)); 
}
elseif($inlineedit == EDIT_INLINE)
{
	$xt->load_template($templatefile);
	$returnJSON["html"] = array();
	foreach($editFields as $fName)
	{
		if($detailKeys && in_array($fName, $detailKeys))
			continue;
		$returnJSON["html"][$fName] = $xt->fetchVar(GoodFieldName($fName)."_editcontrol");	
	}
	
	echo (my_json_encode($returnJSON)); 
}
else	
	$xt->display($templatefile);

?>
