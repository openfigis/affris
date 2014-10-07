<?php
$tdatavw_fullingredientelementanalysis=array();
	$tdatavw_fullingredientelementanalysis[".NumberOfChars"]=80; 
	$tdatavw_fullingredientelementanalysis[".ShortName"]="vw_fullingredientelementanalysis";
	$tdatavw_fullingredientelementanalysis[".OwnerID"]="";
	$tdatavw_fullingredientelementanalysis[".OriginalTable"]="vw_fullingredientelementanalysis";


	
//	field labels
$fieldLabelsvw_fullingredientelementanalysis = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelsvw_fullingredientelementanalysis["English"]=array();
	$fieldToolTipsvw_fullingredientelementanalysis["English"]=array();
	$fieldLabelsvw_fullingredientelementanalysis["English"]["IngredientID"] = "Ingredient ID";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["IngredientID"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["ElementID"] = "Element ID";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["ElementID"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["EName"] = "Element Name";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["EName"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["CommonName"] = "Symbol/Common Name";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["CommonName"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["TagName"] = "Technical description";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["TagName"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["ElementTypeID"] = "Element Type ID";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["ElementTypeID"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["Description"] = "Category";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["Description"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitID"] = "Unit ID";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["UnitID"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitName"] = "Unit Name";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["UnitName"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitSymbol"] = "Unit Symbol";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["UnitSymbol"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["UnitDecimal"] = "Unit Decimal";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["UnitDecimal"] = "";
	$fieldLabelsvw_fullingredientelementanalysis["English"]["IValue"] = "Inclusion";
	$fieldToolTipsvw_fullingredientelementanalysis["English"]["IValue"] = "";
	if (count($fieldToolTipsvw_fullingredientelementanalysis["English"])){
		$tdatavw_fullingredientelementanalysis[".isUseToolTips"]=true;
	}
}


	

	

$tdatavw_fullingredientelementanalysis[".shortTableName"] = "vw_fullingredientelementanalysis";
$tdatavw_fullingredientelementanalysis[".nSecOptions"] = 0;
$tdatavw_fullingredientelementanalysis[".recsPerRowList"] = 1;	
$tdatavw_fullingredientelementanalysis[".tableGroupBy"] = "0";
$tdatavw_fullingredientelementanalysis[".mainTableOwnerID"] = "";
$tdatavw_fullingredientelementanalysis[".moveNext"] = 1;




$tdatavw_fullingredientelementanalysis[".showAddInPopup"] = false;

$tdatavw_fullingredientelementanalysis[".showEditInPopup"] = false;

$tdatavw_fullingredientelementanalysis[".showViewInPopup"] = false;


$tdatavw_fullingredientelementanalysis[".fieldsForRegister"] = array();

$tdatavw_fullingredientelementanalysis[".listAjax"] = false;

	$tdatavw_fullingredientelementanalysis[".audit"] = false;

	$tdatavw_fullingredientelementanalysis[".locking"] = false;
	
$tdatavw_fullingredientelementanalysis[".edit"] = true;
$tdatavw_fullingredientelementanalysis[".copy"] = true;
$tdatavw_fullingredientelementanalysis[".view"] = true;



$tdatavw_fullingredientelementanalysis[".delete"] = true;

$tdatavw_fullingredientelementanalysis[".showSimpleSearchOptions"] = false;

$tdatavw_fullingredientelementanalysis[".showSearchPanel"] = true;


$tdatavw_fullingredientelementanalysis[".isUseAjaxSuggest"] = true;

$tdatavw_fullingredientelementanalysis[".rowHighlite"] = true;


// button handlers file names

$tdatavw_fullingredientelementanalysis[".addPageEvents"] = false;

$tdatavw_fullingredientelementanalysis[".arrKeyFields"][] = "IngredientID";

// use datepicker for search panel
$tdatavw_fullingredientelementanalysis[".isUseCalendarForSearch"] = false;

// use timepicker for search panel
$tdatavw_fullingredientelementanalysis[".isUseTimeForSearch"] = false;

$tdatavw_fullingredientelementanalysis[".isUseiBox"] = false;




$tdatavw_fullingredientelementanalysis[".isUseInlineJs"] = $tdatavw_fullingredientelementanalysis[".isUseInlineAdd"] || $tdatavw_fullingredientelementanalysis[".isUseInlineEdit"];

$tdatavw_fullingredientelementanalysis[".allSearchFields"] = array();

$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "IngredientID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IngredientID", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "IngredientID";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "ElementID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementID", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "ElementID";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "UnitDecimal";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitDecimal", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitDecimal";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "UnitSymbol";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitSymbol", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitSymbol";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "UnitName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitName", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitName";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "ElementTypeID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementTypeID", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "ElementTypeID";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "IValue";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IValue", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "IValue";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "UnitID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitID", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitID";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "EName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("EName", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "EName";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "CommonName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("CommonName", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "CommonName";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "TagName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TagName", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "TagName";	
}
$tdatavw_fullingredientelementanalysis[".globSearchFields"][] = "Description";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description", $tdatavw_fullingredientelementanalysis[".allSearchFields"]))
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "Description";	
}


$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "IngredientID";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "ElementID";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "UnitDecimal";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "UnitSymbol";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "UnitName";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "ElementTypeID";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "IValue";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "UnitID";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "EName";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "CommonName";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "TagName";
$tdatavw_fullingredientelementanalysis[".googleLikeFields"][] = "Description";



$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "IngredientID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IngredientID", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "IngredientID";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "ElementID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementID", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "ElementID";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "UnitDecimal";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitDecimal", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitDecimal";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "UnitSymbol";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitSymbol", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitSymbol";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "UnitName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitName", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitName";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "ElementTypeID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("ElementTypeID", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "ElementTypeID";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "IValue";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("IValue", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "IValue";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "UnitID";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("UnitID", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "UnitID";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "EName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("EName", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "EName";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "CommonName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("CommonName", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "CommonName";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "TagName";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("TagName", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "TagName";	
}
$tdatavw_fullingredientelementanalysis[".advSearchFields"][] = "Description";
// do in this way, because combine functions array_unique and array_merge returns array with keys like 1,2, 4 etc
if (!in_array("Description", $tdatavw_fullingredientelementanalysis[".allSearchFields"])) 
{
	$tdatavw_fullingredientelementanalysis[".allSearchFields"][] = "Description";	
}

$tdatavw_fullingredientelementanalysis[".isTableType"] = "list";


	

$tdatavw_fullingredientelementanalysis[".isDisplayLoading"] = true;

$tdatavw_fullingredientelementanalysis[".isResizeColumns"] = false;





$tdatavw_fullingredientelementanalysis[".pageSize"] = 20;

$gstrOrderBy = "";
if(strlen($gstrOrderBy) && strtolower(substr($gstrOrderBy,0,8))!="order by")
	$gstrOrderBy = "order by ".$gstrOrderBy;
$tdatavw_fullingredientelementanalysis[".strOrderBy"] = $gstrOrderBy;
	
$tdatavw_fullingredientelementanalysis[".orderindexes"] = array();

$tdatavw_fullingredientelementanalysis[".sqlHead"] = "SELECT IngredientID,  ElementID,  EName,  CommonName,  TagName,  ElementTypeID,  Description,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  IValue";
$tdatavw_fullingredientelementanalysis[".sqlFrom"] = "FROM vw_fullingredientelementanalysis";
$tdatavw_fullingredientelementanalysis[".sqlWhereExpr"] = "";
$tdatavw_fullingredientelementanalysis[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatavw_fullingredientelementanalysis[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatavw_fullingredientelementanalysis[".arrGroupsPerPage"] = $arrGPP;

	$tableKeys = array();
	$tableKeys[] = "IngredientID";
	$tdatavw_fullingredientelementanalysis[".Keys"] = $tableKeys;

//	IngredientID
	$fdata = array();
	$fdata["strName"] = "IngredientID";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
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
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["IngredientID"]=$fdata;
//	ElementID
	$fdata = array();
	$fdata["strName"] = "ElementID";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Element ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementID";
	
		$fdata["FullName"]= "ElementID";
	
		
		
		
		
		
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
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["ElementID"]=$fdata;
//	EName
	$fdata = array();
	$fdata["strName"] = "EName";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Element Name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "EName";
	
		$fdata["FullName"]= "EName";
	
		
		
		
		
		
				$fdata["Index"]= 3;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["EName"]=$fdata;
//	CommonName
	$fdata = array();
	$fdata["strName"] = "CommonName";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Symbol/Common Name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "CommonName";
	
		$fdata["FullName"]= "CommonName";
	
		
		
		
		
		
				$fdata["Index"]= 4;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["CommonName"]=$fdata;
//	TagName
	$fdata = array();
	$fdata["strName"] = "TagName";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Technical description"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "TagName";
	
		$fdata["FullName"]= "TagName";
	
		
		
		
		
		
				$fdata["Index"]= 5;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=500";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["TagName"]=$fdata;
//	ElementTypeID
	$fdata = array();
	$fdata["strName"] = "ElementTypeID";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Element Type ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ElementTypeID";
	
		$fdata["FullName"]= "ElementTypeID";
	
		
		
		
		
		
				$fdata["Index"]= 6;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["ElementTypeID"]=$fdata;
//	Description
	$fdata = array();
	$fdata["strName"] = "Description";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Category"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "Description";
	
		$fdata["FullName"]= "Description";
	
		
		
		
		
		
				$fdata["Index"]= 7;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=200";
		
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["Description"]=$fdata;
//	UnitID
	$fdata = array();
	$fdata["strName"] = "UnitID";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Unit ID"; 
	
		
		
	$fdata["FieldType"]= 3;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitID";
	
		$fdata["FullName"]= "UnitID";
	
		
		
		
		
		
				$fdata["Index"]= 8;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["UnitID"]=$fdata;
//	UnitName
	$fdata = array();
	$fdata["strName"] = "UnitName";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Unit Name"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitName";
	
		$fdata["FullName"]= "UnitName";
	
		
		
		
		
		
				$fdata["Index"]= 9;
				$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=45";
		
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
		
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["UnitName"]=$fdata;
//	UnitSymbol
	$fdata = array();
	$fdata["strName"] = "UnitSymbol";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Unit Symbol"; 
	
		
		
	$fdata["FieldType"]= 200;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitSymbol";
	
		$fdata["FullName"]= "UnitSymbol";
	
		
		
		
		
		
				$fdata["Index"]= 10;
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
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["UnitSymbol"]=$fdata;
//	UnitDecimal
	$fdata = array();
	$fdata["strName"] = "UnitDecimal";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Unit Decimal"; 
	
		
		
	$fdata["FieldType"]= 2;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
		
		
		
		
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "UnitDecimal";
	
		$fdata["FullName"]= "UnitDecimal";
	
		
		
		
		
		
				$fdata["Index"]= 11;
				$fdata["EditParams"]="";
			
		
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["UnitDecimal"]=$fdata;
//	IValue
	$fdata = array();
	$fdata["strName"] = "IValue";
	$fdata["ownerTable"] = "vw_fullingredientelementanalysis";
		$fdata["Label"]="Inclusion"; 
	
		
		
	$fdata["FieldType"]= 5;
	
		
			$fdata["UseiBox"] = false;
	
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "Number";
	
		
		
		
		$fdata["DecimalDigits"] = 2;
	
		$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "IValue";
	
		$fdata["FullName"]= "IValue";
	
		
		
		
		
		
				$fdata["Index"]= 12;
				$fdata["EditParams"]="";
			
		$fdata["bListPage"]=true; 
	
		$fdata["bAddPage"]=true; 
	
		
		$fdata["bEditPage"]=true; 
	
		
		$fdata["bViewPage"]=true; 
	
		$fdata["bAdvancedSearch"]=true; 
	
		
		
	//Begin validation
	$fdata["validateAs"] = array();
				$fdata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
		//End validation
	
				$fdata["FieldPermissions"]=true;
	
		
				
		
		
		
			$tdatavw_fullingredientelementanalysis["IValue"]=$fdata;

	
$tables_data["vw_fullingredientelementanalysis"]=&$tdatavw_fullingredientelementanalysis;
$field_labels["vw_fullingredientelementanalysis"] = &$fieldLabelsvw_fullingredientelementanalysis;
$fieldToolTips["vw_fullingredientelementanalysis"] = &$fieldToolTipsvw_fullingredientelementanalysis;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["vw_fullingredientelementanalysis"] = array();

	
// tables which are master tables for current table (detail)
$masterTablesData["vw_fullingredientelementanalysis"] = array();

$mIndex = 1-1;
			$strOriginalDetailsTable="vw_ingredientclass";
	$masterTablesData["vw_fullingredientelementanalysis"][$mIndex] = array(
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
		$masterTablesData["vw_fullingredientelementanalysis"][$mIndex]["masterKeys"][]="IngredientID";
		$masterTablesData["vw_fullingredientelementanalysis"][$mIndex]["detailKeys"][]="IngredientID";

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










$proto70=array();
$proto70["m_strHead"] = "SELECT";
$proto70["m_strFieldList"] = "IngredientID,  ElementID,  EName,  CommonName,  TagName,  ElementTypeID,  Description,  UnitID,  UnitName,  UnitSymbol,  UnitDecimal,  IValue";
$proto70["m_strFrom"] = "FROM vw_fullingredientelementanalysis";
$proto70["m_strWhere"] = "";
$proto70["m_strOrderBy"] = "";
$proto70["m_strTail"] = "";
$proto71=array();
$proto71["m_sql"] = "";
$proto71["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto71["m_column"]=$obj;
$proto71["m_contained"] = array();
$proto71["m_strCase"] = "";
$proto71["m_havingmode"] = "0";
$proto71["m_inBrackets"] = "0";
$proto71["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto71);

$proto70["m_where"] = $obj;
$proto73=array();
$proto73["m_sql"] = "";
$proto73["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto73["m_column"]=$obj;
$proto73["m_contained"] = array();
$proto73["m_strCase"] = "";
$proto73["m_havingmode"] = "0";
$proto73["m_inBrackets"] = "0";
$proto73["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto73);

$proto70["m_having"] = $obj;
$proto70["m_fieldlist"] = array();
						$proto75=array();
			$obj = new SQLField(array(
	"m_strName" => "IngredientID",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto75["m_expr"]=$obj;
$proto75["m_alias"] = "";
$obj = new SQLFieldListItem($proto75);

$proto70["m_fieldlist"][]=$obj;
						$proto77=array();
			$obj = new SQLField(array(
	"m_strName" => "ElementID",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto77["m_expr"]=$obj;
$proto77["m_alias"] = "";
$obj = new SQLFieldListItem($proto77);

$proto70["m_fieldlist"][]=$obj;
						$proto79=array();
			$obj = new SQLField(array(
	"m_strName" => "EName",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto79["m_expr"]=$obj;
$proto79["m_alias"] = "";
$obj = new SQLFieldListItem($proto79);

$proto70["m_fieldlist"][]=$obj;
						$proto81=array();
			$obj = new SQLField(array(
	"m_strName" => "CommonName",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto81["m_expr"]=$obj;
$proto81["m_alias"] = "";
$obj = new SQLFieldListItem($proto81);

$proto70["m_fieldlist"][]=$obj;
						$proto83=array();
			$obj = new SQLField(array(
	"m_strName" => "TagName",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto83["m_expr"]=$obj;
$proto83["m_alias"] = "";
$obj = new SQLFieldListItem($proto83);

$proto70["m_fieldlist"][]=$obj;
						$proto85=array();
			$obj = new SQLField(array(
	"m_strName" => "ElementTypeID",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto85["m_expr"]=$obj;
$proto85["m_alias"] = "";
$obj = new SQLFieldListItem($proto85);

$proto70["m_fieldlist"][]=$obj;
						$proto87=array();
			$obj = new SQLField(array(
	"m_strName" => "Description",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto87["m_expr"]=$obj;
$proto87["m_alias"] = "";
$obj = new SQLFieldListItem($proto87);

$proto70["m_fieldlist"][]=$obj;
						$proto89=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitID",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto89["m_expr"]=$obj;
$proto89["m_alias"] = "";
$obj = new SQLFieldListItem($proto89);

$proto70["m_fieldlist"][]=$obj;
						$proto91=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitName",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto91["m_expr"]=$obj;
$proto91["m_alias"] = "";
$obj = new SQLFieldListItem($proto91);

$proto70["m_fieldlist"][]=$obj;
						$proto93=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitSymbol",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto93["m_expr"]=$obj;
$proto93["m_alias"] = "";
$obj = new SQLFieldListItem($proto93);

$proto70["m_fieldlist"][]=$obj;
						$proto95=array();
			$obj = new SQLField(array(
	"m_strName" => "UnitDecimal",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto95["m_expr"]=$obj;
$proto95["m_alias"] = "";
$obj = new SQLFieldListItem($proto95);

$proto70["m_fieldlist"][]=$obj;
						$proto97=array();
			$obj = new SQLField(array(
	"m_strName" => "IValue",
	"m_strTable" => "vw_fullingredientelementanalysis"
));

$proto97["m_expr"]=$obj;
$proto97["m_alias"] = "";
$obj = new SQLFieldListItem($proto97);

$proto70["m_fieldlist"][]=$obj;
$proto70["m_fromlist"] = array();
												$proto99=array();
$proto99["m_link"] = "SQLL_MAIN";
			$proto100=array();
$proto100["m_strName"] = "vw_fullingredientelementanalysis";
$proto100["m_columns"] = array();
$proto100["m_columns"][] = "IngredientID";
$proto100["m_columns"][] = "ElementID";
$proto100["m_columns"][] = "EName";
$proto100["m_columns"][] = "CommonName";
$proto100["m_columns"][] = "TagName";
$proto100["m_columns"][] = "ElementTypeID";
$proto100["m_columns"][] = "Description";
$proto100["m_columns"][] = "UnitID";
$proto100["m_columns"][] = "UnitName";
$proto100["m_columns"][] = "UnitSymbol";
$proto100["m_columns"][] = "UnitDecimal";
$proto100["m_columns"][] = "IValue";
$obj = new SQLTable($proto100);

$proto99["m_table"] = $obj;
$proto99["m_alias"] = "";
$proto101=array();
$proto101["m_sql"] = "";
$proto101["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto101["m_column"]=$obj;
$proto101["m_contained"] = array();
$proto101["m_strCase"] = "";
$proto101["m_havingmode"] = "0";
$proto101["m_inBrackets"] = "0";
$proto101["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto101);

$proto99["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto99);

$proto70["m_fromlist"][]=$obj;
$proto70["m_groupby"] = array();
$proto70["m_orderby"] = array();
$obj = new SQLQuery($proto70);

$queryData_vw_fullingredientelementanalysis = $obj;
$tdatavw_fullingredientelementanalysis[".sqlquery"] = $queryData_vw_fullingredientelementanalysis;

$tableEvents["vw_fullingredientelementanalysis"] = new eventsBase;

?>
