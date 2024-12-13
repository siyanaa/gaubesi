<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table name, since it differs from the default pluralized form
    protected $table = 'product';

    // Fillable fields that can be mass-assigned
    protected $fillable = [
        'company_name',
        'title',
        'description',
        'category_id',
        'sub_category_id',
        'cost_price',
        'selling_price',
        'weight',
        'product_quantity',
        'brand',
        'flavour',
        'location',
        'status',
        'main_image',
        'availability_status',
        'other_images',
    ];

    // Casts the `other_images` column as an array
    protected $casts = [
        'other_images' => 'array',
        'status' => 'boolean',
    ];

    // Relationships

    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    // A product can have one offer
    public function offer()
    {
        return $this->hasOne(Offer::class, 'product_id');
    }

    public function reviews()
{
    return $this->hasMany(ReviewAndRating::class);
}

public function acceptedReviews()
{
    return $this->hasMany(ReviewAndRating::class)->where('status', 'accepted');
}

}
