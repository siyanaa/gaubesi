<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Whyus;
use App\Models\AboutUs;
use App\Models\Subcategory;
use App\Models\Offer;
use App\Models\Favorites;
use App\Models\Advertisements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FrontViewController extends Controller
{
    public function index()
    {
        // Fetching the services, blogs, testimonials, and other data
        
        $blogs = Blog::where('status', 1)->latest()->get();
        // Fetch categories with subcategories and products, including product ratings
        $categories = Category::with(['subcategories.products' => function ($query) {
            $query->where('status', 1)
                ->with(['reviews' => function ($reviewQuery) {
                    $reviewQuery->select(DB::raw('product_id, AVG(ratings) as average_rating'))
                        ->groupBy('product_id');
                }]);
        }])->get()->map(function ($category) {
            // Decode category image safely
            $category->decodedImage = json_decode($category->image, true)[0] ?? null;

            // Ensure subcategories and products exist before processing
            $category->subcategories->each(function ($subcategory) {
                $subcategory->products->each(function ($product) {
                    // Check if the main_image exists
                    $product->mainImagePath = isset($product->main_image) 
                        ? json_decode($product->main_image, true)[0] ?? null
                        : null;
                    
                    // Calculate average rating, ensuring there's at least one review
                    $product->averageRating = $product->reviews->first()->average_rating ?? 0;
                });
            });

            return $category;
        });

        // Fetch featured and hot sale products, ensuring main_image exists
        $featuredProducts = Offer::where('featured_product', 'Yes')->with('product')->get();
        $hotSaleProducts = Offer::where('offered_product', 'Yes')->with('product')->get();

        // Decode the main_image for featured and hot sale products
        $featuredProducts->each(function ($offer) {
            if (isset($offer->product)) {
                $offer->product->mainImagePath = isset($offer->product->main_image) 
                    ? json_decode($offer->product->main_image, true)[0] ?? null
                    : null;
            }
        });

        $hotSaleProducts->each(function ($offer) {
            if (isset($offer->product)) {
                $offer->product->mainImagePath = isset($offer->product->main_image) 
                    ? json_decode($offer->product->main_image, true)[0] ?? null
                    : null;
            }
        });

        $dayDeals = Offer::where('daydeal', 'yes')
        ->with('product')
        ->get()
        ->map(function ($offer) {
            if (isset($offer->product) && isset($offer->product->main_image)) {
                // Decode the main_image and take the first element if it's an array
                $offer->product->decodedMainImage = json_decode($offer->product->main_image, true)[0] ?? null;
            }
            return $offer;
        });

        $advertisement = Advertisements::latest()->first();
    
        // Return the view with all necessary data
        return view('frontend.welcome', compact([
             'blogs', 'categories', 'featuredProducts', 'hotSaleProducts','dayDeals','advertisement'
        ]));
    }

    public function userFavorites()
    {
        // Fetch only the authenticated user's favorites with related property details
        $favorites = Favorites::with('product')
                              ->where('email', Auth::user()->email)
                              ->get();

        return view('frontend.favorites.index', compact('favorites'));
    }

    public function showCategoryProducts($id)
    {
        // Fetch category with its products
        $category = Category::with('products')->findOrFail($id);
        
        return view('category.products', compact('category'));
    }

    public function showDayDeals()
{
    // Fetch products marked as "yes" in daydeal
    $dayDeals = Offer::where('daydeal', 'yes')
        ->with('product')
        ->get();

    return view('frontend.welcome', compact('dayDeals'));
}
}
