<?php
/*
 * Vietnamese (Tiếng Việt) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// User-friendly names to system folders
$lang['inbox_extended'] = 'Hộp thư đến';
$lang['sent_extended'] = 'Bị đuổi mục';
$lang['trash_extended'] = 'thư mục Trash';
$lang['spam_extended'] = 'thư mục Spam';
$lang['drafts_extended'] = 'nháp';

// Navigation texts
$lang['pages_text'] = 'trang';
$lang['first_text'] = 'đầu tiên';
$lang['previous_text'] = 'trước';
$lang['next_text'] = 'Next'; // FIXME: need translation
$lang['last_text'] = 'Last'; // FIXME: need translation
$lang['total_text'] = 'Tổng';

// Mail Server Errors
$lang['err_login_msg'] = 'Đăng nhập lỗi';
$lang['err_system_msg'] = 'lỗi hệ thống';
$lang['error_login'] = 'Vui lòng kiểm tra tên đăng nhập hoặc mật khẩu của bạn và thử lại';
$lang['error_connect'] = 'Lỗi kết nối tới máy chủ';
$lang['error_retrieving'] = 'Lỗi nhận được tin nhắn của bạn, Hộp thư đến của bạn đã thay đổi';
$lang['error_session_expired'] = 'Phiên của bạn đã hết hạn, xin vui lòng đăng nhập lại';
$lang['error_other'] = 'hệ thống thất bại, xin vui lòng liên hệ với quản trị mạng của bạn';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'tên thư mục không hợp lệ - Chỉ sử dụng các ký tự sau AZ, az, 0-9, và -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Lỗi: Bạn phải có ít nhất một người nhận';
$lang['error_compose_invalid_mail1_s'] = 'Lỗi: địa chỉ e-mail này có vẻ là không hợp lệ';
$lang['error_compose_invalid_mail1_p'] = 'Lỗi: e-mail này địa chỉ dường như là không hợp lệ';
$lang['error_compose_invalid_mail2_s'] = 'Kiểm tra địa chỉ e-mail trước khi gửi lại email này.';
$lang['error_compose_invalid_mail2_p'] = 'Kiểm tra địa chỉ của bạn trước khi gửi lại email này.';

// Confirmation of delete
$lang['confirm_delete'] = '? Bạn có thực sự muốn xóa tin nhắn này (s)';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Không có chủ đề]';
$lang['no_sender_text'] = '[Tên người gửi không rõ]';
$lang['no_recipient_text'] = '[nhận biết]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Không đủ không gian trong hộp thư của bạn để hoàn tất hành động này \ nHãy xóa một số tin nhắn để tiếp tục';
$lang['quota_usage_info'] = 'hạn ngạch giới hạn"';
$lang['quota_usage_used'] = 'sử dụng';
$lang['quota_usage_of'] = 'của';
$lang['quota_usage_avail'] = 'có sẵn';

// Menu
$lang['messages_mnu'] = 'Hộp thư đến';
$lang['read_menu'] = 'đọc E-Mail (s)';
$lang['compose_mnu'] = 'Viết E-Mail';
$lang['refresh_mnu'] = 'Refresh'; // FIXME: need translation
$lang['folders_mnu'] = 'thư mục';
$lang['search_mnu'] = 'Tìm kiếm';
$lang['address_mnu'] = 'Địa chỉ cuốn sách';
$lang['empty_trash_mnu'] = 'Dọn sạch thùng rác';
$lang['prefs_mnu'] = 'Preferences'; // FIXME: need translation
$lang['logoff_mnu'] = 'Đăng xuất';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- tin nhắn gốc --------';
$lang['reply_from_hea'] = 'Từ:';
$lang['reply_to_hea'] = 'Để:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'ngày:';
$lang['reply_subject_hea'] = 'Chủ đề:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'khóa';
$lang['value_hea'] = 'Giá trị';

// [Folders]
$lang['fld_name_hea'] = 'Folder'; // FIXME: need translation
$lang['fld_messages_hea'] = 'Tin nhắn';
$lang['fld_size_hea'] = 'Size';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Xóa';
$lang['fld_total'] = 'Tổng số:';
$lang['fld_make_new'] = 'Tạo thư mục mới';
$lang['folders_to'] = 'Folders để';

// [MessageList]
$lang['messages_to'] = 'Tin nhắn để';
$lang['no_messages'] = 'Không có tin nhắn mới trong của bạn';
$lang['delete_selected_mnu'] = 'Delete'; // FIXME: need translation
$lang['move_selected_mnu'] = 'Move to'; // FIXME: need translation
$lang['mark_selected_mnu'] = 'Đánh dấu là đã đọc';
$lang['unmark_selected_mnu'] = 'Đánh dấu là chưa đọc';
$lang['move_selected_to_trash_mnu'] = 'Di chuyển vào Thùng rác';


$lang['delete_mnu'] = 'Delete'; // FIXME: need translation
$lang['move_mnu'] = 'Move to'; // FIXME: need translation
$lang['subject_hea'] = 'Chủ đề:';
$lang['from_hea'] = 'Từ:';
$lang['to_hea'] = 'Để:';
$lang['date_hea'] = 'ngày:';
$lang['size_hea'] = 'Size'; // FIXME: need translation
$lang['have_spam'] = 'Bạn có Spam (kiểm tra thư mục Spam)';

$lang['msg_you_have'] = 'Bạn có';
$lang['msg_message'] = 'thông báo';
$lang['msg_messages'] = 'thông điệp';

$lang['msg_more_unread'] = 'chưa đọc';
$lang['msg_one_unread'] = 'chưa đọc';
$lang['msg_none_unread'] = 'không đọc';
$lang['msg_in_the_folder'] = 'trong thư mục';


// [Login]
$lang['lgn_title'] = 'Đăng nhập';
$lang['lgn_welcome_msg'] = 'Chào mừng bạn, vui lòng đăng nhập vào tài khoản của bạn';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Tên người dùng';
$lang['lng_user_pwd'] = 'Mật khẩu';
$lang['lng_server'] = 'Server'; // FIXME: need translation
$lang['lng_theme'] = 'Theme'; // FIXME: need translation
$lang['lng_language'] = 'Ngôn ngữ';
$lang['lng_login_btn'] = 'Đăng nhập&gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies phải được cho phép';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Không';

// [Newmessage]

$lang['newmsg_title'] = 'Soạn thư';

$lang['to_hea'] = 'Để:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Chủ đề:';
$lang['address_tip'] = 'Từ sổ địa chỉ';

$lang['attach_hea'] = 'File đính kèm:';
$lang['attch_add_new'] = 'Đính kèm tập tin mới"';
$lang['attch_name_hea'] = 'Tên';
$lang['attch_size'] = 'Size'; // FIXME: need translation
$lang['attch_type_hea'] = 'Type'; // FIXME: need translation
$lang['attch_dele_hea'] = 'Xóa';
$lang['attch_no_hea'] = 'Không có file đính kèm';

$lang['add_signature'] = 'Thêm chữ ký';
$lang['send_text'] = 'Gửi';

$lang['result_error'] = 'Không thể để gửi e-mail này';
$lang['result_success'] = 'e-mail này đã được gửi';
$lang['nav_continue'] = '&lt;&lt; Tiếp tục &gt;&gt;';
$lang['nav_back'] = 'Quay lại';

$lang['up_title'] = 'Thêm tập tin';
$lang['up_information_text'] = 'Select file'; // FIXME: need translation
$lang['up_button_text'] = 'Đính kèm tập tin';

$lang['require_receipt'] = 'nhận trở lại';

$lang['priority_text'] = 'ưu tiên';
$lang['priority_low'] = 'thấp';
$lang['priority_normal'] = 'Normal'; // FIXME: need translation
$lang['priority_high'] = 'cao';

// [Preferences]
$lang['prf_title'] = 'Preferences'; // FIXME: need translation
$lang['prf_general_title'] = 'Thông tin chung';
$lang['prf_name'] = 'Tên';
$lang['prf_reply_to'] = 'Trả lời';
$lang['prf_time_zone'] = 'Múi giờ';
$lang['prf_trash_title'] = 'rác';
$lang['prf_save_to_trash'] = 'Khi bạn <b> xóa </b> một tin nhắn, di chuyển nó đến';
$lang['prf_save_only_read'] = 'Lưu chỉ <b> đọc tin nhắn </ b> trong';
$lang['prf_empty_on_exit'] = '<b> Không </ b> thư mục thùng rác khi bạn đăng xuất';
$lang['prf_empty_spam_on_exit'] = '<b> Không </b> thư mục Spam khi bạn đăng xuất';
$lang['prf_unmark_read_on_exit'] = 'Reset ĐỌC tin nhắn như chưa đọc khi bạn đăng xuất';
$lang['prf_sent_title'] = 'Các tin đã gửi';
$lang['prf_save_sent'] = 'Lưu <b> gửi tin nhắn </ b> trong';
$lang['prf_messages_title'] = 'Tin nhắn';
$lang['prf_page_limit'] = 'Số lượng tối đa của tin nhắn mỗi trang';
$lang['prf_signature_title'] = 'chữ ký';
$lang['prf_signature'] = 'Viết chữ ký của bạn';
$lang['prf_auto_add_sign'] = 'Thêm chữ ký của bạn để tất cả các tin nhắn gửi đi';
$lang['prf_save_button'] = 'Save Preferences';
$lang['prf_display_images'] = 'Hiển thị kèm theo hình ảnh';
$lang['prf_default_editor_mode'] = 'Mặc định chế độ chỉnh sửa';
$lang['prf_default_editor_mode_text'] = '"Plain text"';
$lang['prf_default_editor_mode_html'] = '"biên tập viên nâng cao HTML"';
$lang['prf_time_to_refesh'] = 'Tự động kiểm tra thư mới (phút)';
$lang['prf_spam_level'] = 'Spam nhạy cảm (0 = Không cho phép, 1 = rất cao, 9 = Rất thấp)';
$lang['prf_auto_require_receipt'] = 'Yêu cầu đọc nhận theo mặc định';
$lang['prf_keep_on_server'] = 'Giữ email trên máy chủ - không có thư mục địa phương';

$lang['prf_msg_saved'] = 'Preferences lưu';

// filters
$lang['filter_title'] = 'Bộ lọc';

$lang['filter_new'] = 'Tạo một bộ lọc';
$lang['filter_desc'] = 'Chọn các tiêu chí tìm kiếm và hành động cho các tin nhắn đến';
$lang['filter_list'] = 'bộ lọc hiện tại';

$lang['filter_field_from'] = 'Từ';
$lang['filter_field_to'] = 'Để';
$lang['filter_field_subject'] = 'Chủ đề';
$lang['filter_field_header'] = 'header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Xóa';
$lang['filter_type_mark'] = 'Mark đọc';

$lang['filter_add'] = 'Thêm bộ lọc';
$lang['filter_delete'] = 'Xóa';
$lang['filter_delete_selected'] = 'Xóa bộ lọc lựa chọn';

$lang['filter_field'] = 'Bộ lọc trên sân';
$lang['filter_match'] = 'Tìm kiếm';
$lang['filter_type'] = 'hành động';
$lang['filter_folder'] = 'Destination folder';

$lang['filter_msg_nofilters'] = 'Không có bộ lọc có sẵn.';
$lang['filter_msg_added'] = 'Bộ lọc thêm';
$lang['filter_msg_deleted'] = 'Bộ lọc xóa';


// [Catch]
$lang['ctc_title'] = 'Thêm vào sổ địa chỉ';
$lang['ctc_information'] = 'Chỉ cho e-mail mà không có trong sổ địa chỉ';
$lang['ctc_name'] = 'Tên';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Không có địa chỉ có sẵn';
$lang['ctc_close'] = 'Đóng';
$lang['ctc_save'] = 'Lưu';

// [Readmsg]
$lang['next_mnu'] = 'Next';
$lang['previous_mnu'] = 'trước';
$lang['back_mnu'] = 'Quay lại';
$lang['reply_mnu'] = 'Trả lời';
$lang['reply_all_mnu'] = 'Trả lời tất cả"';
$lang['forward_mnu'] = 'Chuyển tiếp';
$lang['headers_mnu'] = 'header';
$lang['move_mnu'] = 'Move to';
$lang['move_to_trash_mnu'] = 'Di chuyển vào Thùng rác';
$lang['delete_mnu'] = 'Delete';
$lang['print_mnu'] = 'In';
$lang['download_mnu'] = 'Tải';

$lang['from_hea'] = 'Từ:';
$lang['to_hea'] = 'Để:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'ngày:';
$lang['subject_hea'] = 'Chủ đề:';
$lang['attach_hea'] = 'File đính kèm:';

$lang['attch_name_hea'] = 'Tên';
$lang['attch_force_hea'] = 'Tải';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Size';
$lang['catch_address'] = 'Thêm vào sổ địa chỉ';
$lang['block_address'] = 'Chặn địa chỉ';

// [Search]
$lang['sch_title'] = 'Tìm kiếm';
$lang['sch_information_text'] = '.. Viết một cụm từ hoặc một từ mà bạn đang tìm kiếm <br> Chỉ đọc các tin nhắn sẽ được tìm kiếm';
$lang['sch_button_text'] = 'Tìm kiếm &gt;&gt;';
$lang['sch_subject_hea'] = 'Chủ đề';
$lang['sch_from_hea'] = 'Từ';
$lang['sch_date_hea'] = 'Ngày';
$lang['sch_body_hea'] = 'Thông điệp';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Không có thông điệp phù hợp với tiêu chí của bạn đã được tìm thấy';

// [QuickAddress]
$lang['qad_title'] = 'Địa chỉ cuốn sách';
$lang['qad_select_address'] = 'Chọn một số liên lạc"';
$lang['qad_to'] = 'Để';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Địa chỉ cuốn sách';
$lang['adr_name'] = 'Tên';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'Thành phố';
$lang['adr_state'] = 'Nhà nước';
$lang['adr_work'] = 'làm việc';
$lang['adr_back'] = 'Quay lại';
$lang['adr_save'] = 'Lưu';
$lang['adr_phone'] = 'Điện thoại';
$lang['adr_cell'] = 'di động';
$lang['adr_note'] = 'Ghi chú';

// list
$lang['adr_name_hea'] = 'Tên';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Chỉnh sửa';
$lang['adr_expo_hea'] = 'xuất khẩu';
$lang['adr_dele_hea'] = 'Xóa';
$lang['adr_new_entry'] = 'Liên lạc mới';

$lang['addr_saved'] = 'liên hệ đã được lưu!';
$lang['addr_added'] = 'liên hệ đã được thêm vào';
$lang['addr_deleted'] = 'liên hệ đã bị xóa';


// [BlockSender]
$lang['blk_title'] = 'Chặn người gửi';
$lang['blk_information'] = 'Chỉ cho e-mail mà không phải là trong bộ lọc nào';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Không có địa chỉ có sẵn';
$lang['blk_close'] = 'Đóng';
$lang['blk_save'] = 'Lưu';

// [Event]
$lang['evt_title'] = 'Lịch sự kiện';
$lang['evt_save'] = 'Lưu';
$lang['evt_delete'] = 'Xóa';
$lang['evt_stop'] = 'Dừng lại thời gian"';
$lang['evt_start'] = 'thời gian bắt đầu';

