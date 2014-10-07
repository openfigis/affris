<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_ingredient_variables.php");

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
"SUGGEST_TABLE = \"vw_ingredient_searchsuggest.php\";\r\n".
"detect = navigator.userAgent.toLowerCase();
window.checkIt = function(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}
window.ShowHideControls = function ()
{
	document.getElementById('second_IName').style.display =  
		document.forms.editform.elements['asearchopt_IName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_IfeedNo').style.display =  
		document.forms.editform.elements['asearchopt_IfeedNo'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Description1').style.display =  
		document.forms.editform.elements['asearchopt_Description1'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Description2').style.display =  
		document.forms.editform.elements['asearchopt_Description2'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Description3').style.display =  
		document.forms.editform.elements['asearchopt_Description3'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_DataSource').style.display =  
		document.forms.editform.elements['asearchopt_DataSource'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_ICountry').style.display =  
		document.forms.editform.elements['asearchopt_ICountry'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Species').style.display =  
		document.forms.editform.elements['asearchopt_Species'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_IName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_IName,'advanced')};
	document.forms.editform.value1_IName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_IName,'advanced1')};
	document.forms.editform.value_IName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_IName,'advanced')};
	document.forms.editform.value1_IName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_IName,'advanced1')};
	document.forms.editform.value_IfeedNo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_IfeedNo,'advanced')};
	document.forms.editform.value1_IfeedNo.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_IfeedNo,'advanced1')};
	document.forms.editform.value_IfeedNo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_IfeedNo,'advanced')};
	document.forms.editform.value1_IfeedNo.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_IfeedNo,'advanced1')};
	document.forms.editform.value_Description1.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description1,'advanced')};
	document.forms.editform.value1_Description1.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description1,'advanced1')};
	document.forms.editform.value_Description1.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description1,'advanced')};
	document.forms.editform.value1_Description1.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description1,'advanced1')};
	document.forms.editform.value_Description2.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description2,'advanced')};
	document.forms.editform.value1_Description2.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description2,'advanced1')};
	document.forms.editform.value_Description2.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description2,'advanced')};
	document.forms.editform.value1_Description2.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description2,'advanced1')};
	document.forms.editform.value_Description3.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description3,'advanced')};
	document.forms.editform.value1_Description3.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description3,'advanced1')};
	document.forms.editform.value_Description3.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description3,'advanced')};
	document.forms.editform.value1_Description3.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description3,'advanced1')};
	document.forms.editform.value_DataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_DataSource,'advanced')};
	document.forms.editform.value1_DataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_DataSource,'advanced1')};
	document.forms.editform.value_DataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_DataSource,'advanced')};
	document.forms.editform.value1_DataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_DataSource,'advanced1')};
	document.forms.editform.value_ICountry.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_ICountry,'advanced')};
	document.forms.editform.value1_ICountry.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_ICountry,'advanced1')};
	document.forms.editform.value_ICountry.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_ICountry,'advanced')};
	document.forms.editform.value1_ICountry.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_ICountry,'advanced1')};
	document.forms.editform.value_Species.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Species,'advanced')};
	document.forms.editform.value1_Species.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Species,'advanced1')};
	document.forms.editform.value_Species.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Species,'advanced')};
	document.forms.editform.value1_Species.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Species,'advanced1')};
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


// IName 
$opt="";
$not=false;
$control_IName=array();
$control_IName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["IName"];
	$not=@$where[$strTableName."_asearchnot"]["IName"];
	$control_IName["params"]["value"]=@$where[$strTableName."_asearchfor"]["IName"];
}
$control_IName["func"]="xt_buildeditcontrol";
$control_IName["params"]["field"]="IName";
$control_IName["params"]["mode"]="search";
$xt->assignbyref("IName_editcontrol",$control_IName);
$control1_IName=$control_IName;
$control1_IName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_IName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["IName"];
$xt->assignbyref("IName_editcontrol1",$control1_IName);
	
$xt->assign_section("IName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"IName\">","");
$notbox_IName="name=\"not_IName\"";
if($not)
	$notbox_IName=" checked";
$xt->assign("IName_notbox",$notbox_IName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_IName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_IName",$searchtype);
//	edit format
$editformats["IName"]="Text field";
// IfeedNo 
$opt="";
$not=false;
$control_IfeedNo=array();
$control_IfeedNo["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["IfeedNo"];
	$not=@$where[$strTableName."_asearchnot"]["IfeedNo"];
	$control_IfeedNo["params"]["value"]=@$where[$strTableName."_asearchfor"]["IfeedNo"];
}
$control_IfeedNo["func"]="xt_buildeditcontrol";
$control_IfeedNo["params"]["field"]="IfeedNo";
$control_IfeedNo["params"]["mode"]="search";
$xt->assignbyref("IfeedNo_editcontrol",$control_IfeedNo);
$control1_IfeedNo=$control_IfeedNo;
$control1_IfeedNo["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_IfeedNo["params"]["value"]=@$where[$strTableName."_asearchfor2"]["IfeedNo"];
$xt->assignbyref("IfeedNo_editcontrol1",$control1_IfeedNo);
	
$xt->assign_section("IfeedNo_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"IfeedNo\">","");
$notbox_IfeedNo="name=\"not_IfeedNo\"";
if($not)
	$notbox_IfeedNo=" checked";
$xt->assign("IfeedNo_notbox",$notbox_IfeedNo);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_IfeedNo\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_IfeedNo",$searchtype);
//	edit format
$editformats["IfeedNo"]="Text field";
// Description1 
$opt="";
$not=false;
$control_Description1=array();
$control_Description1["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Description1"];
	$not=@$where[$strTableName."_asearchnot"]["Description1"];
	$control_Description1["params"]["value"]=@$where[$strTableName."_asearchfor"]["Description1"];
}
$control_Description1["func"]="xt_buildeditcontrol";
$control_Description1["params"]["field"]="Description1";
$control_Description1["params"]["mode"]="search";
$xt->assignbyref("Description1_editcontrol",$control_Description1);
$control1_Description1=$control_Description1;
$control1_Description1["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Description1["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Description1"];
$xt->assignbyref("Description1_editcontrol1",$control1_Description1);
	
$xt->assign_section("Description1_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Description1\">","");
$notbox_Description1="name=\"not_Description1\"";
if($not)
	$notbox_Description1=" checked";
$xt->assign("Description1_notbox",$notbox_Description1);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Description1\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Description1",$searchtype);
//	edit format
$editformats["Description1"]="Text field";
// Description2 
$opt="";
$not=false;
$control_Description2=array();
$control_Description2["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Description2"];
	$not=@$where[$strTableName."_asearchnot"]["Description2"];
	$control_Description2["params"]["value"]=@$where[$strTableName."_asearchfor"]["Description2"];
}
$control_Description2["func"]="xt_buildeditcontrol";
$control_Description2["params"]["field"]="Description2";
$control_Description2["params"]["mode"]="search";
$xt->assignbyref("Description2_editcontrol",$control_Description2);
$control1_Description2=$control_Description2;
$control1_Description2["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Description2["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Description2"];
$xt->assignbyref("Description2_editcontrol1",$control1_Description2);
	
$xt->assign_section("Description2_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Description2\">","");
$notbox_Description2="name=\"not_Description2\"";
if($not)
	$notbox_Description2=" checked";
$xt->assign("Description2_notbox",$notbox_Description2);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Description2\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Description2",$searchtype);
//	edit format
$editformats["Description2"]="Text field";
// Description3 
$opt="";
$not=false;
$control_Description3=array();
$control_Description3["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Description3"];
	$not=@$where[$strTableName."_asearchnot"]["Description3"];
	$control_Description3["params"]["value"]=@$where[$strTableName."_asearchfor"]["Description3"];
}
$control_Description3["func"]="xt_buildeditcontrol";
$control_Description3["params"]["field"]="Description3";
$control_Description3["params"]["mode"]="search";
$xt->assignbyref("Description3_editcontrol",$control_Description3);
$control1_Description3=$control_Description3;
$control1_Description3["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Description3["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Description3"];
$xt->assignbyref("Description3_editcontrol1",$control1_Description3);
	
$xt->assign_section("Description3_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Description3\">","");
$notbox_Description3="name=\"not_Description3\"";
if($not)
	$notbox_Description3=" checked";
$xt->assign("Description3_notbox",$notbox_Description3);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Description3\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Description3",$searchtype);
//	edit format
$editformats["Description3"]="Text field";
// DataSource 
$opt="";
$not=false;
$control_DataSource=array();
$control_DataSource["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["DataSource"];
	$not=@$where[$strTableName."_asearchnot"]["DataSource"];
	$control_DataSource["params"]["value"]=@$where[$strTableName."_asearchfor"]["DataSource"];
}
$control_DataSource["func"]="xt_buildeditcontrol";
$control_DataSource["params"]["field"]="DataSource";
$control_DataSource["params"]["mode"]="search";
$xt->assignbyref("DataSource_editcontrol",$control_DataSource);
$control1_DataSource=$control_DataSource;
$control1_DataSource["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_DataSource["params"]["value"]=@$where[$strTableName."_asearchfor2"]["DataSource"];
$xt->assignbyref("DataSource_editcontrol1",$control1_DataSource);
	
$xt->assign_section("DataSource_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"DataSource\">","");
$notbox_DataSource="name=\"not_DataSource\"";
if($not)
	$notbox_DataSource=" checked";
$xt->assign("DataSource_notbox",$notbox_DataSource);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_DataSource\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_DataSource",$searchtype);
//	edit format
$editformats["DataSource"]="Text field";
// ICountry 
$opt="";
$not=false;
$control_ICountry=array();
$control_ICountry["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["ICountry"];
	$not=@$where[$strTableName."_asearchnot"]["ICountry"];
	$control_ICountry["params"]["value"]=@$where[$strTableName."_asearchfor"]["ICountry"];
}
$control_ICountry["func"]="xt_buildeditcontrol";
$control_ICountry["params"]["field"]="ICountry";
$control_ICountry["params"]["mode"]="search";
$xt->assignbyref("ICountry_editcontrol",$control_ICountry);
$control1_ICountry=$control_ICountry;
$control1_ICountry["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_ICountry["params"]["value"]=@$where[$strTableName."_asearchfor2"]["ICountry"];
$xt->assignbyref("ICountry_editcontrol1",$control1_ICountry);
	
$xt->assign_section("ICountry_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"ICountry\">","");
$notbox_ICountry="name=\"not_ICountry\"";
if($not)
	$notbox_ICountry=" checked";
$xt->assign("ICountry_notbox",$notbox_ICountry);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_ICountry\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_ICountry",$searchtype);
//	edit format
$editformats["ICountry"]="Text field";
// Species 
$opt="";
$not=false;
$control_Species=array();
$control_Species["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Species"];
	$not=@$where[$strTableName."_asearchnot"]["Species"];
	$control_Species["params"]["value"]=@$where[$strTableName."_asearchfor"]["Species"];
}
$control_Species["func"]="xt_buildeditcontrol";
$control_Species["params"]["field"]="Species";
$control_Species["params"]["mode"]="search";
$xt->assignbyref("Species_editcontrol",$control_Species);
$control1_Species=$control_Species;
$control1_Species["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Species["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Species"];
$xt->assignbyref("Species_editcontrol1",$control1_Species);
	
$xt->assign_section("Species_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Species\">","");
$notbox_Species="name=\"not_Species\"";
if($not)
	$notbox_Species=" checked";
$xt->assign("Species_notbox",$notbox_Species);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Species\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Species",$searchtype);
//	edit format
$editformats["Species"]="Text field";

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
$contents_block["begin"].="action=\"vw_ingredient_list.php\" ";
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

	
$templatefile = "vw_ingredient_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>