<?php

session_start();

define('ROOT', realpath(__DIR__));

require_once ROOT . '/core/Autoloader.php';

date_default_timezone_set(Config::get('app.timezone', 'UTC'));

if (Config::get('app.debug', false)) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
}

$frontController = new FrontController();
$frontController->run();
