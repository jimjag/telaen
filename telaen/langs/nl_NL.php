<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Postvak IN';
$lang['sent_extended'] = 'Verzonden berichten';
$lang['trash_extended'] = 'Prullenbak';
$lang['spam_extended'] = 'Spam';

// Navigation texts
$lang['pages_text'] = 'Pagina\'s';
$lang['first_text'] = 'Eerste';
$lang['previous_text'] = 'Vorige';
$lang['next_text'] = 'Volgende';
$lang['last_text'] = 'Laatste';
$lang['total_text'] = 'Totaal';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'Systeem error';
$lang['error_login'] = 'Controleer gebruikersnaam en wachtwoord en probeer opnieuw';
$lang['error_connect'] = 'De POP3 locatie is onjuist.';
$lang['error_retrieving'] = 'De berichten konden niet opgehaald worden.';
$lang['error_session_expired'] = 'Uw sessie is verlopen, log alsjeblieft opnieuw in.';
$lang['error_other'] = 'Onbekende fout, neem contact op met de webmaster.';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Onjuiste mapnaam - gebruik alleen: \'A t/m Z\', \'0 t/m 9\' en \'-\'.';

// Validations when sending mails
$lang['error_no_recipients'] = 'Typ een adres in het tekstvak Naar.';
$lang['error_compose_invalid_mail1_s'] = 'Het opgegeven e-mailadres is onjuist.';
$lang['error_compose_invalid_mail1_p'] = 'De opgegeven e-mailadressen zijn onjuist.';
$lang['error_compose_invalid_mail2_s'] = 'Controleer het bericht voordat je het verstuurd.';
$lang['error_compose_invalid_mail2_p'] = 'Controleer de berichten voordat je deze verstuurd.';

// Confirmation of delete
$lang['confirm_delete'] = 'Weet je zeker dat je de selectie wilt verwijderen?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '(geen)';
$lang['no_sender_text'] = '(onbekend)';
$lang['no_recipient_text'] = '(onbekend)';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Je hebt geen opslagruimte meer. Maak ruimte vrij door berichten te verwijderen.';
$lang['quota_usage_info'] = 'In gebruik';
$lang['quota_usage_used'] = 'Gebruikt';
$lang['quota_usage_of'] = 'van';
$lang['quota_usage_avail'] = 'beschikbaar';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Postvak IN';
$lang['read_menu'] = 'Lees e-mail';
$lang['compose_mnu'] = 'Opstellen';
$lang['refresh_mnu'] = 'Vernieuwen';
$lang['folders_mnu'] = 'Mappen';
$lang['search_mnu'] = 'Zoeken';
$lang['address_mnu'] = 'Contact-personen';
$lang['empty_trash_mnu'] = 'Prullenbak leegmaken';
$lang['prefs_mnu'] = 'Instellingen';
$lang['logoff_mnu'] = 'Afmelden';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Oorspronkelijk bericht --------';
$lang['reply_from_hea'] = 'Van:';
$lang['reply_to_hea'] = 'Aan:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Datum:';
$lang['reply_subject_hea'] = 'Onderwerp:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Sleutel';
$lang['value_hea'] = 'Waarde';

// [Folders]
$lang['fld_name_hea'] = 'Map';
$lang['fld_messages_hea'] = 'Berichten';
$lang['fld_size_hea'] = 'Grootte';
$lang['fld_empty_hea'] = 'Leegmaken';
$lang['fld_delete_hea'] = 'Verwijderen';
$lang['fld_total'] = 'Totaal:';
$lang['fld_make_new'] = 'Nieuwe map aanmaken';
$lang['folders_to'] = 'Mappen naar';

// [MessageList]
$lang['messages_to'] = 'Berichten ';
$lang['no_messages'] = 'Er zijn geen berichten in de map';
$lang['delete_selected_mnu'] = 'Verwijder';
$lang['move_selected_mnu'] = 'Verplaats naar';
$lang['mark_selected_mnu'] = 'Markeer als gelezen';
$lang['unmark_selected_mnu'] = 'Markeer als ongelezen';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // need translation


$lang['delete_mnu'] = 'Verwijder';
$lang['move_mnu'] = 'Verplaats naar';
$lang['subject_hea'] = 'Onderwerp:';
$lang['from_hea'] = 'Van:';
$lang['to_hea'] = 'Naar:';
$lang['date_hea'] = 'Datum:';
$lang['size_hea'] = 'Grootte';
$lang['have_spam'] = 'Je hebt spam';

$lang['msg_you_have'] = 'Je hebt';
$lang['msg_message'] = 'bericht';
$lang['msg_messages'] = 'berichten';

$lang['msg_more_unread'] = 'ongelezen';
$lang['msg_one_unread'] = 'ongelezen';
$lang['msg_none_unread'] = 'geen ongelezen';
$lang['msg_in_the_folder'] = 'in de map';


// [Login]
$lang['lgn_title'] = 'Aanmelden';
$lang['lgn_welcome_msg'] = 'Welkom, meld je aan op jouw account.';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Gebruikersnaam';
$lang['lng_user_pwd'] = 'Wachtwoord';
$lang['lng_server'] = 'Server'; // need translation
$lang['lng_theme'] = 'Thema';
$lang['lng_language'] = 'Taal';
$lang['lng_login_btn'] = 'Aanmelden';
$lang['lng_cookie_not_enabled'] = 'Cookies moeten geaccepteerd worden';
$lang['lng_cookie_not_valid'] = 'Cookie beveiligingscontrole mislukt';

// [Newmessage]

$lang['newmsg_title'] = 'Nieuw bericht';

$lang['to_hea'] = 'Naar:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Onderwerp:';
$lang['address_tip'] = 'Kiezen uit Contactpersonen';

$lang['attach_hea'] = 'Bijlage:';
$lang['attch_add_new'] = 'Bestand toevoegen';
$lang['attch_name_hea'] = 'Naam';
$lang['attch_size'] = 'Grootte';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Verwijder';
$lang['attch_no_hea'] = 'Geen bijlagen';

$lang['add_signature'] = 'Voeg handtekening toe:';
$lang['send_text'] = 'Verzend';

$lang['result_error'] = 'Foutmelding: het bericht is niet verstuurd.';
$lang['result_success'] = 'Het bericht is succesvol verzonden.';
$lang['nav_continue'] = 'Naar Postvak IN';
$lang['nav_back'] = 'Terug';

$lang['up_title'] = 'Bestand toevoegen';
$lang['up_information_text'] = 'Selecteer bestand';
$lang['up_button_text'] = 'Toevoegen';

$lang['require_receipt'] = 'Verzoek om leesbevestiging';

$lang['priority_text'] = 'Prioriteit';
$lang['priority_low'] = 'Laag';
$lang['priority_normal'] = 'Normaal';
$lang['priority_high'] = 'Hoog';

// [Preferences]
$lang['prf_title'] = 'Instellingen';
$lang['prf_general_title'] = 'Algemene informatie';
$lang['prf_name'] = 'Naam:';
$lang['prf_reply_to'] = 'Antwoordadres:';
$lang['prf_time_zone'] = 'Tijdzone:';
$lang['prf_trash_title'] = 'Prullenbak';
$lang['prf_save_to_trash'] = 'Verplaats een bericht dat <b>verwijderd</b> is automatisch naar de';
$lang['prf_save_only_read'] = 'Bewaar alleen <b>gelezen berichten</b> in de';
$lang['prf_empty_on_exit'] = 'Prullenbak automatisch <b>leegmaken</b> tijdens het afmelden.';
$lang['prf_empty_spam_on_exit'] = 'Spam <b>verwijderen</b> tijdens het afmelden.';
$lang['prf_unmark_read_on_exit'] = 'Gelezen berichten als ongelezen markeren tijdens het afmelden.';
$lang['prf_sent_title'] = 'Verzonden berichten';
$lang['prf_save_sent'] = 'Bewaar <b>verzonden berichten</b> in';
$lang['prf_messages_title'] = 'Berichten';
$lang['prf_page_limit'] = 'Maximaal aantal berichten per pagina:';
$lang['prf_signature_title'] = 'Handtekening';
$lang['prf_signature'] = 'Je handtekening:';
$lang['prf_auto_add_sign'] = 'Voeg handtekening aan alle uitgaande berichten toe.';
$lang['prf_save_button'] = 'Opslaan';
$lang['prf_display_images'] = 'Geef bijgevoegde afbeeldingen weer';
$lang['prf_default_editor_mode'] = 'Plain text/Editor:';
$lang['prf_default_editor_mode_text'] = 'Plain text (simpel)';
$lang['prf_default_editor_mode_html'] = 'Uitgebreide editor (TinyMCE)';
$lang['prf_time_to_refesh'] = 'Vernieuw berichten om de: (aantal minuten)';
$lang['prf_spam_level'] = 'Spam gevoeligheid (0 = uitgeschakeld, 1 = hoogste, 9 = laagste)';
$lang['prf_auto_require_receipt'] = 'Verzoek altijd om leesbevestiging';

$lang['prf_msg_saved'] = 'Voorkeuren opgeslagen';

// filters
$lang['filter_title'] = 'Filters';

$lang['filter_new'] = 'Maak een filter aan';
$lang['filter_desc'] = 'Kies de zoekcriteria en de actie voor binnenkomende berichten';
$lang['filter_list'] = 'Huidige filters';

$lang['filter_field_from'] = 'Van';
$lang['filter_field_to'] = 'Aan';
$lang['filter_field_subject'] = 'Onderwerp';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Verplaats';
$lang['filter_type_delete'] = 'Verwijder';
$lang['filter_type_mark'] = 'Markeer als gelezen';

$lang['filter_add'] = 'Voeg filter toe';
$lang['filter_delete'] = 'Verwijder';
$lang['filter_delete_selected'] = 'Verwijder geselecteerde filters';

$lang['filter_field'] = 'Filter op veld';
$lang['filter_match'] = 'Zoek naar';
$lang['filter_type'] = 'Actie';
$lang['filter_folder'] = 'Doelmap';

$lang['filter_msg_nofilters'] = 'Geen filters beschikbaar.';
$lang['filter_msg_added'] = 'Filter toegevoegd';
$lang['filter_msg_deleted'] = 'Filter verwijderd';


// [Catch]
$lang['ctc_title'] = 'Voeg aan adresboek toe.';
$lang['ctc_information'] = 'Alleen adressen in adresboek tonen.';
$lang['ctc_name'] = 'Naam';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Geen adres beschikbaar';
$lang['ctc_close'] = 'Sluit';
$lang['ctc_save'] = 'Bewaar';

// [Readmsg]
$lang['next_mnu'] = 'Volgende';
$lang['previous_mnu'] = 'Vorige';
$lang['back_mnu'] = 'Terug';
$lang['reply_mnu'] = 'Beantwoorden';
$lang['reply_all_mnu'] = 'Allen beantwoorden';
$lang['forward_mnu'] = 'Doorsturen';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] = 'Verplaats naar';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // need translation
$lang['delete_mnu'] = 'Verwijder';
$lang['print_mnu'] = 'Afdrukweergave';
$lang['download_mnu'] = 'Opslaan';

$lang['from_hea'] = 'Van:';
$lang['to_hea'] = 'Naar:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Datum:';
$lang['subject_hea'] = 'Onderwerp:';
$lang['attach_hea'] = 'Bijlage:';

$lang['attch_name_hea'] = 'Naam';
$lang['attch_force_hea'] = 'Opslaan';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Grootte';
$lang['catch_address'] = 'Aan contactpersonen toevoegen';
$lang['block_address'] = 'Block address'; // need translation

// [Search]
$lang['sch_title'] = 'Zoeken';
$lang['sch_information_text'] = 'Zoek naar een woord of zin in al uw berichten.';
$lang['sch_button_text'] = 'Zoek';
$lang['sch_subject_hea'] = 'Onderwep';
$lang['sch_from_hea'] = 'Afzender';
$lang['sch_date_hea'] = 'Datum';
$lang['sch_body_hea'] = 'Bericht';
$lang['sch_folder_hea'] = 'Map';
$lang['sch_no_results'] = 'Geen berichten gevonden';

// [QuickAddress]
$lang['qad_title'] = 'Contactpersonen';
$lang['qad_select_address'] = 'Selecteer een contactpersoon';
$lang['qad_to'] = 'Aan';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adresboek:';
$lang['adr_name'] = 'Naam:';
$lang['adr_email'] = 'E-mailadres:';
$lang['adr_street'] = 'Adres:';
$lang['adr_city'] = 'Postcode en plaats:';
$lang['adr_state'] = 'Provincie:';
$lang['adr_work'] = 'Werk:';
$lang['adr_back'] = 'Terug';
$lang['adr_save'] = 'Opslaan';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Naam';
$lang['adr_email_hea'] = 'E-mailadres';
$lang['adr_edit_hea'] = 'Bewerken';
$lang['adr_expo_hea'] = 'Exporteer';
$lang['adr_dele_hea'] = 'Verwijder';
$lang['adr_new_entry'] = 'Voeg contactpersoon toe';

$lang['addr_saved'] = 'De veranderingen zijn opgeslagen.';
$lang['addr_added'] = 'De contactpersoon is toegevoegd.';
$lang['addr_deleted'] = 'De contactpersoon is verwijderd.';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // need translation
$lang['blk_email'] = 'E-mail'; // need translation
$lang['blk_no_address'] = 'No address available'; // need translation
$lang['blk_close'] = 'Close'; // need translation
$lang['blk_save'] = 'Save'; // need translation

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'Opslaan';
$lang['evt_delete'] = 'Verwijder';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

