<?php
$tdatavw_fullingredientproxanalysis=array();
	$tdatavw_fullingredientproxanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullingredientproxanalysis[".ShortName"]="vw_fullingredientproxanalysis";
	$tdatavw_fullingredientproxanalysis[".OwnerID"]="";
	$tdatavw_fullingredientproxanalysis[".OriginalTable"]="vw_fullingredientproxanalysis";


	
//	field labels
$fieldLabelsvw_fullingredientproxanalysis = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_fullingredientproxanalysis["English"]=array();
	$fieldToolTipsvw_fullingredientproxanalysis["English"]=array();
	$fieldLabelsvw_fullingredientproxanalysis["English"]["IngredientID"] = "Ingredient ID";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["IngredientID"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["ElementTypeID"] = "Element Type ID";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["ElementTypeID"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["Description"] = "Description";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["Description"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitName"] = "Unit Name";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["UnitName"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitSymbol"] = "Unit Symbol";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["UnitSymbol"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["UnitDecimal"] = "Unit Decimal";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["UnitDecimal"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["ETValue"] = "Inclusion";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["ETValue"] = "";
	$fieldLabelsvw_fullingredientproxanalysis["English"]["IisDetail"] = "Iis Detail";
	$fieldToolTipsvw_fullingredientproxanalysis["English"]["IisDetail"] = "";
	if (count($fieldToolTipsvw_fullingredientproxanalysis["English"])){
		$tdatavw_fullingredientproxanalysis[".isUseToolTips"]=true;
	}
}


	

	

$tdatavw_fullingredientproxanalysis[".shortTableName"] = "vw_fullingredientproxanalysis";
$tdatavw_fullingredientproxanalysis[".nSecOptions"] = 0;
$tdatavw_fullingredientproxanalysis[".recsPerRowList"] = 1;	
$tdatavw_fullingredientproxanalysis[".tableGroupBy"] = "0";
$tdatavw_fullingredientproxanalysis[".mainTableOwnerID"] = "";
$tdatavw_fullingredientproxanalysis[".moveNext"] = 1;




$tdatavw_fullingredientproxanalysis[".showAddInPopup"] = false;

$tdatavw_fullingredientproxanalysis[".showEditInPopup"] = false;

$tdatavw_fullingredientproxanalysis[".showViewInPopup"] = false;


$tdatavw_fullingredientproxanalysis[".fieldsForRegister"] = array();

$tdatavw_fullingredientproxanalysis[".listAjax"] = false;

	$tdatavw_fullingredientproxanalysis[".audit"] = false;

	$tdatavw_fullingredientproxanalysis[".locking"] = false;
	
$tdatavw_fullingredientproxanalysis[".edit"] = true;
$tdatavw_fullingredientproxanalysis[".copy"] = true;
$tdatavw_fullingredientproxanalysis[".view"] = true;



$tdatavw_fullingredientproxanalysis[".delete"] = true;

$tdatavw_fullingredientproxanalysis[".showSimpleSearchOptions"] = false;

$tdatavw_fullingredientproxanalysis[".showSearchPanel"] = true;


$tdatavw_fullingredientproxanalysis[".isUseAjaxSuggest"] = true;

$tdatavw_fullingredientproxanalysis[".rowHighlite"] = true;


// button handlers file names

$tdatavw_fullingredientproxanalysis[".addPageEvents"] = false;

$tdatavw_fullingredientproxanalysis[".arrKeyFields"][] = "IngredientID";

// use datepicker for search panel
$tdatavw_fullingredientproxanalysis[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatavw_fullingredientproxanalysis[".isUseTimeForSearch"] = false;

$tdatavw_fullingredientproxanalysis[".isUseiBox"] = false;




$tdatavw_fullingredientproxanalysis[".isUseInlineJs"] = $tdatavw_fullingredientproxanalysis[".isUseInlineAdd"] || $tdatavw_fullingredientproxanalysis[".isUseInlineEdit"];

$tdatavw_fullingredientproxanalysis[".allSearchFields"] = array();

$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "IngredientID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IngredientID", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "IngredientID";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "ElementTypeID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementTypeID", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "ElementTypeID";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "Description";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "Description";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "UnitName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitName", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitName";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "UnitSymbol";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitSymbol", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitSymbol";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "UnitDecimal";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitDecimal", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitDecimal";	
}
$tdatavw_fullingredientproxanalysis[".globSearchFields"][] = "ETValue";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ETValue", $tdatavw_fullingredientproxanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "ETValue";	
}


$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "IngredientID";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "ElementTypeID";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "Description";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "UnitName";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "UnitSymbol";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "UnitDecimal";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "ETValue";
$tdatavw_fullingredientproxanalysis[".googleLikeFields"][] = "IisDetail";



$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "IngredientID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IngredientID", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "IngredientID";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "ElementTypeID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementTypeID", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "ElementTypeID";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "Description";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "Description";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "UnitName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitName", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitName";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "UnitSymbol";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitSymbol", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitSymbol";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "UnitDecimal";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitDecimal", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "UnitDecimal";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "ETValue";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ETValue", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "ETValue";	
}
$tdatavw_fullingredientproxanalysis[".advSearchFields"][] = "IisDetail";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IisDetail", $tdatavw_fullingredientproxanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientproxanalysis[".allSearchFields"][] = "IisDetail";	
}

$tdatavw_fullingredientproxanalysis[".isTableType"] = "list";


	

$tdatavw_fullingredientproxanalysis[".isDisplayLoading"] = true;

$tdatavw_fullingredientproxanalysis[".isResizeColumns"] = false;





$tdatavw_fullingredientproxanalysis[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatavw_fullingredientproxanalysis[".strOrderBy"] = $gstrOrderBy;
	
$tdatavw_fullingredientproxanalysis[".orderindexes"] = array();

$tdatavw_fullingredientproxanalysis[".sqlHead"] = "SELECT IngredientID,  ElementTypeID,  Description,  UnitName,  UnitSymbol,  UnitDecimal,  ETValue,  IisDetail";
$tdatavw_fullingredientproxanalysis[".sqlFrom"] = "FROM vw_fullingredientproxanalysis";
$tdatavw_fullingredientproxanalysis[".sqlWhereExpr"] = "";
$tdatavw_fullingredientproxanalysis[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_fullingredientproxanalysis[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_fullingredientproxanalysis[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "IngredientID";
	$tdatavw_fullingredientproxanalysis[".Keys"] = $tableKeys;

//	IngredientID
	$fdata = array();
	$fdata["strName"] = "IngredientID";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Ingredient ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IngredientID";
	
		$fdata["FullName"]= "IngredientID";
	
		$fdata["IsRequired"]=true; 
	
		
		
		
		
				$fdata["Index"]= 1;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$fdata["validateAs"]["basicValidate"][] = "IsRequired";
	
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["IngredientID"]=$fdata;
//	ElementTypeID
	$fdata = array();
	$fdata["strName"] = "ElementTypeID";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Element Type ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementTypeID";
	
		$fdata["FullName"]= "ElementTypeID";
	
		
		
		
		
		
				$fdata["Index"]= 2;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["ElementTypeID"]=$fdata;
//	Description
	$fdata = array();
	$fdata["strName"] = "Description";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description";
	
		$fdata["FullName"]= "Description";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["Description"]=$fdata;
//	UnitName
	$fdata = array();
	$fdata["strName"] = "UnitName";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Unit Name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
	
		$fdata["FullName"]= "UnitName";
	
		
		
		
		
		
				$fdata["Index"]= 4;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["UnitName"]=$fdata;
//	UnitSymbol
	$fdata = array();
	$fdata["strName"] = "UnitSymbol";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Unit Symbol"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
	
		$fdata["FullName"]= "UnitSymbol";
	
		
		
		
		
		
				$fdata["Index"]= 5;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["UnitSymbol"]=$fdata;
//	UnitDecimal
	$fdata = array();
	$fdata["strName"] = "UnitDecimal";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Unit Decimal"; 
	
		
		
	$fdata["FieldType"]= 2;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
	
		$fdata["FullName"]= "UnitDecimal";
	
		
		
		
		
		
				$fdata["Index"]= 6;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["UnitDecimal"]=$fdata;
//	ETValue
	$fdata = array();
	$fdata["strName"] = "ETValue";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Inclusion"; 
	
		
		
	$fdata["FieldType"]= 5;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ETValue";
	
		$fdata["FullName"]= "ETValue";
	
		
		
		
		
		
				$fdata["Index"]= 7;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["ETValue"]=$fdata;
//	IisDetail
	$fdata = array();
	$fdata["strName"] = "IisDetail";
	$fdata["ownerTable"] = "vw_fullingredientproxanalysis";
		$fdata["Label"]="Iis Detail"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IisDetail";
	
		$fdata["FullName"]= "IisDetail";
	
		
		
		
		
		
				$fdata["Index"]= 8;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientproxanalysis["IisDetail"]=$fdata;

	
$tables_data["vw_fullingredientproxanalysis"]=&$tdatavw_fullingredientproxanalysis;
$field_labels["vw_fullingredientproxanalysis"] = &$fieldLabelsvw_fullingredientproxanalysis;
$fieldToolTips["vw_fullingredientproxanalysis"] = &$fieldToolTipsvw_fullingredientproxanalysis;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_fullingredientproxanalysis"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["vw_fullingredientproxanalysis"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="vw_ingredientclass";
	$masterTablesData["vw_fullingredientproxanalysis"][$mIndex] = array(
		  "mDataSourceTable"=>"vw_ingredientclass"
		, "mOriginalTable" => $strOriginalDetailsTable
		, "mShortTable" => "vw_ingredientclass"
		, "masterKeys" => array()
		, "detailKeys" => array()
		, "dispChildCount" => "1"
		, "hideChild" => "1"	
		, "dispInfo" => "1"								
		, "previewOnList" => 2
		, "previewOnAdd" => 0
		, "previewOnEdit" => 0
		, "previewOnView" => 1
	);	
		$masterTablesData["vw_fullingredientproxanalysis"][$mIndex]["masterKeys"][]="IngredientID";
		$masterTablesData["vw_fullingredientproxanalysis"][$mIndex]["detailKeys"][]="IngredientID";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto45=array();
$proto45["m_strHead"] = "SELECT";
$proto45["m_strFieldList"] = "IngredientID,  ElementTypeID,  Description,  UnitName,  UnitSymbol,  UnitDecimal,  ETValue,  IisDetail";
$proto45["m_strFrom"] = "FROM vw_fullingredientproxanalysis";
$proto45["m_strWhere"] = "";
$proto45["m_strOrderBy"] = "";
$proto45["m_strTail"] = "";
$proto46=array();
$proto46["m_sql"] = "";
$proto46["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto46["m_column"]=$obj;
$proto46["m_contained"] = array();
$proto46["m_strCase"] = "";
$proto46["m_havingmode"] = "0";
$proto46["m_inBrackets"] = "0";
$proto46["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto46);

$proto45["m_where"] = $obj;
$proto48=array();
$proto48["m_sql"] = "";
$proto48["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto48["m_column"]=$obj;
$proto48["m_contained"] = array();
$proto48["m_strCase"] = "";
$proto48["m_havingmode"] = "0";
$proto48["m_inBrackets"] = "0";
$proto48["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto48);

$proto45["m_having"] = $obj;
$proto45["m_fieldlist"] = array();
						$proto50=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientID",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto50["m_expr"]=$obj;
$proto50["m_alias"] = "";
$obj = new SQLFieldListItem($proto50);

$proto45["m_fieldlist"][]=$obj;
						$proto52=array();
			$obj = new SQLField(array(
	"m_strName" => "ElementTypeID",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto52["m_expr"]=$obj;
$proto52["m_alias"] = "";
$obj = new SQLFieldListItem($proto52);

$proto45["m_fieldlist"][]=$obj;
						$proto54=array();
			$obj = new SQLField(array(
	"m_strName" => "Description",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto54["m_expr"]=$obj;
$proto54["m_alias"] = "";
$obj = new SQLFieldListItem($proto54);

$proto45["m_fieldlist"][]=$obj;
						$proto56=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitName",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto56["m_expr"]=$obj;
$proto56["m_alias"] = "";
$obj = new SQLFieldListItem($proto56);

$proto45["m_fieldlist"][]=$obj;
						$proto58=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitSymbol",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto58["m_expr"]=$obj;
$proto58["m_alias"] = "";
$obj = new SQLFieldListItem($proto58);

$proto45["m_fieldlist"][]=$obj;
						$proto60=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitDecimal",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto60["m_expr"]=$obj;
$proto60["m_alias"] = "";
$obj = new SQLFieldListItem($proto60);

$proto45["m_fieldlist"][]=$obj;
						$proto62=array();
			$obj = new SQLField(array(
	"m_strName" => "ETValue",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto62["m_expr"]=$obj;
$proto62["m_alias"] = "";
$obj = new SQLFieldListItem($proto62);

$proto45["m_fieldlist"][]=$obj;
						$proto64=array();
			$obj = new SQLField(array(
	"m_strName" => "IisDetail",
	"m_strTable" => "vw_fullingredientproxanalysis"
));

$proto64["m_expr"]=$obj;
$proto64["m_alias"] = "";
$obj = new SQLFieldListItem($proto64);

$proto45["m_fieldlist"][]=$obj;
$proto45["m_fromlist"] = array();
												$proto66=array();
$proto66["m_link"] = "SQLL_MAIN";
			$proto67=array();
$proto67["m_strName"] = "vw_fullingredientproxanalysis";
$proto67["m_columns"] = array();
$proto67["m_columns"][] = "IngredientID";
$proto67["m_columns"][] = "ElementTypeID";
$proto67["m_columns"][] = "Description";
$proto67["m_columns"][] = "UnitName";
$proto67["m_columns"][] = "UnitSymbol";
$proto67["m_columns"][] = "UnitDecimal";
$proto67["m_columns"][] = "ETValue";
$proto67["m_columns"][] = "IisDetail";
$obj = new SQLTable($proto67);

$proto66["m_table"] = $obj;
$proto66["m_alias"] = "";
$proto68=array();
$proto68["m_sql"] = "";
$proto68["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto68["m_column"]=$obj;
$proto68["m_contained"] = array();
$proto68["m_strCase"] = "";
$proto68["m_havingmode"] = "0";
$proto68["m_inBrackets"] = "0";
$proto68["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto68);

$proto66["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto66);

$proto45["m_fromlist"][]=$obj;
$proto45["m_groupby"] = array();
$proto45["m_orderby"] = array();
$obj = new SQLQuery($proto45);

$queryData_vw_fullingredientproxanalysis = $obj;
$tdatavw_fullingredientproxanalysis[".sqlquery"] = $queryData_vw_fullingredientproxanalysis;

$tableEvents["vw_fullingredientproxanalysis"] = new eventsBase;

?>
