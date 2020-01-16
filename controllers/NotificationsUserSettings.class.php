<?php

/**
 * Configuration des notifications pour les utilisateurs
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 09
 */
class NotificationsUserSettings extends ModuleController
{
    private $form;
    private $submit_button;
    private $lang;
    private $view;
    private $config;
    private $settings;
    private $is_new_settings;

    public function execute(HTTPRequestCustom $request)
    {
        $this->init();
        $this->build_form();


        if ($this->submit_button->has_been_submited() && $this->form->validate()) {
            $this->save();
            AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::settings()), LangLoader::get_message('notifications.config.save.success', 'common', 'notifications'));
        }

        $this->view->put('FORM', $this->form->display());
        $this->view->put_all(array(
            'ARCHIVES_NUMBER' => NotificationsService::count('WHERE id_to=' . AppContext::get_current_user()->get_id() . ' AND reading = 1'),
            'NOTIFICATIONS_NUMBER' => NotificationsService::count('WHERE id_to=' . AppContext::get_current_user()->get_id() . ' AND reading = 0'),
            'U_NOTIFICATIONS' => NotificationsUrlBuilder::home()->rel(),
            'U_ARCHIVES' => NotificationsUrlBuilder::archives()->rel(),
            'U_SETTINGS' => NotificationsUrlBuilder::settings()->rel(),
        ));

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
        $this->view  = new FileTemplate('notifications/NotificationsUserSettings.tpl');
        $this->view->add_lang($this->lang);
    }

    private function build_form()
    {
        $form = new HTMLForm(__CLASS__);
        $fieldset = new FormFieldsetHTMLHeading('config', $this->lang['notifications.config.title']);
        $form->add_fieldset($fieldset);

        $fieldset->add_field(new FormFieldCheckbox(
            'articles',
            $this->lang['notifications.config.articles'],
            $this->get_settings()->getArticles()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'calendar',
            $this->lang['notifications.config.calendar'],
            $this->get_settings()->getCalendar()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'download',
            $this->lang['notifications.config.download'],
            $this->get_settings()->getDownload()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'forum',
            $this->lang['notifications.config.forum'],
            $this->get_settings()->getForum()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'gallery',
            $this->lang['notifications.config.gallery'],
            $this->get_settings()->getGallery()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'media',
            $this->lang['notifications.config.media'],
            $this->get_settings()->getMedia()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'news',
            $this->lang['notifications.config.news'],
            $this->get_settings()->getNews()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'web',
            $this->lang['notifications.config.web'],
            $this->get_settings()->getWeb()
        ));

        $fieldset->add_field(new FormFieldCheckbox(
            'wiki',
            $this->lang['notifications.config.wiki'],
            $this->get_settings()->getWiki()
        ));



        $this->submit_button = new FormButtonDefaultSubmit();
        $form->add_button($this->submit_button);
        $form->add_button(new FormButtonReset());
        $this->form = $form;
    }

    private function get_settings()
    {
        if ($this->settings === null) {
            try {
                $this->settings = NotificationsService::get_settings('WHERE user_id=:user_id', array('user_id' => AppContext::get_current_user()->get_id()));
            } catch (RowNotFoundException $e) {
                $this->is_new_settings = true;
                $this->settings = new NotificationUser();
                $this->settings->init_default_properties();
            }
        }
        return $this->settings;
    }
    private function save()
    {
        $settings = $this->get_settings();
        $settings->setUserId(AppContext::get_current_user()->get_id());
        $settings->setArticles($this->form->get_value('articles'));
        $settings->setCalendar($this->form->get_value('calendar'));
        $settings->setDownload($this->form->get_value('download'));
        $settings->setForum($this->form->get_value('forum'));
        $settings->setGallery($this->form->get_value('gallery'));
        $settings->setMedia($this->form->get_value('media'));
        $settings->setNews($this->form->get_value('news'));
        $settings->setWeb($this->form->get_value('web'));
        $settings->setWiki($this->form->get_value('wiki'));

        if ($settings->getId() === null) {
            NotificationsService::add_settings($settings);
        } else {
            NotificationsService::update_settings($settings);
        }
    }

    private function generate_response()
    {
        $response = new SiteDisplayResponse($this->view);
        $graphical_environment = $response->get_graphical_environment();

        $breadcrumb = $graphical_environment->get_breadcrumb();
        $breadcrumb->add($this->lang['notifications'], NotificationsUrlBuilder::home());
        $breadcrumb->add($this->lang['notifications.config.title'], NotificationsUrlBuilder::settings());



        $graphical_environment->set_page_title($this->lang['notifications.config.title']);
        return $response;
    }
}
