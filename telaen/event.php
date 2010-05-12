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

$jssource .= "
	<script type=\"text/javascript\" src=\"./js/calendar.js\"></script>
";
$smarty->assign("pageMetas", $nocache);
$smarty->assign("umJS",$jssource);

if ($actionDone) {
	$smarty->assign("umShowEventForm","NO");
} else {
	$event = $events->getEvent($day);
	$smarty->assign("umeText",$event);
	$smarty->assign("umShowEventForm","YES");
}
unset ($events);

$smarty->assign("umPageTitle", "Calendar Event");
$smarty->display("$selected_theme/event.htm");

?>
