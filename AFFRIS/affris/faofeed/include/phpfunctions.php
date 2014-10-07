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
	$from = isset($params['from']) ? $params['from'] : "";
	if(!$from)
	{
		$from = "";
	}
	$to = isset($params['to']) ? $params['to'] : "";
	$body = isset($params['body']) ? $params['body'] : "";
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

		ini_set("sendmail_from", $from);
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
function GetAbsoluteFileName($path) 
{
	// get path to the root
	$pathToRoot = substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen("/include"));
	// cheks if there already we have absolute path
	if (strpos($path, $pathToRoot) !== false)
		return $path;
	
	// add \ or / if needed
	if (substr($path, 0, 1) != "/" && substr($path, 0, 1) != "\\")
		$pathToRoot .= "/";	
	
	$realPath = $pathToRoot.$path;
	return $realPath;
}

function myfile_exists($filename)
{
	return file_exists($filename);
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

function myfile_put_contents($filename, $contents)
{
	if(file_exists($filename))
		@unlink($filename);
	$th = fopen($filename, "w");
	fwrite($th, $contents);
	fclose($th);
}

function myunlink($filename)
{
	@unlink($filename);
}

function get_error_string($error)
{
	$filename = dirname(__FILE__)."/errors.xml";
/*		$dom = new DomDocument('1.0', 'windows-1252');
		$dom->load($filename);
		$xp = new DOMXPath($dom);
		$solution = $xp->query('//Keywords[count(word[contains("'.$error.'", .)])=count(word)]/ancestor::row/Solution');
		if($solution->length > 0)
		{
			$item = $solution->item(0); 
			return $item->nodeValue;
		}
		else
		{
			return "";
		}*/
		
	class XMLParser 
	{
		var $filename;
		var $xml;
		var $data;
   
		function XMLParser($xml_file)
		{
			$this->filename = $xml_file;
			$this->xml = xml_parser_create();
			xml_set_object($this->xml, $this);
			xml_set_element_handler($this->xml, 'startHandler', 'endHandler');
			xml_set_character_data_handler($this->xml, 'dataHandler');
			$this->parse($xml_file);
		}
   
		function parse($xml_file)
		{
			if (!($fp = fopen($xml_file, 'r'))) 
			{
				die('Cannot open XML data file: '.$xml_file);
	            return false;
			}

			$bytes_to_parse = 512;
			while ($data = fread($fp, $bytes_to_parse)) 
			{
				$parse = xml_parse($this->xml, $data, feof($fp));
           
				if (!$parse) 
				{
					die(sprintf("XML error: %s at line %d",
					xml_error_string(xml_get_error_code($this->xml)),
                    xml_get_current_line_number($this->xml)));
	                xml_parser_free($this->xml);
				}
			}

			return true;
		}
   
		function startHandler($parser, $name, $attributes)
		{
			$data['name'] = $name;
			if ($attributes) 
			{
				$data['attributes'] = $attributes; 
			}
			$this->data[] = $data;
		}

		function dataHandler($parser, $data)
		{
			if ($data = trim($data)) 
			{
				$index = count($this->data) - 1;
				if(isset($this->data[$index]['content'])) 
				$this->data[$index]['content'] .= $data;
				else $this->data[$index]['content'] = $data;
			}
		}

		function endHandler($parser, $name)
		{
			if (count($this->data) > 1) 
			{
				$data = array_pop($this->data);
				$index = count($this->data) - 1; 
				$this->data[$index]['child'][] = $data;
			}
		}
	}

	$solution = "";
	$i = 0;

	$myFile = new XMLParser($filename);
	$size = sizeof($myFile->data[0]['child'])-1;
	$pos = array();
	for ($i=0; $i <= $size; $i++)
	{
		$keywords = $myFile->data[0]['child'][$i]['child'][1]['content'];
		$keys = split(" ",$keywords);
			
		$found = true;
		for ($j=0; $j <= sizeof($keys)-1; $j++)
		{
			if(false === strpos(strtoupper($error), strtoupper($keys[$j])))
			{
				$found = false;
				break;
			}
		}
			
		if($found)
			return $myFile->data[0]['child'][$i]['child'][5]['content'];
	}
}

//print file_get_contents("errors.xml");
//print get_error_string("errors.xml", "oci_fetch_array");

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


function prepare_file($value,$field,$controltype,$postfilename)
{
	global $filename;
	$filename="";
	$file=&$_FILES["value_".GoodFieldName($field)];
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

function prepare_upload($field,$controltype,$postfilename,$value,$table)
{
	global $files_delete,$files_save,$files_move;
	
	$file=&$_FILES["file_".GoodFieldName($field)];
	if($file["error"] && $file["error"]!=4)
		return false;
	if(substr($controltype,6,1)=="1")
	{
		if(strlen($postfilename))
		{
			$files_delete[]=GetUploadFolder($field,$table).$postfilename;
			if(GetCreateThumbnail($field,$table))
				$files_delete[]=GetUploadFolder($field,$table).GetThumbnailPrefix($field,$table).$postfilename;
		}
		return "";
	}
	if(substr($controltype,6,1)=="0")
		return false;
	if(strlen($file['tmp_name']))
	{
		if(!ResizeOnUpload($field,$table))
		{
			$file_move = array($file['tmp_name'],GetUploadFolder($field,$table).$value);
			$files_move[] = $file_move;
		}
		else
		{
			$contents = myfile_get_contents($file['tmp_name']);
			$ext = CheckImageExtension($file["name"]);
			$thumb = CreateThumbnail($contents,GetNewImageSize($field,$table),$ext);
			$filename = GetUploadFolder($field,$table).$value;
			$files_save[] = array("file"=>$thumb,"filename"=>$filename);
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

function DoUpdateRecord($table,&$evalues,&$blobfields,$strWhereClause)
{
	global $error_happened,$conn,$files_delete,$files_move,$files_save,$inlineedit,$usermessage,$message;
	if(!count($evalues))
		return false;
	$strSQL = "update ".AddTableWrappers($table)." set ";
//	construct SQL string
	foreach($evalues as $ekey=>$value)
	{
		$strSQL.=GetFullFieldName($ekey)."=".add_db_quotes($ekey,$value).", ";
	}
	if(substr($strSQL,-2)==", ")
		$strSQL=substr($strSQL,0,strlen($strSQL)-2);
	$strSQL.=" where ".$strWhereClause;
	if(SecuritySQL("Edit"))
		$strSQL .= " and (".SecuritySQL("Edit").")";
	set_error_handler("edit_error_handler");
	db_exec($strSQL,$conn);
	set_error_handler("error_handler");
	if($error_happened)
		return false;
//	delete & move files
	foreach ($files_delete as $file)
	{
		if(myfile_exists($file))
			myunlink($file);
	}
	foreach($files_move as $file)
	{		
		move_uploaded_file($file[0],GetAbsoluteFileName($file[1]));
		if(strtoupper(substr(PHP_OS,0,3))!="WIN")
			@chmod($file[1],0777);
	}
	foreach($files_save as $file)
	{
		myfile_put_contents(GetAbsoluteFileName($file["filename"]), $file["file"]);
	}
	
	if ( $inlineedit ) 
	{
		$status="UPDATED";
		$message=""."Record updated"."";
		$IsSaved = true;
	} 
	else 
		$message="<div class=message><<< "."Record updated"." >>></div>";
	if($usermessage!="")
		$message = $usermessage;
	return true;
}
function edit_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readevalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit ) 
		$message=""."Record was NOT edited".". ".$errstr;
	else  
		$message="<div class=message><<< "."Record was NOT edited"." >>><br><br>".$errstr."</div>";
	$readevalues=true;
	$error_happened=true;
}

function GetCurrentYear()
{
	$tm=localtime(time(),true);
	return $tm["tm_year"]+1900;
}


function DPOrderTables(&$tables)
{
	usort($tables,"sortfunc_rights");
}

function sortfunc_rights($a, $b)
{
	if($a[0]==$b[0])
		return 0;
	if($a[0]>$b[0])
		return -1;
	return 1;
}

function DPOrderUsers(&$rowinfo)
{
	usort($rowinfo,"sortfunc_members");
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

function DoInsertRecord($table,&$avalues,&$blobfields)
{
	global $error_happened,$conn,$files_delete,$files_move,$files_save,$inlineedit,$usermessage,$message,$failed_inline_add,$keys;
	
//	make SQL string
	$strSQL = "insert into ".AddTableWrappers($table)." ";
	$strFields="(";
	$strValues="(";
	foreach($avalues as $akey=>$value)
	{
		$strFields.=AddFieldWrappers($akey).", ";
		$strValues.=add_db_quotes($akey,$value).", ";
	}
	if(substr($strFields,-2)==", ")
		$strFields=substr($strFields,0,strlen($strFields)-2);
	if(substr($strValues,-2)==", ")
		$strValues=substr($strValues,0,strlen($strValues)-2);
	$strSQL.=$strFields.") values ".$strValues.")";
	LogInfo($strSQL);
	set_error_handler("add_error_handler");
	db_exec($strSQL,$conn);
	set_error_handler("error_handler");
//	move files
	if($error_happened)
		return false;
	foreach ($files_move as $file)
	{
		move_uploaded_file($file[0],GetAbsoluteFileName($file[1]));
		if(strtoupper(substr(PHP_OS,0,3))!="WIN")
			@chmod($file[1],0777);
	}
	foreach($files_save as $file)
	{		
		myfile_put_contents(GetAbsoluteFileName($file["filename"]), $file["file"]);
	}
	if ( $inlineedit==ADD_INLINE ) 
	{
		$status="ADDED";
		$message=""."Record was added"."";
		$IsSaved = true;
	} 
	else
		$message="<div class=message><<< "."Record was added"." >>></div>";
	if($usermessage!="")
		$message = $usermessage;
	if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY || function_exists("AfterAdd"))
	{
		$failed_inline_add = false;
		$keyfields=GetTableKeys();
		foreach($keyfields as $k)
		{
			if(array_key_exists($k,$avalues))
				$keys[$k]=$avalues[$k];
			elseif(IsAutoincField($k))
			{
							$keys[$k]=mysql_insert_id($conn);
			}
			else
				$failed_inline_add = true;
		}
	}
	return true;
}

function add_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readavalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit!=ADD_SIMPLE ) 
		$message=""."Record was NOT added".". ".$errstr;
	else  
		$message="<div class=message><<< "."Record was NOT added"." >>><br><br>".$errstr."</div>";
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

function mdeleteIndex($i)
{
	return $i-1;
}

//	display error message
function error_handler($errno, $errstr, $errfile, $errline)
{
	global $strLastSQL;

	if ($errno==2048)
		return 0;	

	if($errno==2 && strpos($errstr,"has been disabled for security reasons"))
		return 0;
	if($errno==2 && strpos($errstr,"Data is not in a recognized format"))
		return 0;
	if($errno==8 && !strncmp($errstr,"Undefined index",15))
		return 0;
	if(strpos($errstr,"It is not safe to rely on the system's timezone settings."))
		return 0;
	
	$solution = get_error_string($errstr);	
?>
</form>
<p align=center><font size=+2>php <?php echo "error happened";?></font></p>
<table border="0" cellpadding="3" cellspacing="1" width="700" bgcolor="#000000" align="center">
<tr><td bgcolor="#ccccff" colspan=2 align=middle><font size=+1><b><?php echo "Technical information";?></b></font></td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b><?php echo "Error type";?></b></td><td align="left"><?php echo $errno; ?></td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b><?php echo "Error description";?></b></td><td align="left"><font color=#cc3300><?php echo $errstr?></font></td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b>URL</b></td><td align="left"><?php echo $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]; if(array_key_exists("QUERY_STRING",$_SERVER)) echo "?".htmlspecialchars($_SERVER["QUERY_STRING"]);?> </td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b><?php echo "Error file";?></b></td><td align="left"><?php echo $errfile;?></td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b><?php echo "Error line";?></b></td><td align="left"><?php echo $errline;?></td></tr>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff" ><b><?php echo "SQL query";?></b></td><td align="left"><?php if(isset($strLastSQL)) echo htmlspecialchars(substr($strLastSQL,0,1024));?></td></tr>
<?php if ($solution) 
{?>
<tr bgcolor="#cccccc"><td bgcolor="#ccccff"><b>Solution</b></td><td align="left"><font color=#cc3300><?php echo $solution?></font></td></tr>
<?php } ?>
</table>
<?php
  exit(0);
}

function GetMySQL4RowCount($countstr)
{
	global $conn;
	$countrs = db_query($countstr,$conn);
	return mysql_num_rows($countrs);
}
function CreateFCKeditor($cfield, $value, $nWidth, $nHeight)
{
	$oFCKeditor = new FCKeditor($cfield);
	$oFCKeditor->BasePath = 'plugins/fckeditor/';
	$oFCKeditor->Value = $value;
	$oFCKeditor->Width=$nWidth;
	$oFCKeditor->Height=$nHeight;
	$oFCKeditor->Create();
	return $oFCKeditor;
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

function format_number($val)
{
	return str_format_number($val);
}

function format_datetime($time)
{
	return str_format_datetime($time);
}

function format_time($time)
{
	return str_format_time($time);
}


?>