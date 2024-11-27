<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table first
        User::truncate();
        // Create a test user on table users
        User::create([
            'nombres' => 'Administrador',
            // 'apellidos' => 'Admin',
            'username' => 'admin',
            // 'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
