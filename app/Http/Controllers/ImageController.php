<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Storage;
use League\Glide\Manipulations;

class ImageController extends Controller
{
    /**
     * Show the form to upload and manipulate images.
     */
    public function create()
    {
        return view('admin.image.upload'); // Create a Blade view for uploading images
    }

    /**
     * Handle the image upload, crop, and compression.
     */
    public function store(Request $request)
    {
        // Validate the uploaded images
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB per image for validation before processing
            'cropData' => 'required|string', // Crop data from the frontend crop tool as JSON string
        ]);

        $cropData = json_decode($request->input('cropData'), true); // Parse crop data from the request
        $images = $request->file('images'); // Retrieve images from the request

        // Loop through each uploaded image
        foreach ($images as $image) {
            // Generate a unique name for each image
            $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $outputPath = storage_path('app/public/uploads'); // Define where images will be stored

            // Create Glide server for image manipulation
            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory($request),
                'source' => Storage::disk('local')->getDriver(),
                'cache' => Storage::disk('local')->getDriver(),
                'cache_path_prefix' => '.cache',
                'base_url' => 'images',
            ]);

            // Create manipulated image path with required transformations
            $server->outputImage($image->getPathname(), [
                'w' => $cropData['width'],   // Width from crop data
                'h' => $cropData['height'],  // Height from crop data
                'fit' => Manipulations::FIT_CROP,
                'q' => 75,                   // Quality for compression, adjust as needed to achieve desired file size
            ]);

            // Save the cropped and compressed image to the storage
            $server->makeImage($image->getPathname(), $outputPath . '/' . $imageName, [
                'q' => 75, 
            ]);

            // Optional: Save the image name/path to the database if needed
            // Example: Image::create(['path' => 'uploads/' . $imageName]);
        }

        return back()->with('success', 'Images uploaded, cropped, and compressed successfully!');
    }
}