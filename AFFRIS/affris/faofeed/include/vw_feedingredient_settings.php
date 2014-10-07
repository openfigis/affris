<?php

//	field labels
$fieldLabelsvw_feedingredient = array();
$fieldLabelsvw_feedingredient["English"]=array();
$fieldLabelsvw_feedingredient["English"]["FeedID"] = "Feed ID";
$fieldLabelsvw_feedingredient["English"]["FName"] = "Feed Name";
$fieldLabelsvw_feedingredient["English"]["FisDetail"] = "Fis Detail";
$fieldLabelsvw_feedingredient["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_feedingredient["English"]["IName"] = "Ingredient Name";
$fieldLabelsvw_feedingredient["English"]["IisDetail"] = "Iis Detail";
$fieldLabelsvw_feedingredient["English"]["FValue"] = "Feed Value";


$tdatavw_feedingredient=array();
	 $tdatavw_feedingredient[".NumberOfChars"]=80; 
	$tdatavw_feedingredient[".ShortName"]="vw_feedingredient";
	$tdatavw_feedingredient[".OwnerID"]="";
	$tdatavw_feedingredient[".OriginalTable"]="vw_feedingredient";

	$keys=array();
	$keys[]="FeedID";
	$tdatavw_feedingredient[".Keys"]=$keys;

	
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
				$tdatavw_feedingredient["FeedID"]=$fdata;
	
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
				$tdatavw_feedingredient["FName"]=$fdata;
	
//	FisDetail
	$fdata = array();
	 $fdata["Label"]="Fis Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FisDetail";
		$fdata["FullName"]= "FisDetail";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedingredient["FisDetail"]=$fdata;
	
//	IngredientID
	$fdata = array();
	 $fdata["Label"]="Ingredient ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientID";
		$fdata["FullName"]= "IngredientID";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedingredient["IngredientID"]=$fdata;
	
//	IName
	$fdata = array();
	 $fdata["Label"]="Ingredient Name"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IName";
		$fdata["FullName"]= "IName";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedingredient["IName"]=$fdata;
	
//	IisDetail
	$fdata = array();
	 $fdata["Label"]="Iis Detail"; 
	
	
	$fdata["FieldType"]= 13;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IisDetail";
		$fdata["FullName"]= "IisDetail";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_feedingredient["IisDetail"]=$fdata;
	
//	FValue
	$fdata = array();
	 $fdata["Label"]="Feed Value"; 
	
	
	$fdata["FieldType"]= 5;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "FValue";
		$fdata["FullName"]= "FValue";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_feedingredient["FValue"]=$fdata;
$tables_data["vw_feedingredient"]=&$tdatavw_feedingredient;
$field_labels["vw_feedingredient"] = &$fieldLabelsvw_feedingredient;

?>