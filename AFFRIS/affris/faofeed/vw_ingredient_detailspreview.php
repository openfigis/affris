<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include("include/vw_ingredient_variables.php");

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
		$where.= GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$_SESSION[$strTableName."_masterkey1"]);
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
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["IngredientID"]));

	
	//	IName - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"IName", ""),"field=IName".$keylink,"",MODE_PRINT);
			$row["IName_value"]=$value;
	//	IfeedNo - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"IfeedNo", ""),"field=IfeedNo".$keylink,"",MODE_PRINT);
			$row["IfeedNo_value"]=$value;
	//	Description1 - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Description1", ""),"field=Description1".$keylink,"",MODE_PRINT);
			$row["Description1_value"]=$value;
	//	Description2 - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Description2", ""),"field=Description2".$keylink,"",MODE_PRINT);
			$row["Description2_value"]=$value;
	//	Description3 - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Description3", ""),"field=Description3".$keylink,"",MODE_PRINT);
			$row["Description3_value"]=$value;
	//	DataSource - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"DataSource", ""),"field=DataSource".$keylink,"",MODE_PRINT);
			$row["DataSource_value"]=$value;
	//	ICountry - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"ICountry", ""),"field=ICountry".$keylink,"",MODE_PRINT);
			$row["ICountry_value"]=$value;
	//	Species - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Species", ""),"field=Species".$keylink,"",MODE_PRINT);
			$row["Species_value"]=$value;
	$rowinfo[]=$row;
	}
	$xt->assign_loopsection("details_row",$rowinfo);
} else {
}
$xt->display("vw_ingredient_detailspreview.htm");
if($mode!="inline")
	echo "counterSeparator".postvalue("counter");
?>