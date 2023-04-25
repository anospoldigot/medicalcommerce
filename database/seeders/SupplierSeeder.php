<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'id'        => Uuid::uuid4(),
            'name'      => 'Gojo Satoru',
            'email'     => 'gojosatoru@example.com',
            'phone'     => '081398199618',
            'address'   => 'Pondok Indah'
        ]);
    }
}
