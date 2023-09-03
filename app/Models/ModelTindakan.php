<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTindakan extends Model
{
    use HasFactory;
    protected $table = 'tindakan';
    protected $fillable = [
        'kode_tindakan',
        'nama_tindakan',
    ];
}
