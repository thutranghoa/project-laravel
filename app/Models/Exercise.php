<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $table = 'exercises';
    protected $fillable = ['id','exercise_name', 'id_mon', 'ma_de', 'time', 'num_question'];




    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_mon');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exercise_id');
    }
}