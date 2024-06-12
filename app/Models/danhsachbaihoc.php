<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachbaihoc extends Model
{

    use HasFactory;
    protected $table = 'exercises'; 
    protected $fillable = ['id', 'exercise_name', 'id_mon', 'ma_de'];
}
