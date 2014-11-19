<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'InnhÛlf';
$lang['sent_extended'] = '⁄thÛlf';
$lang['trash_extended'] = 'Rusl';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Fyrri';
$lang['next_text'] = 'NÊsti';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = 'Tenging vi pÛst˛jÛn mistÛkst';
$lang['error_retrieving'] = 'Villa vi a n· Ì pÛst, innhÛlf hefur breyst';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = 'Kerfisvilla, vinsamlegast hafi samband vi kerfisstjÛra';

// Invalid name of mailbox
$lang['error_invalid_name'] = '”lˆglegt mˆppunafn - Noti aeins stafi · bilunum  A-Z, 0-9, .- og bil';

// Validations when sending mails
$lang['error_no_recipients'] = 'ﬁ˙ ·tt eftir a setja inn vitakanda!';
$lang['error_compose_invalid_mail1_s'] = 'PÛsturinn inniheldur villur';
$lang['error_compose_invalid_mail1_p'] = 'ﬁessi netfˆng eru Ûlˆgleg';
$lang['error_compose_invalid_mail2_s'] = 'Hakau vi "semja" ·ur en ˛˙ sendir';
$lang['error_compose_invalid_mail2_p'] = 'Hakau vi "semja" ·ur en ˛˙ sendir';

// Confirmation of delete
$lang['confirm_delete'] = 'Viltu ˆrugglega eya ˛essum pÛsti?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[¡n titils]';
$lang['no_sender_text'] = '[Sendandi Û˛ekktur]';
$lang['no_recipient_text'] = '[Vitakandi Û˛ekktur]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Ekki nÛg pl·ss!\Vinsamlegast eyi ˙t gˆmlum pÛstum';
$lang['quota_usage_info'] = 'StÊrartakmˆrk';
$lang['quota_usage_used'] = 'Notu';
$lang['quota_usage_of'] = 'af';
$lang['quota_usage_avail'] = 'laus';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Skilabo';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Skrifa';
$lang['refresh_mnu'] = 'Endurhlaa';
$lang['folders_mnu'] = 'Mˆppur';
$lang['search_mnu'] = 'Leita';
$lang['address_mnu'] = 'NafnabÛk';
$lang['empty_trash_mnu'] = 'TÊma rusl';
$lang['prefs_mnu'] = 'Stillingar';
$lang['logoff_mnu'] = '⁄tskr·ning';

// Reply
$lang['reply_prefix'] = 'Svar:';
$lang['forward_prefix'] = '¡framsent:';
$lang['reply_delimiter'] = '--------- ﬁ˙ skrifair --------';
$lang['reply_from_hea'] = 'Fr·:';
$lang['reply_to_hea'] = 'Til:';
$lang['reply_cc_hea'] = 'Afrit:';
$lang['reply_date_hea'] = 'Dags:';
$lang['reply_subject_hea'] = 'Efni:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Lykill';
$lang['value_hea'] = 'Gildi';

// [Folders]
$lang['fld_name_hea'] = 'Mappa';
$lang['fld_messages_hea'] = 'Skilabo';
$lang['fld_size_hea'] = 'StÊr';
$lang['fld_empty_hea'] = 'TÊma';
$lang['fld_delete_hea'] = 'Eya';
$lang['fld_total'] = 'Samtals:';
$lang['fld_make_new'] = 'B˙a til n˝ja mˆppu';
$lang['folders_to'] = 'Mˆppur Ì';

// [MessageList]
$lang['messages_to'] = 'Skilabo til';
$lang['no_messages'] = 'Engin n˝ skilabo Ì ';
$lang['delete_selected_mnu'] = 'Eya vˆldum skilaboum';
$lang['move_selected_mnu'] = 'FÊra vˆld skilabo Ì ';
$lang['mark_selected_mnu'] = 'Mark as read';
$lang['unmark_selected_mnu'] = 'Mark as unread';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash';


$lang['delete_mnu'] = 'Eya';
$lang['move_mnu'] = 'FÊra Ì';
$lang['subject_hea'] = 'Efni:';
$lang['from_hea'] = 'Fr·:';
$lang['to_hea'] = 'Til:';
$lang['date_hea'] = 'Dags:';
$lang['size_hea'] = 'StÊr';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

$lang['msg_you_have'] = 'ﬁ˙ ·tt';
$lang['msg_message'] = 'skilabo';
$lang['msg_messages'] = 'skilabo';

$lang['msg_more_unread'] = 'Ûlesin';
$lang['msg_one_unread'] = 'Ûlesi';
$lang['msg_none_unread'] = 'engin lesin';
$lang['msg_in_the_folder'] = 'Ì mˆppunni';


// [Login]
$lang['lgn_title'] = 'Innskr·ning';
$lang['lgn_welcome_msg'] = 'Velkomin, skr·u ˛ig inn';
$lang['lng_user_email'] = 'Netfang';
$lang['lng_user_name'] = 'Notandanafn';
$lang['lng_user_pwd'] = 'Lykilor';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = '⁄tlit';
$lang['lng_language'] = 'Tungum·l';
$lang['lng_login_btn'] = 'Innskr·ning &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Afrit:';
$lang['bcc_hea'] = 'Blint afrit:';
$lang['subject_hea'] = 'Efni:';
$lang['address_tip'] = '⁄r nafnabÛk';

$lang['attach_hea'] = 'Vihengi:';
$lang['attch_add_new'] = 'BÊta vi n˝rri skr·';
$lang['attch_name_hea'] = 'Nafn';
$lang['attch_size'] = 'StÊr';
$lang['attch_type_hea'] = 'Tegund';
$lang['attch_dele_hea'] = 'Eya';
$lang['attch_no_hea'] = 'Engin vihengi';

$lang['add_signature'] = 'BÊta vi undirskrift';
$lang['send_text'] = 'Senda';

$lang['result_error'] = 'Ekki tÛkst a senda!';
$lang['result_success'] = 'Skilabo send!';
$lang['nav_continue'] = 'Halda ·fram';
$lang['nav_back'] = 'Til baka';

$lang['up_title'] = 'BÊta vi skr·';
$lang['up_information_text'] = 'Velja skr·';
$lang['up_button_text'] = 'Senda';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Forgangur';
$lang['priority_low'] = 'LÌtill';
$lang['priority_normal'] = 'Venjulegur';
$lang['priority_high'] = 'Mikill';

// [Preferences]
$lang['prf_title'] = 'Stillingar';
$lang['prf_general_title'] = 'Almennar uppl˝singar';
$lang['prf_name'] = 'Nafn';
$lang['prf_reply_to'] = 'Svar til netfangs';
$lang['prf_time_zone'] = 'TÌmasvÊi';
$lang['prf_trash_title'] = 'Rusl';
$lang['prf_save_to_trash'] = 'ﬁegar skilaboum er <b>eytt</b>, fÊra Ì ';
$lang['prf_save_only_read'] = 'Vista aeins <b>lesin skilabo</b> Ì ';
$lang['prf_empty_on_exit'] = '<b>TÊma</b> rusl vi ˙tskr·ningu';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = '⁄thÛlf';
$lang['prf_save_sent'] = 'Vista <b>send skilabo</b> Ì ';
$lang['prf_messages_title'] = 'Skilabo';
$lang['prf_page_limit'] = 'Mesti fjˆldi skilaboa · sÌu';
$lang['prf_signature_title'] = 'Undirskrift';
$lang['prf_signature'] = 'B˙u til undirskrift ˛Ìna';
$lang['prf_auto_add_sign'] = 'BÊta undirskrift vi ˆll skilabo sem eru send';
$lang['prf_save_button'] = 'Vista';
$lang['prf_display_images'] = 'S˝na myndir sem fylgja me skilaboum';
$lang['prf_default_editor_mode'] = 'Venjulegur ritill';
$lang['prf_default_editor_mode_text'] = '"Venjulegur texti"';
$lang['prf_default_editor_mode_html'] = '"HTML texti (Fyrir IE5 ea n˝rri)"';
$lang['prf_time_to_refesh'] = 'Athuga n˝ skilabo hverjar (mÌn˙tur)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default';

$lang['prf_msg_saved'] = 'Preferences saved';

// filters
$lang['filter_title'] = 'Filters';

$lang['filter_new'] = 'Create a filter';
$lang['filter_desc'] = 'Choose the search criteria and the action for the incoming messages';
$lang['filter_list'] = 'Current filters';

$lang['filter_field_from'] = 'From';
$lang['filter_field_to'] = 'To';
$lang['filter_field_subject'] = 'Subject';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Delete';
$lang['filter_type_mark'] = 'Mark read';

$lang['filter_add'] = 'Add filter';
$lang['filter_delete'] = 'Delete';
$lang['filter_delete_selected'] = 'Delete selected filters';

$lang['filter_field'] = 'Filter on field';
$lang['filter_match'] = 'Search for';
$lang['filter_type'] = 'Action';
$lang['filter_folder'] = 'Destination folder';

$lang['filter_msg_nofilters'] = 'No filters available.';
$lang['filter_msg_added'] = 'Filter added';
$lang['filter_msg_deleted'] = 'Filter deleted';


// [Catch]
$lang['ctc_title'] = 'BÊta vi Ì nafnabÛk';
$lang['ctc_information'] = 'S˝nir aeins netfˆng sem eru Ì nafnabÛk';
$lang['ctc_name'] = 'Nafn';
$lang['ctc_email'] = 'Netfang';
$lang['ctc_no_address'] = 'Ekkert netfang til';
$lang['ctc_close'] = 'Loka';
$lang['ctc_save'] = 'Vista';

// [Readmsg]
$lang['next_mnu'] = 'NÊsti';
$lang['previous_mnu'] = 'Fyrri';
$lang['back_mnu'] = 'Til baka';
$lang['reply_mnu'] = 'Svara';
$lang['reply_all_mnu'] = 'Svara ˆllum';
$lang['forward_mnu'] = '¡framsenda';
$lang['headers_mnu'] = 'Haus';
$lang['move_mnu'] = 'FÊra Ì';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Eya';
$lang['print_mnu'] = 'Prenta';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'Fr·:';
$lang['to_hea'] = 'Til:';
$lang['cc_hea'] = 'Afrit:';
$lang['date_hea'] = 'Dags:';
$lang['subject_hea'] = 'Efni:';
$lang['attach_hea'] = 'Vihengi:';

$lang['attch_name_hea'] = 'Nafn';
$lang['attch_force_hea'] = 'Vista · tˆlvu';
$lang['attch_type_hea'] = 'Tegund';
$lang['attch_size_hea'] = 'StÊr';
$lang['catch_address'] = 'BÊta vi Ì nafnabÛk';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Settu inn or ea orasamband sem ˛˙ vilt leita eftir<br>Leita verur Ì lesnum skilaboum';
$lang['sch_button_text'] = 'Leit &gt;&gt;';
$lang['sch_subject_hea'] = 'Efni';
$lang['sch_from_hea'] = 'Fr·';
$lang['sch_date_hea'] = 'Dags';
$lang['sch_body_hea'] = 'Skilabo';
$lang['sch_folder_hea'] = 'Mappa';
$lang['sch_no_results'] = 'Engin skilabo fundust';

// [QuickAddress]
$lang['qad_title'] = 'NafnabÛk';
$lang['qad_select_address'] = 'Veldu tengili';
$lang['qad_to'] = 'Til';
$lang['qad_cc'] = 'Afrit';
$lang['qad_bcc'] = 'Blint afrit';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'NafnabÛk';
$lang['adr_name'] = 'Nafn';
$lang['adr_email'] = 'Netfang';
$lang['adr_street'] = 'Heimilisfang';
$lang['adr_city'] = 'Borg';
$lang['adr_state'] = 'Land';
$lang['adr_work'] = 'Vinna';
$lang['adr_back'] = 'Til baka';
$lang['adr_save'] = 'Vista';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Nafn';
$lang['adr_email_hea'] = 'Netfang';
$lang['adr_edit_hea'] = 'Breyta';
$lang['adr_expo_hea'] = 'Flytja ˙t';
$lang['adr_dele_hea'] = 'Eya';
$lang['adr_new_entry'] = 'N˝r tengiliur';

$lang['addr_saved'] = 'Tengiliur hefur veri vistaur';
$lang['addr_added'] = 'Tengili hefur veri bÊtt vi';
$lang['addr_deleted'] = 'Tengili hefur vei eytt';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'Vista';
$lang['evt_delete'] = 'Eya';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

