<?php
$strTableName="vw_fullingredientelementanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullingredientelementanalysis";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,   ElementID,   EName,   CommonName,   TagName,   ElementTypeID,   Description,   UnitID,   UnitName,   UnitSymbol,   UnitDecimal,   IValue ";
$gsqlFrom="FROM vw_fullingredientelementanalysis ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_fullingredientelementanalysis_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>