<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

require './inc/init.php';
/* @var $TLN Telaen */

// assign metas
$smarty->assign('pageMetas', $pmetas);

eval('$jssource = "' . $commonJS . '";');
$jssource .= "
<script type='text/javascript'>
//<![CDATA[
function dis() {
	var f = $('prefs_form');
	f.st_only_read.disabled = !f.save_trash.checked;
	if(f.st_only_read.checked) {
		f.st_only_read.checked = f.save_trash.checked;
	}
}
//]]>
</script>
";

$smarty->assign('umJS', $jssource);

// load filters
$filename = $TLN->userdatafolder.'/filters.ucf';
$myfile = $TLN->read_file($filename);
$filters = array();

if ($myfile != "") {
    $filters = unserialize(base64_decode($myfile));
}

// we have to do something...
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {

    case 'savePrefs':
        // pick the new settings and save
        $myprefs['real-name'] = htmlspecialchars($_POST['real_name']);
        $myprefs['reply-to'] = htmlspecialchars($_POST['reply_to']);
        $myprefs['send_to_trash'] = (boolean)$_POST['save_trash'];
        $myprefs['st_only_read'] = (boolean)$_POST['st_only_read'];
        $myprefs['empty_trash'] = (boolean)$_POST['empty_trash_on_exit'];
        $myprefs['empty_spam'] = (boolean)$_POST['empty_spam_on_exit'];
        $myprefs['unmark_read'] = (boolean)$_POST['unmark_read_on_exit'];
        $myprefs['save_to_sent'] = (boolean)$_POST['save_sent'];
        $myprefs['rpp'] = intval($_POST['rpp']);
        $myprefs['add_signature'] = (boolean)$_POST['add_sig'];
        $myprefs['signature'] = htmlspecialchars($_POST['sig']);
        $myprefs['timezone'] = intval($_POST['timezone']);
        $myprefs['display_images'] = (boolean)$_POST['display_images'];
        $myprefs['editor_mode'] = ($_POST['editor_mode'] == "text" ? "text" : "html");
        $myprefs['refresh_time'] = intval($_POST['refresh_time']);
        if ($myprefs['refresh_time'] < 5) $myprefs['refresh_time'] = 5;
        $myprefs['first-login'] = 1;
        $myprefs['spamlevel'] = intval($_POST['spamlevel']);
        $myprefs['require_receipt'] = (boolean)$_POST['require_receipt'];
        $myprefs['version'] = $TLN->appversion;
        $TLN->save_prefs($myprefs);
        unset($myprefs);

        $smarty->assign('message', '1');

        break;

    case 'addFilter':
        // check for params
        if (!isset($_POST['filter_type']) ||
            !isset($_POST['filter_field']) ||
            !isset($_POST['filter_match']) ||
            !isset($_POST['filter_folder'])) {
            break;
        }

        // set the folder only for move
        $destFolder = "";
        if (intval($_POST['filter_type']) == FL_TYPE_MOVE) {
            $destFolder = trim($_POST['filter_folder']);
            // Check if the user entered a valid folder
            if (empty($TLN->tdb->folders[$destFolder])) {
                break;
            }
        }

        // the matching string must not be empty
        $match = trim($_POST['filter_match']);
        if ($match == "") {
            break;
        }

        // add the filter
        $newFilter =  array(
            'type' => intval($_POST['filter_type']),
            'field' => intval($_POST['filter_field']),
            'match' => $match,
            'moveto' => $destFolder,
        );
        array_push($filters, $newFilter);

        // save the file
        $content = base64_encode(serialize($filters));
        $TLN->save_file($filename, $content);

        $smarty->assign('message', '4');

                    break;

    case 'delFilter':

        if (!isset($_POST['filters_array'])) {
            // nothing to delete
            break;
        }

        $delArray = $_POST['filters_array'];

        $newFilters = array();
        for ($i = 0; $i<count($filters); $i++) {
            if (!in_array(strval($i), $delArray)) {
                array_push($newFilters, $filters[$i]);
            }
        }

        $filters = $newFilters;

        // save the file
        $content = base64_encode(serialize($filters));
        $TLN->save_file($filename, $content);

        $smarty->assign('message', '5');

                    break;
    }
}

$smarty->assign('filterList', $filters);

// load prefs
$TLN->load_prefs();

// name & reply to
$smarty->assign('realName', $TLN->prefs['real-name']);
$smarty->assign('replyTo', $TLN->prefs['reply-to']);

// timezones
$gmttime = time()-date('Z');

$timeVals = array();
for ($i = -12; $i <= 12; $i = $i+0.5) {
    $nowgmt = $gmttime + $i*3600;
    $operator = ($i < 0) ? '-' : '+';
    $z = abs($i);
    $diff = $operator.sprintf('%02d', intval($z)).sprintf('%02d', ($z-intval($z))*60);
    $timeVals[$diff] = 'GMT '.$diff." (".date('h:i A', $nowgmt).")";
}

$smarty->assign('timezone', $TLN->prefs['timezone']);
$smarty->assign('timezoneVals', $timeVals);

// editor mode
$smarty->assign('editorMode', $TLN->prefs['editor_mode']);

// records per page
$smarty->assign('msgPerPage', $TLN->prefs['rpp']);
$smarty->assign('msgPerPageVals', array(10, 20, 30, 40, 50, 100, 200));

// refresh time
$smarty->assign('refreshTime', $TLN->prefs['refresh_time']);
$smarty->assign('refreshTimeVals', array(5, 10, 15, 20, 25));

// signature
$status = ($TLN->prefs['add_signature']) ? true : false;
$smarty->assign('addSignature', $status);

$txtsignature = htmlspecialchars($TLN->prefs['signature']);
$smarty->assign('signature', $txtsignature);

// misc
$status = ($TLN->prefs['send_to_trash']) ? true : false;
$smarty->assign('saveTrash', $status);

$status = ($TLN->prefs['st_only_read']) ? true : false;
$smarty->assign('saveTrashOnlyRead', $status);

$status = ($TLN->prefs['empty_trash']) ? true : false;
$smarty->assign('emptyTrashOnExit', $status);

$status = ($TLN->prefs['unmark_read']) ? true : false;
$smarty->assign('unmarkReadOnExit', $status);

$status = ($TLN->prefs['save_to_sent']) ? true : false;
$smarty->assign('saveSent', $status);

$status = ($TLN->prefs['display_images']) ? true : false;
$smarty->assign('displayImages', $status);

$status = ($TLN->prefs['require_receipt']) ? true : false;
$smarty->assign('requireReceipt', $status);

// spam options
$status = ($TLN->prefs['empty_spam']) ? true : false;
$smarty->assign('emptySpamOnExit', $status);

$smarty->assign('spamLevelVals', array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9));
$smarty->assign('spamLevel', $TLN->prefs['spamlevel']);

$smarty->display("$themez/preferences.tpl");
