<?php

/**
 * Menu rapide pour l'administration
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class AdminNotificationsDisplayResponse extends AdminMenuDisplayResponse
{
    public function __construct($view, $title_page)
    {
        parent::__construct($view);
        $lang = LangLoader::get('common', 'notifications');
        $this->set_title($lang['module_title']);
        $this->add_link(LangLoader::get_message('configuration', 'admin-common'), NotificationsUrlBuilder::configuration());
        $this->add_link($lang['module_send_notification'], NotificationsUrlBuilder::send_notification());

        $env = $this->get_graphical_environment();
        $env->set_page_title($title_page, $lang['module_title']);
    }
}
