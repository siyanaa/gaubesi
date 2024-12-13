<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    // Display a listing of the FAQs
    public function index()
    {
        $faqs = FAQ::all();
        return view('admin.faqs.index', compact('faqs')); // Corrected view path
    }

    // Show the form for creating a new FAQ
    public function create()
    {
        return view('admin.faqs.create'); // Corrected view path
    }

    // Store a newly created FAQ in the database
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        FAQ::create($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.'); // Corrected route name
    }

    // Show the form for editing the specified FAQ
    public function edit(FAQ $faq)
    {
        return view('admin.faqs.edit', compact('faq')); // Corrected view path
    }

    
    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->all());
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.'); // Corrected route name
    }

    
    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.'); // Corrected route name
    }
}