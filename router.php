<?php
// Routeur pour le serveur PHP intégré :
//   php -S localhost:8000 -t Public router.php
//
// - Sert les fichiers statiques existants dans Public/
// - Envoie toutes les autres requêtes vers Public/index.php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . '/Public' . $path;

if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/Public/index.php';
