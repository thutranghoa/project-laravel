<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'exercise_name',
        'id_mon',
        'ma_de',
        'time'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_mon');
    }
}