<?php
header('Content-Type: text/html; charset="utf-8"');
set_include_path(get_include_path() . PATH_SEPARATOR . "controllers/");

spl_autoload_register(function ($class) {
    include 'models/' . $class . '.php';
});

$params = parse_ini_file('config.ini');
$db = new PDO($params['db.conn'], $params['db.user'], $params['db.pass']);

//$sxml = simplexml_load_file($xml);
$sxml = simplexml_load_file("http://news.liga.net/politics/rss.xml");
$sxmlItem = $sxml->xpath("/rss/channel/item");

foreach($sxmlItem as $item) {

    $objModelItem = new ItemModel();
    ItemModel::$counter++;
    $id = date("YmdHis") . (1000+ItemModel::$counter);
    $objModelItem->setId($id);

    foreach($item as $itemProperty) {

        switch($itemProperty->getName())
        {
            case "title" : $objModelItem->setItem($itemProperty->__toString()); break;
            case "link" : $objModelItem->setLink($itemProperty->__toString()); break;
            case "description" : $objModelItem->setDescription($itemProperty->__toString()); break;
            case "enclosure" : $objModelItem->setImage($itemProperty->attributes()->url->__toString()); break;
            case "pubDate" : $objModelItem->setPubDate($itemProperty->__toString());
//                             $objModelItem->setIdForeign($$objSourceModel->getId());
                             break;
            default : echo "ERROR"; break;
        }

    }

    $check = $db->prepare("SELECT Item.link, Item.pubDate, Item.idSource
                                   FROM Item ORDER BY Item.pubDate DESC LIMIT 1");
    $check->execute();

    if( $objModelItem->getLink() == $check["link"] &&
        $objModelItem->getPubDate() == $check["pubDate"] &&
        $objModelItem->getIdForeign() == $check["idSource"] ) { break; }
    else {
        $stmt = $db->prepare("INSERT INTO Item(id, name, link, description, image, pubDate)
                                  VALUES (:id, :name, :link, :description, :image, :pubDate)");

        $stmt->execute(array(":id" => $objModelItem->getId(),
            ":name" => $objModelItem->getItem(),
            ":link" => $objModelItem->getLink(),
            ":description" => $objModelItem->getDescription(),
            ":image" => $objModelItem->getImage(),
            ":pubDate" => $objModelItem->getPubDate()));
    }


}

