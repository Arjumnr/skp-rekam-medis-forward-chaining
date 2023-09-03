<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelGejala extends Model
{
    use HasFactory;
    protected $table = 'gejala';
    protected $fillable = [
        'kode_gejala',
        'des_gejala',
        'cf_gejala',
    ];
}
