<?php
/*
 * Czech (Česky) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'Odeslané položky';
$lang['trash_extended'] = 'Trash složku';
$lang['spam_extended'] = 'složky Spam';

// Navigation texts
$lang['pages_text'] = 'Stránky';
$lang['first_text'] = 'První';
$lang['previous_text'] = 'Předchozí';
$lang['next_text'] = 'Next';
$lang['last_text'] = 'Poslední';
$lang['total_text'] = 'Celkem';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'Chyba systému';
$lang['error_login'] = 'Zkontrolujte prosím své uživatelské jméno nebo heslo a zkuste to znovu';
$lang['error_connect'] = 'Chyba při připojení k serveru';
$lang['error_retrieving'] = 'Chyba při získávání zpráv, Doručená změnila';
$lang['error_session_expired'] = 'Vaše relace vypršela, znovu se přihlásit, prosím,';
$lang['error_other'] = 'selhání systému, obraťte se na správce sítě';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Neplatný název složky - Používejte pouze tyto znaky A-Z, a-z, 0-9, a -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Chyba: Musíte mít alespoň jednoho příjemce';
$lang['error_compose_invalid_mail1_s'] = 'Chyba: Tato e-mailová adresa se zdá být neplatná';
$lang['error_compose_invalid_mail1_p'] = 'Chyba: Tato e-mailové adresy se zdá být neplatná';
$lang['error_compose_invalid_mail2_s'] = 'Před přeposílání tento e-mail Zkontrolujte e-mailovou adresu.';
$lang['error_compose_invalid_mail2_p'] = 'Před přeposílání tento e-mail Zkontrolujte, zda vaše adresy.';

// Confirmation of delete
$lang['confirm_delete'] = 'Opravdu chcete smazat tuto zprávu (y)';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[bez názvu]';
$lang['no_sender_text'] = '[Sender neznámý]';
$lang['no_recipient_text'] = '[příjemce neznámý]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Není dostatek místa ve vaší e-mailové schránky k dokončení této akce \ nProsím odstranit některé zprávy, aby i nadále';
$lang['quota_usage_info'] = 'Limit Kvóta';
$lang['quota_usage_used'] = 'Používá';
$lang['quota_usage_of'] = 'z';
$lang['quota_usage_avail'] = 'k dispozici';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Read E-mail (y)';
$lang['compose_mnu'] = 'Write E-Mail';
$lang['refresh_mnu'] = 'Obnovit';
$lang['folders_mnu'] = 'složky';
$lang['search_mnu'] = 'Vyhledávání';
$lang['address_mnu'] = 'Adresář';
$lang['empty_trash_mnu'] = 'Empty trash';
$lang['prefs_mnu'] = 'Nastavení';
$lang['logoff_mnu'] = 'Odhlásit';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
$lang['reply_from_hea'] = 'Od:';
$lang['reply_to_hea'] = 'Komu:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Datum:';
$lang['reply_subject_hea'] = 'Předmět:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'klíč';
$lang['value_hea'] = 'hodnota';

// [Folders]
$lang['fld_name_hea'] = 'Složka';
$lang['fld_messages_hea'] = 'Zprávy';
$lang['fld_size_hea'] = 'Velikost';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Odstranit';
$lang['fld_total'] = 'Celkem:';
$lang['fld_make_new'] = 'Vytvořit novou složku';
$lang['folders_to'] = 'složky, které se';

// [MessageList]
$lang['messages_to'] = 'zpráv, které';
$lang['no_messages'] = 'Žádné nové zprávy v';
$lang['delete_selected_mnu'] = 'Delete';
$lang['move_selected_mnu'] = 'Přesunout do';
$lang['mark_selected_mnu'] = 'Označit jako přečtené';
$lang['unmark_selected_mnu'] = 'Označit jako nepřečtené';
$lang['move_selected_to_trash_mnu'] = 'Přesunout do koše';


$lang['delete_mnu'] = 'Delete';
$lang['move_mnu'] = 'Přesunout do';
$lang['subject_hea'] = 'Předmět:';
$lang['from_hea'] = 'Od:';
$lang['to_hea'] = 'Komu:';
$lang['date_hea'] = 'Datum:';
$lang['size_hea'] = 'Velikost';
$lang['have_spam'] = 'Musíte Spam (zkontrolujte složku se spamem)';

$lang['msg_you_have'] = 'Musíte';
$lang['msg_message'] = 'Zpráva';
$lang['msg_messages'] = 'zprávy';

$lang['msg_more_unread'] = 'nepřečtené';
$lang['msg_one_unread'] = 'nepřečtené';
$lang['msg_none_unread'] = 'none číst';
$lang['msg_in_the_folder'] = 've složce';


// [Login]
$lang['lgn_title'] = 'Přihlášení';
$lang['lgn_welcome_msg'] = 'Vítejte, přihlaste se prosím do svého účtu';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Uživatelské jméno';
$lang['lng_user_pwd'] = 'Heslo';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'téma';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Přihlášení &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Musíte povolit cookies';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Vytvořit e-mail';

$lang['to_hea'] = 'Komu:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Předmět:';
$lang['address_tip'] = 'z adresáře';

$lang['attach_hea'] = 'Příloha:';
$lang['attch_add_new'] = 'Připojit nový soubor';
$lang['attch_name_hea'] = 'Název';
$lang['attch_size'] = 'Velikost';
$lang['attch_type_hea'] = 'Typ';
$lang['attch_dele_hea'] = 'Odstranit';
$lang['attch_no_hea'] = 'Žádné přílohy';

$lang['add_signature'] = 'Přidat podpis';
$lang['send_text'] = 'Odeslat';

$lang['result_error'] = 'Nebylo možné odeslat e-mail';
$lang['result_success'] = 'Tento e-mail byl odeslán';
$lang['nav_continue'] = '& lt; & lt; Pokračovat &gt;&gt;';
$lang['nav_back'] = 'Zpět';

$lang['up_title'] = 'Přidat soubor';
$lang['up_information_text'] = 'Zvolte soubor';
$lang['up_button_text'] = 'Přiložit soubor';

$lang['require_receipt'] = 'doručenkou';

$lang['priority_text'] = 'Priorita';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'High';

// [Preferences]
$lang['prf_title'] = 'Nastavení';
$lang['prf_general_title'] = 'Obecné informace';
$lang['prf_name'] = 'Název';
$lang['prf_reply_to'] = 'Odpovědět';
$lang['prf_time_zone'] = 'Časové pásmo';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Když se <b> Odstranit </ b> zprávu, přesuňte jej na';
$lang['prf_save_only_read'] = 'Save pouze <b> číst zprávy </ b> v';
$lang['prf_empty_on_exit'] = '<b> Empty </ b> trash složky při odhlášení';
$lang['prf_empty_spam_on_exit'] = '<b> Empty </ b> složku Spam, když jste odhlášení';
$lang['prf_unmark_read_on_exit'] = 'Obnovit číst zprávy jako nepřečtené, když se odhlásit';
$lang['prf_sent_title'] = 'Odeslané';
$lang['prf_save_sent'] = 'Uložit <b> odeslaných zpráv </ b> v';
$lang['prf_messages_title'] = 'Zprávy';
$lang['prf_page_limit'] = 'Maximální počet zpráv na stránku';
$lang['prf_signature_title'] = 'Podpis';
$lang['prf_signature'] = 'Napište svůj podpis';
$lang['prf_auto_add_sign'] = 'Přidat podpis všech odesílaných zpráv';
$lang['prf_save_button'] = 'Uložit nastavení';
$lang['prf_display_images'] = 'Zobrazit připojený obraz';
$lang['prf_default_editor_mode'] = 'Výchozí režim úpravy';
$lang['prf_default_editor_mode_text'] = '"Prostý text"';
$lang['prf_default_editor_mode_html'] = '"Advanced HTML editor"';
$lang['prf_time_to_refesh'] = 'Automaticky kontrolovat novou poštu (minuty)';
$lang['prf_spam_level'] = 'citlivost SPAM (0 = vypnuto, 1 = velmi vysoká, 9 = velmi nízká)';
$lang['prf_auto_require_receipt'] = 'Vyžadovat potvrzení přečtení ve výchozím nastavení';

$lang['prf_msg_saved'] = 'Nastavení uloženo';

// filters
$lang['filter_title'] = 'filtry';

$lang['filter_new'] = 'Vytvořit filtr';
$lang['filter_desc'] = 'Vyberte kritéria vyhledávání a akce pro příchozí zprávy';
$lang['filter_list'] = 'Aktuální filtry';

$lang['filter_field_from'] = 'Z';
$lang['filter_field_to'] = 'K';
$lang['filter_field_subject'] = 'Předmět';
$lang['filter_field_header'] = 'Hlavička';
$lang['filter_field_body'] = 'tělo';

$lang['filter_type_move'] = 'Přesunout';
$lang['filter_type_delete'] = 'Odstranit';
$lang['filter_type_mark'] = 'Označit jako přečtené';

$lang['filter_add'] = 'Přidat filtr';
$lang['filter_delete'] = 'Odstranit';
$lang['filter_delete_selected'] = 'Smazat vybrané filtry';

$lang['filter_field'] = 'Filter v oblasti';
$lang['filter_match'] = 'Vyhledávání';
$lang['filter_type'] = 'akce';
$lang['filter_folder'] = 'Cílová složka';

$lang['filter_msg_nofilters'] = 'Žádné filtry nejsou k dispozici.';
$lang['filter_msg_added'] = 'Filter dodal';
$lang['filter_msg_deleted'] = 'Filter odstraněny';


// [Catch]
$lang['ctc_title'] = 'Přidat do adresáře';
$lang['ctc_information'] = 'Jen ukazuje, e-maily, které nejsou v adresáři';
$lang['ctc_name'] = 'Název';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'není k dispozici adresa';
$lang['ctc_close'] = 'Zavřít';
$lang['ctc_save'] = 'Uložit';

// [Readmsg]
$lang['next_mnu'] = 'Next';
$lang['previous_mnu'] = 'Předchozí';
$lang['back_mnu'] = 'Zpět';
$lang['reply_mnu'] = 'Odpovědět';
$lang['reply_all_mnu'] = 'Odpovědět všem';
$lang['forward_mnu'] = 'vpřed';
$lang['headers_mnu'] = 'Hlavička';
$lang['move_mnu'] = 'Přesunout do';
$lang['move_to_trash_mnu'] = 'Přesunout do koše';
$lang['delete_mnu'] = 'Delete';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'Od:';
$lang['to_hea'] = 'Komu:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Datum:';
$lang['subject_hea'] = 'Předmět:';
$lang['attach_hea'] = 'Příloha:';

$lang['attch_name_hea'] = 'Název';
$lang['attch_force_hea'] = 'Download';
$lang['attch_type_hea'] = 'Typ';
$lang['attch_size_hea'] = 'Velikost';
$lang['catch_address'] = 'Přidat do adresáře';
$lang['block_address'] = 'Blokovat adresu';

// [Search]
$lang['sch_title'] = 'Vyhledávání';
$lang['sch_information_text'] = '.. Napište frázi nebo slovo, které hledáte <br> číst pouze zprávy budou prohledávány';
$lang['sch_button_text'] = 'Search &gt;&gt;';
$lang['sch_subject_hea'] = 'Předmět';
$lang['sch_from_hea'] = 'Z';
$lang['sch_date_hea'] = 'Datum';
$lang['sch_body_hea'] = 'Tělo zprávy';
$lang['sch_folder_hea'] = 'Složka';
$lang['sch_no_results'] = 'Žádné zprávy odpovídající vašim kritériím byly nalezeny';

// [QuickAddress]
$lang['qad_title'] = 'Adresář';
$lang['qad_select_address'] = 'Vyberte kontakt';
$lang['qad_to'] = 'K';
$lang['qad_cc'] = 'Kopie';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adresář';
$lang['adr_name'] = 'Název';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'City';
$lang['adr_state'] = 'stát';
$lang['adr_work'] = 'práce';
$lang['adr_back'] = 'Zpět';
$lang['adr_save'] = 'Uložit';
$lang['adr_phone'] = 'Telefon';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Poznámky';

// list
$lang['adr_name_hea'] = 'Název';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Upravit';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Odstranit';
$lang['adr_new_entry'] = 'Nový kontakt';

$lang['addr_saved'] = 'Kontakt byl uložen';
$lang['addr_added'] = 'Kontakt byl přidán';
$lang['addr_deleted'] = 'kontakt byl odstraněn';


// [BlockSender]
$lang['blk_title'] = 'Blokovat odesílatele';
$lang['blk_information'] = 'Jen ukazuje, e-maily, které nejsou ve filtru ještě';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Žádná adresa k dispozici';
$lang['blk_close'] = 'Zavřít';
$lang['blk_save'] = 'Uložit';

// [Event]
$lang['evt_title'] = 'Kalendář událostí';
$lang['evt_save'] = 'Uložit';
$lang['evt_delete'] = 'Odstranit';
$lang['evt_stop'] = 'Zastavte čas';
$lang['evt_start'] = 'Čas spuštění';

