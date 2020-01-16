<?php

/**
 * Installation du module
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationsSetup extends DefaultModuleSetup
{
	public static $notifications_table;
	public static $notifications_users;

	public static function __static()
	{
		self::$notifications_table = PREFIX . 'notifications';
		self::$notifications_users = PREFIX . 'notifications_users';
	}

	public function install()
	{
		$this->drop_tables();
		$this->create_tables();
	}

	public function uninstall()
	{
		$this->drop_tables();
		$this->delete_configuration();
	}

	private function drop_tables()
	{
		PersistenceContext::get_dbms_utils()->drop(array(self::$notifications_table));
		PersistenceContext::get_dbms_utils()->drop(array(self::$notifications_users));
	}

	private function delete_configuration()
	{
		ConfigManager::delete('notifications', 'config');
	}

	private function create_tables()
	{
		$this->create_notifications_table();
		$this->create_notifications_users_table();
	}

	private function create_notifications_table()
	{
		$fields = array(
			'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
			'id_from' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
			'id_to' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
			'message' => array('type' => 'text', 'length' => 3000),
			'created_at' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
			'reading' => array('type' => 'integer', 'length' => 1, 'notnull' => 0, 'default' => 0),

		);
		$options = array(
			'primary' => array('id'),
		);
		PersistenceContext::get_dbms_utils()->create_table(self::$notifications_table, $fields, $options);
	}

	private function create_notifications_users_table()
	{
		$fields = array(
			'id' => array('type' => 'integer', 'length' => 11, 'autoincrement' => true, 'notnull' => 1),
			'user_id' => array('type' => 'integer', 'length' => 11, 'notnull' => 1, 'default' => 0),
			'articles' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'calendar' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'download' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'forum' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'gallery' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'media' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'news' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'web' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),
			'wiki' => array('type' => 'integer', 'length' => 1, 'notnull' => 1, 'default' => 0),


		);
		$options = array(
			'primary' => array('id'),
		);
		PersistenceContext::get_dbms_utils()->create_table(self::$notifications_users, $fields, $options);
	}
}
