<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessCategory;

class BusinessCategoryController extends Controller
{
    public function index()
    {
        // $categories = BusinessCategory::latest()->paginate(10);
        $categories = BusinessCategory::latest()->get();
        return view('business_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('business_categories.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        BusinessCategory::create($request->only('name', 'status'));

        return redirect()
            ->route('business-categories.index')
            ->with('success', 'Business category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusinessCategory $businessCategory)
    {
        return view('business_categories.edit', compact('businessCategory'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, BusinessCategory $businessCategory)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $businessCategory->update($request->only('name', 'status'));

        return redirect()
            ->route('business-categories.index')
            ->with('success', 'Business category updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(BusinessCategory $businessCategory)
    {
        $businessCategory->delete();

        return redirect()
            ->route('business-categories.index')
            ->with('success', 'Business category deleted successfully.');
    }
}
