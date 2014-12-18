<?php
/*
 * Irish (Gaedhilge) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'R-phost Isteach';
$lang['sent_extended'] = 'ítimí Seolta';
$lang['trash_extended'] = 'fillteán Bruscar';
$lang['spam_extended'] = 'fillteán Spam';

// Navigation texts
$lang['pages_text'] = 'Leathanaigh';
$lang['first_text'] = 'An chéad';
$lang['previous_text'] = 'Ar ais';
$lang['next_text'] = 'Ar Aghaidh';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Iomlán';

// Mail Server Errors
$lang['err_login_msg'] = 'earráid Logáil';
$lang['err_system_msg'] = 'Córas earráid';
$lang['error_login'] = 'Déan seiceáil ar do ainm úsáideora nó ar do phasfhocal agus bain triail eile';
$lang['error_connect'] = 'Earráid ag nascadh leis an bhfreastalaí';
$lang['error_retrieving'] = 'Earráid ag fáil do theachtaireachtaí, tá do R-phost Isteach athrú';
$lang['error_session_expired'] = 'Tá do seisiún in éag, le do thoil logáil isteach arís';
$lang['error_other'] = 'Córas teip, téigh i dteagmháil le do riarthóir líonra';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'An t-ainm fillteán Neamhbhailí - Bain úsáid as ach na carachtair seo a leanas AZ, az, 0-9, agus -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Earráid:! Ní mór duit a bheith faighteoir amháin ar a laghad';
$lang['error_compose_invalid_mail1_s'] = 'Earráid: Dealraíonn an seoladh r-phoist a bheith neamhbhailí';
$lang['error_compose_invalid_mail1_p'] = 'Earráid: r-phost cosúil go seoltaí a bheith neamhbhailí';
$lang['error_compose_invalid_mail2_s'] = 'Seiceáil an seoladh r-phoist roimh resending an ríomhphost seo.';
$lang['error_compose_invalid_mail2_p'] = 'Seiceáil do seoltaí roimh resending an ríomhphost seo.';

// Confirmation of delete
$lang['confirm_delete'] = '? Ar mhaith leat teachtaireacht (í) seo a scriosadh';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Uimh ábhar]';
$lang['no_sender_text'] = '[anaithnid Sender]';
$lang['no_recipient_text'] = '[Faighteoir anaithnid]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Níl go leor spáis i do bhosca chun an gníomh seo a chur i gcrích \ nPlease scriosadh roinnt teachtaireachtaí chun leanúint ar aghaidh';
$lang['quota_usage_info'] = 'teorainn Cuóta';
$lang['quota_usage_used'] = 'Úsáidte';
$lang['quota_usage_of'] = 'de';
$lang['quota_usage_avail'] = 'ar fáil';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '% m /% d /% y% H:% M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'R-phost Isteach';
$lang['read_menu'] = 'Léigh E-Mail (í)';
$lang['compose_mnu'] = 'Scríobh E-Mail';
$lang['refresh_mnu'] = 'Athnuaigh';
$lang['folders_mnu'] = 'Fillteáin';
$lang['search_mnu'] = 'Cuardaigh';
$lang['address_mnu'] = 'leabhar Seoladh';
$lang['empty_trash_mnu'] = 'bruscar Folamh';
$lang['prefs_mnu'] = 'Sainroghanna';
$lang['logoff_mnu'] = 'Logáil amach';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'FW:';
$lang['reply_delimiter'] = '--------- Teachtaireacht Bunaidh --------';
$lang['reply_from_hea'] = 'From:';
$lang['reply_to_hea'] = 'Go:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Dáta:';
$lang['reply_subject_hea'] = 'Ábhar:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Eochair';
$lang['value_hea'] = 'Luach';

// [Folders]
$lang['fld_name_hea'] = 'Fillteán';
$lang['fld_messages_hea'] = 'Teachtaireachtaí';
$lang['fld_size_hea'] = 'Méid';
$lang['fld_empty_hea'] = 'Folamh';
$lang['fld_delete_hea'] = 'Scrios';
$lang['fld_total'] = 'Iomlán:';
$lang['fld_make_new'] = 'Cruthaigh fillteán nua';
$lang['folders_to'] = 'Fillteáin a';

// [MessageList]
$lang['messages_to'] = 'Teachtaireachtaí a';
$lang['no_messages'] = 'Níl teachtaireachtaí nua i do';
$lang['delete_selected_mnu'] = 'Scrios';
$lang['move_selected_mnu'] = 'Téigh go dtí';
$lang['mark_selected_mnu'] = 'Marcáil mar a léamh';
$lang['unmark_selected_mnu'] = 'Marcáil mar neamhléite';
$lang['move_selected_to_trash_mnu'] = 'Téigh go dtí an Bruscar';


$lang['delete_mnu'] = 'Scrios';
$lang['move_mnu'] = 'Téigh go dtí';
$lang['subject_hea'] = 'Ábhar:';
$lang['from_hea'] = 'From:';
$lang['to_hea'] = 'Go:';
$lang['date_hea'] = 'Dáta:';
$lang['size_hea'] = 'Méid';
$lang['have_spam'] = 'Tá tú Spam (seiceáil fillteán spam)';

$lang['msg_you_have'] = 'Tá tú';
$lang['msg_message'] = 'teachtaireacht';
$lang['msg_messages'] = 'teachtaireachtaí';

$lang['msg_more_unread'] = 'gan léamh';
$lang['msg_one_unread'] = 'gan léamh';
$lang['msg_none_unread'] = 'none léamh';
$lang['msg_in_the_folder'] = 'san fhillteán';


// [Login]
$lang['lgn_title'] = 'Logáil isteach';
$lang['lgn_welcome_msg'] = 'Fáilte, le do thoil logáil isteach i do chuntas';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Ainm Úsáideora';
$lang['lng_user_pwd'] = 'Pasfhocal';
$lang['lng_server'] = 'an fhreastalaí';
$lang['lng_theme'] = 'Téama';
$lang['lng_language'] = 'Teanga';
$lang['lng_login_btn'] = 'Logáil isteach &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Níor mór fianáin a chumasú';
$lang['lng_cookie_not_valid'] = 'Cookie Slándáil Seiceáil Theip';

// [Newmessage]

$lang['newmsg_title'] = 'Cum ríomhphost';

$lang['to_hea'] = 'Go:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Ábhar:';
$lang['address_tip'] = 'From seoladh leabhar';

$lang['attach_hea'] = 'Iatán:';
$lang['attch_add_new'] = 'comhad nua Ceangail';
$lang['attch_name_hea'] = 'Ainm';
$lang['attch_size'] = 'Méid';
$lang['attch_type_hea'] = 'Cineál';
$lang['attch_dele_hea'] = 'Scrios';
$lang['attch_no_hea'] = 'Níl iatáin';

$lang['add_signature'] = 'Cuir síniú';
$lang['send_text'] = 'Seol';

$lang['result_error'] = 'Ní raibh sé indéanta a sheoladh r-phost';
$lang['result_success'] = 'Tá an r-phost curtha chuig';
$lang['nav_continue'] = '&lt;&lt; Leanúint ar &gt;&gt; ';
$lang['nav_back'] = 'Ar ais';

$lang['up_title'] = 'Cuir comhad';
$lang['up_information_text'] = 'Roghnaigh comhad';
$lang['up_button_text'] = 'Ceangail comhad';

$lang['require_receipt'] = 'admháil Fillte';

$lang['priority_text'] = 'Tosaíocht';
$lang['priority_low'] = 'Íseal';
$lang['priority_normal'] = 'Gnáth';
$lang['priority_high'] = 'Ard';

// [Preferences]
$lang['prf_title'] = 'Sainroghanna';
$lang['prf_general_title'] = 'Faisnéis ghinearálta';
$lang['prf_name'] = 'Ainm';
$lang['prf_reply_to'] = 'Freagra a';
$lang['prf_time_zone'] = 'crios Time';
$lang['prf_trash_title'] = 'Bhruscar';
$lang['prf_save_to_trash'] = 'Nuair a bheidh tú <b> </ b> teachtaireacht a scriosadh, a aistriú go dtí';
$lang['prf_save_only_read'] = 'Sábháil amháin <b> teachtaireachtaí a léamh </ b> sa';
$lang['prf_empty_on_exit'] = '<b> Folamh </ b> fillteán bruscar nuair logála tú';
$lang['prf_empty_spam_on_exit'] = '<b> Folamh </ b> fillteán spam nuair logála tú';
$lang['prf_unmark_read_on_exit'] = 'Athshocraigh teachtaireachtaí mar Neamhléite LÉIGH nuair logála tú';
$lang['prf_sent_title'] = 'ítimí Seolta';
$lang['prf_save_sent'] = 'Sábháil <b> teachtaireachtaí a sheoladh </ b> sa';
$lang['prf_messages_title'] = 'Teachtaireachtaí';
$lang['prf_page_limit'] = 'Uasmhéid na teachtaireachtaí in aghaidh an leathanach';
$lang['prf_signature_title'] = 'Síniú';
$lang['prf_signature'] = 'Scríobh do shíniú';
$lang['prf_auto_add_sign'] = 'Cuir do shíniú go léir na teachtaireachtaí ag dul as oifig';
$lang['prf_save_button'] = 'Sábháil Sainroghanna';
$lang['prf_display_images'] = 'Taispeáin ceangailte íomhánna';
$lang['prf_default_editor_mode'] = 'Réamhshocrú eagar mód';
$lang['prf_default_editor_mode_text'] = '"téacs Plain"';
$lang['prf_default_editor_mode_html'] = '"Casta HTML eagarthóir"';
$lang['prf_time_to_refesh'] = 'seiceáil go huathoibríoch do phost nua (nóiméid)';
$lang['prf_spam_level'] = 'Spam íogaireacht (0 = Mhíchumas, 1 = An-Ard, 9 = An-Íseal)';
$lang['prf_auto_require_receipt'] = 'A cheangal admháil a léamh de réir réamhshocraithe';

$lang['prf_msg_saved'] = 'Preferences shábháil';

// filters
$lang['filter_title'] = 'Scagairí';

$lang['filter_new'] = 'Cruthaigh scagaire';
$lang['filter_desc'] = 'Roghnaigh na critéir chuardaigh agus an ghníomhaíocht do na teachtaireachtaí ag teacht isteach';
$lang['filter_list'] = 'scagairí reatha';

$lang['filter_field_from'] = 'From';
$lang['filter_field_to'] = 'Le';
$lang['filter_field_subject'] = 'Ábhar';
$lang['filter_field_header'] = 'Ceanntásc';
$lang['filter_field_body'] = 'Comhlacht';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Scrios';
$lang['filter_type_mark'] = 'Marcáil léamh';

$lang['filter_add'] = 'Cuir scagaire';
$lang['filter_delete'] = 'Scrios';
$lang['filter_delete_selected'] = 'Scrios scagairí roghnaithe';

$lang['filter_field'] = 'Scagaire ar réimse';
$lang['filter_match'] = 'Cuardaigh le haghaidh';
$lang['filter_type'] = 'Action';
$lang['filter_folder'] = 'fillteán Ceann Scríbe';

$lang['filter_msg_nofilters'] = 'Níl scagairí atá ar fáil.';
$lang['filter_msg_added'] = 'Scagaire breise';
$lang['filter_msg_deleted'] = 'Scagaire scriostar';


// [Catch]
$lang['ctc_title'] = 'Cuir le aghaidh a thabhairt ar leabhar';
$lang['ctc_information'] = 'Léiríonn amháin r-phoist nach bhfuil sa leabhar seoladh';
$lang['ctc_name'] = 'Ainm';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Níl seoladh ar fáil';
$lang['ctc_close'] = 'Close';
$lang['ctc_save'] = 'Sábháil';

// [Readmsg]
$lang['next_mnu'] = 'Ar Aghaidh';
$lang['previous_mnu'] = 'Ar ais';
$lang['back_mnu'] = 'Ar ais';
$lang['reply_mnu'] = 'Freagra';
$lang['reply_all_mnu'] = 'Freagra do gach';
$lang['forward_mnu'] = 'Ar Aghaidh';
$lang['headers_mnu'] = 'Ceanntásc';
$lang['move_mnu'] = 'Téigh go dtí';
$lang['move_to_trash_mnu'] = 'Téigh go dtí an Bruscar';
$lang['delete_mnu'] = 'Scrios';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Íoslódáil';

$lang['from_hea'] = 'From:';
$lang['to_hea'] = 'Go:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Dáta:';
$lang['subject_hea'] = 'Ábhar:';
$lang['attach_hea'] = 'Iatán:';

$lang['attch_name_hea'] = 'Ainm';
$lang['attch_force_hea'] = 'Íoslódáil';
$lang['attch_type_hea'] = 'Cineál';
$lang['attch_size_hea'] = 'Méid';
$lang['catch_address'] = 'Cuir le aghaidh a thabhairt ar leabhar';
$lang['block_address'] = 'Bloc seoladh';

// [Search]
$lang['sch_title'] = 'Cuardaigh';
$lang['sch_information_text'] = '.. Scríobh focal nó abairt a bhfuil tú ag lorg <br> ach léamh a bheidh teachtaireachtaí a chuardach';
$lang['sch_button_text'] = 'Cuardaigh &gt;&gt;';
$lang['sch_subject_hea'] = 'Ábhar';
$lang['sch_from_hea'] = 'From';
$lang['sch_date_hea'] = 'Dáta';
$lang['sch_body_hea'] = 'Teachtaireacht Comhlacht';
$lang['sch_folder_hea'] = 'Fillteán';
$lang['sch_no_results'] = 'Tá No teachtaireachtaí a thagann le do chritéir a shuífear';

// [QuickAddress]
$lang['qad_title'] = 'leabhar Seoladh';
$lang['qad_select_address'] = 'Roghnaigh teagmháil';
$lang['qad_to'] = 'Le';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'leabhar Seoladh';
$lang['adr_name'] = 'Ainm';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'City';
$lang['adr_state'] = 'Stát';
$lang['adr_work'] = 'Obair';
$lang['adr_back'] = 'Ar ais';
$lang['adr_save'] = 'Sábháil';
$lang['adr_phone'] = 'Fón';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Nótaí';

// list
$lang['adr_name_hea'] = 'Ainm';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Edit';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Scrios';
$lang['adr_new_entry'] = 'New teagmháil';

$lang['addr_saved'] = 'Tá an teagmháil Sábháladh';
$lang['addr_added'] = 'Tá an teagmháil curtha leis';
$lang['addr_deleted'] = 'Tá an teagmháil Scriosadh';


// [BlockSender]
$lang['blk_title'] = 'Bloc seoltóir';
$lang['blk_information'] = 'Léiríonn amháin r-phoist nach bhfuil i an scagaire go fóill';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Níl seoladh ar fáil';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Sábháil';

// [Event]
$lang['evt_title'] = 'Féilire Ócáid';
$lang['evt_save'] = 'Sábháil';
$lang['evt_delete'] = 'Scrios';
$lang['evt_stop'] = 'Stop am';
$lang['evt_start'] = 'Tosaigh am';

