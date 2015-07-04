<?php

class IndexController implements IController {

    public function indexAction() {
        echo " = = = indexaction";
        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
    }

}