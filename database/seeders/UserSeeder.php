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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'Azhar',
            'email' => 'azhar@example.com',
            'username' => 'azhar',
            'role' => 'user',
            'password' => bcrypt('12345678')
        ]);
    }
}
