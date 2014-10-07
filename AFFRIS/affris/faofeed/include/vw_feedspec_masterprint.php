<?php
include("vw_feedspec_settings.php");

function DisplayMasterTableInfo_vw_feedspec($params)
{
	$detailtable=$params["detailtable"];
	$keys=$params["keys"];
	global $conn,$strTableName;
	$xt = new Xtempl();
	
	$oldTableName=$strTableName;
	$strTableName="vw_feedspec";

//$strSQL = "SELECT  FeedID AS FeedID,  FName AS Feed,  BrandName AS Brand,  Technology AS Technology,  FeedYear AS `Feed Year`,  Stage AS Stage,  FCountryID,  CountryOrigin AS `Country Origin`,  FIDSourceID,  FisDetail AS Details,  FDataSource AS `Data Source`,  FeedTypeID,  FeedType AS `Type`,  SpeciesID,  SpecName AS `Species Name`,  CommonName AS `Common Name`,  Hybrid AS Hybrid,  Variety AS Variety,  Family AS Family,  `Group` AS `Group`,  Genus AS Genus,  Environment AS Environment,  FeedHabit AS Habit,  Country AS Country,  SpecYear AS `Species Year`  FROM vw_feedspec  ";

$sqlHead="SELECT FeedID AS FeedID,  FName AS Feed,  BrandName AS Brand,  Technology AS Technology,  FeedYear AS `Feed Year`,  Stage AS Stage,  FCountryID,  CountryOrigin AS `Country Origin`,  FIDSourceID,  FisDetail AS Details,  FDataSource AS `Data Source`,  FeedTypeID,  FeedType AS `Type`,  SpeciesID,  SpecName AS `Species Name`,  CommonName AS `Common Name`,  Hybrid AS Hybrid,  Variety AS Variety,  Family AS Family,  `Group` AS `Group`,  Genus AS Genus,  Environment AS Environment,  FeedHabit AS Habit,  Country AS Country,  SpecYear AS `Species Year` ";
$sqlFrom="FROM vw_feedspec ";
$sqlWhere="";
$sqlTail="";

$where="";

if($detailtable=="vw_feedanalysis")
{
		$where.= GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys[1-1]);
}
if($detailtable=="vw_feedingredient")
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
	


//	Feed - 
			$value="";
				$value=DisplayLookupWizard("Feed",$data["Feed"],$data,$keylink,MODE_PRINT);
			$xt->assign("Feed_mastervalue",$value);

//	Brand - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Brand", ""),"field=Brand".$keylink,"",MODE_PRINT);
			$xt->assign("Brand_mastervalue",$value);

//	Technology - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Technology", ""),"field=Technology".$keylink,"",MODE_PRINT);
			$xt->assign("Technology_mastervalue",$value);

//	Feed Year - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Feed Year", ""),"field=Feed+Year".$keylink,"",MODE_PRINT);
			$xt->assign("Feed_Year_mastervalue",$value);

//	Stage - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Stage", ""),"field=Stage".$keylink,"",MODE_PRINT);
			$xt->assign("Stage_mastervalue",$value);

//	Country Origin - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Country Origin", ""),"field=Country+Origin".$keylink,"",MODE_PRINT);
			$xt->assign("Country_Origin_mastervalue",$value);

//	Details - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Details", ""),"field=Details".$keylink,"",MODE_PRINT);
			$xt->assign("Details_mastervalue",$value);

//	Data Source - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Data Source", ""),"field=Data+Source".$keylink,"",MODE_PRINT);
			$xt->assign("Data_Source_mastervalue",$value);

//	Type - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Type", ""),"field=Type".$keylink,"",MODE_PRINT);
			$xt->assign("Type_mastervalue",$value);

//	Species Name - 
			$value="";
				$value=DisplayLookupWizard("Species Name",$data["Species Name"],$data,$keylink,MODE_PRINT);
			$xt->assign("Species_Name_mastervalue",$value);

//	Common Name - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Common Name", ""),"field=Common+Name".$keylink,"",MODE_PRINT);
			$xt->assign("Common_Name_mastervalue",$value);

//	Hybrid - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Hybrid", ""),"field=Hybrid".$keylink,"",MODE_PRINT);
			$xt->assign("Hybrid_mastervalue",$value);

//	Variety - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Variety", ""),"field=Variety".$keylink,"",MODE_PRINT);
			$xt->assign("Variety_mastervalue",$value);

//	Family - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Family", ""),"field=Family".$keylink,"",MODE_PRINT);
			$xt->assign("Family_mastervalue",$value);

//	Group - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Group", ""),"field=Group".$keylink,"",MODE_PRINT);
			$xt->assign("Group_mastervalue",$value);

//	Genus - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Genus", ""),"field=Genus".$keylink,"",MODE_PRINT);
			$xt->assign("Genus_mastervalue",$value);

//	Environment - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Environment", ""),"field=Environment".$keylink,"",MODE_PRINT);
			$xt->assign("Environment_mastervalue",$value);

//	Habit - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Habit", ""),"field=Habit".$keylink,"",MODE_PRINT);
			$xt->assign("Habit_mastervalue",$value);

//	Country - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Country", ""),"field=Country".$keylink,"",MODE_PRINT);
			$xt->assign("Country_mastervalue",$value);

//	Species Year - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Species Year", ""),"field=Species+Year".$keylink,"",MODE_PRINT);
			$xt->assign("Species_Year_mastervalue",$value);
	$strTableName=$oldTableName;
	$xt->display("vw_feedspec_masterprint.htm");

}

// events

?>