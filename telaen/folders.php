<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

// load session management
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

extract(Telaen::pull_from_array($_GET, array('empty', 'goback', 'nameto', 'mailto'), 's'));
extract(Telaen::pull_from_array($_POST, array('newfolder'), 's'));

if ($TLN->fname($newfolder, true)) {
    $TLN->mail_create_box($newfolder);
}

// check and delete the especified folder: system folders can not be deleted
if ($TLN->fname($delfolder, true)) {
    $TLN->mail_delete_box($delfolder);
}

require './folder_list.php';

if (isset($empty)) {
    $headers = $mbox['headers'][$empty];
    for ($i = 0;$i<count($headers);$i++) {
        $TLN->mail_delete_msg($headers[$i], $TLN->prefs['send_to_trash'], $TLN->prefs['st_only_read']);
        $expunge = true;
    }
    if ($expunge) {
        $TLN->mail_expunge();
        unset($mbox['headers'][$empty]);
        /* ops.. you have sent anything to trash, then you need refresh it */
        if ($TLN->prefs['send_to_trash']) {
            unset($mbox['headers']['trash']);
        }
    }
    if (isset($goback)) {
        $TLN->redirect_and_exit('process.php?folder='.urlencode($folder)."");
    }
}

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function refreshlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function create() { frm = document.forms[0]; frm.submit(); }
//]]>
</script>
";

$smarty->assign('umJS', $jssource);
$smarty->assign('umUserEmail', $auth['email']);

$boxes = $TLN->mail_list_boxes();

$scounter = 0;
$pcounter = 0;

// Reset these arrays because are used on previous included funcs!!
$system = array();
$personal = array();

for ($n = 0;$n<count($boxes);$n++) {
    $entry = $boxes[$n]['name'];

    $unread = 0;

    if (!is_array($mbox['headers'][$entry])) {
        $merged_array = array();
        $merged_returnarray = array();
        if ($entry == 'inbox') {
            /*
             * Sort the arrays and fit them together again.
             */
            $merged_array = array_merge($mbox['headers']['inbox'], $mbox['headers']['spam']);
            Telaen::array_qsort2int($merged_array, 'mnum', 'ASC');

            $thisbox = $TLN->mail_list_msgs('inbox');
            $thisbox = $merged_returnarray[0];
            $mbox['headers']['spam'] = $merged_returnarray[1];
        } elseif ($entry == 'spam') {
            ;
        } else {
            $thisbox = $TLN->mail_list_msgs($entry);
            $thisbox = $merged_returnarray[0];
        }

        unset($merged_array);
        unset($merged_returnarray);
        $mbox['headers'][$entry] = $thisbox;
    } else {
        $thisbox = $mbox['headers'][$entry];
    }

    $boxsize = 0;
    for ($i = 0;$i<count($thisbox);$i++) {
        if (!preg_match('|\\SEEN|i', $thisbox[$i]['flags'])) {
            $unread++;
        }
        $boxsize += $thisbox[$i]['size'];
    }

    // prep vars
    if (!$TLN->is_system_folder($entry)) {
        $delete = '<a href="folders.php?delfolder='.urlencode($entry).'&folder='.urlencode($folder).'">OK</a>';
    } else {
        $delete = '&nbsp;';
    }
    $boxname = $entry;
    if ($unread != 0) {
        $unread = "<b>$unread</b>";
    }

    if ($TLN->is_system_folder($entry)) {
        $boxname = extended_name($entry);
        $system[$scounter]['entry'] = $entry;
        $system[$scounter]['name'] = $boxname;
        $system[$scounter]['msgs'] = count($thisbox)."/$unread";
        $system[$scounter]['del'] = $delete;
        $system[$scounter]['boxsize'] = Telaen::bytes2bkmg($boxsize);
        $system[$scounter]['chlink'] = 'process.php?folder='.urlencode($entry)."";
        $system[$scounter]['emptylink'] = 'folders.php?empty='.urlencode($entry).'&folder='.urlencode($entry)."";
        $scounter++;
    } else {
        $personal[$pcounter]['entry'] = $entry;
        $personal[$pcounter]['name'] = $boxname;
        $personal[$pcounter]['msgs'] = count($thisbox)."/$unread";
        $personal[$pcounter]['del'] = $delete;
        $personal[$pcounter]['boxsize'] = Telaen::bytes2bkmg($boxsize);
        $personal[$pcounter]['chlink'] = 'process.php?folder='.urlencode($entry)."";
        $personal[$pcounter]['emptylink'] = 'folders.php?empty='.urlencode($entry).'&folder='.urlencode($entry)."";
        $pcounter++;
    }
    $totalused += $boxsize;
}

$AuthSession->Save($auth);
$TLN->mail_disconnect();
unset($AuthSession, $TLN);
// Sort and merge the 2 folders arrays
Telaen::array_qsort2ic($system, 'name');
Telaen::array_qsort2ic($personal, 'name');

$umFolderList = array_merge((array) $system, (array) $personal);

$smarty->assign('umFolderList', $umFolderList);

$smarty->assign('umPersonal', $personal);
$smarty->assign('umTotalUsed', Telaen::bytes2bkmg($totalused));
$quota_enabled = ($quota_limit) ? 1 : 0;
$smarty->assign('umQuotaEnabled', $quota_enabled);
$smarty->assign('umQuotaLimit', Telaen::bytes2bkmg($quota_limit));
$usageGraph = Telaen::get_usage_graphic($totalused, $quota_limit);
$smarty->assign('umUsageGraph', $usageGraph);
$noquota = ($totalused > $quota_limit) ? 1 : 0;
$smarty->assign('umNoQuota', $noquota);

$smarty->assign('pageMetas', $pmetas);

$smarty->display("$themez/folders.tpl");
