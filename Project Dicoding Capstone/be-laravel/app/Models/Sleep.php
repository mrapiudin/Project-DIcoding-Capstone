<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sleep extends Model
{
    protected $table = 'sleep';
    
    protected $fillable = [
        'jam_tidur',
        'jam_bangun',
        'total'
    ];

    protected $casts = [
        'jam_tidur' => 'datetime:H:i',
        'jam_bangun' => 'datetime:H:i', 
        'total' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}