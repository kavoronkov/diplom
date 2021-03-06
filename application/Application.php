<?php

class Application {

    static private $_instance;

    private function __construct(){}

    final public function __destruct() {
        self::$_instance = null;
    }

    private function __clone(){}

    public static function getInstance() {
        // ��������� ������������ ����������
        if (null === self::$_instance) {
            // ������� ����� ���������
            self::$_instance = new self();
        }
        // ���������� ��������� ��� ������������ ���������
        return self::$_instance;
    }

    static public $mainCfg;

    public function init() {
        self::getApplicationConfig();
        self::setIncludePath();
        self::setAutoload();
        $objFrontController = FrontController::getInstance();
        return $objFrontController;
    }
    private function getApplicationConfig() {
        self::$mainCfg = require_once "config/application.config.php";
    }
    private function setIncludePath() {
        if(is_array(self::$mainCfg["path"]) && !empty(self::$mainCfg["path"])) {
            $includePath = "";
            foreach(self::$mainCfg["path"] as $path) {
                $includePath .= PATH_SEPARATOR . $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.$path; }
            set_include_path(get_include_path() . $includePath);
            return true;
        }else {
            return false; }
    }
    private function setAutoload() {
        $autoLoad = self::$mainCfg["autoload"];
        require_once ($autoLoad["class"].".php");
        spl_autoload_register(array( $autoLoad["class"], $autoLoad["method"]));
    }
}