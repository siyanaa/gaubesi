<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    
        protected $table = 'cart';
        
        protected $fillable = [
            'user_id',
            'product_id',
            'selling_price',
            'product_quantity'
        ];
    
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function product()
        {
            return $this->belongsTo(Product::class);
        }

        public function orders()
    {
        return $this->belongsTo(Order::class, 'product_id', 'product_id');
    }
     
}
