<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/
define('I_AM_TELAEN', basename($_SERVER['SCRIPT_NAME']));

// @ini_set('output_buffering',      1024);
// @ob_start();
require './inc/init.php';
/* @var $TLN Telaen */

extract(Telaen::pull_from_array($_GET, array('decision'), 'str'));
extract(Telaen::pull_from_array($_GET, array('refr', 'mlist'), true));
extract(Telaen::pull_from_array($_POST, array('decision', 'aval_folders'), 'str'));
extract(Telaen::pull_from_array($_POST, array('start_pos', 'end_pos'), 1));
extract(Telaen::pull_from_array($_POST, array('back'), true));

$headers = &$tdb->get_headers($folder);
$messagecount = count($headers);

if (!$messagecount
    || isset($decision)
    || isset($refr)
    || isset($mlist)) {

    if (!$TLN->mail_connect()) $TLN->redirect_and_exit('index.php?err=1', true);
    if (!$TLN->mail_auth(true)) $TLN->redirect_and_exit('index.php?err=0');
    $auth['auth'] = true;

    $expunge = false;
    $require_update = false;
    $reg_pp = $TLN->prefs['rpp'];

    if (isset($pag) && isset($mlist) && !isset($start_pos)) {
        $start_pos = ($pag-1)*$reg_pp;
    } else {
        $start_pos = 0;
    }

    if (isset($start_pos) && isset($end_pos)) { // eg: messages.php or readmsg.php
        foreach (keys($_POST) as $key) {
            $matches = array();
            if (preg_match('|msg_(\d+)|', $key, $matches)) {
                $i = intval($matches[1]);
                if ($decision == 'delete') {
                    $TLN->mail_delete_msg($headers[$i], $TLN->prefs['send_to_trash'], $TLN->prefs['st_only_read']);
                    $expunge = true;
                } elseif ($decision == 'move') {
                    $TLN->mail_move_msg($headers[$i], $aval_folders);
                    $expunge = true;
                } elseif ($decision == 'mark') {
                    $TLN->mail_set_flag($headers[$i], '\\SEEN', '+');
                } elseif ($decision == 'unmark') {
                    $TLN->mail_set_flag($headers[$i], '\\SEEN', '-');
                }
            }
        }
        if ($expunge) {
            $TLN->mail_expunge();
        }

        if ($back) {
            $back_to = $start_pos;
        }
    }
    if ($mlist) {
        $TLN->mail_list_msgs($folder, $start_pos, $reg_pp);
        require './apply_filters.php';
    }
    if ($require_update) {
        $TLN->mail_list_msgs($folder, $start_pos, $reg_pp);
    }

    $TLN->mail_disconnect();
}

$auth['havespam'] = ($TLN->havespam || $tdb->count_headers('spam') > 0);
$AuthSession->Save($auth);
$tdb->sync_headers();

/*
 * If they used a different version (ignoring patchlevel) then
 * they really should checkout the preferences page, since
 * they have likely changed.
 *
 * HACK:
 */
$same_version = true;
if ($TLN->prefs['version'] != $appversion) {
    list($their_major, $their_minor, $patch_level) = explode('.', $TLN->prefs['version']);
    list($our_major, $our_minor, $patch_level, $devver) = explode('.', $appversion);
    if (!$devver && (($their_minor != $our_minor) || ($their_major != $our_major))) {
        $same_version = false;
    }
}
if ((!$same_version) ||
    ($TLN->config['check_first_login'] && !$TLN->prefs['first-login'])) {
    $TLN->prefs['first-login'] = 1;
    $TLN->save_prefs($TLN->prefs);
    $TLN->redirect_and_exit('preferences.php?folder='.urlencode($folder));
    exit;
}

if (!isset($pag) || !is_numeric(trim($pag))) {
    $pag = 1;
}
if (isset($back_to)) {
    if (count($headers) > $back_to) {
        $TLN->redirect_and_exit('readmsg.php?folder='.urlencode($folder)."&pag=$pag&ix=$back_to");
    }
}

$refreshurl = 'messages.php?folder='.urlencode($folder)."&pag=$pag";
$TLN->redirect_and_exit("$refreshurl");
