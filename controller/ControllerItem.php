<?php

class ControllerItem {

    protected function add($xml) {
        $sxml = simplexml_load_file($xml);
    }

    protected function insert($sxml) {
        $params = parse_ini_file('config.ini');
        $db = new PDO($params['db.conn'], $params['db.user'], $params['db.pass']);
        $sql = "INSERT INTO item(id, item, link, description, image, pubDate, text, idForeign)
                       VALUES ();";
    }

}