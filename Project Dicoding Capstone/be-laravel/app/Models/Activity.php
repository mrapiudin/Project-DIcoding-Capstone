<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    
    protected $fillable = [
        'nama_aktivitas',
        'kategori', 
        'durasi'
    ];

    protected $casts = [
        'durasi' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}