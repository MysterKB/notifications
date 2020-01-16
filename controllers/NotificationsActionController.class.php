<?php

/**
 * Permet de gérer la suppression et l'archivage des notifications 
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 09
 */
class NotificationsActionController extends ModuleController
{
    public function execute(HTTPRequestCustom $request)
    {
        if (!AppContext::get_current_user()->check_level(User::MEMBER_LEVEL)) {
            $error_controller = PHPBoostErrors::user_not_authorized();
            DispatchManager::redirect($error_controller);
        }

        AppContext::get_session()->csrf_get_protect();
        $id =  AppContext::get_request()->get_postarray('id');
        $deleted = (bool) retrieve(POST, 'deleted', false);
        $archived = (bool) retrieve(POST, 'archived', false);

        if (!empty($id)) {

            // Suppression des notifications
            if (isset($deleted) and $deleted) {
                $nbr_deleted = count($id);
                foreach ($id as $delete) {

                    NotificationsService::delete('WHERE id=:id AND id_to=:id_to', ['id' => $delete, 'id_to' => AppContext::get_current_user()->get_id()]);
                }
                // Redirection avec message en fonction de singulier/pluriel
                if ($nbr_deleted > 1) {
                    AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::home()), LangLoader::get_message('notifications.deleted_success', 'common', 'notifications'));
                } else {
                    AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::home()), LangLoader::get_message('notifications.deleted_success.one', 'common', 'notifications'));
                }
            }
            // Archivage des notifications
            if (isset($archived) and $archived) {
                $nbr_archived = count($id);
                foreach ($id as $archive) {
                    PersistenceContext::get_querier()->update(PREFIX . 'notifications', array(
                        'reading' => 1
                    ), 'WHERE id=:id AND id_to=:id_to', array('id' => $archive, 'id_to' => AppContext::get_current_user()->get_id()));
                }
                // Redirection avec message en fonction de singulier/pluriel
                if ($nbr_archived > 1) {
                    AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::archives()), LangLoader::get_message('notifications.archiving_success', 'common', 'notifications'));
                } else {
                    AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::archives()), LangLoader::get_message('notifications.archiving_success.one', 'common', 'notifications'));
                }
            }
        } // Fin de la condition s'il ne manque pas form_action
        else {
            AppContext::get_response()->redirect(($request->get_url_referrer() ? $request->get_url_referrer() : NotificationsUrlBuilder::home()), LangLoader::get_message('notifications.deleted_or_archived.error', 'common', 'notifications'), MessageHelper::WARNING, 5);
        }
    }
}
