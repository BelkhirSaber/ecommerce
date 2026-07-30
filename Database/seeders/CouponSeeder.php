<?php

namespace Database\Seeders;

use Model\Coupon;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CouponSeeder
{
    public function run()
    {

        $faker = Faker::create('fr_FR');
        
        echo "🌱 Seeding Coupons...\n";

        $coupons = [
            ['code' => 'WELCOME10', 'type' => 'percentage', 'value' => 10],
            ['code' => 'SUMMER20', 'type' => 'percentage', 'value' => 20],
            ['code' => 'FIXED50', 'type' => 'fixed', 'value' => 50],
            ['code' => 'PROMO15', 'type' => 'percentage', 'value' => 15],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create([
                'S_CODE' => $coupon['code'],
                'S_DESCRIPTION' => $faker->sentence(),
                'E_TYPE' => $coupon['type'],
                'D_VALUE' => $coupon['value'],
                'D_MIN_ORDER_AMOUNT' => 50.00,
                'I_MAX_USES' => 100,
                'I_CURRENT_USES' => 0,
                'I_MAX_USES_PER_USER' => 1,
                'DT_START_DATE' => Carbon::now(),
                'DT_END_DATE' => Carbon::now()->addMonths(3),
                'B_ACTIVE' => 1
            ]);
        }

        echo "   ✅ " . Coupon::count() . " coupons créés\n";
    }
}
