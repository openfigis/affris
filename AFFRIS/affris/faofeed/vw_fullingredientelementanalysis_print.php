<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);
include("include/dbcommon.php");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT");
header("Pragma: no-cache");
header("Cache-Control: no-cache");

include("include/vw_fullingredientelementanalysis_variables.php");

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

$all=postvalue("all");

$pageName = "print.php";

include('include/xtempl.php');
$xt = new Xtempl();


//	Before Process event
if(function_exists("BeforeProcessPrint"))
	BeforeProcessPrint($conn);

$strWhereClause="";

if (@$_REQUEST["a"]!="") 
{
	
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
//	$strSQL = AddWhere($gstrSQL,$sWhere);
	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL = gSQLWhere($strWhereClause);
}
if(postvalue("pdf"))
	$strWhereClause = @$_SESSION[$strTableName."_pdfwhere"];

$_SESSION[$strTableName."_pdfwhere"] = $strWhereClause;


$strOrderBy=$_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryPrint"))
	BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy);

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

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize=$gPageSize;

$recno=1;
$records=0;	
$pageindex=1;

$maxpages=1;

if(!$all)
{	
	if($numrows)
	{
		$maxRecords = $numrows;
		$maxpages=ceil($maxRecords/$PageSize);
		if($mypage > $maxpages)
			$mypage = $maxpages;
		if($mypage<1) 
			$mypage=1;
		$maxrecs=$PageSize;
	}
	if($numrows)
	{
		$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
	}
	$rs=db_query($strSQL,$conn);
	
	
	//	hide colunm headers if needed
	$recordsonpage=$numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
		$recordsonpage=$PageSize;
		
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	$xt->assign("pageno",$mypage);
}
else
{
	$rs=db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	$maxpages=ceil($recordsonpage/30);
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	
}

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;


//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();
	$rowinfo["data"]=array();

	while($data=db_fetch_array($rs))
	{
		if(function_exists("BeforeProcessRowPrint"))
		{
			if(!BeforeProcessRowPrint($data))
				continue;
		}
		break;
	}
	while($data && ($all || $recno<=$PageSize))
	{
		$row=array();
		$row["grid_record"]=array();
		$row["grid_record"]["data"]=array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{
			$record=array();
			$recno++;
			$records++;
			$keylink="";


//	IngredientID - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IngredientID", ""),"field=IngredientID".$keylink,"",MODE_PRINT);
			$record["IngredientID_value"]=$value;

//	ElementID - 
			$value="";
				$value = ProcessLargeText(GetData($data,"ElementID", ""),"field=ElementID".$keylink,"",MODE_PRINT);
			$record["ElementID_value"]=$value;

//	EName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"EName", ""),"field=EName".$keylink,"",MODE_PRINT);
			$record["EName_value"]=$value;

//	CommonName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"CommonName", ""),"field=CommonName".$keylink,"",MODE_PRINT);
			$record["CommonName_value"]=$value;

//	TagName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"TagName", ""),"field=TagName".$keylink,"",MODE_PRINT);
			$record["TagName_value"]=$value;

//	ElementTypeID - 
			$value="";
				$value = ProcessLargeText(GetData($data,"ElementTypeID", ""),"field=ElementTypeID".$keylink,"",MODE_PRINT);
			$record["ElementTypeID_value"]=$value;

//	Description - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Description", ""),"field=Description".$keylink,"",MODE_PRINT);
			$record["Description_value"]=$value;

//	UnitID - 
			$value="";
				$value = ProcessLargeText(GetData($data,"UnitID", ""),"field=UnitID".$keylink,"",MODE_PRINT);
			$record["UnitID_value"]=$value;

//	UnitName - 
			$value="";
				$value = ProcessLargeText(GetData($data,"UnitName", ""),"field=UnitName".$keylink,"",MODE_PRINT);
			$record["UnitName_value"]=$value;

//	UnitSymbol - 
			$value="";
				$value = ProcessLargeText(GetData($data,"UnitSymbol", ""),"field=UnitSymbol".$keylink,"",MODE_PRINT);
			$record["UnitSymbol_value"]=$value;

//	UnitDecimal - 
			$value="";
				$value = ProcessLargeText(GetData($data,"UnitDecimal", ""),"field=UnitDecimal".$keylink,"",MODE_PRINT);
			$record["UnitDecimal_value"]=$value;

//	IValue - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"IValue", "Number"),"field=IValue".$keylink,"",MODE_PRINT);
			$record["IValue_value"]=$value;
			if($col<$colsonpage)
				$record["endrecord_block"]=true;
			$record["grid_recordheader"]=true;
			$record["grid_vrecord"]=true;
			$row["grid_record"]["data"][]=$record;
			
			if(function_exists("BeforeMoveNextPrint"))
				BeforeMoveNextPrint($data,$row,$record);
			while($data=db_fetch_array($rs))
			{
				if(function_exists("BeforeProcessRowPrint"))
				{
					if(!BeforeProcessRowPrint($data))
						continue;
				}
				break;
			}
		}
		if($col<=$colsonpage)
		{
			$row["grid_record"]["data"][count($row["grid_record"]["data"])-1]["endrecord_block"]=false;
		}
		$row["grid_rowspace"]=true;
		$row["grid_recordspace"] = array("data"=>array());
		for($i=0;$i<$colsonpage*2-1;$i++)
			$row["grid_recordspace"]["data"][]=true;
		
		$rowinfo["data"][]=$row;
		
		if($all && $records>=30)
		{
			$page=array("grid_row" =>$rowinfo);
			$page["pageno"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
		
	}
	if(count($rowinfo))
	{
		$page=array("grid_row" =>$rowinfo);
		if($all)
			$page["pageno"]=$pageindex;
		$pages[] = $page;
	}
	
	for($i=0;$i<count($pages);$i++)
	{
	 	if($i<count($pages)-1)
			$pages[$i]["begin"]="<div name=page class=printpage>";
		else
		    $pages[$i]["begin"]="<div name=page>";
			
		$pages[$i]["end"]="</div>";
	}

	$page=array("data"=>&$pages);
	$xt->assignbyref("page",$page);


	
//	display master table info
$mastertable=$_SESSION[$strTableName."_mastertable"];
$masterkeys=array();
if($mastertable=="vw_ingredient")
{
//	include proper masterprint.php code
	include("include/vw_ingredient_masterprint.php");
	$masterkeys[]=@$_SESSION[$strTableName."_masterkey1"];
	$params=array("detailtable"=>"vw_fullingredientelementanalysis","keys"=>$masterkeys);
	$master=array();
	$master["func"]="DisplayMasterTableInfo_vw_ingredient";
	$master["params"]=$params;
	$xt->assignbyref("showmasterfile",$master);
	$xt->assign("mastertable_block",true);
}

$strSQL=$_SESSION[$strTableName."_sql"];

	
$body=array();
$xt->assignbyref("body",$body);
$xt->assign("grid_block",true);

$xt->assign("IngredientID_fieldheadercolumn",true);
$xt->assign("IngredientID_fieldheader",true);
$xt->assign("IngredientID_fieldcolumn",true);
$xt->assign("IngredientID_fieldfootercolumn",true);
$xt->assign("ElementID_fieldheadercolumn",true);
$xt->assign("ElementID_fieldheader",true);
$xt->assign("ElementID_fieldcolumn",true);
$xt->assign("ElementID_fieldfootercolumn",true);
$xt->assign("EName_fieldheadercolumn",true);
$xt->assign("EName_fieldheader",true);
$xt->assign("EName_fieldcolumn",true);
$xt->assign("EName_fieldfootercolumn",true);
$xt->assign("CommonName_fieldheadercolumn",true);
$xt->assign("CommonName_fieldheader",true);
$xt->assign("CommonName_fieldcolumn",true);
$xt->assign("CommonName_fieldfootercolumn",true);
$xt->assign("TagName_fieldheadercolumn",true);
$xt->assign("TagName_fieldheader",true);
$xt->assign("TagName_fieldcolumn",true);
$xt->assign("TagName_fieldfootercolumn",true);
$xt->assign("ElementTypeID_fieldheadercolumn",true);
$xt->assign("ElementTypeID_fieldheader",true);
$xt->assign("ElementTypeID_fieldcolumn",true);
$xt->assign("ElementTypeID_fieldfootercolumn",true);
$xt->assign("Description_fieldheadercolumn",true);
$xt->assign("Description_fieldheader",true);
$xt->assign("Description_fieldcolumn",true);
$xt->assign("Description_fieldfootercolumn",true);
$xt->assign("UnitID_fieldheadercolumn",true);
$xt->assign("UnitID_fieldheader",true);
$xt->assign("UnitID_fieldcolumn",true);
$xt->assign("UnitID_fieldfootercolumn",true);
$xt->assign("UnitName_fieldheadercolumn",true);
$xt->assign("UnitName_fieldheader",true);
$xt->assign("UnitName_fieldcolumn",true);
$xt->assign("UnitName_fieldfootercolumn",true);
$xt->assign("UnitSymbol_fieldheadercolumn",true);
$xt->assign("UnitSymbol_fieldheader",true);
$xt->assign("UnitSymbol_fieldcolumn",true);
$xt->assign("UnitSymbol_fieldfootercolumn",true);
$xt->assign("UnitDecimal_fieldheadercolumn",true);
$xt->assign("UnitDecimal_fieldheader",true);
$xt->assign("UnitDecimal_fieldcolumn",true);
$xt->assign("UnitDecimal_fieldfootercolumn",true);
$xt->assign("IValue_fieldheadercolumn",true);
$xt->assign("IValue_fieldheader",true);
$xt->assign("IValue_fieldcolumn",true);
$xt->assign("IValue_fieldfootercolumn",true);

	$record_header=array("data"=>array());
	for($i=0;$i<$colsonpage;$i++)
	{
		$rheader=array();
		if($i<$colsonpage-1)
		{
			$rheader["endrecordheader_block"]=true;
		}
		$record_header["data"][]=$rheader;
	}
	$xt->assignbyref("record_header",$record_header);
	$xt->assign("grid_header",true);
	$xt->assign("grid_footer",true);


$templatefile = "vw_fullingredientelementanalysis_print.htm";
	
if(function_exists("BeforeShowPrint"))
	BeforeShowPrint($xt,$templatefile);

if(!postvalue("pdf"))
	$xt->display($templatefile);
else
{
	$xt->load_template($templatefile);
	$page = $xt->fetch_loaded();
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
	if(postvalue("all"))
	{
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
	}
}

