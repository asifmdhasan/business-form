<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customerProfile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.edit-profile', compact('customer'));
    }

public function updateProfile(Request $request)
{
    $customer = Auth::guard('customer')->user();

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:customers,email,' . $customer->id,
        'phone' => 'nullable|string|unique:customers,phone,' . $customer->id,
        'dob' => 'nullable|date',
        'profile_image' => 'nullable|image|max:2048', // max 2MB
    ]);

    $data = $request->only(['name', 'email', 'phone', 'dob']);

    // Handle profile image
    if ($request->hasFile('profile_image')) {

        // Delete old file if exists
        if ($customer->profile_image && file_exists(public_path($customer->profile_image))) {
            unlink(public_path($customer->profile_image));
        }

        // Upload new file to public/assets/uploads/customer-images
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/uploads/customer-images'), $filename);

        // Add to $data so it updates DB
        $data['profile_image'] = 'assets/uploads/customer-images/' . $filename;
    }

    $customer->update($data);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}




}
