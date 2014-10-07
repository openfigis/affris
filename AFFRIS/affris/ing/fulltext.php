<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");


include("include/dbcommon.php");

$table = postvalue("table");

if (!checkTableName($table))
	exit(0);
include("include/".$table."_variables.php");

if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$returnJSON = array("success"=>false, "error"=>'');
	echo (my_json_encode($returnJSON));
	return;
}

$id = postvalue("id");
$field = postvalue("field");

if(!CheckFieldPermissions($field))
{
	$returnJSON = array("success"=>false, "error"=>'Error: You have not permission for read this text');
	echo (my_json_encode($returnJSON));
	return;
}
	
if(!$gQuery->HasGroupBy())
{
	// Do not select any fields except current (full text) field.
	// If query has 'group by' clause then other fields are used in it and we may not simply cut 'em off.
	// Just don't do anything in that case.
	$gQuery->RemoveAllFieldsExcept(GetFieldIndex($field));
}

$keysArr = GetTableData($strTableName, '.Keys', array());
$keys = array();
foreach ($keysArr as $ind=>$k)
	$keys[$k] = postvalue("key".($ind+1));

$where = KeyWhere($keys);

$secOpt = GetTableData($strTableName, '.nSecOptions', array());
if ($secOpt == ADVSECURITY_VIEW_OWN)
	$where = whereAdd($where,SecuritySQL("Search"));	

$sql = gSQLWhere($where);

$rs = db_query($sql,$conn);
if(!$rs || !($data=db_fetch_array($rs)))
{
	$returnJSON = array("success"=>false, "error"=>'Error: Wrong SQL query');
	echo (my_json_encode($returnJSON));
	return;
}
$value = nl2br(htmlspecialchars($data[$field]));

$returnJSON = array("success"=>true, "textCont"=>$value);
echo (my_json_encode($returnJSON));
return;
?>
