<?php
/*
 * Korean (한국어) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = '¹ÞÀºÆíÁöÇÔ';
$lang['sent_extended'] = 'º¸³½ÆíÁöÇÔ';
$lang['trash_extended'] = 'ÈÞÁöÅë';
$lang['spam_extended'] = '½ºÆÔÆíÁöÇÔ';

// Navigation texts
$lang['pages_text'] = 'ÆäÀÌÁö';
$lang['first_text'] = 'Ã³À½';
$lang['previous_text'] = 'ÀÌÀü';
$lang['next_text'] = '´ÙÀ½';
$lang['last_text'] = '¸¶Áö¸·';
$lang['total_text'] = 'ÀüÃ¼';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = '¼­¹ö¿¡ ¿¬°áÇÒ¼ö ¾ø½À´Ï´Ù';
$lang['error_retrieving'] = '¹ÞÀºÆíÁö¸¦ °¡Á®¿Ã¼ö ¾ø½À´Ï´Ù.';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = '½Ã½ºÅÛÀå¾ÖÀÔ´Ï´Ù. °ü¸®ÀÚ¿¡°Ô ¹®ÀÇÇÏ¼¼¿ä';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Æú´õÀÌ¸§¿£ ¿µ¹®,¼ýÀÚ ±×¸®°í - (»©±â) ¸¸ »ç¿ëÇÏ½Ç ¼ö ÀÖ½À´Ï´Ù.';

// Validations when sending mails
$lang['error_no_recipients'] = '¿À·ù: ¹Þ´Â»ç¶÷ÀÇ ÁÖ¼Ò¸¦ ÃÖ¼Ò 1°³ÀÌ»ó ÀÔ·ÂÇØ ÁÖ¼¼¿ä!';
$lang['error_compose_invalid_mail1_s'] = '¿À·ù: ÀÌ¸ÞÀÏ ÁÖ¼Ò°¡ ºñÁ¤»óÀÔ´Ï´Ù';
$lang['error_compose_invalid_mail1_p'] = '¿À·ù: ÀÌ¸ÞÀÏ ÁÖ¼ÒµéÀÌ ºñÁ¤»óÀÔ´Ï´Ù';
$lang['error_compose_invalid_mail2_s'] = 'º» ÀÌ¸ÞÀÏÀ» ´Ù½Ã º¸³»±âÀü¿¡ ¹Þ´ÂÀÌÀÇ ÁÖ¼Ò¸¦ È®ÀÎÇØÁÖ¼¼¿ä.';
$lang['error_compose_invalid_mail2_p'] = 'º» ÀÌ¸ÞÀÏÀ» ´Ù½Ã º¸³»±âÀü¿¡ º»ÀÎÀÇ ÁÖ¼Ò¸¦ È®ÀÎÇØÁÖ¼¼¿ä.';

// Confirmation of delete
$lang['confirm_delete'] = 'Á¤¸» ¼±ÅÃµÈ ÀÌ¸ÞÀÏ(µé)À» »èÁ¦ ÇÏ½Ã°Ú½À´Ï±î?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Á¦¸ñ¾øÀ½]';
$lang['no_sender_text'] = '[º¸³½ÀÌ ¾Ë¼ö¾øÀ½]';
$lang['no_recipient_text'] = '[¹Þ´ÂÀÌ ¾Ë¼ö¾øÀ½]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'ÀúÀå°ø°£ÀÌ ÃæºÐÇÏÁö ¾Ê½À´Ï´Ù. ¿À·¡µÈ ÀÌ¸ÞÀÏ ¶Ç´Â º¸³½ÀÌ¸ÞÀÏÀ» »èÁ¦ ÇØÁÖ¼¼¿ä.';
$lang['quota_usage_info'] = '¿ë·®Á¤º¸';
$lang['quota_usage_used'] = '»ç¿ëÁß = ';
$lang['quota_usage_of'] = ',ÀüÃ¼';
$lang['quota_usage_avail'] = '»ç¿ë°¡´É';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%Y-%m-%d %H:%M';

// CharSet
$lang['default_char_set'] = 'euc-kr';

// Menu
$lang['messages_mnu'] = '¹ÞÀºÆíÁöÇÔ';
$lang['read_menu'] = 'ÆíÁöÀÐ±â';
$lang['compose_mnu'] = 'ÆíÁö¾²±â';
$lang['refresh_mnu'] = '»õ·Î°íÄ§';
$lang['folders_mnu'] = 'Æú´õµé';
$lang['search_mnu'] = '°Ë»ö';
$lang['address_mnu'] = 'ÁÖ¼Ò·Ï';
$lang['empty_trash_mnu'] = 'ÈÞÁöÅëºñ¿ì±â';
$lang['prefs_mnu'] = 'È¯°æ¼³Á¤';
$lang['logoff_mnu'] = '·Î±×¾Æ¿ô';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
$lang['reply_from_hea'] = 'From:';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Date:';
$lang['reply_subject_hea'] = 'Subject:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'Æú´õ';
$lang['fld_messages_hea'] = 'ÀÌ¸ÞÀÏ';
$lang['fld_size_hea'] = 'Å©±â';
$lang['fld_empty_hea'] = 'ºñ¿ì±â';
$lang['fld_delete_hea'] = '»èÁ¦';
$lang['fld_total'] = 'ÀüÃ¼:';
$lang['fld_make_new'] = '»õÆú´õ ¸¸µé±â';
$lang['folders_to'] = 'Æú´õ·Î ÀÌµ¿';

// [MessageList]
$lang['messages_to'] = 'ÀÌ¸ÞÀÏ ÀÌµ¿ ';
$lang['no_messages'] = '»õ·Î¿î ÀÌ¸ÞÀÏÀÌ ¾ø½À´Ï´Ù -> ';
$lang['delete_selected_mnu'] = '»èÁ¦ ';
$lang['move_selected_mnu'] = 'ÀÌµ¿';
$lang['mark_selected_mnu'] = 'ÀÐÀ½ Ç¥½Ã';
$lang['unmark_selected_mnu'] = '¾ÈÀÐÀ½ Ç¥½Ã';
$lang['move_selected_to_trash_mnu'] = 'ÈÞÁöÅëÀ¸·Î';


$lang['delete_mnu'] = '»èÁ¦';
$lang['move_mnu'] = 'ÀÌµ¿';
$lang['subject_hea'] = 'Á¦¸ñ:';
$lang['from_hea'] = 'º¸³½ÀÌ:';
$lang['to_hea'] = '¹Þ´ÂÀÌ:';
$lang['date_hea'] = '³¯Â¥:';
$lang['size_hea'] = 'Å©±â';
$lang['have_spam'] = '½ºÆÔ¸ÞÀÏÀ» ¹Þ¾Ò½À´Ï´Ù. (½ºÆÔÆú´õ¸¦ È®ÀÎÇÏ¼¼¿ä)';

$lang['msg_you_have'] = '¹ÞÀºÆíÁö = ';
$lang['msg_message'] = 'Åë';
$lang['msg_messages'] = 'Åë';

$lang['msg_more_unread'] = '¾ÈÀÐÀ½';
$lang['msg_one_unread'] = '¾ÈÀÐÀ½';
$lang['msg_none_unread'] = 'ÀÐÁö¾ÊÀº';
$lang['msg_in_the_folder'] = 'Æú´õ¿¡ ÀÖÀ½';


// [Login]
$lang['lgn_title'] = '·Î±×ÀÎ';
$lang['lgn_welcome_msg'] = '¾È³çÇÏ¼¼¿ä! ¾Æ·¡¿¡ Á¤È®ÇÑ Á¤º¸¸¦ ÀÔ·ÂÈÄ ·Î±×ÀÎ ÇÏ¼¼¿ä';
$lang['lng_user_email'] = 'ÀÌ¸ÞÀÏ ÁÖ¼Ò';
$lang['lng_user_name'] = '¾ÆÀÌµð';
$lang['lng_user_pwd'] = 'ºñ¹Ð¹øÈ£';
$lang['lng_server'] = '¼­¹ö';
$lang['lng_theme'] = 'Å×¸¶';
$lang['lng_language'] = '¾ð¾î';
$lang['lng_login_btn'] = '·Î±×ÀÎ &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'ÄíÅ°»ç¿ëÀÌ Çã¿ëµÇ¾î¾ß ÇÕ´Ï´Ù. (ºê¶ó¿ìÁ® ¼³Á¤)';
$lang['lng_cookie_not_valid'] = 'ÄíÅ° º¸¾È°Ë»ç ½ÇÆÐ!';

// [Newmessage]

$lang['newmsg_title'] = 'ÀÌ¸ÞÀÏ ¾²±â';

$lang['to_hea'] = '¹Þ´ÂÀÌ:';
$lang['cc_hea'] = 'ÂüÁ¶:';
$lang['bcc_hea'] = '¼ûÀºÂüÁ¶:';
$lang['subject_hea'] = 'Á¦¸ñ:';
$lang['address_tip'] = 'ÁÖ¼Ò·ÏÃ£±â';

$lang['attach_hea'] = 'Ã·ºÎÈ­ÀÏ:';
$lang['attch_add_new'] = 'È­ÀÏ Ã·ºÎÇÏ±â';
$lang['attch_name_hea'] = 'ÀÌ¸§';
$lang['attch_size'] = 'Å©±â';
$lang['attch_type_hea'] = 'Á¾·ù';
$lang['attch_dele_hea'] = '»èÁ¦';
$lang['attch_no_hea'] = 'Ã·ºÎÈ­ÀÏ ¾øÀ½';

$lang['add_signature'] = '¼­¸í Ãß°¡ÇÏ±â';
$lang['send_text'] = 'º¸³»±â';

$lang['result_error'] = 'ÀÌ¸ÞÀÏ ¹ß¼Û ½ÇÆÐ!';
$lang['result_success'] = 'ÀÌ¸ÞÀÏÀÌ ¼º°øÀûÀ¸·Î ¹ß¼ÛµÇ¾ú½À´Ï´Ù.';
$lang['nav_continue'] = '&lt;&lt; °è¼Ó &gt;&gt;';
$lang['nav_back'] = 'µÚ·Î';

$lang['up_title'] = 'È­ÀÏÃß°¡';
$lang['up_information_text'] = 'È­ÀÏ ¼±ÅÃ';
$lang['up_button_text'] = 'È­ÀÏ Ã·ºÎ';

$lang['require_receipt'] = '¼ö½Å È®ÀÎ¸ÞÀÏ ¹Þ±â';

$lang['priority_text'] = 'Áß¿äµµ';
$lang['priority_low'] = '³·À½';
$lang['priority_normal'] = 'º¸Åë';
$lang['priority_high'] = '³ôÀ½';

// [Preferences]
$lang['prf_title'] = 'È¯°æ ¼³Á¤';
$lang['prf_general_title'] = '±âº» Á¤º¸';
$lang['prf_name'] = 'ÀÌ¸§';
$lang['prf_reply_to'] = 'È¸½Å¹ÞÀ» ÁÖ¼Ò';
$lang['prf_time_zone'] = 'Áö¿ª ½Ã°£ ¼³Á¤';
$lang['prf_trash_title'] = 'ÈÞÁöÅë';
$lang['prf_save_to_trash'] = 'ÆíÁö¸¦ <b>»èÁ¦</b> ½Ã ´ÙÀ½ Æú´õ·Î ÀÌµ¿ÇÕ´Ï´Ù. ';
$lang['prf_save_only_read'] = 'ÀÌ¹Ì <b>ÀÐÀº ÆíÁö</b>¸¸ ´ÙÀ½ Æú´õ·Î ÀÌµ¿ÇÕ´Ï´Ù.';
$lang['prf_empty_on_exit'] = '·Î±×¾Æ¿ô½Ã ÀÚµ¿À¸·Î <b>ÈÞÁöÅë</b> ºñ¿ì±â';
$lang['prf_empty_spam_on_exit'] = '·Î±×¾Æ¿ô½Ã ÀÚµ¿À¸·Î <b>½ºÆÔÆú´õ</b> ºñ¿ì±â';
$lang['prf_unmark_read_on_exit'] = '·Î±×¾Æ¿ô½Ã ÀÚµ¿À¸·Î <b>ÀÐÀºÆíÁö</b>¸¦ ¾ÈÀÐÀ½À¸·Î ¼³Á¤ÇÏ±â';
$lang['prf_sent_title'] = 'º¸³½ ÆíÁö';
$lang['prf_save_sent'] = '<b>º¸³½ÆíÁö¸¦</b> ´ÙÀ½ Æú´õ¿¡ ÀúÀåÇÕ´Ï´Ù. ';
$lang['prf_messages_title'] = 'ÀÌ¸ÞÀÏ°ü·Ã';
$lang['prf_page_limit'] = 'ÇÑÆäÀÌÁö¿¡ º¸¿©Áú ÀÌ¸ÞÀÏ °¹¼ö';
$lang['prf_signature_title'] = '¼­¸í';
$lang['prf_signature'] = '¼­¸í¾²±â';
$lang['prf_auto_add_sign'] = 'º¸³»´Â ¸ðµç ÆíÁö¿¡ ÀÚµ¿À¸·Î ¼­¸í Ãß°¡ÇÏ±â ';
$lang['prf_save_button'] = 'ÀúÀåÇÏ±â';
$lang['prf_display_images'] = 'Ã·ºÎµÈ ÀÌ¹ÌÁö¸¦ ÀÚµ¿À¸·Î ÀÌ¸ÞÀÏ º»¹®¿¡ º¸¿©ÁÝ´Ï´Ù';
$lang['prf_default_editor_mode'] = '±âº» ¾²±â¼³Á¤';
$lang['prf_default_editor_mode_text'] = '"ÅØ½ºÆ®¸¸ »ç¿ë"';
$lang['prf_default_editor_mode_html'] = '"°í±Þ¿¡µðÅÍ »ç¿ë"';
$lang['prf_time_to_refesh'] = 'ÀÚµ¿À¸·Î »õ·Î¿Â ÀÌ¸ÞÀÏ È®ÀÎÇÏ±â (~ºÐ°£°Ý)';
$lang['prf_spam_level'] = '½ºÆÔ Â÷´Ü Á¤µµ (0 = Â÷´Ü¾ÈÇÔ, 1 = ¸Å¿ì³ôÀ½, 9 = ¸Å¿ì³·À½)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation

$lang['prf_msg_saved'] = 'Preferences saved'; // FIXME: need translation

// filters
$lang['filter_title'] = 'Filters'; // FIXME: need translation

$lang['filter_new'] = 'Create a filter'; // FIXME: need translation
$lang['filter_desc'] = 'Choose the search criteria and the action for the incoming messages'; // FIXME: need translation
$lang['filter_list'] = 'Current filters'; // FIXME: need translation

$lang['filter_field_from'] = 'From'; // FIXME: need translation
$lang['filter_field_to'] = 'To'; // FIXME: need translation
$lang['filter_field_subject'] = 'Subject'; // FIXME: need translation
$lang['filter_field_header'] = 'Header'; // FIXME: need translation
$lang['filter_field_body'] = 'Body'; // FIXME: need translation

$lang['filter_type_move'] = 'Move'; // FIXME: need translation
$lang['filter_type_delete'] = 'Delete'; // FIXME: need translation
$lang['filter_type_mark'] = 'Mark read'; // FIXME: need translation

$lang['filter_add'] = 'Add filter'; // FIXME: need translation
$lang['filter_delete'] = 'Delete'; // FIXME: need translation
$lang['filter_delete_selected'] = 'Delete selected filters'; // FIXME: need translation

$lang['filter_field'] = 'Filter on field'; // FIXME: need translation
$lang['filter_match'] = 'Search for'; // FIXME: need translation
$lang['filter_type'] = 'Action'; // FIXME: need translation
$lang['filter_folder'] = 'Destination folder'; // FIXME: need translation

$lang['filter_msg_nofilters'] = 'No filters available.'; // FIXME: need translation
$lang['filter_msg_added'] = 'Filter added'; // FIXME: need translation
$lang['filter_msg_deleted'] = 'Filter deleted'; // FIXME: need translation


// [Catch]
$lang['ctc_title'] = 'ÁÖ¼Ò·Ï¿¡ Ãß°¡';
$lang['ctc_information'] = 'ÁÖ¼Ò·Ï¿¡ ¾ø´Â ÁÖ¼Ò·ÎºÎÅÍ ¹ß¼ÛµÈ ÀÌ¸ÞÀÏ¸¸ º¸±â';
$lang['ctc_name'] = 'ÀÌ¸§';
$lang['ctc_email'] = 'ÀÌ¸ÞÀÏ';
$lang['ctc_no_address'] = 'ÀÌ¸ÞÀÏ ÁÖ¼Ò ¾øÀ½';
$lang['ctc_close'] = '´Ý±â';
$lang['ctc_save'] = 'ÀúÀå';

// [Readmsg]
$lang['next_mnu'] = '´ÙÀ½';
$lang['previous_mnu'] = 'ÀÌÀü';
$lang['back_mnu'] = 'µÚ·Î';
$lang['reply_mnu'] = '´äÀå';
$lang['reply_all_mnu'] = '¸ðµÎ¿¡°Ô ´äÀå';
$lang['forward_mnu'] = 'Àü´Þ';
$lang['headers_mnu'] = 'Çì´õÁ¤º¸';
$lang['move_mnu'] = 'ÀÌµ¿';
$lang['move_to_trash_mnu'] = 'ÈÞÁöÅëÀ¸·Î';
$lang['delete_mnu'] = '»èÁ¦';
$lang['print_mnu'] = 'ÀÎ¼â';
$lang['download_mnu'] = 'Download'; // FIXME: need translation

$lang['from_hea'] = 'º¸³½ÀÌ:';
$lang['to_hea'] = '¹Þ´ÂÀÌ:';
$lang['cc_hea'] = 'ÂüÁ¶:';
$lang['date_hea'] = '³¯Â¥:';
$lang['subject_hea'] = 'Á¦¸ñ:';
$lang['attach_hea'] = 'Ã·ºÎÈ­ÀÏ:';

$lang['attch_name_hea'] = 'ÀÌ¸§';
$lang['attch_force_hea'] = '´Ù¿î·Îµå';
$lang['attch_type_hea'] = 'Á¾·ù';
$lang['attch_size_hea'] = 'Å©±â';
$lang['catch_address'] = 'ÁÖ¼Ò·Ï¿¡ Ãß°¡';
$lang['block_address'] = 'ÁÖ¼Ò Â÷´Ü';

// [Search]
$lang['sch_title'] = '°Ë»ö';
$lang['sch_information_text'] = 'Ã£À¸½Ç ´Ü¾î³ª ¹®ÀåÀ» ÀÔ·ÂÇÏ¼¼¿ä<br> ÀÌ¹Ì ÀÐÀº ÆíÁöµé¸¸À» ´ë»óÀ¸·Î °Ë»öÇÕ´Ï´Ù.';
$lang['sch_button_text'] = '°Ë»ö &gt;&gt;';
$lang['sch_subject_hea'] = 'Á¦¸ñ';
$lang['sch_from_hea'] = 'º¸³½ÀÌ';
$lang['sch_date_hea'] = '³¯Â¥';
$lang['sch_body_hea'] = 'ÆíÁö³»¿ë';
$lang['sch_folder_hea'] = 'Æú´õ';
$lang['sch_no_results'] = 'Ã£À¸½Ã´Â ³»¿ë¿¡ ´ëÇÑ °Ë»ö°á°ú°¡ ¾ø½À´Ï´Ù.';

// [QuickAddress]
$lang['qad_title'] = 'ÁÖ¼Ò·Ï';
$lang['qad_select_address'] = 'ÁÖ¼Ò ¼±ÅÃ';
$lang['qad_to'] = '¹Þ´ÂÀÌ';
$lang['qad_cc'] = 'ÂüÁ¶';
$lang['qad_bcc'] = '¼ûÀºÂüÁ¶';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'ÁÖ¼Ò·Ï';
$lang['adr_name'] = 'ÀÌ¸§';
$lang['adr_email'] = 'ÀÌ¸ÞÀÏ';
$lang['adr_street'] = 'ÁÖ¼Ò';
$lang['adr_city'] = 'ÀüÈ­¹øÈ£1';
$lang['adr_state'] = 'ÀüÈ­¹øÈ£2';
$lang['adr_work'] = '±âÅ¸»çÇ×';
$lang['adr_back'] = 'µÚ·Î';
$lang['adr_save'] = 'ÀúÀå';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'ÀÌ¸§';
$lang['adr_email_hea'] = 'ÀÌ¸ÞÀÏ';
$lang['adr_edit_hea'] = '¼öÁ¤';
$lang['adr_expo_hea'] = '³»º¸³»±â';
$lang['adr_dele_hea'] = '»èÁ¦';
$lang['adr_new_entry'] = '»õ ÁÖ¼Ò';

$lang['addr_saved'] = '¼º°øÀûÀ¸·Î ÀúÀå µÇ¾ú½À´Ï´Ù.';
$lang['addr_added'] = '¼º°øÀûÀ¸·Î Ãß°¡ µÇ¾ú½À´Ï´Ù.';
$lang['addr_deleted'] = '¼º°øÀûÀ¸·Î »èÁ¦ µÇ¾ú½À´Ï´Ù.';


// [BlockSender]
$lang['blk_title'] = 'º¸³½ÀÌ Â÷´Ü';
$lang['blk_information'] = 'ÇÊÅÍµÇÁö ¾ÊÀº ÀÌ¸ÞÀÏ¸¸ º¸±â';
$lang['blk_email'] = 'ÀÌ¸ÞÀÏ';
$lang['blk_no_address'] = 'ÁÖ¼Ò ¾øÀ½';
$lang['blk_close'] = '´Ý±â';
$lang['blk_save'] = 'ÀúÀå';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'ÀúÀå';
$lang['evt_delete'] = '»èÁ¦';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

