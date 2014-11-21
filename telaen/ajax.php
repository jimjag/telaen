<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

/**
 * This file provides a support for ajax calls
 * All parameters must be sended via POST and the 'action' is mandatory
 */
require './inc/init.php';

// cheking for main param
if (isset($_POST['action'])) {
    $TLN->prefs = load_prefs();

    $action = $_POST['action'];
    switch ($action) {

        // send a read receipt
        case 'sendReceipt':
            if (!isset($_POST['recipient'])) {
                break;
            }

            $recipient = $_POST['recipient'];
            $receiptSubj = $_POST['receipt_subj'];
            $receiptMsg = $_POST['receipt_msg'];

            // init mailer
            $mail = new PHPMailer_extra();
            $mail->PluginDir = './inc/';
            $mail->SetLanguage('en', 'langs/');
            $mail->CharSet = $TLN->charset;
            $mail->Hostname = getenv('SERVER_NAME');
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
            $mail->Username = $auth['user'];
            $mail->Password = $auth['pass'];

            // build the email
            $mail->From = ($allow_modified_from && !empty($TLN->prefs['reply-to'])) ? $TLN->prefs['reply-to'] : $auth['email'];
            $mail->FromName = $mail->encodeHeader($TLN->prefs['real-name']);
            $mail->AddReplyTo($TLN->prefs['reply-to'], $mail->encodeHeader($TLN->prefs['real-name']));
            $mail->AddAddress($recipient);

            $mail->Subject = $mail->encodeHeader(stripslashes($receiptSubj));
            $mail->Body = stripslashes($receiptText);

            // send
            if ($mail->Send() === true) {
                echo 'success: receipt sent';
            } else {
                echo 'error: '.$mail->ErrorInfo;
            }

            break;

        // just refresh the session timeout
        case 'pingSession':
            // refresh time
                $auth['start'] = time();
                // save
                $AuthSession->Save($auth);

                echo 'success: session refreshed';

            break;

        // Regen the calendar
        case 'replaceCal':
            $newcal = new MyMonth($_POST['cal_year'], $_POST['cal_month']);
            $newcal->showMonthAsTable();
            break;
        default:
            echo 'error: this action does not exist';
    }
} else {
    // no action, no fun
    echo 'error: no action specified';
}
