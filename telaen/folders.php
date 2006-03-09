<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

Telaen is based on Uebimiau (http://uebimiau.sourceforge.net)
 by Aldoir Ventura (aldoir@users.sourceforge.net)
*************************************************************************/

// load session management
require("./inc/inc.php");


if(!$UM->mail_connect()) redirect_and_exit("error.php?err=1");
if(!$UM->mail_auth()) { redirect_and_exit("badlogin.php?error=".urlencode($UM->mail_error_msg)); }

// check and create a new folder

$newfolder = trim($newfolder);

$require_update = false;


if($newfolder != "" && 
	!ereg("[^A-Za-z0-9\-]",$newfolder) && 
	!file_exists($userfolder.$newfolder)) {
	$UM->mail_create_box($newfolder);
	$require_update = true;
}


// check and delete the especified folder: system folders can not be deleted
if(	!$UM->is_system_folder($delfolder) &&
	$delfolder != "" && 
	!ereg("[^A-Za-z0-9\-]",$delfolder) &&
	(strpos($delfolder,"..") === false)) {
	if($UM->mail_delete_box($delfolder)) {
		unset($sess["headers"][base64_encode(strtolower($delfolder))]);
		$require_update = true;
	}
}

if($require_update)	$sess["folders"] = $UM->mail_list_boxes();

require("./folder_list.php");


if(isset($empty)) {
	$headers = $sess["headers"][base64_encode(strtolower($empty))];
	for($i=0;$i<count($headers);$i++) {
		$UM->mail_delete_msg($headers[$i],$prefs["save-to-trash"],$prefs["st-only-read"]);
		$expunge = true;
	}
	if($expunge) {
		$UM->mail_expunge();
		unset($sess["headers"][base64_encode(strtolower($empty))]);
		/* ops.. you have sent anything to trash, then you need refresh it */
		if($prefs["save-to-trash"])
			unset($sess["headers"][base64_encode("trash")]);
		$SS->Save($sess);
	}
	if(isset($goback)) redirect_and_exit("process.php?folder=".urlencode($folder)."");

}

$jssource = "
<script language=\"JavaScript\">
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function refreshlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function goend() { location = 'logout.php'; }
function search() { location = 'search.php'; }
function goinbox() { location = 'messages.php?folder=inbox'; }
function emptytrash() {	location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function addresses() { location = 'addressbook.php'; }
function prefs() { location = 'preferences.php'; }
function create() {
	strPat = /[^A-Za-z0-9\-]/;
	frm = document.forms[0];
	strName = frm.newfolder.value
	mathArray = strName.match(strPat)
	if(mathArray != null) {
		alert('".ereg_replace("'","\\'",$error_invalid_name)."')
		return false;
	}else
		frm.submit();
}
</script>
";


$smarty->assign("umJS",$jssource);
$smarty->assign("umUserEmail",$sess["email"]);


$boxes = $UM->mail_list_boxes();

$scounter = 0;
$pcounter = 0;

for($n=0;$n<count($boxes);$n++) {

	$entry = $boxes[$n]["name"];

	$unread = 0;

	if(!is_array($sess["headers"][base64_encode(strtolower($entry))])) {
		$merged_array = Array();
		$merged_returnarray = Array();
		if (strtolower($entry) == "inbox") {
			/*
			 * Sort the arrays and fit them together again.
			 */
			$merged_array = array_merge($sess["headers"][base64_encode("inbox")], $sess["headers"][base64_encode("spam")]);
			array_qsort2($merged_array,"msg",$sortorder);

			$merged_returnarray = $UM->mail_list_msgs("INBOX", $merged_array);
			$thisbox = $merged_returnarray[0];
			$sess["headers"][base64_encode("spam")] = $merged_returnarray[1];
		} elseif (strtolower($entry) == "spam") {
			;
		} else {
			$merged_returnarray = $UM->mail_list_msgs($entry, $sess["headers"][base64_encode(strtolower($entry))]);
			$thisbox = $merged_returnarray[0];
		}
			
		unset($merged_array);
		unset($merged_returnarray);
		$sess["headers"][base64_encode(strtolower($entry))] = $thisbox;
	} else $thisbox = $sess["headers"][base64_encode(strtolower($entry))];

	$boxsize = 0;
	for($i=0;$i<count($thisbox);$i++) {
		if(!eregi("\\SEEN",$thisbox[$i]["flags"])) $unread++;
		$boxsize += $thisbox[$i]["size"];
	}
	$delete = "&nbsp;";

	if(!$UM->is_system_folder($entry))
		$delete = "<a href=\"folders.php?delfolder=$entry&folder=$folder\">OK</a>";

	$boxname = $entry;

	if($unread != 0) $unread = "<b>$unread</b>";

	if(ereg("^(inbox|sent|trash|spam)$",strtolower($entry))) {
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
		$system[$scounter]["entry"]     	= strtolower($entry);
		$system[$scounter]["name"]      	= $boxname;
		$system[$scounter]["msgs"]      	= count($thisbox)."/$unread";
		$system[$scounter]["del"]       	= $delete;
		$system[$scounter]["boxsize"]   	= ceil($boxsize/1024);
		$system[$scounter]["chlink"] 		= "process.php?folder=".strtolower($entry)."";
		$system[$scounter]["emptylink"]		= "folders.php?empty=".strtolower($entry)."&folder=".strtolower($entry)."";

		$scounter++;
	} else {

		$personal[$pcounter]["entry"]   	= $entry;
		$personal[$pcounter]["name"]    	= $boxname;
		$personal[$pcounter]["msgs"]    	= count($thisbox)."/$unread";
		$personal[$pcounter]["del"]    		= $delete;
		$personal[$pcounter]["boxsize"]	 	= ceil($boxsize/1024);
		$personal[$pcounter]["chlink"]  	= "process.php?folder=".urlencode($entry)."";
		$personal[$pcounter]["emptylink"]	= "folders.php?empty=".urlencode($entry)."&folder=".urlencode($entry)."";

		$pcounter++;
	}
	$totalused += $boxsize;
}



$SS->Save($sess);
$UM->mail_disconnect();
unset($SS,$UM);
array_qsort2ic ($system,"name");

if (!is_array($personal)) $personal = Array();
$umFolderList = array_merge((array)$system, (array)$personal);



$smarty->assign("umFolderList",$umFolderList);

$smarty->assign("umPersonal",$personal);
$smarty->assign("umTotalUsed",ceil($totalused/1024));
$quota_enabled = ($quota_limit)?1:0;
$smarty->assign("umQuotaEnabled",$quota_enabled);
$smarty->assign("umQuotaLimit",$quota_limit);
$usageGraph = get_usage_graphic(($totalused/1024),$quota_limit);
$smarty->assign("umUsageGraph",$usageGraph);
$noquota = (($totalused/1024) > $quota_limit)?1:0;
$smarty->assign("umNoQuota",$noquota);

echo($nocache);

$smarty->display("$selected_theme/folders.htm");

?>
