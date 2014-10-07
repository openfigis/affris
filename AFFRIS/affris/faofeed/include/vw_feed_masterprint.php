<?php
include("vw_feed_settings.php");

function DisplayMasterTableInfo_vw_feed($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="vw_feed";

//$strSQL = "SELECT  FeedID,  FName,  BrandName,  Technology,  FeedYear,  Stage,  FCountryID,  CountryOrigin,  FIDSourceID,  FisDetail,  FDataSource,  FeedTypeID,  FeedType  FROM vw_feed  ";

$sqlHead="SELECT FeedID,  FName,  BrandName,  Technology,  FeedYear,  Stage,  FCountryID,  CountryOrigin,  FIDSourceID,  FisDetail,  FDataSource,  FeedTypeID,  FeedType ";
$sqlFrom="FROM vw_feed ";
$sqlWhere="";
$sqlTail="";

$where="";

if($detailtable=="vw_feedanalysis")
{
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys[1-1]);
}
if($detailtable=="vw_fullfeedproxanalysis")
{
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys[1-1]);
}
if($detailtable=="vw_fullfeedelementanalysis")
{
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys[1-1]);
}
if(!$where)
{
	$strTableName=$oldTableName;
	return;
}
	$str = SecuritySQL("Export");
	if(strlen($str))
		$where.=" and ".$str;
	
	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL= $sqlHead.$sqlFrom.$strWhere.$sqlTail;

//	$strSQL=AddWhere($strSQL,$where);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data=db_fetch_array($rs);
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["FeedID"]));
	


//	FName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"FName", ""),"field=FName".$keylink,"",MODE_PRINT);
			$xt->assign("FName_mastervalue",$value);

//	BrandName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"BrandName", ""),"field=BrandName".$keylink,"",MODE_PRINT);
			$xt->assign("BrandName_mastervalue",$value);

//	Technology - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Technology", ""),"field=Technology".$keylink,"",MODE_PRINT);
			$xt->assign("Technology_mastervalue",$value);

//	FeedYear - 
			$value="";
				$value = ProcessLargeText(GetData($data,"FeedYear", ""),"field=FeedYear".$keylink,"",MODE_PRINT);
			$xt->assign("FeedYear_mastervalue",$value);

//	Stage - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Stage", ""),"field=Stage".$keylink,"",MODE_PRINT);
			$xt->assign("Stage_mastervalue",$value);

//	CountryOrigin - 
			$value="";
				$value = ProcessLargeText(GetData($data,"CountryOrigin", ""),"field=CountryOrigin".$keylink,"",MODE_PRINT);
			$xt->assign("CountryOrigin_mastervalue",$value);

//	FDataSource - 
			$value="";
				$value = ProcessLargeText(GetData($data,"FDataSource", ""),"field=FDataSource".$keylink,"",MODE_PRINT);
			$xt->assign("FDataSource_mastervalue",$value);

//	FeedType - 
			$value="";
				$value = ProcessLargeText(GetData($data,"FeedType", ""),"field=FeedType".$keylink,"",MODE_PRINT);
			$xt->assign("FeedType_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("vw_feed_masterprint.htm");

}

// events

?>