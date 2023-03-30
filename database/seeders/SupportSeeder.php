<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $support = [
            'address' => 'Palestine, Gaza City',
            'email' => 'ayuobferwana98@gmail.com',
            'phone' => '0592549688(972+)',
        ];

        Support::create($support);
    }
}
