<?php
defined('I_AM_TELAEN') or die('Direct access not permitted');

$folders = $mbox->get_folders();
$scounter = 0;
$pcounter = 0;
$system = array();
$personal = array();
foreach ($folders as $entry) {
    $entry = $entry['name'];
    $boxname = $entry;
    if ($TLN->is_system_folder($entry)) {
        switch ($entry) {
        case 'inbox':
            $boxname = ($lang['inbox_extended'] ? $lang['inbox_extended'] : 'INBOX');
            break;
        case 'sent':
            $boxname = ($lang['sent_extended'] ? $lang['sent_extended'] : 'Sent');
            break;
        case 'trash':
            $boxname = ($lang['trash_extended'] ? $lang['trash_extended'] : 'Trash');
            break;
        case 'spam':
            $boxname = ($lang['spam_extended'] ? $lang['spam_extended'] : 'SPAM folder');
            break;
        case 'drafts':
            $boxname = ($lang['drafts_extended'] ? $lang['drafts_extended'] : 'Drafts');
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
