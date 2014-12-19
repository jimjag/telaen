<?php
/*
 * Esperanto (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '% m /% d /% y% H:% M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// User-friendly names to system folders
$lang['inbox_extended'] = 'Envenkesto';
$lang['sent_extended'] = 'Sent erojn';
$lang['trash_extended'] = 'Trash dosierujo';
$lang['spam_extended'] = 'spamo dosierujo';
$lang ['drafts_extended'] = 'Skizoj';

// Navigation texts
$lang['pages_text'] = 'Paĝoj';
$lang['first_text'] = 'Unua';
$lang['previous_text'] = 'Antaŭaj';
$lang['next_text'] = 'Sekva';
$lang['last_text'] = 'Lasta';
$lang['total_text'] = 'Tuta';

// Mail Server Errors
$lang['err_login_msg'] = 'Salutnomo eraro';
$lang['err_system_msg'] = 'Sistemo Eraro';
$lang['error_login'] = 'Bonvolu kontroli vian salutnomon aŭ pasvorton kaj reprovu';
$lang['error_connect'] = 'Eraro konekti al la servilo';
$lang['error_retrieving'] = 'Eraro interesigi viajn mesaĝojn, via Envenkesto ŝanĝis';
$lang['error_session_expired'] = 'Via seanco estas eksvalidiĝis, bonvolu ensaluti denove';
$lang['error_other'] = 'Sistemo fiasko, bonvolu kontakti vian reto administranto';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Malvalida dosierujo nomon - Uzi nur la jenajn signojn AZ, az, 0-9, kaj -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Eraro: vi devas havi almenaŭ unu adresaton!';
$lang['error_compose_invalid_mail1_s'] = 'Eraro: ĉi retpoŝtadreso ŝajnas nevalida';
$lang['error_compose_invalid_mail1_p'] = 'Eraro: Ĉi retadresoj ŝajnas esti nevalida';
$lang['error_compose_invalid_mail2_s'] = 'Kontroli la retpoŝtan adreson antaŭ resendi ĉi retpoŝto.';
$lang['error_compose_invalid_mail2_p'] = 'Kontroli viajn adresojn antaŭ resendi ĉi retpoŝto.';

// Confirmation of delete
$lang['confirm_delete'] = 'Ĉu vi vere volas forigi tiun mesaĝon (j)?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Neniu temo]';
$lang['no_sender_text'] = '[Sender nekonata]';
$lang['no_recipient_text'] = '[Ricevanto nekonata]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Ne sufiĉe spaco en via enirkesto kompletigi tiun agon \ nBonvolu forviŝi kelkajn mesaĝojn daŭrigi';
$lang['quota_usage_info'] = 'Kotizo limon';
$lang['quota_usage_used'] = 'Used';
$lang['quota_usage_of'] = 'de';
$lang['quota_usage_avail'] = 'disponebla';

// Menu
$lang['messages_mnu'] = 'Envenkesto';
$lang['read_menu'] = 'legi E-Poŝto (j)';
$lang['compose_mnu'] = 'Skribu E-Poŝto';
$lang['refresh_mnu'] = 'Ĝisdatigi';
$lang['folders_mnu'] = 'Dosierujoj';
$lang['search_mnu'] = 'Serĉi';
$lang['address_mnu'] = 'Nomo libro';
$lang['empty_trash_mnu'] = 'Malplena rubo';
$lang['prefs_mnu'] = 'Preferoj';
$lang['logoff_mnu'] = 'Elsaluti';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
$lang['reply_from_hea'] = 'De:';
$lang['reply_to_hea'] = 'Al:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Dato:';
$lang['reply_subject_hea'] = 'Titolo:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Ŝlosilo';
$lang['value_hea'] = 'Valoro';

// [Folders]
$lang['fld_name_hea'] = 'Dosierujo';
$lang['fld_messages_hea'] = 'Mesaĝoj';
$lang['fld_size_hea'] = 'Grando';
$lang['fld_empty_hea'] = 'Malplena';
$lang['fld_delete_hea'] = 'Forigi';
$lang['fld_total'] = 'Tuta:';
$lang['fld_make_new'] = 'Krei novan dosierujon';
$lang['folders_to'] = 'Dosierujoj al';

// [MessageList]
$lang['messages_to'] = 'Mesaĝoj al';
$lang['no_messages'] = 'Neniu novaj mesaĝoj en via';
$lang['delete_selected_mnu'] = 'Forigi';
$lang['move_selected_mnu'] = 'Movu al';
$lang['mark_selected_mnu'] = 'Marki kiel legita';
$lang['unmark_selected_mnu'] = 'Marki kiel nelegita';
$lang['move_selected_to_trash_mnu'] = 'Alinomigi forĵeti';


$lang['delete_mnu'] = 'Forigi';
$lang['move_mnu'] = 'Movu al';
$lang['subject_hea'] = 'Titolo:';
$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'Al:';
$lang['date_hea'] = 'Dato:';
$lang['size_hea'] = 'Grando';
$lang['have_spam'] = 'Vi devas spamo (kontrolu spamo dosierujo)';

$lang['msg_you_have'] = 'Vi havas';
$lang['msg_message'] = 'mesaĝo';
$lang['msg_messages'] = 'mesaĝojn';

$lang['msg_more_unread'] = 'nelegita';
$lang['msg_one_unread'] = 'nelegita';
$lang['msg_none_unread'] = 'neniu legi';
$lang['msg_in_the_folder'] = 'en la dosierujo';


// [Login]
$lang['lgn_title'] = 'Salutnomo';
$lang['lgn_welcome_msg'] = 'Bonvenon, bonvolu ensaluti al via konto';
$lang['lng_user_email'] = 'Retpoŝtadreso';
$lang['lng_user_name'] = 'Salutnomo';
$lang['lng_user_pwd'] = 'pasvorto';
$lang['lng_server'] = 'Servilo';
$lang['lng_theme'] = 'Temo';
$lang['lng_language'] = 'Lingvo';
$lang['lng_login_btn'] = 'Salutnomo & gt; & gt;';
$lang['lng_cookie_not_enabled'] = 'Kuketoj devas esti ebligita';
$lang['lng_cookie_not_valid'] = 'Kuketo Sekureca kontrolo malsukcesis';

// [Newmessage]

$lang['newmsg_title'] = 'Verki poŝto';

$lang['to_hea'] = 'Al:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bkk:';
$lang['subject_hea'] = 'Titolo:';
$lang['address_tip'] = 'El adresaron';

$lang['attach_hea'] = 'Kunsendaĵo:';
$lang['attch_add_new'] = 'Aligu nova dosiero';
$lang['attch_name_hea'] = 'Nomo';
$lang['attch_size'] = 'Grando';
$lang['attch_type_hea'] = 'Tipo';
$lang['attch_dele_hea'] = 'Forigi';
$lang['attch_no_hea'] = 'Neniu kunsendaĵojn';

$lang['add_signature'] = 'Aldoni subskribon';
$lang['send_text'] = 'Sendi';

$lang['result_error'] = 'Ne eblis sendi ĉi retmesaĝo';
$lang['result_success'] = 'Tiu ĉi retpoŝtadreso estas sendita';
$lang['nav_continue'] = '& lt; & lt; Daŭri & gt; & gt; ';
$lang['nav_back'] = 'Back';

$lang['up_title'] = 'Aldoni dosieron';
$lang['up_information_text'] = 'Elektu dosieron';
$lang['up_button_text'] = 'Aligu dosieron';

$lang['require_receipt'] = 'Reveni kvitanco';

$lang['priority_text'] = 'Prioritato';
$lang['priority_low'] = 'Malalta';
$lang['priority_normal'] = 'Normala';
$lang['priority_high'] = 'Altaj';

// [Preferences]
$lang['prf_title'] = 'Preferoj';
$lang['prf_general_title'] = 'Ĝeneralaj informoj';
$lang['prf_name'] = 'Nomo';
$lang['prf_reply_to'] = 'Respondu al';
$lang['prf_time_zone'] = 'Tempo zono';
$lang['prf_trash_title'] = 'Rubujen';
$lang['prf_save_to_trash'] = 'Kiam vi <b> forviŝi </ b> mesaĝon, movu ĝin al';
$lang['prf_save_only_read'] = 'Konservi nur <b> legi mesaĝojn </ b> en la';
$lang['prf_empty_on_exit'] = '<b> Malplena </ b> rubo dosierujo kiam adiaŭi';
$lang['prf_empty_spam_on_exit'] = '<b> Malplena </ b> spamo dosierujo kiam adiaŭi';
$lang['prf_unmark_read_on_exit'] = 'Restarigi LEGU mesaĝojn kiel legitaj kiam adiaŭi';
$lang['prf_sent_title'] = 'Sent erojn';
$lang['prf_save_sent'] = 'Konservi <b> senditaj mesaĝojn </ b> en la';
$lang['prf_messages_title'] = 'Mesaĝoj';
$lang['prf_page_limit'] = 'Maksimuma nombro da mesaĝoj por paĝo';
$lang['prf_signature_title'] = 'Subskribo';
$lang['prf_signature'] = 'Skribu vian subskribon';
$lang['prf_auto_add_sign'] = 'Aldoni vian subskribon al cxiuj elirantaj mesaĝoj';
$lang['prf_save_button'] = 'Konservi Agordoj';
$lang['prf_display_images'] = 'Montri alfiksis bildojn';
$lang['prf_default_editor_mode'] = 'Defaŭlta redakti modon';
$lang['prf_default_editor_mode_text'] = '"Plata teksto"';
$lang['prf_default_editor_mode_html'] = '"Altnivelaj HTML redaktoro"';
$lang['prf_time_to_refesh'] = 'Aŭtomate kontroli nova poŝto (minutoj)';
$lang['prf_spam_level'] = 'SPAM sentiveco (0 = Malŝaltita, 1 = Very High, 9 = tre malalta)';
$lang['prf_auto_require_receipt'] = 'Postulu legi kvitanco defaŭlte';
$lang['prf_keep_on_server'] = 'Konservu retpoŝto sur servilo - neniu lokaj dosierujoj';

$lang['prf_msg_saved'] = 'Preferoj savitaj';

// filters
$lang['filter_title'] = 'Filtriloj';

$lang['filter_new'] = 'Krei filtrilon';
$lang['filter_desc'] = 'Elektu la serĉo kriterioj kaj la agadon por la venontaj mesaĝojn';
$lang['filter_list'] = 'Aktuala filtriloj';

$lang['filter_field_from'] = 'El';
$lang['filter_field_to'] = 'Por';
$lang['filter_field_subject'] = 'Subjekto';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Korpo';

$lang['filter_type_move'] = 'Alinomigi';
$lang['filter_type_delete'] = 'Forigi';
$lang['filter_type_mark'] = 'Mark legi';

$lang['filter_add'] = 'Aldoni filtrilon';
$lang['filter_delete'] = 'Forigi';
$lang['filter_delete_selected'] = 'Forviŝu elektitaj filtriloj';

$lang['filter_field'] = 'Filtrilo sur kampo';
$lang['filter_match'] = 'Serĉu';
$lang['filter_type'] = 'Ago';
$lang['filter_folder'] = 'Celleterujo';

$lang['filter_msg_nofilters'] = 'Neniu filtriloj havebla.';
$lang['filter_msg_added'] = 'Filtrilo aldonita';
$lang['filter_msg_deleted'] = 'Filtrilo forviŝita';


// [Catch]
$lang['ctc_title'] = 'Aldoni al adreslibro';
$lang['ctc_information'] = 'Nur montras retmesaĝoj kiuj ne aperas en la adreslibro';
$lang['ctc_name'] = 'Nomo';
$lang['ctc_email'] = 'Retpoŝtadreso';
$lang['ctc_no_address'] = 'Neniu adreso havebla';
$lang['ctc_close'] = 'Fermu';
$lang['ctc_save'] = 'Konservi';

// [Readmsg]
$lang['next_mnu'] = 'Sekva';
$lang['previous_mnu'] = 'Antaŭaj';
$lang['back_mnu'] = 'Back';
$lang['reply_mnu'] = 'Respondu';
$lang['reply_all_mnu'] = 'Respondu al ĉiuj';
$lang['forward_mnu'] = 'Antaŭen';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] = 'Movu al';
$lang['move_to_trash_mnu'] = 'Alinomigi forĵeti';
$lang['delete_mnu'] = 'Forigi';
$lang['print_mnu'] = 'Presi';
$lang['download_mnu'] = 'Elŝuti';

$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'Al:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Dato:';
$lang['subject_hea'] = 'Titolo:';
$lang['attach_hea'] = 'Kunsendaĵo:';

$lang['attch_name_hea'] = 'Nomo';
$lang['attch_force_hea'] = 'Elŝuti';
$lang['attch_type_hea'] = 'Tipo';
$lang['attch_size_hea'] = 'Grando';
$lang['catch_address'] = 'Aldoni al adreslibro';
$lang['block_address'] = 'Bloki adreso';

// [Search]
$lang['sch_title'] = 'Serĉi';
$lang['sch_information_text'] = 'Skribu frazon aŭ vorton kiun vi serĉas. <br> Nur legi mesaĝojn estos traserĉata.';
$lang['sch_button_text'] = 'Serĉi & gt; & gt;';
$lang['sch_subject_hea'] = 'Subjekto';
$lang['sch_from_hea'] = 'El';
$lang['sch_date_hea'] = 'Dato';
$lang['sch_body_hea'] = 'Mesaĝo Korpo';
$lang['sch_folder_hea'] = 'Dosierujo';
$lang['sch_no_results'] = 'Neniu mesaĝo kongruas via kriterioj trovis';

// [QuickAddress]
$lang['qad_title'] = 'Nomo libro';
$lang['qad_select_address'] = 'Elektu kontakton';
$lang['qad_to'] = 'Por';
$lang['qad_cc'] = 'PD';
$lang['qad_bcc'] = 'Bkk';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Nomo libro';
$lang['adr_name'] = 'Nomo';
$lang['adr_email'] = 'Retpoŝtadreso';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'Urbo';
$lang['adr_state'] = 'ŝtato';
$lang['adr_work'] = 'Laboro';
$lang['adr_back'] = 'Back';
$lang['adr_save'] = 'Konservi';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notoj';

// list
$lang['adr_name_hea'] = 'Nomo';
$lang['adr_email_hea'] = 'Retpoŝtadreso';
$lang['adr_edit_hea'] = 'Redakti';
$lang['adr_expo_hea'] = 'Eksporti';
$lang['adr_dele_hea'] = 'Forigi';
$lang['adr_new_entry'] = 'Novaj kontakto';

$lang['addr_saved'] = 'La kontakto estas konservita';
$lang['addr_added'] = 'La kontakto estis aldonita';
$lang['addr_deleted'] = 'La kontakto estis forigita';


// [BlockSender]
$lang['blk_title'] = 'Bloki sendinto';
$lang['blk_information'] = 'Nur montras retmesaĝoj kiuj ne estas en la filtrilo ankoraŭ';
$lang['blk_email'] = 'Retpoŝtadreso';
$lang['blk_no_address'] = 'Neniu adreso havebla';
$lang['blk_close'] = 'Fermu';
$lang['blk_save'] = 'Konservi';

// [Event]
$lang['evt_title'] = 'Kalendaro Eventa';
$lang['evt_save'] = 'Konservi';
$lang['evt_delete'] = 'Forigi';
$lang['evt_stop'] = 'Ĉesu tempo';
$lang['evt_start'] = 'Kreu tempo';

