<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Inbox'; // need translation
$lang['sent_extended'] = 'Sent items'; // need translation
$lang['trash_extended'] = 'Trash folder'; // need translation
$lang['spam_extended'] = 'Spam folder'; // need translation

// Navigation texts
$lang['pages_text'] = 'Pages'; // need translation
$lang['first_text'] = 'First'; // need translation
$lang['previous_text'] = 'Previous'; // need translation
$lang['next_text'] = 'Next'; // need translation
$lang['last_text'] = 'Last'; // need translation
$lang['total_text'] = 'Total'; // need translation

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // need translation
$lang['err_system_msg'] = 'System error'; // need translation
$lang['error_login'] = 'Please check your username or password and try again'; // need translation
$lang['error_connect'] = 'Error connecting to the server'; // need translation
$lang['error_retrieving'] = 'Error getting your messages, your Inbox has changed'; // need translation
$lang['error_session_expired'] = 'Your session is expired, please login again'; // need translation
$lang['error_other'] = 'System failure, please contact your network administrator'; // need translation

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Invalid folder name - Use only the following characters  A-Z, a-z, 0-9, and -'; // need translation

// Validations when sending mails
$lang['error_no_recipients'] = 'Error: You must have at least one recipient!'; // need translation
$lang['error_compose_invalid_mail1_s'] = 'Error: This e-mail address seems to be invalid'; // need translation
$lang['error_compose_invalid_mail1_p'] = 'Error: This e-mail addresses seem to be invalid'; // need translation
$lang['error_compose_invalid_mail2_s'] = 'Check the e-mail address before resending this email.'; // need translation
$lang['error_compose_invalid_mail2_p'] = 'Check your addresses before resending this email.'; // need translation

// Confirmation of delete
$lang['confirm_delete'] = 'Do you really want to delete this message(s)?'; // need translation

// If the message no have a subject or sender
$lang['no_subject_text'] = '[No subject]'; // need translation
$lang['no_sender_text'] = '[Sender unknown]'; // need translation
$lang['no_recipient_text'] = '[Recipient unknown]'; // need translation

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Not enough space in your inbox to complete this action\nPlease delete some messages to continue'; // need translation
$lang['quota_usage_info'] = 'Quota limit'; // need translation
$lang['quota_usage_used'] = 'Used'; // need translation
$lang['quota_usage_of'] = 'of'; // need translation
$lang['quota_usage_avail'] = 'available'; // need translation

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M'; // need translation

// CharSet
$lang['default_char_set'] = 'iso-8859-1'; // need translation

// Menu
$lang['messages_mnu'] = 'Inbox'; // need translation
$lang['read_menu'] = 'Read E-Mail(s)'; // need translation
$lang['compose_mnu'] = 'Write E-Mail'; // need translation
$lang['refresh_mnu'] = 'Refresh'; // need translation
$lang['folders_mnu'] = 'Folders'; // need translation
$lang['search_mnu'] = 'Search'; // need translation
$lang['address_mnu'] = 'Address book'; // need translation
$lang['empty_trash_mnu'] = 'Empty trash'; // need translation
$lang['prefs_mnu'] = 'Preferences'; // need translation
$lang['logoff_mnu'] = 'Log out'; // need translation

// Reply
$lang['reply_prefix'] = 'Re:'; // need translation
$lang['forward_prefix'] = 'Fw:'; // need translation
$lang['reply_delimiter'] = '--------- Original Message --------'; // need translation
$lang['reply_from_hea'] = 'From:'; // need translation
$lang['reply_to_hea'] = 'To:'; // need translation
$lang['reply_cc_hea'] = 'Cc:'; // need translation
$lang['reply_date_hea'] = 'Date:'; // need translation
$lang['reply_subject_hea'] = 'Subject:'; // need translation
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key'; // need translation
$lang['value_hea'] = 'Value'; // need translation

// [Folders]
$lang['fld_name_hea'] = 'Folder'; // need translation
$lang['fld_messages_hea'] = 'Messages'; // need translation
$lang['fld_size_hea'] = 'Size'; // need translation
$lang['fld_empty_hea'] = 'Empty'; // need translation
$lang['fld_delete_hea'] = 'Delete'; // need translation
$lang['fld_total'] = 'Total:'; // need translation
$lang['fld_make_new'] = 'Create new folder'; // need translation
$lang['folders_to'] = 'Folders to'; // need translation

// [MessageList]
$lang['messages_to'] = 'Messages to '; // need translation
$lang['no_messages'] = 'No new messages in your '; // need translation
$lang['delete_selected_mnu'] = 'Delete '; // need translation
$lang['move_selected_mnu'] = 'Move to'; // need translation
$lang['mark_selected_mnu'] = 'Mark as read'; // need translation
$lang['unmark_selected_mnu'] = 'Mark as unread'; // need translation
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // need translation


$lang['delete_mnu'] = 'Delete'; // need translation
$lang['move_mnu'] = 'Move to'; // need translation
$lang['subject_hea'] = 'Subject:'; // need translation
$lang['from_hea'] = 'From:'; // need translation
$lang['to_hea'] = 'To:'; // need translation
$lang['date_hea'] = 'Date:'; // need translation
$lang['size_hea'] = 'Size'; // need translation
$lang['have_spam'] = 'You have Spam (check Spam folder)'; // need translation

$lang['msg_you_have'] = 'You have'; // need translation
$lang['msg_message'] = 'message'; // need translation
$lang['msg_messages'] = 'messages'; // need translation

$lang['msg_more_unread'] = 'unread'; // need translation
$lang['msg_one_unread'] = 'unread'; // need translation
$lang['msg_none_unread'] = 'none to read'; // need translation
$lang['msg_in_the_folder'] = 'in the folder'; // need translation


// [Login]
$lang['lgn_title'] = 'Login'; // need translation
$lang['lgn_welcome_msg'] = 'Welcome, please login into your account'; // need translation
$lang['lng_user_email'] = 'E-mail'; // need translation
$lang['lng_user_name'] = 'Username'; // need translation
$lang['lng_user_pwd'] = 'Password'; // need translation
$lang['lng_server'] = 'Server'; // need translation
$lang['lng_theme'] = 'Theme'; // need translation
$lang['lng_language'] = 'Language'; // need translation
$lang['lng_login_btn'] = 'Login &gt;&gt;'; // need translation
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled'; // need translation
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed'; // need translation

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail'; // need translation

$lang['to_hea'] = 'To:'; // need translation
$lang['cc_hea'] = 'Cc:'; // need translation
$lang['bcc_hea'] = 'Bcc:'; // need translation
$lang['subject_hea'] = 'Subject:'; // need translation
$lang['address_tip'] = 'From address book'; // need translation

$lang['attach_hea'] = 'Attachment:'; // need translation
$lang['attch_add_new'] = 'Attach new file'; // need translation
$lang['attch_name_hea'] = 'Name'; // need translation
$lang['attch_size'] = 'Size'; // need translation
$lang['attch_type_hea'] = 'Type'; // need translation
$lang['attch_dele_hea'] = 'Delete'; // need translation
$lang['attch_no_hea'] = 'No attachments'; // need translation

$lang['add_signature'] = 'Add signature'; // need translation
$lang['send_text'] = 'Send'; // need translation

$lang['result_error'] = 'It was not possible to send this e-mail'; // need translation
$lang['result_success'] = 'This e-mail has been sent'; // need translation
$lang['nav_continue'] = '&lt;&lt; Continue &gt;&gt;'; // need translation
$lang['nav_back'] = 'Back'; // need translation

$lang['up_title'] = 'Add file'; // need translation
$lang['up_information_text'] = 'Select file'; // need translation
$lang['up_button_text'] = 'Attach file'; // need translation

$lang['require_receipt'] = 'Return receipt'; // need translation

$lang['priority_text'] = 'Priority'; // need translation
$lang['priority_low'] = 'Low'; // need translation
$lang['priority_normal'] = 'Normal'; // need translation
$lang['priority_high'] = 'High'; // need translation

// [Preferences]
$lang['prf_title'] = 'Preferences'; // need translation
$lang['prf_general_title'] = 'General information'; // need translation
$lang['prf_name'] = 'Name'; // need translation
$lang['prf_reply_to'] = 'Reply to'; // need translation
$lang['prf_time_zone'] = 'Time zone'; // need translation
$lang['prf_trash_title'] = 'Trash'; // need translation
$lang['prf_save_to_trash'] = 'When you <b>delete</b> a message, move it to '; // need translation
$lang['prf_save_only_read'] = 'Save only <b>read messages</b> in the '; // need translation
$lang['prf_empty_on_exit'] = '<b>Empty</b> trash folder when you logout'; // need translation
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout'; // need translation
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout'; // need translation
$lang['prf_sent_title'] = 'Sent items'; // need translation
$lang['prf_save_sent'] = 'Save <b>sent messages</b> in the '; // need translation
$lang['prf_messages_title'] = 'Messages'; // need translation
$lang['prf_page_limit'] = 'Maximum number of messages per page'; // need translation
$lang['prf_signature_title'] = 'Signature'; // need translation
$lang['prf_signature'] = 'Write your signature'; // need translation
$lang['prf_auto_add_sign'] = 'Add your signature to all the outgoing messages '; // need translation
$lang['prf_save_button'] = 'Save Preferences'; // need translation
$lang['prf_display_images'] = 'Show attached images'; // need translation
$lang['prf_default_editor_mode'] = 'Default edit mode'; // need translation
$lang['prf_default_editor_mode_text'] = '"Plain text"'; // need translation
$lang['prf_default_editor_mode_html'] = '"Advanced HTML editor"'; // need translation
$lang['prf_time_to_refesh'] = 'Automatically check for new mail (minutes)'; // need translation
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // need translation
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // need translation

$lang['prf_msg_saved'] = 'Preferences saved'; // need translation

// filters
$lang['filter_title'] = 'Filters'; // need translation

$lang['filter_new'] = 'Create a filter'; // need translation
$lang['filter_desc'] = 'Choose the search criteria and the action for the incoming messages'; // need translation
$lang['filter_list'] = 'Current filters'; // need translation

$lang['filter_field_from'] = 'From'; // need translation
$lang['filter_field_to'] = 'To'; // need translation
$lang['filter_field_subject'] = 'Subject'; // need translation
$lang['filter_field_header'] = 'Header'; // need translation
$lang['filter_field_body'] = 'Body'; // need translation

$lang['filter_type_move'] = 'Move'; // need translation
$lang['filter_type_delete'] = 'Delete'; // need translation
$lang['filter_type_mark'] = 'Mark read'; // need translation

$lang['filter_add'] = 'Add filter'; // need translation
$lang['filter_delete'] = 'Delete'; // need translation
$lang['filter_delete_selected'] = 'Delete selected filters'; // need translation

$lang['filter_field'] = 'Filter on field'; // need translation
$lang['filter_match'] = 'Search for'; // need translation
$lang['filter_type'] = 'Action'; // need translation
$lang['filter_folder'] = 'Destination folder'; // need translation

$lang['filter_msg_nofilters'] = 'No filters available.'; // need translation
$lang['filter_msg_added'] = 'Filter added'; // need translation
$lang['filter_msg_deleted'] = 'Filter deleted'; // need translation


// [Catch]
$lang['ctc_title'] = 'Add to address book'; // need translation
$lang['ctc_information'] = 'Only shows e-mails that are not in the address book'; // need translation
$lang['ctc_name'] = 'Name'; // need translation
$lang['ctc_email'] = 'E-mail'; // need translation
$lang['ctc_no_address'] = 'No address available'; // need translation
$lang['ctc_close'] = 'Close'; // need translation
$lang['ctc_save'] = 'Save'; // need translation

// [Readmsg]
$lang['next_mnu'] = 'Next'; // need translation
$lang['previous_mnu'] = 'Previous'; // need translation
$lang['back_mnu'] = 'Back'; // need translation
$lang['reply_mnu'] = 'Reply'; // need translation
$lang['reply_all_mnu'] = 'Reply to all'; // need translation
$lang['forward_mnu'] = 'Forward'; // need translation
$lang['headers_mnu'] = 'Header'; // need translation
$lang['move_mnu'] = 'Move to'; // need translation
$lang['move_to_trash_mnu'] = 'Move to Trash'; // need translation
$lang['delete_mnu'] = 'Delete'; // need translation
$lang['print_mnu'] = 'Print'; // need translation
$lang['download_mnu'] = 'Download'; // need translation

$lang['from_hea'] = 'From:'; // need translation
$lang['to_hea'] = 'To:'; // need translation
$lang['cc_hea'] = 'Cc:'; // need translation
$lang['date_hea'] = 'Date:'; // need translation
$lang['subject_hea'] = 'Subject:'; // need translation
$lang['attach_hea'] = 'Attachment:'; // need translation

$lang['attch_name_hea'] = 'Name'; // need translation
$lang['attch_force_hea'] = 'Download'; // need translation
$lang['attch_type_hea'] = 'Type'; // need translation
$lang['attch_size_hea'] = 'Size'; // need translation
$lang['catch_address'] = 'Add to address book'; // need translation
$lang['block_address'] = 'Block address'; // need translation

// [Search]
$lang['sch_title'] = 'Search'; // need translation
$lang['sch_information_text'] = 'Write a phrase or a word that you are looking for.<br> Only read messages will be searched.'; // need translation
$lang['sch_button_text'] = 'Search &gt;&gt;'; // need translation
$lang['sch_subject_hea'] = 'Subject'; // need translation
$lang['sch_from_hea'] = 'From'; // need translation
$lang['sch_date_hea'] = 'Date'; // need translation
$lang['sch_body_hea'] = 'Message Body'; // need translation
$lang['sch_folder_hea'] = 'Folder'; // need translation
$lang['sch_no_results'] = 'No messages matching your criteria have been found'; // need translation

// [QuickAddress]
$lang['qad_title'] = 'Address book'; // need translation
$lang['qad_select_address'] = 'Select a contact'; // need translation
$lang['qad_to'] = 'To'; // need translation
$lang['qad_cc'] = 'Cc'; // need translation
$lang['qad_bcc'] = 'Bcc'; // need translation

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Address book'; // need translation
$lang['adr_name'] = 'Name'; // need translation
$lang['adr_email'] = 'E-mail'; // need translation
$lang['adr_street'] = 'Street'; // need translation
$lang['adr_city'] = 'City'; // need translation
$lang['adr_state'] = 'State'; // need translation
$lang['adr_work'] = 'Work'; // need translation
$lang['adr_back'] = 'Back'; // need translation
$lang['adr_save'] = 'Save'; // need translation
$lang['adr_phone'] = 'Phone'; // need translation
$lang['adr_cell'] = 'Cell'; // need translation
$lang['adr_note'] = 'Notes'; // need translation

// list
$lang['adr_name_hea'] = 'Name'; // need translation
$lang['adr_email_hea'] = 'E-mail'; // need translation
$lang['adr_edit_hea'] = 'Edit'; // need translation
$lang['adr_expo_hea'] = 'Export'; // need translation
$lang['adr_dele_hea'] = 'Delete'; // need translation
$lang['adr_new_entry'] = 'New contact'; // need translation

$lang['addr_saved'] = 'The contact has been saved'; // need translation
$lang['addr_added'] = 'The contact has been added'; // need translation
$lang['addr_deleted'] = 'The contact has been deleted'; // need translation


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // need translation
$lang['blk_email'] = 'E-mail'; // need translation
$lang['blk_no_address'] = 'No address available'; // need translation
$lang['blk_close'] = 'Close'; // need translation
$lang['blk_save'] = 'Save'; // need translation

// [Event]
$lang['evt_title'] = 'Calendar Event'; // need translation
$lang['evt_save'] = 'Save'; // need translation
$lang['evt_delete'] = 'Delete'; // need translation
$lang['evt_stop'] = 'Stop time'; // need translation
$lang['evt_start'] = 'Start time'; // need translation

