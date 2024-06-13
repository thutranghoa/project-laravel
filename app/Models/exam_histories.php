<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam_histories extends Model
{
    use HasFactory;
    protected $table = 'exam_histories'; 
    protected $fillable = ['user_id', 'exam_id', 'score'];
}
