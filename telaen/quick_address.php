<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

extract(Telaen::pullFromArray($_GET, array('where'), 'str'));
extract(Telaen::pullFromArray($_POST, array('contacts'), 'str'));

$filename = $TLN->userdatafolder.'/addressbook.ucf';
$myfile = $TLN->blob($TLN->readFile($filename, false), false);
if ($myfile != "") {
    $addressbook = unserialize(base64_decode($myfile));
}
$TLN->arrayQsort2ic($addressbook, 'name');

switch ($where) {
case 'cc':
    $listbox = "<select name=\"contacts\" size=\"10\" onDblClick=\"Add('cc')\">\r\n";
    break;
case 'bcc':
    $listbox = "<select name=\"contacts\" size=\"10\" onDblClick=\"Add('bcc')\">\r\n";
    break;
default:
    $listbox = "<select name=\"contacts\" size=\"10\" onDblClick=\"Add('to')\">\r\n";
    break;
}

for ($i = 0;$i<count($addressbook);$i++) {
    $line = $addressbook[$i];
    $name = htmlspecialchars(trim($line['name']));
    $email = htmlspecialchars(trim($line['email']));
    $listbox .= "<option value=\"&quot;$name&quot; &lt;$email&gt;\"> &quot;$name&quot; &lt;$email&gt; </option>";
}
$listbox .= '</select>';

$smarty->assign('umContacts', $listbox);
$smarty->display("$themez/quick_address.tpl");
