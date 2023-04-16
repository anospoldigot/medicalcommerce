<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class ConfigSeeder extends Seeder
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

        $address = Address::create([
            'province_id'       => 35,
            'regency_id'        => 3507,
            'district_id'       => 3507040,
            'village_id'        => 3507040005,
            'postal_code'       => 65179,
            'detail'            => 'Jl. Kenari 2 blok i1',
            'latitude'          => '-6.3157',
            'longitude'         => '106.7969',
            'is_priority'       => 0
        ]);
        
        $data = [
            'address_id'        => $address->id,
            'merchant_key'      => '14e82f3fd51b5518b435ee4970fc7534',
            'merchant_code'     => 'DS12776',
            'return_url'        => '',
            'callback_url'      => '',
            'biteship_token'    =>  'biteship_test.eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiUGVtZWRpayIsInVzZXJJZCI6IjYzZDMwMzMyOWFiOTQ1MTIyYjY3NWE0NyIsImlhdCI6MTY3NDc3MzQ0M30.IAjCyQMVlIzLWFkKnKbDKFc8AFVwVLYFkeFy-ncT_eg'
        ];

        $contact = [
            [
                'type'          => 'email',
                'value'         => 'admin@permedik.com',
                'icon_class'    => 'fa-solid fa-envelope'
            ],
            [
                'type'              => 'phone',
                'value'             => '081398199618',
                'icon_class'        => 'fa-solid fa-phone'
            ],
            [
                'type'              => 'maps',
                'value'             => 'Jl. Kesehatan Raya No. 20, Bintaro, Jakarta Selatan',
                'icon_class'        => 'fa-solid fa-map-location-dot'
            ],
            [
                'type'              => 'email',
                'value'             => 'customercare@permedik.com',
                'icon_class'        => 'fa-solid fa-envelope'
            ],
            [
                'type'              => 'phone',
                'value'             => '081293692142',
                'icon_class'        => 'fa-solid fa-phone'
            ],
        ];

        $data['contact'] = json_encode($contact);

        $filename = time() . '_' . Str::random(10) . '.webp';
        Image::make($source_path . 'logo.png')
            ->encode('webp', 80)
            ->save($path . $filename);

        $data['logo']    = $filename;

        Config::create($data);
    }
}
