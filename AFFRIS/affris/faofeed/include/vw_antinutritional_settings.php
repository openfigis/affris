<?php

//	field labels
$fieldLabelsvw_antinutritional = array();
$fieldLabelsvw_antinutritional["English"]=array();
$fieldLabelsvw_antinutritional["English"]["IngredientID"] = "Ingredient ID";
$fieldLabelsvw_antinutritional["English"]["IName"] = "Ingredient Name";
$fieldLabelsvw_antinutritional["English"]["Description"] = "Description";
$fieldLabelsvw_antinutritional["English"]["AntiID"] = "Anti ID";
$fieldLabelsvw_antinutritional["English"]["AntiFactor"] = "Anti Factor";
$fieldLabelsvw_antinutritional["English"]["ToxicLevel"] = "Toxic Level";
$fieldLabelsvw_antinutritional["English"]["TreatmentID"] = "Treatment ID";
$fieldLabelsvw_antinutritional["English"]["Treatment"] = "Treatment";
$fieldLabelsvw_antinutritional["English"]["IDSourceID"] = "IDSource ID";
$fieldLabelsvw_antinutritional["English"]["DataSource"] = "Data Source";
$fieldLabelsvw_antinutritional["English"]["PartUsedID"] = "Part Used ID";
$fieldLabelsvw_antinutritional["English"]["PartUsed"] = "Part Used";


$tdatavw_antinutritional=array();
	 $tdatavw_antinutritional[".NumberOfChars"]=80; 
	$tdatavw_antinutritional[".ShortName"]="vw_antinutritional";
	$tdatavw_antinutritional[".OwnerID"]="";
	$tdatavw_antinutritional[".OriginalTable"]="vw_antinutritional";

	$keys=array();
	$keys[]="IngredientID";
	$tdatavw_antinutritional[".Keys"]=$keys;

	
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
				$tdatavw_antinutritional["IngredientID"]=$fdata;
	
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
	$tdatavw_antinutritional["IName"]=$fdata;
	
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
	$tdatavw_antinutritional["Description"]=$fdata;
	
//	AntiID
	$fdata = array();
	 $fdata["Label"]="Anti ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "AntiID";
		$fdata["FullName"]= "AntiID";
	
	
	
	
	$fdata["Index"]= 4;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_antinutritional["AntiID"]=$fdata;
	
//	AntiFactor
	$fdata = array();
	 $fdata["Label"]="Anti Factor"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "AntiFactor";
		$fdata["FullName"]= "AntiFactor";
	
	
	
	
	$fdata["Index"]= 5;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_antinutritional["AntiFactor"]=$fdata;
	
//	ToxicLevel
	$fdata = array();
	 $fdata["Label"]="Toxic Level"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ToxicLevel";
		$fdata["FullName"]= "ToxicLevel";
	
	
	
	
	$fdata["Index"]= 6;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_antinutritional["ToxicLevel"]=$fdata;
	
//	TreatmentID
	$fdata = array();
	 $fdata["Label"]="Treatment ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TreatmentID";
		$fdata["FullName"]= "TreatmentID";
	
	
	
	
	$fdata["Index"]= 7;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_antinutritional["TreatmentID"]=$fdata;
	
//	Treatment
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Treatment";
		$fdata["FullName"]= "Treatment";
	
	
	
	
	$fdata["Index"]= 8;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_antinutritional["Treatment"]=$fdata;
	
//	IDSourceID
	$fdata = array();
	 $fdata["Label"]="IDSource ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IDSourceID";
		$fdata["FullName"]= "IDSourceID";
	
	
	
	
	$fdata["Index"]= 9;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_antinutritional["IDSourceID"]=$fdata;
	
//	DataSource
	$fdata = array();
	 $fdata["Label"]="Data Source"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DataSource";
		$fdata["FullName"]= "DataSource";
	
	
	
	
	$fdata["Index"]= 10;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_antinutritional["DataSource"]=$fdata;
	
//	PartUsedID
	$fdata = array();
	 $fdata["Label"]="Part Used ID"; 
	
	
	$fdata["FieldType"]= 3;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "PartUsedID";
		$fdata["FullName"]= "PartUsedID";
	
	
	
	
	$fdata["Index"]= 11;
	
			$fdata["EditParams"]="";
						$fdata["FieldPermissions"]=true;
				$tdatavw_antinutritional["PartUsedID"]=$fdata;
	
//	PartUsed
	$fdata = array();
	 $fdata["Label"]="Part Used"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "PartUsed";
		$fdata["FullName"]= "PartUsed";
	
	
	
	
	$fdata["Index"]= 12;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
					$fdata["FieldPermissions"]=true;
				$fdata["ListPage"]=true;
	$tdatavw_antinutritional["PartUsed"]=$fdata;
$tables_data["vw_antinutritional"]=&$tdatavw_antinutritional;
$field_labels["vw_antinutritional"] = &$fieldLabelsvw_antinutritional;

?>