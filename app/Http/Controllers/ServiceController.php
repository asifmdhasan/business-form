<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\BusinessCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('businessCategory')->latest()->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $categories = BusinessCategory::where('status', 1)->get();
        return view('services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_category_id' => 'required|exists:business_categories,id',
            'name'                 => 'required|string|max:255',
            'status'               => 'required|in:0,1',
        ]);

        Service::create($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = BusinessCategory::where('status', 1)->get();
        return view('services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'business_category_id' => 'required|exists:business_categories,id',
            'name'                 => 'required|string|max:255',
            'status'               => 'required|in:0,1',
        ]);

        $service->update($request->all());

        return redirect()
            ->route('services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
