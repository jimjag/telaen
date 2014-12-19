<?php
/*
 * Afrikaans (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// User-friendly names to system folders
$lang['inbox_extended'] = 'Boks';
$lang['sent_extended'] = 'Stuur vir items';
$lang['trash_extended'] = 'asblik';
$lang['spam_extended'] = 'Spam gids';
$lang['drafts_extended'] = 'konsep';

// Navigation texts
$lang['pages_text'] = 'Bladsye';
$lang['first_text'] = 'eerste';
$lang['previous_text'] = 'Vorige';
$lang['next_text'] = 'Volgende';
$lang['last_text'] = 'Laaste';
$lang['total_text'] = 'Totale';

// Mail Server Errors
$lang['err_login_msg'] = 'Teken fout';
$lang['err_system_msg'] = 'System fout';
$lang['error_login'] = 'Gaan asseblief jou gebruikersnaam en wagwoord en probeer weer';
$lang['error_connect'] = 'Fout verbinding met die bediener se';
$lang['error_retrieving'] = 'Fout om jou boodskappe, jou Inbox verander';
$lang['error_session_expired'] = 'Jou sessie verstryk het, meld asseblief weer';
$lang['error_other'] = 'System mislukking, kontak asseblief u netwerk administrateur';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Ongeldige naam gids - Gebruik slegs die volgende karakters AZ, az, 0-9, en -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Fout: Jy moet ten minste een ontvanger';
$lang['error_compose_invalid_mail1_s'] = 'Fout: Hierdie e-pos adres blyk ongeldig wees';
$lang['error_compose_invalid_mail1_p'] = 'Fout: Hierdie e-pos adresse lyk ongeldig wees';
$lang['error_compose_invalid_mail2_s'] = 'Gaan die e-posadres voordat weer in hierdie e-pos.';
$lang['error_compose_invalid_mail2_p'] = 'Gaan jou adresse voordat weer in hierdie e-pos.';

// Confirmation of delete
$lang['confirm_delete'] = '? Wil jy regtig hierdie boodskap (s) te verwyder';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Geen onderwerp]';
$lang['no_sender_text'] = '[Sender onbekend]';
$lang['no_recipient_text'] = '[Ontvanger onbekend]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Nie genoeg ruimte in jou posbus hierdie aksie te voltooi \nDe verwyder \'n paar boodskappe om voort te gaan';
$lang['quota_usage_info'] = 'kwota limiet';
$lang['quota_usage_used'] = 'Gebruik';
$lang['quota_usage_of'] = 'van';
$lang['quota_usage_avail'] = 'beskikbaar';

// Menu
$lang['messages_mnu'] = 'Boks';
$lang['read_menu'] = 'Lees E-pos (s)';
$lang['compose_mnu'] = 'Skryf E-pos';
$lang['refresh_mnu'] = 'Herlaai';
$lang['folders_mnu'] = 'dopgehou';
$lang['search_mnu'] = 'Soek';
$lang['address_mnu'] = 'adresboek';
$lang['empty_trash_mnu'] = 'Leë asblik';
$lang['prefs_mnu'] = 'Voorkeure';
$lang['logoff_mnu'] = 'Teken uit';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
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
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'boodskappe';
$lang['fld_size_hea'] = 'Grootte';
$lang['fld_empty_hea'] = 'leë';
$lang['fld_delete_hea'] = 'Verwyder';
$lang['fld_total'] = 'Totaal:';
$lang['fld_make_new'] = 'Skep nuwe gids';
$lang['folders_to'] = 'dopgehou';

// [MessageList]
$lang['messages_to'] = 'boodskappe aan';
$lang['no_messages'] = 'Geen nuwe boodskappe in jou';
$lang['delete_selected_mnu'] = 'Verwyder';
$lang['move_selected_mnu'] = 'skuif na';
$lang['mark_selected_mnu'] = 'Merk as gelees';
$lang['unmark_selected_mnu'] = 'Merk as ongelees';
$lang['move_selected_to_trash_mnu'] = 'Skuif na Asblik';


$lang['delete_mnu'] = 'Verwyder';
$lang['move_mnu'] = 'skuif na';
$lang['subject_hea'] = 'Onderwerp:';
$lang['from_hea'] = 'Van:';
$lang['to_hea'] = 'Aan:';
$lang['date_hea'] = 'Datum:';
$lang['size_hea'] = 'Grootte';
$lang['have_spam'] = 'Jy moet Spam (kyk spam gids)';

$lang['msg_you_have'] = 'Jy het';
$lang['msg_message'] = 'boodskap';
$lang['msg_messages'] = 'boodskappe';

$lang['msg_more_unread'] = 'ongelees';
$lang['msg_one_unread'] = 'ongelees';
$lang['msg_none_unread'] = 'geen te lees';
$lang['msg_in_the_folder'] = 'in die gids';


// [Login]
$lang['lgn_title'] = 'Teken';
$lang['lgn_welcome_msg'] = 'Welkom, inteken in jou rekening';
$lang['lng_user_email'] = 'E-pos';
$lang['lng_user_name'] = 'Gebruikersnaam';
$lang['lng_user_pwd'] = 'Wagwoord';
$lang['lng_server'] = 'Bediener';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Taal';
$lang['lng_login_btn'] = 'Teken &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies moet aangesit wees';
$lang['lng_cookie_not_valid'] = 'Cookie Security misluk';

// [Newmessage]

$lang['newmsg_title'] = 'Stel pos';

$lang['to_hea'] = 'Aan:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Onderwerp:';
$lang['address_tip'] = 'Van adres boek';

$lang['attach_hea'] = 'Attachment:';
$lang['attch_add_new'] = 'Heg nuwe lêer';
$lang['attch_name_hea'] = 'Naam';
$lang['attch_size'] = 'Grootte';
$lang['attch_type_hea'] = 'Tik';
$lang['attch_dele_hea'] = 'Verwyder';
$lang['attch_no_hea'] = 'Geen aanhegsels';

$lang['add_signature'] = 'Voeg handtekening';
$lang['send_text'] = 'Stuur';

$lang['result_error'] = 'Dit was nie moontlik om hierdie e-pos te stuur';
$lang['result_success'] = 'Hierdie e-pos is gestuur';
$lang['nav_continue'] = '&lt;&lt; Gaan voort &gt;&gt; ';
$lang['nav_back'] = 'Terug';

$lang['up_title'] = 'Voeg lêer';
$lang['up_information_text'] = 'Kies lêer';
$lang['up_button_text'] = 'Heg lêer';

$lang['require_receipt'] = 'retoerkwitansie';

$lang['priority_text'] = 'Priority';
$lang['priority_low'] = 'Lae';
$lang['priority_normal'] = 'normaal nie';
$lang['priority_high'] = 'High';

// [Preferences]
$lang['prf_title'] = 'Voorkeure';
$lang['prf_general_title'] = 'Algemene inligting';
$lang['prf_name'] = 'Naam';
$lang['prf_reply_to'] = 'Antwoord';
$lang['prf_time_zone'] = 'Tydsone';
$lang['prf_trash_title'] = 'asblik';
$lang['prf_save_to_trash'] = 'As jy <b> </ b> \'n boodskap verwyder, skuif dit na';
$lang['prf_save_only_read'] = 'Stoor net <b> lees boodskappe </ b> in die';
$lang['prf_empty_on_exit'] = '<b> Leë </ b> asblik wanneer jy afteken';
$lang['prf_empty_spam_on_exit'] = '<b> Leë </ b> Spam gids wanneer jy afteken';
$lang['prf_unmark_read_on_exit'] = 'Herstel lees die boodskappe as ongelees wanneer jy afteken';
$lang['prf_sent_title'] = 'Stuur vir items';
$lang['prf_save_sent'] = 'Stoor <b> gestuur boodskappe </ b> in die';
$lang['prf_messages_title'] = 'boodskappe';
$lang['prf_page_limit'] = 'Maksimum aantal boodskappe per bladsy';
$lang['prf_signature_title'] = 'Handtekening';
$lang['prf_signature'] = 'Skryf jou handtekening';
$lang['prf_auto_add_sign'] = 'Voeg jou handtekening tot al die uitgaande boodskappe';
$lang['prf_save_button'] = 'Stoor voorkeure';
$lang['prf_display_images'] = 'Wys aangeheg beelde';
$lang['prf_default_editor_mode'] = 'Standaard wysig af';
$lang['prf_default_editor_mode_text'] = '"Plain text"';
$lang['prf_default_editor_mode_html'] = '"Advanced HTML editor"';
$lang['prf_time_to_refesh'] = 'outomaties te monitor vir nuwe pos (minute)';
$lang['prf_spam_level'] = 'SPAM sensitiwiteit (0 = Gestremdes, 1 = baie hoog, 9 = Baie laag)';
$lang['prf_auto_require_receipt'] = 'Nodig lees ontvangs by verstek';
$lang['prf_keep_on_server'] = 'Hou e-pos op die bediener - geen plaaslike dopgehou';

$lang['prf_msg_saved'] = 'Voorkeure gered';

// filters
$lang['filter_title'] = 'Filters';

$lang['filter_new'] = 'Skep \'n filter';
$lang['filter_desc'] = 'Kies die soek kriteria en die aksie vir die inkomende boodskappe';
$lang['filter_list'] = 'Huidige filters';

$lang['filter_field_from'] = 'Van';
$lang['filter_field_to'] = 'Om';
$lang['filter_field_subject'] = 'onderwerp';
$lang['filter_field_header'] = 'Selected';
$lang['filter_field_body'] = 'Liggaam';

$lang['filter_type_move'] = 'Skuif';
$lang['filter_type_delete'] = 'Verwyder';
$lang['filter_type_mark'] = 'Mark lees';

$lang['filter_add'] = 'Voeg filter';
$lang['filter_delete'] = 'Verwyder';
$lang['filter_delete_selected'] = 'Verwyder geselekteerde filters';

$lang['filter_field'] = 'Filter op die veld';
$lang['filter_match'] = 'Soek vir';
$lang['filter_type'] = 'Aksie';
$lang['filter_folder'] = 'bestemming gids';

$lang['filter_msg_nofilters'] = 'Geen filters beskikbaar nie.';
$lang['filter_msg_added'] = 'Filter bygevoeg';
$lang['filter_msg_deleted'] = 'Filter verwyder';


// [Catch]
$lang['ctc_title'] = 'n boek aan te spreek Voeg ';
$lang['ctc_information'] = 'Slegs toon e-posse wat nie in die adres boek';
$lang['ctc_name'] = 'Naam';
$lang['ctc_email'] = 'E-pos';
$lang['ctc_no_address'] = 'Geen adres beskikbaar';
$lang['ctc_close'] = 'Maak';
$lang['ctc_save'] = 'Stoor';

// [Readmsg]
$lang['next_mnu'] = 'Volgende';
$lang['previous_mnu'] = 'Vorige';
$lang['back_mnu'] = 'Terug';
$lang['reply_mnu'] = 'Antwoord';
$lang['reply_all_mnu'] = 'Antwoord aan almal';
$lang['forward_mnu'] = 'Stuur';
$lang['headers_mnu'] = 'Selected';
$lang['move_mnu'] = 'skuif na';
$lang['move_to_trash_mnu'] = 'Skuif na Asblik';
$lang['delete_mnu'] = 'Verwyder';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Laai';

$lang['from_hea'] = 'Van:';
$lang['to_hea'] = 'Aan:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Datum:';
$lang['subject_hea'] = 'Onderwerp:';
$lang['attach_hea'] = 'Attachment:';

$lang['attch_name_hea'] = 'Naam';
$lang['attch_force_hea'] = 'Laai';
$lang['attch_type_hea'] = 'Tik';
$lang['attch_size_hea'] = 'Grootte';
$lang['catch_address'] = 'n boek aan te spreek Voeg ';
$lang['block_address'] = 'Blok adres';

// [Search]
$lang['sch_title'] = 'Soek';
$lang['sch_information_text'] = 'Skryf \'n frase of \'n woord wat jy op soek is vir Firefox gelees Net boodskappe sal gesoek word';
$lang['sch_button_text'] = 'Soek &gt;&gt;';
$lang['sch_subject_hea'] = 'onderwerp';
$lang['sch_from_hea'] = 'Van';
$lang['sch_date_hea'] = 'Datum';
$lang['sch_body_hea'] = 'boodskap Body';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Geen boodskappe wat ooreenstem met jou kriteria is gevind';

// [QuickAddress]
$lang['qad_title'] = 'adresboek';
$lang['qad_select_address'] = 'Kies \'n kontak';
$lang['qad_to'] = 'Om';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'adresboek';
$lang['adr_name'] = 'Naam';
$lang['adr_email'] = 'E-pos';
$lang['adr_street'] = 'straat';
$lang['adr_city'] = 'Stad';
$lang['adr_state'] = 'Staat';
$lang['adr_work'] = 'Werk';
$lang['adr_back'] = 'Terug';
$lang['adr_save'] = 'Stoor';
$lang['adr_phone'] = 'Skakel';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Naam';
$lang['adr_email_hea'] = 'E-pos';
$lang['adr_edit_hea'] = 'Verander';
$lang['adr_expo_hea'] = 'Uitvoer';
$lang['adr_dele_hea'] = 'Verwyder';
$lang['adr_new_entry'] = 'Nuwe kontak ';

$lang['addr_saved'] = 'Die kontak is gestoor';
$lang['addr_added'] = 'Die kontak is bygevoeg';
$lang['addr_deleted'] = 'Die kontak is verwyder';


// [BlockSender]
$lang['blk_title'] = 'Blok sender';
$lang['blk_information'] = 'Slegs toon e-posse wat nie in die filter nie';
$lang['blk_email'] = 'E-pos';
$lang['blk_no_address'] = 'Geen adres beskikbaar';
$lang['blk_close'] = 'Maak';
$lang['blk_save'] = 'Stoor';

// [Event]
$lang['evt_title'] = 'Kalender Event';
$lang['evt_save'] = 'Stoor';
$lang['evt_delete'] = 'Verwyder';
$lang['evt_stop'] = 'Stop tyd';
$lang['evt_start'] = 'Begin tyd';

