<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['name' => 'Admin',
             'phone_number' => '123456789',
             'address' => 'Adresa',
             'email' => 'admin@example.com',
             'username' => 'admin',
             'password' => Hash::make('password'),
             'role_id' => 1],

            ['name' => 'Client', 
             'phone_number' => '123456789',
             'address' => 'Adresa',
             'email' => 'client@example.com',
             'username' => 'client',
             'password' => Hash::make('password'),
             'role_id' => 2],

            ['name' => 'Provider',
             'phone_number' => '123456789',
             'address' => 'Adresa',
             'email' => 'provider@example.com',
             'username' => 'provider',
             'password' => Hash::make('password'),
             'role_id' => 3],

        ]);
    }
}
