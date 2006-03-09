<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

require("./inc/inc.php");

$filename = $userfolder."_infos/addressbook.ucf";
$myfile = $UM->_read_file($filename);
if($myfile != "") 
	$addressbook = unserialize(base64_decode($myfile));
array_qsort2ic($addressbook,"name");

switch($where) {
case "cc":
	$listbox = "<select name=contacts size=10 onDblClick=\"Add('cc')\">\r\n";
	break;
case "bcc":
	$listbox = "<select name=contacts size=10 onDblClick=\"Add('bcc')\">\r\n";
	break;
default:
	$listbox = "<select name=contacts size=10 onDblClick=\"Add('to')\">\r\n";
	break;
}

for($i=0;$i<count($addressbook);$i++) {
	$line = $addressbook[$i];
	$name = htmlspecialchars(trim($line["name"]));;
	$email = htmlspecialchars(trim($line["email"]));
	$listbox .= "<option value=\"&quot;$name&quot; &lt;$email&gt;\"> &quot;$name&quot; &lt;$email&gt;";
}
$listbox .= "</select>";


$smarty->assign("umContacts",$listbox);
$smarty->display("$selected_theme/quick_address.htm");

?>
