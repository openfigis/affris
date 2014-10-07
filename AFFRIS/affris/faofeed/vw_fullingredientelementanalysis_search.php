<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_fullingredientelementanalysis_variables.php");

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
"SUGGEST_TABLE = \"vw_fullingredientelementanalysis_searchsuggest.php\";\r\n".
"detect = navigator.userAgent.toLowerCase();
window.checkIt = function(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}
window.ShowHideControls = function ()
{
	document.getElementById('second_EName').style.display =  
		document.forms.editform.elements['asearchopt_EName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_CommonName').style.display =  
		document.forms.editform.elements['asearchopt_CommonName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_TagName').style.display =  
		document.forms.editform.elements['asearchopt_TagName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Description').style.display =  
		document.forms.editform.elements['asearchopt_Description'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_EName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_EName,'advanced')};
	document.forms.editform.value1_EName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_EName,'advanced1')};
	document.forms.editform.value_EName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_EName,'advanced')};
	document.forms.editform.value1_EName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_EName,'advanced1')};
	document.forms.editform.value_CommonName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_CommonName,'advanced')};
	document.forms.editform.value1_CommonName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_CommonName,'advanced1')};
	document.forms.editform.value_CommonName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_CommonName,'advanced')};
	document.forms.editform.value1_CommonName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_CommonName,'advanced1')};
	document.forms.editform.value_TagName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_TagName,'advanced')};
	document.forms.editform.value1_TagName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_TagName,'advanced1')};
	document.forms.editform.value_TagName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_TagName,'advanced')};
	document.forms.editform.value1_TagName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_TagName,'advanced1')};
	document.forms.editform.value_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Description,'advanced1')};
	document.forms.editform.value_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Description,'advanced')};
	document.forms.editform.value1_Description.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Description,'advanced1')};
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


// EName 
$opt="";
$not=false;
$control_EName=array();
$control_EName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["EName"];
	$not=@$where[$strTableName."_asearchnot"]["EName"];
	$control_EName["params"]["value"]=@$where[$strTableName."_asearchfor"]["EName"];
}
$control_EName["func"]="xt_buildeditcontrol";
$control_EName["params"]["field"]="EName";
$control_EName["params"]["mode"]="search";
$xt->assignbyref("EName_editcontrol",$control_EName);
$control1_EName=$control_EName;
$control1_EName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_EName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["EName"];
$xt->assignbyref("EName_editcontrol1",$control1_EName);
	
$xt->assign_section("EName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"EName\">","");
$notbox_EName="name=\"not_EName\"";
if($not)
	$notbox_EName=" checked";
$xt->assign("EName_notbox",$notbox_EName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_EName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_EName",$searchtype);
//	edit format
$editformats["EName"]="Text field";
// CommonName 
$opt="";
$not=false;
$control_CommonName=array();
$control_CommonName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["CommonName"];
	$not=@$where[$strTableName."_asearchnot"]["CommonName"];
	$control_CommonName["params"]["value"]=@$where[$strTableName."_asearchfor"]["CommonName"];
}
$control_CommonName["func"]="xt_buildeditcontrol";
$control_CommonName["params"]["field"]="CommonName";
$control_CommonName["params"]["mode"]="search";
$xt->assignbyref("CommonName_editcontrol",$control_CommonName);
$control1_CommonName=$control_CommonName;
$control1_CommonName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_CommonName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["CommonName"];
$xt->assignbyref("CommonName_editcontrol1",$control1_CommonName);
	
$xt->assign_section("CommonName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"CommonName\">","");
$notbox_CommonName="name=\"not_CommonName\"";
if($not)
	$notbox_CommonName=" checked";
$xt->assign("CommonName_notbox",$notbox_CommonName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_CommonName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_CommonName",$searchtype);
//	edit format
$editformats["CommonName"]="Text field";
// TagName 
$opt="";
$not=false;
$control_TagName=array();
$control_TagName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["TagName"];
	$not=@$where[$strTableName."_asearchnot"]["TagName"];
	$control_TagName["params"]["value"]=@$where[$strTableName."_asearchfor"]["TagName"];
}
$control_TagName["func"]="xt_buildeditcontrol";
$control_TagName["params"]["field"]="TagName";
$control_TagName["params"]["mode"]="search";
$xt->assignbyref("TagName_editcontrol",$control_TagName);
$control1_TagName=$control_TagName;
$control1_TagName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_TagName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["TagName"];
$xt->assignbyref("TagName_editcontrol1",$control1_TagName);
	
$xt->assign_section("TagName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"TagName\">","");
$notbox_TagName="name=\"not_TagName\"";
if($not)
	$notbox_TagName=" checked";
$xt->assign("TagName_notbox",$notbox_TagName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_TagName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_TagName",$searchtype);
//	edit format
$editformats["TagName"]="Text field";
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
$contents_block["begin"].="action=\"vw_fullingredientelementanalysis_list.php\" ";
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

	
$templatefile = "vw_fullingredientelementanalysis_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>