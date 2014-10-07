<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/vw_feedanalysis_variables.php");

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
		$where.= GetFullFieldName("FisDetail")."=".make_db_value("FisDetail",$_SESSION[$strTableName."_masterkey1"]);
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

	
	//	CountryOrigin - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"CountryOrigin", ""),"field=CountryOrigin".$keylink,"",MODE_PRINT);
			$row["CountryOrigin_value"]=$value;
	//	FisDetail - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"FisDetail", ""),"field=FisDetail".$keylink,"",MODE_PRINT);
			$row["FisDetail_value"]=$value;
	//	FDataSource - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"FDataSource", ""),"field=FDataSource".$keylink,"",MODE_PRINT);
			$row["FDataSource_value"]=$value;
	//	FeedType - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"FeedType", ""),"field=FeedType".$keylink,"",MODE_PRINT);
			$row["FeedType_value"]=$value;
	//	FeedAnalysisType - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"FeedAnalysisType", ""),"field=FeedAnalysisType".$keylink,"",MODE_PRINT);
			$row["FeedAnalysisType_value"]=$value;
	//	FAValue - Number
		    $value="";
				$value = ProcessLargeText(GetData($data,"FAValue", "Number"),"field=FAValue".$keylink,"",MODE_PRINT);
			$row["FAValue_value"]=$value;
	//	isShownDetail - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"isShownDetail", ""),"field=isShownDetail".$keylink,"",MODE_PRINT);
			$row["isShownDetail_value"]=$value;
	$rowinfo[]=$row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
} else {
}
$xt->display("vw_feedanalysis_detailspreview.htm");
if($mode!="inline")
	echo "counterSeparator".postvalue("counter");
?>