<?php
class RenderView
{
    private $_dir;
    private $_params;

    public function __construct($className,array $params) {
        $namespaces = explode("\\",$className);
//        $this->_params = $params;
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