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

        $stmt1 = $db->prepare("UPDATE Module SET Module.id = :newModuleId, Module.name = :newModuleName
                               WHERE Module.name = :oldModuleName");
        $stmt1->bindParam(':newModuleId', strtolower($newName), PDO::PARAM_STR);
        $stmt1->bindParam(':newModuleName', strtoupper($newName), PDO::PARAM_STR);
        $stmt1->bindParam(':oldModuleName', strtoupper($oldName), PDO::PARAM_STR);
        $stmt1->execute();

//        $stmt->execute(array(":newModuleId" => strtolower($newName),
//                             ":newModuleName" => strtoupper($newName),
//                             ":oldModuleName" => strtoupper($oldName),));

        $stmt2 = $db->prepare("SELECT Category.id FROM Category
                               WHERE Category.idForeign = :oldCategoryIdForeign");
        $stmt2->bindParam(':oldCategoryIdForeign', strtolower($oldName), PDO::PARAM_STR);
        $stmt2->execute();
//        $stmt2->execute(array(":oldCategoryIdForeign" => strtolower($oldName)));
        $stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        foreach ($stmt2 as $categoryId) {

            $stmt3 = $db->prepare("UPDATE Category SET Category.id = :newCategoryId, Category.idForeign = :newCategoryIdForeign
                                   WHERE Category.idForeign = :oldCategoryIdForeign");
            $stmt3->bindParam(':newCategoryId', str_replace(strtolower($oldName), strtolower($newName), $categoryId), PDO::PARAM_STR);
            $stmt3->bindParam(':newCategoryIdForeign', strtolower($newName), PDO::PARAM_STR);
            $stmt3->bindParam(':oldCategoryIdForeign', strtolower($oldName), PDO::PARAM_STR);
            $stmt3->execute();

//        $stmt->execute(array(":newCategoryId" => str_replace(strtolower($oldName), strtolower($newName), $categoryId),
//                             ":newCategoryIdForeign" => strtolower($newName),
//                             ":oldCategoryIdForeign" => strtolower($oldName),));

            $stmt4 = $db->prepare("SELECT Source.id FROM Source
                                   WHERE Source.idForeign = :oldSourceIdForeign");
            $stmt4->bindParam(':oldSourceIdForeign', $categoryId, PDO::PARAM_STR);
            $stmt4->execute();
//        $stmt4->execute(array(":oldSourceIdForeign" => $categoryId));
            $stmt4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

            foreach ($stmt4 as $sourceId) {

                $stmt5 = $db->prepare("UPDATE Source SET Source.id = :newSourceId, Source.idForeign = :newSourceIdForeign
                                       WHERE Source.idForeign = :oldSourceIdForeign");
                $stmt5->bindParam(':newSourceId', str_replace(strtolower($oldName), strtolower($newName), $sourceId), PDO::PARAM_STR);
                $stmt5->bindParam(':newSourceIdForeign', str_replace(strtolower($oldName), strtolower($newName), $categoryId), PDO::PARAM_STR);
                $stmt5->bindParam(':oldSourceIdForeign', $categoryId, PDO::PARAM_STR);
                $stmt5->execute();

//        $stmt->execute(array(":newSourceId" => str_replace(strtolower($oldName), strtolower($newName), $sourceId),
//                             ":newSourceIdForeign" => str_replace(strtolower($oldName), strtolower($newName), $categoryId),
//                             ":oldSourceIdForeign" => $categoryId,));
            }
        }


    }

    public function deleteModuleModel($name) {

    }
}