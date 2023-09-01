<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TindakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tindakan')->insert([
            ['kode_tindakan' => 'T01', 'nama_tindakan' => 'oral stimulasi'],
            ['kode_tindakan' => 'T02', 'nama_tindakan' => 'blocking and standing'],
            ['kode_tindakan' => 'T03', 'nama_tindakan' => 'neuro senso'],
            ['kode_tindakan' => 'T04', 'nama_tindakan' => 'massage'],
            ['kode_tindakan' => 'T05', 'nama_tindakan' => 'patterning'],
        ]);
    }
}
