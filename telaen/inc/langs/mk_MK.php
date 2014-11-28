<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'Sent items';
$lang['trash_extended'] = 'папката за отпадоци';
$lang['spam_extended'] = 'Spam фолдерот';

// Navigation texts
$lang['pages_text'] = 'Страници';
$lang['first_text'] = 'Прво';
$lang['previous_text'] = 'Претходна';
$lang['next_text'] = 'Напред';
$lang['last_text'] = 'Последна';
$lang['total_text'] = 'Вкупно';

// Mail Server Errors
$lang['err_login_msg'] = 'Влези грешка';
$lang['err_system_msg'] = 'Грешка во системот';
$lang['error_login'] = 'Ве молиме проверете вашето корисничко име или лозинка и обидете се повторно';
$lang['error_connect'] = 'Грешка при поврзување со серверот';
$lang['error_retrieving'] = 'Грешка при добивање на вашите пораки, вашиот Inbox се смени';
$lang['error_session_expired'] = 'Вашата сесија е истечен, Ве молиме пријавете се повторно';
$lang['error_other'] = 'систем неуспех, ве молиме контактирајте со вашиот мрежен администратор =';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Невалиден име на папка - Користете само следниве знаци az, AZ, 0-9, и -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Грешка: Мора да имате барем еден примач';
$lang['error_compose_invalid_mail1_s'] = 'Грешка: Оваа адреса на е-пошта изгледа е погрешно';
$lang['error_compose_invalid_mail1_p'] = 'Грешка: Оваа e-mail адреси се чини дека се неважечки';
$lang['error_compose_invalid_mail2_s'] = 'проверете си ја е-маил адреса пред resending овој е-мејл.';
$lang['error_compose_invalid_mail2_p'] = 'Проверете ги вашите адреси пред resending овој е-мејл.';

// Confirmation of delete
$lang['confirm_delete'] = '? Дали навистина сакате да ја избришете оваа порака (а)';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Без предмет]';
$lang['no_sender_text'] = '[Испраќач непозната]';
$lang['no_recipient_text'] = '[примач]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Нема доволно простор во вашиот inbox да ја заврши оваа акција \ Променете избришете некои пораки да продолжи';
$lang['quota_usage_info'] = 'квотата граница';
$lang['quota_usage_used'] = 'користи';
$lang['quota_usage_of'] = 'на';
$lang['quota_usage_avail'] = 'на располагање';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '% m /% d /% Y% H:% M';

// CharSet
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Прочитајте Е-пошта (и)';
$lang['compose_mnu'] = 'Напиши e-mail';
$lang['refresh_mnu'] = 'Освежи';
$lang['folders_mnu'] = 'Папки';
$lang['search_mnu'] = 'Барај';
$lang['address_mnu'] = 'Адресар';
$lang['empty_trash_mnu'] = 'Празно ѓубре';
$lang['prefs_mnu'] = 'Опции';
$lang['logoff_mnu'] = 'Излез';

// Reply
$lang['reply_prefix'] = 'Одг:';
$lang['forward_prefix'] = 'Препратена:';
$lang['reply_delimiter'] = '--------- Авторски порака --------';
$lang['reply_from_hea'] = 'Од:';
$lang['reply_to_hea'] = 'За:';
$lang['reply_cc_hea'] = 'Кк:';
$lang['reply_date_hea'] = 'Датум:';
$lang['reply_subject_hea'] = 'Предмет:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'клуч';
$lang['value_hea'] = 'Вредност';

// [Folders]
$lang['fld_name_hea'] = 'Папка';
$lang['fld_messages_hea'] = 'Пораки';
$lang['fld_size_hea'] = 'Големина';
$lang['fld_empty_hea'] = 'празен';
$lang['fld_delete_hea'] = 'Избриши';
$lang['fld_total'] = 'Вкупно:';
$lang['fld_make_new'] = 'Креирај нова папка';
$lang['folders_to'] = 'Папки на';

// [MessageList]
$lang['messages_to'] = 'пораки на';
$lang['no_messages'] = 'Нема нови пораки во вашата';
$lang['delete_selected_mnu'] = 'Избриши';
$lang['move_selected_mnu'] = 'Премести';
$lang['mark_selected_mnu'] = 'Означи ги како прочитани';
$lang['unmark_selected_mnu'] = 'Означи како непрочитана';
$lang['move_selected_to_trash_mnu'] = 'Премести во ѓубрето';


$lang['delete_mnu'] = 'Избриши';
$lang['move_mnu'] = 'Премести';
$lang['subject_hea'] = 'Предмет:';
$lang['from_hea'] = 'Од:';
$lang['to_hea'] = 'За:';
$lang['date_hea'] = 'Датум:';
$lang['size_hea'] = 'Големина';
$lang['have_spam'] = 'Мора Спам (проверете Spam фолдерот)';

$lang['msg_you_have'] = 'Мора';
$lang['msg_message'] = 'порака';
$lang['msg_messages'] = 'пораки';

$lang['msg_more_unread'] = 'непрочитани';
$lang['msg_one_unread'] = 'непрочитани';
$lang['msg_none_unread'] = 'ништо да го прочитате';
$lang['msg_in_the_folder'] = 'во папка';


// [Login]
$lang['lgn_title'] = 'Влези';
$lang['lgn_welcome_msg'] = 'Добредојдовте, влези во вашиот профил';
$lang['lng_user_email'] = 'Е-пошта';
$lang['lng_user_name'] = 'Корисничко име';
$lang['lng_user_pwd'] = 'лозинка';
$lang['lng_server'] = 'серверот';
$lang['lng_theme'] = 'тема';
$lang['lng_language'] = 'јазик';
$lang['lng_login_btn'] = 'Влези &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Колачињата мораат да бидат овозможени';
$lang['lng_cookie_not_valid'] = 'колаче безбедност проверка пропадна';

// [Newmessage]

$lang['newmsg_title'] = 'Состави пошта';

$lang['to_hea'] = 'За:';
$lang['cc_hea'] = 'Кк:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Предмет:';
$lang['address_tip'] = 'Од адресар';

$lang['attach_hea'] = 'Прилог:';
$lang['attch_add_new'] = 'Прикачи нова датотека';
$lang['attch_name_hea'] = 'Име';
$lang['attch_size'] = 'Големина';
$lang['attch_type_hea'] = 'Вид';
$lang['attch_dele_hea'] = 'Избриши';
$lang['attch_no_hea'] = 'Не прикачувања';

$lang['add_signature'] = 'Додај потпис';
$lang['send_text'] = 'Испрати';

$lang['result_error'] = 'Не беше можно да се испрати оваа e-mail';
$lang['result_success'] = 'Оваа е-пошта е испратена';
$lang['nav_continue'] = '&lt;&lt; Продолжи &gt;&gt;';
$lang['nav_back'] = 'Назад';

$lang['up_title'] = 'Додај датотека';
$lang['up_information_text'] = 'Изберете датотека';
$lang['up_button_text'] = 'Прикачи датотека';

$lang['require_receipt'] = 'Врати приемот';

$lang['priority_text'] = 'Приоритет';
$lang['priority_low'] = 'мали';
$lang['priority_normal'] = 'Нормално';
$lang['priority_high'] = 'Висока';

// [Preferences]
$lang['prf_title'] = 'Опции';
$lang['prf_general_title'] = 'Општи информации';
$lang['prf_name'] = 'Име';
$lang['prf_reply_to'] = 'Одговори на';
$lang['prf_time_zone'] = 'Временска зона';
$lang['prf_trash_title'] = 'ѓубрето';
$lang['prf_save_to_trash'] = 'Кога ќе <b> избришете </ b> пораката, таа да се движат';
$lang['prf_save_only_read'] = 'спаси само на <b> читаат пораки </ b> во';
$lang['prf_empty_on_exit'] = '<b> Празно </ b> корпа кога ќе се одјавите';
$lang['prf_empty_spam_on_exit'] = '<b> Празно </ b> Spam фолдерот кога ќе се одјавите';
$lang['prf_unmark_read_on_exit'] = 'Ресетирај ПРОЧИТАЈТЕ пораки како непрочитани кога ќе се одјавите';
$lang['prf_sent_title'] = 'Sent items';
$lang['prf_save_sent'] = '<b> Save sent messages </ b> во';
$lang['prf_messages_title'] = 'Пораки';
$lang['prf_page_limit'] = 'Максимален број на пораки на страница';
$lang['prf_signature_title'] = 'потпис';
$lang['prf_signature'] = 'Напиши потпис';
$lang['prf_auto_add_sign'] = 'Додади вашиот потпис на сите појдовни пораки';
$lang['prf_save_button'] = 'Зачувај Опции';
$lang['prf_display_images'] = 'Прикажи спроведен слики';
$lang['prf_default_editor_mode'] = 'Стандарден режим на уредување';
$lang['prf_default_editor_mode_text'] = '"обичен текст';
$lang['prf_default_editor_mode_html'] = '"Напредно уредник HTML';
$lang['prf_time_to_refesh'] = 'Автоматски проверува за нова пошта (минути)';
$lang['prf_spam_level'] = 'СПАМ чувствителност (0 = Исклучено, 1 = многу висока, 9 = Многу ниско)';
$lang['prf_auto_require_receipt'] = 'Потребен читаат приемот стандардно';

$lang['prf_msg_saved'] = 'Параметри спасени';

// filters
$lang['filter_title'] = 'филтри';

$lang['filter_new'] = 'Креирај филтер';
$lang['filter_desc'] = 'Изберете критериум на пребарување и акцијата за дојдовни пораки';
$lang['filter_list'] = 'Тековни филтри';

$lang['filter_field_from'] = 'Од';
$lang['filter_field_to'] = 'Да';
$lang['filter_field_subject'] = 'Предмет';
$lang['filter_field_header'] = 'заглавие';
$lang['filter_field_body'] = 'тело';

$lang['filter_type_move'] = 'Премести';
$lang['filter_type_delete'] = 'Избриши';
$lang['filter_type_mark'] = 'Означи ги како прочитани';

$lang['filter_add'] = 'Додади филтер';
$lang['filter_delete'] = 'Избриши';
$lang['filter_delete_selected'] = 'Избриши ги избраните филтри';

$lang['filter_field'] = 'Филтер на терен';
$lang['filter_match'] = 'пребарување за';
$lang['filter_type'] = 'акција';
$lang['filter_folder'] = 'дестинација папка';

$lang['filter_msg_nofilters'] = 'Не филтри на располагање.';
$lang['filter_msg_added'] = 'Филтер додаде';
$lang['filter_msg_deleted'] = 'Филтер избришани';


// [Catch]
$lang['ctc_title'] = 'Додај адресар';
$lang['ctc_information'] = 'само покажува e-mail кои не се во адресарот';
$lang['ctc_name'] = 'Име';
$lang['ctc_email'] = 'Е-пошта';
$lang['ctc_no_address'] = 'Не адреса на располагање';
$lang['ctc_close'] = 'Затвори';
$lang['ctc_save'] = 'Зачувај';

// [Readmsg]
$lang['next_mnu'] = 'Напред';
$lang['previous_mnu'] = 'Претходна';
$lang['back_mnu'] = 'Назад';
$lang['reply_mnu'] = 'Одговор';
$lang['reply_all_mnu'] = 'Одговори на сите';
$lang['forward_mnu'] = 'Напред';
$lang['headers_mnu'] = 'заглавие';
$lang['move_mnu'] = 'Премести';
$lang['move_to_trash_mnu'] = 'Премести во ѓубрето';
$lang['delete_mnu'] = 'Избриши';
$lang['print_mnu'] = 'print';
$lang['download_mnu'] = 'download';

$lang['from_hea'] = 'Од:';
$lang['to_hea'] = 'За:';
$lang['cc_hea'] = 'Кк:';
$lang['date_hea'] = 'Датум:';
$lang['subject_hea'] = 'Предмет:';
$lang['attach_hea'] = 'Прилог:';

$lang['attch_name_hea'] = 'Име';
$lang['attch_force_hea'] = 'download';
$lang['attch_type_hea'] = 'Вид';
$lang['attch_size_hea'] = 'Големина';
$lang['catch_address'] = 'Додај адресар';
$lang['block_address'] = 'Забрани адреса';

// [Search]
$lang['sch_title'] = 'Барај';
$lang['sch_information_text'] = '.. Напиши фраза или збор кој го барате <br> Само прочитате пораки ќе се пребаруваат';
$lang['sch_button_text'] = 'Барај &gt;&gt;';
$lang['sch_subject_hea'] = 'Предмет';
$lang['sch_from_hea'] = 'Од';
$lang['sch_date_hea'] = 'Датум';
$lang['sch_body_hea'] = 'на пораката';
$lang['sch_folder_hea'] = 'Папка';
$lang['sch_no_results'] = 'Не пораки за појавување на вашиот критериум се пронајдени';

// [QuickAddress]
$lang['qad_title'] = 'Адресар';
$lang['qad_select_address'] = 'Одберете контакт';
$lang['qad_to'] = 'Да';
$lang['qad_cc'] = 'Кк';
$lang['qad_bcc'] = 'Слепа копија';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Адресар';
$lang['adr_name'] = 'Име';
$lang['adr_email'] = 'Е-пошта';
$lang['adr_street'] = 'Улица';
$lang['adr_city'] = 'Град';
$lang['adr_state'] = 'држава';
$lang['adr_work'] = 'работа';
$lang['adr_back'] = 'Назад';
$lang['adr_save'] = 'Зачувај';
$lang['adr_phone'] = 'телефон';
$lang['adr_cell'] = 'Мобилен';
$lang['adr_note'] = 'Забелешки';

// list
$lang['adr_name_hea'] = 'Име';
$lang['adr_email_hea'] = 'Е-пошта';
$lang['adr_edit_hea'] = 'Уреди';
$lang['adr_expo_hea'] = 'Извоз';
$lang['adr_dele_hea'] = 'Избриши';
$lang['adr_new_entry'] = 'Нов контакт';

$lang['addr_saved'] = 'Контактот беше спасен';
$lang['addr_added'] = 'Контактот е додадена';
$lang['addr_deleted'] = 'Контактот е избришан';


// [BlockSender]
$lang['blk_title'] = 'Забрани испраќачот';
$lang['blk_information'] = 'само покажува e-mail кои се уште не се во филтерот';
$lang['blk_email'] = 'Е-пошта';
$lang['blk_no_address'] = 'Не адреса на располагање';
$lang['blk_close'] = 'Затвори';
$lang['blk_save'] = 'Зачувај';

// [Event]
$lang['evt_title'] = 'Календар на настани';
$lang['evt_save'] = 'Зачувај';
$lang['evt_delete'] = 'Избриши';
$lang['evt_stop'] = 'Стоп време';
$lang['evt_start'] = 'Започни време';

