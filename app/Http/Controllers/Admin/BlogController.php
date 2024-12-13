<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // Show all blogs
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(3);
        return view('admin.blogs.index', compact('blogs'));
    }

    // Show form to create a new blog
    public function create()
    {
        return view('admin.blogs.create');
    }

    // Store new blog in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:255',
            'keywords' => 'nullable|string',
            'image' => 'required|array',
            'image.*' => 'required|string',
            'status' => 'required|boolean',
            'cropData' => 'nullable|string',
        ]);

        $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;
        $images = [];

        foreach ($request->input('image') as $base64Image) {
            $image = explode(',', $base64Image);
            $decodedImage = base64_decode($image[1]);
            $imageResource = imagecreatefromstring($decodedImage);

            if ($imageResource !== false) {
                $imageName = time() . '-' . Str::uuid() . '.webp';
                $destinationPath = storage_path('app/public/blog_images');

                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);

                $relativeImagePath = 'storage/blog_images/' . $imageName;
                $images[] = $relativeImagePath;
            }
        }

        // Create new blog record
        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'image' => json_encode($images),
            'status' => $request->status,
        ]);

        session()->flash('success', 'Blog created successfully.');
        return redirect()->route('admin.blogs.index');
    }

    // Show form to edit the blog
    public function edit(Blog $blog)
    {
        return view('admin.blogs.update', compact('blog'));
    }

    // Update blog in the database
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'nullable|string|max:255',
            'keywords' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp',
            'status' => 'required|boolean',
            'cropData' => 'nullable|string',
        ]);

        $images = !empty($blog->image) ? json_decode($blog->image, true) : [];

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            if (!empty($images)) {
                foreach ($images as $image) {
                    $oldImagePath = storage_path('app/public/blog_images') . '/' . basename($image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                $images = [];
            }

            $file = $request->file('image');
            $imageName = time() . '-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('app/public/blog_images');

            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $imageName);
            $relativeImagePath = 'storage/blog_images/' . $imageName;
            $images[] = $relativeImagePath;
        }

        // Update the blog record
        $blog->update([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'keywords' => $request->keywords,
            'image' => json_encode($images),
            'status' => $request->status,
        ]);

        session()->flash('success', 'Blog updated successfully.');
        return redirect()->route('admin.blogs.index');
    }

    // Delete a blog from the database
    public function destroy(Blog $blog)
    {
        $images = json_decode($blog->image, true);
        if ($images) {
            foreach ($images as $image) {
                $filePath = storage_path('app/public/blog_images') . '/' . basename($image);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // Upload image via AJAX
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/uploads');
            $url = asset('storage/uploads/' . basename($path));

            return response()->json(['url' => $url]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
