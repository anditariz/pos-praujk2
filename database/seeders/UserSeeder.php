<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Raka',
            'email' => 'raka@gmail.com',
            'password' => Hash::make('raka123'),
        ]);
    }
}

