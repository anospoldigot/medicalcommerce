<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'phone'     => '081398199618',
            'role'      => 'admin',
        ]);

        // Customer
        $user = User::create([
            'name'      => 'rama',
            'email'     => 'ramaramarama009@gmail.com',
            'password'  => bcrypt('password'),
            'phone'     => '081293692142',
            'role'      => 'customer',
        ]);

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

    }
}
