<?php

class ModuleController {

    public function createModuleModel($name) {

        $objModuleModel = new ModuleModel(strtolower($name), strtoupper($name));
        return $objModuleModel;

    }

    public function insertModuleModel(ModuleModel $objModuleModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("INSERT INTO MODULE (id, name) VALUES (:id, :name)");

        $stmt->execute(array(":id" => $objModuleModel->getId(),
                             ":name" => $objModuleModel->getName()));
    }

}