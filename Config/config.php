<?php

//-- Enable Display Errors

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//-- Get .Env Configuration

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
// echo "<pre>";
// var_dump($_ENV);
// echo "</pre>";

//-- Default Lang

$_SESSION['lang'] = $_ENV['DEFAULT_LANG'];

//-- Racine

define('RACINE', 'ecommerce');

//-- View Path

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views');

//-- Image Path

define('IMAGE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images');

//-- Database Config

// define('HOST', '127.0.0.1');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'b3s_store');