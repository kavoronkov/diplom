<?php

class IndexController implements IController {

    public function indexAction() {

        $objModuleController = new ModuleController();
        //$obj = $objModuleController->createModuleModel("news");
        $objModuleController->insertModuleModel($objModuleController->createModuleModel("news"));

        $objCategoryController = new CategoryController();
        //$obj = $objCategoryController->createCategoryModel($objModuleController, "politics");
        $objCategoryController->insertCategoryModel($objCategoryController->createCategoryModel($objModuleController, "politics"));

        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
    }

}