<?php

class CategoryController
{
    public function createCategoryModel($categoryName, $moduleId)
    {
        $objCategoryModel = new CategoryModel(strtolower($categoryName), strtolower($categoryName),
                                              strtolower($moduleId));
        return $objCategoryModel;
    }
    public function insertCategoryModel(CategoryModel $objCategoryModel)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmt = $db->prepare("INSERT INTO Category (id, name, moduleId) VALUES (:categoryId, :categoryName, :moduleId)");
        $stmt->bindParam(':categoryId', strtolower($objCategoryModel->getId()), PDO::PARAM_STR);
        $stmt->bindParam(':categoryName', strtolower($objCategoryModel->getName()), PDO::PARAM_STR);
        $stmt->bindParam(':moduleId', strtolower($objCategoryModel->getModuleId()), PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array(":categoryId" => $objCategoryModel->getId(),
//                             ":categoryName" => $objCategoryModel->getName(),
//                             ":moduleId" => $objCategoryModel->getModuleId()));
    }
    public function selectCategoryModel($moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmt = $db->prepare("SELECT Module.id, Module.name
                              FROM Module WHERE Module.id = . :moduleId ");
        $stmt->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array(":moduleId" => strtolower($moduleId)));
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;
    }
//    public function updateCategoryModel($moduleId, $moduleName)
//    {
//        $db = DBConnection::getInstance()->_connection;
//        $stmtUpdateModule = $db->prepare("UPDATE Module SET Module.name = :moduleName
//                                          WHERE Module.id = :moduleId");
//        $stmtUpdateModule->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
//        $stmtUpdateModule->bindParam(':moduleName', strtolower($moduleName), PDO::PARAM_STR);
//        $stmtUpdateModule->execute();
////        $stmtUpdateModule->execute(array(":moduleId" => strtolower($moduleId),
////                                         ":moduleName" => strtolower($moduleName)));
//    }
//    public function deleteCategoryModel($moduleId)
//    {
//        $db = DBConnection::getInstance()->_connection;
//        $stmtDeleteModule = $db->prepare("DELETE FROM Module WHERE Module.id = :moduleId");
//        $stmtDeleteModule->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
//        $stmtDeleteModule->execute();
////        $stmtDeleteModule->execute(array(":moduleId" => $moduleId));
//    }
}