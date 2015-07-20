<?php

class ItemController {

    private function createIdItemModel(ItemModel $objItemModel) {
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000 + ItemModel::$counter);
        $objItemModel->setId($id);
    }

    private function fillItemModel(ItemModel $objItemModel, $item, SourceModel $objSourceModel) {

        $this->createIdItemModel($objItemModel);

        foreach($item as $itemProperty) {

            switch($itemProperty->getName())
            {
                case "title" : $objItemModel->setItem($itemProperty->__toString()); break;
                case "link" : $objItemModel->setLink($itemProperty->__toString()); break;
                case "description" : $objItemModel->setDescription($itemProperty->__toString()); break;
                case "enclosure" : $objItemModel->setImage($itemProperty->attributes()->url->__toString()); break;
                case "pubDate" : $objItemModel->setPubDate($itemProperty->__toString());
                                 $objItemModel->setSourceId($objSourceModel->getId());
                                 break;
                default : echo "ERROR"; break;
            }

        }

        return $objItemModel;
    }

    private function checkItemModel(ItemModel $objItemModel, $check) {

        if( is_array($check) && $objItemModel->getLink() == $check["link"] &&
                                $objItemModel->getPubDate() == $check["pubDate"] &&
                                $objItemModel->getSourceId() == $check["sourceId"]
        ) { return true; }

        return false;
    }

    private function checkItemModelDB(DBConnection $db) {
        $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.sourceId
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

        $objSourceModel->setId(1);

        $sxmlItem = $this->simplexmlSourceModel($objSourceModel);

        $check = $this->checkItemModelDB($db);

        foreach($sxmlItem as $item) {

            $objItemModel = $this->fillItemModel(new ItemModel(), $item, $objSourceModel);

            if( $this->checkItemModel($objItemModel, $check[0]) ) { break; }

            $stmt = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate, sourceId)
                                  VALUES (:id, :name, :link, :description, :image, :pubDate, :sourceId)");

            $stmt->execute(array(":id" => $objItemModel->getId(),
                                 ":name" => $objItemModel->getName(),
                                 ":link" => $objItemModel->getLink(),
                                 ":description" => $objItemModel->getDescription(),
                                 ":image" => $objItemModel->getImage(),
                                 ":pubDate" => $objItemModel->getPubDate(),
                                 ":sourceId" => $objItemModel->getSourceId()));
        }
    }

    public function selectItemModel(stdClass $objStdClass) {

        $db = DBConnection::getInstance()->_connection;

        $check = $db->prepare("SELECT * FROM Item
                               WHERE Item.moduleId = :itemIdForeign
                               ORDER BY Item.pubDate DESC LIMIT :limit");
        $check->execute();

        $check = $check->fetchAll(PDO::FETCH_ASSOC);
    }
}