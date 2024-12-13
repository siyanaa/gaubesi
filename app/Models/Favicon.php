<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favicon extends Model
{
    use HasFactory;

    protected $fillable = [
        'favicon_thirtytwo',
        'favicon_sixteen',
        'favicon_ico',
        'appletouch_icon',
        'site_manifest'
    ];
}