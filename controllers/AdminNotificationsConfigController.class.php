<?php

/**
 * Page de configuration du module de notification
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class AdminNotificationsConfigController extends AdminModuleController
{
    private $form;
    private $submit_button;
    private $lang;
    private $admin_common_lang;
    private $config;
    private $tpl;

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

        return new AdminNotificationsDisplayResponse($this->tpl, $this->lang['module_config_title']);
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
        $fieldset = new FormFieldsetHTMLHeading('config', $this->admin_common_lang['configuration']);
        $form->add_fieldset($fieldset);

        $fieldset->add_field(new FormFieldNumberEditor(
            'items_per_page',
            $this->admin_common_lang['config.items_number_per_page'],
            $this->config->getItemsPerPage(),
            array('class' => 'top-field', 'min' => 1, 'max' => 50, 'required' => true),
            array(new FormFieldConstraintIntegerRange(1, 50))
        ));

        $fieldset_params = new FormFieldsetHTMLHeading('params', $this->lang['admin.params']);
        $form->add_fieldset($fieldset_params);

        $fieldset_params->add_field(new FormFieldCheckbox(
            'automatic_archiving',
            $this->lang['admin.automatic_archiving'],
            $this->config->getAutomaticArchiving()
        ));

        $fieldset_params->add_field(new FormFieldCheckbox(
            'automatic_deletion',
            $this->lang['admin.automatic_deletion'],
            $this->config->getAutomaticDeletion()
        ));

        $this->submit_button = new FormButtonDefaultSubmit();
        $form->add_button($this->submit_button);
        $form->add_button(new FormButtonReset());
        $this->form = $form;
    }

    private function save()
    {
        if ($this->form->get_value('automatic_archiving') == TRUE and $this->form->get_value('automatic_deletion') == TRUE) {
            $this->tpl->put('MSG', MessageHelper::display(LangLoader::get_message('admin.message.error.1', 'common', 'notifications'), MessageHelper::ERROR, 8));
        } else {
            $this->config->setItemsPerPage($this->form->get_value('items_per_page'));
            $this->config->setAutomaticDeletion($this->form->get_value('automatic_deletion'));
            $this->config->setAutomaticArchiving($this->form->get_value('automatic_archiving'));
            NotificationsConfig::save();
            $this->tpl->put('MSG', MessageHelper::display(LangLoader::get_message('message.success.config', 'status-messages-common'), MessageHelper::SUCCESS, 5));
        }
    }
}
