<?php
$strTableName="vw_antinutritional";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="vw_antinutritional";

$gPageSize=20;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy="order by ".$gstrOrderBy;

$g_orderindexes=array();
$gsqlHead="SELECT IngredientID,  IName,  Description,  AntiID,  AntiFactor,  ToxicLevel,  TreatmentID,  Treatment,  IDSourceID,  DataSource,  PartUsedID,  PartUsed ";
$gsqlFrom="FROM vw_antinutritional ";
$gsqlWhereExpr="";
$gsqlTail="";

include("vw_antinutritional_settings.php");

$reportCaseSensitiveGroupFields = false;

$gstrSQL = gSQLWhere("");


?>