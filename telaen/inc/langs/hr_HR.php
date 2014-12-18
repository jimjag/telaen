<?php
/*
 * Croatian (Hrvatski) (canonical list and phrasing)
 */

$lang = array();

// User-friendly imena mape sustava
$lang ['inbox_extended'] = 'Inbox';
$lang ['sent_extended'] = 'Poslano';
$lang ['trash_extended'] = 'mapi za smeće ';
$lang ['spam_extended'] = 'Spam folder';

// Navigation tekstovi
$lang ['pages_text'] = 'Stranice';
$lang ['first_text'] = 'Prva';
$lang ['previous_text'] = 'Prethodna';
$lang ['next_text'] = 'Sljedeće';
$lang ['last_text'] = 'Posljednja';
$lang ['total_text'] = 'Ukupan';

// Mail Server pogreške
$lang ['err_login_msg'] = 'Pogreška prijave';
$lang ['err_system_msg'] = 'Pogreška sustava';
$lang ['error_login'] = 'Molimo provjerite svoje korisničko ime ili zaporku i pokušajte ponovno ';
$lang ['error_connect'] = 'Pogreška pri povezivanju na poslužitelj';
$lang ['error_retrieving'] = 'Pogreška sve vaše poruke, vaš Inbox promijenio';
$lang ['error_session_expired'] = 'Vaša sesija je istekla, molimo prijavite se opet';
$lang ['error_other'] = 'kvara sustava, obratite se administratoru mreže';

// Pogrešna naziv poštanskog sandučića
$lang ['error_invalid_name'] = 'Neispravan naziv mape - Koristite samo sljedeće znakove a-z, A-Z, 0-9, i -';

// Potvrđivanje prilikom slanja mailova
$ Lang ['error_no_recipients'] = 'Pogreška: Morate imati najmanje jednog primatelja';
$lang ['error_compose_invalid_mail1_s'] = 'Pogreška: Ova e-mail adresa čini se da je valjan';
$lang ['error_compose_invalid_mail1_p'] = 'Pogreška: Ova e-mail adrese čini se da valjan ';
$lang ['error_compose_invalid_mail2_s'] = 'Provjerite e-mail adresu prije nego što ponovno poslati ovu poruku. ';
$lang ['error_compose_invalid_mail2_p'] = 'Provjerite svoje adrese prije ponovnog slanja ovog e-mail.';

// Potvrda brisanja
$lang ['confirm_delete'] = '? Da li stvarno želite izbrisati ovu poruku (e)';

// Ako se poruka ne imati subjekt ili pošiljatelja
$lang ['no_subject_text'] = '[Ne podliježe]';
$lang ['no_sender_text'] = '[Sender nepoznato]';
$lang ['no_recipient_text'] = '[primatelj nepoznat]';

// Ako je prekoračena granica kvota
$lang ['quota_exceeded'] = 'Nije dovoljno prostora u vaš poštanski sandučić za dovršetak ovu akciju \ nAko izbrisati neke poruke da i dalje';
$lang ['quota_usage_info'] = 'kvotu';
$lang ['quota_usage_used'] = 'Koristi';
$lang ['quota_usage_of'] = 'od';
$lang ['quota_usage_avail'] = 'dostupan';

//
// Format datuma
//% D = dan,% m = mjesec,% Y = godina,% H = sat,% M = min
// Za potpuni popis pogledajte http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// charset
$lang['default_char_set'] = 'iso-8859-1';

// izbornik
$lang ['messages_mnu'] = 'Inbox';
$lang ['read_menu'] = 'čitanje e-pošte (e)';
$lang ['compose_mnu'] = 'Unesi e-mail ';
$lang ['refresh_mnu'] = 'Osvježi';
$lang ['folders_mnu'] = 'mapa';
$lang ['search_mnu'] = 'Pretraži';
$lang ['address_mnu'] = 'adresar';
$lang ['empty_trash_mnu'] = 'Empty trash';
$lang ['prefs_mnu'] = 'Postavke';
$lang ['logoff_mnu'] = 'Odjava';

// Odgovor
$lang ['reply_prefix'] "Re:" =;
$lang ['forward_prefix'] = 'Fw:';
$lang ['reply_delimiter'] = '--------- Original Message --------';
$lang ['reply_from_hea'] = 'Od:';
$lang ['reply_to_hea'] = 'Da:';
$lang ['reply_cc_hea'] = 'Cc:';
$lang ['reply_date_hea'] = 'Datum:';
$lang ['reply_subject_hea'] = 'Subject:';
// učinjeno


// Stranica specifične Vars

// [Zaglavlja]
$lang ['key_hea'] = 'ključ';
$lang ['value_hea'] = 'Vrijednost';

// [Mape]
$lang ['fld_name_hea'] = 'mapa';
$lang ['fld_messages_hea'] = 'Poruke';
$lang ['fld_size_hea'] = 'Veličina';
$lang ['fld_empty_hea'] = 'Empty';
$lang ['fld_delete_hea'] = 'Izbriši';
$lang ['fld_total'] = 'Ukupno:';
$lang ['fld_make_new'] = 'Izradi novu mapu';
$lang ['folders_to'] 'mape u' =;

// [MessageList]
$lang ['messages_to'] = 'poruke na';
$lang ['no_messages'] = 'Nema novih poruka u svojoj';
$lang ['delete_selected_mnu'] = 'Izbriši';
$lang ['move_selected_mnu'] = 'Move to';
$lang ['mark_selected_mnu'] = 'Mark što pročitate ';
$lang ['unmark_selected_mnu'] = 'označi kao nepročitano ';
$lang ['move_selected_to_trash_mnu'] = 'Premjesti u smeće';


$lang ['delete_mnu'] = 'Izbriši';
$lang ['move_mnu'] = 'Move to';
$lang ['subject_hea'] = 'Subject';
$lang ['from_hea'] = 'Od';
$lang ['to_hea'] = 'Da';
$lang ['date_hea'] = 'Datum';
$lang ['size_hea'] = 'Veličina';
$lang ['have_spam'] = 'Imate Spam (provjerite mapu neželjene pošte)';

$lang ['msg_you_have'] = 'Imate';
$lang ['msg_message'] = 'Poruka';
$lang ['msg_messages'] = 'poruke';

$lang ['msg_more_unread'] = 'nepročitana';
$lang ['msg_one_unread'] = 'nepročitana';
$lang ['msg_none_unread'] = 'nitko čitati';
$lang ['msg_in_the_folder'] = 'u mapu';


// [Prijava]
$lang ['lgn_title'] = 'Prijava';
$lang ['lgn_welcome_msg'] = 'Dobrodošli, prijavite se na svoj račun';
$lang ['lng_user_email'] = 'E-mail';
$lang ['lng_user_name'] = 'ime';
$lang ['lng_user_pwd'] = 'Lozinka';
$lang ['lng_server'] = 'Poslužitelj';
$lang ['lng_theme'] = 'Tema';
$lang ['lng_language'] = 'Jezik';
$lang ['lng_login_btn'] = 'Prijava & gt; & gt;';
$lang ['lng_cookie_not_enabled'] = 'Cookies moraju biti uključeni';
$lang ['lng_cookie_not_valid'] = 'Cookie Sigurnosna provjera nije uspjela ';

// [Newmessage]

$lang ['newmsg_title'] = 'Nova poruka';

$lang ['to_hea'] = 'Da:';
$lang ['cc_hea'] = 'Cc:';
$lang ['bcc_hea'] = 'Bcc:';
$lang ['subject_hea'] = 'Subject:';
$lang ['address_tip'] = 'Od adresar';

$lang ['attach_hea'] = 'Prilog:';
$lang ['attch_add_new'] = 'pričvrstite novu datoteku';
$lang ['attch_name_hea'] = 'Naziv';
$lang ['attch_size'] = 'Veličina';
$lang ['attch_type_hea'] = 'Tip';
$lang ['attch_dele_hea'] = 'Izbriši';
$lang ['attch_no_hea'] = 'Nije privitke';

$lang ['add_signature'] = 'Dodaj potpis';
$lang ['send_text'] = 'Pošalji';

$lang ['result_error'] = 'Nije bilo moguće poslati ovaj e-mail';
$lang ['result_success'] = 'Ova e-mail je poslan';
$lang ['nav_continue'] = '& lt; & lt; Nastavak & gt; & gt; ';
$lang ['nav_back'] = 'Povratak';

$lang ['up_title'] = 'Dodaj datoteku';
$lang ['up_information_text'] = 'Odaberite datoteku';
$lang ['up_button_text'] = 'Priloži datoteku';

$lang ['require_receipt'] = 'povratnicom';

$lang ['priority_text'] = 'Prioritet';
$lang ['priority_low'] = 'Low';
$lang ['priority_normal'] = 'normalno';
$lang ['priority_high'] = 'visoke';

// [Postavke]
$lang ['prf_title'] = 'Postavke';
$lang ['prf_general_title'] = 'Opće informacije';
$lang ['prf_name'] = 'Naziv';
$lang ['prf_reply_to'] = 'Odgovori';
$lang ['prf_time_zone'] = 'Vremenska zona';
$lang ['prf_trash_title'] = 'smeće';
$lang ['prf_save_to_trash'] = 'Kad <b> izbrisati </ b> poruku, premjestiti ga na';
$lang ['prf_save_only_read'] = 'Spremi samo <b> čitati poruke </ b> u';
$lang ['prf_empty_on_exit'] = '<b> Empty </ b> za smeće mapu kada logout ';
$lang ['prf_empty_spam_on_exit'] = '<b> Empty </ b> Spam folder kad logout ';
$lang ['prf_unmark_read_on_exit'] = 'Reset čitati poruke kao nepročitane kada logout ';
$lang ['prf_sent_title'] = 'poslane';
$lang ['prf_save_sent'] = 'Spremi <b> poslane poruke </ b> u';
$lang ['prf_messages_title'] = 'Poruke';
$lang ['prf_page_limit'] = 'Najveći broj poruka po stranici';
$lang ['prf_signature_title'] = 'potpis';
$lang ['prf_signature'] = 'Napišite svoj potpis';
$lang ['prf_auto_add_sign'] = 'Dodaj svoj potpis na sve odlazne poruke';
$lang ['prf_save_button'] = 'Spremi postavke';
$lang ['prf_display_images'] = 'Show prilogu slika';
$lang ['prf_default_editor_mode'] = 'Default način obrade';
$lang ['prf_default_editor_mode_text'] = '"Običan tekst"';
$lang ['prf_default_editor_mode_html'] = '"Advanced HTML urednik"';
$lang ['prf_time_to_refesh'] = 'Automatski provjerava novu e-poštu (minuta)';
$lang ['prf_spam_level'] = 'osjetljivost SPAM (0 = onemogućeno, 1 = vrlo visoka, 9 = vrlo nizak)';
$lang ['prf_auto_require_receipt'] = 'Zahtijevati čitanje primitak po defaultu';

$lang ['prf_msg_saved'] = 'Postavke spasio';

// filteri
$lang ['filter_title'] = 'Filteri';

$lang ['filter_new'] = 'Izradi filtar ';
$lang ['filter_desc'] = 'Odaberite kriterijima i akcije za dolazne poruke';
$lang ['filter_list'] = 'Aktualni filtri';

$lang ['filter_field_from'] = 'Od';
$lang ['filter_field_to'] = 'Da';
$lang ['filter_field_subject'] = 'Subject';
$lang ['filter_field_header'] = 'zaglavlja';
$lang ['filter_field_body'] = 'tijelo';

$lang ['filter_type_move'] = 'Move';
$lang ['filter_type_delete'] = 'Izbriši';
$lang ['filter_type_mark'] = 'Pročitano';

$lang ['filter_add'] = 'Dodaj filter ';
$lang ['filter_delete'] = 'Izbriši';
$lang ['filter_delete_selected'] = 'Izbriši odabrane filtre';

$lang ['filter_field'] = 'Filter na terenu ';
$lang ['filter_match'] = 'Pretraži';
$lang ['FILTER_TYPE'] = 'Akcija';
$lang ['filter_folder'] = 'Odredište mapa';

$lang ['filter_msg_nofilters'] = 'Nema dostupnih filtera.';
$lang ['filter_msg_added'] = 'Filter dodao';
$lang ['filter_msg_deleted'] = 'Filter izbrisan';


// [Catch]
$lang ['ctc_title'] = 'Dodaj u adresar';
$lang ['ctc_information'] = 'pokazuje samo e-mailova koje nisu u adresar';
$lang ['ctc_name'] = 'Naziv';
$lang ['ctc_email'] = 'E-mail';
$lang ['ctc_no_address'] = 'Nije adresa dostupan';
$lang ['ctc_close'] = 'Zatvori';
$lang ['ctc_save'] = 'Spremi';

// [Readmsg]
$lang ['next_mnu'] = 'Sljedeće';
$lang ['previous_mnu'] = 'Prethodna';
$lang ['back_mnu'] = 'Povratak';
$lang ['reply_mnu'] = 'Odgovori';
$lang ['reply_all_mnu'] = 'Odgovori svima ';
$lang ['forward_mnu'] = 'Naprijed';
$lang ['headers_mnu'] = 'zaglavlja';
$lang ['move_mnu'] = 'Move to';
$lang ['move_to_trash_mnu'] = 'Premjesti u smeće';
$lang ['delete_mnu'] = 'Izbriši';
$lang ['print_mnu'] = 'Print';
$lang ['download_mnu'] = 'Preuzimanje';

$lang ['from_hea'] = 'Od:';
$lang ['to_hea'] = 'Da:';
$lang ['cc_hea'] = 'Cc:';
$lang ['date_hea'] = 'Datum:';
$lang ['subject_hea'] = 'Subject:';
$lang ['attach_hea'] = 'Prilog:';

$lang ['attch_name_hea'] = 'Naziv';
$lang ['attch_force_hea'] = 'Preuzimanje';
$lang ['attch_type_hea'] = 'Tip';
$lang ['attch_size_hea'] = 'Veličina';
$lang ['catch_address'] = 'Dodaj u adresar';
$lang ['block_address'] = 'Block adresu';

// [Traži]
$lang ['sch_title'] = 'Pretraži';
$lang ['sch_information_text'] = '.. Napišite izraz ili riječ koju tražite <br> samo čitati poruke će se tražiti';
$lang ['sch_button_text'] = 'Pretraži & gt; & gt;';
$lang ['sch_subject_hea'] = 'Subject';
$lang ['sch_from_hea'] = 'Od';
$lang ['sch_date_hea'] = 'Datum';
$lang ['sch_body_hea'] = 'Poruka tijelo';
$lang ['sch_folder_hea'] = 'mapa';
$lang ['sch_no_results'] = 'Nema poruka odgovaraju vašim kriterijima su otkrili';

// [QuickAddress]
$lang ['qad_title'] = 'adresar';
$lang ['qad_select_address'] = 'Odaberite kontakt';
$lang ['qad_to'] = 'Da';
$lang ['qad_cc'] = 'Cc';
$lang ['qad_bcc'] = 'Bcc';

// [Adresar]
// Uredi / display
$lang ['adr_title'] = 'adresar';
$lang ['adr_name'] = 'Naziv';
$lang ['adr_email'] = 'E-mail';
$lang ['adr_street'] = 'Street';
$lang ['adr_city'] = 'City';
$lang ['adr_state'] = 'Država';
$lang ['adr_work'] = 'Rad';
$lang ['adr_back'] = 'Povratak';
$lang ['adr_save'] = 'Spremi';
$lang ['adr_phone'] = 'Telefon';
$lang ['adr_cell'] = 'Cell';
$lang ['adr_note'] = 'Napomena';

// popis
$lang ['adr_name_hea'] = 'Naziv';
$lang ['adr_email_hea'] = 'E-mail';
$lang ['adr_edit_hea'] = 'Uredi';
$lang ['adr_expo_hea'] = 'Izvoz';
$lang ['adr_dele_hea'] = 'Izbriši';
$lang ['adr_new_entry'] = 'Novi kontakt';

$lang ['addr_saved'] = 'kontakt spremljen';
$lang ['addr_added'] = 'Kontakt je dodao';
$lang ['addr_deleted'] = 'Kontakt je izbrisan';


// [BlockSender]
$lang ['blk_title'] = 'Block pošiljatelja';
$lang ['blk_information'] = 'pokazuje samo e-mailova koje nisu u filter još';
$lang ['blk_email'] = 'E-mail';
$lang ['blk_no_address'] = 'Nije adresa dostupan';
$lang ['blk_close'] = 'Zatvori';
$lang ['blk_save'] = 'Spremi';

// [Event]
$lang ['evt_title'] = 'Kalendar događaja';
$lang ['evt_save'] = 'Spremi';
$lang ['evt_delete'] = 'Izbriši';
$lang ['evt_stop'] = 'Zaustavite vrijeme';
$lang ['evt_start'] = 'Vrijeme početka';
