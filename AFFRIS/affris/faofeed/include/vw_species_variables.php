<?php
$strTableName="vw_species";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_species";

$gPageSize=15;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT SpeciesID,  SpecName,  CommonName,  Hybrid,  Variety,  Family,  `Group`,  Genus,  Environment,  FeedHabit,  Country,  SpecYear ";
$gsqlFrom="FROM vw_species ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_species_settings.php");
include("vw_species_events.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>