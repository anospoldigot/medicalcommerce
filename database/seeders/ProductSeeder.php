<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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
        $path = public_path('upload/images/');
        $source_path = public_path('source/');

        // Alat Pemeriksaaan
        $product = Product::create([
            'title'         => 'Thermometer B2XD',
            'slug'          => Str::slug('Thermometer B2XD', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 900000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Pemeriksaan')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'thermometer.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);



        // Alat Bedah
        $product = Product::create([
            'title'         => 'Scissors Z1SCF',
            'slug'          => Str::slug('Scissors Z1SCF', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 900000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Bedah')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'scissors.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);



        
        // Alat Terapi
        $product = Product::create([
            'title'         => 'Oxygen RT250',
            'slug'          => Str::slug('Oxygen RT250', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Terapi')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'oxygen.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);



        // Alat Diagnostik
        $product = Product::create([
            'title'         => 'CT SCAN 001A',
            'slug'          => Str::slug('CT SCAN 001A', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Diagnostik')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'ct-scans.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);


        // Alat Rehabilitasi
        $product = Product::create([
            'title'         => 'Crutches 1021A',
            'slug'          => Str::slug('crutches 1021A', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Rehabilitasi')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'crutches.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);



        // Alat Cuci dan Sterilisasi
        $product = Product::create([
            'title'         => 'Autoclaves Tipe2A',
            'slug'          => Str::slug('Autoclaves Tipe2A', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Cuci dan Sterilisasi')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'autoclaves.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);       
        
        
        // Alat Penyimpanan dan Transportasi
        $product = Product::create([
            'title'         => 'Tote bag medical',
            'slug'          => Str::slug('Tote bag medical', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Penyimpanan dan Transportasi')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'tote_bag.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);




        // Alat Bantu
        $product = Product::create([
            'title'         => 'Leg Support v1',
            'slug'          => Str::slug('Leg Support v1', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Bantu')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'leg_support.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);
        
        
        // Alat Konsumables
        $product = Product::create([
            'title'         => 'Mask august t1',
            'slug'          => Str::slug('Mask august t1', '-'),
            'description'   => 'alat lengkap pembedah dosa dengan standar medis internasional',
            'stock'         => 100,
            'price'         => 15000,
            'sold'          => NULL,
            'is_discount'   => 0,
            'is_front'      => 1,
            'weight'        => 1000,
            'sku'           => 'PRD' . Str::random(14),
            'category_id'   => Category::where('title', 'Alat Konsumables')->first()->id
        ]);

        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'masks.jpg')->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);




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

        $filename = Str::random(40) . '.webp';
        Image::make($source_path . 'tools1.jpg')
            ->fit(500)
            ->encode('webp', 90)
            ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);


        $product = Product::create([  
            'title'         => 'hematology analyzer',
            'slug'          => Str::slug('hematology analyzer', '-'),
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


        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'tools2.jpg')
                ->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
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


        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'tools3.jpg')
                ->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
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


        $filename = Str::random(40) . '.webp';
            Image::make($source_path . 'tools4.jpg')
                ->fit(500)
                ->encode('webp', 90)
                ->save($path . $filename);

        $product->assets()->create([
            'filename'      => $filename
        ]);


    }
}
