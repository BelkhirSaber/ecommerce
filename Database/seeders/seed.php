<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once __DIR__ . '/../../Config/database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

use Database\Seeders\CategorySeeder;
use Database\Seeders\AttributeSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CouponSeeder;


function truncateAllTables(): void
{
    $connection = Capsule::connection();

    echo "🗑️  Truncating all tables...\n\n";

    // Désactiver les contraintes FK
    $connection->statement('SET FOREIGN_KEY_CHECKS=0');

    try {
        // Récupérer toutes les tables de la base
        $tables = $connection->select('SHOW TABLES');

        foreach ($tables as $table) {
            $tableName = array_values((array) $table)[0];

            echo "   Truncating: {$tableName}\n";

            $connection->table($tableName)->truncate();
        }

        echo "\n✅ All tables truncated successfully\n\n";

    } finally {
        // Toujours réactiver les FK
        $connection->statement('SET FOREIGN_KEY_CHECKS=1');
    }
}


echo "\n";
echo "═══════════════════════════════════════\n";
echo "🌱 DATABASE SEEDING STARTED\n";
echo "═══════════════════════════════════════\n\n";


try {

    // ==========================================
    // 1. RESET DATABASE
    // ==========================================

    truncateAllTables();


    // ==========================================
    // 2. RUN SEEDERS
    // ==========================================

    echo "🌱 Running seeders...\n\n";

    (new CategorySeeder())->run();
    (new AttributeSeeder())->run();
    (new ProductSeeder())->run();
    (new UserSeeder())->run();
    (new OrderSeeder())->run();
    (new CouponSeeder())->run();


    // ==========================================
    // 3. SUCCESS
    // ==========================================

    echo "\n";
    echo "═══════════════════════════════════════\n";
    echo "✅ DATABASE SEEDING COMPLETED\n";
    echo "═══════════════════════════════════════\n";

} catch (\Throwable $e) {

    echo "\n";
    echo "═══════════════════════════════════════\n";
    echo "❌ DATABASE SEEDING FAILED\n";
    echo "═══════════════════════════════════════\n";

    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}