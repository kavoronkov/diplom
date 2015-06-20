<?php

class Application {
    use Singleton;

    static public $mainCfg;

    public function init() {
        self::getApplicationConfig();
        self::setIncludePath();
        self::setAutoload();
        $fc = FrontController::getInstance();
    }

    private function getApplicationConfig() {
        self::$mainCfg = require_once "config/app.config.php";
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
        spl_autoload_register();
    }

}