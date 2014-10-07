<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_antinutritional_variables.php");

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
"SUGGEST_TABLE = \"vw_antinutritional_searchsuggest.php\";\r\n".
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
	document.getElementById('second_Description').style.display =  
		document.forms.editform.elements['asearchopt_Description'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_AntiFactor').style.display =  
		document.forms.editform.elements['asearchopt_AntiFactor'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_ToxicLevel').style.display =  
		document.forms.editform.elements['asearchopt_ToxicLevel'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Treatment').style.display =  
		document.forms.editform.elements['asearchopt_Treatment'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_DataSource').style.display =  
		document.forms.editform.elements['asearchopt_DataSource'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_PartUsed').style.display =  
		document.forms.editform.elements['asearchopt_PartUsed'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description,'advanced1')};
	document.forms.editform.value_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description,'advanced1')};
	document.forms.editform.value_AntiFactor.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_AntiFactor,'advanced')};
	document.forms.editform.value1_AntiFactor.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_AntiFactor,'advanced1')};
	document.forms.editform.value_AntiFactor.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_AntiFactor,'advanced')};
	document.forms.editform.value1_AntiFactor.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_AntiFactor,'advanced1')};
	document.forms.editform.value_ToxicLevel.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_ToxicLevel,'advanced')};
	document.forms.editform.value1_ToxicLevel.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_ToxicLevel,'advanced1')};
	document.forms.editform.value_ToxicLevel.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_ToxicLevel,'advanced')};
	document.forms.editform.value1_ToxicLevel.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_ToxicLevel,'advanced1')};
	document.forms.editform.value_Treatment.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Treatment,'advanced')};
	document.forms.editform.value1_Treatment.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Treatment,'advanced1')};
	document.forms.editform.value_Treatment.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Treatment,'advanced')};
	document.forms.editform.value1_Treatment.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Treatment,'advanced1')};
	document.forms.editform.value_DataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_DataSource,'advanced')};
	document.forms.editform.value1_DataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_DataSource,'advanced1')};
	document.forms.editform.value_DataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_DataSource,'advanced')};
	document.forms.editform.value1_DataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_DataSource,'advanced1')};
	document.forms.editform.value_PartUsed.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_PartUsed,'advanced')};
	document.forms.editform.value1_PartUsed.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_PartUsed,'advanced1')};
	document.forms.editform.value_PartUsed.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_PartUsed,'advanced')};
	document.forms.editform.value1_PartUsed.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_PartUsed,'advanced1')};
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
// AntiFactor 
$opt="";
$not=false;
$control_AntiFactor=array();
$control_AntiFactor["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["AntiFactor"];
	$not=@$where[$strTableName."_asearchnot"]["AntiFactor"];
	$control_AntiFactor["params"]["value"]=@$where[$strTableName."_asearchfor"]["AntiFactor"];
}
$control_AntiFactor["func"]="xt_buildeditcontrol";
$control_AntiFactor["params"]["field"]="AntiFactor";
$control_AntiFactor["params"]["mode"]="search";
$xt->assignbyref("AntiFactor_editcontrol",$control_AntiFactor);
$control1_AntiFactor=$control_AntiFactor;
$control1_AntiFactor["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_AntiFactor["params"]["value"]=@$where[$strTableName."_asearchfor2"]["AntiFactor"];
$xt->assignbyref("AntiFactor_editcontrol1",$control1_AntiFactor);
	
$xt->assign_section("AntiFactor_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"AntiFactor\">","");
$notbox_AntiFactor="name=\"not_AntiFactor\"";
if($not)
	$notbox_AntiFactor=" checked";
$xt->assign("AntiFactor_notbox",$notbox_AntiFactor);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_AntiFactor\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_AntiFactor",$searchtype);
//	edit format
$editformats["AntiFactor"]="Text field";
// ToxicLevel 
$opt="";
$not=false;
$control_ToxicLevel=array();
$control_ToxicLevel["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["ToxicLevel"];
	$not=@$where[$strTableName."_asearchnot"]["ToxicLevel"];
	$control_ToxicLevel["params"]["value"]=@$where[$strTableName."_asearchfor"]["ToxicLevel"];
}
$control_ToxicLevel["func"]="xt_buildeditcontrol";
$control_ToxicLevel["params"]["field"]="ToxicLevel";
$control_ToxicLevel["params"]["mode"]="search";
$xt->assignbyref("ToxicLevel_editcontrol",$control_ToxicLevel);
$control1_ToxicLevel=$control_ToxicLevel;
$control1_ToxicLevel["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_ToxicLevel["params"]["value"]=@$where[$strTableName."_asearchfor2"]["ToxicLevel"];
$xt->assignbyref("ToxicLevel_editcontrol1",$control1_ToxicLevel);
	
$xt->assign_section("ToxicLevel_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"ToxicLevel\">","");
$notbox_ToxicLevel="name=\"not_ToxicLevel\"";
if($not)
	$notbox_ToxicLevel=" checked";
$xt->assign("ToxicLevel_notbox",$notbox_ToxicLevel);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_ToxicLevel\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_ToxicLevel",$searchtype);
//	edit format
$editformats["ToxicLevel"]="Text field";
// Treatment 
$opt="";
$not=false;
$control_Treatment=array();
$control_Treatment["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Treatment"];
	$not=@$where[$strTableName."_asearchnot"]["Treatment"];
	$control_Treatment["params"]["value"]=@$where[$strTableName."_asearchfor"]["Treatment"];
}
$control_Treatment["func"]="xt_buildeditcontrol";
$control_Treatment["params"]["field"]="Treatment";
$control_Treatment["params"]["mode"]="search";
$xt->assignbyref("Treatment_editcontrol",$control_Treatment);
$control1_Treatment=$control_Treatment;
$control1_Treatment["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Treatment["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Treatment"];
$xt->assignbyref("Treatment_editcontrol1",$control1_Treatment);
	
$xt->assign_section("Treatment_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Treatment\">","");
$notbox_Treatment="name=\"not_Treatment\"";
if($not)
	$notbox_Treatment=" checked";
$xt->assign("Treatment_notbox",$notbox_Treatment);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Treatment\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Treatment",$searchtype);
//	edit format
$editformats["Treatment"]="Text field";
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
// PartUsed 
$opt="";
$not=false;
$control_PartUsed=array();
$control_PartUsed["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["PartUsed"];
	$not=@$where[$strTableName."_asearchnot"]["PartUsed"];
	$control_PartUsed["params"]["value"]=@$where[$strTableName."_asearchfor"]["PartUsed"];
}
$control_PartUsed["func"]="xt_buildeditcontrol";
$control_PartUsed["params"]["field"]="PartUsed";
$control_PartUsed["params"]["mode"]="search";
$xt->assignbyref("PartUsed_editcontrol",$control_PartUsed);
$control1_PartUsed=$control_PartUsed;
$control1_PartUsed["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_PartUsed["params"]["value"]=@$where[$strTableName."_asearchfor2"]["PartUsed"];
$xt->assignbyref("PartUsed_editcontrol1",$control1_PartUsed);
	
$xt->assign_section("PartUsed_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"PartUsed\">","");
$notbox_PartUsed="name=\"not_PartUsed\"";
if($not)
	$notbox_PartUsed=" checked";
$xt->assign("PartUsed_notbox",$notbox_PartUsed);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_PartUsed\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_PartUsed",$searchtype);
//	edit format
$editformats["PartUsed"]="Text field";

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
$contents_block["begin"].="action=\"vw_antinutritional_list.php\" ";
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

	
$templatefile = "vw_antinutritional_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>