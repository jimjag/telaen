<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/*
 * This module takes care of setting and/or initializing
 * pre-init core aspects of Telaen before main initialization.
 *
 * Why not simply fold into init.php? index.php doesn't require
 * or work if init.php is scarfed in.
 */

defined('I_AM_TELAEN') or die('Direct access not permitted');

require_once './inc/class/class.Telaen.php';
require_once './inc/class/class.MyMonth.php';
require_once './inc/class/class.Session.php';

@set_magic_quotes_runtime(0);            // Smarty and magic_quotes_runtime ON do not mix.

if (version_compare(PHP_VERSION, "5.4.0", "<")) {
    die('PHP version 5.4 and and greater are required');
}
/*
 * "emulate" register_globals ON: These are semi-global
 * vars used by just about all main entry points (see inc/init.php)
 */

extract(Telaen::pull_from_array($_GET, array('pag', 'err', 'ix', 'lng', 'tem'), 1));
extract(Telaen::pull_from_array($_GET, array('folder', 'sortby', 'sortorder'), 's'));
extract(Telaen::pull_from_array($_POST, array('pag', 'six', 'lng', 'tem'), 1));
extract(Telaen::pull_from_array($_POST, array('folder', 'f_email', 'f_user', 'f_pass'), 's'));

/*
 * Clean up user login info
 */
$pag = (abs($pag) ? $pag : 1);
$err = (abs($err) ? $err : 0);
$lng = (abs($lng) ? $lng : 0);
$tem = (abs($tem) ? $tem : 0);
$six = (abs($six) ? $six : 0);
$ix  = (abs($ix)  ? $ix  : 0);
if (isset($folder))
    $folder = urldecode($folder);
else
    $folder = 'inbox';

if (isset($f_email)) {
    $f_email = stripslashes($f_email);
    if (!PHPMailer::validateAddress($f_email)) {
        unset($f_email);
    }
}

if (isset($f_user)) {
    $f_user = stripslashes($f_user);
    if (!PHPMailer::validateAddress("{$f_user}@example.com")) {
        unset($f_user);
    }
}

if (isset($f_pass)) {
    $f_pass = stripslashes($f_pass);
}

$textout = <<<EOF
<!-- Page generated by Telaen (http://jimjag.github.io/telaen/) -->
EOF;

define('FL_TYPE_MOVE',      (1 << 0));
define('FL_TYPE_DELETE',    (1 << 1));
define('FL_TYPE_MARK_READ', (1 << 2));
define('FL_TYPE_SPAM',      (1 << 3));

define('FL_FIELD_FROM',    (1 << 0));
define('FL_FIELD_SUBJECT', (1 << 1));
define('FL_FIELD_TO',      (1 << 2));
define('FL_FIELD_HEADER',  (1 << 3));
define('FL_FIELD_BODY',    (1 << 4));

function extended_name($folder)
{
    global $lang;
    switch ($folder) {
        case 'inbox':
            $boxname = (!empty($lang['inbox_extended']) ? $lang['inbox_extended'] : 'INBOX');
            break;
        case 'sent':
            $boxname = (!empty($lang['sent_extended']) ? $lang['sent_extended'] : 'Sent');
            break;
        case 'trash':
            $boxname = (!empty($lang['trash_extended']) ? $lang['trash_extended'] : 'Trash');
            break;
        case 'spam':
            $boxname = (!empty($lang['spam_extended']) ? $lang['spam_extended'] : 'SPAM folder');
            break;
        case 'drafts':
            $boxname = (!empty($lang['drafts_extended']) ? $lang['drafts_extended'] : 'Drafts');
            break;
        default:
            $boxname = $folder;
            break;
    }
    return $boxname;

}
