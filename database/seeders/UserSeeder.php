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
        // Admin User
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@example.com',
            'password'  => bcrypt('password'),
            'phone'     => '081398199618',
            'role'      => 'admin',
        ]);
    }
}
