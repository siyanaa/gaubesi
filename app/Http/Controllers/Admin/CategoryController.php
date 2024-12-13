<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|array',
            'image.*' => 'required|string',
        ]);

        $images = [];

        foreach ($request->input('image') as $base64Image) {
            $image = explode(',', $base64Image);
            $decodedImage = base64_decode($image[1]);
            $imageResource = imagecreatefromstring($decodedImage);

            if ($imageResource !== false) {
                $imageName = time() . '-' . Str::uuid() . '.webp';
                $destinationPath = storage_path('app/public/category_images');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);

                $relativeImagePath = 'storage/category_images/' . $imageName;
                $images[] = $relativeImagePath;
            }
        }

        // Create the category with image paths
        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => json_encode($images),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $images = !empty($category->image) ? json_decode($category->image, true) : [];

        if ($request->hasFile('image')) {
            // Delete old images if they exist
            if (!empty($images)) {
                foreach ($images as $image) {
                    $oldImagePath = storage_path('app/public/category_images') . '/' . basename($image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                $images = [];
            }

            // Handle new image upload
            $file = $request->file('image');
            $imageName = time() . '-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/category_images');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $imageName);
            $relativeImagePath = 'storage/category_images/' . $imageName;
            $images[] = $relativeImagePath;
        }

        // Update the category with the new image paths
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => json_encode($images),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete images associated with this category
        $images = json_decode($category->image, true);
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/public/category_images') . '/' . basename($image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
