<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'User Testing',
            'email' => 'user@decora.com',
            'password' => Hash::make('password123'),
        ]);
    }
}