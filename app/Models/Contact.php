<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';

    protected $fillable = [
        'name',
        'email',
        'message',
        'inspection',
        'product_id'
    ];

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
}
