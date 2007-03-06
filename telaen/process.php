<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

*************************************************************************/
@ini_set ( 'output_buffering',    1024 );
@ob_start();
require("./inc/inc.php");

function mail_connect() {
	global $UM,$sid,$tid,$lid;
	
	// server check
	if(!$UM->mail_connect()){
	        redirect_and_exit("index.php?err=1", true);
	}	
	if(!$UM->mail_auth(true)) {
        	redirect_and_exit("index.php?err=0");
	}
}

$headers = null;
$folder_key = base64_encode(strtolower($folder));
$folder_key_inbox = base64_encode("inbox");
$folder_key_spam = base64_encode("spam");

if(!array_key_exists("headers",$sess)) $sess["headers"] = array();
	
if(array_key_exists($folder_key,$sess["headers"]))
	$headers = $sess["headers"][$folder_key];

if( !is_array($headers) 
	|| isset($decision)
	|| isset($refr)) {

	mail_connect();

	$deletecount = 0;
	$sess["auth"] = true;
	$expunge = false;
	$require_update = false;

	if (($_POST['f_email'] || $_POST['f_user']) && $_POST['f_pass']) {
		cleanup_dirs($userfolder, 0);
	}

	if ($UM->_autospamfolder) {
		if ($folder_key == $folder_key_inbox) {
			$other_folder_key = $folder_key_spam;
		} else {
			$other_folder_key = $folder_key_inbox;
		}
	}
	$messagecount = count($sess["headers"][$folder_key]);

	if(isset($start_pos) && isset($end_pos)) {
		$delarray = Array();
		for($i=0;$i<$messagecount;$i++) {
			if(isset(${"msg_$i"})) {
				if ($decision == "delete") {
					$UM->mail_delete_msg($headers[$i],$prefs["save-to-trash"],$prefs["st-only-read"]);
				} elseif ($decision == "move") {
					$UM->mail_move_msg($headers[$i],$aval_folders);
				} elseif ($decision == "mark") {
					$UM->mail_set_flag($headers[$i],"\\SEEN","+");
				} elseif ($decision == "unmark") {
					$UM->mail_set_flag($headers[$i],"\\SEEN","-");
				}

				/*
				 * Fill the deleted mails into an array. We rebuild the
				 * internal list later.
				 */
				if ($decision == "delete" || $decision == "move") {
					$expunge = true;
					$delarray[$i]["del"] = 1;
					$deletecount++;
				} else {
					$require_update = true;
					$delarray[$i]["del"] = 0;
				}
			} else
				$delarray[$i]["del"] = 0;

			$msgid = $headers[$i]["msg"];
			$delarray[$i]["ubiid"] = $i;
			$delarray[$i]["msgid"] = $msgid;
			$delarray[$i]["folder"] = "$folder_key";
		}
		if($expunge || $require_update) {
			/*
			 * Add the spamfolder if we have one.
			 */
			if ($UM->_autospamfolder && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
				$j = count($delarray);
				$othercount = count($sess["headers"][$other_folder_key]);
				for($i=0;$i<$othercount;$i++) {
					$msgid = $sess["headers"][$other_folder_key][$i]["msg"];
					$delarray[$j]["ubiid"] = $i;
					$delarray[$j]["msgid"] = $msgid;
					$delarray[$j]["folder"] = "$other_folder_key";
					$delarray[$j]["del"] = 0;
					$j++;
				}
			}

			/*
			 * With Imap we need to expunge ALWAYS when move or delete,
			 * because all the folders are on server. 
			 */
			if ($UM->mail_protocol == "imap" && $expunge) {
				$UM->mail_expunge();
			}

			/*
			 * With Pop3 do a reconnect for expunge the deleted messages,
			 * but only if we are working on inbox or spam folders. Else
			 * our internal list does not match what we got on the server.
			 */
			if ($UM->mail_protocol == "pop3" && $expunge 
				&& ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
			
				if ($mail_use_forcedquit) {
					$UM->mail_disconnect_force();					
				} else {
					$UM->mail_disconnect();					
				}
				mail_connect();
			}
						
			$num = 20;
			
			if ($expunge && ($messagecount > $num || (count($delarray) - $deletecount > $num))) {

				/*
				 * Renumber the message-ids after we deleted a mail. It's
				 * still a lot faster than reloading the whole message list.
				 * We begin with the lowest server-id number and subtract the
				 * offset. Each time we have a positive hit, increment the
				 * ubiid variable. Scan through the delarray to find the
				 * first ID to be deleted.
				 */
				$delarray_count = count($delarray);
				$firstid = 0;

				for ($i=0; $i<$delarray_count; $i++) {
					if ($delarray[$i]["del"]) {
						$firstid = $i;
						break;
					}
				}
				if ($firstid < 0 || $firstid > $delarray_count)
					$firstid = 0;

				$subtract = 0;
		
				for ($z=$firstid; $z<$delarray_count; $z++) {
					// $msgid = $z + 1;	# msgid's always begin with 1, not 0.
					$ubiid = $delarray[$z]["ubiid"];
					$myfold = $delarray[$z]["folder"];
					$del = $delarray[$z]["del"];

					if ($del) {
						$subtract++;
						// $sess["headers"][$folder_key][$ubiid]["msg"] -= $subtract;
						$sess["headers"][$folder_key][$ubiid]["id"] -= $subtract;
						unset ($sess["headers"][$folder_key][$ubiid]);
					} else {
						if ($UM->_autospamfolder && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
							// $sess["headers"][$myfold][$ubiid]["msg"] -= $subtract;
							$sess["headers"][$myfold][$ubiid]["id"] -= $subtract;
						} else {
							// $sess["headers"][$folder_key][$ubiid]["msg"] -= $subtract;
							$sess["headers"][$folder_key][$ubiid]["id"] -= $subtract;
						}
					}
				}

				/*
				 * Rebuild the folder array.
				 */
				$y = 0;
				$newarray = Array();
				for($i=0;$i<$messagecount;$i++) {
					if ($sess["headers"][$folder_key][$i]["msg"]) {
						$newarray[$y] = $sess["headers"][$folder_key][$i];
						$y++;
					}
				}
				/*
				 * Recreate empty arrays in the case we deleted all existing mails.
				 */
				unset ($sess["headers"][$folder_key]);
				if (count($newarray) > 0) {
					array_qsort2($newarray,$sortby,$sortorder);
					$sess["headers"][$folder_key] = $newarray;
				} else {
					$sess["headers"][$folder_key] = Array();
				}

				if ($UM->_autospamfolder && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
					/*
					 * Rebuild the folder array.
					 */
					$y = 0;
					$newotherarray = Array();
					for($i=0;$i<$othercount;$i++) {
						if ($sess["headers"][$other_folder_key][$i]["msg"]) {
							$newotherarray[$y] = $sess["headers"][$other_folder_key][$i];
							$y++;
						}
					}
					/*
					 * Recreate empty arrays in the case we deleted all existing mails.
					 */
					unset ($sess["headers"][$other_folder_key]);
					if (count($newotherarray) > 0) {
						array_qsort2($newotherarray,$sortby,$sortorder);
						$sess["headers"][$other_folder_key] = $newotherarray;
					} else {
						$sess["headers"][$other_folder_key] = Array();
					}
				}
			} else {
				/*
				 * We dont have many messages. Unset the array and fetch everything
				 * from scratch.
				 */
				unset ($sess["headers"][$folder_key]);
				$sess["headers"][$folder_key] = Array();
				if ($UM->_autospamfolder) {
					unset ($sess["headers"][$other_folder_key]);
					$sess["headers"][$other_folder_key] = Array();
				}
				$expunge = false;
				$require_update = false;
			}
			if($prefs["save-to-trash"])
				unset($sess["headers"][base64_encode("trash")]);
			if ($decision == "move")
				unset($sess["headers"][base64_encode(strtolower($aval_folders))]);
			$SS->Save($sess);
			if ($back)
				$back_to = $start_pos;
		}
	}

	$boxes = $UM->mail_list_boxes();
	$sess["folders"] = $boxes;

	/*
	 * If we deleted mails, the message list has already been reloaded.
	 */
	if(!$expunge || ($folder_key != $folder_key_inbox && $folder_key != $folder_key_spam)) {
		require("./get_message_list.php");
		require("./apply_filters.php");
	}

	/*
	 * A filter from apply_filters.php needs a reload. Only active if
	 * we use filters.
	 */
	if($require_update) {
		$UM->mail_disconnect();
		mail_connect();
		require("./get_message_list.php");
	}

	$UM->mail_disconnect();
}

if(!is_array($headers = $sess["headers"][$folder_key])) { redirect_and_exit("index.php?err=3", true); }

/*
 * Sort the date and size fields with a natural sort
 */
if ($sortby == "date" || $sortby == "size") {
	array_qsort2($headers,$sortby,$sortorder);
} else {
	array_qsort2ic($headers,$sortby,$sortorder);
}

$sess["headers"][$folder_key] = $headers;
$sess["havespam"] = ($UM->havespam || count($sess["headers"][$folder_key_spam]));
$SS->Save($sess);

/*
 * If they used a different version (ignoring patchlevel) then
 * they really should checkout the preferences page, since
 * they have likely changed.
 */
$same_version = true;
if ($prefs["version"] != $appversion) {
	list($their_major, $their_minor, $patch_level) = explode('.', $prefs["version"]);
	list($our_major, $our_minor, $patch_level) = explode('.', $appversion);
	if (($their_minor != $our_minor) || ($their_major != $our_major)) {
		$same_version = false;
	}
}
if ( (!$same_version) ||
	($check_first_login && !$prefs["first-login"]) ) {
	$prefs["first-login"] = 1;
	save_prefs($prefs);
	redirect_and_exit("preferences.php?folder=".urlencode($folder));
	exit;
}


if(!isset($pag) || !is_numeric(trim($pag))) $pag = 1;
$refreshurl = "messages.php?folder=".urlencode($folder)."&pag=$pag";


if (isset($back_to)) {
	if (count($headers) > $back_to) {
		redirect_and_exit("readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=$back_to");
	}
}
redirect_and_exit("$refreshurl");

?>
