<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

if (!isset($folder) || !isset($uidl)) {
    die('Expected parameters');
}
$msg = $TLN->tdb->getMessage($uidl, $folder);
$smarty->assign('umPageTitle', $msg['subject']);
$smarty->assign('umHeaders', preg_replace('/\t/', '&nbsp;&nbsp;&nbsp;&nbsp;', nl2br(htmlspecialchars($msg['header']))));
$smarty->display("$themez/headers-window.tpl");
