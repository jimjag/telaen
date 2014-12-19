<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'Sent items';
$lang['trash_extended'] = 'Trash folder';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Previous';
$lang['next_text'] = 'Next';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = 'Error connecting to the server';
$lang['error_retrieving'] = 'Error getting your messages, your Inbox has changed';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = 'System failure, please contact your network administrator';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Invalid folder name - Use only the following characters  A-Z, a-z, 0-9, and -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Error: You must have at least one recipient!';
$lang['error_compose_invalid_mail1_s'] = 'Error: This e-mail address seems to be invalid';
$lang['error_compose_invalid_mail1_p'] = 'Error: This e-mail addresses seem to be invalid';
$lang['error_compose_invalid_mail2_s'] = 'Check the e-mail address before resending this email.';
$lang['error_compose_invalid_mail2_p'] = 'Check your addresses before resending this email.';

// Confirmation of delete
$lang['confirm_delete'] = 'Do you really want to delete this message(s)?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[No subject]';
$lang['no_sender_text'] = '[Sender unknown]';
$lang['no_recipient_text'] = '[Recipient unknown]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Not enough space in your inbox to complete this action\nPlease delete some messages to continue';
$lang['quota_usage_info'] = 'Quota limit';
$lang['quota_usage_used'] = 'Used';
$lang['quota_usage_of'] = 'of';
$lang['quota_usage_avail'] = 'available';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Write E-Mail';
$lang['refresh_mnu'] = 'Refresh';
$lang['folders_mnu'] = 'Folders';
$lang['search_mnu'] = 'Search';
$lang['address_mnu'] = 'Address book';
$lang['empty_trash_mnu'] = 'Empty trash';
$lang['prefs_mnu'] = 'Preferences';
$lang['logoff_mnu'] = 'Log out';

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
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'Messages';
$lang['fld_size_hea'] = 'Size';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Delete';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'Create new folder';
$lang['folders_to'] = 'Folders to';

// [MessageList]
$lang['messages_to'] = 'Messages to ';
$lang['no_messages'] = 'No new messages in your ';
$lang['delete_selected_mnu'] = 'Delete ';
$lang['move_selected_mnu'] = 'Move to';
$lang['mark_selected_mnu'] = 'Mark as read';
$lang['unmark_selected_mnu'] = 'Mark as unread';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash';


$lang['delete_mnu'] = 'Delete';
$lang['move_mnu'] = 'Move to';
$lang['subject_hea'] = 'Subject:';
$lang['from_hea'] = 'From:';
$lang['to_hea'] = 'To:';
$lang['date_hea'] = 'Date:';
$lang['size_hea'] = 'Size';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

$lang['msg_you_have'] = 'You have';
$lang['msg_message'] = 'message';
$lang['msg_messages'] = 'messages';

$lang['msg_more_unread'] = 'unread';
$lang['msg_one_unread'] = 'unread';
$lang['msg_none_unread'] = 'none to read';
$lang['msg_in_the_folder'] = 'in the folder';


// [Login]
$lang['lgn_title'] = 'Login';
$lang['lgn_welcome_msg'] = 'Welcome, please login into your account';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Username';
$lang['lng_user_pwd'] = 'Password';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Theme';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Login &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Subject:';
$lang['address_tip'] = 'From address book';

$lang['attach_hea'] = 'Attachment:';
$lang['attch_add_new'] = 'Attach new file';
$lang['attch_name_hea'] = 'Name';
$lang['attch_size'] = 'Size';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Delete';
$lang['attch_no_hea'] = 'No attachments';

$lang['add_signature'] = 'Add signature';
$lang['send_text'] = 'Send';

$lang['result_error'] = 'It was not possible to send this e-mail';
$lang['result_success'] = 'This e-mail has been sent';
$lang['nav_continue'] = '&lt;&lt; Continue &gt;&gt;';
$lang['nav_back'] = 'Back';

$lang['up_title'] = 'Add file';
$lang['up_information_text'] = 'Select file';
$lang['up_button_text'] = 'Attach file';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Priority';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'High';

// [Preferences]
$lang['prf_title'] = 'Preferences';
$lang['prf_general_title'] = 'General information';
$lang['prf_name'] = 'Name';
$lang['prf_reply_to'] = 'Reply to';
$lang['prf_time_zone'] = 'Time zone';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'When you <b>delete</b> a message, move it to ';
$lang['prf_save_only_read'] = 'After you <b>read</b> a message, move it to ';
$lang['prf_empty_on_exit'] = '<b>Empty</b> trash folder when you logout';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = 'Sent items';
$lang['prf_save_sent'] = 'Save <b>sent messages</b> in the ';
$lang['prf_messages_title'] = 'Messages';
$lang['prf_page_limit'] = 'Maximum number of messages per page';
$lang['prf_signature_title'] = 'Signature';
$lang['prf_signature'] = 'Write your signature';
$lang['prf_auto_add_sign'] = 'Add your signature to all the outgoing messages ';
$lang['prf_save_button'] = 'Save Preferences';
$lang['prf_display_images'] = 'Show attached images';
$lang['prf_default_editor_mode'] = 'Default edit mode';
$lang['prf_default_editor_mode_text'] = '"Plain text"';
$lang['prf_default_editor_mode_html'] = '"Advanced HTML editor"';
$lang['prf_time_to_refesh'] = 'Automatically check for new mail (minutes)';
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
$lang['ctc_title'] = 'Add to address book';
$lang['ctc_information'] = 'Only shows e-mails that are not in the address book';
$lang['ctc_name'] = 'Name';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'No address available';
$lang['ctc_close'] = 'Close';
$lang['ctc_save'] = 'Save';

// [Readmsg]
$lang['next_mnu'] = 'Next';
$lang['previous_mnu'] = 'Previous';
$lang['back_mnu'] = 'Back';
$lang['reply_mnu'] = 'Reply';
$lang['reply_all_mnu'] = 'Reply to all';
$lang['forward_mnu'] = 'Forward';
$lang['headers_mnu'] = 'Header';
$lang['move_mnu'] = 'Move to';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Delete';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'From:';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Date:';
$lang['subject_hea'] = 'Subject:';
$lang['attach_hea'] = 'Attachment:';

$lang['attch_name_hea'] = 'Name';
$lang['attch_force_hea'] = 'Download';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Size';
$lang['catch_address'] = 'Add to address book';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Write a phrase or a word that you are looking for.<br> Only read messages will be searched.';
$lang['sch_button_text'] = 'Search &gt;&gt;';
$lang['sch_subject_hea'] = 'Subject';
$lang['sch_from_hea'] = 'From';
$lang['sch_date_hea'] = 'Date';
$lang['sch_body_hea'] = 'Message Body';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'No messages matching your criteria have been found';

// [QuickAddress]
$lang['qad_title'] = 'Address book';
$lang['qad_select_address'] = 'Select a contact';
$lang['qad_to'] = 'To';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Address book';
$lang['adr_name'] = 'Name';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'City';
$lang['adr_state'] = 'State';
$lang['adr_work'] = 'Work';
$lang['adr_back'] = 'Back';
$lang['adr_save'] = 'Save';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Name';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Edit';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Delete';
$lang['adr_new_entry'] = 'New contact';

$lang['addr_saved'] = 'The contact has been saved';
$lang['addr_added'] = 'The contact has been added';
$lang['addr_deleted'] = 'The contact has been deleted';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'Save';
$lang['evt_delete'] = 'Delete';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

