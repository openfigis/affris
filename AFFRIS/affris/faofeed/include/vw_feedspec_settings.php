<?php

//	field labels
$fieldLabelsvw_feedspec = array();
$fieldLabelsvw_feedspec["English"]=array();
$fieldLabelsvw_feedspec["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_feedspec["English"]["Technology"] = "Technology";
$fieldLabelsvw_feedspec["English"]["Stage"] = "Stage";
$fieldLabelsvw_feedspec["English"]["FCountryID"] = "FCountry ID";
$fieldLabelsvw_feedspec["English"]["FIDSourceID"] = "FIDSource ID";
$fieldLabelsvw_feedspec["English"]["FeedTypeID"] = "Feed Type ID";
$fieldLabelsvw_feedspec["English"]["SpeciesID"] = "Species ID";
$fieldLabelsvw_feedspec["English"]["Hybrid"] = "Hybrid";
$fieldLabelsvw_feedspec["English"]["Variety"] = "Variety";
$fieldLabelsvw_feedspec["English"]["Family"] = "Family";
$fieldLabelsvw_feedspec["English"]["Group"] = "Group";
$fieldLabelsvw_feedspec["English"]["Genus"] = "Genus";
$fieldLabelsvw_feedspec["English"]["Environment"] = "Environment";
$fieldLabelsvw_feedspec["English"]["Country"] = "Country";
$fieldLabelsvw_feedspec["English"]["Feed"] = "Feed Name";
$fieldLabelsvw_feedspec["English"]["Brand"] = "Brand";
$fieldLabelsvw_feedspec["English"]["Feed_Year"] = "Feed Year";
$fieldLabelsvw_feedspec["English"]["Country_Origin"] = "Country Origin";
$fieldLabelsvw_feedspec["English"]["Details"] = "Details";
$fieldLabelsvw_feedspec["English"]["Data_Source"] = "Data Source";
$fieldLabelsvw_feedspec["English"]["Type"] = "Feed Type";
$fieldLabelsvw_feedspec["English"]["Species_Name"] = "Species Name";
$fieldLabelsvw_feedspec["English"]["Common_Name"] = "Common Name";
$fieldLabelsvw_feedspec["English"]["Habit"] = "Feeding Habit";
$fieldLabelsvw_feedspec["English"]["Species_Year"] = "Species Year";


$tdatavw_feedspec=array();
	 $tdatavw_feedspec[".NumberOfChars"]=80; 
	$tdatavw_feedspec[".ShortName"]="vw_feedspec";
	$tdatavw_feedspec[".OwnerID"]="";
	$tdatavw_feedspec[".OriginalTable"]="vw_feedspec";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_feedspec[".Keys"]=$keys;

	
//	FeedID
	$fdata = array();
	 $fdata["Label"]="Feed ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedID";
		$fdata["FullName"]= "FeedID";
	
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["FeedID"]=$fdata;
	
//	Feed
	$fdata = array();
	 $fdata["Label"]="Feed Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
		
		$fdata["LookupType"]=1;
			$fdata["LinkField"]="`FName`";
	$fdata["LinkFieldType"]=200;
		$fdata["DisplayField"]="`FName`";
	$fdata["LookupTable"]="vw_feedspec";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Feed";
		$fdata["FullName"]= "FName";
	
	
	
	
	$fdata["Index"]= 2;
	
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedspec["Feed"]=$fdata;
	
//	Brand
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Brand";
		$fdata["FullName"]= "BrandName";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Brand"]=$fdata;
	
//	Technology
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Technology";
		$fdata["FullName"]= "Technology";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Technology"]=$fdata;
	
//	Feed Year
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Feed_Year";
		$fdata["FullName"]= "FeedYear";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Feed Year"]=$fdata;
	
//	Stage
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Stage";
		$fdata["FullName"]= "Stage";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Stage"]=$fdata;
	
//	FCountryID
	$fdata = array();
	 $fdata["Label"]="FCountry ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FCountryID";
		$fdata["FullName"]= "FCountryID";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["FCountryID"]=$fdata;
	
//	Country Origin
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Country_Origin";
		$fdata["FullName"]= "CountryOrigin";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedspec["Country Origin"]=$fdata;
	
//	FIDSourceID
	$fdata = array();
	 $fdata["Label"]="FIDSource ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FIDSourceID";
		$fdata["FullName"]= "FIDSourceID";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["FIDSourceID"]=$fdata;
	
//	Details
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Details";
		$fdata["FullName"]= "FisDetail";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Details"]=$fdata;
	
//	Data Source
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Data_Source";
		$fdata["FullName"]= "FDataSource";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedspec["Data Source"]=$fdata;
	
//	FeedTypeID
	$fdata = array();
	 $fdata["Label"]="Feed Type ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedTypeID";
		$fdata["FullName"]= "FeedTypeID";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["FeedTypeID"]=$fdata;
	
//	Type
	$fdata = array();
	 $fdata["Label"]="Feed Type"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Type";
		$fdata["FullName"]= "FeedType";
	
	
	
	
	$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedspec["Type"]=$fdata;
	
//	SpeciesID
	$fdata = array();
	 $fdata["Label"]="Species ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpeciesID";
		$fdata["FullName"]= "SpeciesID";
	
	
	
	
	$fdata["Index"]= 14;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["SpeciesID"]=$fdata;
	
//	Species Name
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
	
		
		$fdata["LookupType"]=1;
			$fdata["LinkField"]="`SpecName`";
	$fdata["LinkFieldType"]=200;
		$fdata["DisplayField"]="`SpecName`";
	$fdata["LookupTable"]="vw_feedspec";
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Species_Name";
		$fdata["FullName"]= "SpecName";
	
	
	
	
	$fdata["Index"]= 15;
	
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedspec["Species Name"]=$fdata;
	
//	Common Name
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Common_Name";
		$fdata["FullName"]= "CommonName";
	
	
	
	
	$fdata["Index"]= 16;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Common Name"]=$fdata;
	
//	Hybrid
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Hybrid";
		$fdata["FullName"]= "Hybrid";
	
	
	
	
	$fdata["Index"]= 17;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Hybrid"]=$fdata;
	
//	Variety
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Variety";
		$fdata["FullName"]= "Variety";
	
	
	
	
	$fdata["Index"]= 18;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Variety"]=$fdata;
	
//	Family
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Family";
		$fdata["FullName"]= "Family";
	
	
	
	
	$fdata["Index"]= 19;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Family"]=$fdata;
	
//	Group
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Group";
		$fdata["FullName"]= "`Group`";
	
	
	
	
	$fdata["Index"]= 20;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Group"]=$fdata;
	
//	Genus
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Genus";
		$fdata["FullName"]= "Genus";
	
	
	
	
	$fdata["Index"]= 21;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Genus"]=$fdata;
	
//	Environment
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Environment";
		$fdata["FullName"]= "Environment";
	
	
	
	
	$fdata["Index"]= 22;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Environment"]=$fdata;
	
//	Habit
	$fdata = array();
	 $fdata["Label"]="Feeding Habit"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Habit";
		$fdata["FullName"]= "FeedHabit";
	
	
	
	
	$fdata["Index"]= 23;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Habit"]=$fdata;
	
//	Country
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Country";
		$fdata["FullName"]= "Country";
	
	
	
	
	$fdata["Index"]= 24;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Country"]=$fdata;
	
//	Species Year
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Species_Year";
		$fdata["FullName"]= "SpecYear";
	
	
	
	
	$fdata["Index"]= 25;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedspec["Species Year"]=$fdata;
$tables_data["vw_feedspec"]=&$tdatavw_feedspec;
$field_labels["vw_feedspec"] = &$fieldLabelsvw_feedspec;

?>