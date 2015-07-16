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

    public function selectModuleModel($name) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("SELECT Module.id, Module.name
                               FROM Module WHERE Module.name = :name");
        $stmt->bindParam(':name', strtoupper($name), PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array(":name" => strtoupper($name)));

        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt;
    }

    public function updateModuleModel($name) {

    }

    public function deleteModuleModel($name) {

    }
}