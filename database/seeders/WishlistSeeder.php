<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::get()->each(function($user){
            if($user->hasRole('customer')){
                $user->wishlists()->attach(Product::inRandomOrder()->get()->pluck('id'));
            }
            
        });
    }
}
