<?php
/**
 * Configuration Eloquent ORM
 * Bootstrap Eloquent en mode standalone (sans Laravel)
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DB_HOST'],
    'database'  => $_ENV['DB_NAME'],
    'username'  => $_ENV['DB_USERNAME'],
    'password'  => $_ENV['DB_PASSWORD'],
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
    'strict'    => true,
    'engine'    => null,
]);

// Rendre Capsule disponible globalement
$capsule->setAsGlobal();

// Démarrer Eloquent
$capsule->bootEloquent();

// Optionnel : Activer les logs de requêtes en développement
if ($_ENV['APP_DEBUG'] ?? false) {
    $capsule->connection()->enableQueryLog();
}