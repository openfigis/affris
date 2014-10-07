<?php
$strTableName="vw_fullingredientproxanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullingredientproxanalysis";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  ElementTypeID,  Description,  UnitName,  UnitSymbol,  UnitDecimal,  ETValue,  IisDetail";
$gsqlFrom="FROM vw_fullingredientproxanalysis";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/vw_fullingredientproxanalysis_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_vw_fullingredientproxanalysis;
$eventObj = &$tableEvents["vw_fullingredientproxanalysis"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>