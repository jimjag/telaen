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
    $tid = $auth['tid'];
    $lid = $auth['lid'];
} else {
    if (isset($f_pass) && strlen($f_pass) > 0) {

        if ($allow_user_change_theme) {
            if ($tem != "") {
                if (array_key_exists($tem, $themes) && is_file("themes/$tem")) {
                    $tid = $tem;
                }
            }
        }
        if ($allow_user_change_language) {
            if ($lng != "") {
                if (array_key_exists($lng, $languages) && is_file('langs/'.$lng.'.php')) {
                    $lid = $lng;
                }
            }
        }
        if (isset($auth) && is_array($auth)) {
            $auth['thm_lang_inited'] = true;
            $auth['tid'] = $tid;
            $auth['lid'] = $lid;
        }
    }
}

/********************************************************
Templates
********************************************************/

// Vola on 23/06/06	 I think this are never used... modified for use menu/header/footer in templates

$message_list_template = "themes/$selected_theme/messagelist.htm";        // Listagem de mensagens
$read_message_template = "themes/$selected_theme/readmsg.htm";            // Ler a mensagem
$folder_list_template = "themes/$selected_theme/folders.htm";            // Listagem de pastas
$search_template = "themes/$selected_theme/search.htm";            // Formul·rio/Resultado da busca
$login_template = "themes/$selected_theme/login.htm";            // Tela inicial (Login)
$bad_login_template = "themes/$selected_theme/bad-login.htm";        // Falha de login
$error_template = "themes/$selected_theme/error.htm";            // Erro do sistema
$newmsg_template = "themes/$selected_theme/newmsg.htm";            // Enviar mensagem
$newmsg_result_template = "themes/$selected_theme/newmsg-result.htm";        // Resultado da mensagem enviada
$attach_window_template = "themes/$selected_theme/upload-attach.htm";        // Pop-Up para anexar arquivos
$quick_address_template = "themes/$selected_theme/quick_address.htm";        // Pop-Up de acesso r·pido aos endereÁos
$address_form_template = "themes/$selected_theme/address-form.htm";        // Formul·rio para adicionar/editar os contatos
$address_display_template = "themes/$selected_theme/address-display.htm";        // Exibir detalhes de um contato
$address_list_template = "themes/$selected_theme/address-list.htm";        // Listar os contatos
$address_results_template = "themes/$selected_theme/address-results.htm";        // Resultado das aÁıes tomadas nos contatos (excluir, editar, etc)
$headers_window_template = "themes/$selected_theme/headers-window.htm";        // Janela de cabeÁalhos
$preferences_template = "themes/$selected_theme/preferences.htm";        // Preferencias
$adv_editor_template = "themes/$selected_theme/advanced-editor.htm";        // Advanced HTML Editor
$catch_address_template = "themes/$selected_theme/catch-address.htm";        // Address catcher
$print_message_template = "themes/$selected_theme/print-message.htm";        // Print friendly version

$menu_template = "$selected_theme/menu.htm";            // Menu
$calendar_template = "$selected_theme/calendar.htm";        // Calendar
$news_template = "$selected_theme/news.htm";            // News
$header_template = "$selected_theme/header.htm";            // Page Header
$footer_template = "$selected_theme/footer.htm";            // Page Footer
$popup_header_template = "$selected_theme/popup-header.htm";        // Header for the popup wins


require_once 'langs/'.$selected_language.'.php';
