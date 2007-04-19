<?php
/************************************************************************
Telaen is a GPL'ed software developed by 

 - The Telaen Group
 - http://www.telaen.org/

*************************************************************************/

require("./inc/inc.php");
require("./folder_list.php");

// assign metas
$smarty->assign("pageMetas", $nocache);

$jssource = $commonJS;
$jssource .= "

<script type=\"text/javascript\">
//<![CDATA[
disbl = false;
function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."'; }
function folderlist() { location = 'folders.php?folder=".urlencode($folder)."'}
function search() { location = 'search.php'; }
function emptytrash() { location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true';}
function dis() { 
	var f = $('prefs_form'); 
	f.st_only_read.disabled = !f.save_trash.checked; 
	if(f.st_only_read.checked) {
		f.st_only_read.checked = f.save_trash.checked; 
                disbl = f.save_trash.checked;
	} 
}
function checkDis() {
	if (disbl)
		return false;
}
function filterDelete(id) {
	var f = $('filters_form');
	cb = eval('f.cb' + id);
	if(cb) {
		cb.checked = true;
	}
	f.submit();
}
//]]>
</script>
";

$smarty->assign("umJS", $jssource);

// load filters
$filename = $userfolder."_infos/filters.ucf";
$myfile = $UM->_read_file($filename);
$filters = array();

if($myfile != "")  
        $filters = unserialize(base64_decode($myfile));

// we have to do something...
if(isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
                
		case "savePrefs":
			// pick the new settings and save			
			$myprefs["real-name"]           = $_POST['real_name'];
		        $myprefs["reply-to"]            = $_POST['reply_to'];
		        $myprefs["save-to-trash"]       = $_POST['save_trash'];
		        $myprefs["st-only-read"]        = $_POST['st_only_read'];
		        $myprefs["empty-trash"]         = $_POST['empty_trash_on_exit'];
		        $myprefs["empty-spam"]          = $_POST['empty_spam_on_exit'];
		        $myprefs["unmark-read"]         = $_POST['unmark_read_on_exit'];
		        $myprefs["save-to-sent"]        = $_POST['save_sent'];
		        $myprefs["rpp"]                 = $_POST['rpp'];
		        $myprefs["add-sig"]             = $_POST['add_sig'];
		        $myprefs["signature"]           = $_POST['sig'];
		        $myprefs["timezone"]            = $_POST['timezone'];
		        $myprefs["display-images"]      = $_POST['display_images'];
		        $myprefs["editor-mode"]         = $_POST['editor_mode'];
		        $myprefs["refresh-time"]        = $_POST['refresh_time'];
		        $myprefs["first-login"]         = 1;
		        $myprefs["spamlevel"]           = $_POST['spamlevel'];
			$myprefs["require-receipt"]	= $_POST['require_receipt'];
		        $myprefs["version"]             = $appversion;
		        save_prefs($myprefs);
			unset($myprefs);

			break;

		case "addFilter":
			// check for params
                        if(!isset($_POST['filter_type']) ||
                                !isset($_POST['filter_field']) ||
                                !isset($_POST['filter_match']) ||
                                !isset($_POST['filter_folder']))
                                break;

                        // set the folder only for move
                        $destFolder = "";
                        if(intval($_POST['filter_type']) == FL_TYPE_MOVE) {
                                $destFolder = trim($_POST['filter_folder']);
				// Check if the user entered a valid folder
				if(!valid_folder_name($destFolder) || !file_exists($userfolder.$destFolder))
					break;
                        }
			
			// the matching string must not be empty
			$match = trim($_POST['filter_match']);
			if($match == "")
				break;

			// add the filter
			$newFilter =  array(
				"type"          => intval($_POST['filter_type']),
				"field"         => intval($_POST['filter_field']),
				"match"         => $match,
				"moveto"        => $destFolder
			);
			array_push($filters, $newFilter);

			// save the file
			$content = base64_encode(serialize($filters));
			$UM->_save_file($filename, $content);
			
                        break;

		case "delFilter":

			if (!isset($_POST['filters_array'])) {
				// nothing to delete
				break;
			}
			
			$delArray = $_POST['filters_array'];			
			
			$newFilters = array();
			for($i=0; $i<count($filters); $i++) {
				if(!in_array(strval($i), $delArray)) {
					array_push($newFilters, $filters[$i]);
				}	
			} 
			
			$filters = $newFilters;			
			
			// save the file
                        $content = base64_encode(serialize($filters));
                        $UM->_save_file($filename, $content);

                        break;
        }
}

$smarty->assign("filterList", $filters);

// load prefs
$prefs = load_prefs();

// name & reply to
$smarty->assign("realName", $prefs["real-name"]);
$smarty->assign("replyTo", $prefs["reply-to"]);

// timezones
$gmttime = time()-date("Z");

$timeVals = array();
for($i=-12; $i<=12; $i = $i+0.5) {
        $nowgmt = $gmttime + $i*3600;
        $operator = ($i < 0)?"-":"+";
        $z = abs($i);
        $diff = $operator . sprintf("%02d",intval($z)) . sprintf("%02d",($z-intval($z))*60);
        $timeVals[$diff] = "GMT " .$diff. " (" .date("h:i A",$nowgmt). ")";
}

$smarty->assign("timezone", $prefs["timezone"]);
$smarty->assign("timezoneVals", $timeVals);

// editor mode
$smarty->assign("editorMode", $prefs["editor-mode"]);

// records per page
$smarty->assign("msgPerPage", $prefs["rpp"]);
$smarty->assign("msgPerPageVals", array(10,20,30,40,50,100,200));

// refresh time
$smarty->assign("refreshTime", $prefs["refresh-time"]); 
$smarty->assign("refreshTimeVals", array(5,10,15,20,25));

// signature 
$status = ($prefs["add-sig"])? true:false;
$smarty->assign("addSignature",$status);

$txtsignature = htmlspecialchars($prefs["signature"]);
$smarty->assign("signature", $txtsignature);

// misc
$status = ($prefs["save-to-trash"])? true:false;
$smarty->assign("saveTrash",$status);

$status = ($prefs["st-only-read"])? true:false;
$smarty->assign("saveTrashOnlyRead",$status);

$status = ($prefs["empty-trash"])? true:false;
$smarty->assign("emptyTrashOnExit",$status);

$status = ($prefs["unmark-read"])? true:false;
$smarty->assign("unmarkReadOnExit",$status);

$status = ($prefs["save-to-sent"])? true:false;
$smarty->assign("saveSent",$status);

$status = ($prefs["display-images"])? true:false;
$smarty->assign("displayImages",$status);

$status = ($prefs["require-receipt"])? true:false;
$smarty->assign("requireReceipt",$status);


// spam options
$status = ($prefs["empty-spam"])? true:false;
$smarty->assign("emptySpamOnExit",$status);

$smarty->assign("spamLevelVals", array(0,1,2,3,4,5,6,7,8,9));
$smarty->assign("spamLevel", $prefs["spamlevel"]);

$smarty->display("$selected_theme/preferences.htm");

?>
