<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

//defines
require './inc/init.php';
/* @var $TLN Telaen */

if (!isset($ix) || !isset($pag)) {
    $TLN->redirect_and_exit('index.php?err=3', true);
}

$mysess = $TLN->tdb->get_headers($folder);
$mail_info = $mysess[$ix];

$is_attached = false;
$arAttachment = array();

if (!$TLN->mail_connect()) $TLN->redirect_and_exit('index.php?err=1', true);
if (!$TLN->mail_auth()) $TLN->redirect_and_exit('index.php?err=0');

if (!($result = $TLN->mail_retr_msg($mail_info, 1))) {
    $TLN->redirect_and_exit('messages.php?err=2&folder='.urlencode($folder)."&pag=$pag&refr=true");
}
if (!$TLN->mail_set_flag($mail_info, '\\SEEN', '+')) {
    $TLN->trigger_error('Could not set SEEN flag', I_AM_TELAEN);
}
$TLN->mail_disconnect();

// metas assigned to smarty
$smarty->assign('pageMetas', $pmetas);

$TLN->displayimages = $TLN->prefs['display_images'];
$TLN->sanitize = ($TLN->config['sanitize_html'] || !$TLN->config['allow_scripts']);

$email = $TLN->Decode($result);
if ($ix > 0) {
    $umHavePrevious = 1;
    $umPreviousSubject = $mysess[($ix-1)]['subject'];
    $umPreviousLink = 'readmsg.php?folder='.urlencode($folder)."&pag=$pag&ix=".($ix-1)."";

    $smarty->assign('umHavePrevious', $umHavePrevious);
    $smarty->assign('umPreviousSubject', $umPreviousSubject);
    $smarty->assign('umPreviousLink', $umPreviousLink);
}

if ($ix < (count($mysess)-1)) {
    $umHaveNext = 1;
    $umNextSubject = $mysess[($ix+1)]['subject'];
    $umNextLink = 'readmsg.php?folder='.urlencode($folder)."&pag=$pag&ix=".($ix+1)."";
    $smarty->assign('umHaveNext', $umHaveNext);
    $smarty->assign('umNextSubject', $umNextSubject);
    $smarty->assign('umNextLink', $umNextLink);
}

// message download link
$smarty->assign('downloadLink', 'download.php?folder='.urlencode($folder).'&ix='.$ix);

$body =    $email['body'];

$redir_path = 'redir.php';    // why not just relative?? Now is relative (due to problems on https servers)!

$body = preg_replace('|target=["]?[a-zA-Z_]+["]?|i', "target=\"blank\"", $body);
$body = preg_replace('|href="http([s]?)://|i', "target=\"_blank\" href=\"$redir_path?http$1://", $body);
$body = preg_replace('|href="mailto:|i', "target=\"_top\" href=\"newmsg.php?to=", $body);

$auth['currentbody'] = $body;
$body = "<iframe src=\"show_body.php?folder=".htmlspecialchars($folder)."&ix=$ix\" width=\"100%\" height=\"400\" frameborder=\"0\"></iframe>";

$smarty->assign('umMessageBody', $body);

// look if the msg needs a receipt
if ($email['receipt-to']) {
    $smarty->assign('receiptRequired', true);
}

$ARFrom = $email['from'];
$useremail = $auth['email'];

// from
$name = $ARFrom[0]['name'];
$thismail = $ARFrom[0]['mail'];
$ARFrom[0]['link'] = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
$ARFrom[0]['title'] = "$name <$thismail>";

$smarty->assign('umFromList', $ARFrom);

// To
$ARTo = $email['to'];

for ($i = 0;$i<count($ARTo);$i++) {
    $name = $ARTo[$i]['name'];
    $thismail = $ARTo[$i]['mail'];
    $link = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
    $ARTo[$i]['link'] = $link;
    $ARTo[$i]['title'] = "$name <$thismail>";
    $smarty->assign('umTOList', $ARTo);
}

// CC
$ARCC = $email['cc'];
if (count($ARCC) > 0) {
    $smarty->assign('umHaveCC', 1);
    for ($i = 0;$i<count($ARCC);$i++) {
        $name = $ARCC[$i]['name'];
        $thismail = $ARCC[$i]['mail'];
        $link = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
        $ARCC[$i]['link'] = $link;
        $ARCC[$i]['title'] = "$name <$thismail>";
    }
    $smarty->assign('umCCList', $ARCC);
}

$smarty->assign('umPageTitle', $email['subject']);

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function deletemsg() {
	if(confirm('".preg_replace("/'/", "\\'", $lang['confirm_delete'])."'))
		with(document.move) { decision.value = 'delete'; submit(); }
}
function reply() { document.msg.submit(); }
function movemsg() { document.move.submit(); }
function headers() { mywin = window.open('headers.php?folder=".urlencode($folder)."&ix=$ix','Headers','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes,resizable=yes'); }
function catch_addresses() { window.open('catch.php?folder=".urlencode($folder)."&ix=$ix','Catch','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }
function block_addresses() { window.open('block_address.php?folder=".urlencode($folder)."&ix=$ix','Block','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }

function replyall() { with(document.msg) { rtype.value = 'replyall'; submit(); } }
function forward() { with(document.msg) { rtype.value = 'forward'; submit(); } }
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function goback() { location = 'messages.php?folder=".urlencode($folder)."&pag=$pag'; }
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function printit() { window.open('printmsg.php?folder=".urlencode($folder)."&ix=$ix','PrintView','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openmessage(attach) { window.open('readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix=$ix&attachment='+attach,'','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openwin(targetUrl) { window.open(targetUrl); }



//]]>
</script>
<script type=\"text/javascript\" src=\"./inc/js/mini_Ajax.js\"></script>
<script type=\"text/javascript\">
//<![CDATA[
function sendReceipt(subj, msg) {
	new Ajax.Request('ajax.php', {
		method: 'post',
		parameters: {action: 'sendReceipt', recipient: '".$email["receipt-to"]."', receipt_subj: subj, receipt_msg: msg}
	});
}

//]]>
</script>
";

$umDeleteForm = "<input type=\"hidden\" name=\"decision\" value=\"move\" />
<input type=\"hidden\" name=\"folder\" value=\"".htmlspecialchars($folder)."\" />
<input type=\"hidden\" name=\"pag\" value=\"$pag\" />
<input type=\"hidden\" name=\"start_pos\" value=\"$ix\" />
<input type=\"hidden\" name=\"end_pos\" value=\"".($ix+1)."\" />
<input type=\"hidden\" name=\"msg_$ix\" value=\"X\" />
<input type=\"hidden\" name=\"back\" value=\"true\" />";

$umReplyForm = "<form name=\"msg\" action=\"newmsg.php\" method=\"post\">
	<input type=\"hidden\" name=\"rtype\" value=\"reply\" />
	<input type=\"hidden\" name=\"folder\" value=\"".htmlspecialchars($folder)."\" />
	<input type=\"hidden\" name=\"ix\" value=\"$ix\" />
</form>
";

$smarty->assign('umDeleteForm', $umDeleteForm);
$smarty->assign('umReplyForm', $umReplyForm);
$smarty->assign('umJS', $jssource);

$smarty->assign('umSubject', $email['subject']);
$smarty->assign('umDate', $email['date']);

$anexos = $email['attachments'];
$haveattachs = (count($anexos) > 0) ? 1 : 0;

if (count($anexos) > 0) {
    $root = &$mail_info['attachments'];

    foreach ($arAttachment as $item) {
        if (is_numeric($item)) {
            $root = &$root[$item]['attachments'];
        }
    }

    $root = $email['attachments'];
    $mbox['headers'][$folder][$ix] = $mail_info;

    $nIndex = count($arAttachment);
    $attachAr = array();

    for ($i = 0;$i<count($anexos);$i++) {
        $arAttachment[$nIndex] = $i;
        $link1 = "download.php?folder=$folder&ix=$ix&attach=".join(',', $arAttachment)."";
        $link2 = "$link1&down=1";

        if (!$anexos[$i]['temp']) {
            if ($anexos[$i]['content-type'] == 'message/rfc822') {
                $anexos[$i]['normlink'] = "<a href=\"javascript:openmessage('".join(",", $arAttachment)."')\">";
            } else {
                $anexos[$i]['normlink'] = "<a href=\"$link1\" target=\"_new\">";
            }

            $anexos[$i]['downlink'] = "<a href=\"$link2\">";
            $anexos[$i]['size'] = ceil($anexos[$i]['size']/1024);
            $anexos[$i]['type'] = $anexos[$i]['content-type'];
            $attachAr[] = $anexos[$i];
        }
    }
    $smarty->assign('umHaveAttachments', (count($attachAr) > 0));
    $smarty->assign('umAttachList', $attachAr);
}

$UserMbox->Save($mbox);

$avalfolders = array();
foreach (scandir($TLN->userfolder) as $entry) {
    if (is_dir($TLN->userfolder.$entry)
        && $entry != '..'
        && $entry != '.'
        && substr($entry, 0, 1) != '_'
        && $entry != $folder
        && ($TLN->mail_protocol == IMAP || ($entry != 'inbox' && $entry != 'spam'))) {
        $entry = $TLN->fix_prefix($entry, 0);
        $display = extended_name($entry);
        $avalfolders[] = array('path' => $entry, 'display' => $display);
    }
}
$smarty->assign('umAvalFolders', $avalfolders);
unset($TLN);

if ($is_attached) {
    $smarty->display("$selected_theme/readmsg_popup.tpl");
} else {
    $smarty->display("$selected_theme/readmsg.tpl");
}
