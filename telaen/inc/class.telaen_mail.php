<?php
class Telaen extends Telaen_core {

	var $_autospamfolder	= true;		// boolean
	var $_spamregex		= Array("^\*\*\*\*\*SPAM\*\*\*\*\*", "^\*\*\*\*\*VIRUS\*\*\*\*\*");
	var $havespam		= "";		// NOTE: This is a STRING!
	var $_haveatop		= false;	// boolean
	var $_havepipelining	= false;	// boolean
	var $_system_folders	= Array("inbox","trash","sent","spam");
	var $_current_folder 	= "";	
	var $CRLF		= "\r\n";
	var $userspamlevel	= 0;		// Disabled
	var $dirperm		= 0700;  	// recall affected by umask value
	var $greeting		= ""; 		// Internally used for store pop3 APOP greeting message
	var $_haveapop		= false;	// boolean

	function Telaen() {
		require("./inc/class.tnef.php");
		$this->_tnef = new TNEF();
		$this->_sid = uniqid("");
	}

	function mail_connected() {
		if(!empty($this->mail_connection)) {
			$sock_status = @socket_get_status($this->mail_connection);

			if($sock_status["eof"]) {
				@fclose($this->mail_connection);
				return 0;
			}
			return 1; 
		} 
		return 0;
	}

	function is_system_folder($name) {
		return (in_array(strtolower($name), $this->_system_folders));
	}

	function mail_get_line() {
		$buffer = fgets($this->mail_connection,8192);
		$buffer = preg_replace("/\r?\n/","\r\n",$buffer);
		if($this->debug) {
			$sendtodebug = true;
			if(eregi("^(\\* )",$buffer) || eregi("^([A-Za-z0-9]+ (OK|NO|BAD))",$buffer) || eregi("^(\\+OK|\\-ERR)",$buffer)) {
				$output = "<- <b>".htmlspecialchars($buffer)."</b>";
			} else {
				$sendtodebug = ($this->debug > 1)?false:true;
				$output = htmlspecialchars($buffer);
			}
			if ($sendtodebug)
				echo("<font style=\"font-size:12px; font-family: Courier New; background-color: white; color: black;\"> $output</font><br>\r\n");
			flush();
		}
		return $buffer;
	}

	/*
	 * Send the supplied command to the mail server. Auto-
	 * appends the required EOL chars to the command.
	 * The provided parameter is either the command string to
	 * send or an array of command strings that will be
	 * sent one after another in order.
	 */
	function mail_send_command($cmds) {

		if($this->mail_connected()) {
			if (!is_array($cmds)) {
				$cmds = (array)$cmds;
			}
			foreach ($cmds as $cmd) {
				$cmd = trim($cmd) . $this->CRLF;
				$output = (eregi("^(PASS|LOGIN)",$cmd,$regs))?$regs[1]." ****":$cmd;
				if($this->mail_protocol == "imap") {
					$cmd = $this->_sid." ".$cmd;
					$output = $this->_sid." ".$output;
				}
				fwrite($this->mail_connection,$cmd);
				if($this->debug) {
					echo("<font style=\"font-size:12px; font-family: Courier New; background-color: white; color: black;\">-&gt; <em><b>".htmlspecialchars($output)."</b></em></font><br>\r\n");
					flush();
				}
			}
			return 1;
		}
		return 0;
	}

	function mail_connect() {
		if($this->debug)
			for($i=0;$i<20;$i++)
				echo("<!-- buffer sux -->\r\n");
		if(!$this->mail_connected()) {
			$this->mail_connection = fsockopen($this->mail_server, $this->mail_port, $errno, $errstr, 15);
			if($this->mail_connection) {
				$buffer = $this->mail_get_line();
				if($this->mail_protocol == "imap") 
					$regexp = "^([ ]?\\*[ ]?OK)";
				else { 
					$regexp = "^(\\+OK)";
					// save the greeting message
					$this->greeting = $buffer;
				}
				if(ereg($regexp,$buffer)) 
					return 1;
				else 
					return 0;
			}
			return 0;
		} else return 1;
	}

	function mail_auth($checkfolders=false) {
		if($this->mail_connected()) {
			if ($this->mail_protocol == "imap") {
				$this->mail_send_command("LOGIN ".$this->mail_user." ".$this->mail_pass);
				$buffer = $this->mail_get_line();
				if(ereg("^(".$this->_sid." OK)",$buffer)) { 
					if($checkfolders)
						$this->_check_folders();
					return 1;
				} else { 
					$this->mail_error_msg = $buffer; 
					return 0; 
				}
			} else {
				// APOP login mode, more secure
				if ($this->_haveapop && preg_match('/<.+@.+>/U', $this->greeting, $tokens) ) {
					$this->mail_send_command("APOP ".$this->mail_user.' '.md5($tokens[0].$this->mail_pass));
                                } 
				// Classic login mode
				else {
					$this->mail_send_command("USER ".$this->mail_user);
				
					$buffer = $this->mail_get_line();
					if (substr($buffer, 0, 3) == "+OK") {
						$this->mail_send_command("PASS ".$this->mail_pass);
					}	
					else 
						return 0;
				}

				$buffer = $this->mail_get_line();
				if(substr($buffer, 0, 3) == "+OK") {
					if($checkfolders)
						$this->_check_folders();
					return 1;
				} else {
					$this->mail_error_msg = $buffer;
					return 0;
				}
			}
		}
		return 0;
	}

	function _check_folders() {
		$userfolder 			= $this->user_folder;
		$temporary_directory 	= $this->temp_folder;
		$idle_timeout 			= $this->timeout;

		if(!file_exists($this->user_folder))
			if(!@mkdir($this->user_folder,$this->dirperm)) die("<h1><br><br><br><center>$error_permiss</center></h1>");

		$boxes = $this->mail_list_boxes();

		if($this->mail_protocol == "imap") {
		
			$tmp = $this->_system_folders;

			for($i=0;$i<count($boxes);$i++) {
				$current_folder = $boxes[$i]["name"];

				if ($this->is_system_folder($current_folder)) 
					$current_folder = strtolower($current_folder);

				while(list($index,$value) = each($tmp)) {
					if(strtolower($current_folder) == strtolower($value)) {
						unset($tmp[$index]);
					}
				}
				reset($tmp);
			}
			
			while(list($index,$value) = each($tmp)) {
				$this->mail_create_box($value);
			}

			for($i=0;$i<count($boxes);$i++) {
				$current_folder = $this->fix_prefix($boxes[$i]["name"],1);
				if(!$this->is_system_folder($current_folder))
					if(!file_exists($this->user_folder.$current_folder)) 
						mkdir($this->user_folder.$current_folder,$this->dirperm);
			}



		}

		$system_folders = array_merge((array)$this->_system_folders,Array("_attachments","_infos"));

		while(list($index,$value) = each($system_folders)) {
			$value = $this->fix_prefix($value,1);
			if(!file_exists($this->user_folder.$value)) {
				if($this->is_system_folder($value)) 
					$value = strtolower($value);
				mkdir($this->user_folder.$value,$this->dirperm);
			}
		}
	}
	
	
	function mail_retr_msg($msg,$check=1) {

		global $mail_use_top,$error_retrieving;
		$msgheader = $msg["header"];

		if($this->mail_protocol == "imap") {

			if($check) {
				if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
					$boxinfo = $this->mail_select_box($msg["folder"]);

				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
				$buffer = chop($this->mail_get_line());
				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					if(preg_match("/message-id: (.*)/i",$buffer,$regs))
						$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);
					$buffer = chop($this->mail_get_line());
				}

				if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}
			}

			if(file_exists($msg["localname"])) {
				$msgcontent = $this->_read_file($msg["localname"]);
			} else {
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY[TEXT]");
				$buffer = $this->mail_get_line();
				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				if(ereg("\\{(.*)\\}",$buffer,$regs))
					$bytes = $regs[1];

				$buffer = $this->mail_get_line();
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					if(!eregi("[ ]?\\*[ ]?[0-9]+[ ]?FETCH",$buffer))
						$msgbody .= $buffer;
					$buffer = $this->mail_get_line();
				}
				$pos = strrpos($msgbody, ")");
				if(!($pos === false))
					$msgbody = substr($msgbody,0,$pos);

				$msgcontent = "$msgheader\r\n\r\n$msgbody";

				$this->_save_file($msg["localname"],$msgcontent);

			}

		} else {

			if($check && (strtolower($msg["folder"]) == "inbox" || strtolower($msg["folder"]) == "spam")) {
				$this->mail_send_command("TOP ".$msg["id"]." 0");
				$buffer = $this->mail_get_line();

				if(substr($buffer, 0, 3) != "+OK")  { $this->mail_error_msg = $buffer; return 0; }

				unset($header);
				
				
				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(trim($buffer) == ".") break;
					$header .= $buffer;
				}
				$mail_info = $this->get_mail_info($header);
				if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}
			}


			if(file_exists($msg["localname"])) {
				$msgcontent = $this->_read_file($msg["localname"]);
			} elseif (strtolower($msg["folder"]) == "inbox" || strtolower($msg["folder"]) == "spam") {

				$command = ($mail_use_top)?"TOP ".$msg["id"]." ".$msg["size"]:"RETR ".$msg["id"];
				$this->mail_send_command($command);

				$buffer = $this->mail_get_line();

				if(substr($buffer, 0, 3) != "+OK") { $this->mail_error_msg = $buffer; return 0; }
				$last_buffer = 0;
				$msgcontent = "";
				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(chop($buffer) == ".") break;
					$msgcontent .= $buffer;
				}
				$this->_save_file($msg["localname"],$msgcontent);
			}
		}
		
		return $msgcontent;
	}


	function mail_delete_msg($msg, $send_to_trash = 1, $save_only_read = 0) {

		$read = (ereg("\\SEEN",$msg["flags"]))?1:0;

		/* choose your protocol */
		if($this->mail_protocol == "imap") {
			
			
			/* check the message id to make sure that the messages still in the server */
			if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
				$boxinfo = $this->mail_select_box($msg["folder"]);
	
			$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
			$buffer = chop($this->mail_get_line());

			/* if any problem with the server, stop the function */
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				/* we need only the message id yet */

				if(eregi("message-id: (.*)",$buffer,$regs))
					$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);

				$buffer = chop($this->mail_get_line());
			}


			/* compare the old and the new message id, if different, stop*/
			if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
				$this->mail_error_msg = $error_retrieving;
				return 0;
			}

			/*if the pointer is here, no one problem occours*/

			
			if( $send_to_trash && 
				strtoupper($msg["folder"]) != "TRASH" &&
				(!$save_only_read || ($save_only_read && $read))) {

				$trash_folder = $this->fix_prefix("trash",1);

				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"$trash_folder\"");
				$buffer = $this->mail_get_line();

				/* if any problem with the server, stop the function */
				if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."trash/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
			}
			$this->mail_set_flag($msg,"\\DELETED","+");

			// Expunge NOW instead of expunge on disconnect
			// so no reconnect is required for update the list
                        $this->mail_expunge();
                        //$this->_require_expunge = true;

			return 1;

		} else {
			/* now we are working with POP3 */
			/* check the message id to make sure that the messages still in the server */
			if(strtoupper($msg["folder"]) == "INBOX" || strtoupper($msg["folder"]) == "SPAM") {

				$this->mail_send_command("TOP ".$msg["id"]." 0");
				$buffer = $this->mail_get_line();
	
				/* if any problem with the server, stop the function */
				if(substr($buffer, 0, 3) != "+OK")  { $this->mail_error_msg = $buffer; return 0; }
	
				unset($header);
	
				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(trim($buffer) == ".") break;
					$header .= $buffer;
				}
				$mail_info = $this->get_mail_info($header);
	
	
				/* compare the old and the new message id, if different, stop*/
				if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}

				if(!file_exists($msg["localname"])) {
					if(!$this->mail_retr_msg($msg,0)) return 0;
					$this->mail_set_flag($msg,"\\SEEN","-");
				}

				$this->mail_send_command("DELE ".$msg["id"]);
				$buffer = $this->mail_get_line();
				if(substr($buffer, 0, 3) != "+OK") { $this->mail_error_msg = $buffer; return 0; }
			}

			if( $send_to_trash && 
				strtoupper($msg["folder"]) != "TRASH" &&
				(!$save_only_read || ($save_only_read && $read))) {

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."trash/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
			} else {
				if(file_exists($msg["localname"])) {
					unlink($msg["localname"]);
				}
			}

		}
		return 1;
	}


	function mail_move_msg($msg,$tofolder) {

		/* choose your protocol */

		if($this->mail_protocol == "imap") {

			if(strtolower($tofolder) != strtolower($msg["folder"])) {
				/* check the message id to make sure that the messages still in the server */
				if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
					$boxinfo = $this->mail_select_box($msg["folder"]);
		
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
				$buffer = chop($this->mail_get_line());
	
				/* if any problem with the server, stop the function */
				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
	
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					/* we need only the message id yet */
	
					if(eregi("message-id: (.*)",$buffer,$regs))
						$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);
	
					$buffer = chop($this->mail_get_line());
				}
	
	
				/* compare the old and the new message id, if different, stop*/
				if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}

				$tofolder = $this->fix_prefix($tofolder,1);
				
				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"$tofolder\"");
				$buffer = $this->mail_get_line();

				/* if any problem with the server, stop the function */
				if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."$tofolder/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
				$this->mail_set_flag($msg,"\\DELETED","+");
				
				// Expunge NOW instead of expunge on disconnect
        	                // so no reconnect is required for update the list
                	        $this->mail_expunge();
                        	//$this->_require_expunge = true;
	
			}

			return 1;

		} else {

			if((strtoupper($tofolder) != "INBOX" && strtoupper($tofolder) != "SPAM") && strtolower($tofolder) != strtolower($msg["folder"])) {
				/* now we are working with POP3 */
				/* check the message id to make sure that the messages still in the server */
				if(strtoupper($msg["folder"]) == "INBOX" || strtoupper($msg["folder"]) == "SPAM") {
	
					$this->mail_send_command("TOP ".$msg["id"]." 0");
					$buffer = $this->mail_get_line();
		
					/* if any problem with the server, stop the function */
					if(substr($buffer, 0, 3) != "+OK")  { $this->mail_error_msg = $buffer; return 0; }
		
					unset($header);
		
					while (!feof($this->mail_connection)) {
						$buffer = $this->mail_get_line();
						if(trim($buffer) == ".") break;
						$header .= $buffer;
					}
					$mail_info = $this->get_mail_info($header);
		
		
					/* compare the old and the new message id, if different, stop*/
					if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
						$this->mail_error_msg = $error_retrieving;
						return 0;
					}
	
					if(!file_exists($msg["localname"])) {
						if(!$this->mail_retr_msg($msg,0)) return 0;
						$this->mail_set_flag($msg,"\\SEEN","-");
					}
				}				
				// ensure that the original file exist
				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."$tofolder/$basename";
					copy($currentname, $newfilename);
					// ensure that the copy exist
					if(file_exists($newfilename)) {
						unlink($currentname);
						// delete from server if we are working on inbox or spam
						if(strtoupper($msg["folder"]) == "INBOX" || strtoupper($msg["folder"]) == "SPAM") {
							$this->mail_send_command("DELE ".$msg["id"]);
							$buffer = $this->mail_get_line();
							if(substr($buffer, 0, 3) != "+OK") {
								$this->mail_error_msg = $buffer;
								return 0;
							}
						}
					} else
						return 0;
				} else 
					return 0;						
			} else 
				return 0;
		}
		return 1;
	}

	/*
	 * The below returns an 3 element array:
	 *   $myreturnarray[0] == The message list
	 *   $myreturnarray[1] == the auto-spam populated list
	 *   $myreturnarray[2] == return status where:
	 *     -1 = Error; 0 = OK, No Changes; 1 = OK, Had Changes
	 * NOTE: $myreturnarray[0] is ALWAYS the $boxname list !
	 */
	function mail_list_msgs($boxname = "INBOX", $localmessages = Array()) {


		global $userfolder;
		$fetched_part = 0;
		$parallelized = 0;
		// $this->havespam = "";

		if($this->is_system_folder($boxname))
			$boxname = strtolower($boxname);

		$messages = Array();
		$messagescopy = Array();

		/* choose the protocol */

		if($this->mail_protocol == "imap") {

			/* select the mail box and make sure that it exists */
			$boxinfo = $this->mail_select_box($boxname);

			if(is_array($boxinfo) && $boxinfo["exists"]) {

				/* if the box is ok, fetch the first to the last message, getting the size and the header */
	
				$this->mail_send_command("FETCH 1:".$boxinfo["exists"]." (FLAGS RFC822.SIZE RFC822.HEADER)");
				$buffer = $this->mail_get_line();
	
				/* if any problem, stop the procedure */
	
				if(!eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { 
	
					$counter = 0;
					
					/* the end mark is <sid> OK FETCH, we are waiting for it*/
					while(!eregi("^(".$this->_sid." OK)",$buffer)) {
						/* if the return is something such as * N FETCH, a new message will displayed  */
						if(eregi("[ ]?\\*[ ]?([0-9]+)[ ]?FETCH",$buffer,$regs)) {
							$curmsg	= $regs[1];
							eregi("SIZE[ ]?([0-9]+)",$buffer,$regs);
							$size	= $regs[1];
							eregi("FLAGS[ ]?\\((.*)\\)",$buffer,$regs);
							$flags 	= $regs[1];
						/* if any problem, add the current line to buffer */
						} elseif(trim($buffer) != ")" && trim($buffer) != "") {
							$header .= $buffer;
		
						/*	the end of message header was reached, increment the counter and store the last message */
						} elseif(trim($buffer) == ")") {
							$messages[$counter]["id"] = $counter+1; //$msgs[0];
							$messages[$counter]["msg"] = $curmsg;
							$messages[$counter]["size"] = $size;
							$messages[$counter]["flags"] = strtoupper($flags);
							$messages[$counter]["header"] = $header;
							$counter++;
							$header = "";
						}
						$buffer = $this->mail_get_line();
					}
				}
			}
		} else {

			/* 
			now working with POP3
			if the boxname is "INBOX" or "SPAM", we can check in the server for messsages 
			*/
			if(strtoupper($boxname) == "INBOX" || strtoupper($boxname) == "SPAM") {
				$this->mail_send_command("LIST");
				$buffer = $this->mail_get_line();
				/* if any problem with this messages list, stop the procedure */

				if(substr($buffer, 0, 3) != "+OK")  {
					$this->mail_error_msg = $buffer;
					$myreturnarray = Array();
					$myreturnarray[0] = Array(); 
					$myreturnarray[1] = Array();
					$myreturnarray[2] = -1;
					return $myreturnarray;
				}

				$counter = 0;

				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					$buffer = trim($buffer); // trim buffer here avoid CRLF include on msg size (causes error on TOP)
					if($buffer == ".") 
						break;
					$msgs = split(" ",$buffer);
					if(is_numeric($msgs[0])) {
						$messages[$counter]["id"] = $counter+1; //$msgs[0];
						$messages[$counter]["msg"] = $msgs[0];
						$messages[$counter]["size"] = $msgs[1];
						$counter++;
					}
				}

				if (!is_array($localmessages)) $localmessages = (array)$localmessages;
				$localcount = count($localmessages);
				$onservercount = count($messages);

				/* OK, now we have id and size of messages, but we need the headers too */
				if($onservercount == 0) {
					
					$myreturnarray = Array();
					$myreturnarray[0] = Array();
					$myreturnarray[1] = Array();
					$myreturnarray[2] = 1;
					return $myreturnarray;
				}
								
				if ($onservercount < $localcount || $localcount == 0) {
					/*
					 * Someone deleted some messages on the server, refetch all
					 * headers via TOP, or we just didn't had any messages previously.
					 */
					$rescount = 0;
				} else if ($onservercount >= $localcount) {
					/*
					 * More messages have arrived or we still have the same amount of messages.
					 * Keep our old array and skip all the rest. Check if the last message
					 * is still at the same place, else we refetch all message
					 * headers again, because it is too complicated to see which messages we
					 * have or haven't.
					 */					
					$this->mail_send_command("TOP ".$messages[$localcount - 1]["msg"]." 0");
					$buffer = $this->mail_get_line();
					if(substr($buffer, 0, 3) != "+OK")  {
						$this->mail_error_msg = $buffer;
						$myreturnarray = Array();
						$myreturnarray[0] = Array(); 
						$myreturnarray[1] = Array();
						$myreturnarray[2] = -1;
						return $myreturnarray;
					}
					while (!feof($this->mail_connection)) {
						$buffer = $this->mail_get_line();
						if(trim($buffer) == ".") break;
						if(strlen($buffer) > 3) 
							$header .= $buffer;
					}
					if(!($pos = strpos($header,"\r\n\r\n") === false)) 
						$header = substr($header,0,$pos);

					$mail_info_new = $this->get_mail_info($header);
					$header = "";

					// We need the old array sorted by msg, else we can't compare
					array_qsort2($localmessages,"msg","ASC");
					$oldid = $localmessages[$localcount - 1]["message-id"];
					$newid = $mail_info_new["message-id"];

					if ("$oldid" == "$newid") {
					// Ok the ids are the same and we have new messages, fetch only the new part
					
						if ($onservercount == $localcount) {
							// in this case return nothing, get_message_list.php handle this
							$myreturnarray = Array();
							$myreturnarray[0] = Array();
							$myreturnarray[1] = Array();
							$myreturnarray[2] = 0; // zero 0 no changes
							return $myreturnarray; 
						}											
	
						if ($this->_havepipelining) {
							/*
							 * Server with PIPELINING support, fast.
							 */
							$mailcommand = array();
							for($i=$localcount;$i<$onservercount;$i++) {
								$mcmd = "TOP ".$messages[$i]["msg"]." 0";
								array_push($mailcommand, $mcmd);
							}
							$parallelized = 1;
						} else if ($this->_haveatop) {
							/*
							 * Server with ATOP support, very fast
							 */
							$mailcommand = "ATOP " . $messages[$localcount]["msg"] .
									" " .
									$messages[$onservercount - 1]["msg"];
							$parallelized = 1;
						}

						if ($parallelized)
							$this->mail_send_command($mailcommand);

						// fetch the only the new messages
						for($i=$localcount; $i<$onservercount; $i++) {
							$header = "";
							if (! $parallelized) {
								/*
								 * Fetch headers serially. Very slow.
								 */
								$this->mail_send_command("TOP ".$messages[$i]["msg"]." 0");
								$buffer = $this->mail_get_line();
								/* if any problem with this messages list, stop the procedure */
								if(substr($buffer, 0, 3) != "+OK")  { $this->mail_error_msg = $buffer; return 0; }
							}

							while (!feof($this->mail_connection)) {
								$buffer = $this->mail_get_line();
								if(trim($buffer) == ".") break;
								if(strlen($buffer) > 3) 
									$header .= $buffer;
							}
							if(!($pos = strpos($header,"\r\n\r\n") === false)) 
								$header = substr($header,0,$pos);
				
							/**
							 * Add the basic info (index and size) and then msg header 
							 * of the new msg to the old headers array
						 	 */				 
							$localmessages[$i] = $messages[$i]; 
							$localmessages[$i]["header"] = $header;
						}
						$fetched_part = $localcount;
						// now the localmessages are updated with the new ones						
						$messages = $localmessages;

						$rescount = $onservercount;
					
					} else {
					// The ids differs, refetch all						
						$rescount = 0;
					}
				}
				
				if (!$fetched_part) { // refetch all
										
					if ($this->_havepipelining) {
						/*
						 * Server with PIPELINING support, fast.
						 */
						$mailcommand = array();
						for($i=$rescount;$i<count($messages);$i++) {
							$mcmd = "TOP ".$messages[$i]["msg"] . " 0";
							array_push($mailcommand, $mcmd);
						}
						$parallelized = 1;
					} else if ($this->_haveatop) {
						/*
						 * Server with ATOP support, very fast
						 */
						$mailcommand = "ATOP " . $messages[$rescount]["msg"] .
								" " .  $messages[$onservercount - 1]["msg"];
						$parallelized = 1;
					}

					if ($parallelized)
						$this->mail_send_command($mailcommand);

					$endcount = count($messages);
					for($i=$rescount;$i<$endcount;$i++) {
						$header="";
						if (! $parallelized) {
							/*
							 * Fetch headers serially. Very slow.
							 */
							$this->mail_send_command("TOP ".$messages[$i]["msg"]." 0");
							$buffer = $this->mail_get_line();
							if(substr($buffer, 0, 3) != "+OK")  { $this->mail_error_msg = $buffer; return 0; }
						}
			
						while (!feof($this->mail_connection)) {
							$buffer = $this->mail_get_line();
							if(trim($buffer) == ".") break;
							if(strlen($buffer) > 3) 
								$header .= $buffer;
						}
						if(!($pos = strpos($header,"\r\n\r\n") === false)) 
							$header = substr($header,0,$pos);
				
						$messages[$i]["header"] = $header;
					}
				}
			} else {
				/* otherwise (not inbox or spam), we need get the message list from a cache (currently, hard disk)*/

				$datapath = $userfolder.$boxname;
				$i = 0;
				$messages = Array();
				$d = dir($datapath);
				$dirsize = 0;

				while($entry=$d->read()) {
					$fullpath = "$datapath/$entry";
					if(is_file($fullpath)) {
						$thisheader = $this->_get_headers_from_cache($fullpath);
						$messages[$i]["id"]		= $i+1;
						$messages[$i]["msg"]		= $i;
						$messages[$i]["header"]		= $thisheader;
						$messages[$i]["size"]		= filesize($fullpath);
						$messages[$i]["localname"]	= $fullpath;
						$i++;
					}
				}

				$d->close();
			}
		}
		/* 
		 * OK, now we have the message list, that contains id, size and header
		 * this script will process the header to get subject, date and other
		 * informations formatted to be displayed in the message list when needed
		 */
		$i = 0;
		$j = 0;
		$y = 0;
		$messagescopy = Array();
		$spamcopy = Array();
		for($i=0;$i<count($messages);$i++) {
			$mail_info = $this->get_mail_info($messages[$i]["header"]);

			$havespam = 0;
			$spamsubject = $mail_info["subject"];
			$xspamlevel = $mail_info["x-spam-level"];
			/*
			 * Only auto-populate the SPAM folder if
			 * we are checking the INBOX and we have _autospamfolder
			 * set :)
			 */
			if ( ($this->_autospamfolder) &&
				(strtoupper($boxname) == "INBOX" || strtoupper($boxname) == "SPAM") ) {
				foreach ($this->_spamregex as $spamregex) {
					if (eregi($spamregex,$spamsubject)) {
						$havespam = 1;
						$this->havespam = "TRUE";
						break;
					}
				}
				if ($this->userspamlevel) {
					preg_match('/[*+]+/', $xspamlevel, $matches);
					if (strlen($matches[0]) >= $this->userspamlevel) {
						$havespam = 1;
						$this->havespam = "TRUE";						
					}
				}
			}

			if (! $havespam) {
				$messagescopy[$j]		= $messages[$i];
				
				if ($fetched_part && $i < $fetched_part ) {
					$j++;
					continue;
				}
				$messagescopy[$j]["subject"]	= $mail_info["subject"];
				$messagescopy[$j]["date"]	= $mail_info["date"];
				$messagescopy[$j]["message-id"]	= $mail_info["message-id"];
				$messagescopy[$j]["from"]	= $mail_info["from"];
				$messagescopy[$j]["to"]		= $mail_info["to"];
				$messagescopy[$j]["fromname"]	= $mail_info["from"][0]["name"];
				$messagescopy[$j]["to"]		= $mail_info["to"];
				$messagescopy[$j]["cc"]		= $mail_info["cc"];
				$messagescopy[$j]["priority"]	= $mail_info["priority"];
				$messagescopy[$j]["attach"]	= (eregi("(multipart/mixed|multipart/related|application)",
									$mail_info["content-type"]))?1:0;

				if ($messagescopy[$j]["localname"] == "") {
					$messagescopy[$j]["localname"] = $this->_get_local_name($mail_info,$boxname);
				}

				$messagescopy[$j]["read"] = file_exists($flocalname)?1:0;

				/* 
				 * ops, a trick. if the message is not imap, the flags are stored in
				 * a special field on headers 
				 */

				if($this->mail_protocol != "imap" && file_exists($messagescopy[$j]["localname"])) {

					$iheaders = $this->_get_headers_from_cache($messagescopy[$j]["localname"]);
					$iheaders = $this->decode_header($iheaders);
					$messagescopy[$j]["flags"] = strtoupper($iheaders["x-um-flags"]);
					unset($iheaders);
				}
				$messagescopy[$j]["folder"] = $boxname;

				$j++;
			} else {
				$spamcopy[$y]			= $messages[$i];
				if ($fetched_part && $i < $fetched_part ) {
					$y++;
					continue;
				}

				$spamcopy[$y]["subject"]	= $mail_info["subject"];
				$spamcopy[$y]["date"]		= $mail_info["date"];
				$spamcopy[$y]["message-id"]	= $mail_info["message-id"];
				$spamcopy[$y]["from"]		= $mail_info["from"];
				$spamcopy[$y]["to"]		= $mail_info["to"];
				$spamcopy[$y]["fromname"]	= $mail_info["from"][0]["name"];
				$spamcopy[$y]["to"]		= $mail_info["to"];
				$spamcopy[$y]["cc"]		= $mail_info["cc"];
				$spamcopy[$y]["priority"]	= $mail_info["priority"];
				$spamcopy[$y]["attach"]		= (eregi("(multipart/mixed|multipart/related|application)",
									 $mail_info["content-type"]))?1:0;

				if ($spamcopy[$y]["localname"] == "") {
					$spamcopy[$y]["localname"] = $this->_get_local_name($mail_info,$boxname);
				}

				$spamcopy[$y]["read"] = file_exists($flocalname)?1:0;

				/* 
				 * ops, a trick. if the message is not imap, the flags are stored in
				 * a special field on headers 
				 */

				if($this->mail_protocol != "imap" && file_exists($spamcopy[$y]["localname"])) {

					$iheaders = $this->_get_headers_from_cache($spamcopy[$y]["localname"]);
					$iheaders = $this->decode_header($iheaders);
					$spamcopy[$y]["flags"] = strtoupper($iheaders["x-um-flags"]);
					unset($iheaders);
				}
				$spamcopy[$y]["folder"] = "spam";

				$y++;
			}
		}
		$myreturnarray = Array();
		/*
		 * Special Hack: if we are listing the SPAM folder for any
		 * reason, ensure that the 1st array *IS* the SPAM folder
		 */
		if (strtoupper($boxname) == "SPAM") {
			$myreturnarray[0] = $spamcopy; 
			$myreturnarray[1] = $messagescopy;
		} else {
			$myreturnarray[0] = $messagescopy; 
			$myreturnarray[1] = $spamcopy;
		}
		$myreturnarray[2] = 1;
		unset($messagescopy);
		unset($spamcopy);
		return $myreturnarray;
	}

	function _get_local_name($message,$boxname) {
		$flocalname = trim($this->user_folder."$boxname/".md5(trim($message["subject"].$message["date"].$message["message-id"])).".eml");
		return $flocalname;
	}

	function mail_list_boxes($boxname = "*") {
		$boxlist = Array();
		/* choose the protocol*/
		if($this->mail_protocol == "imap") {
			$this->mail_send_command("LIST \"\" $boxname");
			$buffer = $this->mail_get_line();
			/* if any problem, stop the script */
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			/* loop throught the list and split the parts */
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				$tmp = Array();
				ereg("\\((.*)\\)",$buffer,$regs);
				$flags = $regs[1];
				$tmp["flags"] = $flags;

				ereg("\\((.*)\\)",$buffer,$regs);
				$flags = $regs[1];
				
				$pos = strpos($buffer,")");
				$rest = substr($buffer,$pos+2);
				$pos = strpos($rest," ");
				$tmp["prefix"] = ereg_replace("\"(.*)\"","\\1",substr($rest,0,$pos));
				$tmp["name"] = $this->fix_prefix(trim(ereg_replace("\"(.*)\"","\\1",substr($rest,$pos+1))),0);
				$buffer = $this->mail_get_line();
				$boxlist[] = $tmp;
			}
		} else {
			/* if POP3, only list the available folders */
			$d = dir($this->user_folder);
			while($entry=$d->read()) {
				if($this->is_system_folder($entry)) 
					$entry = strtolower($entry);

				if(	is_dir($this->user_folder.$entry) && 
					$entry != ".." && 
					substr($entry,0,1) != "_" && 
					$entry != ".") {
					$boxlist[]["name"] = $entry;
				}
			}
			$d->close();
		}
		return $boxlist;
	}

	function mail_select_box($boxname = "INBOX") {
		/* this function is used only for IMAP servers */
		if($this->mail_protocol == "imap") {
			$original_name = ereg_replace("\"(.*)\"","\\1",$boxname);
			$boxname = $this->fix_prefix($original_name,1);
			$this->mail_send_command("SELECT \"$boxname\"");
			$buffer = $this->mail_get_line();
			if(preg_match("/^".$this->_sid." NO/i",$buffer)) { 
				if($this->mail_subscribe_box($original_name)) {
					$this->mail_send_command("SELECT \"$boxname\"");
					$buffer = $this->mail_get_line();
				}
			}
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			$boxinfo = Array();
			/* get total, recent messages and flags */
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				if(eregi("[ ]?\\*[ ]?([0-9]+)[ ]EXISTS",$buffer,$regs))
					$boxinfo["exists"] = $regs[1];
				if(eregi("[ ]?\\*[ ]?([0-9])+[ ]RECENT",$buffer,$regs))
					$boxinfo["recent"] = $regs[1];
				if(eregi("[ ]?\\*[ ]?FLAGS[ ]?\\((.*)\\)",$buffer,$regs))
					$boxinfo["flags"] = $regs[1];
				$buffer = $this->mail_get_line();
			}
		}
		$this->_current_folder = $boxname;
		return $boxinfo;
	}


	function mail_subscribe_box($boxname = "INBOX") {
		/* this function is used only for IMAP servers */
		if($this->mail_protocol == "imap") {
			$boxname = $this->fix_prefix(ereg_replace("\"(.*)\"","\\1",$boxname),1);
			$this->mail_send_command("SUBSCRIBE \"$boxname\"");
			$buffer = $this->mail_get_line();
			if(preg_match("/^".$this->_sid." (NO|BAD)/i",$buffer)) { 
				$this->mail_error_msg = $buffer; 
				return 0; 
			}
		}
		return 1;
	}


	function mail_create_box($boxname) {
		if($this->mail_protocol == "imap") {
			$boxname = $this->fix_prefix(ereg_replace("\"(.*)\"","\\1",$boxname),1);
			$this->mail_send_command("CREATE \"$boxname\"");
			$buffer = $this->mail_get_line();
			if(eregi("^(".$this->_sid." OK)",$buffer)) {
				@mkdir($this->user_folder.$boxname,$this->dirperm);
				return 1;
			} else { 
				$this->mail_error_msg = $buffer; return 0; 
			}

		} else {
			/* if POP3, only make a new folder */
			if(@mkdir($this->user_folder.$boxname,$this->dirperm)) return 1;
			else return 0;

		}
	}

	function mail_delete_box($boxname) {
		if($this->mail_protocol == "imap") {
			$boxname = $this->fix_prefix(ereg_replace("\"(.*)\"","\\1",$boxname),1);
			$this->mail_send_command("DELETE \"$boxname\"");
			$buffer = $this->mail_get_line();

			if(eregi("^(".$this->_sid." OK)",$buffer)) {
				$this->_RmDirR($this->user_folder.$boxname);
				return 1;
			} else { 
				$this->mail_error_msg = $buffer; 
				return 0; 
			}

		} else {
			if(is_dir($this->user_folder.$boxname)) {
				$this->_RmDirR($this->user_folder.$boxname);
				return 1;
			} else {
				return 0;
			}
		}
	}


	function mail_save_message($boxname,$message,$flags = "") {
		if($this->mail_protocol == "imap") {
			$boxname = $this->fix_prefix(ereg_replace("\"(.*)\"","\\1",$boxname),1);
			$mailcommand = array();
			$mailcommand[0] = "APPEND \"$boxname\" ($flags) {".strlen($message)."}";
			$mailcommand[1] = "$message";
			$this->mail_send_command($mailcommand);
			$buffer = $this->mail_get_line();
			if($buffer[0] == "+") {
				$this->mail_send_command("");
				$buffer = $this->mail_get_line();
			}
			if(!eregi("^(".$this->_sid." OK)",$buffer)) return 0; 
		}

		if(is_dir($this->user_folder.$boxname)) {
			$email = $this->fetch_structure($message);
			$mail_info = $this->get_mail_info($email["header"]);
			$filename = $this->_get_local_name($mail_info,$boxname);
			if(!empty($flags))
				$message = trim($email["header"])."\r\nX-UM-Flags: $flags\r\n\r\n".$email["body"];
			unset($email);
			$this->_save_file($filename,$message);
			return 1;
		}
	}

	function mail_set_flag(&$msg,$flagname,$flagtype = "+") {
		$flagname = strtoupper($flagname);
		if($this->mail_protocol == "imap") {

			if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
				$this->mail_select_box($msg["folder"]);

			if($flagtype != "+") $flagtype = "-";
			$this->mail_send_command("STORE ".$msg["id"].":".$msg["id"]." ".$flagtype."FLAGS ($flagname)");
			$buffer = $this->mail_get_line();

			while(!eregi("^(".$this->_sid." (OK|NO|BAD))",$buffer)) { 
				$buffer = $this->mail_get_line();
			}

			if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0;}

		} elseif (!file_exists($msg["localname"]))
			$this->mail_retr_msg($msg,0);

		if(file_exists($msg["localname"])) {

			$email 		= $this->_read_file($msg["localname"]);
			$email		= $this->fetch_structure($email);
			$header 	= $email["header"];
			$body	 	= $email["body"];
			$headerinfo	= $this->decode_header($header);

			$strFlags 	= trim(strtoupper($msg["flags"]));

			$flags = Array();
			if(!empty($strFlags))
				$flags = split(" ",$strFlags);

			if($flagtype == "+") {
				if(!in_array($flagname,$flags))
					$flags[] = $flagname;
			} else {
				while(list($key,$value) = each($flags))
					if(strtoupper($value) == $flagname) 
						$pos = $key;
				if(isset($pos)) unset($flags[$pos]);
			}

			$flags = join(" ",$flags);
			if(!eregi("X-UM-Flags",$header)) {
				$header .= "\r\nX-UM-Flags: $flags";
			} else {
				$header = preg_replace("/".quotemeta("X-UM-Flags:")."(.*)/i","X-UM-Flags: $flags",$header);
			}

			$msg["header"]  = $header;
			$msg["flags"]	= $flags;

			//print_struc($msg);

			$email = "$header\r\n\r\n$body";

			$this->_save_file($msg["localname"],$email);

			unset($email,$header,$body,$flags,$headerinfo);
		}
		return 1;
	}

	function mail_disconnect() {
		if($this->mail_connected()) {
			if($this->mail_protocol == "imap") {
				if($this->_require_expunge)
					$this->mail_expunge();
				$this->mail_send_command("LOGOUT");
				$tmp = $this->mail_get_line();
			} else {
				$this->mail_send_command("QUIT");
				$tmp = $this->mail_get_line();
			}
			fclose($this->mail_connection);
			$this->mail_connection = "";
			//usleep(500);
			return 1;
		} else return 0;
	
	}

	function mail_disconnect_force() {
		if($this->mail_connected()) {
			$this->mail_send_command("FORCEDQUIT");
			$tmp = $this->mail_get_line();
			fclose($this->mail_connection);
			$this->mail_connection = "";
			// Sleep to make it possible that the server can resume.
			sleep(2);
			return 1;
		} else return 0;
	
	}

	function mail_expunge() {
		if($this->mail_protocol == "imap") {
			$this->mail_send_command("EXPUNGE");
			$buffer = $this->mail_get_line();
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				$buffer = $this->mail_get_line();
			}
		}
		return 1;
	}

	function mail_pop3_capa() {
		$capa = Array();
		$this->mail_connect();
		if ($this->mail_protocol == "pop3") {
			$this->mail_send_command("CAPA");
                               while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(ereg("PIPELINING",$buffer))
						$capa["PIPELINING"] = 1;
					if(ereg("ATOP",$buffer))
						$capa["ATOP"] = 1;
					if(ereg("APOP",$buffer))
						$capa["APOP"] = 1;
					if(ereg("UIDL",$buffer))
						$capa["UIDL"] = 1;
					if(chop($buffer) == ".")
						break;
                               }
		}
		$this->mail_disconnect();
		return ($capa);
	}


}
?>
