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

extract(Telaen::pullFromArray($_GET, ['empty', 'goback', 'nameto', 'mailto'], 's'));
extract(Telaen::pullFromArray($_POST, ['newfolder', 'delfolder'], 's'));

if ($TLN->isValidFname($newfolder)) {
    $TLN->mailCreateBox($newfolder);
}

// check and delete the especified folder: system folders can not be deleted
if ($TLN->isValidFname($delfolder)) {
    $TLN->mailDeleteBox($delfolder);
}

// require './folder_list.php';

if (isset($empty)) {
    $headers = $mbox['headers'][$empty];
    for ($i = 0;$i<count($headers);$i++) {
        $TLN->mailDeleteMsg($headers[$i], $TLN->prefs['send_to_trash'], $TLN->prefs['st_only_read']);
        $expunge = true;
    }
    if ($expunge) {
        $TLN->mailExpunge();
        unset($mbox['headers'][$empty]);
        /* ops.. you have sent anything to trash, then you need refresh it */
        if ($TLN->prefs['send_to_trash']) {
            unset($mbox['headers']['trash']);
        }
    }
    if (isset($goback)) {
        $TLN->redirectAndExit('process.php?folder='.urlencode($folder)."");
    }
}

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function refreshlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function create() { frm = document.forms[0]; frm.submit(); }
//]]>
</script>
";

$smarty->assign('smJS', $jssource);
$smarty->assign('smUserEmail', $auth['email']);

$TLN->refreshFolders();
$boxes = $TLN->mailListBoxes();

$scounter = 0;
$pcounter = 0;

// Reset these arrays because are used on previous included funcs!!
$system = array();
$personal = array();
$totalused = 0;
foreach ($boxes as $entry => $f) {
    // prep vars
    if (!$TLN->isSystemFolder($entry)) {
        $delete = '<a href="folders.php?delfolder='.urlencode($entry).'&folder='.urlencode($folder).'">OK</a>';
    } else {
        $delete = '&nbsp;';
    }
    $boxname = $entry;
    $unread = $f['unread'];
    if ($unread != 0) {
        $unread = "<b>$unread</b>";
    }


    if ($TLN->isSystemFolder($entry)) {
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
$TLN->mailDisconnect();
unset($AuthSession, $TLN);
// Sort and merge the 2 folders arrays
Telaen::arrayQsort2ic($system, 'name');
Telaen::arrayQsort2ic($personal, 'name');

$smFolderList = array_merge((array) $system, (array) $personal);

$smarty->assign('smFolderList', $smFolderList);

$smarty->assign('smPersonal', $personal);
$smarty->assign('smTotalUsed', Telaen::bytes2bkmg($totalused));
$quota_enabled = ($quota_limit) ? 1 : 0;
$smarty->assign('smQuotaEnabled', $quota_enabled);
$smarty->assign('smQuotaLimit', Telaen::bytes2bkmg($quota_limit));
$usageGraph = Telaen::getUsageGraphic($totalused, $quota_limit);
$smarty->assign('smUsageGraph', $usageGraph);
$noquota = ($totalused > $quota_limit) ? 1 : 0;
$smarty->assign('smNoQuota', $noquota);

$smarty->assign('pageMetas', $pmetas);

$smarty->display("$themez/folders.tpl");
