<?php
namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Product;
use App\Models\Favorites;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Cart;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\FAQ;
use App\Models\Advertisements;
use App\Models\AboutDescription;
use App\Models\ReviewAndRating;
use App\Models\SiteSetting;
use App\Models\TermsandConditions;
// use App\Models\ReviewAndRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
   public function render_about()
    {
       
        $products = Product::latest()->get();
        $categories = Category::latest()->get();
        $teams=Team::latest()->get();
        $faqs=FAQ::Latest()->get();
        return view('frontend.about', compact('aboutDescriptions','teams','testimonials' ,'faqs','categories','products'));
    }
    public function render_blog()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(10);
        $products = Product::where('status', 1)->latest()->get();
        $categories = Category::all();
        
        return view('frontend.blog', compact('blogs', 'products', 'categories'));
    }
    public function singlePost($id)
    {
        $blogs = Blog::where('id', $id)->firstOrFail();
        $products = Product::latest()->get();
        $relatedPosts = blog::where('id', '!=', $blogs->id)->get();
        $categories=Category::latest()->get();
        return view('frontend.singleblogpost', compact('blogs','relatedPosts','products','categories'));
    }


    public function render_products()
{
    $categories = Category::with('subcategories.products')->get(); 
    $subcategories = SubCategory::all();
    $products = Product::where('status', 1)->latest()->get();
    $blogs = Blog::all();
   
    return view('frontend.products', compact('categories', 'subcategories', 'products','blogs'));
}


    public function render_singleProducts($id)
    {
        // Fetch the property by ID and ensure it's active
        $categories = Category::with(['subcategories.products' => function ($query) {
            $query->where('status', 1)
                ->with(['reviews' => function ($reviewQuery) {
                    $reviewQuery->select(DB::raw('product_id, AVG(ratings) as average_rating'))
                        ->groupBy('product_id');
                }]);
        }])->get()->map(function ($category) {
            // Decode category image
            $category->decodedImage = json_decode($category->image, true)[0] ?? null;
    
            $category->subcategories->each(function ($subcategory) {
                $subcategory->products->each(function ($product) {
                    $product->mainImagePath = json_decode($product->main_image, true)[0] ?? null;
                    // Calculate average rating
                    $product->averageRating = $product->reviews->first()->average_rating ?? 0;
                });
            });
            return $category;
        });
        $subcategories = SubCategory::all(); 
        $products = Product::where('id', $id)->where('status', 1)->firstOrFail();
        $relatedProducts = Product::where('id', '!=', $products->id)->where('status', 1)->get();
        $acceptedReviews = ReviewAndRating::where('status', 'accepted')
        ->where('product_id', $id)
        ->get();
        $blogs = Blog::all();
        $advertisement = Advertisements::latest()->first();
        
        // Handle the 'other_images' field if it exists
        $otherImages = !empty($products->other_images) ? json_decode($products->other_images, true) : [];
        
        return view('frontend.singleproducts', compact('categories', 'products', 'relatedProducts', 'otherImages','acceptedReviews','blogs','advertisement'));

    }
    

    public function render_contact()
    {  $products = Product::latest()->get();
        $siteSettings=SiteSetting::latest()->get();
        $products = Product::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.contact', compact("categories",'siteSettings','products'));
    }

    public function render_search()
    {
        $products = Product::latest()->get();
        $categories=Category::latest()->get();
        return view('frontend.searching', compact('products','categories'));
    }

    public function products(Request $request, $categoryId = null)
{
    
    $categories = Category::all();
    $subcategories = SubCategory::all(); 
    $categoryId = $request->query('categoryId');
    $productsQuery = Product::where('status', 1); 
    if ($categoryId) {
        $productsQuery->where('category_id', $categoryId); 
    }

        $products = $productsQuery->paginate(6);

        $subcategories = SubCategory::all();
    
        return view('frontend.products', compact('products', 'categories', 'subcategories'));
    }

    public function render_favourite()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your favorites.');
        }
    
        $userEmail = Auth::user()->email;
        $categories = Category::latest()->get();
    
        $favorites = Favorites::where('email', $userEmail)
            ->join('product', 'favorites.product_id', '=', 'product.id')
            ->select(
                'favorites.id as favorite_id',
                'product.id',
                'product.title',
                'product.selling_price',
                'product.cost_price',
                'product.product_quantity',
                'product.main_image',
                'product.availability_status',
                'favorites.created_at'  
            )
            ->with(['product.reviews' => function($query) {
                $query->where('status', 'accepted')
                      ->select('product_id', 'ratings');
            }])
            ->latest('favorites.created_at')  
            ->get()
            ->map(function ($favorite) {
                $favorite->mainImagePath = json_decode($favorite->main_image, true)[0] ?? null;
                return $favorite;
            });
    
        return view('frontend.favourite', compact('favorites', 'categories'));
    }

    public function render_cart()
{
    $cart = [];
    
    if (Auth::check()) {
        // For authenticated users, get cart from database
        $userCart = Cart::where('user_id', Auth::id())
                      ->with('product')
                      ->get();

        $advertisement = Advertisements::latest()->first();
        
        foreach ($userCart as $item) {
            $cart[] = [
                'id' => $item->product_id,
                'title' => $item->product->title,
                'price' => $item->selling_price,
                'image' => json_decode($item->product->main_image, true)[0] ?? null,
                'quantity' => $item->product_quantity
            ];
        }
        
        // Update session with database cart
        session()->put('cart', $cart);
    } else {
        // For guests, use session cart
        $cart = session()->get('cart', []);
    }
    
//      // Eager load the relationships and ensure proper data structure
    $categories = Category::with(['subcategories' => function($query) {
        $query->with(['products' => function($query) {
            $query->where('status', 1);
        }]);
    }])->get();

    // Transform the data to ensure main_image is properly decoded
    $categories = $categories->map(function ($category) {
        $category->subcategories->each(function ($subcategory) {
            $subcategory->products->each(function ($product) {
                $mainImage = json_decode($product->main_image, true);
                $product->mainImagePath = $mainImage[0] ?? null;
            });
        });
        return $category;
    });

    // Get all products for the deals section, including availability_status
    $products = Product::where('status', 1)
        ->select('id', 'title', 'selling_price', 'cost_price', 'main_image', 'availability_status') // Add availability_status here
        ->latest()
        ->get();

    // Return view with all required variables
    return view("frontend.cart", compact('products', 'categories', 'cart','advertisement'));
}


    
// public function render_cart()
// {
//     // Get cart data from session
//     $cart = session()->get('cart', []);

//     // Eager load the relationships and ensure proper data structure
//     $categories = Category::with(['subcategories' => function($query) {
//         $query->with(['products' => function($query) {
//             $query->where('status', 1);
//         }]);
//     }])->get();

//     // Transform the data to ensure main_image is properly decoded
//     $categories = $categories->map(function ($category) {
//         $category->subcategories->each(function ($subcategory) {
//             $subcategory->products->each(function ($product) {
//                 $mainImage = json_decode($product->main_image, true);
//                 $product->mainImagePath = $mainImage[0] ?? null;
//             });
//         });
//         return $category;
//     });

//     // Get all products for the deals section, including availability_status
//     $products = Product::where('status', 1)
//         ->select('id', 'title', 'selling_price', 'cost_price', 'main_image', 'availability_status') // Add availability_status here
//         ->latest()
//         ->get();

//     // Return view with all required variables
//     return view("frontend.cart", compact('products', 'categories', 'cart'));
// }

    public function render_account() {
        $categories = Category::latest()->get();
        return view("frontend.account" , compact('categories'));
    }
    
    public function render_chat(){
        return view("frontend.chat");
    }

    public function showProductReviews($productId)
{
    $product = Product::with('acceptedReviews')->findOrFail($productId);

    return view('frontend.singleproducts', compact('product'));
}

public function getHeaderCounts()
{
    if (Auth::check()) {
        $user = Auth::user();
        
        // Get favorites count from favorites table
        $favoritesCount = Favorites::where('email', $user->email)->count();
        
        // Get cart count from cart table
        $cartCount = DB::table('cart')->where('user_id', $user->id)->count();

        return response()->json([
            'favorites_count' => $favoritesCount,
            'cart_count' => $cartCount
        ]);
    }

    // For non-authenticated users, return 0 for both counts
    return response()->json([
        'favorites_count' => 0,
        'cart_count' => 0
    ]);
}

public function render_termsandcondition()
{
    $categories = Category::latest()->get();
    $ourPolicy = TermsAndConditions::where('policy_type', 'Our Policy')->first();
    $returnPolicy = TermsAndConditions::where('policy_type', 'Return Policy')->first();
    $returnCondition = TermsAndConditions::where('policy_type', 'Return Condition')->first();
    $termsAndCondition = TermsAndConditions::where('policy_type', 'Terms and Conditions')->first();

    $categories = Category::latest()->get();
    $ourPolicy = $ourPolicy ? json_decode($ourPolicy->description) : [];
    $returnPolicy = $returnPolicy ? json_decode($returnPolicy->description) : [];
    $returnCondition = $returnCondition ? json_decode($returnCondition->description) : [];
    $termsAndCondition = $termsAndCondition ? json_decode($termsAndCondition->description) : [];

    return view('frontend.terms', compact(
        'categories',
        'ourPolicy',
        'returnPolicy',
        'returnCondition',
        'termsAndCondition'
    ));
}


public function render_singlecatogories($id)  
{
    // Fetch the specific category and its subcategories with active products
    $category = Category::with(['subcategories' => function($query) {
        $query->with(['products' => function($query) {
            $query->where('status', 1);
        }]);
    }])->findOrFail($id);

    // Process images for products within the category
    $category->subcategories->each(function ($subcategory) {
        $subcategory->products->each(function ($product) {
            $mainImage = json_decode($product->main_image, true);
            $product->mainImagePath = $mainImage[0] ?? null;
        });
    });

    // Fetch all categories for the navigation
    $categories = Category::all();

    return view('frontend.singlecatogories', compact('category', 'categories'));
}

}


