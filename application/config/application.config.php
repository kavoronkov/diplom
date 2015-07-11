<?php
return array(
    "path" => array(
        "application" => "application",
        "controllers" => "application/controllers",
        "models" => "application/models",
        "views" => "application/views",
        "modules" => "modules",
        "core" => "core",
        "patterns" => "core/patterns",
        "temlates" => "application/views/default"
    ),

    "dbconnection" => array(
        "dbHost" => "localhost",
        "dbName" => "NewsAgregator",
        "dbUser" => "root",
        "dbPass" => "",
    ),

    "autoload" => array(
        "class" => "Autoloader",
        "method"=> "classLoader"
    )
);