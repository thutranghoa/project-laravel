<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    protected $table = 'quizzes'; 
    use HasFactory;

    protected $fillable = ['name', 'title', 'description' ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
