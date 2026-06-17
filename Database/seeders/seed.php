<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

require_once __DIR__ . '/../../Config/database.php';

use Database\Seeders\CategorySeeder;
use Database\Seeders\AttributeSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CouponSeeder;

echo "\n";
echo "═══════════════════════════════════════\n";
echo "🌱 DATABASE SEEDING STARTED\n";
echo "═══════════════════════════════════════\n\n";

try {
    (new CategorySeeder())->run();
    (new AttributeSeeder())->run();
    (new ProductSeeder())->run();
    (new UserSeeder())->run();
    (new OrderSeeder())->run();
    (new CouponSeeder())->run();

    echo "\n";
    echo "═══════════════════════════════════════\n";
    echo "✅ DATABASE SEEDING COMPLETED\n";
    echo "═══════════════════════════════════════\n";
    echo "\n📊 Credentials:\n";
    echo "   Admin: admin@b3s.com / admin123\n";
    echo "   Customer: password123\n\n";
    
} catch (Exception $e) {
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
