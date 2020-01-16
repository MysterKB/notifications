<?php

/**
 * Envoi de notification depuis l'administration
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class AdminNotificationsSendController extends AdminModuleController
{
	private $form;
	private $submit_button;
	private $lang;
	private $admin_common_lang;
	private $config;
	private $tpl;

	private $username;
	private $content;
	private $all_users;

	public function execute(HTTPRequestCustom $request)
	{
		$this->init();
		$this->build_form();

		$this->tpl = new StringTemplate('# INCLUDE MSG # # INCLUDE FORM #');
		$this->tpl->add_lang($this->lang);

		if ($this->submit_button->has_been_submited() && $this->form->validate()) {
			$this->save();
		}

		$this->tpl->put('FORM', $this->form->display());

		return new AdminNotificationsDisplayResponse($this->tpl, $this->lang['module_send_notification']);
	}
	private function init()
	{
		$this->config = NotificationsConfig::load();
		$this->lang = LangLoader::get('common', 'notifications');
		$this->admin_common_lang = LangLoader::get('admin-common');
	}

	private function build_form()
	{
		$form = new HTMLForm(__CLASS__);
		$fieldset = new FormFieldsetHTMLHeading('config', $this->lang['module_send_notification']);
		$form->add_fieldset($fieldset);

		// Champ qui ajoute les pseudos séparé par le symbole |
		$fieldset->add_field(new FormFieldTextEditor(
			'username',
			$this->lang['notifications.username'],
			$this->username,
			[
				'placeholder' => $this->lang['notifications.username.placeholder'],
				'description' => $this->lang['notifications.username.desc'],
				'maxlength' => 999
			]
		));

		// Si activé, on vide le champ username
		$fieldset->add_field(new FormFieldCheckbox(
			'all_users',
			$this->lang['notifications.all_users'],
			$this->all_users,
			['description' => $this->lang['notifications.all_users.desc']]
		));

		// Champ contenu de la notification
		$fieldset->add_field(new FormFieldRichTextEditor(
			'content',
			$this->lang['notifications.content'],
			$this->content,
			['required' => true, 'description' => $this->lang['notifications.content.desc']]
		));


		$this->submit_button = new FormButtonDefaultSubmit();
		$form->add_button($this->submit_button);
		$form->add_button(new FormButtonReset());
		$this->form = $form;
	}

	private function save()
	{
		if ($this->form->get_value('all_users')) { // Envoi à tous les membres
			$req_user = PersistenceContext::get_querier()->select_rows(PREFIX . 'member', array('user_id'), 'ORDER BY display_name');

			foreach ($req_user as $users) {
				$notification = new Notification();
				$notification->setIdTo($users['user_id']);
				$notification->setType('custom_admin');
				$notification->format('custom', [
					'user_id' => AppContext::get_current_user()->get_id(),
					'username' => AppContext::get_current_user()->get_display_name(),
					'message' => $this->form->get_value('content')
				]);
				$notification->add($notification);
			}
			$this->tpl->put('MSG', MessageHelper::display($this->lang['admin.message.send.success'], MessageHelper::SUCCESS, 5));
		} else {
			$array_user = explode('|', $this->form->get_value('username'));
			$nbr_user = count($array_user);
			$errors = '';

			// Boucle qui vérifie l'existence des utilisateurs
			foreach ($array_user as $user) {
				$user_exist = UserService::get_user_by_display_name($user);

				if ($user_exist) {
					$notification = new Notification();
					$notification->setIdTo($user_exist->get_id());
					$notification->setType("custom_admin");
					$notification->format('custom', [
						'user_id' => AppContext::get_current_user()->get_id(),
						'username' => AppContext::get_current_user()->get_display_name(),
						'message' => $this->form->get_value('content')
					]);
					$notification->add($notification);
					$this->tpl->put('MSG', MessageHelper::display($this->lang['admin.message.send.success'], MessageHelper::SUCCESS, 5));
				} else {
					$errors .= $user . ' '; // Ajout des pseudos qui n'ont pas reçu la notification car il n'existe pas.

				}
			}
			if (isset($errors) and !empty($errors)) {
				$this->tpl->put('MSG', MessageHelper::display(StringVars::replace_vars($this->lang['admin.message.send.error'], ['users' => $errors]), MessageHelper::WARNING, 10));
			}
		}
	}
}
