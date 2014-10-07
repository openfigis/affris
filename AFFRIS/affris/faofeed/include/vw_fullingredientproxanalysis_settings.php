<?php

//	field labels
$fieldLabelsvw_fullingredientproxanalysis = array();
$fieldLabelsvw_fullingredientproxanalysis["English"]=array();
$fieldLabelsvw_fullingredientproxanalysis["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_fullingredientproxanalysis["English"]["ElementTypeID"] = "Element Type ID";
$fieldLabelsvw_fullingredientproxanalysis["English"]["Description"] = "Description";
$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitName"] = "Unit Name";
$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitSymbol"] = "Unit Symbol";
$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitDecimal"] = "Unit Decimal";
$fieldLabelsvw_fullingredientproxanalysis["English"]["ETValue"] = "Inclusion";


$tdatavw_fullingredientproxanalysis=array();
	 $tdatavw_fullingredientproxanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullingredientproxanalysis[".ShortName"]="vw_fullingredientproxanalysis";
	$tdatavw_fullingredientproxanalysis[".OwnerID"]="";
	$tdatavw_fullingredientproxanalysis[".OriginalTable"]="vw_fullingredientproxanalysis";

	$keys=array();
	$keys[]="IngredientID";
	$tdatavw_fullingredientproxanalysis[".Keys"]=$keys;

	
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
				$tdatavw_fullingredientproxanalysis["IngredientID"]=$fdata;
	
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
				$tdatavw_fullingredientproxanalysis["ElementTypeID"]=$fdata;
	
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
	$tdatavw_fullingredientproxanalysis["Description"]=$fdata;
	
//	UnitName
	$fdata = array();
	 $fdata["Label"]="Unit Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
		$fdata["FullName"]= "UnitName";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_fullingredientproxanalysis["UnitName"]=$fdata;
	
//	UnitSymbol
	$fdata = array();
	 $fdata["Label"]="Unit Symbol"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
		$fdata["FullName"]= "UnitSymbol";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientproxanalysis["UnitSymbol"]=$fdata;
	
//	UnitDecimal
	$fdata = array();
	 $fdata["Label"]="Unit Decimal"; 
	
	
	$fdata["FieldType"]= 2;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
		$fdata["FullName"]= "UnitDecimal";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientproxanalysis["UnitDecimal"]=$fdata;
	
//	ETValue
	$fdata = array();
	 $fdata["Label"]="Inclusion"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ETValue";
		$fdata["FullName"]= "ETValue";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientproxanalysis["ETValue"]=$fdata;
$tables_data["vw_fullingredientproxanalysis"]=&$tdatavw_fullingredientproxanalysis;
$field_labels["vw_fullingredientproxanalysis"] = &$fieldLabelsvw_fullingredientproxanalysis;

?>