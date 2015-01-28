<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';

if (!isset($folder) || !isset($uidl)) {
    die('Expected parameters');
}
$msg = $TLN->tdb->get_message($uidl, $folder);
$body = $TLN->mail_retr_msg($msg);
//$meta_charset = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$lang['default_char_set']."\">";
echo($pmetas);
//echo($meta_charset);
echo($body);
