<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/vw_species_variables.php");



$field = postvalue('searchField');
$value = postvalue('searchFor');
$lookupValue = postvalue('lookupValue');
$LookupSQL = "";
$response = array();
$output = "";

	if(!@$_SESSION["UserID"]) { return;	}
	if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search")) { return;	}

	if($field=="Group") 
	{
	
		$LookupSQL = "SELECT ";
		$LookupSQL .= "`Description`";
		$LookupSQL .= ",`Description`";
		$LookupSQL .= " FROM `tb_specgroup` ";
		$LookupSQL .= " WHERE ";
		$LookupSQL .= "`Description` LIKE '".db_addslashes($value)."%'";
	}
	if($field=="FeedHabit") 
	{
	
		$LookupSQL = "SELECT ";
		$LookupSQL .= "`Description`";
		$LookupSQL .= ",`Description`";
		$LookupSQL .= " FROM `tb_specfeedhabit` ";
		$LookupSQL .= " WHERE ";
		$LookupSQL .= "`Description` LIKE '".db_addslashes($value)."%'";
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


for($i=0;$i<count($response) && $i<40;$i++)
	echo $response[$i]."\n";
/*
if ($output = array_chunk($response,40)) {
	foreach( $output[0] as $value ) {
		echo $value."\n";
		//echo str_replace("\n","\\n",$value)."\n";
	}
}
*/
?>