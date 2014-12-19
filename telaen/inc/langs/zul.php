<?php
/*
 * Zulu (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Ibhokisi lokunge';
$lang['sent_extended'] = 'Sent izinto';
$lang['trash_extended'] = 'ifolda Trash';
$lang['spam_extended'] = 'ogaxekile folda';

// Navigation texts
$lang['pages_text'] = 'amakhasi';
$lang['first_text'] = 'Okokuqala';
$lang['previous_text'] = 'Previous';
$lang['next_text'] = 'Okulandelayo';
$lang['last_text'] = 'Last'; // FIXME: need translation
$lang['total_text'] = 'Total'; // FIXME: need translation

// Mail Server Errors
$lang['err_login_msg'] = 'ngesiphambeko Login';
$lang['err_system_msg'] = 'ngesiphambeko System';
$lang['error_login'] = 'Sicela uhlole igama lomsebenzisi noma iphasiwedi yakho bese uzama futhi';
$lang['error_connect'] = 'Iphutha yokuxhuma kwiseva';
$lang['error_retrieving'] = 'Iphutha ekutholeni imilayezo yakho, Ibhokisi lokunge kwakho sekushintshile';
$lang['error_session_expired'] = 'session yakho iphelelwe yisikhathi, sicela ungene futhi';
$lang['error_other'] = 'ukwehluleka System, sicela uxhumane wenethiwekhi yakho nomqondisi';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Igama lesikhwama elingalungile - Sebenzisa kuphela abalingiswa ezilandelayo AZ, az, 0-9, futhi -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Iphutha: Kufanele ube okungenani umamukeli oyedwa';
$lang['error_compose_invalid_mail1_s'] = 'Iphutha: Leli kheli le-e-mail ibonakala invalid';
$lang['error_compose_invalid_mail1_p'] = 'Iphutha: Leli e-mail amakheli babonakala invalid';
$lang['error_compose_invalid_mail2_s'] = 'Hlola ikheli le-imeyili ngaphambi uthumele le-imeyili.';
$lang['error_compose_invalid_mail2_p'] = 'Hlola amakheli zakho ngaphambi uthumele le-imeyili.';

// Confirmation of delete
$lang['confirm_delete'] = '? Ingabe ngempela ufuna ukususa lomyalezo (s)';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[No isihloko]';
$lang['no_sender_text'] = '[Umthumeli ongaziwa]';
$lang['no_recipient_text'] = '[Umamukeli ongaziwa]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Hhayi isikhala esanele ebhokisini lakho lokungenayo ukuqedela lesi senzo \ nSicela ususe ezinye imiyalezo ukuqhubeka';
$lang['quota_usage_info'] = 'Isabelo Umkhawulo';
$lang['quota_usage_used'] = 'Used'; // FIXME: need translation
$lang['quota_usage_of'] = 'of'; // FIXME: need translation
$lang['quota_usage_avail'] = 'ezikhona';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// Menu
$lang['messages_mnu'] = 'Ibhokisi lokunge';
$lang['read_menu'] = 'Funda E-Mail (s)';
$lang['compose_mnu'] = 'Loba E-Mail';
$lang['refresh_mnu'] = 'Vuselela';
$lang['folders_mnu'] = 'yewebhu';
$lang['search_mnu'] = 'Funa';
$lang['address_mnu'] = 'Incwadi Ikheli';
$lang['empty_trash_mnu'] = 'kadoti Empty';
$lang['prefs_mnu'] = 'Izintandokazi';
$lang['logoff_mnu'] = 'Qeda';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'FW:';
$lang['reply_delimiter'] = '--------- Umlayezo Original --------';
$lang['reply_from_hea'] = 'From:';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Usuku:';
$lang['reply_subject_hea'] = 'Isihloko:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'Ifolda';
$lang['fld_messages_hea'] = 'Imilayezo';
$lang['fld_size_hea'] = 'Size'; // FIXME: need translation
$lang['fld_empty_hea'] = 'Empty'; // FIXME: need translation
$lang['fld_delete_hea'] = 'Susa';
$lang['fld_total'] = 'Total:'; // FIXME: need translation
$lang['fld_make_new'] = 'Yakha ifolda entsha';
$lang['folders_to'] = 'Amafolda ukuba';

// [MessageList]
$lang['messages_to'] = 'Imibiko ukuba';
$lang['no_messages'] = 'Ayikho imilayezo emisha yakho';
$lang['delete_selected_mnu'] = 'Susa';
$lang['move_selected_mnu'] = 'Move ukuba';
$lang['mark_selected_mnu'] = 'uMarku njengoba ufunda';
$lang['unmark_selected_mnu'] = 'Mark njengezingafundiwe';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation


$lang['delete_mnu'] = 'Susa';
$lang['move_mnu'] = 'Move ukuba';
$lang['subject_hea'] = 'Isihloko:';
$lang['from_hea'] = 'From:'; // FIXME: need translation
$lang['to_hea'] = 'To:'; // FIXME: need translation
$lang['date_hea'] = 'Usuku:';
$lang['size_hea'] = 'Size'; // FIXME: need translation
$lang['have_spam'] = 'You ube Ogaxekile (hlola ifolda Spam)';

$lang['msg_you_have'] = 'Wena babe';
$lang['msg_message'] = 'umyalezo';
$lang['msg_messages'] = 'imiyalezo';

$lang['msg_more_unread'] = 'engafundiwe';
$lang['msg_one_unread'] = 'engafundiwe';
$lang['msg_none_unread'] = 'akukho ukufunda';
$lang['msg_in_the_folder'] = 'kwifolda';


// [Login]
$lang['lgn_title'] = 'Login';
$lang['lgn_welcome_msg'] = 'Siyakwamukela, sicela ungene ku-akhawunti yakho';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Igama lomsebenzisi';
$lang['lng_user_pwd'] = 'Iphasiwedi';
$lang['lng_server'] = 'Server'; // FIXME: need translation
$lang['lng_theme'] = 'Theme'; // FIXME: need translation
$lang['lng_language'] = 'Ulimi';
$lang['lng_login_btn'] = 'Login &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Amakhukhi kumele inikwe amandla';
$lang['lng_cookie_not_valid'] = 'Cookie Security Hlola Yehlulekile';

// [Newmessage]

$lang['newmsg_title'] = 'Uqambe imeyili';

$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Isihloko:';
$lang['address_tip'] = 'Kusuka ibhuku lamakheli';

$lang['attach_hea'] = 'Okunamathiselwe:';
$lang['attch_add_new'] = 'Namathisela ifayela entsha';
$lang['attch_name_hea'] = 'Igama';
$lang['attch_size'] = 'Size'; // FIXME: need translation
$lang['attch_type_hea'] = 'Type'; // FIXME: need translation
$lang['attch_dele_hea'] = 'Susa';
$lang['attch_no_hea'] = 'Akukho okunamathiselwe';

$lang['add_signature'] = 'Faka isignesha';
$lang['send_text'] = 'Thumela';

$lang['result_error'] = 'It kwakungenakwenzeka ukuthumela le-e-mail';
$lang['result_success'] = 'Le e-mail ithunyelwe';
$lang['nav_continue'] = '&lt;&lt; Qhubeka &gt;&gt; ';
$lang['nav_back'] = 'Back'; // FIXME: need translation

$lang['up_title'] = 'Faka ifayela';
$lang['up_information_text'] = 'ifayela Khetha';
$lang['up_button_text'] = 'Namathisela ifayela';

$lang['require_receipt'] = 'irisidi Return';

$lang['priority_text'] = 'Priority'; // FIXME: need translation
$lang['priority_low'] = 'Phansi';
$lang['priority_normal'] = 'Normal'; // FIXME: need translation
$lang['priority_high'] = 'High'; // FIXME: need translation

// [Preferences]
$lang['prf_title'] = 'Izintandokazi';
$lang['prf_general_title'] = 'imininingwane General';
$lang['prf_name'] = 'Igama';
$lang['prf_reply_to'] = 'Phendula ukuba';
$lang['prf_time_zone'] = 'zone Isikhathi';
$lang['prf_trash_title'] = 'Trash'; // FIXME: need translation
$lang['prf_save_to_trash'] = 'Uma you <b> susa </ b> umyalezo, ukuhambisa yona';
$lang['prf_save_only_read'] = 'Gcina nje <b> ukufunda imilayezo </ b> in the';
$lang['prf_empty_on_exit'] = '<b> Empty </ b> kadoti ifolda uma wena uphume';
$lang['prf_empty_spam_on_exit'] = '<b> Empty </ b> Spam ifolda uma wena uphume';
$lang['prf_unmark_read_on_exit'] = 'Setha kabusha FUNDA imiyalezo njengoba engafundiwe uma wena uphume';
$lang['prf_sent_title'] = 'izinto Sent';
$lang['prf_save_sent'] = 'Londoloza <b> wathumela izigijimi </ b> in the';
$lang['prf_messages_title'] = 'Imilayezo';
$lang['prf_page_limit'] = 'isibalo esiphezulu of imiyalezo ngekhasi ngalinye';
$lang['prf_signature_title'] = 'Signature';
$lang['prf_signature'] = 'Bhala isiginesha yakho';
$lang['prf_auto_add_sign'] = 'Engeza isiginesha yakho zonke izigijimi ephumayo';
$lang['prf_save_button'] = 'Londoloza izintandokazi';
$lang['prf_display_images'] = 'Veza izithombe linamathele';
$lang['prf_default_editor_mode'] = 'Okuzenzakalelayo edit mode';
$lang['prf_default_editor_mode_text'] = '"text Plain"';
$lang['prf_default_editor_mode_html'] = '"Umhleli Advanced HTML"';
$lang['prf_time_to_refesh'] = 'hlola ngokuzenzakalela for imeyili entsha (imizuzu)';
$lang['prf_spam_level'] = 'Opheland sensitivity (0 = Abakhubazekile, 1 = High Very, 9 = Phansi kakhulu)';
$lang['prf_auto_require_receipt'] = 'Dinga irisidi ukufunda ngokuzenzakalela';

$lang['prf_msg_saved'] = 'Izintandokazi wasindisa';

// filters
$lang['filter_title'] = 'Okuhlungayo';

$lang['filter_new'] = 'Yakhani lemifanekiso';
$lang['filter_desc'] = 'Khetha criteria search kanye action for the imiyalezo engenayo';
$lang['filter_list'] = 'izihlungi Current';

$lang['filter_field_from'] = 'Kusuka';
$lang['filter_field_to'] = 'To';
$lang['filter_field_subject'] = 'Kuncike';
$lang['filter_field_header'] = 'Header'; // FIXME: need translation
$lang['filter_field_body'] = 'Body'; // FIXME: need translation

$lang['filter_type_move'] = 'Move'; // FIXME: need translation
$lang['filter_type_delete'] = 'Susa';
$lang['filter_type_mark'] = 'UMarku wafunda';

$lang['filter_add'] = 'Faka lemifanekiso';
$lang['filter_delete'] = 'Susa';
$lang['filter_delete_selected'] = 'Susa ukuhlunga abakhethiwe';

$lang['filter_field'] = 'Ihluzo on indima';
$lang['filter_match'] = 'Search for';
$lang['filter_type'] = 'Action'; // FIXME: need translation
$lang['filter_folder'] = 'Destination ifolda';

$lang['filter_msg_nofilters'] = 'Akukho okuhlungayo atholakalayo.';
$lang['filter_msg_added'] = 'Ihluzo added';
$lang['filter_msg_deleted'] = 'Ihluzo kusulwe';


// [Catch]
$lang['ctc_title'] = 'Faka ibhuku';
$lang['ctc_information'] = 'lubonisa kuphela e-mail ezingekho encwadini inkulumo';
$lang['ctc_name'] = 'Igama';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Akukho kheli ezikhona';
$lang['ctc_close'] = 'Close'; // FIXME: need translation
$lang['ctc_save'] = 'Londoloza';

// [Readmsg]
$lang['next_mnu'] = 'Okulandelayo';
$lang['previous_mnu'] = 'Previous'; // FIXME: need translation
$lang['back_mnu'] = 'Back'; // FIXME: need translation
$lang['reply_mnu'] = 'Reply'; // FIXME: need translation
$lang['reply_all_mnu'] = 'Phendula konke';
$lang['forward_mnu'] = 'Phambili';
$lang['headers_mnu'] = 'Header'; // FIXME: need translation
$lang['move_mnu'] = 'Move ukuba';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation
$lang['delete_mnu'] = 'Susa';
$lang['print_mnu'] = 'Phrinta';
$lang['download_mnu'] = 'Thwebula';

$lang['from_hea'] = 'From:';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Usuku:';
$lang['subject_hea'] = 'Isihloko:';
$lang['attach_hea'] = 'Okunamathiselwe:';

$lang['attch_name_hea'] = 'Igama';
$lang['attch_force_hea'] = 'Thwebula';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Size';
$lang['catch_address'] = 'Faka ibhuku';
$lang['block_address'] = 'Block inkulumo';

// [Search]
$lang['sch_title'] = 'Funa';
$lang['sch_information_text'] = '.. Bhala umusho noma igama ufuna khulula ukufunda imiyalezo siyofunwa kuphela';
$lang['sch_button_text'] = 'Funa &gt;&gt;';
$lang['sch_subject_hea'] = 'Kuncike';
$lang['sch_from_hea'] = 'Kusuka';
$lang['sch_date_hea'] = 'Usuku';
$lang['sch_body_hea'] = 'Body Message'; // FIXME: need translation
$lang['sch_folder_hea'] = 'Ifolda';
$lang['sch_no_results'] = 'Ayikho imiyalezo criteria zakho zindlela ziye zatholakala';

// [QuickAddress]
$lang['qad_title'] = 'Incwadi Ikheli';
$lang['qad_select_address'] = 'Khetha oxhumana';
$lang['qad_to'] = 'To';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Incwadi Ikheli';
$lang['adr_name'] = 'Igama';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street'; // FIXME: need translation
$lang['adr_city'] = 'City'; // FIXME: need translation
$lang['adr_state'] = 'State'; // FIXME: need translation
$lang['adr_work'] = 'Umsebenzi';
$lang['adr_back'] = 'Back'; // FIXME: need translation
$lang['adr_save'] = 'Londoloza';
$lang['adr_phone'] = 'Phone'; // FIXME: need translation
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'Igama';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Edit'; // FIXME: need translation
$lang['adr_expo_hea'] = 'Export'; // FIXME: need translation
$lang['adr_dele_hea'] = 'Susa';
$lang['adr_new_entry'] = 'New contact'; // FIXME: need translation

$lang['addr_saved'] = 'Le contact igciniwe';
$lang['addr_added'] = 'Oxhumana naye wanezela';
$lang['addr_deleted'] = 'Le contact isusiwe';


// [BlockSender]
$lang['blk_title'] = 'Block kumthumeli';
$lang['blk_information'] = 'lubonisa kuphela e-mail ezingekho kule lemifanekiso okwamanje';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Akukho kheli ezikhona';
$lang['blk_close'] = 'Close'; // FIXME: need translation
$lang['blk_save'] = 'Londoloza';

// [Event]
$lang['evt_title'] = 'Ikhalenda Indawo';
$lang['evt_save'] = 'Londoloza';
$lang['evt_delete'] = 'Susa';
$lang['evt_stop'] = 'Yekani nesikhathi';
$lang['evt_start'] = 'Qala isikhathi';

