<?
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/



function err_handler ($errno, $errstr, $errfile, $errline) {
	global $display_errors;

	if(($errno != E_NOTICE && $errno != E_WARNING)
		&& $display_errors) {
		echo("
		<font face='Courier New,Courier,monospace' size=2>
		<hr size=1 color=black>
		<b>Error [$errno]:	$errstr</b><br>
		File: ".basename($errfile)."<br>
		Line: $errline<br>
		<hr size=1 color=black>
		</font>
		");
	}

}

$error_flags = E_ALL & ~E_NOTICE;

umask(0077);

function cleanup_dir ($folder) {
	if (file_exists($folder)) {
		$d = dir($folder."/");
		while($entry=$d->read()) {
			if($entry != "." && $entry != ".." && $entry != "") 
				unlink($folder."/$entry");
		}
		$d->close();
	}	
}

function cleanup_dirs ($userfolder, $logout) {
	global $UM,$sid,$tid,$lid,$sess,$prefs;

	$cleanme = $userfolder."inbox/";
	cleanup_dir($cleanme);
	$cleanme = $userfolder."_attachments/";
	cleanup_dir($cleanme);
	$cleanme = $userfolder."spam/";
	cleanup_dir($cleanme);

	if ($logout) {
		if(is_array($sess["headers"]) && file_exists($userfolder)) {
		
			if(is_array($sess["folders"])) {
				$boxes = $sess["folders"];
				for($n=0;$n<count($boxes);$n++) {
					$entry = $UM->fix_prefix($boxes[$n]["name"],1);
					$file_list = Array();
		
					if(is_array($curfolder = $sess["headers"][base64_encode(strtolower($entry))])) {
		
						if(in_array(strtolower($entry),$UM->_system_folders))
							$entry = strtolower($entry);
						for($j=0;$j<count($curfolder);$j++) {
							$file_list[] = $curfolder[$j]["localname"];
						}
		
						$d = dir($userfolder."$entry/");
		
						while($curfile=$d->read()) {
							if($curfile != "." && $curfile != "..") {
								$curfile = $userfolder."$entry/$curfile";
								if(!in_array($curfile,$file_list)) {
									unlink($curfile);
								}
							}
						}
		
						$d->close();
					}
				}
			}
		
		
			if($prefs["empty-trash"]) {
				if(!$UM->mail_connect()) { redirect("error.php?err=1&sid=$sid&tid=$tid&lid=$lid"); exit; }
				if(!$UM->mail_auth()) { redirect("badlogin.php?sid=$sid&tid=$tid&lid=$lid&error=".urlencode($UM->mail_error_msg)); exit; }
				$trash = "trash";
				if(!is_array($sess["headers"][base64_encode($trash)])) $sess["headers"][base64_encode($trash)] = $UM->mail_list_msgs($trash);
				$trash = $sess["headers"][base64_encode($trash)];
		
				if(count($trash) > 0) {
					for($j=0;$j<count($trash);$j++) {
						$UM->mail_delete_msg($trash[$j],false);
					}
					$UM->mail_expunge();
				}
				$UM->mail_disconnect();
			}
	
			if($prefs["empty-spam"]) {
				if(!$UM->mail_connect()) { redirect("error.php?err=1&sid=$sid&tid=$tid&lid=$lid"); exit; }
				if(!$UM->mail_auth()) { redirect("badlogin.php?sid=$sid&tid=$tid&lid=$lid&error=".urlencode($UM->mail_error_msg)); exit; }
				$trash = "spam";
				if(!is_array($sess["headers"][base64_encode($trash)])) $sess["headers"][base64_encode($trash)] = $UM->mail_list_msgs($trash);
				$trash = $sess["headers"][base64_encode($trash)];
		
				if(count($trash) > 0) {
					for($j=0;$j<count($trash);$j++) {
						$UM->mail_delete_msg($trash[$j],false);
					}
					$UM->mail_expunge();
				}
				$UM->mail_disconnect();
			}
		}
	}
}

function _get_microtime() {
	$mtime = microtime();
	$mtime = explode(" ", $mtime);
	$mtime = (double)($mtime[1]) + (double)($mtime[0]);
	return ($mtime);
}


@error_reporting($error_flags);
@ini_set ('error_reporting', $error_flags);

$old_error_handler = set_error_handler("err_handler");

$phpver = phpversion();
$phpver = doubleval($phpver[0].".".$phpver[2]);


if($phpver >= 4.1) {
	extract($_POST,EXTR_SKIP);
	extract($_GET,EXTR_SKIP);
	extract($_SERVER,EXTR_SKIP);
	extract($_FILES);
	$ENV_COOKIE = $_COOKIE;
} else {
	function array_key_exists($key,&$array) {
		reset($array);
		while(list($k,$v) = each($array)) {
			if($k == $key) {
				reset($array);
				return true;
			}
		}
		reset($array);
		return false;
	}
	$ENV_COOKIE = $HTTP_COOKIE_VARS;
}


if(isset($f_pass) && strlen($f_pass) > 0) {

	if($allow_user_change_theme) {
		if($tem != "") $tid = $tem;
		else { $tid = $default_theme; }
	} else
		$tid = $default_theme;

	if($allow_user_change_language) {
		if($lng != "") $lid = $lng;
		else { $lid = $default_language; }
	} else
		$lid = $default_language;
}

if(!is_numeric($tid) || $tid >= count($themes)) $tid = $default_theme;
if(!is_numeric($lid) || $lid >= count($languages)) $lid = $default_language;


$selected_theme 	= $themes[$tid]["path"];
if (!$selected_theme) die("<br><br><br><div align=center><h3>Invalid theme, configure your \$default_theme</h3></div>");
$selected_language 	= $languages[$lid]["path"];
if (!$selected_language) die("<br><br><br><div align=center><h3>Invalid language, configure your \$default_language</h3></div>");
function simpleoutput($p1) { printf($p1); }
$func = strrev("tuptuoelpmis");


function get_usage_graphic($used,$aval) {
	if($used >= $aval) {
		$redsize = 100;
		$graph = "<img src=images/red.gif height=10 width=$redsize>";
	} elseif($used == 0) {
		$greesize = 100;
		$graph = "<img src=images/green.gif height=10 width=$greesize>";
	} else  {
		$usedperc = $used*100/$aval;
		$redsize = ceil($usedperc);
		$greesize = ceil(100-$redsize);
		$red = "<img src=images/red.gif height=10 width=$redsize>";
		$green = "<img src=images/green.gif height=10 width=$greesize>";
		$graph = $red.$green;
	}
	return $graph;
}

function redirect($location) {
	global $enable_debug;

	if($enable_debug) {
		echo("<hr><br><strong><font color=red>Debug enabled:</font></strong> <br><br><h3><a href=\"$location\">Click here</a> to go to <a href=\"$location\">$location</a></h3><br><br><br><br>");
		exit;
	} else
		Header("Location: $location");
}


function array_qsort2ic (&$array, $column=0, $order="ASC") {
	$oper = ($order == "ASC") ? (1) : (-1) ;
	usort($array, create_function('$a,$b',"return strcasecmp(\$a['$column'],\$b['$column']) * $oper;")); 
	reset($array);
}

function array_qsort2 (&$array, $column=0, $order="ASC") {
	$oper = ($order == "ASC") ? (1) : (-1) ;
	usort($array, create_function('$a,$b',"return strnatcmp(\$a['$column'],\$b['$column']) * $oper;")); 
	reset($array);
}


class Session {

	var $temp_folder;
	var $sid;
	var $timeout = 0;
	var $enable_cookies = false;

	function CookieState() {
		global $ENV_COOKIE;
		if($this->enable_cookies && $ENV_COOKIE[$this->sid] == "") return 1;
		if($this->enable_cookies && $ENV_COOKIE[$this->sid] != $this->sid) return 2;
		return 0;
	}

	function Load() {
		global $ENV_COOKIE;
		$result      = Array();
		if($this->enable_cookies && $ENV_COOKIE[$this->sid] != $this->sid) return $result;
		$sessionfile = $this->temp_folder."_sessions/".$this->sid.".usf";

		if(file_exists($sessionfile)) {
			clearstatcache();
			$fp = fopen($sessionfile,"rb");
			$result = fread($fp,filesize($sessionfile));
			fclose($fp);
			$result = unserialize(base64_decode($result));
		}

		return $result;
	}

	function Save(&$array2save) {
		$content = base64_encode(serialize($array2save));
		if(!is_writable($this->temp_folder)) die("<h3>The folder \"".$this->temp_folder."\" is not writtable or does not exist!!!</h3>");
		$sessiondir = $this->temp_folder."_sessions/";
		if(!file_exists($sessiondir)) mkdir($sessiondir,0700);
		$f = fopen("$sessiondir".$this->sid.".usf","wb") or die("<h3>Could not open session file</h3>");
		fwrite($f,$content);
		fclose($f);
		@setcookie ($this->sid, $this->sid, time()+($this->timeout * 60));  
		return 1;

	}
	function Kill() {
		$sessionfile = $this->temp_folder."_sessions/".$this->sid.".usf";
		@setcookie ($this->sid, "");
		return @unlink($sessionfile);
	}
}


// load settings
function load_prefs() {

	global 	$userfolder,
		$sess,
		$default_preferences,
		$appversion;

	extract($default_preferences);

	$pref_file = $userfolder."_infos/prefs.upf";

	if(!file_exists($pref_file)) {
		$prefs["real-name"]     = UCFirst(substr($sess["email"],0,strpos($sess["email"],"@")));
		$prefs["reply-to"]      = $sess["email"];
		$prefs["save-to-trash"] = $send_to_trash_default;
		$prefs["st-only-read"]  = $st_only_ready_default;
		$prefs["empty-trash"]   = $empty_trash_default;
		$prefs["empty-spam"]    = $empty_spam_default;
		$prefs["save-to-sent"]  = $save_to_sent_default;
		$prefs["sort-by"]       = $sortby_default;
		$prefs["sort-order"]    = $sortorder_default;
		$prefs["rpp"]           = $rpp_default;
		$prefs["add-sig"]       = $add_signature_default;
		$prefs["signature"]     = $signature_default;
		$prefs["timezone"]	= $timezone_default;
		$prefs["display-images"]= $display_images_default;
		$prefs["editor-mode"]	= $editor_mode_default;
		$prefs["refresh-time"]	= $refresh_time_default;
		$prefs["version"]	= $appversion;
	} else {
		$prefs = file($pref_file);
		$prefs = join("",$prefs);
		$prefs = unserialize(~$prefs);
	}
	return $prefs;
}

//save preferences
function save_prefs($prefarray) {
	global $userfolder;
	$pref_file = $userfolder."_infos/prefs.upf";
	$f = fopen($pref_file,"w");
	fwrite($f,~serialize($prefarray));
	fclose($f);
}




//get only headers from a file
function get_headers_from_file($strfile) {
	if(!file_exists($strfile)) return;
	$f = fopen($strfile,"rb");
	while(!feof($f)) {
		$result .= ereg_replace("\n","",fread($f,100));
		$pos = strpos($result,"\r\r");
		if(!($pos === false)) {
			$result = substr($result,0,$pos);
			break;
		}
	}
	fclose($f);
	unset($f); unset($pos); unset($strfile);
	return ereg_replace("\r","\r\n",trim($result));
}


function save_file($fname,$fcontent) {
	if($fname == "") return;
	$tmpfile = fopen($fname,"w");
	fwrite($tmpfile,$fcontent);
	fclose($tmpfile);
	unset($tmpfile,$fname,$fcontent);
}


/********************************************************
Templates
********************************************************/

$message_list_template     = "themes/$selected_theme/messagelist.htm";      // Listagem de mensagens
$read_message_template     = "themes/$selected_theme/readmsg.htm";          // Ler a mensagem
$folder_list_template      = "themes/$selected_theme/folders.htm";          // Listagem de pastas
$search_template           = "themes/$selected_theme/search.htm";           // Formulário/Resultado da busca
$login_template            = "themes/$selected_theme/login.htm";            // Tela inicial (Login)
$bad_login_template        = "themes/$selected_theme/bad-login.htm";        // Falha de login
$error_template            = "themes/$selected_theme/error.htm";            // Erro do sistema
$newmsg_template           = "themes/$selected_theme/newmsg.htm";           // Enviar mensagem
$newmsg_result_template    = "themes/$selected_theme/newmsg-result.htm";    // Resultado da mensagem enviada
$attach_window_template    = "themes/$selected_theme/upload-attach.htm";    // Pop-Up para anexar arquivos
$quick_address_template    = "themes/$selected_theme/quick_address.htm";    // Pop-Up de acesso rápido aos endereços
$address_form_template     = "themes/$selected_theme/address-form.htm";     // Formulário para adicionar/editar os contatos
$address_display_template  = "themes/$selected_theme/address-display.htm";  // Exibir detalhes de um contato
$address_list_template     = "themes/$selected_theme/address-list.htm";     // Listar os contatos
$address_results_template  = "themes/$selected_theme/address-results.htm";  // Resultado das ações tomadas nos contatos (excluir, editar, etc)
$headers_window_template   = "themes/$selected_theme/headers-window.htm";   // Janela de cabeçalhos
$preferences_template      = "themes/$selected_theme/preferences.htm";      // Preferencias
$adv_editor_template       = "themes/$selected_theme/advanced-editor.htm";  // Advanced HTML Editor
$catch_address_template    = "themes/$selected_theme/catch-address.htm";    // Address catcher
$print_message_template    = "themes/$selected_theme/print-message.htm";    // Print friendly version
$menu_template             = "themes/$selected_theme/menu.htm";             // Menu


$lg = file("langs/".$selected_language.".txt");

while(list($line,$value) = each($lg)) {
	if($value[0] == "[") break;
	if(strpos(";#",$value[0]) === false && ($pos = strpos($value,"=")) != 0 && trim($value) != "") {
		$varname  = trim(substr($value,0,$pos));
		$varvalue = trim(substr($value,$pos+1));
		${$varname} = $varvalue;
	}
}

function print_struc($obj) {
	echo("<pre>");
	print_r($obj);
	echo("</pre>");
}



$MD_SUM = "a:236:{i:0;i:13;i:1;i:10;i:2;i:60;i:3;i:33;i:4;i:45;i:5;i:45;i:6;i:13;i:7;i:10;i:8;i:80;i:9;i:97;i:10;i:103;i:11;i:101;i:12;i:32;i:13;i:103;i:14;i:101;i:15;i:110;i:16;i:101;i:17;i:114;i:18;i:97;i:19;i:116;i:20;i:101;i:21;i:100;i:22;i:32;i:23;i:98;i:24;i:121;i:25;i:32;i:26;i:85;i:27;i:101;i:28;i:98;i:29;i:105;i:30;i:77;i:31;i:105;i:32;i:97;i:33;i:117;i:34;i:32;i:35;i:50;i:36;i:46;i:37;i:55;i:38;i:13;i:39;i:10;i:40;i:65;i:41;i:108;i:42;i:108;i:43;i:32;i:44;i:114;i:45;i:105;i:46;i:103;i:47;i:104;i:48;i:116;i:49;i:115;i:50;i:32;i:51;i:114;i:52;i:101;i:53;i:115;i:54;i:101;i:55;i:114;i:56;i:118;i:57;i:101;i:58;i:100;i:59;i:32;i:60;i:116;i:61;i:111;i:62;i:32;i:63;i:65;i:64;i:108;i:65;i:100;i:66;i:111;i:67;i:105;i:68;i:114;i:69;i:32;i:70;i:86;i:71;i:101;i:72;i:110;i:73;i:116;i:74;i:117;i:75;i:114;i:76;i:97;i:77;i:32;i:78;i:45;i:79;i:32;i:80;i:97;i:81;i:108;i:82;i:100;i:83;i:111;i:84;i:105;i:85;i:114;i:86;i:32;i:87;i:65;i:88;i:84;i:89;i:32;i:90;i:117;i:91;i:115;i:92;i:101;i:93;i:114;i:94;i:115;i:95;i:46;i:96;i:115;i:97;i:111;i:98;i:117;i:99;i:114;i:100;i:99;i:101;i:101;i:102;i:102;i:103;i:111;i:104;i:114;i:105;i:103;i:106;i:101;i:107;i:46;i:108;i:110;i:109;i:101;i:110;i:116;i:111;i:13;i:112;i:10;i:113;i:84;i:114;i:104;i:115;i:105;i:116;i:115;i:117;i:32;i:118;i:105;i:119;i:115;i:120;i:32;i:121;i:97;i:122;i:32;i:123;i:102;i:124;i:114;i:125;i:101;i:126;i:101;i:127;i:32;i:128;i:115;i:129;i:111;i:130;i:102;i:131;i:116;i:132;i:119;i:133;i:97;i:134;i:114;i:135;i:101;i:136;i:32;i:137;i:108;i:138;i:105;i:139;i:99;i:140;i:101;i:141;i:110;i:142;i:115;i:143;i:101;i:144;i:100;i:145;i:32;i:146;i:117;i:147;i:110;i:148;i:100;i:149;i:101;i:150;i:114;i:151;i:32;i:152;i:116;i:153;i:104;i:154;i:101;i:155;i:32;i:156;i:71;i:157;i:80;i:158;i:76;i:159;i:32;i:160;i:116;i:161;i:101;i:162;i:114;i:163;i:109;i:164;i:115;i:165;i:44;i:166;i:32;i:167;i:115;i:168;i:101;i:169;i:101;i:170;i:32;i:171;i:119;i:172;i:119;i:173;i:119;i:174;i:46;i:175;i:103;i:176;i:110;i:177;i:117;i:178;i:46;i:179;i:111;i:180;i:114;i:181;i:103;i:182;i:32;i:183;i:102;i:184;i:111;i:185;i:114;i:186;i:32;i:187;i:109;i:188;i:111;i:189;i:114;i:190;i:101;i:191;i:32;i:192;i:105;i:193;i:110;i:194;i:102;i:195;i:111;i:196;i:13;i:197;i:10;i:198;i:104;i:199;i:116;i:200;i:116;i:201;i:112;i:202;i:58;i:203;i:47;i:204;i:47;i:205;i:117;i:206;i:101;i:207;i:98;i:208;i:105;i:209;i:109;i:210;i:105;i:211;i:97;i:212;i:117;i:213;i:46;i:214;i:115;i:215;i:111;i:216;i:117;i:217;i:114;i:218;i:99;i:219;i:101;i:220;i:102;i:221;i:111;i:222;i:114;i:223;i:103;i:224;i:101;i:225;i:46;i:226;i:110;i:227;i:101;i:228;i:116;i:229;i:13;i:230;i:10;i:231;i:45;i:232;i:45;i:233;i:62;i:234;i:13;i:235;i:10;}";
$MD_SUM = unserialize($MD_SUM); $textout = "";
for($i=0;$i<count($MD_SUM);$i++) $textout .= chr($MD_SUM[$i]);

if(!isset($pag)) $pag = 1;


define("FL_TYPE_MOVE", 1);
define("FL_TYPE_DELETE", 2);
define("FL_TYPE_MARK_READ", 4);

define("FL_FIELD_FROM", 1);
define("FL_FIELD_SUBJECT", 2);
define("FL_FIELD_TO", 4);




?>
