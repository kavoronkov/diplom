<?php

class FrontController {

    use Singleton;

    private $body;

    public function route() {
        $request = $_SERVER["REQUEST_URI"];

        $request = explode("?", $request);

        $params = $this->getUrlParams($request[0]);

        if($params["module"]){
            $ctrl = $params["module"]."\\Controller\\".$params["controller"];
            if (class_exists($ctrl)) {
                $ctrl = new $ctrl();
                if($ctrl instanceof IController) {
                    if (method_exists($ctrl, $params["action"])) {
                        $this->body = $ctrl->$params["action"]();
                    }
                }
            }else {
                echo "ERROR. NO MODULE CLASS";
            }
        }else{
            if (class_exists($params["controller"])) {
                $ctrl = new $params["controller"]();
                if($ctrl instanceof IController) {
                    if (method_exists($ctrl, $params["action"])) {
                        $this->body = $ctrl->$params["action"]();
                    }
                }
            }else {
                echo "ERROR. NO APPLICATION CLASS";
            }
        }

    }

    public function getBody()
    {
        echo $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    private function getUrlParams($route) {
        $route_mask = Application::$mainCfg["route_mask"];
        $explode_route = explode("/",trim($route,"/"));
        foreach($route_mask as $module => $mask) {
            if(preg_match($mask, $route)) {
                return array(
                    "module" => $module,
                    "controller" => (!empty($explode_route[1])) ? ucfirst($explode_route[1]) . "Controller" : "IndexController",
                    "action" => (!empty($explode_route[2])) ? $explode_route[2] . "Action" : "indexAction"
                );
            }
        }
        return array(
            "controller" => (!empty($explode_route[0])) ? ucfirst($explode_route[0]) . "Controller" : "IndexController",
            "action" => (!empty($explode_route[1])) ? $explode_route[1] . "Action" : "indexAction"
        );
    }
}