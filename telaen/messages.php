<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

$is_inbox_or_spam = ($folder == 'inbox' || $folder == 'spam');

$smarty->assign('umUser', $f_user);
$refreshurl = 'process.php?folder='.urlencode($folder)."&pag=$pag&refr=true";

$arrow = ($sortorder == 'ASC') ? 'images/arrow_up.gif' : 'images/arrow_down.gif';
$arrow = '&nbsp;<img src="'.$arrow.'" width"8" height="7" border="0" alt="" />';

$attach_arrow = "";
$subject_arrow = "";
$fromname_arrow = "";
$date_arrow = "";
$size_arrow = "";
$toname_arrow = "";

if ($TLN->mail_protocol == IMAP || !$is_inbox_or_spam) {
    switch ($sortby) {
        case 'subject':
            $subject_arrow = $arrow;
            break;
        case 'fromname':
            $fromname_arrow = $arrow;
            break;
        case 'date':
            $date_arrow = $arrow;
            break;
        case 'size':
            $size_arrow = $arrow;
            break;
        case 'toname':
            $toname_arrow = $arrow;
            break;
    }
}
/*
$elapsedtime = (time()-$auth['last-update'])/60;
$timeleft = ($TLN->prefs['refresh_time']-$elapsedtime);

if ($timeleft > 0) {
    $refreshMeta = "	<meta http-equiv=\"Refresh\" content=\"".(ceil($timeleft)*60)."; url=$refreshurl\" />";
} elseif ($TLN->prefs['refresh_time']) {
    $TLN->redirect_and_exit("$refreshurl");
}
*/
// Assign metas to smarty, no more bad echos output
//$smarty->assign('pageMetas', $pmetas."\n".$refreshMeta);

/* load total size */
$totalused = 0;
foreach ($tdb->folders as $key => $val) {
    $totalused += $val['size'];
}

$smarty->assign('umTotalUsed', ceil($totalused/1024));
$quota_enabled = ($quota_limit) ? 1 : 0;
$smarty->assign('umQuotaEnabled', $quota_enabled);
$smarty->assign('umQuotaLimit', Telaen::bytes2bkmg($quota_limit));
$usageGraph = Telaen::get_usage_graphic($totalused, $quota_limit);
$smarty->assign('umUsageGraph', $usageGraph);

$exceeded = (($quota_limit) && ($totalused >= $quota_limit));

// sorting arrays..
$smarty->assign('umAttachArrow', $attach_arrow);
$smarty->assign('umSubjectArrow', $subject_arrow);
$smarty->assign('umFromArrow', $fromname_arrow);
$smarty->assign('umDateArrow', $date_arrow);
$smarty->assign('umSizeArrow', $size_arrow);

$nummsg = count($headers);
if (!isset($pag) || !is_numeric(trim($pag))) {
    $pag = 1;
}

$reg_pp = $TLN->prefs['rpp'];
$start_pos = ($pag-1)*$reg_pp;
$end_pos = (($start_pos+$reg_pp) > $nummsg) ? $nummsg : $start_pos+$reg_pp;

if (($start_pos >= $end_pos) && ($pag != 1)) {
    $TLN->redirect_and_exit("messages.php?folder=$folder&pag=".($pag-1)."");
}

$tdb->get_messages($folder, true, $sortby, $sortorder);
$headers = &$TLN->mail_list_msgs($folder, $start_pos, $end_pos);

$jsquota = ($exceeded) ? 'true' : 'false';

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[

no_quota = $jsquota;
quota_msg = '".preg_replace("|'|", "\\'", $lang['quota_exceeded'])."';
function readmsg(ix,read) {
	if(no_quota)
		alert(quota_msg);
	else
		location = 'readmsg.php?folder=".urlencode($folder)."&pag=$pag&ix='+ix+'';
}
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function refreshlist() { location = 'process.php?refr=true&folder=".urlencode($folder)."&pag=$pag' }
function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function delemsg() { document.form1.submit() }
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function movemsg() {
	if(no_quota)
		alert(quota_msg);
	else {
		with(document.form1) { decision.value = 'move'; submit(); }
	}
}
function markmsg() {
	  with(document.form1) { decision.value = 'mark'; submit(); }
};
function unmarkmsg() {
	  with(document.form1) { decision.value = 'unmark'; submit(); }
};
function sel() {
	with(document.form1) {
		for(i=0;i<elements.length;i++) {
			thiselm = elements[i];
			if(thiselm.name.substring(0,3) == 'msg')
				thiselm.checked = !thiselm.checked
		}
	}
}
sort_colum = '$sortby';
sort_order = '$sortorder';

function sortby(col) {
	if(col == sort_colum) ord = (sort_order == 'ASC')?'DESC':'ASC';
	else ord = 'ASC';
	location = 'process.php?folder=$folder&pag=$pag&sortby='+col+'&sortorder='+ord+'';
}
//]]>
</script>
";

if (isset($msg)) {
    $smarty->assign('umErrorMessage', $msg);
}

$forms = "<input type=\"hidden\" name=\"decision\" value=\"delete\" />
<input type=\"hidden\" name=\"folder\" value=\"".htmlspecialchars($folder)."\" />
<input type=\"hidden\" name=\"pag\" value=\"$pag\" />
<input type=\"hidden\" name=\"start_pos\" value=\"$start_pos\" />
<input type=\"hidden\" name=\"end_pos\" value=\"$end_pos\" />";

$smarty->assign('umJS', $jssource);
$smarty->assign('umForms', $forms);
$smarty->assign('umUserEmail', $auth['email']);
$smarty->assign('umFolder', $folder);

$messagelist = array();
printf($textout);

$newmsgs = 0;
if ($nummsg > 0) {
    for ($i = 0;$i<count($headers);$i++) {
        if (!stristr($headers[$i]['flags'], '\\SEEN')) {
            $newmsgs++;
        }
    }

    for ($i = $start_pos;$i<$end_pos;$i++) {
        $read = (stristr($headers[$i]['flags'], '\\SEEN')) ? 'true' : 'false';
        $readlink = "javascript:readmsg($i,$read)";
        $composelink = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['from'][0]['name'])."&mailto=".htmlspecialchars($headers[$i]['from'][0]['mail'])."";
        $composelinksent = "newmsg.php?folder=$folder&nameto=".htmlspecialchars($headers[$i]['to'][0]['name'])."&mailto=".htmlspecialchars($headers[$i]['to'][0]['name'])."";

        $from = $headers[$i]['from'][0]['name'];
        $to = $headers[$i]['to'][0]['name'];
        $subject = $headers[$i]['subject'];
        if ($read != 'true') {
            $msg_img = './images/msg_unread.gif';
        } elseif (stristr($headers[$i]['flags'], '\\ANSWERED')) {
            $msg_img = './images/msg_answered.gif';
        } elseif (stristr($headers[$i]['flags'], '\\FORWARDED')) {
            $msg_img = './images/msg_forwarded.gif';
        } else {
            $msg_img = './images/msg_read.gif';
        }
        $prior = $headers[$i]['priority'];
        if ($prior == 4 || $prior == 5) {
            $img_prior = '&nbsp;<img src="./images/prior_low.gif" width="5" height="11" border="0" alt="" />';
        } elseif ($prior == 1 || $prior == 2) {
            $img_prior = '&nbsp;<img src="./images/prior_high.gif" width="5" height="11" border="0" alt="" />';
        } else {
            $img_prior = "";
        }

        $msg_img = '&nbsp;<img src="'.$msg_img.'" width="14" height="14" border="0" alt="" />';
        $checkbox = '<input type="checkbox" name="msg_'.$i.'" value="1" />';
        $attachimg = ($headers[$i]['attach']) ? '&nbsp;<img src\"images/attach.gif" border="0" />' : '';

        $date = $headers[$i]['date'];
        $size = $headers[$i]['size'];
        $index = count($messagelist);

        $messagelist[$index]['read'] = $read;
        $messagelist[$index]['readlink'] = $readlink;
        $messagelist[$index]['composelink'] = $composelink;
        $messagelist[$index]['composelinksent'] = $composelinksent;
        $messagelist[$index]['from'] = $from;
        $messagelist[$index]['to'] = $to;
        $messagelist[$index]['subject'] = $subject;
        $messagelist[$index]['date'] = $date;
        $messagelist[$index]['statusimg'] = $msg_img;
        $messagelist[$index]['checkbox'] = $checkbox;
        $messagelist[$index]['attachimg'] = $attachimg;
        $messagelist[$index]['priorimg'] = $img_prior;
        $messagelist[$index]['size'] = Telaen::bytes2bkmg($size);
    }
}
$smarty->assign('umNumMessages', $nummsg);
$smarty->assign('umNumUnread', $newmsgs);
$smarty->assign('umMessageList', $messagelist);

$display = extended_name($folder);

$smarty->assign('umBoxName', $display);

// Ugg. This should be it's own lang[] entry
$wlcmessage = $lang['msg_you_have']." <b>$nummsg</b> ";
if ($nummsg == 1) {
    $wlcmessage .= $lang['msg_message'].", ";
} else {
    $wlcmessage .= $lang['msg_messages'].", ";
}
if ($newmsgs == 0) {
    $wlcmessage .= $lang['msg_none_unread']." ";
} elseif ($newmsgs == 1) {
    $wlcmessage .= "<b>$newmsgs</b> ".$lang['msg_one_unread']." ";
} else {
    $wlcmessage .= "<b>$newmsgs</b> ".$lang['msg_more_unread']." ";
}
$wlcmessage .= $lang['msg_in_the_folder']." <b><i>$display</i></b>";

$smarty->assign('umWelcomeMessage2', $wlcmessage);

// Page navigation
if ($nummsg > 0) {
    if ($pag > 1) {
        $smarty->assign('umFirstLink', "messages.php?folder=$folder&pag=1");
        $smarty->assign('umPreviousLink', "messages.php?folder=$folder&pag=".($pag-1)."");
    }

    for ($i = 1;$i <= ceil($nummsg / $reg_pp);$i++) {
        if ($pag == $i) {
            $navigation .= "[<b>$i</b>] ";
        } else {
            $navigation .= "<a href=\"messages.php?folder=$folder&pag=$i\" class=\"navigation\">$i</a> ";
        }
    }

    $totPages = ceil($nummsg / $reg_pp);
    if ($end_pos < $nummsg) {
        $smarty->assign('umNextLink', "messages.php?folder=$folder&pag=".($pag+1)."");
        $smarty->assign('umLastLink', "messages.php?folder=$folder&pag=".$totPages."");
    }
    $navigation .= " ($pag/".$totPages.")";
}

$smarty->assign('umNavBar', $navigation);

$avalfolders = array();
foreach (scandir($TLN->userfolder) as $entry) {
    if (is_dir($TLN->userfolder.$entry)
        && $entry != '..'
        && $entry != '.'
        && substr($entry, 0, 1) != '_'
        && $entry != $folder
        && ($TLN->mail_protocol == IMAP || (($entry != 'inbox') && ($entry != 'spam')))) {
        $entry = $TLN->fix_prefix($entry, 0);
        $display = extended_name($entry);
        $avalfolders[] = array('path' => $entry, 'display' => $display);
    }
}

unset($TLN);

$smarty->assign('umHaveSpam', $auth['havespam']);
$smarty->assign('umAvalFolders', $avalfolders);
$smarty->display("$themez/messagelist.tpl");
