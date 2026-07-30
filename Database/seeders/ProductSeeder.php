<?php

namespace Database\Seeders;

use Model\Product;
use Model\ProductVariant;
use Model\ProductImage;
use Model\Category;
use Model\AttributeValue;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder
{
    public function run()
    {

        $faker = Faker::create('fr_FR');
        
        echo "🌱 Seeding Products...\n";
        
        $categories = Category::whereNotNull('FK_PARENT_CATEGORY')->get();
        $colors = AttributeValue::whereHas('attribute', function($q) {
            $q->where('NAME', 'Couleur');
        })->get();
        
        $sizes = AttributeValue::whereHas('attribute', function($q) {
            $q->where('NAME', 'Taille');
        })->get();

        for ($i = 1; $i <= 50; $i++) {
            $category = $categories->random();
            
            $product = Product::create([
                'FK_CATEGORY' => $category->PK_CATEGORY,
                'SLUG' => $faker->slug(3),
                'TITLE' => $faker->words(3, true),
                'SHORT_DESCRIPTION' => $faker->sentence(),
                'IN_STOCK' => 1,
                'SHOW_IN_STORE' => 1
            ]);

            for ($j = 1; $j <= rand(1, 4); $j++) {
                ProductImage::create([
                    'FK_PRODUCT' => $product->PK_PRODUCT,
                    'IMAGE' => 'https://picsum.photos/800/600?random=' . $i . $j,
                    'POSITION' => $j
                ]);
            }

            for ($v = 1; $v <= rand(2, 5); $v++) {
                $variant = ProductVariant::create([
                    'FK_PRODUCT' => $product->PK_PRODUCT,
                    'SKU' => strtoupper($faker->bothify('SKU-####??')),
                    'PRICE' => $faker->randomFloat(2, 10, 500),
                    'DISCOUNT' => rand(0, 30),
                    'STOCK' => rand(0, 100),
                    'IMAGE' => 'https://picsum.photos/400/400?random=' . $i . $v,
                    'ACTIVE' => 1
                ]);

                if ($colors->count() > 0) {
                    $variant->attributeValues()->attach($colors->random()->PK_ATTRIBUTE_VALUE);
                }
                if ($sizes->count() > 0) {
                    $variant->attributeValues()->attach($sizes->random()->PK_ATTRIBUTE_VALUE);
                }
            }
        }

        echo "   ✅ " . Product::count() . " produits créés\n";
        echo "   ✅ " . ProductVariant::count() . " variants créés\n";
        echo "   ✅ " . ProductImage::count() . " images créées\n";
    }
}
