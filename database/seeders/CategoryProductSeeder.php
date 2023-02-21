<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Alat Pemeriksaan: termasuk stetoskop, termometer, tekanan darah, otoskop, ophthalmoscope, spirometer, nebulizer, dan sebagainya.

        // Alat Bedah: termasuk pisau bedah, gunting, pinset, retractor, hemostat, kateter, dan sebagainya.

        // Alat Terapi: termasuk nebulizer, oksigen, inhaler, CPAP, perangkat bantuan pernapasan, dan sebagainya.

        // Alat Laboratorium: termasuk mikroskop, centrifuge, pipet, pH meter, spektrofotometer, spektrometer massa, dan sebagainya.

        // Alat Diagnostik: termasuk MRI, CT scan, X-ray, ultrasonografi, mamografi, PET scan, dan sebagainya.

        // Alat Rehabilitasi: termasuk kursi roda, kruk, walker, brace, prostetik, dan sebagainya.

        // Alat Cuci dan Sterilisasi: termasuk autoclave, mesin cuci instrumen, alat pembersih ultrasonik, dan sebagainya.

        // Alat Penyimpanan dan Transportasi: termasuk kulkas medis, box pendingin, tote bag, dan sebagainya.

        // Alat Bantu: termasuk bantal dan bantal khusus, penyangga kaki, penyangga lengan, brace, dan sebagainya.

        // Alat Konsumables: termasuk balutan, plester, masker, sarung tangan medis, jarum, kateter, dan sebagainya.


        $path = public_path('upload/images/');
        $source_path = public_path('source/');

        $filename = Str::random(99) . '.webp';
        Image::make($source_path . 'alat_pemeriksaan.jpg')->fit(400)
            ->encode('webp', 80)
            ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Pemeriksaan',
            'slug'          => Str::slug('Alat Pemeriksaan', '-'),
            'image'         => $filename,
            'description'   => 'Darah adalah cairan yang terdapat pada semua makhluk hidup (kecuali tumbuhan) tingkat tinggi yang berfungsi mengirimkan zat-zat dan oksigen yang dibutuhkan oleh jaringan tubuh, mengangkut bahan-bahan kimia hasil metabolisme dan juga sebagai pertahanan tubuh terhadap virus atau bakteri',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_bedah.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Bedah',
            'slug'          => Str::slug('Alat Bedah', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung.',
        ]);



        $filename = Str::random(99) . '.webp';
        Image::make($source_path . 'alat_terapi.jpg')->fit(400)
            ->encode('webp', 80)
            ->save($path . $filename);
        
        Category::create([
            'title'         => 'Alat Terapi',
            'slug'          => Str::slug('Alat Terapi', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_labolatorium.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Laboratorium',
            'slug'          => Str::slug('Alat Laboratorium', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_diagnostik.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Diagnostik',
            'slug'          => Str::slug('Alat Diagnostik', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_rehabilitasi.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Rehabilitasi',
            'slug'          => Str::slug('Alat Rehabilitasi', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_cuci_sterilisasi.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Cuci dan Sterilisasi',
            'slug'          => Str::slug('Alat Cuci dan Sterilisasi', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_penyimpanan_transportasi.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);
        
        Category::create([
            'title'         => 'Alat Penyimpanan dan Transportasi',
            'slug'          => Str::slug('Alat Penyimpanan dan Transportasi', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_bantu.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Bantu',
            'slug'          => Str::slug('Alat Bantu', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);



        $filename = Str::random(99) . '.webp';
            Image::make($source_path . 'alat_konsumsi.jpg')->fit(400)
                ->encode('webp', 80)
                ->save($path . $filename);

        Category::create([
            'title'         => 'Alat Konsumables',
            'slug'          => Str::slug('Alat Konsumables', '-'),
            'image'         => $filename,
            'description'   => 'Jantung adalah organ vital yang berfungsi sebagai pemompa darah untuk memenuhi kebutuhan oksigen dan nutrisi ke seluruh tubuh. Apabila jantung mengalami gangguan, peredaran darah dalam tubuh dapat terganggu sehingga menjaga kesehatan jantung sangatlah penting agar terhindar dari berbagai jenis penyakit jantung',
        ]);
    }
}
