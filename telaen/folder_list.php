<?
$folders = $sess["folders"];
$scounter = 0;
$pcounter = 0;
foreach($folders as $entry) {
	$entry = $entry["name"];
	$boxname = $entry;
	if(preg_match("/(inbox|sent|trash|spam)/i",$entry)) {
		switch(strtolower($entry)) {
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
		$system[$scounter]["systemname"]    = strtolower($entry);
		$system[$scounter]["name"]      = $boxname;
		$system[$scounter]["link"] 	= "process.php?folder=".strtolower($entry)."";
		$scounter++;
	} else {
		$personal[$pcounter]["systemname"]  = $entry;
		$personal[$pcounter]["name"]    = $boxname;
		$personal[$pcounter]["link"] 	= "process.php?folder=$entry";
		$pcounter++;
	}
}
array_qsort2ic ($system,"name");
array_qsort2ic ($personal,"name");
$smarty->assign("umSystemFolders",$system);
$smarty->assign("umPersonalFolders",$personal);
?>
