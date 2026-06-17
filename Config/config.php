<?php

//-- Enable Display Errors

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('error_log', __DIR__ . '/logs/php-error.log');
error_reporting(E_ALL);

if($_ENV['DEBUG'] === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('error_log', __DIR__ . '/logs/php-error.log');
    error_reporting(E_ALL);
}

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

// -- Assets
define('ASSETS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR . 'assets' );

//-- View Path

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views');

//-- Image Path

define('IMAGE_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images');

//-- Assets URL
define('ASSETS_URL', '/assets');
define('CSS_URL', '/assets/css');
define('JS_URL', '/assets/js');
define('IMG_URL', '/assets/images');

