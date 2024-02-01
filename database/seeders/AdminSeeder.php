<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => '2',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Adobe@123'),
        ]);
    }
}
