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

$msgs = $TLN->tdb->getMessages($folder);
if (!isset($ix) && !isset($uidl)) {
    $TLN->redirectAndExit('index.php?err=3', true);
} elseif (!isset($uidl)) {
    $uidl = $msgs[$ix]['uidl'];
}
$msg = $TLN->tdb->getMessage($uidl, $folder);
$ix = $msg['idx'];

$is_attached = false;
$arAttachment = array();

if (!($TLN->mailRetrMsg($msg, false))) {
    $TLN->redirectAndExit('messages.php?err=2&folder='.urlencode($folder)."&refr=true");
}

if ($msg['unread']) {
    if (!$TLN->mailSetFlag($msg, $TLN->flags['seen'], '+')) {
        $TLN->triggerError('Could not set SEEN flag', I_AM_TELAEN, __LINE__);
    }
    $msg['unread'] = false;
    $TLN->tdb->updateFolderField($folder, 'unread', $folders[$folder]['unread'] - 1);
    $TLN->tdb->doMessage($msg, ['unread']);
}

$TLN->parseBody($msg);
$TLN->tdb->syncMessages();

if ($ix > 0) {
    $smHavePrevious = 1;
    $smPreviousSubject = $msgs[($ix-1)]['subject'];
    $smPreviousLink = 'readmsg.php?folder='.urlencode($folder)."&ix=".($ix-1)."";

    $smarty->assign('smHavePrevious', $smHavePrevious);
    $smarty->assign('smPreviousSubject', $smPreviousSubject);
    $smarty->assign('smPreviousLink', $smPreviousLink);
}

if ($ix < (count($msgs)-1)) {
    $smHaveNext = 1;
    $smNextSubject = $msgs[($ix+1)]['subject'];
    $smNextLink = 'readmsg.php?folder='.urlencode($folder)."&ix=".($ix+1)."";
    $smarty->assign('smHaveNext', $smHaveNext);
    $smarty->assign('smNextSubject', $smNextSubject);
    $smarty->assign('smNextLink', $smNextLink);
}

// message download JS and links
$smarty->assign('pageMetas', $pmetas);
$smarty->assign('downloadLink', 'download.php?folder='.urlencode($folder).'&uidl='.$uidl);
$redir_path = 'redir.php';    // why not just relative?? Now is relative (due to problems on https servers)!

$body = "<iframe src='show_body.php?folder=".urlencode($folder)."&uidl=$uidl' width='100%' height='400' frameborder='0'></iframe>";
$smarty->assign('smMessageBody', $body);

// look if the msg needs a receipt
if ($email['receipt-to']) {
    $smarty->assign('receiptRequired', true);
}

$ARFrom = $TLN->getNames($msg['headers']['from']);
$useremail = $auth['email'];

// from
$name = $ARFrom[0]['name'];
$thismail = $ARFrom[0]['mail'];
$ARFrom[0]['link'] = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
$ARFrom[0]['title'] = "$name <$thismail>";

$smarty->assign('smFromList', $ARFrom);

// To
$ARTo = $TLN->getNames($msg['headers']['to']);

for ($i = 0;$i<count($ARTo);$i++) {
    $name = $ARTo[$i]['name'];
    $thismail = $ARTo[$i]['mail'];
    $link = 'newmsg.php?nameto='.urlencode($name)."&mailto=$thismail";
    $ARTo[$i]['link'] = $link;
    $ARTo[$i]['title'] = "$name <$thismail>";
    $smarty->assign('smTOList', $ARTo);
}

// CC
$ARCC = $msg['headers']['cc'];
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

$smarty->assign('smCCList', $TLN->convertCharset($msg['subject'], $TLN->ucharset));

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type='text/javascript'>
//<![CDATA[
function deletemsg() {
	if(confirm('".preg_replace("/'/", "\\'", $lang['confirm_delete'])."'))
		with(document.move) { decision.value = 'delete'; submit(); }
}
function reply() { document.msg.submit(); }
function movemsg() { document.move.submit(); }
function headers() { mywin = window.open('headers.php?folder=".urlencode($folder)."&uidl=$uidl','Headers','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes,resizable=yes'); }
function catch_addresses() { window.open('catch.php?folder=".urlencode($folder)."&uidl=$uidl','Catch','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }
function block_addresses() { window.open('block_address.php?folder=".urlencode($folder)."&uidl=$uidl','Block','width=550, top=100, left=100, height=320,directories=no,toolbar=no,status=no,scrollbars=yes'); }

function replyall() { with(document.msg) { rtype.value = 'replyall'; submit(); } }
function forward() { with(document.msg) { rtype.value = 'forward'; submit(); } }
function goback() { location = 'messages.php?folder=".urlencode($folder)."&pag=$pag'; }
function printit() { window.open('printmsg.php?folder=".urlencode($folder)."&uidl={$msg['uidl']}','PrintView','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openmessage(attach) { window.open('readmsg.php?folder=".urlencode($folder)."&uidl=".$msg['uidl']."&name='+attach,'','resizable=1,top=10,left=10,width=700,height=500,scrollbars=1,status=0'); }
function openwin(targetUrl) { window.open(targetUrl); }



//]]>
</script>
<script type='text/javascript'>
//<![CDATA[
function sendReceipt(subj, msg) {
	$.ajax({
	    url: 'ajax.php',
		method: 'POST',
		data: {action: 'sendReceipt', recipient: '".$msg['headers']['x-receipt-to']."', receipt_subj: subj, receipt_msg: msg}
	});
}
//]]>
</script>
";

$smDeleteForm = "<input type='hidden' name='decision' value='move' />
<input type='hidden' name='folder' value='".urlencode($folder)."' />
<input type='hidden' name='pag' value='$pag' />
<input type='hidden' name='start_pos' value='$ix' />
<input type='hidden' name='end_pos' value='".($ix+1)."' />
<input type='hidden' name='msg_$ix' value='X' />
<input type='hidden' name='back' value='true' />";

$smReplyForm = "<form name='msg' action='newmsg.php' method='post'>
	<input type='hidden' name='rtype' value='reply' />
	<input type='hidden' name='folder' value='".urlencode($folder)."' />
	<input type='hidden' name='uidl' value='{$msg['uidl']}' />
</form>
";

$smarty->assign('smDeleteForm', $smDeleteForm);
$smarty->assign('smReplyForm', $smReplyForm);
$smarty->assign('smJS', $jssource);

$smarty->assign('smSubject', $msg['subject']);
$smarty->assign('smDate', $msg['date']);

$anexos = $TLN->tdb->getAttachments($msg);
$haveattachs = count($anexos);

if ($haveattachs) {
    $attachAr = [];
    for ($i = 0; $i < $haveattachs; $i++) {
        $link1 = "download.php?folder=".urlencode($folder)."&uidl={$msg['uidl']}&name=".urlencode($anexos[$i]['name'])."";
        $link2 = "$link1&down=1";

        if ($anexos[$i]['disposition'] != 'inline') {
            if ($attachAr[$i]['content-type'] == 'message/rfc822') {
                $attachAr[$i]['normlink'] = "<a href='javascript:openmessage('".urlencode($anexos[$i]['name'])."')'>";
            } else {
                $attachAr[$i]['normlink'] = "<a href='$link1' target='_new'>";
            }

            $attachAr[$i]['downlink'] = "<a href='$link2'>";
            $attachAr[$i]['size'] = $TLN->bytes2bkmg($anexos[$i]['size']);
            $attachAr[$i]['type'] = $anexos[$i]['type'].'/'.$anexos[$i]['subtype'];
        }
    }
    $smarty->assign('smHaveAttachments', $haveattachs);
    $smarty->assign('smAttachList', $attachAr);
}

//$AuthSession->Save($auth);
//$TLN->tdb->syncMessages();

$avalfolders = array();
foreach ($folders as $entry => $f) {
    $entry = $TLN->fixPrefix($entry, 0);
    $display = extended_name($entry);
    $avalfolders[] = array('path' => $entry, 'display' => $display);
}
$smarty->assign('smAvalFolders', $avalfolders);
unset($TLN);

if ($is_attached) {
    $smarty->display("$themez/readmsg_popup.tpl");
} else {
    $smarty->display("$themez/readmsg.tpl");
}
