<?php

class ItemController {

    private function createIdItemModel(ItemModel $objItemModel) {
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000 + ItemModel::$counter);
        $objItemModel->setId($id);
    }
    private function fillItemModel(ItemModel $objItemModel, SourceModel $objSourceModel, $item) {

        $this->createIdItemModel($objItemModel);

        foreach($item as $itemProperty) {

            switch($itemProperty->getName())
            {
                case "title" : $objItemModel->setItem(strtolower($itemProperty->__toString())); break;
                case "link" : $objItemModel->setLink(strtolower($itemProperty->__toString())); break;
                case "description" : $objItemModel->setDescription(strtolower($itemProperty->__toString())); break;
                case "enclosure" : $objItemModel->setImage(strtolower($itemProperty->attributes()->url->__toString())); break;
                case "pubDate" : $objItemModel->setPubDate(strtolower($itemProperty->__toString()));
                                 $objItemModel->setSourceId(strtolower($objSourceModel->getId()));
                                 $objItemModel->setCategoryId(strtolower($objSourceModel->getCategoryId()));
                                 $objItemModel->setModuleId(strtolower($objSourceModel->getModuleId()));
                                 break;
                default : echo "ERROR"; break;
            }

        }

        return $objItemModel;
    }
    private function checkItemModel(ItemModel $objItemModel, $check) {

        if( is_array($check) && strtolower($objItemModel->getLink())       === strtolower($check["link"]) &&
                                strtolower($objItemModel->getPubDate())    === strtolower($check["pubDate"]) &&
                                strtolower($objItemModel->getSourceId())   === strtolower($check["sourceId"]) &&
                                strtolower($objItemModel->getCategoryId()) === strtolower($check["categoryId"]) &&
                                strtolower($objItemModel->getModuleId())   === strtolower($check["moduleId"])
        ) { return true; }

        return false;
    }
    private function checkItemModelDB($db) {
        $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.sourceId, Item.categoryId, Item.moduleId
                               FROM Item ORDER BY Item.id, Item.pubDate ASC LIMIT 1");
        $check->execute();
        $check = $check->fetchAll(PDO::FETCH_ASSOC);

        return $check;
    }
    private function simplexmlSourceModel(SourceModel $objSourceModel) {
        $sxml = simplexml_load_file($objSourceModel->getXml());
        $sxmlItem = $sxml->xpath("/rss/channel/item");
        return $sxmlItem;
    }
    public function insertItemModel(SourceModel $objSourceModel) {

        $db = DBConnection::getInstance()->_connection;

        $sxmlItem = $this->simplexmlSourceModel($objSourceModel);

        $check = $this->checkItemModelDB($db);

        foreach($sxmlItem as $item) {

            $objItemModel = $this->fillItemModel(new ItemModel(), $objSourceModel, $item);

            if( $this->checkItemModel($objItemModel, $check[0]) ) { break; }

            $stmtInsertItem = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate,
                                                                          sourceId, categoryId, moduleId)
                                            VALUES (:id, :name, :link, :description, :image, :pubDate,
                                                                    :sourceId, :categoryId, :moduleId)");

            $stmtInsertItem->bindParam(":id"         , strtolower($objItemModel->getId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":name"       , strtolower($objItemModel->getName()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":link"       , strtolower($objItemModel->getLink()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":description", strtolower($objItemModel->getDescription()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":image"      , strtolower($objItemModel->getImage()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":pubDate"    , strtolower($objItemModel->getPubDate()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":sourceId"   , strtolower($objItemModel->getSourceId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":categoryId" , strtolower($objItemModel->getCategoryId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":moduleId"   , strtolower($objItemModel->getModuleId()), PDO::PARAM_STR);
            $stmtInsertItem->execute();

//            $stmtInsertItem->execute(array(":id"          => strtolower($objItemModel->getId()),
//                                           ":name"        => strtolower($objItemModel->getName()),
//                                           ":link"        => strtolower($objItemModel->getLink()),
//                                           ":description" => strtolower($objItemModel->getDescription()),
//                                           ":image"       => strtolower($objItemModel->getImage()),
//                                           ":pubDate"     => strtolower($objItemModel->getPubDate()),
//                                           ":sourceId"    => strtolower($objItemModel->getSourceId()),
//                                           ":categoryId"  => strtolower($objItemModel->getCategoryId()),
//                                           ":moduleId"    => strtolower($objItemModel->getModuleId())));
        }
    }
    public function selectItemModel(stdClass $objStdClass) {

        $db = DBConnection::getInstance()->_connection;

        if($objStdClass->older === "true")
        {
            $stmtSelectItem = $db->prepare("SELECT * FROM Item
                                            WHERE Item.pubDate < :pubDate
                                            AND   Item.sourceId = :sourceId
                                            AND   Item.categoryId = :categoryId
                                            AND   Item.moduleId = :moduleId
                                            ORDER BY Item.id ASC LIMIT :quantity");
        }
        else
        {
            $stmtSelectItem = $db->prepare("SELECT * FROM Item
                                            WHERE Item.pubDate > :pubDate
                                            AND   Item.sourceId = :sourceId
                                            AND   Item.categoryId = :categoryId
                                            AND   Item.moduleId = :moduleId
                                            ORDER BY Item.id ASC LIMIT :quantity");
        }

        $stmtSelectItem->bindParam(":pubDate"    , strtolower($objStdClass->pubDate), PDO::PARAM_STR);
        $stmtSelectItem->bindParam(":sourceId"   , strtolower($objStdClass->sourceId), PDO::PARAM_STR);
        $stmtSelectItem->bindParam(":categoryId" , strtolower($objStdClass->categoryId), PDO::PARAM_STR);
        $stmtSelectItem->bindParam(":moduleId"   , strtolower($objStdClass->moduleId), PDO::PARAM_STR);
        $quantity = (integer)$objStdClass->quantity;
        $stmtSelectItem->bindParam(":quantity"   , $quantity, PDO::PARAM_INT);

        $stmtSelectItem->execute();


//        $stmtSelectItem->execute(array(":pubDate"     => strtolower($objStdClass->pubDate),
//                                       ":sourceId"    => strtolower($objStdClass->sourceId),
//                                       ":categoryId"  => strtolower($objStdClass->categoryId),
//                                       ":moduleId"    => strtolower($objStdClass->moduleId),
//                                       ":quantity"    => $objStdClass->quantity));

        $stmtSelectItem = $stmtSelectItem->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectItem;
    }
}