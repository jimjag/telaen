<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

extract(Telaen::pull_from_array($_GET, array('where'), 'str'));
extract(Telaen::pull_from_array($_POST, array('contacts'), 'str'));

$filename = $TLN->userdatafolder.'/addressbook.ucf';
$myfile = $TLN->read_file($filename);
if ($myfile != "") {
    $addressbook = unserialize(base64_decode($myfile));
}
$TLN->array_qsort2ic($addressbook, 'name');

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
$smarty->display("$selected_theme/quick_address.tpl");
