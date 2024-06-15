<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamHistory extends Model
{
    use HasFactory;
    protected $table = 'exam_histories'; 
    protected $fillable = ['user_id', 'exam_id', 'score', 'exam_duration','content', 'created_at'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exam_id', 'id');
    }
}
