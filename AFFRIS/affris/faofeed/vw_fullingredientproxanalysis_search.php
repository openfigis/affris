<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_fullingredientproxanalysis_variables.php");

if(isset($_SESSION[$strTableName.'_advsearch']))
{
	$whereObject = unserialize($_SESSION[$strTableName.'_advsearch']);
	$where = $whereObject->getTable();
}
else
{
	$where = &$_SESSION;
}

$pageName = "search.php";


//Basic includes js files
$includes="";
//javascript code
$jscode="";

$chrt_array=array();
$rpt_array=array();
//	check if logged in
if( (!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !@$chrt_array['status'] && !@$rpt_array['status'])
|| (@$rpt_array['status'] == "private" && @$rpt_array['owner'] != @$_SESSION["UserID"])
|| (@$chrt_array['status'] == "private" && @$chrt_array['owner'] != @$_SESSION["UserID"]) )
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
$xt = new Xtempl();

//	Before Process event
if(function_exists("BeforeProcessSearch"))
	BeforeProcessSearch($conn);

$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
$includes.="<script language=\"JavaScript\" src=\"include/customlabels.js\"></script>\r\n";
$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
AddJSFile("ajaxsuggest");


$jscode.="window.TEXT_MONTH_JAN='".jsreplace("January")."';\r\n";
$jscode.="window.TEXT_MONTH_FEB='".jsreplace("February")."';\r\n";
$jscode.="window.TEXT_MONTH_MAR='".jsreplace("March")."';\r\n";
$jscode.="window.TEXT_MONTH_APR='".jsreplace("April")."';\r\n";
$jscode.="window.TEXT_MONTH_MAY='".jsreplace("May")."';\r\n";
$jscode.="window.TEXT_MONTH_JUN='".jsreplace("June")."';\r\n";
$jscode.="window.TEXT_MONTH_JUL='".jsreplace("July")."';\r\n";
$jscode.="window.TEXT_MONTH_AUG='".jsreplace("August")."';\r\n";
$jscode.="window.TEXT_MONTH_SEP='".jsreplace("September")."';\r\n";
$jscode.="window.TEXT_MONTH_OCT='".jsreplace("October")."';\r\n";
$jscode.="window.TEXT_MONTH_NOV='".jsreplace("November")."';\r\n";
$jscode.="window.TEXT_MONTH_DEC='".jsreplace("December")."';\r\n";

$jscode.="window.TEXT_DAY_SU='".jsreplace("Su")."';\r\n";
$jscode.="window.TEXT_DAY_MO='".jsreplace("Mo")."';\r\n";
$jscode.="window.TEXT_DAY_TU='".jsreplace("Tu")."';\r\n";
$jscode.="window.TEXT_DAY_WE='".jsreplace("We")."';\r\n";
$jscode.="window.TEXT_DAY_TH='".jsreplace("Th")."';\r\n";
$jscode.="window.TEXT_DAY_FR='".jsreplace("Fr")."';\r\n";
$jscode.="window.TEXT_DAY_SA='".jsreplace("Sa")."';\r\n";

$jscode.="window.TEXT_TODAY='".jsreplace("today")."';\r\n";
	
AddJSFile("calendar");
///////////////////////
////////////////////// time picker
//////////////////////

$jscode.="locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
"locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
"bLoading=false;\r\n".
"TEXT_PLEASE_SELECT='".jsreplace("Please select")."';\r\n".
"SUGGEST_TABLE = \"vw_fullingredientproxanalysis_searchsuggest.php\";\r\n".
"detect = navigator.userAgent.toLowerCase();
window.checkIt = function(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}
window.ShowHideControls = function ()
{
	document.getElementById('second_ElementTypeID').style.display =  
		document.forms.editform.elements['asearchopt_ElementTypeID'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Description').style.display =  
		document.forms.editform.elements['asearchopt_Description'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_UnitName').style.display =  
		document.forms.editform.elements['asearchopt_UnitName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_UnitSymbol').style.display =  
		document.forms.editform.elements['asearchopt_UnitSymbol'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_UnitDecimal').style.display =  
		document.forms.editform.elements['asearchopt_UnitDecimal'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_ETValue').style.display =  
		document.forms.editform.elements['asearchopt_ETValue'].value==\"Between\" ? '' : 'none'; 
	return false;
}
window.ResetControls = function()
{
	var i;
	e = document.forms[0].elements; 
	for (i=0;i<e.length;i++) 
	{
		if (e[i].name!='type' && e[i].className!='button' && e[i].type!='hidden')
		{
			if(e[i].type=='select-one')
				e[i].selectedIndex=0;
			else if(e[i].type=='select-multiple')
			{
				var j;
				for(j=0;j<e[i].options.length;j++)
					e[i].options[j].selected=false;
			}
			else if(e[i].type=='checkbox' || e[i].type=='radio')
				e[i].checked=false;
			else 
				e[i].value = ''; 
		}
		else if(e[i].name.substr(0,6)=='value_' && e[i].type=='hidden')
			e[i].value = ''; 
	}
	ShowHideControls();	
	return false;
}";

$jscode.="
	document.forms.editform.value_ElementTypeID.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_ElementTypeID,'advanced')};
	document.forms.editform.value1_ElementTypeID.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_ElementTypeID,'advanced1')};
	document.forms.editform.value_ElementTypeID.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_ElementTypeID,'advanced')};
	document.forms.editform.value1_ElementTypeID.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_ElementTypeID,'advanced1')};
	document.forms.editform.value_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description,'advanced1')};
	document.forms.editform.value_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description,'advanced1')};
	document.forms.editform.value_UnitName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_UnitName,'advanced')};
	document.forms.editform.value1_UnitName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_UnitName,'advanced1')};
	document.forms.editform.value_UnitName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_UnitName,'advanced')};
	document.forms.editform.value1_UnitName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_UnitName,'advanced1')};
	document.forms.editform.value_UnitSymbol.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_UnitSymbol,'advanced')};
	document.forms.editform.value1_UnitSymbol.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_UnitSymbol,'advanced1')};
	document.forms.editform.value_UnitSymbol.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_UnitSymbol,'advanced')};
	document.forms.editform.value1_UnitSymbol.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_UnitSymbol,'advanced1')};
	document.forms.editform.value_UnitDecimal.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_UnitDecimal,'advanced')};
	document.forms.editform.value1_UnitDecimal.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_UnitDecimal,'advanced1')};
	document.forms.editform.value_UnitDecimal.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_UnitDecimal,'advanced')};
	document.forms.editform.value1_UnitDecimal.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_UnitDecimal,'advanced1')};
	document.forms.editform.value_ETValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_ETValue,'advanced')};
	document.forms.editform.value1_ETValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_ETValue,'advanced1')};
	document.forms.editform.value_ETValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_ETValue,'advanced')};
	document.forms.editform.value1_ETValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_ETValue,'advanced1')};
";
$includes.="<div id=\"search_suggest\"></div>";

$all_checkbox="value=\"and\"";
$any_checkbox="value=\"or\"";

if(@$where[$strTableName."_asearchtype"]=="or")
	$any_checkbox.=" checked";
else
	$all_checkbox.=" checked";
$xt->assign("any_checkbox",$any_checkbox);
$xt->assign("all_checkbox",$all_checkbox);

$editformats=array();

	if(!is_array($where[$strTableName."_asearchopt"]))
		$where[$strTableName."_asearchopt"]=array();
	if(!is_array($where[$strTableName."_asearchnot"]))
		$where[$strTableName."_asearchnot"]=array();
	if(!is_array($where[$strTableName."_asearchfor"]))
		$where[$strTableName."_asearchfor"]=array();
	if(!is_array($where[$strTableName."_asearchfor2"]))
		$where[$strTableName."_asearchfor2"]=array();


// ElementTypeID 
$opt="";
$not=false;
$control_ElementTypeID=array();
$control_ElementTypeID["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["ElementTypeID"];
	$not=@$where[$strTableName."_asearchnot"]["ElementTypeID"];
	$control_ElementTypeID["params"]["value"]=@$where[$strTableName."_asearchfor"]["ElementTypeID"];
}
$control_ElementTypeID["func"]="xt_buildeditcontrol";
$control_ElementTypeID["params"]["field"]="ElementTypeID";
$control_ElementTypeID["params"]["mode"]="search";
$xt->assignbyref("ElementTypeID_editcontrol",$control_ElementTypeID);
$control1_ElementTypeID=$control_ElementTypeID;
$control1_ElementTypeID["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_ElementTypeID["params"]["value"]=@$where[$strTableName."_asearchfor2"]["ElementTypeID"];
$xt->assignbyref("ElementTypeID_editcontrol1",$control1_ElementTypeID);
	
$xt->assign_section("ElementTypeID_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"ElementTypeID\">","");
$notbox_ElementTypeID="name=\"not_ElementTypeID\"";
if($not)
	$notbox_ElementTypeID=" checked";
$xt->assign("ElementTypeID_notbox",$notbox_ElementTypeID);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_ElementTypeID\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_ElementTypeID",$searchtype);
//	edit format
$editformats["ElementTypeID"]="Text field";
// Description 
$opt="";
$not=false;
$control_Description=array();
$control_Description["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Description"];
	$not=@$where[$strTableName."_asearchnot"]["Description"];
	$control_Description["params"]["value"]=@$where[$strTableName."_asearchfor"]["Description"];
}
$control_Description["func"]="xt_buildeditcontrol";
$control_Description["params"]["field"]="Description";
$control_Description["params"]["mode"]="search";
$xt->assignbyref("Description_editcontrol",$control_Description);
$control1_Description=$control_Description;
$control1_Description["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Description["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Description"];
$xt->assignbyref("Description_editcontrol1",$control1_Description);
	
$xt->assign_section("Description_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Description\">","");
$notbox_Description="name=\"not_Description\"";
if($not)
	$notbox_Description=" checked";
$xt->assign("Description_notbox",$notbox_Description);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Description\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Description",$searchtype);
//	edit format
$editformats["Description"]="Text field";
// UnitName 
$opt="";
$not=false;
$control_UnitName=array();
$control_UnitName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["UnitName"];
	$not=@$where[$strTableName."_asearchnot"]["UnitName"];
	$control_UnitName["params"]["value"]=@$where[$strTableName."_asearchfor"]["UnitName"];
}
$control_UnitName["func"]="xt_buildeditcontrol";
$control_UnitName["params"]["field"]="UnitName";
$control_UnitName["params"]["mode"]="search";
$xt->assignbyref("UnitName_editcontrol",$control_UnitName);
$control1_UnitName=$control_UnitName;
$control1_UnitName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_UnitName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["UnitName"];
$xt->assignbyref("UnitName_editcontrol1",$control1_UnitName);
	
$xt->assign_section("UnitName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"UnitName\">","");
$notbox_UnitName="name=\"not_UnitName\"";
if($not)
	$notbox_UnitName=" checked";
$xt->assign("UnitName_notbox",$notbox_UnitName);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_UnitName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_UnitName",$searchtype);
//	edit format
$editformats["UnitName"]="Text field";
// UnitSymbol 
$opt="";
$not=false;
$control_UnitSymbol=array();
$control_UnitSymbol["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["UnitSymbol"];
	$not=@$where[$strTableName."_asearchnot"]["UnitSymbol"];
	$control_UnitSymbol["params"]["value"]=@$where[$strTableName."_asearchfor"]["UnitSymbol"];
}
$control_UnitSymbol["func"]="xt_buildeditcontrol";
$control_UnitSymbol["params"]["field"]="UnitSymbol";
$control_UnitSymbol["params"]["mode"]="search";
$xt->assignbyref("UnitSymbol_editcontrol",$control_UnitSymbol);
$control1_UnitSymbol=$control_UnitSymbol;
$control1_UnitSymbol["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_UnitSymbol["params"]["value"]=@$where[$strTableName."_asearchfor2"]["UnitSymbol"];
$xt->assignbyref("UnitSymbol_editcontrol1",$control1_UnitSymbol);
	
$xt->assign_section("UnitSymbol_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"UnitSymbol\">","");
$notbox_UnitSymbol="name=\"not_UnitSymbol\"";
if($not)
	$notbox_UnitSymbol=" checked";
$xt->assign("UnitSymbol_notbox",$notbox_UnitSymbol);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_UnitSymbol\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_UnitSymbol",$searchtype);
//	edit format
$editformats["UnitSymbol"]="Text field";
// UnitDecimal 
$opt="";
$not=false;
$control_UnitDecimal=array();
$control_UnitDecimal["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["UnitDecimal"];
	$not=@$where[$strTableName."_asearchnot"]["UnitDecimal"];
	$control_UnitDecimal["params"]["value"]=@$where[$strTableName."_asearchfor"]["UnitDecimal"];
}
$control_UnitDecimal["func"]="xt_buildeditcontrol";
$control_UnitDecimal["params"]["field"]="UnitDecimal";
$control_UnitDecimal["params"]["mode"]="search";
$xt->assignbyref("UnitDecimal_editcontrol",$control_UnitDecimal);
$control1_UnitDecimal=$control_UnitDecimal;
$control1_UnitDecimal["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_UnitDecimal["params"]["value"]=@$where[$strTableName."_asearchfor2"]["UnitDecimal"];
$xt->assignbyref("UnitDecimal_editcontrol1",$control1_UnitDecimal);
	
$xt->assign_section("UnitDecimal_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"UnitDecimal\">","");
$notbox_UnitDecimal="name=\"not_UnitDecimal\"";
if($not)
	$notbox_UnitDecimal=" checked";
$xt->assign("UnitDecimal_notbox",$notbox_UnitDecimal);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_UnitDecimal\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_UnitDecimal",$searchtype);
//	edit format
$editformats["UnitDecimal"]="Text field";
// ETValue 
$opt="";
$not=false;
$control_ETValue=array();
$control_ETValue["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["ETValue"];
	$not=@$where[$strTableName."_asearchnot"]["ETValue"];
	$control_ETValue["params"]["value"]=@$where[$strTableName."_asearchfor"]["ETValue"];
}
$control_ETValue["func"]="xt_buildeditcontrol";
$control_ETValue["params"]["field"]="ETValue";
$control_ETValue["params"]["mode"]="search";
$xt->assignbyref("ETValue_editcontrol",$control_ETValue);
$control1_ETValue=$control_ETValue;
$control1_ETValue["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_ETValue["params"]["value"]=@$where[$strTableName."_asearchfor2"]["ETValue"];
$xt->assignbyref("ETValue_editcontrol1",$control1_ETValue);
	
$xt->assign_section("ETValue_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"ETValue\">","");
$notbox_ETValue="name=\"not_ETValue\"";
if($not)
	$notbox_ETValue=" checked";
$xt->assign("ETValue_notbox",$notbox_ETValue);

//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_ETValue\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_ETValue",$searchtype);
//	edit format
$editformats["ETValue"]="Text field";

if ($useAJAX) {
}
else
{
}

$body=array();
$body["begin"]=$includes;
$jscode.="ShowHideControls();";
PrepareJSCode($jscode,'');
$body["end"]="<script>".$jscode."</script>";	
$xt->assignbyref("body",$body);

$contents_block=array();
$contents_block["begin"]="<form method=\"POST\" ";
if(isset( $_GET["rname"]))
{
	$contents_block["begin"].="action=\"dreport.php?rname=".htmlspecialchars(rawurlencode(postvalue("rname")))."\" ";
}	
else if(isset( $_GET["cname"]))
{
	$contents_block["begin"].="action=\"dchart.php?cname=".htmlspecialchars(rawurlencode(postvalue("cname")))."\" ";
}	
else
{
$contents_block["begin"].="action=\"vw_fullingredientproxanalysis_list.php\" ";
}
$contents_block["begin"].="name=\"editform\"><input type=\"hidden\" id=\"a\" name=\"a\" value=\"advsearch\">";
$contents_block["end"]="</form>";
$xt->assignbyref("contents_block",$contents_block);

$xt->assign("searchbutton_attrs","name=\"SearchButton\" onclick=\"javascript:document.forms.editform.submit();\"");
$xt->assign("resetbutton_attrs","onclick=\"return ResetControls();\"");

$xt->assign("backbutton_attrs","onclick=\"javascript: document.forms.editform.a.value='return'; document.forms.editform.submit();\"");

$xt->assign("conditions_block",true);
$xt->assign("search_button",true);
$xt->assign("reset_button",true);
$xt->assign("back_button",true);

	
$templatefile = "vw_fullingredientproxanalysis_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>