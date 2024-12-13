<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $fillable = ['fav_products', 'name', 'email', 'product_id'];
  
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

