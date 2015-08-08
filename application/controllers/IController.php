<?php

abstract class  IController {
    abstract public function indexAction();
    protected function render($view,array $params) {
        $r = new RenderView(__CLASS__,$params);
        return $r->render($view);
    }
}