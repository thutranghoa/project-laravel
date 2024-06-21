<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'total_questions',
        'name'
    ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class, 'id_mon');
    }

    
    
}
