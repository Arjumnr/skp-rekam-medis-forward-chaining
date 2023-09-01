<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CfUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cf_user')->insert([
            ['ungkapan' => 'tidak tahu', 'nilai_cf_user' => 0],
            ['ungkapan' => 'mungkin ya', 'nilai_cf_user' => 0.4],
            ['ungkapan' => 'kemungkinan besar ya', 'nilai_cf_user' => 0.6],
            ['ungkapan' => 'hampir pasti ya', 'nilai_cf_user' => 0.8],
            ['ungkapan' => 'pasti ya', 'nilai_cf_user' => 1.0],
        ]);
    }
}
