<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = Warehouse::create([
            'id'            => Uuid::uuid4(),
            'name'          => 'Cabang A jakarta Barat',
            'province_id'   => 31,
            'regency_id'    => 3174,
            'district_id'   => 3174020,
            'village_id'    => 3174020004,
            'postal_code'   => 40181,
            'latitude'      => -6.219721,
            'longitude'     => 106.751753
        ]);


        $user = User::create([
            'name'          => 'akuncabangjakbar',
            'email'         => 'akuncabangjakbar@example.com',
            'password'      => bcrypt('password'),
            'phone'         => '081293692142',
            'warehouse_id'  => $warehouse->id
        ]);
        
        $user->assignRole('management cabang');
    }
}
