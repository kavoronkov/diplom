<?php
header('Content-Type: text/html; charset="utf-8"');
set_include_path(get_include_path() . PATH_SEPARATOR . "controller/");

function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}

$sxml = simplexml_load_file("http://news.liga.net/all/rss.xml");

//print_r($sxml);


$result = $sxml->xpath("/rss/channel/item");
//var_dump($result);
foreach($result as $sxmlItem) {
    foreach($sxmlItem as $param) {
//        echo "<br><br>IN count if<br><br>";
//        echo "<br>ATRRIBUTES = ".$param->attributes()."<br>";
        if($param->getName() == "enclosure" ) {
//            echo "<br><br>IN count if<br><br>";
            foreach($param->attributes() as $img) {
                echo $img . "<br>";
            }
        }else {
            echo $param."<br>";
        }
    }
}

