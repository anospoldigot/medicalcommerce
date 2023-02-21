<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        File::cleanDirectory(public_path('upload/images'));
        

        $this->call([
            UserSeeder::class, 
            CategoryProductSeeder::class, 
            ProductSeeder::class, 
            PostSeeder::class, 
            ChatSeeder::class,
            CouponSeeder::class,
            ConfigSeeder::class
        ]);
    }
}
