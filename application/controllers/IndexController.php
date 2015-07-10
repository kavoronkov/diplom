<?php

class IndexController implements IController {

    public function indexAction() {

        $objModuleController = new ModuleController();
        //$obj = $objModuleController->createModuleModel("news");
        $objModuleController->insertModuleModel($objModuleController->createModuleModel("news"));


        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
    }

}