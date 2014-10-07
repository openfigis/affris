<?php
include("vw_feedingredient_settings.php");

function DisplayMasterTableInfo_vw_feedingredient($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="vw_feedingredient";

//$strSQL = "SELECT  FeedID,  FName,  FisDetail,  IngredientID,  IName,  IisDetail,  FValue  FROM vw_feedingredient  ";

$sqlHead="SELECT FeedID,  FName,  FisDetail,  IngredientID,  IName,  IisDetail,  FValue ";
$sqlFrom="FROM vw_feedingredient ";
$sqlWhere="";
$sqlTail="";

$where="";

if($detailtable=="vw_feedanalysis")
{
		$where.= GetFullFieldName("FisDetail")."=".make_db_value("FisDetail",$keys[1-1]);
}
if($detailtable=="vw_ingredient")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
}
if($detailtable=="vw_feed")
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

//	IName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IName", ""),"field=IName".$keylink,"",MODE_PRINT);
			$xt->assign("IName_mastervalue",$value);

//	FValue - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"FValue", "Number"),"field=FValue".$keylink,"",MODE_PRINT);
			$xt->assign("FValue_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("vw_feedingredient_masterprint.htm");

}

// events

?>