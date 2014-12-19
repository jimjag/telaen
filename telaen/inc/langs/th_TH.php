<?php
/*
 * Thai (ไทย) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'tis-620';

$lang['inbox_extended'] = 'กล่องขาเข้า';
$lang['sent_extended'] = 'รายการที่ส่ง';
$lang['trash_extended'] = 'โฟลเดอร์ถังขยะ';
$lang['spam_extended'] = 'โฟลเดอร์สแปม';
$lang['drafts_extended'] = 'ร่าง';

$lang['pages_text'] = 'หน้า';
$lang['first_text'] = 'ครั้งแรก';
$lang['previous_text'] = 'ก่อน';
$lang['next_text'] = 'ถัดไป';
$lang['last_text'] = 'ล่าสุด';
$lang['total_text'] = 'รวม';

$lang['err_login_msg'] = 'ข้อผิดพลาดเข้าสู่ระบบ';
$lang['err_system_msg'] = 'ข้อผิดพลาดของระบบ';
$lang['error_login'] = 'กรุณาตรวจสอบชื่อผู้ใช้หรือรหัสผ่านของคุณและลองอีกครั้ง';
$lang['error_connect'] = 'ข้อผิดพลาดการเชื่อมต่อกับเซิร์ฟเวอร์';
$lang['error_retrieving'] = 'ข้อผิดพลาดได้รับข้อความของคุณกล่องจดหมายของคุณมีการเปลี่ยนแปลง';
$lang['error_session_expired'] = 'เซสชั่นของคุณจะหมดอายุแล้วกรุณาเข้าสู่ระบบอีกครั้ง';
$lang['error_other'] = 'ความล้มเหลวของระบบกรุณาติดต่อผู้ดูแลระบบเครือข่ายของคุณ';

$lang['error_invalid_name'] = 'ชื่อโฟลเดอร์ไม่ถูกต้อง - ใช้เฉพาะอักขระต่อไปนี้ az, AZ, 0-9, และ -';

$lang['error_no_recipients'] = 'ข้อผิดพลาด: คุณต้องมีอย่างน้อยหนึ่งผู้รับ';
$lang['error_compose_invalid_mail1_s'] = 'ข้อผิดพลาด: e-mail address นี้ดูเหมือนว่าจะไม่ถูกต้อง';
$lang['error_compose_invalid_mail1_p'] = 'ข้อผิดพลาดนี้อยู่อีเมลดูเหมือนจะไม่ถูกต้อง';
$lang['error_compose_invalid_mail2_s'] = 'ตรวจสอบที่อยู่ e-mail ก่อนที่จะ resending อีเมล์นี้.';
$lang['error_compose_invalid_mail2_p'] = 'ตรวจสอบที่อยู่ของคุณก่อนที่ resending อีเมล์นี้.';

$lang['confirm_delete'] = 'คุณต้องการจริงๆที่จะลบข้อความนี้ (s)';

$lang['no_subject_text'] = '[ไม่มีหัวเรื่อง]';
$lang['no_sender_text'] = '[ไม่รู้จักผู้ส่ง]';
$lang['no_recipient_text'] = '[ผู้รับที่ไม่รู้จัก]';

$lang['quota_exceeded'] = 'พื้นที่ไม่เพียงพอในกล่องจดหมายของคุณเพื่อดำเนินการนี้ \ n กรุณาลบข้อความบางอย่างที่จะดำเนินการต่อไป';
$lang['quota_usage_info'] = 'ขีด จำกัด โควต้า';
$lang['quota_usage_used'] = 'ใช้';
$lang['quota_usage_of'] = 'ของ';
$lang['quota_usage_avail'] = 'มีอยู่';

$lang['messages_mnu'] = 'กล่องขาเข้า';
$lang['read_menu'] = 'อ่านอีเมล์ (s)';
$lang['compose_mnu'] = 'เขียน E-Mail:';
$lang['refresh_mnu'] = 'รีเฟรช';
$lang['folders_mnu'] = 'โฟลเดอร์';
$lang['search_mnu'] = 'ค้นหา';
$lang['address_mnu'] = 'ที่อยู่ในหนังสือ';
$lang['empty_trash_mnu'] = 'ว่างเปล่าถังขยะ';
$lang['prefs_mnu'] = 'การตั้งค่า';
$lang['logoff_mnu'] = 'ออกจากระบบ';

$lang['reply_prefix'] = 'เรื่อง';
$lang['forward_prefix'] = 'ส่งต่อ';
$lang['reply_delimiter'] = '--------- ข้อความต้นฉบับ --------';
$lang['reply_from_hea'] = 'จาก:';
$lang['reply_to_hea'] = 'เพื่อ';
$lang['reply_cc_hea'] = 'สำเนา:';
$lang['reply_date_hea'] = 'วันที่:';
$lang['reply_subject_hea'] = 'เรื่อง';

$lang['key_hea'] = 'คีย์';
$lang['value_hea'] = 'มูลค่า';

$lang['fld_name_hea'] = 'โฟลเดอร์';
$lang['fld_messages_hea'] = 'ข้อความ';
$lang['fld_size_hea'] = 'ขนาด';
$lang['fld_empty_hea'] = 'ว่างเปล่า';
$lang['fld_delete_hea'] = 'ลบ';
$lang['fld_total'] = 'รวม';
$lang['fld_make_new'] = 'สร้างโฟลเดอร์ใหม่';
$lang['folders_to'] = 'โฟลเดอร์เพื่อ';

// [messagelist]
$lang['messages_to'] = 'ข้อความที่จะ';
$lang['no_messages'] = 'ไม่มีข้อความใหม่ในของคุณ';
$lang['delete_selected_mnu'] = 'ลบ';
$lang['move_selected_mnu'] = 'ย้ายไป';
$lang['mark_selected_mnu'] = 'มาร์คว่าอ่าน';
$lang['unmark_selected_mnu'] = 'มาร์คยังไม่ได้อ่าน';
$lang['move_selected_to_trash_mnu'] = 'ย้ายไปที่ถังขยะ';

$lang['delete_mnu'] = 'ลบ';
$lang['move_mnu'] = 'ย้ายไป';
$lang['subject_hea'] = 'เรื่อง';
$lang['from_hea'] = 'จาก:';
$lang['to_hea'] = 'เพื่อ';
$lang['date_hea'] = 'วันที่:';
$lang['size_hea'] = 'ขนาด';
$lang['have_spam'] = 'คุณมีสแปม (Spam โฟลเดอร์ตรวจสอบ)';

$lang['msg_you_have'] = 'คุณมี';
$lang['msg_message'] = 'ข้อความ';
$lang['msg_messages'] = 'ข้อความ';

$lang['msg_more_unread'] = 'ยังไม่ได้อ่าน';
$lang['msg_one_unread'] = 'ยังไม่ได้อ่าน';
$lang['msg_none_unread'] = 'ไม่มีการอ่าน';
$lang['msg_in_the_folder'] = 'ในโฟลเดอร์';

$lang['lgn_title'] = 'เข้าสู่ระบบ';
$lang['lgn_welcome_msg'] = 'ยินดีต้อนรับคุณ, กรุณาเข้าสู่ระบบในบัญชีของคุณ';
$lang['lng_user_email'] = 'อีเมล';
$lang['lng_user_name'] = 'ชื่อผู้ใช้';
$lang['lng_user_pwd'] = 'รหัสผ่าน';
$lang['lng_server'] = 'เซิร์ฟเวอร์';
$lang['lng_theme'] = 'ธีม';
$lang['lng_language'] = 'ภาษา';
$lang['lng_login_btn'] = 'เข้าสู่ระบบ & gt; & gt;';
$lang['lng_cookie_not_enabled'] = 'คุกกี้จะต้องเปิดการใช้งาน';
$lang['lng_cookie_not_valid'] = 'Cookie รักษาความปลอดภัยตรวจสอบล้มเหลว';

$lang['newmsg_title'] = 'เขียนจดหมาย';

$lang['to_hea'] = 'เพื่อ';
$lang['cc_hea'] = 'สำเนา:';
$lang['bcc_hea'] = 'สำเนาลับ:';
$lang['subject_hea'] = 'เรื่อง';
$lang['address_tip'] = 'จากสมุดที่อยู่';

$lang['attach_hea'] = 'ที่แนบมา:';
$lang['attch_add_new'] = 'แนบไฟล์ใหม่';
$lang['attch_name_hea'] = 'ชื่อ';
$lang['attch_size'] = 'ขนาด';
$lang['attch_type_hea'] = 'ประเภท';
$lang['attch_dele_hea'] = 'ลบ';
$lang['attch_no_hea'] = 'ไม่มีสิ่งที่แนบมา';

$lang['add_signature'] = 'เพิ่มลายเซ็น';
$lang['send_text'] = 'ส่ง';

$lang['result_error'] = 'มันไม่ได้เป็นไปได้ที่จะส่ง e-mail นี้';
$lang['result_success'] = 'อีเมลนี้ได้ถูกส่ง';
$lang['nav_continue'] = '& lt; & lt; ดำเนินการต่อ & gt; & gt; ';
$lang['nav_back'] = 'กลับ';

$lang['up_title'] = 'เพิ่มไฟล์';
$lang['up_information_text'] = 'เลือกไฟล์';
$lang['up_button_text'] = 'แนบไฟล์';

$lang['require_receipt'] = 'ใบเสร็จรับเงินกลับ';

$lang['priority_text'] = 'ลำดับความสำคัญ';
$lang['priority_low'] = 'ต่ำ';
$lang['priority_normal'] = 'ปกติ';
$lang['priority_high'] = 'สูง';

$lang['prf_title'] = 'การตั้งค่า';
$lang['prf_general_title'] = 'ข้อมูลทั่วไป';
$lang['prf_name'] = 'ชื่อ';
$lang['prf_reply_to'] = 'ตอบ';
$lang['prf_time_zone'] = 'โซนเวลา';
$lang['prf_trash_title'] = 'ขยะ';
$lang['prf_save_to_trash'] = 'เมื่อคุณ <b> ลบ </ b> ข้อความย้ายไปยัง';
$lang['prf_save_only_read'] = 'หลังจากที่คุณ <b> อ่าน </ b> ข้อความย้ายไปยัง';
$lang['prf_empty_on_exit'] = '<b> เปล่า </ b> โฟลเดอร์ถังขยะเมื่อคุณออกจากระบบ';
$lang['prf_empty_spam_on_exit'] = '<b> เปล่า </ b> โฟลเดอร์สแปมเมื่อคุณออกจากระบบ';
$lang['prf_unmark_read_on_exit'] = 'รีเซ็ตอ่านข้อความที่ยังไม่ได้อ่านเมื่อคุณออกจากระบบ';
$lang['prf_sent_title'] = 'รายการที่ส่ง';
$lang['prf_save_sent'] = 'บันทึก <b> ส่งข้อความ </ b>';
$lang['prf_messages_title'] = 'ข้อความ';
$lang['prf_page_limit'] = 'จำนวนสูงสุดของข้อความต่อหน้า';
$lang['prf_signature_title'] = 'ลายเซ็น';
$lang['prf_signature'] = 'เขียนลายเซ็นของคุณ';
$lang['prf_auto_add_sign'] = 'เพิ่มลายเซ็นของคุณไปยังทุกข้อความที่ส่งออก';
$lang['prf_save_button'] = 'บันทึกการตั้งค่า';
$lang['prf_display_images'] = 'แสดงแนบภาพ';
$lang['prf_default_editor_mode'] = 'เริ่มต้นโหมดแก้ไข';
$lang['prf_default_editor_mode_text'] = '"ข้อความล้วน"';
$lang['prf_default_editor_mode_html'] = '"ตกแต่ง HTML"';
$lang['prf_time_to_refesh'] = 'ตรวจสอบโดยอัตโนมัติจดหมายใหม่ (นาที)';
$lang['prf_spam_level'] = 'ไว SPAM (0 = พิการ, 1 = สูงมาก, 9 = ต่ำมาก)';
$lang['prf_auto_require_receipt'] = 'จำเป็นต้องอ่านใบเสร็จรับเงินตามค่าเริ่มต้น';
$lang['prf_keep_on_server'] = 'เก็บอีเมล์บนเซิร์ฟเวอร์ - โฟลเดอร์ท้องถิ่นไม่มี';

$lang['prf_msg_saved'] = 'การตั้งค่าการบันทึกไว้';

$lang['filter_title'] = 'กรอง';

$lang['filter_new'] = 'สร้างตัวกรอง';
$lang['filter_desc'] = 'เลือกเกณฑ์การค้นหาและการดำเนินการสำหรับข้อความที่เข้ามา';
$lang['filter_list'] = 'ตัวกรองปัจจุบัน';

$lang['filter_field_from'] = 'จาก';
$lang['filter_field_to'] = 'เพื่อ';
$lang['filter_field_subject'] = 'เรื่อง';
$lang['filter_field_header'] = 'หัว';
$lang['filter_field_body'] = 'ร่างกาย';

$lang['filter_type_move'] = 'ย้าย';
$lang['filter_type_delete'] = 'ลบ';
$lang['filter_type_mark'] = 'มาร์คอ่าน';

$lang['filter_add'] = 'เพิ่มตัวกรอง';
$lang['filter_delete'] = 'ลบ';
$lang['filter_delete_selected'] = 'ลบกรองที่เลือก';

$lang['filter_field'] = 'กรองบนสนาม';
$lang['filter_match'] = 'ค้นหา';
$lang['filter_type'] = 'การกระทำ';
$lang['filter_folder'] = 'โฟลเดอร์ปลายทาง';

$lang['filter_msg_nofilters'] = 'ไม่มีฟิลเตอร์ที่มีอยู่.';
$lang['filter_msg_added'] = 'กรองเพิ่ม';
$lang['filter_msg_deleted'] = 'กรองลบ';


$lang['ctc_title'] = 'เพิ่มสมุด';
$lang['ctc_information'] = 'เท่านั้นที่แสดงให้เห็นถึงอีเมลที่ไม่ได้อยู่ในหนังสือที่อยู่';
$lang['ctc_name'] = 'ชื่อ';
$lang['ctc_email'] = 'อีเมล';
$lang['ctc_no_address'] = 'ไม่มีที่อยู่ที่มีอยู่';
$lang['ctc_close'] = 'ปิด';
$lang['ctc_save'] = 'บันทึก';

$lang['next_mnu'] = 'ถัดไป';
$lang['previous_mnu'] = 'ก่อน';
$lang['back_mnu'] = 'กลับ';
$lang['reply_mnu'] = 'ตอบ';
$lang['reply_all_mnu'] = 'ตอบกลับทั้งหมด';
$lang['forward_mnu'] = 'ไปข้างหน้า';
$lang['headers_mnu'] = 'หัว';
$lang['move_mnu'] = 'ย้ายไป';
$lang['move_to_trash_mnu'] = 'ย้ายไปที่ถังขยะ';
$lang['delete_mnu'] = 'ลบ';
$lang['print_mnu'] = 'พิมพ์';
$lang['download_mnu'] = 'ดาวน์โหลด';

$lang['from_hea'] = 'จาก:';
$lang['to_hea'] = 'เพื่อ';
$lang['cc_hea'] = 'สำเนา:';
$lang['date_hea'] = 'วันที่:';
$lang['subject_hea'] = 'เรื่อง';
$lang['attach_hea'] = 'ที่แนบมา:';

$lang['attch_name_hea'] = 'ชื่อ';
$lang['attch_force_hea'] = 'ดาวน์โหลด';
$lang['attch_type_hea'] = 'ประเภท';
$lang['attch_size_hea'] = 'ขนาด';
$lang['catch_address'] = 'เพิ่มสมุด';
$lang['block_address'] = 'ที่อยู่บล็อก';

$lang['sch_title'] = 'ค้นหา';
$lang['sch_information_text'] = '.. เขียนวลีหรือคำที่คุณกำลังมองหาเพียงดาวน์โหลดอ่านข้อความที่จะค้นหา';
$lang['sch_button_text'] = 'Search & gt; & gt;';
$lang['sch_subject_hea'] = 'เรื่อง';
$lang['sch_from_hea'] = 'จาก';
$lang['sch_date_hea'] = 'วัน';
$lang['sch_body_hea'] = 'ข้อความตัว';
$lang['sch_folder_hea'] = 'โฟลเดอร์';
$lang['sch_no_results'] = 'ไม่มีข้อความที่ตรงกับเกณฑ์ของคุณได้รับพบ';

$lang['qad_title'] = 'ที่อยู่ในหนังสือ';
$lang['qad_select_address'] = 'เลือกรายชื่อ';
$lang['qad_to'] = 'เพื่อ';
$lang['qad_cc'] = 'สำเนา';
$lang['qad_bcc'] = 'สำเนาลับ';

$lang['adr_title'] = 'ที่อยู่ในหนังสือ';
$lang['adr_name'] = 'ชื่อ';
$lang['adr_email'] = 'อีเมล';
$lang['adr_street'] = 'ถนน';
$lang['adr_city'] = 'เมือง';
$lang['adr_state'] = 'รัฐ';
$lang['adr_work'] = 'ทำงาน';
$lang['adr_back'] = 'กลับ';
$lang['adr_save'] = 'บันทึก';
$lang['adr_phone'] = 'โทรศัพท์';
$lang['adr_cell'] = 'มือถือ';
$lang['adr_note'] = 'หมายเหตุ';

$lang['adr_name_hea'] = 'ชื่อ';
$lang['adr_email_hea'] = 'อีเมล';
$lang['adr_edit_hea'] = 'แก้ไข';
$lang['adr_expo_hea'] = 'ส่งออก';
$lang['adr_dele_hea'] = 'ลบ';
$lang['adr_new_entry'] = 'รายชื่อใหม่';

$lang['addr_saved'] = 'ติดต่อได้รับการบันทึก';
$lang['addr_added'] = 'ติดต่อได้รับการเพิ่ม';
$lang['addr_deleted'] = 'ติดต่อได้ถูกลบไปแล้ว';

$lang['blk_title'] = 'บล็อกผู้ส่ง';
$lang['blk_information'] = 'เท่านั้นที่แสดงให้เห็นถึงอีเมลที่ไม่ได้อยู่ในตัวกรองที่ยัง';
$lang['blk_email'] = 'อีเมล';
$lang['blk_no_address'] = 'ไม่มีที่อยู่ที่มีอยู่';
$lang['blk_close'] = 'ปิด';
$lang['blk_save'] = 'บันทึก';

$lang['evt_title'] = 'ปฏิทินกิจกรรม';
$lang['evt_save'] = 'บันทึก';
$lang['evt_delete'] = 'ลบ';
$lang['evt_stop'] = 'หยุดเวลา';
$lang['evt_start'] = 'เวลาเริ่มต้น';
