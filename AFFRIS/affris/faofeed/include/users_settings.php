<?php

//	field labels
$fieldLabelsusers = array();
$fieldLabelsusers["English"]=array();
$fieldLabelsusers["English"]["ID"] = "ID";
$fieldLabelsusers["English"]["user"] = "User";
$fieldLabelsusers["English"]["pass"] = "Pass";


$tdatausers=array();
	 $tdatausers[".NumberOfChars"]=80; 
	$tdatausers[".ShortName"]="users";
	$tdatausers[".OwnerID"]="";
	$tdatausers[".OriginalTable"]="users";

	$keys=array();
	$keys[]="ID";
	$tdatausers[".Keys"]=$keys;

	
//	ID
	$fdata = array();
	
	
	
	$fdata["FieldType"]= 3;
		$fdata["AutoInc"]=true;
	$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "ID";
		$fdata["FullName"]= "ID";
	 $fdata["IsRequired"]=true; 
	
	
	
	$fdata["Index"]= 1;
	
			$fdata["EditParams"]="";
									$tdatausers["ID"]=$fdata;
	
//	user
	$fdata = array();
	 $fdata["Label"]="User"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Text field";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "user";
		$fdata["FullName"]= "`user`";
	
	
	
	
	$fdata["Index"]= 2;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
								$tdatausers["user"]=$fdata;
	
//	pass
	$fdata = array();
	 $fdata["Label"]="Pass"; 
	
	
	$fdata["FieldType"]= 200;
		$fdata["EditFormat"]= "Password";
	$fdata["ViewFormat"]= "";
	
	
		
				$fdata["NeedEncode"]=true;
	
	$fdata["GoodName"]= "pass";
		$fdata["FullName"]= "pass";
	
	
	
	
	$fdata["Index"]= 3;
	
			$fdata["EditParams"]="";
			$fdata["EditParams"].= " maxlength=50";
								$tdatausers["pass"]=$fdata;
$tables_data["users"]=&$tdatausers;
$field_labels["users"] = &$fieldLabelsusers;

?>