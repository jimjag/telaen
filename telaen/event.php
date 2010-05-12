<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.com/

*************************************************************************/

require("./inc/init.php");

if(!$sess["auth"]) {
	echo "error: your session seems expired";
	die();
}

extract(pull_from_get(Array("edate")));
extract(pull_from_post(Array("etext", "edate", "eaction")));

$etext = trim($etext);

list($dummy, $year, $month, $day) = explode("_", $edate);
$year=intval($year); $month=intval($month); $day=intval($day);

// Minor error-check
if ($year <= 2009 || $year >= 2050 || $month <= 0 || $month >= 13 || $day <= 0 || $day >= 32)
	unset($eaction);

if (!$etext && $eaction != "delete")
	unset($eaction);


/*
 * Grab the event array and event, if any, for this date
 */
$events = new CalEvents($year, $month);

$actionDone = false;
switch($eaction) {
	case "delete":
		$events->delEvent($day);
		$events->saveEvents();
		$actionDone = true;
		break;
	case "save":
		$events->setEvent($day, $etext);
		$events->saveEvents();
		$actionDone = true;
		break;
	default:
		break;
}

if ($actionDone)
	$smarty->assign("umEventForm",0);
} else {
	$smarty->assign("pageMetas", $nocache);

	$show_advanced = ($prefs["editor-mode"] != "text") ? 1 : 0 ;
	$js_advanced = ($show_advanced) ? "true" : "false" ;

	$jssource = $commonJS;

	if ($show_advanced) {
		$jssource .=<<<EOT
	<script type="text/javascript" src="editors/tiny_mce/tiny_mce_gzip.js"></script>
	<script type="text/javascript" src="editors/tiny_mce/tiny_comp_init.js"></script>
	<script type="text/javascript" src="editors/tiny_mce/tiny_init.js"></script>
EOT;
}

	$smarty->assign("umJS",$jssource);

	$event = $events->getEvent($day);
	$smarty->assign("umeText",$event);

	$smarty->assign("umEventForm",1);
}
unset ($events);

$smarty->display("$selected_theme/search.htm");

?>
