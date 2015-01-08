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

if (!$TLN->mail_connect()) $TLN->redirect_and_exit('index.php?err=1', true);
if (!$TLN->mail_auth()) $TLN->redirect_and_exit('index.php?err=0');
$auth['auth'] = true;

extract(Telaen::pull_from_array($_GET, array('empty', 'goback', 'nameto', 'mailto'), 's'));
extract(Telaen::pull_from_array($_POST, array('newfolder'), 's'));

if ($TLN->valid_fname($newfolder)) {
    $TLN->mail_create_box($newfolder);
}

// check and delete the especified folder: system folders can not be deleted
if ($TLN->valid_fname($delfolder)) {
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

$TLN->refresh_folders();
$boxes = $TLN->mail_list_boxes();

$scounter = 0;
$pcounter = 0;

// Reset these arrays because are used on previous included funcs!!
$system = array();
$personal = array();
$totalused = 0;
foreach ($boxes as $entry => $f) {
    // prep vars
    if (!$TLN->is_system_folder($entry)) {
        $delete = '<a href="folders.php?delfolder='.urlencode($entry).'&folder='.urlencode($folder).'">OK</a>';
    } else {
        $delete = '&nbsp;';
    }
    $boxname = $entry;
    $unread = $f['unread'];
    if ($unread != 0) {
        $unread = "<b>$unread</b>";
    }


    if ($TLN->is_system_folder($entry)) {
        $boxname = extended_name($entry);
        $system[$scounter]['entry'] = $entry;
        $system[$scounter]['name'] = $boxname;
        $system[$scounter]['msgs'] = $f['count']."/$unread";
        $system[$scounter]['del'] = $delete;
        $system[$scounter]['boxsize'] = Telaen::bytes2bkmg($f['size']);
        $system[$scounter]['chlink'] = 'process.php?folder='.urlencode($entry)."";
        $system[$scounter]['emptylink'] = 'folders.php?empty='.urlencode($entry).'&folder='.urlencode($entry)."";
        $scounter++;
    } else {
        $personal[$pcounter]['entry'] = $entry;
        $personal[$pcounter]['name'] = $boxname;
        $personal[$pcounter]['msgs'] = $f['count']."/$unread";
        $personal[$pcounter]['del'] = $delete;
        $personal[$pcounter]['boxsize'] = Telaen::bytes2bkmg($f['size']);
        $personal[$pcounter]['chlink'] = 'process.php?folder='.urlencode($entry)."";
        $personal[$pcounter]['emptylink'] = 'folders.php?empty='.urlencode($entry).'&folder='.urlencode($entry)."";
        $pcounter++;
    }
    $totalused += $f['size'];
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
