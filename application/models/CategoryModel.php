<?php

class CategoryModel {

    protected $id;        // primary key / первичный ключ
    protected $name;      // category name / название категории
    protected $moduleId;  // foreign key / внешний ключ

//    function __construct() {
//
//    }

    function __construct($id, $name, $moduleId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->moduleId = $moduleId;
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

    public function getModuleId()
    {
        return $this->moduleId;
    }

    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;
    }

}