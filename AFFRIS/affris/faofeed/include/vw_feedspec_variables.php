<?php
$strTableName="vw_feedspec";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_feedspec";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT FeedID AS FeedID,  FName AS Feed,  BrandName AS Brand,  Technology AS Technology,  FeedYear AS `Feed Year`,  Stage AS Stage,  FCountryID,  CountryOrigin AS `Country Origin`,  FIDSourceID,  FisDetail AS Details,  FDataSource AS `Data Source`,  FeedTypeID,  FeedType AS `Type`,  SpeciesID,  SpecName AS `Species Name`,  CommonName AS `Common Name`,  Hybrid AS Hybrid,  Variety AS Variety,  Family AS Family,  `Group` AS `Group`,  Genus AS Genus,  Environment AS Environment,  FeedHabit AS Habit,  Country AS Country,  SpecYear AS `Species Year` ";
$gsqlFrom="FROM vw_feedspec ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_feedspec_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>