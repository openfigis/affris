<?php




































function vw_species_Snippet1(&$params)
{
// Put your code here.
$str = "";

$str.= "<select onchange=\"window.location.href=this.options[this.selectedIndex].

  value;\"><option value=\"\">Please select</option>";

//
//select values from database

global $conn;

$strSQL = "select Group from vw_species";

$rs = db_query($strSQL,$conn);

while ($data = db_fetch_array($rs))

  $str.="<option value=\"vw_species_list.php?ctlSearchFor=".$data["Group"].

    "&srchOptShowStatus=1&ctrlTypeComboStatus=0&srchWinShowStatus=0&a=integrated&id=1&criteria=and&type1=&value11=".

    $data["Group"]."&field1=Group&option1=Contains&not1=a=search&value=1\">".$data["Group"]."</option>";



$str.="</select>";

echo $str;
;
}

?>