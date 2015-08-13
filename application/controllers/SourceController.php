<?php

class SourceController {

    public function createSourceModel($sourceName, $sourceUrl, $sourceXml, $sourceTitle, $sourceDescription,
                                      CategoryModel $objCategoryModel)
    {
        $objSourceModel = new SourceModel();
        $objSourceModel->setId(strtolower($objCategoryModel->getId()) . "_" . strtolower($sourceName));
        $objSourceModel->setName(strtolower($sourceName));
        $objSourceModel->setUrl(strtolower($sourceUrl));
        $objSourceModel->setXml(strtolower($sourceXml));
        $objSourceModel->setTitle(strtolower($sourceTitle));
        $objSourceModel->setDescription(strtolower($sourceDescription));
        $objSourceModel->setModuleId(strtolower($objCategoryModel->getModuleId()));
        $objSourceModel->setCategoryId(strtolower($objCategoryModel->getId()));

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
//    public function selectSourceModel($sourceId, $categoryId, $moduleId)
//    {
//        $db = DBConnection::getInstance()->_connection;
//        $stmtSelectSource = $db->prepare("SELECT * FROM Source
//                                          WHERE Source.id = . :sourceId
//                                          AND Source.categoryId = :categoryId
//                                          AND Source.moduleId = :moduleId ");
//        $stmtSelectSource->bindParam(':sourceId', strtolower($sourceId), PDO::PARAM_STR);
//        $stmtSelectSource->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
//        $stmtSelectSource->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
//        $stmtSelectSource->execute();
////        $stmtSelectSource->execute(array(':sourceId', strtolower($sourceId),
////                                         ':categoryId', strtolower($categoryId),
////                                         ':moduleId', strtolower($moduleId)));
//        $stmtSelectSource = $stmtSelectSource->fetchAll(PDO::FETCH_ASSOC);
//        return $stmtSelectSource;
//    }
    public function selectSourceModel(stdClass $objStdClass)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtSelectSource = $db->prepare("SELECT * FROM Source
                                          WHERE Source.id = :sourceId
                                          AND Source.categoryId = :categoryId
                                          AND Source.moduleId = :moduleId ");
        $stmtSelectSource->bindParam(':sourceId', strtolower($objStdClass->sourceId), PDO::PARAM_STR);
        $stmtSelectSource->bindParam(':categoryId', strtolower($objStdClass->categoryId), PDO::PARAM_STR);
        $stmtSelectSource->bindParam(':moduleId', strtolower($objStdClass->moduleId), PDO::PARAM_STR);
        $stmtSelectSource->execute();
//        $stmtSelectSource->execute(array(':sourceId', strtolower($sourceId),
//                                         ':categoryId', strtolower($categoryId),
//                                         ':moduleId', strtolower($moduleId)));
        $stmtSelectSource = $stmtSelectSource->fetchAll(PDO::FETCH_CLASS, "SourceModel");
        return $stmtSelectSource;
    }public function selectAllSourceModel()
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtSelectSource = $db->prepare("SELECT * FROM Source");
        $stmtSelectSource->execute();
        $stmtSelectSource = $stmtSelectSource->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectSource;
    }
    public function updateSourceModel($sourceId, $sourceName, $sourceUrl, $sourceXml, $sourceTitle, $sourceDescription,
                                      $moduleId, $categoryId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtUpdateSource = $db->prepare("UPDATE Source
                                            SET Source.name = :sourceName,
                                                Source.url = :sourceUrl,
                                                Source.xml = :sourceXml,
                                                Source.title = :sourceTitle,
                                                Source.description = :sourceDescription
                                            WHERE Source.id = . :sourceId
                                            AND Source.categoryId = :categoryId
                                            AND Source.moduleId = :moduleId ");
        $stmtUpdateSource->bindParam(':sourceName', strtolower($sourceName), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':sourceUrl', strtolower($sourceUrl), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':sourceXml', strtolower($sourceXml), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':sourceTitle', strtolower($sourceTitle), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':sourceDescription', strtolower($sourceDescription), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':sourceId', strtolower($sourceId), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtUpdateSource->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtUpdateSource->execute();
//        $stmtUpdateSource->execute(array(':sourceName', strtolower($sourceName),
//                                         ':sourceUrl', strtolower($sourceUrl),
//                                         ':sourceXml', strtolower($sourceXml),
//                                         ':sourceTitle', strtolower($sourceTitle),
//                                         ':sourceDescription', strtolower($sourceDescription),
//                                         ':sourceId', strtolower($sourceId),
//                                         ':categoryId', strtolower($categoryId),
//                                         ':moduleId', strtolower($moduleId)));
    }
    public function deleteSourceModel($sourceId, $categoryId, $moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtDeleteSource = $db->prepare("DELETE FROM Source
                                          WHERE Source.id = . :sourceId
                                          AND Source.categoryId = :categoryId
                                          AND Source.moduleId = :moduleId ");
        $stmtDeleteSource->bindParam(':sourceId', strtolower($sourceId), PDO::PARAM_STR);
        $stmtDeleteSource->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtDeleteSource->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtDeleteSource->execute();
//        $stmtDeleteSource->execute(array(':sourceId', strtolower($sourceId),
//                                         ':categoryId', strtolower($categoryId),
//                                         ':moduleId', strtolower($moduleId)));
    }
}