<?php

class IndexController implements IController {

    public function indexAction() {
//        $r = new RenderView();
//        return $r->render("index");

//        echo "<h1> HHH HHH</h1>";

//        $objModuleController = new ModuleController();
//        //$obj = $objModuleController->createModuleModel("news");
//        $objModuleController->insertModuleModel($objModuleController->createModuleModel("news"));
//
//        $objCategoryController = new CategoryController();
//        //$obj = $objCategoryController->createCategoryModel($objModuleController, "politics");
//        $objCategoryController->insertCategoryModel($objCategoryController->createCategoryModel($objModuleController, "politics"));
//
        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
    }

    public function testAction() {
//        if($_SERVER["REQUEST_METHOD"])

        $json = file_get_contents("php://input");
        $o = json_decode($json);

        $objItemController = new ItemController();
        $objItemController->parseInsertLiga(new SourceModel());
        $resp = $objItemController->selectItemModel($o);
        echo json_encode($resp);


        echo "URA";
    }

}