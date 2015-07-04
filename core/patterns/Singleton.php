<?php
/**
 * Created by PhpStorm.
 * User: teacher
 * Date: 20.06.2015
 * Time: 10:45
 */

trait Singleton {
    static private $_instance;

    private function __construct(){}

    final public function __destruct() {
        self::$_instance = null;
    }

        private function __clone(){}

    public static function getInstance() {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::$_instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }
}