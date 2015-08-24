<?php

class IndexController extends IController {

    public function indexAction() {
       return $this->render("index", array());
    }
    public function moduleAction() {
        return $this->render("module", array());
    }
    public function categoryAction() {
        return $this->render("category", array());
    }
    public function sourceAction() {
        return $this->render("source", array());
    }

    public function requestAction() {
        $json = file_get_contents("php://input");
        $json_request = json_decode($json);

        $objSourceController = new SourceController();
        $objSourceModel = $objSourceController->selectSourceModel($json_request);

        $objItemController = new ItemController();
        if($json_request->id === "") {
            $objItemController->insertItemModel($objSourceModel[0]);
        } elseif($json_request->id === "-1") {
            $select = $objItemController->selectItemModelNoId($json_request);
            echo json_encode($select);
        } else {
            $objItemController->insertItemModel($objSourceModel[0]);
            $selection = $objItemController->selectItemModel($json_request);
            echo json_encode($selection);
        }
    }

    public function exchangeAllAction() {
//        $json = file_get_contents("php://input");
//        $json_request = json_decode($json);

        $objModuleController = new ModuleController();
        $objModuleModel = $objModuleController->selectAllModuleModel();
        echo json_encode($objModuleModel);

        $objCategoryController = new CategoryController();
        $objCategoryModel = $objCategoryController->selectAllCategoryModel();
        echo json_encode($objCategoryModel);

        $objSourceController = new SourceController();
        $objSourceModel = $objSourceController->selectAllSourceModel();
        echo json_encode($objSourceModel);
    }
    public function exchangeModuleAction() {
//        $json = file_get_contents("php://input");
//        $json_request = json_decode($json);

        $objModuleController = new ModuleController();
        $objModuleModel = $objModuleController->selectAllModuleModel();
        echo json_encode($objModuleModel);
    }
    public function exchangeCategoryAction() {
//        $json = file_get_contents("php://input");
//        $json_request = json_decode($json);

        $objCategoryController = new CategoryController();
        $objCategoryModel = $objCategoryController->selectAllCategoryModel();
        echo json_encode($objCategoryModel);
    }
    public function exchangeSourceAction() {
//        $json = file_get_contents("php://input");
//        $json_request = json_decode($json);

        $objSourceController = new SourceController();
        $objSourceModel = $objSourceController->selectAllSourceModel();
        echo json_encode($objSourceModel);
    }
}