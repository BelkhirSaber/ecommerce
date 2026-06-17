<?php
/**
 * Rollback - Annule toutes les migrations
 */

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once __DIR__ . '/../../Config/database.php';

echo "🔄 Rollback des migrations...\n\n";

$migrationFiles = glob(__DIR__ . '/*.php');
rsort($migrationFiles); // Ordre inverse pour le rollback

$migrationFiles = array_filter($migrationFiles, function($file) {
    return !in_array(basename($file), ['migrate.php', 'rollback.php']);
});

foreach ($migrationFiles as $file) {
    $filename = basename($file);
    echo "📄 Rollback: {$filename}\n";
    
    try {
        $migration = require $file;
        
        if (method_exists($migration, 'down')) {
            $migration->down();
            echo "   ✅ Table supprimée\n";
        }
    } catch (Exception $e) {
        echo "   ⚠️  " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo "🎉 Rollback terminé\n";