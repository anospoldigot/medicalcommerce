<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::upsert([
            [
                'name'      => 'fitness',
                'slug'      => Str::slug('fitness', '-')
            ],
            [
                'name'      => 'olahraga',
                'slug'      => Str::slug('olahraga', '-')
            ],
            [
                'name'      => 'gaya hidup',
                'slug'      => Str::slug('gaya hidup', '-')
            ],
            [
                'name'      => 'industri kesehatan',
                'slug'      => Str::slug('industri kesehatan', '-')
            ],
            [
                'name'      => 'ala sehat wajib',
                'slug'      => Str::slug('ala sehat wajib', '-')
            ],
        ], ['name', 'slug']);
    }
}
