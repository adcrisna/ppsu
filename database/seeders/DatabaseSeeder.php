<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UsersTableSeeder::class);
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
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
