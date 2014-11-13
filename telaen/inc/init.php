<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

defined('I_AM_TELAEN') or die('Direct access not permitted');

if(function_exists("date_default_timezone_set") && function_exists("date_default_timezone_get"))
        @date_default_timezone_set(@date_default_timezone_get());

@set_time_limit(0);
session_name('telaen');
session_start();
$sid = session_id();
/* We grab the actual session data below with the Session class */

require_once("./inc/config/config.php");
require_once("./inc/errorhandler.php");
require_once("./inc/class/class.telaen.php");
require_once("./inc/lib.php");
require_once("./inc/preinit.php");
require_once("./inc/class/class.mymonth.php");


require_once(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;
$smarty->security=true;
$smarty->secure_dir=array("./");
$smarty->compile_dir = $temporary_directory;
$smarty->template_dir =	 './themes';
$smarty->config_dir = './langs';
$smarty->use_sub_dirs = true;

$AuthSession = New Session();
$auth = &$AuthSession->Load('telaen_sess');

// Only process.php is allowed to be run with expired sessions (for login)
if((I_AM_TELAEN != "process.php") && (!$auth["auth"])) { die("error: your session seems expired"); }

if(!array_key_exists("start",$auth)) $auth["start"] = time();
$start = $auth["start"];

/*
 * Now load in stored tid and lid, if they exist.
 * otherwise, we init them and store them
 */
require("./inc/user_tl.php");

// Assing to smarty the paths for include dinamically menu/header/footer
$smarty->assign("menuTemplate", $menu_template);
$smarty->assign("calendarTemplate", $calendar_template);
$smarty->assign("newsTemplate", $news_template);
$smarty->assign("headerTemplate", $header_template);
$smarty->assign("footerTemplate", $footer_template);
$smarty->assign("popupHeaderTemplate", $popup_header_template);

// For debug in smarty
//$smarty->debugging = true;

$smarty->assign("umLanguageFile",$selected_language.".txt");

// setlocale(LC_ALL, $languages[$lid]['locale']);

// Assign also the webmail title to smarty, check for empty title before
if (!isset($webmail_title) || trim($webmail_title) == "" ) {
	$webmail_title = "Telaen Webmail"; 
}
$smarty->assign("webmailTitle", $webmail_title);

$TLN = new Telaen();

if(isset($f_pass)) { $f_pass = stripslashes($f_pass); }
if(isset($f_pass) && strlen($f_pass) > 0) {

	// Clean up
	if(isset($f_email)) { $f_email = stripslashes($f_email); }
	if(isset($f_user)) { $f_user = stripslashes($f_user); }
	if(isset($f_server)) { $f_server = stripslashes($f_server); }

	if(isset($f_email) && !PHPMailer::validateAddress($f_email)) { $f_email = "unknown@example.com"; }
	if(isset($f_user) && !PHPMailer::validateAddress("$f_user@example.com")) { $f_user = "unknown"; }

	switch(strtoupper($mail_server_type)) {

	case "DETECT":
		$f_server	= strtolower(getenv("HTTP_HOST"));
		$f_server	= str_replace($mail_detect_remove,"",$f_server);
		$f_server	= $mail_detect_prefix.$f_server;

		if(preg_match('|(.*)@(.*)|',$f_email,$regs)) {
			$f_user = trim($regs[1]);
			$domain = trim($regs[2]);
			if($mail_detect_login_type != "") $f_user = preg_replace("/%user%/i",$f_user,preg_replace("/%domain%/i",$domain,$mail_detect_login_type));
		}

		$f_protocol	= $mail_detect_protocol;
		$f_port		= $mail_detect_port;
		$f_prefix	= $mail_detect_folder_prefix;

		break;

	case "ONE-FOR-EACH": 
		$domain			= trim($mail_servers[$six]["domain"]);
		$f_email		= $f_user."@".$domain;
		$f_server		= $mail_servers[$six]["server"];
		$login_type			= $mail_servers[$six]["login_type"];

		$f_protocol		= $mail_servers[$six]["protocol"];
		$f_port			= $mail_servers[$six]["port"];
		$f_prefix		= $mail_servers[$six]["folder_prefix"];

		if($login_type != "") $f_user = preg_replace("/%user%/i",$f_user,preg_replace("/%domain%/i",$domain,$login_type));
		break;

	case "ONE-FOR-ALL": 
		if(preg_match('|(.*)@(.*)|',$f_email,$regs)) {
			$f_user = trim($regs[1]);
			$domain = trim($regs[2]);
			if($one_for_all_login_type != "") $f_user = preg_replace("/%user%/i",$f_user,preg_replace("/%domain%/i",$domain,$one_for_all_login_type));
		}
		$f_server	= $default_mail_server;
		$f_protocol	= $default_protocol;
		$f_port		= $default_port;
		$f_prefix	= $default_folder_prefix;

		break;
	}

	$TLN->mail_email		= $auth["email"]	= $f_email	= trim(stripslashes($f_email));
	$TLN->mail_user		= $auth["user"]		= $f_user	= trim(stripslashes($f_user));
	$TLN->mail_pass		= $auth["pass"]		= $f_pass	= stripslashes($f_pass);
	$TLN->mail_server	= $auth["server"]	= $f_server	= stripslashes($f_server);

	$TLN->mail_port		= $auth["port"]			= $f_port;
	$TLN->mail_protocol	= $auth["protocol"]		= (strcasecmp($f_protocol, "pop3") ? IMAP : POP3);
	$TLN->mail_prefix	= $auth["folder_prefix"]	= $f_prefix;

	$pop3capa = $TLN->mail_pop3_capa();
	$TLN->havepipelining	= $auth["havepipelining"]	= ( isset($mail_use_pipelining) ? $mail_use_pipelining : $pop3capa["PIPELINING"] );
	$TLN->haveatop		= $auth["haveatop"]		= ( isset($mail_use_atop) ? $mail_use_atop : $pop3capa["ATOP"] );
	$TLN->haveuidl		= $auth["haveuidl"]		= ( isset($mail_use_uidl) ? $mail_use_uidl : $pop3capa["UIDL"] );
	$TLN->haveapop		= $auth["haveapop"]		= ( isset($mail_use_apop) ? $mail_use_apop : $pop3capa["APOP"] );

	$refr = 1;

	if (is_array($quota_limits)) {
		foreach ($quota_limits as $quota) {
			if (preg_match($quota[0], $TLN->mail_user)) {
				$quota_limit = $quota[1];
			}
		}
	}
	
	$auth["quota_limit"] = $quota_limit;
	
} elseif ($auth["auth"] && ((time() - $start) < ($idle_timeout * 60)) ) {

	$TLN->mail_user		= $f_user	= $auth["user"];
	$TLN->mail_pass		= $f_pass	= $auth["pass"];
	$TLN->mail_server	= $f_server	= $auth["server"];
	$TLN->mail_email		= $f_email	= $auth["email"];

	$TLN->mail_port		= $f_port	= $auth["port"];
	$TLN->mail_protocol	= $f_protocol	= $auth["protocol"];
	$TLN->mail_prefix	= $f_prefix	= $auth["folder_prefix"];

	$TLN->havepipelining	= $auth["havepipelining"];
	$TLN->haveatop		= $auth["haveatop"];
	$TLN->haveuidl		= $auth["haveuidl"];
	$TLN->haveapop		= $auth["haveapop"];
	
	$quota_limit		= $auth["quota_limit"];

} else {		
		// session expired
		redirect_and_exit("index.php?err=4");
}

$auth["start"] = time();

$AuthSession->Save($auth);

$userfolder = $temporary_directory.preg_replace("/[^a-z0-9\._-]/","_",strtolower($f_user))."_".strtolower($f_server)."/";

$UserMbox = new Mbox();
$mbox = &$UserMbox->Load($userfolder."_infos/mboxes.ucf");

$TLN->debug			= $enable_debug;
$TLN->use_html			= $allow_html;

$TLN->user_folder		= $userfolder;
$TLN->temp_folder		= $temporary_directory;
$TLN->timeout			= $idle_timeout;

// avoid missing settings allow dirs creation with 000 perms
if (isset($dirperm) && $dirperm != 0000) {
	$TLN->dirperm = $dirperm;
}

$prefs = load_prefs();

$mymo = new MyMonth();     // needs $prefs[], $UM and $userfolder!
$mycal = $mymo->monthAsDiv();
$smarty->assign("umCalendar",$mycal);
$smarty->assign("umSystemNews",$systemNews);

$TLN->timezone			= $prefs["timezone"];
$TLN->charset			= $default_char_set;
$TLN->userspamlevel		= $prefs["spamlevel"];


/*
Don't remove the following lines, or you will have problems with browser's cache
*/
Header("Expires: Wed, 11 Nov 1998 11:11:11 GMT");
Header("Cache-Control: no-cache");
Header("Cache-Control: must-revalidate");
Header("Pragma: no-cache");

// No cache metas
$nocache = "
	<meta http-equiv=\"Cache-Control\" content=\"no-cache\" />
	<meta http-equiv=\"Expires\" content=\"-1\" />
	<meta http-equiv=\"Pragma\" content=\"no-cache\" />";

// Common js included system-wide
$commonJS = "
	<script type=\"text/javascript\" src=\"./js/ajax_prototype.js\"></script>
	<script type=\"text/javascript\" src=\"./js/common.js\"></script>
";

// Include also folder list
require_once("./folder_list.php");

// Sort rules

$need_save = false;
if(!isset($sortby) || !preg_match('/(subject|fromname|date|size|toname)/',$sortby)) {
	if(array_key_exists("sort-by",$prefs) && preg_match('/(subject|fromname|date|size|toname)/',$prefs["sort-by"]))
		$sortby = $prefs["sort-by"];
	else
		$sortby = $default_sortby;
} else {
	$need_save = true;
	$prefs["sort-by"] = $sortby;
}

if(!isset($sortorder) || !preg_match('/ASC|DESC/',$sortorder)) {
	if(array_key_exists("sort-order",$prefs) && preg_match('/ASC|DESC/',$prefs["sort-order"]))
		$sortorder = $prefs["sort-order"];
	else
		$sortorder = $default_sortorder;
} else {
	$need_save = true;
	$prefs["sort-order"] = $sortorder;
}

if(isset($need_save)) 
	save_prefs($prefs);

if(!isset($folder) || $folder == "" || strpos($folder,"..") !== false ) 
	$folder = "inbox";
elseif (!file_exists($userfolder.$TLN->fix_prefix($folder,1))) { 
	redirect_and_exit("logout.php"); 
}

?>
