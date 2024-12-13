<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'link',
        'image'
    ];

    protected $table = 'advertisment_table'; 
}