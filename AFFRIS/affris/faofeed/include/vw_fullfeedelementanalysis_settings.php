<?php

//	field labels
$fieldLabelsvw_fullfeedelementanalysis = array();
$fieldLabelsvw_fullfeedelementanalysis["English"]=array();
$fieldLabelsvw_fullfeedelementanalysis["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_fullfeedelementanalysis["English"]["ElementID"] = "Element ID";
$fieldLabelsvw_fullfeedelementanalysis["English"]["EName"] = "Element Name";
$fieldLabelsvw_fullfeedelementanalysis["English"]["CommonName"] = "Symbol/Common Name";
$fieldLabelsvw_fullfeedelementanalysis["English"]["TagName"] = "Technical description";
$fieldLabelsvw_fullfeedelementanalysis["English"]["UnitID"] = "Unit ID";
$fieldLabelsvw_fullfeedelementanalysis["English"]["UnitName"] = "Unit Symbol";
$fieldLabelsvw_fullfeedelementanalysis["English"]["UnitSymbol"] = "Unit Symbol";
$fieldLabelsvw_fullfeedelementanalysis["English"]["UnitDecimal"] = "Unit Decimal";
$fieldLabelsvw_fullfeedelementanalysis["English"]["iValue"] = "Inclusion";


$tdatavw_fullfeedelementanalysis=array();
	 $tdatavw_fullfeedelementanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullfeedelementanalysis[".ShortName"]="vw_fullfeedelementanalysis";
	$tdatavw_fullfeedelementanalysis[".OwnerID"]="";
	$tdatavw_fullfeedelementanalysis[".OriginalTable"]="vw_fullfeedelementanalysis";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_fullfeedelementanalysis[".Keys"]=$keys;

	
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
				$tdatavw_fullfeedelementanalysis["FeedID"]=$fdata;
	
//	ElementID
	$fdata = array();
	 $fdata["Label"]="Element ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementID";
		$fdata["FullName"]= "ElementID";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullfeedelementanalysis["ElementID"]=$fdata;
	
//	EName
	$fdata = array();
	 $fdata["Label"]="Element Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "EName";
		$fdata["FullName"]= "EName";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedelementanalysis["EName"]=$fdata;
	
//	CommonName
	$fdata = array();
	 $fdata["Label"]="Symbol/Common Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CommonName";
		$fdata["FullName"]= "CommonName";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedelementanalysis["CommonName"]=$fdata;
	
//	TagName
	$fdata = array();
	 $fdata["Label"]="Technical description"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TagName";
		$fdata["FullName"]= "TagName";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=500";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedelementanalysis["TagName"]=$fdata;
	
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
				$tdatavw_fullfeedelementanalysis["UnitID"]=$fdata;
	
//	UnitName
	$fdata = array();
	 $fdata["Label"]="Unit Symbol"; 
	
	
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
	$tdatavw_fullfeedelementanalysis["UnitName"]=$fdata;
	
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
				$tdatavw_fullfeedelementanalysis["UnitSymbol"]=$fdata;
	
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
				$tdatavw_fullfeedelementanalysis["UnitDecimal"]=$fdata;
	
//	iValue
	$fdata = array();
	 $fdata["Label"]="Inclusion"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "iValue";
		$fdata["FullName"]= "iValue";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullfeedelementanalysis["iValue"]=$fdata;
$tables_data["vw_fullfeedelementanalysis"]=&$tdatavw_fullfeedelementanalysis;
$field_labels["vw_fullfeedelementanalysis"] = &$fieldLabelsvw_fullfeedelementanalysis;

?>