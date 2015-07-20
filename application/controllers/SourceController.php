<?php

class SourceController {

    public function createSourceModel(CategoryModel $objCategoryModel,
                                      $name, $url, $xml, $title, $description) {
        $id = $objCategoryModel->getId() . ucfirst($name);
        $objSourceModel = new SourceModel($id, strtoupper($name), $url, $xml,
                                          $title, $description, $objCategoryModel->getId());
        return $objSourceModel;
    }

    public function insertSourceModel(SourceModel $objSourceModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("INSERT INTO CATEGORY (id, name, url, xml, title, description, moduleId)
                              VALUES (:id, :name, :url, :xml, :title, :description, :moduleId)");

        $stmt->execute(array(":id" => $objSourceModel->getId(),
                             ":name" => $objSourceModel->getName(),
                             ":url" => $objSourceModel->getUrl(),
                             ":xml" => $objSourceModel->getXml(),
                             ":title" => $objSourceModel->getTitle(),
                             ":description" => $objSourceModel->getDescription(),
                             ":moduleId" => $objSourceModel->getCategoryId()));
    }

}