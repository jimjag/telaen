<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Входящие';
$lang['sent_extended'] = 'Отправленные';
$lang['trash_extended'] = 'Удалённые';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Назад';
$lang['next_text'] = 'Далее';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error';
$lang['err_system_msg'] = 'System error';
$lang['error_login'] = 'Please check your username or password and try again';
$lang['error_connect'] = 'Ошибка подключения к почтовому серверу';
$lang['error_retrieving'] = 'Ошибка получения письма - Папка входящие изменилась';
$lang['error_session_expired'] = 'Your session is expired, please login again';
$lang['error_other'] = 'Общий сбой системы';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Неправильное имя папки - Используйте только символы А-Б, A-Z, 0-9, .- или пробелы';

// Validations when sending mails
$lang['error_no_recipients'] = 'Необходимо для начала указать свой Email адрес';
$lang['error_compose_invalid_mail1_s'] = 'Этот Email адрес неверен';
$lang['error_compose_invalid_mail1_p'] = 'Эти Email адреса неверны';
$lang['error_compose_invalid_mail2_s'] = 'Выберите Создать сообщение перед отправкой';
$lang['error_compose_invalid_mail2_p'] = 'Выберите Создать сообщение перед отправкой';

// Confirmation of delete
$lang['confirm_delete'] = 'Вы действительно хотите удалить это сообщение?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Без темы]';
$lang['no_sender_text'] = '[Отправитель неизвестен]';
$lang['no_recipient_text'] = '[Получатель неизвестен]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Не хватает места в вашем ящике!\Пожалуйста, удалите часть сообщений, чтобы продолжить';
$lang['quota_usage_info'] = 'Место в ящике';
$lang['quota_usage_used'] = 'Использовано';
$lang['quota_usage_of'] = 'из';
$lang['quota_usage_avail'] = 'доступных';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'windows-1251';

// Menu
$lang['messages_mnu'] = 'Сообщения';
$lang['read_menu'] = 'Read E-Mail(s)'; // need translation
$lang['compose_mnu'] = 'Написать';
$lang['refresh_mnu'] = 'Обновить';
$lang['folders_mnu'] = 'Папки';
$lang['search_mnu'] = 'Поиск';
$lang['address_mnu'] = 'Адресная книга';
$lang['empty_trash_mnu'] = 'Очистить корзину';
$lang['prefs_mnu'] = 'Настройки';
$lang['logoff_mnu'] = 'Выход';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Оригинал письма --------';
$lang['reply_from_hea'] = 'От:';
$lang['reply_to_hea'] = 'Для:';
$lang['reply_cc_hea'] = 'опия:';
$lang['reply_date_hea'] = 'Дата:';
$lang['reply_subject_hea'] = 'Тема:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'люч';
$lang['value_hea'] = 'Значение';

// [Folders]
$lang['fld_name_hea'] = 'Папка';
$lang['fld_messages_hea'] = 'Сообщения';
$lang['fld_size_hea'] = 'Размер';
$lang['fld_empty_hea'] = 'Очистить';
$lang['fld_delete_hea'] = 'Удалить';
$lang['fld_total'] = 'Итого:';
$lang['fld_make_new'] = 'Создать папку';
$lang['folders_to'] = 'Папки';

// [MessageList]
$lang['messages_to'] = 'Сообщения ';
$lang['no_messages'] = 'Нет новых сообщений в папке ';
$lang['delete_selected_mnu'] = 'Удалить отмеченные';
$lang['move_selected_mnu'] = 'Переместить отмеченные в';
$lang['mark_selected_mnu'] = 'Mark as read';
$lang['unmark_selected_mnu'] = 'Mark as unread';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // need translation


$lang['delete_mnu'] = 'Удалить';
$lang['move_mnu'] = 'Переместить в';
$lang['subject_hea'] = 'Тема:';
$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'Для:';
$lang['date_hea'] = 'Дата:';
$lang['size_hea'] = 'Размер';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

$lang['msg_you_have'] = 'У вас';
$lang['msg_message'] = 'сообщение';
$lang['msg_messages'] = 'сообщений';

$lang['msg_more_unread'] = 'непрочитанных';
$lang['msg_one_unread'] = 'непрочитано';
$lang['msg_none_unread'] = 'непрочитанных нет';
$lang['msg_in_the_folder'] = 'в папке';


// [Login]
$lang['lgn_title'] = 'Логин';
$lang['lgn_welcome_msg'] = 'Введите ваши Логин и пароль для доступа к почте';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Логин';
$lang['lng_user_pwd'] = 'Пароль';
$lang['lng_server'] = 'Server'; // need translation
$lang['lng_theme'] = 'Тема';
$lang['lng_language'] = 'Язык';
$lang['lng_login_btn'] = 'Логин &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'Для:';
$lang['cc_hea'] = 'опия:';
$lang['bcc_hea'] = 'опия 2:';
$lang['subject_hea'] = 'Тема:';
$lang['address_tip'] = 'Из адресной книги';

$lang['attach_hea'] = 'Вложение:';
$lang['attch_add_new'] = 'Добавить новый файл';
$lang['attch_name_hea'] = 'Название';
$lang['attch_size'] = 'Размер';
$lang['attch_type_hea'] = 'Тип';
$lang['attch_dele_hea'] = 'Удалить';
$lang['attch_no_hea'] = 'Нет вложений';

$lang['add_signature'] = 'Добавить подпись';
$lang['send_text'] = 'Отправить';

$lang['result_error'] = 'Невозможно отправить почту';
$lang['result_success'] = 'Письмо успешно отправлено';
$lang['nav_continue'] = 'Продолжить';
$lang['nav_back'] = 'Назад';

$lang['up_title'] = 'Добавить файл';
$lang['up_information_text'] = 'Выбрать файл';
$lang['up_button_text'] = 'Отправить';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Приоритет';
$lang['priority_low'] = 'Низкий';
$lang['priority_normal'] = 'Средний';
$lang['priority_high'] = 'Высокий';

// [Preferences]
$lang['prf_title'] = 'Настройки';
$lang['prf_general_title'] = 'Основная информация';
$lang['prf_name'] = 'Имя';
$lang['prf_reply_to'] = 'Адрес для ответов';
$lang['prf_time_zone'] = 'Временная зона';
$lang['prf_trash_title'] = 'орзина';
$lang['prf_save_to_trash'] = 'огда Вы <b>удаляете</b> сообщения, помещать из в папке ';
$lang['prf_save_only_read'] = 'Хранить только <b>прочитанные сообщения</b> в папке  ';
$lang['prf_empty_on_exit'] = '<b>Очистить</b> корзину при выходе из программы';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = 'Отправленные';
$lang['prf_save_sent'] = 'Хранить <b>отправляемые сообщения</b> в папке  ';
$lang['prf_messages_title'] = 'Сообщения';
$lang['prf_page_limit'] = 'оличество сообщений на страницу';
$lang['prf_signature_title'] = 'Подпись';
$lang['prf_signature'] = 'Здесь Вы можете написать свою подпись для отправляемых сообщений';
$lang['prf_auto_add_sign'] = 'Добавлять Вашу подпись ко всем оправляемым сообщениям ';
$lang['prf_save_button'] = 'Сохранить';
$lang['prf_display_images'] = 'Показывать прикреплённые изображения';
$lang['prf_default_editor_mode'] = 'Режим редактирования';
$lang['prf_default_editor_mode_text'] = '"Простой текстовый"';
$lang['prf_default_editor_mode_html'] = '"HTML редактор (Internet Explorer 5 или выше, или схожих)"';
$lang['prf_time_to_refesh'] = 'Обновление папки с сообщениями (в минутах)';
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
$lang['ctc_title'] = 'Добавить в адресную книгу';
$lang['ctc_information'] = 'Будут показаны адреса, записанные в адресную книгу';
$lang['ctc_name'] = 'Имя';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Адреса нет';
$lang['ctc_close'] = 'Закрыть';
$lang['ctc_save'] = 'Сохранить';

// [Readmsg]
$lang['next_mnu'] = 'Следующее';
$lang['previous_mnu'] = 'Предыдущее';
$lang['back_mnu'] = 'Назад';
$lang['reply_mnu'] = 'Ответить';
$lang['reply_all_mnu'] = 'Ответить всем';
$lang['forward_mnu'] = 'Переслать';
$lang['headers_mnu'] = 'Заголовок';
$lang['move_mnu'] = 'Переместить в';
$lang['move_to_trash_mnu'] = 'Move to Trash'; // need translation
$lang['delete_mnu'] = 'Удалить';
$lang['print_mnu'] = 'Распечатать';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'Для:';
$lang['cc_hea'] = 'опия:';
$lang['date_hea'] = 'Дата:';
$lang['subject_hea'] = 'Тема:';
$lang['attach_hea'] = 'Вложение:';

$lang['attch_name_hea'] = 'Название';
$lang['attch_force_hea'] = 'Скачать';
$lang['attch_type_hea'] = 'Тип';
$lang['attch_size_hea'] = 'Размер';
$lang['catch_address'] = 'Добавить в адресную книгу';
$lang['block_address'] = 'Block address'; // need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Напишите фразу или слово, которое Вы ищете.<br> Поиск в теле письма производится только, если письмо прочитано';
$lang['sch_button_text'] = 'Поиск &gt;&gt;';
$lang['sch_subject_hea'] = 'Тема';
$lang['sch_from_hea'] = 'От';
$lang['sch_date_hea'] = 'Дата';
$lang['sch_body_hea'] = 'Сообщение';
$lang['sch_folder_hea'] = 'Папка';
$lang['sch_no_results'] = 'Подходящих писем не найдено';

// [QuickAddress]
$lang['qad_title'] = 'Адресная книга';
$lang['qad_select_address'] = 'Выберите контакт';
$lang['qad_to'] = 'Для';
$lang['qad_cc'] = 'опия';
$lang['qad_bcc'] = 'опия 2 ';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Адресная книга';
$lang['adr_name'] = 'Имя';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Адрес';
$lang['adr_city'] = 'Город';
$lang['adr_state'] = 'Район';
$lang['adr_work'] = 'Работа';
$lang['adr_back'] = 'Назад';
$lang['adr_save'] = 'Сохранить';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Имя';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Редактировать';
$lang['adr_expo_hea'] = 'Экспортировать';
$lang['adr_dele_hea'] = 'Удалить';
$lang['adr_new_entry'] = 'Новый контакт';

$lang['addr_saved'] = 'онтакт сохранён';
$lang['addr_added'] = 'онтакт добавлен';
$lang['addr_deleted'] = 'онтакт уничтожен';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // need translation
$lang['blk_email'] = 'E-mail'; // need translation
$lang['blk_no_address'] = 'No address available'; // need translation
$lang['blk_close'] = 'Close'; // need translation
$lang['blk_save'] = 'Save'; // need translation

// [Event]
$lang['evt_title'] = 'Calendar Event';
$lang['evt_save'] = 'Сохранить';
$lang['evt_delete'] = 'Удалить';
$lang['evt_stop'] = 'Stop time';
$lang['evt_start'] = 'Start time';

