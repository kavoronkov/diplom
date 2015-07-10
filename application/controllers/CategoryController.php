<?php

class CategoryController {

    public function createCategoryModel(ModuleModel $objModuleModel, $name) {

        $id = $objModuleModel->getId() . ucfirst($name);
        $objCategoryModel = new CategoryModel($id, strtoupper($name), $objModuleModel->getId());
        return $objCategoryModel;

    }

    public function insertCategoryModel(CategoryModel $objCategoryModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("INSERT INTO CATEGORY (id, name, idForeign) VALUES (:id, :name, :idForeign)");

        $stmt->execute(array(":id" => $objCategoryModel->getId(),
                             ":name" => $objCategoryModel->getName(),
                             ":idForeign" => $objCategoryModel->getIdForeign()));

    }
}