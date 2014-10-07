<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 


$table = postvalue("table");
$strTableName = GetTableByShort($table);

if (!checkTableName($table))
{
	exit(0);
}

include("include/".$table."_variables.php");



$field = postvalue('searchField');
$value = postvalue('searchFor');
$lookupValue = postvalue('lookupValue');
$LookupSQL = "";
$response = array();
$output = "";

$strDataSourceTable = GetTableData($strTableName, '.OriginalTable', '');
$strLoginTable = "users";
if ($strDataSourceTable != $strLoginTable)
{
	if(!@$_SESSION["UserID"]) { 
		return;	
	}
	if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}
}
else 
{
	$checkResult = true;
	if($field=="user")
		$checkResult=false;

	if($field=="pass")
		$checkResult=false;

	if($checkResult)
	{
		if(!@$_SESSION["UserID"]) { return;	}
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}
	}
}

$hasWhere = false;


$fieldsArr = GetFieldsList($strTableName);	

foreach ($fieldsArr as $f)
{
	$fEditFormat = GetFieldData($strTableName, $f, 'EditFormat', '');
	if ($fEditFormat != EDIT_FORMAT_LOOKUP_WIZARD || GoodFieldName($f) != $field)
	{
		continue;
	}
	
	$LookupType = GetFieldData($strTableName, $f, 'LookupType', '');
	if ($LookupType == LT_LOOKUPTABLE)
	{
		$LookupSQL = "SELECT ";
		if (GetFieldData($strTableName, $f, 'LookupUnique', false))
		{
			$LookupSQL .= "DISTINCT ";
		}
		$LookupSQL .= GetLWLinkField($f, $strTableName, true);
		
		$LookupSQL .= ",".GetLWDisplayField($f, $strTableName, true);
		
		$LookupSQL .= " FROM ".AddTableWrappers(GetFieldData($strTableName, $f, 'LookupTable', ''))." ";
		
		$strLookupWhere = LookupWhere($f,$strTableName);
		if ($strLookupWhere)
		{
			$LookupSQL.="where (".$strLookupWhere.")  AND ";
		}
		else
		{
			$LookupSQL .= " WHERE ";
		}		
		$LookupSQL .= GetLWDisplayField($f, $strTableName, true)." LIKE '".db_addslashes($value)."%'";
		
		if (GetFieldData($strTableName, $f, 'UseCategory', false) && (postvalue("category") != '' || postvalue('editMode') != MODE_SEARCH))
		{
			$cvalue = make_db_value(GetFieldData($strTableName, $f, 'CategoryControl', ''),postvalue("category"));
			$LookupSQL.=" AND ".AddFieldWrappers(GetFieldData($strTableName, $f, 'CategoryFilter', ''))."=".$cvalue;
		}
		
		if (!GetFieldData($strTableName, $f, 'LookupUnique', false) || nDATABASE_Access != 0)
		{
			$lookupOrderBy = GetFieldData($strTableName, $f, 'LookupOrderBy', '');
			if ($lookupOrderBy)
			{
				$LookupSQL.= " ORDER BY ".AddFieldWrappers($lookupOrderBy);
				if (GetFieldData($strTableName, $f, 'LookupDesc', false))
				{
					$LookupSQL.=" DESC";	
				}
			}
		}
	}
	if (strlen(LookupWhere($f,$strTableName)))
	{
		$hasWhere=true;
	}
}


$rs=db_query($LookupSQL,$conn);

$found=false;
while ($data = db_fetch_numarray($rs)) 
{
	if(!$found && $data[0]==$lookupValue)
		$found=true;
	$response[] = $data[0];
	$response[] = $data[1];
}

if($hasWhere)
{
	if(!$found)
	{
	// try to make query without WHERE expression
		foreach ($fieldsArr as $f)
		{
			$fEditFormat = GetFieldData($strTableName, $f, 'EditFormat', '');
			if ($fEditFormat != EDIT_FORMAT_LOOKUP_WIZARD || GoodFieldName($f) != $field)
			{
				continue;
			}
			$origfield=GetFieldByGoodFieldName($field);
			$lookupValue = make_db_value($origfield,$lookupValue);
			$LookupType = GetFieldData($strTableName, $f, 'LookupType', '');
			if ($LookupType == LT_LOOKUPTABLE)
			{
				$LookupSQL = "SELECT count(*)";
				$LookupSQL .= " FROM ".AddTableWrappers(GetFieldData($strTableName, $f, 'LookupTable', ''))." ";
				if (strlen(LookupWhere($f,$strTableName)))
				{
					$LookupSQL.="where (".LookupWhere($f,$strTableName).")  AND ".GetLWLinkField($f, $strTableName, true)."=".$lookupValue;
				}
				else 
				{
					$LookupSQL .= " WHERE ".GetLWLinkField($f, $strTableName, true)."=".$lookupValue;
				}
				if (GetFieldData($strTableName, $f, 'UseCategory', false))
				{
					$cvalue = make_db_value(GetFieldData($strTableName, $f, 'CategoryControl', '') ,postvalue("category"));
					$LookupSQL.=" AND ".AddFieldWrappers(GetFieldData($strTableName, $f, 'CategoryFilter', ''))."=".$cvalue;
				}
			}
		}


		$rs1=db_query($LookupSQL,$conn);
		$datacount=db_fetch_numarray($rs1);

		if (!$datacount[0])
		{
			foreach ($fieldsArr as $f)
			{
				$fEditFormat = GetFieldData($strTableName, $f, 'EditFormat', '');
				if ($fEditFormat != EDIT_FORMAT_LOOKUP_WIZARD || GoodFieldName($f) != $field)
				{
					continue;
				}
				$LookupType = GetFieldData($strTableName, $f, 'LookupType', '');
				if ($LookupType == LT_LOOKUPTABLE)
				{
					$LookupSQL = "SELECT ";
					if (GetFieldData($strTableName, $f, 'LookupUnique', false))
					{
						$LookupSQL .= "DISTINCT ";
					}
					$LookupSQL .= GetLWLinkField($f, $strTableName, true);
					$LookupSQL .= ",".GetLWDisplayField($f, $strTableName, true);
					
					$LookupSQL .= " FROM ".AddTableWrappers(GetFieldData($strTableName, $f, 'LookupTable', ''))." ";
					$LookupSQL .= " WHERE ".GetLWLinkField($f, $strTableName, true)."=".$lookupValue." AND ";
					
					$LookupSQL .= GetLWDisplayField($f, $strTableName, true)." LIKE '".db_addslashes($value)."%'";
					if (GetFieldData($strTableName, $f, 'UseCategory', false))
					{
						$cvalue = make_db_value(GetFieldData($strTableName, $f, 'CategoryControl', ''),postvalue("category"));
						$LookupSQL.=" AND ".AddFieldWrappers(GetFieldData($strTableName, $f, 'CategoryFilter', ''))."=".$cvalue;
					}
				}
			}

			
			$rs2=db_query($LookupSQL,$conn);
	
			if ($data = db_fetch_numarray($rs2))
			{	
				$response[]=$data[0];
				$response[]=$data[1];
			}
		}
	}
}

$respObj = array('success'=>true, 'data'=>array_slice($response, 0, 40));
echo my_json_encode($respObj);

?>