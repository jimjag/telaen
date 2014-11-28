<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = '받은편지함';
$lang['sent_extended'] = '보낸편지함';
$lang['trash_extended'] = '휴지통';
$lang['spam_extended'] = '스팸편지함';

// Navigation texts
$lang['pages_text'] = '페이지';
$lang['first_text'] = '처음';
$lang['previous_text'] = '이전';
$lang['next_text'] = '다음';
$lang['last_text'] = '마지막';
$lang['total_text'] = '전체';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = '서버에 연결할수 없습니다';
$lang['error_retrieving'] = '받은편지를 가져올수 없습니다.';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = '시스템장애입니다. 관리자에게 문의하세요';

// Invalid name of mailbox
$lang['error_invalid_name'] = '폴더이름엔 영문,숫자 그리고 - (빼기) 만 사용하실 수 있습니다.';

// Validations when sending mails
$lang['error_no_recipients'] = '오류: 받는사람의 주소를 최소 1개이상 입력해 주세요!';
$lang['error_compose_invalid_mail1_s'] = '오류: 이메일 주소가 비정상입니다';
$lang['error_compose_invalid_mail1_p'] = '오류: 이메일 주소들이 비정상입니다';
$lang['error_compose_invalid_mail2_s'] = '본 이메일을 다시 보내기전에 받는이의 주소를 확인해주세요.';
$lang['error_compose_invalid_mail2_p'] = '본 이메일을 다시 보내기전에 본인의 주소를 확인해주세요.';

// Confirmation of delete
$lang['confirm_delete'] = '정말 선택된 이메일(들)을 삭제 하시겠습니까?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[제목없음]';
$lang['no_sender_text'] = '[보낸이 알수없음]';
$lang['no_recipient_text'] = '[받는이 알수없음]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = '저장공간이 충분하지 않습니다. 오래된 이메일 또는 보낸이메일을 삭제 해주세요.';
$lang['quota_usage_info'] = '용량정보';
$lang['quota_usage_used'] = '사용중 = ';
$lang['quota_usage_of'] = ',전체';
$lang['quota_usage_avail'] = '사용가능';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%Y-%m-%d %H:%M';

// CharSet
$lang['default_char_set'] = 'euc-kr';

// Menu
$lang['messages_mnu'] = '받은편지함';
$lang['read_menu'] = '편지읽기';
$lang['compose_mnu'] = '편지쓰기';
$lang['refresh_mnu'] = '새로고침';
$lang['folders_mnu'] = '폴더들';
$lang['search_mnu'] = '검색';
$lang['address_mnu'] = '주소록';
$lang['empty_trash_mnu'] = '휴지통비우기';
$lang['prefs_mnu'] = '환경설정';
$lang['logoff_mnu'] = '로그아웃';

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
$lang['fld_name_hea'] = '폴더';
$lang['fld_messages_hea'] = '이메일';
$lang['fld_size_hea'] = '크기';
$lang['fld_empty_hea'] = '비우기';
$lang['fld_delete_hea'] = '삭제';
$lang['fld_total'] = '전체:';
$lang['fld_make_new'] = '새폴더 만들기';
$lang['folders_to'] = '폴더로 이동';

// [MessageList]
$lang['messages_to'] = '이메일 이동 ';
$lang['no_messages'] = '새로운 이메일이 없습니다 -> ';
$lang['delete_selected_mnu'] = '삭제 ';
$lang['move_selected_mnu'] = '이동';
$lang['mark_selected_mnu'] = '읽음 표시';
$lang['unmark_selected_mnu'] = '안읽음 표시';
$lang['move_selected_to_trash_mnu'] = '휴지통으로';


$lang['delete_mnu'] = '삭제';
$lang['move_mnu'] = '이동';
$lang['subject_hea'] = '제목:';
$lang['from_hea'] = '보낸이:';
$lang['to_hea'] = '받는이:';
$lang['date_hea'] = '날짜:';
$lang['size_hea'] = '크기';
$lang['have_spam'] = '스팸메일을 받았습니다. (스팸폴더를 확인하세요)';

$lang['msg_you_have'] = '받은편지 = ';
$lang['msg_message'] = '통';
$lang['msg_messages'] = '통';

$lang['msg_more_unread'] = '안읽음';
$lang['msg_one_unread'] = '안읽음';
$lang['msg_none_unread'] = '읽지않은';
$lang['msg_in_the_folder'] = '폴더에 있음';


// [Login]
$lang['lgn_title'] = '로그인';
$lang['lgn_welcome_msg'] = '안녕하세요! 아래에 정확한 정보를 입력후 로그인 하세요';
$lang['lng_user_email'] = '이메일 주소';
$lang['lng_user_name'] = '아이디';
$lang['lng_user_pwd'] = '비밀번호';
$lang['lng_server'] = '서버';
$lang['lng_theme'] = '테마';
$lang['lng_language'] = '언어';
$lang['lng_login_btn'] = '로그인 &gt;&gt;';
$lang['lng_cookie_not_enabled'] = '쿠키사용이 허용되어야 합니다. (브라우져 설정)';
$lang['lng_cookie_not_valid'] = '쿠키 보안검사 실패!';

// [Newmessage]

$lang['newmsg_title'] = '이메일 쓰기';

$lang['to_hea'] = '받는이:';
$lang['cc_hea'] = '참조:';
$lang['bcc_hea'] = '숨은참조:';
$lang['subject_hea'] = '제목:';
$lang['address_tip'] = '주소록찾기';

$lang['attach_hea'] = '첨부화일:';
$lang['attch_add_new'] = '화일 첨부하기';
$lang['attch_name_hea'] = '이름';
$lang['attch_size'] = '크기';
$lang['attch_type_hea'] = '종류';
$lang['attch_dele_hea'] = '삭제';
$lang['attch_no_hea'] = '첨부화일 없음';

$lang['add_signature'] = '서명 추가하기';
$lang['send_text'] = '보내기';

$lang['result_error'] = '이메일 발송 실패!';
$lang['result_success'] = '이메일이 성공적으로 발송되었습니다.';
$lang['nav_continue'] = '&lt;&lt; 계속 &gt;&gt;';
$lang['nav_back'] = '뒤로';

$lang['up_title'] = '화일추가';
$lang['up_information_text'] = '화일 선택';
$lang['up_button_text'] = '화일 첨부';

$lang['require_receipt'] = '수신 확인메일 받기';

$lang['priority_text'] = '중요도';
$lang['priority_low'] = '낮음';
$lang['priority_normal'] = '보통';
$lang['priority_high'] = '높음';

// [Preferences]
$lang['prf_title'] = '환경 설정';
$lang['prf_general_title'] = '기본 정보';
$lang['prf_name'] = '이름';
$lang['prf_reply_to'] = '회신받을 주소';
$lang['prf_time_zone'] = '지역 시간 설정';
$lang['prf_trash_title'] = '휴지통';
$lang['prf_save_to_trash'] = '편지를 <b>삭제</b> 시 다음 폴더로 이동합니다. ';
$lang['prf_save_only_read'] = '이미 <b>읽은 편지</b>만 다음 폴더로 이동합니다.';
$lang['prf_empty_on_exit'] = '로그아웃시 자동으로 <b>휴지통</b> 비우기';
$lang['prf_empty_spam_on_exit'] = '로그아웃시 자동으로 <b>스팸폴더</b> 비우기';
$lang['prf_unmark_read_on_exit'] = '로그아웃시 자동으로 <b>읽은편지</b>를 안읽음으로 설정하기';
$lang['prf_sent_title'] = '보낸 편지';
$lang['prf_save_sent'] = '<b>보낸편지를</b> 다음 폴더에 저장합니다. ';
$lang['prf_messages_title'] = '이메일관련';
$lang['prf_page_limit'] = '한페이지에 보여질 이메일 갯수';
$lang['prf_signature_title'] = '서명';
$lang['prf_signature'] = '서명쓰기';
$lang['prf_auto_add_sign'] = '보내는 모든 편지에 자동으로 서명 추가하기 ';
$lang['prf_save_button'] = '저장하기';
$lang['prf_display_images'] = '첨부된 이미지를 자동으로 이메일 본문에 보여줍니다';
$lang['prf_default_editor_mode'] = '기본 쓰기설정';
$lang['prf_default_editor_mode_text'] = '"텍스트만 사용"';
$lang['prf_default_editor_mode_html'] = '"고급에디터 사용"';
$lang['prf_time_to_refesh'] = '자동으로 새로온 이메일 확인하기 (~분간격)';
$lang['prf_spam_level'] = '스팸 차단 정도 (0 = 차단안함, 1 = 매우높음, 9 = 매우낮음)';
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
$lang['ctc_title'] = '주소록에 추가';
$lang['ctc_information'] = '주소록에 없는 주소로부터 발송된 이메일만 보기';
$lang['ctc_name'] = '이름';
$lang['ctc_email'] = '이메일';
$lang['ctc_no_address'] = '이메일 주소 없음';
$lang['ctc_close'] = '닫기';
$lang['ctc_save'] = '저장';

// [Readmsg]
$lang['next_mnu'] = '다음';
$lang['previous_mnu'] = '이전';
$lang['back_mnu'] = '뒤로';
$lang['reply_mnu'] = '답장';
$lang['reply_all_mnu'] = '모두에게 답장';
$lang['forward_mnu'] = '전달';
$lang['headers_mnu'] = '헤더정보';
$lang['move_mnu'] = '이동';
$lang['move_to_trash_mnu'] = '휴지통으로';
$lang['delete_mnu'] = '삭제';
$lang['print_mnu'] = '인쇄';
$lang['download_mnu'] = 'Download'; // FIXME: need translation

$lang['from_hea'] = '보낸이:';
$lang['to_hea'] = '받는이:';
$lang['cc_hea'] = '참조:';
$lang['date_hea'] = '날짜:';
$lang['subject_hea'] = '제목:';
$lang['attach_hea'] = '첨부화일:';

$lang['attch_name_hea'] = '이름';
$lang['attch_force_hea'] = '다운로드';
$lang['attch_type_hea'] = '종류';
$lang['attch_size_hea'] = '크기';
$lang['catch_address'] = '주소록에 추가';
$lang['block_address'] = '주소 차단';

// [Search]
$lang['sch_title'] = '검색';
$lang['sch_information_text'] = '찾으실 단어나 문장을 입력하세요<br> 이미 읽은 편지들만을 대상으로 검색합니다.';
$lang['sch_button_text'] = '검색 &gt;&gt;';
$lang['sch_subject_hea'] = '제목';
$lang['sch_from_hea'] = '보낸이';
$lang['sch_date_hea'] = '날짜';
$lang['sch_body_hea'] = '편지내용';
$lang['sch_folder_hea'] = '폴더';
$lang['sch_no_results'] = '찾으시는 내용에 대한 검색결과가 없습니다.';

// [QuickAddress]
$lang['qad_title'] = '주소록';
$lang['qad_select_address'] = '주소 선택';
$lang['qad_to'] = '받는이';
$lang['qad_cc'] = '참조';
$lang['qad_bcc'] = '숨은참조';

// [AddressBook]
// edit/display
$lang['adr_title'] = '주소록';
$lang['adr_name'] = '이름';
$lang['adr_email'] = '이메일';
$lang['adr_street'] = '주소';
$lang['adr_city'] = '전화번호1';
$lang['adr_state'] = '전화번호2';
$lang['adr_work'] = '기타사항';
$lang['adr_back'] = '뒤로';
$lang['adr_save'] = '저장';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = '이름';
$lang['adr_email_hea'] = '이메일';
$lang['adr_edit_hea'] = '수정';
$lang['adr_expo_hea'] = '내보내기';
$lang['adr_dele_hea'] = '삭제';
$lang['adr_new_entry'] = '새 주소';

$lang['addr_saved'] = '성공적으로 저장 되었습니다.';
$lang['addr_added'] = '성공적으로 추가 되었습니다.';
$lang['addr_deleted'] = '성공적으로 삭제 되었습니다.';


// [BlockSender]
$lang['blk_title'] = '보낸이 차단';
$lang['blk_information'] = '필터되지 않은 이메일만 보기';
$lang['blk_email'] = '이메일';
$lang['blk_no_address'] = '주소 없음';
$lang['blk_close'] = '닫기';
$lang['blk_save'] = '저장';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = '저장';
$lang['evt_delete'] = '삭제';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

