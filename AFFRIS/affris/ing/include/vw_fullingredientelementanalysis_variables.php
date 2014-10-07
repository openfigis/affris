<?php
$strTableName="vw_fullingredientelementanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullingredientelementanalysis";

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  ElementID,  EName,  CommonName,  TagName,  ElementTypeID,  Description,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  IValue";
$gsqlFrom="FROM vw_fullingredientelementanalysis";
$gsqlWhereExpr="";
$gsqlTail="";

include(getabspath("include/vw_fullingredientelementanalysis_settings.php"));

// alias for 'SQLQuery' object
$gQuery = &$queryData_vw_fullingredientelementanalysis;
$eventObj = &$tableEvents["vw_fullingredientelementanalysis"];

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>