<?php
$strTableName="vw_digestibility";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_digestibility";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  IName,  Description,  SpeciesID,  SpecName,  CommonName,  DigestTypeID,  DigestibilityType,  DValue,  Country,  DataSource ";
$gsqlFrom="FROM vw_digestibility ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_digestibility_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>