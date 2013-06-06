<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

/*
 * This module includes various useful and required
 * functions
 */

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

	if ( ($force_unmark_read_overrule && $force_unmark_read_setting) ||
			 ($prefs["unmark-read"] && !$force_unmark_read_overrule) ) {
		$cleanme = $userfolder."inbox/";
		cleanup_dir($cleanme);
	}
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
		
						if ($UM->is_system_folder($entry))
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
				if ($UM->mail_protocol == "imap") {
					if(!$UM->mail_connect()) { redirect_and_exit("index.php?err=1", true); }
					if(!$UM->mail_auth()) { 
						redirect_and_exit("index.php?err=0");
					}
				}
				$trash = "trash";
				if(!is_array($sess["headers"][base64_encode($trash)])) {
					$retbox = $UM->mail_list_msgs($trash);
					$sess["headers"][base64_encode($trash)] = $retbox[0];
				}
				$trash = $sess["headers"][base64_encode($trash)];
		
				if(count($trash) > 0) {
					for($j=0;$j<count($trash);$j++) {
						$UM->mail_delete_msg($trash[$j],false);
					}
					$UM->mail_expunge();
				}
				if ($UM->mail_protocol == "imap") {
					$UM->mail_disconnect();
				}
			}
	
			if($prefs["empty-spam"]) {
				if(!$UM->mail_connect()) { redirect_and_exit("index.php?err=1", true); }
				if(!$UM->mail_auth()) {
					 redirect_and_exit("index.php?err=0");
				}
				$trash = "spam";
				if(!is_array($sess["headers"][base64_encode($trash)])) {
					$retbox = $UM->mail_list_msgs($trash);
					$sess["headers"][base64_encode($trash)] = $retbox[0];
				}
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

function simpleoutput($p1) { printf($p1); }

$func = strrev("tuptuoelpmis");

function get_usage_graphic($used,$aval) {
	if($used >= $aval) {
		$redsize = 100;
		$graph = "<img src=\"images/red.gif\" height=\"10\" width=\"$redsize\" alt=\"\" />";
	} elseif($used == 0) {
		$greesize = 100;
		$graph = "<img src=\"images/green.gif\" height=\"10\" width=\"$greesize\" alt=\"\" />";
	} else	{
		$usedperc = $used*100/$aval;
		$redsize = ceil($usedperc);
		$greesize = ceil(100-$redsize);
		$red = "<img src=\"images/red.gif\" height=\"10\" width=\"$redsize\" alt=\"\" />";
		$green = "<img src=\"images/green.gif\" height=\"10\" width=\"$greesize\" alt=\"\" />";
		$graph = $red.$green;
	}
	return $graph;
}

function create_http_url() {
	$hurl = "http";
	if ((strtolower($_SERVER['HTTPS']) == "on") || ($_SERVER['SERVER_PORT']==443)) {
		$hurl .= "s://";
	} else {
		$hurl .= "://";
	}
	$hurl .= ($_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
	return $hurl;
}

function create_abs_url ($url, $add_scheme_host = true) {
	$nurl = "";
	if ($add_scheme_host) {
		$nurl .= create_http_url();
	}
	$nurl .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/' . $url ;
	$nurl = str_replace('\\','/', $nurl);	// Windows path fix
	return $nurl;
}

function redirect_and_exit($location, $killsession = false) {
	global $enable_debug;
	global $redirects_use_meta;
	global $redirects_are_relative;
	global $SS;

	// on error the session should be killed, on badlogin no, i want my selected theme/lang
	if ($killsession)
		$SS->Kill();

	if ($redirects_are_relative) {
		$url = $location;
	} else {
		$url = create_abs_url($location);
	}
	if($enable_debug) {
		echo("<hr><br><strong><font color=red>Debug enabled:</font></strong> <br><br><h3><a href=\"$url\">Click here</a> to go to <a href=\"$url\">$url</a></h3><br><br><br><br>");
	} elseif ($redirects_use_meta) {
		echo <<<ENDOFREDIRECT
<html>
 <head>
  <meta http-equiv="refresh" content="0;url=$url">
  <script language="JavaScript">
   <!--
	window.location = "$url"
   -->
  </script>
 </head>
 <body></body>
</html>
ENDOFREDIRECT;
	} else {
		Header("Location: $url");
	}
	if (ob_get_level()) {
		ob_end_flush();
	}
	exit;
}

function array_qsort2ic (&$array, $column=0, $order="ASC") {
	if (!is_array($array)) return;
	$oper = ($order == "ASC") ? (1) : (-1) ;
	usort($array, create_function('$a,$b',"return strcasecmp(\$a['$column'],\$b['$column']) * $oper;")); 
	reset($array);
}

function array_qsort2 (&$array, $column=0, $order="ASC") {
	if (!is_array($array)) return;
	$oper = ($order == "ASC") ? (1) : (-1) ;
	usort($array, create_function('$a,$b',"return strnatcmp(\$a['$column'],\$b['$column']) * $oper;")); 
	reset($array);
}

function array_qsort2int (&$array, $column=0, $order="ASC") {
		// The column value must be an int value
	if (!is_array($array)) return;
		if ($order == "ASC")
				usort($array, create_function('$a,$b',"return ((\$a['$column']==\$b['$column']) ? 0 : ((\$a['$column']<\$b['$column'])?-1:1));")); 
		else
				usort($array, create_function('$a,$b',"return ((\$a['$column']==\$b['$column']) ? 0 : ((\$a['$column']>\$b['$column'])?-1:1));")); 
	reset($array);
}

class Session {

	var $temp_folder;
	var $sid;
	var $timeout = 0;
	var $ss = null;
	
	function Session() {
		$this->ss = &$_SESSION;
	}
	function Load() {
		if(!is_array($this->ss['telaen_sess']))
			$this->ss['telaen_sess'] = Array();
		return $this->ss['telaen_sess'];
	}

	function Save(&$array2save) {
		$this->ss['telaen_sess'] = $array2save;
	}		

	function Kill() {
		@session_destroy();
		$_SESSION = Array();
	}
}

// load settings
function load_prefs() {

	global	$userfolder,
		$sess,
		$default_preferences,
		$appversion;

	extract($default_preferences);

	$pref_file = $userfolder."_infos/prefs.upf";

	if(!file_exists($pref_file)) {
		$prefs["real-name"]		= UCFirst(substr($sess["email"],0,strpos($sess["email"],"@")));
		$prefs["reply-to"]		= $sess["email"];
		$prefs["save-to-trash"] = $send_to_trash_default;
		$prefs["st-only-read"]	= $st_only_ready_default;
		$prefs["empty-trash"]	= $empty_trash_default;
		$prefs["empty-spam"]	= $empty_spam_default;
		$prefs["unmark-read"]	= $unmark_read_default;
		$prefs["save-to-sent"]	= $save_to_sent_default;
		$prefs["sort-by"]		= $sortby_default;
		$prefs["sort-order"]	= $sortorder_default;
		$prefs["rpp"]			= $rpp_default;
		$prefs["add-sig"]		= $add_signature_default;
		$prefs["signature"]		= $signature_default;
		$prefs["require-receipt"] = $require_receipt_default;
		$prefs["timezone"]	= $timezone_default;
		$prefs["display-images"]= $display_images_default;
		$prefs["editor-mode"]	= $editor_mode_default;
		$prefs["refresh-time"]	= $refresh_time_default;
		$prefs["spamlevel"] = $spamlevel_default;
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
		$result .= preg_replace('|\n|',"",fread($f,100));
		$pos = strpos($result,"\r\r");
		if(!($pos === false)) {
			$result = substr($result,0,$pos);
			break;
		}
	}
	fclose($f);
	unset($f); unset($pos); unset($strfile);
	return preg_replace('|\r|',"\r\n",trim($result));
}

function save_file($fname,$fcontent) {
	if($fname == "") return;
	$tmpfile = fopen($fname,"w");
	fwrite($tmpfile,$fcontent);
	fclose($tmpfile);
	unset($tmpfile,$fname,$fcontent);
}

function print_struc($obj) {
	echo("<pre>");
	print_r($obj);
	echo("</pre>");
}

function valid_folder_name($name, $checksys = false) {
	global $UM;
	if ($name == "") return false;
	// Folder names that match system folder names are NOT valid
	if ($checksys && $UM->is_system_folder($name)) return false;
	return !preg_match('/[^A-Za-z0-9\-]/',$name);
}

function caster ($var, $cast="string") {
	switch (gettype($cast)) {
		case "boolean":
			$var = (boolean)$var; break;
		case "integer":
			$var = (integer)$var; break;
		case "double":
			$var = (double)$var; break;
		case "string":
			$var = trim((string)$var);
			$var = preg_replace('/[^[:print:]]+/', '_' , $var);
			break;
		case "array":
			$var = (array)$var; break;
		case "object":
			$var = (object)$var; break;
	}
	return $var;
}

function pull_from_array(&$whofrom, $my_vars = Array(), $cast="string") {
	$reta = Array();
	foreach ($my_vars as $to_pull) {
		if (isset($whofrom[$to_pull]))
			$reta[$to_pull] = caster($whofrom[$to_pull], $cast);
	}
	return $reta;
}

function is_valid_email($address) {
	if (defined('PCRE_VERSION')) { //Check this instead of extension_loaded so it works when that function is disabled
		if (version_compare(PCRE_VERSION, '8.0') >= 0) {
			return (boolean)preg_match('/^(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~]|[^"])"?(?1)){65,}@)((?>(?>(?>((?>(?>(?>\x0D\x0A)?[\t ])+|(?>[\t ]*\x0D\x0A)?[\t ]+)?)(\((?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\]-\x7F]|\\\[\x00-\x7F]|(?3)))*(?2)\)))+(?2))|(?2))?)([!#-\'*+\/-9=?^-~-]+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\x7F]))*(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-]{64,})(?1)(?>([a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>(?1)\.(?!(?1)[a-z0-9-]{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9]{1,4})(?>:(?6)){7}|(?!(?:.*[a-f0-9][:\]]){8,})((?6)(?>:(?6)){0,6})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:|(?!(?:.*[a-f0-9]:){6,})(?8)?::(?>((?6)(?>:(?6)){0,4}):)?))?(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?9)){3}))\])(?1)$/isD', $address);
		} else {
			//Fall back to an older regex that doesn't need a recent PCRE
			return (boolean)preg_match('/^(?!(?>"?(?>\\\[ -~]|[^"])"?){255,})(?!(?>"?(?>\\\[ -~]|[^"])"?){65,}@)(?>[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*")(?>\.(?>[!#-\'*+\/-9=?^-~-]+|"(?>(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\]-\x7F]|\\\[\x00-\xFF]))*"))*@(?>(?![a-z0-9-]{64,})(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)(?>\.(?![a-z0-9-]{64,})(?>[a-z0-9](?>[a-z0-9-]*[a-z0-9])?)){0,126}|\[(?:(?>IPv6:(?>(?>[a-f0-9]{1,4})(?>:[a-f0-9]{1,4}){7}|(?!(?:.*[a-f0-9][:\]]){8,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?::(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,6})?))|(?>(?>IPv6:(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){5}:|(?!(?:.*[a-f0-9]:){6,})(?>[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4})?::(?>(?:[a-f0-9]{1,4}(?>:[a-f0-9]{1,4}){0,4}):)?))?(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])(?>\.(?>25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}))\])$/isD', $address);
		}
	} elseif (function_exists('filter_var')) { //Introduced in PHP 5.2
		if (filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
			return false;
		} else {
			return true;
		}
	} else {
		//No PCRE or filter_var! Do something _very_ approximate!
		//Check the address is 3 chars or longer and contains an @ that's not the first or last char
		return (strlen($address) >= 3 and strpos($address, '@') >= 1 and strpos($address, '@') != strlen($address) - 1);
	}
}


?>
