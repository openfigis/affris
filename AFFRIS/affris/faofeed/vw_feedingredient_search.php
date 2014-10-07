<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_feedingredient_variables.php");

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
"SUGGEST_TABLE = \"vw_feedingredient_searchsuggest.php\";\r\n".
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
	document.getElementById('second_FisDetail').style.display =  
		document.forms.editform.elements['asearchopt_FisDetail'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_IName').style.display =  
		document.forms.editform.elements['asearchopt_IName'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_IisDetail').style.display =  
		document.forms.editform.elements['asearchopt_IisDetail'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_FValue').style.display =  
		document.forms.editform.elements['asearchopt_FValue'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_FisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FisDetail,'advanced')};
	document.forms.editform.value1_FisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FisDetail,'advanced1')};
	document.forms.editform.value_FisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FisDetail,'advanced')};
	document.forms.editform.value1_FisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FisDetail,'advanced1')};
	document.forms.editform.value_IName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_IName,'advanced')};
	document.forms.editform.value1_IName.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_IName,'advanced1')};
	document.forms.editform.value_IName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_IName,'advanced')};
	document.forms.editform.value1_IName.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_IName,'advanced1')};
	document.forms.editform.value_IisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_IisDetail,'advanced')};
	document.forms.editform.value1_IisDetail.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_IisDetail,'advanced1')};
	document.forms.editform.value_IisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_IisDetail,'advanced')};
	document.forms.editform.value1_IisDetail.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_IisDetail,'advanced1')};
	document.forms.editform.value_FValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_FValue,'advanced')};
	document.forms.editform.value1_FValue.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_FValue,'advanced1')};
	document.forms.editform.value_FValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_FValue,'advanced')};
	document.forms.editform.value1_FValue.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_FValue,'advanced1')};
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
// IisDetail 
$opt="";
$not=false;
$control_IisDetail=array();
$control_IisDetail["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["IisDetail"];
	$not=@$where[$strTableName."_asearchnot"]["IisDetail"];
	$control_IisDetail["params"]["value"]=@$where[$strTableName."_asearchfor"]["IisDetail"];
}
$control_IisDetail["func"]="xt_buildeditcontrol";
$control_IisDetail["params"]["field"]="IisDetail";
$control_IisDetail["params"]["mode"]="search";
$xt->assignbyref("IisDetail_editcontrol",$control_IisDetail);
$control1_IisDetail=$control_IisDetail;
$control1_IisDetail["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_IisDetail["params"]["value"]=@$where[$strTableName."_asearchfor2"]["IisDetail"];
$xt->assignbyref("IisDetail_editcontrol1",$control1_IisDetail);
	
$xt->assign_section("IisDetail_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"IisDetail\">","");
$notbox_IisDetail="name=\"not_IisDetail\"";
if($not)
	$notbox_IisDetail=" checked";
$xt->assign("IisDetail_notbox",$notbox_IisDetail);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_IisDetail\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_IisDetail",$searchtype);
//	edit format
$editformats["IisDetail"]="Text field";
// FValue 
$opt="";
$not=false;
$control_FValue=array();
$control_FValue["params"] = array();
if(@$where[$strTableName."_search"]==2)
{
	$opt=@$where[$strTableName."_asearchopt"]["FValue"];
	$not=@$where[$strTableName."_asearchnot"]["FValue"];
	$control_FValue["params"]["value"]=@$where[$strTableName."_asearchfor"]["FValue"];
}
$control_FValue["func"]="xt_buildeditcontrol";
$control_FValue["params"]["field"]="FValue";
$control_FValue["params"]["mode"]="search";
$xt->assignbyref("FValue_editcontrol",$control_FValue);
$control1_FValue=$control_FValue;
$control1_FValue["params"]["second"]=true;
if(@$where[$strTableName."_search"]==2)
	$control1_FValue["params"]["value"]=@$where[$strTableName."_asearchfor2"]["FValue"];
$xt->assignbyref("FValue_editcontrol1",$control1_FValue);
	
$xt->assign_section("FValue_fieldblock","<input type=\"Hidden\" name=\"asearchfield[]\" value=\"FValue\">","");
$notbox_FValue="name=\"not_FValue\"";
if($not)
	$notbox_FValue=" checked";
$xt->assign("FValue_notbox",$notbox_FValue);

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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_FValue\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$xt->assign("searchtype_FValue",$searchtype);
//	edit format
$editformats["FValue"]="Text field";

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
$contents_block["begin"].="action=\"vw_feedingredient_list.php\" ";
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

	
$templatefile = "vw_feedingredient_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($xt,$templatefile);

$xt->display($templatefile);

?>