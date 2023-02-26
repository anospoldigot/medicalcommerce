<?php

namespace Database\Seeders;

use App\Models\CategoryPost;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('upload/images/');
        $source_path = public_path('source/');

        $filename = Str::random(40) . '.webp';

        Image::make($source_path . 'post1.webp')
            ->encode('webp', 80)
            ->save($path . $filename, 80);

        $category = CategoryPost::create([
            'name' => 'Kesehatan',
            'slug' => Str::slug('Kesehatan', '-'),
        ]);

        $post = $category->post()->create([
            'title'     => 'Cara Jaga Kesehatan Jantung, Lakukan 5 Hal Ini',
            'slug'      => 'cara-jaga-kesehatan-jantung-lakukan-5-hal-ini',
            'image'     =>  $filename,
            'body'      => '<p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;"><span style="font-weight: bolder;">Halodoc</span>, Jakarta – Menjaga&nbsp;<a href="https://www.halodoc.com/kesehatan/penyakit-jantung" style="color: rgb(224, 0, 77) !important;">kesehatan jantung</a>&nbsp;adalah hal yang penting dilakukan, mengingat jantung merupakan organ vital yang bekerja tanpa henti. Organ ini memiliki peran yang sangat penting, yaitu memompa darah ke seluruh tubuh untuk menjaga kelangsungan hidup. Berbagai jenis gangguan atau penyakit bisa menyebabkan kondisi jantung memburuk, bahkan berujung pada kematian.&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Maka dari itu, sangat penting untuk selalu menjaga kesehatan dan fungsi jantung agar terhindar dari serangan penyakit. Ada beberapa cara yang bisa dilakukan untuk menjaga kesehatan jantung, bahkan sebagian besar caranya sangat sederhana dan mudah dilakukan. Salah satu hal penting untuk menjaga kesehatan organ ini adalah dengan menerapkan gaya hidup sehat dan pola makan yang baik. Agar lebih jelas, simak pembahasan seputar cara menjaga kesehatan jantung berikut!&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;"><span style="font-weight: bolder;">Baca juga:</span>&nbsp;<a href="https://www.halodoc.com/kebiasaan-merokok-dapat-merusak-kesehatan-jantung" style="color: rgb(224, 0, 77) !important;">Kebiasaan Merokok dapat Merusak Kesehatan Jantung</a></p><h2 style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; font-family: Nunito, sans-serif; font-weight: 700; line-height: 1.1; font-size: 2rem; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;"><span style="font-weight: bolder;">Cara Sederhana Menjaga Kesehatan Jantung&nbsp;</span></h2><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Menjaga kesehatan jantung bisa dilakukan dengan beberapa cara, terutama menjalani gaya hidup dan pola makan sehat. Merawat kesehatan jantung artinya merawat kehidupan. Pasalnya, saat jantung berhenti makan kehidupan seorang manusia pun akan ikut berhenti. Ada beberapa cara yang bisa diterapkan untuk menjaga kesehatan jantung, yaitu:&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal;"><span style="font-weight: bolder;">1. Makanan Sehat</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Salah satu cara terbaik untuk menjaga kesehatan jantung adalah dengan mengonsumsi makanan sehat, terutama yang banyak mengandung serat. Makanan yang kaya akan serat bermanfaat untuk menurunkan kadar kolesterol jahat (LDL) yang bisa meningkatkan risiko penyakit jantung. Kamu bisa mendapat asupan serta dari buah-buahan, sayuran, gandum, kacang, dan sereal. Lengkapi juga konsumsi serat dengan banyak minum air putih agar pencernaan lebih lancar.&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal;"><span style="font-weight: bolder;">2. Rutin Berolahraga</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Jarang berolahraga dan melakukan aktivitas fisik nyatanya juga berkaitan dengan peningkatan risiko penyakit jantung. Maka dari itu, salah satu cara terbaik untuk menghindarinya adalah dengan aktif secara fisik atau rutin melakukan olahraga. Di tengah kesibukan sehari-hari, sempatkanlah untuk berolahraga sekitar 20–30 menit setiap hari.&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;"><span style="font-weight: bolder;">Baca juga:</span>&nbsp;<a href="https://www.halodoc.com/makanan-kaya-serat-ampuh-cegah-penyakit-jantung-koroner" style="color: rgb(224, 0, 77) !important;">Makanan Kaya Serat Ampuh Cegah Penyakit Jantung Koroner</a></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal;"><span style="font-weight: bolder;">3. Berhenti Merokok</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Orang yang aktif merokok memiliki&nbsp;<a href="https://www.halodoc.com/5-cara-praktis-cegah-penyakit-jantung" style="color: rgb(224, 0, 77) !important;">risiko</a>&nbsp;lebih tinggi mengalami penyakit&nbsp;<a href="https://www.halodoc.com/kesehatan/penyakit-jantung-koroner" style="color: rgb(224, 0, 77) !important;">jantung koroner</a>. Tak hanya pada perokok, risiko penyakit ini juga meningkat pada orang di sekitar atau orang yang terpapar asap rokok. Zat beracun yang ada pada rokok dapat merusak pembuluh darah jantung dan menyebabkan gangguan pada aliran darah. Hal itu kemudian menyebabkan fungsi jantung menjadi terganggu karena kurangnya asupan nutrisi dan oksigen.&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal;"><span style="font-weight: bolder;">4. Kurangi Lemak Jenuh&nbsp;</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Mengonsumsi lemak jenuh dan lemak trans bisa meningkatkan kolesterol dalam darah, yang bisa memicu gangguan pada organ jantung. Kolesterol yang menumpuk bisa menyumbat pembuluh darah pada jantung dan memicu penyakit. Maka dari itu, sangat penting untuk membatasi konsumsi lemak jenuh, seperti daging merah, kulit ayam, makanan yang digoreng, serta produk susu kaya lemak.&nbsp;</p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal;"><span style="font-weight: bolder;">5. Cukup Tidur&nbsp;</span></p><p style="margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; font-family: Nunito, sans-serif; vertical-align: baseline; color: rgb(51, 51, 51); letter-spacing: normal; text-align: justify;">Kurang tidur juga bisa meningkatkan risiko penyakit jantung menyerang. Orang dewasa membutuhkan waktu istirahat minimal 7–8 jam dalam satu hari. Kurang beristirahat bisa meningkatkan risiko penyakit darah tinggi, diabetes, serta serangan jantung. Mengelola stres juga bisa membantu mencegah terjadinya penyakit jantung.&nbsp;</p>'
        ]);

        $post->tags()->attach([1,2,3,4,5]);

        $category = CategoryPost::create([
            'name' => 'Industri',
            'slug' => Str::slug('Industri', '-'),
        ]);

        $category = CategoryPost::create([
            'name' => 'Tips',
            'slug' => Str::slug('Tips', '-')
        ]);
    }
}
