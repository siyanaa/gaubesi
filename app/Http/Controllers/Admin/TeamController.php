<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of the team members.
     */
    public function index()
    {
        $teams = Team::latest()->get();
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'croppedImage' => 'required|array', // Expecting the image data as an array
            'croppedImage.*' => 'string', // Validating that each item in the array is a string
            'social_media_links' => 'required|array',
        ]);

        // Handle base64 cropped image upload
        $imagePath = $this->handleBase64Image($request->input('croppedImage')[0], 'team');

        // Create new team member record
        Team::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'social_media_links' => json_encode($request->social_media_links),
        ]);

        session()->flash('success', 'Team member created successfully.');

        return redirect()->route('admin.team.index');
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified team member in storage.
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'croppedImage' => 'sometimes|array', // Expecting the image data as an array
            'croppedImage.*' => 'string', // Validating that each item in the array is a string
            'social_media_links' => 'required|array',
        ]);

        // Handle base64 cropped image upload if a new image is provided
        $imagePath = $team->image; // Keep existing image by default
        if ($request->has('croppedImage')) {
            $imagePath = $this->handleBase64Image($request->input('croppedImage')[0], 'team', $team->image);
        }

        // Update the team member record
        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'social_media_links' => json_encode($request->social_media_links),
        ]);

        session()->flash('success', 'Team member updated successfully.');

        return redirect()->route('admin.team.index');
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy(Team $team)
    {
        // Delete the associated image
        $this->deleteImage($team->image, 'team/');

        // Delete the team member record
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }

    /**
     * Handle base64 image upload and convert it to WEBP format.
     */
    private function handleBase64Image($base64Image, $folder, $existingImage = null)
    {
        // Initialize image path
        $imagePath = $existingImage ? $existingImage : '';

        if ($base64Image) {
            // Extract base64 encoded part and decode it
            $image = explode(',', $base64Image);
            $decodedImage = base64_decode($image[1]);
            $imageResource = imagecreatefromstring($decodedImage);

            if ($imageResource !== false) {
                // Generate unique image name
                $imageName = time() . '-' . Str::uuid() . '.webp';
                $destinationPath = storage_path("app/public/$folder");

                // Create the directory if it does not exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true, true);
                }

                // Save the image in WEBP format
                $savedPath = $destinationPath . '/' . $imageName;
                imagewebp($imageResource, $savedPath);
                imagedestroy($imageResource);

                // Delete existing image if it exists
                if ($existingImage) {
                    $this->deleteImage($existingImage, "$folder/");
                }

                // Correctly formatted relative path for storage link
                $imagePath = "storage/$folder/$imageName";
            }
        }

        return $imagePath;
    }

    /**
     * Deletes an image from the specified path.
     *
     * @param string|null $image
     * @param string $folderPath
     */
    private function deleteImage($image, $folderPath)
    {
        if ($image) {
            $imagePath = storage_path('app/public/' . $folderPath . basename($image));

            // Check if the image exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
}