<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
session_cache_limiter("none");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_fullfeedelementanalysis_variables.php");

if(!@$_SESSION["UserID"])
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."You don't have permissions to access this table"."<a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}


//	Before Process event
if(function_exists("BeforeProcessExport"))
	BeforeProcessExport($conn);

$strWhereClause="";

$options = "1";
if (@$_REQUEST["a"]!="")
{
	$options = "";
	$sWhere = "1=0";	

//	process selection
	$selected_recs=array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=split("&",refine($keyblock));
			if(count($arr)<0)
				continue;
			$keys=array();
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL=gSQLWhere($strWhereClause);
}


$mypage=1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if(function_exists("BeforeQueryExport"))
		BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy);
//	Rebuild SQL if needed
	if($strSQL!=$strSQLbak)
	{
//	changed $strSQL - old style	
		$numrows=GetRowCount($strSQL);
	}
	else
	{
		$strSQL = gSQLWhere($strWhereClause);
		$strSQL.=" ".trim($strOrderBy);
		$numrows=gSQLRowCount($strWhereClause,0);
	}
	LogInfo($strSQL);

//	 Pagination:

	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;

		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}

	$rs=db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(@$_REQUEST["type"]=="excel")
	{
		ExportToExcel();
	}
	else if(@$_REQUEST["type"]=="word")
	{
		ExportToWord();
	}
	else if(@$_REQUEST["type"]=="xml")
	{
		ExportToXML();
	}
	else if(@$_REQUEST["type"]=="csv")
	{
		ExportToCSV();
	}
	else if(@$_REQUEST["type"]=="pdf")
	{
		ExportToPDF();
	}

	db_close($conn);
	return;
}

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include('include/xtempl.php');
$xt = new Xtempl();
if($options)
{
	$xt->assign("rangeheader_block",true);
	$xt->assign("range_block",true);
}
$body=array();
$body["begin"]="<form action=\"vw_fullfeedelementanalysis_export.php\" method=get id=frmexport name=frmexport>";
$body["end"]="</form>";
$xt->assignbyref("body",$body);
$xt->display("vw_fullfeedelementanalysis_export.htm");


function ExportToExcel()
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=vw_fullfeedelementanalysis.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord()
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=vw_fullfeedelementanalysis.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML()
{
	global $nPageSize,$rs,$strTableName,$conn;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=vw_fullfeedelementanalysis.xml");
	if(!($row=db_fetch_array($rs)))
		return;
	global $cCharset;
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		echo "<row>\r\n";
		$field=htmlspecialchars(XMLNameEncode("FeedID"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"FeedID",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("ElementID"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"ElementID",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("EName"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"EName",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("CommonName"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"CommonName",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("TagName"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"TagName",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("UnitID"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"UnitID",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("UnitName"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"UnitName",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("UnitSymbol"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"UnitSymbol",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("UnitDecimal"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"UnitDecimal",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("iValue"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"iValue",""));
		echo "</".$field.">\r\n";
		echo "</row>\r\n";
		$i++;
		$row=db_fetch_array($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV()
{
	global $rs,$nPageSize,$strTableName,$conn;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=vw_fullfeedelementanalysis.csv");

	if(!($row=db_fetch_array($rs)))
		return;

	$totals=array();

	
// write header
	$outstr="";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"FeedID\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"ElementID\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"EName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"CommonName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"TagName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"UnitID\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"UnitName\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"UnitSymbol\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"UnitDecimal\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"iValue\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		$outstr="";
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"FeedID",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"ElementID",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"EName",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"CommonName",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"TagName",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"UnitID",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"UnitName",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"UnitSymbol",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"UnitDecimal",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Number";
		$outstr.='"'.htmlspecialchars(GetData($row,"iValue",$format)).'"';
		echo $outstr;
		echo "\r\n";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

//	display totals
	$first=true;

}


function WriteTableData()
{
	global $rs,$nPageSize,$strTableName,$conn;
	if(!($row=db_fetch_array($rs)))
		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Feed ID").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Element ID").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("EName").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Common Name").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Tag Name").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Unit ID").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Unit Name").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Unit Symbol").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("Unit Decimal").'</td>';	
	echo '<td style="width: 100" x:str>'.PrepareForExcel("I Value").'</td>';	
	}
	else
	{
		echo "<td>"."Feed ID"."</td>";
		echo "<td>"."Element ID"."</td>";
		echo "<td>"."EName"."</td>";
		echo "<td>"."Common Name"."</td>";
		echo "<td>"."Tag Name"."</td>";
		echo "<td>"."Unit ID"."</td>";
		echo "<td>"."Unit Name"."</td>";
		echo "<td>"."Unit Symbol"."</td>";
		echo "<td>"."Unit Decimal"."</td>";
		echo "<td>"."I Value"."</td>";
	}
	echo "</tr>";

	$totals=array();
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		echo "<tr>";
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"FeedID",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"ElementID",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"EName",$format));
		else
			echo htmlspecialchars(GetData($row,"EName",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"CommonName",$format));
		else
			echo htmlspecialchars(GetData($row,"CommonName",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"TagName",$format));
		else
			echo htmlspecialchars(GetData($row,"TagName",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"UnitID",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"UnitName",$format));
		else
			echo htmlspecialchars(GetData($row,"UnitName",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"UnitSymbol",$format));
		else
			echo htmlspecialchars(GetData($row,"UnitSymbol",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"UnitDecimal",$format));
	echo '</td>';
	echo '<td>';

		$format="Number";
			echo htmlspecialchars(GetData($row,"iValue",$format));
	echo '</td>';
		echo "</tr>";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

}

function XMLNameEncode($strValue)
{	
	$search=array(" ","#","'","/","\\","(",")",",","[");
	$ret=str_replace($search,"",$strValue);
	$search=array("]","+","\"","-","_","|","}","{","=");
	$ret=str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($str)
{
	$ret = htmlspecialchars($str);
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}





?>