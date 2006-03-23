<?php
class Telaen extends Telaen_core {

	var $_autospamfolder	= "TRUE";
	var $_spamregex		= Array("^\*\*\*\*\*SPAM\*\*\*\*\*", "^\*\*\*\*\*VIRUS\*\*\*\*\*");
	var $havespam		= "";
	var $_haveatop		= "";
	var $_havepipelining	= "";
	var $_system_folders    = Array("inbox","trash","sent","spam");
	var $_current_folder 	= "";
	var $CRLF				= "\r\n";
	var $userspamlevel		= 0;	// Disabled

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
		foreach ($this->_system_folders as $test) {
			if (strtolower($test) == strtolower($name)) {
				return 1;
			}
		}
		return 0;
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

	function mail_send_command($cmd) {

		if($this->mail_connected()) {
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
				if($this->mail_protocol == "imap") $regexp = "^([ ]?\\*[ ]?OK)";
				else $regexp = "^(\\+OK)";
				if(ereg($regexp,$buffer)) return 1;
				else return 0;
			}
			return 0;
		} else return 1;
	}

	function have_pipe_capability() {
		if($this->mail_connected()) {
			$haspipe = 0;
			if ($this->mail_protocol == "pop3") {
				$this->mail_send_command("CAPA".$this->CRLF);
                                while (!feof($this->mail_connection)) {
                                        $buffer = $this->mail_get_line();
					if(ereg("PIPELINING",$buffer))
						$haspipe = 1;
                                        if(chop($buffer) == ".") break;
                                        $msgcontent .= $buffer;
                                }
				if (!$haspipe) {
					$this->mail_send_command("EPOP".$this->CRLF);
					while (!feof($this->mail_connection)) {
						$buffer = $this->mail_get_line();
						if(ereg("PIPELINING",$buffer))
							$haspipe = 1;
						if(chop($buffer) == ".") break;
						$msgcontent .= $buffer;
					}
				}
				return ($haspipe);
			}
		}
		return (0);
	}

	function mail_auth($checkfolders=false) {
		if($this->mail_connected()) {
			if ($this->mail_protocol == "imap") {
				$this->mail_send_command("LOGIN ".$this->mail_user." ".$this->mail_pass.$this->CRLF);
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
				$this->mail_send_command("USER ".$this->mail_user.$this->CRLF);
				$buffer = $this->mail_get_line();
				if(ereg("^(\+OK)",$buffer)) {
					$this->mail_send_command("PASS ".$this->mail_pass.$this->CRLF);
					$buffer = $this->mail_get_line();
					if(ereg("^(\+OK)",$buffer)) { 
						if($checkfolders)
							$this->_check_folders();
						return 1;
					} else { 
						$this->mail_error_msg = $buffer; 
						return 0; 
					}
				} else 
					return 0;
			}
		}
		return 0;
	}

	function _check_folders() {
		$userfolder 			= $this->user_folder;
		$temporary_directory 	= $this->temp_folder;
		$idle_timeout 			= $this->timeout;

		if(!file_exists($this->user_folder))
			if(!@mkdir($this->user_folder,0700)) die("<h1><br><br><br><center>$error_permiss</center></h1>");

		$boxes = $this->mail_list_boxes();

		if($this->mail_protocol == "imap") {
		
			$tmp = $this->_system_folders;

			for($i=0;$i<count($boxes);$i++) {
				$current_folder = $boxes[$i]["name"];

				if(in_array(strtolower($current_folder),$this->_system_folders)) 
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
				if(!in_array(strtolower($current_folder),$this->_system_folders)) 
					if(!file_exists($this->user_folder.$current_folder)) 
						mkdir($this->user_folder.$current_folder,0700);
			}



		}

		$system_folders = array_merge((array)$this->_system_folders,Array("_attachments","_infos"));

		while(list($index,$value) = each($system_folders)) {
			$value = $this->fix_prefix($value,1);
			if(!file_exists($this->user_folder.$value)) {
				if(in_array(strtolower($value),$this->_system_folders)) 
					$value = strtolower($value);
				mkdir($this->user_folder.$value,0700);
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

				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]".$this->CRLF);
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
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY[TEXT]".$this->CRLF);
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
				$this->mail_send_command("TOP ".$msg["id"]." 0".$this->CRLF);
				$buffer = $this->mail_get_line();

				if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }

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
				$this->mail_send_command($command.$this->CRLF);

				$buffer = $this->mail_get_line();

				if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
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
	
			$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]".$this->CRLF);
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

				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"$trash_folder\"".$this->CRLF);
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

			$this->_require_expunge = true;

			return 1;

		} else {
			/* now we are working with POP3 */
			/* check the message id to make sure that the messages still in the server */
			if(strtoupper($msg["folder"]) == "INBOX" || strtoupper($msg["folder"]) == "SPAM") {

				$this->mail_send_command("TOP ".$msg["id"]." 0".$this->CRLF);
				$buffer = $this->mail_get_line();
	
				/* if any problem with the server, stop the function */
				if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
	
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

				$this->mail_send_command("DELE ".$msg["id"].$this->CRLF);
				$buffer = $this->mail_get_line();
				if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
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
		
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]".$this->CRLF);
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
				
				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"$tofolder\"".$this->CRLF);
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
				$this->_require_expunge = true;
			}

			return 1;

		} else {

			if((strtoupper($tofolder) != "INBOX" && strtoupper($tofolder) != "SPAM") && strtolower($tofolder) != strtolower($msg["folder"])) {
				/* now we are working with POP3 */
				/* check the message id to make sure that the messages still in the server */
				if(strtoupper($msg["folder"]) == "INBOX" || strtoupper($msg["folder"]) == "SPAM") {
	
					$this->mail_send_command("TOP ".$msg["id"]." 0".$this->CRLF);
					$buffer = $this->mail_get_line();
		
					/* if any problem with the server, stop the function */
					if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
		
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
					$this->mail_send_command("DELE ".$msg["id"].$this->CRLF);
					$buffer = $this->mail_get_line();
					if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				}
				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."$tofolder/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
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
	 */
	function mail_list_msgs($boxname = "INBOX", $headers = Array()) {


		global $userfolder;
		$fetched_part = 0;
		$parallelized = 0;
		// $this->havespam = "";

		if(in_array(strtolower($boxname),$this->_system_folders)) 
			$boxname = strtolower($boxname);

		$messages = Array();
		$messagescopy = Array();

		/* choose the protocol */

		if($this->mail_protocol == "imap") {

			/* select the mail box and make sure that it exists */
			$boxinfo = $this->mail_select_box($boxname);

			if(is_array($boxinfo) && $boxinfo["exists"]) {

				/* if the box is ok, fetch the first to the last message, getting the size and the header */
	
				$this->mail_send_command("FETCH 1:".$boxinfo["exists"]." (FLAGS RFC822.SIZE RFC822.HEADER)".$this->CRLF);
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
				$this->mail_send_command("LIST".$this->CRLF);
				$buffer = $this->mail_get_line();
				/* if any problem with this messages list, stop the procedure */

				if(!ereg("^(\+OK)",$buffer))  {
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
					if(trim($buffer) == ".") break;
					$msgs = split(" ",$buffer);
					if(is_numeric($msgs[0])) {
						$messages[$counter]["id"] = $counter+1; //$msgs[0];
						$messages[$counter]["msg"] = $msgs[0];
						$messages[$counter]["size"] = $msgs[1];
						$counter++;
					}
				}


				$oldheaders = (array)$headers;
				$newheaders = $messages;
				$oldheaderscount = count($oldheaders);
				$newheaderscount = count($messages);

				/* OK, now we have id and size of messages, but we need the headers too */
				if($newheaderscount == 0) {
					$myreturnarray = Array();
					$myreturnarray[0] = Array();
					$myreturnarray[1] = Array();
					$myreturnarray[2] = 1;
					return $myreturnarray;
				}

				if ($newheaderscount < $oldheaderscount || $oldheaderscount == 0) {
					/*
					 * Someone deleted some messages on the server, refetch all
					 * headers via TOP, or we just didn't had any messages previously.
					 */
					$rescount = 0;
				} else if ($newheaderscount >= $oldheaderscount) {
					/*
					 * More messages have arrived or we still have the same amount of messages.
					 * Keep our old array and skip all the rest. Check if the last message
					 * is still at the same place, else we refetch all message
					 * headers again, because it is too complicated to see which messages we
					 * have or haven't.
					 */
					$this->mail_send_command("TOP ".$messages[$oldheaderscount - 1]["msg"]." 0".$this->CRLF);
					$buffer = $this->mail_get_line();
					if(!ereg("^(\+OK)",$buffer))  {
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
					array_qsort2($oldheaders,"msg","ASC");
					$oldid = $oldheaders[$oldheaderscount - 1]["message-id"];
					$newid = $mail_info_new["message-id"];

					if ("$oldid" == "$newid") {
						if ($newheaderscount == $oldheaderscount) {
							$myreturnarray = Array();
							$myreturnarray[0] = Array();
							$myreturnarray[1] = Array();
							$myreturnarray[2] = 0;
							return $myreturnarray;
						}

						if ($this->_havepipelining == "TRUE") {
							/*
							 * Server with PIPELINING support, fast.
							 */
							for($i=$oldheaderscount;$i<$newheaderscount;$i++) {
								$mailcommand .= "TOP ".$newheaders[$i]["msg"]." 0".$this->CRLF;
							}
							$parallelized = 1;
						} else if ($this->_haveatop == "TRUE") {
							/*
							 * Server with ATOP support, very fast
							 */
							$mailcommand = "ATOP " . $newheaders[$oldheaderscount]["msg"] .
									" " .
									$messages[$newheaderscount - 1]["msg"] . $this->CRLF;
							$parallelized = 1;
						}

						if ($parallelized)
							$this->mail_send_command($mailcommand);

						for($i=$oldheaderscount;$i<$newheaderscount;$i++) {
							if (! $parallelized) {
								/*
								 * Fetch headers serially. Very slow.
								 */
								$this->mail_send_command("TOP ".$newheaders[$i]["msg"]." 0".$this->CRLF);
								$buffer = $this->mail_get_line();
								/* if any problem with this messages list, stop the procedure */
								if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
							}

							while (!feof($this->mail_connection)) {
								$buffer = $this->mail_get_line();
								if(trim($buffer) == ".") break;
								if(strlen($buffer) > 3) 
									$header .= $buffer;
							}
							if(!($pos = strpos($header,"\r\n\r\n") === false)) 
								$header = substr($header,0,$pos);

							$oldheaders[$i + 1]["header"] = $header;
							$header = "";

							$oldheaders[$i + 1]["id"] = $messages[$i]["id"];
							$oldheaders[$i + 1]["msg"] = $messages[$i]["msg"];
							$oldheaders[$i + 1]["size"] = $messages[$i]["size"];
						}
						$fetched_part = $oldheaderscount;
						$messages = array_merge($oldheaders, null);
						$rescount = $newheaderscount;
					} else {
						$rescount = 0;
					}
				}

				if (! $fetched_part) {
					if ($this->_havepipelining == "TRUE") {
						/*
						 * Server with PIPELINING support, fast.
						 */
						for($i=$rescount;$i<count($messages);$i++) {
							$mailcommand .= "TOP ".$messages[$i]["msg"] . 
									" 0".$this->CRLF;
						}
						$parallelized = 1;
					} else if ($this->_haveatop == "TRUE") {
						/*
						 * Server with ATOP support, very fast
						 */
						$mailcommand = "ATOP " . $messages[$rescount]["msg"] .
								" " .  $messages[$newheaderscount - 1]["msg"] .
								$this->CRLF;
						$parallelized = 1;
					}

					if ($parallelized)
						$this->mail_send_command($mailcommand);

					for($i=$rescount;$i<count($messages);$i++) {
						if (! $parallelized) {
							/*
							 * Fetch headers serially. Very slow.
							 */
							$this->mail_send_command("TOP ".$messages[$i]["msg"]." 0".$this->CRLF);
							$buffer = $this->mail_get_line();
							if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
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
						$header="";
					}
				}
			} else {
				/* otherwise, we need get the message list from a cache (currently, hard disk)*/

				$datapath = $userfolder.$boxname;
				$i = 0;
				$messages = Array();
				$d = dir($datapath);
				$dirsize = 0;

				while($entry=$d->read()) {
					$fullpath = "$datapath/$entry";
					if(is_file($fullpath)) {
						$thisheader = $this->_get_headers_from_cache($fullpath);
						$messages[$i]["id"]			= $i+1;
						$messages[$i]["msg"]			= $i;
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
			if ( ($this->_autospamfolder == "TRUE") &&
			      (strtoupper($boxname) == "INBOX" || strtoupper($boxname) == "SPAM") ) {
				foreach ($this->_spamregex as $spamregex) {
					if (eregi($spamregex,$spamsubject)) {
						$havespam = 1;
						$this->havespam = "TRUE";
						break;
					}
				}
				if ($this->userspamlevel) {
					preg_match('/[*]+/', $xspamlevel, $matches);
					if (strlen($matches[0]) >= $this->userspamlevel) {
						$havespam = 1;
						$this->havespam = "TRUE";						
					}
				}
			}

			if (! $havespam) {
				if ($fetched_part && $i < $fetched_part ) {
					$messagescopy[$j] = $messages[$i];
					$j++;
					continue;
				}
				$messagescopy[$j]["id"]		= $messages[$i]["id"];
				$messagescopy[$j]["msg"]	= $messages[$i]["msg"];
				$messagescopy[$j]["size"]	= $messages[$i]["size"];
				$messagescopy[$j]["localname"]	= $messages[$i]["localname"];
	
				$messagescopy[$j]["subject"] = $mail_info["subject"];
				$messagescopy[$j]["date"] = $mail_info["date"];
				$messagescopy[$j]["message-id"] = $mail_info["message-id"];
				$messagescopy[$j]["from"] = $mail_info["from"];
				$messagescopy[$j]["to"] = $mail_info["to"];
				$messagescopy[$j]["fromname"] = $mail_info["from"][0]["name"];
				$messagescopy[$j]["to"] = $mail_info["to"];
				$messagescopy[$j]["cc"] = $mail_info["cc"];
				$messagescopy[$j]["priority"] = $mail_info["priority"];
				$messagescopy[$j]["attach"] = (eregi("(multipart/mixed|multipart/related|application)",
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
				if ($fetched_part && $i < $fetched_part ) {
					$spamcopy[$y] = $messages[$i];
					$y++;
					continue;
				}
				$spamcopy[$y]["id"]		= $messages[$i]["id"];
				$spamcopy[$y]["msg"]	= $messages[$i]["msg"];
				$spamcopy[$y]["size"]	= $messages[$i]["size"];
				$spamcopy[$y]["localname"]	= $messages[$i]["localname"];
	
				$spamcopy[$y]["subject"] = $mail_info["subject"];
				$spamcopy[$y]["date"] = $mail_info["date"];
				$spamcopy[$y]["message-id"] = $mail_info["message-id"];
				$spamcopy[$y]["from"] = $mail_info["from"];
				$spamcopy[$y]["to"] = $mail_info["to"];
				$spamcopy[$y]["fromname"] = $mail_info["from"][0]["name"];
				$spamcopy[$y]["to"] = $mail_info["to"];
				$spamcopy[$y]["cc"] = $mail_info["cc"];
				$spamcopy[$y]["priority"] = $mail_info["priority"];
				$spamcopy[$y]["attach"] = (eregi("(multipart/mixed|multipart/related|application)",
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
		$myreturnarray[0] = $messagescopy; 
		$myreturnarray[1] = $spamcopy;
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
			$this->mail_send_command("LIST \"\" $boxname".$this->CRLF);
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
				if(in_array(strtolower($entry),$this->_system_folders)) 
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
			$this->mail_send_command("SELECT \"$boxname\"".$this->CRLF);
			$buffer = $this->mail_get_line();
			if(preg_match("/^".$this->_sid." NO/i",$buffer)) { 
				if($this->mail_subscribe_box($original_name)) {
					$this->mail_send_command("SELECT \"$boxname\"".$this->CRLF);
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
			$this->mail_send_command("SUBSCRIBE \"$boxname\"".$this->CRLF);
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
			$this->mail_send_command("CREATE \"$boxname\"".$this->CRLF);
			$buffer = $this->mail_get_line();
			if(eregi("^(".$this->_sid." OK)",$buffer)) {
				@mkdir($this->user_folder.$boxname,0700);
				return 1;
			} else { 
				$this->mail_error_msg = $buffer; return 0; 
			}

		} else {
			/* if POP3, only make a new folder */
			if(@mkdir($this->user_folder.$boxname,0700)) return 1;
			else return 0;

		}
	}

	function mail_delete_box($boxname) {
		if($this->mail_protocol == "imap") {
			$boxname = $this->fix_prefix(ereg_replace("\"(.*)\"","\\1",$boxname),1);
			$this->mail_send_command("DELETE \"$boxname\"".$this->CRLF);
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
			$this->mail_send_command("APPEND \"$boxname\" ($flags) {".strlen($message)."}".$this->CRLF."$message".$this->CRLF);
			$buffer = $this->mail_get_line();
			if($buffer[0] == "+") {
				$this->mail_send_command($this->CRLF);
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
			$this->mail_send_command("STORE ".$msg["id"].":".$msg["id"]." ".$flagtype."FLAGS ($flagname)".$this->CRLF);
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
				$this->mail_send_command("LOGOUT".$this->CRLF);
				$tmp = $this->mail_get_line();
			} else {
				$this->mail_send_command("QUIT".$this->CRLF);
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
			$this->mail_send_command("FORCEDQUIT".$this->CRLF);
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
			$this->mail_send_command("EXPUNGE".$this->CRLF);
			$buffer = $this->mail_get_line();
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				$buffer = $this->mail_get_line();
			}
		}
		return 1;
	}


}
?>
