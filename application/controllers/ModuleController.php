<?php

class ModuleController {

    public function createModuleModel($name) {

        ModuleModel::$counter++;
        $objModuleModel = new ModuleModel(ModuleModel::$counter, $name);
        return $objModuleModel;

    }

    public function insertModuleModel(ModuleModel $objModuleModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("INSERT INTO MODULE (id, name) VALUES (:id, :name)");

        $stmt->execute(array(":id" => $objModuleModel->getId(),
                             ":name" => $objModuleModel->getName()));
    }

}