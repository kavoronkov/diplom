<?php

class FrontController {
    use Singleton;

    public function route() {
        $request = $_SERVER["REQUEST_URI"];
        // пРОВЕРИТЬ  на наличие знака ?
        $request = explode("?",$request);

        $request = trim($request,"/");

        $request = explode("/", $request);

        $ctrlName = (!empty($request[0])) ? $request[0] . "Controller" : "IndexController";
        $actionName = (!empty($request[1])) ? $request[1] . "Action" : "pageNotFoundAction";

        if (class_exists($ctrlName)) {
            $ctrl = new $ctrlName();
            if($ctrl instanceof IController) {
                if (method_exists($ctrl, $actionName)) {
                    $ctrl->$actionName();
                }
            }
        }else {
            // action BAD
        }

    }
}