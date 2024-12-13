<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorites;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FavoritesController extends Controller
{
    public function index()
    {
        $favorites = Favorites::with(['product' => function($query) {
            $query->select('id', 'title', 'selling_price', 'cost_price', 'product_quantity', 'availability_status', 'mainImagePath');
        }])
        ->where('email', Auth::user()->email)
        ->get();

        return view('admin.favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
        ]);

        $existingFavorite = Favorites::where('product_id', $request->product_id)
            ->where('email', Auth::user()->email)
            ->first();

        if ($existingFavorite) {
            return response()->json([
                'status' => 'already_added',
                'message' => 'This product is already in your favorites list.'
            ], 200);
        }

        $favorite = new Favorites();
        $favorite->product_id = $request->product_id;
        $favorite->fav_products = 'Favorite Product';
        $favorite->name = Auth::user()->name;
        $favorite->email = Auth::user()->email;
        $favorite->save();

        $favoriteCount = Favorites::where('email', Auth::user()->email)->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to favorites successfully!',
            'count' => $favoriteCount
        ], 200);
    }

    public function destroy($id)
{
    try {
        $favorite = Favorites::findOrFail($id);
        
        // Optional: Check if the favorite belongs to the logged-in user
        if ($favorite->email !== Auth::user()->email) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $favorite->delete();

        // Get updated counts
        $favoritesCount = Favorites::where('email', Auth::user()->email)->count();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from favorites successfully',
            'counts' => [
                'favorites_count' => $favoritesCount
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error removing item from favorites'
        ], 500);
    }
}
}
    




