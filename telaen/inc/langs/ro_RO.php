<?php
/*
 * Romanian (Româneşte) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-2';

// User-friendly names to system folders
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'Mesaje trimise';
$lang['trash_extended'] = 'Cos de gunoi';
$lang['spam_extended'] = 'director Spam';
$lang['drafts_extended'] = 'Schițe';

// Navigation texts
$lang['pages_text'] = 'Pagini';
$lang['first_text'] = 'Prima';
$lang['previous_text'] = 'Precedentul';
$lang['next_text'] = 'Urmatorul';
$lang['last_text'] = 'Acum';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Eroare Autentificare';
$lang['err_system_msg'] = 'Eroare de sistem'; 
$lang['error_login'] = 'Vă rugăm să verificați numele de utilizator sau parola și încercați din nou ';
$lang['error_connect'] = 'Eroare la conectarea cu serverul';
$lang['error_retrieving'] = 'Eroare la receptionarea mesajelor, Inbox-ul a fost modificat intre timp.';
$lang['error_session_expired'] = 'Sesiunea a expirat, vă rugăm să te autentifici din nou ';
$lang['error_other'] = 'Eroare fatala, contactati administratorul';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Nume invalid, folositi litere, cifre si -.';

// Validations when sending mails
$lang['error_no_recipients'] = 'Este necesara cel putin o adresa e-mail.';
$lang['error_compose_invalid_mail1_s'] = 'Acest mesaj pare invalid.';
$lang['error_compose_invalid_mail1_p'] = 'Urmatoarele mesje par invalide';
$lang['error_compose_invalid_mail2_s'] = 'Introduceti destinatarul inainte de a trimite';
$lang['error_compose_invalid_mail2_p'] = 'Introduceti destinatarul inainte de a trimite';

// Confirmation of delete
$lang['confirm_delete'] = 'Chiar vreti sa stergeti acest mesaj ?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Fara subiect]';
$lang['no_sender_text'] = '[Expeditor necunoscut]';
$lang['no_recipient_text'] = '[Recipient necunoscut]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Limita de marime pentru Inbox a fost atinsa.\n Stergeti cateva mesaje pentru a creea spatiul necesar.';
$lang['quota_usage_info'] = 'Limita';
$lang['quota_usage_used'] = 'Folosire';
$lang['quota_usage_of'] = 'din';
$lang['quota_usage_avail'] = 'disponibili';

// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Compune mesaj';
$lang['refresh_mnu'] = 'Verifica mesaje noi';
$lang['folders_mnu'] = 'Foldere';
$lang['search_mnu'] = 'Cauta';
$lang['address_mnu'] = 'Agenda';
$lang['empty_trash_mnu'] = 'Goleste cosul';
$lang['prefs_mnu'] = 'Optiuni';
$lang['logoff_mnu'] = 'Iesire';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Mesaj Original --------';
$lang['reply_from_hea'] = 'De la:';
$lang['reply_to_hea'] = 'pentru:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Data:';
$lang['reply_subject_hea'] = 'Subiect:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'cheie';
$lang['value_hea'] = 'valoare';

// [Folders]
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'Mesaje';
$lang['fld_size_hea'] = 'Dimensiune';
$lang['fld_empty_hea'] = 'Goleste';
$lang['fld_delete_hea'] = 'Sterge';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'Creeaza folder';
$lang['folders_to'] = 'Foldere la';

// [MessageList]
$lang['messages_to'] = 'Mesaje pentru ';
$lang['no_messages'] = 'Nici un mesaj nou in ';
$lang['delete_selected_mnu'] = 'Sterge selectate';
$lang['move_selected_mnu'] = 'Muta selectate in';
$lang['mark_selected_mnu'] = 'Marchează ca citit';
$lang['unmark_selected_mnu'] = 'Marchează ca necitit';
$lang['move_selected_to_trash_mnu'] = 'Mută la gunoi';


$lang['delete_mnu'] = 'Sterge';
$lang['move_mnu'] = 'Muta in';
$lang['subject_hea'] = 'Subiect:';
$lang['from_hea'] = 'De la:';
$lang['to_hea'] = 'Pentru:';
$lang['date_hea'] = 'Data:';
$lang['size_hea'] = 'Marime';
$lang['have_spam'] = 'Ai Spam (verificați director Spam)';

$lang['msg_you_have'] = 'Aveti';
$lang['msg_message'] = 'mesaj';
$lang['msg_messages'] = 'mesaje';

$lang['msg_more_unread'] = 'necitite';
$lang['msg_one_unread'] = 'necitit';
$lang['msg_none_unread'] = 'citite';
$lang['msg_in_the_folder'] = 'in folderul';


// [Login]
$lang['lgn_title'] = 'Login';
$lang['lgn_welcome_msg'] = 'Bine ati venit, va rugam introduceti numele si parola!';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Nume';
$lang['lng_user_pwd'] = 'Parola';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Limba';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Logare &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookie-urile trebuie să fie activate';
$lang['lng_cookie_not_valid'] = 'Cookie Securitate Consultați eșuat';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'Pentru:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Subiect:';
$lang['address_tip'] = 'Alegeti din agenda';

$lang['attach_hea'] = 'Atasament:';
$lang['attch_add_new'] = 'Adaugati fisier';
$lang['attch_name_hea'] = 'Nume';
$lang['attch_size'] = 'Marime';
$lang['attch_type_hea'] = 'Tip';
$lang['attch_dele_hea'] = 'Stergeti';
$lang['attch_no_hea'] = 'Nici un atasament';

$lang['add_signature'] = 'Adaugati semnatura';
$lang['send_text'] = 'Trimite';

$lang['result_error'] = 'Nu am reusit sa trimit mesajul';
$lang['result_success'] = 'Mesajul a fost trimis';
$lang['nav_continue'] = 'Continua';
$lang['nav_back'] = 'Inapoi';

$lang['up_title'] = 'Adaugati fisier';
$lang['up_information_text'] = 'Selectari fisier';
$lang['up_button_text'] = 'Trimite';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Prioritate';
$lang['priority_low'] = 'Mica';
$lang['priority_normal'] = 'Normala';
$lang['priority_high'] = 'Mare';

// [Preferences]
$lang['prf_title'] = 'Optiuni';
$lang['prf_general_title'] = 'Informatii generale';
$lang['prf_name'] = 'Nume';
$lang['prf_reply_to'] = 'Adresa de raspuns';
$lang['prf_time_zone'] = 'Fus orar';
$lang['prf_trash_title'] = 'Gunoi';
$lang['prf_save_to_trash'] = 'La <b>stergerea</b> unui mesaj, muta-l in ';
$lang['prf_save_only_read'] = 'Salveaza numai <b>mesajele citite</b> in  ';
$lang['prf_empty_on_exit'] = '<b>Clean</b> trash folder when you logout';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout'; // FIXME: need translation
$lang['prf_sent_title'] = 'Mesaje trimise';
$lang['prf_save_sent'] = 'Salveaza <b>mesajele trimise</b> in ';
$lang['prf_messages_title'] = 'Mesaje';
$lang['prf_page_limit'] = 'Mesaje pe pagina';
$lang['prf_signature_title'] = 'Semnatura';
$lang['prf_signature'] = 'Scrieti semnatura';
$lang['prf_auto_add_sign'] = 'Adauga semnatura la mesajele trimise';
$lang['prf_save_button'] = 'Salveaza optiuni';
$lang['prf_display_images'] = 'Afiseaza imaginile atasate';
$lang['prf_default_editor_mode'] = 'Mod de editare';
$lang['prf_default_editor_mode_text'] = '"Mod text"';
$lang['prf_default_editor_mode_html'] = '"HTML (Doar pentru Internet Explorer 5+)"';
$lang['prf_time_to_refesh'] = 'Interval pentru verificarea de mesaje noi (minute)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // FIXME: need translation
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation
$lang['prf_keep_on_server'] = 'Păstrați e-mail pe serverul - directoare locale';

$lang['prf_msg_saved'] = 'Preferences saved';

// filters
$lang['filter_title'] = 'filtre';

$lang['filter_new'] = 'Creează un filtru ';
$lang['filter_desc'] = 'Alege criteriile de căutare și de acțiune pentru mesajele primite ';
$lang['filter_list'] = 'filtre curente';

$lang['filter_field_from'] = 'Din';
$lang['filter_field_to'] = 'În';
$lang['filter_field_subject'] = 'Subiect';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'body';

$lang['filter_type_move'] = 'mișcare';
$lang['filter_type_delete'] = 'Șterge';
$lang['filter_type_mark'] = 'Marcu citit';

$lang['filter_add'] = 'Adauga filtru';
$lang['filter_delete'] = 'Șterge';
$lang['filter_delete_selected'] = 'Sterge filtrele selectate';

$lang['filter_field'] = 'Filtru pe teren';
$lang['filter_match'] = 'Cauta';
$lang['filter_type'] = 'acțiune';
$lang['filter_folder'] = 'dosar de destinație';

$lang['filter_msg_nofilters'] = 'Nu filtre.';
$lang['filter_msg_added'] = 'Filtru adăugată';
$lang['filter_msg_deleted'] = 'Filtru elimină';

// [Catch]
$lang['ctc_title'] = 'Adauga in agenda';
$lang['ctc_information'] = 'Vor fi afisate doar adresele din agenda';
$lang['ctc_name'] = 'Nume';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Adresa indisponibila';
$lang['ctc_close'] = 'Inchide';
$lang['ctc_save'] = 'Salveaza';

// [Readmsg]
$lang['next_mnu'] = 'Urmatorul';
$lang['previous_mnu'] = 'Precedentul';
$lang['back_mnu'] = 'Inapoi';
$lang['reply_mnu'] = 'Raspunde';
$lang['reply_all_mnu'] = 'Raspunde tuturor';
$lang['forward_mnu'] = 'Trimite mai departe';
$lang['headers_mnu'] = 'Afiseaza header';
$lang['move_mnu'] = 'Muta in';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Sterge';
$lang['print_mnu'] = 'Printeaza';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'De la:';
$lang['to_hea'] = 'Pentru:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Data:';
$lang['subject_hea'] = 'Subiect:';
$lang['attach_hea'] = 'Atasament:';

$lang['attch_name_hea'] = 'Nume';
$lang['attch_force_hea'] = 'Descarca';
$lang['attch_type_hea'] = 'Tip';
$lang['attch_size_hea'] = 'Marime';
$lang['catch_address'] = 'Adauga in agenda';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Scrieti cuvantul sau fraza dupa care se ca cauta.<br> Cautarea dupa mesaj se va face numai in mesajele citite.';
$lang['sch_button_text'] = 'Cauta &gt;&gt;';
$lang['sch_subject_hea'] = 'Subiect';
$lang['sch_from_hea'] = 'De la';
$lang['sch_date_hea'] = 'Data';
$lang['sch_body_hea'] = 'Mesaj';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Nu am gasit nici un mesaj';

// [QuickAddress]
$lang['qad_title'] = 'Agenda';
$lang['qad_select_address'] = 'Selectati un contact';
$lang['qad_to'] = 'Pentru';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Agenda';
$lang['adr_name'] = 'Nume';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Strada';
$lang['adr_city'] = 'Oras';
$lang['adr_state'] = 'Judet';
$lang['adr_work'] = 'Firma';
$lang['adr_back'] = 'Inapoi';
$lang['adr_save'] = 'Salveaza';
$lang['adr_phone'] = 'Phone'; // FIXME: need translation
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'Nume';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Editeaza';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Sterge';
$lang['adr_new_entry'] = 'Adauga contact';

$lang['addr_saved'] = 'Intrare salvata.';
$lang['addr_added'] = 'Contact adaugat cu succes.';
$lang['addr_deleted'] = 'Intrare stearsa.';


// [BlockSender]
$lang['blk_title'] = 'Blocare expeditor';
$lang['blk_information'] = 'prezinta doar e-mail-uri care nu sunt în filtrul încă ';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Nu adresa disponibile'; 
$lang['blk_close'] = 'Închide';
$lang['blk_save'] = 'Salveaza';

// [Event]
$lang['evt_title'] = 'Calendar evenimente';
$lang['evt_save'] = 'Salveaza';
$lang['evt_delete'] = 'Sterge';
$lang['evt_stop'] = 'Nu mai timp';
$lang['evt_start'] = 'Start timp';

