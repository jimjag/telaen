<?
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

/*
 * Place to put all required and extra functions or
 * Class definitions for Telaen
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
				if ($UM->mail_protocol == "imap") {
					if(!$UM->mail_connect()) { redirect("error.php?err=1&sid=$sid&tid=$tid&lid=$lid"); exit; }
					if(!$UM->mail_auth()) { redirect("badlogin.php?sid=$sid&tid=$tid&lid=$lid&error=".urlencode($UM->mail_error_msg)); exit; }
				}
				$trash = "trash";
				if(!is_array($sess["headers"][base64_encode($trash)])) $sess["headers"][base64_encode($trash)] = $UM->mail_list_msgs($trash);
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
		$prefs["unmark-read"]   = $unmark_read_default;
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


function print_struc($obj) {
	echo("<pre>");
	print_r($obj);
	echo("</pre>");
}


?>
