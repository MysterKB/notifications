<?php

/**
 * Menu rapide dans l'affichage de la partie publique du module
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationsTreeLinks implements ModuleTreeLinksExtensionPoint
{
    public function get_actions_tree_links()
    {
        $tree = new ModuleTreeLinks();
        $tree->add_link(new AdminModuleLink(LangLoader::get_message('configuration', 'admin-common'), NotificationsUrlBuilder::configuration()));
        $tree->add_link(new AdminModuleLink(LangLoader::get_message('module_send_notification', 'common', 'notifications'), NotificationsUrlBuilder::send_notification()));

        return $tree;
    }
}
