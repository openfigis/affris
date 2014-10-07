<?php
$strTableName="vw_ingredientclass";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_ingredientclass";

$gstrOrderBy="ORDER BY IName, IngredientSpecID";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(2, (1 ? "ASC" : "DESC"), "IName");
$g_orderindexes[] = array(12, (1 ? "ASC" : "DESC"), "IngredientSpecID");
$gsqlHead="SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  IngredientClassID,  IngredientClass,  Description4";
$gsqlFrom="FROM vw_ingredientclass";
$gsqlWhereExpr="(IisDetail =1)";
$gsqlTail="";

include(getabspath("include/vw_ingredientclass_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_vw_ingredientclass;
$eventObj = &$tableEvents["vw_ingredientclass"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>