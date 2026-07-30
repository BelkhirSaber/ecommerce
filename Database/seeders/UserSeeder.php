<?php

namespace Database\Seeders;

use Model\User;
use Model\Address;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder
{
    public function run()
    {

        $faker = Faker::create('fr_FR');
        
        echo "🌱 Seeding Users...\n";

        $admin = User::create([
            'S_FIRSTNAME' => 'Admin',
            'S_LASTNAME' => 'B3S',
            'S_EMAIL' => 'admin@b3s.com',
            'S_PASSWORD' => password_hash('admin123', PASSWORD_BCRYPT),
            'S_PHONE' => $faker->phoneNumber(),
            'E_ROLE' => 'admin',
            'B_ACTIVE' => 1
        ]);

        Address::create([
            'FK_USER' => $admin->PK_USER,
            'S_LABEL' => 'Domicile',
            'S_FIRSTNAME' => 'Admin',
            'S_LASTNAME' => 'B3S',
            'S_ADDRESS_LINE1' => $faker->streetAddress(),
            'S_CITY' => $faker->city(),
            'S_POSTAL_CODE' => $faker->postcode(),
            'S_COUNTRY' => 'France',
            'S_PHONE' => $faker->phoneNumber(),
            'B_IS_DEFAULT' => 1,
            'E_TYPE' => 'both'
        ]);

        for ($i = 1; $i <= 20; $i++) {
            $user = User::create([
                'S_FIRSTNAME' => $faker->firstName(),
                'S_LASTNAME' => $faker->lastName(),
                'S_EMAIL' => $faker->unique()->email(),
                'S_PASSWORD' => password_hash('password123', PASSWORD_BCRYPT),
                'S_PHONE' => $faker->phoneNumber(),
                'E_ROLE' => 'customer',
                'B_ACTIVE' => 1
            ]);

            for ($j = 1; $j <= rand(1, 2); $j++) {
                Address::create([
                    'FK_USER' => $user->PK_USER,
                    'S_LABEL' => $j === 1 ? 'Domicile' : 'Travail',
                    'S_FIRSTNAME' => $user->S_FIRSTNAME,
                    'S_LASTNAME' => $user->S_LASTNAME,
                    'S_ADDRESS_LINE1' => $faker->streetAddress(),
                    'S_CITY' => $faker->city(),
                    'S_POSTAL_CODE' => $faker->postcode(),
                    'S_COUNTRY' => 'France',
                    'S_PHONE' => $faker->phoneNumber(),
                    'B_IS_DEFAULT' => $j === 1,
                    'E_TYPE' => 'both'
                ]);
            }
        }

        echo "   ✅ " . User::count() . " utilisateurs créés\n";
        echo "   ✅ " . Address::count() . " adresses créées\n";
    }
}
