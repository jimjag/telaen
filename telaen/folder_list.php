<?php
$folders = $sess["folders"];
$scounter = 0;
$pcounter = 0;
$system = Array();
$personal = Array();
foreach($folders as $entry) {
	$entry = $entry["name"];
	$boxname = $entry;
	if ($UM->is_system_folder($entry)) {
		$entry = strtolower($entry);
		switch ($entry) {
		case "inbox":
			$boxname = $inbox_extended;
			break;
		case "sent":
			$boxname = $sent_extended;
			break;
		case "trash":
			$boxname = $trash_extended;
			break;
		case "spam":
			$boxname = ($spam_extended ? $spam_extended : "SPAM");
			break;
		}
		$system[$scounter]["systemname"]	= $entry;
		$system[$scounter]["name"]		= $boxname;
		$system[$scounter]["link"]		= "process.php?folder=$entry";
		$scounter++;
	} else {
		$personal[$pcounter]["systemname"]	= $entry;
		$personal[$pcounter]["name"]		= $boxname;
		$personal[$pcounter]["link"]		= "process.php?folder=$entry";
		$pcounter++;
	}
}
array_qsort2ic ($system,"name");
array_qsort2ic ($personal,"name");
$smarty->assign("umSystemFolders",$system);
$smarty->assign("umPersonalFolders",$personal);
?>
