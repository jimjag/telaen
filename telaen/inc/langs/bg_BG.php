<?php
/*
 * Bulgarian (Български) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';
// CharSet
$lang['default_char_set'] = 'Windows-1251';

// Удобни имена в системните папки
$lang['inbox_extended'] = 'Inbox ';
$lang['sent_extended'] = 'Изпратени ';
$lang['trash_extended'] = 'Trash папка ';
$lang['spam_extended'] = 'Spam папката ';
$lang['drafts_extened'] = 'Чернови ';
$lang['drafts_extended'] = 'Чернови';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First ';
$lang['previous_text'] = 'Previous ';
$lang['next_text'] = 'Next';
$lang['last_text'] = 'Last ';
$lang['total_text'] = 'Общо';

// Mail Server Errors
$lang['err_login_msg'] = 'Login грешка ';
$lang['err_system_msg '] = 'Системна повреда';
$lang['error_login'] = 'Моля, проверете потребителското име или паролата и опитайте отново ';
$lang['error_connect'] = 'Грешка при свързването със сървъра ';
$lang['error_retrieving'] = 'Грешка при получаване на съобщенията ви, вашата Inbox е променило ';
$lang['error_session_expired'] = 'Сесията ви е изтекла, моля логнете отново ';
$lang['error_other'] = 'System недостатъчност, моля обърнете се към вашия мрежов администратор ';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Невалидно име на папка - Използвайте само следните знаци от А до Я, AZ, 0-9, и - ';

// Validations when sending mails
$lang['error_no_recipients'] = 'Грешка: Трябва да имате поне един получател ';
$lang['error_compose_invalid_mail1_s'] = 'Грешка: Този е-мейл адрес е грешно ';
$lang['error_compose_invalid_mail1_p'] = 'Грешка: Този е-мейл адреси, изглежда са невалидни ';
$lang['error_compose_invalid_mail2_s'] = 'Проверка на адреса на електронната поща, преди да изпратите този имейл. ';
$lang['error_compose_invalid_mail2_p'] = 'Проверка на адресите си преди да изпратите този имейл. ';

// Confirmation of delete
$lang['confirm_delete'] = '? Наистина ли искате да изтриете това съобщение (ите) ';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[No подлежи] ';
$lang['no_sender_text'] = '[Sender неизвестен] ';
$lang['no_recipient_text'] = '[Получател неизвестен] ';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Няма достатъчно място в пощенската си кутия, за да завършите това действие \ nМоля изтриете някои съобщения, за да продължи ';
$lang['quota_usage_info'] = 'граница квота ';
$lang['quota_usage_used'] = 'използван';
$lang['quota_usage_of'] = 'на';
$lang['quota_usage_avail'] = 'годна';

// Menu
$lang['messages_mnu'] = 'Inbox ';
$lang ['read_menu'] = 'Прочетете E-Mail (и)';
$lang['compose_mnu'] = 'Изпращане на E-Mail ';
$lang['refresh_mnu'] = 'Refresh';
$lang['folders_mnu'] = 'Folders ';
$lang['search_mnu'] = 'Търсене';
$lang['address_mnu'] = 'Адрес книга ';
$lang['empty_trash_mnu'] = 'Empty боклук ';
$lang['prefs_mnu'] = 'Preferences ';
$lang['logoff_mnu'] = 'Изход';

// Reply
$lang['reply_prefix'] = 'Re: ';
$lang['forward_prefix'] = 'Fw: ';
$lang['reply_delimiter'] = '--------- Original Message -------- ';
$lang['reply_from_hea'] = 'От:';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Cc: ';
$lang['reply_date_hea'] = 'Дата: ';
$lang['reply_subject_hea'] = 'Тема: ';

// page-specific vars

// [Headers]
$lang['key_hea'] = 'ключ';
$lang['value_hea'] = 'стойност';

// [Folders]
$lang['fld_name_hea'] = 'Folder ';
$lang['fld_messages_hea'] = 'Съобщения';
$lang['fld_size_hea'] = 'Size ';
$lang['fld_empty_hea'] = 'Empty ';
$lang['fld_delete_hea'] = 'Изтриване';
$lang['fld_total'] = 'Total: ';
$lang['fld_make_new'] = 'Създаване на нова папка ';
$lang['folders_to'] = 'папки';

// [MessageList]
$lang['messages_to'] = 'Съобщения до ';
$lang['no_messages'] = 'Няма нови съобщения в ';
$lang['delete_selected_mnu'] = 'Изтрий';
$lang['move_selected_mnu'] = 'Move да ';
$lang['mark_selected_mnu'] = 'Mark като прочетете ';
$lang['unmark_selected_mnu'] = 'Mark като непрочетено ';
$lang['move_selected_to_trash_mnu'] = 'Move да Trash ';


$lang['delete_mnu'] = 'Изтрий';
$lang['move_mnu'] = 'Move да ';
$lang['subject_hea'] = 'Тема: ';
$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'To:';
$lang['date_hea'] = 'Дата: ';
$lang['size_hea'] = 'Size ';
$lang['have_spam'] = 'Трябва Spam (проверява папката за спам) ';

$lang['msg_you_have'] = 'Трябва';
$lang['msg_message'] = 'съобщение ';
$lang['msg_messages'] = 'съобщения ';

$lang['msg_more_unread'] = 'непрочетено ';
$lang['msg_one_unread'] = 'непрочетено ';
$lang['msg_none_unread'] = 'кой да чете ';
$lang['msg_in_the_folder'] = 'в папката ';


// [Login]
$lang['lgn_title'] = 'Вход';
$lang['lgn_welcome_msg'] = 'Добре дошли, влезте в профила си ';
$lang['lng_user_email'] = 'Електронна поща';
$lang['lng_user_name'] = 'Потребителското име';
$lang['lng_user_pwd'] = 'Password ';
$lang['lng_server'] = 'сървър ';
$lang['lng_theme'] = 'Тема ';
$lang['lng_language'] = 'език';
$lang['lng_login_btn'] = 'Login & GT; & GT; ';
$lang['lng_cookie_not_enabled'] = 'трябва да приема бисквитки ';
$lang['lng_cookie_not_valid'] = 'Cookie сигурност проверка не успя ';

// [Newmessage]

$lang['newmsg_title'] = 'Ново съобщение ';

$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc: ';
$lang['bcc_hea'] = 'Ск: ';
$lang['subject_hea'] = 'Тема: ';
$lang['address_tip'] = 'От адресната книга ';

$lang['attach_hea'] = 'Attachment: ';
$lang['attch_add_new'] = 'Прикрепете нов файл ';
$lang['attch_name_hea'] = 'Име';
$lang['attch_size'] = 'Size ';
$lang['attch_type_hea'] = 'Type ';
$lang['attch_dele_hea'] = 'Изтриване';
$lang['attch_no_hea'] = 'Не са прикачени';

$lang['add_signature'] = 'Добавяне на подпис ';
$lang['send_text'] = 'Изпрати';

$lang['result_error'] = 'Не е възможно да се изпрати електронна поща';
$lang['result_success'] = 'Този е-мейл е изпратен ';
$lang['nav_continue'] = '& LT; & LT; Продължи & GT; & GT; ';
$lang['nav_back'] = 'Back';

$lang['up_title'] = 'Добавяне на файл ';
$lang['up_information_text'] = 'Изберете файл ';
$lang['up_button_text'] = 'Прикачете файл ';

$lang['require_receipt'] = 'Return получаване ';

$lang['priority_text'] = 'Priority ';
$lang['priority_low'] = 'Low ';
$lang['priority_normal'] = 'Normal ';
$lang['priority_high'] = 'висок';

// [Preferences]
$lang['prf_title'] = 'Preferences ';
$lang['prf_general_title'] = 'Обща информация ';
$lang['prf_name'] = 'Име';
$lang['prf_reply_to'] = 'Отговор до ';
$lang['prf_time_zone'] = 'Часова зона ';
$lang['prf_trash_title'] = 'Trash ';
$lang['prf_save_to_trash'] = 'Когато <б> изтриете </ B> съобщение, да го премести към ';
$lang['prf_save_only_read'] = 'След като <б> Прочети </ B> съобщение, да го премести към ';
$lang['prf_empty_on_exit'] = '<б> Empty </ B> боклук папка, когато вие излезете ';
$lang['prf_empty_spam_on_exit'] = '<б> Empty </ B> Spam папката, когато вие излезете ';
$lang['prf_unmark_read_on_exit'] = 'Reset четете съобщения като непрочетени, когато вие излезете ';
$lang['prf_sent_title'] = 'Изпратени ';
$lang['prf_save_sent'] = 'Save <б> изпратени съобщения </ б> в ';
$lang['prf_messages_title'] = 'Съобщения';
$lang['prf_page_limit'] = 'Максимален брой съобщения на страница ';
$lang['prf_signature_title'] = 'подпис';
$lang['prf_signature'] = 'Въведете Вашия подпис ';
$lang['prf_auto_add_sign'] = 'Добавяне на вашия подпис за всички изходящи съобщения ';
$lang['prf_save_button'] = 'Запазване на предпочитанията';
$lang['prf_display_images'] = 'Show прикрепени снимки ';
$lang['prf_default_editor_mode'] = 'Default режим редактиране ';
$lang['prf_default_editor_mode_text'] = '"Обикновен текст" ';
$lang['prf_default_editor_mode_html'] = '"Advanced HTML редактор" ';
$lang['prf_time_to_refesh'] = 'Автоматична проверка за нова поща (минути)';
$lang['prf_spam_level'] = 'SPAM чувствителност (0 = Disabled, 1 = много висока, 9 = ниско) ';
$lang['prf_auto_require_receipt'] = 'Изискване прочетете получаване по подразбиране ';
$lang['prf_keep_on_server'] = 'Дръжте имейл на сървъра - няма местни папки ';

$lang['prf_msg_saved'] = 'спасени Preferences ';

// filters
$lang['filter_title'] = 'филтри';

$lang['filter_new'] = 'Създаване на филтър ';
$lang['filter_desc'] = 'Изберете критерии за търсене и действията за входящите съобщения ';
$lang['filter_list'] = 'Текущи филтри';

$lang['filter_field_from'] = 'От ';
$lang['filter_field_to'] = 'Да';
$lang['filter_field_subject'] = 'Относно';
$lang['filter_field_header'] = 'Header ';
$lang['filter_field_body'] = 'Body ';

$lang['filter_type_move'] = 'Move ';
$lang['filter_type_delete'] = 'Изтриване';
$lang['filter_type_mark'] = 'Mark чете ';

$lang['filter_add'] = 'Добавяне на филтър ';
$lang['filter_delete'] = 'Изтриване';
$lang['filter_delete_selected'] = 'Изтриване на избраните филтри ';

$lang['filter_field'] = 'Филтър по поле ';
$lang['filter_match'] = 'Търсене на ';
$lang['filter_type'] = 'действие ';
$lang['filter_folder'] = 'Папката ';

$lang['filter_msg_nofilters'] = 'Не са налични филтри. ';
$lang['filter_msg_added'] = 'Filter добавя ';
$lang['filter_msg_deleted'] = 'Filter заличава ';


// [Catch]
$lang['ctc_title'] = 'Добави в адресната книга ';
$lang['ctc_information'] = 'Само показва електронни писма, които не са в адресната книга ';
$lang['ctc_name'] = 'Име';
$lang['ctc_email'] = 'Електронна поща';
$lang['ctc_no_address'] = 'Не е налична адрес ';
$lang['ctc_close'] = 'Close';
$lang['ctc_save'] = 'Save';

// [Readmsg]
$lang['next_mnu'] = 'Next';
$lang['previous_mnu'] = 'Previous ';
$lang['back_mnu'] = 'Back';
$lang['reply_mnu'] = 'отговор ';
$lang['reply_all_mnu'] = 'Отговор до всички ';
$lang['forward_mnu'] = 'Forward ';
$lang['headers_mnu'] = 'Header ';
$lang['move_mnu'] = 'Move да ';
$lang['move_to_trash_mnu'] = 'Move да Trash ';
$lang['delete_mnu'] = 'Изтрий';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'От:';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc: ';
$lang['date_hea'] = 'Дата: ';
$lang['subject_hea'] = 'Тема: ';
$lang['attach_hea'] = 'Attachment: ';

$lang['attch_name_hea'] = 'Име';
$lang['attch_force_hea'] = 'Download';
$lang['attch_type_hea'] = 'Type ';
$lang['attch_size_hea'] = 'Size ';
$lang['catch_address'] = 'Добави в адресната книга ';
$lang['block_address'] = 'Block адрес ';

// [Search]
$lang['sch_title'] = 'Търсене';
$lang['sch_information_text'] = '.. Напиши фраза или дума, която търсите КЪЩА само за четене на съобщения ще бъдат търсени ';
$lang['sch_button_text'] = 'Търсене & GT; & GT; ';
$lang['sch_subject_hea'] = 'Относно';
$lang['sch_from_hea'] = 'От ';
$lang['sch_date_hea'] = 'Дата';
$lang['sch_body_hea'] = 'Message Body ';
$lang['sch_folder_hea'] = 'Folder ';
$lang['sch_no_results'] = 'Не съобщения, отговарящи на Вашите критерии са били открити ';

// [QuickAddress]
$lang['qad_title'] = 'Адрес книга ';
$lang['qad_select_address'] = 'Изберете контакт ';
$lang['qad_to'] = 'Да';
$lang['qad_cc'] = 'Cc ';
$lang['qad_bcc'] = 'Ск ';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Адрес книга ';
$lang['adr_name'] = 'Име';
$lang['adr_email'] = 'Електронна поща';
$lang['adr_street'] = 'Улица ';
$lang['adr_city'] = 'City ';
$lang['adr_state'] = 'държава';
$lang['adr_work'] = 'труд';
$lang['adr_back'] = 'Back';
$lang['adr_save'] = 'Save';
$lang['adr_phone'] = 'Телефон';
$lang['adr_cell'] = 'Cell ';
$lang['adr_note'] = 'Забележки ';

// list
$lang['adr_name_hea'] = 'Име';
$lang['adr_email_hea'] = 'Електронна поща';
$lang['adr_edit_hea'] = 'Edit';
$lang['adr_expo_hea'] = 'износ';
$lang['adr_dele_hea'] = 'Изтриване';
$lang['adr_new_entry'] = 'Нов контакт ';

$lang['addr_saved'] = 'Контактът бе спасен ';
$lang['addr_added'] = 'Контактът бе добавен ';
$lang['addr_deleted'] = 'Контактът е изтрит ';


// [BlockSender]
$lang['blk_title'] = 'Block подател ';
$lang['blk_information'] = 'Само показва електронни писма, които все още не са във филтъра ';
$lang['blk_email'] = 'Електронна поща';
$lang['blk_no_address'] = 'Не адрес на разположение ';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Save';

// [Event]
$lang['evt_title'] = 'Calendar Event ';
$lang['evt_save'] = 'Save';
$lang['evt_delete'] = 'Изтриване';
$lang['evt_stop'] = 'Спри времето ';
$lang['evt_start'] = 'Начален час ';
