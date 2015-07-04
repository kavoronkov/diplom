<?php

class ItemController {

    private function fillItemModel(ItemModel $objItemModel, $item, SourceModel $objSourceModel) {

//        $objItemModel = new ItemModel();
        ItemModel::$counter++;
        $id = date("YmdHis") . (1000+ItemModel::$counter);
        echo "<br>".$id;
        $objItemModel->setId($id);

        foreach($item as $itemProperty) {

            switch($itemProperty->getName())
            {
                case "title" : $objItemModel->setItem($itemProperty->__toString()); break;
                case "link" : $objItemModel->setLink($itemProperty->__toString()); break;
                case "description" : $objItemModel->setDescription($itemProperty->__toString()); break;
                case "enclosure" : $objItemModel->setImage($itemProperty->attributes()->url->__toString()); break;
                case "pubDate" : $objItemModel->setPubDate($itemProperty->__toString());
                    $objItemModel->setIdForeign($objSourceModel->getId());
                    break;
                default : echo "ERROR"; break;
            }

        }

        return $objItemModel;
    }

    private function checkItem(ItemModel $objItemModel, $check) {
        echo "<br>LinkO = ".$objItemModel->getLink()." === ".$check["link"];
        echo "<br>pubO = ".$objItemModel->getPubDate()." === ".$check["pubDate"];
        echo "<br>IdO = ".$objItemModel->getIdForeign()." === ".$check["idSource"];



        if( is_array($check) && $objItemModel->getLink() == $check["link"] &&
                                $objItemModel->getPubDate() == $check["pubDate"] &&
                                $objItemModel->getIdForeign() == $check["idSource"]
        ) { return true; }
        return false;
    }

    public function parseInsertLiga(SourceModel $objSourceModel) {
        $db = DBConnection::getInstance()->_connection;

        $objSourceModel->setId(1);

//        $sxml = simplexml_load_file($objSourceModel->getXml());
        $sxml = simplexml_load_file("http://news.liga.net/politics/rss.xml");
        $sxmlItem = $sxml->xpath("/rss/channel/item");

        $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.idSource
                                   FROM Item ORDER BY Item.pubDate DESC LIMIT 1");
        $check->execute();

        $check = $check->fetchAll(PDO::FETCH_ASSOC);

        echo "<br>";
        var_dump($check);
        foreach($sxmlItem as $item) {

            $objItemModel = $this->fillItemModel(new ItemModel(), $item, $objSourceModel);

            echo "<br>";
//            var_dump($objItemModel);

            if( $this->checkItem($objItemModel, $check[0]) ) { break; }
//            echo "<br>After check";
            $stmt = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate, idSource)
                                  VALUES (:id, :name, :link, :description, :image, :pubDate, :idSource)");

            $stmt->execute(array(":id" => $objItemModel->getId(),
                ":name" => $objItemModel->getItem(),
                ":link" => $objItemModel->getLink(),
                ":description" => $objItemModel->getDescription(),
                ":image" => $objItemModel->getImage(),
                ":pubDate" => $objItemModel->getPubDate(),
                ":idSource" => $objItemModel->getIdForeign()));

        }
    }
}