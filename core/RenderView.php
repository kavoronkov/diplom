<?php
class RenderView
{
    private $_dir;

    public function __construct($className, array $params) {
        $namespaces = explode("\\", $className);
        foreach($params as $key => $val) {
            $this->$key = $val;
        }
        $this->_dir = (Application::$mainCfg["modules"][$namespaces[0]]["views"]) ?
                             Application::$mainCfg["modules"][$namespaces[0]]["views"] :
                             "default";
    }

    public function render($file) {
        $fileName = ($this->_dir == "default") ? ($file.".phtml") : ($this->_dir.DIRECTORY_SEPARATOR.$file.".phtml");
        ob_start();
        include $fileName;
        return ob_get_clean();
    }
}