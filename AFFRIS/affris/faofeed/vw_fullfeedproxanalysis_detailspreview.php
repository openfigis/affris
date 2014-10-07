<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/vw_fullfeedproxanalysis_variables.php");

$mode=postvalue("mode");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

include('include/xtempl.php');
$xt = new Xtempl();


$recordsCounter = 0;

//	process masterkey value
$mastertable=postvalue("mastertable");
if($mastertable!="")
{
	$_SESSION[$strTableName."_mastertable"]=$mastertable;
//	copy keys to session
	$i=1;
	while(isset($_REQUEST["masterkey".$i]))
	{
		$_SESSION[$strTableName."_masterkey".$i]=$_REQUEST["masterkey".$i];
		$i++;
	}
	if(isset($_SESSION[$strTableName."_masterkey".$i]))
		unset($_SESSION[$strTableName."_masterkey".$i]);
}
else
	$mastertable=$_SESSION[$strTableName."_mastertable"];

//$strSQL = $gstrSQL;

if($mastertable=="vw_feedingredient")
{
	$where ="";
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$_SESSION[$strTableName."_masterkey1"]);
}
if($mastertable=="vw_feed")
{
	$where ="";
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$_SESSION[$strTableName."_masterkey1"]);
}
if($mastertable=="vw_feedspec")
{
	$where ="";
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$_SESSION[$strTableName."_masterkey1"]);
}


$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount=gSQLRowCount($where,0);

$xt->assign("row_count",$rowcount);
if ( $rowcount ) {
	$xt->assign("details_data",true);
	$rs=db_query($strSQL,$conn);

	$display_count=10;
	if($mode=="inline")
		$display_count*=2;
	if($rowcount>$display_count+2)
	{
		$xt->assign("display_first",true);
		$xt->assign("display_count",$display_count);
	}
	else
		$display_count = $rowcount;

	$rowinfo=array();
		
	while (($data = db_fetch_array($rs)) && $recordsCounter<$display_count) {
		$recordsCounter++;
		$row=array();
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["FeedID"]));

	
	//	Description - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Description", ""),"field=Description".$keylink,"",MODE_PRINT);
			$row["Description_value"]=$value;
	//	UnitName - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"UnitName", ""),"field=UnitName".$keylink,"",MODE_PRINT);
			$row["UnitName_value"]=$value;
	//	ETValue - Number
		    $value="";
				$value = ProcessLargeText(GetData($data,"ETValue", "Number"),"field=ETValue".$keylink,"",MODE_PRINT);
			$row["ETValue_value"]=$value;
	$rowinfo[]=$row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
} else {
}
$xt->display("vw_fullfeedproxanalysis_detailspreview.htm");
if($mode!="inline")
	echo "counterSeparator".postvalue("counter");
?>