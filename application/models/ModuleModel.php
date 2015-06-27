<?php

class ModelModule {

    protected $id;   // primary key / первичный ключ
    protected $name; // category name / название категории

    function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(){
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