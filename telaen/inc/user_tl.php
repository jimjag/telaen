<?php
/************************************************************************
Telaen is a GPL'ed software developed by

 - The Telaen Group
 - http://jimjag.github.io/telaen/

*************************************************************************/

/*
 * This module takes care of setting and/or initializing
 * the user's language and template prefs
 */

defined('I_AM_TELAEN') or die('Direct access not permitted');

$themez = $tid = $TLN->config['default_theme'];
$langz = $lid = $TLN->config['default_language'];

if (isset($auth) && is_array($auth) && $auth['thm_lang_inited']) {
    $themez = $tid = $auth['tid'];
    $langz = $lid = $auth['lid'];
}

if ($TLN->config['allow_user_change_theme'] && isset($tem) && $tem != "") {
    if (isset($TLN->config['themes'][$tem]) && is_dir("./inc/themes/$tem")) {
        $themez = $tid = $tem;
    }
}
if ($TLN->config['allow_user_change_language'] && isset($lng) && $lng != "") {
    if (isset($TLN->config['languages'][$lng]) && is_file("./inc/langs/{$lng}.php")) {
        $langz = $lid = $lng;
    }
}
if (isset($auth) && is_array($auth)) {
    $auth['thm_lang_inited'] = true;
    $auth['tid'] = $tid;
    $auth['lid'] = $lid;
}


/********************************************************
Templates
********************************************************/

$menu_template = "$themez/menu.tpl";
$calendar_template = "$themez/calendar.tpl";
$news_template = "$themez/news.tpl";
$header_template = "$themez/header.tpl";
$footer_template = "$themez/footer.tpl";
$popup_header_template = "$themez/popup-header.tpl";

// Pull in correct $lang[] array for select language
require_once 'langs/'.$langz.'.php';
