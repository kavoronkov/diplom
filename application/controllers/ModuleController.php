<?php

class ModuleController {

    public function createModuleModel($name) {

        $objModuleModel = new ModuleModel(strtolower($name), strtoupper($name));
        return $objModuleModel;

    }

    public function insertModuleModel(ModuleModel $objModuleModel) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("INSERT INTO Module (id, name) VALUES (:idModule, :nameModule)");
        $stmt->bindParam(':idModule', strtolower($objModuleModel->getId()), PDO::PARAM_STR);
        $stmt->bindParam(':nameModule', strtoupper($objModuleModel->getName()), PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array(":idModule" => $objModuleModel->getId(),
//                             ":nameModule" => $objModuleModel->getName()));
    }

    public function selectModuleModel($name) {

        $db = DBConnection::getInstance()->_connection;

        $stmt = $db->prepare("SELECT Module.id, Module.name
                              FROM Module WHERE Module.name LIKE '%' . :nameModule . '%'");
        $stmt->bindParam(':nameModule', strtoupper($name), PDO::PARAM_STR);
        $stmt->execute();
//        $stmt->execute(array(":nameModule" => strtoupper($name)));

        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt;
    }

    public function updateModuleModel($oldName, $newName) {

        $db = DBConnection::getInstance()->_connection;

        $stmtUpdateModule = $db->prepare("UPDATE Module SET Module.id = :newModuleId, Module.name = :newModuleName
                                          WHERE Module.name = :oldModuleName");
        $stmtUpdateModule->bindParam(':newModuleId', strtolower($newName), PDO::PARAM_STR);
        $stmtUpdateModule->bindParam(':newModuleName', strtoupper($newName), PDO::PARAM_STR);
        $stmtUpdateModule->bindParam(':oldModuleName', strtoupper($oldName), PDO::PARAM_STR);
        $stmtUpdateModule->execute();

//        $stmtUpdateModule->execute(array(":newModuleId" => strtolower($newName),
//                                         ":newModuleName" => strtoupper($newName),
//                                         ":oldModuleName" => strtoupper($oldName),));

        $stmtSelectCategory = $db->prepare("SELECT Category.id FROM Category
                                            WHERE Category.idForeign = :CategoryIdForeign");
        $stmtSelectCategory->bindParam(':CategoryIdForeign', strtolower($oldName), PDO::PARAM_STR);
        $stmtSelectCategory->execute();
//        $stmtSelectCategory->execute(array(":CategoryIdForeign" => strtolower($oldName)));
        $stmtSelectCategory = $stmtSelectCategory->fetchAll(PDO::FETCH_ASSOC);

        foreach ($stmtSelectCategory as $categoryId) {

            $stmtUpdateCategory = $db->prepare("UPDATE Category SET Category.id = :newCategoryId,
                                                       Category.idForeign = :newCategoryIdForeign
                                                WHERE Category.idForeign = :oldCategoryIdForeign");
            $stmtUpdateCategory->bindParam(':newCategoryId',
                                    str_replace(strtolower($oldName), strtolower($newName), $categoryId), PDO::PARAM_STR);
            $stmtUpdateCategory->bindParam(':newCategoryIdForeign', strtolower($newName), PDO::PARAM_STR);
            $stmtUpdateCategory->bindParam(':oldCategoryIdForeign', strtolower($oldName), PDO::PARAM_STR);
            $stmtUpdateCategory->execute();

//            $stmtUpdateCategory->execute(array(":newCategoryId" => str_replace(strtolower($oldName), strtolower($newName), $categoryId),
//                                               ":newCategoryIdForeign" => strtolower($newName),
//                                               ":oldCategoryIdForeign" => strtolower($oldName),));

            $stmtSelectSource = $db->prepare("SELECT Source.id FROM Source
                                              WHERE Source.idForeign = :SourceIdForeign");
            $stmtSelectSource->bindParam(':SourceIdForeign', $categoryId, PDO::PARAM_STR);
            $stmtSelectSource->execute();
//            $stmtSelectSource->execute(array(":SourceIdForeign" => $categoryId));
            $stmtSelectSource = $stmtSelectSource->fetchAll(PDO::FETCH_ASSOC);

            foreach ($stmtSelectSource as $sourceId) {

                $stmtUpdateSource = $db->prepare("UPDATE Source SET Source.id = :newSourceId, Source.idForeign = :newSourceIdForeign
                                                  WHERE Source.idForeign = :oldSourceIdForeign");
                $stmtUpdateSource->bindParam(':newSourceId', str_replace(strtolower($oldName), strtolower($newName), $sourceId), PDO::PARAM_STR);
                $stmtUpdateSource->bindParam(':newSourceIdForeign', str_replace(strtolower($oldName), strtolower($newName), $categoryId), PDO::PARAM_STR);
                $stmtUpdateSource->bindParam(':oldSourceIdForeign', $categoryId, PDO::PARAM_STR);
                $stmtUpdateSource->execute();

//                $stmtUpdateSource->execute(array(":newSourceId" => str_replace(strtolower($oldName), strtolower($newName), $sourceId),
//                                                 ":newSourceIdForeign" => str_replace(strtolower($oldName), strtolower($newName), $categoryId),
//                                                 ":oldSourceIdForeign" => $categoryId,));

                $stmtUdateItem = $db->prepare("UPDATE Item SET Item.idForeign = :newItemIdForeign
                                               WHERE Item.idForeign = :oldItemIdForeign");
                $stmtUdateItem->bindParam(':newItemIdForeign', str_replace(strtolower($oldName), strtolower($newName), $sourceId), PDO::PARAM_STR);
                $stmtUdateItem->bindParam(':oldItemIdForeign', $sourceId, PDO::PARAM_STR);
                $stmtUdateItem->execute();

//                $stmtUdateItem->execute(array(":newItemIdForeign" => str_replace(strtolower($oldName), strtolower($newName), $sourceId),
//                                              ":oldItemIdForeign" => $sourceId,));

            }
        }
    }

    public function deleteModuleModel($name) {

        $db = DBConnection::getInstance()->_connection;

        $stmtDeleteModule = $db->prepare("DELETE FROM Module WHERE Module.name = :ModuleName");
        $stmtDeleteModule->bindParam(':ModuleName', strtolower($name), PDO::PARAM_STR);
        $stmtDeleteModule->execute();
//        $stmtDeleteModule->execute(array(":ModuleName" => $name));

        $stmtSelectCategory = $db->prepare("SELECT Category.id FROM Category
                                            WHERE Category.idForeign = :CategoryIdForeign");
        $stmtSelectCategory->bindParam(':CategoryIdForeign', strtolower($name), PDO::PARAM_STR);
        $stmtSelectCategory->execute();
//        $stmtSelectCategory->execute(array(":CategoryIdForeign" => strtolower($name)));
        $stmtSelectCategory = $stmtSelectCategory->fetchAll(PDO::FETCH_ASSOC);

        foreach($stmtSelectCategory as $categoryId) {

            $stmtDeleteCategory = $db->prepare("DELETE FROM Module WHERE Module.name = :ModuleName");
            $stmtDeleteModule->bindParam(':ModuleName', strtolower($name), PDO::PARAM_STR);
            $stmtDeleteModule->execute();
//            $stmtDeleteModule->execute(array(":ModuleName" => $name));

        }

    }
}