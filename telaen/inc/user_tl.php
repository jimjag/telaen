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

if (isset($sess) && is_array($sess) && $sess['thm_lang_inited']) {
	$tid = $sess['tid'];
	$lid = $sess['lid'];
} else {	
	if(isset($f_pass) && strlen($f_pass) > 0) {

		if($allow_user_change_theme) {
			if($tem != "") $tid = $tem;
			else { $tid = $default_theme; }
		} else
			$tid = $default_theme;

		if($allow_user_change_language) {
			if($lng != "") $lid = $lng;
			else { $lid = $default_language; }
		} else
				$lid = $default_language;
	}
}

if(!is_numeric($tid) || $tid >= count($themes)) $tid = $default_theme;
if(!is_numeric($lid) || $lid >= count($languages)) $lid = $default_language;

if (isset($sess) && is_array($sess)) {
	$sess['thm_lang_inited'] = true;
	$sess['tid'] = $tid;
	$sess['lid'] = $lid;
}

$selected_theme		= $themes[$tid]["path"];
if (!$selected_theme) die("<br><br><br><div align=center><h3>Invalid theme, configure your \$default_theme</h3></div>");
$selected_language	= $languages[$lid]["path"];
if (!$selected_language) die("<br><br><br><div align=center><h3>Invalid language, configure your \$default_language</h3></div>");

/********************************************************
Templates
********************************************************/

// Vola on 23/06/06	 I think this are never used... modified for use menu/header/footer in templates

$message_list_template	   = "themes/$selected_theme/messagelist.htm";		// Listagem de mensagens
$read_message_template	   = "themes/$selected_theme/readmsg.htm";			// Ler a mensagem
$folder_list_template	   = "themes/$selected_theme/folders.htm";			// Listagem de pastas
$search_template		   = "themes/$selected_theme/search.htm";			// Formulário/Resultado da busca
$login_template			   = "themes/$selected_theme/login.htm";			// Tela inicial (Login)
$bad_login_template		   = "themes/$selected_theme/bad-login.htm";		// Falha de login
$error_template			   = "themes/$selected_theme/error.htm";			// Erro do sistema
$newmsg_template		   = "themes/$selected_theme/newmsg.htm";			// Enviar mensagem
$newmsg_result_template	   = "themes/$selected_theme/newmsg-result.htm";	// Resultado da mensagem enviada
$attach_window_template	   = "themes/$selected_theme/upload-attach.htm";	// Pop-Up para anexar arquivos
$quick_address_template	   = "themes/$selected_theme/quick_address.htm";	// Pop-Up de acesso rápido aos endereços
$address_form_template	   = "themes/$selected_theme/address-form.htm";		// Formulário para adicionar/editar os contatos
$address_display_template  = "themes/$selected_theme/address-display.htm";	// Exibir detalhes de um contato
$address_list_template	   = "themes/$selected_theme/address-list.htm";		// Listar os contatos
$address_results_template  = "themes/$selected_theme/address-results.htm";	// Resultado das ações tomadas nos contatos (excluir, editar, etc)
$headers_window_template   = "themes/$selected_theme/headers-window.htm";	// Janela de cabeçalhos
$preferences_template	   = "themes/$selected_theme/preferences.htm";		// Preferencias
$adv_editor_template	   = "themes/$selected_theme/advanced-editor.htm";	// Advanced HTML Editor
$catch_address_template	   = "themes/$selected_theme/catch-address.htm";	// Address catcher
$print_message_template		= "themes/$selected_theme/print-message.htm";	 // Print friendly version

$menu_template			= "$selected_theme/menu.htm";			// Menu
$calendar_template		= "$selected_theme/calendar.htm";		// Calendar
$news_template			= "$selected_theme/news.htm";			// News
$header_template		= "$selected_theme/header.htm";				// Page Header
$footer_template		= "$selected_theme/footer.htm";				// Page Footer
$popup_header_template	= "$selected_theme/popup-header.htm";			// Header for the popup wins


$lg = file("langs/".$selected_language.".txt");

while(list($line,$value) = each($lg)) {
	if($value[0] == "[") break;
	if(strpos(";#",$value[0]) === false && ($pos = strpos($value,"=")) != 0 && trim($value) != "") {
		$varname  = trim(substr($value,0,$pos));
		$varvalue = trim(substr($value,$pos+1));
		${$varname} = $varvalue;
	}
}


?>
