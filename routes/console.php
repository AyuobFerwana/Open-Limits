<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('ayuob', function() {
    Artisan::call('key:generate');
    Artisan::call('storage:link');
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
});

Artisan::command('user', function() {
    User::create([
        'UsersName' => 'Super Admin',
        'phone' => '123123123',
        'email' => 'admin@app.com',
        'password' => bcrypt('123'),
    ]);
});
