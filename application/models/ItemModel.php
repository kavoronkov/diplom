<?php

class ItemModel {

    static public $counter;

    protected $id;          // primary key / первичный ключ
    protected $name;        // item name / название ресурса
    protected $link;        // item url / url ресурса
    protected $description; // item description // краткое описание
    protected $image;       // image url / url изображения
    protected $pubDate;     // item pubDate // дата публикации
    protected $text;        // item content / подробное описание
    protected $moduleId;    // foreign key / внешний ключ
    protected $categoryId;  // foreign key / внешний ключ
    protected $sourceId;    // foreign key / внешний ключ


    function __construct() {  }

//    function __construct($id, $item, $link, $description, $image, $pubDate, $text, $moduleId, $categoryId, $sourceId)
//    {
//        $this->id = $id;
//        $this->item = $item;
//        $this->link = $link;
//        $this->description = $description;
//        $this->image = $image;
//        $this->pubDate = $pubDate;
//        $this->text = $text;
//        $this->moduleId = $moduleId;
//        $this->categoryId = $categoryId;
//        $this->sourceId = $sourceId;
//    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setItem($name)
    {
        $this->name = $name;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPubDate()
    {
        return $this->pubDate;
    }

    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getModuleId()
    {
        return $this->moduleId;
    }

    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getSourceId()
    {
        return $this->sourceId;
    }

    public function setSourceId($sourceId)
    {
        $this->sourceId = $sourceId;
    }




}
