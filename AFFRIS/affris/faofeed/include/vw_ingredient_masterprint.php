<?php
include("vw_ingredient_settings.php");

function DisplayMasterTableInfo_vw_ingredient($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="vw_ingredient";

//$strSQL = "SELECT  IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species  FROM vw_ingredient  ";

$sqlHead="SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species ";
$sqlFrom="FROM vw_ingredient ";
$sqlWhere="";
$sqlTail="";

$where="";

if($detailtable=="vw_fullingredientelementanalysis")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
}
if($detailtable=="vw_fullingredientproxanalysis")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
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
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["IngredientID"]));
	


//	IName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IName", ""),"field=IName".$keylink,"",MODE_PRINT);
			$xt->assign("IName_mastervalue",$value);

//	IfeedNo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IfeedNo", ""),"field=IfeedNo".$keylink,"",MODE_PRINT);
			$xt->assign("IfeedNo_mastervalue",$value);

//	Description1 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Description1", ""),"field=Description1".$keylink,"",MODE_PRINT);
			$xt->assign("Description1_mastervalue",$value);

//	Description2 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Description2", ""),"field=Description2".$keylink,"",MODE_PRINT);
			$xt->assign("Description2_mastervalue",$value);

//	Description3 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Description3", ""),"field=Description3".$keylink,"",MODE_PRINT);
			$xt->assign("Description3_mastervalue",$value);

//	DataSource - 
			$value="";
				$value = ProcessLargeText(GetData($data,"DataSource", ""),"field=DataSource".$keylink,"",MODE_PRINT);
			$xt->assign("DataSource_mastervalue",$value);

//	ICountry - 
			$value="";
				$value = ProcessLargeText(GetData($data,"ICountry", ""),"field=ICountry".$keylink,"",MODE_PRINT);
			$xt->assign("ICountry_mastervalue",$value);

//	Species - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Species", ""),"field=Species".$keylink,"",MODE_PRINT);
			$xt->assign("Species_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("vw_ingredient_masterprint.htm");

}

// events

?>