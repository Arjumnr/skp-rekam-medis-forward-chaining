<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelPasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'nama_lengkap',
        'jk',
        'alamat',
        'ttl',
        'no_hp',
    ];
}
