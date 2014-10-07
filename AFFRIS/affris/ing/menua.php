<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");

if(!@$_SESSION["UserID"])
{
	header("Location: login.php");
	return;
}


include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();

$id = postvalue("id")!=="" ? postvalue("id") : 1;
//array of params for classes
$params = array("pageType" => PAGE_MENU,"id" =>$id, "menuTablesArr"=>$menuTablesArr, "isGroupSecurity"=>$isGroupSecurity);
$params["xt"]=&$xt;
$params["tName"]= "global";
$params["needSearchClauseObj"] = false;
$pageObject = new RunnerPage($params);


// button handlers file names



// add onload event

//	Before Process event
if($globalEvents->exists("BeforeProcessMenu"))
	$globalEvents->BeforeProcessMenu($conn);



$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/jquery.js\"></script>".
"<script type=\"text/javascript\" src=\"include/jsfunctions.js\"></script>";

if ($pageObject->debugJSMode === true)
{

	/*$pageObject->body['begin'] .= "<script type=\"text/javascript\" src=\"include/runnerJS/Runner.js\"></script>\r\n".
		"<script type=\"text/javascript\" src=\"include/runnerJS/Util.js\"></script>\r\n".
		"<script type=\"text/javascript\" src=\"include/runnerJS/Observer.js\"></script>\r\n";*/
	$pageObject->body['begin'] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerBase.js\"></script>\r\n";
}
else
{
	$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/runnerJS/RunnerBase.js\"></script>";
}

$pageObject->addCommonJs();

//fill jsSettings and ControlsHTMLMap
$pageObject->fillSetCntrlMaps();
$pageObject->body['end'] .= '<script>';
$pageObject->body['end'] .= "window.controlsMap = '".jsreplace(my_json_encode($pageObject->controlsHTMLMap))."';";
$pageObject->body['end'] .= "window.settings = '".jsreplace(my_json_encode($pageObject->jsSettings))."';";
$pageObject->body["end"] .= $pageObject->PrepareJS()."</script>";

$xt->assignbyref("body",$pageObject->body);

$xt->assign("username",$_SESSION["UserID"]);
$xt->assign("changepwd_link",$_SESSION["AccessLevel"] != ACCESS_LEVEL_GUEST);
$xt->assign("changepwdlink_attrs","onclick=\"window.location.href='changepwd.php';return false;\"");
$xt->assign("logoutlink_attrs","onclick=\"window.location.href='login.php?a=logout';return false;\"");

$xt->assign("loggedas_block",true);
$xt->assign("logout_link",true);


$menuInfo = $pageObject->createOldMenu();

if($pageObject->isCreateMenu())
	$xt->assign("menustyle_block",true);




if($menuInfo['menuTablesCount']<2 && strlen($menuInfo['urlForRedirect']))
{
	header("Location: ".$menuInfo['urlForRedirect']); 
	exit();
}

$templatefile="menu.htm";
if($globalEvents->exists("BeforeShowMenu"))
	$globalEvents->BeforeShowMenu($xt, $templatefile);

$xt->display($templatefile);
?>