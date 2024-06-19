<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_name',
        'ma_de',
        'time',
        'num_questions',
        'id_mon',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_mon');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exercise_id');
    }
}
