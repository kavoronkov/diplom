<?php

class CategoryModel {

    protected $id;        // primary key / первичный ключ
    protected $name;      // name news category/ название новостной категории
    protected $idForeign; // foreign key / внешний ключ

    function __construct($id, $name, $idForeign)
    {
        $this->id = $id;
        $this->name = $name;
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

    public function getIdForeign()
    {
        return $this->idForeign;
    }

    public function setIdForeign($idForeign)
    {
        $this->idForeign = $idForeign;
    }

}