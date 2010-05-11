<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

/**
 * This file provides a support for ajax calls
 * All parameters must be sended via POST and the 'action' is mandatory
 */
session_name('telaen');
session_start();

require("./inc/lib.php");
require("./inc/version.php");

// common session check, exit if no auth
$SS = new Session();
$sess = $SS->Load();

if(!$sess["auth"]) {
	echo "error: your session seems expired";
	die();
}

// cheking for main param
if(isset($_POST['action'])) {
	
	// config
	require("./inc/config/config.php");

	$prefs = load_prefs();
		
	$action = $_POST['action'];
	switch($action) {
	
		// send a read receipt
		case "sendReceipt":
			if(!isset($_POST['recipient']))
				break;

			$recipient = $_POST['recipient'];			
			$receiptSubj = $_POST['receipt_subj'];
			$receiptMsg = $_POST['receipt_msg'];
			
			require("./inc/class.telaen.php");
			$UM = new Telaen();

			require("./inc/class.phpmailer.php");
				require("./inc/class.phpmailer_extra.php");

			// init mailer
				$mail = new PHPMailer_extra;
				$mail->PluginDir = "./inc/";
			$mail->SetLanguage("en","langs/");
			$mail->CharSet = $default_char_set;
			$mail->Hostname = getenv("SERVER_NAME");
			$mail->Host = $smtp_server;
			$mail->WordWrap = 76;
			$mail->Priority = 3;
			$mail->SMTPDebug = false;
			$mail->Mailer = $mailer_type;
			if ($phpmailer_sendmail != "") {
				$mail->Sendmail = $phpmailer_sendmail;
			}
			if ($phpmailer_timeout != 0) {
				$mail->Timeout = $phpmailer_timeout;
				}

			// for password authenticated servers
			$mail->SMTPAuth = $use_password_for_smtp;
			$mail->Username = $sess["user"];
			$mail->Password = $sess["pass"];

			// build the email
			$mail->From = ($allow_modified_from && !empty($prefs["reply-to"]))?$prefs["reply-to"]:$sess["email"];
			$mail->FromName = $UM->mime_encode_headers($prefs["real-name"]);
			$mail->AddReplyTo($prefs["reply-to"], $UM->mime_encode_headers($prefs["real-name"]));			
			$mail->AddAddress($recipient);
			
			$mail->Subject = $UM->mime_encode_headers(stripslashes($receiptSubj));
			$mail->Body = stripslashes($receiptText);

			// send
			if($mail->Send() === true) {
				echo "success: receipt sent";
			}			
			else {
				echo "error: " . $mail->ErrorInfo;
			}

			break;

		// just refresh the session timeout
		case "pingSession":
			// refresh time
				$sess["start"] = time();
				// save
				$SS->Save($sess);

				echo "success: session refreshed";
		
			break;

		// Regen the calendar
		case "replaceCal":
			$newcal = new MyMonth($_POST['cal_month'], $_POST['cal_year']);
			$newcal->showMonth();
			break;
		default:
			echo "error: this action does not exist";
	}

} else {
	// no action, no fun
	echo "error: no action specified";
}

?>
