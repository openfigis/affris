<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");

if(!@$_SESSION["UserID"])
{
	header("Location: login.php");
	return;
}


include('include/xtempl.php');
$xt = new Xtempl();


//	Before Process event
if(function_exists("BeforeProcessMenu"))
	BeforeProcessMenu($conn);
$xt->assign("body",true);
$body=array();
$body["begin"] = "<script type=\"text/javascript\" src=\"include/jquery.js\"></script>".
"<script type=\"text/javascript\" src=\"include/jsfunctions.js\"></script>";
$xt->assignbyref("body",$body);

$xt->assign("username",$_SESSION["UserID"]);
$xt->assign("changepwd_link",$_SESSION["AccessLevel"] != ACCESS_LEVEL_GUEST);
$xt->assign("changepwdlink_attrs","onclick=\"window.location.href='changepwd.php';return false;\"");
$xt->assign("logoutlink_attrs","onclick=\"window.location.href='login.php?a=logout';\"");

$xt->assign("loggedas_block",true);
$xt->assign("logout_link",true);
$createmenu = false;
$allow_vw_antinutritional=true;
if($allow_vw_antinutritional)
{
	$createmenu=true;
	$xt->assign("vw_antinutritional_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_antinutritional");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_antinutritional_tablelink_attrs","href=\"vw_antinutritional_".$page.".php\"");
}
$allow_vw_digestibility=true;
if($allow_vw_digestibility)
{
	$createmenu=true;
	$xt->assign("vw_digestibility_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_digestibility");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_digestibility_tablelink_attrs","href=\"vw_digestibility_".$page.".php\"");
}
$allow_vw_species=true;
if($allow_vw_species)
{
	$createmenu=true;
	$xt->assign("vw_species_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_species");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_species_tablelink_attrs","href=\"vw_species_".$page.".php\"");
}
$allow_vw_feedspec=true;
if($allow_vw_feedspec)
{
	$createmenu=true;
	$xt->assign("vw_feedspec_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_feedspec");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_feedspec_tablelink_attrs","href=\"vw_feedspec_".$page.".php\"");
}
$allow_vw_feedanalysis=true;
if($allow_vw_feedanalysis)
{
	$createmenu=true;
	$xt->assign("vw_feedanalysis_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_feedanalysis");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_feedanalysis_tablelink_attrs","href=\"vw_feedanalysis_".$page.".php\"");
}
$allow_vw_feedingredient=true;
if($allow_vw_feedingredient)
{
	$createmenu=true;
	$xt->assign("vw_feedingredient_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_feedingredient");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_feedingredient_tablelink_attrs","href=\"vw_feedingredient_".$page.".php\"");
}
$allow_vw_ingredient=true;
if($allow_vw_ingredient)
{
	$createmenu=true;
	$xt->assign("vw_ingredient_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_ingredient");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_ingredient_tablelink_attrs","href=\"vw_ingredient_".$page.".php\"");
}
$allow_vw_feed=true;
if($allow_vw_feed)
{
	$createmenu=true;
	$xt->assign("vw_feed_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_feed");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_feed_tablelink_attrs","href=\"vw_feed_".$page.".php\"");
}
$allow_vw_fullingredientelementanalysis=true;
if($allow_vw_fullingredientelementanalysis)
{
	$createmenu=true;
	$xt->assign("vw_fullingredientelementanalysis_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_fullingredientelementanalysis");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_fullingredientelementanalysis_tablelink_attrs","href=\"vw_fullingredientelementanalysis_".$page.".php\"");
}
$allow_vw_fullingredientproxanalysis=true;
if($allow_vw_fullingredientproxanalysis)
{
	$createmenu=true;
	$xt->assign("vw_fullingredientproxanalysis_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_fullingredientproxanalysis");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_fullingredientproxanalysis_tablelink_attrs","href=\"vw_fullingredientproxanalysis_".$page.".php\"");
}
$allow_vw_fullfeedproxanalysis=true;
if($allow_vw_fullfeedproxanalysis)
{
	$createmenu=true;
	$xt->assign("vw_fullfeedproxanalysis_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_fullfeedproxanalysis");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_fullfeedproxanalysis_tablelink_attrs","href=\"vw_fullfeedproxanalysis_".$page.".php\"");
}
$allow_vw_fullfeedelementanalysis=true;
if($allow_vw_fullfeedelementanalysis)
{
	$createmenu=true;
	$xt->assign("vw_fullfeedelementanalysis_tablelink",true);
	$page="";
		$page="list";
		$strPerm = GetUserPermissions("vw_fullfeedelementanalysis");
	if(strpos($strPerm, "A")!==false && strpos($strPerm, "S")===false)
		$page="add";
	$xt->assign("vw_fullfeedelementanalysis_tablelink_attrs","href=\"vw_fullfeedelementanalysis_".$page.".php\"");
}

if($createmenu)
	$xt->assign("menustyle_block",true);




$templatefile="menu.htm";
if(function_exists("BeforeShowMenu"))
	BeforeShowMenu($xt,$templatefile);

$xt->display($templatefile);
?>