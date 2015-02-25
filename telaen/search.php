<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

extract(Telaen::pullFromArray($_POST, ['srcFrom', 'srcSubject', 'srcBody'], 'str'));

$smarty->assign('pageMetas', $pmetas);

$jsquota = ($exceeded) ? 'true' : 'false';

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type='text/javascript'>
//<![CDATA[
no_quota = $jsquota;
quota_msg = '".preg_replace("/'/", "\\'", $lang['quota_exceeded'])."';
function readmsg(ix,folder) {
	if(no_quota)
		alert(quota_msg)
	else
		location = 'readmsg.php?folder='+folder+'&ix='+ix+'';
}
//]]>
</script>
";

$smarty->assign('smJS', $jssource);

$smarty->assign('smInputFrom', $srcFrom);
$smarty->assign('smInputSubject', $srcSubject);
$smarty->assign('smInputBody', $srcBody);

if ($srcFrom != "" || $srcSubject != "" || $srcBody != "") {
    $boxes = $mbox['folders'];

    for ($n = 0;$n<count($boxes);$n++) {
        $entry = $boxes[$n]['name'];
        if (!is_array($mbox['headers'][$entry])) {
            if (!$TLN->mailConnected()) {
                if (!$TLN->mailConnect()) $TLN->redirectAndExit('index.php?err=1', true);
                if (!$TLN->mailAuth()) $TLN->redirectAndExit('index.php?err=0');
            }
            $retbox = $TLN->mailListMsgs($entry);
            $mbox['headers'][$entry] = $retbox[0];
            $thisbox = $retbox[0];
        } else {
            $thisbox = $mbox['headers'][$entry];
        }
    }
    if ($TLN->mailConnected()) {
        $TLN->mailDisconnect();
        $UserMbox->Save($mbox);
    }

    $boxlist = $mbox['headers'];

    function build_regex($strSearch)
    {
        $strSearch = trim($strSearch);
        if ($strSearch != "") {
            $strSearch = quotemeta($strSearch);
            $arSearch = explode(' ', $strSearch);
            $strSearch = join(')(', $arSearch);
         }

        return '|('.$strSearch.')|i';
    }

    if (trim($srcBody) != "") {
        $get_body = 1;
    }
    $search_results = array();
    $start = $TLN->getMicrotime();
    $TLN->config['allow_html'] = false;

    if ($srcFrom != "") {
        $srcFrom = build_regex($srcFrom);
    }
    if ($srcSubject != "") {
        $srcSubject = build_regex($srcSubject);
    }
    if ($srcBody != "") {
        $srcBody = build_regex($srcBody);
    }

    while (list($current_folder, $messages) = each($boxlist)) {

        for ($z = 0;$z<count($messages);$z++) {
            $email = $messages[$z];
            $localname = $TLN->getPath($email)[0];

            if ($get_body && file_exists($localname)) {
                $thisfile = $TLN->readFile($localname);
                $email = $TLN->parseBody($thisfile);
                unset($thisfile);
            }

            $found = false;

            if ($srcFrom != "") {
                $from = $email['from'];
                $srcString = $from[0]['name'].' '.$from[0]['mail'];
                if (preg_match($srcFrom, $srcString)) {
                    $found = true;
                }
            }

            if ($srcSubject != "" && !$found) {
                $srcString = $email['subject'];
                if (preg_match($srcSubject, $srcString)) {
                    $found = true;
                }
            }

            if ($srcBody != "" && !$found) {
                $srcString = strip_tags($email['body']);
                if (preg_match($srcBody, $srcString)) {
                    $found = true;
                }
            }

            if ($found) {
                $messages[$z]['ix'] = $z;
                $headers[] = $messages[$z];
            }
        }
    }

    $messagelist = array();

    for ($i = 0;$i<count($headers);$i++) {
        $read = (stristr($headers[$i]['flags'], $TLN->flags['seen'])) ? 'true' : 'false';

        $readlink = "javascript:readmsg(".$headers[$i]['ix'].",$read,'".urlencode($headers[$i]['folder'])."')";
        $composelink = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['from'][0]['name']).'&mailto='.htmlspecialchars($headers[$i]['from'][0]['mail'])."";
        $composelinksent = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['to'][0]['name']).'&mailto='.htmlspecialchars($headers[$i]['to'][0]['name'])."";
        $folderlink = 'messages.php?folder='.urlencode($headers[$i]['folder'])."";

        $from = $headers[$i]['from'][0]['name'];
        $to = $headers[$i]['to'][0]['name'];
        $subject = $headers[$i]['subject'];
        if (!stristr($headers[$i]['flags'], $TLN->flags['seen'])) {
            $msg_img = './images/msg_unread.gif';
        } elseif (stristr($headers[$i]['flags'], $TLN->flags['answered'])) {
            $msg_img = './images/msg_answered.gif';
        } else {
            $msg_img = './images/msg_read.gif';
        }
        $prior = $headers[$i]['priority'];
        if ($prior == 1 || $prior == 2) {
            $img_prior = "&nbsp;<img src=\"./images/prior_high.gif\" width=5 height=11 border=0 alt=\"\">";
        } elseif ($prior == 4 || $prior == 5) {
            $img_prior = "&nbsp;<img src=\"./images/prior_low.gif\" width=5 height=11 border=0 alt=\"\">";
        } else {
            $img_prior = "";
        }
        $msg_img = "&nbsp;<img src=\"$msg_img\" width=14 height=14 border=0 alt=\"\">";
        $checkbox = "<input type=\"checkbox\" name=\"msg_$i\" value=1>";
        $attachimg = ($headers[$i]['attach']) ? "&nbsp;<img src=images/attach.gif border=0>" : "";
        $date = $headers[$i]['date'];
        $size = ceil($headers[$i]['size']/1024);
        $index = count($messagelist);
        $boxname = extended_name($headers[$i]['folder']);
        $messagelist[$index]['read'] = $read;
        $messagelist[$index]['readlink'] = $readlink;
        $messagelist[$index]['composelink'] = $composelink;
        $messagelist[$index]['composelinksent'] = $composelinksent;
        $messagelist[$index]['folderlink'] = $folderlink;
        $messagelist[$index]['from'] = $from;
        $messagelist[$index]['to'] = $to;
        $messagelist[$index]['subject'] = $subject;
        $messagelist[$index]['date'] = $date;
        $messagelist[$index]['statusimg'] = $msg_img;
        $messagelist[$index]['checkbox'] = $checkbox;
        $messagelist[$index]['attachimg'] = $attachimg;
        $messagelist[$index]['priorimg'] = $img_prior;
        $messagelist[$index]['size'] = $size;
        $messagelist[$index]['folder'] = $headers[$i]['folder'];
        $messagelist[$index]['foldername'] = $boxname;
    }
    $smarty->assign('smMessageList', $messagelist);
    unset($headers);
    $smarty->assign('smDoSearch', 1);
} else {
    $smarty->assign('smDoSearch', 0);
}
$smarty->display("$themez/search.tpl");
