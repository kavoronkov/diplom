<?php

class ModuleModel {

    protected $id;   // primary key / первичный ключ
    protected $name; // module name / название модуля

    function __construct() {  }

//    function __construct($id, $name)
//    {
//        $this->id = $id;
//        $this->name = $name;
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

    public function setName($name)
    {
        $this->name = $name;
    }

}