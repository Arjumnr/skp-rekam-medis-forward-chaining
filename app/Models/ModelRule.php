<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRule extends Model
{
    use HasFactory;
    protected $table = 'rule';
    protected $fillable = [
        'tindakan_kode',
        'gejala_kode',
    ];
}
