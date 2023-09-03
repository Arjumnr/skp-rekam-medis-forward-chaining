<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelDatas extends Model
{
    use HasFactory;
    protected $table = 'datas';
    protected $fillable = [
        'pasien_id',
        'data_terapis',
    ];

    public function get_pasien(){
        return $this->hasOne(ModelPasien::class, 'id', 'pasien_id');
    }
}
