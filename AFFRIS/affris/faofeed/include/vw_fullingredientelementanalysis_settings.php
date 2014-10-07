<?php

//	field labels
$fieldLabelsvw_fullingredientelementanalysis = array();
$fieldLabelsvw_fullingredientelementanalysis["English"]=array();
$fieldLabelsvw_fullingredientelementanalysis["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_fullingredientelementanalysis["English"]["ElementID"] = "Element ID";
$fieldLabelsvw_fullingredientelementanalysis["English"]["EName"] = "Element Name";
$fieldLabelsvw_fullingredientelementanalysis["English"]["CommonName"] = "Symbol/Common Name";
$fieldLabelsvw_fullingredientelementanalysis["English"]["TagName"] = "Technical description";
$fieldLabelsvw_fullingredientelementanalysis["English"]["ElementTypeID"] = "Element Type ID";
$fieldLabelsvw_fullingredientelementanalysis["English"]["Description"] = "Category";
$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitID"] = "Unit ID";
$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitName"] = "Unit Name";
$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitSymbol"] = "Unit Symbol";
$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitDecimal"] = "Unit Decimal";
$fieldLabelsvw_fullingredientelementanalysis["English"]["IValue"] = "Inclusion";


$tdatavw_fullingredientelementanalysis=array();
	 $tdatavw_fullingredientelementanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullingredientelementanalysis[".ShortName"]="vw_fullingredientelementanalysis";
	$tdatavw_fullingredientelementanalysis[".OwnerID"]="";
	$tdatavw_fullingredientelementanalysis[".OriginalTable"]="vw_fullingredientelementanalysis";

	$keys=array();
	$keys[]="IngredientID";
	$tdatavw_fullingredientelementanalysis[".Keys"]=$keys;

	
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
				$tdatavw_fullingredientelementanalysis["IngredientID"]=$fdata;
	
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
				$tdatavw_fullingredientelementanalysis["ElementID"]=$fdata;
	
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
	$tdatavw_fullingredientelementanalysis["EName"]=$fdata;
	
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
	$tdatavw_fullingredientelementanalysis["CommonName"]=$fdata;
	
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
	$tdatavw_fullingredientelementanalysis["TagName"]=$fdata;
	
//	ElementTypeID
	$fdata = array();
	 $fdata["Label"]="Element Type ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementTypeID";
		$fdata["FullName"]= "ElementTypeID";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullingredientelementanalysis["ElementTypeID"]=$fdata;
	
//	Description
	$fdata = array();
	 $fdata["Label"]="Category"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description";
		$fdata["FullName"]= "Description";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientelementanalysis["Description"]=$fdata;
	
//	UnitID
	$fdata = array();
	 $fdata["Label"]="Unit ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitID";
		$fdata["FullName"]= "UnitID";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullingredientelementanalysis["UnitID"]=$fdata;
	
//	UnitName
	$fdata = array();
	 $fdata["Label"]="Unit Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
		$fdata["FullName"]= "UnitName";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$tdatavw_fullingredientelementanalysis["UnitName"]=$fdata;
	
//	UnitSymbol
	$fdata = array();
	 $fdata["Label"]="Unit Symbol"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
		$fdata["FullName"]= "UnitSymbol";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientelementanalysis["UnitSymbol"]=$fdata;
	
//	UnitDecimal
	$fdata = array();
	 $fdata["Label"]="Unit Decimal"; 
	
	
	$fdata["FieldType"]= 2;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
		$fdata["FullName"]= "UnitDecimal";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_fullingredientelementanalysis["UnitDecimal"]=$fdata;
	
//	IValue
	$fdata = array();
	 $fdata["Label"]="Inclusion"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IValue";
		$fdata["FullName"]= "IValue";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_fullingredientelementanalysis["IValue"]=$fdata;
$tables_data["vw_fullingredientelementanalysis"]=&$tdatavw_fullingredientelementanalysis;
$field_labels["vw_fullingredientelementanalysis"] = &$fieldLabelsvw_fullingredientelementanalysis;

?>