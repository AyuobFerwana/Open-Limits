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
            'UsersName' => 'SuperAdmin',
            'email' => 'ayuob@gmail.com',
            'phone' => '0592549688',
            'role' => 'admin',
            'password' => Hash::make('1213'),
        ]);
        User::create([
            'UsersName' => 'SuperAdmin',
            'email' => 'admin@app.com',
            'phone' => '05925496883',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);
    }
}
