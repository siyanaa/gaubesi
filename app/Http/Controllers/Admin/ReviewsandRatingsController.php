<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ReviewAndRating;

class ReviewsandRatingsController extends Controller
{
    public function index()
    {
        $reviews = ReviewAndRating::with('product')->get();
        return view('admin.reviews.index', compact('reviews'));
    }
    
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:product,id',
            'reviews' => 'required|string',
            'ratings' => 'required|integer|min:1|max:5',
        ]);
    
        // Check if the data is passing through correctly
        logger()->info('Form Data:', $validatedData);
    
        // Create the review entry
        ReviewAndRating::create([
            'product_id' => $request->input('product_id'),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'reviews' => $request->input('reviews'),
            'ratings' => $request->input('ratings'),
            'status' => 'pending', 
        ]);
    
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
    

    
public function update(Request $request, ReviewAndRating $review)
{
    $review->update(['status' => $request->status]);
    return redirect()->back()->with('success', 'Review status updated successfully.');
}
     
}
