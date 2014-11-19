<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'œÓÎÛ˜ÂÌË';
$lang['sent_extended'] = '»ÁÔ‡ÚÂÌË';
$lang['trash_extended'] = 'Ó¯˜Â';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'œÂ‰Ë¯Ì‡';
$lang['next_text'] = '—ÎÂ‰‚‡˘‡';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = '√Â¯Í‡ ÔË ‚˙ÁÍ‡ Ò˙Ò Ò˙‚˙‡';
$lang['error_retrieving'] = '√Â¯Í‡ ÔË ËÁÚÂ„ÎˇÌÂ Ì‡ ÔÓ˘‡Ú‡';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = '—ËÒÚÂÏÌ‡ „Â¯Í‡ - Ò‚˙ÊÂÚÂ ÒÂ Ò˙Ò —ËÚÂÏÌËˇ ‡‰ÏËÌËÒÚ‡ÚÓ ';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'ÕÂ‚‡ÎË‰ÌÓ ËÏÂ Á‡ Ô‡ÔÍ‡ - ËÁÔÓÎÁ‚‡ÈÚÂ Ò‡ÏÓ A-Z, 0-9, .- Ë ËÎË ËÌÚÂ‚‡Î';

// Validations when sending mails
$lang['error_no_recipients'] = 'ÃÓÎˇ ‚˙‚Â‰ÂÚÂ ‚‡ÎË‰ÂÌ ≈-mail ‡‰ÂÒ';
$lang['error_compose_invalid_mail1_s'] = '¬‡¯ËˇÚ ≈-mail ËÁ„ÎÂÊ‰‡ ‚‡ÎË‰ÂÌ';
$lang['error_compose_invalid_mail1_p'] = '—ÎÂ‰‚‡˘ËÚÂ ≈-mailÒ ËÁ„ÎÂÊ‰‡ Ò‡ ÌÂ‚‡ÎË‰ÌË';
$lang['error_compose_invalid_mail2_s'] = 'ŸÂ ·˙‰Â ÔÓ‚ÂÂÌ ÔÂ‰Ë ËÁÔ‡˘‡ÌÂ';
$lang['error_compose_invalid_mail2_p'] = 'ŸÂ ·˙‰‡Ú ÔÓ‚ÂÂÌË ÔÂ‰Ë ËÁÔ‡˘‡ÌÂ';

// Confirmation of delete
$lang['confirm_delete'] = 'ÃÓÎˇ ÔÓÚ‚˙‰ÂÚÂ ËÁÚË‚‡ÌÂÚÓ Ì‡ Ò˙Ó·˘ÂÌËÂÚÓ';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[ÕˇÏ‡ ÚÂÏ‡]';
$lang['no_sender_text'] = '[ÕˇÏ‡ ËÁÔ‡˘‡˜]';
$lang['no_recipient_text'] = '[ÕˇÏ‡ Ò˙‰˙Ê‡ÌËÂ]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = '‚ÓÚ‡Ú‡ Â Á‡Ô˙ÎÌÂÌ‡. ÃÓÎˇ ËÁÚËÈÚÂ ÒÚ‡Ë ÔËÒÏ‡ Á‡ ‰‡ ÓÒ‚Ó·Ó‰ËÚÂ ÏˇÒÚÓ';
$lang['quota_usage_info'] = 'ÀËÏËÚ';
$lang['quota_usage_used'] = '»ÁÔÓÎÁ‚‡ÌË';
$lang['quota_usage_of'] = 'ÓÚ';
$lang['quota_usage_avail'] = 'ÔÂ‰ÓÒÚ‡‚ÂÌË';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'Windows-1251';

// Menu
$lang['messages_mnu'] = '—˙Ó·˘ÂÌËˇ';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = '»ÁÔ‡ÚË';
$lang['refresh_mnu'] = 'ŒÔÂÒÌË';
$lang['folders_mnu'] = 'œ‡ÔÍË';
$lang['search_mnu'] = '“˙ÒË';
$lang['address_mnu'] = '¿‰ÂÒË';
$lang['empty_trash_mnu'] = '»ÁÚËÈ ÍÓ¯˜ÂÚÓ';
$lang['prefs_mnu'] = 'Õ‡ÒÚÓÈÍË';
$lang['logoff_mnu'] = '»ÁıÓ‰';

// Reply
$lang['reply_prefix'] = 'ŒÚ„:';
$lang['forward_prefix'] = 'œÂ:';
$lang['reply_delimiter'] = '--------- ŒË„ËÌ‡ÎÌÓ Ò˙Ó·˘ÂÌËÂ --------';
$lang['reply_from_hea'] = 'ŒÚ:';
$lang['reply_to_hea'] = 'ƒÓ:';
$lang['reply_cc_hea'] = 'ÓÔËÂ ‰Ó:';
$lang['reply_date_hea'] = 'ƒ‡Ú‡:';
$lang['reply_subject_hea'] = '“ÂÏ‡:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Î˛˜';
$lang['value_hea'] = '—ÚÓÈÌÓÒÚ';

// [Folders]
$lang['fld_name_hea'] = 'œ‡ÔÍË';
$lang['fld_messages_hea'] = '—˙Ó·˘ÂÌËˇ';
$lang['fld_size_hea'] = '√ÓÎÂÏËÌ‡';
$lang['fld_empty_hea'] = '»Á˜ËÒÚË';
$lang['fld_delete_hea'] = '»ÁÚËÈ';
$lang['fld_total'] = 'Œ·˘Ó:';
$lang['fld_make_new'] = 'Õ‡Ô‡‚Ë ÌÓ‚‡ Ô‡ÔÍ‡';
$lang['folders_to'] = 'œ‡ÔÍË Á‡ ';

// [MessageList]
$lang['messages_to'] = '—˙Ó·˘ÂÌËˇ Á‡ ';
$lang['no_messages'] = 'ÕˇÏ‡ Ò˙Ó·˘ÂÌËˇ ';
$lang['delete_selected_mnu'] = '»ÁÚËÈ ËÁ·‡ÌËÚÂ';
$lang['move_selected_mnu'] = 'œÂÏÂÒÚË ËÁ·‡ÌËÚÂ ‚';
$lang['mark_selected_mnu'] = 'Mark as read';
$lang['unmark_selected_mnu'] = 'Mark as unread';
$lang['move_selected_to_trash_mnu'] = 'Move selected to Trash';


$lang['delete_mnu'] = '»ÁÚËÈ';
$lang['move_mnu'] = 'œÂÏÂÒÚË ‚';
$lang['subject_hea'] = '“ÂÏ‡:';
$lang['from_hea'] = 'ŒÚ:';
$lang['to_hea'] = 'ƒÓ:';
$lang['date_hea'] = 'ƒ‡Ú‡:';
$lang['size_hea'] = '√ÓÎÂÏËÌ‡';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

$lang['msg_you_have'] = '»Ï‡ÚÂ';
$lang['msg_message'] = 'Ò˙Ó·˘ÂÌËÂ';
$lang['msg_messages'] = 'Ò˙Ó·˘ÂÌËˇ';

$lang['msg_more_unread'] = 'ÌÂÔÓ˜ÂÚÂÌË';
$lang['msg_one_unread'] = 'ÌÂÔÓ˜ÂÚÂÌÓ';
$lang['msg_none_unread'] = 'ÌˇÏ‡ÚÂ ÌÂÔÓ˜ÂÚÂÌË';
$lang['msg_in_the_folder'] = '‚ Ô‡ÔÍ‡';


// [Login]
$lang['lgn_title'] = '¬ıÓ‰';
$lang['lgn_welcome_msg'] = 'ƒÓ·Â ‰Ó¯ÎË. ÃÓÎˇ ‚˙‚Â‰ÂÚÂ ËÏÂ Ë Ô‡ÓÎ‡';
$lang['lng_user_email'] = '≈-ÔÓ˘‡';
$lang['lng_user_name'] = '»ÏÂ';
$lang['lng_user_pwd'] = 'œ‡ÓÎ‡';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = '≈ÁËÍ';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = '¬ıÓ‰ &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'ƒÓ:';
$lang['cc_hea'] = 'ÓÔËÂ ‰Ó:';
$lang['bcc_hea'] = '2  ÓÔËÂ ‰Ó:';
$lang['subject_hea'] = '“ÂÏ‡:';
$lang['address_tip'] = 'ŒÚ ‡‰ÂÒÌ‡Ú‡ ÍÌË„‡';

$lang['attach_hea'] = 'œËÍÂÔÂÌË Ù‡ÈÎÓ‚Â:';
$lang['attch_add_new'] = 'œËÍÂÔË ÌÓ‚ Ù‡ÈÎ';
$lang['attch_name_hea'] = '»ÏÂ';
$lang['attch_size'] = '√ÓÎÂÏËÌ‡';
$lang['attch_type_hea'] = 'ÚËÔ';
$lang['attch_dele_hea'] = '»ÁÚËÈ';
$lang['attch_no_hea'] = 'ÕˇÏ‡ ÔËÍÂÔÂÌË Ù‡ÈÎÓ‚Â!';

$lang['add_signature'] = 'ƒÓ·‡‚Ë ';
$lang['send_text'] = '»ÁÔ‡ÚË';

$lang['result_error'] = '√Â¯Í‡, ÌÂ ÏÓÊÂ ‰‡ ÒÂ ËÁÔ‡ÚË ÔËÒÏÓÚÓ';
$lang['result_success'] = 'œËÒÏÓÚÓ Â ËÁÔ‡ÚÂÌÓ ÛÒÔÂ¯ÌÓ';
$lang['nav_continue'] = 'œÓ‰˙ÎÊË';
$lang['nav_back'] = 'Õ‡Á‡‰';

$lang['up_title'] = 'ƒÓ·‡‚Ë ÌÓ‚ Ù‡ÈÎ';
$lang['up_information_text'] = '»Á·ÂË Ù‡ÈÎ';
$lang['up_button_text'] = 'ƒÓ·‡‚Ë';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'œËÓËÚÂÚ';
$lang['priority_low'] = 'ÕËÒ˙Í';
$lang['priority_normal'] = 'ÕÓÏ‡ÎÂÌ';
$lang['priority_high'] = '¬ËÒÓÍ';

// [Preferences]
$lang['prf_title'] = 'Õ‡ÒÚÓÈÍË';
$lang['prf_general_title'] = 'œÂÒÓÌ‡ÎÌ‡ ËÌÙÓÏ‡ˆËˇ';
$lang['prf_name'] = '»ÏÂ';
$lang['prf_reply_to'] = '¿‰ÂÒ Á‡ ÓÚ„Ó‚Ó';
$lang['prf_time_zone'] = '¬ÂÏÂ‚‡ ÁÓÌ‡';
$lang['prf_trash_title'] = 'Ó¯˜Â Á‡ ·ÓÍÎÛÍ';
$lang['prf_save_to_trash'] = 'œÂÏÂÒÚË <b>ËÁÚËÚËÚÂ</b> Ò˙Ó·˘ÂÌËˇ ‚ Ô‡ÔÍ‡ ';
$lang['prf_save_only_read'] = '«‡ÔË¯Ë Ò‡ÏÓ <b>ÔÓ˜ÂÚÂÌËÂ</b> Ò˙Ó·˘ÂÌËˇ ‚ Ô‡ÔÍ‡ ';
$lang['prf_empty_on_exit'] = '<b>»ÁÚËÈ</b>  Ó¯˜ÂÚÓ Á‡ ·ÓÍÎÛÍ';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = '»ÁÔ‡ÚÂÌË Ò˙Ó·˘ÂÌËˇ';
$lang['prf_save_sent'] = '«‡ÔË¯Ë <b>ËÁÔ‡ÚÂÌËÚÂ</b> Ò˙Ó·˘ÂÌËˇ ‚ Ô‡ÔÍ‡';
$lang['prf_messages_title'] = '—˙Ó·˘ÂÌËˇ';
$lang['prf_page_limit'] = '—˙Ó·˘ÂÌËˇ ÔÓÍ‡Á‚‡ÌË Ì‡ ÒÚ‡ÌËˆ‡';
$lang['prf_signature_title'] = 'œÓ‰ÔËÒ';
$lang['prf_signature'] = 'œÂÒÓÌ‡ÎËÁË‡Ì ÚÂÒÍÚ Á‡ ÔÓ‰ÔËÒ';
$lang['prf_auto_add_sign'] = 'ƒÓ·‡‚Ë ‡‚ÚÓÏ‡ÚË˜ÌÓ';
$lang['prf_save_button'] = '«‡ÔËÒ';
$lang['prf_display_images'] = 'œÓÍ‡ÊË Í‡ÚËÌÍËÚÂ ‡‚ÚÓÏ‡ÚË˜ÌÓ';
$lang['prf_default_editor_mode'] = 'ÕÓÏÎÂÌ ÂÊËÏ Ì‡ Â‰‡ÍÚË‡ÌÂ';
$lang['prf_default_editor_mode_text'] = '"◊ËÒÚ ÚÂÍÒÚ"';
$lang['prf_default_editor_mode_html'] = '"HTML –Â‰‡ÍÚÓ (ËÁÒÍ‚‡ ÏËÌËÏÛÏ IE 5.0)"';
$lang['prf_time_to_refesh'] = '¬ÂÏÂ Á‡ ‡‚ÚÓÏ‡ÚË˜ÌÓ ÓÔÂÒÌˇ‚‡ÌÂ Ì‡ Ò˙Ó·˘ÂÌËˇÚ‡ (‚ ÏËÌÛÚË)';
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
$lang['ctc_title'] = '«‡ÔË¯Ë ‡‰ÂÒ‡';
$lang['ctc_information'] = '—‡ÏÓ ‡‰ÂÒËÚÂ, ÍÓËÚÓ ÌÂ Ò‡ Á‡ÔËÒ‡ÌË ‚ ‡‰ÂÒÌ‡Ú‡ ÍÌË„‡ ‚ÒÂ Ó˘Â ÒÂ ÔÓÍ‡Á‚‡Ú';
$lang['ctc_name'] = '»ÏÂ';
$lang['ctc_email'] = 'Â-ÔÓ˘‡';
$lang['ctc_no_address'] = 'ÕˇÏ‡ ‡‰ÂÒ';
$lang['ctc_close'] = '«‡Ú‚ÓË';
$lang['ctc_save'] = '«‡ÔËÒ';

// [Readmsg]
$lang['next_mnu'] = '—ÎÂ‰‚‡˘Ó';
$lang['previous_mnu'] = 'œÂ‰Ë¯ÌÓ';
$lang['back_mnu'] = 'Õ‡Á‡‰';
$lang['reply_mnu'] = 'ŒÚ„Ó‚ÓË';
$lang['reply_all_mnu'] = 'ŒÚ„Ó‚ÓË Ì‡ ‚ÒË˜ÍË';
$lang['forward_mnu'] = 'œÂÔ‡ÚË';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] = 'œÂÏÂÒÚË ‚';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = '»ÁÚËÈ';
$lang['print_mnu'] = 'œÂ˜‡Ú';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'ŒÚ:';
$lang['to_hea'] = 'ƒÓ:';
$lang['cc_hea'] = 'ÓÔËÂ ‰Ó:';
$lang['date_hea'] = 'ƒ‡Ú‡:';
$lang['subject_hea'] = '“ÂÏ‡:';
$lang['attach_hea'] = 'œËÍÂÔÂÌË Ù‡ÈÎÓ‚Â:';

$lang['attch_name_hea'] = '»ÏÂ';
$lang['attch_force_hea'] = 'ËÁÚÂ„ÎË';
$lang['attch_type_hea'] = 'ÚËÔ';
$lang['attch_size_hea'] = '√ÓÎÂÏËÌ‡';
$lang['catch_address'] = 'ƒÓ·‡‚Ë ‡‰ÂÒ‡';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = '¬˙‚Â‰ÂÚÂ ‰ÛÏ‡ ËÎË Ù‡Á‡<br> —‡ÏÓ Ò˙Ó·˘ÂÌËˇ ‚ <br>ÎÓÍ‡ÎÌËÚÂ Ô‡ÔÍË<br> Ë <b>ÔÓ˜ÂÚÂÌË Ò˙Ó·˘ÂÌËˇ</b> ˘Â ·˙‰‡Ú ÔÓ‚ÂÂÌË';
$lang['sch_button_text'] = '“˙ÒË &gt;&gt;';
$lang['sch_subject_hea'] = '“ÂÏ‡';
$lang['sch_from_hea'] = 'ŒÚ';
$lang['sch_date_hea'] = 'ƒ‡Ú‡';
$lang['sch_body_hea'] = '—˙Ó·˘ÂÌËÂ';
$lang['sch_folder_hea'] = 'œ‡ÔÍ‡';
$lang['sch_no_results'] = 'ÕˇÏ‡ Ì‡ÏÂÂÌË';

// [QuickAddress]
$lang['qad_title'] = '»Á·ÂË ÔÓÎÛ˜‡ÚÂÎË';
$lang['qad_select_address'] = '»Á·ÂË ‡‰ÂÒ';
$lang['qad_to'] = 'ƒÓ';
$lang['qad_cc'] = 'ÓÔËÂ ‰Ó';
$lang['qad_bcc'] = '2  ÓÔËÂ ‰Ó';

// [AddressBook]
// edit/display
$lang['adr_title'] = '¿‰ÂÒÌ‡ ÍÌË„‡';
$lang['adr_name'] = '»ÏÂ';
$lang['adr_email'] = 'Â-ÔÓ˘‡';
$lang['adr_street'] = '”ÎËˆ‡';
$lang['adr_city'] = '√‡‰';
$lang['adr_state'] = 'ŒÍ˙„';
$lang['adr_work'] = 'œÓÙÂÒËˇ';
$lang['adr_back'] = 'Õ‡Á‡‰';
$lang['adr_save'] = '«‡ÔËÒ';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = '»ÏÂ';
$lang['adr_email_hea'] = 'Â-ÔÓ˘‡';
$lang['adr_edit_hea'] = '–Â‰‡ÍˆËˇ';
$lang['adr_expo_hea'] = '≈ÍÒÔÓÚ';
$lang['adr_dele_hea'] = '»ÁÚË‚‡ÌÂ';
$lang['adr_new_entry'] = 'ÕÓ‚ Á‡ÔËÒ';

$lang['addr_saved'] = '¿‰ÂÒ‡ Â Á‡ÔËÒ‡Ì ÛÒÔÂ¯ÌÓ';
$lang['addr_added'] = '¿‰ÂÒ‡ Â ‰Ó·‡‚ÂÌ ÛÒÔÂ¯ÌÓ';
$lang['addr_deleted'] = '¿‰ÂÒ‡ Â ËÁÚËÚ';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = '«‡ÔËÒ';
$lang['evt_delete'] = '»ÁÚË‚‡ÌÂ';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

