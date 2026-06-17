<?php
/**
 * Migration Runner - Exécute toutes les migrations dans l'ordre
 */

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once __DIR__ . '/../../Config/database.php';

echo "🚀 Exécution des migrations...\n\n";

// Lister tous les fichiers de migration
$migrationFiles = glob(__DIR__ . '/*.php');
sort($migrationFiles); // Trier par ordre alphabétique (timestamp)

// Exclure migrate.php lui-même
$migrationFiles = array_filter($migrationFiles, function($file) {
    return !in_array(basename($file), ['migrate.php', 'rollback.php']);
});

$successCount = 0;
$errorCount = 0;

foreach ($migrationFiles as $file) {
    $filename = basename($file);
    echo "📄 Migration: {$filename}\n";
    
    try {
        $migration = require $file;
        
        if (method_exists($migration, 'up')) {
            $migration->up();
            echo "   ✅ Succès\n";
            $successCount++;
        } else {
            echo "   ⚠️  Pas de méthode up()\n";
        }
    } catch (Exception $e) {
        echo "   ❌ Erreur: " . $e->getMessage() . "\n";
        $errorCount++;
    }
    
    echo "\n";
}

echo "═══════════════════════════════════════\n";
echo "🎉 MIGRATIONS TERMINÉES\n";
echo "═══════════════════════════════════════\n";
echo "✅ Réussies : {$successCount}\n";
echo "❌ Échouées : {$errorCount}\n";
echo "═══════════════════════════════════════\n";