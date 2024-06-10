<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioFile extends Model
{

    protected $table = 'audio_files'; 
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_size',
        'format',
        'duration',
        'uploaded_at',
        'description'
    ];
}
