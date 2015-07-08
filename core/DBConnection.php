<?php

class DBConnection
{
    use Singleton;
    
    public $_connection;
    private $_connSettings = array();

    private function __construct(){
        self::connect();
    }

    private function connect() {
        self::parseIni();
        try {
            $dsl = "mysql:host=".$this->_connSettings["HOST"].";dbname=".$this->_connSettings["DBNAME"];
            $this->_connection = new PDO($dsl, $this->_connSettings["USER"], $this->_connSettings["PASSWORD"] );
        } catch (PDOException $pdo_ex) {
            throw new PDOException ('Ошибка соединения с базой данных ' . $pdo_ex->getMessage());
        }
    }

    private function parseIni() {
        $this->_connSettings["HOST"]    = Application::$mainCfg["dbconnection"]["dbHost"];
        $this->_connSettings["DBNAME"]  = Application::$mainCfg["dbconnection"]["dbName"];
        $this->_connSettings["USER"]    = Application::$mainCfg["dbconnection"]["dbUser"];
        $this->_connSettings["PASSWORD"]= Application::$mainCfg["dbconnection"]["dbPass"];
    }

}