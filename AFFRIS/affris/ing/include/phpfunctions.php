<?php

/*
	PHPRunner wrapper for mail() function.
	$params array Input paramaters.
	The following parameters are supported:
	'from' Sender email address. If none specified an email address from the wizard will be used.
	'to' Receiver email address.
	'body' Plain text message body.
	'htmlbody' Html message body (do not use 'body' parameter in this case).
	'charset' Html message charset. If none specified the default website charset will be used.
	
	Returns array with data:
	"mailed" - indicates wheter mail sent or not
	"errors" - array of errors
		Each error is an array with the following keys:
		"number" - error number
		"description" - error description
		"file" - name of the php file in which error happened
		"line" - line number on which error happened
*/

class ErrorHandler
{
	var $errorstack = array();
	function handle_mail_error($errno, $errstr, $errfile, $errline)
	{
		if(strpos($errstr,"It is not safe to rely on the system's timezone settings."))
			return;	
		$this->errorstack []= array('number' => $errno, 'description' => $errstr, 'file' => $errfile, 'line' => $errline);
	}
	function getErrorMessage()
	{
		$msg="";
		foreach($this->errorstack as $err)
		{
			if($msg)
				$msg.="\r\n";
			$msg.=$err['description'];
		}
		return $msg;
	}
}

function runner_mail($params)
{

	$customSMTP = "";
	if ($customSMTP)
	{
		include_once(getabspath('libs/phpmailer/class.phpmailer.php'));
		include_once(getabspath('libs/phpmailer/class.smtp.php'));
		return runner_mail_smtp($params);
	}
	
	$from = isset($params['from']) ? $params['from'] : "";
	if(!$from)
	{
		$from = "";
	}
	$to = isset($params['to']) ? $params['to'] : "";
	$body = isset($params['body']) ? $params['body'] : "";
	$cc = isset($params['cc']) ? $params['cc'] : "";
	$bcc = isset($params['bcc']) ? $params['bcc'] : "";
	$replyTo = isset($params['replyTo']) ? $params['replyTo'] : "";
	$priority = isset($params['priority']) ? $params['priority'] : "";
	$charset = "";
	$isHtml = false;
	if(!$body)
	{
		$body = isset($params['htmlbody']) ? $params['htmlbody'] : "";
		$charset = isset($params['charset']) ? $params['charset'] : "";
		if(!$charset)
			$charset = "utf-8";
		$isHtml = true;
	}
	$subject = $params['subject'];

	//
	$header = "";
	if($isHtml)
	{
		$header .= "MIME-Version: 1.0\r\n";
		$header .= 'Content-Type: text/html;' . ( $charset ? ' charset=' . $charset . ';' : '' ) . "\r\n";
	}

	if($from)
	{
		if(strpos($from, '<') !== false)
			$header .= 'From: ' . $from . "\r\n";
		else
			$header .= 'From: <' . $from . ">\r\n";

		@ini_set("sendmail_from", $from);
	}
	if($cc)
		$header .= 'Cc: ' . $cc . "\r\n";
	if($bcc)
		$header .= 'Bcc: ' . $bcc . "\r\n";
	
	if ($priority)
		$header .= 'X-Priority: '.$priority."\r\n";
		
	if($replyTo)
	{
		if(strpos($replyTo, '<') !== false)
			$header .= 'Reply-to: '.$replyTo."\r\n";
		else
			$header .= 'Reply-to: <'.$replyTo.">\r\n";
	}
	
		
	$eh = new ErrorHandler();
	set_error_handler(array($eh, "handle_mail_error"));

	$res = false;
	if(!$header)
	{
		$res = mail($to, $subject, $body);
	}
	else
	{
		$res = mail($to, $subject, $body, $header);
	}
		
	restore_error_handler();
	return array('mailed' => $res, 'errors' => $eh->errorstack, "message"=> nl2br($eh->getErrorMessage()));
}
/**
 * Gets absolute path
 *
 * @param string $path
 * @return string
 */
function getabspath($path) 
{
	
	// get path to the root
	$pathToRoot = substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen("/include"));
	// cheks if there already we have absolute path
	if ($pathToRoot=="" || strpos($path, $pathToRoot) !== false)
		return $path;
	
	// add \ or / if needed
	if (substr($path, 0, 1) != "/" && substr($path, 0, 1) != "\\")
		$pathToRoot .= "/";	
	
	$realPath = $pathToRoot.$path;
	return $realPath;
}

function myfile_exists($filename)
{
	$file = @fopen($filename,"rb");
	if($file)
	{
		fclose($file);
		return true;
	}
	else
		return false;
}

//	read the whole file and return contents
function myfile_get_contents($filename, $mode = "rb")
{
	if(!is_uploaded_file($filename) && !file_exists($filename))
		return false;
	$handle = fopen($filename, $mode);
	if(!$handle)
		return false;
	fseek($handle, 0 , SEEK_END);
	$fsize = ftell($handle);
	fseek($handle, 0 , SEEK_SET);
	
	if($fsize)
		$contents = fread($handle, $fsize);
	else
		$contents="";
	fclose($handle);
	return $contents;
}



function printfile($filename)
{
	$file = fopen($filename, "rb");
	$bufsize = 8*1024;
	while(!feof($file))
		echo fread($file, $bufsize);
	fclose($file);
}

function CreateThumbnail($value, $size, $ext){
	
	if(!function_exists("imagecreatefromstring"))
		return $value;
	$image = imagecreatefromstring($value);
	if(!$image)
		return $value;
				
	$width_old = imagesx($image);
	$height_old = imagesy($image);	
	
	if($width_old>$size || $height_old>$size){
		if($width_old>=$height_old)
		{
			$final_height=(integer)($height_old*$size/$width_old);
			$final_width=$size;
		}
		else
		{
			$final_width=(integer)($width_old*$size/$height_old);
			$final_height=$size;
		}
		
	 
	    $image_resized = imagecreatetruecolor( $final_width, $final_height );
	 
	    if ($ext==".GIF" || $ext=="GIF" || $ext==".PNG" || $ext=="PNG") {
	      $trnprt_indx = imagecolortransparent($image);
		  
	      // If we have a specific transparent color
	      if ($trnprt_indx >= 0) {
	 		
	     	// when index more than imagecolorstotal may occurs problems with gif
		    $totalColors = imagecolorstotal($image);	      	
		    if ($trnprt_indx>=$totalColors && $totalColors>0){
		    	$trnprt_indx = imagecolorstotal($image)-1;
		    }
	      	
	        // Get the original image's transparent color's RGB values
	        $trnprt_color    = imagecolorsforindex($image, $trnprt_indx);
	 		
	        // Allocate the same color in the new image resource
	        $trnprt_indx    = imagecolorallocatealpha($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue'],127);
	        $trnprt_indx    = imagecolorallocate($image_resized, 255,255,255);
	        // Completely fill the background of the new image with allocated color.
	        imagefill($image_resized, 0, 0, $trnprt_indx);
 	 
	        // Set the background color for new image to transparent
	        imagecolortransparent($image_resized, $trnprt_indx);
	 
	      } 
	      // Always make a transparent background color for PNGs that don't have one allocated already
	      elseif ($ext==".PNG" || $ext=="PNG") {
	 
	        // Turn off transparency blending (temporarily)
	        imagealphablending($image_resized, false);
	 
	        // Create a new transparent color for image
	        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
	 
	        // Completely fill the background of the new image with allocated color.
	        imagefill($image_resized, 0, 0, $color);
	 
	        // Restore transparency blending
	        imagesavealpha($image_resized, true);
	      }
	    }	 	
	 	
	 	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);	    
	 	
	    ob_start();
		if($ext==".JPG" || $ext=="JPEG")
			imagejpeg($image_resized);
		elseif($ext==".PNG")
			imagepng($image_resized);
		else
			imagegif($image_resized);
		$ret=ob_get_contents();
		ob_end_clean();
		imagedestroy($image);
		imagedestroy($image_resized);
		return $ret;
	}
	imagedestroy($image);
	return $value;
	
}
function mysprintf($format, $params)
{
	$params2 = $params;
	array_unshift($params2, $format);
	return call_user_func_array('sprintf', $params2);
}

function now()
{
	return strftime("%Y-%m-%d %H:%M:%S");
}

//	refine value passed by POST or GET method
function refine($str)
{
	if(get_magic_quotes_gpc())
		return stripslashes($str);
	return $str;
}

//	suggest image type by extension
function SupposeImageType($file)
{
	if(strlen($file)>1 && $file[0]=='B' && $file[1]=='M')
		return "image/bmp";
	if(strlen($file)>2 &&  $file[0]=='G' && $file[1]=='I' && $file[2]=='F')
		return "image/gif";
	if(strlen($file)>3 &&  ord($file[0])==0xff && ord($file[1])==0xd8 && ord($file[2])==0xff)
		return "image/jpeg";
	if(strlen($file)>8 &&  ord($file[0])==0x89 && ord($file[1])==0x50 && ord($file[2])==0x4e && ord($file[3])==0x47
					   &&  ord($file[4])==0x0d && ord($file[5])==0x0a && ord($file[6])==0x1a && ord($file[7])==0x0a)
		return "image/png";
}


function prepare_file($value,$field,$controltype,$postfilename, $id)
{
	global $filename;
	$filename="";
	$file=&$_FILES["value_".GoodFieldName($field)."_".$id];
	if($file["error"] && $file["error"]!=4)
		return false;
	if(trim($postfilename))
		$filename=refine(trim($postfilename));
	else
		$filename=$file['name'];
	if(substr($controltype,4,1)=="1")
	{
		$filename="";
		return "";
	}
	if(substr($controltype,4,1)=="0")
		return false;
	$ret=myfile_get_contents($file['tmp_name']);
	if($ret===false)
		return false;
	return $ret;
}

function prepare_upload($field,$controltype,$postfilename,$value,$table, $id, &$pageObject)
{
	$abs = GetFieldData($table, $field, "Absolute", false);
	$file=&$_FILES["value_".GoodFieldName($field)."_".$id];
	if($file["error"] && $file["error"]!=4)
		return false;
	if(substr($controltype,6,1)=="1")
	{
		if(strlen($postfilename))
		{
			$pageObject->filesToDelete[]=new DeleteFile($postfilename, GetUploadFolder($field,$table), $abs);
			if(GetCreateThumbnail($field,$table))
				$pageObject->filesToDelete[]=new DeleteFile(GetThumbnailPrefix($field,$table).$postfilename, GetUploadFolder($field,$table), $abs);
		}
		return "";
	}
	if(substr($controltype,6,1)=="0")
		return false;
	if(strlen($file['tmp_name']))
	{
		if(!ResizeOnUpload($field,$table))
		{
			$pageObject->filesToMove[] = new MoveFile($file['tmp_name'],$value, GetUploadFolder($field,$table),$abs);
		}
		else
		{
			$contents = myfile_get_contents($file['tmp_name']);
			$ext = CheckImageExtension($file["name"]);
			$thumb = CreateThumbnail($contents,GetNewImageSize($field,$table),$ext);
			$pageObject->filesToSave[] = new SaveFile($thumb,$value, GetUploadFolder($field,$table),$abs);
		}
	}
	return $value;
}

function FieldSubmitted($field)
{
	return in_assoc_array("type_".GoodFieldName($field),$_POST) || in_assoc_array("value_".GoodFieldName($field),$_POST) || in_assoc_array("value_".GoodFieldName($field),$_FILES);
}

function GetUploadedFileContents($name)
{
	return myfile_get_contents($_FILES[$name]['tmp_name']);
}

function GetUploadedFileName($name)
{
	return $_FILES[$name]["name"];
}

function PrepareBlobs(&$values, &$blobfields)
{
	global $error_happened;
	$blobs=array();
//	no special processing required
	$blobfields=array();
	return $blobs;
}

function ExecuteUpdate($strSQL,&$blobs,$addMode)
{
	global $conn,$error_happened;
	if($addMode)
		$errFunction = "add_error_handler";
	else
		$errFunction = "edit_error_handler";
	$errhandler = set_error_handler($errFunction);
	db_exec($strSQL,$conn);
	set_error_handler($errhandler);
	if($error_happened)
		return false;
	return true;
}

function runner_move_uploaded_file($source, $dest)
{
	move_uploaded_file($source, $dest);
}

function runner_save_file($filename, $contents)
{
	if(file_exists($filename))
		@unlink($filename);
	$th = fopen($filename, "w");
	fwrite($th, $contents);
	fclose($th);
}

function runner_delete_file($file)
{
	if(myfile_exists($file))
		@unlink($file);
}

function edit_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readevalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit ) 
		$message=""."Record was NOT edited".". ".$errstr;
	else  
		$message="<<< "."Record was NOT edited"." >>><br><br>".$errstr;
	$readevalues=true;
	$error_happened=true;
}

function GetCurrentYear()
{
	$tm=localtime(time(),true);
	return $tm["tm_year"]+1900;
}

function sortMembers(&$arr)
{
	usort($arr, "sortfunc_members");

}

function sortTables(&$arr)
{
	usort($arr,"sortfunc_rights");
}


function sortfunc_rights($a, $b)
{
	if($a[0]==$b[0])
		return 0;
	if($a[0]>$b[0])
		return -1;
	return 1;
}


function sortfunc_members(&$a,&$b)
{
	global $sortgroup,$sortorder;
	$gcount=count($a["usergroup_boxes"]["data"]);
	for($i=0;$i<$gcount;$i++)
		if($a["usergroup_boxes"]["data"][$i]["group"]==$sortgroup)
			break;
	if($i==$gcount || $a["usergroup_boxes"]["data"][$i]["checked"]==$b["usergroup_boxes"]["data"][$i]["checked"])
	{
//	compare by username
		if($a["user"]==$b["user"])
			return 0;
		if($a["user"]>$b["user"])
			return 1;
		return -1;
	}
	if($sortorder=="a" && $a["usergroup_boxes"]["data"][$i]["checked"]=="")
		return 1;
	if($sortorder=="d" && $b["usergroup_boxes"]["data"][$i]["checked"]=="")
		return 1;
	return -1;
}


//	return refined POST or GET value - single value or array
function postvalue($name)
{
	if(array_key_exists($name,$_POST))
		$value=$_POST[$name];
	else if(array_key_exists($name,$_GET))
		$value=$_GET[$name];
	else
		return "";
	if(!is_array($value))
		return refine($value);
	$ret=array();
	foreach($value as $key=>$val)
		$ret[$key]=refine($val);
	return $ret;
}


function add_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readavalues, $message, $status, $inlineadd, $error_happened;
	if ( $inlineadd!=ADD_SIMPLE ) 
		$message=""."Record was NOT added".". ".$errstr;
	else  
		$message="<<< "."Record was NOT added"." >>><br><br>".$errstr;
	$readavalues=true;
	$error_happened=true;
}

//	return custom expression
function CustomExpression($value,$data,$field,$table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	return $value;
}

//	return lookup wizard WHERE expression
function LookupWhere($field,$table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	return "";
}

//	return lookup wizard WHERE expression
function GetDefaultValue($field,$table="")
{
	global $strTableName;
	if(!$table)
		$table=$strTableName;
	if($table=="vw_ingredientclass" && $field=="Description3") 
	{
		return "Select";
	}
	return "";
}


function mdeleteIndex($i)
{
	return $i-1;
}
/**
 * Call function stack info parser
 * Return array of function calls
 *
 * @return array
 */
function parse_backtrace($errfFile, $errLine, $splitAsArray = true)
{
    // get backtrace array
    $backtrace = debug_backtrace();
    
    // delete calls to error handler functions
	foreach ($backtrace as $i => $call) 
    {
    	// cut error handlers calls etc.
    	if ($call['function'] == 'parse_backtrace' ||  $call['function'] == 'error_handler' || $call['function'] == 'trigger_error'){
    		array_shift($backtrace);
    		continue;
    	}
    }
    // if no data return empty array
    if (empty($backtrace)) {
        return array();
    }
   
    
    $backTraceLen = count($backtrace);
    $backtrace[$backTraceLen]['file'] = $backtrace[$backTraceLen-1]['file'];
    $backtrace[$backTraceLen]['line'] = $backtrace[$backTraceLen-1]['line'];
    $backtrace[$backTraceLen]['function'] =  'Global scope';
    
    
 	// make shift of file: line, for better view. It will show not line where function were called, but line where in function error was happend
    for($i=0;$i<count($backtrace);$i++) 
    {
    	$errorLineBefore = $backtrace[$i]['line'];
    	$errorFileBefore = $backtrace[$i]['file'];
    	$backtrace[$i]['file'] = $errfFile;
    	$backtrace[$i]['line'] = $errLine;
    	$errLine = $errorLineBefore;
    	$errfFile = $errorFileBefore;
    }
    
    // result array with data
    $funCallsArray = array();
    // parse array
    foreach ($backtrace as $i => $call) 
    {    	
    	// proccess the data that may not exist
    	if (isset($call['file']))
    	{
    		// get path to the root
			$pathToRoot = substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen("include"));
			// replace it
			$call['file'] = str_replace($pathToRoot, '', $call['file']);			
    	}
    	else
    	{
    		$call['file'] = '(null)';
			    		
    	}
    	//$call['file'] = !isset($call['file']) ? '(null)' : $call['file'];
    	$call['line'] = !isset($call['line']) ? '0' : $call['line'];
		// proccess file and error line 
        $location = $call['file'] . ':' . $call['line'];
        // if object method was called
        if (isset($call['class']))
        {
        	$function = $call['class'].(isset($call['type']) ? $call['type'] : '.').$call['function'];
        
        }// if function
        else
        {
        	$function = $call['function'];
        }
		// proccess arguments
        $params = '';
        if (isset($call['args'])) 
        {
            $args = array();
            $j=0;
            foreach ($call['args'] as $arg) 
            {
            	$j++;
            	// proccess array
                if (is_array($arg)) 
                {
                	$arrStr = print_r($arg, true);
                    $arrStr = strlen($arrStr) < 200 ? $arrStr : substr($arrStr, 0, 200).'...';
                    $args[] = $j.'.&nbsp;'.htmlspecialchars($arrStr).';';
                } 
                // process objects
                elseif (is_object($arg)) 
                {
                    $args[] = $j.'.&nbsp;'.htmlspecialchars(get_class($arg)).';';
                } 
                // another arguments
                else 
                {
                	$arg = @strlen($arg) < 200 ? $arg : @htmlspecialchars(substr($arg, 0, 200)).'...';
                    $args[] = $j.'.&nbsp;'.$arg.';';
                }
            }            
            $params = implode('</br> ', $args);
        } 
		// add in finish array all params		
		if (!$splitAsArray)
		{
			$funCallsArray[] = '#'.$i.'&nbsp;&nbsp;'.$function.'('.$params.')&nbsp;&nbsp;called&nbsp;at&nbsp;['.$location.']';
		}
		else 
		{			
			$funCallsArray[] = array('num' => '#'.$i.'.&nbsp;', 'path' => $location, 'func'=>$function, 'args'=>(strlen($params) ? $params : 'N/A'));				
		}		
    }
    
    // return array with call functions strings
    return $funCallsArray;
}

//	display error message
function error_handler($errno, $errstr, $errfile, $errline)
{
	global $strLastSQL;
	
	if ($errno==2048)
		return 0;	
	if($errno==8192)
	{
		if($errstr=="Assigning the return value of new by reference is deprecated")
			return 0;
		if(strpos($errstr,"set_magic_quotes_runtime"))
			return 0;
	}

	if($errno==2 && strpos($errstr,"has been disabled for security reasons"))
		return 0;
	if($errno==2 && strpos($errstr,"Data is not in a recognized format"))
		return 0;
	if($errno==8 && !strncmp($errstr,"Undefined index",15))
		return 0;
	if(strpos($errstr,"It is not safe to rely on the system's timezone settings."))
		return 0;	
	if(strpos($errstr,"fopen(")===0)
		return 0;

	
	// show error htm
	if(!class_exists("Xtempl"))
		require_once(getabspath("include/xtempl.php"));
		
	$xt = new Xtempl();
	$xt->assign('errno', $errno);
	$xt->assign('errstr', $errstr);
	
	$url = $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]; 
	if(array_key_exists("QUERY_STRING",$_SERVER))
	{ 
		$url .= "?".htmlspecialchars($_SERVER["QUERY_STRING"]);
	}
	
	$xt->assign('url', $url);
	$xt->assign('errfile', $errfile);
	$xt->assign('errline', $errline);
	
	$sqlStr = isset($strLastSQL) ? htmlspecialchars(substr($strLastSQL,0,1024)) : ''; 
	$xt->assign('sqlStr', $sqlStr);
	
	$debugInfoArr = parse_backtrace($errfile, $errline);
	$xt->assign_loopsection('debugRow', $debugInfoArr);	
			
	$xt->display('error.htm');
	
	exit(0);
}

function GetMySQL4RowCount($countstr)
{
	global $conn;
	$countrs = db_query($countstr,$conn);
	return mysql_num_rows($countrs);
}

function no_output_done()
{
	if(headers_sent())
		return false;
	if(ob_get_length())
		return false;
	return true;
}


function format_currency($val)
{
	return str_format_currency($val);
}

function format_number($val,$valDigits = false)
{
	return str_format_number($val,$valDigits);
}

function format_datetime($time)
{
	return str_format_datetime($time);
}

function format_time($time)
{
	return str_format_time($time);
}

function secondsPassedFrom($datetime)
{
	$arrDateTime=db2time($datetime);
	return time()-mktime($arrDateTime[3],$arrDateTime[4],$arrDateTime[5],$arrDateTime[1],$arrDateTime[2],$arrDateTime[0]);
}

function xtempl_call_func($func,&$params)
{
	if(function_exists($func))
		$func($params);
}

function echoBinary($string, $bufferSize = 8192)
{
	for ($chars=strlen($string)-1,$start=0;$start <= $chars;$start += $bufferSize) 
		echo substr($string,$start,$bufferSize);
}

function setObjectProperty(&$obj,$key,&$value)
{
	$obj->$key = &$value;		
}
function returnError404()
{
	header("HTTP/1.0 404 Not Found");
}
function execute_events(&$params)
{
	if(function_exists(@$params["custom1"]))
		eval($params["custom1"].'($params);');
}

function GetMySQLLastInsertID()
{
	global $conn;
//	select LAST_INSERT_ID() for ASP
	return mysql_insert_id($conn);
}

function DoUpdateRecord($table,&$evalues,&$blobfields,$strWhereClause, $pageid, &$pageObject)
{
	return DoUpdateRecordSQL($table,$evalues,$blobfields,$strWhereClause, $pageid, $pageObject);
}
function DoInsertRecord($table,&$avalues,&$blobfields, $pageid, &$pageObject)
{
	return DoInsertRecordSQL($table,$avalues,$blobfields, $pageid, $pageObject);
}
function xtempl_include_header($xt,$fname,$param)
{
	$xt->assign_function($fname,"xt_include",array("file"=>$param));
}


$db_query_safe_errstr ="";
$db_query_safe_err = false;
function db_query_safe($qstring,$conn,&$errstring)
{
	global $db_query_safe_errstr,$db_query_safe_err;
	$db_query_safe_errstr="";
	$db_query_safe_err=false;
	$errhandler = set_error_handler("errhandler_db_query_safe");
	$ret = db_query($qstring,$conn);
	set_error_handler($errhandler);
	$errstring = $db_query_safe_errstr;
	if($db_query_safe_err)
	{
		return false;
	}
	return $ret;
}
function errhandler_db_query_safe($errno, $errstr, $errfile, $errline)
{
	global $db_query_safe_errstr,$db_query_safe_err;
	if($errno==E_ERROR || $errno==E_USER_ERROR)
	{
		$db_query_safe_err=true;
	}
	$db_query_safe_errstr.="<br>".$errstr;
}
function binPrint(&$value, $size)
{
	echobig($value,$size); 
}
//	construct "good" field name
function GoodFieldName($field)
{
	global $cCharset;
	if ($cCharset == "utf-8"){
		$field = utf8_decode($field);
	}
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


function xt_getvar(&$xt,$name)
{
	global $testingLinks;
	for($i = count($xt->xt_stack)-1;$i>=0;$i--)
	{
		if(array_key_exists($name,$xt->xt_stack[$i]))
			return $xt->xt_stack[$i][$name];
	}
	if(!$xt->testingFlag)
		return false;
		
	if(array_key_exists($name,$testingLinks))
		return "func=\"".$testingLinks[$name]."\"";
	else
		return false;
}

	function xt_process_template(&$xt,$str)
	{
//	parse template file tag by tag
		$start=0;
		$literal=false;
		$len = strlen($str);
		while(true)
		{
			$pos = strpos($str,"{",$start);
			if($pos===false)
			{
				echo substr($str,$start,$len-$start);
				break;
			}
			$section=false;
			$var=false;
			$message=false;
			if(substr($str,$pos+1,6)=="BEGIN ")
				$section=true;
			elseif(substr($str,$pos+1,1)=='$')
				$var=true;
			elseif(substr($str,$pos+1,14)=='mlang_message ')
			{
				$message=true;
			}
			else
			{
//	no tag, just '{' char
				echo substr($str,$start,$pos-$start+1);
				$start=$pos+1;
				continue;
			}
			echo substr($str,$start,$pos-$start);
			if($section)
			{
//	section
				$endpos=strpos($str,"}",$pos);
				if($endpos===false)
				{
					$xt->report_error("Page is broken");
					return;
				}
				$section_name=trim(substr($str,$pos+7,$endpos-$pos-7));
				$endtag="{END ".$section_name."}";
				$endpos1=strpos($str,$endtag,$endpos);
				if($endpos1===false)
				{
					echo "End tag not found:".htmlspecialchars($endtag);
					$xt->report_error("Page is broken");
					return;
				}
				$section=substr($str,$endpos+1,$endpos1-$endpos-1);
				$start=$endpos1+strlen($endtag);
				$var = xt_getvar($xt,$section_name);
				if($var===false)
				{
					continue;
				}
				$begin="";
				$end="";
				if(is_array($var))
				{
					$begin=@$var["begin"];
					$end=@$var["end"];
					$var=@$var["data"];
				}
				if(!is_array($var))
				{
//	if section
					echo $begin;
					xt_process_template($xt,$section);
					$xt->processVar($end, $varparams);
				}
				else
				{
//	foreach section
					echo $begin;
					$keys=array_keys($var);
					foreach($keys as $i)
					{
						$xt->xt_stack[]=&$var[$i];
						if(is_array($var[$i]) && array_key_exists("begin",$var[$i]))
							echo $var[$i]["begin"];
						xt_process_template($xt,$section);
						array_pop($xt->xt_stack);
						if(is_array($var[$i]) && array_key_exists("end",$var[$i]))
							echo $var[$i]["end"];
					}
					$xt->processVar($end, $varparams);
				}
			}
			elseif($var)
			{
//	display a variable or call a function
				$endpos=strpos($str,"}",$pos);
				if($endpos===false)
				{
					$xt->report_error("Page is broken");
					return;
				}
				$varparams=array();
				$var_name = trim(substr($str,$pos+2,$endpos-$pos-2));
				if(strpos($var_name," ")!==FALSE)
				{
					$varparams = explode(" ",$var_name);
					$var_name = $varparams[0];
					unset($varparams[0]);
				}
				$start=$endpos+1;
				$var = xt_getvar($xt,$var_name);
				if($var===false)
					continue;
					
				$xt->processVar($var, $varparams);
			}
			elseif($message)
			{
				$endpos=strpos($str,"}",$pos);
				if($endpos===false)
				{
					$xt->report_error("Page is broken");
					return;
				}
				$tag = trim(substr($str,$pos+15,$endpos-$pos-15));
				$start=$endpos+1;
				echo htmlspecialchars(mlang_message($tag));
			}
		}
	}

function runner_mail_smtp($params)
{
	$mail             = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP

	$from = isset($params['from']) ? $params['from'] : "";
	if(!$from)
	{
		$from = "";
	}
	$to = isset($params['to']) ? $params['to'] : "";
	$body = isset($params['body']) ? $params['body'] : "";
	
	$subject = $params['subject'];
	
	if (""!="")
	{
		$mail->SMTPAuth   = true;                  				// enable SMTP authentication
		$mail->Host       = "localhost";     // sets SMTP server
		$mail->Port       = "25"+0;     	// set the SMTP port 
		$mail->Username   = "";  		// SMTP username
		$mail->Password   = "";   // SMTP password
		
		if ($mail->Port==465)
			$mail->SMTPSecure = "ssl";                 
	}
	

	$mail->SetFrom($from, '');
	
	
	$mail->Subject    = $subject;
	$mail->AddAddress($to, "");	
	
	// replyTo
	if ( isset($params['replyTo']) )
		$mail->AddReplyTo($params['replyTo'],"");
		
	// body, htmlbody
	if (isset($params['htmlbody']))
	{
		$mail->AltBody    = $body; 
		$mail->MsgHTML($params['htmlbody']);	
	}
	else
	{
		$mail->Body    = $body;
	}
	
	
	// charset
	if (isset($params['charset']))
		$mail->CharSet = $params['charset'];
	else
		$mail->CharSet = "utf-8";
	

	// priority
	if (isset($params['priority']))
		$mail->Priority = isset($params['priority']);
	
	// CC/BCC
	
	if (isset($params['cc']))
			$mail->AddCC($params['cc'], "");
			
	if (isset($params['bcc']))
			$mail->AddBCC($params['bcc'], "");
			

	$res = $mail->Send();

	return array('mailed' => $res, "message"=> nl2br($mail->ErrorInfo));
}

//	utf8 substr
//	Example: myutf8_substr2($prname,0,"23") 
//	Display first 23 characters from variable, all the rest of it will be cut 
function utf8_substr($str,$from,$len)
{
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$str);
} 
function getFileNameFromURL()
{
	$scriptname=$_SERVER["PHP_SELF"];
	$pos=strrpos($scriptname,"/");
	if($pos!==FALSE)
		$scriptname=substr($scriptname,$pos+1);
	return $scriptname;
}

function strlen_bin(&$str)
{
	return strlen($str);
}
function db_stripslashesbinaryAccess($str)
{
//	try to remove ole header for BMP pictures
	$pos = strpos($str,".Picture");
	if($pos===false || $pos>300)
		return $str;
	$pos1=strpos($str,"BM",$pos);
	if($pos1===false || $pos1>300)
		return $str;
	return substr($str,$pos1);
}
function SendContentLength($len)
{
	header("Content-Length: ".$len);
}

function add_mysql_binaryslashes($str)
{
	return "'".mysql_real_escape_string($str)."'";
}
function DecodeUTF8($str)
{
	return utf8_decode($str);
}
function escapeEntities($str)
{
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
	return $out;
}

?>