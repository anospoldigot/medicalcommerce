<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title'         => 'darah',
            'slug'          => Str::slug('darah', '-'),
            'description'   => 'Darah adalah cairan yang terdapat pada semua makhluk hidup (kecuali tumbuhan) tingkat tinggi yang berfungsi mengirimkan zat-zat dan oksigen yang dibutuhkan oleh jaringan tubuh, mengangkut bahan-bahan kimia hasil metabolisme dan juga sebagai pertahanan tubuh terhadap virus atau bakteri',
        ]);

        Category::create([
            'title'         => 'jantung',
            'slug'          => Str::slug('darah', '-'),
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung.',
        ]);
        
        Category::create([
            'title'         => 'umum',
            'slug'          => Str::slug('umum', '-'),
            'description'   => 'umum',
        ]);
    }
}
