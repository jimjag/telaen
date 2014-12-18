<?php
/*
 * Thai (ไทย) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = '¶Ò´à¢éÒ';
$lang['sent_extended'] = '¶Ò´ÍÍ¡';
$lang['trash_extended'] = '¶Ñ§¢ÂÐ';
$lang['spam_extended'] = '¨´ËÁÒÂ¢ÂÐ';

// Navigation texts
$lang['pages_text'] = 'Ë¹éÒ';
$lang['first_text'] = 'Ë¹éÒáÃ¡';
$lang['previous_text'] = '¡èÍ¹Ë¹éÒ';
$lang['next_text'] = '¶Ñ´ä»';
$lang['last_text'] = 'Ë¹éÒÊØ´·éÒÂ';
$lang['total_text'] = '·Ñé§ËÁ´';

// Mail Server Errors
$lang['err_login_msg'] = '¡ÒÃà¢éÒÊÙèÃÐºº¼Ô´¾ÅÒ´';
$lang['err_system_msg'] = 'à¡Ô´¤ÇÒÁ¼Ô´¾ÅÒ´¨Ò¡ÃÐºº';
$lang['error_login'] = '¡ÃØ³ÒµÃÇ¨àªç¤ª×èÍ¼ÙéãªéáÅÐÃËÑÊ¼èÒ¹ãËé´ÕáÅéÇÅÍ§ãËÁèÍÕ¡¤ÃÑé§';
$lang['error_connect'] = 'äÁèÊÒÁÒÃ¶µÔ´µèÍ¡ÑºÃÐººä´é ·Ò§àÃÒ¡ÓÅÑ§»ÃÑº»ÃØ§ ÃÐºº';
$lang['error_retrieving'] = 'ÁÕ»Ñ­ËÒ ¡ÒÃÃÑº¨´ËÁÒÂ ·ÓãËéäÁèÊÒÁÒÃ¶ÃÑº¨´ËÁÒÂä´é';
$lang['error_session_expired'] = 'ÃÐÂÐàÇÅÒã¹¡ÒÃà¢éÒÊÙèÃÐºº¢Í§¤Ø³ËÁ´áÅéÇ ¡ÃØ³Òà¢éÒÊÙèÃÐººãËÁèÍÕ¡¤ÃÑé§';
$lang['error_other'] = 'ÃÐººÁÕ»Ñ­ËÒ ·Ò§àÃÒ¡ÓÅÑ§»ÃÑº»ÃØ§ÃÐºº';

// Invalid name of mailbox
$lang['error_invalid_name'] = '¡ÒÃµÑé§ª×èÍäÁè¶Ù¡µéÍ§ - ¤Ø³ÊÒÁÒ¶ãªéµÑÇÍÑ¡ÉÃä´é ´Ñ§¹Õé : ¡-Î, A-Z, 0-9, .-';

// Validations when sending mails
$lang['error_no_recipients'] = '¤Ø³µéÍ§ãÊè mail ¢Í§ ¼ÙéÃÑºÍÂèÒ§¹éÍÂ 1 ¤¹';
$lang['error_compose_invalid_mail1_s'] = '´ÙàËÁ×Í¹ÇèÒ email ¹Õé¨ÐäÁè¶Ù¡µéÍ§';
$lang['error_compose_invalid_mail1_p'] = '¡ÒÃÊè§¨´ËÁÒÂÅÙ¡â«èäÁèÊÒÁÒÃ¶·Óä´é';
$lang['error_compose_invalid_mail2_s'] = 'µÃÇ¨ÊÍº¡ÒÃà¢ÕÂ¹¨´ËÁÒÂ¡èÍ¹Êè§';
$lang['error_compose_invalid_mail2_p'] = 'µÃÇ¨ÊÍº¡ÒÃà¢ÕÂ¹¨´ËÁÒÂ¡èÍ¹Êè§';

// Confirmation of delete
$lang['confirm_delete'] = '¤Ø³á¹èã¨·Õè¨ÐÅº¨´ËÁÒÂ¹Õé ?';

// If the message no have a subject or sender
$lang['no_subject_text'] = 'äÁèÁÕËÑÇàÃ×èÍ§';
$lang['no_sender_text'] = 'äÁè·ÃÒº';
$lang['no_recipient_text'] = 'äÁèÁÕ¡ÒÃÃÑºÃÍ§';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'à¹×éÍ·Õè¢Í§·èÒ¹àµçÁáÅéÇ \r ¡ÃØ³ÒÅº¨´ËÁÒÂà¡èÒæ ÍÍ¡ à¾×èÍà¾ÔèÁà¹×éÍ·ÕèÇèÒ§ã¹ ÃÐºº¢Í§·èÒ¹';
$lang['quota_usage_info'] = '¨Ó¡Ñ´à¹×éÍ·Õè';
$lang['quota_usage_used'] = 'ãªéä»';
$lang['quota_usage_of'] = '¢Í§';
$lang['quota_usage_avail'] = 'à¹×éÍ·Õè·Ñé§ËÁ´';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'tis-620';

// Menu
$lang['messages_mnu'] = '¢éÍ¤ÇÒÁ';
$lang['read_menu'] = 'Read E-Mail(s)'; // FIXME: need translation
$lang['compose_mnu'] = 'à¢ÕÂ¹¨´ËÁÒÂ';
$lang['refresh_mnu'] = 'ÃÕâËÅ´';
$lang['folders_mnu'] = 'â¿Åà´ÍÃì';
$lang['search_mnu'] = '¤é¹ËÒ';
$lang['address_mnu'] = 'ÁØ´ÃÒÂª×èÍ';
$lang['empty_trash_mnu'] = 'Åº¢ÂÐ';
$lang['prefs_mnu'] = 'ÃÒÂÅÐàÍÕÂ´ÊèÇ¹µÑÇ';
$lang['logoff_mnu'] = 'ÍÍ¡¨Ò¡ÃÐºº';

// Reply
$lang['reply_prefix'] = 'Rv:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- ¢éÍ¤ÇÒÁ´Ñ§à´ÔÁ --------';
$lang['reply_from_hea'] = '¨Ò¡ :';
$lang['reply_to_hea'] = '¶Ö§ :';
$lang['reply_cc_hea'] = 'Cc :';
$lang['reply_date_hea'] = 'ÇÑ¹·Õè :';
$lang['reply_subject_hea'] = 'ËÑÇàÃ×èÍ§ :';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'â¿Åà´ÍÃì';
$lang['fld_messages_hea'] = '¢éÍ¤ÇÒÁ';
$lang['fld_size_hea'] = '¢¹Ò´';
$lang['fld_empty_hea'] = 'ÇèÒ§';
$lang['fld_delete_hea'] = 'Åº';
$lang['fld_total'] = '·Ñé§ËÁ´ :';
$lang['fld_make_new'] = 'ÃéÒ§â¿Åà´ÍÃìãËÁè';
$lang['folders_to'] = 'â¿Åà´ÍÃìs to';

// [MessageList]
$lang['messages_to'] = '¢éÍ¤ÇÒÁ¶Ö§ ';
$lang['no_messages'] = 'äÁèÁÕ¨´ËÁÒÂãËÁè¶Ö§ ¤Ø³';
$lang['delete_selected_mnu'] = 'Åº·ÕèàÅ×Í¡';
$lang['move_selected_mnu'] = 'ÂéÒÂä»·ÕèàÅ×Í¡';
$lang['mark_selected_mnu'] = '·Óà¤Ã×èÍ§ËÁÒÂÇèÒÍèÒ¹áÅéÇ';
$lang['unmark_selected_mnu'] = '·Óà¤Ã×èÍ§ËÁÒÂÇèÒÂÑ§äÁèÍèÒ¹';
$lang['move_selected_to_trash_mnu'] = 'ÂéÒÂ·ÕèàÅ×Í¡Å§¶Ñ§¢ÂÐ';


$lang['delete_mnu'] = 'Åº';
$lang['move_mnu'] = 'ÂéÒÂä»';
$lang['subject_hea'] = 'ËÑÇàÃ×èÍ§ :';
$lang['from_hea'] = '¨Ò¡ :';
$lang['to_hea'] = '¶Ö§ :';
$lang['date_hea'] = 'ÇÑ¹·Õè :';
$lang['size_hea'] = '¢¹Ò´';
$lang['have_spam'] = '¤Ø³ÁÕ¨´ËÁÒÂ¢ÂÐ (µÃÇÊÍº·Õèâ¿Åà´ÍÃì¨´ËÁÒÂ¢ÂÐ)';

$lang['msg_you_have'] = '¤Ø³ÁÕ';
$lang['msg_message'] = '¢éÍ¤ÇÒÁ';
$lang['msg_messages'] = '¢éÍ¤ÇÒÁ';

$lang['msg_more_unread'] = 'ÂÑ§äÁèä´éÍèÒ¹';
$lang['msg_one_unread'] = 'ÂÑ§äÁèä´é´Ù';
$lang['msg_none_unread'] = 'äÁèÁÕ·ÕèÂÑ§äÁèä´éÍèÒ¹';
$lang['msg_in_the_folder'] = 'ã¹â¿Åà´ÍÃì';


// [Login]
$lang['lgn_title'] = 'à¢éÒÃÐºº';
$lang['lgn_welcome_msg'] = 'ÂÔ¹´ÕµéÍ¹ÃÑºÊÙè Telaen webmail';
$lang['lng_user_email'] = '¨´ËÁÒÂÍÔàÅç¡·ÃÍ¹Ô¡Êì';
$lang['lng_user_name'] = 'ª×èÍ¼Ùéãªé';
$lang['lng_user_pwd'] = 'ÃËÑÊ¼èÒ¹';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Ë¹éÒµÒ';
$lang['lng_language'] = 'ÀÒÉÒ';
$lang['lng_login_btn'] = 'à¢éÒÊÙèÃÐºº &gt;&gt;';
$lang['lng_cookie_not_enabled'] = '¤Ø³µéÍ§à»Ô´¡ÒÃãªé§Ò¹ Cookies';
$lang['lng_cookie_not_valid'] = '¡ÒÃµÇ¨ÊÍº Cookie ÅéÁàËÅÇ';

// [Newmessage]

$lang['newmsg_title'] = 'à¢ÕÂ¹¨´ËÁÒÂ';

$lang['to_hea'] = '¶Ö§ :';
$lang['cc_hea'] = 'Cc :';
$lang['bcc_hea'] = 'Bcc :';
$lang['subject_hea'] = 'ËÑÇàÃ×èÍ§ :';
$lang['address_tip'] = '¨Ò¡ÊÁØ´ÃÒÂª×èÍ';

$lang['attach_hea'] = 'á¹ºä¿Åì :';
$lang['attch_add_new'] = 'à¾ÔèÁä¿ÅìãËÁè';
$lang['attch_name_hea'] = 'ª×èÍ';
$lang['attch_size'] = '¢¹Ò´';
$lang['attch_type_hea'] = 'ª¹Ô´';
$lang['attch_dele_hea'] = 'Åº';
$lang['attch_no_hea'] = 'äÁèÁÕ¡ÒÃá¹ºä¿Åì';

$lang['add_signature'] = 'à¾ÔèÁÅÒÂà«ç¹µì·éÒÂ¨´ËÁÒÂ';
$lang['send_text'] = 'è§¨´ËÁÒÂ';

$lang['result_error'] = 'ÁÑ¹äÁèÊÁºÙÃ³ì áµè ÍÒ¨¨ÐÊè§¶Ö§¼ÙéÃÑºä´é';
$lang['result_success'] = 'è§¨´ËÁÒÂàÃÕÂºÃéÍÂáÅéÇ';
$lang['nav_continue'] = 'µèÍä»';
$lang['nav_back'] = '¡ÅÑº';

$lang['up_title'] = 'à¾ÔèÁä¿Åì';
$lang['up_information_text'] = 'àÅ×Í¡ä¿Åì';
$lang['up_button_text'] = 'è§';

$lang['require_receipt'] = 'Return receipt'; // FIXME: need translation

$lang['priority_text'] = 'ÅÓ´Ñº¤ÇÒÁÊÓ¤Ñ­';
$lang['priority_low'] = '¹éÍÂ';
$lang['priority_normal'] = '»Ò¹¡ÅÒ§';
$lang['priority_high'] = 'ÁÒ¡';

// [Preferences]
$lang['prf_title'] = 'ÃÒÂÅÐàÍÕÂ´ÊèÇ¹µÑÇ';
$lang['prf_general_title'] = '¢éÍÁÙÅ·ÑèÇä»¢Í§¤Ø³';
$lang['prf_name'] = 'ª×èÍ';
$lang['prf_reply_to'] = 'àÁÅÅì¢Í§¤Ø³';
$lang['prf_time_zone'] = 'àÇÅÒ';
$lang['prf_trash_title'] = '¶Ñ§¢ÂÐ';
$lang['prf_save_to_trash'] = 'µÑé§¶Ñ§¢ÂÐäÇé·ÕèäË¹';
$lang['prf_save_only_read'] = '¨Ñ´à¡çº¨´ËÁÒÂäÇé·ÕèäË¹';
$lang['prf_empty_on_exit'] = 'Åº¨´ËÁÒÂ¨Ò¡ Folder ËÅÑ§¨Ò¡ÍÍ¡¨Ò¡ÃÐºº';
$lang['prf_empty_spam_on_exit'] = '<b>ÅéÒ§</b>¡ÅèÍ§¨´ËÁÒÂ¢ÂÐàÁ×èÍÍÍ¡¨Ò¡ÃÐºº';
$lang['prf_unmark_read_on_exit'] = '·Óà¤Ã×èÍ§ËÁÒÂ¨´ËÁÒÂ·ÕèÍèÒ¹áÅéÇà»ç¹<b>ÂÑ§äÁèÍèÒ¹</b>àÁ×èÍÍÍ¡¨Ò¡ÃÐºº';
$lang['prf_sent_title'] = 'è§ÃÒÂ¡ÒÃ';
$lang['prf_save_sent'] = '¨Ñ´à¡çº¨´ËÁÒÂ·ÕèÊè§äÇé·Õè :';
$lang['prf_messages_title'] = '¢éÍ¤ÇÒÁ';
$lang['prf_page_limit'] = 'áÊ´§¨Ó¹Ç¹¨´ËÁÒÂµèÍË¹éÒ';
$lang['prf_signature_title'] = 'ÅÒÂà«ç¹µì';
$lang['prf_signature'] = 'à¢ÕÂ¹ÅÒÂà«ç¹µì';
$lang['prf_auto_add_sign'] = 'à¾ÔèÁÅÒÂà«ç¹µì¢Í§¤Ø³¡Ñº¨´ËÁÒÂ·Õè¨ÐÊè§·Ø¡©ºÑº';
$lang['prf_save_button'] = '¨Ñ´à¡çº';
$lang['prf_display_images'] = 'áÊ´§ÃÙ»ÀÒ¾·Õèá¹º';
$lang['prf_default_editor_mode'] = 'âËÁ´¡ÒÃá¡éä¢¢éÍ¤ÇÒÁ¾×é¹°Ò¹';
$lang['prf_default_editor_mode_text'] = '"¡ÒÃá¡éä¢áºº¢éÍ¤ÇÒÁ¸ÃÃÁ´Ò"';
$lang['prf_default_editor_mode_html'] = '"¡ÒÃá¡éä¢¢éÍ¤ÇÒÁã¹ÃÙ»áºº HTML"';
$lang['prf_time_to_refesh'] = 'ÃÕâËÅ´·Ø¡æ [¹Ò·Õ]';
$lang['prf_spam_level'] = 'ÃÐ´Ñº¡ÒÃµÃÇ¨¨Ñº¨´ËÁÒÂ¢ÂÐ(0 = äÁèµÃÇ¨¨Ñº, 1 = ÊÙ§ÁÒ¡, 9 = µèÓÁÒ¡)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation

$lang['prf_msg_saved'] = 'Preferences saved'; // FIXME: need translation

// filters
$lang['filter_title'] = 'µÑÇ¡ÃÍ§';

$lang['filter_new'] = 'ÃéÒ§µÑÇ¡ÃÍ§';
$lang['filter_desc'] = 'àÅ×Í¡ÃÙ»áºº¡ÒÃ¤é¹ËÒ¨´ËÁÒÂ¢ÂÐáÅÐ¡ÒÃ¡ÃÐ·Ó¢Í§¨´ËÁÒÂà¢éÒáµèÅÐ©ºÑº';
$lang['filter_list'] = 'µÑÇ¡ÃÍ§»Ñ¨¨ØºÑ¹';

$lang['filter_field_from'] = '¨Ò¡';
$lang['filter_field_to'] = '¶Ö§';
$lang['filter_field_subject'] = 'ËÑÇ¢éÍ';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'ÂéÒÂ';
$lang['filter_type_delete'] = 'Åº';
$lang['filter_type_mark'] = '·Óà¤Ã×èÍ§ËÁÒÂÇèÒÍèÒ¹';

$lang['filter_add'] = 'à¾ÔèÁµÑÇ¡ÃÍ§';
$lang['filter_delete'] = 'Åº';
$lang['filter_delete_selected'] = 'ÅºµÑÇ¡ÃÍ§·ÕèàÅ×Í¡';

$lang['filter_field'] = 'µÑÇ¡ÃÍ§ã¹';
$lang['filter_match'] = '¤é¹ËÒ¢éÍ¤ÇÒÁ';
$lang['filter_type'] = '¡ÒÃ¡ÃÐ·Ó';
$lang['filter_folder'] = 'â¿Åà´ÍÃìà»éÒËÁÒÂ';

$lang['filter_msg_nofilters'] = 'ÂÑ§äÁèÁÕµÑÇ¡ÃÍ§';
$lang['filter_msg_added'] = 'à¾ÔèÁµÑÇ¡ÃÍ§áÅéÇ';
$lang['filter_msg_deleted'] = 'ÅºµÑÇ¡ÃÍ§áÅéÇ';


// [Catch]
$lang['ctc_title'] = 'à¾×èÁä»ã¹ÊÁØ´ÃÒÂª×èÍ';
$lang['ctc_information'] = 'áÊ´§à©¾ÒÐ¨´ËÁÒÂ·ÕèÊè§ÁÒ¡¨Ò¡¤¹ã¹ÊÁØ´ÃÒÂª×èÍ';
$lang['ctc_name'] = 'ª×èÍ';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'ÃÒÂª×èÍäÁè¶Ù¡µéÍ§';
$lang['ctc_close'] = '»Ô´';
$lang['ctc_save'] = '¨´à¡çº';

// [Readmsg]
$lang['next_mnu'] = 'µèÍä»';
$lang['previous_mnu'] = '¡èÍ¹Ë¹éÒ';
$lang['back_mnu'] = '¡ÅÑº';
$lang['reply_mnu'] = 'µÍº¡ÅÑº';
$lang['reply_all_mnu'] = 'µÍº¡ÅÑº·Ñé§ËÁ´';
$lang['forward_mnu'] = 'è§µèÍ';
$lang['headers_mnu'] = 'ËÑÇ';
$lang['move_mnu'] = 'ÂéÒÂä»';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation
$lang['delete_mnu'] = 'Åº';
$lang['print_mnu'] = '¾ÔÁ¾ì';
$lang['download_mnu'] = '´ÒÇ¹ìâËÅ´';

$lang['from_hea'] = '¨Ò¡ :';
$lang['to_hea'] = '¶Ö§ :';
$lang['cc_hea'] = 'Cc :';
$lang['date_hea'] = 'ÇÑ¹·Õè :';
$lang['subject_hea'] = 'ËÑÇàÃ×èÍ§ :';
$lang['attach_hea'] = 'á¹ºä¿Åì :';

$lang['attch_name_hea'] = 'ª×èÍ';
$lang['attch_force_hea'] = 'ÃÑºä¿Åì';
$lang['attch_type_hea'] = 'ª¹Ô´';
$lang['attch_size_hea'] = '¢¹Ò´';
$lang['catch_address'] = 'à¾ÔèÁà¢éÒä»ã¹ÊÁØ´ÃÒÂª×èÍ';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = '¤é¹ËÒ';
$lang['sch_information_text'] = 'à¢ÕÂ¹¢éÍ¤ÇÒÁ·ÕèµéÍ§¡ÒÃËÒ¨Ò¡ ¨´ËÁÒÂ·ÕèÍèÒ¹ä»áÅéÇ';
$lang['sch_button_text'] = '¤é¹ËÒ &gt;&gt;';
$lang['sch_subject_hea'] = 'ËÑÇàÃ×èÍ§';
$lang['sch_from_hea'] = '¨Ò¡';
$lang['sch_date_hea'] = 'ÇÑ¹·Õè';
$lang['sch_body_hea'] = '¢éÍ¤ÇÒÁ';
$lang['sch_folder_hea'] = 'â¿Åà´ÍÃì';
$lang['sch_no_results'] = 'äÁè¾º¢éÍ¤ÇÒÁ·Õè¤é¹ËÒ';

// [QuickAddress]
$lang['qad_title'] = 'ÁØ´ÃÒÂª×èÍ';
$lang['qad_select_address'] = 'àÅ×Í¡';
$lang['qad_to'] = '¶Ö§';
$lang['qad_cc'] = 'Óà¹Ò';
$lang['qad_bcc'] = 'Óà¹Ò«èÍ¹';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'ÁØ´ÃÒÂª×èÍ';
$lang['adr_name'] = 'ª×èÍ';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = '¶¹¹';
$lang['adr_city'] = 'àÁ×Í§';
$lang['adr_state'] = 'ÍÓàÀÍ';
$lang['adr_work'] = '§Ò¹';
$lang['adr_back'] = '¡ÅÑº';
$lang['adr_save'] = '¨Ñ´à¡çº';
$lang['adr_phone'] = 'Phone'; // FIXME: need translation
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'ª×èÍ';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'á¡éä¢';
$lang['adr_expo_hea'] = 'è§ÍÍ¡';
$lang['adr_dele_hea'] = 'Åº';
$lang['adr_new_entry'] = 'ÃÒÂª×èÍãËÁè';

$lang['addr_saved'] = '¨Ñ´à¡çº¢éÍÁÙÅÃÒÂª×èÍáÅéÇ';
$lang['addr_added'] = 'à¾ÔèÁÃÒÂª×èÍáÅéÇ';
$lang['addr_deleted'] = 'ÅºÃÒÂª×èÍáÅéÇ';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available'; // FIXME: need translation
$lang['blk_close'] = '»Ô´';
$lang['blk_save'] = '¨´à¡çº';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = '¨Ñ´à¡çº';
$lang['evt_delete'] = 'Åº';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

