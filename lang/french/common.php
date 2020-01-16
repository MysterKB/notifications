<?php

/**
 * Fichier de langue française du module de notifications
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 04
 */
$lang['module_title'] = 'Notification';
$lang['notification'] = 'Notification';
$lang['notifications'] = 'Notifications';

/**
 * Interface utilisateur
 */
$lang['notifications.my_notifications'] = "Mes notifications";
$lang['notifications.you_do_not_have'] = "Vous n'avez pas de notification";
$lang['notifications.you_have'] = "Vous avez <strong>:num</strong> notification(s)";
$lang['notifications.delete'] = "Supprimer";
$lang['notifications.archived'] = "Archiver";
$lang['notifications.archives'] = "Archives";
$lang['notifications.settings'] = "Paramètres";
$lang['notifications.delete.confirmation'] = "Êtes-vous sûr de vouloir supprimer ces notifications ?";
$lang['notifications.deleted_success'] = "Les notifications ont été supprimées avec succès !";
$lang['notifications.archiving_success'] = "Les notifications ont été archivées avec succès !";
$lang['notifications.deleted_success.one'] = "La notification a été supprimée avec succès !";
$lang['notifications.archiving_success.one'] = "La notification a été archivée avec succès !";
$lang['notifications.select_all'] = "Tout sélectionner";
$lang['notifications.deleted_or_archived.error'] = "Vous devez sélectionner au moins un élément !";

// Notification
/* Articles */
$lang['notifications.articles.commented'] = '<a href=":url_profile">:username</a> a posté un commentaire dans votre article <a href=":url">:title</a>';
$lang['notifications.articles.rated'] = '<a href=":url_profile">:username</a> a noté votre article <a href=":url">:title</a>';
$lang['notifications.articles.published'] = '<a href=":url_profile">:username</a> a publié votre article <a href=":url">:title</a>';
$lang['notifications.articles.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre article <b>:title</b>';

/** Calendar */
$lang['notifications.calendar.approved'] = '<a href=":url_profile">:username</a> a approuvé votre événement <a href=":url">:title</a>';
$lang['notifications.calendar.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre événement <b>:title</b>';
$lang['notifications.calendar.registered'] = '<a href=":url_profile">:username</a> participe à votre événement <a href=":url">:title</a>';

/** Download */
$lang['notifications.download.approved'] = '<a href=":url_profile">:username</a> a approuvé votre fichier <a href=":url">:title</a>';
$lang['notifications.download.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre fichier <b>:title</b>';
$lang['notifications.download.commented'] = '<a href=":url_profile">:username</a> a posté un commentaire sur votre fichier <a href=":url">:title</a>';

/**  Forum **/
$lang['notifications.custom'] = '<a href=":url_profile">:username</a> a envoyé le message suivant: :message';
$lang['notifications.forum.reply'] = '<a href=":url_profile">:username</a> a posté une réponse dans votre sujet: <a href=":url">:title</a>';
$lang['notifications.forum.deleted.topic'] = '<a href=":url_profile">:username</a> a supprimé votre sujet <b>:title</b>';
$lang['notifications.forum.deleted.msg'] = '<a href=":url_profile">:username</a> a supprimé votre message dans le sujet <a href=":url">:title</a>';
$lang['notifications.forum.reply.poll'] = '<a href=":url_profile">:username</a> a répondu au sondage de votre sujet <a href=":url">:title</a>';
$lang['notifications.forum.locked'] = '<a href=":url_profile">:username</a> a verrouillé votre sujet <a href=":url">:title</a>';
$lang['notifications.forum.unlocked'] = '<a href=":url_profile">:username</a> a déverrouillé votre sujet <a href=":url">:title</a>';
$lang['notifications.forum.moved'] = '<a href=":url_profile">:username</a> a déplacé votre sujet <a href=":url">:title</a> dans la catégorie <a href=":url_category">:category_title</a>';
$lang['notifications.forum.mention'] = '<a href=":url_profile">:username</a> vous a mentionné dans le sujet <a href=":url">:title</a>';

/** Gallery **/
$lang['notifications.gallery.commented'] = '<a href=":url_profile">:username</a> a posté un commentaire sur votre image <a href=":url">:title</a>';
$lang['notifications.gallery.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre image <b>:title</b>';
$lang['notifications.gallery.rated'] = '<a href=":url_profile">:username</a> a noté votre image <a href=":url">:title</a>';

/** Media */
$lang['notifications.media.approved'] = '<a href=":url_profile">:username</a> a approuvé votre fichier multimédia <a href=":url">:title</a>';
$lang['notifications.media.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre fichier multimédia <b>:title</b>';
$lang['notifications.media.rated'] = '<a href=":url_profile">:username</a> a noté votre fichier multimédia <a href=":url">:title</a>';
$lang['notifications.media.commented'] = '<a href=":url_profile">:username</a> a commenté votre fichier multimédia <a href=":url">:title</a>';

/** News */
$lang['notifications.news.approved'] = '<a href=":url_profile">:username</a> a approuvé news <a href=":url">:title</a>';
$lang['notifications.news.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre news <b>:title</b>';
$lang['notifications.news.commented'] = '<a href=":url_profile">:username</a> a commenté votre news <a href=":url">:title</a>';

/** Media */
$lang['notifications.web.approved'] = '<a href=":url_profile">:username</a> a approuvé votre lien web <a href=":url">:title</a>';
$lang['notifications.web.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre lien web <b>:title</b>';
$lang['notifications.web.rated'] = '<a href=":url_profile">:username</a> a noté votre lien web <a href=":url">:title</a>';
$lang['notifications.web.commented'] = '<a href=":url_profile">:username</a> a commenté votre lien web <a href=":url">:title</a>';

/** Wiki */
$lang['notifications.wiki.deleted'] = '<a href=":url_profile">:username</a> a supprimé votre article <b>:title</b> du wiki';
$lang['notifications.wiki.commented'] = '<a href=":url_profile">:username</a> a commenté votre article <a href=":url">:title</a> du wiki';
$lang['notifications.wiki.edited'] = '<a href=":url_profile">:username</a> a modifié votre article <a href=":url">:title</a> du wiki';
$lang['notifications.wiki.renamed'] = '<a href=":url_profile">:username</a> a renommé votre article <a href=":url">:title</a> du wiki';
$lang['notifications.wiki.moved'] = '<a href=":url_profile">:username</a> a déplacé votre article <a href=":url">:title</a> du wiki dans la catégorie <a href=":url_category">:category_title</a>';
$lang['notifications.wiki.status'] = '<a href=":url_profile">:username</a> a modifié le statut de votre article <a href=":url">:title</a> du wiki en <b>:status</b>';

// Configuration
$lang['notifications.config.title'] = "Configuration de vos notifications";
$lang['notifications.config.content'] = "Gérez vos notifications très facilement, cochez les cases des modules pour lesquels vous souhaitez recevoir des notifications. Vous recevez une notification lorsque quelqu'un interagit avec votre contenu.";
$lang['notifications.config.articles'] = "Articles";
$lang['notifications.config.calendar'] = "Événements";
$lang['notifications.config.download'] = "Téléchargements";
$lang['notifications.config.forum'] = "Forum";
$lang['notifications.config.gallery'] = "Galerie";
$lang['notifications.config.media'] = "Multimédia";
$lang['notifications.config.news'] = "News";
$lang['notifications.config.web'] = "Liens web";
$lang['notifications.config.wiki'] = "Wiki";
$lang['notifications.config.save.success'] = "Les modifications ont été prises en compte.";

/**
 * Administration
 */
$lang['module_config_title'] = "Configuration des notifications";
$lang['module_send_notification'] = "Envoyer une notification";
$lang['admin.params'] = "Paramètres des notifications";
$lang['admin.automatic_archiving'] = "Archivage automatique des notifications";
$lang['admin.automatic_deletion'] = "Suppression automatique des notifications";

// Form
$lang['notifications.username'] = "Nom d'utilisateur";
$lang['notifications.username.desc'] = "Pour envoyer à d'autres personnes, séparé les pseudos par des le symbole <b>|</b>.";
$lang['notifications.username.placeholder'] = "Pseudo1|Pseudo2|Pseudo3|Pseudo4...";
$lang['notifications.content'] = "Contenu de la notification";
$lang['notifications.content.desc'] = "Contenu de la notification qui sera envoyée";
$lang['notifications.all_users'] = "Tous les membres";
$lang['notifications.all_users.desc'] = "Envoyer la notification à tous les membres.";


// Erreurs
$lang['admin.message.error.1'] = "Vous ne pouvez pas activer la suppression automatique ainsi que l'archivage automatique, c'est soit l'un ou soit l'autre.";
$lang['admin.message.error.form.username.does_not_exist'] = ":username n'existe pas";
$lang['admin.message.send.success'] = "La notification a bien été envoyée.";
$lang['admin.message.send.error'] = "La notification a été envoye aux utilisateurs existants mais n'a pas été envoyée à : <b>:users</b> car il(s) n'existe(nt) pas.";
