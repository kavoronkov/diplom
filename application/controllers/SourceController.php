<?php

class SourceController {

    public function createSourceModel() {

    }

    private function createIdSourceModel(SourceModel $objSourceModel) {
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000 + ItemModel::$counter);
        $objSourceModel->setId($id);
    }

}