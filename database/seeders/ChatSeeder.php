<?php

namespace Database\Seeders;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id       = 1;
        $customer_id    = 3;

        Message::upsert([
            [
                'to_id'     =>  $admin_id, 
                'from_id'   =>  $customer_id,
                'from_type' =>  'user',
                'content'   => 'Halo, untuk produk jantung sehat apa stoknya hanya 100??',
                'created_at'=> Carbon::create('21-01-2023 08:10:01')->format('Y-m-d H:i:s')
            ],
            [
                'to_id'     =>  $customer_id, 
                'from_id'   =>  $admin_id,
                'from_type' =>  'admin',
                'content'   => 'Baik dengan bapak rama, untuk produk jantung sehat hanya tersedia 100 untuk saat ini bapak',
                'created_at' => Carbon::create('21-01-2023 08:10:02')->format('Y-m-d H:i:s')
            ],
            [
                'to_id'     =>  $admin_id, 
                'from_id'   =>  $customer_id,
                'from_type' =>  'user',
                'content'   => 'Kira kira restock kapan ya mbak',
                'created_at' => Carbon::create('21-01-2023 08:10:03')->format('Y-m-d H:i:s')
            ],
            [
                'to_id'     =>  $admin_id, 
                'from_id'   =>  $customer_id,
                'from_type' =>  'user',
                'content'   => 'Kebetulan saya dari organisasi sehat indonesia mendapatkan donasi dan membutuhkan sekitar 500 product jantung sehat',
                'created_at' => Carbon::create('21-01-2023 08:10:04')->format('Y-m-d H:i:s')
            ],
            [
                'to_id'     =>  $customer_id,
                'from_id'   =>  $admin_id,
                'from_type' =>  'admin',
                'content'   => 'Baik bapak, kami akan restock di hari selasa 21 februari 2023',
                'created_at' => Carbon::create('21-01-2023 08:10:05')->format('Y-m-d H:i:s')
            ],
            [
                'to_id'     =>  $customer_id,
                'from_id'   =>  $admin_id,
                'from_type' =>  'admin',
                'content'   => 'Tapi jika bapak membutuhkan product tersebut lebih dari 100 kami sarankan kontak sales kami di link berikut https://medicalcommerce.test/contact',
                'created_at' => Carbon::create('21-01-2023 08:10:06')->format('Y-m-d H:i:s')
            ],
        ], [
            'to_id', 'from_id', 'from_type', 'content'
        ]);
    }
}
