<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

// load session management
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require('./inc/init.php');

extract(pull_from_array($_GET, array('empty', 'goback', 'nameto', 'mailto'), 's'));
extract(pull_from_array($_POST, array('newfolder'), 's'));

// server check
if(!$TLN->mail_connect()){ 
	redirect_and_exit('index.php?err=1', true);
}
if(!$TLN->mail_auth()) { 
	redirect_and_exit('index.php?err=0');
}

// check and create a new folder
$newfolder = trim($newfolder);

$require_update = false;

if(valid_folder_name($newfolder, true) && 
   !file_exists($userfolder.$newfolder)) {
	$TLN->mail_create_box($newfolder);
	$require_update = true;
}


// check and delete the especified folder: system folders can not be deleted
if (valid_folder_name($delfolder, true) &&
   (strpos($delfolder,'..') === false)) {
	if($TLN->mail_delete_box($delfolder)) {
		unset($mbox['headers'][base64_encode(strtolower($delfolder))]);
		$require_update = true;
	}
}

if($require_update) $mbox['folders'] = $TLN->mail_list_boxes();

require('./folder_list.php');


if(isset($empty)) {
	$headers = $mbox['headers'][base64_encode(strtolower($empty))];
	for($i=0;$i<count($headers);$i++) {
		$TLN->mail_delete_msg($headers[$i],$prefs['save-to-trash'],$prefs['st-only-read']);
		$expunge = true;
	}
	if($expunge) {
		$TLN->mail_expunge();
		unset($mbox['headers'][base64_encode(strtolower($empty))]);
		/* ops.. you have sent anything to trash, then you need refresh it */
		if($prefs['save-to-trash'])
			unset($mbox['headers'][base64_encode('trash')]);
		$UserMbox->Save($mbox);
	}
	if(isset($goback)) redirect_and_exit('process.php?folder='.urlencode($folder)."");

}

$jssource = $commonJS;
$jssource .= "
<script type=\"text/javascript\">
//<![CDATA[
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function refreshlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function create() {
	strPat = /[^A-Za-z0-9\-]/;
	frm = document.forms[0];
	strName = frm.newfolder.value
	mathArray = strName.match(strPat)
	if(mathArray != null) {
		alert('".preg_replace("/'/","\\'",$error_invalid_name)."')
		return false;
	}else
		frm.submit();
}
//]]>
</script>
";


$smarty->assign('umJS',$jssource);
$smarty->assign('umUserEmail',$auth['email']);


$boxes = $TLN->mail_list_boxes();

$scounter = 0;
$pcounter = 0;


// Reset these arrays because are used on previous included funcs!!
$system = array();
$personal = array();

for($n=0;$n<count($boxes);$n++) {

	$entry = $boxes[$n]['name'];

	$unread = 0;

	if(!is_array($mbox['headers'][base64_encode(strtolower($entry))])) {
		$merged_array = array();
		$merged_returnarray = array();
		if (strtolower($entry) == 'inbox') {
			/*
			 * Sort the arrays and fit them together again.
			 */
			$merged_array = array_merge($mbox['headers'][base64_encode('inbox')], $mbox['headers'][base64_encode('spam')]);
			array_qsort2int($merged_array,'msg','ASC');

			$merged_returnarray = $TLN->mail_list_msgs('INBOX', $merged_array);
			$thisbox = $merged_returnarray[0];
			$mbox['headers'][base64_encode('spam')] = $merged_returnarray[1];
		} elseif (strtolower($entry) == 'spam') {
			;
		} else {
			$merged_returnarray = $TLN->mail_list_msgs($entry, $mbox['headers'][base64_encode(strtolower($entry))]);
			$thisbox = $merged_returnarray[0];
		}
			
		unset($merged_array);
		unset($merged_returnarray);
		$mbox['headers'][base64_encode(strtolower($entry))] = $thisbox;
	} else $thisbox = $mbox['headers'][base64_encode(strtolower($entry))];

	$boxsize = 0;
	for($i=0;$i<count($thisbox);$i++) {
		if(!preg_match('|\\SEEN|i',$thisbox[$i]['flags'])) $unread++;
		$boxsize += $thisbox[$i]['size'];
	}
	$delete = '&nbsp;';

	if(!$TLN->is_system_folder($entry))
		$delete = "<a href=\"folders.php?delfolder=$entry&folder=$folder\">OK</a>";

	$boxname = $entry;

	if($unread != 0) $unread = "<b>$unread</b>";

	if ($TLN->is_system_folder($entry)) {
		$entry = strtolower($entry);
		switch ($entry) {
		case 'inbox':
			$boxname = $inbox_extended;
			break;
		case 'sent':
			$boxname = $sent_extended;
			break;
		case 'trash':
			$boxname = $trash_extended;
			break;
		case 'spam':
			$boxname = ($spam_extended ? $spam_extended : 'SPAM');
			break;
		}
		$system[$scounter]['entry']		= $entry;
		$system[$scounter]['name']		= $boxname;
		$system[$scounter]['msgs']		= count($thisbox)."/$unread";
		$system[$scounter]['del']		= $delete;
		$system[$scounter]['boxsize']		= ceil($boxsize/1024);
		$system[$scounter]['chlink']		= "process.php?folder=$entry";
		$system[$scounter]['emptylink']		= 'folders.php?empty='.$entry.'&folder='.$entry."";

		$scounter++;
	} else {

		$personal[$pcounter]['entry']		= $entry;
		$personal[$pcounter]['name']		= $boxname;
		$personal[$pcounter]['msgs']		= count($thisbox)."/$unread";
		$personal[$pcounter]['del']		= $delete;
		$personal[$pcounter]['boxsize']		= ceil($boxsize/1024);
		$personal[$pcounter]['chlink']		= 'process.php?folder='.urlencode($entry)."";
		$personal[$pcounter]['emptylink']	= 'folders.php?empty='.urlencode($entry).'&folder='.urlencode($entry)."";

		$pcounter++;
	}
	$totalused += $boxsize;
}



$AuthSession->Save($auth);
$TLN->mail_disconnect();
unset($AuthSession,$TLN);

// Sort and merge the 2 folders arrays
array_qsort2ic ($system,'name');
array_qsort2ic ($personal,'name');

$umFolderList = array_merge((array)$system, (array)$personal);



$smarty->assign('umFolderList',$umFolderList);

$smarty->assign('umPersonal',$personal);
$smarty->assign('umTotalUsed',ceil($totalused/1024));
$quota_enabled = ($quota_limit)?1:0;
$smarty->assign('umQuotaEnabled',$quota_enabled);
$smarty->assign('umQuotaLimit',$quota_limit);
$usageGraph = get_usage_graphic(($totalused/1024),$quota_limit);
$smarty->assign('umUsageGraph',$usageGraph);
$noquota = (($totalused/1024) > $quota_limit)?1:0;
$smarty->assign('umNoQuota',$noquota);

$smarty->assign('pageMetas',$nocache);

$smarty->display("$selected_theme/folders.htm");

?>
