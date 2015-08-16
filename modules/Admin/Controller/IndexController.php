<?php

namespace Admin\Controller;
use \IController;
use \RenderView;
use \ItemController;
use \SourceModel;
use \ModuleController;

class IndexController extends IController {

    public function indexAction() {
        $this->render("index",array());

//        echo "<h1> HHH HHH</h1>";

//        $objModuleController = new ModuleController();
//        //$obj = $objModuleController->createModuleModel("news");
//        $objModuleController->insertModuleModel($objModuleController->createModuleModel("news"));
//
//        $objCategoryController = new CategoryController();
//        //$obj = $objCategoryController->createCategoryModel($objModuleController, "politics");
//        $objCategoryController->insertCategoryModel($objCategoryController->createCategoryModel($objModuleController, "politics"));
//
//        $objItemController = new ItemController();
//        $objItemController->insertItemModel(new SourceModel());
    }

    public function moduleAction() {
        $objModuleController = new ModuleController();
        $modules = $objModuleController->selectAllModuleModel();
        $r = new RenderView(__CLASS__,array("modules"=>$modules));
        return $r->render("model");
    }

    public function testAction() {
//        if($_SERVER["REQUEST_METHOD"])

        $json = file_get_contents("php://input");
        $o = json_decode($json);

        $objItemController = new ItemController();
        $objItemController->insertItemModel(new SourceModel());
        $resp = $objItemController->selectItemModel($o);
        var_dump($resp);
        echo json_encode($resp);
    }

}