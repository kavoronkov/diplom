<?php
header('Content-Type: text/html; charset="utf-8"');
set_include_path(get_include_path() . PATH_SEPARATOR . "controller/");

spl_autoload_register(function ($class) {
    include 'model/' . $class . '.php';
});

$sxml = simplexml_load_file("http://news.liga.net/all/rss.xml");

//print_r($sxml);
$objModelItem = new ModelItem();

$result = $sxml->xpath("/rss/channel/item");
//
//foreach($sxml->channel->item as $item) {
//    echo $item->title . "<br>";
//}



//var_dump($result);
foreach($result as $sxmlItem) {
    ModelItem::$counter++;
    $id = date("YmdHis") . (1000+ModelItem::$counter);
    echo "<br>ID = ".$id;
    foreach($sxmlItem as $param) {
        if($param->getName() == "enclosure" ) {
            foreach($param->attributes() as $img) {
                echo $img . "<br>";
            }
        } else {
            echo $param."<br>";
        }
        switch($param->getName())
        {
            case "title" : $objModelItem->setItem($param); break;
            case "link" : $objModelItem->setLink($param->__toString()); break;
            case "description" : $objModelItem->setDescription($param->__toString()); break;
            case "enclosure" : $objModelItem->setImage($param->attributes()->url->__toString()); break;
            case "pubDate" : $objModelItem->setPubDate($param->__toString()); break;
            default : echo "ERROR"; break;
        }

    }


    var_dump($objModelItem);
}

//var_dump($objModelItem);

