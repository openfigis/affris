<?php

// handling errors
function triggerErrorMSSQL()
{
	
	$error = db_error();
	if (!strlen($error))
		trigger_error("Udefined MSSQL Server Error", E_USER_ERROR);
	else 
		trigger_error($error, E_USER_ERROR);
}
// connection to server and choosing DB
function db_connect()
{
    global $host,$user,$pwd,$dbname;
    
	$connectionInfo = array("Database"=>$dbname, "PWD" => $pwd, "UID" => $user);
	$conn = sqlsrv_connect($host, $connectionInfo);
		
	if(!$conn)
		triggerErrorMSSQL();
	
	return $conn;
}
// free connection resources 
function db_close($conn)
{
	return sqlsrv_close($conn);
}
// make query
function db_query($qstring,$conn)
{
	global $strLastSQL;
	
	$strLastSQL=$qstring;	
	$ret=sqlsrv_query($conn, $qstring);
	
	if($ret===false)
		triggerErrorMSSQL();
		
	return $ret;	
}
// executing query
function db_exec($qstring,$conn)
{
	global $strLastSQL;
	$strLastSQL=$qstring;
	return sqlsrv_query($conn, $qstring);
}
// pageseek
function db_pageseek($qhandle,$pagesize,$page)
{
	db_dataseek($qhandle,($page-1)*$pagesize);
}
// search row 
function db_dataseek($qhandle,$row)
{
	if($row>0)
		for ($i=0;$i<$row;$i++)
			if (!sqlsrv_fetch($qhandle))
				break;
}
// fetch accoc array
function db_fetch_array($qhandle)
{	
	$rowArray=array();	
	$metaData = sqlsrv_field_metadata($qhandle);
	$fetchRes = sqlsrv_fetch($qhandle);
	
	
	if($fetchRes === false)
	{
		triggerErrorMSSQL();
	}
	elseif (is_null($fetchRes))
	{
		return $rowArray;
	}
	else
	{	
		$j=0;		
		foreach($metaData as $fieldMetadata)
		{			
			switch ($fieldMetadata['Type']) 
			{
			//dateTime	
			case 93:
			    $fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR));			 
				$fieldVal = substr($fieldVal, 0, strrpos($fieldVal, "."));
			    break;
			// ntext
			case -10:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_CHAR));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;
			    break;
			// image
			case -4:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;				
			    break;
			// text
			case -1:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_CHAR));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;				
			    break;
			// need to check, may be int data should be retrieved in another type		
			default:   				
				$fieldVal = sqlsrv_get_field($qhandle, $j);						    
			}	
			
			$rowArray[$fieldMetadata['Name']] = $fieldVal;
			$j++;			
		}
		return $rowArray;
	}	
}
// fetch num array
function db_fetch_numarray($qhandle)
{
	$rowArray=array();	
	$metaData = sqlsrv_field_metadata($qhandle);
	$fetchRes = sqlsrv_fetch($qhandle);
	
	
	if($fetchRes === false)
	{
		triggerErrorMSSQL();
	}
	elseif (is_null($fetchRes))
	{
		return $rowArray;
	}
	else
	{	
		$j=0;		
		foreach($metaData as $fieldMetadata)
		{
			switch ($fieldMetadata['Type']) 
			{
			//dateTime	
			case 93:
			    $fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR));			 
				$fieldVal = substr($fieldVal, 0, strrpos($fieldVal, "."));
			    break;
			// ntext
			case -10:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_CHAR));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;
			    break;
			// image
			case -4:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;				
			    break;
			// text
			case -1:
				$fieldVal = sqlsrv_get_field($qhandle, $j, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_CHAR));
				$buffer = null;
				while (!feof($fieldVal)) 
				{
				    $buffer .= fgets($fieldVal, 4096);
				}
				fclose($fieldVal);
				$fieldVal = $buffer;				
			    break;
			// need to check, may be int data should be retrieved in another type		
			default:   				
				$fieldVal = sqlsrv_get_field($qhandle, $j);				    
			}		
			$rowArray[] = $fieldVal;
			$j++;	
		}
		return $rowArray;
	}
}
// return error message
function db_error()
{
	$errMess = "";
	if(($errors=sqlsrv_errors())!=null)
		foreach( $errors as $error)		
			$errMess .= "SQLSTATE: ".$error['SQLSTATE']." code: ".$error['code']." message: ".$error['message']."</br>";
			
    return $errMess;
}
// addslashes
function db_addslashes($str)
{
	return str_replace("'","''",$str);
}
// stripslashes
function db_stripslashes($str)
{
	return str_replace("''","'",$str);
}
// addslashesbinary
function db_addslashesbinary($str)
{
	return "0x".bin2hex($str);
}
// stripslashesbinary
function db_stripslashesbinary($str)
{
	return $str;
}

// adds wrappers to field name if required
function AddFieldWrappers($strName)
{
	global $strLeftWrapper,$strRightWrapper;
	if(substr($strName,0,1)==$strLeftWrapper)
		return $strName;
	return $strLeftWrapper.$strName.$strRightWrapper;
}
// AddTableWrappers
function AddTableWrappers($strName)
{
	global $strLeftWrapper,$strRightWrapper;
	if(substr($strName,0,1)==$strLeftWrapper)
		return $strName;
	$arr=explode(".",$strName);
	$ret=$strLeftWrapper.$arr[0].$strRightWrapper;
	if(count($arr)>1)
		$ret.=".".$strLeftWrapper.$arr[1].$strRightWrapper;
	return $ret;
}

// removes wrappers from field name if required
function RemoveFieldWrappers($strName)
{
	global $strLeftWrapper,$strRightWrapper;
	if(substr($strName,0,1)==$strLeftWrapper)
		return substr($strName,1,strlen($strName)-2);
	return $strName;
}
// removes wrappers from table name if required
function RemoveTableWrappers($strName)
{
	global $strLeftWrapper,$strRightWrapper;
	if(substr($strName,0,1)!=$strLeftWrapper)
		return $strName;
	$arr=explode(".",$strName);
	$ret=substr($arr[0],1,strlen($arr[0])-2);
	if(count($arr)>1)
		$ret.=".".substr($arr[1],1,strlen($arr[1])-2);
	return $ret;
}
// add upper
function db_upper($dbval)
{
	return "upper(".$dbval.")";
}
// add quotes
function db_datequotes($val)
{
	return "'".$val."'";
}
// Retrieves the number of fields in an active result set
function db_numfields($lhandle)
{
	return @sqlsrv_num_fields($lhandle);
}
// return field name
function db_fieldname($lhandle,$fnumber)
{
	$metaData = @sqlsrv_field_metadata($lhandle);
	if ($metaData!==false)
		return $metaData[$fnumber]['Name'];	
}
// return field type by field number
function db_fieldtypen($lhandle,$fnumber)
{
	$metaData = @sqlsrv_field_metadata($lhandle);
	if ($metaData!==false)
		return $metaData[$fnumber]['Type'];	
}
// return field type by field name
function db_fieldtype($lhandle,$fname)
{
	/*
	 * $fieldMetadata['Type'] values description
	 * int => 4
	 * real => 7
	 * decimal, money => 3
	 * varchar => 12
	 * nvarchar => -9
	 * text => -1
	 * ntext => -10
	 * image => -4
	 */
	
	$metaData = @sqlsrv_field_metadata($lhandle);
	if ($metaData!==false)			
		foreach($metaData as $fieldMetadata)			
				if ($fieldMetadata['Name']==$fname)
					return $fieldMetadata['Type'];
}
// indicates if field needs quotes
function FieldNeedQuotes($rs,$field)
{
	$t=db_fieldtype($rs,$field);	
	
	if($t==-4||$t==-10||$t==3||$t==4||$t==7)
		return false;
	return true;
}

?>