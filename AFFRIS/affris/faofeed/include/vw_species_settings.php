<?php

//	field labels
$fieldLabelsvw_species = array();
$fieldLabelsvw_species["English"]=array();
$fieldLabelsvw_species["English"]["SpeciesID"] = "Species ID";
$fieldLabelsvw_species["English"]["SpecName"] = "Species Name";
$fieldLabelsvw_species["English"]["CommonName"] = "Common Name";
$fieldLabelsvw_species["English"]["Hybrid"] = "Hybrid cross";
$fieldLabelsvw_species["English"]["Variety"] = "Variety";
$fieldLabelsvw_species["English"]["Family"] = "Family";
$fieldLabelsvw_species["English"]["Group"] = "Group";
$fieldLabelsvw_species["English"]["Genus"] = "Genus";
$fieldLabelsvw_species["English"]["Environment"] = "Environment";
$fieldLabelsvw_species["English"]["FeedHabit"] = "Feeding Habit";
$fieldLabelsvw_species["English"]["Country"] = "Country";
$fieldLabelsvw_species["English"]["SpecYear"] = "Species Year";


$tdatavw_species=array();
	 $tdatavw_species[".NumberOfChars"]=80; 
	$tdatavw_species[".ShortName"]="vw_species";
	$tdatavw_species[".OwnerID"]="";
	$tdatavw_species[".OriginalTable"]="vw_species";

	$keys=array();
	$keys[]="SpeciesID";
	$tdatavw_species[".Keys"]=$keys;

	
//	SpeciesID
	$fdata = array();
	 $fdata["Label"]="Species ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpeciesID";
		$fdata["FullName"]= "SpeciesID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_species["SpeciesID"]=$fdata;
	
//	SpecName
	$fdata = array();
	 $fdata["Label"]="Species Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpecName";
		$fdata["FullName"]= "SpecName";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=500";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["SpecName"]=$fdata;
	
//	CommonName
	$fdata = array();
	 $fdata["Label"]="Common Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CommonName";
		$fdata["FullName"]= "CommonName";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=100";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["CommonName"]=$fdata;
	
//	Hybrid
	$fdata = array();
	 $fdata["Label"]="Hybrid cross"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Hybrid";
		$fdata["FullName"]= "Hybrid";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Hybrid"]=$fdata;
	
//	Variety
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Variety";
		$fdata["FullName"]= "Variety";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Variety"]=$fdata;
	
//	Family
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Family";
		$fdata["FullName"]= "Family";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Family"]=$fdata;
	
//	Group
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
		
		$fdata["LookupType"]=1;
			$fdata["LinkField"]="`Description`";
	$fdata["LinkFieldType"]=200;
		$fdata["DisplayField"]="`Description`";
	$fdata["LookupTable"]="tb_specgroup";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Group";
		$fdata["FullName"]= "`Group`";
	
	
	
	
	$fdata["Index"]= 7;
	
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Group"]=$fdata;
	
//	Genus
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Genus";
		$fdata["FullName"]= "Genus";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Genus"]=$fdata;
	
//	Environment
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Environment";
		$fdata["FullName"]= "Environment";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Environment"]=$fdata;
	
//	FeedHabit
	$fdata = array();
	 $fdata["Label"]="Feeding Habit"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
		
		$fdata["LookupType"]=1;
			$fdata["LinkField"]="`Description`";
	$fdata["LinkFieldType"]=200;
		$fdata["DisplayField"]="`Description`";
	$fdata["LookupTable"]="tb_specfeedhabit";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedHabit";
		$fdata["FullName"]= "FeedHabit";
	
	
	
	
	$fdata["Index"]= 10;
	
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["FeedHabit"]=$fdata;
	
//	Country
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Country";
		$fdata["FullName"]= "Country";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_species["Country"]=$fdata;
	
//	SpecYear
	$fdata = array();
	 $fdata["Label"]="Species Year"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpecYear";
		$fdata["FullName"]= "SpecYear";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_species["SpecYear"]=$fdata;
$tables_data["vw_species"]=&$tdatavw_species;
$field_labels["vw_species"] = &$fieldLabelsvw_species;

?>