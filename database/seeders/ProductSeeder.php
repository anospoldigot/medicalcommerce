<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Category::count();

        $product = Product::create([  
            'title'         => '1 set tool medis standar',
            'slug'          => Str::slug('1 set tool medis standar', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 900000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => rand(1, $count)
        ]);

        $product->assets()->create([
            'filename'      => 'tools1.jpg'
        ]);


        $product = Product::create([  
            'title'         => 'HEMATOLOGY ANALYZER',
            'slug'          => Str::slug('HEMATOLOGY ANALYZER', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 300000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => rand(1, $count)
        ]);


        $product->assets()->create([
            'filename'      => 'tools2.jpg'
        ]);

        $product = Product::create([  
            'title'         => '2 IN 1 Infus pump & Stetoskop',
            'slug'          => Str::slug('2 IN 1 Infus pump & Stetoskop', '-'),
            'description'   => 'Stetoskop merupakan alat yang digunakan para tenaga medis untuk mendengarkan suara organ di dalam tubuh, seperti denyut jantung, nadi, organ pencernaan, dan paru-paru. Tidak hanya itu, alat ini juga dapat mendengar suara aliran darah bahkan bunyi detak jantung janin yang masih berada di dalam kandungan',
            'stock'         => 100,
            'price'         => 1100000,
            'sold'          => NULL,
            'is_discount'   => 1,
            'discount'      => 50,
            'discount_type' => 'persen',
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => rand(1, $count)
        ]);


        $product->assets()->create([
            'filename'      => 'tools3.jpg'
        ]);

        $product = Product::create([  
            'title'         => '2 IN 1 Termometer & Stetoskop',
            'slug'          => Str::slug('2 IN 1 Termometer & Stetoskop', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 1100000,
            'sold'          => NULL,
            'is_discount'   => 1,
            'discount'      => 50000,
            'discount_type' => 'nominal',
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => rand(1, $count)
        ]);


        $product->assets()->create([
            'filename'      => 'tools4.jpg'
        ]);


    }
}
