<?php

class FrontController {
    use Singleton;

    public function route() {
        $request = $_SERVER["REQUEST_URI"];
        // пРОВЕРИТЬ  на наличие знака ?
        $request = explode("?",$request);

        $request = trim($request,"/");

        $request = explode("/", $request);


        if(!empty($request[0])) {
            $ctrlName = $request[0] . "Controller";
            $actionName = $request[1] . "Action";

            if (class_exists($ctrlName)) {
                $ctrl = new $ctrlName();
                if($ctrl instanceof IController) {
                    if (method_exists($ctrl, $actionName)) {
                        $ctrl->$actionName();
                    }
                }
            }else {

            }
        }
    }
}