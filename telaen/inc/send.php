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

$ARTo = $TLN->getNames(stripslashes($to));
$ARCc = $TLN->getNames(stripslashes($cc));
$ARBcc = $TLN->getNames(stripslashes($bcc));

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
$msg = $TLN->tdb->getMessage($uidl, $folder);
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
    if ($is_html != 'false') {
        $mail->isHTML(true);
        if (!empty($TLN->config['footer'])) {
            $body .= preg_replace('|(\r?\n)|', "<br>$1", $TLN->config['footer']);
        }
        // add html head and foot
        $body = $htmlHead.$body.$htmlFoot;
        $mail->AltBody = "\nThis Email is formatted in HTML. Your Email client appears to be incompatible.\n";
    } elseif (!empty($TLN->config['footer'])) {
        $body .= $TLN->config['footer'];
    }

    $mail->CharSet = $TLN->ucharset;
    $mail->Hostname = $TLN->getServerName();
    $mail->From = ($TLN->config['allow_modified_from'] && !empty($TLN->prefs['reply-to'])) ? $TLN->prefs['reply-to'] : $auth['email'];
    $mail->FromName = $mail->encodeHeader($TLN->prefs['real-name']);
    $mail->AddReplyTo($TLN->prefs['reply-to'], $TLN->mimeEncodeHeaders($TLN->prefs['real-name']));

    $mail->Host = $TLN->config['smtp_server'];
    $mail->WordWrap = 76;
    $mail->Priority = $priority;

    if ($TLN->config['smtp_debug']) {
        $mail->SMTPDebug = true;
    }

    // add an header for keep a track of client IP
    $mail->AddCustomHeader('X-Originating-IP: '.getenv('REMOTE_ADDR'));
    // Now keep threading info intact (or create as needed)
    $mail->MessageID = "<{$TLN->uniqID('tln.')}@{$mail->Hostname}>";
    $mid = '<'.$msg['message-id'].'>';
    if (!empty($msg) && $mid != '<>') {
        if ($msg['headers']['references'] != '') {
            $mail->AddCustomHeader('References: '.$msg['headers']['references'].$mid);
        } elseif ($msg['headers']['in-reply-to'] != '') {
            $mail->AddCustomHeader('References: '.$msg['headers']['in-reply-to'].$mid);
        }
        $mail->AddCustomHeader('In-Reply-To: '.$mid);
    }

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
                $mail->AddAddress($email, $TLN->mimeEncodeHeaders($name));
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
                $mail->AddCC($email, $TLN->mimeEncodeHeaders($name));
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
                $mail->AddBCC($email, $TLN->mimeEncodeHeaders($name));
            } else {
                $mail->AddBCC($email);
            }
        }
    }

        $attachs = $TLN->tdb->getAttachments(['uidl' => '_upload', 'folder' => '_upload']);
        for ($i = 0;$i<count($attachs);$i++) {
            $path = $TLN->getPathName($attachs[$i])[0];
            if (file_exists($path)) {
                $mail->AddAttachment($path, $attachs[$i]['name'], 'base64', $attachs[$i]['type']);
            }
        }

    $mail->Subject = $TLN->mimeEncodeHeaders(stripslashes($subject));
    $mail->Body = stripslashes($body);
    $mail->Mailer = $TLN->config['mailer_type'];

    if (($mail->Send()) === false) {
        $smarty->assign('smMailSent', false);
        $smarty->assign('smErrorMessage', $mail->ErrorInfo);
    } else {
        $smarty->assign('smMailSent', true);

        if ($TLN->prefs['save_to_sent']) {
            if (!$TLN->mailConnect()) $TLN->redirectAndExit('index.php?err=1', true);
            if (!$TLN->mailAuth(false)) $TLN->redirectAndExit('index.php?err=0');
            $TLN->mailSaveMessage('sent', $mail->getSentMIMEMessage(), '\\SEEN');
            $TLN->mailDisconnect();
        }
    }
} else {
    die("<script language='javascript' type='text/javascript'>location = 'index.php?err=3';</script>");
}

eval('$jssource = "' . $commonJS . '";');
$smarty->assign('smJS', $jssource);

$smarty->display("$themez/newmsg-result.tpl");
