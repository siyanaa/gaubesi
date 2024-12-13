<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialLink; // Make sure this model is created

class SocialLinkController extends Controller
{
    /**
     * Display a listing of social links.
     */
    public function index()
    {
        $socialLinks = SocialLink::paginate(10); // Fetch social links with pagination
        return view('admin.sociallinks.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new social link.
     */
    public function create()
    {
        return view('admin.sociallinks.create');
    }

    /**
     * Store a newly created social link in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'google_map' => 'required|url',
            'facebook_link' => 'required|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'reddit_link' => 'nullable|url',
            'embed_fbpage' => 'nullable|string',
        ]);

        SocialLink::create($request->all());

        return redirect()->route('social-links.index')->with('success', 'Social link added successfully.');
    }

    /**
     * Show the form for editing the specified social link.
     */
    public function edit($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        return view('admin.sociallinks.update', compact('socialLink'));
    }

    /**
     * Update the specified social link in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'google_map' => 'required|url',
            'facebook_link' => 'required|url',
            'instagram_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'reddit_link' => 'nullable|url',
            'embed_fbpage' => 'nullable|string',
        ]);

        $socialLink = SocialLink::findOrFail($id);
        $socialLink->update($request->all());

        return redirect()->route('social-links.index')->with('success', 'Social link updated successfully.');
    }

    /**
     * Remove the specified social link from storage.
     */
    public function destroy($id)
    {
        $socialLink = SocialLink::findOrFail($id);
        $socialLink->delete();

        return redirect()->route('social-links.index')->with('success', 'Social link deleted successfully.');
    }
}
