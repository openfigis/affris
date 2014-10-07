<?php
$strTableName="vw_ingredientspecassociation";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_ingredientspecassociation";

$gstrOrderBy="ORDER BY IName";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$g_orderindexes[] = array(2, (1 ? "ASC" : "DESC"), "IName");
$gsqlHead="SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  SpeciesID,  SpecName,  CommonName,  Hybrid,  Variety,  Family,  `Group`,  Genus,  Environment,  FeedHabit,  Country,  SpecYear,  `lower`,  `upper`";
$gsqlFrom="FROM vw_ingredientspecassociation";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/vw_ingredientspecassociation_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_vw_ingredientspecassociation;
$eventObj = &$tableEvents["vw_ingredientspecassociation"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>