<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhiemModels extends Model
{
    use HasFactory;
    protected $table = 'students'; 
    public $timestamps = false; // Nếu bảng không có trường created_at và updated_at

    protected $fillable = ['id', 'ten', 'img', 'gmail'];
}




