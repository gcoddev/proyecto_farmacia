<?php

namespace Database\Seeders;

use App\Models\Informacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Informacion::truncate();
        Informacion::create([
            'nombre' => 'El buen doctor'
        ]);
    }
}
