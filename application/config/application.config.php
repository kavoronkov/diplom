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
        "templates" => "application/views/default/"
    ),

    "dbconnection" => array(
        "dbHost" => "localhost",
        "dbName" => "NewsAgregator",
        "dbUser" => "root",
        "dbPass" => "",
    ),

    "autoload" => array(
        "class" => "AutoLoader",
        "method"=> "classLoader"
    ),

    "modules" => array(
        "Admin" => array(
            "dirrectory" => "modules/Admin",
            "views" => "modules/Admin/View"
        )
    ),

    "route_mask" => array(
        "Admin" => "/^(\\/admin(\\/[a-z_]{0,}){0,2})$/"
    )
);