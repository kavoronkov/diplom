<?php

abstract class  IController {
    abstract public function indexAction();
    protected function render($view, array $params) {
        $renderView = new RenderView(__CLASS__, $params);
        return $renderView->render($view);
    }
}