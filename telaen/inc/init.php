<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

@set_time_limit(0);
session_name('telaen');
session_start();
$sid = session_id();

require("./inc/config/config.php");
require("./inc/class/class.telaen.php");
require("./inc/lib.php");
require("./inc/preinit.php");
require("./inc/class/iCalcreator.class.php");
require("./inc/class/class.mymonth.php");


require_once(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;
$smarty->security=true;
$smarty->secure_dir=array("./");
$smarty->compile_dir = $temporary_directory;
$smarty->template_dir =	 './themes';
$smarty->config_dir = './langs';
$smarty->use_sub_dirs = true;

$SS = New Session();
$SS->temp_folder	= $temporary_directory;
$SS->sid		= $sid;
$SS->timeout		= $idle_timeout;

$sess = $SS->Load();


if(!array_key_exists("start",$sess)) $sess["start"] = time();
$start = $sess["start"];

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

// Assign also the webmail title to smarty, check for empty title before
if (!isset($webmail_title) || trim($webmail_title) == "" ) {
	$webmail_title = "Telaen Webmail"; 
}
$smarty->assign("webmailTitle", $webmail_title);

$UM = new Telaen();

if(isset($f_pass) && strlen($f_pass) > 0) {

	switch(strtoupper($mail_server_type)) {

	case "DETECT":
		$f_server	= strtolower(getenv("HTTP_HOST"));
		$f_server	= str_replace($mail_detect_remove,"",$f_server);
		$f_server	= $mail_detect_prefix.$f_server;
		$f_email	= trim($f_email);

		if(preg_match('|(.*)@(.*)|',$f_email,$regs)) {
			$f_user = trim($regs[1]);
			$domain = trim($regs[2]);
			if($mail_detect_login_type != "") $f_user = preg_replace("/%user%/i",$f_user,preg_replace("/%domain%/i",$domain,$mail_detect_login_type));
		}

		$f_protocol = $mail_detect_protocol;
		$f_port		= $mail_detect_port;
		$f_prefix	= $mail_detect_folder_prefix;

		break;

	case "ONE-FOR-EACH": 
		$f_user			= trim($f_user);
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
		$f_email	= trim($f_email);
		if(preg_match('|(.*)@(.*)|',$f_email,$regs)) {
			$f_user = trim($regs[1]);
			$domain = trim($regs[2]);
			if($one_for_all_login_type != "") $f_user = preg_replace("/%user%/i",$f_user,preg_replace("/%domain%/i",$domain,$one_for_all_login_type));
		}
		$f_server	= $default_mail_server;

		$f_protocol = $default_protocol;
		$f_port		= $default_port;
		$f_prefix	= $default_folder_prefix;

		break;
	}

	$UM->mail_email		= $sess["email"]	= $f_email	= trim(stripslashes($f_email));
	$UM->mail_user		= $sess["user"]		= $f_user	= trim(stripslashes($f_user));
	$UM->mail_pass		= $sess["pass"]		= $f_pass	= stripslashes($f_pass); 
	$UM->mail_server	= $sess["server"]	= $f_server = stripslashes($f_server); 

	$UM->mail_port		= $sess["port"]			= $f_port; 
	$UM->mail_protocol	= $sess["protocol"]			= $f_protocol; 
	$UM->mail_prefix	= $sess["folder_prefix"]	= $f_prefix; 

	$pop3capa = $UM->mail_pop3_capa();
	$UM->_havepipelining	= $sess["havepipelining"]	= ( isset($mail_use_pipelining) ? $mail_use_pipelining : $pop3capa["PIPELINING"] );
	$UM->_haveatop		= $sess["haveatop"]			= ( isset($mail_use_atop) ? $mail_use_atop : $pop3capa["ATOP"] );
	$UM->_haveuidl		= $sess["haveuidl"]			= ( isset($mail_use_uidl) ? $mail_use_uidl : $pop3capa["UIDL"] );
	$UM->_haveapop		= $sess["haveapop"]			= ( isset($mail_use_apop) ? $mail_use_apop : $pop3capa["APOP"] );

	$refr = 1;

	if (is_array($quota_limits)) {
		foreach ($quota_limits as $quota) {
			if (preg_match($quota[0], $UM->mail_user)) {
				$quota_limit = $quota[1];
			}
		}
	}
	
	$sess["quota_limit"] = $quota_limit;
	
} elseif ($sess["auth"] && ((time() - $start) < ($idle_timeout * 60)) ) {

	$UM->mail_user		= $f_user		= $sess["user"];
	$UM->mail_pass		= $f_pass		= $sess["pass"];
	$UM->mail_server	= $f_server		= $sess["server"];
	$UM->mail_email		= $f_email		= $sess["email"];

	$UM->mail_port		= $f_port	= $sess["port"]; 
	$UM->mail_protocol	= $f_protocol	= $sess["protocol"]; 
	$UM->mail_prefix	= $f_prefix		= $sess["folder_prefix"]; 

	$UM->_havepipelining	= $sess["havepipelining"];
	$UM->_haveatop		= $sess["haveatop"];
	$UM->_haveuidl		= $sess["haveuidl"];
	$UM->_haveapop		= $sess["haveapop"];
	
	$quota_limit		= $sess["quota_limit"];

} else {		
		// session expired
		redirect_and_exit("index.php?err=4");
}

$sess["start"] = time();

$SS->Save($sess);

$userfolder = $temporary_directory.preg_replace("/[^a-z0-9\._-]/","_",strtolower($f_user))."_".strtolower($f_server)."/";

$UM->debug			= $enable_debug;
$UM->use_html			= $allow_html;

$UM->user_folder		= $userfolder;
$UM->temp_folder		= $temporary_directory;
$UM->timeout			= $idle_timeout;

// avoid missing settings allow dirs creation with 000 perms
if (isset($dirperm) && $dirperm != 0000) {
	$UM->dirperm = $dirperm;
}

$prefs = load_prefs();

$mycal = new MyMonth();     // needs $prefs[], $UM and $userfolder!
$mycal = $mycal->monthAsDiv();
$smarty->assign("umCalendar",$mycal);
$smarty->assign("umSystemNews",$systemNews);

$UM->timezone			= $prefs["timezone"];
$UM->charset			= $default_char_set;
$UM->userspamlevel		= $prefs["spamlevel"];


/*
Don't remove the fallowing lines, or you will be problems with browser's cache 
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
elseif (!file_exists($userfolder.$UM->fix_prefix($folder,1))) { 
	redirect_and_exit("logout.php"); 
}

?>
