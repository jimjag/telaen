<?php
/*
 * Japanese (日本語) (canonical list and phrasing)
 */

$lang = array();
//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '% m /% d /% y% H:% M';

// CharSet
$lang['default_char_set'] = 'UTF-8';

// User-friendly names to system folders
$lang['inbox_extended'] = '受信トレイ';
$lang['sent_extended'] = 'アイテムを送信済み';
$lang['trash_extended'] = 'ごみ箱フォルダを';
$lang['spam_extended'] = 'スパムフォルダ';
$lang['drafts_extended']= '下書き';

// Navigation texts
$lang['pages_text'] = 'ページ';
$lang['first_text'] = 'まず';
$lang['previous_text'] = '前';
$lang['next_text'] = '次のページ';
$lang['last_text'] = '最終';
$lang['total_text'] = '合計';

// Mail Server Errors
$lang['err_login_msg'] = 'ログインエラー';
$lang['err_system_msg'] = 'システムエラー';
$lang['error_login'] = 'ユーザ名またはパスワードを確認して、もう一度やり直してください';
$lang['error_connect'] = 'サーバーへの接続エラー';
$lang['error_retrieving'] = 'エラーあなたのメッセージを取得するには、受信トレイが変更された';
$lang['error_session_expired'] = 'あなたのセッションの有効期限が切れて、再度ログインしてください';
$lang['error_other'] = 'システム障害、ネットワーク管理者に連絡してください';

// Invalid name of mailbox
$lang['error_invalid_name'] = '無効なフォルダ名 - のみを使用し、以下の文字A-Z、a-z、0-9、および - ';

// Validations when sending mails
$lang['error_no_recipients'] = 'エラー：！あなたは少なくとも1人の受信者を持っている必要があります';
$lang['error_compose_invalid_mail1_s'] = 'エラー：このメールアドレスは無効であると思われる';
$lang['error_compose_invalid_mail1_p'] = 'エラー：このメールはアドレスが無効であると思われる';
$lang['error_compose_invalid_mail2_s'] = 'このメールを再送信する前に電子メールアドレスを確認してください。';
$lang['error_compose_invalid_mail2_p'] = 'このメールを再送信する前に、あなたのアドレスを確認してください。';

// Confirmation of delete
$lang['confirm_delete'] = '？あなたは本当にこのメッセージ（複数可）を削除しますか';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[いいえ件名]';
$lang['no_sender_text'] = '[送信者不明]';
$lang['no_recipient_text'] = '[不明な受信者]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'このアクションを完了するために、あなたの受信箱にはない十分なスペースが\しり続行するには、いくつかのメッセージを削除';
$lang['quota_usage_info'] = 'クォータ制限';
$lang['quota_usage_used'] = 'を使用';
$lang['quota_usage_of'] = 'の';
$lang['quota_usage_avail'] = '利用可能';

// Menu
$lang['messages_mnu'] = '受信トレイ';
$lang['read_menu'] = '読むEメール（S）';
$lang['compose_mnu'] = '書き込み済みE-Mail';
$lang['refresh_mnu'] = 'リフレッシュ';
$lang['folders_mnu'] = 'フォルダ';
$lang['search_mnu'] = '検索';
$lang['address_mnu'] = 'アドレス帳';
$lang['empty_trash_mnu'] = 'ゴミ箱を空にする';
$lang['prefs_mnu'] = '設定';
$lang['logoff_mnu'] = 'ログアウト';

// Reply
$lang['reply_prefix'] = '日時：';
$lang['forward_prefix'] = 'Fwは：';
$lang['reply_delimiter'] = '---------元のメッセージ--------';
$lang['reply_from_hea'] = 'から：';
$lang['reply_to_hea'] = 'へ：';
$lang['reply_cc_hea'] = 'Cc：に';
$lang['reply_date_hea'] = '日付：';
$lang['reply_subject_hea'] = '件名：';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'キー';
$lang['value_hea'] = '値';

// [Folders]
$lang['fld_name_hea'] = 'フォルダ';
$lang['fld_messages_hea'] = 'メッセージ';
$lang['fld_size_hea'] = 'サイズ';
$lang['fld_empty_hea'] = '空';
$lang['fld_delete_hea'] = '削除';
$lang['fld_total'] = '合計：';
$lang['fld_make_new'] = '新しいフォルダを作成し、';
$lang['folders_to'] = 'フォルダへの';

// [MessageList]
$lang['messages_to'] = 'メッセージにする';
$lang['no_messages'] = 'あなたのんの新しいメッセージ';
$lang['delete_selected_mnu'] = '削除';
$lang['move_selected_mnu'] = 'へ移動';
$lang['mark_selected_mnu'] = '既読に';
$lang['unmark_selected_mnu'] = '未読としてマーク';
$lang['move_selected_to_trash_mnu'] = 'ゴミ箱へ移動';


$lang['delete_mnu'] = '削除';
$lang['move_mnu'] = 'へ移動';
$lang['subject_hea'] = '件名：';
$lang['from_hea'] = 'から：';
$lang['to_hea'] = 'へ：';
$lang['date_hea'] = '日付：';
$lang['size_hea'] = 'サイズ';
$lang['have_spam'] = 'あなたがスパム（迷惑メールフォルダを確認）を持っている';

$lang['msg_you_have'] = 'あなたが持っている';
$lang['msg_message'] = 'メッセージ';
$lang['msg_messages'] = 'メッセージ';

$lang['msg_more_unread'] = '未読';
$lang['msg_one_unread'] = '未読';
$lang['msg_none_unread'] = '何も読まないために';
$lang['msg_in_the_folder'] = 'フォルダ内の';


// [Login]
$lang['lgn_title'] = 'ログイン';
$lang['lgn_welcome_msg'] = 'ようこそ、あなたのアカウントにログインしてください';
$lang['lng_user_email'] = 'メール';
$lang['lng_user_name'] = 'ユーザー名';
$lang['lng_user_pwd'] = 'パスワード';
$lang['lng_server'] = 'サーバ';
$lang['lng_theme'] = 'テーマ';
$lang['lng_language'] = '言語';
$lang['lng_login_btn'] = 'ログイン＆gt;＆gt; 8ここで';
$lang['lng_cookie_not_enabled'] = 'クッキーを有効にする必要があります';
$lang['lng_cookie_not_valid'] = 'クッキーセキュリティチェックに失敗しました';

// [Newmessage]

$lang['newmsg_title'] = 'メールを作成';

$lang['to_hea'] = 'へ：';
$lang['cc_hea'] = 'Cc：に';
$lang['bcc_hea'] = 'のBcc：';
$lang['subject_hea'] = '件名：';
$lang['address_tip'] = 'アドレス帳から';

$lang['attach_hea'] = '添付ファイル：';
$lang['attch_add_new'] = '新しいファイルを添付';
$lang['attch_name_hea'] = '名前';
$lang['attch_size'] = 'サイズ';
$lang['attch_type_hea'] = '種類';
$lang['attch_dele_hea'] = '削除';
$lang['attch_no_hea'] = 'いいえ添付ファイル';

$lang['add_signature'] = '署名を追加する';
$lang['send_text'] = '送信';

$lang['result_error'] = 'これは、この電子メールを送信することができませんでした';
$lang['result_success'] = 'このメールが送られてきた';
$lang['nav_continue'] = '＆LT;＆LT;続行＆gt;＆gt; 8ここで';
$lang['nav_back'] = '戻る';

$lang['up_title'] = 'ファイルを追加します。';
$lang['up_information_text'] = '選択したファイル';
$lang['up_button_text'] = 'ファイルを添付';

$lang['require_receipt'] = 'リターン領収書';

$lang['priority_text'] = '優先';
$lang['priority_low'] = 'ロー';
$lang['priority_normal'] = 'ノーマル';
$lang['priority_high'] = 'ハイ';

// [Preferences]
$lang['prf_title'] = '設定';
$lang['prf_general_title'] = '一般情報';
$lang['prf_name'] = '名前';
$lang['prf_reply_to'] = 'Reply to'; // FIXME: need translation
$lang['prf_time_zone'] = 'タイムゾーン';
$lang['prf_trash_title'] = 'ゴミ箱';
$lang['prf_save_to_trash'] = 'あなたは<b> </ b>のメッセージを削除すると、それへの移動';
$lang['prf_save_only_read'] = '保存のみ<B> </ B>内のメッセージをお読み';
$lang['prf_empty_on_exit'] = '<B>空の</ b>のごみ箱フォルダをあなたはログアウト時';
$lang['prf_empty_spam_on_exit'] = '<B>空の</ b>のスパムフォルダをあなたはログアウト時';
$lang['prf_unmark_read_on_exit'] = 'あなたは、ログアウト時に未読メッセージを読むのリセット';
$lang['prf_sent_title'] = '送信済みアイテム';
$lang['prf_save_sent'] = 'Save <b>sent messages</b> in the '; // FIXME: need translation
$lang['prf_messages_title'] = 'メッセージ';
$lang['prf_page_limit'] = 'ページあたりのメッセージの最大数';
$lang['prf_signature_title'] = '署名';
$lang['prf_signature'] = 'あなたの署名を書く';
$lang['prf_auto_add_sign'] = 'すべての送信メッセージに署名を追加します';
$lang['prf_save_button'] = '保存]';
$lang['prf_display_images'] = 'Show attached images'; // FIXME: need translation
$lang['prf_default_editor_mode'] = 'デフォルト編集モード';
$lang['prf_default_editor_mode_text'] = '"プレーンテキスト"';
$lang['prf_default_editor_mode_html'] = '"高度なHTMLエディタ"';
$lang['prf_time_to_refesh'] = '自動で新規メール（分）をチェックする';
$lang['prf_spam_level'] = 'スパム感度（0=無効、1=非常に高い、9=非常に低い）';
$lang['prf_auto_require_receipt'] = 'デフォルトで読み取り領収書が必要';
$lang['prf_keep_on_server'] = 'サーバー上で電子メールをおいてください - ローカルのフォルダを';

$lang['prf_msg_saved'] = '設定が保存';

// filters
$lang['filter_title'] = 'フィルタ';

$lang['filter_new'] = 'フィルタを作成します';
$lang['filter_desc'] = '着信メッセージの検索条件やアクションを選択してください';
$lang['filter_list'] = '現在のフィルタ';

$lang['filter_field_from'] = 'から';
$lang['filter_field_to'] = 'へ';
$lang['filter_field_subject'] = '件名';
$lang['filter_field_header'] = 'ヘッダ';
$lang['filter_field_body'] = 'ボディ';

$lang['filter_type_move'] = '移動';
$lang['filter_type_delete'] = '削除';
$lang['filter_type_mark'] = 'Mark read';  // FIXME: need translation

$lang['filter_add'] = 'フィルタを追加します。';
$lang['filter_delete'] = '削除';
$lang['filter_delete_selected'] = '選択したフィルタを削除する';

$lang['filter_field'] = 'フィールド上のフィルター';
$lang['filter_match'] = '検索';
$lang['filter_type'] = 'Action';  // FIXME: need translation
$lang['filter_folder'] = 'インストール先フォルダ';

$lang['filter_msg_nofilters'] = 'なしのフィルター。';
$lang['filter_msg_added'] = 'フィルタが追加された';
$lang['filter_msg_deleted'] = 'フィルタが削除された';


// [Catch]
$lang['ctc_title'] = 'アドレス帳に追加します';
$lang['ctc_information'] = 'Only shows e-mails that are not in the address book'; // FIXME: need translation
$lang['ctc_email'] = 'メール';
$lang['ctc_no_address'] = 'なしアドレス';
$lang['ctc_close'] = '閉じる';
$lang['ctc_save'] = '保存';

// [Readmsg]
$lang['next_mnu'] = '次のページ';
$lang['previous_mnu'] = '前';
$lang['back_mnu'] = '戻る';
$lang['reply_mnu'] = '返信';
$lang['reply_all_mnu'] = '全員に返信';
$lang['forward_mnu'] = 'フォワード';
$lang['headers_mnu'] = 'ヘッダ';
$lang['move_mnu'] = 'へ移動';
$lang['move_to_trash_mnu'] = 'ゴミ箱へ移動';
$lang['delete_mnu'] = '削除';
$lang['print_mnu'] = '印刷';
$lang['download_mnu'] = 'ダウンロード';

$lang['from_hea'] = 'から：';
$lang['to_hea'] = 'へ：';
$lang['cc_hea'] = 'Cc：に';
$lang['date_hea'] = '日付：';
$lang['subject_hea'] = '件名：';
$lang['attach_hea'] = '添付ファイル：';

$lang['attch_name_hea'] = '名前';
$lang['attch_force_hea'] = 'ダウンロード';
$lang['attch_type_hea'] = '種類';
$lang['attch_size_hea'] = 'サイズ';
$lang['catch_address'] = 'アドレス帳に追加します';
$lang['block_address'] = 'ブロックアドレス';

// [Search]
$lang['sch_title'] = '検索';
$lang['sch_information_text'] = '。。フレーズやあなたが探している単語を書くメッセージのみが検索されます読み<BR>';
$lang['sch_button_text'] = '検索＆gt;＆gt; 8ここで';
$lang['sch_subject_hea'] = '件名';
$lang['sch_from_hea'] = 'から';
$lang['sch_date_hea'] = '日付';
$lang['sch_body_hea'] = 'メッセージ本文';
$lang['sch_folder_hea'] = 'フォルダ';
$lang['sch_no_results'] = 'あなたの条件に一致するメッセージは見出されていない';

// [QuickAddress]
$lang['qad_title'] = 'アドレス帳';
$lang['qad_select_address'] = '連絡先を選択します';
$lang['qad_to'] = 'へ';
$lang['qad_cc'] = 'Ccを';
$lang['qad_bcc'] = 'のBcc';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'アドレス帳';
$lang['adr_name'] = '名前';
$lang['adr_email'] = 'メール';
$lang['adr_street'] = 'ストリート';
$lang['adr_city'] = '市';
$lang['adr_state'] = '国家';
$lang['adr_work'] = '仕事';
$lang['adr_back'] = '戻る';
$lang['adr_save'] = '保存';
$lang['adr_phone'] = '電話';
$lang['adr_cell'] = '細胞';
$lang['adr_note'] = 'メモ';

// list
$lang['adr_name_hea'] = '名前';
$lang['adr_email_hea'] = 'メール';
$lang['adr_edit_hea'] = '編集';
$lang['adr_expo_hea'] = 'エクスポート';
$lang['adr_dele_hea'] = '削除';
$lang['adr_new_entry'] = '新しい接触';

$lang['addr_saved'] = '接触が保存されました';
$lang['addr_added'] = '接点が追加されました';
$lang['addr_deleted'] = '接触が削除されました';


// [BlockSender]
$lang['blk_title'] = 'ブロック差出人';
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'メール';
$lang['blk_no_address'] = 'いいえアドレス利用可能な';
$lang['blk_close'] = '閉じる';
$lang['blk_save'] = '保存';

// [Event]
$lang['evt_title'] = 'カレンダーのイベントを';
$lang['evt_save'] = '保存';
$lang['evt_delete'] = '削除';
$lang['evt_stop'] = '時間を停止します';
$lang['evt_start'] = '開始時間';

