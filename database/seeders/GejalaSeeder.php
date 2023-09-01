<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gejala')->insert([
            ['kode_gejala' => 'G01', 'des_gejala' => 'gangguan pada fungsi berbicara'],
            ['kode_gejala' => 'G02', 'des_gejala' => 'gangguan pada fungsi mengunyah makanan'],
            ['kode_gejala' => 'G03', 'des_gejala' => 'gangguan pada fungsi menelan makanan'],
            ['kode_gejala' => 'G04', 'des_gejala' => 'gangguan pada fungsi mengisap'],
            ['kode_gejala' => 'G05', 'des_gejala' => 'gangguan pada fungsi pernapasan'],
            ['kode_gejala' => 'G06', 'des_gejala' => 'air liur berlebihan'],
            ['kode_gejala' => 'G07', 'des_gejala' => 'gangguan pada mental atau perilaku'],
            ['kode_gejala' => 'G08', 'des_gejala' => 'lambat merespon'],
            ['kode_gejala' => 'G09', 'des_gejala' => 'susah fokus'],
            ['kode_gejala' => 'G10', 'des_gejala' => 'sensitif dan mudah tersinggung'],
            ['kode_gejala' => 'G11', 'des_gejala' => 'sering merasa tegang'],
            ['kode_gejala' => 'G12', 'des_gejala' => 'merasakan tekanan pisikologis'],
            ['kode_gejala' => 'G13', 'des_gejala' => 'tidak bergairah dan kehilangan energi'],
            ['kode_gejala' => 'G14', 'des_gejala' => 'emosi yang berlebihan dan susah dikontrol'],
            ['kode_gejala' => 'G15', 'des_gejala' => 'hidung pesek'],
            ['kode_gejala' => 'G16', 'des_gejala' => 'mata kecil atau sipit'],
            ['kode_gejala' => 'G17', 'des_gejala' => 'telinga kecil'],
            ['kode_gejala' => 'G18', 'des_gejala' => 'lidah besar'],
            ['kode_gejala' => 'G19', 'des_gejala' => 'perawakan pendek atauu trisomi'],
            ['kode_gejala' => 'G20', 'des_gejala' => 'kelemahan otot'],
            ['kode_gejala' => 'G21', 'des_gejala' => 'kelumpuhan otot'],
            ['kode_gejala' => 'G22', 'des_gejala' => 'susah tidur'],
            ['kode_gejala' => 'G23', 'des_gejala' => 'pencernaan tidak lancar'],
            ['kode_gejala' => 'G24', 'des_gejala' => 'nyeri sendi atau saraf'],
            ['kode_gejala' => 'G25', 'des_gejala' => 'sering sakit kepala'],
            ['kode_gejala' => 'G26', 'des_gejala' => 'kelelahan'],
            ['kode_gejala' => 'G27', 'des_gejala' => 'otot terasa kaku'],
            ['kode_gejala' => 'G28', 'des_gejala' => 'pembengkakan otot'],
            ['kode_gejala' => 'G29', 'des_gejala' => 'gangguan emosi'],
            ['kode_gejala' => 'G30', 'des_gejala' => 'lumpuh layuh'],
            ['kode_gejala' => 'G31', 'des_gejala' => 'autis'],
            ['kode_gejala' => 'G32', 'des_gejala' => 'epilepsi'],
            ['kode_gejala' => 'G33', 'des_gejala' => 'hiperaktif'],
            ['kode_gejala' => 'G34', 'des_gejala' => 'kelainan genetik'],
            ['kode_gejala' => 'G35', 'des_gejala' => 'susah memahami bahasa'],
        ]);
    }
}
