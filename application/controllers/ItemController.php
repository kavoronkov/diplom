<?php

class ItemController {

    protected function parseInsertLiga(SourceModel $objSourceModel) {

//        $params = parse_ini_file('config.ini');
        $db = new PDO( "mysql:host=" . Application::$mainCfg["dbconnection"]["dbHost"] .
                       ";dbname=" . Application::$mainCfg["dbconnection"]["dbName"],
                       Application::$mainCfg["dbconnection"]["dbUser"],
                       Application::$mainCfg["dbconnection"]["dbPass"] );

        $sxml = simplexml_load_file($objSourceModel->getXml());
        //$sxml = simplexml_load_file("http://news.liga.net/politics/rss.xml");
        $sxmlItem = $sxml->xpath("/rss/channel/item");

        foreach($sxmlItem as $item) {

            $objItemModel = new ItemModel();
            ItemModel::$counter++;
            $id = date("YmdHis") . (1000+ItemModel::$counter);
            $objItemModel->setId($id);

            foreach($item as $itemProperty) {

                switch($itemProperty->getName())
                {
                    case "title" : $objItemModel->setItem($itemProperty->__toString()); break;
                    case "link" : $objItemModel->setLink($itemProperty->__toString()); break;
                    case "description" : $objItemModel->setDescription($itemProperty->__toString()); break;
                    case "enclosure" : $objItemModel->setImage($itemProperty->attributes()->url->__toString()); break;
                    case "pubDate" : $objItemModel->setPubDate($itemProperty->__toString());
                                     $objItemModel->setIdForeign($$objSourceModel->getId());
                        break;
                    default : echo "ERROR"; break;
                }

            }

            $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.idSource
                                   FROM Item ORDER BY Item.pubDate DESC LIMIT 1");
            $check->execute();

            if( $objItemModel->getLink() == $check["link"] &&
                $objItemModel->getPubDate() == $check["pubDate"] &&
                $objItemModel->getIdForeign() == $check["idSource"] ) { break; }
            else {
                $stmt = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate)
                                  VALUES (:id, :name, :link, :description, :image, :pubDate)");

                $stmt->execute(array(":id" => $objItemModel->getId(),
                    ":name" => $objItemModel->getItem(),
                    ":link" => $objItemModel->getLink(),
                    ":description" => $objItemModel->getDescription(),
                    ":image" => $objItemModel->getImage(),
                    ":pubDate" => $objItemModel->getPubDate()));
            }
        }
    }
}