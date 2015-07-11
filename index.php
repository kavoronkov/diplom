<?php

include "application/Application.php";

$fc = Application::getInstance() -> init();

$fc -> route();

$fc->getBody();