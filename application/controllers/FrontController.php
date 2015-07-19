<?php

class FrontController {
    use Singleton;

    private $body;

    public function route() {
        $request = $_SERVER["REQUEST_URI"];
        // Проверить на наличие знака ?
        $request = explode("?", $request);

        $request = trim($request[0],"/");

        $request = explode("/", $request);

        $ctrlName = (!empty($request[0])) ? ucfirst($request[0]) . "Controller" : "IndexController";
        $actionName = (!empty($request[1])) ? $request[1] . "Action" : "indexAction";

        //echo "ctrl = ".$ctrlName;
       // echo "<br>method = ".$actionName;

        if (class_exists($ctrlName)) {
            //echo "yes class";
            $ctrl = new $ctrlName();
            if($ctrl instanceof IController) {
                if (method_exists($ctrl, $actionName)) {
                    $this->body = $ctrl->$actionName();
                }
            }
        }else {
            echo "no class";
            // action BAD
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
}