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
        // Validate the request
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // validate as image
            'status' => 'required|in:0,1',
        ]);

        // Prepare data
        $data = $request->only('name', 'status');

        // Handle IMAGE upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); // unique name
            $image->move(public_path('assets/uploads/business/categories'), $imageName); // move to public folder
            $data['image'] = 'uploads/business/categories/' . $imageName;
        }

        // Create the business category
        BusinessCategory::create($data);

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
        // Validate the request
        $request->validate([
            'name'   => 'required|string|max:255',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048', // image validation
            'status' => 'required|in:0,1',
        ]);

        $data = $request->only('name', 'status');

        // Handle IMAGE upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($businessCategory->image && file_exists(public_path('assets/' . $businessCategory->image))) {
                unlink(public_path('assets/' . $businessCategory->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/uploads/business/categories'), $imageName);

            $data['image'] = 'uploads/business/categories/' . $imageName;
        }

        // Update the business category
        $businessCategory->update($data);

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
