<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'ถาดเข้า';
$lang['sent_extended'] = 'ถาดออก';
$lang['trash_extended'] = 'ถังขยะ';
$lang['spam_extended'] = 'จดหมายขยะ';

// Navigation texts
$lang['pages_text'] = 'หน้า';
$lang['first_text'] = 'หน้าแรก';
$lang['previous_text'] = 'ก่อนหน้า';
$lang['next_text'] = 'ถัดไป';
$lang['last_text'] = 'หน้าสุดท้าย';
$lang['total_text'] = 'ทั้งหมด';

// Mail Server Errors
$lang['err_login_msg'] = 'การเข้าสู่ระบบผิดพลาด';
$lang['err_system_msg'] = 'เกิดความผิดพลาดจากระบบ';
$lang['error_login'] = 'กรุณาตรวจเช็คชื่อผู้ใช้และรหัสผ่านให้ดีแล้วลองใหม่อีกครั้ง';
$lang['error_connect'] = 'ไม่สามารถติดต่อกับระบบได้ ทางเรากำลังปรับปรุง ระบบ';
$lang['error_retrieving'] = 'มีปัญหา การรับจดหมาย ทำให้ไม่สามารถรับจดหมายได้';
$lang['error_session_expired'] = 'ระยะเวลาในการเข้าสู่ระบบของคุณหมดแล้ว กรุณาเข้าสู่ระบบใหม่อีกครั้ง';
$lang['error_other'] = 'ระบบมีปัญหา ทางเรากำลังปรับปรุงระบบ';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'การตั้งชื่อไม่ถูกต้อง - คุณสามาถใช้ตัวอักษรได้ ดังนี้ : ก-ฮ, A-Z, 0-9, .-';

// Validations when sending mails
$lang['error_no_recipients'] = 'คุณต้องใส่ mail ของ ผู้รับอย่างน้อย 1 คน';
$lang['error_compose_invalid_mail1_s'] = 'ดูเหมือนว่า email นี้จะไม่ถูกต้อง';
$lang['error_compose_invalid_mail1_p'] = 'การส่งจดหมายลูกโซ่ไม่สามารถทำได้';
$lang['error_compose_invalid_mail2_s'] = 'ตรวจสอบการเขียนจดหมายก่อนส่ง';
$lang['error_compose_invalid_mail2_p'] = 'ตรวจสอบการเขียนจดหมายก่อนส่ง';

// Confirmation of delete
$lang['confirm_delete'] = 'คุณแน่ใจที่จะลบจดหมายนี้ ?';

// If the message no have a subject or sender
$lang['no_subject_text'] = 'ไม่มีหัวเรื่อง';
$lang['no_sender_text'] = 'ไม่ทราบ';
$lang['no_recipient_text'] = 'ไม่มีการรับรอง';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'เนื้อที่ของท่านเต็มแล้ว \r กรุณาลบจดหมายเก่าๆ ออก เพื่อเพิ่มเนื้อที่ว่างใน ระบบของท่าน';
$lang['quota_usage_info'] = 'จำกัดเนื้อที่';
$lang['quota_usage_used'] = 'ใช้ไป';
$lang['quota_usage_of'] = 'ของ';
$lang['quota_usage_avail'] = 'เนื้อที่ทั้งหมด';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'tis-620';

// Menu
$lang['messages_mnu'] = 'ข้อความ';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'เขียนจดหมาย';
$lang['refresh_mnu'] = 'รีโหลด';
$lang['folders_mnu'] = 'โฟลเดอร์';
$lang['search_mnu'] = 'ค้นหา';
$lang['address_mnu'] = 'มุดรายชื่อ';
$lang['empty_trash_mnu'] = 'ลบขยะ';
$lang['prefs_mnu'] = 'รายละเอียดส่วนตัว';
$lang['logoff_mnu'] = 'ออกจากระบบ';

// Reply
$lang['reply_prefix'] = 'Rv:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- ข้อความดังเดิม --------';
$lang['reply_from_hea'] = 'จาก :';
$lang['reply_to_hea'] = 'ถึง :';
$lang['reply_cc_hea'] = 'Cc :';
$lang['reply_date_hea'] = 'วันที่ :';
$lang['reply_subject_hea'] = 'หัวเรื่อง :';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'โฟลเดอร์';
$lang['fld_messages_hea'] = 'ข้อความ';
$lang['fld_size_hea'] = 'ขนาด';
$lang['fld_empty_hea'] = 'ว่าง';
$lang['fld_delete_hea'] = 'ลบ';
$lang['fld_total'] = 'ทั้งหมด :';
$lang['fld_make_new'] = 'ร้างโฟลเดอร์ใหม่';
$lang['folders_to'] = 'โฟลเดอร์s to';

// [MessageList]
$lang['messages_to'] = 'ข้อความถึง ';
$lang['no_messages'] = 'ไม่มีจดหมายใหม่ถึง คุณ';
$lang['delete_selected_mnu'] = 'ลบที่เลือก';
$lang['move_selected_mnu'] = 'ย้ายไปที่เลือก';
$lang['mark_selected_mnu'] = 'ทำเครื่องหมายว่าอ่านแล้ว';
$lang['unmark_selected_mnu'] = 'ทำเครื่องหมายว่ายังไม่อ่าน';
$lang['move_selected_to_trash_mnu'] = 'ย้ายที่เลือกลงถังขยะ';


$lang['delete_mnu'] = 'ลบ';
$lang['move_mnu'] = 'ย้ายไป';
$lang['subject_hea'] = 'หัวเรื่อง :';
$lang['from_hea'] = 'จาก :';
$lang['to_hea'] = 'ถึง :';
$lang['date_hea'] = 'วันที่ :';
$lang['size_hea'] = 'ขนาด';
$lang['have_spam'] = 'คุณมีจดหมายขยะ (ตรวสอบที่โฟลเดอร์จดหมายขยะ)';

$lang['msg_you_have'] = 'คุณมี';
$lang['msg_message'] = 'ข้อความ';
$lang['msg_messages'] = 'ข้อความ';

$lang['msg_more_unread'] = 'ยังไม่ได้อ่าน';
$lang['msg_one_unread'] = 'ยังไม่ได้ดู';
$lang['msg_none_unread'] = 'ไม่มีที่ยังไม่ได้อ่าน';
$lang['msg_in_the_folder'] = 'ในโฟลเดอร์';


// [Login]
$lang['lgn_title'] = 'เข้าระบบ';
$lang['lgn_welcome_msg'] = 'ยินดีต้อนรับสู่ Telaen webmail';
$lang['lng_user_email'] = 'จดหมายอิเล็กทรอนิกส์';
$lang['lng_user_name'] = 'ชื่อผู้ใช้';
$lang['lng_user_pwd'] = 'รหัสผ่าน';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'หน้าตา';
$lang['lng_language'] = 'ภาษา';
$lang['lng_login_btn'] = 'เข้าสู่ระบบ &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'คุณต้องเปิดการใช้งาน Cookies';
$lang['lng_cookie_not_valid'] = 'การตวจสอบ Cookie ล้มเหลว';

// [Newmessage]

$lang['newmsg_title'] = 'เขียนจดหมาย';

$lang['to_hea'] = 'ถึง :';
$lang['cc_hea'] = 'Cc :';
$lang['bcc_hea'] = 'Bcc :';
$lang['subject_hea'] = 'หัวเรื่อง :';
$lang['address_tip'] = 'จากสมุดรายชื่อ';

$lang['attach_hea'] = 'แนบไฟล์ :';
$lang['attch_add_new'] = 'เพิ่มไฟล์ใหม่';
$lang['attch_name_hea'] = 'ชื่อ';
$lang['attch_size'] = 'ขนาด';
$lang['attch_type_hea'] = 'ชนิด';
$lang['attch_dele_hea'] = 'ลบ';
$lang['attch_no_hea'] = 'ไม่มีการแนบไฟล์';

$lang['add_signature'] = 'เพิ่มลายเซ็นต์ท้ายจดหมาย';
$lang['send_text'] = '่งจดหมาย';

$lang['result_error'] = 'มันไม่สมบูรณ์ แต่ อาจจะส่งถึงผู้รับได้';
$lang['result_success'] = '่งจดหมายเรียบร้อยแล้ว';
$lang['nav_continue'] = 'ต่อไป';
$lang['nav_back'] = 'กลับ';

$lang['up_title'] = 'เพิ่มไฟล์';
$lang['up_information_text'] = 'เลือกไฟล์';
$lang['up_button_text'] = '่ง';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'ลำดับความสำคัญ';
$lang['priority_low'] = 'น้อย';
$lang['priority_normal'] = 'ปานกลาง';
$lang['priority_high'] = 'มาก';

// [Preferences]
$lang['prf_title'] = 'รายละเอียดส่วนตัว';
$lang['prf_general_title'] = 'ข้อมูลทั่วไปของคุณ';
$lang['prf_name'] = 'ชื่อ';
$lang['prf_reply_to'] = 'เมลล์ของคุณ';
$lang['prf_time_zone'] = 'เวลา';
$lang['prf_trash_title'] = 'ถังขยะ';
$lang['prf_save_to_trash'] = 'ตั้งถังขยะไว้ที่ไหน';
$lang['prf_save_only_read'] = 'จัดเก็บจดหมายไว้ที่ไหน';
$lang['prf_empty_on_exit'] = 'ลบจดหมายจาก Folder หลังจากออกจากระบบ';
$lang['prf_empty_spam_on_exit'] = '<b>ล้าง</b>กล่องจดหมายขยะเมื่อออกจากระบบ';
$lang['prf_unmark_read_on_exit'] = 'ทำเครื่องหมายจดหมายที่อ่านแล้วเป็น<b>ยังไม่อ่าน</b>เมื่อออกจากระบบ';
$lang['prf_sent_title'] = '่งรายการ';
$lang['prf_save_sent'] = 'จัดเก็บจดหมายที่ส่งไว้ที่ :';
$lang['prf_messages_title'] = 'ข้อความ';
$lang['prf_page_limit'] = 'แสดงจำนวนจดหมายต่อหน้า';
$lang['prf_signature_title'] = 'ลายเซ็นต์';
$lang['prf_signature'] = 'เขียนลายเซ็นต์';
$lang['prf_auto_add_sign'] = 'เพิ่มลายเซ็นต์ของคุณกับจดหมายที่จะส่งทุกฉบับ';
$lang['prf_save_button'] = 'จัดเก็บ';
$lang['prf_display_images'] = 'แสดงรูปภาพที่แนบ';
$lang['prf_default_editor_mode'] = 'โหมดการแก้ไขข้อความพื้นฐาน';
$lang['prf_default_editor_mode_text'] = '"การแก้ไขแบบข้อความธรรมดา"';
$lang['prf_default_editor_mode_html'] = '"การแก้ไขข้อความในรูปแบบ HTML"';
$lang['prf_time_to_refesh'] = 'รีโหลดทุกๆ [นาที]';
$lang['prf_spam_level'] = 'ระดับการตรวจจับจดหมายขยะ(0 = ไม่ตรวจจับ, 1 = สูงมาก, 9 = ต่ำมาก)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default';

$lang['prf_msg_saved'] = 'Preferences saved';

// filters
$lang['filter_title'] = 'ตัวกรอง';

$lang['filter_new'] = 'ร้างตัวกรอง';
$lang['filter_desc'] = 'เลือกรูปแบบการค้นหาจดหมายขยะและการกระทำของจดหมายเข้าแต่ละฉบับ';
$lang['filter_list'] = 'ตัวกรองปัจจุบัน';

$lang['filter_field_from'] = 'จาก';
$lang['filter_field_to'] = 'ถึง';
$lang['filter_field_subject'] = 'หัวข้อ';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'ย้าย';
$lang['filter_type_delete'] = 'ลบ';
$lang['filter_type_mark'] = 'ทำเครื่องหมายว่าอ่าน';

$lang['filter_add'] = 'เพิ่มตัวกรอง';
$lang['filter_delete'] = 'ลบ';
$lang['filter_delete_selected'] = 'ลบตัวกรองที่เลือก';

$lang['filter_field'] = 'ตัวกรองใน';
$lang['filter_match'] = 'ค้นหาข้อความ';
$lang['filter_type'] = 'การกระทำ';
$lang['filter_folder'] = 'โฟลเดอร์เป้าหมาย';

$lang['filter_msg_nofilters'] = 'ยังไม่มีตัวกรอง';
$lang['filter_msg_added'] = 'เพิ่มตัวกรองแล้ว';
$lang['filter_msg_deleted'] = 'ลบตัวกรองแล้ว';


// [Catch]
$lang['ctc_title'] = 'เพื่มไปในสมุดรายชื่อ';
$lang['ctc_information'] = 'แสดงเฉพาะจดหมายที่ส่งมากจากคนในสมุดรายชื่อ';
$lang['ctc_name'] = 'ชื่อ';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'รายชื่อไม่ถูกต้อง';
$lang['ctc_close'] = 'ปิด';
$lang['ctc_save'] = 'จดเก็บ';

// [Readmsg]
$lang['next_mnu'] = 'ต่อไป';
$lang['previous_mnu'] = 'ก่อนหน้า';
$lang['back_mnu'] = 'กลับ';
$lang['reply_mnu'] = 'ตอบกลับ';
$lang['reply_all_mnu'] = 'ตอบกลับทั้งหมด';
$lang['forward_mnu'] = '่งต่อ';
$lang['headers_mnu'] = 'หัว';
$lang['move_mnu'] = 'ย้ายไป';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'ลบ';
$lang['print_mnu'] = 'พิมพ์';
$lang['download_mnu'] = 'ดาวน์โหลด';

$lang['from_hea'] = 'จาก :';
$lang['to_hea'] = 'ถึง :';
$lang['cc_hea'] = 'Cc :';
$lang['date_hea'] = 'วันที่ :';
$lang['subject_hea'] = 'หัวเรื่อง :';
$lang['attach_hea'] = 'แนบไฟล์ :';

$lang['attch_name_hea'] = 'ชื่อ';
$lang['attch_force_hea'] = 'รับไฟล์';
$lang['attch_type_hea'] = 'ชนิด';
$lang['attch_size_hea'] = 'ขนาด';
$lang['catch_address'] = 'เพิ่มเข้าไปในสมุดรายชื่อ';
$lang['block_address'] = 'Block address';

// [Search]
$lang['sch_title'] = 'ค้นหา';
$lang['sch_information_text'] = 'เขียนข้อความที่ต้องการหาจาก จดหมายที่อ่านไปแล้ว';
$lang['sch_button_text'] = 'ค้นหา &gt;&gt;';
$lang['sch_subject_hea'] = 'หัวเรื่อง';
$lang['sch_from_hea'] = 'จาก';
$lang['sch_date_hea'] = 'วันที่';
$lang['sch_body_hea'] = 'ข้อความ';
$lang['sch_folder_hea'] = 'โฟลเดอร์';
$lang['sch_no_results'] = 'ไม่พบข้อความที่ค้นหา';

// [QuickAddress]
$lang['qad_title'] = 'มุดรายชื่อ';
$lang['qad_select_address'] = 'เลือก';
$lang['qad_to'] = 'ถึง';
$lang['qad_cc'] = 'ำเนา';
$lang['qad_bcc'] = 'ำเนาซ่อน';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'มุดรายชื่อ';
$lang['adr_name'] = 'ชื่อ';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'ถนน';
$lang['adr_city'] = 'เมือง';
$lang['adr_state'] = 'อำเภอ';
$lang['adr_work'] = 'งาน';
$lang['adr_back'] = 'กลับ';
$lang['adr_save'] = 'จัดเก็บ';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'ชื่อ';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'แก้ไข';
$lang['adr_expo_hea'] = '่งออก';
$lang['adr_dele_hea'] = 'ลบ';
$lang['adr_new_entry'] = 'รายชื่อใหม่';

$lang['addr_saved'] = 'จัดเก็บข้อมูลรายชื่อแล้ว';
$lang['addr_added'] = 'เพิ่มรายชื่อแล้ว';
$lang['addr_deleted'] = 'ลบรายชื่อแล้ว';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'จัดเก็บ';
$lang['evt_delete'] = 'ลบ';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

