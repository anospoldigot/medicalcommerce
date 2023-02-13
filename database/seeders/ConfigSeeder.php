<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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


        Config::create($data);
    }
}
