<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCF extends Model
{
    use HasFactory;
    protected $table = 'cf_user';
    protected $fillable = [
        'ungkapan',
        'nilai_cf_user',
    ];
}
