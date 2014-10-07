<?php
$tdatavw_ingredientclass=array();
	$tdatavw_ingredientclass[".NumberOfChars"]=80; 
	$tdatavw_ingredientclass[".ShortName"]="vw_ingredientclass";
	$tdatavw_ingredientclass[".OwnerID"]="";
	$tdatavw_ingredientclass[".OriginalTable"]="vw_ingredientclass";


	
//	field labels
$fieldLabelsvw_ingredientclass = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_ingredientclass["English"]=array();
	$fieldToolTipsvw_ingredientclass["English"]=array();
	$fieldLabelsvw_ingredientclass["English"]["IngredientID"] = "Ingredient ID";
	$fieldToolTipsvw_ingredientclass["English"]["IngredientID"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IName"] = "Ingredient name";
	$fieldToolTipsvw_ingredientclass["English"]["IName"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IfeedNo"] = "International feed no.";
	$fieldToolTipsvw_ingredientclass["English"]["IfeedNo"] = "";
	$fieldLabelsvw_ingredientclass["English"]["Description1"] = "Ingredient type";
	$fieldToolTipsvw_ingredientclass["English"]["Description1"] = "";
	$fieldLabelsvw_ingredientclass["English"]["Description2"] = "Major ingredient classification";
	$fieldToolTipsvw_ingredientclass["English"]["Description2"] = "";
	$fieldLabelsvw_ingredientclass["English"]["Description3"] = "Sub-classification";
	$fieldToolTipsvw_ingredientclass["English"]["Description3"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IisDetail"] = "Iis Detail";
	$fieldToolTipsvw_ingredientclass["English"]["IisDetail"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IDSourceID"] = "IDSource ID";
	$fieldToolTipsvw_ingredientclass["English"]["IDSourceID"] = "";
	$fieldLabelsvw_ingredientclass["English"]["DataSource"] = "Data Source";
	$fieldToolTipsvw_ingredientclass["English"]["DataSource"] = "";
	$fieldLabelsvw_ingredientclass["English"]["CountryID"] = "Country ID";
	$fieldToolTipsvw_ingredientclass["English"]["CountryID"] = "";
	$fieldLabelsvw_ingredientclass["English"]["ICountry"] = "Ingredient country";
	$fieldToolTipsvw_ingredientclass["English"]["ICountry"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IngredientSpecID"] = "Ingredient Spec ID";
	$fieldToolTipsvw_ingredientclass["English"]["IngredientSpecID"] = "";
	$fieldLabelsvw_ingredientclass["English"]["Species"] = "Scientific name";
	$fieldToolTipsvw_ingredientclass["English"]["Species"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IngredientClassID"] = "Ingredient Class ID";
	$fieldToolTipsvw_ingredientclass["English"]["IngredientClassID"] = "";
	$fieldLabelsvw_ingredientclass["English"]["IngredientClass"] = "Ingredient Class";
	$fieldToolTipsvw_ingredientclass["English"]["IngredientClass"] = "";
	$fieldLabelsvw_ingredientclass["English"]["Description4"] = "Sub-classification";
	$fieldToolTipsvw_ingredientclass["English"]["Description4"] = "";
	if (count($fieldToolTipsvw_ingredientclass["English"])){
		$tdatavw_ingredientclass[".isUseToolTips"]=true;
	}
}


	

	

$tdatavw_ingredientclass[".shortTableName"] = "vw_ingredientclass";
$tdatavw_ingredientclass[".nSecOptions"] = 0;
$tdatavw_ingredientclass[".recsPerRowList"] = 1;	
$tdatavw_ingredientclass[".tableGroupBy"] = "0";
$tdatavw_ingredientclass[".mainTableOwnerID"] = "";
$tdatavw_ingredientclass[".moveNext"] = 1;




$tdatavw_ingredientclass[".showAddInPopup"] = false;

$tdatavw_ingredientclass[".showEditInPopup"] = false;

$tdatavw_ingredientclass[".showViewInPopup"] = false;


$tdatavw_ingredientclass[".fieldsForRegister"] = array();

$tdatavw_ingredientclass[".listAjax"] = false;

	$tdatavw_ingredientclass[".audit"] = false;

	$tdatavw_ingredientclass[".locking"] = false;
	
$tdatavw_ingredientclass[".listIcons"] = true;
$tdatavw_ingredientclass[".edit"] = true;
$tdatavw_ingredientclass[".copy"] = true;
$tdatavw_ingredientclass[".view"] = true;



$tdatavw_ingredientclass[".delete"] = true;

$tdatavw_ingredientclass[".showSimpleSearchOptions"] = false;

$tdatavw_ingredientclass[".showSearchPanel"] = true;


$tdatavw_ingredientclass[".isUseAjaxSuggest"] = true;

$tdatavw_ingredientclass[".rowHighlite"] = true;


// button handlers file names

$tdatavw_ingredientclass[".addPageEvents"] = false;

$tdatavw_ingredientclass[".arrKeyFields"][] = "IngredientID";

// use datepicker for search panel
$tdatavw_ingredientclass[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatavw_ingredientclass[".isUseTimeForSearch"] = false;

$tdatavw_ingredientclass[".isUseiBox"] = false;




$tdatavw_ingredientclass[".isUseInlineJs"] = $tdatavw_ingredientclass[".isUseInlineAdd"] || $tdatavw_ingredientclass[".isUseInlineEdit"];

$tdatavw_ingredientclass[".allSearchFields"] = array();

$tdatavw_ingredientclass[".globSearchFields"][] = "Description2";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description2", $tdatavw_ingredientclass[".allSearchFields"]))
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "Description2";	
}
$tdatavw_ingredientclass[".globSearchFields"][] = "Description4";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description4", $tdatavw_ingredientclass[".allSearchFields"]))
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "Description4";	
}
$tdatavw_ingredientclass[".globSearchFields"][] = "IName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IName", $tdatavw_ingredientclass[".allSearchFields"]))
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "IName";	
}


$tdatavw_ingredientclass[".googleLikeFields"][] = "Description2";
$tdatavw_ingredientclass[".googleLikeFields"][] = "Description4";
$tdatavw_ingredientclass[".googleLikeFields"][] = "IName";



$tdatavw_ingredientclass[".advSearchFields"][] = "Description2";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description2", $tdatavw_ingredientclass[".allSearchFields"])) 
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "Description2";	
}
$tdatavw_ingredientclass[".advSearchFields"][] = "Description4";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description4", $tdatavw_ingredientclass[".allSearchFields"])) 
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "Description4";	
}
$tdatavw_ingredientclass[".advSearchFields"][] = "IName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IName", $tdatavw_ingredientclass[".allSearchFields"])) 
{
	$tdatavw_ingredientclass[".allSearchFields"][] = "IName";	
}

$tdatavw_ingredientclass[".isTableType"] = "list";


	

$tdatavw_ingredientclass[".isDisplayLoading"] = true;

$tdatavw_ingredientclass[".isResizeColumns"] = false;

	$tdatavw_ingredientclass[".subQueriesSupAccess"] = true;




$tdatavw_ingredientclass[".pageSize"] = 20;

$gstrOrderBy = "ORDER BY IName, IngredientSpecID";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatavw_ingredientclass[".strOrderBy"] = $gstrOrderBy;
	
$tdatavw_ingredientclass[".orderindexes"] = array();
$tdatavw_ingredientclass[".orderindexes"][] = array(2, (1 ? "ASC" : "DESC"), "IName");
$tdatavw_ingredientclass[".orderindexes"][] = array(12, (1 ? "ASC" : "DESC"), "IngredientSpecID");

$tdatavw_ingredientclass[".sqlHead"] = "SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  IngredientClassID,  IngredientClass,  Description4";
$tdatavw_ingredientclass[".sqlFrom"] = "FROM vw_ingredientclass";
$tdatavw_ingredientclass[".sqlWhereExpr"] = "(IisDetail =1)";
$tdatavw_ingredientclass[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_ingredientclass[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_ingredientclass[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "IngredientID";
	$tdatavw_ingredientclass[".Keys"] = $tableKeys;

//	IngredientID
	$fdata = array();
	$fdata["strName"] = "IngredientID";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientID";
	
		$fdata["FullName"]= "IngredientID";
	
		
		
		
		
		
				$fdata["Index"]= 1;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IngredientID"]=$fdata;
//	IName
	$fdata = array();
	$fdata["strName"] = "IName";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
		
		$fdata["LookupType"]=1;
	$fdata["pLookupType"] = 1;
	$fdata["freeInput"] = 0;	
	$fdata["autoCompleteFieldsOnEdit"] = 0;
	$fdata["autoCompleteFields"] = array();
										$fdata["LookupUnique"]=true;
	$fdata["LinkField"]="IName";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="IName";
				$fdata["LookupTable"]="vw_ingredientclass";
	$fdata["LookupOrderBy"]="IName";
										$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="Description4"; 
	$fdata["CategoryFilter"]="Description4"; 
										
					
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IName";
	
		$fdata["FullName"]= "IName";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IName"]=$fdata;
//	IfeedNo
	$fdata = array();
	$fdata["strName"] = "IfeedNo";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="International feed no."; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IfeedNo";
	
		$fdata["FullName"]= "IfeedNo";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IfeedNo"]=$fdata;
//	Description1
	$fdata = array();
	$fdata["strName"] = "Description1";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient type"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description1";
	
		$fdata["FullName"]= "Description1";
	
		
		
		
		
		
				$fdata["Index"]= 4;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["Description1"]=$fdata;
//	Description2
	$fdata = array();
	$fdata["strName"] = "Description2";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Major ingredient classification"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
		
		$fdata["LookupType"]=1;
	$fdata["pLookupType"] = 1;
	$fdata["freeInput"] = 0;	
	$fdata["autoCompleteFieldsOnEdit"] = 0;
	$fdata["autoCompleteFields"] = array();
	$fdata["autoCompleteFields"][] = array('masterF'=>"IName", 'lookupF'=>"IName");
										$fdata["LookupUnique"]=true;
	$fdata["LinkField"]="Description2";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Description2";
				$fdata["LookupTable"]="vw_ingredientclass";
	$fdata["LookupOrderBy"]="Description2";
																			
				//	dependent dropdowns	
	$fdata["DependentLookups"]=array();
	$fdata["DependentLookups"][]="Description3";
					$fdata["DependentLookups"][]="Description4";
					
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description2";
	
		$fdata["FullName"]= "Description2";
	
		
		
		
		
		
				$fdata["Index"]= 5;
				
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["Description2"]=$fdata;
//	Description3
	$fdata = array();
	$fdata["strName"] = "Description3";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Sub-classification"; 
	
		
		$fdata["LinkPrefix"]="files/"; 
	
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
		
		$fdata["LookupType"]=1;
	$fdata["pLookupType"] = 1;
	$fdata["freeInput"] = 0;	
	$fdata["autoCompleteFieldsOnEdit"] = 0;
	$fdata["autoCompleteFields"] = array();
										$fdata["LookupUnique"]=true;
	$fdata["LinkField"]="Description4";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Description3";
				$fdata["LookupTable"]="vw_ingredientclass";
	$fdata["LookupOrderBy"]="Description3";
										$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="Description2"; 
	$fdata["CategoryFilter"]="Description2"; 
										
					
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description3";
	
		$fdata["FullName"]= "Description3";
	
		
		
		
		
		
			$fdata["UploadFolder"]="files"; 
		$fdata["Index"]= 6;
				
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["Description3"]=$fdata;
//	IisDetail
	$fdata = array();
	$fdata["strName"] = "IisDetail";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Iis Detail"; 
	
		
		
	$fdata["FieldType"]= 13;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IisDetail";
	
		$fdata["FullName"]= "IisDetail";
	
		
		
		
		
		
				$fdata["Index"]= 7;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IisDetail"]=$fdata;
//	IDSourceID
	$fdata = array();
	$fdata["strName"] = "IDSourceID";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="IDSource ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IDSourceID";
	
		$fdata["FullName"]= "IDSourceID";
	
		
		
		
		
		
				$fdata["Index"]= 8;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IDSourceID"]=$fdata;
//	DataSource
	$fdata = array();
	$fdata["strName"] = "DataSource";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Data Source"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "DataSource";
	
		$fdata["FullName"]= "DataSource";
	
		
		
		
		
		
				$fdata["Index"]= 9;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["DataSource"]=$fdata;
//	CountryID
	$fdata = array();
	$fdata["strName"] = "CountryID";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Country ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CountryID";
	
		$fdata["FullName"]= "CountryID";
	
		
		
		
		
		
				$fdata["Index"]= 10;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["CountryID"]=$fdata;
//	ICountry
	$fdata = array();
	$fdata["strName"] = "ICountry";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient country"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ICountry";
	
		$fdata["FullName"]= "ICountry";
	
		
		
		
		
		
				$fdata["Index"]= 11;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["ICountry"]=$fdata;
//	IngredientSpecID
	$fdata = array();
	$fdata["strName"] = "IngredientSpecID";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient Spec ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientSpecID";
	
		$fdata["FullName"]= "IngredientSpecID";
	
		
		
		
		
		
				$fdata["Index"]= 12;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IngredientSpecID"]=$fdata;
//	Species
	$fdata = array();
	$fdata["strName"] = "Species";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Scientific name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Species";
	
		$fdata["FullName"]= "Species";
	
		
		
		
		
		
				$fdata["Index"]= 13;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["Species"]=$fdata;
//	IngredientClassID
	$fdata = array();
	$fdata["strName"] = "IngredientClassID";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient Class ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
		
		$fdata["LookupType"]=1;
	$fdata["pLookupType"] = 1;
	$fdata["freeInput"] = 0;	
	$fdata["autoCompleteFieldsOnEdit"] = 0;
	$fdata["autoCompleteFields"] = array();
										$fdata["LookupUnique"]=true;
	$fdata["LinkField"]="IngredientClassID";
	$fdata["LinkFieldType"]=3;
	$fdata["DisplayField"]="IngredientClassID";
				$fdata["LookupTable"]="vw_ingredientclass";
	$fdata["LookupOrderBy"]="IngredientClassID";
																			
					
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientClassID";
	
		$fdata["FullName"]= "IngredientClassID";
	
		
		
		
		
		
				$fdata["Index"]= 14;
				
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IngredientClassID"]=$fdata;
//	IngredientClass
	$fdata = array();
	$fdata["strName"] = "IngredientClass";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Ingredient Class"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientClass";
	
		$fdata["FullName"]= "IngredientClass";
	
		
		
		
		
		
				$fdata["Index"]= 15;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_ingredientclass["IngredientClass"]=$fdata;
//	Description4
	$fdata = array();
	$fdata["strName"] = "Description4";
	$fdata["ownerTable"] = "vw_ingredientclass";
		$fdata["Label"]="Sub-classification"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Lookup wizard";
	$fdata["ViewFormat"]= "";
	
		
		$fdata["LookupType"]=1;
	$fdata["pLookupType"] = 1;
	$fdata["freeInput"] = 0;	
	$fdata["autoCompleteFieldsOnEdit"] = 0;
	$fdata["autoCompleteFields"] = array();
										$fdata["LookupUnique"]=true;
	$fdata["LinkField"]="Description4";
	$fdata["LinkFieldType"]=200;
	$fdata["DisplayField"]="Description3";
				$fdata["LookupTable"]="vw_ingredientclass";
	$fdata["LookupOrderBy"]="Description3";
										$fdata["UseCategory"]=true; 
	$fdata["CategoryControl"]="Description2"; 
	$fdata["CategoryFilter"]="Description2"; 
										
				//	dependent dropdowns	
	$fdata["DependentLookups"]=array();
	$fdata["DependentLookups"][]="IName";
					
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description4";
	
		$fdata["FullName"]= "Description4";
	
		
		
		
		
		
				$fdata["Index"]= 16;
				
		
		
		
		
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				
		
				
		
		
		
			$tdatavw_ingredientclass["Description4"]=$fdata;

	
$tables_data["vw_ingredientclass"]=&$tdatavw_ingredientclass;
$field_labels["vw_ingredientclass"] = &$fieldLabelsvw_ingredientclass;
$fieldToolTips["vw_ingredientclass"] = &$fieldToolTipsvw_ingredientclass;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_ingredientclass"] = array();
$dIndex = 1-1;
			$strOriginalDetailsTable="vw_fullingredientelementanalysis";
	$detailsTablesData["vw_ingredientclass"][$dIndex] = array(
		  "dDataSourceTable"=>"vw_fullingredientelementanalysis"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"vw_fullingredientelementanalysis"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"1"
		, "sqlHead"=>"SELECT IngredientID,  ElementID,  EName,  CommonName,  TagName,  ElementTypeID,  Description,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  IValue"	
		, "sqlFrom"=>"FROM vw_fullingredientelementanalysis"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 2
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 1
	);	
		$detailsTablesData["vw_ingredientclass"][$dIndex]["masterKeys"][]="IngredientID";
		$detailsTablesData["vw_ingredientclass"][$dIndex]["detailKeys"][]="IngredientID";

$dIndex = 2-1;
			$strOriginalDetailsTable="vw_fullingredientproxanalysis";
	$detailsTablesData["vw_ingredientclass"][$dIndex] = array(
		  "dDataSourceTable"=>"vw_fullingredientproxanalysis"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"vw_fullingredientproxanalysis"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"1"
		, "sqlHead"=>"SELECT IngredientID,  ElementTypeID,  Description,  UnitName,  UnitSymbol,  UnitDecimal,  ETValue,  IisDetail"	
		, "sqlFrom"=>"FROM vw_fullingredientproxanalysis"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 2
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 1
	);	
		$detailsTablesData["vw_ingredientclass"][$dIndex]["masterKeys"][]="IngredientID";
		$detailsTablesData["vw_ingredientclass"][$dIndex]["detailKeys"][]="IngredientID";

$dIndex = 3-1;
			$strOriginalDetailsTable="vw_ingredientspecassociation";
	$detailsTablesData["vw_ingredientclass"][$dIndex] = array(
		  "dDataSourceTable"=>"vw_ingredientspecassociation"
		, "dOriginalTable"=>$strOriginalDetailsTable
		, "dShortTable"=>"vw_ingredientspecassociation"
		, "masterKeys"=>array()
		, "detailKeys"=>array()
		, "dispChildCount"=> "1"
		, "hideChild"=>"1"
		, "sqlHead"=>"SELECT IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  SpeciesID,  SpecName,  CommonName,  Hybrid,  Variety,  Family,  `Group`,  Genus,  Environment,  FeedHabit,  Country,  SpecYear,  `lower`,  `upper`"	
		, "sqlFrom"=>"FROM vw_ingredientspecassociation"	
		, "sqlWhere"=>""
		, "sqlTail"=>""
		, "groupBy"=>"0"
		, "previewOnList" => 2
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 1
	);	
		$detailsTablesData["vw_ingredientclass"][$dIndex]["masterKeys"][]="IngredientID";
		$detailsTablesData["vw_ingredientclass"][$dIndex]["detailKeys"][]="IngredientID";


	
// tables which are master tables for current table (detail)
$masterTablesData["vw_ingredientclass"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "IngredientID,  IName,  IfeedNo,  Description1,  Description2,  Description3,  IisDetail,  IDSourceID,  DataSource,  CountryID,  ICountry,  IngredientSpecID,  Species,  IngredientClassID,  IngredientClass,  Description4";
$proto0["m_strFrom"] = "FROM vw_ingredientclass";
$proto0["m_strWhere"] = "(IisDetail =1)";
$proto0["m_strOrderBy"] = "ORDER BY IName, IngredientSpecID";
$proto0["m_strTail"] = "";
$proto1=array();
$proto1["m_sql"] = "IisDetail =1";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "IisDetail",
	"m_strTable" => "vw_ingredientclass"
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "=1";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientID",
	"m_strTable" => "vw_ingredientclass"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "IName",
	"m_strTable" => "vw_ingredientclass"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "IfeedNo",
	"m_strTable" => "vw_ingredientclass"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Description1",
	"m_strTable" => "vw_ingredientclass"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Description2",
	"m_strTable" => "vw_ingredientclass"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Description3",
	"m_strTable" => "vw_ingredientclass"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "IisDetail",
	"m_strTable" => "vw_ingredientclass"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "IDSourceID",
	"m_strTable" => "vw_ingredientclass"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "DataSource",
	"m_strTable" => "vw_ingredientclass"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "CountryID",
	"m_strTable" => "vw_ingredientclass"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "ICountry",
	"m_strTable" => "vw_ingredientclass"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientSpecID",
	"m_strTable" => "vw_ingredientclass"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "Species",
	"m_strTable" => "vw_ingredientclass"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientClassID",
	"m_strTable" => "vw_ingredientclass"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientClass",
	"m_strTable" => "vw_ingredientclass"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "Description4",
	"m_strTable" => "vw_ingredientclass"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto37=array();
$proto37["m_link"] = "SQLL_MAIN";
			$proto38=array();
$proto38["m_strName"] = "vw_ingredientclass";
$proto38["m_columns"] = array();
$proto38["m_columns"][] = "IngredientID";
$proto38["m_columns"][] = "IName";
$proto38["m_columns"][] = "IfeedNo";
$proto38["m_columns"][] = "Description1";
$proto38["m_columns"][] = "Description2";
$proto38["m_columns"][] = "Description3";
$proto38["m_columns"][] = "Description4";
$proto38["m_columns"][] = "IisDetail";
$proto38["m_columns"][] = "IDSourceID";
$proto38["m_columns"][] = "DataSource";
$proto38["m_columns"][] = "CountryID";
$proto38["m_columns"][] = "ICountry";
$proto38["m_columns"][] = "IngredientSpecID";
$proto38["m_columns"][] = "Species";
$proto38["m_columns"][] = "IngredientClassID";
$proto38["m_columns"][] = "IngredientClass";
$obj = new SQLTable($proto38);

$proto37["m_table"] = $obj;
$proto37["m_alias"] = "";
$proto39=array();
$proto39["m_sql"] = "";
$proto39["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto39["m_column"]=$obj;
$proto39["m_contained"] = array();
$proto39["m_strCase"] = "";
$proto39["m_havingmode"] = "0";
$proto39["m_inBrackets"] = "0";
$proto39["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto39);

$proto37["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto37);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
												$proto41=array();
						$obj = new SQLField(array(
	"m_strName" => "IName",
	"m_strTable" => "vw_ingredientclass"
));

$proto41["m_column"]=$obj;
$proto41["m_bAsc"] = 1;
$proto41["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto41);

$proto0["m_orderby"][]=$obj;					
												$proto43=array();
						$obj = new SQLField(array(
	"m_strName" => "IngredientSpecID",
	"m_strTable" => "vw_ingredientclass"
));

$proto43["m_column"]=$obj;
$proto43["m_bAsc"] = 1;
$proto43["m_nColumn"] = 0;
$obj = new SQLOrderByItem($proto43);

$proto0["m_orderby"][]=$obj;					
$obj = new SQLQuery($proto0);

$queryData_vw_ingredientclass = $obj;
$tdatavw_ingredientclass[".sqlquery"] = $queryData_vw_ingredientclass;

include(getabspath("include/vw_ingredientclass_events.php"));
$tableEvents["vw_ingredientclass"] = new eventclass_vw_ingredientclass;

?>
