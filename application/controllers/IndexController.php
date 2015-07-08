<?php

class IndexController implements IController {

    public function indexAction() {
        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
    }

}