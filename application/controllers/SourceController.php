<?php

class SourceController {

    public function createSourceModel($name, $url, $xml, $title, $description, $moduleId, $categoryId)
    {
        $objSourceModel = new SourceModel(strtolower($name), strtolower($name), $url, $xml,
                                          $title, $description, strtolower($moduleId), strtolower($categoryId));
        return $objSourceModel;
    }
    public function insertSourceModel(SourceModel $objSourceModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmtInsertSource = $db->prepare("INSERT INTO Source (id, name, url, xml, title, description, moduleId, categoryId)
                                          VALUES (:id, :name, :url, :xml, :title, :description, :moduleId, :categoryId)");

        $stmtInsertSource->bindParam(':id', strtolower($objSourceModel->getId()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':name', strtolower($objSourceModel->getName()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':url', strtolower($objSourceModel->getUrl()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':xml', strtolower($objSourceModel->getXml()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':title', strtolower($objSourceModel->getTitle()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':description', strtolower($objSourceModel->getDescription()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':moduleId', strtolower($objSourceModel->getModuleId()), PDO::PARAM_STR);
        $stmtInsertSource->bindParam(':categoryId', strtolower($objSourceModel->getCategoryId()), PDO::PARAM_STR);
        $stmtInsertSource->execute();
//        $stmtInsertSource->execute(array(":id" => strtolower($objSourceModel->getId()),
//                                         ":name" => strtolower($objSourceModel->getName()),
//                                         ":url" => strtolower($objSourceModel->getUrl()),
//                                         ":xml" => strtolower($objSourceModel->getXml()),
//                                         ":title" => strtolower($objSourceModel->getTitle()),
//                                         ":description" => strtolower($objSourceModel->getDescription()),
//                                         ":moduleId" => strtolower($objSourceModel->getModuleId()),
//                                         ":categoryId" => strtolower($objSourceModel->getCategoryId())));

    }
    public function selectSourceModel($sourceId, $categoryId, $moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtSelectSource = $db->prepare("SELECT * FROM Source
                                          WHERE Source.id = . :sourceId
                                          AND Source.categoryId = :categoryId
                                          AND Source.moduleId = :moduleId ");
        $stmtSelectSource->bindParam(':sourceId', strtolower($sourceId), PDO::PARAM_STR);
        $stmtSelectSource->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtSelectSource->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtSelectSource->execute();
//        $stmtSelectSource->execute(array(':sourceId', strtolower($sourceId),
//                                         ':categoryId', strtolower($categoryId),
//                                         ':moduleId', strtolower($moduleId)));
        $stmtSelectSource = $stmtSelectSource->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectSource;
    }
    public function updateSourceModel($id, $name, $url, $xml, $title, $description, $moduleId, $categoryId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtUpdateCategory = $db->prepare("UPDATE Category SET Category.name = :categoryName
                                            WHERE Category.id = . :categoryId AND Category.moduleId = :moduleId");
        $stmtUpdateCategory->bindParam(':categoryName', strtolower($categoryName), PDO::PARAM_STR);
        $stmtUpdateCategory->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtUpdateCategory->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtUpdateCategory->execute();
//        $stmt->execute(array(':categoryName', strtolower($categoryName),
//                             ':categoryId', strtolower($categoryId),
//                             ':moduleId', strtolower($moduleId)));
    }
//    public function deleteCategoryModel($categoryId, $moduleId)
//    {
//        $db = DBConnection::getInstance()->_connection;
//        $stmtDeleteCategory = $db->prepare("DELETE FROM Category
//                                          WHERE Category.id = . :categoryId AND Category.moduleId = :moduleId");
//        $stmtDeleteCategory->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
//        $stmtDeleteCategory->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
//        $stmtDeleteCategory->execute();
////        $stmtDeleteCategory->execute(array(':categoryId', strtolower($categoryId),
////                                           ':moduleId', strtolower($moduleId)));
//    }
}