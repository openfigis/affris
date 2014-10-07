<?php

//	field labels
$fieldLabelsvw_ingredient = array();
$fieldLabelsvw_ingredient["English"]=array();
$fieldLabelsvw_ingredient["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_ingredient["English"]["IName"] = "Ingredient Name";
$fieldLabelsvw_ingredient["English"]["IfeedNo"] = "International Feed No.";
$fieldLabelsvw_ingredient["English"]["Description1"] = "Ingredient type";
$fieldLabelsvw_ingredient["English"]["Description2"] = "Specific ingr. source";
$fieldLabelsvw_ingredient["English"]["Description3"] = "Add. ingredient details";
$fieldLabelsvw_ingredient["English"]["IisDetail"] = "Iis Detail";
$fieldLabelsvw_ingredient["English"]["IDSourceID"] = "IDSource ID";
$fieldLabelsvw_ingredient["English"]["DataSource"] = "Data Source";
$fieldLabelsvw_ingredient["English"]["CountryID"] = "Country ID";
$fieldLabelsvw_ingredient["English"]["ICountry"] = "Ingredient Country";
$fieldLabelsvw_ingredient["English"]["IngredientSpecID"] = "Ingredient Spec ID";
$fieldLabelsvw_ingredient["English"]["Species"] = "Species";


$tdatavw_ingredient=array();
	 $tdatavw_ingredient[".NumberOfChars"]=80; 
	$tdatavw_ingredient[".ShortName"]="vw_ingredient";
	$tdatavw_ingredient[".OwnerID"]="";
	$tdatavw_ingredient[".OriginalTable"]="vw_ingredient";

	$keys=array();
	$keys[]="IngredientID";
	$tdatavw_ingredient[".Keys"]=$keys;

	
//	IngredientID
	$fdata = array();
	 $fdata["Label"]="Ingredient ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientID";
		$fdata["FullName"]= "IngredientID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["IngredientID"]=$fdata;
	
//	IName
	$fdata = array();
	 $fdata["Label"]="Ingredient Name"; 
	
	
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
	$tdatavw_ingredient["IName"]=$fdata;
	
//	IfeedNo
	$fdata = array();
	 $fdata["Label"]="International Feed No."; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IfeedNo";
		$fdata["FullName"]= "IfeedNo";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_ingredient["IfeedNo"]=$fdata;
	
//	Description1
	$fdata = array();
	 $fdata["Label"]="Ingredient type"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description1";
		$fdata["FullName"]= "Description1";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["Description1"]=$fdata;
	
//	Description2
	$fdata = array();
	 $fdata["Label"]="Specific ingr. source"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description2";
		$fdata["FullName"]= "Description2";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["Description2"]=$fdata;
	
//	Description3
	$fdata = array();
	 $fdata["Label"]="Add. ingredient details"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description3";
		$fdata["FullName"]= "Description3";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["Description3"]=$fdata;
	
//	IisDetail
	$fdata = array();
	 $fdata["Label"]="Iis Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IisDetail";
		$fdata["FullName"]= "IisDetail";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["IisDetail"]=$fdata;
	
//	IDSourceID
	$fdata = array();
	 $fdata["Label"]="IDSource ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IDSourceID";
		$fdata["FullName"]= "IDSourceID";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["IDSourceID"]=$fdata;
	
//	DataSource
	$fdata = array();
	 $fdata["Label"]="Data Source"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DataSource";
		$fdata["FullName"]= "DataSource";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["DataSource"]=$fdata;
	
//	CountryID
	$fdata = array();
	 $fdata["Label"]="Country ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CountryID";
		$fdata["FullName"]= "CountryID";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["CountryID"]=$fdata;
	
//	ICountry
	$fdata = array();
	 $fdata["Label"]="Ingredient Country"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ICountry";
		$fdata["FullName"]= "ICountry";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_ingredient["ICountry"]=$fdata;
	
//	IngredientSpecID
	$fdata = array();
	 $fdata["Label"]="Ingredient Spec ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientSpecID";
		$fdata["FullName"]= "IngredientSpecID";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_ingredient["IngredientSpecID"]=$fdata;
	
//	Species
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Species";
		$fdata["FullName"]= "Species";
	
	
	
	
	$fdata["Index"]= 13;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_ingredient["Species"]=$fdata;
$tables_data["vw_ingredient"]=&$tdatavw_ingredient;
$field_labels["vw_ingredient"] = &$fieldLabelsvw_ingredient;

?>