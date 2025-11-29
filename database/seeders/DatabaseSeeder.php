<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Admin
        User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@cinereview.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}