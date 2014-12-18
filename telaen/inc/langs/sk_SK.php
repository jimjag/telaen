<?php
/*
 * Slovak (Slovenčina) (kanonické zoznam a frázovanie)
 */

$lang = array();

// Užívateľsky prívetivé mena do systémových priečinkov
$lang ['inbox_extended'] = 'Inbox';
$lang ['sent_extended'] = 'Vylúčený položky';
$lang ['trash_extended'] = 'priečinku Kôš';
$lang ['spam_extended'] = 'priečinku Spam';

// Navigácia texty
$lang ['pages_text'] = 'Stránky';
$lang ['first_text'] = 'Prvý';
$lang ['previous_text'] = 'Predchádzajúci';
$lang ['next_text'] = 'Next';
$lang ['last_text'] = 'Last';
$lang ['total_text'] = 'Total';

// Chyby Mail Server
$lang ['err_login_msg'] = 'Login error';
$lang ['err_system_msg'] = 'Chyba systému';
$lang ['error_login'] = 'Skontrolujte svoje používateľské meno alebo heslo a skúste to znova';
$lang ['error_connect'] = 'Chyba pri pripojení k serveru';
$lang ['error_retrieving'] = 'Chyba pri získavaní správ, Doručená zmenila';
$lang ['error_session_expired'] = 'Vaša relácia vypršala, znova sa prihlásiť, prosím,';
$lang ['error_other'] = 'zlyhanie systému, obráťte sa na správcu siete';

// Neplatný názov poštovej schránky
$lang ['error_invalid_name'] = 'Neplatný názov zložky - Používajte iba tieto znaky A-Z, a-z, 0-9, a -';

// Overovanie pri odosielaní mailov
$lang ['error_no_recipients'] = 'Chyba: Musíte mať aspoň jedného príjemcu';
$lang ['error_compose_invalid_mail1_s'] = 'Chyba: Táto e-mailová adresa sa zdá byť neplatná';
$lang ['error_compose_invalid_mail1_p'] = 'Chyba: Táto e-mailovej adresy sa zdá byť neplatná';
$lang ['error_compose_invalid_mail2_s'] = 'Pred preposielanie tohto e-mailu skontrolujte e-mailovú adresu.';
$lang ['error_compose_invalid_mail2_p'] = 'Pred preposielanie tento e-mail Skontrolujte, či vaše adresy.';

// Potvrdenie delete
$lang ['CONFIRM_DELETE'] = '? Naozaj chcete zmazať túto správu (y)';

// Ak správa nie je nejaký predmet alebo odosielateľa
$lang ['no_subject_text'] = '[bez názvu]';
$lang ['no_sender_text'] = '[Sender neznámy]';
$lang ['no_recipient_text'] = '[príjemcu neznáme]';

// Ak bol prekročený limit kvóty
$lang ['quota_exceeded'] = 'nie je dostatok miesta vo vašej e-mailovej schránky na dokončenie tejto akcie \ nProsím odstrániť niektoré správy, aby aj naďalej';
$lang ['quota_usage_info'] = 'limit kvóty';
$lang ['quota_usage_used'] = 'použité';
$lang ['quota_usage_of'] = 'z';
$lang ['quota_usage_avail'] = 'k dispozícii';

//
// Formát dátumu
//% D = deň,% m = mesiac,% r = rok,% H = hodina,% M = minúty
// Pre kompletný zoznam, vidieť http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// charset
$lang ['default_char_set'] = 'iso-8859-1';

// Menu
$lang ['messages_mnu'] = 'Inbox';
$lang ['read_menu'] = 'Read E-Mail (s)';
$lang ['compose_mnu'] = 'Write E-Mail';
$lang ['refresh_mnu'] = 'Obnoviť';
$lang ['folders_mnu'] = 'Folders';
$lang ['search_mnu'] = 'Hľadať';
$lang ['address_mnu'] = 'Adresár';
$lang ['empty_trash_mnu'] = 'Empty Trash';
$lang ['prefs_mnu'] = 'Nastavenia';
$lang ['logoff_mnu'] = 'Odhlásiť';

// Odpovedať
$lang ['reply_prefix'] = 'Re:';
$lang ['forward_prefix'] = 'Fw:';
$lang ['reply_delimiter'] = '--------- Original Message --------';
$lang ['reply_from_hea'] = 'Od:';
$lang ['reply_to_hea'] = 'Komu:';
$lang ['reply_cc_hea'] = 'Cc:';
$lang ['reply_date_hea'] = 'Date:';
$lang ['reply_subject_hea'] = 'Predmet:';
// Implementoval


// Page-špecifické Vars

// [Hlavičky]
$lang ['key_hea'] = 'Key';
$lang ['value_hea'] = 'Value';

// [Folders]
$lang ['fld_name_hea'] = 'Folder';
$lang ['fld_messages_hea'] = 'Správy';
$lang ['fld_size_hea'] = 'Size';
$lang ['fld_empty_hea'] = 'Empty';
$lang ['fld_delete_hea'] = 'Odstrániť';
$lang ['fld_total'] = 'Celkom:';
$lang ['fld_make_new'] = 'Vytvoriť novú zložku';
$lang ['folders_to'] = 'zložky, ktoré sa';

// [MessageList]
$lang ['messages_to'] = 'správ, ktoré majú';
$lang ['no_messages'] = 'Žiadne nové správy v';
$lang ['delete_selected_mnu'] = 'Delete';
$lang ['move_selected_mnu'] = 'Presunúť do';
$lang ['mark_selected_mnu'] = 'Označiť ako prečítané';
$lang ['unmark_selected_mnu'] = 'Označiť ako neprečítané';
$lang ['move_selected_to_trash_mnu'] = 'Presunúť do koša';


$lang ['delete_mnu'] = 'Delete';
$lang ['move_mnu'] = 'Presunúť do';
$lang ['subject_hea'] = 'Predmet';
$lang ['from_hea'] = 'Z';
$lang ['to_hea'] = 'To';
$lang ['date_hea'] = 'Date';
$lang ['size_hea'] = 'Size';
$lang ['have_spam'] = 'Máte Spam (skontrolujte zložku so spamom)';

$lang ['msg_you_have'] = 'Musíte';
$lang ['msg_message'] = 'správa';
$lang ['msg_messages'] = 'Správy';

$lang ['msg_more_unread'] = 'neprečítané';
$lang ['msg_one_unread'] = 'neprečítané';
$lang ['msg_none_unread'] = 'none čítať';
$lang ['msg_in_the_folder'] = 'v priečinku';


// [Prihlásiť sa]
$lang ['lgn_title'] = 'Prihlásenie';
$lang ['lgn_welcome_msg'] = 'Vitajte, prihláste sa do svojho účtu';
$lang ['lng_user_email'] = 'E-mail';
$lang ['lng_user_name'] = 'Užívateľské meno';
$lang ['lng_user_pwd'] = 'Heslo';
$lang ['lng_server'] = 'serveru';
$lang ['lng_theme'] = 'Theme';
$lang ['lng_language'] = 'Language';
$lang ['lng_login_btn'] = 'Prihlásenie &gt;&gt';
$lang ['lng_cookie_not_enabled'] = 'Cookies';
$lang ['lng_cookie_not_valid'] = 'Cookie Security Check zlyhalo';

// [NewMessage]

$lang ['newmsg_title'] = 'Vytvoriť e-mail';

$lang ['to_hea'] = 'Komu:';
$lang ['cc_hea'] = 'Cc:';
$lang ['bcc_hea'] = 'Bcc:';
$lang ['subject_hea'] = 'Predmet:';
$lang ['address_tip'] = 'z adresára';

$lang ['attach_hea'] = 'Príloha:';
$lang ['attch_add_new'] = 'Priložiť nový súbor';
$lang ['attch_name_hea'] = 'Name';
$lang ['attch_size'] = 'Size';
$lang ['attch_type_hea'] = 'Typ';
$lang ['attch_dele_hea'] = 'Odstrániť';
$lang ['attch_no_hea'] = 'Žiadne prílohy';

$lang ['add_signature'] = 'pridať podpis';
$lang ['send_text'] = 'Odoslať';

$lang ['result_error'] = 'Nebolo možné odoslať e-mail';
$lang ['result_success'] = 'Tento e-mail bol odoslaný';
$lang ['nav_continue'] = '&lt;&lt; Pokračovať &gt;&gt;';
$lang ['nav_back'] = 'Back';

$lang ['up_title'] = 'pridať súbor';
$lang ['up_information_text'] = 'Select file';
$lang ['up_button_text'] = 'Priložiť súbor';

$lang ['require_receipt'] = 'doručenkou';

$lang ['priority_text'] = 'Priorita';
$lang ['priority_low'] = 'Low';
$lang ['priority_normal'] = 'normálne';
$lang ['priority_high'] = 'High';

// [Preferences]
$lang ['prf_title'] = 'Nastavenia';
$lang ['prf_general_title'] = 'Všeobecné informácie';
$lang ['prf_name'] = 'Name';
$lang ['prf_reply_to'] = 'Odpovedať';
$lang ['prf_time_zone'] = 'Časové pásmo';
$lang ['prf_trash_title'] = 'Trash';
$lang ['prf_save_to_trash'] = 'Keď <b> zmazať </ b> správy presunúť ju do';
$lang ['prf_save_only_read'] = 'Save iba <b> čítať správy </ b> na';
$lang ['prf_empty_on_exit'] = '<b> Empty </ b> na odpadky zložky pri odhlásení';
$lang ['prf_empty_spam_on_exit'] = '<b> Empty </ b> zložky nevyžiadanej pošty, keď sa odhlási';
$lang ['prf_unmark_read_on_exit'] = 'Obnoviť čítať správy ako neprečítané, keď sa odhlási';
$lang ['prf_sent_title'] = 'Odoslané položky';
$lang ['prf_save_sent'] = 'Save <b> odoslané správy </ b> na';
$lang ['prf_messages_title'] = 'Správy';
$lang ['prf_page_limit'] = 'Maximálny počet správ na stránku';
$lang ['prf_signature_title'] = 'Signature';
$lang ['prf_signature'] = 'Napíšte svoj podpis';
$lang ['prf_auto_add_sign'] = 'pridať svoj podpis do všetkých odchádzajúcich správ';
$lang ['prf_save_button'] = 'Save Preferences';
$lang ['prf_display_images'] = 'Show Priložené obrázky';
$lang ['prf_default_editor_mode'] = 'Default mode editovať';
$lang ['prf_default_editor_mode_text'] = '"obyčajný text"';
$lang ['prf_default_editor_mode_html'] = '"Advanced HTML editor"';
$lang ['prf_time_to_refesh'] = 'Automaticky kontrolovať novú poštu (minúty)';
$lang ['prf_spam_level'] = 'citlivosť SPAM (0 = vypnuté, 1 = veľmi vysoká, 9 = veľmi nízka),';
$lang ['prf_auto_require_receipt'] = 'Požadovať potvrdenie prečítania v predvolenom nastavení';

$lang ['prf_msg_saved'] = 'Nastavenia uložené';

// filtre
$lang ['filter_title'] = 'Filtre';

$lang ['filter_new'] = 'Vytvoriť filter';
$lang ['filter_desc'] = 'Vyberte si vyhľadávacie kritériá a opatrenia na prichádzajúce správy';
$lang ['filter_list'] = 'Aktuálna filtre';

$lang ['filter_field_from'] = 'Z';
$lang ['filter_field_to'] = 'To';
$lang ['filter_field_subject'] = 'Predmet';
$lang ['filter_field_header'] = 'Header';
$lang ['filter_field_body'] = 'telo';

$lang ['filter_type_move'] = 'Move';
$lang ['filter_type_delete'] = 'Odstrániť';
$lang ['filter_type_mark'] = 'Označiť ako prečítané';

$lang ['filter_add'] = 'pridať filter';
$lang ['filter_delete'] = 'Odstrániť';
$lang ['filter_delete_selected'] = 'Zmazať vybrané filtre';

$lang ['filter_field'] = 'Filter na poli';
$lang ['filter_match'] = 'Hľadať';
$lang ['filter_type'] = 'akcia';
$lang ['filter_folder'] = 'Cieľový priečinok';

$lang ['filter_msg_nofilters'] = 'Žiadne filtre nie sú k dispozícii.';
$lang ['filter_msg_added'] = 'Filter pridaný';
$lang ['filter_msg_deleted'] = 'Filter vypúšťajú';


// [Catch]
$lang ['ctc_title'] = 'Pridať do adresára';
$lang ['ctc_information'] = 'Len ukazuje, e-maily, ktoré nie sú v adresári';
$lang ['ctc_name'] = 'Name';
$lang ['ctc_email'] = 'E-mail';
$lang ['ctc_no_address'] = 'nie je k dispozícii adresa';
$lang ['ctc_close'] = 'Close';
$lang ['ctc_save'] = 'Save';

// [Readmsg]
$lang ['next_mnu'] = 'Next';
$lang ['previous_mnu'] = 'Predchádzajúci';
$lang ['back_mnu'] = 'Back';
$lang ['reply_mnu'] = 'Odpovedať';
$lang ['reply_all_mnu'] = 'Odpovedať všetkým';
$lang ['forward_mnu'] = 'vpred';
$lang ['headers_mnu'] = 'Header';
$lang ['move_mnu'] = 'Presunúť do';
$lang ['move_to_trash_mnu'] = 'Presunúť do koša';
$lang ['delete_mnu'] = 'Delete';
$lang ['print_mnu'] = 'Print';
$lang ['download_mnu'] = 'Na stiahnutie';

$lang ['from_hea'] = 'Od:';
$lang ['to_hea'] = 'Komu:';
$lang ['cc_hea'] = 'Cc:';
$lang ['date_hea'] = 'Date:';
$lang ['subject_hea'] = 'Predmet:';
$lang ['attach_hea'] = 'Príloha:';

$lang ['attch_name_hea'] = 'Name';
$lang ['attch_force_hea'] = 'Na stiahnutie';
$lang ['attch_type_hea'] = 'Typ';
$lang ['attch_size_hea'] = 'Size';
$lang ['catch_address'] = 'Pridať do adresára';
$lang ['block_address'] = 'Blokovať adresa';

// [Search]
$lang ['sch_title'] = 'Hľadať';
$lang ['sch_information_text'] = '.. Napíšte frázu alebo slovo, ktoré hľadáte <br> čítať iba správy budú prehľadávané';
$lang ['sch_button_text'] = 'Search &gt;&gt;';
$lang ['sch_subject_hea'] = 'Predmet';
$lang ['sch_from_hea'] = 'Z';
$lang ['sch_date_hea'] = 'Date';
$lang ['sch_body_hea'] = 'text správy';
$lang ['sch_folder_hea'] = 'Folder';
$lang ['sch_no_results'] = 'Žiadne správy, ktoré zodpovedajú kritériám boli nájdené';

// [QuickAddress]
$lang ['qad_title'] = 'Adresár';
$lang ['qad_select_address'] = 'Vyberte kontakt';
$lang ['qad_to'] = 'To';
$lang ['qad_cc'] = 'CC';
$lang ['qad_bcc'] = 'Bcc';

// [Addressbook]
// Editovať / display
$lang ['adr_title'] = 'Adresár';
$lang ['adr_name'] = 'Name';
$lang ['adr_email'] = 'E-mail';
$lang ['adr_street'] = 'Street';
$lang ['adr_city'] = 'City';
$lang ['adr_state'] = 'State';
$lang ['adr_work'] = 'práce';
$lang ['adr_back'] = 'Back';
$lang ['adr_save'] = 'Save';
$lang ['adr_phone'] = 'Phone';
$lang ['adr_cell'] = 'Cell';
$lang ['adr_note'] = 'Notes';

// Zoznam
$lang ['adr_name_hea'] = 'Name';
$lang ['adr_email_hea'] = 'E-mail';
$lang ['adr_edit_hea'] = 'Edit';
$lang ['adr_expo_hea'] = 'Export';
$lang ['adr_dele_hea'] = 'Odstrániť';
$lang ['adr_new_entry'] = 'Nový kontakt';

$lang ['addr_saved'] = 'kontakt bol uložený';
$lang ['addr_added'] = 'kontakt bol pridaný';
$lang ['addr_deleted'] = 'kontakt bol zmazaný';


// [BlockSender]
$lang ['blk_title'] = 'Blokovať odosielateľa';
$lang ['blk_information'] = 'Len ukazuje, e-maily, ktoré nie sú vo filtri, ale';
$lang ['blk_email'] = 'E-mail';
$lang ['blk_no_address'] = 'No adresa k dispozícii';
$lang ['blk_close'] = 'Close';
$lang ['blk_save'] = 'Save';

// [Event]
$lang ['evt_title'] = 'Kalendár udalostí';
$lang ['evt_save'] = 'Save';
$lang ['evt_delete'] = 'Odstrániť';
$lang ['evt_stop'] = 'Čas zastavenie';
$lang ['evt_start'] = 'Čas spustenia';
