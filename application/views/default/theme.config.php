<?php
return array(
    "templates_blocks" => array(
                                "header" => array(
                                    "pos" => "1"
                                ),
                                "footer" => array(
                                    "pos" => "100"
                                ),
                                "sidebar",
                                "content"
    ),
    "routes" => array(
        "/category/index" => array(
            "templates_blocks" => array("header","footer","content")
        )
    )

);