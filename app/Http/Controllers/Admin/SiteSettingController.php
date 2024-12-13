<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SiteSettingController extends Controller
{
    public function index()
    {
        // Fetch site settings along with their social links
        $siteSettings = SiteSetting::with('socialLinks')->latest()->get();
        return view('admin.sitesetting.index', compact('siteSettings'));
    }

    public function create()
    {
        
        $socialLinks = SocialLink::all();
        return view('admin.sitesetting.create', compact( 'socialLinks'));
    }

    public function edit($id)
    {
        $siteSetting = SiteSetting::findOrFail($id);
        $socialLinks = SocialLink::all(); // Fetch social links if needed
        return view('admin.sitesetting.update', compact('siteSetting', 'socialLinks'));
    }

    // Update the site settings in the database
    public function update(Request $request, $id)
    {
        // Validate the request data for SiteSetting fields
        $request->validate([
            'office_title' => 'required|string|max:255',
            'office_address' => 'required|array',
            'office_address.*' => 'string|max:255',
            'office_contact' => 'required|array',
            'office_contact.*' => 'string|max:255',
            'office_email' => 'required|array',
            'office_email.*' => 'email|max:255',
            'office_description' => 'nullable|string',
            'established_year' => 'nullable|string|max:4',
            'slogan' => 'nullable|string|max:255',
            'main_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'side_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'main_logo_cropped' => 'nullable|string',
            'side_logo_cropped' => 'nullable|string',
            'main_logo_crop_data' => 'nullable|string',
            'side_logo_crop_data' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
    
        // Find the site setting by ID
        $siteSetting = SiteSetting::findOrFail($id);
    
        // Handle logo uploads
        if ($request->hasFile('main_logo')) {
            if ($siteSetting->main_logo) {
                Storage::delete('public/' . $siteSetting->main_logo);
            }
            $mainLogoPath = $request->file('main_logo')->store('logos', 'public');
            $siteSetting->main_logo = $mainLogoPath;
        }
    
        if ($request->hasFile('side_logo')) {
            if ($siteSetting->side_logo) {
                Storage::delete('public/' . $siteSetting->side_logo);
            }
            $sideLogoPath = $request->file('side_logo')->store('logos', 'public');
            $siteSetting->side_logo = $sideLogoPath;
        }
    
        // Update site settings
        $siteSetting->update([
            'office_title' => $request->input('office_title'),
            'office_address' => json_encode($request->input('office_address')),
            'office_contact' => json_encode($request->input('office_contact')),
            'office_email' => json_encode($request->input('office_email')),
            'office_description' => $request->input('office_description'),
            'established_year' => $request->input('established_year'),
            'slogan' => $request->input('slogan'),
            'main_logo_cropped' => $request->input('main_logo_cropped'),
            'side_logo_cropped' => $request->input('side_logo_cropped'),
            'main_logo_crop_data' => $request->input('main_logo_crop_data'),
            'side_logo_crop_data' => $request->input('side_logo_crop_data'),
            'status' => $request->input('status'),
        ]);
    
       
    
        session()->flash('success', 'Site settings updated successfully.');
    
        return redirect()->route('sitesettings.index');
    }
}    