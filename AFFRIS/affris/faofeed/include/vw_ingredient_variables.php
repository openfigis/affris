<?php
$strTableName="vw_ingredient";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_ingredient";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species ";
$gsqlFrom="FROM vw_ingredient ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_ingredient_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>