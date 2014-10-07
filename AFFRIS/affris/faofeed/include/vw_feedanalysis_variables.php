<?php
$strTableName="vw_feedanalysis";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_feedanalysis";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID,  FName,  BrandName,  Technology,  FeedYear,  Stage,  FCountryID,  CountryOrigin,  FIDSourceID,  FisDetail,  FDataSource,  FeedTypeID,  FeedType,  FeedAnalysisTypeID,  FeedAnalysisType,  FATTagName,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  FAValue,  isShownDetail ";
$gsqlFrom="FROM vw_feedanalysis ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_feedanalysis_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>