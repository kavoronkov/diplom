<?php

class DB
{
    protected static $_instance;
    private $_connection;

    private function __construct(){}

    private function __clone(){}

    //private function __wakeup() {}

    public static function getInstance() {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::$_instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }

    public function connect() {
        try {
            $_connection_settings = parse_ini_file('config.ini');
            $this->_connection = new PDO($_connection_settings['db.conn'],
                                         $_connection_settings['db.user'],
                                         $_connection_settings['db.pass']);
        } catch (PDOException $pdo_ex) {
            throw new PDOException ('Ошибка соединения с базой данных '.$pdo_ex->getMessage());
        }
    }
}