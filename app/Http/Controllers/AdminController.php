<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Category;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product; // Use the correct model
use App\Models\Category;

class AdminController extends Controller
{
    public function index() {
        $user = Auth::user();
    
        // Fetch the count of products by status
        $availableCount = Product::where('availability_status', 'available')->count(); // Updated to use Product
        $soldCount = Product::where('availability_status', 'sold')->count(); // Updated to use Product
        // $rentalCount = Product::where('availability_status', 'rental')->count(); // Uncomment if needed
        
        // Fetch categories with their product counts
        $categories = Category::withCount('products')->get(); // Assuming categories are related to products, not properties
    
        return view('admin.index', [
            'user' => $user,
            'availableCount' => $availableCount,
            'soldCount' => $soldCount,
            // 'rentalCount' => $rentalCount,
            'categories' => $categories,
        ]);
    }
}
