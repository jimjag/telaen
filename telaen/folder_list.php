<?php
defined('I_AM_TELAEN') or die('Direct access not permitted');

$mfolders = $tdb->get_folders();
$scounter = 0;
$pcounter = 0;
$system = array();
$personal = array();
foreach ($mfolders as $entry) {
    $entry = $entry['name'];
    $boxname = $entry;
    if ($TLN->is_system_folder($entry)) {
        $boxname = extended_name($entry);
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
