<?php
$strTableName="vw_feed";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_feed";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID,  FName,  BrandName,  Technology,  FeedYear,  Stage,  FCountryID,  CountryOrigin,  FIDSourceID,  FisDetail,  FDataSource,  FeedTypeID,  FeedType ";
$gsqlFrom="FROM vw_feed ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_feed_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>