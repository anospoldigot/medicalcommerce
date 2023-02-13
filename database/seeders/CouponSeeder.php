<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'              => Str::random(6),
            'discount'          => 50,
            'discount_type'     => 'persen',
            'expire_at'         => Carbon::create('2023-09-09'),
        ]);


        Coupon::create([
            'code'              => Str::random(6),
            'discount'          => 100000,
            'discount_type'     => 'nominal',
            'expire_at'         => Carbon::create('2023-09-09'),
        ]);

    }
}
