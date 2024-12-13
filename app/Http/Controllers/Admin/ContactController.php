<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        // Common validation rules
        $rules = [
            'message' => 'required|string',
            
        ];

        // For logged-in users
        if (Auth::check()) {
            $data = [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'message' => $request->input('message'),
                
                'properties_id' => $request->input('properties_id'), // Add this line
            ];
        }
        // For guests
        else {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
               
                'properties_id' => $request->input('properties_id'), // Add this line
            ];
        }

        // Validate the request
        $request->validate($rules);

        // Create the contact
        Contact::create($data);

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

}