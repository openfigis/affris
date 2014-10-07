<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_feedanalysis_variables.php");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}



$response = array();

$suggestAllContent=true;
if(postvalue("start"))
	$suggestAllContent=false;

if (isset($_GET['searchFor']) && postvalue('searchFor') != '') {

	$searchFor = postvalue('searchFor');
	$searchField = GoodFieldName( postvalue('searchField') );
	
		
	$searchByField = ($searchField == '' || $searchField=="FName");
	if($searchByField)
	{
	
		$field="FName";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="BrandName");
	if($searchByField)
	{
	
		$field="BrandName";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="Technology");
	if($searchByField)
	{
	
		$field="Technology";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="FeedYear");
	if($searchByField)
	{
	
		$field="FeedYear";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="Stage");
	if($searchByField)
	{
	
		$field="Stage";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="CountryOrigin");
	if($searchByField)
	{
	
		$field="CountryOrigin";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
			
	$searchByField = ($searchField == '' || $searchField=="FDataSource");
	if($searchByField)
	{
	
		$field="FDataSource";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="FeedType");
	if($searchByField)
	{
	
		$field="FeedType";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="FeedAnalysisType");
	if($searchByField)
	{
	
		$field="FeedAnalysisType";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		
	$searchByField = ($searchField == '' || $searchField=="FAValue");
	if($searchByField)
	{
	
		$field="FAValue";
		if(CheckFieldPermissions($field))
		{
		$whereCondition = ($suggestAllContent) ? " like '%".db_addslashes($searchFor)."%'" : " like '".db_addslashes($searchFor)."%'";
		$whereCondition = " ".GetFullFieldName($field).$whereCondition;
		$whereCondition = whereAdd($gsqlWhereExpr,$whereCondition);
		$strSQL = "SELECT DISTINCT ".GetFullFieldName($field)." ".$gsqlFrom." WHERE ".$whereCondition.$gsqlTail." ORDER BY 1 LIMIT 10";
		$rs=db_query($strSQL,$conn);
			$i=0;
			while ($row = db_fetch_numarray($rs)) 
			{
				$i++;
				$pos = strpos($row[0],"\n");
				if ($pos!==FALSE) {
					$response[] = substr($row[0],0,$pos);
				} else {
					$response[] = $row[0];
				}
				if ($i>10)
					break;
			}
		}
		}
		db_close($conn);
}

sort($response);

for( $i=0;$i<10 && $i<count($response);$i++) 
{
	$value=$response[$i];
	if($suggestAllContent)
	{
		$str=substr($value,0,50);
		$pos=my_stripos($str,$searchFor,0);
		if($pos===false)
			echo $str;
		else
			echo substr($str,0,$pos)."<b>".substr($str,$pos,strlen($searchFor))."</b>".substr($str,$pos+strlen($searchFor));
		echo "\n";
	}
	else
		echo  "<b>".substr($value,0,strlen($searchFor))."</b>".substr($value,strlen($searchFor),50-strlen($searchFor))."\n";
}
?>