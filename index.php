<?php

/**
 * Index
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 04
 */
define('PATH_TO_ROOT', '..');
require_once PATH_TO_ROOT . '/kernel/init.php';
$url_controller_mappers = array(
    //Admin
    new UrlControllerMapper('AdminNotificationsConfigController', '`^/admin(?:/config)?/?$`'),
    new UrlControllerMapper('AdminNotificationsSendController', '`^/admin(?:/config)?/send`'),

    // User    
    new UrlControllerMapper('NotificationsActionController', '`^/action/?$`'),
    new UrlControllerMapper('NotificationsArchivesController', '`^/archives(?:/([0-9]+))?/?$`', array(
        'page'
    )),
    new UrlControllerMapper('NotificationsUserSettings', '`^/settings/?$`'),
    new UrlControllerMapper('NotificationsHomeController', '`^(?:/([0-9]+))?/?$`', array(
        'page'
    )),




);
DispatchManager::dispatch($url_controller_mappers);
