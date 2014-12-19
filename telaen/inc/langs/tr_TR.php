<?php
/*
 * Turkish (Türkçe) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d-%m-%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-9';

// User-friendly names to system folders
$lang['inbox_extended'] = 'Gelen Kutusu';
$lang['sent_extended'] = 'Gönderilmiş Öğeler';
$lang['trash_extended'] = 'Çöp Kutusu';
$lang['spam_extended'] = 'Spam folder';
$lang['drafts_extended'] = 'Taslaklar';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Önceki';
$lang['next_text'] = 'Sonraki';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = 'Sunucuya bağlanamadı.';
$lang['error_retrieving'] = 'Mesajlarınızı alırken bir hata oluştu. Gelen Kutusunun yeri değişmiş.';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = 'Sistem hatası! Sistem yöneticisiyle irtibata geçin.';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Geçersiz klasör adı - Lütfen sadece A-Z, 0-9, .- ve boşluk karakterini kullanın.';

// Validations when sending mails
$lang['error_no_recipients'] = 'Lütfen geçerli bir e-posta adresleri girin';
$lang['error_compose_invalid_mail1_s'] = 'E-posta adresi geçersiz gözüküyor';
$lang['error_compose_invalid_mail1_p'] = 'Belirtilen e-posta adresleri geçersiz gözüküyor';
$lang['error_compose_invalid_mail2_s'] = 'Gönderilmeden önce kontrol edilecek';
$lang['error_compose_invalid_mail2_p'] = 'Gönderilmeden önce kontrol edilecekler';

// Confirmation of delete
$lang['confirm_delete'] = 'Bu mesajı silmek istediğinize emin misiniz?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[konusuz]';
$lang['no_sender_text'] = '[gönderen bilinmiyor]';
$lang['no_recipient_text'] = '[alıcı bilinmiyor]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Bu işlemi tamamlayabilmeniz için gerekli yer mevcut değil\Lütfen bazı devam etmek için bazı mesajlarınızı silin';
$lang['quota_usage_info'] = 'Limit';
$lang['quota_usage_used'] = 'quota_usage_of					= /';
$lang['quota_usage_of'] = 'of';
$lang['quota_usage_avail'] = 'kullanımda.';

// Menu
$lang['messages_mnu'] = 'Gelen Kutusu';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Yaz';
$lang['refresh_mnu'] = 'Yenile';
$lang['folders_mnu'] = 'Klasörler';
$lang['search_mnu'] = 'Arama';
$lang['address_mnu'] = 'Adres defteri';
$lang['empty_trash_mnu'] = 'Çöpü boşalt';
$lang['prefs_mnu'] = 'Ayarlar';
$lang['logoff_mnu'] = 'Çıkış';

// Reply
$lang['reply_prefix'] = 'Rv:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '---------  Orjinal mesaj --------';
$lang['reply_from_hea'] = 'Kimden:';
$lang['reply_to_hea'] = 'Kime:';
$lang['reply_cc_hea'] = 'CC:';
$lang['reply_date_hea'] = 'Tarih:';
$lang['reply_subject_hea'] = 'Konu:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Anahtar';
$lang['value_hea'] = 'Değer';

// [Folders]
$lang['fld_name_hea'] = 'Klasörler';
$lang['fld_messages_hea'] = 'Mesajlar';
$lang['fld_size_hea'] = 'Boyut';
$lang['fld_empty_hea'] = 'Boşalt';
$lang['fld_delete_hea'] = 'Sil';
$lang['fld_total'] = 'Toplam:';
$lang['fld_make_new'] = 'Yeni klasör';
$lang['folders_to'] = 'Klasörler:';

// [MessageList]
$lang['messages_to'] = 'no_messages				= Yeni mesajınız yok. Klasör:  ';
$lang['no_messages'] = 'No new messages in your '; // FIXME: need translation
$lang['delete_selected_mnu'] = 'İşaretlileri sil';
$lang['move_selected_mnu'] = 'İşaretlileri taşı: ';
$lang['mark_selected_mnu'] = 'Mark as read'; // FIXME: need translation
$lang['unmark_selected_mnu'] = 'Mark as unread'; // FIXME: need translation
$lang['move_selected_to_trash_mnu'] = 'Move selected to Trash'; // FIXME: need translation


$lang['delete_mnu'] = 'Sil';
$lang['move_mnu'] = 'Taşı:';
$lang['subject_hea'] = 'Konu:';
$lang['from_hea'] = 'Kimden:';
$lang['to_hea'] = 'Kime:';
$lang['date_hea'] = 'Tarih:';
$lang['size_hea'] = 'Boyut';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

$lang['msg_you_have'] = 'msg_message					= mesajınız var';
$lang['msg_message'] = 'message';
$lang['msg_messages'] = 'mesajınız var';

$lang['msg_more_unread'] = 'tanesi okunmamış.';
$lang['msg_one_unread'] = 'tanesi okunmamış.';
$lang['msg_none_unread'] = 'Hepsi okunmuş.';
$lang['msg_in_the_folder'] = 'Klasör: ';


// [Login]
$lang['lgn_title'] = 'Giriş';
$lang['lgn_welcome_msg'] = 'Hoş geldiniz, lütfen hesabınıza giriş yapın';
$lang['lng_user_email'] = 'E-posta';
$lang['lng_user_name'] = 'Kullanıcı adı';
$lang['lng_user_pwd'] = 'Şifre';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Giriş &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled'; // FIXME: need translation
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail'; // FIXME: need translation

$lang['to_hea'] = 'Kime:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Konu:';
$lang['address_tip'] = 'Adres defterinden';

$lang['attach_hea'] = 'Ekler:';
$lang['attch_add_new'] = 'Dosya ekle';
$lang['attch_name_hea'] = 'Ad';
$lang['attch_size'] = 'Boyut';
$lang['attch_type_hea'] = 'Tür';
$lang['attch_dele_hea'] = 'Sil';
$lang['attch_no_hea'] = 'Hiç dosya eklenmemiş!';

$lang['add_signature'] = 'İmza ekle';
$lang['send_text'] = 'Gönder';

$lang['result_error'] = 'Hata, e-postanız gönderilemedi';
$lang['result_success'] = 'E-posta başarıyla gönderildi';
$lang['nav_continue'] = 'Devam';
$lang['nav_back'] = 'Geri';

$lang['up_title'] = 'Dosya ekle';
$lang['up_information_text'] = 'Dosya seç';
$lang['up_button_text'] = 'Gönder';

$lang['require_receipt'] = 'Return receipt'; // FIXME: need translation

$lang['priority_text'] = 'Periyot';
$lang['priority_low'] = 'Düşük';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'Yüksek';

// [Preferences]
$lang['prf_title'] = 'Ayarlar';
$lang['prf_general_title'] = 'Genel bilgiler';
$lang['prf_name'] = 'Ad Soyad';
$lang['prf_reply_to'] = 'Cevapla adresi';
$lang['prf_time_zone'] = 'Zaman kuşağı';
$lang['prf_trash_title'] = 'Çöp';
$lang['prf_save_to_trash'] = 'Bir mesaj <b>silince</b> taşınacağı klasör:';
$lang['prf_save_only_read'] = 'Sadece <b>okunmuş mesajların</b> kayıt edileceği klasör:';
$lang['prf_empty_on_exit'] = 'Çıkış yaptığım zaman çöp kutusunuz <b>temizle</b>';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = 'Gönderilmiş öğeler';
$lang['prf_save_sent'] = '<b>Gönderilmiş mesajların</b> kayıt edileceği klasör: ';
$lang['prf_messages_title'] = 'Mesajlar';
$lang['prf_page_limit'] = 'Bir sayfada gösterilcek mesaj sayısı';
$lang['prf_signature_title'] = 'İmza';
$lang['prf_signature'] = 'İmzanız';
$lang['prf_auto_add_sign'] = 'Tüm giden mesajlara imzamı ekle';
$lang['prf_save_button'] = 'Kaydet';
$lang['prf_display_images'] = 'Ekli resimleri göster';
$lang['prf_default_editor_mode'] = 'Normal edition mode'; // FIXME: need translation
$lang['prf_default_editor_mode_text'] = '"Düz Metin"';
$lang['prf_default_editor_mode_html'] = '"Gelişmiş HTML editörü"';
$lang['prf_time_to_refesh'] = 'Mesajların yenilenme zamanı (dakika)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // FIXME: need translation
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation
$lang['prf_keep_on_server'] = 'Sunucusu e-posta tutun - hibir yerel klasšrler';

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
$lang['filter_type'] = 'Action'; // FIXME: need tra // FIXME: need translationnslation
$lang['filter_folder'] = 'Destination folder';

$lang['filter_msg_nofilters'] = 'No filters available.'; // FIXME: need translation
$lang['filter_msg_added'] = 'Filter added'; // FIXME: need translation
$lang['filter_msg_deleted'] = 'Filter deleted'; // FIXME: need translation


// [Catch]
$lang['ctc_title'] = 'Adresleri yakala';
$lang['ctc_information'] = 'Sadece adres defterinizde kayıtlı olmayan adresler yakalanacak.';
$lang['ctc_name'] = 'Ad Soyad';
$lang['ctc_email'] = 'E-posta';
$lang['ctc_no_address'] = 'Hiçbir adres geçerli değil';
$lang['ctc_close'] = 'Kapat';
$lang['ctc_save'] = 'Kaydet';

// [Readmsg]
$lang['next_mnu'] = 'Sonraki';
$lang['previous_mnu'] = 'Önceki';
$lang['back_mnu'] = 'Geri';
$lang['reply_mnu'] = 'Cevapla';
$lang['reply_all_mnu'] = 'Hepsini cevapla';
$lang['forward_mnu'] = 'Yönlendir';
$lang['headers_mnu'] = 'Başlıklar';
$lang['move_mnu'] = 'Taşı:';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation
$lang['delete_mnu'] = 'Sil';
$lang['print_mnu'] = 'Yazdır';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'Kimden:';
$lang['to_hea'] = 'Kime:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Tarih:';
$lang['subject_hea'] = 'Konu:';
$lang['attach_hea'] = 'Ekler:';

$lang['attch_name_hea'] = 'Ad';
$lang['attch_force_hea'] = 'İndir';
$lang['attch_type_hea'] = 'Tür';
$lang['attch_size_hea'] = 'Boyut';
$lang['catch_address'] = 'Adres defterine ekle';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Lütfen bir sözcük veya sözcük grubu girin! <br> Sadece lokal klasörlerdeki mesajlar ve okunmuş mesajlar taranacak.';
$lang['sch_button_text'] = 'Ara &gt;&gt;';
$lang['sch_subject_hea'] = 'Konu';
$lang['sch_from_hea'] = 'Kimden';
$lang['sch_date_hea'] = 'Tarih';
$lang['sch_body_hea'] = 'Mesaj';
$lang['sch_folder_hea'] = 'Klasör';
$lang['sch_no_results'] = 'Hiçbir şey bulunamadı';

// [QuickAddress]
$lang['qad_title'] = 'Adres defteri';
$lang['qad_select_address'] = 'Bağlantı seçin';
$lang['qad_to'] = 'Kime';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adres defteri';
$lang['adr_name'] = 'Ad Soyad';
$lang['adr_email'] = 'E-posta';
$lang['adr_street'] = 'Sokak';
$lang['adr_city'] = 'Şehir';
$lang['adr_state'] = 'Eyalet';
$lang['adr_work'] = 'İş';
$lang['adr_back'] = 'Geri';
$lang['adr_save'] = 'Kaydet';
$lang['adr_phone'] = 'Phone'; // FIXME: need translation
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'Ad Soyad';
$lang['adr_email_hea'] = 'E-posta';
$lang['adr_edit_hea'] = 'Düzenle';
$lang['adr_expo_hea'] = 'Export'; // FIXME: need translation
$lang['adr_dele_hea'] = 'Sil';
$lang['adr_new_entry'] = 'Yeni Giriş';

$lang['addr_saved'] = 'Bağlantı kayıt edildi';
$lang['addr_added'] = 'Bağlantı eklendi';
$lang['addr_deleted'] = 'Bu bağlantı ortadan kaldırıldı';


// [BlockSender]
$lang['blk_title'] = 'Block sender';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Kapat';
$lang['blk_save'] = 'Kaydet';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'Kaydet';
$lang['evt_delete'] = 'Sil';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

