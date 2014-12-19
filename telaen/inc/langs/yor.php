<?php
/*
 * Yoruba (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Apo-iwọle';
$lang['sent_extended'] = 'firanšẹ awọn ohun kan';
$lang['trash_extended'] = 'Ile ile folda';
$lang['spam_extended'] = 'idoti folda';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Táa';
$lang['next_text'] = 'Next';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Lapapọ';

// Mail Server Errors
$lang['err_login_msg'] = 'Login aṣiṣe';
$lang['err_system_msg'] = 'System aṣiṣe';
$lang['error_login'] = 'Jọwọ ṣayẹwo rẹ olumulo tabi aṣínà ati ki o gbiyanju lẹẹkansi';
$lang['error_connect'] = 'aṣiṣe pọ si awọn olupin';
$lang['error_retrieving'] = 'ašiše si sunmọ rẹ ifiranṣẹ, Apo-iwọle rẹ ti yi pada';
$lang['error_session_expired'] = 'rẹ igba ti wa ni pari, jọwọ buwolu lẹẹkansi';
$lang['error_other'] = 'System ikuna, jọwọ kan si nẹtiwọki rẹ administrator';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Apejẹ folda orukọ - Lo nikan awọn wọnyi ohun kikọ AZ, AZ, 0-9, ati ki o -';

// Validations when sending mails
$lang['error_no_recipients'] = 'aṣiṣe: O gbọdọ ni ni o kere kan olugba!';
$lang['error_compose_invalid_mail1_s'] = 'aṣiṣe: e-mail yi adirẹsi dabi lati wa ni invalid';
$lang['error_compose_invalid_mail1_p'] = 'aṣiṣe: e-mail yi adirẹsi dabi lati wa ni invalid';
$lang['error_compose_invalid_mail2_s'] = 'Ṣayẹwo awọn e-mail adirẹsi imeeli yi ki o to resending.';
$lang['error_compose_invalid_mail2_p'] = 'Ṣayẹwo rẹ ṣaaju ki o to adirẹsi imeeli resending yi.';

// Confirmation of delete
$lang['confirm_delete'] = 'Ṣe o fẹ lati pa gan yi ifiranṣẹ (s)?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Ko si koko]';
$lang['no_sender_text'] = '[Olu aimọ]';
$lang['no_recipient_text'] = '[olugba aimọ]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Ko to aaye rẹ ninu apo-iwọle lati pari yi igbese \nPlease pa diẹ ninu awọn ifiranṣẹ lati tẹsiwaju';
$lang['quota_usage_info'] = 'meeli iye to';
$lang['quota_usage_used'] = 'lo';
$lang['quota_usage_of'] = 'ti';
$lang['quota_usage_avail'] = 'wa';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// Menu
$lang['messages_mnu'] = 'Apo-iwọle';
$lang['read_menu'] = 'Ka E-Mail (s)';
$lang['compose_mnu'] = 'Kọ E-Mail';
$lang['refresh_mnu'] = 'Sọ';
$lang['folders_mnu'] = 'awọn folda';
$lang['search_mnu'] = 'àwárí';
$lang['address_mnu'] = 'Adirẹsi iwe';
$lang['empty_trash_mnu'] = 'ṣofo idọti';
$lang['prefs_mnu'] = 'saju';
$lang['logoff_mnu'] = 'Jade';

// Reply
$lang['reply_prefix'] = 'Tun:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- Original ifiranṣẹ --------';
$lang['reply_from_hea'] = 'Lati:';
$lang['reply_to_hea'] = 'Lati:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] = 'Ọjọ:';
$lang['reply_subject_hea'] = 'Koko:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Key';
$lang['value_hea'] = 'Iye';

// [Folders]
$lang['fld_name_hea'] = 'Folda';
$lang['fld_messages_hea'] = 'ifiranṣẹ';
$lang['fld_size_hea'] = 'Iwon';
$lang['fld_empty_hea'] = 'sofo';
$lang['fld_delete_hea'] = 'Pa';
$lang['fld_total'] = 'Lapapọ:';
$lang['fld_make_new'] = 'Ṣẹda titun folda';
$lang['folders_to'] = 'awọn folda lati';

// [MessageList]
$lang['messages_to'] = 'Awọn ifiranṣẹ to';
$lang['no_messages'] = 'Ko si ifiranṣẹ titun ninu rẹ';
$lang['delete_selected_mnu'] = 'Parẹ';
$lang['move_selected_mnu'] = 'Gbe si';
$lang['mark_selected_mnu'] = 'Marku bi ka';
$lang['unmark_selected_mnu'] = 'Marku bi aika';
$lang['move_selected_to_trash_mnu'] = 'Gbe si Ile ile';


$lang['delete_mnu'] = 'Parẹ';
$lang['move_mnu'] = 'Gbe si';
$lang['subject_hea'] = 'Koko:';
$lang['from_hea'] = 'Lati:';
$lang['to_hea'] = 'Lati:';
$lang['date_hea'] = 'Ọjọ:';
$lang['size_hea'] = 'Iwon';
$lang['have_spam'] = 'O ni idoti (ṣayẹwo idoti folda)';

$lang['msg_you_have'] = 'O ni';
$lang['msg_message'] = 'ifiranṣẹ';
$lang['msg_messages'] = 'awọn ifiranṣẹ';

$lang['msg_more_unread'] = 'aika';
$lang['msg_one_unread'] = 'aika';
$lang['msg_none_unread'] = 'kò lati ka';
$lang['msg_in_the_folder'] = 'ni awọn folda';


// [Login]
$lang['lgn_title'] = 'Login'; // FIXME: need translation
$lang['lgn_welcome_msg'] = 'Kaabo, jọwọ buwolu sinu àkọọlẹ rẹ';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Orukọ olumulo';
$lang['lng_user_pwd'] = 'Ọrọigbaniwọle';
$lang['lng_server'] = 'Server'; // FIXME: need translation
$lang['lng_theme'] = 'Akori';
$lang['lng_language'] = 'Ede';
$lang['lng_login_btn'] = 'Login &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies gbọdọ wa ni sise';
$lang['lng_cookie_not_valid'] = 'kukisi Aabo Ṣayẹwo kùnà';

// [Newmessage]

$lang['newmsg_title'] = 'ṣajọ mail';

$lang['to_hea'] = 'Lati:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'Bcc:';
$lang['subject_hea'] = 'Koko:';
$lang['address_tip'] = 'Lati adirẹsi iwe';

$lang['attach_hea'] = 'Asomọ:';
$lang['attch_add_new'] = 'So titun faili';
$lang['attch_name_hea'] = 'Name'; // FIXME: need translation
$lang['attch_size'] = 'Iwon';
$lang['attch_type_hea'] = 'Iru';
$lang['attch_dele_hea'] = 'Pa';
$lang['attch_no_hea'] = 'Ko si asomọ';

$lang['add_signature'] = 'Fi Ibuwọlu';
$lang['send_text'] = 'Fi';

$lang['result_error'] = 'O je ko ṣee ṣe lati fi yi e-mail';
$lang['result_success'] = 'e-mail yi ti a ti rán';
$lang['nav_continue'] = '&lt;&lt; Tẹsiwaju &gt;&gt;';
$lang['nav_back'] = 'Back'; // FIXME: need translation

$lang['up_title'] = 'Fi faili';
$lang['up_information_text'] = 'Yan faili';
$lang['up_button_text'] = 'So faili';

$lang['require_receipt'] = 'pada ọjà';

$lang['priority_text'] = 'pataki';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'Deede';
$lang['priority_high'] = 'gaju';

// [Preferences]
$lang['prf_title'] = 'saju';
$lang['prf_general_title'] = 'Gbogbogbo alaye';
$lang['prf_name'] = 'Name';
$lang['prf_reply_to'] = 'Esi to';
$lang['prf_time_zone'] = 'Time ibi kan';
$lang['prf_trash_title'] = 'Ile ile';
$lang['prf_save_to_trash'] = 'Nigbati o <b> pa </b> ifiranṣẹ kan, o si gbe';
$lang['prf_save_only_read'] = 'Fi nikan <b> ka awọn ifiranṣẹ </b> ni';
$lang['prf_empty_on_exit'] = '<b> sofo </ b> idọti folda nigba ti o logout';
$lang['prf_empty_spam_on_exit'] = '<b> sofo </ b> idoti folda nigba ti o logout';
$lang['prf_unmark_read_on_exit'] = 'Tun ka awọn ifiranṣẹ bi aika nigbati o logout';
$lang['prf_sent_title'] = 'firanšẹ awọn ohun kan';
$lang['prf_save_sent'] = 'Fi <b> rán awọn ifiranṣẹ </ b> ni';
$lang['prf_messages_title'] = 'ifiranṣẹ';
$lang['prf_page_limit'] = 'Iwọn nọmba ti awọn ifiranṣẹ fun iwe';
$lang['prf_signature_title'] = 'Ibuwọlu';
$lang['prf_signature'] = 'Kọ rẹ Ibuwọlu';
$lang['prf_auto_add_sign'] = 'Fi kun rẹ Ibuwọlu si gbogbo awọn ti njade awọn ifiranṣẹ';
$lang['prf_save_button'] = 'Fi-saju';
$lang['prf_display_images'] = 'Show so images';
$lang['prf_default_editor_mode'] = 'aiyipada edit mode';
$lang['prf_default_editor_mode_text'] = '"Itele ọrọ"';
$lang['prf_default_editor_mode_html'] = '"ni ilọsiwaju HTML olootu"';
$lang['prf_time_to_refesh'] = 'adase ṣayẹwo fun awọn titun mail (iṣẹju)';
$lang['prf_spam_level'] = 'àwúrúju ifamọ (0 = alaabo, 1 = gan Ga, 9 = gan Low)';
$lang['prf_auto_require_receipt'] = 'Béèrè ka ọjà nipa aiyipada';

$lang['prf_msg_saved'] = 'saju ti o ti fipamọ';

// filters
$lang['filter_title'] = 'Ajọ';

$lang['filter_new'] = 'Ṣẹda kan àlẹmọ';
$lang['filter_desc'] = 'Yan awọn àwárí àwárí mu ati awọn iṣẹ fun awọn ti nwọle awọn ifiranṣẹ';
$lang['filter_list'] = 'ti isiyi Ajọ';

$lang['filter_field_from'] = 'Lati';
$lang['filter_field_to'] = 'Lati';
$lang['filter_field_subject'] = 'Koko';
$lang['filter_field_header'] = 'akọsori';
$lang['filter_field_body'] = 'Ara';

$lang['filter_type_move'] = 'Gbe';
$lang['filter_type_delete'] = 'Pa';
$lang['filter_type_mark'] = 'Marku ka';

$lang['filter_add'] = 'Fi àlẹmọ';
$lang['filter_delete'] = 'Pa';
$lang['filter_delete_selected'] = 'Pa ti a ti yan Ajọ';

$lang['filter_field'] = 'Àlẹmọ lori aaye';
$lang['filter_match'] = 'Search fun';
$lang['filter_type'] = 'Action'; // FIXME: need translation
$lang['filter_folder'] = 'nlo folda';

$lang['filter_msg_nofilters'] = 'Ko si Ajọ wa.';
$lang['filter_msg_added'] = 'Àlẹmọ fi kun';
$lang['filter_msg_deleted'] = 'Àlẹmọ paarẹ';


// [Catch]
$lang['ctc_title'] = 'Fikun lati koju iwe';
$lang['ctc_information'] = 'nikan fihan e-leta ti o wa ni ko si ni awọn adirẹsi iwe';
$lang['ctc_name'] = 'Name'; // FIXME: need translation
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Ko si adirẹsi wa';
$lang['ctc_close'] = 'Close'; // FIXME: need translation
$lang['ctc_save'] = 'Fipamọ';

// [Readmsg]
$lang['next_mnu'] = 'Next'; // FIXME: need translation
$lang['previous_mnu'] = 'Táa';
$lang['back_mnu'] = 'Back'; // FIXME: need translation
$lang['reply_mnu'] = 'Fesi';
$lang['reply_all_mnu'] = 'Esi si gbogbo';
$lang['forward_mnu'] = 'Dari';
$lang['headers_mnu'] = 'akọsori';
$lang['move_mnu'] = 'Gbe si';
$lang['move_to_trash_mnu'] = 'Gbe si Ile ile';
$lang['delete_mnu'] = 'Parẹ';
$lang['print_mnu'] = 'Print'; // FIXME: need translation
$lang['download_mnu'] = 'Download'; // FIXME: need translation

$lang['from_hea'] = 'Lati:';
$lang['to_hea'] = 'Lati:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] = 'Ọjọ:';
$lang['subject_hea'] = 'Koko:';
$lang['attach_hea'] = 'Asomọ:';

$lang['attch_name_hea'] = 'Name'; // FIXME: need translation
$lang['attch_force_hea'] = 'Download'; // FIXME: need translation
$lang['attch_type_hea'] = 'Iru';
$lang['attch_size_hea'] = 'Iwon';
$lang['catch_address'] = 'Fikun lati koju iwe';
$lang['block_address'] = 'Block adirẹsi';

// [Search]
$lang['sch_title'] = 'àwárí';
$lang['sch_information_text'] = 'Kọ kan tabi gbolohun kan ti ọrọ ti o ti wa ni nwa fun. <br> nikan ka awọn ifiranṣẹ yoo wa ni wá.';
$lang['sch_button_text'] = 'àwárí &gt;&gt;';
$lang['sch_subject_hea'] = 'Koko';
$lang['sch_from_hea'] = 'Lati';
$lang['sch_date_hea'] = 'Ọjọ';
$lang['sch_body_hea'] = 'ifiranṣẹ Ara';
$lang['sch_folder_hea'] = 'Folda';
$lang['sch_no_results'] = 'Ko si awọn ifiranṣẹ tuntun rẹ àwárí mu ti a ti ri';

// [QuickAddress]
$lang['qad_title'] = 'Adirẹsi iwe';
$lang['qad_select_address'] = 'Yan olubasọrọ kan';
$lang['qad_to'] = 'Lati';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'Bcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Adirẹsi iwe';
$lang['adr_name'] = 'Name'; // FIXME: need translation
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Street'; // FIXME: need translation
$lang['adr_city'] = 'City'; // FIXME: need translation
$lang['adr_state'] = 'State'; // FIXME: need translation
$lang['adr_work'] = 'Ise';
$lang['adr_back'] = 'Back'; // FIXME: need translation
$lang['adr_save'] = 'Fipamọ';
$lang['adr_phone'] = 'foonu';
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'akọsilẹ';

// list
$lang['adr_name_hea'] = 'Name'; // FIXME: need translation
$lang['adr_email_hea'] = 'E-mail';
$lang['adr_edit_hea'] = 'Ṣatunkọ';
$lang['adr_expo_hea'] = 'si ilẹ';
$lang['adr_dele_hea'] = 'Pa';
$lang['adr_new_entry'] = 'Olubasọrọ titun';

$lang['addr_saved'] = 'Awọn olubasọrọ ti a ti ni ti o ti fipamọ';
$lang['addr_added'] = 'Awọn olubasọrọ ti a ti ni fi kun';
$lang['addr_deleted'] = 'Awọn olubasọrọ ti a ti ni paarẹ';


// [BlockSender]
$lang['blk_title'] = 'Block Olu';
$lang['blk_information'] = 'nikan fihan e-leta ti o wa ni ko si ni awọn àlẹmọ sibẹsibẹ';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Ko si adirẹsi wa';
$lang['blk_close'] = 'Close'; // FIXME: need translation
$lang['blk_save'] = 'Fipamọ';

// [Event]
$lang['evt_title'] = 'Kalẹnda ti oyan';
$lang['evt_save'] = 'Fipamọ';
$lang['evt_delete'] = 'Pa';
$lang['evt_stop'] = 'Duro akoko';
$lang['evt_start'] = 'Bẹrẹ akoko';

