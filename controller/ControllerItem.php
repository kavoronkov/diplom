<?php

class ControllerItem {

//    protected function add($xml) {
//        $sxml = simplexml_load_file($xml);
//    }

    protected function insert($xml) {

        $params = parse_ini_file('config.ini');
        $db = new PDO($params['db.conn'], $params['db.user'], $params['db.pass']);

        //$sxml = simplexml_load_file($xml);
        $sxml = simplexml_load_file("http://news.liga.net/politics/rss.xml");
        $sxmlItem = $sxml->xpath("/rss/channel/item");

        foreach($sxmlItem as $item) {
            foreach($item as $itemProperty) {
                $objModelItem = new ModelItem();
                ModelItem::$counter++;
                $id = date("YmdHis") . (1000+ModelItem::$counter);
                $objModelItem->setId($id);
                switch($itemProperty->getName())
                {
                    case "title" : $objModelItem->setItem($itemProperty->__toString()); break;
                    case "link" : $objModelItem->setLink($itemProperty->__toString()); break;
                    case "description" : $objModelItem->setDescription($itemProperty->__toString()); break;
                    case "enclosure" : $objModelItem->setImage($itemProperty->attributes()->url->__toString()); break;
                    case "pubDate" : $objModelItem->setPubDate($itemProperty->__toString()); break;
                    default : echo "ERROR"; break;
                }

                var_dump($objModelItem);

//                $stmt = $db->prepare("INSERT INTO item(id, item, link, description, image, pubDate)
//                                             VALUES (:id, :item, :link, :description, :image, :puDate)");
//                $stmt->execute(array(":id" => $objModelItem->getId(),
//                                     ":item" => $objModelItem->getItem(),
//                                     ":link" => $objModelItem->getLink(),
//                                     ":descr" => $objModelItem->getDescription(),
//                                     ":image" => $objModelItem->getImage(),
//                                     ":pubdate" => $objModelItem->getPubDate()));

            }
        }
    }
}