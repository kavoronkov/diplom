<?php

class ModelSource {

    protected $id;          // primary key / первичный ключ
    protected $name;        // source name / название ресурса
    protected $url;         // source url / url ресурса
    protected $xml;         // source xml / xml ресурса
    protected $title;       // source title / краткое описание ресурса
    protected $description; // source description // подробное описание ресурса
    protected $idForeign;   // foreign key / внешний ключ

    function __construct($id, $name, $url, $xml, $title, $description, $idForeign)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->xml = $xml;
        $this->title = $title;
        $this->description = $description;
        $this->idForeign = $idForeign;
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

    public function getIdForeign()
    {
        return $this->idForeign;
    }

    public function setIdForeign($idForeign)
    {
        $this->idForeign = $idForeign;
    }


}