<?php 


////////////////////////////////////////////////////////////////////////////////
// table and field info functions
////////////////////////////////////////////////////////////////////////////////

function GetTableData($table,$key,$default)
{
	global $strTableName,$tables_data;
	if(!$table) 
		$table = $strTableName;
	if(!array_key_exists($table,$tables_data))
		return $default;
	if(!array_key_exists($key,$tables_data[$table]))
		return $default;
	return $tables_data[$table][$key];
}

function GetFieldData($table,$field,$key,$default)
{
	global $strTableName,$tables_data;
	if(!$table) 
		$table = $strTableName;
	if(!array_key_exists($table,$tables_data))
		return $default;
	if(!array_key_exists($field,$tables_data[$table]))
		return $default;
	if(!array_key_exists($key,$tables_data[$table][$field]))
		return $default;
	return $tables_data[$table][$field][$key];
}

function GetFieldByIndex($index, $table="")
{
	global $strTableName,$tables_data;
	if(!$table) 
		$table = $strTableName;
	if(!array_key_exists($table,$tables_data))
		return null;
	foreach($tables_data[$table] as $key=>$value)
	{
		if(!is_array($value) || !array_key_exists("Index",$value))
			continue;
		if($value["Index"]==$index and GetFieldIndex($key))
			return $key;
	}
	return null;
}

// return field label
function Label($field,$table="")
{
	return GetFieldData($table,$field,"Label",$field);
}

// return filename field if any
function GetFilenameField($field,$table="")
{
	return GetFieldData($table,$field,"Filename","");
}

//	return hyperlink prefix
function GetLinkPrefix($field,$table="")
{
	return GetFieldData($table,$field,"LinkPrefix","");
}

//	return database field type
//	using ADO DataTypeEnum constants
//	the full list available at:
//	http://msdn.microsoft.com/library/default.asp?url=/library/en-us/ado270/htm/mdcstdatatypeenum.asp
function GetFieldType($field,$table="")
{
	return GetFieldData($table,$field,"FieldType","");
}

function IsAutoincField($field,$table="")
{
	return GetFieldData($table,$field,"AutoInc",false);
}


//	return Edit format
function GetEditFormat($field,$table="")
{
	return GetFieldData($table,$field,"EditFormat","");
}

//	return View format
function ViewFormat($field,$table="")
{
	return GetFieldData($table,$field,"ViewFormat","");
}

//	show time in datepicker or not
function DateEditShowTime($field,$table="")
{
	return GetFieldData($table,$field,"ShowTime",false);
}

//	use FastType Lookup wizard or not
function FastType($field,$table="")
{
	return GetFieldData($table,$field,"FastType",false);
}

function LookupControlType($field,$table="")
{
	return GetFieldData($table,$field,"LCType",LCT_DROPDOWN);
}


//	is Lookup wizard dependent or not
function UseCategory($field,$table="")
{
	return GetFieldData($table,$field,"UseCategory",false);
}

//	is Lookup wizard with multiple selection
function Multiselect($field,$table="")
{
	return GetFieldData($table,$field,"Multiselect",false);
}

function ShowThumbnail($field,$table="")
{
	return GetFieldData($table,$field,"ShowThumbnail",false);
}

function GetImageWidth($field,$table="")
{
	return GetFieldData($table,$field,"ImageWidth",0);
}

function GetImageHeight($field,$table="")
{
	return GetFieldData($table,$field,"ImageHeight",0);
}

//	return Lookup Wizard Where expression
function GetLWWhere($field,$table="")
{
	global $strTableName;
	if(!$table) 
		$table = $strTableName;
	return "";
}

function GetLookupType($field,$table="")
{
	return GetFieldData($table,$field,"LookupType",0);
}

function GetLookupTable($field,$table="")
{
	return GetFieldData($table,$field,"LookupTable","");
}

function GetLWLinkField($field,$table="")
{
	return GetFieldData($table,$field,"LinkField","");
}

function GetLWLinkFieldType($field,$table="")
{
	return GetFieldData($table,$field,"LinkFieldType",0);
}

function GetLWDisplayField($field,$table="")
{
	return GetFieldData($table,$field,"DisplayField","");
}

function NeedEncode($field,$table="")
{
	return GetFieldData($table,$field,"NeedEncode",false);
}

function AppearOnListPage($field,$table="")
{
	return GetFieldData($table,$field,"ListPage",false);
}

function GetTablesList()
{
	$arr=array();
		$arr[]="vw_antinutritional";
		$arr[]="vw_digestibility";
		$arr[]="users";
		$arr[]="vw_species";
		$arr[]="vw_feedspec";
		$arr[]="vw_feedanalysis";
		$arr[]="vw_feedingredient";
		$arr[]="vw_ingredient";
		$arr[]="vw_feed";
		$arr[]="vw_fullingredientelementanalysis";
		$arr[]="vw_fullingredientproxanalysis";
		$arr[]="vw_fullfeedproxanalysis";
		$arr[]="vw_fullfeedelementanalysis";
	return $arr;
}

function GetTablesListReport()
{
	$arr=array();
		$arr[]="vw_antinutritional";
		$arr[]="vw_digestibility";
		$arr[]="users";
		$arr[]="vw_species";
		$arr[]="vw_feedspec";
		$arr[]="vw_feedanalysis";
		$arr[]="vw_feedingredient";
		$arr[]="vw_ingredient";
		$arr[]="vw_feed";
		$arr[]="vw_fullingredientelementanalysis";
		$arr[]="vw_fullingredientproxanalysis";
		$arr[]="vw_fullfeedproxanalysis";
		$arr[]="vw_fullfeedelementanalysis";
	return $arr;
}


function GetFieldsList($table="")
{
	global $strTableName,$tables_data;
	if(!$table)
		$table = $strTableName;
	if(!array_key_exists($table,$tables_data))
		return array();
	$t = array_keys($tables_data[$table]);
	$arr=array();
	foreach($t as $f)
		if(substr($f,0,1)!=".")
			$arr[]=$f;
	return $arr;
}

function GetNBFieldsList($table="")
{
	$t = GetFieldsList($table);
	$arr=array();
	foreach($t as $f)
		if(!IsBinaryType(GetFieldType($f,$table)))
			$arr[]=$f;
	return $arr;
}

//	Category Control field for dependent dropdowns
function CategoryControl($field,$table="")
{
	return GetFieldData($table,$field,"CategoryControl","");
}

//	create Thumbnail or not
function GetCreateThumbnail($field,$table="")
{
	return GetFieldData($table,$field,"CreateThumbnail",false);
}

//	return Thumbnail prefix
function GetThumbnailPrefix($field,$table="")
{
	return GetFieldData($table,$field,"ThumbnailPrefix","");
}

//	resize on upload
function ResizeOnUpload($field,$table="")
{
	return GetFieldData($table,$field,"ResizeImage",false);
}

//	get size to reduce image after upload
function GetNewImageSize($field,$table="")
{
	return GetFieldData($table,$field,"NewSize",0);
}

//	return field name
function GetFieldByGoodFieldName($field,$table="")
{
	global $strTableName,$tables_data;
	if(!$table)
		$table=$strTableName;
	if(!array_key_exists($table,$tables_data))
		return "";

	foreach($tables_data[$table] as $key=>$value)
	{
		if(count($value)>1)
		{
			if($value["GoodName"]==$field)
				return $key;
		}
	}
	return "";
}

//	return the full database field original name
function GetFullFieldName($field,$table="")
{
	$fname=AddTableWrappers(GetOriginalTableName($table)).".".AddFieldWrappers($field);
	return GetFieldData($table,$field,"FullName",$fname);
}

//     return height of text area
function GetNRows($field,$table="")
{
	return GetFieldData($table,$field,"nRows",$field);
}

//     return width of text area
function GetNCols($field,$table="")
{
	return GetFieldData($table,$field,"nCols",$field);
}

//	return original table name
function GetOriginalTableName($table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	return GetTableData($table,".OriginalTable",$table);
}

//	return list of key fields
function GetTableKeys($table="")
{
	return GetTableData($table,".Keys",array());
}


//	return number of chars to show before More... link
function GetNumberOfChars($table="")
{
	return GetTableData($table,".NumberOfChars",0);
}

//	return table short name
function GetTableURL($table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	if("vw_antinutritional"==$table) 
		return "vw_antinutritional";
	if("vw_digestibility"==$table) 
		return "vw_digestibility";
	if("users"==$table) 
		return "users";
	if("vw_species"==$table) 
		return "vw_species";
	if("vw_feedspec"==$table) 
		return "vw_feedspec";
	if("vw_feedanalysis"==$table) 
		return "vw_feedanalysis";
	if("vw_feedingredient"==$table) 
		return "vw_feedingredient";
	if("vw_ingredient"==$table) 
		return "vw_ingredient";
	if("vw_feed"==$table) 
		return "vw_feed";
	if("vw_fullingredientelementanalysis"==$table) 
		return "vw_fullingredientelementanalysis";
	if("vw_fullingredientproxanalysis"==$table) 
		return "vw_fullingredientproxanalysis";
	if("vw_fullfeedproxanalysis"==$table) 
		return "vw_fullfeedproxanalysis";
	if("vw_fullfeedelementanalysis"==$table) 
		return "vw_fullfeedelementanalysis";
}

//	return table Owner ID field
function GetTableOwnerID($table="")
{
	return GetTableData($table,".OwnerID",0);
}

//	is field marked as required
function IsRequired($field,$table="")
{
	return GetFieldData($table,$field,"IsRequired",false);
}

//	use Rich Text Editor or not
function UseRTE($field,$table="")
{
	return GetFieldData($table,$field,"UseRTE",false);
}

//	add timestamp to filename when uploading files or not
function UseTimestamp($field,$table="")
{
	return GetFieldData($table,$field,"UseTimestamp",false);
}

function GetUploadFolder($field, $table="")
{
	$path = GetFieldData($table,$field,"UploadFolder","");
	if(strlen($path) && substr($path,strlen($path)-1) != "/")
		$path.="/";
	return $path;
}

function GetFieldIndex($field, $table="")
{
	return GetFieldData($table,$field,"Index",0);
}

//	return Date field edit type
function DateEditType($field,$table="")
{
	return GetFieldData($table,$field,"DateEditType",0);
}

// returns text edit parameters
function GetEditParams($field, $table="")
{
	return GetFieldData($table,$field,"EditParams","");
}

// returns Chart type
function GetChartType($shorttable)
{
	return "";
}

////////////////////////////////////////////////////////////////////////////////
// data output functions
////////////////////////////////////////////////////////////////////////////////

//	format field value for output
function GetData($data, $field, $format)
{
	return GetDataInt($data[$field], $data, $field, $format);
}

function GetDataValue($value, $field, $format)
{
	return GetDataInt($value, null, $field, $format);
}

//	GetData Internal
function GetDataInt($value, $data, $field, $format)
{
	global $strTableName;
	$ret="";
// long binary data?
	if(IsBinaryType(GetFieldType($field)))
	{
		$ret="LONG BINARY DATA - CANNOT BE DISPLAYED";
	} else
		$ret = $value;
	if($ret===false)
		return "";
	
	if($format == FORMAT_DATE_SHORT) 
		$ret = format_shortdate(db2time($value));
	else if($format == FORMAT_DATE_LONG) 
		$ret = format_longdate(db2time($value));
	else if($format == FORMAT_DATE_TIME) 
		$ret = str_format_datetime(db2time($value));
	else if($format == FORMAT_TIME) 
	{
		if(IsDateFieldType(GetFieldType($field)))
			$ret = str_format_time(db2time($value));
		else
		{
			$numbers=parsenumbers($value);
			if(!count($numbers))
				return "";
			while(count($numbers)<3)
				$numbers[]=0;
			$ret = str_format_time(array(0,0,0,$numbers[0],$numbers[1],$numbers[2]));
		}
	}
	else if($format == FORMAT_NUMBER) 
		$ret = str_format_number($value);
	else if($format == FORMAT_CURRENCY) 
		$ret = str_format_currency($value);
	else if($format == FORMAT_CHECKBOX) 
	{
		$ret="<img src=\"images/check_";
		if($value && $value!=0)
			$ret.="yes";
		else
			$ret.="no";
		$ret.=".gif\" border=0>";
	}
	else if($format == FORMAT_PERCENT) 
	{
		if($value!="")
			$ret = ($value*100)."%";
	}
	else if($format == FORMAT_PHONE_NUMBER)
	{
		if(strlen($ret)==7)
			$ret=substr($ret,0,3)."-".substr($ret,3);
		else if(strlen($ret)==10)
			$ret="(".substr($ret,0,3).") ".substr($ret,3,3)."-".substr($ret,6);
	}
	else if($format == FORMAT_FILE_IMAGE)
	{
		if(!CheckImageExtension($ret))
			return "";
			
		$thumbnailed=false;
		$thumbprefix="";
		if($thumbnailed)
		{
		 	// show thumbnail
			$thumbname=$thumbprefix.$ret;
			if(substr(GetLinkPrefix($field),0,7)!="http://" && !myfile_exists(GetUploadFolder($field).$thumbname))
				$thumbname=$ret;
			$ret="<a target=_blank href=\"".htmlspecialchars(AddLinkPrefix($field,$ret))."\">";
			$ret.="<img";
			$ret.=" border=0";
			$ret.=" src=\"".htmlspecialchars(AddLinkPrefix($field,$thumbname))."\"></a>";
		}
		else
			$ret='<img src="'.AddLinkPrefix($field,$ret).'" border=0>';
	}
	else if($format == FORMAT_HYPERLINK)
	{
		if($data)
			$ret=GetHyperlink($ret,$field,$data);
	}
	else if($format==FORMAT_EMAILHYPERLINK)
	{
		$link=$ret;
		$title=$ret;
		if(substr($ret,0,7)=="mailto:")
			$title=substr($ret,8);
		else
			$link="mailto:".$link;
		$ret='<a href="'.$link.'">'.$title.'</a>';
	}
	else if($format==FORMAT_FILE)
	{
		$iquery="field=".rawurlencode($field);
		if($strTableName=="vw_antinutritional")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["IngredientID"]);
		}
		if($strTableName=="vw_digestibility")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["IngredientID"]);
		}
		if($strTableName=="users")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["ID"]);
		}
		if($strTableName=="vw_species")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["SpeciesID"]);
		}
		if($strTableName=="vw_feedspec")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		if($strTableName=="vw_feedanalysis")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		if($strTableName=="vw_feedingredient")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		if($strTableName=="vw_ingredient")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["IngredientID"]);
		}
		if($strTableName=="vw_feed")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		if($strTableName=="vw_fullingredientelementanalysis")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["IngredientID"]);
		}
		if($strTableName=="vw_fullingredientproxanalysis")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["IngredientID"]);
		}
		if($strTableName=="vw_fullfeedproxanalysis")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		if($strTableName=="vw_fullfeedelementanalysis")
		{
			if($data)
				$iquery.="&key1=".rawurlencode($data["FeedID"]);
		}
		return 	'<a href="'.GetTableURL($strTableName).'_download.php?'.$iquery.'".>'.htmlspecialchars($ret).'</a>';
	}
	else if(GetEditFormat($field)==EDIT_FORMAT_CHECKBOX && $format==FORMAT_NONE)
	{
		if($ret && $ret!=0)
			$ret="Yes";
		else
			$ret="No";
	}
	else if($format == FORMAT_CUSTOM)
	{
		if($data)
			$ret = CustomExpression($value,$data,$field,"");
	}
	return $ret;
}


function ProcessLargeText($strValue,$iquery="",$table="", $mode=MODE_LIST)
{
	global $strTableName;

	$cNumberOfChars = GetNumberOfChars($table);
	if(substr($strValue,0,8)=="<a href=")
		return $strValue;
	if(substr($strValue,0,23)=="<img src=\"images/check_")
		return $strValue;
	if($cNumberOfChars>0 && strlen($strValue)>$cNumberOfChars && (strlen($strValue)<200 || !strlen($iquery)) && $mode==MODE_LIST)
	{
		$ret = substr($strValue,0,$cNumberOfChars );
		$ret=htmlspecialchars($ret);
		$ret.=" <a href=\"#\" onClick=\"javascript: pwin = window.open('',null,'height=300,width=400,status=yes,resizable=yes,toolbar=no,menubar=no,location=no,left=150,top=200,scrollbars=yes'); ";
		$ind = 1;
		$ret.="pwin.document.write('" . htmlspecialchars(jsreplace(nl2br(substr($strValue,0, 801)))) ."');";
//		$ret.="pwin.document.write('" . db_addslashes(str_replace("\r\n","<br>",htmlspecialchars(substr($strValue,0, 801)))) ."');";
		$ret.="pwin.document.write('<br><hr size=1 noshade><a href=# onClick=\\'window.close();return false;\\'>"."Close window"."</a>');";
		$ret.="return false;\">"."More"." ...</a>";
	}
	else if($cNumberOfChars>0 && strlen($strValue)>$cNumberOfChars && $mode==MODE_LIST)
	{
		$table = GetTableURL($table);
		$ret = substr($strValue,0,$cNumberOfChars );
		$ret=htmlspecialchars($ret);
		$ret.=" <a href=#  onClick=\"javascript: pwin = window.open('',null,'height=300,width=400,status=yes,resizable=yes,toolbar=no,menubar=no,location=no,left=150,top=200,scrollbars=yes');";
		$ret.=" pwin.location='".$table."_fulltext.php?".$iquery."'; return false;\">"."More"." ...</a>";
	}
	else if($cNumberOfChars>0 && strlen($strValue)>$cNumberOfChars && $mode==MODE_PRINT)
	{
		$ret = substr($strValue,0,$cNumberOfChars );
		$ret=htmlspecialchars($ret);
		if(strlen($strValue)>$cNumberOfChars)
			$ret.=" ...";
	}
	else
		$ret= htmlspecialchars($strValue);

/*
//	highlight search results
	if ($mode==MODE_LIST && $_SESSION[$strTableName."_search"]==1)
	{
		$ind = 0;
		$searchopt=$_SESSION[$strTableName."_searchoption"];
		$searchfor=$_SESSION[$strTableName."_searchfor"];
//		highlight Contains search
		if($searchopt=="Contains")
		{
			while ( ($ind = my_stripos($ret, $searchfor, $ind)) !== false )
			{
				$ret = substr($ret, 0, $ind) . "<span class=highlight>". substr($ret, $ind, strlen($searchfor)) ."</span>" . substr($ret, $ind + strlen($searchfor));
				$ind+= strlen("<span class=highlight>") + strlen($searchfor) + strlen("</span>");
			}
		}
//		highlight Starts with search
		elseif($searchopt=="Starts with ...")
		{
			if( !strncasecmp($ret, $searchfor,strlen($searchfor)) )
				$ret = "<span class=highlight>". substr($ret, 0, strlen($searchfor)) ."</span>" . substr($ret, strlen($searchfor));
		}
		elseif($searchopt=="Equals")
		{
			if( !strcasecmp($ret, $searchfor) )
				$ret = "<span class=highlight>". $ret ."</span>";
		}
		elseif($searchopt=="More than ...")
		{
			if( strtoupper($ret)>strtoupper($searchfor) )
				$ret = "<span class=highlight>". $ret ."</span>";
		}
		elseif($searchopt=="Less than ...")
		{
			if( strtoupper($ret)<strtoupper($searchfor) )
				$ret = "<span class=highlight>". $ret ."</span>";
		}
		elseif($searchopt=="Equal or more than ...")
		{
			if( strtoupper($ret)>=strtoupper($searchfor) )
				$ret = "<span class=highlight>". $ret ."</span>";
		}
		elseif($searchopt=="Equal or less than ...")
		{
			if( strtoupper($ret)<=strtoupper($searchfor) )
				$ret = "<span class=highlight>". $ret ."</span>";
		}
	}
*/
	return nl2br($ret);
}

//	construct hyperlink
function GetHyperlink($str, $field,$data,$table="")
{
	global $strTableName;
	if(!strlen($table))
		$table=$strTableName;
	if(!strlen($str))
		return "";
	$ret=$str;
	$title=$ret;
	$link=$ret;
	if(substr($ret,strlen($ret)-1)=='#')
	{
		$i=strpos($ret,'#');
		$title=substr($ret,0,$i);
		$link=substr($ret,$i+1,strlen($ret)-$i-2);
		if(!$title)
			$title=$link;
	}
	$target="";
	
	if(strpos($link,"://")===false && substr($link,0,7)!="mailto:")
		$link=$prefix.$link;
	$ret='<a href="'.$link.'"'.$target.'>'.$title.'</a>';
	return $ret;
}

//	add prefix to the URL
function AddLinkPrefix($field,$link,$table="")
{
	if(strpos($link,"://")===false && substr($link,0,7)!="mailto:")
		return GetLinkPrefix($field,$table).$link;
	return $link;
}

function GetTotalsForTime($value,$arr)
{
	$nsec=0;
	$nmin=0;
	if($value!='')
	{
		$time=parsenumbers($value);
		if(!empty($time))
		{
			if(count($time)==3 && is_numeric($time[2]))
			{
				$nsec=$arr[2]+$time[2];
				if($nsec>59)
				{	
					$arr[2]=$nsec-60;
					$time[1]+=1;
				}
				else $arr[2]+=$time[2];
			}
			if(count($time)>1 && is_numeric($time[1]))
			{
				$nmin=$arr[1]+$time[1];  
				if($nmin>59)
				{
					$arr[1]=$nmin-60;
					$time[0]+=1;	
				}
				else $arr[1]+=$time[1];
			}
			if(is_numeric($time[0]))
				$arr[0]+=$time[0];
		}
	}
	return $arr;
}


//	return Totals string
function GetTotals($field,$value, $stype, $iNumberOfRows,$sFormat)
{
	$days=0;
	if($stype=="AVERAGE")
	{
		if($iNumberOfRows)
		{	
			if($sFormat == FORMAT_TIME)
			{
				if($value!='')
				{
					$pr=parsenumbers($value);
					if(!empty($pr) && count($pr)==3)
					{
						$avhor=round($pr[0]/$iNumberOfRows,0);
						if($avhor>23)
						{
							$days=floor($avhor/24);
							$avhor=$avhor-$days*24;
						}
						$avmin=round($pr[1]/$iNumberOfRows,0);
						$avsec=round($pr[2]/$iNumberOfRows,0);
						$value=($days!=0 ? $days.'d ' : '').$avhor.':'.($avmin>9 ? $avmin : ($avmin==0 ? '00' : '0'.$avmin)).':'.($avsec>9 ? $avsec : ($avsec==0 ? '00' : '0'.$avsec));
					}
				}
			}
			else $value=round($value/$iNumberOfRows,2);	
		}
		else
			return "";
	}
	if($stype=="TOTAL")
	{
		if($sFormat == FORMAT_TIME)
		{
			if($value!='')
			{
				$pr=parsenumbers($value);
				if(!empty($pr)&& count($pr)==3)
				{
					if($pr[0]>23)
					{	
						$days=floor($pr[0]/24);
						$pr[0]=$pr[0]-$days*24;
					}
					$value=($days!=0 ? $days.'d ' :'').($pr[0]==0 ? '00' : $pr[0]).':'.($pr[1]==0 ? '00' : ($pr[1]>9 ? $pr[1] : '0'.$pr[1])).':'.($pr[2]==0 ? '00' : ($pr[2]>9 ? $pr[2] : '0'.$pr[2]));
				}
			}
		}
	}
	$sValue="";
	$data=array($field=>$value);
	if($sFormat == FORMAT_CURRENCY)
	 	$sValue = str_format_currency($value);
	else if($sFormat == FORMAT_PERCENT)
		$sValue = str_format_number($value*100)."%"; 
	else if($sFormat == FORMAT_NUMBER)
 		$sValue = str_format_number($value);
	else if($sFormat == FORMAT_CUSTOM && $stype!="COUNT")
 		$sValue = GetData($data,$field,$sFormat);
	else 
 		$sValue = $value;

	if($stype=="COUNT") 
		return $value;
	if($stype=="TOTAL") 
		return $sValue;
	if($stype=="AVERAGE") 
		return $sValue;
	return "";
}


//	display Lookup Wizard value in List/View mode
function DisplayLookupWizard($field, $value, $data, $keylink, $mode)
{
	global $conn;
	if(!strlen($value))
		return "";
	$LookupSQL="SELECT ";
	$LookupSQL.=GetLWDisplayField($field);
	$LookupSQL.=" FROM ".AddTableWrappers(GetLookupTable($field))." WHERE ";
	$where="";
	$lookupvalue=$value;
	if(Multiselect($field))
	{
		$arr = splitvalues($value);
		$numeric=true;
		$type = GetLWLinkFieldType($field);
		if(!$type)
		{
			foreach($arr as $val)
				if(strlen($val) && !is_numeric($val))
				{
					$numeric=false;
					break;
				}
		}
		else
			$numeric = !NeedQuotes($type);
		$in="";
		foreach($arr as $val)
		{
			if($numeric && !strlen($val))
				continue;
			if(strlen($in))
				$in.=",";
			if($numeric)
				$in.=($val+0);
			else
				$in.="'".db_addslashes($val)."'";
		}
		if(strlen($in))
		{
			$LookupSQL.= GetLWLinkField($field)." in (".$in.")";
			$where = GetLWWhere($field);
			if(strlen($where))
				$LookupSQL.=" and (".$where.")";
			LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$found=false;
			$out="";
			while($lookuprow=db_fetch_numarray($rsLookup))
			{
				$lookupvalue=$lookuprow[0];
				if($found)
					$out.=",";
				$found = true;
				$out.=GetDataInt($lookupvalue,$data,$field, ViewFormat($field));
			}
			if($found)
			{
				if(NeedEncode($field) && $mode!=MODE_EXPORT)
					return ProcessLargeText($out,"field=".htmlspecialchars(rawurlencode($field)).$keylink,"",$mode);
				else
					return $out;
			}
		}
	}
	else
	{
		$strdata = make_db_value($field,$value);
		$LookupSQL.=GetLWLinkField($field)." = " . $strdata;
		$where = GetLWWhere($field);
		if(strlen($where))
			$LookupSQL.=" and (".$where.")";
		LogInfo($LookupSQL);
		$rsLookup = db_query($LookupSQL,$conn);
		if($lookuprow=db_fetch_numarray($rsLookup))
			$lookupvalue=$lookuprow[0];
	}
	if(NeedEncode($field) && $mode!=MODE_EXPORT)
		$value=ProcessLargeText(GetDataInt($lookupvalue,$data,$field, ViewFormat($field)),"field=".htmlspecialchars(rawurlencode($field)).$keylink,"",$mode);
	else
		$value=GetDataInt($lookupvalue,$data,$field, ViewFormat($field));
	return $value;
}

function DisplayNoImage()
{
	$path = GetAbsoluteFileName("images/no_image.gif");
	$img=myfile_get_contents($path,"r");
	header("Content-Type: image/gif");
	echo $img;
}

function DisplayFile()
{
	$path = GetAbsoluteFileName("images/file.gif");
	$img=myfile_get_contents($path,"r");
	header("Content-Type: image/gif");
	echo $img;
}

function echobig($string, $bufferSize = 8192)
{
	for ($chars=strlen($string)-1,$start=0;$start <= $chars;$start += $bufferSize) 
		echo substr($string,$start,$bufferSize);
}

////////////////////////////////////////////////////////////////////////////////
// miscellaneous functions
////////////////////////////////////////////////////////////////////////////////



//	analog of strrpos function
function my_strrpos($haystack, $needle) {
   $index = strpos(strrev($haystack), strrev($needle));
   if($index === false) {
       return false;
   }
   $index = strlen($haystack) - strlen($needle) - $index;
   return $index;
}

//	utf-8 analog of strlen function
function strlen_utf8($str)
{
	$len=0;
	$i=0;
	$olen=strlen($str);
	while($i<$olen)
	{
		$c=ord(substr($str,$i,1));
		if($c<128)
			$i++;
		else if($i<$olen-1 && $c>=192 && $c<=223)
			$i+=2;
		else if($i<$olen-2 && $c>=224 && $c<=239)
			$i+=3;
		else if($i<$olen-3 && $c>=240)
			$i+=4;
		else
			break;
		$len++;
	}
	return $len;
}

//	utf-8 analog of substr function
function substr_utf8($str,$index,$strlen)
{
	if($strlen<=0)
		return "";
	$len=0;
	$i=0;
	$olen=strlen($str);
	$oindex=-1;
	while($i<$olen)
	{
		if($len==$index)
			$oindex=$i;
		
		$c=ord(substr($str,$i,1));
		if($c<128)
			$i++;
		else if($i<$olen-1 && $c>=192 && $c<=223)
			$i+=2;
		else if($i<$olen-2 && $c>=224 && $c<=239)
			$i+=3;
		else if($i<$olen-3 && $c>=240)
			$i+=4;
		else
			break;
		$len++;
		if($oindex>=0 && $len==$index+$strlen)
			return substr($str,$oindex,$i-$oindex);
	}
	if($oindex>0)
		return substr($str,$oindex,$olen-$oindex);
	return "";
}

//	construct "good" field name
function GoodFieldName($field)
{
	$field=(string)$field;	
	$out="";
	for($i=0;$i<strlen($field);$i++)
	{
		$t=substr($field,$i,1);
		if((ord($t)<ord('a') || ord($t)>ord('z')) && (ord($t)<ord('A') || ord($t)>ord('Z')) && (ord($t)<ord('0') || ord($t)>ord('9')))
			$out.='_';
		else
			$out.=$t;
	}
	return $out;
}

//	prepare string for JavaScript. Replace ' with \' and linebreaks with \r\n
function jsreplace($str)
{
	$ret= str_replace(array("\\","'","\r","\n"),array("\\\\","\\'","\\r","\\n"),$str);
	return my_str_ireplace("</script>","</scr'+'ipt>",$ret);
}


function LogInfo($SQL)
{
	global $dSQL,$dDebug;
	$dSQL=$SQL;
	if($dDebug)
	{
		echo $dSQL;
		echo "<br>";
	}
}


//	check if file extension is image extension
function CheckImageExtension($filename)
{
	if(strlen($filename)<4)
		return false;
	$ext=strtoupper(substr($filename,strlen($filename)-4));
	if($ext==".GIF" || $ext==".JPG" || $ext=="JPEG" || $ext==".PNG" || $ext==".BMP")
		return $ext;
	return false;
} 























































































function RTESafe($strText)
{
//	returns safe code for preloading in the RTE
	$tmpString="";
	
	$tmpString = trim($strText);
	if(!$tmpString) return "";
	
//	convert all types of single quotes
	$tmpString = str_replace( chr(145), chr(39),$tmpString);
	$tmpString = str_replace( chr(146), chr(39),$tmpString);
	$tmpString = str_replace("'", "&#39;",$tmpString);
	
//	convert all types of double quotes
	$tmpString = str_replace(chr(147), chr(34),$tmpString);
	$tmpString = str_replace(chr(148), chr(34),$tmpString);
	
//	replace carriage returns & line feeds
	$tmpString = str_replace(chr(10), " ",$tmpString);
	$tmpString = str_replace(chr(13), " ",$tmpString);
	
	return $tmpString;
}



function html_special_decode($str)
{
	$ret=$str;
	$ret=str_replace("&gt;",">",$ret);
	$ret=str_replace("&lt;","<",$ret);
	$ret=str_replace("&quot;","\"",$ret);
	$ret=str_replace("&#039;","'",$ret);
	$ret=str_replace("&#39;","'",$ret);
	$ret=str_replace("&amp;","&",$ret);
	return $ret;
}

////////////////////////////////////////////////////////////////////////////////
// database and SQL related functions
////////////////////////////////////////////////////////////////////////////////

function CalcSearchParameters()
{
	global $strTableName, $strSQL;
	$sWhere="";
	if(@$_SESSION[$strTableName."_search"]==2)
//	 advanced search
	{
		foreach(@$_SESSION[$strTableName."_asearchfor"] as $f => $sfor)
		{
			$strSearchFor=trim($sfor);
			$strSearchFor2="";
			$type=@$_SESSION[$strTableName."_asearchfortype"][$f];
			if(array_key_exists($f,@$_SESSION[$strTableName."_asearchfor2"]))
				$strSearchFor2=trim(@$_SESSION[$strTableName."_asearchfor2"][$f]);
			if($strSearchFor!="" || true)
			{
				if (!$sWhere) 
				{
					if($_SESSION[$strTableName."_asearchtype"]=="and")
						$sWhere="1=1";
					else
						$sWhere="1=0";
				}
				$strSearchOption=trim($_SESSION[$strTableName."_asearchopt"][$f]);
				if($where=StrWhereAdv($f, $strSearchFor, $strSearchOption, $strSearchFor2,$type))
				{
					if($_SESSION[$strTableName."_asearchnot"][$f])
						$where="not (".$where.")";
					if($_SESSION[$strTableName."_asearchtype"]=="and")
	   					$sWhere .= " and ".$where;
					else
	   					$sWhere .= " or ".$where;
				}
			}
		}
	}
	return $sWhere;
}

//	add WHERE condition to gstrSQL
function gSQLWhere($where)
{
	global $gsqlHead,$gsqlFrom,$gsqlWhereExpr,$gsqlTail;
	return gSQLWhere_int($gsqlHead,$gsqlFrom,$gsqlWhereExpr,$gsqlTail,$where);
}

function gSQLWhere_int($sqlHead,$sqlFrom,$sqlWhere,$sqlTail,$where)
{
	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	
	return $sqlHead.$sqlFrom.$strWhere.$sqlTail;
}

//	add clause to WHERE expression
function whereAdd($where,$clause)
{
	if(!strlen($clause))
		return $where;
	if(!strlen($where))
		return $clause;
	return "(".$where.") and (".$clause.")";
}

//	add WHERE clause to SQL string
function AddWhere($sql,$where)
{
	if(!strlen($where))
		return $sql;
	$sql=str_replace(array("\r\n","\n","\t")," ",$sql);
	$tsql = strtolower($sql);
	$n = my_strrpos($tsql," where ");
	$n1 = my_strrpos($tsql," group by ");
	$n2 = my_strrpos($tsql," order by ");
	if($n1===false)
		$n1=strlen($tsql);
	if($n2===false)
		$n2=strlen($tsql);
	if ($n1>$n2)
		$n1=$n2;
	if($n===false)
		return substr($sql,0,$n1)." where ".$where.substr($sql,$n1);
	else
		return substr($sql,0,$n+strlen(" where "))."(".substr($sql,$n+strlen(" where "),$n1-$n-strlen(" where ")).") and (".$where.")".substr($sql,$n1);
}

//	construct WHERE clause with key values
function KeyWhere(&$keys, $table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	$strWhere="";

//	vw_antinutritional
	if($table=="vw_antinutritional")
	{
			$value=make_db_value("IngredientID",$keys["IngredientID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("IngredientID")." is null";
		else
			$strWhere.=GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys["IngredientID"]);
	}

//	vw_digestibility
	if($table=="vw_digestibility")
	{
			$value=make_db_value("IngredientID",$keys["IngredientID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("IngredientID")." is null";
		else
			$strWhere.=GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys["IngredientID"]);
	}

//	users
	if($table=="users")
	{
			$value=make_db_value("ID",$keys["ID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("ID")." is null";
		else
			$strWhere.=GetFullFieldName("ID")."=".make_db_value("ID",$keys["ID"]);
	}

//	vw_species
	if($table=="vw_species")
	{
			$value=make_db_value("SpeciesID",$keys["SpeciesID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("SpeciesID")." is null";
		else
			$strWhere.=GetFullFieldName("SpeciesID")."=".make_db_value("SpeciesID",$keys["SpeciesID"]);
	}

//	vw_feedspec
	if($table=="vw_feedspec")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}

//	vw_feedanalysis
	if($table=="vw_feedanalysis")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}

//	vw_feedingredient
	if($table=="vw_feedingredient")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}

//	vw_ingredient
	if($table=="vw_ingredient")
	{
			$value=make_db_value("IngredientID",$keys["IngredientID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("IngredientID")." is null";
		else
			$strWhere.=GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys["IngredientID"]);
	}

//	vw_feed
	if($table=="vw_feed")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}

//	vw_fullingredientelementanalysis
	if($table=="vw_fullingredientelementanalysis")
	{
			$value=make_db_value("IngredientID",$keys["IngredientID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("IngredientID")." is null";
		else
			$strWhere.=GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys["IngredientID"]);
	}

//	vw_fullingredientproxanalysis
	if($table=="vw_fullingredientproxanalysis")
	{
			$value=make_db_value("IngredientID",$keys["IngredientID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("IngredientID")." is null";
		else
			$strWhere.=GetFullFieldName("IngredientID")."=".make_db_value("IngredientID",$keys["IngredientID"]);
	}

//	vw_fullfeedproxanalysis
	if($table=="vw_fullfeedproxanalysis")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}

//	vw_fullfeedelementanalysis
	if($table=="vw_fullfeedelementanalysis")
	{
			$value=make_db_value("FeedID",$keys["FeedID"]);
				$valueisnull = ($value==="null");
		if($valueisnull)
			$strWhere.=GetFullFieldName("FeedID")." is null";
		else
			$strWhere.=GetFullFieldName("FeedID")."=".make_db_value("FeedID",$keys["FeedID"]);
	}
	return $strWhere;
}

//	consctruct SQL WHERE clause for simple search
function StrWhereExpression($strField, $SearchFor, $strSearchOption, $SearchFor2)
{
	global $strTableName;
	$type=GetFieldType($strField);
	
	$ismssql=false;
	
	$btexttype=IsTextType($type);
	$btexttype=false;

	if($strSearchOption=='Empty')
	{
		if(IsCharType($type) && (!$ismssql || !$btexttype))
			return "(".GetFullFieldName($strField)." is null or ".GetFullFieldName($strField)."='')";			
		elseif ($ismssql && $btexttype)	
			return "(".GetFullFieldName($strField)." is null or ".GetFullFieldName($strField)." LIKE '')";
		else
			return GetFullFieldName($strField)." is null";
	}
	$strQuote="";
	if(NeedQuotes($type))
		$strQuote = "'";
//	return none if trying to compare numeric field and string value
	$sSearchFor=$SearchFor;
	$sSearchFor2=$SearchFor2;
	if(IsBinaryType($type))
		return "";
	

	
	if(IsDateFieldType($type) && $strSearchOption!="Contains" && $strSearchOption!="Starts with ..." )
	{
		$time=localdatetime2db($SearchFor);
		if($time=="null")
			return "";
		$sSearchFor=db_datequotes($time);
		if($strSearchOption=="Between")
		{
			$time=localdatetime2db($SearchFor2);
			if($time=="null")
				$sSearchFor2="";
			else
				$sSearchFor2=db_datequotes($time);
		}
	}
	
	if(!$strQuote && !is_numeric($sSearchFor) && !is_numeric($sSearchFor))
		return "";
	else if(!$strQuote && $strSearchOption!="Contains" && $strSearchOption!="Starts with ...")
	{
		$sSearchFor = 0+$sSearchFor;
		$sSearchFor2 = 0+$sSearchFor2;
	}
	else if(!IsDateFieldType($type) && $strSearchOption!="Contains" && $strSearchOption!="Starts with ...")
	{
		if(!$btexttype)
		{
			$sSearchFor=$strQuote.db_addslashes($sSearchFor).$strQuote;
			if($strSearchOption=="Between" && $sSearchFor2)
				$sSearchFor2=$strQuote.db_addslashes($sSearchFor2).$strQuote;
		}
		else
		{
			$sSearchFor=db_upper($strQuote.db_addslashes($sSearchFor).$strQuote);
			if($strSearchOption=="Between" && $sSearchFor2)
				$sSearchFor2=db_upper($strQuote.db_addslashes($sSearchFor2).$strQuote);
		}
	}
	else if(!IsDateFieldType($type) || $strSearchOption=="Contains" || $strSearchOption=="Starts with ..." )
		$sSearchFor=db_addslashes($sSearchFor);
		

	if(IsCharType($type) && !$btexttype)
		$strField=db_upper(GetFullFieldName($strField));
	elseif ($ismssql && !$btexttype && ($strSearchOption=="Contains" || $strSearchOption=="Starts with ..."))
		$strField="convert(varchar(50),".GetFullFieldName($strField).")";
	else 
		$strField=GetFullFieldName($strField);
	$ret="";
		$like="like";
	if($strSearchOption=="Contains")
	{
		if(IsCharType($type) && !$btexttype)
			return $strField." ".$like." ".db_upper("'%".$sSearchFor."%'");
		else
			return $strField." ".$like." '%".$sSearchFor."%'";
	}
	else if($strSearchOption=="Equals") return $strField."=".$sSearchFor;
	else if($strSearchOption=="Starts with ...")
	{
		if(IsCharType($type) && !$btexttype)
			return $strField." ".$like." ".db_upper("'".$sSearchFor."%'");
		else
			return $strField." ".$like." '".$sSearchFor."%'";
	}
	else if($strSearchOption=="More than ...") return $strField.">".$sSearchFor;
	else if($strSearchOption=="Less than ...") return $strField."<".$sSearchFor;
	else if($strSearchOption=="Equal or more than ...") return $strField.">=".$sSearchFor;
	else if($strSearchOption=="Equal or less than ...") return $strField."<=".$sSearchFor;
	else if($strSearchOption=="Between")
	{
		$ret=$strField.">=".$sSearchFor;
		if($sSearchFor2) $ret.=" and ".$strField."<=".$sSearchFor2;
			return $ret;
	}
	return "";
}

//	construct SQL WHERE clause for Advanced search
function StrWhereAdv($strField, $SearchFor, $strSearchOption, $SearchFor2, $etype)
{
	global $strTableName;
	$type=GetFieldType($strField);

	$ismssql=false;
	
	$btexttype=IsTextType($type);
	$btexttype=false;

	if(IsBinaryType($type))
		return "";
	if($strSearchOption=='Empty')
	{
		if(IsCharType($type) && (!$ismssql || !$btexttype))
			return "(".GetFullFieldName($strField)." is null or ".GetFullFieldName($strField)."='')";			
		elseif ($ismssql && $btexttype)	
			return "(".GetFullFieldName($strField)." is null or ".GetFullFieldName($strField)." LIKE '')";
		else
			return GetFullFieldName($strField)." is null";
	}
		$like="like";
	if(GetEditFormat($strField)==EDIT_FORMAT_LOOKUP_WIZARD)
	{
		
		if(Multiselect($strField))
			$SearchFor=splitvalues($SearchFor);
		else
			$SearchFor=array($SearchFor);
		$ret="";
		foreach($SearchFor as $value)
		{
			if(!($value=="null" || $value=="Null" || $value==""))
			{
				if(strlen($ret))
					$ret.=" or ";
				if($strSearchOption=="Equals")
				{
					$value=make_db_value($strField,$value);
					if(!($value=="null" || $value=="Null"))
						$ret.=GetFullFieldName($strField).'='.$value;
				}
				else
				{
					if(strpos($value,",")!==false || strpos($value,'"')!==false)
						$value = '"'.str_replace('"','""',$value).'"';
					$value=db_addslashes($value);
					$ret.=GetFullFieldName($strField)." = '".$value."'";
					$ret.=" or ".GetFullFieldName($strField)." ".$like." '%,".$value.",%'";
					$ret.=" or ".GetFullFieldName($strField)." ".$like." '%,".$value."'";
					$ret.=" or ".GetFullFieldName($strField)." ".$like." '".$value.",%'";
				}
			}
		}
		if(strlen($ret))
			$ret="(".$ret.")";
		return $ret;
	}
	if(GetEditFormat($strField)==EDIT_FORMAT_CHECKBOX)
	{
		if($SearchFor=="none")
			return "";
		if(NeedQuotes($type))
		{
			if($SearchFor=="on")
				return "(".GetFullFieldName($strField)."<>'0' and ".GetFullFieldName($strField)."<>'' and ".GetFullFieldName($strField)." is not null)";
			else
				return "(".GetFullFieldName($strField)."='0' or ".GetFullFieldName($strField)."='' or ".GetFullFieldName($strField)." is null)";
		}
		else
		{
			if($SearchFor=="on")
				return "(".GetFullFieldName($strField)."<>0 and ".GetFullFieldName($strField)." is not null)";
			else
				return "(".GetFullFieldName($strField)."=0 or ".GetFullFieldName($strField)." is null)";
		}
	}
	$value1=make_db_value($strField,$SearchFor,$etype);
	$value2=false;
	if($strSearchOption=="Between")
		$value2=make_db_value($strField,$SearchFor2,$etype);
	if($strSearchOption!="Contains" && $strSearchOption!="Starts with ..." && ($value1==="null" || $value2==="null" ))
		return "";

	if(IsCharType($type) && !$btexttype)
	{
		$value1=db_upper($value1);
		$value2=db_upper($value2);
		$strField=db_upper(GetFullFieldName($strField));
	}
	elseif ($ismssql && !$btexttype && ($strSearchOption=="Contains" || $strSearchOption=="Starts with ..."))
		$strField="convert(varchar,".GetFullFieldName($strField).")";
	else 
		$strField=GetFullFieldName($strField);
	$ret="";
	if($strSearchOption=="Contains")
	{
		if(IsCharType($type) && !$btexttype)
			return $strField." ".$like." ".db_upper("'%".db_addslashes($SearchFor)."%'");
		else
			return $strField." ".$like." '%".db_addslashes($SearchFor)."%'";
	}
	else if($strSearchOption=="Equals") return $strField."=".$value1;
	else if($strSearchOption=="Starts with ...")
	{
		if(IsCharType($type) && !$btexttype)
			return $strField." ".$like." ".db_upper("'".db_addslashes($SearchFor)."%'");
		else
			return $strField." ".$like." '".db_addslashes($SearchFor)."%'";
	}
	else if($strSearchOption=="More than ...") return $strField.">".$value1;
	else if($strSearchOption=="Less than ...") return $strField."<".$value1;
	else if($strSearchOption=="Equal or more than ...") return $strField.">=".$value1;
	else if($strSearchOption=="Equal or less than ...") return $strField."<=".$value1;
	else if($strSearchOption=="Between")
	{
		$ret=$strField.">=".$value1;
		$ret.=" and ".$strField."<=".$value2;
		return $ret;
	}
	return "";
}

//	get count of rows from the query
function gSQLRowCount($where,$groupby=false)
{
	global $gsqlHead,$gsqlFrom,$gsqlWhereExpr,$gsqlTail;
	return gSQLRowCount_int($gsqlHead,$gsqlFrom,$gsqlWhereExpr,$gsqlTail,$where,$groupby);
}

function gSQLRowCount_int($sqlHead,$sqlFrom,$sqlWhere,$sqlTail,$where,$groupby=false)
{
	global $conn;
	global $bSubqueriesSupported;
	
	$strWhere=whereAdd($sqlWhere,$where);
	if(strlen($strWhere))
		$strWhere=" where ".$strWhere." ";
	
	if($groupby)
	{
			if($bSubqueriesSupported)
			$countstr = "select count(*) from (".gSQLWhere_int($sqlHead,$sqlFrom,$sqlWhere,$sqlTail,$where).") a";
		else
		{
			$countstr = gSQLWhere_int($sqlHead,$sqlFrom,$sqlWhere,$sqlTail,$where);
			return GetMySQL4RowCount($countstr);
		}
	}
	else
		$countstr = "select count(*) ".$sqlFrom.$strWhere.$sqlTail;
		
	$countrs = db_query($countstr,$conn);
	$countdata = db_fetch_numarray($countrs);
	return $countdata[0];
}

//	get count of rows from the query
function GetRowCount($strSQL)
{
	global $conn;
	$strSQL=str_replace(array("\r\n","\n","\t")," ",$strSQL);
	$tstr = strtoupper($strSQL);
	$ind1 = strpos($tstr,"SELECT ");
	$ind2 = my_strrpos($tstr," FROM ");
	$ind3 = my_strrpos($tstr," GROUP BY ");
	if($ind3===false)
	{
		$ind3 = strpos($tstr," ORDER BY ");
		if($ind3===false)
			$ind3=strlen($strSQL);
	}
	$countstr=substr($strSQL,0,$ind1+6)." count(*) ".substr($strSQL,$ind2+1,$ind3-$ind2);
	$countrs = db_query($countstr,$conn);
	$countdata = db_fetch_numarray($countrs);
	return $countdata[0];
}

//	add MSSQL Server TOP clause
function AddTop($strSQL, $n)
{
	$tstr = strtoupper($strSQL);
	$ind1 = strpos($tstr,"SELECT");
	return substr($strSQL,0,$ind1+6)." top ".$n." ".substr($strSQL,$ind1+6);
}

//	add Oracle ROWNUMBER checking
function AddRowNumber($strSQL, $n)
{
	return "select * from (".$strSQL.") where rownum<".($n+1);
}

// test database type if values need to be quoted
function NeedQuotesNumeric($type)
{
    if($type == 203 || $type == 8 || $type == 129 || $type == 130 || 
		$type == 7 || $type == 133 || $type == 134 || $type == 135 ||
		$type == 201 || $type == 205 || $type == 200 || $type == 202 || $type==72 || $type==13)
		return true;
	else
		return false;
}

//	using ADO DataTypeEnum constants
//	the full list available at:
//	http://msdn.microsoft.com/library/default.asp?url=/library/en-us/ado270/htm/mdcstdatatypeenum.asp

function IsNumberType($type)
{
	if($type==20 || $type==6 || $type==14 || $type==5 || $type==10 
	|| $type==3 || $type==131 || $type==4 || $type==2 || $type==16
	|| $type==21 || $type==19 || $type==18 || $type==17 || $type==139
	|| $type==11)
		return true;
	return false;
}

function IsFloatType($type)
{
	if($type==14 || $type==5 || $type==131 || $type==6)
		return true;
	return false;
}


function NeedQuotes($type)
{
	return !IsNumberType($type);
}

function IsBinaryType($type)
{
	if($type==128 || $type==205 || $type==204)
		return true;
	return false;
}

function IsDateFieldType($type)
{
	if($type==7 || $type==133 || $type==135)
		return true;
	return false;
}

function IsTimeType($type)
{
	if($type==134)
		return true;
	return false;
}

function IsCharType($type)	
{
	if(IsTextType($type) || $type==8 || $type==129 || $type==200 || $type==202 || $type==130)
		return true;
	return false;
}

function IsTextType($type)
{
	if($type==201 || $type==203)
		return true;
	return false;
}

////////////////////////////////////////////////////////////////////////////////
// security functions
////////////////////////////////////////////////////////////////////////////////


//	return user permissions on the table
//	A - Add
//	D - Delete
//	E - Edit
//	S - List/View/Search
//	P - Print/Export



function GetUserPermissionsStatic($table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;

	$sUserGroup=@$_SESSION["GroupID"];
	if($table=="vw_antinutritional" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_antinutritional")
	{
		return "AEDSPI";
	}
	if($table=="vw_digestibility" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_digestibility")
	{
		return "AEDSPI";
	}
	if($table=="users" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="users")
	{
		return "AEDSPI";
	}
	if($table=="vw_species" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_species")
	{
		return "AEDSPI";
	}
	if($table=="vw_feedspec" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_feedspec")
	{
		return "AEDSPI";
	}
	if($table=="vw_feedanalysis" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_feedanalysis")
	{
		return "AEDSPI";
	}
	if($table=="vw_feedingredient" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_feedingredient")
	{
		return "ADESPI";
	}
	if($table=="vw_ingredient" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_ingredient")
	{
		return "ADESPI";
	}
	if($table=="vw_feed" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_feed")
	{
		return "ADESPI";
	}
	if($table=="vw_fullingredientelementanalysis" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_fullingredientelementanalysis")
	{
		return "ADESPI";
	}
	if($table=="vw_fullingredientproxanalysis" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_fullingredientproxanalysis")
	{
		return "ADESPI";
	}
	if($table=="vw_fullfeedproxanalysis" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_fullfeedproxanalysis")
	{
		return "ADESPI";
	}
	if($table=="vw_fullfeedelementanalysis" && $sUserGroup=="<Guest>")
	{
				return "S";
	}
//	default permissions	
	if($table=="vw_fullfeedelementanalysis")
	{
		return "ADESPI";
	}
}


function GetUserPermissions($table="")
{
	return GetUserPermissionsStatic($table);
}


//	check whether field is viewable
function CheckFieldPermissions($field, $table="")
{
	return GetFieldData($table,$field,"FieldPermissions",false);
}

// 
function CheckSecurity($strValue, $strAction)
{
global $cAdvSecurityMethod, $strTableName;
	if($_SESSION["AccessLevel"]==ACCESS_LEVEL_ADMIN)
		return true;

	$strPerm = GetUserPermissions();
	if(@$_SESSION["AccessLevel"]!=ACCESS_LEVEL_ADMINGROUP && strpos($strPerm, "M")===false)
	{
	}
		return true;
}


//	add security WHERE clause to SELECT SQL command
function SecuritySQL($strAction, $table="")
{
global $cAdvSecurityMethod,$strTableName;
	
	if (!strlen($table))	
		$table = $strTableName;
		
   	$ownerid=@$_SESSION["_".$table."_OwnerID"];
	$ret="";
	if(@$_SESSION["AccessLevel"]==ACCESS_LEVEL_ADMIN)
		return "";
	$ret="";

	$strPerm = GetUserPermissions($table);

	if(@$_SESSION["AccessLevel"]!=ACCESS_LEVEL_ADMINGROUP)
	{

	}
	
	if($strAction=="Edit" && !(strpos($strPerm, "E")===false) ||
	   $strAction=="Delete" && !(strpos($strPerm, "D")===false) ||
	   $strAction=="Search" && !(strpos($strPerm, "S")===false) ||
	   $strAction=="Export" && !(strpos($strPerm, "P")===false) )
		return $ret;
	else
		return "1=0";
	return "";
}

////////////////////////////////////////////////////////////////////////////////
// editing functions
////////////////////////////////////////////////////////////////////////////////

function make_db_value($field,$value,$controltype="",$postfilename="",$table="")
{
	$ret=prepare_for_db($field,$value,$controltype,$postfilename,$table);
	if($ret===false)
		return $ret;
	return add_db_quotes($field,$ret,$table);
}

function add_db_quotes($field,$value,$table="")
{
	global $strTableName;
	$type=GetFieldType($field,$table);
	if(IsBinaryType($type))
		return db_addslashesbinary($value);
	if(($value==="" || $value===FALSE) && !IsCharType($type))
		return "null";
	if(NeedQuotes($type))
	{
		if(!IsDateFieldType($type))
			$value="'".db_addslashes($value)."'";
		else
			$value=db_datequotes($value);
	}
	else
	{
		$strvalue = (string)$value;
		$strvalue = str_replace(",",".",$strvalue);
		if(is_numeric($strvalue))
			$value=$strvalue;
		else
			$value=0;
//		$value=0+$strvalue;
	}
	return $value;
}


function prepare_for_db($field,$value,$controltype="",$postfilename="",$table="")
{
	global $strTableName;
	$filename="";
	$type=GetFieldType($field,$table);
	if(!$controltype || $controltype=="multiselect")
	{
		if(is_array($value))
			$value=combinevalues($value);
		if(($value==="" || $value===FALSE) && !IsCharType($type))
			return "";
		return $value;
	}
	else if(substr($controltype,0,4)=="file")
	{
		return prepare_file($value,$field,$controltype,$postfilename);
	}
	else if(substr($controltype,0,6)=="upload")
	{
		return prepare_upload($field,$controltype,$postfilename,$value,$table);
	}
	else if($controltype=="time")
	{
		if(!strlen($value))
			return "";
		$time=localtime2db($value);
		if(IsDateFieldType(GetFieldType($field,$table)))
		{
			$time="2000-01-01 ".$time;
		}
		return $time;
	}
	else if(substr($controltype,0,4)=="date")
	{
		$dformat=substr($controltype,4);
		if($dformat==EDIT_DATE_SIMPLE || $dformat==EDIT_DATE_SIMPLE_DP)
		{
			$time=localdatetime2db($value);
			if($time=="null")
				return "";
			return $time;
		}
		else if($dformat==EDIT_DATE_DD || $dformat==EDIT_DATE_DD_DP)
		{
			$a=explode("-",$value);
			if(count($a)<3)
				return "";
			else
			{
				$y=$a[0];
				$m=$a[1];
				$d=$a[2];
			}
			if($y<100)
			{
				if($y<70)
					$y+=2000;
				else
					$y+=1900;
			}
			return mysprintf("%04d-%02d-%02d",array($y,$m,$d));
		}
		else
			return "";
	}
	else if(substr($controltype,0,8)=="checkbox")
	{
		if($value=="on")
			$ret=1;
		else if($value=="none")
			return "";
		else 
			$ret=0;
		return $ret;
	}
	else
		return false;
}

//	delete uploaded files when deleting the record
function DeleteUploadedFiles($where,$table="")
{
	global $conn,$gstrSQL;
	$sql = gSQLWhere($where);
	$rs = db_query($sql,$conn);
	if(!($data=db_fetch_array($rs)))
		return;
	foreach($data as $field=>$value)
	{
		if(strlen($value) && GetEditFormat($field)==EDIT_FORMAT_FILE)
		{
			if(myfile_exists(GetUploadFolder($field).$value))
				myunlink(GetUploadFolder($field).$value);
			if(GetCreateThumbnail($field) && myfile_exists(GetUploadFolder($field).GetThumbnailPrefix($field).$value))
				myunlink(GetUploadFolder($field).GetThumbnailPrefix($field).$value);
		}
	}
}

//	combine checked values from multi-select list box
function combinevalues($arr)
{
	$ret="";
	foreach($arr as $val)
	{
		if(strlen($ret))
			$ret.=",";
		if(strpos($val,",")===false && strpos($val,'"')===false)
			$ret.=$val;
		else
		{
			$val=str_replace('"','""',$val);
			$ret.='"'.$val.'"';
		}
	}
	return $ret;
}

//	split values for multi-select list box
function splitvalues($str)
{
	$arr=array();
	$start=0;
	$i=0;
	$inquot=false;
	while($i<=strlen($str))
	{
		if($i<strlen($str) && substr($str,$i,1)=='"')
			$inquot=!$inquot;
		else if($i==strlen($str) || !$inquot && substr($str,$i,1)==',')
		{
			$val=substr($str,$start,$i-$start);
			$start=$i+1;
			if(strlen($val) && substr($val,0,1)=='"')
			{
				$val=substr($val,1,strlen($val)-2);
				$val=str_replace('""','"',$val);
			}
			$arr[]=$val;
		}
		$i++;
	}
	return $arr;
}


////////////////////////////////////////////////////////////////////////////////
// edit controls creation functions
////////////////////////////////////////////////////////////////////////////////


//	write days dropdown
function WriteDays($d)
{
	$ret='<option value=""> </option>';
	for($i=1;$i<=31;$i++)
		$ret.='<option value="'.$i.'" '.($i==$d?"selected":"").'>'.$i."</option>\r\n";
	return $ret;
}

//	write months dropdown
function WriteMonths($m)
{
	$monthnames=array();
	$monthnames[1]="January";
	$monthnames[2]="February";
	$monthnames[3]="March";
	$monthnames[4]="April";
	$monthnames[5]="May";
	$monthnames[6]="June";
	$monthnames[7]="July";
	$monthnames[8]="August";
	$monthnames[9]="September";
	$monthnames[10]="October";
	$monthnames[11]="November";
	$monthnames[12]="December";
	$ret='<option value=""></option>';
	for($i=1;$i<=12;$i++)
		$ret.='<option value="'.$i.'" '.($i==$m?"selected":"").'>'.$monthnames[$i]."</option>\r\n";
	return $ret;
}

//	write years dropdown
function WriteYears($y)
{
	$currectYear=GetCurrentYear();
	$firstyear = $currectYear-100;
	$lastyear=$currectYear+10;
	$ret='<option value=""> </option>';
	if($y && $firstyear>$y-5)
		$firstyear=$y-10;
	if($y && $lastyear<$y+5)
		$lastyear=$y+10;
	for($i=$firstyear;$i<=$lastyear;$i++)
		$ret.='<option value="'.$i.'" '.($i==$y?"selected":"").'>'.$i."</option>\r\n";
	return $ret;
}

//	returns HTML code that represents required Date edit control
function GetDateEdit($field, $value, $type, $secondfield=false,$search=MODE_EDIT,$record_id="")
{	
	global $cYearRadius, $locale_info, $jscode;
	$cfieldname=GoodFieldName($field);
	$cfield="value_".GoodFieldName($field);
	$ctype="type_".GoodFieldName($field);
	if($secondfield)
	{
		$cfield="value1_".GoodFieldName($field);
		$ctype="type1_".GoodFieldName($field);
	}
	$iname=$cfield;
	$tvalue=$value;
	if($search==MODE_SEARCH && ($type==EDIT_DATE_SIMPLE || $type==EDIT_DATE_SIMPLE_DP))
		$tvalue=localdatetime2db($value);
	$time=db2time($tvalue);
	if(!count($time))
		$time=array(0,0,0,0,0,0);
	$dp=0;
//	$edit_type = postvalue("editType");
	$inline=false;
	if($search==MODE_INLINE_ADD || $search==MODE_INLINE_EDIT)
		$inline=true;
	
	switch($type)
	{
		case EDIT_DATE_SIMPLE_DP:
			$ovalue=$value;
			if($locale_info["LOCALE_IDATE"]==1)
			{
				$fmt="dd".$locale_info["LOCALE_SDATE"]."MM".$locale_info["LOCALE_SDATE"]."yyyy";
				$sundayfirst="false";
			}
			else if($locale_info["LOCALE_IDATE"]==0)
			{
				$fmt="MM".$locale_info["LOCALE_SDATE"]."dd".$locale_info["LOCALE_SDATE"]."yyyy";
				$sundayfirst="true";
			}
			else
			{
				$fmt="yyyy".$locale_info["LOCALE_SDATE"]."MM".$locale_info["LOCALE_SDATE"]."dd";
				$sundayfirst="false";
			}
			if(DateEditShowTime($field) )
			{
				if($time[5])
					$fmt.=" HH:mm:ss";
				else if($time[3] || $time[4])
					$fmt.=" HH:mm";
			}
			if($time[0])
				$ovalue=format_datetime_custom($time,$fmt);
			$ovalue1=$time[2]."-".$time[1]."-".$time[0];
			$showtime="false";
			if(DateEditShowTime($field))
			{
				$showtime="true";
				$ovalue1.=" ".$time[3].":".$time[4].":".$time[5];
			}
			if ( $inline ) {
				$onblur="var dt=parse_datetime(this.value,".$locale_info["LOCALE_IDATE"]."); if(dt!=null) $('input#ts".$iname."_".$record_id."').get(0).value=print_datetime(dt,-1,".$showtime."); else $('input#ts".$iname."_".$record_id."').get(0).value='';";
			} else {
				$onblur="var dt=parse_datetime(this.value,".$locale_info["LOCALE_IDATE"]."); if(dt!=null) $('input[@name=ts".$iname."]').get(0).value=print_datetime(dt,-1,".$showtime."); else $('input[@name=ts".$iname."]').get(0).value='';";
			}
			$ret='<input type="Text" name="'.$iname.'" size = "20" value="'.$ovalue.'" onblur="'.$onblur.'">'; 
			$ret.='<input type="Hidden" name="ts'.$iname.'" value="'.$ovalue1.'">&nbsp;&nbsp;';
			if ( $inline ) {
				$ret.='<a href="#" onclick="javascript:var v=show_calendar(\'update\', \''.$iname.'\',\''.$record_id.'\', $(\'input#ts'.$iname.'_'.$record_id.'\').get(0).value,'.$showtime.','.$sundayfirst.'); return false;">'.
					'<img src="images/cal.gif" width=16 height=16 border=0 alt="'."Click Here to Pick up the date".'"></a>';
				$ret.="<script language=\"javascript\">".
					"function update".$iname."_".$record_id."(newDate) ".
					"{ ";
				$ret.="	$('input#".$iname."_".$record_id."').get(0).value =  print_datetime(newDate,".$locale_info["LOCALE_IDATE"].",".$showtime.");";
				$ret.="	$('input#ts".$iname."_".$record_id."').get(0).value =  print_datetime(newDate,-1,".$showtime.");";
				$ret.="	}";
			} else {
				$ret.='<a href="#" onclick="javascript:var v=show_calendar(\'update'.$iname.'\', \'\',\'\', $(\'input[@name=ts'.$iname.']\').get(0).value,'.$showtime.','.$sundayfirst.'); return false;">'.
					'<img src="images/cal.gif" width=16 height=16 border=0 alt="'."Click Here to Pick up the date".'"></a>';
				$ret.="<script language=\"javascript\">";
				$ret.="function update".$iname."(newDate)\r\n".
					"{ "."\r\n";
				$ret.="	$('input[@name=".$iname."]').get(0).value =  print_datetime(newDate,".$locale_info["LOCALE_IDATE"].",".$showtime.");\r\n";
				$ret.="	$('input[@name=ts".$iname."]').get(0).value =  print_datetime(newDate,-1,".$showtime.");\r\n";
				$ret.="	attr();}";
			}
			$ret.="</script>";
			echo $ret;
			return;
		case EDIT_DATE_DD_DP:
			$dp=1;
		case EDIT_DATE_DD:
			$ovalue=$value;
			if($time)
				$ovalue=format_datetime_custom($time,"yyyy-MM-dd");
			if ( $inline ) {
				$retday='<select class=selects name="day'.$iname.'" onchange="SetDate(\''.$iname.'\',\''.$record_id.'\'); return true;">'.WriteDays($time[2])."</select>";
				$retmonth='<select class=selectm name="month'.$iname.'" onchange="SetDate(\''.$iname.'\',\''.$record_id.'\'); return true;">'.WriteMonths($time[1])."</select>";
				$retyear='<select class=selects name="year'.$iname.'" onchange="SetDate(\''.$iname.'\',\''.$record_id.'\'); return true;">'.WriteYears($time[0])."</select>";
			} else {
				$retday='<select class=selects name="day'.$iname.'" onchange="javascript: SetDate'.$iname.'(); return true;">'.WriteDays($time[2])."</select>";
				$retmonth='<select class=selectm name="month'.$iname.'" onchange="javascript: SetDate'.$iname.'(); return true;">'.WriteMonths($time[1])."</select>";
				$retyear='<select class=selects name="year'.$iname.'" onchange="javascript: SetDate'.$iname.'(); return true;">'.WriteYears($time[0])."</select>";
			}
			
			$sundayfirst="false";
			if($locale_info["LOCALE_ILONGDATE"]==1)
				$ret=$retday."&nbsp;".$retmonth."&nbsp;".$retyear;
			else if($locale_info["LOCALE_ILONGDATE"]==0)
			{
				$ret=$retmonth."&nbsp;".$retday."&nbsp;".$retyear;
				$sundayfirst="true";
			}
			else
				$ret=$retyear."&nbsp;".$retmonth."&nbsp;".$retday;
				
			if($time[0] && $time[1] && $time[2])
				$ret.="<input type=hidden name=\"".$iname."\" value=\"".$time[0]."-".$time[1]."-".$time[2]."\">";
			else
				$ret.="<input type=hidden name=\"".$iname."\" value=\"\">";
			if($dp)
			{
				if($inline)
				{
					$ret.="&nbsp;".
						"<a href=\"#\" onclick=\"javascript:var v=show_calendar('update','".$iname."','".$record_id."', $('input#ts".$iname."_".$record_id."').get(0).value,false,".$sundayfirst."); return false;\">".
						"<img src=images/cal.gif width=16 height=16 border=0 alt=\""."Click Here to Pick up the date"."\"></a>".
						"<input type=hidden name=\"ts".$iname."\" value=\"".$time[2]."-".$time[1]."-".$time[0]."\">";
				}
				else{
						$ret.="&nbsp;".
						"<a href=\"#\" onclick=\"javascript:var v=show_calendar('update".$iname."','','', $('input[@name=ts".$iname."]').get(0).value,false,".$sundayfirst."); return false;\">".
						"<img src=images/cal.gif width=16 height=16 border=0 alt=\""."Click Here to Pick up the date"."\"></a>".
						"<input type=hidden name=\"ts".$iname."\" value=\"".$time[2]."-".$time[1]."-".$time[0]."\">";
					}
			}
			if($inline)
			{
				$ret.="<script language=\"javascript\">".
					"function SetDate".$iname."_".$record_id."()"."\r\n".
					"{ "."\r\n".
					"  if ( $('select#month".$iname."_".$record_id."').get(0).value!='' && $('select#day".$iname."_".$record_id."').get(0).value!='' && $('select#year".$iname."_".$record_id."').get(0).value!='') {"."\r\n".
					"	$('input#".$iname."_".$record_id."').get(0).value= ''+$('select#year".$iname."_".$record_id."').get(0).value + "."\r\n".
					" 	'-' + $('select#month".$iname."_".$record_id."').get(0).value + '-' + $('select#day".$iname."_".$record_id."').get(0).value; "."\r\n";
				if($dp)
					$ret.="   $('input#ts".$iname."_".$record_id."').get(0).value='' + $('select#day".$iname."_".$record_id."').get(0).value+'-'+$('select#month".$iname."_".$record_id."').get(0).value+'-'+$('select#year".$iname."_".$record_id."').get(0).value;"."\r\n";
				$ret.="  } else {"."\r\n";
				if($dp)
					$ret.="	$('input#ts".$iname."_".$record_id."').get(0).value= '".$time[2]."-".$time[1]."-".$time[0]."';"."\r\n";
				$ret.="	$('input#".$iname."_".$record_id."').get(0).value= '';"."\r\n".
					"   } "."\r\n".
					" } "."\r\n".
					"\r\n";
			} else {
				$ret.="<script language=\"javascript\">".
					"function SetDate".$iname."()"."\r\n".
					"{ "."\r\n".
					"  if ( $('select[@name=month".$iname."]').get(0).value!='' && $('select[@name=day".$iname."]').get(0).value!='' && $('select[@name=year".$iname."]').get(0).value!='') {"."\r\n".
					"	$('input[@name=".$iname."]').get(0).value= ''+$('select[@name=year".$iname."]').get(0).value + "."\r\n".
					" 	'-' + $('select[@name=month".$iname."]').get(0).value + '-' + $('select[@name=day".$iname."]').get(0).value; "."\r\n";
				if($dp)
					$ret.="   $('input[@name=ts".$iname."]').get(0).value='' + $('select[@name=day".$iname."]').get(0).value+'-'+$('select[@name=month".$iname."]').get(0).value+'-'+$('select[@name=year".$iname."]').get(0).value;"."\r\n";
				$ret.="  } else {"."\r\n";
				if($dp)
					$ret.="	$('input[@name=ts".$iname."]').get(0).value= '".$time[2]."-".$time[1]."-".$time[0]."';"."\r\n";
				$ret.="	$('input[@name=".$iname."]').get(0).value= '';"."\r\n".
					"   } "."\r\n".
					" } "."\r\n".
					" SetDate".$iname."(); "."\r\n".
					"\r\n";
			}
				
			if($dp) {
				if ( $inline ) {
					$ret.="	function update".$iname."_".$record_id."(newDate) "."\r\n".
					"{ "."\r\n".
					"	var dt_datetime; "."\r\n".
					" 	var curdate = new Date(); "."\r\n".
					"		dt_datetime = newDate;"."\r\n".
					"		$('input#".$iname."_".$record_id."').get(0).value =  dt_datetime.getFullYear() + '-' + (dt_datetime.getMonth()+1) + '-' + dt_datetime.getDate();"."\r\n".
					"		$('select#day".$iname."_".$record_id."').get(0).selectedIndex = dt_datetime.getDate();"."\r\n".
					"		$('select#month".$iname."_".$record_id."').get(0).selectedIndex = dt_datetime.getMonth()+1;"."\r\n".
					"		for(i=0; i<$('select#year".$iname."_".$record_id."').get(0).options.length;i++)".
					"			if($('select#year".$iname."_".$record_id."').get(0).options[i].value==dt_datetime.getFullYear())".
					"			{".
					"				$('select#year".$iname."_".$record_id."').get(0).selectedIndex=i;".
					"				break;".
					"			}".
					"  	$('input#ts".$iname."_".$record_id."').get(0).value = dt_datetime.getDate() + '-' + (dt_datetime.getMonth()+1) + '-' + dt_datetime.getFullYear();"."\r\n".
					"	}"."\r\n";
				} else {
					$ret.="	function update".$iname."(newDate) "."\r\n".
					"{ "."\r\n".
					"	var dt_datetime; "."\r\n".
					" 	var curdate = new Date(); "."\r\n".
					"		dt_datetime = newDate;"."\r\n".
					"		$('input[@name=".$iname."]').get(0).value =  dt_datetime.getFullYear() + '-' + (dt_datetime.getMonth()+1) + '-' + dt_datetime.getDate();"."\r\n".
					"		$('select[@name=day".$iname."]').get(0).selectedIndex = dt_datetime.getDate();"."\r\n".
					"		$('select[@name=month".$iname."]').get(0).selectedIndex = dt_datetime.getMonth()+1;"."\r\n".
					"		for(i=0; i<$('select[@name=year".$iname."]').get(0).options.length;i++)".
					"			if($('select[@name=year".$iname."]').get(0).options[i].value==dt_datetime.getFullYear())".
					"			{".
					"				$('select[@name=year".$iname."]').get(0).selectedIndex=i;".
					"				break;".
					"			}".
					"  	$('input[@name=ts".$iname."]').get(0).value = dt_datetime.getDate() + '-' + (dt_datetime.getMonth()+1) + '-' + dt_datetime.getFullYear();"."\r\n".
					"	attr();}"."\r\n";
				}
			}
			$ret.="</script>";
			echo $ret;
			return;
		case EDIT_DATE_SIMPLE:
		default:
			$ovalue=$value;
			if($time[0])
			{
				if($time[3] || $time[4] || $time[5])
					$ovalue=str_format_datetime($time);
				else
					$ovalue=format_shortdate($time);
			}
			echo '<input type=text name="'.$iname.'" size = "20" value="'.htmlspecialchars($ovalue).'">';
	}
}

//	create javascript array with values for dependent dropdowns
function BuildSecondDropdownArray( $arrName, $strSQL)
{
	global $conn;

	echo $arrName . "=new Array();\r\n";
	$i=0;
	$rs = db_query($strSQL,$conn);
	while($row=db_fetch_numarray($rs))
	{
		echo $arrName."[".($i*3)."]='".jsreplace($row[0]). "';\r\n";
		echo $arrName."[".($i*3 + 1)."]='".jsreplace($row[1]). "';\r\n";
		echo $arrName."[".($i*3 + 2)."]='".jsreplace($row[2]). "';\r\n";
		$i++;
	}
}

//	create Lookup wizard control
function BuildSelectControl($field, $value, $values="", $secondfield=false, $mode, $id="")
{
	global $conn,$LookupSQL,$strTableName;
	$LookupSQL ="";
	$strSize = 1;
	$cfieldname=GoodFieldName($field);
	$cfield="value_".GoodFieldName($field);
	$clookupfield="display_value_".GoodFieldName($field);
	$ctype="type_".GoodFieldName($field);
	if($secondfield)
	{
		$cfield="value1_".GoodFieldName($field);
		$ctype="type1_".GoodFieldName($field);
	}
	if($values)
		$arr=&$values;
	$addnewitem=false;
	$advancedadd=false;
	$add_page="";
	$strCategoryControl=CategoryControl($field);
	$lookuptype=LookupControlType($field);
	
	$checkBoxMode = false;
					
	if($checkBoxMode)
		echo '<div align=\'left\'>';

	$script="";
//	build SQL strings for lookup wizards
		if($strTableName=="vw_species" && $field=="Group") 
		{
			$strPerm = GetUserPermissions("tb_specgroup");
					$LinkField="Description";
			$DisplayField="Description";
			$LookupTable="tb_specgroup";
			
						$strSize=1;

			
			$LookupSQL = "select ";
						$LookupSQL .= "`tb_specgroup`.`Description`";
						
			$LookupSQL .= ",`tb_specgroup`.`Description`";
						$LookupSQL .= " from `tb_specgroup` ";
			
									
			
					}
		if($strTableName=="vw_species" && $field=="FeedHabit") 
		{
			$strPerm = GetUserPermissions("tb_specfeedhabit");
					$LinkField="Description";
			$DisplayField="Description";
			$LookupTable="tb_specfeedhabit";
			
						$strSize=1;

			
			$LookupSQL = "select ";
						$LookupSQL .= "`tb_specfeedhabit`.`Description`";
						
			$LookupSQL .= ",`tb_specfeedhabit`.`Description`";
						$LookupSQL .= " from `tb_specfeedhabit` ";
			
									
			
					}
		if($strTableName=="vw_feedspec" && $field=="Feed") 
		{
			$strPerm = GetUserPermissions("vw_feedspec");
					$LinkField="FName";
			$DisplayField="FName";
			$LookupTable="vw_feedspec";
			
						$strSize=1;

			
			$LookupSQL = "select ";
						$LookupSQL .= "distinct ";
			$LookupSQL .= "`vw_feedspec`.`FName`";
						
			$LookupSQL .= ",`vw_feedspec`.`FName`";
						$LookupSQL .= " from `vw_feedspec` ";
			
									
			
					}
		if($strTableName=="vw_feedspec" && $field=="Species Name") 
		{
			$strPerm = GetUserPermissions("vw_feedspec");
					$LinkField="SpecName";
			$DisplayField="SpecName";
			$LookupTable="vw_feedspec";
			
						$strSize=1;

			
			$LookupSQL = "select ";
						$LookupSQL .= "distinct ";
			$LookupSQL .= "`vw_feedspec`.`SpecName`";
						
			$LookupSQL .= ",`vw_feedspec`.`SpecName`";
						$LookupSQL .= " from `vw_feedspec` ";
			
									
			
					}
	if($lookuptype==LCT_LIST)
		$addnewitem=false;
	
//	prepare multi-select attributes
	$multiple="";
	$postfix="";
	if($strSize>1)
	{
		$avalue=splitvalues($value);
		$multiple=" multiple";
		$postfix="[]";
	}
	else 
		$avalue=array((string)$value);
	
	$cfieldid=$cfield;
	if($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD)
		$cfieldid.="_".$id;
	if($LookupSQL)
	{
//	ajax-lookup control
//		if ( FastType($field) )
		if ( $lookuptype==LCT_AJAX || $lookuptype==LCT_LIST )
		{
			if(UseCategory($field))
			{
//	dependent dropdown
				$clookupfieldid=$clookupfield;
				$categoryFieldId = GoodFieldName(CategoryControl($field));
				if($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD)
				{
					$clookupfieldid.="_".$id;
					$categoryFieldId.="_".$id;
				}
				if(	$lookuptype==LCT_AJAX)
					echo '<input type="text" categoryId="'.$categoryFieldId.'" autocomplete="off" id="'.$clookupfieldid.'" name="'.$clookupfield.'" onkeydown="return listenEvent(event,this,\'lookup\');" onkeyup="lookupSuggest(\''.GetTableURL().'\',event,this,\''.htmlspecialchars(jsreplace($value)).'\',\''.$id.'\');" onblur="isSetFocus=false;showHideLookupError(this);" onfocus="isSetFocus=true;" >';
				elseif(	$lookuptype==LCT_LIST)
					echo '<input type="text" categoryId="'.$categoryFieldId.'" autocomplete="off" id="'.$clookupfieldid.'" name="'.$clookupfield.'"  readonly >';
				$onchange="";
		   		if($onchange)
					$onchange="onchange=\"".$onchange."\"";
				echo '<input type="hidden" id="'.$cfieldid.'" name="'.$cfield.'" '.$onchange.'>';
			//	add new item
				if($mode!=MODE_SEARCH && $addnewitem || $lookuptype==LCT_LIST)
				{
					if($mode!=MODE_INLINE_EDIT && $mode!=MODE_INLINE_ADD)
					{
						$celement="document.forms.editform.value_".GoodFieldName($strCategoryControl);
						$extra="";
					}
					else
					{
						$celement="document.getElementById('value_".GoodFieldName($strCategoryControl)."_".$id."')";
						$extra="&mode=".$mode."&id=value_".GoodFieldName($field)."_".$id;
					}
					$celementvalue = '$('.$celement.").val()";
					if($addnewitem)
					{
						if(!$advancedadd)
						{
							echo "<a href=# onclick=\"window.open('vw_antinutritional_addnewitem.php?".
							"field=".htmlspecialchars(jsreplace(rawurlencode($field))).$extra.
							"&category='+escape(".$celementvalue.")".
							",\r\n".
							"'AddNewItem', 'width=250,height=100,status=no,resizable=yes,top=200,left=200');\">\r\n".
							"Add new"."</a>";
						}
						else
						{
							echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$add_page."','".$cfieldid."','".GoodFieldName($field)."','".GetTableURL()."',".$celementvalue.");\">"."Add new"."</a>";
						}
					}
					if($lookuptype==LCT_LIST)
					{
							echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$list_page."','".$cfieldid."','".GoodFieldName($field)."','".GetTableURL()."',".$celementvalue.");\">"."Select"."</a>";
					}
				}
				
				if($checkBoxMode)
					echo '</div>';
				return;
//	fasttype - dependent - end
			}
//	fasttype - regular - start
//	get the initial value
			$lookup_SQL = "";
			$lookup_value = "";
			
			if($strTableName=="vw_species" && $field=="Group") 
			{
								$lookup_SQL = "SELECT ";
								$lookup_SQL .= "`tb_specgroup`.`Description`";
								$lookup_SQL .= ",`tb_specgroup`.`Description`";
				$lookup_SQL .= " FROM `tb_specgroup` ";
								$lookup_SQL .= " WHERE `tb_specgroup`.`Description`=".make_db_value($field,$value)."";
										}
			if($strTableName=="vw_species" && $field=="FeedHabit") 
			{
								$lookup_SQL = "SELECT ";
								$lookup_SQL .= "`tb_specfeedhabit`.`Description`";
								$lookup_SQL .= ",`tb_specfeedhabit`.`Description`";
				$lookup_SQL .= " FROM `tb_specfeedhabit` ";
								$lookup_SQL .= " WHERE `tb_specfeedhabit`.`Description`=".make_db_value($field,$value)."";
										}
			if($strTableName=="vw_feedspec" && $field=="Feed") 
			{
								$lookup_SQL = "SELECT ";
								$lookup_SQL .= "DISTINCT ";
				$lookup_SQL .= "`vw_feedspec`.`FName`";
								$lookup_SQL .= ",`vw_feedspec`.`FName`";
				$lookup_SQL .= " FROM `vw_feedspec` ";
								$lookup_SQL .= " WHERE `vw_feedspec`.`FName`=".make_db_value($field,$value)."";
										}
			if($strTableName=="vw_feedspec" && $field=="Species Name") 
			{
								$lookup_SQL = "SELECT ";
								$lookup_SQL .= "DISTINCT ";
				$lookup_SQL .= "`vw_feedspec`.`SpecName`";
								$lookup_SQL .= ",`vw_feedspec`.`SpecName`";
				$lookup_SQL .= " FROM `vw_feedspec` ";
								$lookup_SQL .= " WHERE `vw_feedspec`.`SpecName`=".make_db_value($field,$value)."";
										}
			
			$rs_lookup=db_query($lookup_SQL,$conn);
	
			if ( $data = db_fetch_numarray($rs_lookup) ) 
			{	
				$lookup_value = $data[1];
			} 
			else
			{
				if($strTableName=="vw_species" && $field=="Group") 
				{
										$lookup_SQL = "SELECT ";
										$lookup_SQL .= "`tb_specgroup`.`Description`";
										$lookup_SQL .= ",`tb_specgroup`.`Description`";
					$lookup_SQL .= " FROM `tb_specgroup` ";
					$lookup_SQL .= " WHERE `tb_specgroup`.`Description`=".make_db_value($field,$value)."";
				// in access order by conflicts with unique
									}
				if($strTableName=="vw_species" && $field=="FeedHabit") 
				{
										$lookup_SQL = "SELECT ";
										$lookup_SQL .= "`tb_specfeedhabit`.`Description`";
										$lookup_SQL .= ",`tb_specfeedhabit`.`Description`";
					$lookup_SQL .= " FROM `tb_specfeedhabit` ";
					$lookup_SQL .= " WHERE `tb_specfeedhabit`.`Description`=".make_db_value($field,$value)."";
				// in access order by conflicts with unique
									}
				if($strTableName=="vw_feedspec" && $field=="Feed") 
				{
										$lookup_SQL = "SELECT ";
										$lookup_SQL .= "DISTINCT ";
					$lookup_SQL .= "`vw_feedspec`.`FName`";
										$lookup_SQL .= ",`vw_feedspec`.`FName`";
					$lookup_SQL .= " FROM `vw_feedspec` ";
					$lookup_SQL .= " WHERE `vw_feedspec`.`FName`=".make_db_value($field,$value)."";
				// in access order by conflicts with unique
									}
				if($strTableName=="vw_feedspec" && $field=="Species Name") 
				{
										$lookup_SQL = "SELECT ";
										$lookup_SQL .= "DISTINCT ";
					$lookup_SQL .= "`vw_feedspec`.`SpecName`";
										$lookup_SQL .= ",`vw_feedspec`.`SpecName`";
					$lookup_SQL .= " FROM `vw_feedspec` ";
					$lookup_SQL .= " WHERE `vw_feedspec`.`SpecName`=".make_db_value($field,$value)."";
				// in access order by conflicts with unique
									}
			
				$rs_lookup=db_query($lookup_SQL,$conn);			
				
				if($data = db_fetch_numarray($rs_lookup))
					$lookup_value = $data[1];
			}
//	build the control
			$clookupfieldid=$clookupfield;
			if($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD)
				$clookupfieldid.="_".$id;
			
			
			if($lookuptype==LCT_AJAX)
				echo '<input type="text" autocomplete="off" id="'.$clookupfieldid.'" name="'.$clookupfield.'" value="'.htmlspecialchars($lookup_value).'" 	onkeydown="return listenEvent( event,this,\'lookup\');" onkeyup="lookupSuggest(\''.GetTableURL().'\',event,this,\''.htmlspecialchars(jsreplace($value)).'\',\''.$id.'\');" onblur="isSetFocus=false;showHideLookupError(this);" onfocus="isSetFocus=true;" >';
			elseif($lookuptype==LCT_LIST)
				echo '<input type="text" autocomplete="off" id="'.$clookupfieldid.'" name="'.$clookupfield.'" value="'.htmlspecialchars($lookup_value).'" 	readonly >';
			$onchange="";
	   		if($onchange)
				$onchange="onchange=\"".$onchange."\"";
			
			echo '<input type="hidden" id="'.$cfieldid.'" name="'.$cfield.'" value="'.htmlspecialchars($value).'" '.$onchange.'>';
			//	add new item
			if($addnewitem &&  $mode!=MODE_SEARCH)
			{
				if(!$advancedadd)
				{
					$extra="";
					if( $mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD )
						$extra="&mode=".$mode."&id=value_".GoodFieldName($field)."_".$id;
					echo "<a href=# onclick=\"window.open('".GetTableURL($strTableName)."_addnewitem.php?field=".htmlspecialchars(jsreplace(rawurlencode($field))).$extra."',\r\n".
					"'AddNewItem', 'width=250,height=100,status=no,resizable=yes,top=200,left=200');\">\r\n".
					"Add new"."</a>";
				}
				else
				{
					if( $mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD )
						echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$add_page."','value_".GoodFieldName($field)."_".$id."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Add new"."</a>";
					else
						echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$add_page."','value_".GoodFieldName($field)."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Add new"."</a>";
				}
			}
			if($lookuptype==LCT_LIST)
			{
				if( $mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD )
					echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$list_page."','value_".GoodFieldName($field)."_".$id."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Select"."</a>";
				else
					echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$list_page."','value_".GoodFieldName($field)."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Select"."</a>";
			}
//	fasttype - regular - end
//	fasttype - end
		}
		else
		{
//	classic dropdown - start
			LogInfo($LookupSQL);
			$rs=db_query($LookupSQL,$conn);
			$onchange="";
	   		if($onchange)
				$onchange="onchange=\"".$onchange."\"";
				//	print Type control to allow selecting nothing
			if($multiple!="")
				echo "<input type=hidden name=\"".$ctype."\" value=\"multiselect\">";
				
			if($strTableName=="vw_species" && $field=="Group") 
			{
					   	  		echo '<select size = "'.$strSize.'" id="'.$cfield.'" name="'.$cfield.$postfix.'"'.$multiple.' '.$onchange.'>';
				if($strSize<2)
					echo '<option value="">'."Please select".'</option>';
				else if($mode==MODE_SEARCH)
					echo '<option value=""> </option>';
			}
			if($strTableName=="vw_species" && $field=="FeedHabit") 
			{
					   	  		echo '<select size = "'.$strSize.'" id="'.$cfield.'" name="'.$cfield.$postfix.'"'.$multiple.' '.$onchange.'>';
				if($strSize<2)
					echo '<option value="">'."Please select".'</option>';
				else if($mode==MODE_SEARCH)
					echo '<option value=""> </option>';
			}
			if($strTableName=="vw_feedspec" && $field=="Feed") 
			{
					   	  		echo '<select size = "'.$strSize.'" id="'.$cfield.'" name="'.$cfield.$postfix.'"'.$multiple.' '.$onchange.'>';
				if($strSize<2)
					echo '<option value="">'."Please select".'</option>';
				else if($mode==MODE_SEARCH)
					echo '<option value=""> </option>';
			}
			if($strTableName=="vw_feedspec" && $field=="Species Name") 
			{
					   	  		echo '<select size = "'.$strSize.'" id="'.$cfield.'" name="'.$cfield.$postfix.'"'.$multiple.' '.$onchange.'>';
				if($strSize<2)
					echo '<option value="">'."Please select".'</option>';
				else if($mode==MODE_SEARCH)
					echo '<option value=""> </option>';
			}

		      	$found=false;
			while($data=db_fetch_numarray($rs))
			{
				$res=array_search((string)$data[0],$avalue);
				if(!($res===NULL || $res===FALSE))
				{
					$found=true;
					if($checkBoxMode)
					{
						echo '<input type="checkbox" name="'.$cfield.$postfix.'" value="'.htmlspecialchars($data[0]).'" checked="checked"/>';
						echo '&nbsp;'.htmlspecialchars($data[1]).'<br/>';
					}
					else
						echo '<option value="'.htmlspecialchars($data[0]).'" selected>'.htmlspecialchars($data[1]).'</option>';
				}
				else
				{
					if($checkBoxMode)
					{
						echo '<input type="checkbox" name="'.$cfield.$postfix.'" value="'.htmlspecialchars($data[0]).'"/>';
					echo '&nbsp;'.htmlspecialchars($data[1]).'<br/>';
					}
					else
						echo '<option value="'.htmlspecialchars($data[0]).'">'.htmlspecialchars($data[1]).'</option>';
				}
			}
			if(!$checkBoxMode)
				echo "</select>";
				
//	add new item
			if($addnewitem &&  $mode!=MODE_SEARCH && $mode!=MODE_INLINE_EDIT && $mode!=MODE_INLINE_ADD)
			{
				if(!$advancedadd)
				{
					echo "<a href=# onclick=\"window.open('".GetTableURL($strTableName)."_addnewitem.php?field=".htmlspecialchars(jsreplace(rawurlencode($field)))."',\r\n".
					"'AddNewItem', 'width=250,height=100,status=no,resizable=yes,top=200,left=200');\">\r\n".
					"Add new"."</a>";
				}
				else
				{
					echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$add_page."','".htmlspecialchars(jsreplace($cfield))."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Add new"."</a>";
				}
			}
			if($addnewitem &&  $mode!=MODE_SEARCH &&  ($mode==MODE_INLINE_EDIT || $mode==MODE_INLINE_ADD))
			{
				if(!$advancedadd)
				{
					echo "<a href=# onclick=\"window.open('".GetTableURL($strTableName)."_addnewitem.php?field=".htmlspecialchars(jsreplace(rawurlencode($field)))."&mode=".$mode."&id=value_".GoodFieldName($field)."_".$id."',\r\n".
					"'AddNewItem', 'width=250,height=100,status=no,resizable=yes,top=200,left=200');\">\r\n".
					"Add new"."</a>";
				}
				else
				{
					echo "&nbsp;<a href=# onclick=\"return DisplayPage(event,'".$add_page."','value_".GoodFieldName($field)."_".$id."','".GoodFieldName($field)."','".GetTableURL()."','');\">"."Add new"."</a>";
				}
			}
		}
	}
	else
	{
		//	print Type control to allow selecting nothing
		if($multiple!="")
			echo "<input type=hidden name=\"".$ctype."\" value=\"multiselect\">";
		if($strTableName=="vw_species" && $field=="Group") 
		{
						echo '<select size = "'.$strSize.'" name="'.$cfield.$postfix.'" '.$multiple.'>';
			if($strSize<2 )
				echo '<option value="">'."Please select".'</option>';
			else if($mode==MODE_SEARCH)
				echo '<option value=""> </option>';
				
			foreach($arr as $opt)
			{
				$res=array_search((string)$opt,$avalue);
				if(!($res===NULL || $res===FALSE))
		      			echo '<option value="'.htmlspecialchars($opt).'" selected>'.htmlspecialchars($opt).'</option>';
				else
		      			echo '<option value="'.htmlspecialchars($opt).'">'.htmlspecialchars($opt).'</option>';
			}
			echo "</select>";
		}
		if($strTableName=="vw_species" && $field=="FeedHabit") 
		{
						echo '<select size = "'.$strSize.'" name="'.$cfield.$postfix.'" '.$multiple.'>';
			if($strSize<2 )
				echo '<option value="">'."Please select".'</option>';
			else if($mode==MODE_SEARCH)
				echo '<option value=""> </option>';
				
			foreach($arr as $opt)
			{
				$res=array_search((string)$opt,$avalue);
				if(!($res===NULL || $res===FALSE))
		      			echo '<option value="'.htmlspecialchars($opt).'" selected>'.htmlspecialchars($opt).'</option>';
				else
		      			echo '<option value="'.htmlspecialchars($opt).'">'.htmlspecialchars($opt).'</option>';
			}
			echo "</select>";
		}
		if($strTableName=="vw_feedspec" && $field=="Feed") 
		{
						echo '<select size = "'.$strSize.'" name="'.$cfield.$postfix.'" '.$multiple.'>';
			if($strSize<2 )
				echo '<option value="">'."Please select".'</option>';
			else if($mode==MODE_SEARCH)
				echo '<option value=""> </option>';
				
			foreach($arr as $opt)
			{
				$res=array_search((string)$opt,$avalue);
				if(!($res===NULL || $res===FALSE))
		      			echo '<option value="'.htmlspecialchars($opt).'" selected>'.htmlspecialchars($opt).'</option>';
				else
		      			echo '<option value="'.htmlspecialchars($opt).'">'.htmlspecialchars($opt).'</option>';
			}
			echo "</select>";
		}
		if($strTableName=="vw_feedspec" && $field=="Species Name") 
		{
						echo '<select size = "'.$strSize.'" name="'.$cfield.$postfix.'" '.$multiple.'>';
			if($strSize<2 )
				echo '<option value="">'."Please select".'</option>';
			else if($mode==MODE_SEARCH)
				echo '<option value=""> </option>';
				
			foreach($arr as $opt)
			{
				$res=array_search((string)$opt,$avalue);
				if(!($res===NULL || $res===FALSE))
		      			echo '<option value="'.htmlspecialchars($opt).'" selected>'.htmlspecialchars($opt).'</option>';
				else
		      			echo '<option value="'.htmlspecialchars($opt).'">'.htmlspecialchars($opt).'</option>';
			}
			echo "</select>";
		}
	}
	if($checkBoxMode)
		echo '</div>';
	return;
}

function BuildRadioControl($field, $value,$secondfield=false,$id="")
{
	global $conn,$LookupSQL,$strTableName;
	$cfieldname=GoodFieldName($field);
	$cfield="value_".GoodFieldName($field);
	$cfieldid="value_".GoodFieldName($field);
	$ctype="type_".GoodFieldName($field);
	if($id<>"")
	{
		$cfieldname.="_".$id;
		$cfieldid.="_".$id;
	}
	if($secondfield)
	{
		$cfield="value1_".GoodFieldName($field);
		$ctype="type1_".GoodFieldName($field);
	}
	$LookupSQL ="";
	$spacer = '<br/>';

	if($LookupSQL)
	{
	    LogInfo($LookupSQL);
		$rs=db_query($LookupSQL,$conn);
		echo '<input type=hidden name="'.$cfield.'" value="'.htmlspecialchars($value).'" id="'.$cfieldid.'">';
	    while($data=db_fetch_numarray($rs))
		{
			$checked="";
			if($data[0]==$value)
				$checked=" checked";
			echo "<input type=\"Radio\" name=\"radio_".$cfieldname."\" onclick=\"javascript: $('#".$cfieldid."')[0].value='".htmlspecialchars($data[0])."'; return true;\" ".$checked.">".htmlspecialchars($data[1]).$spacer;
		}
	}
	else
	{
		echo '<input type=hidden name="'.$cfield.'" value="'.htmlspecialchars($value).'" id="'.$cfieldid.'">';
		foreach($arr as $opt)
		{
			$checked="";
			if($opt==$value)
				$checked=" checked";
			echo "<input type=\"Radio\" name=\"radio_".$cfieldname."\" onclick=\"javascript: $('#".$cfieldid."')[0].value='".htmlspecialchars($opt)."'; return true;\" ".$checked.">".htmlspecialchars($opt).$spacer;
//			echo '<input type="Radio" name="radio_'.$cfieldname.'" onclick="javascript: $("#'.$cfield."\")[0].value='".db_addslashes($opt).'\'; return true;" '.$checked.'>'.htmlspecialchars($opt)."<br>";
		}
	}
	return;

}

function BuildEditControl($field , $value, $format, $edit, $secondfield=false, $id="")
{
	global $rs,$data,$strTableName,$filenamelist,$keys,$locale_info,$jscode;
	$cfieldname=GoodFieldName($field);
	$cfield="value_".GoodFieldName($field);
	$ctype="type_".GoodFieldName($field);
	if($secondfield)
	{
		$cfield="value1_".GoodFieldName($field);
		$ctype="type1_".GoodFieldName($field);
	}
	$cfieldid=$cfield;
	if($edit==MODE_INLINE_EDIT || $edit==MODE_INLINE_ADD)
		$cfieldid.="_".$id;
	$type=GetFieldType($field);
	$arr="";

	$iquery="field=".rawurlencode($field);
	$keylink="";
	if($strTableName=="vw_antinutritional")
	{
		$keylink.="&key1=".rawurlencode(@$keys["IngredientID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_digestibility")
	{
		$keylink.="&key1=".rawurlencode(@$keys["IngredientID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="users")
	{
		$keylink.="&key1=".rawurlencode(@$keys["ID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_species")
	{
		$keylink.="&key1=".rawurlencode(@$keys["SpeciesID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_feedspec")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_feedanalysis")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_feedingredient")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_ingredient")
	{
		$keylink.="&key1=".rawurlencode(@$keys["IngredientID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_feed")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_fullingredientelementanalysis")
	{
		$keylink.="&key1=".rawurlencode(@$keys["IngredientID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_fullingredientproxanalysis")
	{
		$keylink.="&key1=".rawurlencode(@$keys["IngredientID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_fullfeedproxanalysis")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($strTableName=="vw_fullfeedelementanalysis")
	{
		$keylink.="&key1=".rawurlencode(@$keys["FeedID"]);
		$iquery.=$keylink;
	}
	if($format==EDIT_FORMAT_FILE && $edit==MODE_SEARCH)
		$format="";
	if($format==EDIT_FORMAT_TEXT_FIELD)
	{
		if(IsDateFieldType($type))
			echo '<input type="hidden" name="'.$ctype.'" value="date'.EDIT_DATE_SIMPLE.'">'.GetDateEdit($field,$value,0,$secondfield,$edit,$id);
		else
	    {
			if($edit==MODE_SEARCH)
				echo '<input type="text" autocomplete="off" name="'.$cfield.'" '.GetEditParams($field).' value="'.htmlspecialchars($value).'">';
			else
				echo '<input type="text" name="'.$cfield.'" '.GetEditParams($field).' value="'.htmlspecialchars($value).'">';
		}
	}
	else if($format==EDIT_FORMAT_TIME)
	{
		echo '<input type="hidden" name="'.$ctype.'" value="time">';
	}
	else if($format==EDIT_FORMAT_TEXT_AREA)
	{
	
		$nWidth = GetNCols($field);
		$nHeight = GetNRows($field);
		if(UseRTE($field))
		{
			$value = RTESafe($value);
						if($id!='')
				$cfield.="_".$id;
			$browser="";
			if(@$_REQUEST["browser"]=="ie")
				$browser="&browser=ie";
			echo "<iframe frameborder=\"0\" vspace=\"0\" hspace=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\" id=\"".$cfield."\" name=\"".$cfield."\" style='width: " . ($nWidth+1) . "px;height: " . ($nHeight+1) . "px;border:1px solid black;'";
			echo " src=\"".GetTableURL($strTableName)."_rte.php?".($edit==MODE_INLINE_EDIT || $edit==MODE_INLINE_ADD ? "id=".$id ."&": '').$iquery.$browser."\">";
			echo "</iframe>";
								}
		else
			echo '<textarea name="'.$cfield.'" style="width: ' . $nWidth . 'px;height: ' . $nHeight . 'px;">'.htmlspecialchars($value).'</textarea>';
	}
	else if($format==EDIT_FORMAT_PASSWORD)
		echo '<input type="Password" name="'.$cfield.'" '.GetEditParams($field).' value="'.htmlspecialchars($value).'">';
	else if($format==EDIT_FORMAT_DATE)
		echo '<input type="hidden" name="'.$ctype.'" value="date'.DateEditType($field).'">'.GetDateEdit($field,$value,DateEditType($field),$secondfield,$edit,$id);
	else if($format==EDIT_FORMAT_RADIO)
		BuildRadioControl($field,$value,$secondfield,$id);
	else if($format==EDIT_FORMAT_CHECKBOX)
	{
		if($edit==MODE_ADD || $edit==MODE_INLINE_ADD || $edit==MODE_EDIT || $edit==MODE_INLINE_EDIT)
		{
			$checked="";
			if($value && $value!=0)
				$checked=" checked";
			echo '<input type="hidden" name="'.$ctype.'" value="checkbox"><input type="Checkbox" name="'.$cfield.'" '.$checked.'>';
		}
		else
		{
			echo '<input type="hidden" name="'.$ctype.'" value="checkbox">';
			echo '<select name="'.$cfield.'">';
			$val=array("none","on","off");
			$show=array("","True","False");
			foreach($val as $i=>$v)
			{
				$sel="";
				if($value===$v)
					$sel=" selected";
				echo '<option value="'.$v.'"'.$sel.'>'.$show[$i].'</option>';
			}
			echo "</select>";
		}
	}
	else if($format==EDIT_FORMAT_DATABASE_IMAGE || $format==EDIT_FORMAT_DATABASE_FILE)
	{
		$disp="";
		$strfilename="";
		$onchangefile="";
		if($edit==MODE_EDIT || $edit==MODE_INLINE_EDIT)
		{
			if($id<>"")
				$ctype.="_".$id;
			$value=db_stripslashesbinary($value);
			$itype=SupposeImageType($value);
			$thumbnailed=false;
			$thumbfield="";

			if($itype)
			{
				if($thumbnailed)
				{
					$disp="<a target=_blank href=\"".GetTableURL($strTableName)."_imager.php?".$iquery."\">";
					$disp.= "<img name=\"".$cfield."\" border=0";
					$disp.=" src=\"".GetTableURL($strTableName)."_imager.php?field=".rawurlencode($thumbfield)."&alt=".rawurlencode($field).$keylink."\">";
					$disp.= "</a>";
				}
				else
					$disp='<img name="'.$cfield.'" border=0 src="'.GetTableURL($strTableName).'_imager.php?'.$iquery.'">';
			}
			else
			{
				if(strlen($value))
					$disp='<img name="'.$cfield.'" border=0 src="images/file.gif">';
				else
					$disp='<img name="'.$cfield.'" border=0 src="images/no_image.gif">';
			}
//	filename
			if($format==EDIT_FORMAT_DATABASE_FILE && !$itype && strlen($value))
			{
				if(!($filename=@$data[GetFilenameField($field)]))
					$filename="file.bin";
				$disp='<a href="'.GetTableURL($strTableName).'_getfile.php?filename='.htmlspecialchars($filename).'&'.$iquery.'".>'.$disp.'</a>';
			}
//	filename edit
			if($format==EDIT_FORMAT_DATABASE_FILE && GetFilenameField($field))
			{
				if(!($filename=@$data[GetFilenameField($field)]))
					$filename="";
				if($edit==MODE_INLINE_EDIT)
				{
					$strfilename='<br>'."Filename".'&nbsp;&nbsp;<input id="filename_'.$cfieldname.'_'.$id.'" name="filename_'.$cfieldname.'" size="20" maxlength="50" value="'.htmlspecialchars($filename).'">';
					$onchangefile.="var path=$('#".$cfield."_".$id."').val(); var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; $('#filename_".$cfieldname."_".$id."').val(path.substr(pos+1));";
				}
				else
				{
					$strfilename='<br>'."Filename".'&nbsp;&nbsp;<input name="filename_'.$cfieldname.'" size="20" maxlength="50" value="'.htmlspecialchars($filename).'">';
					$onchangefile.="var path=this.form.elements['".jsreplace($cfield)."'].value; var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; this.form.elements['filename_".jsreplace($cfieldname)."'].value=path.substr(pos+1);";
				}
			}
			$strtype='<br><input type="Radio" name="'.$ctype.'" value="file0" checked>'."Keep";
			if(strlen($value) && !IsRequired($field))
			{
				$strtype.='<input type="Radio" name="'.$ctype.'" value="file1">'."Delete";
				if ($edit==MODE_INLINE_EDIT ) {
					$onchangefile.='$(\'input[@type=radio][@value=file2][@name='.$ctype.']\').get(0).checked=true;';
				} else {				
					$onchangefile.='this.form.elements[\''.jsreplace($ctype).'\'][2].checked=true;';
				}
			}
			else {
				if ($edit==MODE_INLINE_EDIT) {
					$onchangefile.='$(\'input[@type=radio][@value=file2][@name='.$ctype.']\').get(0).checked=true;';
				} else {			
					$onchangefile.='this.form.elements[\''.jsreplace($ctype).'\'][1].checked=true;';
				}
			}
			
			$strtype.='<input type="Radio" name="'.$ctype.'" value="file2">'."Update";
		}
		else
		{
//	if Add mode
			$strtype='<input type="hidden" name="'.$ctype.'" value="file2">';
			if($format==EDIT_FORMAT_DATABASE_FILE && GetFilenameField($field))
			{
				$strfilename='<br>'."Filename".'&nbsp;&nbsp;<input name="filename_'.$cfieldname.'" size="20" maxlength="50">';
				if($edit==MODE_INLINE_ADD)
					$onchangefile.="var path=$('#".$cfield."_".$id."').val(); var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; $('#filename_".$cfieldname."_".$id."').val(path.substr(pos+1));";
				else
					$onchangefile.="var path=this.form.elements['".jsreplace($cfield)."'].value; var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; this.form.elements['filename_".jsreplace($cfieldname)."'].value=path.substr(pos+1);";
			}
		}
		if($onchangefile)
			$onchangefile='onChange="'.$onchangefile.'"';
		if($edit==MODE_INLINE_EDIT && $format==EDIT_FORMAT_DATABASE_FILE)
			$disp="";
		echo $disp.$strtype.'<br><input type="File" id="'.$cfield."_".$id.'" name="'.$cfield.'" '.$onchangefile.'>'.$strfilename;
	}
	else if($format==EDIT_FORMAT_LOOKUP_WIZARD)
			BuildSelectControl($field, $value, $arr, $secondfield, $edit,$id);
	else if($format==EDIT_FORMAT_HIDDEN)
			echo '<input type="Hidden" name="'.$cfield.'" value="'.htmlspecialchars($value).'">';
	else if($format==EDIT_FORMAT_READONLY)
			echo '<input type="Hidden" name="'.$cfield.'" value="'.htmlspecialchars($value).'">';
	else if($format==EDIT_FORMAT_FILE)
	{
		$disp="";
		$strfilename="";
		$onchangefile="";
		$function="";
		if($edit==MODE_EDIT || $edit==MODE_INLINE_EDIT)
		{
//	show current file
			if($id<>"")
				$ctype.="_".$id;
			if(ViewFormat($field)==FORMAT_FILE || ViewFormat($field)==FORMAT_FILE_IMAGE)
			{
				$disp=GetData($data,$field,ViewFormat($field))."<br>";
			}
			$filename=$value;
			if($edit != MODE_INLINE_EDIT)
			{
				$function .=
				'<script language=\'javascript\'>'.
				'function controlfilename'.$cfieldname.'(enable)
				{
					if(enable)
					{
						document.forms.editform.'.$cfield.'.style.backgroundColor="white";
						document.forms.editform.'.$cfield.'.disabled=false;
					}
					else
					{
						document.forms.editform.'.$cfield.'.style.backgroundColor="gainsboro";
						document.forms.editform.'.$cfield.'.disabled=true;
					}
				}'.
				'</script>';
			}
//	filename edit
			$filename_size=30;
			if(UseTimestamp($field))
				$filename_size=50;
			$strfilename='<input type=hidden name="filename_'.$cfieldname.'" value="'.htmlspecialchars($filename).'"><br>'."Filename".'&nbsp;&nbsp;<input style="background-color:gainsboro" disabled id="'.$cfield.'_'.$id.'" name="'.$cfield.'" size="'.$filename_size.'" maxlength="100" value="'.htmlspecialchars($filename).'">';
			if ( $edit==MODE_INLINE_EDIT ) {
				$onchangefile.="var path=$('[@id=file_".$cfieldname."_".$id."]').val(); var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; $('#".$cfield."_".$id."').css('backgroundColor','white');$('#".$cfield."_".$id."')[0].disabled=false;";
				if(UseTimestamp($field))
					$onchangefile.="$('[@id=".$cfield."_".$id."]').val(addTimestamp(path.substr(pos+1))); ";
				else
					$onchangefile.="$('[@id=".$cfield."_".$id."]').val(path.substr(pos+1)); ";
				$strtype='<br><input type="Radio" name="'.$ctype.'" value="upload0" checked onclick="$(\'[@id='.$cfield.'_'.$id.']\').css(\'backgroundColor\',\'gainsboro\');$(\'[@id='.$cfield.'_'.$id.']\')[0].disabled=true;">'."Keep";
			} else {
				$onchangefile.="var path=this.form.file_".$cfieldname.".value; var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos; controlfilename".$cfieldname."(true);";
				if(UseTimestamp($field))
					$onchangefile.="this.form.".$cfield.".value=addTimestamp(path.substr(pos+1)); ";
				else
					$onchangefile.="this.form.".$cfield.".value=path.substr(pos+1); ";
				$strtype='<br><input type="Radio" name="'.$ctype.'" value="upload0" checked onclick="controlfilename'.$cfieldname.'(false)">'."Keep";
			}


			if(strlen($value) && !IsRequired($field))
			{
				if ($edit==MODE_INLINE_EDIT) {
					$strtype.='<input type="Radio" name="'.$ctype.'" value="upload1" onclick="$(\'[@id='.$cfield.'_'.$id.']\').css(\'backgroundColor\',\'gainsboro\');$(\'[@id='.$cfield.'_'.$id.']\')[0].disabled=true;">'."Delete";
					$onchangefile.='$(\'input[@type=radio][@value=upload2][@name='.$ctype.']\').get(0).checked=true;';
				} else {
					$strtype.='<input type="Radio" name="'.$ctype.'" value="upload1" onclick="controlfilename'.$cfieldname.'(false)">'."Delete";
					$onchangefile.='this.form.'.$ctype.'[2].checked=true;';
				}
			}
			else {
				if ($edit==MODE_INLINE_EDIT) {
					$onchangefile.='$(\'input[@type=radio][@value=upload2][@name='.$ctype.']\').get(0).checked=true;';
				} else {			
					$onchangefile.='this.form.'.$ctype.'[1].checked=true;';
				}
			}
			if ($edit==MODE_INLINE_EDIT) {
				$strtype.='<input type="Radio" name="'.$ctype.'" value="upload2" onclick="$(\'[@id='.$cfield.'_'.$id.']\').css(\'backgroundColor\',\'white\');$(\'[@id='.$cfield.'_'.$id.']\')[0].disabled=false;">'."Update";
			} else {
				$strtype.='<input type="Radio" name="'.$ctype.'" value="upload2" onclick="controlfilename'.$cfieldname.'(true)">'."Update";
			}
		}
		else
		{
//	if Adding record		
			$filename_size=30;
			if(UseTimestamp($field))
				$filename_size=50;
			$strtype='<input type="hidden" name="'.$ctype.'" value="upload2">';
			$strfilename='<br>'."Filename".'&nbsp;&nbsp;<input name="'.$cfield.'" size="'.$filename_size.'" maxlength="100">';
			if($edit==MODE_INLINE_ADD)
			{
				$onchangefile.="var path=$('[@id=file_".$cfieldname."_".$id."]').val(); var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos;";
				if(UseTimestamp($field))
					$onchangefile.=" $('[@id=".$cfield."_".$id."]').val(addTimestamp(path.substr(pos+1)));";
				else
					$onchangefile.=" $('[@id=".$cfield."_".$id."]').val(path.substr(pos+1));";
			}
			else
			{
				$onchangefile.="var path=this.form.file_".$cfieldname.".value; var wpos=path.lastIndexOf('\\\\'); var upos=path.lastIndexOf('/'); var pos=wpos; if(upos>wpos) pos=upos;";
				if(UseTimestamp($field))
					$onchangefile.=" this.form.".$cfield.".value=addTimestamp(path.substr(pos+1));";
				else
					$onchangefile.=" this.form.".$cfield.".value=path.substr(pos+1);";
			}
		}
		if($onchangefile)
			$onchangefile='onChange="'.$onchangefile.'"';
		echo $disp.$strtype.$function.'<br><input type="File" id="file_'.$cfieldname.'" name="file_'.$cfieldname.'" '.$onchangefile.'>'.$strfilename;
	}
}
function my_stripos($str,$needle, $offest)
{
    if (strlen($needle)==0 || strlen($str)==0)
		return false;
	return strpos(strtolower($str),strtolower($needle), $offest);
} 

function my_str_ireplace($search, $replace,$str)
{
    $pos=my_stripos($str,$search,0);
	if($pos===false)
		return $str;
	return substr($str,0,$pos).$replace.substr($str,$pos+strlen($search));
} 


function in_assoc_array($name, $arr)
{
foreach ($arr as $key => $value) 
	if ($key==$name)
		return true;

return false;
}

function loadSelectContent($field, $value,$fvalue="")
{
	global $conn,$LookupSQL,$strTableName;
	
	$Lookup = "";
	$response = array();
	$output = "";

	$rs=db_query($LookupSQL,$conn);

	if(!FastType($field))
	{
		while ($data = db_fetch_numarray($rs)) 
		{
			$response[] = $data[0];
			$response[] = $data[1];
		}
	}
	else
	{
		$data=db_fetch_numarray($rs);
//	one record only
		if($data && (strlen($fvalue) || !db_fetch_numarray($rs)))
		{
			$response[] = $data[0];
			$response[] = $data[1];
		}
	}
	return $response;
}

function xmlencode($str)
{

	$str = str_replace("&","&amp;",$str);
	$str = str_replace("<","&lt;",$str);
	$str = str_replace(">","&gt;",$str);

	$out="";
	$len=strlen($str);
	$ind=0;
	for($i=0;$i<$len;$i++)
	{
		if(ord(substr($str,$i,1))>=128)
		{
			if($ind<$i)
				$out.=substr($str,$ind,$i-$ind);
			$out.="&#".ord(substr($str,$i,1)).";";
			$ind=$i+1;
		}
	}
	if($ind<$len)
		$out.=substr($str,$ind);
	return str_replace("'","&apos;",$out);

}

function print_inline_array(&$arr,$printkey=false)
{
	if(!$printkey)
	{
		foreach ( $arr as $key=>$val )
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$val))."\\n";
	}
	else
	{
		foreach( $arr as $key=>$val )
			echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$key))."\\n";
	}
		
}


function GetChartXML($chartname)
{


}

//For add script code to function postloadstep, that performed after loading all files
function AddScript2Postload($code,$id="")
{
	echo "<script  language='javascript'>
			$(document).ready(function()
			{ 
				AddScript2Postload(function(){".$code."}, ".($id ? $id : "''").");
			});
		 </script>";
}

function AddCSSFile($file)
{
	global $includes_css;
	$includes_css[]=$file;
}

function AddJSFile($file,$req1="",$req2="",$req3="")
{
	global $includes_js,$includes_jsreq;
	$includes_js[]=$file;
	if($req1!="")
		$includes_jsreq[$file]=array($req1);
	if($req2!="")
		$includes_jsreq[$file][]=$req2;
	if($req3!="")
		$includes_jsreq[$file][]=$req3;
}

function LoadJS_CSS($id)
{
	global $includes_js,$includes_jsreq,$includes_css;
	$includes_js=array_unique($includes_js);
	$includes_css=array_unique($includes_css);
	$sl = "sl".$id;
	$out="var ".$sl." = new ScriptLoader('".$id."');\r\n";
	foreach($includes_css as $file)
		$out.=$sl.".loadCSS('".$file."');";
	foreach($includes_js as $file)
	{
		$out .= $sl.".addJS('".$file."'";
		if(array_key_exists($file,$includes_jsreq))
		{
			foreach($includes_jsreq[$file] as $req)
				$out.=",'".$req."'";
		}
		$out.=");\r\n";
	}
	$out.=$sl.".load();";
	return $out;
}

function PrepareJSCode(&$js,$id)
{
	$js="window.postloadstep".($id ? "_".$id : '')." = function(){".$js."};\r\n ";
	$js.=LoadJS_CSS($id);
}


function loadindicator()
{
	$path = GetAbsoluteFileName("templates/loadindicator.htm");
	return myfile_get_contents($path,"r");
}


class WhereClause
{
	var $_where = null;
	var $_security = '';
	
	function WhereClause()
	{
		$strSecuritySql = SecuritySQL("Search");
		if($strSecuritySql)
			$this->_security = $strSecuritySql;
	}

	function getWhere()
	{
		global $strTableName;
		$sWhere="";
		if($this->_where && isset($this->_where[$strTableName."_asearchfor"]))
		{
			foreach($this->_where[$strTableName."_asearchfor"] as $f => $sfor)
			{
				$strSearchFor = trim($sfor);
				$strSearchFor2 = "";
				$type=@$this->_where[$strTableName."_asearchfortype"][$f];
				if(array_key_exists($f,@$this->_where[$strTableName."_asearchfor2"]))
					$strSearchFor2=trim(@$this->_where[$strTableName."_asearchfor2"][$f]);
				if($strSearchFor!="" || true)
				{
					if (!$sWhere) 
					{
						if($this->_where[$strTableName."_asearchtype"]=="and")
							$sWhere="1=1";
						else
							$sWhere="1=0";
					}
					$strSearchOption=trim($this->_where[$strTableName."_asearchopt"][$f]);
					if($where=StrWhereAdv($f, $strSearchFor, $strSearchOption, $strSearchFor2,$type))
					{
						if($this->_where[$strTableName."_asearchnot"][$f])
							$where="not (".$where.")";
						if($this->_where[$strTableName."_asearchtype"]=="and")
		   					$sWhere .= " and ".$where;
						else
		   					$sWhere .= " or ".$where;
					}
				}
			}
		}
		
		if($this->_security)
			$sWhere = whereAdd($sWhere, $this->_security);
			
		return $sWhere;
	}
	
	function parseRequest()
	{
		global $strTableName;
		$this->_where = array();
		$this->_where[$strTableName."_asearchnot"]=array();
		$this->_where[$strTableName."_asearchopt"]=array();
		$this->_where[$strTableName."_asearchfor"]=array();
		$this->_where[$strTableName."_asearchfor2"]=array();
		$tosearch=0;
		$asearchfield = postvalue("asearchfield");
		$this->_where[$strTableName."_asearchtype"] = postvalue("type");
		if(!$this->_where[$strTableName."_asearchtype"])
			$this->_where[$strTableName."_asearchtype"]="and";
		if(isset($asearchfield) && is_array($asearchfield))
		{
			foreach($asearchfield as $field)
			{
				$gfield=GoodFieldName($field);
				$asopt=postvalue("asearchopt_".$gfield);
				$value1=postvalue("value_".$gfield);
				$type=postvalue("type_".$gfield);
				$value2=postvalue("value1_".$gfield);
				$not=postvalue("not_".$gfield);
				if($value1 || $asopt=='Empty')
				{
					$tosearch=1;
					$this->_where[$strTableName."_asearchopt"][$field]=$asopt;
					if(!is_array($value1))
						$this->_where[$strTableName."_asearchfor"][$field]=$value1;
					else
						$this->_where[$strTableName."_asearchfor"][$field]=combinevalues($value1);
					$this->_where[$strTableName."_asearchfortype"][$field]=$type;
					if($value2)
						$this->_where[$strTableName."_asearchfor2"][$field]=$value2;
					$this->_where[$strTableName."_asearchnot"][$field]=($not=="on");
				}
			}
		}
		if($tosearch)
			$this->_where[$strTableName."_search"]=2;
		else
			$this->_where[$strTableName."_search"]=0;
		$this->_where[$strTableName."_pagenumber"]=1;
	}
	
	function applyWhere(&$sql)
	{
		$toAdd = $this->getWhere();
		if($toAdd)
		{
			if($sql[2])
			{
				$sql[2] = '('.$sql[2].') AND ';
			}
			
			$sql[2] .= '('.$toAdd.') ';
		}
		
		return $sql;
	}
	
	function getTable()
	{
		return $this->_where;
	}
}

function GetSiteUrl()
{
	$url = "http://".$_SERVER["SERVER_NAME"];
	if($_SERVER["SERVER_PORT"]!=80)
	{
		if ($_SERVER["SERVER_PORT"]==443)
		   $url = "https://".$_SERVER["SERVER_NAME"];
		else
		   $url.=":".$_SERVER["SERVER_PORT"];
	}
	return $url;
}
?>