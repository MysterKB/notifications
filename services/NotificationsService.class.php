<?php

/**
 * Liste des méthodes de requêtes 
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationsService
{
    private static $db_querier;
    public static function __static()
    {
        self::$db_querier = PersistenceContext::get_querier();
    }

    public static function count($condition = '')
    {
        return self::$db_querier->count(NotificationsSetup::$notifications_table, $condition);
    }

    public static function add(Notification $notification)
    {
        $result = self::$db_querier->insert(NotificationsSetup::$notifications_table, $notification->get_properties());
        return $result->get_last_inserted_id();
    }

    public static function delete($condition, array $parameters)
    {
        self::$db_querier->delete(NotificationsSetup::$notifications_table, $condition, $parameters);
    }

    public static function get_notification($condition, array $parameters)
    {
        $row = self::$db_querier->select_single_row_query('SELECT member.*, notifications.*
		FROM ' . NotificationsSetup::$notifications_table . ' notifications
		LEFT JOIN ' . DB_TABLE_MEMBER . ' member ON member.user_id = guestbook.id_from
		' . $condition, $parameters);
        $notification = new Notification();
        $notification->set_properties($row);
        return $notification;
    }

    public static function get_settings($condition, array $parameters)
    {
        $row = self::$db_querier->select_single_row_query('SELECT *
		FROM ' . NotificationsSetup::$notifications_users . '
		' . $condition, $parameters);
        $notificationUser = new NotificationUser();
        $notificationUser->set_properties($row);
        return $notificationUser;
    }

    public static function add_settings(NotificationUser $notification_user)
    {
        $result = self::$db_querier->insert(NotificationsSetup::$notifications_users, $notification_user->get_properties());
    }

    public static function update_settings(NotificationUser $notification_user)
    {
        self::$db_querier->update(NotificationsSetup::$notifications_users, $notification_user->get_properties(), 'WHERE user_id=:user_id', array('user_id' => $notification_user->getUserId()));
    }
}
