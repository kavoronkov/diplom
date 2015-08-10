<?php

require_once "application/Application.php";

$objFrontController = Application::getInstance() -> init();

$objFrontController -> route();

$objFrontController -> getBody();