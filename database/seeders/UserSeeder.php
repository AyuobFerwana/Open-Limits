<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'UsersName' => 'Ayuob Ferwana',
            'email' => 'ayuob@gmail.com',
            'phone' => '0592549688',
            'role' => 'admin',
            'password' => Hash::make('1213'),
        ]);
        User::create([
            'UsersName' => 'Rima Al-Afrangi ',
            'email' => 'rema@app.com',
            'phone' => '0592343560',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);
    }
}
