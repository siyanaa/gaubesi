<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisements::latest()->get();
        return view('admin.advertisement.index', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisement.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'description' => 'required',
        'link' => 'required|url',
        'image' => 'required|array',
        'image.0' => 'required|string',  // Base64 image data
    ]);

    try {
        // Decode base64 image
        $imageData = $request->input('image.0');
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        
        // Generate unique filename
        $filename = 'advertisement-' . time() . '.jpg';
        
        // Store the image in the storage/app/public/advertisements directory
        Storage::disk('public')->put('advertisements/' . $filename, $image);

        // Create advertisement record
        Advertisements::create([
            'description' => $request->description,
            'link' => $request->link,
            'image' => 'advertisements/' . $filename,  // Store the relative path
        ]);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement created successfully.');
    } catch (\Exception $e) {
        return back()->with('error', 'Error creating advertisement: ' . $e->getMessage());
    }
}

    public function edit(Advertisements $advertisement)
    {
        return view('admin.advertisement.update', compact('advertisement'));
    }

    public function update(Request $request, Advertisements $advertisement)
    {
        $request->validate([
            'description' => 'required|string|max:1000',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        try {
            $data = [
                'description' => $request->description,
                'link' => $request->link,
            ];

            if ($request->hasFile('image')) {
                // Delete old image
                if ($advertisement->image) {
                    Storage::disk('public')->delete($advertisement->image);
                }

                // Store new image
                $image = $request->file('image');
                $filename = 'advertisement-' . time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('advertisements', $filename, 'public');
                $data['image'] = $path;
            }

            $advertisement->update($data);

            return redirect()->route('admin.advertisements.index')
                           ->with('success', 'Advertisement updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error updating advertisement: ' . $e->getMessage())
                        ->withInput();
        }
    }

    public function destroy(Advertisements $advertisement)
    {
        try {
            if ($advertisement->image) {
                Storage::disk('public')->delete($advertisement->image);
            }

            $advertisement->delete();

            return redirect()->route('admin.advertisements.index')
                           ->with('success', 'Advertisement deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting advertisement: ' . $e->getMessage());
        }
    }
}