<?php
defined('I_AM_TELAEN') or die('Direct access not permitted');
/* @var $TLN Telaen */

$mfolders = &$tdb->getFolders();
$scounter = 0;
$pcounter = 0;
$system = array();
$personal = array();
foreach ($mfolders as $entry) {
    $entry = $entry['name'];
    $boxname = $entry;
    if ($TLN->isSystemFolder($entry)) {
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
$TLN->arrayQsort2ic($system, 'systemname');
$TLN->arrayQsort2ic($personal, 'name');

$smarty->assign('umSystemFolders', $system);
$smarty->assign('umPersonalFolders', $personal);
