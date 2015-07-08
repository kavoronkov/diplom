<?php

class DBConnection
{
    use Singleton;

    public $_connection;
    private $_connectionSettings = array();

    private function __construct(){
        self::connect();
    }

    private function connect() {
        self::parseIni();
        try {
            $dbConnectionString = "mysql:host=".$this->_connectionSettings["HOST"].";dbname=".$this->_connectionSettings["DBNAME"];
            $this->_connection = new PDO($dbConnectionString, $this->_connectionSettings["USER"], $this->_connectionSettings["PASSWORD"] );
        } catch (PDOException $pdo_ex) {
            throw new PDOException ('Ошибка соединения с базой данных ' . $pdo_ex->getMessage());
        }
    }

    private function parseIni() {
        $this->_connectionSettings["HOST"]     = Application::$mainCfg["dbconnection"]["dbHost"];
        $this->_connectionSettings["DBNAME"]   = Application::$mainCfg["dbconnection"]["dbName"];
        $this->_connectionSettings["USER"]     = Application::$mainCfg["dbconnection"]["dbUser"];
        $this->_connectionSettings["PASSWORD"] = Application::$mainCfg["dbconnection"]["dbPass"];
    }

}