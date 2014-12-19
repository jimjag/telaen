<?php
/*
 * Armenian (Հայերեն) (canonical list and phrasing)
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
$lang['inbox_extended'] = 'Inbox';
$lang['sent_extended'] = 'Ուղարկված իրեր';
$lang['trash_extended'] = 'Trash թղթապանակ';
$lang['spam_extended'] = 'Spam թղթապանակ';
$lang['drafts_extended'] = 'նախագծերը';

// Navigation texts
$lang['pages_text'] = 'Էջեր';
$lang['first_text'] = 'Առաջին';
$lang['previous_text'] = 'Այս';
$lang['next_text'] = 'Հաջորդը';
$lang['last_text'] = 'Վերջին';
$lang['total_text'] = 'Ընդհանուր';

// Mail Server Errors
$lang['err_login_msg'] = 'Մուտք սխալ';
$lang['err_system_msg'] = 'System սխալ';
$lang['error_login'] = 'Խնդրում ենք ստուգել Ձեր մուտքաբառը կամ գաղտնաբառը, եւ փորձեք կրկին.';
$lang['error_connect'] = 'Սխալ կապում է սերվերի';
$lang['error_retrieving'] = 'Սխալ ստանալով ձեր հաղորդագրությունները Ձեր Inbox փոխվել';
$lang['error_session_expired'] = 'Ձեր նիստը ժամկետանց, խնդրում ենք մուտք նորից';
$lang['error_other'] = 'համակարգի ձախողման, դիմեք ձեր ցանցային ադմինիստրատորին';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Սխալ թղթապանակը անունը - Օգտագործեք միայն հետեւյալ կերպարները A-Z, a-z, 0-9, -';

// Validations when sending mails
$lang['error_no_recipients'] = 'Սխալ: Դուք պետք է ունենա առնվազն մեկ հասցեատեր.';
$lang['error_compose_invalid_mail1_s'] = 'Սխալ: Այս e-mail հասցեն կարծես անվավեր';
$lang['error_compose_invalid_mail1_p'] = 'Սխալ: Այս e-mail հասցեներ կարծես անվավեր';
$lang['error_compose_invalid_mail2_s'] = 'Ստուգեք e-mail հասցեն, նախքան resending այս նամակը.';
$lang['error_compose_invalid_mail2_p'] = 'Ընտրեք ձեր հասցեները առաջ resending այս նամակը.';

// Confirmation of delete
$lang['confirm_delete'] = 'Դուք իսկապես ցանկանում եք ջնջել այս հաղորդագրությունը (եր).';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[առանց վերնագիր]';
$lang['no_sender_text'] = '[Ուղարկողի անհայտ]';
$lang['no_recipient_text'] = '[Ստացողի անհայտ]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Ոչ բավարար տարածք ձեր ներարկղ լրացնի այս գործողությունը \ n ջնջել որոշ հաղորդագրությունները շարունակելու';
$lang['quota_usage_info'] = 'Սահմանը սահմանը';
$lang['quota_usage_used'] = 'Նոր';
$lang['quota_usage_of'] = 'եւ';
$lang['quota_usage_avail'] = 'մատչելի';

// Menu
$lang['messages_mnu'] = 'Inbox';
$lang['read_menu'] = 'Կարդալ E-Mail (ներ)';
$lang['compose_mnu'] = 'գրել E-Mail';
$lang['refresh_mnu'] = 'Թարմացնել';
$lang['folders_mnu'] = 'Թղթապանակներ';
$lang['search_mnu'] = 'Որոնել';
$lang['address_mnu'] = 'Հասցեների գրքույկ';
$lang['empty_trash_mnu'] = 'Դատարկ թափոն';
$lang['prefs_mnu'] = 'Preferences';
$lang['logoff_mnu'] = 'Ելք';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original Message --------';
$lang['reply_from_hea'] = 'From';
$lang['reply_to_hea'] = 'To:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'ամսաթիվը:';
$lang['reply_subject_hea'] = 'Թեմա.';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Value';

// [Folders]
$lang['fld_name_hea'] = 'Folder';
$lang['fld_messages_hea'] = 'Հաղորդագրություններ';
$lang['fld_size_hea'] = 'Size';
$lang['fld_empty_hea'] = 'Դատարկ';
$lang['fld_delete_hea'] = 'Ջնջել';
$lang['fld_total'] = 'Ընդհանուր';
$lang['fld_make_new'] = 'Ստեղծել նոր թղթապանակ';
$lang['folders_to'] = 'թղթապանակների';

// [MessageList]
$lang['messages_to'] = 'Հաղորդագրություններ';
$lang['no_messages'] = 'Ոչ մի նոր հաղորդագրությունները Ձեր';
$lang['delete_selected_mnu'] = 'Ջնջել';
$lang['move_selected_mnu'] = 'Տեղափոխել';
$lang['mark_selected_mnu'] = 'Նշել որպես ընթերցված';
$lang['unmark_selected_mnu'] = 'Նշել որպես չընթերցված';
$lang['move_selected_to_trash_mnu'] = 'Տեղափոխել Trash';


$lang['delete_mnu'] = 'Ջնջել';
$lang['move_mnu'] = 'Տեղափոխել';
$lang['subject_hea'] = 'Թեմա.';
$lang['from_hea'] = 'From';
$lang['to_hea'] = 'To:';
$lang['date_hea'] = 'ամսաթիվը:';
$lang['size_hea'] = 'Size';
$lang['have_spam'] = 'Դուք պետք Spam (ստուգել սպամի թղթապանակ)';

$lang['msg_you_have'] = 'Դուք պետք է';
$lang['msg_message'] = 'հաղորդագրությունը';
$lang['msg_messages'] = 'հաղորդագրությունները';

$lang['msg_more_unread'] = 'չընթերցված';
$lang['msg_one_unread'] = 'չընթերցված';
$lang['msg_none_unread'] = 'ոչ կարդալ';
$lang['msg_in_the_folder'] = 'թղթապանակում';


// [Login]
$lang['lgn_title'] = 'Մուտք';
$lang['lgn_welcome_msg'] = 'Բարի, խնդրում ենք մուտք գործել Ձեր հաշիվը';
$lang['lng_user_email'] = 'Էլ-փոստ';
$lang['lng_user_name'] = 'Մականուն';
$lang['lng_user_pwd'] = 'Գաղտնաբառ.';
$lang['lng_server'] = 'Սերվերի';
$lang['lng_theme'] = 'Theme';
$lang['lng_language'] = 'Language';
$lang['lng_login_btn'] = 'Մուտք &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'պետք է թույլատրվեն cookies';
$lang['lng_cookie_not_valid'] = 'Cookie Security ստուգել չհաջողվեց';

// [Newmessage]

$lang['newmsg_title'] = 'Խմբագրել փոստով';

$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc';
$lang['subject_hea'] = 'Թեմա.';
$lang['address_tip'] = 'From հասցեագրքից';

$lang['attach_hea'] = 'Հավելված';
$lang['attch_add_new'] = 'Կցել նոր ֆայլ';
$lang['attch_name_hea'] = 'անվանումը:';
$lang['attch_size'] = 'Size';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Ջնջել';
$lang['attch_no_hea'] = 'Ոչ հավելվածները';

$lang['add_signature'] = 'Ավելացնել ստորագրությունը';
$lang['send_text'] = 'Ուղարկել';

$lang['result_error'] = 'Այն հնարավոր չէր ուղարկել այս էլեկտրոնային փոստով';
$lang['result_success'] = 'Այս e-mail է ուղարկվել';
$lang['nav_continue'] = '&lt;&lt; Շարունակել &gt;&gt; ';
$lang['nav_back'] = 'Վերադառնալ';

$lang['up_title'] = 'Ավելացնել ֆայլ';
$lang['up_information_text'] = 'Ընտրեք ֆայլը';
$lang['up_button_text'] = 'կցել ֆայլը';

$lang['require_receipt'] = 'Վերադառնալ ստացում';

$lang['priority_text'] = 'Priority';
$lang['priority_low'] = 'Ցածր';
$lang['priority_normal'] = 'Նորմալ';
$lang['priority_high'] = 'High';

// [Preferences]
$lang['prf_title'] = 'Preferences';
$lang['prf_general_title'] = 'Ընդհանուր տեղեկություններ';
$lang['prf_name'] = 'անվանումը:';
$lang['prf_reply_to'] = 'Պատասխանել';
$lang['prf_time_zone'] = 'Ժամային գոտի.';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Եթե դուք <b> ջնջել </ b> հաղորդագրություն, տեղափոխել այն.';
$lang['prf_save_only_read'] = 'Պահպանել միայն <b> կարդալ հաղորդագրությունները </ b> է';
$lang['prf_empty_on_exit'] = '<b> Դատարկ </ b> թափոն թղթապանակը, երբ դուք դուրս գալ համակարգից';
$lang['prf_empty_spam_on_exit'] = '<b> Դատարկ </ b> սպամի թղթապանակ, երբ դուք դուրս գալ համակարգից';
$lang['prf_unmark_read_on_exit'] = 'Դուք փնտրել էք կարդալ հաղորդագրությունները որպես չընթերցված, երբ դուք դուրս գալ համակարգից';
$lang['prf_sent_title'] = 'հղել նյութեր';
$lang['prf_save_sent'] = 'Պահպանել <b> ուղարկված հաղորդագրությունները </ b> է';
$lang['prf_messages_title'] = 'Հաղորդագրություններ';
$lang['prf_page_limit'] = 'Առավելագույն թվով Հաղորդագրությունների մեկ էջում';
$lang['prf_signature_title'] = 'Ստորագրություն';
$lang['prf_signature'] = 'Գրեք ձեր ստորագրությունը';
$lang['prf_auto_add_sign'] = 'Ավելացնել ձեր ստորագրությունը բոլոր ելքային հաղորդագրությունները';
$lang['prf_save_button'] = 'Պահպանել Preferences';
$lang['prf_display_images'] = 'Ցուցադրել կցված պատկերներ';
$lang['prf_default_editor_mode'] = 'Կանխորոշված ​​խմբագրել ռեժիմում';
$lang['prf_default_editor_mode_text'] = '«Plain տեքստը"';
$lang['prf_default_editor_mode_html'] = '"Advanced HTML խմբագրիչի"';
$lang['prf_time_to_refesh'] = 'ավտոմատ ստուգել նոր փոստով (րոպե)';
$lang['prf_spam_level'] = 'SPAM զգայունության (0 = Հաշմանդամների, 1 = շատ մեծ է, 9 = Very Low)';
$lang['prf_auto_require_receipt'] = 'Անհրաժեշտ է կարդալ անդորրագիրը լռակյաց';
$lang['prf_keep_on_server'] = 'Պահպանեք email սերվերի - ոչ տեղական թղթապանակների';

$lang['prf_msg_saved'] = 'Preferences պահպանվել';

// filters
$lang['filter_title'] = 'Filters';

$lang['filter_new'] = 'Ստեղծել զտիչ';
$lang['filter_desc'] = 'Ընտրեք որոնման չափանիշներին ու գործողությունների համար մուտքային հաղորդագրությունները';
$lang['filter_list'] = 'Ընթացիկ զտիչներ';

$lang['filter_field_from'] = 'From';
$lang['filter_field_to'] = 'To';
$lang['filter_field_subject'] = 'Թեմա.';
$lang['filter_field_header'] = 'Վերնագրի';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Տեղափոխել';
$lang['filter_type_delete'] = 'Ջնջել';
$lang['filter_type_mark'] = 'Նշել կարդալ';

$lang['filter_add'] = 'Ավելացնել զտիչ';
$lang['filter_delete'] = 'Ջնջել';
$lang['filter_delete_selected'] = 'Ջնջել ընտրված ֆիլտրերը';

$lang['filter_field'] = 'Զտել դաշտ';
$lang['filter_match'] = 'Որոնել';
$lang['filter_type'] = 'Action';
$lang['filter_folder'] = 'Այս թղթապանակը';

$lang['filter_msg_nofilters'] = 'Ոչ ֆիլտրեր մատչելի.';
$lang['filter_msg_added'] = 'Filter ավելացրեց';
$lang['filter_msg_deleted'] = 'Filter ջնջվել';


// [Catch]
$lang['ctc_title'] = 'Ավելացնել Հասցեների գրքույկ';
$lang['ctc_information'] = 'Միայն թե էլեկտրոնային նամակների, որոնք չեն հասցեագրքից';
$lang['ctc_name'] = 'անվանումը:';
$lang['ctc_email'] = 'Էլ-փոստ';
$lang['ctc_no_address'] = 'Ոչ հասցեն մատչելի';
$lang['ctc_close'] = 'Close';
$lang['ctc_save'] = 'Պահպանել';

// [Readmsg]
$lang['next_mnu'] = 'Հաջորդը';
$lang['previous_mnu'] = 'Այս';
$lang['back_mnu'] = 'Վերադառնալ';
$lang['reply_mnu'] = 'Պատասխանել';
$lang['reply_all_mnu'] = 'Պատասխանել բոլորին';
$lang['forward_mnu'] = 'Փոխանցել';
$lang['headers_mnu'] = 'Վերնագրի';
$lang['move_mnu'] = 'Տեղափոխել';
$lang['move_to_trash_mnu'] = 'Տեղափոխել Trash';
$lang['delete_mnu'] = 'Ջնջել';
$lang['print_mnu'] = 'Print';
$lang['download_mnu'] = 'Բեռնել';

$lang['from_hea'] = 'From';
$lang['to_hea'] = 'To:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'ամսաթիվը:';
$lang['subject_hea'] = 'Թեմա.';
$lang['attach_hea'] = 'Հավելված';

$lang['attch_name_hea'] = 'անվանումը:';
$lang['attch_force_hea'] = 'Բեռնել';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Size';
$lang['catch_address'] = 'Ավելացնել Հասցեների գրքույկ';
$lang['block_address'] = 'Արգելափակել հասցե';

// [Search]
$lang['sch_title'] = 'Որոնել';
$lang['sch_information_text'] = 'Գրեք մի արտահայտություն կամ բառը, որ դուք փնտրում: Բաժին Միայն կարդալ հաղորդագրությունները կլինի փնտրում.';
$lang['sch_button_text'] = 'Որոնել &gt; &gt;';
$lang['sch_subject_hea'] = 'Թեմա.';
$lang['sch_from_hea'] = 'From';
$lang['sch_date_hea'] = 'ամսաթիվը';
$lang['sch_body_hea'] = 'Հաղորդագրություն Body';
$lang['sch_folder_hea'] = 'Folder';
$lang['sch_no_results'] = 'Ոչ հաղորդագրությունները համապատասխանող ձեր չափանիշներին են գտնվել';

// [QuickAddress]
$lang['qad_title'] = 'Հասցեների գրքույկ';
$lang['qad_select_address'] = 'Ընտրեք կոնտակտ';
$lang['qad_to'] = 'To';
$lang['qad_cc'] = 'Cc:';
$lang['qad_bcc'] = 'Նաեւ';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Հասցեների գրքույկ';
$lang['adr_name'] = 'անվանումը:';
$lang['adr_email'] = 'Էլ-փոստ';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'City';
$lang['adr_state'] = 'պետական';
$lang['adr_work'] = 'աշխատանք';
$lang['adr_back'] = 'Վերադառնալ';
$lang['adr_save'] = 'Պահպանել';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Բջջային';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'անվանումը:';
$lang['adr_email_hea'] = 'Էլ-փոստ';
$lang['adr_edit_hea'] = 'Խմբագրել';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'Ջնջել';
$lang['adr_new_entry'] = 'Նոր կոնտակտային';

$lang['addr_saved'] = 'Կապը արդեն պահպանվել';
$lang['addr_added'] = 'Կապը ավելացված';
$lang['addr_deleted'] = 'Կապը ջնջվել է';


// [BlockSender]
$lang['blk_title'] = 'Արգելափակել ուղարկողի';
$lang['blk_information'] = 'Միայն թե էլեկտրոնային նամակների, որոնք չեն զտիչ դեռեւս';
$lang['blk_email'] = 'Էլ-փոստ';
$lang['blk_no_address'] = 'Ոչ հասցեն մատչելի';
$lang['blk_close'] = 'Close';
$lang['blk_save'] = 'Պահպանել';

// [Event]
$lang['evt_title'] = 'Օրացույց իրադարձություն';
$lang['evt_save'] = 'Պահպանել';
$lang['evt_delete'] = 'Ջնջել';
$lang['evt_stop'] = 'Stop ժամանակ';
$lang['evt_start'] = 'Սկիզբ ժամանակ';

