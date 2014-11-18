<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';

extract(pull_from_array($_POST, array('srcFrom', 'srcSubject', 'srcBody'), 'str'));

$smarty->assign('pageMetas', $nocache);

$jsquota = ($exceeded) ? 'true' : 'false';

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
no_quota = $jsquota;
quota_msg = '".preg_replace("/'/", "\\'", $quota_exceeded)."';
function readmsg(ix,read,folder) {
	if(no_quota)
		alert(quota_msg)
	else
		location = 'readmsg.php?folder='+folder+'&pag=$pag&ix='+ix+'';
}
//]]>
</script>
";

$smarty->assign('umJS', $jssource);

$smarty->assign('umInputFrom', $srcFrom);
$smarty->assign('umInputSubject', $srcSubject);
$smarty->assign('umInputBody', $srcBody);

if ($srcFrom != "" || $srcSubject != "" || $srcBody != "") {
    $boxes = $mbox['folders'];

    for ($n = 0;$n<count($boxes);$n++) {
        $entry = $boxes[$n]['name'];
        if (!is_array($mbox['headers'][base64_encode(strtolower($entry))])) {
            if (!$TLN->mail_connected()) {
                if (!$TLN->mail_connect()) {
                    redirect_and_exit('index.php?err=1', true);
                }
                if (!$TLN->mail_auth()) {
                    redirect_and_exit('index.php?err=0');
                }
            }
            $retbox = $TLN->mail_list_msgs($entry);
            $mbox['headers'][base64_encode(strtolower($entry))] = $retbox[0];
            $thisbox = $retbox[0];
        } else {
            $thisbox = $mbox['headers'][base64_encode(strtolower($entry))];
        }
    }
    if ($TLN->mail_connected()) {
        $TLN->mail_disconnect();
        $UserMbox->Save($mbox);
    }

    $boxlist = $mbox['headers'];

    function build_regex($strSearch)
    {
        $strSearch = trim($strSearch);
        if ($strSearch != "") {
            $strSearch = quotemeta($strSearch);
            $arSearch = explode(' ', $strSearch);
            unset($strSearch);
            for ($n = 0;$n<count($arSearch);$n++) {
                if ($strSearch) {
                    $strSearch .= "|(".$arSearch[$n].")";
                } else {
                    $strSearch .= "(".$arSearch[$n].")";
                }
            }
        }

        return '/'.$strSearch.'/i';
    }

    if (trim($srcBody) != "") {
        $get_body = 1;
    }
    $search_results = array();
    $start = get_microtime();
    $TLN->use_html = false;

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
        $current_folder = base64_decode($current_folder);

        for ($z = 0;$z<count($messages);$z++) {
            $email = $messages[$z];
            $localname = $email['localname'];

            if ($get_body && file_exists($localname)) {
                $thisfile = $TLN->read_file($localname);
                $email = $TLN->Decode($thisfile);
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
        $read = (stristr($headers[$i]['flags'], '\\SEEN')) ? 'true' : 'false';

        $readlink = "javascript:readmsg(".$headers[$i]['ix'].",$read,'".urlencode($headers[$i]['folder'])."')";
        $composelink = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['from'][0]['name']).'&mailto='.htmlspecialchars($headers[$i]['from'][0]['mail'])."";
        $composelinksent = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['to'][0]['name']).'&mailto='.htmlspecialchars($headers[$i]['to'][0]['name'])."";
        $folderlink = 'messages.php?folder='.urlencode($headers[$i]['folder'])."";

        $from = $headers[$i]['from'][0]['name'];
        $to = $headers[$i]['to'][0]['name'];
        $subject = $headers[$i]['subject'];
        if (!stristr($headers[$i]['flags'], '\\SEEN')) {
            $msg_img = './images/msg_unread.gif';
        } elseif (stristr($headers[$i]['flags'], '\\ANSWERED')) {
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
        switch (strtolower($headers[$i]['folder'])) {
        case 'inbox':
            $boxname = $inbox_extended;
            break;
        case 'sent':
            $boxname = $sent_extended;
            break;
        case 'trash':
            $boxname = $trash_extended;
            break;
        default:
            $boxname = $headers[$i]['folder'];
        }
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
    $smarty->assign('umMessageList', $messagelist);
    unset($headers);
    $smarty->assign('umDoSearch', 1);
} else {
    $smarty->assign('umDoSearch', 0);
}
$smarty->display("$selected_theme/search.htm");
