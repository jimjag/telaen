<?php
/*
 * Russian (Русский) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'windows-1251';

$lang['inbox_extended'] = 'Входящие';
$lang['sent_extended'] = 'Отправленные';
$lang['trash_extended'] = 'папку Trash';
$lang['spam_extended'] = 'Spam папку';
$lang['drafts_extended'] = 'Проекты';

$lang['pages_text'] = 'Страницы';
$lang['first_text'] = 'первый';
$lang['previous_text'] = 'Предыдущий';
$lang['next_text'] = 'Next';
$lang['last_text'] = 'Последнее';
$lang['total_text'] = 'Всего';

$lang['err_login_msg'] = 'Логин об ошибке';
$lang['err_system_msg'] = 'Системная ошибка';
$lang['error_login'] = 'Пожалуйста, проверьте свои имя пользователя или пароль и повторите попытку';
$lang['error_connect'] = 'Ошибка при подключении к серверу';
$lang['error_retrieving'] = 'Ошибка при получении сообщений, в папке Входящие изменилось ';
$lang['error_session_expired'] = 'Ваша сессия истек, пожалуйста, войдите снова';
$lang['error_other'] = 'Системный сбой, обратитесь к администратору сети';

$lang['error_invalid_name'] = 'Неверное имя папки - Используйте только следующие символы AZ, AZ, 0-9, и - ';

$lang['error_no_recipients'] = 'Ошибка: Вы должны иметь по крайней мере одного получателя ';
$lang['error_compose_invalid_mail1_s'] = 'Ошибка: Этот адрес электронной почты, кажется, инвалид »';
$lang['error_compose_invalid_mail1_p'] = 'Ошибка: адреса электронной почты, кажется, инвалид »';
$lang['error_compose_invalid_mail2_s'] = 'Проверьте адрес электронной почты перед повторной эту электронную почту.';
$lang['error_compose_invalid_mail2_p'] = 'Проверьте ваши адреса перед повторной эту электронную почту.';

$lang['confirm_delete'] = 'Вы действительно хотите удалить это сообщение (ы)';

$lang['no_subject_text'] = '[без темы]';
$lang['no_sender_text'] = '[Отправитель неизвестен]';
$lang['no_recipient_text'] = '[Получатель неизвестен]';

$lang['quota_exceeded'] = 'Не хватает места в вашем почтовом ящике для выполнения этого действия \ nПожалуйста удалите некоторые сообщения, чтобы продолжить ';
$lang['quota_usage_info'] = 'квоту';
$lang['quota_usage_used'] = 'Используется';
$lang['quota_usage_of'] = 'из';
$lang['quota_usage_avail'] = 'доступны';

$lang['messages_mnu'] = 'Входящие';
$lang['read_menu'] = 'Read E-Mail (ы)';
$lang['compose_mnu'] = 'Write E-Mail';
$lang['refresh_mnu'] = 'Refresh';
$lang['folders_mnu'] = 'Папки';
$lang['search_mnu'] = 'Поиск';
$lang['address_mnu'] = 'Адресная книга';
$lang['empty_trash_mnu'] = 'Очистить корзину ';
$lang['prefs_mnu'] = 'Настройки';
$lang['logoff_mnu'] = 'Выйти';

$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Исходное сообщение --------';
$lang['reply_from_hea'] = 'От:';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Копия:';
$lang['reply_date_hea'] = 'Дата:';
$lang['reply_subject_hea'] = 'Тема:';

$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'значение';

$lang['fld_name_hea'] = 'Папка';
$lang['fld_messages_hea'] = 'Сообщения';
$lang['fld_size_hea'] = 'Размер';
$lang['fld_empty_hea'] = 'пустой';
$lang['fld_delete_hea'] = 'Удалить';
$lang['fld_total'] = 'Общее:';
$lang['fld_make_new'] = 'Создать новую папку';
$lang['folders_to'] = 'папки для';

// [MessageList]
$lang['messages_to'] = 'Сообщения в';
$lang['no_messages'] = 'Нет новых сообщений в почтовом';
$lang['delete_selected_mnu'] = 'Удалить';
$lang['move_selected_mnu'] = 'Переместить в';
$lang['mark_selected_mnu'] = 'Отметить как прочитанное ';
$lang['unmark_selected_mnu'] = 'Отметить как непрочитанные';
$lang['move_selected_to_trash_mnu'] = 'Переместить в Корзину';

$lang['delete_mnu'] = 'Удалить';
$lang['move_mnu'] = 'Переместить в';
$lang['subject_hea'] = 'Тема:';
$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'To:';
$lang['date_hea'] = 'Дата:';
$lang['size_hea'] = 'Размер';
$lang['have_spam'] = 'Вы должны спама (проверить папку Спам)';

$lang['msg_you_have'] = 'Вы должны';
$lang['msg_message'] = 'сообщение';
$lang['msg_messages'] = 'сообщения';

$lang['msg_more_unread'] = 'прочитанные';
$lang['msg_one_unread'] = 'прочитанные';
$lang['msg_none_unread'] = 'никто не читать ';
$lang['msg_in_the_folder'] = 'в папке';

$lang['lgn_title'] = 'Логин';
$lang['lgn_welcome_msg'] = 'Добро пожаловать, пожалуйста, войдите в свой аккаунт ';
$lang['lng_user_email'] = 'Электронная почта';
$lang['lng_user_name'] = 'Имя пользователя';
$lang['lng_user_pwd'] = 'Пароль';
$lang['lng_server'] = 'Сервер';
$lang['lng_theme'] = 'Тема';
$lang['lng_language'] = 'Язык';
$lang['lng_login_btn'] = 'Логин и GT; & GT;';
$lang['lng_cookie_not_enabled'] = 'Cookies должны быть разрешены';
$lang['lng_cookie_not_valid'] = 'Cookie Проверка безопасности Failed';

$lang['newmsg_title'] = 'Написать письмо »';

$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Копия:';
$lang['bcc_hea'] = 'Копия:';
$lang['subject_hea'] = 'Тема:';
$lang['address_tip'] = 'Из адресной книги ';

$lang['attach_hea'] = 'Приложение:';
$lang['attch_add_new'] = 'Присоединить новый файл ';
$lang['attch_name_hea'] = 'Имя';
$lang['attch_size'] = 'Размер';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Удалить';
$lang['attch_no_hea'] = 'Нет вложений';

$lang['add_signature'] = 'Добавить подпись';
$lang['send_text'] = 'Отправить';

$lang['result_error'] = 'Не удалось отправить это письмо';
$lang['result_success'] = 'Это электронная почта была отправлена';
$lang['nav_continue'] = '& Lt; & Lt; Продолжить & GT; & GT; ';
$lang['nav_back'] = 'Back';

$lang['up_title'] = 'Добавить файл ';
$lang['up_information_text'] = 'Выберите файл';
$lang['up_button_text'] = 'Присоединить файл';

$lang['require_receipt'] = 'уведомлением о вручении ';

$lang['priority_text'] = 'Приоритет';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'Normal';
$lang['priority_high'] = 'High';

$lang['prf_title'] = 'Настройки';
$lang['prf_general_title'] = 'Общая информация';
$lang['prf_name'] = 'Имя';
$lang['prf_reply_to'] = 'Ответить на';
$lang['prf_time_zone'] = 'Часовой пояс';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Когда вы <b>Удалить</b> сообщение, переместите его в';
$lang['prf_save_only_read'] = 'После <b>прочитать </b> сообщение, переместите его в';
$lang['prf_empty_on_exit'] = '<b> Пусто </b> папки Корзина, когда вы выйдите';
$lang['prf_empty_spam_on_exit'] = '<b> Пусто </b> папку Спам когда вы выйдите';
$lang['prf_unmark_read_on_exit'] = 'Сброс читать сообщения как непрочитанные, когда вы выйдите';
$lang['prf_sent_title'] = 'Отправленные';
$lang['prf_save_sent'] = 'Сохранить <b> отправленных сообщений </b> в';
$lang['prf_messages_title'] = 'Сообщения';
$lang['prf_page_limit'] = 'Максимальное количество сообщений на странице';
$lang['prf_signature_title'] = 'Подпись';
$lang['prf_signature'] = 'Напишите подпись ';
$lang['prf_auto_add_sign'] = 'Добавить подпись ко всем исходящим сообщениям';
$lang['prf_save_button'] = 'Сохранить настройки';
$lang['prf_display_images'] = 'Показать Изображения';
$lang['prf_default_editor_mode'] = 'По умолчанию режим редактирования';
$lang['prf_default_editor_mode_text'] = 'Простой текст';
$lang['prf_default_editor_mode_html'] = 'продвинутый редактор HTML';
$lang['prf_time_to_refesh'] = 'Автоматически проверять наличие новой почты (в минутах)';
$lang['prf_spam_level'] = 'чувствительность спам (0 = Отключен, 1 = Very High, 9 = очень низкий)';
$lang['prf_auto_require_receipt'] = 'Требовать прочтении по умолчанию';
$lang['prf_keep_on_server'] = 'Держать электронную почту на сервере - не локальные папки';

$lang['prf_msg_saved'] = 'Настройки сохраняются';

$lang['filter_title'] = 'Фильтры';

$lang['filter_new'] = 'Создать фильтр ';
$lang['filter_desc'] = 'Выберите критерии поиска и действия для входящих сообщений';
$lang['filter_list'] = 'Текущие фильтры';

$lang['filter_field_from'] = 'From';
$lang['filter_field_to'] = 'Для';
$lang['filter_field_subject'] = 'Тема';
$lang['filter_field_header'] = 'Заголовок';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Удалить';
$lang['filter_type_mark'] = 'Отметить как прочитанное ';

$lang['filter_add'] = 'Добавить фильтр ';
$lang['filter_delete'] = 'Удалить';
$lang['filter_delete_selected'] = 'Удалить выбранные фильтры ';

$lang['filter_field'] = 'Фильтр на поле';
$lang['filter_match'] = 'Поиск';
$lang['filter_type'] = 'Действие';
$lang['filter_folder'] = 'Папка назначения';

$lang['filter_msg_nofilters'] = 'Нет доступных фильтров.';
$lang['filter_msg_added'] = 'Фильтр добавил';
$lang['filter_msg_deleted'] = 'Фильтр удалена';


$lang['ctc_title'] = 'Добавить в адресную книгу ';
$lang['ctc_information'] = 'Показывает только по электронной почте, которые не в адресной книге';
$lang['ctc_name'] = 'Имя';
$lang['ctc_email'] = 'Электронная почта';
$lang['ctc_no_address'] = 'Нет адреса доступны';
$lang['ctc_close'] = 'Close';
$lang['ctc_save'] = 'Сохранить';

$lang['next_mnu'] = 'Next';
$lang['previous_mnu'] = 'Предыдущий';
$lang['back_mnu'] = 'Back';
$lang['reply_mnu'] = 'Ответить';
$lang['reply_all_mnu'] = 'Ответить всем ';
$lang['forward_mnu'] = 'Вперед';
$lang['headers_mnu'] = 'Заголовок';
$lang['move_mnu'] = 'Переместить в';
$lang['move_to_trash_mnu'] = 'Переместить в Корзину';
$lang['delete_mnu'] = 'Удалить';
$lang['print_mnu'] = 'Печать';
$lang['download_mnu'] = 'Скачать';

$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Копия:';
$lang['date_hea'] = 'Дата:';
$lang['subject_hea'] = 'Тема:';
$lang['attach_hea'] = 'Приложение:';

$lang['attch_name_hea'] = 'Имя';
$lang['attch_force_hea'] = 'Скачать';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Размер';
$lang['catch_address'] = 'Добавить в адресную книгу ';
$lang['block_address'] = 'Блок адрес';

$lang['sch_title'] = 'Поиск';
$lang['sch_information_text'] = '.. Написать фразу или слово, которое вы ищете <br> только для чтения будет искать сообщения';
$lang['sch_button_text'] = 'Поиск и GT; & GT; ';
$lang['sch_subject_hea'] = 'Тема';
$lang['sch_from_hea'] = 'From';
$lang['sch_date_hea'] = 'Дата';
$lang['sch_body_hea'] = 'Текст сообщения';
$lang['sch_folder_hea'] = 'Папка';
$lang['sch_no_results'] = 'Нет сообщений, соответствующих Вашему запросу, не было найдено ';

$lang['qad_title'] = 'Адресная книга';
$lang['qad_select_address'] = 'Выберите контакт ';
$lang['qad_to'] = 'Для';
$lang['qad_cc'] = 'CC';
$lang['qad_bcc'] = 'Копия';

$lang['adr_title'] = 'Адресная книга';
$lang['adr_name'] = 'Имя';
$lang['adr_email'] = 'Электронная почта';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'Город';
$lang['adr_state'] = 'государство';
$lang['adr_work'] = 'работа';
$lang['adr_back'] = 'Back';
$lang['adr_save'] = 'Сохранить';
$lang['adr_phone'] = 'Телефон';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Записки';

$lang['adr_name_hea'] = 'Имя';
$lang['adr_email_hea'] = 'Электронная почта';
$lang['adr_edit_hea'] = 'Edit';
$lang['adr_expo_hea'] = 'Экспорт';
$lang['adr_dele_hea'] = 'Удалить';
$lang['adr_new_entry'] = 'Новый контакт';

$lang['addr_saved'] = 'контакт был сохранен';
$lang['addr_added'] = 'Контакт добавлен';
$lang['addr_deleted'] = 'контакт был удален';

$lang['blk_title'] = 'Блок отправителя';
$lang['blk_information'] = 'Показывает только по электронной почте, которые не в фильтре, но';
$lang['blk_email'] = 'Электронная почта';
$lang['blk_no_address'] = 'Нет адреса доступны';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Сохранить';

$lang['evt_title'] = 'Календарь событий';
$lang['evt_save'] = 'Сохранить';
$lang['evt_delete'] = 'Удалить';
$lang['evt_stop'] = 'Время остановки';
$lang['evt_start'] = 'Время начала';
