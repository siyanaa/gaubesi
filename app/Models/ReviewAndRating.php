<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class ReviewAndRating extends Model
{
    use HasFactory;


    protected $table = 'reviewsandratings';
    protected $fillable = ['name', 'email', 'reviews','ratings','product_id','status'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}



