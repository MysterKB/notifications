<?php

/**
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationsExtensionPointProvider extends ExtensionPointProvider
{
    public function __construct()
    {
        parent::__construct('notifications');
    }
    public function css_files()
    {
        $module_css_files = new ModuleCssFiles();
        $module_css_files->adding_running_module_displayed_file('notifications.css');
        $module_css_files->adding_always_displayed_file('notifications_mini.css');
        return $module_css_files;
    }
    public function home_page()
    {
        return new DefaultHomePageDisplay($this->get_id(), NotificationsController::get_view());
    }
    public function menus()
    {
        return new ModuleMenus(array(new NotificationsModuleMiniMenu()));
    }
    public function tree_links()
    {
        return new NotificationsTreeLinks();
    }
    public function url_mappings()
    {
        return new UrlMappings(array(new DispatcherUrlMapping('/notifications/index.php')));
    }
}
