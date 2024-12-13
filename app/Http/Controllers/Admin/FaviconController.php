<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favicon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaviconController extends Controller
{
    public function index()
    {
        $icons = Favicon::all();
        return view('admin.favicon.index', [
            'icons' => $icons,
            'page_title' => 'Favicons'
        ]);
    }

    public function create()
    {
        return view('admin.favicon.create', ['page_title' => 'Create Favicon']);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'favicon_thirtytwo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'favicon_sixteen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                'favicon_ico' => 'nullable|file|mimes:ico|max:2048',
                'appletouch_icon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048 ',
                'site_manifest' => 'nullable|file|max:4000',
                'cropData' => 'sometimes|string'
            ]);

            $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;

            $favicon = new Favicon;

            $favicon->favicon_thirtytwo = $this->handleImageUpload($request, 'favicon_thirtytwo', 'uploads/favicon/', $cropData['favicon_thirtytwo'] ?? null);
            $favicon->favicon_sixteen = $this->handleImageUpload($request, 'favicon_sixteen', 'uploads/favicon/', $cropData['favicon_sixteen'] ?? null);
            $favicon->favicon_ico = $this->handleFileUpload($request, 'favicon_ico', 'uploads/favicon/');
            $favicon->appletouch_icon = $this->handleImageUpload($request, 'appletouch_icon', 'uploads/favicon/', $cropData['appletouch_icon'] ?? null);
            $favicon->site_manifest = $this->handleFileUpload($request, 'site_manifest', 'uploads/favicon/file/');

            $favicon->save();

            return redirect()->route('favicons.index')->with(['success' => 'Favicon successfully updated.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $favicon = Favicon::findOrFail($id);
        return view('admin.favicon.update', [
            'favicon' => $favicon,
            'page_title' => 'Update Favicon'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'favicon_thirtytwo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon_sixteen' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon_ico' => 'nullable|file|mimes:ico|max:2048',
            'appletouch_icon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'site_manifest' => 'nullable|file|max:4000',
            'cropData' => 'sometimes|string'
        ]);

        try {
            $favicon = Favicon::findOrFail($id);

            $cropData = $request->input('cropData') ? json_decode($request->input('cropData'), true) : null;

            $favicon->favicon_thirtytwo = $this->handleImageUpload($request, 'favicon_thirtytwo', 'uploads/favicon/', $cropData['favicon_thirtytwo'] ?? null) ?: $favicon->favicon_thirtytwo;
            $favicon->favicon_sixteen = $this->handleImageUpload($request, 'favicon_sixteen', 'uploads/favicon/', $cropData['favicon_sixteen'] ?? null) ?: $favicon->favicon_sixteen;
            $favicon->favicon_ico = $this->handleFileUpload($request, 'favicon_ico', 'uploads/favicon/') ?: $favicon->favicon_ico;
            $favicon->appletouch_icon = $this->handleImageUpload($request, 'appletouch_icon', 'uploads/favicon/', $cropData['appletouch_icon'] ?? null) ?: $favicon->appletouch_icon;
            $favicon->site_manifest = $this->handleFileUpload($request, 'site_manifest', 'uploads/favicon/file/') ?: $favicon->site_manifest;

            $favicon->save();

            return redirect()->route('favicons.index')->with(['success' => 'Favicon successfully updated.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    protected function handleImageUpload($request, $inputName, $uploadPath, $cropData = null)
    {
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);
            $imageName = time() . '.' . $file->extension();
            $filePath = $file->storeAs($uploadPath, $imageName, 'public');
    
            if ($cropData) {
                $imagePath = storage_path('app/public/' . $filePath);
                $this->cropImage($imagePath, $cropData);
            }
    
            return $filePath;
        }
    
        return null;
    }
    
    protected function handleFileUpload($request, $inputName, $uploadPath)
    {
        if ($request->hasFile($inputName)) {
            $file = $request->file($inputName);
            $fileName = time() . '.' . $file->extension();
            $filePath = $file->storeAs($uploadPath, $fileName, 'public');
            return $filePath;
        }
    
        return null;
    }
    protected function cropImage($imagePath, $cropParams)
    {
        $x = intval($cropParams['x']);
        $y = intval($cropParams['y']);
        $width = intval($cropParams['width']);
        $height = intval($cropParams['height']);

        $image = imagecreatefromstring(file_get_contents($imagePath));
        $croppedImage = imagecreatetruecolor($width, $height);

        imagecopyresampled($croppedImage, $image, 0, 0, $x, $y, $width, $height, $width, $height);

        imagewebp($croppedImage, $imagePath);
        imagedestroy($image);
        imagedestroy($croppedImage);
    }

    public function destroy($id)
    {
        $icon = Favicon::find($id);
        if ($icon) {
            // Delete files
            Storage::disk('public')->delete($icon->favicon_thirtytwo);
            Storage::disk('public')->delete($icon->favicon_sixteen);
            Storage::disk('public')->delete($icon->favicon_ico);
            Storage::disk('public')->delete($icon->appletouch_icon);
            Storage::disk('public')->delete($icon->site_manifest);

            $icon->delete();
            return redirect()->route('favicons.index')->with('success', 'Favicon successfully deleted.');
        } else {
            return redirect()->route('favicons.index')->with('error', 'Favicon not found.');
        }
    }
}
