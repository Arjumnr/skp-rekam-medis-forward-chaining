<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => '1',
            'created_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Terapi',
            'username' => 'terapi',
            'email' => 'terapi@gmail.com',
            'password' => bcrypt('123'),
            'role' => '2',
            'created_at' => now(),
        ]);

        
    }
}
