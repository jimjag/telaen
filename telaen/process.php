<?
/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
São Paulo - Brasil
*************************************************************************/

require("./inc/inc.php");

function mail_connect() {
	global $UM,$sid,$tid,$lid;
	if(!$UM->mail_connect()) { redirect("error.php?err=1&sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }
	if(!$UM->mail_auth(true)) { redirect("badlogin.php?sid=$sid&tid=$tid&lid=$lid&error=".urlencode($UM->mail_error_msg)."\r\n"); exit; }
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

	if (($_POST['f_email'] || $_POST['f_user']) && $_POST['f_pass']) {
		cleanup_dirs($userfolder, 0);
	}

	if ($UM->_autospamfolder == "TRUE") {
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
				} else {
					$UM->mail_move_msg($headers[$i],$aval_folders);
				}

				/*
				 * Fill the deleted mails into an array. We rebuild the
				 * internal list later.
				 */
				$delarray[$i]["del"] = 1;
				$expunge = true;
				$deletecount++;
			} else
				$delarray[$i]["del"] = 0;

			$msgid = $headers[$i]["msg"];
			$delarray[$i]["ubiid"] = $i;
			$delarray[$i]["msgid"] = $msgid;
			$delarray[$i]["folder"] = "$folder_key";
		}
		if($expunge) {
			/*
			 * Add the spamfolder if we have one.
			 */
			if ($UM->_autospamfolder == "TRUE" && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
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
			 * If a previous page deleted or moved mails, we have to
			 * force a disconnect if a POP3 proxy server is used. Else
			 * our internal list does not match what we got on the server.
			 */
			if ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam) {
				if ($mail_use_forcedquit) {
					$UM->mail_disconnect_force();
					mail_connect();
				} else {
					$UM->mail_disconnect();
					mail_connect();
				}
			}

			$num = 20;
			if ($messagecount > $num || (count($delarray) - $deletecount > $num)) {
				/*
				 * Renumber the message-ids after we deleted a mail. It's
				 * still a lot faster than reloading the whole message list.
				 * We begin with the lowest server-id number and subtract the
				 * offset. Each time we have a positive hit, increment the
				 * ubiid variable.
				 */
				array_qsort2($delarray,"msgid","ASC");
				$firstmsgid = $delarray[0]["msgid"];
				$subtract = 0;
		
				$delarray_count = count($delarray);
				for ($z=$firstid -1 ; $z<$delarray_count; $z++) {
					$msgid = $z + 1;	# msgid's always begin with 1, not 0.
					$ubiid = $delarray[$z]["ubiid"];
					$myfold = $delarray[$z]["folder"];
					$del = $delarray[$z]["del"];

					if ($del) {
						$subtract++;
						$sess["headers"][$folder_key][$ubiid]["msg"] = $sess["headers"][$folder_key][$ubiid]["msg"] - $subtract;
						$sess["headers"][$folder_key][$ubiid]["id"] = $sess["headers"][$folder_key][$ubiid]["id"] - $subtract;
						unset ($sess["headers"][$folder_key][$ubiid]);
					} else {
						if ($UM->_autospamfolder == "TRUE" && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
							$sess["headers"][$myfold][$ubiid]["msg"] = $sess["headers"][$myfold][$ubiid]["msg"] - $subtract;
							$sess["headers"][$myfold][$ubiid]["id"] = $sess["headers"][$myfold][$ubiid]["id"] - $subtract;
						} else {
							$sess["headers"][$folder_key][$ubiid]["msg"] = $sess["headers"][$folder_key][$ubiid]["msg"] - $subtract;
							$sess["headers"][$folder_key][$ubiid]["id"] = $sess["headers"][$folder_key][$ubiid]["id"] - $subtract;
						}
					}
				}

				/*
				 * Rebuild the folder array.
				 */
				$y = 0;
				$newarray = Array();
				for($i=0;$i<$messagecount;$i++) {
					if ($sess["headers"][$folder_key][$i]["id"]) {
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

				if ($UM->_autospamfolder == "TRUE" && ($folder_key == $folder_key_inbox || $folder_key == $folder_key_spam)) {
					/*
					 * Rebuild the folder array.
					 */
					$y = 0;
					$newotherarray = Array();
					for($i=0;$i<$othercount;$i++) {
						if ($sess["headers"][$other_folder_key][$i]["id"]) {
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
				if ($UM->_autospamfolder == "TRUE") {
					unset ($sess["headers"][$other_folder_key]);
					$sess["headers"][$other_folder_key] = Array();
				}
				$expunge = 0;
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

if(!is_array($headers = $sess["headers"][$folder_key])) { redirect("error.php?err=3&sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }

/*
 * Sort the date and size fields with a natural sort
 */
if ($sortby == "date" || $sortby == "size") {
	array_qsort2($headers,$sortby,$sortorder);
} else {
	array_qsort2ic($headers,$sortby,$sortorder);
}

$sess["headers"][$folder_key] = $headers;
$sess["havespam"] = $UM->havespam;
$SS->Save($sess);

if ( ($prefs["version"] != $appversion) ||
     ($check_first_login && !$prefs["first-login"]) ) {
	$prefs["first-login"] = 1;
	save_prefs($prefs);
	redirect("preferences.php?sid=$sid&tid=$tid&lid=$lid&folder=".urlencode($folder));
	exit;
}


if(!isset($pag) || !is_numeric(trim($pag))) $pag = 1;
$refreshurl = "messages.php?sid=$sid&tid=$tid&lid=$lid&folder=".urlencode($folder)."&pag=$pag";


if (isset($back_to)) {
	if (count($headers) > $back_to) {
		redirect("readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=$back_to&sid=$sid&tid=$tid&lid=$lid");
		exit;
	}
}
redirect("$refreshurl");

?>
