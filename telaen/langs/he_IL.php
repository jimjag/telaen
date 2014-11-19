<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'דואר נכנס';
$lang['sent_extended'] = 'דואר נשלח';
$lang['trash_extended'] = 'סל המחזור';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'הקודם';
$lang['next_text'] = 'הבא';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = 'שגיאה בחיבור אל השרת';
$lang['error_retrieving'] = 'שגיאה בקבלת הדואר שלך, תיבת הדואר שלך השתנתה';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = 'תקלה במערכת, אנא פנה לאיש הסיסטם';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'שם תיקיה שגוי. יש להשתמש רק ב A-Z, 0-9, - ורווחים';

// Validations when sending mails
$lang['error_no_recipients'] = 'שגיאה: חובה עלייך לציין לפחות נמען אחד.';
$lang['error_compose_invalid_mail1_s'] = 'שגיאה: כתובת אי-מייל זאת נראית שגוייה';
$lang['error_compose_invalid_mail1_p'] = 'שגיאה: כתובת אי-מייל זאת נראית שגוייה';
$lang['error_compose_invalid_mail2_s'] = 'נא לבדוק את כתובת האי-מייל לפני שמנסים לשלוח מחדש הודעה זו.';
$lang['error_compose_invalid_mail2_p'] = 'נא לבדוק את הכתובות לפני שמנסים לשלוח מחדש הודעה זו.';

// Confirmation of delete
$lang['confirm_delete'] = 'האם אתה בטוח שברצונך למחוק את ההודעה(ות) הנ"ל?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[ללא נושא]';
$lang['no_sender_text'] = '[שולח לא ידוע]';
$lang['no_recipient_text'] = '[נמען לא ידוע]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'אין מספיק מקום בתיבת הדואר הנכנס שלך על מנת להמשיך את הפעולה\נא למחוק כמה הודעות על מנת להמשיך';
$lang['quota_usage_info'] = 'הגבלת מקום';
$lang['quota_usage_used'] = 'בשימוש';
$lang['quota_usage_of'] = 'מתוך';
$lang['quota_usage_avail'] = 'זמינים';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-8-i';

// Menu
$lang['messages_mnu'] = 'דואר נכנס';
$lang['read_menu'] = 'קרא אי-מייל(ים)';
$lang['compose_mnu'] = 'כתוב אי-מייל';
$lang['refresh_mnu'] = 'רענן';
$lang['folders_mnu'] = 'תיקיות';
$lang['search_mnu'] = 'חיפוש';
$lang['address_mnu'] = 'ספר כתובות';
$lang['empty_trash_mnu'] = 'נקה סל מחזור';
$lang['prefs_mnu'] = 'מאפיינים';
$lang['logoff_mnu'] = 'יציאה מהמערכת';

// Reply
$lang['reply_prefix'] = 'תשובה:';
$lang['forward_prefix'] = 'העברה:';
$lang['reply_delimiter'] = '--------- הודעה מקורית --------';
$lang['reply_from_hea'] = 'מ:';
$lang['reply_to_hea'] = 'אל:';
$lang['reply_cc_hea'] = 'עותק:';
$lang['reply_date_hea'] = 'תאריך:';
$lang['reply_subject_hea'] = 'נושא:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'מפתח';
$lang['value_hea'] = 'ערך';

// [Folders]
$lang['fld_name_hea'] = 'תיקיה';
$lang['fld_messages_hea'] = 'הודעות';
$lang['fld_size_hea'] = 'גודל';
$lang['fld_empty_hea'] = 'ריק';
$lang['fld_delete_hea'] = 'מחק';
$lang['fld_total'] = 'סך הכל:';
$lang['fld_make_new'] = 'צור תיקיה חדשה';
$lang['folders_to'] = 'תיקיות אל';

// [MessageList]
$lang['messages_to'] = 'הודעות אל ';
$lang['no_messages'] = 'אין לך הודעות חדשות בתוך ';
$lang['delete_selected_mnu'] = 'מחק מסומנים';
$lang['move_selected_mnu'] = 'העבר מסומנים אל';
$lang['mark_selected_mnu'] = 'Mark as read'; // FIXME: need translation
$lang['unmark_selected_mnu'] = 'Mark as unread'; // FIXME: need translation
$lang['move_selected_to_trash_mnu'] = 'העבר מסומנים אל סל המחזור';


$lang['delete_mnu'] = 'מחק';
$lang['move_mnu'] = 'העבר ל';
$lang['subject_hea'] = 'נושא:';
$lang['from_hea'] = 'מ:';
$lang['to_hea'] = 'אל:';
$lang['date_hea'] = 'תאריך:';
$lang['size_hea'] = 'גודל';
$lang['have_spam'] = 'You have Spam (check Spam folder)'; // FIXME: need translation

$lang['msg_you_have'] = 'יש לך';
$lang['msg_message'] = 'הודעה';
$lang['msg_messages'] = 'הודעות';

$lang['msg_more_unread'] = 'לא נקראו';
$lang['msg_one_unread'] = 'לא נקרא';
$lang['msg_none_unread'] = 'שלא נקרא';
$lang['msg_in_the_folder'] = 'בתיקיה';


// [Login]
$lang['lgn_title'] = 'כניסה';
$lang['lgn_welcome_msg'] = 'ברוך הבא, אנא הכנס את פרטי החשבון';
$lang['lng_user_email'] = 'אי-מייל';
$lang['lng_user_name'] = 'שם משתמש';
$lang['lng_user_pwd'] = 'סיסמא';
$lang['lng_server'] = 'שרת';
$lang['lng_theme'] = 'ערכה';
$lang['lng_language'] = 'שפה';
$lang['lng_login_btn'] = 'כניסה &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled'; // FIXME: need translation
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed'; // FIXME: need translation

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail'; // FIXME: need translation

$lang['to_hea'] = 'אל:';
$lang['cc_hea'] = 'עותק:';
$lang['bcc_hea'] = 'עותק עיוור:';
$lang['subject_hea'] = 'נושא:';
$lang['address_tip'] = 'מספר כתובות';

$lang['attach_hea'] = 'קובץ(ים) מצורף(ים):';
$lang['attch_add_new'] = 'צרף קובץ חדש';
$lang['attch_name_hea'] = 'שם';
$lang['attch_size'] = 'גודל';
$lang['attch_type_hea'] = 'סוג';
$lang['attch_dele_hea'] = 'מחק';
$lang['attch_no_hea'] = 'אין קבצים מצורפים';

$lang['add_signature'] = 'הוסף חתימה';
$lang['send_text'] = 'שלח';

$lang['result_error'] = 'לא הייתה אפשרות לשלוח אי-מייל זה';
$lang['result_success'] = 'האי-מייל נשלח';
$lang['nav_continue'] = 'המשך';
$lang['nav_back'] = 'אחורה';

$lang['up_title'] = 'הוסף קובץ';
$lang['up_information_text'] = 'בחר קובץ';
$lang['up_button_text'] = 'שלח';

$lang['require_receipt'] = 'Return receipt'; // FIXME: need translation

$lang['priority_text'] = 'עדיפות';
$lang['priority_low'] = 'נמוכה';
$lang['priority_normal'] = 'רגילה';
$lang['priority_high'] = 'גבוהה';

// [Preferences]
$lang['prf_title'] = 'מאפיינים';
$lang['prf_general_title'] = 'מידע כללי';
$lang['prf_name'] = 'שם';
$lang['prf_reply_to'] = 'הגב ל';
$lang['prf_time_zone'] = 'אזור זמן';
$lang['prf_trash_title'] = 'סל מחזור';
$lang['prf_save_to_trash'] = 'כאשר אתה <b>מוחק</b> הודעה, העבר אותה ל ';
$lang['prf_save_only_read'] = 'שמור רק <b>הודעות שנקראו</b> בתוך ה ';
$lang['prf_empty_on_exit'] = '<b>רוקן</b> את סל המחזור ביציאה';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout'; // FIXME: need translation
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout'; // FIXME: need translation
$lang['prf_sent_title'] = 'הודעות יוצאות';
$lang['prf_save_sent'] = 'שמור <b>הודעות שנשלחו</b> בתוך ה ';
$lang['prf_messages_title'] = 'הודעות';
$lang['prf_page_limit'] = 'מקסימום הודעות בעמוד';
$lang['prf_signature_title'] = 'חתימה';
$lang['prf_signature'] = 'כתוב את חתימתך';
$lang['prf_auto_add_sign'] = 'הוסף את חתימתך לכל ההודעות היוצאות';
$lang['prf_save_button'] = 'שמור';
$lang['prf_display_images'] = 'הצג תמונות מצורפות';
$lang['prf_default_editor_mode'] = 'מצב עריכה בברירת מחדל';
$lang['prf_default_editor_mode_text'] = '"טקסט רגיל"';
$lang['prf_default_editor_mode_html'] = '"עורך HTML מתקדם"';
$lang['prf_time_to_refesh'] = 'בדוק אוטומטית עבור דואר חדש (דקות)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // FIXME: need translation
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
$lang['ctc_title'] = 'הוסף לספר הכתובות';
$lang['ctc_information'] = 'מראה רק אי-מיילים שהם בספר הכתובות';
$lang['ctc_name'] = 'שם';
$lang['ctc_email'] = 'אי-מייל';
$lang['ctc_no_address'] = 'אין כתובת זמינה';
$lang['ctc_close'] = 'סגור';
$lang['ctc_save'] = 'שמור';

// [Readmsg]
$lang['next_mnu'] = 'הבא';
$lang['previous_mnu'] = 'הקודם';
$lang['back_mnu'] = 'אחורה';
$lang['reply_mnu'] = 'הגב';
$lang['reply_all_mnu'] = 'הגב לכולם';
$lang['forward_mnu'] = 'העבר';
$lang['headers_mnu'] = 'כותר';
$lang['move_mnu'] = 'העבר ל';
$lang['move_to_trash_mnu'] = 'העבר לסל המחזור';
$lang['delete_mnu'] = 'מחק';
$lang['print_mnu'] = 'הדפס';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'מ:';
$lang['to_hea'] = 'אל:';
$lang['cc_hea'] = 'עותק:';
$lang['date_hea'] = 'תאריך:';
$lang['subject_hea'] = 'נושא:';
$lang['attach_hea'] = 'קובץ(ים) מצורף(ים):';

$lang['attch_name_hea'] = 'שם';
$lang['attch_force_hea'] = 'הורד';
$lang['attch_type_hea'] = 'סוג';
$lang['attch_size_hea'] = 'גודל';
$lang['catch_address'] = 'הוסף לספר הכתובות';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'כתוב ביטוי או מילה כדי לחפש בהם.<br> החיפוש יתבצע רק בהודעות שנקראו.';
$lang['sch_button_text'] = 'חפש &gt;&gt;';
$lang['sch_subject_hea'] = 'נושא';
$lang['sch_from_hea'] = 'מאת';
$lang['sch_date_hea'] = 'תאריך';
$lang['sch_body_hea'] = 'גוף ההודעה';
$lang['sch_folder_hea'] = 'תיקיה';
$lang['sch_no_results'] = 'לא נמצאה אף הודעה התואמת את מחרוזת החיפוש';

// [QuickAddress]
$lang['qad_title'] = 'ספר הכתובות';
$lang['qad_select_address'] = 'בחר איש קשר';
$lang['qad_to'] = 'אל';
$lang['qad_cc'] = 'עותק';
$lang['qad_bcc'] = 'עותק עיוור';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'ספר כתובות';
$lang['adr_name'] = 'שם';
$lang['adr_email'] = 'אי-מייל';
$lang['adr_street'] = 'רחוב';
$lang['adr_city'] = 'עיר';
$lang['adr_state'] = 'מדינה';
$lang['adr_work'] = 'עבודה';
$lang['adr_back'] = 'חזרה';
$lang['adr_save'] = 'שמור';
$lang['adr_phone'] = 'Phone'; // FIXME: need translation
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'שם';
$lang['adr_email_hea'] = 'אי-מייל';
$lang['adr_edit_hea'] = 'עריכה';
$lang['adr_expo_hea'] = 'ייצא';
$lang['adr_dele_hea'] = 'מחק';
$lang['adr_new_entry'] = 'צור איש-קשר חדש';

$lang['addr_saved'] = 'פרטי איש הקשר נשמרו';
$lang['addr_added'] = 'פרטי איש הקשר נוספו';
$lang['addr_deleted'] = 'איש הקשר נמחק';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // FIXME: need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available'; // FIXME: need translation
$lang['blk_close'] = 'Close'; // FIXME: need translation
$lang['blk_save'] = 'Save'; // FIXME: need translation

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'שמור';
$lang['evt_delete'] = 'מחק';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

