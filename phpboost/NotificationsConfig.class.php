<?php

/**
 * Configuration du module
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationsConfig extends AbstractConfigData
{
    const NAME = 'notification';
    const ITEMS_PER_PAGE = 'items_per_page';
    const AUTOMATIC_ARCHIVING = 'automatic_archiving';
    const AUTOMATIC_DELETION = 'automatic_deletion';

    //Renvoie le nom du module
    public function get_name()
    {
        return $this->get_property(self::NAME);
    }

    //Modifie le nom du module
    public function set_name($name)
    {
        $this->set_property(self::NAME, $name);
    }

    /**
     * Obtenir le nombre de notifications par page
     *
     * @return void
     */
    public function getItemsPerPage()
    {
        return $this->get_property(self::ITEMS_PER_PAGE);
    }

    /**
     * Définir le nombre de notifications par page
     *
     * @param integer $item
     * @return void
     */
    public function setItemsPerPage($item)
    {
        $this->set_property(self::ITEMS_PER_PAGE, $item);
    }

    /**
     * Obtenir si l'archivage des notifications est automatique
     *
     * @return void
     */
    public function getAutomaticArchiving()
    {
        return $this->get_property(self::AUTOMATIC_ARCHIVING);
    }

    /**
     * Définir l'archiage des notifications en automatique
     *
     * @param boolean $archiving
     * @return void
     */
    public function setAutomaticArchiving($archiving)
    {
        $this->set_property(self::AUTOMATIC_ARCHIVING, $archiving);
    }

    /**
     * Permet de savoir si la suppression est automatique
     *
     * @return void
     */
    public function getAutomaticDeletion()
    {
        return $this->get_property(self::AUTOMATIC_DELETION);
    }

    /**
     * Définir la suppression automatique des notifications
     *
     * @param boolean $deletion
     * @return void
     */
    public function setAutomaticDeletion($deletion)
    {
        $this->set_property(self::AUTOMATIC_DELETION, $deletion);
    }

    public function get_default_values()
    {
        // Tableau de la configuration par défaut
        return array(
            self::NAME => 'Notifications',
            self::ITEMS_PER_PAGE => 15,
            self::AUTOMATIC_ARCHIVING => FALSE,
            self::AUTOMATIC_DELETION => FALSE,
        );
    }

    /**
     * Retourne la configuration
     * @return NotificationsConfig
     */
    public static function load()
    {
        return ConfigManager::load(__CLASS__, 'notifications', 'config');
    }

    /**
     * Enregistre la configuration dans la base de donnée
     */
    public static function save()
    {
        ConfigManager::save('notifications', self::load(), 'config');
    }
}
