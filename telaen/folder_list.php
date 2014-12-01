<?php
defined('I_AM_TELAEN') or die('Direct access not permitted');

$folders = $mbox['folders'] || array();
$scounter = 0;
$pcounter = 0;
$system = array();
$personal = array();
foreach ($folders as $entry) {
    $entry = $entry['name'];
    $boxname = $entry;
    if ($TLN->is_system_folder($entry)) {
        $entry = strtolower($entry);
        switch ($entry) {
        case 'inbox':
            $boxname = $lang['inbox_extended'];
            break;
        case 'sent':
            $boxname = $lang['sent_extended'];
            break;
        case 'trash':
            $boxname = $lang['trash_extended'];
            break;
        case 'spam':
            $boxname = ($lang['spam_extended'] ? $lang['spam_extended'] : 'SPAM');
            break;
        }
        $system[$scounter]['systemname'] = $entry;
        $system[$scounter]['name'] = $boxname;
        $system[$scounter]['link'] = "process.php?folder=$entry";
        $scounter++;
    } else {
        $personal[$pcounter]['systemname'] = $entry;
        $personal[$pcounter]['name'] = $boxname;
        $personal[$pcounter]['link'] = "process.php?folder=$entry";
        $pcounter++;
    }
}

// sort the sys item by sysname so the order will always
// inbox -> sent -> spam -> trash
// in all languages
$TLN->array_qsort2ic($system, 'systemname');
$TLN->array_qsort2ic($personal, 'name');

$smarty->assign('umSystemFolders', $system);
$smarty->assign('umPersonalFolders', $personal);
