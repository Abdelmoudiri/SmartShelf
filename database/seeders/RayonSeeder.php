<?php

namespace Database\Seeders;

use App\Models\Rayon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rayon::factory(10)->create();
    }
}
