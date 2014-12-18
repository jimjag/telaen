<?php
/*
 * Russian (Русский) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Âõîäÿùèå';
$lang['sent_extended'] = 'Îòïðàâëåííûå';
$lang['trash_extended'] = 'Óäàë¸ííûå';
$lang['spam_extended'] = 'Spam folder'; // FIXME: need translation

// Navigation texts
$lang['pages_text'] = 'Pages'; // FIXME: need translation
$lang['first_text'] = 'First'; // FIXME: need translation
$lang['previous_text'] = 'Íàçàä';
$lang['next_text'] = 'Äàëåå';
$lang['last_text'] = 'Last'; // FIXME: need translation
$lang['total_text'] = 'Total'; // FIXME: need translation

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = 'Îøèáêà ïîäêëþ÷åíèÿ ê ïî÷òîâîìó ñåðâåðó';
$lang['error_retrieving'] = 'Îøèáêà ïîëó÷åíèÿ ïèñüìà - Ïàïêà âõîäÿùèå èçìåíèëàñü';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = 'Îáùèé ñáîé ñèñòåìû';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Íåïðàâèëüíîå èìÿ ïàïêè - Èñïîëüçóéòå òîëüêî ñèìâîëû À-Á, A-Z, 0-9, .- èëè ïðîáåëû';

// Validations when sending mails
$lang['error_no_recipients'] = 'Íåîáõîäèìî äëÿ íà÷àëà óêàçàòü ñâîé Email àäðåñ';
$lang['error_compose_invalid_mail1_s'] = 'Ýòîò Email àäðåñ íåâåðåí';
$lang['error_compose_invalid_mail1_p'] = 'Ýòè Email àäðåñà íåâåðíû';
$lang['error_compose_invalid_mail2_s'] = 'Âûáåðèòå Ñîçäàòü ñîîáùåíèå ïåðåä îòïðàâêîé';
$lang['error_compose_invalid_mail2_p'] = 'Âûáåðèòå Ñîçäàòü ñîîáùåíèå ïåðåä îòïðàâêîé';

// Confirmation of delete
$lang['confirm_delete'] = 'Âû äåéñòâèòåëüíî õîòèòå óäàëèòü ýòî ñîîáùåíèå?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Áåç òåìû]';
$lang['no_sender_text'] = '[Îòïðàâèòåëü íåèçâåñòåí]';
$lang['no_recipient_text'] = '[Ïîëó÷àòåëü íåèçâåñòåí]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Íå õâàòàåò ìåñòà â âàøåì ÿùèêå!\Ïîæàëóéñòà, óäàëèòå ÷àñòü ñîîáùåíèé, ÷òîáû ïðîäîëæèòü';
$lang['quota_usage_info'] = 'Ìåñòî â ÿùèêå';
$lang['quota_usage_used'] = 'Èñïîëüçîâàíî';
$lang['quota_usage_of'] = 'èç';
$lang['quota_usage_avail'] = 'äîñòóïíûõ';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'windows-1251';

// Menu
$lang['messages_mnu'] = 'Ñîîáùåíèÿ';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Íàïèñàòü';
$lang['refresh_mnu'] = 'Îáíîâèòü';
$lang['folders_mnu'] = 'Ïàïêè';
$lang['search_mnu'] = 'Ïîèñê';
$lang['address_mnu'] = 'Àäðåñíàÿ êíèãà';
$lang['empty_trash_mnu'] = 'Î÷èñòèòü êîðçèíó';
$lang['prefs_mnu'] = 'Íàñòðîéêè';
$lang['logoff_mnu'] = 'Âûõîä';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Îðèãèíàë ïèñüìà --------';
$lang['reply_from_hea'] = 'Îò:';
$lang['reply_to_hea'] = 'Äëÿ:';
$lang['reply_cc_hea'] = 'îïèÿ:';
$lang['reply_date_hea'] = 'Äàòà:';
$lang['reply_subject_hea'] = 'Òåìà:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'ëþ÷';
$lang['value_hea'] = 'Çíà÷åíèå';

// [Folders]
$lang['fld_name_hea'] = 'Ïàïêà';
$lang['fld_messages_hea'] = 'Ñîîáùåíèÿ';
$lang['fld_size_hea'] = 'Ðàçìåð';
$lang['fld_empty_hea'] = 'Î÷èñòèòü';
$lang['fld_delete_hea'] = 'Óäàëèòü';
$lang['fld_total'] = 'Èòîãî:';
$lang['fld_make_new'] = 'Ñîçäàòü ïàïêó';
$lang['folders_to'] = 'Ïàïêè';

// [MessageList]
$lang['messages_to'] = 'Ñîîáùåíèÿ ';
$lang['no_messages'] = 'Íåò íîâûõ ñîîáùåíèé â ïàïêå ';
$lang['delete_selected_mnu'] = 'Óäàëèòü îòìå÷åííûå';
$lang['move_selected_mnu'] = 'Ïåðåìåñòèòü îòìå÷åííûå â';
$lang['mark_selected_mnu'] = 'Mark as read'; // FIXME: need translation
$lang['unmark_selected_mnu'] = 'Mark as unread'; // FIXME: need translation
$lang['move_selected_to_trash_mnu'] = 'Move to Trash'; // FIXME: need translation


$lang['delete_mnu'] = 'Óäàëèòü';
$lang['move_mnu'] = 'Ïåðåìåñòèòü â';
$lang['subject_hea'] = 'Òåìà:';
$lang['from_hea'] = 'Îò:';
$lang['to_hea'] = 'Äëÿ:';
$lang['date_hea'] = 'Äàòà:';
$lang['size_hea'] = 'Ðàçìåð';
$lang['have_spam'] = 'You have Spam (check Spam folder)'; // FIXME: need translation

$lang['msg_you_have'] = 'Ó âàñ';
$lang['msg_message'] = 'ñîîáùåíèå';
$lang['msg_messages'] = 'ñîîáùåíèé';

$lang['msg_more_unread'] = 'íåïðî÷èòàííûõ';
$lang['msg_one_unread'] = 'íåïðî÷èòàíî';
$lang['msg_none_unread'] = 'íåïðî÷èòàííûõ íåò';
$lang['msg_in_the_folder'] = 'â ïàïêå';


// [Login]
$lang['lgn_title'] = 'Ëîãèí';
$lang['lgn_welcome_msg'] = 'Ââåäèòå âàøè Ëîãèí è ïàðîëü äëÿ äîñòóïà ê ïî÷òå';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Ëîãèí';
$lang['lng_user_pwd'] = 'Ïàðîëü';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'Òåìà';
$lang['lng_language'] = 'ßçûê';
$lang['lng_login_btn'] = 'Ëîãèí &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled'; // FIXME: need translation
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed'; // FIXME: need translation

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail'; // FIXME: need translation

$lang['to_hea'] = 'Äëÿ:';
$lang['cc_hea'] = 'îïèÿ:';
$lang['bcc_hea'] = 'îïèÿ 2:';
$lang['subject_hea'] = 'Òåìà:';
$lang['address_tip'] = 'Èç àäðåñíîé êíèãè';

$lang['attach_hea'] = 'Âëîæåíèå:';
$lang['attch_add_new'] = 'Äîáàâèòü íîâûé ôàéë';
$lang['attch_name_hea'] = 'Íàçâàíèå';
$lang['attch_size'] = 'Ðàçìåð';
$lang['attch_type_hea'] = 'Òèï';
$lang['attch_dele_hea'] = 'Óäàëèòü';
$lang['attch_no_hea'] = 'Íåò âëîæåíèé';

$lang['add_signature'] = 'Äîáàâèòü ïîäïèñü';
$lang['send_text'] = 'Îòïðàâèòü';

$lang['result_error'] = 'Íåâîçìîæíî îòïðàâèòü ïî÷òó';
$lang['result_success'] = 'Ïèñüìî óñïåøíî îòïðàâëåíî';
$lang['nav_continue'] = 'Ïðîäîëæèòü';
$lang['nav_back'] = 'Íàçàä';

$lang['up_title'] = 'Äîáàâèòü ôàéë';
$lang['up_information_text'] = 'Âûáðàòü ôàéë';
$lang['up_button_text'] = 'Îòïðàâèòü';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Ïðèîðèòåò';
$lang['priority_low'] = 'Íèçêèé';
$lang['priority_normal'] = 'Ñðåäíèé';
$lang['priority_high'] = 'Âûñîêèé';

// [Preferences]
$lang['prf_title'] = 'Íàñòðîéêè';
$lang['prf_general_title'] = 'Îñíîâíàÿ èíôîðìàöèÿ';
$lang['prf_name'] = 'Èìÿ';
$lang['prf_reply_to'] = 'Àäðåñ äëÿ îòâåòîâ';
$lang['prf_time_zone'] = 'Âðåìåííàÿ çîíà';
$lang['prf_trash_title'] = 'îðçèíà';
$lang['prf_save_to_trash'] = 'îãäà Âû <b>óäàëÿåòå</b> ñîîáùåíèÿ, ïîìåùàòü èç â ïàïêå ';
$lang['prf_save_only_read'] = 'Õðàíèòü òîëüêî <b>ïðî÷èòàííûå ñîîáùåíèÿ</b> â ïàïêå  ';
$lang['prf_empty_on_exit'] = '<b>Î÷èñòèòü</b> êîðçèíó ïðè âûõîäå èç ïðîãðàììû';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout'; // FIXME: need translation
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout'; // FIXME: need translation
$lang['prf_sent_title'] = 'Îòïðàâëåííûå';
$lang['prf_save_sent'] = 'Õðàíèòü <b>îòïðàâëÿåìûå ñîîáùåíèÿ</b> â ïàïêå  ';
$lang['prf_messages_title'] = 'Ñîîáùåíèÿ';
$lang['prf_page_limit'] = 'îëè÷åñòâî ñîîáùåíèé íà ñòðàíèöó';
$lang['prf_signature_title'] = 'Ïîäïèñü';
$lang['prf_signature'] = 'Çäåñü Âû ìîæåòå íàïèñàòü ñâîþ ïîäïèñü äëÿ îòïðàâëÿåìûõ ñîîáùåíèé';
$lang['prf_auto_add_sign'] = 'Äîáàâëÿòü Âàøó ïîäïèñü êî âñåì îïðàâëÿåìûì ñîîáùåíèÿì ';
$lang['prf_save_button'] = 'Ñîõðàíèòü';
$lang['prf_display_images'] = 'Ïîêàçûâàòü ïðèêðåïë¸ííûå èçîáðàæåíèÿ';
$lang['prf_default_editor_mode'] = 'Ðåæèì ðåäàêòèðîâàíèÿ';
$lang['prf_default_editor_mode_text'] = '"Ïðîñòîé òåêñòîâûé"';
$lang['prf_default_editor_mode_html'] = '"HTML ðåäàêòîð (Internet Explorer 5 èëè âûøå, èëè ñõîæèõ)"';
$lang['prf_time_to_refesh'] = 'Îáíîâëåíèå ïàïêè ñ ñîîáùåíèÿìè (â ìèíóòàõ)';
$lang['prf_spam_level'] = 'SPAM sensitivity (0 = Disabled, 1 = Very High, 9 = Very Low)'; // FIXME: need translation
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation

$lang['prf_msg_saved'] = 'Preferences saved'; // FIXME: need translation

// filters
$lang['filter_title'] = 'Filters'; // FIXME: need translation

$lang['filter_new'] = 'Create a filter';
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
$lang['ctc_title'] = 'Äîáàâèòü â àäðåñíóþ êíèãó';
$lang['ctc_information'] = 'Áóäóò ïîêàçàíû àäðåñà, çàïèñàííûå â àäðåñíóþ êíèãó';
$lang['ctc_name'] = 'Èìÿ';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Àäðåñà íåò';
$lang['ctc_close'] = 'Çàêðûòü';
$lang['ctc_save'] = 'Ñîõðàíèòü';

// [Readmsg]
$lang['next_mnu'] = 'Ñëåäóþùåå';
$lang['previous_mnu'] = 'Ïðåäûäóùåå';
$lang['back_mnu'] = 'Íàçàä';
$lang['reply_mnu'] = 'Îòâåòèòü';
$lang['reply_all_mnu'] = 'Îòâåòèòü âñåì';
$lang['forward_mnu'] = 'Ïåðåñëàòü';
$lang['headers_mnu'] = 'Çàãîëîâîê';
$lang['move_mnu'] = 'Ïåðåìåñòèòü â';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Óäàëèòü';
$lang['print_mnu'] = 'Ðàñïå÷àòàòü';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'Îò:';
$lang['to_hea'] = 'Äëÿ:';
$lang['cc_hea'] = 'îïèÿ:';
$lang['date_hea'] = 'Äàòà:';
$lang['subject_hea'] = 'Òåìà:';
$lang['attach_hea'] = 'Âëîæåíèå:';

$lang['attch_name_hea'] = 'Íàçâàíèå';
$lang['attch_force_hea'] = 'Ñêà÷àòü';
$lang['attch_type_hea'] = 'Òèï';
$lang['attch_size_hea'] = 'Ðàçìåð';
$lang['catch_address'] = 'Äîáàâèòü â àäðåñíóþ êíèãó';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Íàïèøèòå ôðàçó èëè ñëîâî, êîòîðîå Âû èùåòå.<br> Ïîèñê â òåëå ïèñüìà ïðîèçâîäèòñÿ òîëüêî, åñëè ïèñüìî ïðî÷èòàíî';
$lang['sch_button_text'] = 'Ïîèñê &gt;&gt;';
$lang['sch_subject_hea'] = 'Òåìà';
$lang['sch_from_hea'] = 'Îò';
$lang['sch_date_hea'] = 'Äàòà';
$lang['sch_body_hea'] = 'Ñîîáùåíèå';
$lang['sch_folder_hea'] = 'Ïàïêà';
$lang['sch_no_results'] = 'Ïîäõîäÿùèõ ïèñåì íå íàéäåíî';

// [QuickAddress]
$lang['qad_title'] = 'Àäðåñíàÿ êíèãà';
$lang['qad_select_address'] = 'Âûáåðèòå êîíòàêò';
$lang['qad_to'] = 'Äëÿ';
$lang['qad_cc'] = 'îïèÿ';
$lang['qad_bcc'] = 'îïèÿ 2 ';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Àäðåñíàÿ êíèãà';
$lang['adr_name'] = 'Èìÿ';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Àäðåñ';
$lang['adr_city'] = 'Ãîðîä';
$lang['adr_state'] = 'Ðàéîí';
$lang['adr_work'] = 'Ðàáîòà';
$lang['adr_back'] = 'Íàçàä';
$lang['adr_save'] = 'Ñîõðàíèòü';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'Èìÿ';
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Ðåäàêòèðîâàòü';
$lang['adr_expo_hea'] = 'Ýêñïîðòèðîâàòü';
$lang['adr_dele_hea'] = 'Óäàëèòü';
$lang['adr_new_entry'] = 'Íîâûé êîíòàêò';

$lang['addr_saved'] = 'îíòàêò ñîõðàí¸í';
$lang['addr_added'] = 'îíòàêò äîáàâëåí';
$lang['addr_deleted'] = 'îíòàêò óíè÷òîæåí';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // FIXME: need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'E-mail'; // FIXME: need translation
$lang['blk_no_address'] = 'No address available'; // FIXME: need translation
$lang['blk_close'] = 'Çàêðûòü';
$lang['blk_save'] = 'Ñîõðàíèòü';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'Ñîõðàíèòü';
$lang['evt_delete'] = 'Óäàëèòü';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

