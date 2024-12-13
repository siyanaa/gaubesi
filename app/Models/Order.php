<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'order';

    protected $fillable = [
        'user_id',
        'product_id',
        'status',
        'location',
        'contact',
        'date',
        'bill_no'
    ];

    public function cart()
{
    return $this->hasMany(Cart::class, 'product_id', 'product_id');
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
