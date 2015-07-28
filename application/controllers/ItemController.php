<?php

class ItemController {

    private function createIdItemModel(ItemModel $objItemModel) {
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000 + ItemModel::$counter);
        $objItemModel->setId($id);
    }
    private function fillItemModel(ItemModel $objItemModel, $sourceId, $categoryId, $moduleId, $item) {

        $this->createIdItemModel($objItemModel);

        foreach($item as $itemProperty) {

            switch($itemProperty->getName())
            {
                case "title" : $objItemModel->setItem($itemProperty->__toString()); break;
                case "link" : $objItemModel->setLink($itemProperty->__toString()); break;
                case "description" : $objItemModel->setDescription($itemProperty->__toString()); break;
                case "enclosure" : $objItemModel->setImage($itemProperty->attributes()->url->__toString()); break;
                case "pubDate" : $objItemModel->setPubDate($itemProperty->__toString());
                                 $objItemModel->setSourceId($sourceId);
                                 $objItemModel->setCategoryId($categoryId);
                                 $objItemModel->setModuleId($moduleId);
                                 break;
                default : echo "ERROR"; break;
            }

        }

        return $objItemModel;
    }
    private function checkItemModel(ItemModel $objItemModel, $check) {

        if( is_array($check) && $objItemModel->getLink()        == $check["link"] &&
                                $objItemModel->getPubDate()     == $check["pubDate"] &&
                                $objItemModel->getSourceId()    == $check["sourceId"] &&
                                $objItemModel->getCategoryId()  == $check["categoryId"] &&
                                $objItemModel->getModuleId()    == $check["moduleId"]
        ) { return true; }

        return false;
    }
    private function checkItemModelDB($db) {
        $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.sourceId, Item.categoryId, Item.moduleId
                               FROM Item ORDER BY Item.pubDate DESC LIMIT 1");
        $check->execute();
        $check = $check->fetchAll(PDO::FETCH_ASSOC);

        return $check;
    }
    private function simplexmlSourceModel(SourceModel $objSourceModel) {
//        $sxml = simplexml_load_file($objSourceModel->getXml());
        $sxml = simplexml_load_file("http://news.liga.net/politics/rss.xml");
        $sxmlItem = $sxml->xpath("/rss/channel/item");
        return $sxmlItem;
    }
    public function parseInsertLiga(SourceModel $objSourceModel) {

        $db = DBConnection::getInstance()->_connection;

        $sxmlItem = $this->simplexmlSourceModel($objSourceModel);

        $check = $this->checkItemModelDB($db);

        foreach($sxmlItem as $item) {

            $objItemModel = $this->fillItemModel(new ItemModel(), null, null, null, $item);

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

//            $stmtInsertItem->execute(array(":id"          => $objItemModel->getId(),
//                                           ":name"        => $objItemModel->getName(),
//                                           ":link"        => $objItemModel->getLink(),
//                                           ":description" => $objItemModel->getDescription(),
//                                           ":image"       => $objItemModel->getImage(),
//                                           ":pubDate"     => $objItemModel->getPubDate(),
//                                           ":sourceId"    => $objItemModel->getSourceId(),
//                                           ":categoryId"  => $objItemModel->getCategoryId(),
//                                           ":moduleId"    => $objItemModel->getModuleId()));
        }
    }
    public function selectItemModel(stdClass $objStdClass) {

        $db = DBConnection::getInstance()->_connection;

        if($objStdClass->older === "true") {
            $check = $db->prepare("SELECT * FROM Item
                                   WHERE Item.sourceId = :sourceId
                                   AND   Item.categoryId = :categoryId
                                   AND   Item.moduleId = :moduleId
                                   ORDER BY Item.pubDate DESC ");
        } else {
            $check = $db->prepare("SELECT * FROM Item
                                   WHERE Item.sourceId = :sourceId,
                                   AND   Item.categoryId = :categoryId,
                                   AND   Item.moduleId = :moduleId
                                   ORDER BY Item.pubDate DESC");
        }

        $check->execute();

        $check = $check->fetchAll(PDO::FETCH_ASSOC);
        return $check;
    }
}