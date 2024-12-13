<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['featured_product', 'offered_product','daydeal', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    } 
}
