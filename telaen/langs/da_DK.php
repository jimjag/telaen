<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Indbakke';
$lang['sent_extended'] = 'Sendte beskeder';
$lang['trash_extended'] = 'Papirkurv';
$lang['spam_extended'] = 'mappe Spam';

// Navigation texts
$lang['pages_text'] = 'Sider';
$lang['first_text'] = 'først';
$lang['previous_text'] = 'Forrige';
$lang['next_text'] = 'Næste';
$lang['last_text'] = 'Sidste';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login fejl';
$lang['err_system_msg'] = 'Systemfejl';
$lang['error_login'] = 'Tjek venligst dit brugernavn eller password, og prøv igen';
$lang['error_connect'] = 'Fejl ved forbindelse til serveren';
$lang['error_retrieving'] = 'Fejl ved hentning af dine beskeder, er din indbakke ændret';
$lang['error_session_expired'] = 'Din session er udløbet, skal du logge ind igen';
$lang['error_other'] = 'System fejl, skal du kontakte din netværksadministrator';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Ugyldig mappe Name - Brug kun følgende tegn AZ, az, 0-9, og -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Fejl: Du skal have mindst én modtager';
$lang['error_compose_invalid_mail1_s'] = 'Fejl: Denne e-mailadresse synes at være ugyldig';
$lang['error_compose_invalid_mail1_p'] = 'Fejl: Denne e-mail-adresser ser ud til at være ugyldig';
$lang['error_compose_invalid_mail2_s'] = 'Kontroller e-mail-adresse, før gensende denne e-mail.';
$lang['error_compose_invalid_mail2_p'] = 'Tjek dine adresser før gensende denne e-mail.';

// Confirmation of delete
$lang['confirm_delete'] = '? Vil du virkelig slette denne besked (s)';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Intet emne]';
$lang['no_sender_text'] = '[Afsender ukendt]';
$lang['no_recipient_text'] = '[Modtager ukendt]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Ikke nok plads i din indbakke for at fuldføre denne handling \ nVenligst slette nogle beskeder for at fortsætte';
$lang['quota_usage_info'] = 'kvote';
$lang['quota_usage_used'] = 'brugt';
$lang['quota_usage_of'] = 'af';
$lang['quota_usage_avail'] = 'til rådighed';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Indbakke';
$lang['read_menu'] = 'Læs E-Mail (s)';
$lang['compose_mnu'] = 'Skriv E-mail';
$lang['refresh_mnu'] = 'Opdater';
$lang['folders_mnu'] = 'Mapper';
$lang['search_mnu'] = 'Søg';
$lang['address_mnu'] = 'Adresse bog';
$lang['empty_trash_mnu'] = 'Tøm papirkurv';
$lang['prefs_mnu'] = 'Indstillinger';
$lang['logoff_mnu'] = 'Log ud';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
$lang['reply_from_hea'] = 'Fra:';
$lang['reply_to_hea'] = 'Til:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Dato:';
$lang['reply_subject_hea'] = 'Emne:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'nøgle';
$lang['value_hea'] = 'værdi';

// [Folders]
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'meddelelser';
$lang['fld_size_hea'] = 'Størrelse';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Slet';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'Opret ny mappe';
$lang['folders_to'] = 'mapper til';

// [MessageList]
$lang['messages_to'] = 'Meddelelser til';
$lang['no_messages'] = 'Ingen nye beskeder i din';
$lang['delete_selected_mnu'] = 'Slet';
$lang['move_selected_mnu'] = 'Flyt til';
$lang['mark_selected_mnu'] = 'Marker som læst';
$lang['unmark_selected_mnu'] = 'Marker som ulæst';
$lang['move_selected_to_trash_mnu'] = 'Flyt til papirkurven';


$lang['delete_mnu'] = 'Slet';
$lang['move_mnu'] = 'Flyt til';
$lang['subject_hea'] = 'Emne:';
$lang['from_hea'] = 'Fra:';
$lang['to_hea'] = 'Til:';
$lang['date_hea'] = 'Dato:';
$lang['size_hea'] = 'Størrelse';
$lang['have_spam'] = 'Du har Spam (tjek spam mappe)';

$lang['msg_you_have'] = 'Du har';
$lang['msg_message'] = 'beskeden';
$lang['msg_messages'] = 'meddelelser';

$lang['msg_more_unread'] = 'ulæste';
$lang['msg_one_unread'] = 'ulæste';
$lang['msg_none_unread'] = 'none at læse';
$lang['msg_in_the_folder'] = 'i mappen';


// [Login]
$lang['lgn_title'] = 'Login';
$lang['lgn_welcome_msg'] = 'Velkommen, bedes du logge ind på din konto';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Brugernavn';
$lang['lng_user_pwd'] = 'Password';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Login &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies skal være aktiveret';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check mislykkedes';

// [Newmessage]

$lang['newmsg_title'] = 'Skriv e-mail';

$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Emne:';
$lang['address_tip'] = 'Fra adressebogen';

$lang['attach_hea'] = 'Vedhæftet:';
$lang['attch_add_new'] = 'Vedhæft ny fil';
$lang['attch_name_hea'] = 'navn';
$lang['attch_size'] = 'Størrelse';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Slet';
$lang['attch_no_hea'] = 'Ingen vedhæftning';

$lang['add_signature'] = 'Tilføj underskrift';
$lang['send_text'] = 'Send';

$lang['result_error'] = 'Det var ikke muligt at sende denne e-mail';
$lang['result_success'] = 'Denne e-mail er blevet sendt';
$lang['nav_continue'] = '&lt;&lt; Fortsæt &gt;&gt;';
$lang['nav_back'] = 'Tilbage';

$lang['up_title'] = 'Tilføj filen';
$lang['up_information_text'] = 'Vælg fil';
$lang['up_button_text'] = 'Vedhæft fil';

$lang['require_receipt'] = 'Return kvittering';

$lang['priority_text'] = 'Prioritet';
$lang['priority_low'] = 'Lav';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'Høj';

// [Preferences]
$lang['prf_title'] = 'Indstillinger';
$lang['prf_general_title'] = 'Generelle oplysninger';
$lang['prf_name'] = 'navn';
$lang['prf_reply_to'] = 'Besvar';
$lang['prf_time_zone'] = 'Time zone';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Når du <b> slette </ b> en besked, skal du flytte den til';
$lang['prf_save_only_read'] = 'Gem kun <b> læse beskeder </ b> i';
$lang['prf_empty_on_exit'] = '<b> Tøm </ b> papirkurven mappe, når du logger af';
$lang['prf_empty_spam_on_exit'] = '<b> Tøm </ b> Spam-mappe, når du logger af';
$lang['prf_unmark_read_on_exit'] = 'Nulstil læse meddelelser som ulæst når du logger';
$lang['prf_sent_title'] = 'Sendte beskeder';
$lang['prf_save_sent'] = 'Gem <b> sendte beskeder </ b> i';
$lang['prf_messages_title'] = 'meddelelser';
$lang['prf_page_limit'] = 'Maksimalt antal beskeder per side';
$lang['prf_signature_title'] = 'signatur';
$lang['prf_signature'] = 'Skriv din underskrift';
$lang['prf_auto_add_sign'] = 'Tilføj din signatur til alle udgående meddelelser';
$lang['prf_save_button'] = 'Gem indstillinger';
$lang['prf_display_images'] = 'Vis vedhæftede billeder';
$lang['prf_default_editor_mode'] = 'Standard redigeringstilstand';
$lang['prf_default_editor_mode_text'] = '"Plain text"';
$lang['prf_default_editor_mode_html'] = '"Avanceret HTML editor"';
$lang['prf_time_to_refesh'] = 'Se automatisk efter ny post (minutter)';
$lang['prf_spam_level'] = 'SPAM følsomhed (0 = Deaktiveret, 1 = Very High, 9 = Meget lav)';
$lang['prf_auto_require_receipt'] = 'Kræv læst kvittering som standard';

$lang['prf_msg_saved'] = 'Indstillinger gemt!';

// filters
$lang['filter_title'] = 'Filtre';

$lang['filter_new'] = 'Opret et filter';
$lang['filter_desc'] = 'Vælg søgekriterier og handlingen for indgående beskeder';
$lang['filter_list'] = 'Nuværende filtre';

$lang['filter_field_from'] = 'From';
$lang['filter_field_to'] = 'Til';
$lang['filter_field_subject'] = 'Emne';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Krop';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Slet';
$lang['filter_type_mark'] = 'Mark med';

$lang['filter_add'] = 'Tilføj filter';
$lang['filter_delete'] = 'Slet';
$lang['filter_delete_selected'] = 'Slet valgte filtre';

$lang['filter_field'] = 'Filter på marken';
$lang['filter_match'] = 'Søg efter';
$lang['filter_type'] = 'handling';
$lang['filter_folder'] = 'Destination folder';

$lang['filter_msg_nofilters'] = 'Ingen filtre til rådighed.';
$lang['filter_msg_added'] = 'Filter tilføjet';
$lang['filter_msg_deleted'] = 'Filter slettet';


// [Catch]
$lang['ctc_title'] = 'Tilføj til adressebog';
$lang['ctc_information'] = 'viser kun e-mails, der ikke er i adressebogen';
$lang['ctc_name'] = 'navn';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Ingen adresse til rådighed';
$lang['ctc_close'] = 'Luk';
$lang['ctc_save'] = 'Gem';

// [Readmsg]
$lang['next_mnu'] = 'Næste';
$lang['previous_mnu'] = 'Forrige';
$lang['back_mnu'] = 'Tilbage';
$lang['reply_mnu'] = 'svar';
$lang['reply_all_mnu'] = 'Svar til alle';
$lang['forward_mnu'] = 'Forward';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] = 'Flyt til';
$lang['move_to_trash_mnu'] = 'Flyt til papirkurven';
$lang['delete_mnu'] = 'Slet';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'download';

$lang['from_hea'] = 'Fra:';
$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Dato:';
$lang['subject_hea'] = 'Emne:';
$lang['attach_hea'] = 'Vedhæftet:';

$lang['attch_name_hea'] = 'navn';
$lang['attch_force_hea'] = 'download';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Størrelse';
$lang['catch_address'] = 'Tilføj til adressebog';
$lang['block_address'] = 'Bloker adresse';

// [Search]
$lang['sch_title'] = 'Søg';
$lang['sch_information_text'] = '.. Skriv en sætning eller et ord, du er på udkig efter <br> kun læse beskeder vil blive søgt';
$lang['sch_button_text'] = 'Søg &gt;&gt;';
$lang['sch_subject_hea'] = 'Emne';
$lang['sch_from_hea'] = 'From';
$lang['sch_date_hea'] = 'Date';
$lang['sch_body_hea'] = 'Message organ';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Ingen beskeder der matcher dine kriterier er blevet fundet';

// [QuickAddress]
$lang['qad_title'] = 'Adresse bog';
$lang['qad_select_address'] = 'Vælg en kontakt';
$lang['qad_to'] = 'Til';
$lang['qad_cc'] = 'CC';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adresse bog';
$lang['adr_name'] = 'navn';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'by';
$lang['adr_state'] = 'stat';
$lang['adr_work'] = 'arbejde';
$lang['adr_back'] = 'Tilbage';
$lang['adr_save'] = 'Gem';
$lang['adr_phone'] = 'telefon';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'navn';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Rediger';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Slet';
$lang['adr_new_entry'] = 'Ny kontakt';

$lang['addr_saved'] = 'Kontakten er blevet gemt';
$lang['addr_added'] = 'Kontakten er tilføjet';
$lang['addr_deleted'] = 'Kontakten er blevet slettet';


// [BlockSender]
$lang['blk_title'] = 'Bloker afsender';
$lang['blk_information'] = 'viser kun e-mails, der ikke er i filteret endnu';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Ingen adresse til rådighed';
$lang['blk_close'] = 'Luk';
$lang['blk_save'] = 'Gem';

// [Event]
$lang['evt_title'] = 'kalender Begivenhed';
$lang['evt_save'] = 'Gem';
$lang['evt_delete'] = 'Slet';
$lang['evt_stop'] = 'Stop tid';
$lang['evt_start'] = 'Start tid';

