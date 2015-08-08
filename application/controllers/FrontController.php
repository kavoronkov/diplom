<?php

class FrontController {
    use Singleton;

    private $body;

    public function route() {
        $request = $_SERVER["REQUEST_URI"];
        // Проверить на наличие знака ?
        $request = explode("?", $request);

        $params = $this->getUrlParams($request[0]);

        //echo "ctrl = ".$ctrlName;
       // echo "<br>method = ".$actionName;
//    var_dump($params);
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
                echo "no mod class";
                // action BAD
            }
        }else{
            if (class_exists($params["controller"])) {
//                echo "yes class";
                $ctrl = new $params["controller"]();
                if($ctrl instanceof IController) {
                    if (method_exists($ctrl, $params["action"])) {
                        $this->body = $ctrl->$params["action"]();
                    }
                }
            }else {
                echo "no class";
                // action BAD
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
        $f = explode("/",trim($route,"/"));
        foreach($route_mask as $module => $mask) {
            if(preg_match($mask,$route)) {
                return array(
                    "module" => $module,
                    "controller" => (!empty($f[1])) ? ucfirst($f[1]) . "Controller" : "IndexController",
                    "action" => (!empty($f[2])) ? $f[2] . "Action" : "indexAction"
                );
            }
        }
        return array(
            "controller" => (!empty($f[0])) ? ucfirst($f[0]) . "Controller" : "IndexController",
            "action" => (!empty($f[1])) ? $f[1] . "Action" : "indexAction"
        );
    }
}