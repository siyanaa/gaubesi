<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with(['category'])->get();
        return view('admin.subcategories.index', compact('subCategories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            
        ]);

        // Create the subcategory
        SubCategory::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            
        ]);


        return redirect()->route('subcategories.index')->with('success', 'SubCategory created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('subCategory', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        


        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            
        ]);



        // Update the subcategory
        $subCategory->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('subcategories.index')->with('success', 'SubCategory updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return redirect()->route('subcategories.index')->with('success', 'SubCategory deleted successfully.');
    }
}



