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

$selected_theme = $tid = $TLN->config['default_theme'];
$selected_language = $lid = $TLN->config['default_language'];

if (isset($auth) && is_array($auth) && $auth['thm_lang_inited']) {
    $selected_theme = $tid = $auth['tid'];
    $selected_language = $lid = $auth['lid'];
}

if ($TLN->config['allow_user_change_theme'] && isset($tem) && $tem != "") {
    if (array_key_exists($tem, $TLN->config['themes']) && is_dir("./inc/themes/$tem")) {
        $selected_theme = $tid = $tem;
    }
}
if ($TLN->config['allow_user_change_language'] && isset($lng) && $lng != "") {
    if (array_key_exists($lng, $TLN->config['languages']) && is_file("./inc/langs/{$lng}.php")) {
        $selected_language = $lid = $lng;
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

$menu_template = "$selected_theme/menu.tpl";
$calendar_template = "$selected_theme/calendar.tpl";
$news_template = "$selected_theme/news.tpl";
$header_template = "$selected_theme/header.tpl";
$footer_template = "$selected_theme/footer.tpl";
$popup_header_template = "$selected_theme/popup-header.tpl";

// Pull in correct $lang[] array for select language
require_once 'langs/'.$selected_language.'.php';
