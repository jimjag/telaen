<?php
/*
 * US English (canonical list and phrasing)
 */

$lang = array();

// User-friendly names to system folders
$lang['inbox_extended'] = 'Boîte de réception';
$lang['sent_extended'] = 'Eléments envoyés';
$lang['trash_extended'] = 'Corbeille';
$lang['spam_extended'] = 'Spam folder';

// Navigation texts
$lang['pages_text'] = 'Pages';
$lang['first_text'] = 'First';
$lang['previous_text'] = 'Précédent';
$lang['next_text'] = 'Suivant';
$lang['last_text'] = 'Last';
$lang['total_text'] = 'Total';

// Mail Server Errors
$lang['err_login_msg'] = 'Login error'; // FIXME: need translation
$lang['err_system_msg'] = 'System error'; // FIXME: need translation
$lang['error_login'] = 'Please check your username or password and try again'; // FIXME: need translation
$lang['error_connect'] = 'Connexion au serveur impossible';
$lang['error_retrieving'] = 'Impossible de recevoir le message, dû aux modifications ';
$lang['error_session_expired'] = 'Your session is expired, please login again'; // FIXME: need translation
$lang['error_other'] = 'Des erreurs sont survenues, veuillez contacter votre administrateur';

// Invalid name of mailbox
$lang['error_invalid_name'] = 'Nom de dossier invalide - Veuillez utiliser les caractères suivants A-Z, 0-9, . - espace';

// Validations when sending mails
$lang['error_no_recipients'] = 'Aucun destinataire spécifié';
$lang['error_compose_invalid_mail1_s'] = 'L\'adresse suivante semble invalide';
$lang['error_compose_invalid_mail1_p'] = 'Les adresses suivantes semblent invalides';
$lang['error_compose_invalid_mail2_s'] = 'Veuillez la vérifier avant l\'envoi du message';
$lang['error_compose_invalid_mail2_p'] = 'Veuillez les vérifier avant l\'envoi du message';

// Confirmation of delete
$lang['confirm_delete'] = 'Etes-vous sûr de vouloir effacer ce message ? ';

// If the message no have a subject or sender
$lang['no_subject_text'] = '[Pas d\'objet]';
$lang['no_sender_text'] = '[Inconnu]';
$lang['no_recipient_text'] = '[Inconnu]';

// If the quota limit was exceeded
$lang['quota_exceeded'] = 'Espace insuffisant pour effectuer cette opération.\rVeuillez nettoyer les anciens messages et réessayer.';
$lang['quota_usage_info'] = 'Limite de quota';
$lang['quota_usage_used'] = 'utilisé';
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
$lang['prefs_mnu'] = 'Préférences';
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
$lang['fld_make_new'] = 'Créer un nouveau dossier';
$lang['folders_to'] = 'Dossier de';

// [MessageList]
$lang['messages_to'] = 'Messages de ';
$lang['no_messages'] = 'Aucun message dans le dossier ';
$lang['delete_selected_mnu'] = 'Supprimer la sélection';
$lang['move_selected_mnu'] = 'Déplacer la sélection dans';
$lang['mark_selected_mnu'] = 'Mark as read';
$lang['unmark_selected_mnu'] = 'Mark as unread';
$lang['move_selected_to_trash_mnu'] = 'Move to Trash';


$lang['delete_mnu'] = 'Supprimer';
$lang['move_mnu'] = 'Déplacer dans';
$lang['subject_hea'] = 'Objet:';
$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'A:';
$lang['date_hea'] = 'Date:';
$lang['size_hea'] = 'Taille';
$lang['have_spam'] = 'You have Spam (check Spam folder)';

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
$lang['lng_theme'] = 'Thème';
$lang['lng_language'] = 'Langue';
$lang['lng_login_btn'] = 'Connexion &gt;&gt;';
$lang['lng_cookie_not_enabled'] = 'Cookies must be enabled';
$lang['lng_cookie_not_valid'] = 'Cookie Security Check Failed';

// [Newmessage]

$lang['newmsg_title'] = 'Compose mail';

$lang['to_hea'] = 'A:';
$lang['cc_hea'] = 'Copies:';
$lang['bcc_hea'] = 'Copies cachées:';
$lang['subject_hea'] = 'Objet:';
$lang['address_tip'] = 'Carnet d adresses';

$lang['attach_hea'] = 'Pièces jointes:';
$lang['attch_add_new'] = 'Ajouter une pièce jointe';
$lang['attch_name_hea'] = 'Nom';
$lang['attch_size'] = 'Taille';
$lang['attch_type_hea'] = 'Type';
$lang['attch_dele_hea'] = 'Supprimer';
$lang['attch_no_hea'] = 'Aucune pièce jointe';

$lang['add_signature'] = 'Ajouter une signature';
$lang['send_text'] = 'Envoyer';

$lang['result_error'] = 'Impossible d\'envoyer l\'e-Mail';
$lang['result_success'] = 'Votre e-Mail a bien été envoyé.';
$lang['nav_continue'] = 'Continuer';
$lang['nav_back'] = 'Retour';

$lang['up_title'] = 'Ajouter une pièce jointe';
$lang['up_information_text'] = 'Sélectionnez un fichier';
$lang['up_button_text'] = 'Envoyer';

$lang['require_receipt'] = 'Return receipt';

$lang['priority_text'] = 'Priorité';
$lang['priority_low'] = 'Basse';
$lang['priority_normal'] = 'Normale';
$lang['priority_high'] = 'Haute';

// [Preferences]
$lang['prf_title'] = 'Préférences';
$lang['prf_general_title'] = 'Informations Générales';
$lang['prf_name'] = 'Nom';
$lang['prf_reply_to'] = 'Répondre à ';
$lang['prf_time_zone'] = 'Fuseau horaire';
$lang['prf_trash_title'] = 'Corbeille';
$lang['prf_save_to_trash'] = 'Garder une copie des messages <b>supprimés</b> dans le dossier';
$lang['prf_save_only_read'] = 'Garder une copie des messages <b>lus</b> dans les dossier';
$lang['prf_empty_on_exit'] = '<b>Vider</b> la corbeille en quittant';
$lang['prf_empty_spam_on_exit'] = '<b>Empty</b> Spam folder when you logout';
$lang['prf_unmark_read_on_exit'] = 'Reset READ messages as UNREAD when you logout';
$lang['prf_sent_title'] = 'Eléments envoyés';
$lang['prf_save_sent'] = 'Garder une copie des messages <b>envoyés</b> dans le dossier';
$lang['prf_messages_title'] = 'Messages';
$lang['prf_page_limit'] = 'Nombre de messages maximum affichés par page';
$lang['prf_signature_title'] = 'Signature';
$lang['prf_signature'] = 'Tapez ou collez votre signature';
$lang['prf_auto_add_sign'] = 'Ajouter la signature automatiquement aux nouveaux messages';
$lang['prf_save_button'] = 'Enregistrer';
$lang['prf_display_images'] = 'Afficher les images attachées';
$lang['prf_default_editor_mode'] = 'Mode d\'édition par défaut';
$lang['prf_default_editor_mode_text'] = '"Mode texte"';
$lang['prf_default_editor_mode_html'] = '"Editeur HTML avancé"';
$lang['prf_time_to_refesh'] = 'Temps de rafraîchissement pour les messages (en minutes)';
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
$lang['ctc_title'] = 'Capturer une adresse';
$lang['ctc_information'] = 'Seuls les e-mails valides qui ne sont pas encore dans ce carnet seront ajoutés';
$lang['ctc_name'] = 'Nom';
$lang['ctc_email'] = 'e-Mail';
$lang['ctc_no_address'] = 'Pas d\'adresse disponible ';
$lang['ctc_close'] = 'Fermer';
$lang['ctc_save'] = 'Enregistrer';

// [Readmsg]
$lang['next_mnu'] = 'Suivant';
$lang['previous_mnu'] = 'Précédent';
$lang['back_mnu'] = 'Retour';
$lang['reply_mnu'] = 'Répondre';
$lang['reply_all_mnu'] = 'Répondre à tous';
$lang['forward_mnu'] = 'Transférer';
$lang['headers_mnu'] = 'En-tête';
$lang['move_mnu'] = 'Déplacer dans';
$lang['move_to_trash_mnu'] = 'Move to Trash';
$lang['delete_mnu'] = 'Supprimer';
$lang['print_mnu'] = 'Imprimer';
$lang['download_mnu'] = 'Download';

$lang['from_hea'] = 'De:';
$lang['to_hea'] = 'A:';
$lang['cc_hea'] = 'Copies:';
$lang['date_hea'] = 'Date:';
$lang['subject_hea'] = 'Objet:';
$lang['attach_hea'] = 'Pièces jointes:';

$lang['attch_name_hea'] = 'Nom';
$lang['attch_force_hea'] = 'Télécharger';
$lang['attch_type_hea'] = 'Type';
$lang['attch_size_hea'] = 'Taille';
$lang['catch_address'] = 'Ajouter l\'adresse au carnet';
$lang['block_address'] = 'Block address'; // FIXME: need translation

// [Search]
$lang['sch_title'] = 'Search';
$lang['sch_information_text'] = 'Entrez le mot ou la phrase que vous désirez trouver.<br> La recherche sera uniquement effectuée sur les messages des <b>dossiers locaux</b> ou sur les <b>messages lus<b>.';
$lang['sch_button_text'] = 'Rechercher &gt;&gt;';
$lang['sch_subject_hea'] = 'Objet';
$lang['sch_from_hea'] = 'De';
$lang['sch_date_hea'] = 'Date';
$lang['sch_body_hea'] = 'Message';
$lang['sch_folder_hea'] = 'Dossier';
$lang['sch_no_results'] = 'Aucun message trouvé';

// [QuickAddress]
$lang['qad_title'] = 'Carnet d\'adresses';
$lang['qad_select_address'] = 'Sélectionnez un contact ';
$lang['qad_to'] = 'A';
$lang['qad_cc'] = 'Copies';
$lang['qad_bcc'] = 'Copies cachées';

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
$lang['adr_phone'] = 'TŽlŽphone';
$lang['adr_cell'] = 'Cell'; // FIXME: need translation
$lang['adr_note'] = 'Notes'; // FIXME: need translation

// list
$lang['adr_name_hea'] = 'Nom';
$lang['adr_email_hea'] = 'e-Mail';
$lang['adr_edit_hea'] = 'Modifier';
$lang['adr_expo_hea'] = 'Exportation';
$lang['adr_dele_hea'] = 'Supprimer';
$lang['adr_new_entry'] = 'Nouvelle entrée';

$lang['addr_saved'] = 'Votre contact a été sauvé';
$lang['addr_added'] = 'Votre contact a été ajouté';
$lang['addr_deleted'] = 'Votre contact a été supprimé';


// [BlockSender]
$lang['blk_title'] = 'Block sender'; // FIXME: need translation
$lang['blk_information'] = 'Only shows e-mails that are not in the filter yet'; // FIXME: need translation
$lang['blk_email'] = 'E-mail'; // FIXME: need translation
$lang['blk_no_address'] = 'No address available';
$lang['blk_close'] = 'Fermer'; // FIXME: need translation
$lang['blk_save'] = 'Enregistrer';

// [Event]
$lang['evt_title'] = 'Calendar Event'; // FIXME: need translation
$lang['evt_save'] = 'Enregistrer';
$lang['evt_delete'] = 'Supprimer';
$lang['evt_stop'] = 'Stop time'; // FIXME: need translation
$lang['evt_start'] = 'Start time'; // FIXME: need translation

