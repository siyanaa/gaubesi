<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsandConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        $termsandconditions = TermsandConditions::all();
        return view('admin.termsandconditions.index', compact('termsandconditions'));
    }

    public function create()
    {
        return view('admin.termsandconditions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'policy_type' => 'required|string',
            'description' => 'required|array',
        ]);

        TermsandConditions::create([
            'policy_type' => $request->policy_type,
            'description' => json_encode($request->description),
        ]);

        return redirect()->route('termsandconditions.index')->with('success', 'Policy created successfully.');
    }

    public function edit($id)
    {
        $policy = TermsandConditions::findOrFail($id);
        return view('admin.termsandconditions.update', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'policy_type' => 'required|string',
            'description' => 'required|array',
        ]);

        $policy = TermsandConditions::findOrFail($id);
        $policy->update([
            'policy_type' => $request->policy_type,
            'description' => json_encode($request->description),
        ]);

        return redirect()->route('termsandconditions.index')->with('success', 'Policy updated successfully.');
    }

    public function destroy($id)
    {
        $policy = TermsandConditions::findOrFail($id);
        $policy->delete();

        return redirect()->route('termsandconditions.index')->with('success', 'Policy deleted successfully.');
    }
}
