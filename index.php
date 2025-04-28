<?php

session_start();

require_once __DIR__ . '/core/Autoloader.php';

$frontController = new FrontController();
$frontController->run();
