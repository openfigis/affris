<?php
$strTableName="vw_feedingredient";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_feedingredient";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID,  FName,  FisDetail,  IngredientID,  IName,  IisDetail,  FValue ";
$gsqlFrom="FROM vw_feedingredient ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_feedingredient_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>