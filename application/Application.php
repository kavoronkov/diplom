<?php

class Application {
    static public $mainCfg;

    static private $_instance;

    private function __construct(){}

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



    public function init() {
        self::getApplicationConfig();
        self::setIncludePath();
        self::setAutoload();
        $fc = FrontController::getInstance();
    }

    private function getApplicationConfig() {
        self::$mainCfg = require_once "config/application.config.php";
    }

    private function setIncludePath() {
        if(is_array(self::$mainCfg["path"]) && !empty(self::$mainCfg["path"])) {
            $includePath = "";
            foreach(self::$mainCfg["path"] as $path) {
                $includePath .= PATH_SEPARATOR . $path; }
            set_include_path(get_include_path() . $includePath);
            return true;
        }else {
            return false; }
    }

    private function setAutoload() {
        $al = self::$mainCfg["autoload"];
        require_once ($al["class"].".php");
        spl_autoload_register(array( $al["class"], $al["method"]));
    }

}