<?php

class ItemController {

    private function createIdItemModel(ItemModel $objItemModel) {
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000 - ItemModel::$counter);
        $objItemModel->setId($id);
    }
    private function cleanString($value) {
        $value = trim($value);
        $value = strip_tags($value);
        $value = strtolower($value);
        return $value;
    }
    private function fillItemModel(ItemModel $objItemModel, SourceModel $objSourceModel, $item) {

        $this->createIdItemModel($objItemModel);

        foreach($item as $itemProperty) {

            switch($itemProperty->getName())
            {
                case "title" : $objItemModel->setItem($this->cleanString($itemProperty->__toString())); break;
                case "link" : $objItemModel->setLink($this->cleanString($itemProperty->__toString())); break;
                case "description" : $objItemModel->setDescription($this->cleanString($itemProperty->__toString())); break;
                case "enclosure" : $objItemModel->setImage($this->cleanString($itemProperty->attributes()->url->__toString())); break;
                case "fulltext" : $objItemModel->setText($this->cleanString($itemProperty->__toString())); break;
                case "pubDate" : $objItemModel->setPubDate($this->cleanString($itemProperty->__toString()));
                                 $objItemModel->setSourceId($this->cleanString($objSourceModel->getId()));
                                 $objItemModel->setCategoryId($this->cleanString($objSourceModel->getCategoryId()));
                                 $objItemModel->setModuleId($this->cleanString($objSourceModel->getModuleId()));
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
    private function checkItemModelDB($db, SourceModel $objSourceModel) {
        $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.sourceId, Item.categoryId, Item.moduleId
                               FROM Item
                               WHERE Item.sourceId = :sourceId
                               AND   Item.categoryId = :categoryId
                               AND   Item.moduleId = :moduleId
                               ORDER BY Item.id DESC LIMIT 1");
        $check->bindParam(":sourceId"   , strtolower($objSourceModel->getId()), PDO::PARAM_STR);
        $check->bindParam(":categoryId" , strtolower($objSourceModel->getCategoryId()), PDO::PARAM_STR);
        $check->bindParam(":moduleId"   , strtolower($objSourceModel->getModuleId()), PDO::PARAM_STR);
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

        $check = $this->checkItemModelDB($db, $objSourceModel);

        foreach($sxmlItem as $item) {

            $objItemModel = $this->fillItemModel(new ItemModel(), $objSourceModel, $item);

            if( $this->checkItemModel($objItemModel, $check[0]) ) { break; }

            $stmtInsertItem = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate,
                                                                    text, sourceId, categoryId, moduleId)
                                            VALUES (:id, :name, :link, :description, :image, :pubDate,
                                                              :text, :sourceId, :categoryId, :moduleId)");

            $stmtInsertItem->bindParam(":id"         , $this->cleanString($objItemModel->getId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":name"       , $this->cleanString($objItemModel->getName()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":link"       , $this->cleanString($objItemModel->getLink()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":description", $this->cleanString($objItemModel->getDescription()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":image"      , $this->cleanString($objItemModel->getImage()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":pubDate"    , $this->cleanString($objItemModel->getPubDate()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":text"       , $this->cleanString($objItemModel->getText()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":sourceId"   , $this->cleanString($objItemModel->getSourceId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":categoryId" , $this->cleanString($objItemModel->getCategoryId()), PDO::PARAM_STR);
            $stmtInsertItem->bindParam(":moduleId"   , $this->cleanString($objItemModel->getModuleId()), PDO::PARAM_STR);
            $stmtInsertItem->execute();

//            $stmtInsertItem->execute(array(":id"          => $this->cleanString($objItemModel->getId()),
//                                           ":name"        => $this->cleanString($objItemModel->getName()),
//                                           ":link"        => $this->cleanString($objItemModel->getLink()),
//                                           ":description" => $this->cleanString($objItemModel->getDescription()),
//                                           ":image"       => $this->cleanString($objItemModel->getImage()),
//                                           ":pubDate"     => $this->cleanString($objItemModel->getPubDate()),
//                                           ":text"        => $this->cleanString($objItemModel->getText()),
//                                           ":sourceId"    => $this->cleanString($objItemModel->getSourceId()),
//                                           ":categoryId"  => $this->cleanString($objItemModel->getCategoryId()),
//                                           ":moduleId"    => $this->cleanString($objItemModel->getModuleId())));
        }
    }
    public function selectItemModel(stdClass $objStdClass) {

        $db = DBConnection::getInstance()->_connection;

        if($objStdClass->older === "true")
        {
            $stmtSelectItem = $db->prepare("SELECT * FROM Item
                                            WHERE Item.id < :id
                                            AND   Item.sourceId = :sourceId
                                            AND   Item.categoryId = :categoryId
                                            AND   Item.moduleId = :moduleId
                                            ORDER BY Item.id DESC LIMIT :quantity");
        }
        else
        {
            $stmtSelectItem = $db->prepare("SELECT * FROM Item
                                            WHERE Item.id > :id
                                            AND   Item.sourceId = :sourceId
                                            AND   Item.categoryId = :categoryId
                                            AND   Item.moduleId = :moduleId
                                            ORDER BY Item.id DESC LIMIT :quantity");
        }

        $stmtSelectItem->bindParam(":id"         , strtolower($objStdClass->id), PDO::PARAM_STR);
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
    public function selectItemModelNoId(stdClass $objStdClass) {

        $db = DBConnection::getInstance()->_connection;

        $stmtSelectItem = $db->prepare("SELECT * FROM Item
                                        WHERE Item.sourceId = :sourceId
                                        AND   Item.categoryId = :categoryId
                                        AND   Item.moduleId = :moduleId
                                        ORDER BY Item.id DESC LIMIT :quantity");

        $stmtSelectItem->bindParam(":sourceId"   , strtolower($objStdClass->sourceId), PDO::PARAM_STR);
        $stmtSelectItem->bindParam(":categoryId" , strtolower($objStdClass->categoryId), PDO::PARAM_STR);
        $stmtSelectItem->bindParam(":moduleId"   , strtolower($objStdClass->moduleId), PDO::PARAM_STR);
        $quantity = (integer)$objStdClass->quantity;
        $stmtSelectItem->bindParam(":quantity"   , $quantity, PDO::PARAM_INT);

        $stmtSelectItem->execute();

//        $stmtSelectItem->execute(array(":sourceId"    => strtolower($objStdClass->sourceId),
//                                       ":categoryId"  => strtolower($objStdClass->categoryId),
//                                       ":moduleId"    => strtolower($objStdClass->moduleId),
//                                       ":quantity"    => $objStdClass->quantity));

        $stmtSelectItem = $stmtSelectItem->fetchAll(PDO::FETCH_ASSOC);
        return $stmtSelectItem;
    }
}