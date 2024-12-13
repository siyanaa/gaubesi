<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function render_cart()
    {
        // Get user-specific cart from session
        $cart = [];
        
        if (Auth::check()) {
            // For authenticated users, get cart from database
            $userCart = Cart::where('user_id', Auth::id())
                          ->with('product')
                          ->get();
            
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
        
        // Fetch categories with active subcategories and products
        $categories = Category::with(['subcategories.products' => function ($query) {
            $query->where('status', 1);
        }])->get()->map(function ($category) {
            $category->subcategories->each(function ($subcategory) {
                $subcategory->products->each(function ($product) {
                    $product->mainImagePath = json_decode($product->main_image, true)[0] ?? null;
                });
            });
            return $category;
        });
        
        return view("frontend.cart", compact('categories', 'cart'));
    }

    public function addToCart(Request $request)
    {
        try {
            // Check if user is logged in
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart'
                ], 401);
            }

            $userId = Auth::id();
            
            // Check if product already exists in user's cart
            $existingCartItem = Cart::where('user_id', $userId)
                                  ->where('product_id', $request->product_id)
                                  ->first();

            if ($existingCartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product already exists in cart'
                ]);
            }

            // Create new cart item
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'selling_price' => $request->price,
                'product_quantity' => 1
            ]);

            // Get updated cart data
            $cartItems = Cart::where('user_id', $userId)->get();
            $cartCount = $cartItems->count();
            $cartTotal = $cartItems->sum(function($item) {
                return $item->selling_price * $item->product_quantity;
            });

            // Update session cart
            $sessionCart = $this->getUserCart($userId);
            session()->put('cart', $sessionCart);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'cartIndex' => count($sessionCart) - 1
            ]);

        } catch (\Exception $e) {
            Log::error('Cart add error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error adding product to cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateQuantity(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to update cart'
                ], 401);
            }

            $userId = Auth::id();
            $index = $request->input('index');
            $newQuantity = max(1, intval($request->input('quantity')));
            
            // Get current cart
            $cart = $this->getUserCart($userId);
            
            if (isset($cart[$index])) {
                // Update database
                Cart::where('user_id', $userId)
                    ->where('product_id', $cart[$index]['id'])
                    ->update(['product_quantity' => $newQuantity]);
                
                // Update session cart
                $cart[$index]['quantity'] = $newQuantity;
                session()->put('cart', $cart);
                
                // Calculate totals
                $cartTotal = $this->calculateCartTotal($cart);
                $cartCount = Cart::where('user_id', $userId)->sum('product_quantity');
                
                return response()->json([
                    'success' => true,
                    'updatedItem' => [
                        'quantity' => $newQuantity,
                        'price' => $cart[$index]['price']
                    ],
                    'cartCount' => $cartCount,
                    'cartTotal' => $cartTotal
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Cart update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clearCartItems(Request $request)
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to clear cart items'
                ], 401);
            }

            $userId = Auth::id();
            $selectedItems = $request->input('items', []);
            
            // Remove items from database
            Cart::where('user_id', $userId)
                ->whereIn('product_id', $selectedItems)
                ->delete();
            
            // Update session cart
            $updatedCart = $this->getUserCart($userId);
            session()->put('cart', $updatedCart);
            
            // Calculate new totals
            $newCartCount = count($updatedCart);
            $newTotalPrice = $this->calculateCartTotal($updatedCart);
            
            return response()->json([
                'success' => true,
                'message' => 'Selected items removed successfully',
                'newCartCount' => $newCartCount,
                'newTotalPrice' => $newTotalPrice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error removing selected items: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clearCart()
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to clear cart'
                ], 401);
            }

            // Clear database cart for current user
            Cart::where('user_id', Auth::id())->delete();
            
            // Clear session cart
            session()->put('cart', []);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Cart clearing error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error clearing cart: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getUserCart($userId)
    {
        $cartItems = Cart::where('user_id', $userId)
                        ->with('product')
                        ->get();
        
        $cart = [];
        foreach ($cartItems as $item) {
            $cart[] = [
                'id' => $item->product_id,
                'title' => $item->product->title,
                'price' => $item->selling_price,
                'image' => json_decode($item->product->main_image, true)[0] ?? null,
                'quantity' => $item->product_quantity
            ];
        }
        
        return $cart;
    }

    private function calculateCartTotal($cart)
    {
        return array_reduce($cart, function($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }
}