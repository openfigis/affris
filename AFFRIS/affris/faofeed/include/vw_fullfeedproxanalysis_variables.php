<?php
$strTableName="vw_fullfeedproxanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullfeedproxanalysis";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID,   ElementTypeID,   Description,   isShownDetail,   ETTagName,   UnitID,   UnitName,   UnitSymbol,   UnitDecimal,   ETValue ";
$gsqlFrom="FROM vw_fullfeedproxanalysis ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_fullfeedproxanalysis_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>