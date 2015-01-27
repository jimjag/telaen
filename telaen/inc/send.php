<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

defined('I_AM_TELAEN') or die('Direct access not permitted');

$mail = new PHPMailer();

if ($TLN->config['phpmailer_sendmail'] != "") {
    $mail->Sendmail = $TLN->config['phpmailer_sendmail'];
}
if ($TLN->config['phpmailer_timeout'] != 0) {
    $mail->Timeout = $TLN->config['phpmailer_timeout'];
}

$ARTo = $TLN->get_names(stripslashes($to));
$ARCc = $TLN->get_names(stripslashes($cc));
$ARBcc = $TLN->get_names(stripslashes($bcc));

// html head and foot to add, the editor can do it, but causes some problems with sign and footer
$htmlHead = "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head><meta http-equiv='Content-Type' content='text/html; charset={$lang['default_char_set']}'></head>
<body>
";

$htmlFoot = "
</body>
</html>";

// build the email
if ((count($ARTo)+count($ARCc)+count($ARBcc)) > 0) {
    // set lang for error messages, english for now
    $mail->SetLanguage('en', 'inc/language/');

    // for password authenticated servers
    $mail->SMTPAuth = $TLN->config['use_password_for_smtp'];

    // use user data or static data for smtp auth
    if ($TLN->config['smtp_static_auth']) {
        $mail->Username = $TLN->config['smtp_static_user'];
        $mail->Password = $TLN->config['smtp_static_password'];
    } else {
        $mail->Username = $auth['user'];
        $mail->Password = $auth['pass'];
    }

    // if using the advanced editor
    if ($is_html == 'true') {
        $mail->IsHTML(1);
        if (!empty($TLN->config['footer'])) {
            $body .= preg_replace('|(\r?\n)|', "<br>$1", $TLN->config['footer']);
        }
        // add html head and foot
        $body = $htmlHead.$body.$htmlFoot;
        $mail->AltBody = "\nThis Email is formatted in HTML. Your Email client appears to be incompatible.\n";
    } elseif (!empty($TLN->config['footer'])) {
        $body .= $TLN->config['footer'];
    }

    $mail->CharSet = $TLN->charset;
    $mail->Hostname = getenv('SERVER_NAME');
    $mail->From = ($TLN->config['allow_modified_from'] && !empty($TLN->prefs['reply-to'])) ? $TLN->prefs['reply-to'] : $auth['email'];
    $mail->FromName = $mail->encodeHeader($TLN->prefs['real-name']);
    $mail->AddReplyTo($TLN->prefs['reply-to'], $TLN->mime_encode_headers($TLN->prefs['real-name']));

    $mail->Host = $TLN->config['smtp_server'];
    $mail->WordWrap = 76;
    $mail->Priority = $priority;

    if ($TLN->config['smtp_debug']) {
        $mail->SMTPDebug = true;
    }

    // add an header for keep a track of client IP
    $mail->AddCustomHeader('X-Originating-IP: '.getenv('REMOTE_ADDR'));

    // add return-receipt if required
    if (isset($requireReceipt)) {
        $mail->ConfirmReadingTo =  $TLN->prefs['reply-to'];
    }

    // add recipients
    if (count($ARTo) != 0) {
        for ($i = 0;$i<count($ARTo);$i++) {
            $name = $ARTo[$i]['name'];
            $email = $ARTo[$i]['mail'];
            if ($name != $email) {
                $mail->AddAddress($email, $TLN->mime_encode_headers($name));
            } else {
                $mail->AddAddress($email);
            }
        }
    }

    if (count($ARCc) != 0) {
        for ($i = 0;$i<count($ARCc);$i++) {
            $name = $ARCc[$i]['name'];
            $email = $ARCc[$i]['mail'];
            if ($name != $email) {
                $mail->AddCC($email, $TLN->mime_encode_headers($name));
            } else {
                $mail->AddCC($email);
            }
        }
    }

    if (count($ARBcc) != 0) {
        for ($i = 0;$i<count($ARBcc);$i++) {
            $name = $ARBcc[$i]['name'];
            $email = $ARBcc[$i]['mail'];
            if ($name != $email) {
                $mail->AddBCC($email, $TLN->mime_encode_headers($name));
            } else {
                $mail->AddBCC($email);
            }
        }
    }

    if (isset($mbox['attachments'])) {
        $attachs = $mbox['attachments'];
        for ($i = 0;$i<count($attachs);$i++) {
            if (file_exists($attachs[$i]['localname'])) {
                $mail->AddAttachment($attachs[$i]['localname'], $attachs[$i]['name'], 'base64', $attachs[$i]['type']);
            }
        }
    }

    $mail->Subject = $TLN->mime_encode_headers(stripslashes($subject));
    $mail->Body = stripslashes($body);
    $mail->Mailer = $TLN->config['mailer_type'];

    if (($mail->Send()) === false) {
        $smarty->assign('umMailSent', false);
        $smarty->assign('umErrorMessage', $mail->ErrorInfo);
    } else {
        $smarty->assign('umMailSent', true);

        if (isset($mbox['attachments'])) {
            unset($mbox['attachments']);
            reset($mbox);
            $UserMbox->Save($mbox);
        }

        if ($TLN->prefs['save_to_sent']) {
            if (!$TLN->mail_connect()) $TLN->redirect_and_exit('index.php?err=1', true);
            if (!$TLN->mail_auth(false)) $TLN->redirect_and_exit('index.php?err=0');
            $TLN->mail_save_message('sent', $mail->getSentMIMEMessage(), '\\SEEN');
            unset($mbox['headers']['sent']);
            $TLN->mail_disconnect();
            $UserMbox->Save($mbox);
        }
    }
} else {
    die("<script language='javascript' type='text/javascript'>location = 'index.php?err=3';</script>");
}

eval('$jssource = "' . $commonJS . '";');
$smarty->assign('umJS', $jssource);

$smarty->display("$themez/newmsg-result.tpl");
