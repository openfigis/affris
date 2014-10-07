<?php

//	field labels
$fieldLabelsvw_fullfeedproxanalysis = array();
$fieldLabelsvw_fullfeedproxanalysis["English"]=array();
$fieldLabelsvw_fullfeedproxanalysis["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_fullfeedproxanalysis["English"]["ElementTypeID"] = "Element Type ID";
$fieldLabelsvw_fullfeedproxanalysis["English"]["Description"] = "Description";
$fieldLabelsvw_fullfeedproxanalysis["English"]["isShownDetail"] = "Is Shown Detail";
$fieldLabelsvw_fullfeedproxanalysis["English"]["ETTagName"] = "Element Tag Name";
$fieldLabelsvw_fullfeedproxanalysis["English"]["UnitID"] = "Unit ID";
$fieldLabelsvw_fullfeedproxanalysis["English"]["UnitName"] = "Unit Name";
$fieldLabelsvw_fullfeedproxanalysis["English"]["UnitSymbol"] = "Unit Symbol";
$fieldLabelsvw_fullfeedproxanalysis["English"]["UnitDecimal"] = "Unit Decimal";
$fieldLabelsvw_fullfeedproxanalysis["English"]["ETValue"] = "Element Value";


$tdatavw_fullfeedproxanalysis=array();
	 $tdatavw_fullfeedproxanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullfeedproxanalysis[".ShortName"]="vw_fullfeedproxanalysis";
	$tdatavw_fullfeedproxanalysis[".OwnerID"]="";
	$tdatavw_fullfeedproxanalysis[".OriginalTable"]="vw_fullfeedproxanalysis";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_fullfeedproxanalysis[".Keys"]=$keys;

	
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
				$tdatavw_fullfeedproxanalysis["FeedID"]=$fdata;
	
//	ElementTypeID
	$fdata = array();
	 $fdata["Label"]="Element Type ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementTypeID";
		$fdata["FullName"]= "ElementTypeID";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["ElementTypeID"]=$fdata;
	
//	Description
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description";
		$fdata["FullName"]= "Description";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedproxanalysis["Description"]=$fdata;
	
//	isShownDetail
	$fdata = array();
	 $fdata["Label"]="Is Shown Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "isShownDetail";
		$fdata["FullName"]= "isShownDetail";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["isShownDetail"]=$fdata;
	
//	ETTagName
	$fdata = array();
	 $fdata["Label"]="Element Tag Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ETTagName";
		$fdata["FullName"]= "ETTagName";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["ETTagName"]=$fdata;
	
//	UnitID
	$fdata = array();
	 $fdata["Label"]="Unit ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitID";
		$fdata["FullName"]= "UnitID";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["UnitID"]=$fdata;
	
//	UnitName
	$fdata = array();
	 $fdata["Label"]="Unit Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
		$fdata["FullName"]= "UnitName";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedproxanalysis["UnitName"]=$fdata;
	
//	UnitSymbol
	$fdata = array();
	 $fdata["Label"]="Unit Symbol"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
		$fdata["FullName"]= "UnitSymbol";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["UnitSymbol"]=$fdata;
	
//	UnitDecimal
	$fdata = array();
	 $fdata["Label"]="Unit Decimal"; 
	
	
	$fdata["FieldType"]= 2;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
		$fdata["FullName"]= "UnitDecimal";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedproxanalysis["UnitDecimal"]=$fdata;
	
//	ETValue
	$fdata = array();
	 $fdata["Label"]="Element Value"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ETValue";
		$fdata["FullName"]= "ETValue";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedproxanalysis["ETValue"]=$fdata;
$tables_data["vw_fullfeedproxanalysis"]=&$tdatavw_fullfeedproxanalysis;
$field_labels["vw_fullfeedproxanalysis"] = &$fieldLabelsvw_fullfeedproxanalysis;

?>