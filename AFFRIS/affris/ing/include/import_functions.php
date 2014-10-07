<?php
include("libs/excelreader.php");
function openImportExcelFile($uploadfile)
{
	$data = new Spreadsheet_Excel_Reader();
	$data->_defaultEncoding="Windows-1252";
	$data->read($uploadfile);
	return $data;
}
function getImportExcelFields($data)
{
	$fields = array();
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++)
	{
		$fields[] = trim($data->sheets[0]['cells'][1][$j]); 
	}
	return $fields;
}
function getImportExelData($data,$fields)
{
	global $total_records;
	for ($i = 0; $i <  $data->sheets[0]['numRows']-1; $i++) 
	{
		$arr = array();
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) 
		{
			if(array_key_exists($j,$data->sheets[0]['cells'][$i+2]))
				$arr[$fields[$j-1]] = $data->sheets[0]['cells'][$i+2][$j];
		}
		$ret = InsertRecord($arr, $i);
		$total_records++;
	}
}
function getImportTableName($tname)
{
	return $_FILES[$tname]['tmp_name'];
}
function db_exec_import($sql,$conn)
{
	set_error_handler("import_error_handler");
	return db_exec($sql,$conn);
}
function getImportCVSFields($uploadfile)
{
	$fcontents = file($uploadfile); 
	$line2 = trim($fcontents[0]);
	$fields = explode(",", $line2); 
	return $fields;
}
?>