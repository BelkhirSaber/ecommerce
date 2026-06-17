<?php

namespace Database\Seeders;

use Model\Attribute;
use Model\AttributeValue;

class AttributeSeeder
{
    public function run()
    {
        echo "🌱 Seeding Attributes...\n";
        
        $attributes = [
            'Couleur' => ['Rouge', 'Bleu', 'Vert', 'Noir', 'Blanc', 'Jaune'],
            'Taille' => ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
            'Matériau' => ['Coton', 'Polyester', 'Laine', 'Soie', 'Lin'],
            'Capacité' => ['32GB', '64GB', '128GB', '256GB', '512GB'],
        ];

        foreach ($attributes as $name => $values) {
            $attribute = Attribute::create(['NAME' => $name]);
            
            foreach ($values as $value) {
                AttributeValue::create([
                    'FK_ATTRIBUTE' => $attribute->PK_ATTRIBUTE,
                    'VALUE' => $value
                ]);
            }
        }

        echo "   ✅ " . Attribute::count() . " attributs créés\n";
        echo "   ✅ " . AttributeValue::count() . " valeurs d'attributs créées\n";
    }
}
