<?php

/**
 * Définition des paramètres de notification d'un utilisateur
 * @copyright   © 2005-2019 PHPBoost
 * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL-3.0
 * @author      Kévin BRISSEZ <brissez.kevin@gmail.com>
 * @version     PHPBoost 5.2 - last update: 2020 01 08
 */
class NotificationUser
{
    private $id;
    private $user_id;
    private $articles;
    private $calendar;
    private $download;
    private $forum;
    private $gallery;
    private $media;
    private $news;
    private $web;
    private $wiki;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of articles
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set the value of articles
     *
     * @return  self
     */
    public function setArticles(int $articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get the value of calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set the value of calendar
     *
     * @return  self
     */
    public function setCalendar(int $calendar)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get the value of download
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * Set the value of download
     *
     * @return  self
     */
    public function setDownload(int $download)
    {
        $this->download = $download;

        return $this;
    }

    /**
     * Get the value of forum
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * Set the value of forum
     *
     * @return  self
     */
    public function setForum(int $forum)
    {
        $this->forum = $forum;

        return $this;
    }

    /**
     * Get the value of gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set the value of gallery
     *
     * @return  self
     */
    public function setGallery(int $gallery)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get the value of media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set the value of media
     *
     * @return  self
     */
    public function setMedia(int $media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get the value of news
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * Set the value of news
     *
     * @return  self
     */
    public function setNews(int $news)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get the value of web
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set the value of web
     *
     * @return  self
     */
    public function setWeb(int $web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get the value of wiki
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of wiki
     *
     * @return  self
     */
    public function setWiki(int $wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

    public function get_properties()
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUserId(),
            'articles' => $this->getArticles(),
            'calendar' => $this->getCalendar(),
            'download' => $this->getDownload(),
            'forum' => $this->getForum(),
            'gallery' => $this->getGallery(),
            'media' => $this->getMedia(),
            'news' => $this->getNews(),
            'web' => $this->getWeb(),
            'wiki' => $this->getWiki()
        ];
    }

    public function set_properties(array $properties)
    {
        $this->id = $properties['id'];
        $this->user_id = $properties['user_id'];
        $this->articles = $properties['articles'];
        $this->calendar = $properties['calendar'];
        $this->download = $properties['download'];
        $this->forum = $properties['forum'];
        $this->gallery = $properties['gallery'];
        $this->media = $properties['media'];
        $this->news = $properties['news'];
        $this->web = $properties['web'];
        $this->wiki = $properties['wiki'];
    }

    public function init_default_properties()
    {
        $this->articles = 0;
        $this->calendar = 0;
        $this->download = 0;
        $this->forum = 0;
        $this->gallery = 0;
        $this->media = 0;
        $this->news = 0;
        $this->web = 0;
        $this->wiki = 0;
    }
}
