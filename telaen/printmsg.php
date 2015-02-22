<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

if (!isset($folder) || !isset($ix)) {
    die('Expected parameters');
}
$mail_info = $mbox['headers'][$folder][$ix];

$smarty->assign('pageMetas', $pmetas);

$path = $TLN->getPath($mail_info)[0];
if (!file_exists($path)) {
    die('File not found');
}
$email = $TLN->readFile($path);

$TLN->displayimages = $TLN->prefs['display_images'];
$TLN->sanitize = ($TLN->config['sanitize_html'] || !$TLN->config['allow_scripts']);

$email = $TLN->parseBody($email);
$body = $email['body'];

//cleanning bad tags to show
if (preg_match('|<[ ]*body.*background[ ]*=[ ]*["\']?([A-Za-z0-9._&?=:/{}%+-]+)["\']?.*>|i', $body, $regs)) {
    $backimg =    " background=\"".$regs[1]."\"";
}
$smarty->assign('smBackImg', $backimg);
if (preg_match('|<[ ]*body[A-Z0-9._&?=:/"\' -]*bgcolor=["\']?([A-Z0-9#]+)["\']?[A-Z0-9._&?=:/"\' -]*>|i', $body, $regs)) {
    $backcolor = " bgcolor=\"".$regs[1]."\"";
}
$smarty->assign('smBackColor', $backcolor);

$body = preg_replace('|<body|i', '<telaen_body_not_alowed', $body);
$body = preg_replace('/a:(link|visited|hover)/i', '.'.$TLN->uniqID(), $body);
$body = preg_replace('|(body)[ ]?\\{|i', '.'.$TLN->uniqID(), $body);

$smarty->assign('smMessageBody', $body);

$ARFrom = $email['from'];
$useremail = $auth['email'];
// from
$name = $ARFrom[0]['name'];
$thismail = $ARFrom[0]['mail'];
$ARFrom[0]['link'] = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
$ARRom[0]['title'] = "$name <$thismail>";

$smarty->assign('smFromList', $ARFrom);

// To
$ARTo = $email['to'];

for ($i = 0;$i<count($ARTo);$i++) {
    $name = $ARTo[$i]['name'];
    $thismail = $ARTo[$i]['mail'];
    $link = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
    $ARTo[$i]['link'] = $link;
    $ARTo[$i]['title'] = "$name <$thismail>";
    $smarty->assign('smTOList', $ARTo);
}

// CC
$ARCC = $email['cc'];
if (count($ARCC) > 0) {
    $smarty->assign('smHaveCC', 1);
    for ($i = 0;$i<count($ARCC);$i++) {
        $name = $ARCC[$i]['name'];
        $thismail = $ARCC[$i]['mail'];
        $link = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
        $ARCC[$i]['link'] = $link;
        $ARCC[$i]['title'] = "$name <$thismail>";
    }
    $smarty->assign('smCCList', $ARCC);
}

$smarty->assign('smCCList', $email['subject']);

$smarty->assign('smSubject', $email['subject']);
$smarty->assign('smDate', $email['date']);

$anexos = $email['attachments'];

$haveattachs = (count($anexos) > 0) ? 1 : 0;
$smarty->assign('smHaveAttachments', $haveattachs);

if (count($anexos) > 0) {
    for ($i = 0;$i<count($anexos);$i++) {
        $safefname = rawurlencode($anexos[$i]['name']);
        $link1 = "download.php?folder=$folder&ix=$ix&mnum=$mnum&bound=".base64_encode($anexos[$i]['boundary']).'&part='.$anexos[$i]['part']."";
        $link2 = "$link1&down=1";
        $anexos[$i]['normlink'] = "$link1&fname=$safefname";
        $anexos[$i]['downlink'] = "$link2&fname=$safefname";
        $anexos[$i]['size'] = Telaen::bytes2bkmg($anexos[$i]['size']);
        $anexos[$i]['type'] = trim($anexos[$i]['content-type']);
    }
    $smarty->assign('smAttachList', $anexos);
}

unset($TLN);

$smarty->display("$themez/print-message.tpl");
