<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
{
    // Fetch all products with their offers (if any)
    $products = Product::with('offer')->get();

    // Return the view with the products data
    return view('product.index', compact('products'));
}


    public function create($propertyId)
    {
        $product = Product::findOrFail($propertyId);
        return view('offers.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id', 
            'featured_product' => 'boolean',
            'offered_product' => 'boolean',
            'daydeal' => 'boolean',
        ]);
    
        $product = Product::findOrFail($request->product_id);
    
        $offer = Offer::updateOrCreate(
            ['product_id' => $product->id],
            [
                'featured_product' => $request->has('featured_product') ? 'Yes' : 'No',
                'offered_product' => $request->has('offered_product') ? 'Yes' : 'No',
                'daydeal' => $request->has('daydeal') ? 'Yes' : 'No',
            ]
        );
    
        return redirect()->route('product.index')->with('success', 'Offer updated successfully.');
    }
    
}

