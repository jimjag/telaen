<? PHP
/ *
  *-Istati Uniti Ingliż (lista canonical u diċitura)
  * /

$lang = array();

// Faċli għall-utent ismijiet għal sistema folders
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'oġġetti Mibgħuta';
$lang['trash_extended'] "folder Trash" =;
$lang['spam_extended'] = 'folder Spam';
// Testi Navigazzjoni
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'Ewwel';
$lang['previous_text'] = 'Preċedenti';
$lang['next_text'] = 'Li jmiss';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';
// Żbalji Mail Server
$lang['err_login_msg'] = 'żball Login';
$lang['err_system_msg'] "żball Sistema" =;
$lang['error_login'] = 'Jekk jogħġbok iċċekkja username tiegħek jew il-password u erġa 'pprova';
$lang['error_connect'] "Error konnessjoni għall-server" =;
$lang['error_retrieving'] = 'Error jkollna messaġġi tiegħek, Inbox tiegħek tkun inbidlet';
$lang['error_session_expired'] = 'sessjoni tiegħek huwa skada, jekk jogħġbok login għal darb'oħra';
$lang['error_other'] "falliment tas-Sistema, jekk jogħġbok ikkuntattja amministratur tan-netwerk tiegħek" =;

// Isem Invalid tal-mailbox
$lang['error_invalid_name'] = 'isem folder Invalid - Uża biss il-karattri li ġejjin AZ, az, 0-9, u -';
// Validazzjonijiet meta jibagħtu mails
$lang['error_no_recipients'] = 'Error:! Irid ikollok reċipjent inqas wieħed';
$lang['error_compose_invalid_mail1_s'] = 'Error: Dan l-indirizz e-mail jidher li jkun invalidi';
$lang['error_compose_invalid_mail1_p'] = 'Error: Dan le-mail indirizzi jidhru bħala invalidi';
$lang['error_compose_invalid_mail2_s'] = 'Iċċekkja l-indirizz e-mail qabel jigi msewwi din l-email.';
$lang['error_compose_invalid_mail2_p'] = 'Iċċekkja l-indirizzi tiegħek qabel jigi msewwi din l-email.';
// Konferma ta ħassar
$lang['confirm_delete'] = '? Do you verament tixtieq li tħassar dan il-messaġġ (i)';
// Jekk il-messaġġ ma jkollu suġġett jew mittent
$lang['no_subject_text'] = '[Ebda suġġett]';
$lang['no_sender_text'] = '[mhux magħruf Sender]';
$lang['no_recipient_text'] = '[Riċevitur mhux magħruf]';
// Jekk il-limitu tal-kwota nqabeż
$lang['quota_exceeded'] = 'Mhux biżżejjed spazju fil inbox tiegħek biex jitlesta din l-azzjoni \ nPlease ħassar xi messaġġi li tkompli';
$lang['quota_usage_info'] = 'limitu tal-kwota';
$lang['quota_usage_used'] = 'Użati';
$lang['quota_usage_of'] = 'tal-';
$lang['quota_usage_avail'] = 'disponibbli';
//
// Data Format
//% Y = sena% d = ġurnata,% m = xahar,,% H = siegħa,% M = il minuta
// Għal lista kompluta, ara http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// charset
$lang['default_char_set'] = 'iso 8859-1';
// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Aqra E-Mail (s)';
$lang['compose_mnu'] = 'Write E-Mail';
$lang['refresh_mnu'] = 'Riffriskar';
$lang['folders_mnu'] = 'folders';
$lang['search_mnu'] = 'Fittex';
$lang['address_mnu'] = 'ktieb Indirizz';
$lang['empty_trash_mnu'] = 'Trash vojta';
$lang['prefs_mnu'] = 'Preferenzi';
$lang['logoff_mnu'] = 'Log out';
// Tweġiba
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'FW:';
$lang['reply_delimiter'] = '--------- Messaġġ Oriġinali --------';
$lang['reply_from_hea'] = 'Minn:';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] "Data:" =;
$lang['reply_subject_hea'] = 'Suġġett:';
// isir


// Speċifiċi għall-paġna VARs

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'valur';
// [Folders]
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'Messaġġi';
$lang['fld_size_hea'] = 'Daqs';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Ħassar';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'Oħloq folder ġdid';
$lang['folders_to'] "folders għal" =;

// [MessageList]
$lang['messages_to'] "Messaġġi għal" =;
$lang['no_messages'] = 'Ebda messaġġi ġodda fil tiegħek';
$lang['delete_selected_mnu'] = 'Ħassar';
$lang['move_selected_mnu'] "Move għal" =;
$lang['mark_selected_mnu'] = 'Mark kif jinqara';
$lang['unmark_selected_mnu'] = 'Mark bħala unread';
$lang['move_selected_to_trash_mnu'] "Move li Trash" =;


$lang['delete_mnu'] = 'Ħassar';
$lang['move_mnu'] "Move għal" =;
$lang['subject_hea'] = 'Suġġett:';
$lang['from_hea'] = 'Minn:';
$lang['to_hea'] = 'To:';
$lang['date_hea'] "Data:" =;
$lang['size_hea'] = 'Daqs';
$lang['have_spam'] = 'Int għandek Spam (check folder spam)';
$lang['msg_you_have'] = 'Int għandek';
$lang['msg_message'] = 'messaġġ';
$lang['msg_messages'] "Messaġġi" =;

$lang['msg_more_unread'] = 'unread';
$lang['msg_one_unread'] = 'unread';
$lang['msg_none_unread'] = 'xejn biex jinqara';
$lang['msg_in_the_folder'] = 'fil-folder';
// [Login]
$lang['lgn_title'] = 'Login';
$lang['lgn_welcome_msg'] = 'Merħba, jekk jogħġbok login fil-kont tiegħek';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Username';
$lang['lng_user_pwd'] = 'Password';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Lingwa';
$lang['lng_login_btn'] = 'Login & gt; & gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies għandha tkun mixgħula';
$lang['lng_cookie_not_valid'] = 'Check Cookie Sigurtà rnexxielhomx';
// [Newmessage]

$lang['newmsg_title'] = 'Ikteb posta';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Suġġett:';
$lang['address_tip'] = 'Minn indirizz ktieb';
$lang['attach_hea'] = 'Attachment:';
$lang['attch_add_new'] = 'Waħħal fajl ġdid';
$lang['attch_name_hea'] = 'Isem';
$lang['attch_size'] = 'Daqs';
$lang['attch_type_hea'] = 'Tip';
$lang['attch_dele_hea'] = 'Ħassar';
$lang['attch_no_hea'] = 'Ebda attachments';
$lang['add_signature'] = 'Żid firma';
$lang['send_text'] = 'Ibgħat';
$lang['result_error'] = 'Ma kienx possibbli li tibgħat din l-email';
$lang['result_success'] = 'Dan le-mail ntbagħtet';
$lang['nav_continue'] = '& lt; & lt; Kompli & gt; & gt; ';
$lang['nav_back'] = 'Lura';
$lang['up_title'] = 'Żid fajl';
$lang['up_information_text'] = 'file Agħżel';
$lang['up_button_text'] = 'Waħħal fajl';
$lang['require_receipt'] = 'riċevuta Ritorn';
$lang['priority_text'] = 'Prijorità';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'normali';
$lang['priority_high'] = 'High';
// [Preferenzi]
$lang['prf_title'] = 'Preferenzi';
$lang['prf_general_title'] = 'Informazzjoni Ġenerali';
$lang['prf_name'] = 'Isem';
$lang['prf_reply_to'] = 'Reply to';
$lang['prf_time_zone'] = 'żona Time';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Meta inti <b> ħassar </ b> messaġġ, jmexxuha għal';
$lang['prf_save_only_read'] = 'Save biss <b> taqra messaġġi </ b> fil-';
$lang['prf_empty_on_exit'] = '<b> Empty </ b> folder Trash meta inti logout';
$lang['prf_empty_spam_on_exit'] = '<b> Empty </ b> folder Spam meta inti logout';
$lang['prf_unmark_read_on_exit'] = 'Irrisettja AQRA messaġġi kif unread meta inti logout';
$lang['prf_sent_title'] = 'oġġetti Sent';
$lang['prf_save_sent'] = 'Save <b> mibgħuta messaġġi </ b> fil-';
$lang['prf_messages_title'] = 'Messaġġi';
$lang['prf_page_limit'] = 'Numru massimu ta messaġġi għal kull paġna';
$lang['prf_signature_title'] = 'firma';
$lang['prf_signature'] = 'Ikteb firma tiegħek';
$lang['prf_auto_add_sign'] = 'Żid firma tiegħek kollha l-messaġġi ħierġa';
$lang['prf_save_button'] = 'Preferenzi Save';
$lang['prf_display_images'] = 'Show stampi mehmuża';
$lang['prf_default_editor_mode'] = 'Default modalità editja';
$lang['prf_default_editor_mode_text'] = '" test Plain "';
$lang['prf_default_editor_mode_html'] = '" editur Advanced HTML "';
$lang['prf_time_to_refesh'] = 'Awtomatikament jikkontrolla għal posta ġdida (minuti)';
$lang['prf_spam_level'] "sensittività SPAM (0 =-Persuni b'Diżabbiltà, 1 = Għolja Ħafna, 9 = Baxxa ħafna)" =;
$lang['prf_auto_require_receipt'] = 'Jeħtieġu irċevuta tinqara mill default';
$lang['prf_msg_saved'] = 'Preferenzi salvati';
// filtri
$lang['filter_title'] = 'Filtri';
$lang['filter_new'] = 'Oħloq filtru';
$lang['filter_desc'] = 'Agħżel il-kriterji ta tiftix u l-azzjoni għall-messaġġi deħlin';
$lang['filter_list'] = 'filtri kurrenti';
$lang['filter_field_from'] = 'Minn';
$lang['filter_field_to'] = 'Biex';
$lang['filter_field_subject'] = 'Suġġett';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'korp';
$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Ħassar';
$lang['filter_type_mark'] = 'Mark jinqara';
$lang['filter_add'] = 'Żid filtru';
$lang['filter_delete'] = 'Ħassar';
$lang['filter_delete_selected'] = 'Ħassar filtri magħżula';
$lang['filter_field'] "Iffiltra dwar il-qasam" =;
$lang['filter_match'] = 'Tiftix għal';
$lang['filter_type'] = 'Azzjoni';
$lang['filter_folder'] = 'folder Destinazzjoni';
$lang['filter_msg_nofilters'] = 'Ebda filtri disponibbli.';
$lang['filter_msg_added'] = 'Filtru miżjud';
$lang['filter_msg_deleted'] = 'Filtru mħassra';
// [Qabda]
$lang['ctc_title'] = 'Żid biex jindirizzaw ktieb';
$lang['ctc_information'] = 'turi biss e-mails li mhumiex fil-ktieb l-indirizz';
$lang['ctc_name'] = 'Isem';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Le indirizz disponibbli';
$lang['ctc_close'] = 'Agħlaq';
$lang['ctc_save'] = 'Save';
// [Readmsg]
$lang['next_mnu'] = 'Li jmiss';
$lang['previous_mnu'] = 'Preċedenti';
$lang['back_mnu'] = 'Lura';
$lang['reply_mnu'] = 'Reply';
$lang['reply_all_mnu'] = 'Risposta għal kulħadd';
$lang['forward_mnu'] = 'Forward';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] "Move għal" =;
$lang['move_to_trash_mnu'] "Move li Trash" =;
$lang['delete_mnu'] = 'Ħassar';
$lang['print_mnu'] = 'Stampa';
$lang['download_mnu'] = 'Download';
$lang['from_hea'] = 'Minn:';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] "Data:" =;
$lang['subject_hea'] = 'Suġġett:';
$lang['attach_hea'] = 'Attachment:';
$lang['attch_name_hea'] = 'Isem';
$lang['attch_force_hea'] = 'Download';
$lang['attch_type_hea'] = 'Tip';
$lang['attch_size_hea'] = 'Daqs';
$lang['catch_address'] = 'Żid biex jindirizzaw ktieb';
$lang['block_address'] = 'Blokk indirizz';
// [Fittex]
$lang['sch_title'] = 'Fittex';
$lang['sch_information_text'] = '.. Ikteb frażi jew kelma li inti qed tfittex <br> Biss taqra messaġġi se jiġu mfittxija';
$lang['sch_button_text'] = 'Search & gt; & gt;';
$lang['sch_subject_hea'] = 'Suġġett';
$lang['sch_from_hea'] = 'Minn';
$lang['sch_date_hea'] = 'Data';
$lang['sch_body_hea'] = 'messaġġ Korp';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Ebda messaġġi li jaqblu mal-kriterji tiegħek jkunu nstabu';
// [QuickAddress]
$lang['qad_title'] = 'ktieb Indirizz';
$lang['qad_select_address'] = 'Agħżel kuntatt';
$lang['qad_to'] = 'Biex';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';
// [AddressBook]
// Jeditjaw / wiri
$lang['adr_title'] = 'ktieb Indirizz';
$lang['adr_name'] = 'Isem';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Triq';
$lang['adr_city'] = 'city';
$lang['adr_state'] = 'Stat';
$lang['adr_work'] = 'xogħol';
$lang['adr_back'] = 'Lura';
$lang['adr_save'] = 'Save';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Noti';
// lista
$lang['adr_name_hea'] = 'Isem';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Edit';
$lang['adr_expo_hea'] = 'esportazzjoni';
$lang['adr_dele_hea'] = 'Ħassar';
$lang['adr_new_entry'] = 'New kuntatt';
$lang['addr_saved'] = 'Il-kuntatt ġie salvat';
$lang['addr_added'] = 'Il-kuntatt ġie miżjud';
$lang['addr_deleted'] = 'Il-kuntatt ġiet imħassra';
// [BlockSender]
$lang['blk_title'] = 'Blokk mittent';
$lang['blk_information'] = 'turi biss e-mails li mhumiex fil-filtru għadhom';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Le indirizz disponibbli';
$lang['blk_close'] = 'Agħlaq';
$lang['blk_save'] = 'Save';
// [Avveniment]
$lang['evt_title'] = 'Ġrajjiet';
$lang['evt_save'] = 'Save';
$lang['evt_delete'] = 'Ħassar';
$lang['evt_stop'] = 'Stop żmien';
$lang['evt_start'] = 'Start żmien';
