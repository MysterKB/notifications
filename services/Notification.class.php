<?php

/**
 * Définition d'une notification
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class Notification
{
    private $id;
    private $id_from;
    private $id_to;
    private $message;
    private $created_at;
    private $reading;
    private $type;

    public function __construct()
    {
        // On appel les propriétés par défaut à la construction de l'objet
        self::init_default_properties();
    }

    /**
     * Obtenir l'id de la notification
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Définir l'id de la notification
     *
     * @param integer $id
     * @return void
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Obtenir l'id de l'expéditeur
     *
     * @return integer|null
     */
    public function getIdFrom(): ?int
    {
        return $this->id_from;
    }

    /**
     * Définir l'id de l'expéditeur
     *
     * @param integer $id
     * @return void
     */
    public function setIdFrom(int $id)
    {
        $this->id_from = $id;
    }

    /**
     * Obtenir l'id du destinataire
     *
     * @return integer|null
     */
    public function getIdTo(): ?int
    {
        return $this->id_to;
    }

    /**
     * Définir l'id du destinataire
     *
     * @param integer $id
     * @return void
     */
    public function setIdTo(int $id)
    {
        $this->id_to = $id;
    }

    /**
     * Obtenir le message d'une notification perso
     *
     * @return void
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Définir le message d'une notification perso
     *
     * @param string $message
     * @return void
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Obtenir la date de création de la notification
     *
     * @return void
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Définir la date de création de la notification
     *
     * @param Date $date
     * @return void
     */
    public function setCreatedAt(Date $date)
    {
        $this->created_at = $date;
    }

    /**
     * Retourne TRUE ou FALSE si la notification a été lue (False si non lue)
     *
     * @return int|null
     */
    public function getReading()
    {
        return $this->reading;
    }

    /**
     * Définir la lecture de la notification (True si lue, false si non lue)
     *
     * @param int $reading
     * @return void
     */
    public function setReading(int $reading)
    {
        $this->reading = $reading;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Permet de formater le contenu d'une notification
     *
     * @param [string] $lang
     * @param [array] $params
     * @return void
     */
    public function format(string $lang, array $params)
    {
        $this->message = StringVars::replace_vars(LangLoader::get_message('notifications.' . $lang, 'common', 'notifications'), $params);
    }

    /**
     * Ajoute une notification
     *
     * @param self $notification
     * @return void
     */
    public function add(self $notification)
    {
        // On vérifie que ce n'est pas une notification custom d'un admin, et ensuite on vérifie que l'utilisateur accepte bien le type de notification
        if ($this->type != "custom_admin") {
            try {
                $accept_notification = PersistenceContext::get_querier()->select_single_row(PREFIX . 'notifications_users', array('*'), 'WHERE user_id=:user_id AND ' . $this->type . '= 1', array(
                    'user_id' => $this->id_to
                ));
            } catch (RowNotFoundException $e) {
            }
        }

        if (isset($accept_notification) or $this->type == "custom_admin") { // Si l'utilisateur accepte ce genre de notification, ou si c'est une notification de la part d'un admin, on envoi la notification
            NotificationsService::add($notification);
        }
    }

    /**
     * Obtenir les propriétés de l'objet notification
     *
     * @return void
     */
    public function get_properties()
    {
        return [
            'id' => $this->getId(),
            'id_from' => $this->getIdFrom(),
            'id_to' => $this->getIdTo(),
            'message' => $this->getMessage(),
            'created_at' => $this->getCreatedAt()->get_timestamp(),
            'reading' => $this->getReading(),
        ];
    }

    /**
     * Assigner les propriétés de l'objet notification
     *
     * @param array $properties
     * @return void
     */
    public function set_properties(array $properties)
    {
        $this->id = $properties['id'];
        $this->id_from = $properties['id_from'];
        $this->id_to = $properties['id_to'];
        $this->message = $properties['message'];
        $this->created_at = new Date($properties['created_at'], Timezone::SERVER_TIMEZONE);
        $this->reading = $properties['reading'];
    }

    /**
     * Permet de définir les attributs par défaut
     *
     * @return void
     */
    public function init_default_properties()
    {
        $this->id_from = AppContext::get_current_user()->get_id();
        $this->created_at = new Date();
        $this->reading = 0;
    }

    public function get_array_tpl_vars($page = 1)
    {
        return array_merge(
            Date::get_array_tpl_vars($this->created_at, 'date'),
            array(
                //Notification               
                'ID' => $this->id,
                'MESSAGE' => FormatingHelper::second_parse($this->message),
                'U_USER' => UserUrlBuilder::profile($this->id_from)->rel(),

            )
        );
    }
}
