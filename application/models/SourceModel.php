<?php

class SourceModel {

    protected $id;          // primary key / первичный ключ
    protected $name;        // source name / название ресурса
    protected $url;         // source url / url ресурса
    protected $xml;         // source xml / xml ресурса
    protected $title;       // source title / краткое описание ресурса
    protected $description; // source description // подробное описание ресурса
    protected $moduleId;    // foreign key / внешний ключ
    protected $categoryId;  // foreign key / внешний ключ

//    function __construct() {
//
//    }

    function __construct($id, $name, $url, $xml, $title, $description, $moduleId, $categoryId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->xml = $xml;
        $this->title = $title;
        $this->description = $description;
        $this->moduleId = $moduleId;
        $this->categoryId = $categoryId;
    }

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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function setXml($xml)
    {
        $this->xml = $xml;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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


}