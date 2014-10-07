<?php

//	field labels
$fieldLabelsvw_feed = array();
$fieldLabelsvw_feed["English"]=array();
$fieldLabelsvw_feed["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_feed["English"]["FName"] = "Feed Name";
$fieldLabelsvw_feed["English"]["BrandName"] = "Brand Name";
$fieldLabelsvw_feed["English"]["Technology"] = "Technology";
$fieldLabelsvw_feed["English"]["FeedYear"] = "Feed Year";
$fieldLabelsvw_feed["English"]["Stage"] = "Stage";
$fieldLabelsvw_feed["English"]["FCountryID"] = "FCountry ID";
$fieldLabelsvw_feed["English"]["CountryOrigin"] = "Country Origin";
$fieldLabelsvw_feed["English"]["FIDSourceID"] = "FIDSource ID";
$fieldLabelsvw_feed["English"]["FisDetail"] = "Fis Detail";
$fieldLabelsvw_feed["English"]["FDataSource"] = "Data Source";
$fieldLabelsvw_feed["English"]["FeedTypeID"] = "Feed Type ID";
$fieldLabelsvw_feed["English"]["FeedType"] = "Feed Type";


$tdatavw_feed=array();
	 $tdatavw_feed[".NumberOfChars"]=80; 
	$tdatavw_feed[".ShortName"]="vw_feed";
	$tdatavw_feed[".OwnerID"]="";
	$tdatavw_feed[".OriginalTable"]="vw_feed";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_feed[".Keys"]=$keys;

	
//	FeedID
	$fdata = array();
	 $fdata["Label"]="Feed ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedID";
		$fdata["FullName"]= "FeedID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feed["FeedID"]=$fdata;
	
//	FName
	$fdata = array();
	 $fdata["Label"]="Feed Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FName";
		$fdata["FullName"]= "FName";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feed["FName"]=$fdata;
	
//	BrandName
	$fdata = array();
	 $fdata["Label"]="Brand Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "BrandName";
		$fdata["FullName"]= "BrandName";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feed["BrandName"]=$fdata;
	
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
				$fdata["ListPage"]=true;
	$tdatavw_feed["Technology"]=$fdata;
	
//	FeedYear
	$fdata = array();
	 $fdata["Label"]="Feed Year"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedYear";
		$fdata["FullName"]= "FeedYear";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feed["FeedYear"]=$fdata;
	
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
				$tdatavw_feed["Stage"]=$fdata;
	
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
				$tdatavw_feed["FCountryID"]=$fdata;
	
//	CountryOrigin
	$fdata = array();
	 $fdata["Label"]="Country Origin"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CountryOrigin";
		$fdata["FullName"]= "CountryOrigin";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feed["CountryOrigin"]=$fdata;
	
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
				$tdatavw_feed["FIDSourceID"]=$fdata;
	
//	FisDetail
	$fdata = array();
	 $fdata["Label"]="Fis Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FisDetail";
		$fdata["FullName"]= "FisDetail";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feed["FisDetail"]=$fdata;
	
//	FDataSource
	$fdata = array();
	 $fdata["Label"]="Data Source"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FDataSource";
		$fdata["FullName"]= "FDataSource";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feed["FDataSource"]=$fdata;
	
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
				$tdatavw_feed["FeedTypeID"]=$fdata;
	
//	FeedType
	$fdata = array();
	 $fdata["Label"]="Feed Type"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedType";
		$fdata["FullName"]= "FeedType";
	
	
	
	
	$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feed["FeedType"]=$fdata;
$tables_data["vw_feed"]=&$tdatavw_feed;
$field_labels["vw_feed"] = &$fieldLabelsvw_feed;

?>