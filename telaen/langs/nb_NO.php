<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Innboks';
$lang['sent_extended'] = 'Sendte';
$lang['trash_extended'] = 'Slettede';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Forrige';
$lang['next_text'] = 'Neste';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = 'Kontakt ble ikke oppnådd med server';
$lang['error_retrieving'] = 'Problemer oppstod under forsøk på å motta dine beskjeder. Din innboks har blitt endret.';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = 'Systemfeil. Kontakt systemansvarlig.';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Ulovlig navn på katalog - Bruk kun tegnene A-Z, 0-9, .- og eller mellomrom';

// Validations when sending mails
$lang['error_no_recipients'] = 'Det er nødvendig å spesifisere minimum en e-post adresse';
$lang['error_compose_invalid_mail1_s'] = 'Denne e-posten ser ut for å være uleselig';
$lang['error_compose_invalid_mail1_p'] = 'de følgende e-postene ser ut for å være uleselige';
$lang['error_compose_invalid_mail2_s'] = 'Sjekk komposisjon før sending av meldingen';
$lang['error_compose_invalid_mail2_p'] = 'Sjekk komposisjon før sending av meldingene';

// Confirmation of delete
$lang['confirm_delete'] = 'Ønsker du virkelig å slette denne beskjeden?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Ingen tema]';
$lang['no_sender_text'] = '[Sender ukjent]';
$lang['no_recipient_text'] = '[Mottaker ukjent]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Det er ikke plass nok i din innboks til å fullføre denne handlingen\Slett noen meldinger for å fortsette';
$lang['quota_usage_info'] = 'Plassbegrensning';
$lang['quota_usage_used'] = 'Brukt';
$lang['quota_usage_of'] = 'av';
$lang['quota_usage_avail'] = 'tilgjengelig';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Beskjeder (inn)';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Skriv';
$lang['refresh_mnu'] = 'Oppdater';
$lang['folders_mnu'] = 'Mapper';
$lang['search_mnu'] = 'Søk';
$lang['address_mnu'] = 'Adressebok';
$lang['empty_trash_mnu'] = 'Tøm slettede elementer';
$lang['prefs_mnu'] = 'Innstillinger';
$lang['logoff_mnu'] = 'Logg ut';

// Reply
$lang['reply_prefix'] = 'Rv:';
$lang['forward_prefix'] = 'Fv:';
$lang['reply_delimiter'] = '--------- Original melding --------';
$lang['reply_from_hea'] = 'Fra:';
$lang['reply_to_hea'] = 'Til:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Dato:';
$lang['reply_subject_hea'] = 'Tema:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Nøkkel';
$lang['value_hea'] = 'Verdi';

// [Folders]
$lang['fld_name_hea'] = 'Mappe';
$lang['fld_messages_hea'] = 'Beskjeder';
$lang['fld_size_hea'] = 'Størrelse';
$lang['fld_empty_hea'] = 'Tom';
$lang['fld_delete_hea'] = 'Slett';
$lang['fld_total'] = 'Totalt:';
$lang['fld_make_new'] = 'Opprett ny mappe';
$lang['folders_to'] = 'Mapper til';

// [MessageList]
$lang['messages_to'] = 'Beskjeder til ';
$lang['no_messages'] = 'Ingen nye meldinger i din ';
$lang['delete_selected_mnu'] = 'Slett valgte';
$lang['move_selected_mnu'] = 'Flytt valgte til';
$lang['mark_selected_mnu'] = 'Mark as read'; // FIXME: need translation
$lang['unmark_selected_mnu'] = 'Mark as unread'; // FIXME: need translation
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation


$lang['delete_mnu'] = 'Slett';
$lang['move_mnu'] = 'Flytt til';
$lang['subject_hea'] = 'Tema:';
$lang['from_hea'] = 'Fra:';
$lang['to_hea'] = 'Til:';
$lang['date_hea'] = 'Dato:';
$lang['size_hea'] = 'Størrelse';
$lang['have_spam'] = 'You have Spam (check Spam folder)'; // FIXME: need translation

$lang['msg_you_have'] = 'Du har';
$lang['msg_message'] = 'beskjed';
$lang['msg_messages'] = 'beskjeder';

$lang['msg_more_unread'] = 'uleste';
$lang['msg_one_unread'] = 'ulest';
$lang['msg_none_unread'] = 'ingen uleste';
$lang['msg_in_the_folder'] = 'i mappen';


// [Login]
$lang['lgn_title'] = 'Innlogging';
$lang['lgn_welcome_msg'] = 'Velkommen! Vennligst logg deg inn på din konto';
$lang['lng_user_email'] = 'E-post';
$lang['lng_user_name'] = 'Brukernavn';
$lang['lng_user_pwd'] = 'Passord';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Utseende';
$lang['lng_language'] = 'Språk';
$lang['lng_login_btn'] = 'Logg inn &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled'; // FIXME: need translation
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed'; // FIXME: need translation

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail'; // FIXME: need translation

$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Tema:';
$lang['address_tip'] = 'Fra adressebok';

$lang['attach_hea'] = 'Vedlegg:';
$lang['attch_add_new'] = 'Legg ved ny fil';
$lang['attch_name_hea'] = 'Navn';
$lang['attch_size'] = 'Størrelse';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Slett';
$lang['attch_no_hea'] = 'Ingen vedlegg';

$lang['add_signature'] = 'Legg til signatur';
$lang['send_text'] = 'Send';

$lang['result_error'] = 'Det har ikke vært mulig å sende e-posten';
$lang['result_success'] = 'Denne e-posten har blitt sendt uten problemer';
$lang['nav_continue'] = 'Fortsett';
$lang['nav_back'] = 'Tilbake';

$lang['up_title'] = 'Legg til fil';
$lang['up_information_text'] = 'Velg fil';
$lang['up_button_text'] = 'Send';

$lang['require_receipt'] = 'Return receipt'; // FIXME: need translation

$lang['priority_text'] = 'Prioritet';
$lang['priority_low'] = 'Lav';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'Høy';

// [Preferences]
$lang['prf_title'] = 'Innstillinger';
$lang['prf_general_title'] = 'Generell informasjon';
$lang['prf_name'] = 'Navn';
$lang['prf_reply_to'] = 'Svar til';
$lang['prf_time_zone'] = 'Tidssone';
$lang['prf_trash_title'] = 'Søppel';
$lang['prf_save_to_trash'] = 'Når du <b>sletter</b> en beskjed skal den flyttes til ';
$lang['prf_save_only_read'] = 'Lagre bra <b>leste meldinger</b> i ';
$lang['prf_empty_on_exit'] = '<b>Slett</b> mappeinnholdet i slettede elementer når du logger ut';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout'; // FIXME: need translation
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout'; // FIXME: need translation
$lang['prf_sent_title'] = 'Sendte elementer';
$lang['prf_save_sent'] = 'Lagre <b>sendte beskjeder</b> i ';
$lang['prf_messages_title'] = 'Beskjeder';
$lang['prf_page_limit'] = 'Maksimalt antall beskjeder pr side';
$lang['prf_signature_title'] = 'Signatur';
$lang['prf_signature'] = 'Opprett din egen signatur';
$lang['prf_auto_add_sign'] = 'Legg til din signatur til alle utgående beskjeder ';
$lang['prf_save_button'] = 'Lagre';
$lang['prf_display_images'] = 'Vis vedlagte bilder';
$lang['prf_default_editor_mode'] = 'Standard redigeringsmodus';
$lang['prf_default_editor_mode_text'] = '"Tekst"';
$lang['prf_default_editor_mode_html'] = '"Avansert HTML editor (Kun for IE5 eller høyere)"';
$lang['prf_time_to_refesh'] = 'Oppdateringsintervall beskjeder (minutter)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // FIXME: need translation
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation

$lang['prf_msg_saved'] = 'Preferences saved'; // FIXME: need translation

// filters
$lang['filter_title'] = 'Filters'; // FIXME: need translation

$lang['filter_new'] = 'Create a filter'; // FIXME: need translation
$lang['filter_desc'] = 'Choose the search criteria and the action for the incoming messages'; // FIXME: need translation
$lang['filter_list'] = 'Current filters'; // FIXME: need translation

$lang['filter_field_from'] = 'From'; // FIXME: need translation
$lang['filter_field_to'] = 'To'; // FIXME: need translation
$lang['filter_field_subject'] = 'Subject'; // FIXME: need translation
$lang['filter_field_header'] = 'Header'; // FIXME: need translation
$lang['filter_field_body'] = 'Body'; // FIXME: need translation

$lang['filter_type_move'] = 'Move'; // FIXME: need translation
$lang['filter_type_delete'] = 'Delete'; // FIXME: need translation
$lang['filter_type_mark'] = 'Mark read'; // FIXME: need translation

$lang['filter_add'] = 'Add filter'; // FIXME: need translation
$lang['filter_delete'] = 'Delete'; // FIXME: need translation
$lang['filter_delete_selected'] = 'Delete selected filters'; // FIXME: need translation

$lang['filter_field'] = 'Filter on field'; // FIXME: need translation
$lang['filter_match'] = 'Search for'; // FIXME: need translation
$lang['filter_type'] = 'Action'; // FIXME: need translation
$lang['filter_folder'] = 'Destination folder'; // FIXME: need translation

$lang['filter_msg_nofilters'] = 'No filters available.'; // FIXME: need translation
$lang['filter_msg_added'] = 'Filter added'; // FIXME: need translation
$lang['filter_msg_deleted'] = 'Filter deleted'; // FIXME: need translation


// [Catch]
$lang['ctc_title'] = 'Legg til i adressebok';
$lang['ctc_information'] = 'OBS! Bare adresser som ikke allerede er lagret i din adressebok vises.';
$lang['ctc_name'] = 'Navn';
$lang['ctc_email'] = 'E-post';
$lang['ctc_no_address'] = 'Ingen adresse tilgjengelig';
$lang['ctc_close'] = 'Lukk';
$lang['ctc_save'] = 'Lagre';

// [Readmsg]
$lang['next_mnu'] = 'Neste';
$lang['previous_mnu'] = 'Forrige';
$lang['back_mnu'] = 'Tilbake';
$lang['reply_mnu'] = 'Besvar';
$lang['reply_all_mnu'] = 'Besvar til alle';
$lang['forward_mnu'] = 'Videresend';
$lang['headers_mnu'] = 'Heading';
$lang['move_mnu'] = 'Flytt til';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation
$lang['delete_mnu'] = 'Slett';
$lang['print_mnu'] = 'Skriv ut';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'Fra:';
$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Dato:';
$lang['subject_hea'] = 'Tema:';
$lang['attach_hea'] = 'Vedlegg:';

$lang['attch_name_hea'] = 'Navn';
$lang['attch_force_hea'] = 'Last ned';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Størrelse';
$lang['catch_address'] = 'Føy til i adressebok';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Velg en frase eller et ord som du leter etter.<br> Søk i hovedteksten vil kun skje på allerede leste meldinger. ';
$lang['sch_button_text'] = 'Søk &gt;&gt;';
$lang['sch_subject_hea'] = 'Tema';
$lang['sch_from_hea'] = 'Fra';
$lang['sch_date_hea'] = 'Dato';
$lang['sch_body_hea'] = 'Beskjed';
$lang['sch_folder_hea'] = 'Mappe';
$lang['sch_no_results'] = 'Ingen beskjeder har blitt funnet';

// [QuickAddress]
$lang['qad_title'] = 'Adressebok';
$lang['qad_select_address'] = 'Velg en kontakt';
$lang['qad_to'] = 'Til';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adressebok';
$lang['adr_name'] = 'Navn';
$lang['adr_email'] = 'E-post';
$lang['adr_street'] = 'Gate';
$lang['adr_city'] = 'By';
$lang['adr_state'] = 'Stat';
$lang['adr_work'] = 'Arbeid';
$lang['adr_back'] = 'Tilbake';
$lang['adr_save'] = 'Lagre';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Navn';
$lang['adr_email_hea'] = 'E-post';
$lang['adr_edit_hea'] = 'Rediger';
$lang['adr_expo_hea'] = 'Eksporter';
$lang['adr_dele_hea'] = 'Slett';
$lang['adr_new_entry'] = 'Ny kontakt';

$lang['addr_saved'] = 'Kontakten har blitt lagret';
$lang['addr_added'] = 'Kontakten har blitt lagt til';
$lang['addr_deleted'] = 'Kontakten har blitt slettet';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // FIXME: need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available'; // FIXME: need translation
$lang['blk_close'] = 'Close'; // FIXME: need translation
$lang['blk_save'] = 'Save'; // FIXME: need translation

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'Lagre';
$lang['evt_delete'] = 'Slett';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

