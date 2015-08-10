<?php

class IndexController extends IController {

    public function indexAction() {
       return $this->render("index", array());
    }

    public function testAction() {
        $json = file_get_contents("php://input");
        $json_request = json_decode($json);

        $objSourceController = new SourceController();
        $objSourceController->selectSourceModel($json_request);
        $objItemController = new ItemController();
        $objItemController->parseInsertLiga($objSourceController);
        $selection = $objItemController->selectItemModel($json_request);

        echo json_encode($selection);
    }

}