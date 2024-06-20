<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'quizzes';
    protected $fillable = ['name', 'title', 'created_at', 'updated_at'];
}
