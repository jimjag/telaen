<?php
/*
 * French (FranÁais) (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'BoÓte de rÈception';
$lang['sent_extended'] = 'ElÈments envoyÈs';
$lang['trash_extended'] = 'Corbeille';
$lang['spam_extended'] = 'dossier Spam';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'PrÈcÈdent';
$lang['next_text'] = 'Suivant';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Veuillez vérifier votre Nom d\'utilisateur ou votre mot de passe, et réessayez';\
$lang['error_connect'] = 'Connexion au serveur impossible';
$lang['error_retrieving'] = 'Impossible de recevoir le message, d˚ aux modifications ';
$lang['error_session_expired'] = 'Votre session a expiré. Veuillez vous reconnecter';
$lang['error_other'] = 'Des erreurs sont survenues, veuillez contacter votre administrateur';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Nom de dossier invalide - Veuillez utiliser les caractËres suivants A-Z, 0-9, . - espace';

// Validations when sending mails
$lang['error_no_recipients'] = 'Aucun destinataire spÈcifiÈ';
$lang['error_compose_invalid_mail1_s'] = 'L\'adresse suivante semble invalide';
$lang['error_compose_invalid_mail1_p'] = 'Les adresses suivantes semblent invalides';
$lang['error_compose_invalid_mail2_s'] = 'Veuillez la vÈrifier avant l\'envoi du message';
$lang['error_compose_invalid_mail2_p'] = 'Veuillez les vÈrifier avant l\'envoi du message';

// Confirmation of delete
$lang['confirm_delete'] = 'Etes-vous s˚r de vouloir effacer ce message ? ';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Pas d\'objet]';
$lang['no_sender_text'] = '[Inconnu]';
$lang['no_recipient_text'] = '[Inconnu]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Espace insuffisant pour effectuer cette opÈration.\rVeuillez nettoyer les anciens messages et rÈessayer.';
$lang['quota_usage_info'] = 'Limite de quota';
$lang['quota_usage_used'] = 'utilisÈ';
$lang['quota_usage_of'] = 'de';
$lang['quota_usage_avail'] = 'Total';

//
// Date Format
// %d = day, %m = month, %y = year, %H = hour, %M = minutes
// for a complete list, see http://www.php.net/strftime
//
$lang['date_format'] = '%d/%m/%y %H:%M';

// CharSet
$lang['default_char_set'] = 'iso-8859-15';

// Menu
$lang['messages_mnu'] = 'Messages';
$lang['read_menu'] = 'Read E-Mail(s)';
$lang['compose_mnu'] = 'Ecrire un nouveau message';
$lang['refresh_mnu'] = 'Actualiser';
$lang['folders_mnu'] = 'Dossiers';
$lang['search_mnu'] = 'Rechercher';
$lang['address_mnu'] = 'Carnet d\'adresses';
$lang['empty_trash_mnu'] = 'Vider la corbeille';
$lang['prefs_mnu'] = 'PrÈfÈrences';
$lang['logoff_mnu'] = 'Quitter';

// Reply
$lang['reply_prefix'] = 'Re:';
$lang['forward_prefix'] = 'Tr:';
$lang['reply_delimiter'] = '--------- Message d\'origine --------';
$lang['reply_from_hea'] = 'De:';
$lang['reply_to_hea'] = 'A:';
$lang['reply_cc_hea'] = 'Copies:';
$lang['reply_date_hea'] = 'Date:';
$lang['reply_subject_hea'] = 'Objet:';
// done


// page-specific vars

// [Headers]
$lang['key_hea'] = 'Clef';
$lang['value_hea'] = 'Valeur';

// [Folders]
$lang['fld_name_hea'] = 'Dossiers';
$lang['fld_messages_hea'] = 'Messages';
$lang['fld_size_hea'] = 'Taille';
$lang['fld_empty_hea'] = 'Vider';
$lang['fld_delete_hea'] = 'Supprimer';
$lang['fld_total'] = 'Total:';
$lang['fld_make_new'] = 'CrÈer un nouveau dossier';
$lang['folders_to'] = 'Dossier de';

// [MessageList]
$lang['messages_to'] = 'Messages de ';
$lang['no_messages'] = 'Aucun message dans le dossier ';
$lang['delete_selected_mnu'] = 'Supprimer la sÈlection';
$lang['move_selected_mnu'] = 'DÈplacer la sÈlection dans';
$lang['mark_selected_mnu'] = 'Marquer comme lu';
$lang['unmark_selected_mnu'] = 'Marquer comme non lu';
$lang['move_selected_to_trash_mnu'] = 'éplacer vers la corbeille';


$lang['delete_mnu'] = 'Supprimer';
$lang['move_mnu'] = 'DÈplacer dans';
$lang['subject_hea'] = 'Objet:';
$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'A:';
$lang['date_hea'] = 'Date:';
$lang['size_hea'] = 'Taille';
$lang['have_spam'] = 'Vous avez le Spam (vérifier dossier Spam)';

$lang['msg_you_have'] = 'Vous avez';
$lang['msg_message'] = 'message';
$lang['msg_messages'] = 'messages';

$lang['msg_more_unread'] = 'non lus';
$lang['msg_one_unread'] = 'non lu';
$lang['msg_none_unread'] = 'aucun non lu';
$lang['msg_in_the_folder'] = 'dans le dossier';


// [Login]
$lang['lgn_title'] = 'Authentification';
$lang['lgn_welcome_msg'] = 'Bienvenue. Veuillez entrer vos informations de connexion.';
$lang['lng_user_email'] = 'e-Mail';
$lang['lng_user_name'] = 'Nom d\'utilisateur';
$lang['lng_user_pwd'] = 'Mot de passe';
$lang['lng_server'] = 'Server';
$lang['lng_theme'] = 'ThËme';
$lang['lng_language'] = 'Langue';
$lang['lng_login_btn'] = 'Connexion &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Les cookies doivent être activés';
$lang['lng_cookie_not_valid'] = 'Cookie Échec de la vérification de la sécurité';

// [Newmessage]

$lang['newmsg_title'] = 'Nouveau Email';

$lang['to_hea'] = 'A:';
$lang['cc_hea'] = 'Copies:';
$lang['bcc_hea'] = 'Copies cachÈes:';
$lang['subject_hea'] = 'Objet:';
$lang['address_tip'] = 'Carnet d adresses';

$lang['attach_hea'] = 'PiËces jointes:';
$lang['attch_add_new'] = 'Ajouter une piËce jointe';
$lang['attch_name_hea'] = 'Nom';
$lang['attch_size'] = 'Taille';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Supprimer';
$lang['attch_no_hea'] = 'Aucune piËce jointe';

$lang['add_signature'] = 'Ajouter une signature';
$lang['send_text'] = 'Envoyer';

$lang['result_error'] = 'Impossible d\'envoyer l\'e-Mail';
$lang['result_success'] = 'Votre e-Mail a bien ÈtÈ envoyÈ.';
$lang['nav_continue'] = 'Continuer';
$lang['nav_back'] = 'Retour';

$lang['up_title'] = 'Ajouter une piËce jointe';
$lang['up_information_text'] = 'SÈlectionnez un fichier';
$lang['up_button_text'] = 'Envoyer';

$lang['require_receipt'] = 'Retour réception';

$lang['priority_text'] = 'PrioritÈ';
$lang['priority_low'] = 'Basse';
$lang['priority_normal'] = 'Normale';
$lang['priority_high'] = 'Haute';

// [Preferences]
$lang['prf_title'] = 'PrÈfÈrences';
$lang['prf_general_title'] = 'Informations GÈnÈrales';
$lang['prf_name'] = 'Nom';
$lang['prf_reply_to'] = 'RÈpondre ‡ ';
$lang['prf_time_zone'] = 'Fuseau horaire';
$lang['prf_trash_title'] = 'Corbeille';
$lang['prf_save_to_trash'] = 'Garder une copie des messages <b>supprimÈs</b> dans le dossier';
$lang['prf_save_only_read'] = 'Garder une copie des messages <b>lus</b> dans les dossier';
$lang['prf_empty_on_exit'] = '<b>Vider</b> la corbeille en quittant';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = 'ElÈments envoyÈs';
$lang['prf_save_sent'] = 'Garder une copie des messages <b>envoyÈs</b> dans le dossier';
$lang['prf_messages_title'] = 'Messages';
$lang['prf_page_limit'] = 'Nombre de messages maximum affichÈs par page';
$lang['prf_signature_title'] = 'Signature';
$lang['prf_signature'] = 'Tapez ou collez votre signature';
$lang['prf_auto_add_sign'] = 'Ajouter la signature automatiquement aux nouveaux messages';
$lang['prf_save_button'] = 'Enregistrer';
$lang['prf_display_images'] = 'Afficher les images attachÈes';
$lang['prf_default_editor_mode'] = 'Mode d\'Èdition par dÈfaut';
$lang['prf_default_editor_mode_text'] = '"Mode texte"';
$lang['prf_default_editor_mode_html'] = '"Editeur HTML avancÈ"';
$lang['prf_time_to_refesh'] = 'Temps de rafraÓchissement pour les messages (en minutes)';
$lang['prf_spam_level'] = 'SPAM sensibilité (0 = désactivé, 1 = très élevé, 9 = très faible)';
$lang['prf_auto_require_receipt'] = 'Require read receipt by default';

$lang['prf_msg_saved'] = 'Préférences enregistrées';

// filters
$lang['filter_title'] = 'Filtres';

$lang['filter_new'] = 'Créer un filtre';
$lang['filter_desc'] = 'Choisissez les critères de recherche et les Action pour les messages entrants';
$lang['filter_list'] = 'Filtres actuels';

$lang['filter_field_from'] = 'De:';
$lang['filter_field_to'] = 'A:';
$lang['filter_field_subject'] = 'Sujet';
$lang['filter_field_header'] = 'Header';
$lang['filter_field_body'] = 'Body';

$lang['filter_type_move'] = 'Déplacer';
$lang['filter_type_delete'] = 'Supprimer';
$lang['filter_type_mark'] = 'Marquer comme lu';

$lang['filter_add'] = 'Ajouter un filtre';
$lang['filter_delete'] = 'Supprimer un filtre';
$lang['filter_delete_selected'] = 'Supprimer les filtres sélectionnés';

$lang['filter_field'] = 'Filter on field'; // FIXME: need translation
$lang['filter_match'] = 'Search for'; // FIXME: need translation
$lang['filter_type'] = 'Action'; // FIXME: need translation
$lang['filter_folder'] = 'Dossier de destination';

$lang['filter_msg_nofilters'] = 'No filters available.'; // FIXME: need translation
$lang['filter_msg_added'] = 'Filtre ajouté';
$lang['filter_msg_deleted'] = 'Filtre supprimé';


// [Catch]
$lang['ctc_title'] = 'Capturer une adresse';
$lang['ctc_information'] = 'Seuls les e-mails valides qui ne sont pas encore dans ce carnet seront ajoutÈs';
$lang['ctc_name'] = 'Nom';
$lang['ctc_email'] = 'e-Mail';
$lang['ctc_no_address'] = 'Pas d\'adresse disponible ';
$lang['ctc_close'] = 'Fermer';
$lang['ctc_save'] = 'Enregistrer';

// [Readmsg]
$lang['next_mnu'] = 'Suivant';
$lang['previous_mnu'] = 'PrÈcÈdent';
$lang['back_mnu'] = 'Retour';
$lang['reply_mnu'] = 'RÈpondre';
$lang['reply_all_mnu'] = 'RÈpondre ‡ tous';
$lang['forward_mnu'] = 'TransfÈrer';
$lang['headers_mnu'] = 'En-tÍte';
$lang['move_mnu'] = 'DÈplacer dans';
$lang['move_to_trash_mnu'] = 'Déplacer vers la corbeille';
$lang['delete_mnu'] = 'Supprimer';
$lang['print_mnu'] = 'Imprimer';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'A:';
$lang['cc_hea'] = 'Copies:';
$lang['date_hea'] = 'Date:';
$lang['subject_hea'] = 'Objet:';
$lang['attach_hea'] = 'PiËces jointes:';

$lang['attch_name_hea'] = 'Nom';
$lang['attch_force_hea'] = 'TÈlÈcharger';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Taille';
$lang['catch_address'] = 'Ajouter l\'adresse au carnet';
$lang['block_address'] = 'adresse de bloc';

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Entrez le mot ou la phrase que vous dÈsirez trouver.<br> La recherche sera uniquement effectuÈe sur les messages des <b>dossiers locaux</b> ou sur les <b>messages lus<b>.';
$lang['sch_button_text'] = 'Rechercher &gt;&gt;';
$lang['sch_subject_hea'] = 'Objet';
$lang['sch_from_hea'] = 'De';
$lang['sch_date_hea'] = 'Date';
$lang['sch_body_hea'] = 'Message';
$lang['sch_folder_hea'] = 'Dossier';
$lang['sch_no_results'] = 'Aucun message trouvÈ';

// [QuickAddress]
$lang['qad_title'] = 'Carnet d\'adresses';
$lang['qad_select_address'] = 'SÈlectionnez un contact ';
$lang['qad_to'] = 'A';
$lang['qad_cc'] = 'Copies';
$lang['qad_bcc'] = 'Copies cachÈes';

// [AddressBook]
// edit/display
$lang['adr_title'] = 'Carnet d\'adresses';
$lang['adr_name'] = 'Nom';
$lang['adr_email'] = 'e-Mail';
$lang['adr_street'] = 'Adresse';
$lang['adr_city'] = 'Ville';
$lang['adr_state'] = 'Etat';
$lang['adr_work'] = 'Travail';
$lang['adr_back'] = 'Retour';
$lang['adr_save'] = 'Enregistrer';
$lang['adr_phone'] = 'Téléphone';
$lang['adr_cell'] = 'Cellule';
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'Nom';
$lang['adr_email_hea'] = 'e-Mail';
$lang['adr_edit_hea'] = 'Modifier';
$lang['adr_expo_hea'] = 'Exportation';
$lang['adr_dele_hea'] = 'Supprimer';
$lang['adr_new_entry'] = 'Nouvelle entrÈe';

$lang['addr_saved'] = 'Votre contact a ÈtÈ sauvÈ';
$lang['addr_added'] = 'Votre contact a ÈtÈ ajoutÈ';
$lang['addr_deleted'] = 'Votre contact a ÈtÈ supprimÈ';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // FIXME: need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'E-mail'; // FIXME: need translation
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Fermer'; // FIXME: need translation
$lang['blk_save'] = 'Enregistrer';

// [Event]
$lang['evt_title'] = 'événement de calendrier';
$lang['evt_save'] = 'Enregistrer';
$lang['evt_delete'] = 'Supprimer';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

