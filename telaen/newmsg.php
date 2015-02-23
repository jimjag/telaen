<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

// assign metas
$smarty->assign('pageMetas', $pmetas);

extract(Telaen::pullFromArray($_GET, ['nameto', 'mailto'], 'str'));
if (isset($nameto)) {
    $nameto = urldecode($nameto);
}
if (isset($mailto)) {
    $mailto = urldecode($mailto);
}
extract(Telaen::pullFromArray($_POST, ['to', 'cc', 'bcc', 'subject', 'requireReceipt',
        'priority', 'body', 'is_html', 'textmode', 'sig', 'todo', 'rtype', 'uidl', ], 'str'));

if ($todo == 'send') {
    require './inc/send.php';
    exit;
}
// priority
$priority_level = (!isset($priority) || empty($priority)) ? 3 : $priority;
$smarty->assign('smPriority', $priority_level);
// adv editor
if (!isset($textmode)) {
    $textmode = null;
}
$show_advanced = ((!$textmode) && ($TLN->prefs['editor_mode'] != 'text')) ? 1 : 0;
$js_advanced = ($show_advanced) ? 'true' : 'false';

$signature = $TLN->prefs['signature'];
if ($show_advanced) {
    $signature = nl2br($signature);
}

$add_sig = $TLN->prefs['add_signature'];
$addSignature = ($add_sig) ? 1 : 0;
$smarty->assign('smAddSignature', $addSignature);

// return receipt
$rr = ($TLN->prefs['require_receipt']) ? true : false;
$smarty->assign('requireReceipt', $rr);

// hidden inputs ---- Note: these should be moved into template...
$forms = "<input type='hidden' name='todo' value='create' />
<input type='hidden' name='is_html' value='$js_advanced' />
<input type='hidden' name='folder' value='$folder' />
<input type='hidden' name='uidl' value='$uidl' />
<input type='hidden' name='sig' value='".htmlspecialchars($signature)."' />
<input type='hidden' name='textmode' value='$textmode' />
";
$smarty->assign('smForms', $forms);

eval('$jssource = "' . $commonJS . '";');

if ($show_advanced) {
    $jssource .= "
<script type='text/javascript' src='inc/vendor/editors/tinymce/tinymce.gzip.js'></script>
<script type='text/javascript' src='inc/vendor/editors/tinymce/tiny_init.js'></script>
    ";
}

require './inc/js/newmsg_js.php';
$smarty->assign('smJS', $jssource);

$body = ''; // we are crafting from scratch. Ignore any params
$msg = $TLN->tdb->getMessage($uidl, $folder);
if (isset($rtype)) {
    // Hmmm passed a bogus uidl and/or folder val? bail.
    if (empty($msg)) {
        $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&pag={$pag}&refr=true");
    }

    switch ($rtype) {
        case 'forward':
            $TLN->mailSetFlag($msg, $TLN->flags['forwarded'], '+');
            break;
        case 'reply':
        case 'replyall':
            $TLN->mailSetFlag($msg, $TLN->flags['answered'], '+');
            break;
        default:
            $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&pag={$pag}&refr=true");
            break;
    }
    $filename = $TLN->getPath($msg)[0];

    if (!file_exists($filename)) {
        $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&pag={$pag}&refr=true");
    }
    $tmpbody = stream_get_contents($TLN->mailRetrPbody($msg));
    $subject = $msg['subject'];
    $ARReplyTo = $TLN->getNames($msg['headers']['reply-to']);
    $ARFrom = $TLN->getNames($msg['headers']['from']);
    $useremail = $auth['email'];

    // From
    if ($ARReplyTo[0]['mail'] != "") {
        $name = $ARReplyTo[0]['name'];
        $thismail = $ARReplyTo[0]['mail'];
    } else {
        $name = $ARFrom[0]['name'];
        $thismail = $ARFrom[0]['mail'];
    }
    $fromreply = "\"$name\" <$thismail>";

    // These are used for re-add my address in the quoted message, since we remove it from To & CC lists
    // I don't want my adr in To or CC fields when I reply-all, but I want to see it in the quoted message.
    // If someone finds a better way to do this is welcome....
    $myToAdr = "";
    $myCCAdr = "";

    // To
    $ARTo = $TLN->getNames($msg['headers']['to']);
    for ($i = 0;$i<count($ARTo);$i++) {
        $name = $ARTo[$i]['name'];
        $thismail = $ARTo[$i]['mail'];

        // avoid to add my address in the TO list
        if ($thismail != $auth['email'] && $thismail != $TLN->prefs['reply-to']) {
            if (isset($toreply)) {
                $toreply .= ", \"$name\" <$thismail>";
            } else {
                $toreply = "\"$name\" <$thismail>";
            }
        } else {
            $myToAdr = "\"$name\" <$thismail>";
        }
    }

    // CC
    $ARCC = $msg['headers']['cc'];
    for ($i = 0;$i<count($ARCC);$i++) {
        $name = $ARCC[$i]['name'];
        $thismail = $ARCC[$i]['mail'];

        // avoid to add my address in the CC list
        if ($thismail != $auth['email'] && $thismail != $TLN->prefs['reply-to']) {
            if (isset($ccreply)) {
                $ccreply .= ", \"$name\" <$thismail>";
            } else {
                $ccreply = "\"$name\" <$thismail>";
            }
        } else {
            $myCCAdr = "\"$name\" <$thismail>";
        }
    }

    $allreply = $TLN->clearNames($fromreply.', '.$toreply);
    $ccreply = $TLN->clearNames($ccreply);
    $fromreply = $TLN->clearNames($fromreply);

    $msgsubject = $msg['subject'];

    $fromreply_quote = $fromreply;
    $toreply_quote = $toreply;
    $ccreply_quote = $ccreply;
    $msgsubject_quote = $msgsubject;

    // re-add my address in the quoted message, why? look at line #412
    if (!empty($myToAdr)) {
        if (empty($toreply_quote)) {
            $toreply_quote = $myToAdr;
        } else {
            $toreply_quote = $myToAdr.','.$toreply_quote;
        }
    }

    if (!empty($myCCAdr)) {
        if (empty($ccreply_quote)) {
            $ccreply_quote = $myCCAdr;
        } else {
            $ccreply_quote = $myCCAdr.','.$ccreply_quote;
        }
    }

    if ($show_advanced) {
        $fromreply_quote = htmlspecialchars($fromreply_quote);
        $toreply_quote = htmlspecialchars($toreply_quote);
        $ccreply_quote = htmlspecialchars($ccreply_quote);
        $msgsubject_quote = htmlspecialchars($msgsubject_quote);
        $linebreak = '<br>';
    } else {
        $tmpbody = strip_tags($tmpbody);
        $quote_string = '> ';
        $tmpbody = $quote_string.preg_replace('|\n|', "\n$quote_string", $tmpbody);
    }

    $body = "
{$lang['reply_delimiter']}$linebreak
{$lang['reply_from_hea']} ".preg_replace('|(")|', "", $fromreply_quote)."$linebreak
{$lang['reply_to_hea']} ".preg_replace('|(")|', "", $toreply_quote);

    if (!empty($ccreply)) {
        $body .= "$linebreak
{$lang['reply_cc_hea']} ".preg_replace('|(")|', "", $ccreply_quote);
    }

    $body .= "$linebreak
{$lang['reply_subject_hea']} ".$msgsubject_quote."$linebreak
{$lang['reply_date_hea']} ".@strftime($lang['date_format'], $msg['date'])."$linebreak
$linebreak
$tmpbody";

    if ($show_advanced) {
        $body = "
<br>
<blockquote dir='ltr' style='padding-right: 0px; padding-left: 5px; margin-left: 5px; border-left: #000000 2px solid; margin-right: 0px'>
<div style='font: 10pt arial'>
$body
</div>
</blockquote>
<br>
";
    }

    switch ($rtype) {
    case 'reply':
        if (!preg_match("/^{$lang['reply_prefix']}/i", trim($subject))) {
            $subject = "{$lang['reply_prefix']} $subject";
        }
        $to = $fromreply;
        break;
    case 'replyall':
        if (!preg_match("/^{$lang['reply_prefix']}/i", trim($subject))) {
            $subject = "{$lang['reply_prefix']} $subject";
        }
        $to = $allreply;
        $cc = $ccreply;
        break;
    case 'forward':
        if (!preg_match("/^{$lang['forward_prefix']}/i", trim($subject))) {
            $subject = "{$lang['forward_prefix']} $subject";
        }
        break;
    }
}
if ($show_advanced) {
    $body = "<br><br>----<br>$signature<br><br>$body";
} else {
    $body = "\r\n\r\n----\r\n$signature\r\n\r\n$body";
}


$haveSig = empty($signature) ? 0 : 1;
$smarty->assign('smHaveSignature', $haveSig);

$strto = (isset($nameto) && preg_match('|([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_])|i', $mailto)) ?
"<input class='textbox' style='width : 200px;' type='text' size='20' name='to' value='&quot;".htmlspecialchars(stripslashes($nameto))."&quot; <".htmlspecialchars(stripslashes($mailto)).">' />
" : "<input class='textbox' style='width : 200px;' type='text' size='20' name='to' value='".htmlspecialchars(stripslashes($to))."' />";

$strcc = "<input class='textbox' style='width : 200px;' type='text' size='20' name='cc' value='".htmlspecialchars(stripslashes($cc))."' />";
$strbcc = "<input class='textbox' style='width : 200px;' type='text' size='20' name='bcc' value='".htmlspecialchars(stripslashes($bcc))."' />";
$strsubject = "<input class='textbox' style='width : 200px;' type='text' size='20' name='subject' value='".htmlspecialchars(stripslashes($subject))."' />";

/* We use the special _upload/_upload attachments for to-include attachments; clear it */
$TLN->tdb->delAttachments(['uidl' => '_upload', 'folder' => '_upload']);
Telaen::cleanupDir($TLN->userfolder.'_upload/');

/* Now get list of all attachments from this reply-to message */
$attachs = $TLN->tdb->getAttachments($msg);
$num = count($attachs);
$attachlist = [];
for ($i = 0; $i < $num; $i++) {
    $attachlist[$i]['name'] = urlencode($attachs[$i]['name']);
    $attachlist[$i]['size'] = Telaen::bytes2bkmg($attachs[$i]['size']);
    $attachlist[$i]['type'] = $attachs[$i]['type'].'/'.$attachs[$i]['subtype'];
    $attachlist[$i]['link'] = "javascript:delatt('".urlencode($attachs[$i]['name'])."')";
    /* Now prep all attachments as to-include attachments */
    $from = $TLN->getPath($attachs[$i], '_attachments')[0];
    $attachs[$i]['uidl'] = '_upload';
    $attachs[$i]['folder'] = '_upload';
    $attachs[$i]['flat'] = true;
    $attachs[$i]['localname'] = 'u__'.$attachs[$i]['localname'];
    $to = $TLN->getPath($attachs[$i])[0];
    symlink($from, $to);
    $TLN->tdb->addAttachment($attachs[$i]);
}

if (!$show_advanced) {
    $body = stripslashes($body);
}

if (!isset($txtarea)) {
    $txtarea = '';
}
/*
 * Force the below to 0. We do not want to
 * enable the old HTML editor even when using
 * HTML Email.
 */
// $umAdvEdit = ($show_advanced) ? 1 : 0 ;
$advEdit = 0;

$smarty->assign('smBody', $body);
$smarty->assign('smTo', $strto);
$smarty->assign('smCc', $strcc);
$smarty->assign('smBcc', $strbcc);
$smarty->assign('smSubject', $strsubject);
$smarty->assign('smTextEditor', $txtarea);
$smarty->assign('smAdvancedEditor', $advEdit);
$smarty->assign('smAttachList', $attachlist);

$smarty->display("$themez/newmsg.tpl");
