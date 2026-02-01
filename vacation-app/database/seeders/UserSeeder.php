<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'rol' => 'admin'
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Viajero 1',
                'password' => Hash::make('password'),
                'rol' => 'user'
            ]
        );
    }
}
