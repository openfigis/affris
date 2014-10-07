<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_feedanalysis_variables.php");

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
"SUGGEST_TABLE = \"vw_feedanalysis_searchsuggest.php\";\r\n".
"detect = navigator.userAgent.toLowerCase();
window.checkIt = function(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}
window.ShowHideControls = function ()
{
	document.getElementById('second_FName').style.display =  
		document.forms.editform.elements['asearchopt_FName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_BrandName').style.display =  
		document.forms.editform.elements['asearchopt_BrandName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Technology').style.display =  
		document.forms.editform.elements['asearchopt_Technology'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FeedYear').style.display =  
		document.forms.editform.elements['asearchopt_FeedYear'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Stage').style.display =  
		document.forms.editform.elements['asearchopt_Stage'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_CountryOrigin').style.display =  
		document.forms.editform.elements['asearchopt_CountryOrigin'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FisDetail').style.display =  
		document.forms.editform.elements['asearchopt_FisDetail'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FDataSource').style.display =  
		document.forms.editform.elements['asearchopt_FDataSource'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FeedType').style.display =  
		document.forms.editform.elements['asearchopt_FeedType'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FeedAnalysisType').style.display =  
		document.forms.editform.elements['asearchopt_FeedAnalysisType'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FAValue').style.display =  
		document.forms.editform.elements['asearchopt_FAValue'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_isShownDetail').style.display =  
		document.forms.editform.elements['asearchopt_isShownDetail'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_FName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FName,'advanced')};
	document.forms.editform.value1_FName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FName,'advanced1')};
	document.forms.editform.value_FName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FName,'advanced')};
	document.forms.editform.value1_FName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FName,'advanced1')};
	document.forms.editform.value_BrandName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_BrandName,'advanced')};
	document.forms.editform.value1_BrandName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_BrandName,'advanced1')};
	document.forms.editform.value_BrandName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_BrandName,'advanced')};
	document.forms.editform.value1_BrandName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_BrandName,'advanced1')};
	document.forms.editform.value_Technology.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Technology,'advanced')};
	document.forms.editform.value1_Technology.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Technology,'advanced1')};
	document.forms.editform.value_Technology.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Technology,'advanced')};
	document.forms.editform.value1_Technology.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Technology,'advanced1')};
	document.forms.editform.value_FeedYear.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FeedYear,'advanced')};
	document.forms.editform.value1_FeedYear.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FeedYear,'advanced1')};
	document.forms.editform.value_FeedYear.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FeedYear,'advanced')};
	document.forms.editform.value1_FeedYear.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FeedYear,'advanced1')};
	document.forms.editform.value_Stage.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Stage,'advanced')};
	document.forms.editform.value1_Stage.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Stage,'advanced1')};
	document.forms.editform.value_Stage.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Stage,'advanced')};
	document.forms.editform.value1_Stage.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Stage,'advanced1')};
	document.forms.editform.value_CountryOrigin.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_CountryOrigin,'advanced')};
	document.forms.editform.value1_CountryOrigin.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_CountryOrigin,'advanced1')};
	document.forms.editform.value_CountryOrigin.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_CountryOrigin,'advanced')};
	document.forms.editform.value1_CountryOrigin.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_CountryOrigin,'advanced1')};
	document.forms.editform.value_FisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FisDetail,'advanced')};
	document.forms.editform.value1_FisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FisDetail,'advanced1')};
	document.forms.editform.value_FisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FisDetail,'advanced')};
	document.forms.editform.value1_FisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FisDetail,'advanced1')};
	document.forms.editform.value_FDataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FDataSource,'advanced')};
	document.forms.editform.value1_FDataSource.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FDataSource,'advanced1')};
	document.forms.editform.value_FDataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FDataSource,'advanced')};
	document.forms.editform.value1_FDataSource.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FDataSource,'advanced1')};
	document.forms.editform.value_FeedType.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FeedType,'advanced')};
	document.forms.editform.value1_FeedType.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FeedType,'advanced1')};
	document.forms.editform.value_FeedType.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FeedType,'advanced')};
	document.forms.editform.value1_FeedType.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FeedType,'advanced1')};
	document.forms.editform.value_FeedAnalysisType.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FeedAnalysisType,'advanced')};
	document.forms.editform.value1_FeedAnalysisType.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FeedAnalysisType,'advanced1')};
	document.forms.editform.value_FeedAnalysisType.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FeedAnalysisType,'advanced')};
	document.forms.editform.value1_FeedAnalysisType.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FeedAnalysisType,'advanced1')};
	document.forms.editform.value_FAValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FAValue,'advanced')};
	document.forms.editform.value1_FAValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FAValue,'advanced1')};
	document.forms.editform.value_FAValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FAValue,'advanced')};
	document.forms.editform.value1_FAValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FAValue,'advanced1')};
	document.forms.editform.value_isShownDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_isShownDetail,'advanced')};
	document.forms.editform.value1_isShownDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_isShownDetail,'advanced1')};
	document.forms.editform.value_isShownDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_isShownDetail,'advanced')};
	document.forms.editform.value1_isShownDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_isShownDetail,'advanced1')};
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


// FName 
$opt="";
$not=false;
$control_FName=array();
$control_FName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FName"];
	$not=@$where[$strTableName."_asearchnot"]["FName"];
	$control_FName["params"]["value"]=@$where[$strTableName."_asearchfor"]["FName"];
}
$control_FName["func"]="xt_buildeditcontrol";
$control_FName["params"]["field"]="FName";
$control_FName["params"]["mode"]="search";
$xt->assignbyref("FName_editcontrol",$control_FName);
$control1_FName=$control_FName;
$control1_FName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FName"];
$xt->assignbyref("FName_editcontrol1",$control1_FName);
	
$xt->assign_section("FName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FName\">","");
$notbox_FName="name=\"not_FName\"";
if($not)
	$notbox_FName=" checked";
$xt->assign("FName_notbox",$notbox_FName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FName",$searchtype);
//	edit format
$editformats["FName"]="Text field";
// BrandName 
$opt="";
$not=false;
$control_BrandName=array();
$control_BrandName["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["BrandName"];
	$not=@$where[$strTableName."_asearchnot"]["BrandName"];
	$control_BrandName["params"]["value"]=@$where[$strTableName."_asearchfor"]["BrandName"];
}
$control_BrandName["func"]="xt_buildeditcontrol";
$control_BrandName["params"]["field"]="BrandName";
$control_BrandName["params"]["mode"]="search";
$xt->assignbyref("BrandName_editcontrol",$control_BrandName);
$control1_BrandName=$control_BrandName;
$control1_BrandName["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_BrandName["params"]["value"]=@$where[$strTableName."_asearchfor2"]["BrandName"];
$xt->assignbyref("BrandName_editcontrol1",$control1_BrandName);
	
$xt->assign_section("BrandName_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"BrandName\">","");
$notbox_BrandName="name=\"not_BrandName\"";
if($not)
	$notbox_BrandName=" checked";
$xt->assign("BrandName_notbox",$notbox_BrandName);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_BrandName\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_BrandName",$searchtype);
//	edit format
$editformats["BrandName"]="Text field";
// Technology 
$opt="";
$not=false;
$control_Technology=array();
$control_Technology["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Technology"];
	$not=@$where[$strTableName."_asearchnot"]["Technology"];
	$control_Technology["params"]["value"]=@$where[$strTableName."_asearchfor"]["Technology"];
}
$control_Technology["func"]="xt_buildeditcontrol";
$control_Technology["params"]["field"]="Technology";
$control_Technology["params"]["mode"]="search";
$xt->assignbyref("Technology_editcontrol",$control_Technology);
$control1_Technology=$control_Technology;
$control1_Technology["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Technology["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Technology"];
$xt->assignbyref("Technology_editcontrol1",$control1_Technology);
	
$xt->assign_section("Technology_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Technology\">","");
$notbox_Technology="name=\"not_Technology\"";
if($not)
	$notbox_Technology=" checked";
$xt->assign("Technology_notbox",$notbox_Technology);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Technology\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Technology",$searchtype);
//	edit format
$editformats["Technology"]="Text field";
// FeedYear 
$opt="";
$not=false;
$control_FeedYear=array();
$control_FeedYear["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FeedYear"];
	$not=@$where[$strTableName."_asearchnot"]["FeedYear"];
	$control_FeedYear["params"]["value"]=@$where[$strTableName."_asearchfor"]["FeedYear"];
}
$control_FeedYear["func"]="xt_buildeditcontrol";
$control_FeedYear["params"]["field"]="FeedYear";
$control_FeedYear["params"]["mode"]="search";
$xt->assignbyref("FeedYear_editcontrol",$control_FeedYear);
$control1_FeedYear=$control_FeedYear;
$control1_FeedYear["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FeedYear["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FeedYear"];
$xt->assignbyref("FeedYear_editcontrol1",$control1_FeedYear);
	
$xt->assign_section("FeedYear_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FeedYear\">","");
$notbox_FeedYear="name=\"not_FeedYear\"";
if($not)
	$notbox_FeedYear=" checked";
$xt->assign("FeedYear_notbox",$notbox_FeedYear);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FeedYear\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FeedYear",$searchtype);
//	edit format
$editformats["FeedYear"]="Text field";
// Stage 
$opt="";
$not=false;
$control_Stage=array();
$control_Stage["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["Stage"];
	$not=@$where[$strTableName."_asearchnot"]["Stage"];
	$control_Stage["params"]["value"]=@$where[$strTableName."_asearchfor"]["Stage"];
}
$control_Stage["func"]="xt_buildeditcontrol";
$control_Stage["params"]["field"]="Stage";
$control_Stage["params"]["mode"]="search";
$xt->assignbyref("Stage_editcontrol",$control_Stage);
$control1_Stage=$control_Stage;
$control1_Stage["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_Stage["params"]["value"]=@$where[$strTableName."_asearchfor2"]["Stage"];
$xt->assignbyref("Stage_editcontrol1",$control1_Stage);
	
$xt->assign_section("Stage_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"Stage\">","");
$notbox_Stage="name=\"not_Stage\"";
if($not)
	$notbox_Stage=" checked";
$xt->assign("Stage_notbox",$notbox_Stage);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Stage\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_Stage",$searchtype);
//	edit format
$editformats["Stage"]="Text field";
// CountryOrigin 
$opt="";
$not=false;
$control_CountryOrigin=array();
$control_CountryOrigin["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["CountryOrigin"];
	$not=@$where[$strTableName."_asearchnot"]["CountryOrigin"];
	$control_CountryOrigin["params"]["value"]=@$where[$strTableName."_asearchfor"]["CountryOrigin"];
}
$control_CountryOrigin["func"]="xt_buildeditcontrol";
$control_CountryOrigin["params"]["field"]="CountryOrigin";
$control_CountryOrigin["params"]["mode"]="search";
$xt->assignbyref("CountryOrigin_editcontrol",$control_CountryOrigin);
$control1_CountryOrigin=$control_CountryOrigin;
$control1_CountryOrigin["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_CountryOrigin["params"]["value"]=@$where[$strTableName."_asearchfor2"]["CountryOrigin"];
$xt->assignbyref("CountryOrigin_editcontrol1",$control1_CountryOrigin);
	
$xt->assign_section("CountryOrigin_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"CountryOrigin\">","");
$notbox_CountryOrigin="name=\"not_CountryOrigin\"";
if($not)
	$notbox_CountryOrigin=" checked";
$xt->assign("CountryOrigin_notbox",$notbox_CountryOrigin);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_CountryOrigin\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_CountryOrigin",$searchtype);
//	edit format
$editformats["CountryOrigin"]="Text field";
// FisDetail 
$opt="";
$not=false;
$control_FisDetail=array();
$control_FisDetail["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FisDetail"];
	$not=@$where[$strTableName."_asearchnot"]["FisDetail"];
	$control_FisDetail["params"]["value"]=@$where[$strTableName."_asearchfor"]["FisDetail"];
}
$control_FisDetail["func"]="xt_buildeditcontrol";
$control_FisDetail["params"]["field"]="FisDetail";
$control_FisDetail["params"]["mode"]="search";
$xt->assignbyref("FisDetail_editcontrol",$control_FisDetail);
$control1_FisDetail=$control_FisDetail;
$control1_FisDetail["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FisDetail["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FisDetail"];
$xt->assignbyref("FisDetail_editcontrol1",$control1_FisDetail);
	
$xt->assign_section("FisDetail_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FisDetail\">","");
$notbox_FisDetail="name=\"not_FisDetail\"";
if($not)
	$notbox_FisDetail=" checked";
$xt->assign("FisDetail_notbox",$notbox_FisDetail);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FisDetail\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FisDetail",$searchtype);
//	edit format
$editformats["FisDetail"]="Text field";
// FDataSource 
$opt="";
$not=false;
$control_FDataSource=array();
$control_FDataSource["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FDataSource"];
	$not=@$where[$strTableName."_asearchnot"]["FDataSource"];
	$control_FDataSource["params"]["value"]=@$where[$strTableName."_asearchfor"]["FDataSource"];
}
$control_FDataSource["func"]="xt_buildeditcontrol";
$control_FDataSource["params"]["field"]="FDataSource";
$control_FDataSource["params"]["mode"]="search";
$xt->assignbyref("FDataSource_editcontrol",$control_FDataSource);
$control1_FDataSource=$control_FDataSource;
$control1_FDataSource["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FDataSource["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FDataSource"];
$xt->assignbyref("FDataSource_editcontrol1",$control1_FDataSource);
	
$xt->assign_section("FDataSource_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FDataSource\">","");
$notbox_FDataSource="name=\"not_FDataSource\"";
if($not)
	$notbox_FDataSource=" checked";
$xt->assign("FDataSource_notbox",$notbox_FDataSource);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FDataSource\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FDataSource",$searchtype);
//	edit format
$editformats["FDataSource"]="Text field";
// FeedType 
$opt="";
$not=false;
$control_FeedType=array();
$control_FeedType["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FeedType"];
	$not=@$where[$strTableName."_asearchnot"]["FeedType"];
	$control_FeedType["params"]["value"]=@$where[$strTableName."_asearchfor"]["FeedType"];
}
$control_FeedType["func"]="xt_buildeditcontrol";
$control_FeedType["params"]["field"]="FeedType";
$control_FeedType["params"]["mode"]="search";
$xt->assignbyref("FeedType_editcontrol",$control_FeedType);
$control1_FeedType=$control_FeedType;
$control1_FeedType["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FeedType["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FeedType"];
$xt->assignbyref("FeedType_editcontrol1",$control1_FeedType);
	
$xt->assign_section("FeedType_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FeedType\">","");
$notbox_FeedType="name=\"not_FeedType\"";
if($not)
	$notbox_FeedType=" checked";
$xt->assign("FeedType_notbox",$notbox_FeedType);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FeedType\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FeedType",$searchtype);
//	edit format
$editformats["FeedType"]="Text field";
// FeedAnalysisType 
$opt="";
$not=false;
$control_FeedAnalysisType=array();
$control_FeedAnalysisType["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FeedAnalysisType"];
	$not=@$where[$strTableName."_asearchnot"]["FeedAnalysisType"];
	$control_FeedAnalysisType["params"]["value"]=@$where[$strTableName."_asearchfor"]["FeedAnalysisType"];
}
$control_FeedAnalysisType["func"]="xt_buildeditcontrol";
$control_FeedAnalysisType["params"]["field"]="FeedAnalysisType";
$control_FeedAnalysisType["params"]["mode"]="search";
$xt->assignbyref("FeedAnalysisType_editcontrol",$control_FeedAnalysisType);
$control1_FeedAnalysisType=$control_FeedAnalysisType;
$control1_FeedAnalysisType["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FeedAnalysisType["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FeedAnalysisType"];
$xt->assignbyref("FeedAnalysisType_editcontrol1",$control1_FeedAnalysisType);
	
$xt->assign_section("FeedAnalysisType_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FeedAnalysisType\">","");
$notbox_FeedAnalysisType="name=\"not_FeedAnalysisType\"";
if($not)
	$notbox_FeedAnalysisType=" checked";
$xt->assign("FeedAnalysisType_notbox",$notbox_FeedAnalysisType);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FeedAnalysisType\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FeedAnalysisType",$searchtype);
//	edit format
$editformats["FeedAnalysisType"]="Text field";
// FAValue 
$opt="";
$not=false;
$control_FAValue=array();
$control_FAValue["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FAValue"];
	$not=@$where[$strTableName."_asearchnot"]["FAValue"];
	$control_FAValue["params"]["value"]=@$where[$strTableName."_asearchfor"]["FAValue"];
}
$control_FAValue["func"]="xt_buildeditcontrol";
$control_FAValue["params"]["field"]="FAValue";
$control_FAValue["params"]["mode"]="search";
$xt->assignbyref("FAValue_editcontrol",$control_FAValue);
$control1_FAValue=$control_FAValue;
$control1_FAValue["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FAValue["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FAValue"];
$xt->assignbyref("FAValue_editcontrol1",$control1_FAValue);
	
$xt->assign_section("FAValue_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FAValue\">","");
$notbox_FAValue="name=\"not_FAValue\"";
if($not)
	$notbox_FAValue=" checked";
$xt->assign("FAValue_notbox",$notbox_FAValue);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FAValue\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FAValue",$searchtype);
//	edit format
$editformats["FAValue"]="Text field";
// isShownDetail 
$opt="";
$not=false;
$control_isShownDetail=array();
$control_isShownDetail["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["isShownDetail"];
	$not=@$where[$strTableName."_asearchnot"]["isShownDetail"];
	$control_isShownDetail["params"]["value"]=@$where[$strTableName."_asearchfor"]["isShownDetail"];
}
$control_isShownDetail["func"]="xt_buildeditcontrol";
$control_isShownDetail["params"]["field"]="isShownDetail";
$control_isShownDetail["params"]["mode"]="search";
$xt->assignbyref("isShownDetail_editcontrol",$control_isShownDetail);
$control1_isShownDetail=$control_isShownDetail;
$control1_isShownDetail["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_isShownDetail["params"]["value"]=@$where[$strTableName."_asearchfor2"]["isShownDetail"];
$xt->assignbyref("isShownDetail_editcontrol1",$control1_isShownDetail);
	
$xt->assign_section("isShownDetail_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"isShownDetail\">","");
$notbox_isShownDetail="name=\"not_isShownDetail\"";
if($not)
	$notbox_isShownDetail=" checked";
$xt->assign("isShownDetail_notbox",$notbox_isShownDetail);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_isShownDetail\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_isShownDetail",$searchtype);
//	edit format
$editformats["isShownDetail"]="Text field";

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
$contents_block["begin"].="action=\"vw_feedanalysis_list.php\" ";
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

	
$templatefile = "vw_feedanalysis_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>