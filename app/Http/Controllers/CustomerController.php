<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GmeBusinessForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function updatePassword(){
        return view('customer.update-password');
    }

    public function storeUpdatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        $customer = Auth::guard('customer')->user();

        if (!Hash::check($request->current_password, $customer->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');

    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.login');
    }




    /////////////////////GET CUSTOMER DASHBOARD/////////////////////
    public function customerDashboard()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.dashboard', compact('customer'));
    }

    public function createGmeBusinessForm(){
        return view('customer.gme-business.create');
    }


    public function gmeBusinessIndex(Request $request)
    {
        // Check if it's an AJAX request for JSON data
        if ($request->ajax() || $request->wantsJson()) {
            $businesses = GmeBusinessForm::select([
                'id',
                'business_name',
                'short_introduction',
                'business_category_id',
                'countries_of_operation',
                'founders',
                'logo',
                'photos',
                'status',
                'created_at'
            ])
            ->with('category')
            ->where('allow_publish', true) // Only show businesses that allow publishing
            ->orderBy('created_at', 'desc')
            ->get();

            // Parse JSON fields
            $businesses = $businesses->map(function($business) {
                if ($business->photos && is_string($business->photos)) {
                    $business->photos = json_decode($business->photos, true);
                }
                return $business;
            });

            return response()->json([
                'businesses' => $businesses
            ]);
        }

        // Return the view for normal page load
        return view('gme-business.index');
    }

    public function show($id)
    {
        $business = GmeBusinessForm::findOrFail($id);
        return view('gme-business.show', compact('business'));
    }



}
