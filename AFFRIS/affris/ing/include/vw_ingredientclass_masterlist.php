<?php
include(getabspath("include/vw_ingredientclass_settings.php"));

function DisplayMasterTableInfo_vw_ingredientclass($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	$oldTableName=$strTableName;
	$strTableName="vw_ingredientclass";

//$strSQL = "SELECT  IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  IngredientClassID,  IngredientClass,  Description4  FROM vw_ingredientclass  WHERE (IisDetail =1)  ORDER BY IName, IngredientSpecID  ";

$sqlHead="SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  IngredientClassID,  IngredientClass,  Description4";
$sqlFrom="FROM vw_ingredientclass";
$sqlWhere="(IisDetail =1)";
$sqlTail="";

$where="";
$mKeys = array();
$showKeys = "";

if($detailtable=="vw_fullingredientelementanalysis")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
	$showKeys .= " Ingredient ID: ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable=="vw_fullingredientproxanalysis")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
	$showKeys .= " Ingredient ID: ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
if($detailtable=="vw_ingredientspecassociation")
{
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys[1-1]);
	$showKeys .= " Ingredient ID: ".$keys[1-1];
	$xt->assign('showKeys',$showKeys);
}
	if(!$where)
	{
		$strTableName=$oldTableName;
		return;
	}
	$str = SecuritySQL("Search");
	if(strlen($str))
		$where.=" and ".$str;

	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	$strSQL= $sqlHead.' '.$sqlFrom.$strWhere.$sqlTail;

//	$strSQL=AddWhere($strSQL,$where);
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$data=db_fetch_array($rs);
	if(!$data)
	{
		$strTableName=$oldTableName;
		return;
	}
	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["IngredientID"]));
	


//	IName - 
			$value="";
				$value=DisplayLookupWizard("IName",$data["IName"],$data,$keylink,MODE_LIST);
			$xt->assign("IName_mastervalue",$value);

//	IfeedNo - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IfeedNo", ""),"field=IfeedNo".$keylink);
			$xt->assign("IfeedNo_mastervalue",$value);

//	Description1 - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Description1", ""),"field=Description1".$keylink);
			$xt->assign("Description1_mastervalue",$value);

//	Description2 - 
			$value="";
				$value=DisplayLookupWizard("Description2",$data["Description2"],$data,$keylink,MODE_LIST);
			$xt->assign("Description2_mastervalue",$value);

//	Description3 - 
			$value="";
				$value=DisplayLookupWizard("Description3",$data["Description3"],$data,$keylink,MODE_LIST);
			$xt->assign("Description3_mastervalue",$value);

//	DataSource - 
			$value="";
				$value = ProcessLargeText(GetData($data,"DataSource", ""),"field=DataSource".$keylink);
			$xt->assign("DataSource_mastervalue",$value);

//	ICountry - 
			$value="";
				$value = ProcessLargeText(GetData($data,"ICountry", ""),"field=ICountry".$keylink);
			$xt->assign("ICountry_mastervalue",$value);

//	Species - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Species", ""),"field=Species".$keylink);
			$xt->assign("Species_mastervalue",$value);

//	IngredientClass - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IngredientClass", ""),"field=IngredientClass".$keylink);
			$xt->assign("IngredientClass_mastervalue",$value);
	$xt->display("vw_ingredientclass_masterlist.htm");
	$strTableName=$oldTableName;
}

?>