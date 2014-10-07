<?php

//	field labels
$fieldLabelsvw_feedanalysis = array();
$fieldLabelsvw_feedanalysis["English"]=array();
$fieldLabelsvw_feedanalysis["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_feedanalysis["English"]["FName"] = "Feed Name";
$fieldLabelsvw_feedanalysis["English"]["BrandName"] = "Brand Name";
$fieldLabelsvw_feedanalysis["English"]["Technology"] = "Technology";
$fieldLabelsvw_feedanalysis["English"]["FeedYear"] = "Feed Year";
$fieldLabelsvw_feedanalysis["English"]["Stage"] = "Stage";
$fieldLabelsvw_feedanalysis["English"]["FCountryID"] = "FCountry ID";
$fieldLabelsvw_feedanalysis["English"]["CountryOrigin"] = "Country Origin";
$fieldLabelsvw_feedanalysis["English"]["FIDSourceID"] = "FIDSource ID";
$fieldLabelsvw_feedanalysis["English"]["FisDetail"] = "Details";
$fieldLabelsvw_feedanalysis["English"]["FDataSource"] = "Data Source";
$fieldLabelsvw_feedanalysis["English"]["FeedTypeID"] = "Feed Type ID";
$fieldLabelsvw_feedanalysis["English"]["FeedType"] = "Feed Type";
$fieldLabelsvw_feedanalysis["English"]["FeedAnalysisTypeID"] = "Feed Analysis Type ID";
$fieldLabelsvw_feedanalysis["English"]["FeedAnalysisType"] = "Feed Analysis Type";
$fieldLabelsvw_feedanalysis["English"]["FATTagName"] = "FAT Tag Name";
$fieldLabelsvw_feedanalysis["English"]["UnitID"] = "Unit ID";
$fieldLabelsvw_feedanalysis["English"]["UnitName"] = "Unit Name";
$fieldLabelsvw_feedanalysis["English"]["UnitSymbol"] = "Unit Symbol";
$fieldLabelsvw_feedanalysis["English"]["UnitDecimal"] = "Unit Decimal";
$fieldLabelsvw_feedanalysis["English"]["FAValue"] = "Analysis quantity(%)";
$fieldLabelsvw_feedanalysis["English"]["isShownDetail"] = "Is Shown Detail";


$tdatavw_feedanalysis=array();
	 $tdatavw_feedanalysis[".NumberOfChars"]=80; 
	$tdatavw_feedanalysis[".ShortName"]="vw_feedanalysis";
	$tdatavw_feedanalysis[".OwnerID"]="";
	$tdatavw_feedanalysis[".OriginalTable"]="vw_feedanalysis";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_feedanalysis[".Keys"]=$keys;

	
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
				$tdatavw_feedanalysis["FeedID"]=$fdata;
	
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
				$tdatavw_feedanalysis["FName"]=$fdata;
	
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
				$tdatavw_feedanalysis["BrandName"]=$fdata;
	
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
				$tdatavw_feedanalysis["Technology"]=$fdata;
	
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
				$tdatavw_feedanalysis["FeedYear"]=$fdata;
	
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
				$tdatavw_feedanalysis["Stage"]=$fdata;
	
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
				$tdatavw_feedanalysis["FCountryID"]=$fdata;
	
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
				$tdatavw_feedanalysis["CountryOrigin"]=$fdata;
	
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
				$tdatavw_feedanalysis["FIDSourceID"]=$fdata;
	
//	FisDetail
	$fdata = array();
	 $fdata["Label"]="Details"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FisDetail";
		$fdata["FullName"]= "FisDetail";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedanalysis["FisDetail"]=$fdata;
	
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
				$tdatavw_feedanalysis["FDataSource"]=$fdata;
	
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
				$tdatavw_feedanalysis["FeedTypeID"]=$fdata;
	
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
				$tdatavw_feedanalysis["FeedType"]=$fdata;
	
//	FeedAnalysisTypeID
	$fdata = array();
	 $fdata["Label"]="Feed Analysis Type ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedAnalysisTypeID";
		$fdata["FullName"]= "FeedAnalysisTypeID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 14;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["FeedAnalysisTypeID"]=$fdata;
	
//	FeedAnalysisType
	$fdata = array();
	 $fdata["Label"]="Feed Analysis Type"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FeedAnalysisType";
		$fdata["FullName"]= "FeedAnalysisType";
	
	
	
	
	$fdata["Index"]= 15;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedanalysis["FeedAnalysisType"]=$fdata;
	
//	FATTagName
	$fdata = array();
	 $fdata["Label"]="FAT Tag Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FATTagName";
		$fdata["FullName"]= "FATTagName";
	
	
	
	
	$fdata["Index"]= 16;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["FATTagName"]=$fdata;
	
//	UnitID
	$fdata = array();
	 $fdata["Label"]="Unit ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitID";
		$fdata["FullName"]= "UnitID";
	
	
	
	
	$fdata["Index"]= 17;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["UnitID"]=$fdata;
	
//	UnitName
	$fdata = array();
	 $fdata["Label"]="Unit Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
		$fdata["FullName"]= "UnitName";
	
	
	
	
	$fdata["Index"]= 18;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["UnitName"]=$fdata;
	
//	UnitSymbol
	$fdata = array();
	 $fdata["Label"]="Unit Symbol"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
		$fdata["FullName"]= "UnitSymbol";
	
	
	
	
	$fdata["Index"]= 19;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["UnitSymbol"]=$fdata;
	
//	UnitDecimal
	$fdata = array();
	 $fdata["Label"]="Unit Decimal"; 
	
	
	$fdata["FieldType"]= 2;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
		$fdata["FullName"]= "UnitDecimal";
	
	
	
	
	$fdata["Index"]= 20;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedanalysis["UnitDecimal"]=$fdata;
	
//	FAValue
	$fdata = array();
	 $fdata["Label"]="Analysis quantity(%)"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FAValue";
		$fdata["FullName"]= "FAValue";
	
	
	
	
	$fdata["Index"]= 21;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedanalysis["FAValue"]=$fdata;
	
//	isShownDetail
	$fdata = array();
	 $fdata["Label"]="Is Shown Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "isShownDetail";
		$fdata["FullName"]= "isShownDetail";
	
	
	
	
	$fdata["Index"]= 22;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedanalysis["isShownDetail"]=$fdata;
$tables_data["vw_feedanalysis"]=&$tdatavw_feedanalysis;
$field_labels["vw_feedanalysis"] = &$fieldLabelsvw_feedanalysis;

?>