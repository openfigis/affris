<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/vw_feedspec_variables.php");




//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

include('include/xtempl.php');
$xt = new Xtempl();

$filename="";	
$message="";
$key=array();
$next=array();
$prev=array();
$all=postvalue("all");
$pdf=postvalue("pdf");
$mypage=1;

$id=1;


//	Before Process event
if(function_exists("BeforeProcessView"))
	BeforeProcessView($conn);

$strWhereClause="";
if(!$all)
{
	$keys=array();
	$keys["FeedID"]=postvalue("editid1");

//	get current values and show edit controls

	$strWhereClause = KeyWhere($keys);


	$strSQL=gSQLWhere($strWhereClause);
}
else
{
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
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
		$numrows=gSQLRowCount($strWhereClause,0);
}

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryView"))
	BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);

if(!$all)
{
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
}
else
{
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
}

$data=db_fetch_array($rs);

$out="";
$first=true;

$templatefile="";

while($data)
{



	$xt->assign("show_key1", htmlspecialchars(GetData($data,"FeedID", "")));

$keylink="";
$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["FeedID"]));

////////////////////////////////////////////
//	Feed - 
	$value="";
		$value=DisplayLookupWizard("Feed",$data["Feed"],$data,$keylink,MODE_VIEW);
			
	$xt->assign("Feed_value",$value);
	$xt->assign("Feed_fieldblock",true);
////////////////////////////////////////////
//	Brand - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Brand", ""),"","",MODE_VIEW);
	$xt->assign("Brand_value",$value);
	$xt->assign("Brand_fieldblock",true);
////////////////////////////////////////////
//	Technology - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Technology", ""),"","",MODE_VIEW);
	$xt->assign("Technology_value",$value);
	$xt->assign("Technology_fieldblock",true);
////////////////////////////////////////////
//	Feed Year - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Feed Year", ""),"","",MODE_VIEW);
	$xt->assign("Feed_Year_value",$value);
	$xt->assign("Feed_Year_fieldblock",true);
////////////////////////////////////////////
//	Stage - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Stage", ""),"","",MODE_VIEW);
	$xt->assign("Stage_value",$value);
	$xt->assign("Stage_fieldblock",true);
////////////////////////////////////////////
//	Country Origin - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Country Origin", ""),"","",MODE_VIEW);
	$xt->assign("Country_Origin_value",$value);
	$xt->assign("Country_Origin_fieldblock",true);
////////////////////////////////////////////
//	Details - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Details", ""),"","",MODE_VIEW);
	$xt->assign("Details_value",$value);
	$xt->assign("Details_fieldblock",true);
////////////////////////////////////////////
//	Data Source - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Data Source", ""),"","",MODE_VIEW);
	$xt->assign("Data_Source_value",$value);
	$xt->assign("Data_Source_fieldblock",true);
////////////////////////////////////////////
//	Species Name - 
	$value="";
		$value=DisplayLookupWizard("Species Name",$data["Species Name"],$data,$keylink,MODE_VIEW);
			
	$xt->assign("Species_Name_value",$value);
	$xt->assign("Species_Name_fieldblock",true);
////////////////////////////////////////////
//	Common Name - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Common Name", ""),"","",MODE_VIEW);
	$xt->assign("Common_Name_value",$value);
	$xt->assign("Common_Name_fieldblock",true);
////////////////////////////////////////////
//	Hybrid - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Hybrid", ""),"","",MODE_VIEW);
	$xt->assign("Hybrid_value",$value);
	$xt->assign("Hybrid_fieldblock",true);
////////////////////////////////////////////
//	Variety - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Variety", ""),"","",MODE_VIEW);
	$xt->assign("Variety_value",$value);
	$xt->assign("Variety_fieldblock",true);
////////////////////////////////////////////
//	Family - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Family", ""),"","",MODE_VIEW);
	$xt->assign("Family_value",$value);
	$xt->assign("Family_fieldblock",true);
////////////////////////////////////////////
//	Group - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Group", ""),"","",MODE_VIEW);
	$xt->assign("Group_value",$value);
	$xt->assign("Group_fieldblock",true);
////////////////////////////////////////////
//	Genus - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Genus", ""),"","",MODE_VIEW);
	$xt->assign("Genus_value",$value);
	$xt->assign("Genus_fieldblock",true);
////////////////////////////////////////////
//	Environment - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Environment", ""),"","",MODE_VIEW);
	$xt->assign("Environment_value",$value);
	$xt->assign("Environment_fieldblock",true);
////////////////////////////////////////////
//	Habit - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Habit", ""),"","",MODE_VIEW);
	$xt->assign("Habit_value",$value);
	$xt->assign("Habit_fieldblock",true);
////////////////////////////////////////////
//	Country - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Country", ""),"","",MODE_VIEW);
	$xt->assign("Country_value",$value);
	$xt->assign("Country_fieldblock",true);
////////////////////////////////////////////
//	Species Year - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Species Year", ""),"","",MODE_VIEW);
	$xt->assign("Species_Year_value",$value);
	$xt->assign("Species_Year_fieldblock",true);

$body=array();
$body["begin"]="";

$xt->assignbyref("body",$body);
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Next Prev button
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
if(!@$_SESSION[$strTableName."_noNextPrev"])
{
	$where_next=$where_prev="";
	$order_next=$order_prev="";
	$arrFieldForSort=array();
	$arrHowFieldSort=array();
	$where=$_SESSION[$strTableName."_where"];
		if(GetFieldIndex("FeedID"))
			$key[]=GetFieldIndex("FeedID");
//if session mass sorting empty, then create it as a sheet
	if(@$_SESSION[$strTableName."_arrFieldForSort"] && @$_SESSION[$strTableName."_arrHowFieldSort"])
	{
		$arrFieldForSort=$_SESSION[$strTableName."_arrFieldForSort"];
		$arrHowFieldSort=$_SESSION[$strTableName."_arrHowFieldSort"];
		$lenArr=count($arrFieldForSort);
	}
	else
	{
		if(count($g_orderindexes))
		{
			for($i=0;$i<count($g_orderindexes);$i++)
			{
				$arrFieldForSort[]=$g_orderindexes[$i][0];
				$arrHowFieldSort[]=$g_orderindexes[$i][1];
			}
		}
		elseif($gstrOrderBy!='')
			$_SESSION[$strTableName."_noNextPrev"] = 1;
		if(count($key))
		{
			for($i=0;$i<count($key);$i++)
			{
				$idsearch=array_search($key[$i],$arrFieldForSort);
				if($idsearch===false)
				{
					$arrFieldForSort[]=$key[$i];
					$arrHowFieldSort[]="ASC";
				}
			}
		}
		$_SESSION[$strTableName."_arrFieldForSort"]=$arrFieldForSort;
		$_SESSION[$strTableName."_arrHowFieldSort"]=$arrHowFieldSort;
		$lenArr=count($arrFieldForSort);
	}
//if session order by empty, then create a line order		
	if(@$_SESSION[$strTableName."_order"]) 
		$order_next=$_SESSION[$strTableName."_order"];
	elseif($lenArr>0)
	{
		for($i=0;$i<$lenArr;$i++)
			$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
	}
//create a line where and order for the two queries
	if($lenArr>0 and count($key) and !$_SESSION[$strTableName."_noNextPrev"])
	{
		if($where)
			$where .=" and ";
		$scob="";
		$flag=0;
		for($i=0;$i<$lenArr;$i++)
		{
			$fieldName=GetFieldByIndex($arrFieldForSort[$i]);
			if($fieldName)
			{
				$order_prev .=($order_prev!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i].($arrHowFieldSort[$i]=="ASC" ? " DESC" : " ASC");
				$dbg=GetFullFieldName($fieldName);
				if(!is_null($data[$fieldName]))
				{
					$mdv=make_db_value($fieldName,$data[$fieldName]);
					$ga=($arrHowFieldSort[$i]=="ASC" ? ">" : "<");
					$gd=($arrHowFieldSort[$i]=="ASC" ? "<" : ">");
					$gasc=$dbg.$ga.$mdv;
					$gdesc=$dbg.$gd.$mdv;
					$gravn=($i!=$lenArr-1 ? $dbg."=".$mdv : "");
					$ganull=($ga=="<" ? " or ".$dbg." IS NULL" : "");
					$gdnull=($gd=="<" ? " or ".$dbg." IS NULL" : "");
				}
				else{
						$gasc=($arrHowFieldSort[$i]=="ASC" ? $dbg." IS NOT NULL" : "");
						$gdesc=($arrHowFieldSort[$i]=="ASC" ? "" : $dbg." IS NOT NULL");
						$gravn=($i!=$lenArr-1 ? $dbg." IS NULL" : "");
						$ganull=$gdnull="";
					}
				$where_next .=($where_next!="" ? " and (" : " (").($gasc=="" && $gravn=="" ? " 1=0 " : ($gasc!="" ? $gasc.$ganull : "").($gasc!="" && $gravn!="" ? " or " : "").$gravn." ");
				$where_prev .=($where_prev!="" ? " and (" : " (").($gdesc=="" && $gravn=="" ? " 1=0 " : ($gdesc!="" ? $gdesc.$gdnull : "").($gdesc!="" && $gravn!="" ? " or " : "").$gravn." ");
				$scob .=")";
			}
			else $flag=1;
		}
		$where_next =$where_next.$scob;
		$where_prev =$where_prev.$scob;
		$where_next=whereAdd($where_next,SecuritySQL("Search"));
		$where_prev=whereAdd($where_prev,SecuritySQL("Search"));
		if($flag==1)
		{
			$order_next="";
			for($i=0;$i<$lenArr;$i++)
				$order_next .=(GetFieldByIndex($arrFieldForSort[$i]) ? ($order_next!="" ? ", " : " ORDER BY ").$arrFieldForSort[$i]." ".$arrHowFieldSort[$i] : "");
		}
/*		
		$select_list="";
		foreach($keys as $k=>$v)
		{
			if(strlen($select_list))
				$select_list.=",";
			$select_list.=GetFullFieldName($k);
		}
		$select_list = "SELECT ".$select_list." ";
*/
		$sql_next=gSQLWhere($where.$where_next).$order_next;
		$sql_prev=gSQLWhere($where.$where_prev).$order_prev;
//		$sql_next = gSQLWhere_int($select_list,$gsqlFrom,$gsqlWhereExpr,$gsqlTail,$where.$where_next).$order_next;
//		$sql_prev = gSQLWhere_int($select_list,$gsqlFrom,$gsqlWhereExpr,$gsqlTail,$where.$where_prev).$order_prev;
		if($where_next!="" and $order_next!="" and $where_prev!="" and $order_prev!="")
		{
					$sql_next.=" limit 1";
			$sql_prev.=" limit 1";
		
			$res_next=db_query($sql_next,$conn);		
			if($row_next=db_fetch_array($res_next))
			{
				$next[1]=$row_next["FeedID"];
			}
			
			$res_prev=db_query($sql_prev,$conn);	
			if($row_prev=db_fetch_array($res_prev))
			{
				$prev[1]=$row_prev["FeedID"];
			}
		}	
	}
}	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	  
if(!$pdf && !$all)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $nextlink=$prevlink="";
	if(count($next))
    {
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1]));
		$xt->assign("nextbutton_attrs","onclick=\"window.location.href='vw_feedspec_view.php?".$nextlink."'\"");
	}
	else 
		$xt->assign("next_button",false);	
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1]));
		$xt->assign("prevbutton_attrs","onclick=\"window.location.href='vw_feedspec_view.php?".$prevlink."'\"");
	}
    else 
		$xt->assign("prev_button",false);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","onclick=\"window.location.href='vw_feedspec_list.php?a=return'\"");
}

$oldtemplatefile=$templatefile;
$templatefile = "vw_feedspec_view.htm";
if(!$all)
{
	if(function_exists("BeforeShowView"))
		BeforeShowView($xt,$templatefile,$data);
	if(!$pdf)
		$xt->display($templatefile);
	break;
}

}


?>
