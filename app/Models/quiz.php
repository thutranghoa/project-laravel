<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    protected $table = 'categories'; 
    use HasFactory;

    protected $fillable = ['name', 'description' ];

    public function question()
    {
        return $this->hasMany(Question::class);
    }
}
