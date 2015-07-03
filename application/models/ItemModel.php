<?php

class ItemModel {

    static public $counter;

    protected $id;          // primary key / первичный ключ
    protected $item;        // item name / название ресурса
    protected $link;        // item url / url ресурса
    protected $description; // item description // краткое описание ресурса
    protected $image;       // image url / url изображения
    protected $pubDate;     // item pubDate // дата публикации
    protected $text;        // item content / подробное описание ресурса
    protected $idForeign;   // foreign key / внешний ключ

    function __construct() { }

//    function __construct($id, $item, $link, $description, $image, $pubDate, $text, $idForeign)
//    {
//        $this->id = $id;
//        $this->item = $item;
//        $this->link = $link;
//        $this->description = $description;
//        $this->image = $image;
//        $this->pubDate = $pubDate;
//        $this->text = $text;
//        $this->idForeign = $idForeign;
//    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;
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

    public function getIdForeign()
    {
        return $this->idForeign;
    }

    public function setIdForeign($idForeign)
    {
        $this->idForeign = $idForeign;
    }


}
