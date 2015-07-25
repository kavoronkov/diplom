<?php

require_once "application/Application.php";

$fc = Application::getInstance() -> init();

$fc -> route();

$fc->getBody();