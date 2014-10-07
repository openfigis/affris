<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
add_nocache_headers();

include('classes/searchclause.php');


$table = postvalue("table");
$strTableName = GetTableByShort($table);

if (!checkTableName($table))
	exit(0);

include("include/".$table."_variables.php");

if(!@$_SESSION["UserID"])
	return;
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
	return;

// if nothing to search 
if (postvalue('searchFor') == '') 
	return;

$sessionPrefix = $strTableName;

// array of fields which were added in wizard for search
$allSearchFields = GetTableData($strTableName, '.allSearchFields', array());

// SearchClause class stuff
if (isset($_SESSION[$sessionPrefix.'_advsearch']))
	$searchClauseObj = unserialize($_SESSION[$sessionPrefix.'_advsearch']);		
else{
	$params = array();
	$params['tName'] = $strTableName;
	$params['searchFieldsArr'] = $allSearchFields;
	$params['sessionPrefix'] = $sessionPrefix;
	$params['panelSearchFields'] = GetTableData($strTableName,".panelSearchFields",array());
	$params['googleLikeFields'] = GetTableData($strTableName,".googleLikeFields",array());
	$this->searchClauseObj = new SearchClause($params);
}
// array of vals
$response = array();

$suggestAllContent=true;
if(postvalue("start"))
	$suggestAllContent=false;

$searchFor = postvalue('searchFor');
$searchField = GoodFieldName(postvalue('searchField'));
$strSecuritySql = SecuritySQL("Search", $strTableName);
		
// proccess fields and create sql
foreach($allSearchFields as $f)
{
	$fType = GetFieldType($f, $strTableName);
	// filter fields by type
	if (!IsCharType($fType) && !IsNumberType($fType) || IsTextType($fType))
	{
		continue;
	}
	// get suggest for field
	if(($searchField == '' || $searchField == GoodFieldName($f)) && CheckFieldPermissions($f))
	{			
		$where = "";
		$having = "";
		if (!$gQuery->IsAggrFuncField(GetFieldIndex($f)-1))
		{
			$where = $searchClauseObj->getSuggestWhere($f, $fType, $suggestAllContent, $searchFor);
		}
		elseif ($gQuery->IsAggrFuncField(GetFieldIndex($f)-1))
		{
			$having = $searchClauseObj->getSuggestWhere($f, $fType, $suggestAllContent, $searchFor);
		}		
		// prepare common vals
		$sqlHead = "SELECT DISTINCT ".GetFullFieldName($f)." ";
		
		$oHaving = $gQuery->Having();
		$sqlHaving = $oHaving->toSql($gQuery);
		
		$sqlGroupBy = $gQuery->GroupByToSql();
		
		$where = whereAdd($where, $strSecuritySql);
		
		$strSQL = gSQLWhere_having($sqlHead, $gsqlFrom, $gsqlWhereExpr, $sqlGroupBy, $sqlHaving, $where, $having);
		
			$strSQL .= " ORDER BY 1 LIMIT 10 ";
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
$response = array_unique($response); 
sort($response);
// all queries worked without errors, add success marker
echo 'suggest_success';
for( $i=0;$i<10 && $i<count($response);$i++) 
{
	$value=$response[$i];
	if($suggestAllContent)
	{
		$str = substr($value,0,50);
		$pos = my_stripos($str,$searchFor,0);
		if($pos===false)
			echo ($str);
		else
			echo (substr($str,0,$pos))."<b>".(substr($str,$pos,strlen($searchFor)))."</b>".(substr($str,$pos+strlen($searchFor)));
		echo "\n";
	}
	else
		echo  "<b>".(substr($value,0,strlen($searchFor)))."</b>".(substr($value,strlen($searchFor),50-strlen($searchFor)))."\n";
}
?>