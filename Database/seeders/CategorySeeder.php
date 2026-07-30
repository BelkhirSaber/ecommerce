<?php

namespace Database\Seeders;

use Model\Category;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategorySeeder
{
    public function run()
    {

        $faker = Faker::create('fr_FR');
        
        echo "🌱 Seeding Categories...\n";
        
        $categories = [
            ['name' => 'Électronique', 'slug' => 'electronique'],
            ['name' => 'Vêtements', 'slug' => 'vetements'],
            ['name' => 'Maison & Jardin', 'slug' => 'maison-jardin'],
            ['name' => 'Sports & Loisirs', 'slug' => 'sports-loisirs'],
            ['name' => 'Livres', 'slug' => 'livres'],
        ];

        foreach ($categories as $index => $cat) {
            $category = Category::create([
                'FK_PARENT_CATEGORY' => null,
                'S_NAME' => $cat['name'],
                'S_SLUG' => $cat['slug'],
                'S_DESCRIPTION' => $faker->paragraph(),
                'I_ORDER' => $index + 1,
                'B_ACTIVE' => 1
            ]);

            for ($i = 1; $i <= 3; $i++) {
                Category::create([
                    'FK_PARENT_CATEGORY' => $category->PK_CATEGORY,
                    'S_NAME' => $cat['name'] . ' - ' . $faker->word(),
                    'S_SLUG' => $cat['slug'] . '-' . $faker->slug(2),
                    'S_DESCRIPTION' => $faker->sentence(),
                    'I_ORDER' => $i,
                    'B_ACTIVE' => 1
                ]);
            }
        }

        $count = Category::count();
        echo "   ✅ {$count} catégories créées\n";
    }
}
