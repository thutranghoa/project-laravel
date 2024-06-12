<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhsachmonhoc extends Model
{
    use HasFactory;
    protected $table = 'categories'; 
    protected $fillable = ['name', 'description'];

}
