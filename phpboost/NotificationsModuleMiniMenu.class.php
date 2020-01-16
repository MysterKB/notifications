<?php

/**
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 11
 */
class NotificationsModuleMiniMenu extends ModuleMiniMenu
{
    public function get_default_block()
    {
        return self::BLOCK_POSITION__LEFT;
    }
    public function get_menu_id()
    {
        return 'module-mini-notifications';
    }
    public function get_menu_title()
    {
        return LangLoader::get_message('notifications', 'common', 'notifications');
    }
    public function is_displayed()
    {
        if (!AppContext::get_current_user()->check_level(User::MEMBER_LEVEL)) {
            return false;
        }
        return true;
    }
    public function get_menu_content()
    {
        $tpl = new FileTemplate('notifications/NotificationsModuleMiniMenu.tpl');
        $tpl->add_lang(LangLoader::get('common', 'notifications'));
        $nbr_notifications = NotificationsService::count('WHERE id_to=' . AppContext::get_current_user()->get_id() . ' AND reading = 0');
        MenuService::assign_positions_conditions($tpl, $this->get_block());
        $tpl->put_all(array(
            'NOTIFICATIONS_NUMBER' => $nbr_notifications,
            'L_YOU_HAVE' => $nbr_notifications > 0 ? StringVars::replace_vars(LangLoader::get_message('notifications.you_have', 'common', 'notifications'), ['num' => $nbr_notifications]) : LangLoader::get_message('notifications.you_do_not_have', 'common', 'notifications'),
            'U_NOTIFICATIONS' => NotificationsUrlBuilder::home()->rel()
        ));

        return $tpl->render();
    }
}
