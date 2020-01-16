<?php

/**
 * Constructeur des URL
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 04
 */
class NotificationsUrlBuilder
{
    private static $dispatcher = '/notifications';

    /**
     * Page de configuration dans l'administration
     *
     * @return void
     */
    public static function configuration()
    {
        return DispatchManager::get_url(self::$dispatcher, '/admin/config');
    }

    public static function send_notification()
    {
        return DispatchManager::get_url(self::$dispatcher, '/admin/send');
    }

    /**
     * Page d'accueil
     *
     * @param integer $page
     * @return void
     */
    public static function home($page = 1)
    {
        return DispatchManager::get_url(self::$dispatcher, '/' . $page);
    }

    /**
     * Page des archives
     *
     * @param integer $page
     * @return void
     */
    public static function archives($page = 1)
    {
        return DispatchManager::get_url(self::$dispatcher, '/archives/' . $page);
    }

    /**
     * Page des paramètres de notifications pour les utilisateurs
     *
     * @return void
     */
    public static function settings()
    {
        return DispatchManager::get_url(self::$dispatcher, '/settings');
    }

    /**
     * Lien du formulaire de suppression et d'archivage des notifications
     *
     * @return void
     */
    public static function form_action()
    {
        return DispatchManager::get_url(self::$dispatcher, '/action');
    }
}
