<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\User::create([
        'name'	=> 'Admin',
        'email'	=> 'admin@app.com',
        'password'	=> bcrypt('password'),
        'username' => 'admin',
        'telepon' => '084194141321',
        'nip' => '14045',
        'nik' => '14046',
        'role' => 1
]);
    }
}
