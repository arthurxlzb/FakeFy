<?php

namespace Database\Seeders;

use App\Models\Singer;
use Illuminate\Database\Seeder;

class SingerSeeder extends Seeder
{
    public function run()
    {
        Singer::factory()->count(20)->create();
    }
}