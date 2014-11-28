<? Php
/ *
  * Estats Units Anglès (llista canònica i fraseig)
  * /

$lang = array();

// Noms fàcils d'usar per a les carpetes del sistema
$lang['inbox_extended'] = 'Safata d\'entrada';
$lang['sent_extended'] = 'Elements enviats';
$lang['trash_extended'] 'Paperera';
$lang['spam_extended'] = 'carpeta Spam';

// Textos de navegació
$lang['pages_text'] = 'Pàgines';
$lang['first_text'] = 'Primer';
$lang['previous_text'] = 'Anterior';
$lang['next_text'] = 'Següent';
$lang['last_text'] = 'Darrer';
$lang['total_text'] = 'total';

// Els errors del servidor de correu
$lang['err_login_msg'] = 'Error d\'ccés';
$lang['err_system_msg'] = 'Error de sistema';
$lang['error_login'] = 'Si us plau, marqui el seu nom d\'suari o contrasenya, i torneu a provar ';
$lang['error_connect'] = 'Ha fallat la connexió amb el servidor';
$lang['error_retrieving'] = 'Error en obtenir els seus missatges, la safata d\'ntrada ha canviat ';
$lang['error_session_expired'] = 'La vostra sessió ha caducat, si us plau entra de nou ';
$lang['error_other'] 'Sistema de fracàs, si us plau poseu-vos en contacte amb l\'dministrador de xarxa';

// Nom no vàlid de bústia
$lang['ERROR_INVALID_NAME'] = 'nom de la carpeta no vàlida - Utilitzeu només els següents caràcters A-Z, a=z, 0-9, i -';

// Validacions en enviar mails
$lang['error_no_recipients'] = 'Error: Vostè ha de tenir almenys un destinatari';
$lang['error_compose_invalid_mail1_s'] = 'Error: Aquesta adreça de correu electrònic sembla no vàlid';
$lang['error_compose_invalid_mail1_p'] = 'Error: Aquesta adreça de correu electrònic sembla ser invàlid';
$lang['error_compose_invalid_mail2_s'] = 'Comproveu l\'dreça de correu electrònic abans de tornar a enviar aquest correu electrònic.';
$lang['error_compose_invalid_mail2_p'] = 'Comprova les adreces abans de tornar a enviar aquest correu electrònic.';

// La confirmació d'eliminació
$lang['confirm_delete'] = '? Realment vols eliminar aquest missatge (s)';

// Si el missatge no té un tema o remitent
$lang['no_subject_text'] = '[sense assumpte]';
$lang['no_sender_text'] = '[desconegut remitent]';
$lang['no_recipient_text'] = '[Destinatari desconegut]';

// Si s'ha superat el límit de quota
$lang['quota_exceeded'] = 'No hi ha prou espai a la safata d\'ntrada per completar aquesta acció \ nSi us plau, elimineu alguns missatges per continuar ';
$lang['quota_usage_info'] = 'Límit de quota';
$lang['quota_usage_used'] = 'utilitza';
$lang['quota_usage_of'] = 'de';
$lang['quota_usage_avail'] = 'disponible';

//
// Format de data
//% D = dies,% m = mes,% i = anys,% H = hores,% M = minuts
// Per obtenir una llista completa, consulteu http://www.php.net/strftime
//
$lang['date_format'] = '%m/%d/%y %H:%M';

// charset
$lang['default_char_set'] = 'iso-8859-1';

// Menu
$lang['messages_mnu'] = 'Safata d\'ntrada';
$lang['read_menu'] = 'Llegir E-Mail (s)';
$lang['compose_mnu'] = 'Escriure un correu electrònic';
$lang['refresh_mnu'] = 'Actualitzar';
$lang['folders_mnu'] = 'Carpetes';
$lang['search_mnu'] = 'Cerca';
$lang['address_mnu'] = 'Llibreta d\'dreces';
$lang['empty_trash_mnu'] = 'Buidar paperera ';
$lang['prefs_mnu'] = 'Preferències';
$lang['logoff_mnu'] = 'Sortir';

// Respondre
$lang['reply_prefix'] 'Re:';
$lang['forward_prefix'] = 'Fw:';
$lang['reply_delimiter'] = '--------- -------- Missatge original ';
$lang['reply_from_hea'] = 'D:';
$lang['reply_to_hea'] = 'Per:';
$lang['reply_cc_hea'] = 'Cc:';
$lang['reply_date_hea'] 'Data:';
$lang['reply_subject_hea'] = 'Assumpte:';
// Fet


// Específica de la pàgina vars

// [Encapçalats]
$lang['key_hea'] = 'clau';
$lang['value_hea'] = 'valor';

// [Carpetes]
$lang['fld_name_hea'] = 'Carpeta';
$lang['fld_messages_hea'] = 'Missatges';
$lang['fld_size_hea'] = 'Tamany';
$lang['fld_empty_hea'] = 'Empty';
$lang['fld_delete_hea'] = 'Eliminar';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'Crear una carpeta ';
$lang['folders_to'] = 'Carpetes a';

// [MessageList]
$lang['messages_to'] = 'Missatges a';
$lang['no_messages'] = 'No hi ha nous missatges en el seu';
$lang['delete_selected_mnu'] = 'Eliminar';
$lang['move_selected_mnu'] 'Mou a';
$lang['mark_selected_mnu'] = 'Marca com a llegit ';
$lang['unmark_selected_mnu'] = 'Marca com a no llegit';
$lang['move_selected_to_trash_mnu'] 'Mou a la paperera';


$lang['delete_mnu'] = 'Eliminar';
$lang['move_mnu'] 'Mou a';
$lang['subject_hea'] = 'Assumpte';
$lang['from_hea'] = 'Des de';
$lang['to_hea'] = 'Per';
$lang['date_hea'] = 'Data';
$lang['size_hea'] = 'Tamany';
$lang['have_spam'] = 'Vostè té Spam (revisar la carpeta de Spam)';

$lang['msg_you_have'] = 'Ha';
$lang['msg_message'] = 'missatge';
$lang['msg_messages'] 'missatges';

$lang['msg_more_unread'] = 'no llegit';
$lang['msg_one_unread'] = 'no llegit';
$lang['msg_none_unread'] = 'none llegir';
$lang['msg_in_the_folder'] = 'a la carpeta';


// [Entrada]
$lang['lgn_title'] = 'Entrar';
$lang['lgn_welcome_msg'] = 'Benvingut, si us plau entra al teu compte ';
$lang['lng_user_email'] = 'Correu electrònic';
$lang['lng_user_name'] = 'nom d\'suari';
$lang['lng_user_pwd'] = 'contrasenya';
$lang['lng_server'] = 'servidor';
$lang['lng_theme'] = 'Tema';
$lang['lng_language'] = 'Idioma';
$lang['lng_login_btn'] = 'Entra & gt; & gt;';
$lang['lng_cookie_not_enabled'] = 'galetes han d\'star habilitades';
$lang['lng_cookie_not_valid'] = 'galetes Security Check Failed ';

// [NewMessage]

$lang['newmsg_title'] = 'Crea missatge';

$lang['to_hea'] = 'Per:';
$lang['cc_hea'] = 'Cc:';
$lang['bcc_hea'] = 'CCO:';
$lang['subject_hea'] = 'Assumpte:';
$lang['address_tip'] = 'Des de la llibreta d\'dreces ';

$lang['attach_hea'] = 'Annex: ';
$lang['attch_add_new'] = 'Adjuntar nou arxiu';
$lang['attch_name_hea'] = 'Nom';
$lang['attch_size'] = 'Tamany';
$lang['attch_type_hea'] = 'Tipus';
$lang['attch_dele_hea'] = 'Eliminar';
$lang['attch_no_hea'] = 'No hi ha arxius adjunts';

$lang['add_signature'] = 'Afegir signatura ';
$lang['send_text'] = 'Enviar';

$lang['result_error'] = 'No es pot enviar aquest e-mail';
$lang['result_success'] = 'Aquest missatge ha estat enviat';
$lang['nav_continue'] = '& lt; & lt; Continuar & gt; & gt; ';
$lang['nav_back'] = 'Volver';

$lang['up_title'] = 'Afegir arxiu';
$lang['up_information_text'] = 'Seleccionar arxiu';
$lang['up_button_text'] = 'Adjuntar arxiu';

$lang['require_receipt'] = 'justificant de recepció';

$lang['priority_text'] = 'prioritat';
$lang['priority_low'] = 'Low';
$lang['priority_normal'] = 'normal';
$lang['priority_high'] = 'Alt';

// [Preferències]
$lang['prf_title'] = 'Preferències';
$lang['prf_general_title'] = 'Informació general';
$lang['prf_name'] = 'Nom';
$lang['prf_reply_to'] = 'Respondre';
$lang['prf_time_zone'] = 'zona horària';
$lang['prf_trash_title'] = 'Trash';
$lang['prf_save_to_trash'] = 'Quan <b> Eliminar </ b> un missatge, moure a';
$lang['prf_save_only_read'] = 'Desa només <b> llegir missatges </ b> al';
$lang['prf_empty_on_exit'] = '<b> buit <b /> Carpeta d\'scombraries quan tancar la sessió ';
$lang['prf_empty_spam_on_exit'] = '<b> buit <b /> carpeta Spam quan tancar la sessió ';
$lang['prf_unmark_read_on_exit'] = 'Reset llegir missatges com a no llegits quan es tanca la sessió ';
$lang['prf_sent_title'] = 'Elements enviats';
$lang['prf_save_sent'] = 'Desa <b> enviar missatges </ b> al';
$lang['prf_messages_title'] = 'Missatges';
$lang['prf_page_limit'] = 'El nombre màxim de missatges per pàgina';
$lang['prf_signature_title'] = 'Signatura';
$lang['prf_signature'] = 'Introduïu el firma ';
$lang['prf_auto_add_sign'] = 'Afegir seva signatura a tots els missatges sortints ';
$lang['prf_save_button'] = 'Desa les preferències';
$lang['prf_display_images'] = 'Mostra adjunta imatges';
$lang['prf_default_editor_mode'] = 'Per defecte el mode d\'dició';
$lang['prf_default_editor_mode_text'] = '"Text sense format"';
$lang['prf_default_editor_mode_html'] = '"editor HTML avançat"';
$lang['prf_time_to_refesh'] = 'Comprova automàticament si hi ha correu nou (minuts)';
$lang['prf_spam_level'] = 'SPAM sensibilitat (0 = Desactivat, 1 = Molt alta, 9 = Molt Baixa)';
$lang['prf_auto_require_receipt'] = 'Requerir rebut llegit per defecte';

$lang['prf_msg_saved'] = 'Preferències salvar';

// filtres
$lang['filter_title'] = 'Restriccions';

$lang['filter_new'] = 'Crea un filtre ';
$lang['filter_desc'] = 'Seleccioneu els criteris de cerca i l\'cció per als missatges entrants';
$lang['filter_list'] = 'Restriccions actuals';

$lang['filter_field_from'] = 'Des de';
$lang['filter_field_to'] = 'Per';
$lang['filter_field_subject'] = 'Assumpte';
$lang['filter_field_header'] = 'capçalera';
$lang['filter_field_body'] = 'cos';

$lang['filter_type_move'] = 'Move';
$lang['filter_type_delete'] = 'Eliminar';
$lang['filter_type_mark'] = 'Marca com a llegit ';

$lang['filter_add'] = 'Afegir filtre';
$lang['filter_delete'] = 'Eliminar';
$lang['filter_delete_selected'] = 'Esborrar filtres seleccionats';

$lang['filter_field'] 'Filtre en camp';
$lang['filter_match'] = 'Cerca';
$lang['filter_type'] = 'Acció';
$lang['filter_folder'] = 'Carpeta de destinació ';

$lang['filter_msg_nofilters'] = 'No hi ha filtres disponibles.';
$lang['filter_msg_added'] = 'Filtra afegit ';
$lang['filter_msg_deleted'] = 'Filter elimina';


// [Captura]
$lang['ctc_title'] = 'Afegir a Llibreta d\'dreces ';
$lang['ctc_information'] = 'Només mostra els correus electrònics que no són a la llibreta d\'dreces ';
$lang['ctc_name'] = 'Nom';
$lang['ctc_email'] = 'Correu electrònic';
$lang['ctc_no_address'] = 'No hi ha cap adreça disponible ';
$lang['ctc_close'] = 'Tancar';
$lang['ctc_save'] = 'Desa';

// [Readmsg]
$lang['next_mnu'] = 'Següent';
$lang['previous_mnu'] = 'Anterior';
$lang['back_mnu'] = 'Volver';
$lang['reply_mnu'] = 'Respondre';
$lang['reply_all_mnu'] = 'Respondre a tots ';
$lang['forward_mnu'] = 'Forward';
$lang['headers_mnu'] = 'capçalera';
$lang['move_mnu'] 'Mou a';
$lang['move_to_trash_mnu'] 'Mou a la paperera';
$lang['delete_mnu'] = 'Eliminar';
$lang['print_mnu'] = 'Imprimir';
$lang['download_mnu'] = 'Descarregar';

$lang['from_hea'] = 'D:';
$lang['to_hea'] = 'Per:';
$lang['cc_hea'] = 'Cc:';
$lang['date_hea'] 'Data:';
$lang['subject_hea'] = 'Assumpte:';
$lang['attach_hea'] = 'Annex: ';

$lang['attch_name_hea'] = 'Nom';
$lang['attch_force_hea'] = 'Descarregar';
$lang['attch_type_hea'] = 'Tipus';
$lang['attch_size_hea'] = 'Tamany';
$lang['catch_address'] = 'Afegir a Llibreta d\'dreces ';
$lang['block_address'] = 'Bloca direcció';

// [Cerca]
$lang['sch_title'] = 'Cerca';
$lang['sch_information_text'] = '.. Escriure una frase o una paraula que vostè està buscant <br> només lectura es buscaran els missatges';
$lang['sch_button_text'] = 'Search & gt; & gt;';
$lang['sch_subject_hea'] = 'Assumpte';
$lang['sch_from_hea'] = 'Des de';
$lang['sch_date_hea'] = 'Data';
$lang['sch_body_hea'] = 'Cos del missatge';
$lang['sch_folder_hea'] = 'Carpeta';
$lang['sch_no_results'] = 'No hi ha missatges que coincideixin amb els seus criteris s\'han trobat';

// [QuickAddress]
$lang['qad_title'] = 'Llibreta d\'dreces';
$lang['qad_select_address'] = 'Seleccioneu un contacte';
$lang['qad_to'] = 'Per';
$lang['qad_cc'] = 'Cc';
$lang['qad_bcc'] = 'CCO';

// [Llibreta d'adreces]
// Edita / pantalla
$lang['adr_title'] = 'Llibreta d\'dreces';
$lang['adr_name'] = 'Nom';
$lang['adr_email'] = 'Correu electrònic';
$lang['adr_street'] = 'Street';
$lang['adr_city'] = 'City';
$lang['adr_state'] = 'Estat';
$lang['adr_work'] = 'treball';
$lang['adr_back'] = 'Volver';
$lang['adr_save'] = 'Desa';
$lang['adr_phone'] = 'Telèfon';
$lang['adr_cell'] = 'telèfon';
$lang['adr_note'] = 'Notes';

// Llista
$lang['adr_name_hea'] = 'Nom';
$lang['adr_email_hea'] = 'Correu electrònic';
$lang['adr_edit_hea'] = 'Edita';
$lang['adr_expo_hea'] = 'Exporta';
$lang['adr_dele_hea'] = 'Eliminar';
$lang['adr_new_entry'] = 'Nou contacte';

$lang['addr_saved'] = 'El contacte s\'ha guardat ';
$lang['addr_added'] = 'El contacte s\'ha afegit ';
$lang['addr_deleted'] = 'El contacte ha estat eliminat ';


// [BlockSender]
$lang['blk_title'] = 'Bloca remitent';
$lang['blk_information'] = 'Només mostra els correus electrònics que no estan encara en el filtre';
$lang['blk_email'] = 'Correu electrònic';
$lang['blk_no_address'] = 'No hi ha cap adreça disponible ';
$lang['blk_close'] = 'Tancar';
$lang['blk_save'] = 'Desa';

// [Esdeveniment]
$lang['evt_title'] 'Calendari d\'sdeveniments';
$lang['evt_save'] = 'Desa';
$lang['evt_delete'] = 'Eliminar';
$lang['evt_stop'] = 'Atura el temps ';
$lang['evt_start'] = 'Hora d\'nici ';
