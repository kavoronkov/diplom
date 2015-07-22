<?php

class ModuleController
{
    public function createModuleModel($moduleName)
    {
        $objModuleModel = new ModuleModel(strtolower($moduleName), strtolower($moduleName));
        return $objModuleModel;
    }
    public function insertModuleModel(ModuleModel $objModuleModel)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtInsertModule = $db->prepare("INSERT INTO Module (id, name) VALUES (:moduleId, :moduleName)");
        $stmtInsertModule->bindParam(':moduleId', strtolower($objModuleModel->getId()), PDO::PARAM_STR);
        $stmtInsertModule->bindParam(':moduleName', strtolower($objModuleModel->getName()), PDO::PARAM_STR);
        $stmtInsertModule->execute();
//        $stmtInsertModule->execute(array(":moduleId" => strtolower($objModuleModel->getId()),
//                                         ":moduleName" => strtolower($objModuleModel->getName())));
    }
    public function selectModuleModel($moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtSelectModule = $db->prepare("SELECT * FROM Module WHERE Module.id = . :moduleId ");
        $stmtSelectModule->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtSelectModule->execute();
//        $stmtSelectModule->execute(array(":moduleId" => strtolower($moduleId)));
        $stmtSelectModule = $stmtSelectModule->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectModule;
    }
    public function updateModuleModel($moduleId, $moduleName)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtUpdateModule = $db->prepare("UPDATE Module SET Module.name = :moduleName
                                          WHERE Module.id = :moduleId");
        $stmtUpdateModule->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtUpdateModule->bindParam(':moduleName', strtolower($moduleName), PDO::PARAM_STR);
        $stmtUpdateModule->execute();
//        $stmtUpdateModule->execute(array(":moduleId" => strtolower($moduleId),
//                                         ":moduleName" => strtolower($moduleName)));
    }
    public function deleteModuleModel($moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtDeleteModule = $db->prepare("DELETE FROM Module WHERE Module.id = :moduleId");
        $stmtDeleteModule->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtDeleteModule->execute();
//        $stmtDeleteModule->execute(array(":moduleId" => $moduleId));
    }
}