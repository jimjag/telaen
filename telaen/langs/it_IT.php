<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Posta in arrivo';
$lang['sent_extended'] = 'Posta spedita';
$lang['trash_extended'] = 'Cestino';
$lang['spam_extended'] = 'Spam';

// Navigation texts
$lang['pages_text'] = 'Pagine';
$lang['first_text'] = 'Prima';
$lang['previous_text'] = 'Precedente';
$lang['next_text'] = 'Successiva';
$lang['last_text'] = 'Ultima';
$lang['total_text'] = 'Totale';

// Mail Server Errors
$lang['err_login_msg'] = 'Errore di login';
$lang['err_system_msg'] = 'Errore di sistema';
$lang['error_login'] = 'Controlla il tuo nome utente o password e riprova';
$lang['error_connect'] = 'Impossibile connettersi al server';
$lang['error_retrieving'] = 'Errore di sincronizzazione della cartella';
$lang['error_session_expired'] = 'La sessione &egrave; scaduta, devi rieffettuare il login';
$lang['error_other'] = 'Contattare l\'amministratore di sistema';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Nome non valido - Usare i caratteri  A-Z, 0-9, .-';

// Validations when sending mails
$lang['error_no_recipients'] = 'Devi impostare almeno un indirizzo e-mail';
$lang['error_compose_invalid_mail1_s'] = 'Questa e-mail sembra non essere valida';
$lang['error_compose_invalid_mail1_p'] = 'Queste e-mail sembrano non essere valide';
$lang['error_compose_invalid_mail2_s'] = 'Scrivere un messaggio prima di inviare l\'email';
$lang['error_compose_invalid_mail2_p'] = 'Scrivere dei messaggi prima di inviare l\'email';

// Confirmation of delete
$lang['confirm_delete'] = 'Volete veramente cancellare questo messaggio?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Nessun oggetto]';
$lang['no_sender_text'] = '[Mittente sconosciuto]';
$lang['no_recipient_text'] = '[Destinatario sconosciuto]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Spazio esaurito\nCancellare qualche messaggio per proseguire\nSvuotare il cestino ';
$lang['quota_usage_info'] = 'Limite di spazio';
$lang['quota_usage_used'] = 'Usato';
$lang['quota_usage_of'] = 'di';
$lang['quota_usage_avail'] = 'disponibile';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Messaggi';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Scrivi';
$lang['refresh_mnu'] = 'Refresh';
$lang['folders_mnu'] = 'Cartelle';
$lang['search_mnu'] = 'Cerca';
$lang['address_mnu'] = 'Agenda';
$lang['empty_trash_mnu'] = 'Svuota cestino';
$lang['prefs_mnu'] = 'Preferenze';
$lang['logoff_mnu'] = 'Uscita';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Messaggio Originale --------';
$lang['reply_from_hea'] = 'Da:';
$lang['reply_to_hea'] = 'Per:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Data:';
$lang['reply_subject_hea'] = 'Oggetto:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'Cartella';
$lang['fld_messages_hea'] = 'Messaggi';
$lang['fld_size_hea'] = 'Dimensioni';
$lang['fld_empty_hea'] = 'Svuota';
$lang['fld_delete_hea'] = 'Cancella';
$lang['fld_total'] = 'Totale:';
$lang['fld_make_new'] = 'Crea nuova cartella';
$lang['folders_to'] = 'Cartelle';

// [MessageList]
$lang['messages_to'] = 'Messaggi per ';
$lang['no_messages'] = 'Nessun nuovo messaggio nella cartella ';
$lang['delete_selected_mnu'] = 'Cancella ';
$lang['move_selected_mnu'] = 'Sposta in';
$lang['mark_selected_mnu'] = 'Segna come letto';
$lang['unmark_selected_mnu'] = 'Segna come non letto';
$lang['move_selected_to_trash_mnu'] = 'Sposta nel cestino';


$lang['delete_mnu'] = 'Cancella';
$lang['move_mnu'] = 'Sposta';
$lang['subject_hea'] = 'Oggetto:';
$lang['from_hea'] = 'Da:';
$lang['to_hea'] = 'Per:';
$lang['date_hea'] = 'Data:';
$lang['size_hea'] = 'Dimesioni';
$lang['have_spam'] = 'Hai dello Spam (controlla la cartella Spam)';

$lang['msg_you_have'] = 'Hai';
$lang['msg_message'] = 'messaggio';
$lang['msg_messages'] = 'messaggi';

$lang['msg_more_unread'] = 'non letti';
$lang['msg_one_unread'] = 'non letto';
$lang['msg_none_unread'] = 'nessuno da leggere';
$lang['msg_in_the_folder'] = 'nella cartella';


// [Login]
$lang['lgn_title'] = 'Accedi';
$lang['lgn_welcome_msg'] = 'Benvenuto, accedi alla tua posta';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Username';
$lang['lng_user_pwd'] = 'Password';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Lingua';
$lang['lng_login_btn'] = 'Accedi &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'I cookies devono essere abilitati';
$lang['lng_cookie_not_valid'] = 'Check Sicurezza Cookies Fallito';

// [Newmessage]

$lang['newmsg_title'] = 'Scrivi messaggio';

$lang['to_hea'] = 'Per:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Oggetto:';
$lang['address_tip'] = 'Dalla rubrica';

$lang['attach_hea'] = 'Allegato:';
$lang['attch_add_new'] = 'Aggiungi file';
$lang['attch_name_hea'] = 'Nome';
$lang['attch_size'] = 'Dimensioni';
$lang['attch_type_hea'] = 'Tipo';
$lang['attch_dele_hea'] = 'Cancella';
$lang['attch_no_hea'] = 'Nessun allegato';

$lang['add_signature'] = 'Aggiungi firma';
$lang['send_text'] = 'Invia';

$lang['result_error'] = 'Non è stato possibile inviare l\'e-mail';
$lang['result_success'] = 'E-mail inviata correttamente';
$lang['nav_continue'] = 'Continua';
$lang['nav_back'] = 'Torna indietro';

$lang['up_title'] = 'Aggiungi file';
$lang['up_information_text'] = 'Seleziona file';
$lang['up_button_text'] = 'Invia';

$lang['require_receipt'] = 'Richiedi conferma di lettura';

$lang['priority_text'] = 'Priorità';
$lang['priority_low'] = 'Bassa';
$lang['priority_normal'] = 'Normale';
$lang['priority_high'] = 'Alta';

// [Preferences]
$lang['prf_title'] = 'Preferenze';
$lang['prf_general_title'] = 'Informazioni generali';
$lang['prf_name'] = 'Nome';
$lang['prf_reply_to'] = 'Rispondi a';
$lang['prf_time_zone'] = 'Fuso orario';
$lang['prf_trash_title'] = 'Cestino';
$lang['prf_save_to_trash'] = 'Quando <b>cancelli</b> un messaggio, spostalo in';
$lang['prf_save_only_read'] = 'Salva solo <b>i messaggi letti</b> nel';
$lang['prf_empty_on_exit'] = '<b>Svuota</b> il cestino quando esci';
$lang['prf_empty_spam_on_exit'] = '<b>Svuota</b> la cartella spam quando esci';
$lang['prf_unmark_read_on_exit'] = 'Reimposta tutti i messaggi come NON letti quando esci ';
$lang['prf_sent_title'] = 'Posta inviata';
$lang['prf_save_sent'] = 'Salva <b>posta inviata</b> nel';
$lang['prf_messages_title'] = 'Messaggi';
$lang['prf_page_limit'] = 'Massimo nr. di messaggi per pagina';
$lang['prf_signature_title'] = 'Firma';
$lang['prf_signature'] = 'Scrivi la firma';
$lang['prf_auto_add_sign'] = 'Aggiungi firma a tutti i messaggi in uscita ';
$lang['prf_save_button'] = 'Salva';
$lang['prf_display_images'] = 'Mostra immagini allegate';
$lang['prf_default_editor_mode'] = 'Editing semplificato';
$lang['prf_default_editor_mode_text'] = '"Modo testuale"';
$lang['prf_default_editor_mode_html'] = '"Modo avanzato (editor HTML)"';
$lang['prf_time_to_refesh'] = 'Refresh dei messaggi (minuti)';
$lang['prf_spam_level'] = 'Sensibilit&agrave; filtro SPAM (0 = Disattivo, 1 = Molto alta, 9 = Molto bassa)';
$lang['prf_auto_require_receipt'] = 'Richiedi conferma di lettura nei messaggi in uscita';

$lang['prf_msg_saved'] = 'Preferenze salvate';

// filters
$lang['filter_title'] = 'Filtri';

$lang['filter_new'] = 'Crea un filtro';
$lang['filter_desc'] = 'Scegli il criterio di ricerca a l\'azione per il messaggio';
$lang['filter_list'] = 'Filtri correnti';

$lang['filter_field_from'] = 'Da';
$lang['filter_field_to'] = 'Per';
$lang['filter_field_subject'] = 'Oggetto';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Sposta';
$lang['filter_type_delete'] = 'Cancella';
$lang['filter_type_mark'] = 'Segna come letto';

$lang['filter_add'] = 'Aggiungi filtro';
$lang['filter_delete'] = 'Elimina	';
$lang['filter_delete_selected'] = 'Elimina i filtri selezionati';

$lang['filter_field'] = 'Filtro sul campo';
$lang['filter_match'] = 'Cerca';
$lang['filter_type'] = 'Azione';
$lang['filter_folder'] = 'Cartella destinazione';

$lang['filter_msg_nofilters'] = 'Nessun filtro disponibile';
$lang['filter_msg_added'] = 'Filtro aggiunto';
$lang['filter_msg_deleted'] = 'Filtro eliminato';


// [Catch]
$lang['ctc_title'] = 'Aggiungi alla rubrica';
$lang['ctc_information'] = 'Vengono mostrati solo gli indirizzi che non sono gi&agrave; nella rubrica';
$lang['ctc_name'] = 'Nome';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Indirizzo non disponibile';
$lang['ctc_close'] = 'Chiudi';
$lang['ctc_save'] = 'Salva';

// [Readmsg]
$lang['next_mnu'] = 'Prossimo';
$lang['previous_mnu'] = 'Precedente';
$lang['back_mnu'] = 'Indietro';
$lang['reply_mnu'] = 'Rispondi';
$lang['reply_all_mnu'] = 'Rispondi a tutti';
$lang['forward_mnu'] = 'Inoltra';
$lang['headers_mnu'] = 'Intestazione';
$lang['move_mnu'] = 'Sposta';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Cancella';
$lang['print_mnu'] = 'Stampa';
$lang['download_mnu'] = 'Scarica';

$lang['from_hea'] = 'Da:';
$lang['to_hea'] = 'Per:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Data:';
$lang['subject_hea'] = 'Oggetto:';
$lang['attach_hea'] = 'Allegato:';

$lang['attch_name_hea'] = 'Nome';
$lang['attch_force_hea'] = 'Scarica';
$lang['attch_type_hea'] = 'Tipo';
$lang['attch_size_hea'] = 'Dimensioni';
$lang['catch_address'] = 'Aggiungi alla rubrica';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'Ricerca';
$lang['sch_information_text'] = 'Scrivi una frase o una parola che vuoi cercare.<br /> La ricerca nei messaggi avverr&agrave; tra i messagi gi&agrave; letti';
$lang['sch_button_text'] = 'Cerca &gt;&gt;';
$lang['sch_subject_hea'] = 'Oggetto';
$lang['sch_from_hea'] = 'Da';
$lang['sch_date_hea'] = 'Data';
$lang['sch_body_hea'] = 'Messaggio';
$lang['sch_folder_hea'] = 'Cartella';
$lang['sch_no_results'] = 'Non &egrave; stato trovato alcun messaggio';

// [QuickAddress]
$lang['qad_title'] = 'Rubrica';
$lang['qad_select_address'] = 'Seleziona un contatto';
$lang['qad_to'] = 'A';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Rubrica';
$lang['adr_name'] = 'Nome';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Via';
$lang['adr_city'] = 'Città';
$lang['adr_state'] = 'Stato';
$lang['adr_work'] = 'Impiego';
$lang['adr_back'] = 'Indietro';
$lang['adr_save'] = 'Salva';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Nome';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Modifica';
$lang['adr_expo_hea'] = 'Esporta';
$lang['adr_dele_hea'] = 'Cancella';
$lang['adr_new_entry'] = 'Nuovo Contatto';

$lang['addr_saved'] = 'Il contatto è stato salvato';
$lang['addr_added'] = 'Il contatto è stato aggiunto';
$lang['addr_deleted'] = 'Il contatto è stato eliminato';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'Salva';
$lang['evt_delete'] = 'Cancella';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

