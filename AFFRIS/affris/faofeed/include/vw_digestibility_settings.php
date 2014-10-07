<?php

//	field labels
$fieldLabelsvw_digestibility = array();
$fieldLabelsvw_digestibility["English"]=array();
$fieldLabelsvw_digestibility["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_digestibility["English"]["IName"] = "Feed ingredient";
$fieldLabelsvw_digestibility["English"]["Description"] = "Description";
$fieldLabelsvw_digestibility["English"]["SpeciesID"] = "Species ID";
$fieldLabelsvw_digestibility["English"]["SpecName"] = "Aquaculture species";
$fieldLabelsvw_digestibility["English"]["CommonName"] = "Common Name";
$fieldLabelsvw_digestibility["English"]["DigestTypeID"] = "Digest Type ID";
$fieldLabelsvw_digestibility["English"]["DigestibilityType"] = "Digestibility Type";
$fieldLabelsvw_digestibility["English"]["DValue"] = "Ing. Digestibility (%)";
$fieldLabelsvw_digestibility["English"]["Country"] = "Country";
$fieldLabelsvw_digestibility["English"]["DataSource"] = "Data Source";


$tdatavw_digestibility=array();
	 $tdatavw_digestibility[".NumberOfChars"]=80; 
	$tdatavw_digestibility[".ShortName"]="vw_digestibility";
	$tdatavw_digestibility[".OwnerID"]="";
	$tdatavw_digestibility[".OriginalTable"]="vw_digestibility";

	$keys=array();
	$keys[]="IngredientID";
	$tdatavw_digestibility[".Keys"]=$keys;

	
//	IngredientID
	$fdata = array();
	 $fdata["Label"]="Ingredient ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientID";
		$fdata["FullName"]= "IngredientID";
	
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["IngredientID"]=$fdata;
	
//	IName
	$fdata = array();
	 $fdata["Label"]="Feed ingredient"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IName";
		$fdata["FullName"]= "IName";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_digestibility["IName"]=$fdata;
	
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
				$tdatavw_digestibility["Description"]=$fdata;
	
//	SpeciesID
	$fdata = array();
	 $fdata["Label"]="Species ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpeciesID";
		$fdata["FullName"]= "SpeciesID";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["SpeciesID"]=$fdata;
	
//	SpecName
	$fdata = array();
	 $fdata["Label"]="Aquaculture species"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "SpecName";
		$fdata["FullName"]= "SpecName";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=500";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_digestibility["SpecName"]=$fdata;
	
//	CommonName
	$fdata = array();
	 $fdata["Label"]="Common Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CommonName";
		$fdata["FullName"]= "CommonName";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=100";
					$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["CommonName"]=$fdata;
	
//	DigestTypeID
	$fdata = array();
	 $fdata["Label"]="Digest Type ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DigestTypeID";
		$fdata["FullName"]= "DigestTypeID";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["DigestTypeID"]=$fdata;
	
//	DigestibilityType
	$fdata = array();
	 $fdata["Label"]="Digestibility Type"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DigestibilityType";
		$fdata["FullName"]= "DigestibilityType";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_digestibility["DigestibilityType"]=$fdata;
	
//	DValue
	$fdata = array();
	 $fdata["Label"]="Ing. Digestibility (%)"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DValue";
		$fdata["FullName"]= "DValue";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_digestibility["DValue"]=$fdata;
	
//	Country
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Country";
		$fdata["FullName"]= "Country";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["Country"]=$fdata;
	
//	DataSource
	$fdata = array();
	 $fdata["Label"]="Data Source"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DataSource";
		$fdata["FullName"]= "DataSource";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_digestibility["DataSource"]=$fdata;
$tables_data["vw_digestibility"]=&$tdatavw_digestibility;
$field_labels["vw_digestibility"] = &$fieldLabelsvw_digestibility;

?>