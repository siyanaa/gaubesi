<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'author',
        'image',
        'status',
       
    ];
    protected $casts = [
        'image' => 'array', // Handle multi-image upload as an array
    ];

    // Relationships
    
}
