<?php
$strTableName="vw_fullfeedelementanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_fullfeedelementanalysis";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID,  ElementID,  EName,  CommonName,  TagName,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  iValue ";
$gsqlFrom="FROM vw_fullfeedelementanalysis ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_fullfeedelementanalysis_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>