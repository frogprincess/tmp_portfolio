<?php
namespace Portfolio\Model;

Class Portfolio {

    protected $id;
    protected $title;
    protected $short_title;
    protected $thumb;
    protected $lightbox;
    protected $client;
    protected $tools;
    protected $url;
    protected $url_text;
    protected $banner;
    protected $html;
    protected $sort;
    protected $hide;

    /**
     * Getter for id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setter for id
     *
     * @param mixed $id Value to set
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Getter for title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Setter for title
     *
     * @param mixed $title Value to set
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Getter for short_title
     *
     * @return mixed
     */
    public function getShortTitle()
    {
        return $this->short_title;
    }

    /**
     * Setter for short_title
     *
     * @param mixed $shortTitle Value to set
     * @return self
     */
    public function setShortTitle($shortTitle)
    {
        $this->short_title = $shortTitle;
        return $this;
    }

    /**
     * Getter for thumb
     *
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Setter for thumb
     *
     * @param mixed $thumb Value to set
     * @return self
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
        return $this;
    }

    /**
     * Getter for lightbox
     *
     * @return mixed
     */
    public function getLightbox()
    {
        return $this->lightbox;
    }

    /**
     * Setter for lightbox
     *
     * @param mixed $lightbox Value to set
     * @return self
     */
    public function setLightbox($lightbox)
    {
        $this->lightbox = $lightbox;
        return $this;
    }

    /**
     * Getter for client
     *
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Setter for client
     *
     * @param mixed $client Value to set
     * @return self
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Getter for tools
     *
     * @return mixed
     */
    public function getTools()
    {
        return $this->tools;
    }

    /**
     * Setter for tools
     *
     * @param mixed $tools Value to set
     * @return self
     */
    public function setTools($tools)
    {
        $this->tools = $tools;
        return $this;
    }

    /**
     * Getter for url
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Setter for url
     *
     * @param mixed $url Value to set
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Getter for url_text
     *
     * @return mixed
     */
    public function getUrlText()
    {
        return $this->url_text;
    }

    /**
     * Setter for url_text
     *
     * @param mixed $urlText Value to set
     * @return self
     */
    public function setUrlText($urlText)
    {
        $this->url_text = $urlText;
        return $this;
    }

    /**
     * Getter for banner
     *
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Setter for banner
     *
     * @param mixed $banner Value to set
     * @return self
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
        return $this;
    }

    /**
     * Getter for html
     *
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Setter for html
     *
     * @param mixed $html Value to set
     * @return self
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * Getter for sort
     *
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Setter for sort
     *
     * @param mixed $sort Value to set
     * @return self
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * Getter for hide
     *
     * @return mixed
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Setter for hide
     *
     * @param mixed $hide Value to set
     * @return self
     */
    public function setHide($hide)
    {
        $this->hide = $hide;
        return $this;
    }


}