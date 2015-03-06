<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
require './inc/vendor/vCard.php';

/* @var $TLN Telaen */

extract(Telaen::pullFromArray($_GET, ['where'], 'str'));
extract(Telaen::pullFromArray($_POST, ['contacts'], 'str'));

$filename = $TLN->userdatafolder.'/'.$addressBook;
$myfile = $TLN->blob($TLN->readFile($filename, false), false);
if ($myfile != "") {
    $mab = unserialize(base64_decode($myfile));
}
ksort($mab);

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

foreach ($mab as $k => $a) {
    $v = new vCard(false, $a);
    $name = htmlspecialchars(trim($v->fn[0]));
    $email = htmlspecialchars(trim($v->email[0]['value']));
    $listbox .= "<option value=\"&quot;$name&quot; &lt;$email&gt;\"> &quot;$name&quot; &lt;$email&gt; </option>";
}
$listbox .= '</select>';

$smarty->assign('smContacts', $listbox);
$smarty->display("$themez/quick_address.tpl");
