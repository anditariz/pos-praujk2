<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // $user = User::create([
        //     'name' => 'Dita',
        //     'email' => 'dita@gmail.com',
        //     'password' => Hash::make('rahasia'),
        // ]);

        // $role = Role::where('name', 'admin')->first();
        // $user->roles()->attach($role->id);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('rahasia'),
        ]);

        $role = Role::where('name', 'admin')->first();
        $admin->roles()->attach($role->id);

        $kasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('rahasia'),
        ]);

        $role = Role::where('name', 'Kasir')->first();
        $kasir->roles()->attach($role->id);

        $pimpinan = User::create([
            'name' => 'Pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => Hash::make('rahasia'),
        ]);

        $role = Role::where('name', 'Pimpinan')->first();
        $pimpinan->roles()->attach($role->id);
    }
}

