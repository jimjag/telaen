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
extract(pull_from_post(Array("etext", "edate", "evsave", "evdelete", "starthour", "stophour", "startmin", "stopmin")));

$etext = trim($etext);

list(, $foo, $uid) = explode("_", $edate);
$year=intval(strstr($foo, 0, 4));
$month=intval(strstr($foo, 4, 2));
$day=intval(strstr($foo, 6, 2));
$midnight = sprintf("%4s%02s%02s", $year, $month, $day) . "T000000";

$actionDone = false;
$event = Array("", $midnight, $midnight, "", "00", "00", "00", "00");
// Minor error-check
if ($year > 2009 && $year < 2050 && $month > 0 && $month <  13 && $day > 0 && $day < 32) {
	/*
	 * Grab the event array and event, if any, for this date
	 */
	$events = new MyMonth($year, $month);
	$event = $events->getEvent($day);
	
	if (isset($evdelete) && $uid) {
		$events->delEvent($uid);
		$events->saveEvents();
		$actionDone = true;
	}
	if(isset($evsave) && $etext) {
		$starttime = sprintf("%2d%2d00", $starthour . $startmin);
		$stoptime = sprintf("%2d%2d00", $stopthour . $stopmin);
		$etext = HTMLFilter($etext, "images/trans.gif", $block_external_images);
		$events->setEvent($day, $starttime, $stoptime, $etext, $uid);
		$events->saveEvents();
		$actionDone = true;
	}
}

$jssource .=<<<EOT
	<script type="text/javascript" src="./js/calendar.js"></script>
	<script type="text/javascript" src="editors/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="editors/tiny_mce/tiny_e_init.js"></script>
EOT;

$smarty->assign("pageMetas", $nocache);
$smarty->assign("umJS",$jssource);

if ($actionDone) {
	$smarty->assign("umShowEventForm","NO");
} else {
	$timestamp = mktime(0, 0, 0, $month, 1, 2010);
	$mdate = ":: &nbsp;&nbsp; ". date("M", $timestamp) . " $day, $year &nbsp;&nbsp; ::<br/>";
	$smarty->assign("umEvent",$event);
	$smarty->assign("umShowEventForm","YES");
	$smarty->assign("umEventHeader", $mdate);
	$smarty->assign("mins", array(0,5,10,15,20,25,30,35,40,45,50,55));
	$smarty->assign("hours", array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23));
	$smarty->assign("dhours", array("12am","1am","2am","3am", "4am","5am","6am","7am","8am","9am","10am","11am",
									"12pm","1pm","2pm","3pm", "4pm","5pm","6pm","7pm","8pm","9pm","10pm","11pm"));
}
unset ($events);

$smarty->assign("umPageTitle", "Calendar Event");
$smarty->display("$selected_theme/event.htm");

?>
