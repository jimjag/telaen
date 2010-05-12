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
extract(pull_from_post(Array("etext", "edate", "evsave", "evdelete")));

$etext = trim($etext);

list($dummy, $year, $month, $day) = explode("_", $edate);
$year=intval($year); $month=intval($month); $day=intval($day);

$actionDone = false;
$event = "";
// Minor error-check
if ($year > 2009 && $year < 2050 && $month > 0 && $month <  13 && $day > 0 && $day < 32) {
	/*
	 * Grab the event array and event, if any, for this date
	 */
	$events = new MyMonth($year, $month);
	$event = $events->getEvent($day);
	
	if (isset($evdelete)) {
		$events->delEvent($day);
		$events->saveEvents();
		$actionDone = true;
	}
	if(isset($evsave) && $etext) {
		$events->setEvent($day, $etext);
		$events->saveEvents();
		$actionDone = true;
	}
}
$jssource .= "
	<script type=\"text/javascript\" src=\"./js/calendar.js\"></script>
";
$smarty->assign("pageMetas", $nocache);
$smarty->assign("umJS",$jssource);

if ($actionDone) {
	$smarty->assign("umShowEventForm","NO");
} else {
	$timestamp = mktime(0, 0, 0, $month, 1, 2010);
	$mdate = date("M", $timestamp) . " $day, $year";
	$smarty->assign("umeText",$event);
	$smarty->assign("umShowEventForm","YES");
	$smarty->assign("umEventHeader", $mdate);
	$smarty->assign("umEdate", $edate);
}
unset ($events);

$smarty->assign("umPageTitle", "Calendar Event");
$smarty->display("$selected_theme/event.htm");

?>
