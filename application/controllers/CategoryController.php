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
        $stmtInsertCategory = $db->prepare("INSERT INTO Category (id, name, moduleId) VALUES (:categoryId, :categoryName, :moduleId)");
        $stmtInsertCategory->bindParam(':categoryId', strtolower($objCategoryModel->getId()), PDO::PARAM_STR);
        $stmtInsertCategory->bindParam(':categoryName', strtolower($objCategoryModel->getName()), PDO::PARAM_STR);
        $stmtInsertCategory->bindParam(':moduleId', strtolower($objCategoryModel->getModuleId()), PDO::PARAM_STR);
        $stmtInsertCategory->execute();
//        $stmtInsertCategory->execute(array(':categoryId' => $objCategoryModel->getId(),
            //                               ':categoryName' => $objCategoryModel->getName(),
            //                               ':moduleId' => $objCategoryModel->getModuleId()));
    }
    public function selectCategoryModel($categoryId, $moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtSelectCategory = $db->prepare("SELECT * FROM Category
                              WHERE Category.id = . :categoryId AND Category.moduleId = :moduleId ");
        $stmtSelectCategory->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtSelectCategory->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtSelectCategory->execute();
//        $stmtSelectCategory->execute(array(':categoryId', strtolower($categoryId),'
//                                            ':moduleId', strtolower($moduleId)));
        $stmtSelectCategory = $stmtSelectCategory->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectCategory;
    }
    public function updateCategoryModel($categoryId, $categoryName, $moduleId)
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
    public function deleteCategoryModel($categoryId, $moduleId)
    {
        $db = DBConnection::getInstance()->_connection;
        $stmtDeleteCategory = $db->prepare("DELETE FROM Category
                                          WHERE Category.id = . :categoryId AND Category.moduleId = :moduleId");
        $stmtDeleteCategory->bindParam(':categoryId', strtolower($categoryId), PDO::PARAM_STR);
        $stmtDeleteCategory->bindParam(':moduleId', strtolower($moduleId), PDO::PARAM_STR);
        $stmtDeleteCategory->execute();
//        $stmtDeleteCategory->execute(array(':categoryId', strtolower($categoryId),
//                                           ':moduleId', strtolower($moduleId)));
    }
}