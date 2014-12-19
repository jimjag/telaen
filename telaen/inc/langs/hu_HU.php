<?php
/*
 * Hungarian (Magyar) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%y/%m/%d %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-2';

// User-friendly names to system folders
$lang['inbox_extended'] = '…rkezett';
$lang['sent_extended'] = 'Elk¸ldˆtt';
$lang['trash_extended'] = 'Kuka';
$lang['spam_extended'] = 'Spam';
$lang['drafts_extended'] = 'Vázlatok';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Elızı';
$lang['next_text'] = 'Kˆvetkezı';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = 'Nem siker¸lt a POP szerverhez kapcsolÛd·s.';
$lang['error_retrieving'] = 'Az ¸zenet nem lett letˆltve.';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = 'V·ratlan hiba tˆrtÈnt. LÈpj kapcsolatba az adminisztr·torral.';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Hib·s bejegyzÈs - csak A-Z, 0-9, .- Ès szÛkˆz karaktereket haszn·lj';

// Validations when sending mails
$lang['error_no_recipients'] = 'Adj meg egy e-mail cÌmet!';
$lang['error_compose_invalid_mail1_s'] = 'Hib·s e-mail cÌm';
$lang['error_compose_invalid_mail1_p'] = 'Hib·s e-mail cÌm';
$lang['error_compose_invalid_mail2_s'] = 'Ellenırizd mielıtt elk¸ldˆd';
$lang['error_compose_invalid_mail2_p'] = 'Ellenırizd mielıtt elk¸ldˆd';

// Confirmation of delete
$lang['confirm_delete'] = 'ValÛban tˆrˆlni akarod ezt az ¸zenetet?';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[nincs t·rgy]';
$lang['no_sender_text'] = '[ismeretlen]';
$lang['no_recipient_text'] = '[nincs tˆrzse]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'A t·rhelyed betelt. Tˆrˆld a rÈgi ¸zeneteid a beÈrkezett ¸zenetek mapp·bÛl Ès prÛb·ld ˙jra!';
$lang['quota_usage_info'] = 'T·rhely haszn·lat';
$lang['quota_usage_used'] = 'quota_usage_of					= foglalt az engedÈlyezett';
$lang['quota_usage_of'] = 'of';
$lang['quota_usage_avail'] = '-bÛl';

// Menu
$lang['messages_mnu'] = '…rkezett';
$lang['read_menu'] = 'Levelek olvas·sa';
$lang['compose_mnu'] = 'LevÈl Ìr·sa';
$lang['refresh_mnu'] = 'FrissÌtÈs';
$lang['folders_mnu'] = 'Mapp·k';
$lang['search_mnu'] = 'KeresÈs';
$lang['address_mnu'] = 'CÌmek';
$lang['empty_trash_mnu'] = 'Kuka ¸rÌtÈse';
$lang['prefs_mnu'] = 'Be·llÌt·sok';
$lang['logoff_mnu'] = 'KijelentkezÈs';

// Reply
$lang['reply_prefix'] = 'RE:';
$lang['forward_prefix'] = 'FW:';
$lang['reply_delimiter'] = '--------- Eredeti ¸zenet --------';
$lang['reply_from_hea'] = 'K¸ldı:';
$lang['reply_to_hea'] = 'CÌmzett:';
$lang['reply_cc_hea'] = 'M·solatot kap:';
$lang['reply_date_hea'] = 'D·tum:';
$lang['reply_subject_hea'] = 'T·rgy:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Kulcs';
$lang['value_hea'] = '…rtÈk';

// [Folders]
$lang['fld_name_hea'] = 'Mapp·k';
$lang['fld_messages_hea'] = '‹zenetek';
$lang['fld_size_hea'] = 'MÈret';
$lang['fld_empty_hea'] = 'Ki¸rÌtÈs';
$lang['fld_delete_hea'] = 'TˆrlÈs';
$lang['fld_total'] = '÷sszesen:';
$lang['fld_make_new'] = '⁄j mappa';
$lang['folders_to'] = 'Mapp·k';

// [MessageList]
$lang['messages_to'] = '‹zenetek';
$lang['no_messages'] = 'Nincs ¸zenet a kˆvetkezı mapp·ban:';
$lang['delete_selected_mnu'] = 'Kijelˆlt ¸zenetek tˆrlÈse';
$lang['move_selected_mnu'] = 'Kijelˆlt ¸zenetek ·thelyezÈse';
$lang['mark_selected_mnu'] = 'MegjelˆlÈs olvasottkÈnt';
$lang['unmark_selected_mnu'] = 'MegjelˆlÈs olvasatlankÈnt';
$lang['move_selected_to_trash_mnu'] = 'Kijelˆlt ¸zenetek ·thelyezÈse a Kuk·ba';


$lang['delete_mnu'] = 'TˆrlÈs';
$lang['move_mnu'] = '¡thelyez';
$lang['subject_hea'] = 'T·rgy:';
$lang['from_hea'] = 'K¸ldı:';
$lang['to_hea'] = 'Cimzett:';
$lang['date_hea'] = 'D·tum:';
$lang['size_hea'] = 'MÈret';
$lang['have_spam'] = '÷nnek spam levele Èrkezett (tekintse meg Spam mapp·j·t)';

$lang['msg_you_have'] = 'msg_message					= ¸zeneted van';
$lang['msg_message'] = 'message';
$lang['msg_messages'] = '¸zeneted van';

$lang['msg_more_unread'] = 'olvasatlan';
$lang['msg_one_unread'] = 'olvasatlan';
$lang['msg_none_unread'] = 'nincs olvasatlan';
$lang['msg_in_the_folder'] = 'a kˆvetkezı mapp·ban:';


// [Login]
$lang['lgn_title'] = 'BejelentkezÈs';
$lang['lgn_welcome_msg'] = '‹dv. Ird be a sz¸ksÈges inform·ciÛkat:';
$lang['lng_user_email'] = 'E-mail';
$lang['lng_user_name'] = 'Felhaszn·lÛnÈv';
$lang['lng_user_pwd'] = 'JelszÛ';
$lang['lng_server'] = 'Kiszolg·lÛ';
$lang['lng_theme'] = 'StÌlus';
$lang['lng_language'] = 'Nyelv';
$lang['lng_login_btn'] = 'BelÈpÈs &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'A s¸tiket engedÈlyeznie kell';
$lang['lng_cookie_not_valid'] = 'S¸tik biztons·gi ellenırzÈse sikertelen';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'Cimzett:';
$lang['cc_hea'] = 'M·solatot kap:';
$lang['bcc_hea'] = 'Rejtett m·solatot kap:';
$lang['subject_hea'] = 'T·rgy:';
$lang['address_tip'] = 'CÌmlista';

$lang['attach_hea'] = 'Csatolt f·jl:';
$lang['attch_add_new'] = 'Csatolt f·jl hozz·ad·sa';
$lang['attch_name_hea'] = 'NÈv';
$lang['attch_size'] = 'MÈret';
$lang['attch_type_hea'] = 'TÌpus';
$lang['attch_dele_hea'] = 'TˆrlÈs';
$lang['attch_no_hea'] = 'Nincs csatolt ·llom·ny!';

$lang['add_signature'] = 'Al·Ìr·s hozz·ad·sa';
$lang['send_text'] = 'K¸ldÈs';

$lang['result_error'] = 'Hiba, az ¸zenet nem lett elk¸ldve';
$lang['result_success'] = 'Az ¸zenet sikeresen el lett k¸ldve!';
$lang['nav_continue'] = 'Folytat·s';
$lang['nav_back'] = 'Vissza';

$lang['up_title'] = 'Csatolt f·jl hozz·ad·sa';
$lang['up_information_text'] = 'Kiv·laszt';
$lang['up_button_text'] = 'Csatol';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Priorit·s';
$lang['priority_low'] = 'Nem s¸rgıs';
$lang['priority_normal'] = '¡tlagos';
$lang['priority_high'] = 'S¸rgıs';

// [Preferences]
$lang['prf_title'] = 'Be·llÌt·sok';
$lang['prf_general_title'] = 'SzemÈlyes adatok';
$lang['prf_name'] = 'NÈv';
$lang['prf_reply_to'] = 'V·lasz cÌm';
$lang['prf_time_zone'] = 'IdızÛna';
$lang['prf_trash_title'] = 'Kuka';
$lang['prf_save_to_trash'] = 'A <b>Tˆrˆlt</b> ¸zenetek ker¸ljenek a kˆvetkezı mapp·ba: ';
$lang['prf_save_only_read'] = 'Az <b>olvasott</b> ¸zenetek mentÈse a kˆvetkezı mapp·ba: ';
$lang['prf_empty_on_exit'] = '<b>Kuka</b> ¸rÌtÈse kilÈpÈsnÈl';
$lang['prf_empty_spam_on_exit'] = 'Spam mappa <b>¸rÌtÈse</b> kilÈpÈskor';
$lang['prf_unmark_read_on_exit'] = '<b>Olvasott</b> ¸zenetek <b>olvasatlanra</b> ·llÌt·sa kilÈpÈskor';
$lang['prf_sent_title'] = 'Elk¸ldˆtt ¸zenetek';
$lang['prf_save_sent'] = 'Az <b>elk¸ldˆtt</b> ¸zenetek mentÈse a kˆvetkezı mapp·ba:';
$lang['prf_messages_title'] = '‹zenetek';
$lang['prf_page_limit'] = 'MegjelenÌtett ¸zenetek sz·ma';
$lang['prf_signature_title'] = 'Al·Ìr·s';
$lang['prf_signature'] = 'SzemÈlyes al·Ìr·s';
$lang['prf_auto_add_sign'] = 'Automatikus al·Ìr·s-hozz·ad·s';
$lang['prf_save_button'] = 'MentÈs';
$lang['prf_display_images'] = 'Csatolt kÈpek automatikus megjelenÌtÈse';
$lang['prf_default_editor_mode'] = 'Szerkesztı tÌpusa';
$lang['prf_default_editor_mode_text'] = '"Sima szˆveg"';
$lang['prf_default_editor_mode_html'] = '"HTML szerkesztı"';
$lang['prf_time_to_refesh'] = 'BeÈrkezett ¸zenetek automatikus frissÌtÈse (perc)';
$lang['prf_spam_level'] = 'SPAM érzékenység (0 = letiltva, 1 = nagyon magas, 9 = nagyon alacsony)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default'; // FIXME: need translation
$lang['prf_keep_on_server'] = 'Tartsa e-mail szerver - nincs helyi mappák';

$lang['prf_msg_saved'] = 'Beállítások mentve';

// filters
$lang['filter_title'] = 'Filters';

$lang['filter_new'] = 'Hozzon létre egy szűrőt ';
$lang['filter_desc'] = 'Válassza ki a keresési feltételeket és az akció a bejövő üzenetek';
$lang['filter_list'] = 'Aktuális szűrők';

$lang['filter_field_from'] = 'A';
$lang['filter_field_to'] = 'A';
$lang['filter_field_subject'] = 'Tárgy';
$lang['filter_field_header'] = 'Fejléc';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Törlés';
$lang['filter_type_mark'] = 'Mark olvasni';

$lang['filter_add'] = 'Új szűrő';
$lang['filter_delete'] = 'Törlés';
$lang['filter_delete_selected'] = 'Törlés kiválasztott szűrő ';

$lang['filter_field'] = 'Filter terepen ';
$lang['filter_match'] = 'Keresés';
$lang['filter_type'] = 'Action';
$lang['filter_folder'] = 'Destination folder';

$lang['filter_msg_nofilters'] = 'Nem szűrők állnak. ';
$lang['filter_msg_added'] = 'Filter hozzá';
$lang['filter_msg_deleted'] = 'Filter törölve';

// [Catch]
$lang['ctc_title'] = '˙j cÌmek';
$lang['ctc_information'] = 'Csak azok a cÌmek jelenÌtıdnek meg, amelyek mÈg nincsenek a cÌmlist·ban.';
$lang['ctc_name'] = 'NÈv';
$lang['ctc_email'] = 'E-mail';
$lang['ctc_no_address'] = 'Nincs cÌm	';
$lang['ctc_close'] = 'Bez·r';
$lang['ctc_save'] = 'MentÈs';

// [Readmsg]
$lang['next_mnu'] = 'Kˆvetkezı';
$lang['previous_mnu'] = 'Elızı';
$lang['back_mnu'] = 'Vissza';
$lang['reply_mnu'] = 'V·lasz';
$lang['reply_all_mnu'] = 'V·lasz mindenkinek';
$lang['forward_mnu'] = 'Tov·bbk¸ldÈs';
$lang['headers_mnu'] = 'FejlÈc';
$lang['move_mnu'] = '¡thelyez';
$lang['move_to_trash_mnu'] = 'Kuk·ba helyezÈs';
$lang['delete_mnu'] = 'TˆrlÈs';
$lang['print_mnu'] = 'Nyomtat·s';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'K¸ldı:';
$lang['to_hea'] = 'Cimzett:';
$lang['cc_hea'] = 'M·solatot kap:';
$lang['date_hea'] = 'D·tum:';
$lang['subject_hea'] = 'T·rgy:';
$lang['attach_hea'] = 'Csatolt f·jl:';

$lang['attch_name_hea'] = 'NÈv';
$lang['attch_force_hea'] = 'LetˆltÈs';
$lang['attch_type_hea'] = 'TÌpus';
$lang['attch_size_hea'] = 'MÈret';
$lang['catch_address'] = 'K¸ldı hozz·ad·sa a CÌmlist·hoz';
$lang['block_address'] = 'CÌm blokkol·sa';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Keresendı szÛ, vagy kifejezÈs megad·sa a...';
$lang['sch_button_text'] = 'Keres &gt;&gt;';
$lang['sch_subject_hea'] = 'LevÈl t·rgy·ban';
$lang['sch_from_hea'] = 'K¸ldı cÌmÈben';
$lang['sch_date_hea'] = 'D·tum';
$lang['sch_body_hea'] = 'LevÈl szˆvegÈben';
$lang['sch_folder_hea'] = 'Mappa';
$lang['sch_no_results'] = 'Nincs tal·lat';

// [QuickAddress]
$lang['qad_title'] = 'V·lassz cimzettet';
$lang['qad_select_address'] = 'V·lassz cÌmet';
$lang['qad_to'] = 'CÌmzett';
$lang['qad_cc'] = 'M·solatot kap';
$lang['qad_bcc'] = 'Rejtett m·solatot kap';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'CÌmek';
$lang['adr_name'] = 'NÈv';
$lang['adr_email'] = 'E-mail';
$lang['adr_street'] = 'Utca';
$lang['adr_city'] = 'V·ros';
$lang['adr_state'] = 'Megye';
$lang['adr_work'] = 'Foglalkoz·s';
$lang['adr_back'] = 'Vissza';
$lang['adr_save'] = 'MentÈs';
$lang['adr_phone'] = 'Phone';
$lang['adr_cell'] = 'Cell';
$lang['adr_note'] = 'Notes';

// list
$lang['adr_name_hea'] = 'NÈv';
$lang['adr_email_hea'] = 'E-Mail';
$lang['adr_edit_hea'] = 'SzerkesztÈs';
$lang['adr_expo_hea'] = 'Export';
$lang['adr_dele_hea'] = 'TˆrlÈs';
$lang['adr_new_entry'] = '˙j bejegyzÈs';

$lang['addr_saved'] = 'a cÌm sikeresen elmentve';
$lang['addr_added'] = 'a cÌm sikeresen hozz·adva';
$lang['addr_deleted'] = 'a cÌm tˆrˆlve';


// [BlockSender]
$lang['blk_title'] = 'K¸ldı blokkol·sa';
$lang['blk_information'] = 'Csak azokat a leveleket mutassa, amik nincsenek mÈg kisz˚rve';
$lang['blk_email'] = 'E-mail';
$lang['blk_no_address'] = 'Nincs megadott cÌm';
$lang['blk_close'] = 'Bez·r';
$lang['blk_save'] = 'Ment';

// [Event]
$lang['evt_title'] = 'Esemény';
$lang['evt_delete'] = 'TˆrlÈs';
$lang['evt_stop'] = 'Állj ideje';
$lang['evt_start'] = 'Start time'; // FIXME: need translation

