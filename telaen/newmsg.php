<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

require("./inc/init.php");

// assign metas
$smarty->assign("pageMetas", $nocache);

extract(pull_from_array($_GET, Array("nameto", "mailto"), "str"));
extract(pull_from_array($_POST, Array("to", "cc", "bcc", "subject", "requireReceipt",
		"priority", "body", "is_html", "textmode", "sig", "tipo", "rtype", "ix"), "str"));

if(isset($tipo) && $tipo == "send") {

	require("./inc/class/class.phpmailer.php");
	require("./inc/class/class.phpmailer_extra.php");

	$mail = new PHPMailer_extra;
	$mail->PluginDir = "./inc/";

	if ($phpmailer_sendmail != "") {
		$mail->Sendmail = $phpmailer_sendmail;
	}
	if ($phpmailer_timeout != 0) {
		$mail->Timeout = $phpmailer_timeout;
	}
	
	$ARTo = $UM->get_names(stripslashes($to));
	$ARCc = $UM->get_names(stripslashes($cc));
	$ARBcc = $UM->get_names(stripslashes($bcc));

	// html head and foot to add, the editor can do it, but causes some problems with sign and footer
	$htmlHead = "
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$default_char_set\"></head>
<body>
	";

	$htmlFoot = "
</body>
</html>";

	// build the email	
	if((count($ARTo)+count($ARCc)+count($ARBcc)) > 0) {
	
		// set lang for error messages, english for now
		$mail->SetLanguage("en","langs/");

		// for password authenticated servers
		$mail->SMTPAuth		= $use_password_for_smtp;
		
		// use user data or static data for smtp auth
		if ($smtp_static_auth) {
			$mail->Username = $smtp_static_user;
					$mail->Password = $smtp_static_password;
		} else {		
			$mail->Username = $sess["user"];
			$mail->Password = $sess["pass"];
		}

		// if using the advanced editor
		if($is_html == "true")	{
			$mail->IsHTML(1);			
			if($footer != "") 
				$body .= preg_replace('|(\r?\n)|',"<br>$1",$footer);
			// add html head and foot
			$body = $htmlHead . $body . $htmlFoot;
			$mail->AltBody = "
This Email is formatted in HTML. Your Email client appears to be incompatible.
";

		} elseif ($footer != "") $body .= $footer;

		$mail->CharSet		= $default_char_set;
		$mail->Hostname		= getenv("SERVER_NAME");
		$mail->From			= ($allow_modified_from && !empty($prefs["reply-to"]))?$prefs["reply-to"]:$sess["email"];
		$mail->FromName		= $UM->mime_encode_headers($prefs["real-name"]);
		$mail->AddReplyTo($prefs["reply-to"], $UM->mime_encode_headers($prefs["real-name"]));

		$mail->Host			= $smtp_server;
		$mail->WordWrap		= 76;
		$mail->Priority		= $priority;
		
		if($smtp_debug) {
			$mail->SMTPDebug = true;
		}

		// add an header for keep a track of client IP
		$mail->AddCustomHeader("X-Originating-IP: ".getenv("REMOTE_ADDR"));		
		
		// add return-receipt if required 
		if ( isset($requireReceipt) ) { 
			$mail->ConfirmReadingTo =  $prefs["reply-to"];
		}

		// add recipients
		if(count($ARTo) != 0) {
			for($i=0;$i<count($ARTo);$i++) {
				$name = $ARTo[$i]["name"];
				$email = $ARTo[$i]["mail"];
				if($name != $email)
					$mail->AddAddress($email,$UM->mime_encode_headers($name));
				else
					$mail->AddAddress($email);
			}
		}

		if(count($ARCc) != 0) {
			for($i=0;$i<count($ARCc);$i++) {
				$name = $ARCc[$i]["name"];
				$email = $ARCc[$i]["mail"];
				if($name != $email)
					$mail->AddCC($email,$UM->mime_encode_headers($name));
				else
					$mail->AddCC($email);
			}
		}

		if(count($ARBcc) != 0) {
			for($i=0;$i<count($ARBcc);$i++) {
				$name = $ARBcc[$i]["name"];
				$email = $ARBcc[$i]["mail"];
				if($name != $email)
					$mail->AddBCC($email,$UM->mime_encode_headers($name));
				else
					$mail->AddBCC($email);
			}
		}

		if(array_key_exists("attachments",$sess)) {
			$attachs = $sess["attachments"];
			for($i=0;$i<count($attachs);$i++) {
				if(file_exists($attachs[$i]["localname"])) {
					$mail->AddAttachment($attachs[$i]["localname"], $attachs[$i]["name"], "base64", $attachs[$i]["type"]);
				}
			}
		}

		$mail->Subject = $UM->mime_encode_headers(stripslashes($subject));
		$mail->Body = stripslashes($body);
		$mail->Mailer = $mailer_type;

		if(($mail->TelaenSend()) === false) {
			$smarty->assign("umMailSent",false);
			$smarty->assign("umErrorMessage",$mail->ErrorInfo);

		} else {
		
			$smarty->assign("umMailSent",true);

			if(array_key_exists("attachments",$sess)) {
				unset($sess["attachments"]);
				reset($sess);
				$SS->Save($sess);
			}
			
			
			if($prefs["save-to-sent"]) {

				if(!$UM->mail_connect()) {				
					redirect_and_exit("index.php?err=1", true);
				}
				if(!$UM->mail_auth(false)) { redirect_and_exit("index.php?err=0"); }
				$UM->mail_save_message("sent",$mail->TelaenGetEmail(),"\\SEEN");
				unset($sess["headers"][base64_encode("sent")]);
				$UM->mail_disconnect();
				$SS->Save($sess);

			}
		}

	} else die("<script language=\"javascript\" type=\"text/javascript\">location = 'index.php?err=3';</script>");

	$jssource = $commonJS;
	$jssource .= "	
	<script language=\"javascript\" type=\"text/javascript\">
	//<![CDATA[
	function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
	function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
	function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
	function search() { location = 'search.php?folder=".urlencode($folder)."';}
	//]]>
	</script>	
	";
	

	$smarty->assign("umJS",$jssource);

	$smarty->display("$selected_theme/newmsg-result.htm");

} else {
	
	// priority
	$priority_level = (!isset($priority) || empty($priority)) ? 3 : $priority;
	$smarty->assign("umPriority",$priority_level);

	// adv editor
	if(!isset($textmode))
		$textmode = null;
		$show_advanced = ((!$textmode) && ($prefs["editor-mode"] != "text")) ? 1 : 0 ;
		$js_advanced = ($show_advanced) ? "true" : "false" ;

		// signature
		$signature = $prefs["signature"];
		if($show_advanced)
			$signature = nl2br($signature);
	
		$add_sig = $prefs["add-sig"];
		$addSignature = ($add_sig) ? 1 : 0 ;
		$smarty->assign("umAddSignature", $addSignature);

		// return receipt
		$rr = ($prefs["require-receipt"])? true:false;
		$smarty->assign("requireReceipt", $rr);

	// hidden inputs ---- Note: these should be moved into template...
	$forms = "<input type=\"hidden\" name=\"tipo\" value=\"edit\" />
	<input type=\"hidden\" name=\"is_html\" value=\"$js_advanced\" />
	<input type=\"hidden\" name=\"folder\" value=\"$folder\" />
	<input type=\"hidden\" name=\"sig\" value=\"".htmlspecialchars($signature)."\" />
	<input type=\"hidden\" name=\"textmode\" value=\"$textmode\" />
	";
	$smarty->assign("umForms",$forms);


	$jssource = $commonJS;

	if ($show_advanced) {
		$jssource .= "
	<script type=\"text/javascript\" src=\"editors/tiny_mce/tiny_mce_gzip.js\"></script>
	<script type=\"text/javascript\" src=\"editors/tiny_mce/tiny_comp_init.js\"></script>
	<script type=\"text/javascript\" src=\"editors/tiny_mce/tiny_init.js\"></script>
		";
	}

	$jssource .= "
	<script language=\"javascript\" type=\"text/javascript\">
	//<![CDATA[
	bIs_html = $js_advanced;
	bsig_added = false;
	function addsig() {
		with(document.composeForm) {
			if(bsig_added || sig.value == '') return false;
			if(cksig.checked) {
				if(bIs_html) {					
					body.value +='<br /><br />----<br />'+sig.value;
				} else
					body.value += '\\r\\n\\r\\n----\\r\\n'+sig.value;
			}
			cksig.disabled = true;
			bsig_added = true;
		}
		return true;
	}

	function upwin(rem) { 
		mywin = 'upload.php';
		if (rem != null) mywin += '?rem='+rem+'';
		else mywin += '';
		window.open(mywin,'Upload','width=400,height=120,scrollbars=0,menubar=0,status=0'); 
	}

	function doupload() {
		document.composeForm.tipo.value = 'edit';
		document.composeForm.submit();
	}

	function textmode() {
		with(document.composeForm) {
			textmode.value = 1;
			tipo.value = 'edit';
			submit();
		}
	}

	function enviar() {
		error_msg = new Array();
		frm = document.composeForm;
		check_mail(frm.to.value);
		check_mail(frm.cc.value);
		check_mail(frm.bcc.value);
		errors = error_msg.length;

		if(frm.to.value == '' && frm.cc.value == '' && frm.bcc.value == '')
			alert('".preg_replace("|'|","\\'",$error_no_recipients)."');

		else if (errors > 0) {

			if (errors == 1) errmsg = '".preg_replace("|'|","\\'",$error_compose_invalid_mail1_s)."\\r\\r';
			else  errmsg = '".preg_replace("|'|","\\'",$error_compose_invalid_mail1_p)."\\r\\r';

			for(i=0;i<errors;i++)
				errmsg += error_msg[i]+'\\r';

			if (errors == 1) errmsg += '\\r".preg_replace("|'|","\\'",$error_compose_invalid_mail2_s)."s';
			else  errmsg += '\\r".preg_replace("|'|","\\'",$error_compose_invalid_mail2_p)."';

			alert(errmsg)
	
		} else {
			frm.tipo.value = 'send';
			frm.submit();
		}
	}
	
	function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
	function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
	function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
	function search() { location = 'search.php?folder=".urlencode($folder)."';}
	function addrpopup(where) {
		url = 'quick_address.php?where=' + where;
		mywin = window.open(url,'AddressBook','width=600,height=300,top=150,left=150');
	}
	function AddAddress(strType,strAddress) {
		obj = eval('document.composeForm.'+strType);
		if(obj.value == '') obj.value = strAddress
		else  obj.value = obj.value + ', ' + strAddress
	}
	
	function check_mail(strmail) {
		if(strmail == '') return;
		chartosplit = ',;';
		protectchar = '\"';
		temp = '';
		armail = new Array();
		inthechar = false; 
		lt = '<';
		gt = '>'; 
		isclosed = true;
	
		for(i=0;i<strmail.length;i++) {
			thischar = strmail.charAt(i);
			if(thischar == lt && isclosed) isclosed = false;
			if(thischar == gt && !isclosed) isclosed = true;
			if(thischar == protectchar) inthechar = (inthechar)?0:1;
			if(chartosplit.indexOf(thischar) != -1 && !inthechar && isclosed) {
				armail[armail.length] = temp; temp = '';
			} else temp += thischar;
		}
	
		armail[armail.length] = temp; 
	
		for(i=0;i<armail.length;i++) {
			thismail = armail[i]; strPat = /(.*)<(.*)>/;
			matchArray = thismail.match(strPat); 
			if (matchArray != null) strEmail = matchArray[2];
			else {
				strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/; matchArray = thismail.match(strPat); 
				if (matchArray != null) strEmail = matchArray[1];
				else strEmail = thismail;
			}
			if(strEmail.charAt(0) == '\"' && strEmail.charAt(strEmail.length-1) == '\"') strEmail = strEmail.substring(1,strEmail.length-1)
			if(strEmail.charAt(0) == '<' && strEmail.charAt(strEmail.length-1) == '>') strEmail = strEmail.substring(1,strEmail.length-1)
	
			strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/;
			matchArray = strEmail.match(strPat); 
			if(matchArray == null)
				error_msg[error_msg.length] = strEmail;
		}
	}
	
	//]]>
	</script>
	
	<script type=\"text/javascript\">
	//<![CDATA[
	window.setInterval(function() {
			new Ajax.Request('ajax.php', {
					method: 'post',
					parameters: {action: 'pingSession'}
			});
	}, 60000);
	//]]>
	</script>

	";
	
	$smarty->assign("umJS",$jssource);

	if(!isset($body))
		$body = null;
	$body = stripslashes($body);

	if(isset($rtype)) {
		$mail_info = $sess["headers"][base64_encode(strtolower($folder))][$ix];

		if( ($rtype == "forward" && !stristr($mail_info["flags"], '\\FORWARDED'))
			|| ($rtype != "forward" && !stristr($mail_info["flags"], '\\ANSWERED'))) {

			if(!$UM->mail_connect()) { 
				redirect_and_exit("index.php?err=1", true);
			}
			if(!$UM->mail_auth()) { 
				redirect_and_exit("index.php?err=0");
			}
			if($rtype != "forward" && $UM->mail_set_flag($mail_info,"\\ANSWERED","+")) {
				$sess["headers"][base64_encode(strtolower($folder))][$ix] = $mail_info;
				$SS->Save($sess);
			}
			if($rtype == "forward" && $UM->mail_set_flag($mail_info,"\\FORWARDED","+")) {
				$sess["headers"][base64_encode(strtolower($folder))][$ix] = $mail_info;
				$SS->Save($sess);
			}
			$UM->mail_disconnect(); 

		}


		$filename = $mail_info["localname"];

		if(!file_exists($filename)) die("<script>location = 'messages.php?err=2&folder=".urlencode($folder)."&pag=$pag&refr=true';</script>");
		$result = $UM->_read_file($filename);

				$UM->sanitize = ($sanitize_html || !$allow_scripts);
		$email = $UM->Decode($result);

		$result = $UM->fetch_structure($result);


		$tmpbody = $email["body"];
		$subject = $mail_info["subject"];

		$ARReplyTo = $email["reply-to"];
		$ARFrom = $email["from"];
		$useremail = $sess["email"];

		// From
		if($ARReplyTo[0]["mail"] != "") {
			$name = $ARReplyTo[0]["name"];
			$thismail = $ARReplyTo[0]["mail"];
		} else {
			$name = $ARFrom[0]["name"];
			$thismail = $ARFrom[0]["mail"];
		}
		$fromreply = "\"$name\" <$thismail>";		
		
		// These are used for re-add my address in the quoted message, since we remove it from To & CC lists
		// I don't want my adr in To or CC fields when I reply-all, but I want to see it in the quoted message.
		// If someone finds a better way to do this is welcome....
		$myToAdr = "";
		$myCCAdr = "";

		// To			
		$ARTo = $email["to"];
		for($i=0;$i<count($ARTo);$i++) {
			$name = $ARTo[$i]["name"]; 
			$thismail = $ARTo[$i]["mail"];

			// avoid to add my address in the TO list
						if ($thismail != $sess["email"] && $thismail != $prefs["reply-to"]) {
				if(isset($toreply)) 
					$toreply .= ", \"$name\" <$thismail>";
				else 
					$toreply = "\"$name\" <$thismail>";
			}
			else
				$myToAdr = "\"$name\" <$thismail>";
		}

		// CC
		$ARCC = $email["cc"];
		for($i=0;$i<count($ARCC);$i++) {
			$name = $ARCC[$i]["name"]; 
			$thismail = $ARCC[$i]["mail"];

			// avoid to add my address in the CC list
			if ($thismail != $sess["email"] && $thismail != $prefs["reply-to"]) {
				if(isset($ccreply)) 
					$ccreply .= ", \"$name\" <$thismail>";
				else 
					$ccreply = "\"$name\" <$thismail>";
			}
			else
								$myCCAdr = "\"$name\" <$thismail>";
	
		}

		function clear_names($strMail) {
			global $UM;
			$strMail = $UM->get_names($strMail);
			for($i=0;$i<count($strMail);$i++) {
				$thismail = $strMail[$i];
				$thisline = ($thismail["mail"] != $thismail["name"])?"\"".$thismail["name"]."\""." <".$thismail["mail"].">":$thismail["mail"];
				if($thismail["mail"] != "" && strpos($result,$thismail["mail"]) === false) {
					if($result != "") $result .= ", ".$thisline;
					else $result = $thisline;
				}
			}
			return $result;
		}


		$allreply = clear_names($fromreply.", ".$toreply);
		$ccreply = clear_names($ccreply);
		$fromreply = clear_names($fromreply);

		$msgsubject = $email["subject"];

		$fromreply_quote	= $fromreply;
		$toreply_quote		= $toreply;
		$ccreply_quote		= $ccreply;
		$msgsubject_quote	= $msgsubject;

		// re-add my address in the quoted message, why? look at line #412
		if (!empty($myToAdr))
			if (empty($toreply_quote))
				$toreply_quote = $myToAdr;			
			else 
				$toreply_quote = $myToAdr . "," . $toreply_quote;

		if (!empty($myCCAdr))
			if (empty($ccreply_quote))
								$ccreply_quote = $myCCAdr;
						else
								$ccreply_quote = $myCCAdr . "," . $ccreply_quote;

		
		if($show_advanced) {
			$fromreply_quote	= htmlspecialchars($fromreply_quote);
			$toreply_quote		= htmlspecialchars($toreply_quote);
			$ccreply_quote		= htmlspecialchars($ccreply_quote);
			$msgsubject_quote	= htmlspecialchars($msgsubject_quote);
			$linebreak			= "<br>";

		} else {
			$tmpbody			= strip_tags($tmpbody);
			$quote_string = "> ";
			$tmpbody = $quote_string.preg_replace('|\n|',"\n$quote_string",$tmpbody);
		}

$body = "
$reply_delimiter$linebreak
$reply_from_hea ".preg_replace('|(")|',"",$fromreply_quote)."$linebreak
$reply_to_hea ".preg_replace('|(")|',"",$toreply_quote);

if(!empty($ccreply)) {
	$body .= "$linebreak
$reply_cc_hea ".preg_replace('|(")|',"",$ccreply_quote);
}


$body .= "$linebreak
$reply_subject_hea ".$msgsubject_quote."$linebreak
$reply_date_hea ".@strftime($date_format,$email["date"])."$linebreak
$linebreak
$tmpbody";


		if($show_advanced) {
			$body = "
<br>
<blockquote dir=\"ltr\" style=\"padding-right: 0px; padding-left: 5px; margin-left: 5px; border-left: #000000 2px solid; margin-right: 0px\">
  <div style=\"font: 10pt arial\">
  $body
  </div>
</blockquote>
<br>
";
		}

		switch($rtype) {
		case "reply":
			if(!preg_match("/^$reply_prefix/i",trim($subject))) $subject = "$reply_prefix $subject";
			$to = $fromreply;
			break;
		case "replyall":
			if(!preg_match("/^$reply_prefix/i",trim($subject))) $subject = "$reply_prefix $subject";
			$to = $allreply;
			$cc = $ccreply;
			break;
		case "forward":
			if(!preg_match("/^$forward_prefix/i",trim($subject))) $subject = "$forward_prefix $subject";
			if(count($email["attachments"]) > 0) {
				for($i = 0; $i < count($email["attachments"]); $i++) {
					$current = $email["attachments"][$i];
					$ind = count($sess["attachments"]);
					$sess["attachments"][$ind]["localname"] = $current["filename"];
					$sess["attachments"][$ind]["name"] = $current["name"];
					$sess["attachments"][$ind]["type"] = $current["content-type"];
					$sess["attachments"][$ind]["size"] = $current["size"];
				}
				$SS->Save($sess);
			}
			break;
		}
		if($add_sig && !empty($signature)) 
			if($show_advanced) $body = "<br><br>----<br>$signature<br><br>$body";
			else $body = "\r\n\r\n----\r\n$signature\r\n\r\n$body";
	} else

		if($add_sig && !empty($signature) && empty($body)) 
			if($show_advanced) $body = "<br><br>----<br>$signature<br><br>$body";
			else $body = "\r\n\r\n----\r\n$signature\r\n\r\n$body";

	$haveSig = empty($signature) ? 0 : 1 ;
	$smarty->assign("umHaveSignature",$haveSig);

	if(!isset($to)) $to = null;
	if(!isset($cc)) $cc = null;
	if(!isset($bcc)) $bcc = null;
	if(!isset($subject)) $subject = null;


	$strto = (isset($nameto) && preg_match('|([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_])|i',$mailto))?
	"<input class=\"textbox\" style=\"width : 200px;\" type=\"text\" size=\"20\" name=\"to\" value=\"&quot;".htmlspecialchars(stripslashes($nameto))."&quot; <".htmlspecialchars(stripslashes($mailto)).">\" />
	":"<input class=\"textbox\" style=\"width : 200px;\" type=\"text\" size=\"20\" name=\"to\" value=\"".htmlspecialchars(stripslashes($to))."\" />";


	$strcc = "<input class=\"textbox\" style=\"width : 200px;\" type=\"text\" size=\"20\" name=\"cc\" value=\"".htmlspecialchars(stripslashes($cc))."\" />";
	$strbcc = "<input class=\"textbox\" style=\"width : 200px;\" type=\"text\" size=\"20\" name=\"bcc\" value=\"".htmlspecialchars(stripslashes($bcc))."\" />";
	$strsubject = "<input class=\"textbox\" style=\"width : 200px;\" type=\"text\" size=\"20\" name=\"subject\" value=\"".htmlspecialchars(stripslashes($subject))."\" />";


	if(array_key_exists("attachments", $sess) && count($attachs = $sess["attachments"]) > 0) {

		$smarty->assign("umHaveAttachs",1);
		$attachlist = Array();
		for($i=0;$i<count($attachs);$i++) {
			$index = count($attachlist);

			$attachlist[$index]["name"] = $attachs[$i]["name"];
			$attachlist[$index]["size"] = ceil($attachs[$i]["size"]/1024);
			$attachlist[$index]["type"] = $attachs[$i]["type"];
			$attachlist[$index]["link"] = "javascript:upwin($i)";
		}
		$smarty->assign("umAttachList",$attachlist);
	}

	if(!$show_advanced) $body = stripslashes($body);

	if(!isset($txtarea)) $txtarea = null;
	/*
	 * Force the below to 0. We do not want to
	 * enable the old HTML editor even when using
	 * HTML Email.
	 */
	// $umAdvEdit = ($show_advanced) ? 1 : 0 ;
	$umAdvEdit = 0 ;

	$smarty->assign("umBody",$body);
	$smarty->assign("umTo",$strto);
	$smarty->assign("umCc",$strcc);
	$smarty->assign("umBcc",$strbcc);
	$smarty->assign("umSubject",$strsubject);
	$smarty->assign("umTextEditor",$txtarea);
	$smarty->assign("umAdvancedEditor",$umAdvEdit);

	$smarty->display("$selected_theme/newmsg.htm");

}

?>

