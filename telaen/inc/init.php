<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/*
 * Initialize a working Telaen session
 */
defined('I_AM_TELAEN') or die('Direct access not permitted');

@date_default_timezone_set(@date_default_timezone_get());

@set_time_limit(0);
session_name('telaen');
session_start();
$sid = session_id();
/* We grab the actual session data below with the Session class */

require_once './inc/preinit.php';

/* @var $TLN Telaen */
$TLN = new Telaen();

$AuthSession = new Session($sid);
$auth = &$AuthSession->Load('telaen_sess');
$TLN->AuthSession = $AuthSession;
if ($auth['auth'] && isset($auth['config'])) {
    $TLN->config = $auth['config'];
} else {
    $TLN->loadConfig();
    $auth['config'] = $TLN->config;
}

if (!empty($TLN->config['appname'])) {
    $TLN->appname = $TLN->config['appname'];
}
umask($TLN->config['default_umask']);

require_once './inc/errorhandler.php';

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
$initial_login = false;


// Only process.php is allowed to be run with expired sessions (for login)
if ((I_AM_TELAEN != 'process.php') && (!$auth['auth'])) {
    $TLN->redirectAndExit('index.php?err=4', true);
}

if (!isset($auth['start'])) {
    $auth['start'] = $TLN->now();;
}
$start = $auth['start'];

/*
 * Now load in stored tid and lid, if they exist.
 * otherwise, we init them and store them
 */
require './inc/user_tl.php';

// Assing to smarty the paths for include dinamically menu/header/footer
$smarty->assign('menuTemplate', $menu_template);
$smarty->assign('calendarTemplate', $calendar_template);
$smarty->assign('newsTemplate', $news_template);
$smarty->assign('headerTemplate', $header_template);
$smarty->assign('footerTemplate', $footer_template);
$smarty->assign('popupHeaderTemplate', $popup_header_template);

// For debug in smarty
//$smarty->debugging = true;

$smarty->assign('umLabel', $lang);

// setlocale(LC_ALL, $languages[$lid]['locale']);

// Assign also the webmail title to smarty, check for empty title before
if (!isset($TLN->config['webmail_title'])) {
    $TLN->config['webmail_title'] = 'Telaen Webmail';
}
$smarty->assign('webmailTitle', $TLN->config['webmail_title']);

if (!empty($f_pass)) {
    /*
     * We are logging in...
     */
    switch (strtoupper($TLN->config['mail_server_type'])) {
        case 'DETECT':
            if (!isset($f_email)) $TLN->redirectAndExit('index.php');
            $f_server = strtolower(getenv('HTTP_HOST'));
            $f_server = str_replace($TLN->config['mail_detect_remove'], "", $f_server);
            $f_server = $TLN->config['mail_detect_prefix'].$f_server;

            if (preg_match('|(.*)@(.*)|', $f_email, $regs)) {
                $f_user = trim($regs[1]);
                $domain = trim($regs[2]);
                if ($TLN->config['mail_detect_login_type'] != "") {
                    $f_user = preg_replace('/%user%/i', $f_user, preg_replace('/%domain%/i', $domain, $TLN->config['mail_detect_login_type']));
                }
            }

            $f_protocol = $TLN->config['mail_detect_protocol'];
            $f_port = $TLN->config['mail_detect_port'];
            $f_prefix = $TLN->config['mail_detect_folder_prefix'];
            break;
        case 'ONE-FOR-EACH':
            if (!isset($f_user)) $TLN->redirectAndExit('index.php');
            $domain = trim($TLN->config['mail_servers'][$six]['domain']);
            $f_email = $f_user.'@'.$domain;
            $f_server = $TLN->config['mail_servers'][$six]['server'];
            $login_type = $TLN->config['mail_servers'][$six]['login_type'];

            $f_protocol = $TLN->config['mail_servers'][$six]['protocol'];
            $f_port = $TLN->config['mail_servers'][$six]['port'];
            $f_prefix = $TLN->config['mail_servers'][$six]['folder_prefix'];

            if ($login_type != "") {
                $f_user = preg_replace('/%user%/i', $f_user, preg_replace('/%domain%/i', $domain, $login_type));
            }
            break;
        case 'ONE-FOR-ALL':
            if (!isset($f_email)) $TLN->redirectAndExit('index.php');
            if (preg_match('|(.*)@(.*)|', $f_email, $regs)) {
                $f_user = trim($regs[1]);
                $domain = trim($regs[2]);
                if ($TLN->config['one_for_all_login_type'] != "") {
                    $f_user = preg_replace('/%user%/i', $f_user, preg_replace('/%domain%/i', $domain, $TLN->config['one_for_all_login_type']));
                }
            }
            $f_server = $TLN->config['default_mail_server'];
            $f_protocol = $TLN->config['default_protocol'];
            $f_port = $TLN->config['default_port'];
            $f_prefix = $TLN->config['default_folder_prefix'];
            break;
        default:
            die("Bad mail_server_type: {$TLN->config['mail_server_type']}");
    }

    $TLN->mail_email = $auth['email'] = $f_email = trim(stripslashes($f_email));
    $TLN->mail_user = $auth['user'] = $f_user = trim(stripslashes($f_user));
    $TLN->mail_pass = $auth['pass'] = $f_pass = stripslashes($f_pass);
    $TLN->mail_server = $auth['server'] = $f_server = trim(stripslashes($f_server));

    $TLN->mail_port = $auth['port'] = $f_port;
    $TLN->mail_protocol = $auth['protocol'] = (strcasecmp($f_protocol, 'pop3') ? IMAP : POP3);
    $TLN->mail_prefix = $auth['folder_prefix'] = $f_prefix;

    if (!$TLN->mailConnect()) $TLN->redirectAndExit('index.php?err=1', true);
    $TLN->mailCapa();
    $auth['capabilities'] = $TLN->capabilities;
    if (!$TLN->mailAuth()) $TLN->redirectAndExit('index.php');
    $auth['auth'] = true;
    $initial_login = true;

    $refr = 1;

    if (is_array($TLN->config['quota_limits'])) {
        foreach ($TLN->config['quota_limits'] as $quota) {
            if (preg_match($quota[0], $TLN->mail_user)) {
                $quota_limit = $quota[1];
                break;
            }
        }
    }
    $quota_limit = Telaen::bkmg2bytes($quota_limit); // ensure bytes
    $auth['quota_limit'] = $quota_limit;
} elseif ($auth['auth'] && (($TLN->now() - $start) < ($TLN->config['idle_timeout'] * 60))) {
    $TLN->mail_user = $f_user = $auth['user'];
    $TLN->mail_pass = $f_pass = $auth['pass'];
    $TLN->mail_server = $f_server = $auth['server'];
    $TLN->mail_email = $f_email = $auth['email'];

    $TLN->mail_port = $f_port = $auth['port'];
    $TLN->mail_protocol = $f_protocol = $auth['protocol'];
    $TLN->mail_prefix = $f_prefix = $auth['folder_prefix'];

    $TLN->capabilities = $auth['capabilities'];

    $quota_limit = $auth['quota_limit'];
} elseif ($auth['auth']) {
    $AuthSession->Kill();
    $TLN->redirectAndExit('index.php?err=4');
} else {
    $TLN->redirectAndExit('index.php');
}

/*
 * Everything after this assumes an authenticated user
 */
$auth['start'] = $TLN->now();

$TLN->userfolder = $TLN->config['temporary_directory'].preg_replace('/[^a-z0-9\._-]/', '_', strtolower($f_user)).'_'.strtolower($f_server).'/';

// avoid missing settings allow dirs creation with 000 perms
if (isset($TLN->config['dirperm']) && $TLN->config['dirperm'] != 0000) {
    $TLN->dirperm = $TLN->config['dirperm'];
}

$TLN->initTdb(($TLN->mail_protocol == IMAP) && $TLN->prefs['keep_on_server'] && $initial_login);
$tdb = &$TLN->tdb;
$TLN->userdatafolder = $TLN->userfolder.$tdb->udatafolder;
$TLN->loadPrefs();

$TLN->displayimages = $TLN->prefs['display_images'];
$TLN->sanitize = ($TLN->config['sanitize_html'] || !$TLN->config['allow_scripts']);

/*
 * Special case: Always start w/ fresh inbox cache for POP3 if we aren't
 * their exclusive email client
 */
if (($TLN->mail_protocol == POP3) && $TLN->prefs['keep_on_server'] && $initial_login) {
    $tdb->delFolder('inbox');
    $tdb->newFolder('inbox');
}
$AuthSession->Save($auth);

$mymo = new MyMonth($TLN->userdatafolder);
$mycal = $mymo->monthAsDiv();
$smarty->assign('umCalendar', $mycal);
$smarty->assign('umSystemNews', $TLN->config['systemNews']);

$TLN->charset = $lang['default_char_set'];

/*
Don't remove the following lines, or you will have problems with browser's cache
*/
@Header('Expires: Wed, 11 Nov 1998 11:11:11 GMT');
@Header('Cache-Control: no-cache');
@Header('Cache-Control: must-revalidate');
@Header('Pragma: no-cache');

// No cache metas
$pmetas = "
	<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />
	<meta http-equiv=\"Expires\" content=\"-1\" />
	<meta http-equiv=\"Pragma\" content=\"no-cache\" />
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";

// Common js included system-wide
$commonJS = <<<'EOD'
	<script type='text/javascript' src='./inc/js/jquery-1.11.2.min.js'></script>
	<script type='text/javascript' src='./inc/js/jquery.form.min.js'></script>
	<script type='text/javascript' src='./inc/js/common.js'></script>
	<script language='javascript' type='text/javascript'>
	//<![CDATA[
	function newmsg() { location = 'newmsg.php'; }
	function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'; }
	function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true'; }
	function search() { location = 'search.php?folder=".urlencode($folder)."'; }
	//]]>
	</script>
EOD;

// Include also folder list
require_once './inc/folder_list.php';

// Sort rules

$need_save = false;
if (!isset($sortby) || !preg_match('/(subject|fromname|date|size|toname)/', $sortby)) {
    if (isset($TLN->prefs['sortby']) && preg_match('/(subject|fromname|date|size|toname)/', $TLN->prefs['sortby'])) {
        $sortby = $TLN->prefs['sortby'];
    } else {
        $sortby = $TLN->config['default_sortby'];
    }
} else {
    $need_save = true;
    $TLN->prefs['sortby'] = $sortby;
}

if (!isset($sortorder) || !preg_match('/ASC|DESC/', $sortorder)) {
    if (isset($TLN->prefs['sortorder']) && preg_match('/ASC|DESC/', $TLN->prefs['sortorder'])) {
        $sortorder = $TLN->prefs['sortorder'];
    } else {
        $sortorder = $TLN->config['default_sortorder'];
    }
} else {
    $need_save = true;
    $TLN->prefs['sortorder'] = $sortorder;
}

if ($TLN->prefs['refresh_time'] < 5) {
    $TLN->prefs['refresh_time'] = 5;
    $need_save = true;
}
if (isset($need_save)) {
    $TLN->savePrefs($TLN->prefs);
}
//
if ($initial_login) {
    $TLN->prepLocalDirs();
    // In case not cleaned-up by logging out, do-so now
    $TLN->cleanupDirs($TLN->userfolder);
}
$folders = $TLN->mailListBoxes();
if (empty($folders[$folder])) {
    $TLN->redirectAndExit('logout.php');
}