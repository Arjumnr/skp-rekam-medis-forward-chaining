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
            ['kode_gejala' => 'G01', 'des_gejala' => 'gangguan pada fungsi berbicara', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G02', 'des_gejala' => 'gangguan pada fungsi mengunyah makanan', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G03', 'des_gejala' => 'gangguan pada fungsi menelan makanan', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G04', 'des_gejala' => 'gangguan pada fungsi mengisap', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G05', 'des_gejala' => 'gangguan pada fungsi pernapasan', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G06', 'des_gejala' => 'air liur berlebihan', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G07', 'des_gejala' => 'gangguan pada mental atau perilaku', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G08', 'des_gejala' => 'lambat merespon', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G09', 'des_gejala' => 'susah fokus', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G10', 'des_gejala' => 'sensitif dan mudah tersinggung', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G11', 'des_gejala' => 'sering merasa tegang', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G12', 'des_gejala' => 'merasakan tekanan pisikologis', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G13', 'des_gejala' => 'tidak bergairah dan kehilangan energi', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G14', 'des_gejala' => 'emosi yang berlebihan dan susah dikontrol', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G15', 'des_gejala' => 'hidung pesek', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G16', 'des_gejala' => 'mata kecil atau sipit', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G17', 'des_gejala' => 'telinga kecil', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G18', 'des_gejala' => 'lidah besar', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G19', 'des_gejala' => 'perawakan pendek atauu trisomi', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G20', 'des_gejala' => 'kelemahan otot', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G21', 'des_gejala' => 'kelumpuhan otot', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G22', 'des_gejala' => 'susah tidur', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G23', 'des_gejala' => 'pencernaan tidak lancar', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G24', 'des_gejala' => 'nyeri sendi atau saraf', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G25', 'des_gejala' => 'sering sakit kepala', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G26', 'des_gejala' => 'kelelahan', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G27', 'des_gejala' => 'otot terasa kaku', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G28', 'des_gejala' => 'pembengkakan otot', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G29', 'des_gejala' => 'gangguan emosi', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G30', 'des_gejala' => 'lumpuh layuh', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G31', 'des_gejala' => 'autis', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G32', 'des_gejala' => 'epilepsi', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G33', 'des_gejala' => 'hiperaktif', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G34', 'des_gejala' => 'kelainan genetik', 'cf_gejala' => '0.6'],
            ['kode_gejala' => 'G35', 'des_gejala' => 'susah memahami bahasa', 'cf_gejala' => '0.6'],
        ]);
    }
}
