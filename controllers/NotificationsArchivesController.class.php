<?php

/**
 * Archives des notifications
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 09
 */
class NotificationsArchivesController extends ModuleController
{
    private $lang;
    private $view;
    private $config;
    private $number_of_read_notifications;

    public function execute(HTTPRequestCustom $request)
    {
        $this->init();
        $this->build_view();
        return $this->generate_response();
    }

    private function init()
    {
        if (!AppContext::get_current_user()->check_level(User::MEMBER_LEVEL)) {
            $error_controller = PHPBoostErrors::user_not_authorized();
            DispatchManager::redirect($error_controller);
        }

        $this->config = NotificationsConfig::load();
        $this->lang = LangLoader::get('common', 'notifications');
        $this->view  = new FileTemplate('notifications/NotificationsArchivesController.tpl');
        $this->view->add_lang($this->lang);
    }

    private function build_view()
    {
        $user_accounts_config = UserAccountsConfig::load();
        $this->number_of_read_notifications = NotificationsService::count('WHERE id_to=' . AppContext::get_current_user()->get_id() . ' AND reading = 1');
        $page = AppContext::get_request()->get_getint('page', 1);
        $pagination = $this->get_pagination($this->number_of_read_notifications, $page);

        $result = PersistenceContext::get_querier()->select(
            'SELECT member.*, notifications.*, m_extend.user_avatar
		FROM ' . NotificationsSetup::$notifications_table . ' notifications
        LEFT JOIN ' . DB_TABLE_MEMBER . ' member ON member.user_id = notifications.id_from
        LEFT JOIN ' . DB_TABLE_MEMBER_EXTENDED_FIELDS . ' m_extend ON m_extend.user_id = member.user_id
        WHERE id_to=:id_to AND reading=1
        ORDER BY notifications.created_at DESC
        LIMIT :number_items_per_page OFFSET :display_from',
            array(
                'id_to' => AppContext::get_current_user()->get_id(),
                'number_items_per_page' => $pagination->get_number_items_per_page(),
                'display_from' => $pagination->get_display_from()
            )
        );

        while ($row = $result->fetch()) {
            $notification = new Notification();
            $notification->set_properties($row);
            $user_avatar = !empty($row['user_avatar']) ? Url::to_rel($row['user_avatar']) : ($user_accounts_config->is_default_avatar_enabled() ? Url::to_rel('/templates/' . AppContext::get_current_user()->get_theme() . '/images/' .  $user_accounts_config->get_default_avatar_name()) : '');

            $this->view->assign_block_vars(
                'notifications',
                array_merge($notification->get_array_tpl_vars($page)),
                array( // Cela concerne l'expéditeur (id_from)
                    'C_AVATAR' => $row['user_avatar'] || ($user_accounts_config->is_default_avatar_enabled()),
                    'USERNAME' => $row['display_name'],
                    'USER_AVATAR' => $row['user_avatar'],
                    'U_AVATAR' => $user_avatar
                )
            );
        }

        $result->dispose();

        $this->view->put_all(array(
            'C_NO_NOTIFICATION' => $result->get_rows_count() == 0,
            'C_PAGINATION' => $this->number_of_read_notifications > NotificationsConfig::load()->getItemsPerPage(),
            'PAGINATION' => $pagination->display(),
            'ARCHIVES_NUMBER' => $this->number_of_read_notifications,
            'NOTIFICATIONS_NUMBER' => NotificationsService::count('WHERE id_to=' . AppContext::get_current_user()->get_id() . ' AND reading = 0'),
            'U_ARCHIVES' => NotificationsUrlBuilder::archives()->rel(),
            'U_SETTINGS' => NotificationsUrlBuilder::settings()->rel(),
            'U_NOTIFICATIONS' => NotificationsUrlBuilder::home()->rel(),
            'U_FORM' => NotificationsUrlBuilder::form_action()->rel(),


        ));
    }

    private function get_pagination($notifications_number, $page)
    {
        $pagination = new ModulePagination($page, $notifications_number, (int) NotificationsConfig::load()->getItemsPerPage());
        $pagination->set_url(NotificationsUrlBuilder::archives('%d'));
        if ($pagination->current_page_is_empty() && $page > 1) {
            $error_controller = PHPBoostErrors::unexisting_page();
            DispatchManager::redirect($error_controller);
        }
        return $pagination;
    }

    private function generate_response()
    {
        $page = AppContext::get_request()->get_getint('page', 1);

        $response = new SiteDisplayResponse($this->view);
        $graphical_environment = $response->get_graphical_environment();

        $breadcrumb = $graphical_environment->get_breadcrumb();
        $breadcrumb->add($this->lang['notifications'], NotificationsUrlBuilder::home());
        $breadcrumb->add($this->lang['notifications.archives'], NotificationsUrlBuilder::archives($page));


        $graphical_environment->set_page_title($this->lang['notifications.archives']);
        return $response;
    }
}
