<?php

class IndexController implements IController {

    public function indexAction() {

        return RenderView::render("index");

//        $objModuleController = new ModuleController();
//        //$obj = $objModuleController->createModuleModel("news");
//        $objModuleController->insertModuleModel($objModuleController->createModuleModel("news"));
//
//        $objCategoryController = new CategoryController();
//        //$obj = $objCategoryController->createCategoryModel($objModuleController, "politics");
//        $objCategoryController->insertCategoryModel($objCategoryController->createCategoryModel($objModuleController, "politics"));
//
//        $objItemController = new ItemController();
//        $objItemController->parseInsertLiga(new SourceModel());
    }

    public function testAction() {



        $json = file_get_contents("php://input");
        $o = json_decode($json);
//        var_dump($o);

        $o->module = "no module like " . $o->module;

        echo json_encode($o);


//        echo '{"resp":"URA"}';
    }

}