<?php

namespace Database\Seeders;

use Model\Order;
use Model\OrderItem;
use Model\User;
use Model\ProductVariant;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder
{
    public function run()
    {
        $faker = Faker::create('fr_FR');
        
        echo "🌱 Seeding Orders...\n";

        $customers = User::where('E_ROLE', 'customer')->get();
        $variants = ProductVariant::with('product')->get();

        for ($i = 1; $i <= 30; $i++) {
            $customer = $customers->random();
            $subtotal = 0;

            $order = Order::create([
                'FK_CUSTOMER' => $customer->PK_USER,
                'ORDER_NUMBER' => 'ORD-' . strtoupper($faker->bothify('####??##')),
                'STATUS' => $faker->randomElement(['pending', 'paid', 'processing', 'shipped', 'delivered']),
                'SUBTOTAL' => 0,
                'DISCOUNT_AMOUNT' => 0,
                'SHIPPING_AMOUNT' => $faker->randomFloat(2, 5, 15),
                'TOTAL_AMOUNT' => 0,
                'CUSTOMER_NAME' => $customer->S_FIRSTNAME . ' ' . $customer->S_LASTNAME,
                'CUSTOMER_EMAIL' => $customer->S_EMAIL,
                'SHIPPING_ADDRESS' => $faker->address(),
                'CREATED_AT' => Carbon::now()->subDays(rand(0, 60))
            ]);

            $itemCount = rand(1, 5);
            for ($j = 0; $j < $itemCount; $j++) {
                $variant = $variants->random();
                $quantity = rand(1, 3);
                $unitPrice = $variant->PRICE;
                $lineTotal = $unitPrice * $quantity;
                $subtotal += $lineTotal;

                OrderItem::create([
                    'FK_ORDER' => $order->PK_ORDER,
                    'FK_PRODUCT' => $variant->FK_PRODUCT,
                    'FK_PRODUCT_VARIANT' => $variant->PK_PRODUCT_VARIANT,
                    'PRODUCT_TITLE' => $variant->product->TITLE,
                    'PRODUCT_SKU' => $variant->SKU,
                    'UNIT_PRICE' => $unitPrice,
                    'QUANTITY' => $quantity,
                    'LINE_TOTAL' => $lineTotal
                ]);
            }

            $order->update([
                'SUBTOTAL' => $subtotal,
                'TOTAL_AMOUNT' => $subtotal + $order->SHIPPING_AMOUNT
            ]);
        }

        echo "   ✅ " . Order::count() . " commandes créées\n";
        echo "   ✅ " . OrderItem::count() . " items de commande créés\n";
    }
}
