<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 


$mainTable = postvalue('mainTable');
if (!checkTableName($mainTable))
	exit(0);
include("include/".$mainTable."_variables.php");



	if(!@$_SESSION["UserID"]) { 
		return;	
	}
	if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { 
		return;	
	}

$mainField = postvalue('mainField');

$autoCompleteFields = array();					

	if($strTableName == "vw_ingredientclass" && $mainField == "Description2"){
		$autoCompleteFields[] = array('masterF'=>"IName", 'lookupF'=>"IName");
	$lookupTable = "vw_ingredientclass";	
	}

$linkField = GetFullFieldName(postvalue('linkField'), $lookupTable);
$linkFieldVal = postvalue('linkFieldVal');

$strSQL = 'SELECT ';
for($i=0; $i<count($autoCompleteFields); $i++){
	$strSQL .= AddFieldWrappers(GetFullFieldName($autoCompleteFields[$i]['lookupF'], $lookupTable)).', ';
}
$strSQL = substr($strSQL, 0, strlen($strSQL)-2);

$linkFieldVal = make_db_value($mainField, $linkFieldVal);

$strSQL .= " FROM ".AddTableWrappers($lookupTable);
$strSQL .= " WHERE ".AddFieldWrappers($linkField).'='.$linkFieldVal;

$rs = db_query($strSQL, $conn);	
$row = db_fetch_array($rs);
db_close($conn);

	
$respObj = array('success'=>true, 'data'=>$row);
echo my_json_encode($respObj);
?>