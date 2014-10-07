<?php
$strTableName="vw_fullingredientproxanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullingredientproxanalysis";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  ElementTypeID,  Description,  UnitName,  UnitSymbol,  UnitDecimal,  ETValue ";
$gsqlFrom="FROM vw_fullingredientproxanalysis ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_fullingredientproxanalysis_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>