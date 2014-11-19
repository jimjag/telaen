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

$selected_theme = $tid = $default_theme;
$selected_language = $lid = $default_language;

if (isset($auth) && is_array($auth) && $auth['thm_lang_inited']) {
    $selected_theme = $tid = $auth['tid'];
    $selected_language = $lid = $auth['lid'];
}

if ($allow_user_change_theme && $tem != "") {
    if (array_key_exists($tem, $themes) && is_dir("./themes/$tem")) {
        $selected_theme = $tid = $tem;
    }
}
if ($allow_user_change_language && $lng != "") {
    if (array_key_exists($lng, $languages) && is_file("./langs/{$lng}.php")) {
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

$menu_template = "$selected_theme/menu.htm";            // Menu
$calendar_template = "$selected_theme/calendar.htm";        // Calendar
$news_template = "$selected_theme/news.htm";            // News
$header_template = "$selected_theme/header.htm";            // Page Header
$footer_template = "$selected_theme/footer.htm";            // Page Footer
$popup_header_template = "$selected_theme/popup-header.htm";        // Header for the popup wins


require_once 'langs/'.$selected_language.'.php';
