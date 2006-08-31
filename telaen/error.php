<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

// load configs
require("./inc/config.php");
require("./inc/lib.php");
require("./inc/preinit.php");
require("./inc/user_tl.php");

require_once(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;
$smarty->security=true;
$smarty->secure_dir=array("./");
$smarty->compile_dir = $temporary_directory;
$smarty->template_dir =  './themes';
$smarty->config_dir = './langs';
$smarty->use_sub_dirs = true;

$smarty->assign("umLanguageFile",$selected_language.".txt");

// Assign also the webmail title to smarty, check for empty title before
if (!isset($webmail_title) || trim($webmail_title) == "" ) {
	$webmail_title = "Telaen Webmail";
}
$smarty->assign("webmailTitle", $webmail_title);

// Assing the header and footer paths because inc.php is not loaded in index
$smarty->assign("headerTemplate", $header_template);
$smarty->assign("footerTemplate", $footer_template);

if($phpver >= 4.1) {
	extract($_GET);
}

$smarty->assign("umErrorCode",$err);

$smarty->display("$selected_theme/error.htm");
?>
