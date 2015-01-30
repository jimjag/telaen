<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require_once './inc/preinit.php';
$TLN = new Telaen();
$TLN->loadConfig();
require_once './inc/errorhandler.php';

extract(Telaen::pullFromArray($_GET, array('f_email', 'f_user', 'lng', 'tem', 'six'), 's'));
require_once './inc/user_tl.php';

require_once $TLN->config['SMARTY_DIR'].'Smarty.class.php';
$smarty = new Smarty();
$smarty_compile_dir  = $TLN->config['temporary_directory'].'/smarty_ct/';
$smarty->setCompileDir($smarty_compile_dir);
$smarty->setConfigDir('./inc/langs');
$smarty->setTemplateDir('./inc/themes');

$smarty->use_sub_dirs = true;
if (!is_dir($smarty_compile_dir)) {
    mkdir($smarty_compile_dir, (isset($TLN->config['dirperm']) ? $TLN->config['dirperm'] : "0755"));
}

$smarty->assign('umLabel', $lang);

// Assign also the webmail title to smarty, check for empty title before
if (!isset($TLN->config['webmail_title'])) {
    $TLN->config['webmail_title'] = 'Telaen Webmail';
}
$smarty->assign('webmailTitle', $TLN->config['webmail_title']);

// the header and footer paths because inc.php is not loaded in index
$smarty->assign('headerTemplate', $header_template);
$smarty->assign('footerTemplate', $footer_template);

// Detect errors
if (isset($_GET['err'])) {
    $smarty->assign('errorCode', $_GET['err']);
    $smarty->assign('error', 'true');
} else {
    $smarty->assign('error', 'false');
}

$jssource = "
<script language=\"javascript\" type=\"text/javascript\">
//<![CDATA[
	function selectLanguage() {
		sSix		= '';
		sUser		= '';
		sEmail		= '';
		sLanguage	= '';
		sTheme		= '';

		try {
			frm = document.forms[0];
			if(frm.six && frm.six.options)
				sSix = frm.six.options[frm.six.selectedIndex].value;
			if(frm.f_user)
				sUser = frm.f_user.value;
			if(frm.f_email)
				sEmail = frm.f_email.value;
			if(frm.tem)
				sTheme = frm.tem.options[frm.tem.selectedIndex].value;
			if(frm.lng)
				sLanguage = frm.lng.options[frm.lng.selectedIndex].value;
			sLocation = 'index.php?lng='+sLanguage+'&tem='+sTheme+'&f_user='+escape(sUser)+'&six='+sSix+'&f_email='+sEmail;
			location.replace(sLocation);
		} catch(err) {
			alert('Your browser does not support JS'); // Vola: this is stupid... if js doesn't work also alert doesn't work :)
		}
	}
//]]>
</script>
";

//$smarty->debugging = true;
$mail_server_type = strtoupper($TLN->config['mail_server_type']);
$smarty->assign('umServerType', $mail_server_type);

switch ($mail_server_type) {
    case 'ONE-FOR-ALL':
    case 'DETECT':
        break;
    case 'ONE-FOR-EACH':
        $aval_servers = count($TLN->config['mail_servers']);
        $smarty->assign('umAvailableServers', $aval_servers);
        if (!$aval_servers) {
            die("You must set at least one server in \$mail_servers, please review your configv2.php");
        }
        if ($aval_servers == 1) {
            $strServers = '@'.$TLN->config['mail_servers'][0]['domain']." <input type=\"hidden\" name=\"six\" value=\"0\" />";
        } else {
            $strServers = "<select name=\"six\">\r";
            for ($i = 0;$i<$aval_servers;$i++) {
                $sel = ($i == $six) ? "selected=\"selected\"" : "";
                $strServers .= "<option value=\"$i\" $sel>@".$TLN->config['mail_servers'][$i]["domain"]."</option> \r";
            }
            $strServers .= "</select>\r";
        }
        $smarty->assign('umServer', $strServers);
        break;
    default:
        die("Bad mail_server_type: {$mail_server_type}");
}

$smarty->assign('umEmail', $f_email);
$smarty->assign('umUser', $f_user);
$smarty->assign('umPass', $f_pass);
$smarty->assign('umJS', $jssource);

if (count($TLN->config['languages']) == 0) {
    die('You must provide at least one language');
}

if (count($TLN->config['themes']) == 0) {
    die('You must provide at least one theme');
}

$smarty->assign('umAllowSelectLanguage', $TLN->config['allow_user_change_language']);
printf($textout);

if ($TLN->config['allow_user_change_language']) {
    $langsel = "<select name=\"lng\" onchange=\"selectLanguage()\">\r";
    foreach ($TLN->config['languages'] as $key => $val) {
        if (!is_file("./inc/langs/{$key}.php")) continue;
        $selected = ($langz == $key) ? "selected=\"selected\"" : "";
        $langsel .= "<option value=\"$key\" $selected>".$val."</option> \r";
    }
    $langsel .= "</select>\r";
    $smarty->assign("umLanguages", $langsel);
}

$smarty->assign('umAllowSelectTheme', $TLN->config['allow_user_change_theme']);

if ($TLN->config['allow_user_change_theme']) {
    $themsel = "<select name=\"tem\" onchange=\"selectLanguage()\">\r";
    foreach ($TLN->config['themes'] as $key => $val) {
        $selected = ($themez == $key) ? "selected=\"selected\"" : "";
        $themsel .= "<option value=\"$key\" $selected>".$val."</option> \r";
    }
    $themsel .= "</select>\r";
    $smarty->assign('umThemes', $themsel);
}

$smarty->display("$themez/login.tpl");
