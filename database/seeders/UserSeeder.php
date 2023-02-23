<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserSeeder extends Seeder
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
            Image::make($source_path . 'profile.webp')->fit(500)
                ->encode('webp', 90)
                ->save($path . 'avatar_default.webp');


        // Developer
        $user = User::create([
            'name'      => 'developer',
            'email'     => 'developer@example.com',
            'password'  => bcrypt('password'),
            'phone'     => '081398199618',
        ]);


        $user->assignRole('developer');

        // Admin
        $user = User::create([
            'name'      => 'admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'phone'     => '081398199618',
        ]);

        $user->assignRole('admin');

        
        // Customer
        $user = User::create([
            'name'      => 'rama',
            'email'     => 'ramaramarama009@gmail.com',
            'password'  => bcrypt('password'),
            'phone'     => '081293692142',
        ]);

        $user->assignRole('customer');
        

        $data = [
            'province_id'       => 32,
            'regency_id'        => 3201,
            'district_id'       => 3201170,
            'village_id'        => 3201170001,
            'postal_code'       => 11240,
            'detail'            => 'Jl. Pejagalan Raya',
            'latitude'          => '-6.407595511848003',
            'longitude'         => '106.99576377868654',
            'is_priority'       => 1
        ];

        $data['rawdata'] =json_encode($data);

        $user->addresses()->create($data);

        $data = [
            'province_id'       => 35,
            'regency_id'        => 3507,
            'district_id'       => 3507040,
            'village_id'        => 3507040005,
            'postal_code'       => 65179,
            'detail'            => 'Jl. Kenari 2 blok i1',
            'latitude'          => '-6.407595511848003',
            'longitude'         => '106.99576377868654',
            'is_priority'       => 0
        ];

        $data['rawdata'] =json_encode($data);

        $user->addresses()->create($data);

        $user = User::create([
            'name'      => 'amar',
            'email'     => 'amawdhans@gmail.com',
            'password'  => bcrypt('password'),
            'phone'     => '081293692142',
        ]);

        $user->assignRole('customer');

    }
}
