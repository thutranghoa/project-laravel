<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions'; 
  


    protected $fillable = [
        'quiz_id',
        'content',
        'exercise_id',
        'difficulty_level',
        'audio_file', 
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
