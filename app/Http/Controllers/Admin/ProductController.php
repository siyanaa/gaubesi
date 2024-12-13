<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category', 'subCategory')->latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.product.create', compact('categories', 'subCategories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'required|array',
            'main_image.*' => 'required|string',
            'cropData' => 'required|string',
            'brand'  => 'nullable|string',
            'location'  => 'nullable|string',
            'flavour'  => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'weight'  => 'required|string',
            'product_quantity' => 'required|integer',
            'status' => 'required|boolean',
            'availability_status' => 'required|in:available,sold,rental',
            'other_images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle the main image upload (base64 images)
        $images = $this->handleBase64Images($request->input('main_image'), 'product');

        // Handle other images upload
        $otherImages = [];
        if ($request->hasFile('other_images')) {
            $otherImages = $this->handleUploadedImages($request->file('other_images'), 'product/other_images');
        }

        // Create new product record
        Product::create([
            'company_name' => $request->company_name,
            'title' => $request->title,
            'description' => $request->description,
            'brand' => $request->brand,
            'location' => $request->location,
            'flavour' => $request->flavour,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'product_quantity' => $request->product_quantity,
            'weight' => $request->weight,
            'status' => $request->status,
            'main_image' => json_encode($images),
            'other_images' => json_encode($otherImages),
            'availability_status' => $request->availability_status,
        ]);

        session()->flash('success', 'Product created successfully.');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.product.update', compact('product', 'categories', 'subCategories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|array',
            'main_image.*' => 'nullable|string',
            'brand'  => 'nullable|string',
            'location'  => 'nullable|string',
            'flavour'  => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'weight'  => 'nullable|string',
            'product_quantity' => 'required|integer',
            'status' => 'required|boolean',
            'availability_status' => 'required|in:available,sold,rental',
            'other_images.*' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle main image update if provided
        if ($request->has('main_image')) {
            $this->deleteImages(json_decode($product->main_image, true), 'product/');
            $images = $this->handleBase64Images($request->input('main_image'), 'product');
            $product->main_image = json_encode($images);
        }

        // Handle other images update if provided
        if ($request->hasFile('other_images')) {
            $this->deleteImages(json_decode($product->other_images, true), 'product/other_images/');
            $otherImages = $this->handleUploadedImages($request->file('other_images'), 'product/other_images');
            $product->other_images = json_encode($otherImages);
        }

        // Update the product record
        $product->update([
            'company_name' => $request->company_name,
            'title' => $request->title,
            'description' => $request->description,
            'brand' => $request->brand,
            'location' => $request->location,
            'flavour' => $request->flavour,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'cost_price' => $request->cost_price,
            'selling_price' => $request->selling_price,
            'weight' => $request->weight,
            'product_quantity' => $request->product_quantity,
            'status' => $request->status,
            'availability_status' => $request->availability_status,
        ]);

        session()->flash('success', 'Product updated successfully.');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete main images
        $this->deleteImages(json_decode($product->main_image, true), 'product/');

        // Delete other images
        $this->deleteImages(json_decode($product->other_images, true), 'product/other_images/');

        // Delete the product from the database
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    // Keep all the existing private methods for image handling exactly as they are
    private function handleBase64Images(array $base64Images, $folder, $existingImages = [])
    {
        // Initialize with existing images if provided
        $images = !empty($existingImages) ? $existingImages : [];

        foreach ($base64Images as $base64Image) {
            // Extract base64 encoded part and decode it
            $image = explode(',', $base64Image);
            if (isset($image[1])) {
                $decodedImage = base64_decode($image[1]);
            } else {
                continue; // Skip if the base64 string is not properly formatted
            }
            $imageResource = imagecreatefromstring($decodedImage);

            if ($imageResource !== false) {
                // Generate unique image name
                $imageName = time() . '-' . Str::uuid() . '.webp';
                // Correct destination path
                $destinationPath = storage_path("app/public/$folder");

                // Create the directory if it does not exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                // Save the image in WEBP format
                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);

                // Correctly formatted relative path for storage link
                $relativeImagePath = "storage/$folder/$imageName";
                $images[] = $relativeImagePath;
            }
        }

        return $images;
    }

    private function handleUploadedImages($uploadedFiles, $folder, $existingImages = [])
    {
        // Initialize with existing images if any
        $images = !empty($existingImages) ? $existingImages : [];

        if ($uploadedFiles) {
            foreach ($uploadedFiles as $file) {
                // Generate a unique name for each image
                $imageName = time() . '-' . Str::uuid() . '.webp';
                // Correct destination path for storage
                $destinationPath = storage_path("app/public/$folder");

                // Create the directory if it does not exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                // Convert the uploaded image to WEBP format
                $imageResource = imagecreatefromstring(file_get_contents($file));
                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);

                // Correctly formatted relative path for storage link
                $relativeImagePath = "storage/$folder/$imageName";
                $images[] = $relativeImagePath;
            }
        }

        return $images;
    }

    private function deleteImages($images, $folderPath)
    {
        // If $images is a string, convert it to an array
        if (is_string($images)) {
            $images = [$images];
        }

        // If $images is an array, iterate through each image
        if (is_array($images)) {
            foreach ($images as $image) {
                // Check if image is not empty
                if (!empty($image)) {
                    // Extract the basename of the image path
                    $imagePath = storage_path('app/public/' . $folderPath . basename($image));

                    // Check if the image exists and delete it
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }
    }
}