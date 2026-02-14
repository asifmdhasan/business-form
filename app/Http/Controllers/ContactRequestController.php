<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\GmeBusinessForm;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:gme_business_forms,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'country' => 'required|string|max:100',
            'purpose' => 'required|string',
            'message' => 'nullable|string|max:1000',
            'agreement' => 'required|accepted',
            'ethics_pledge' => 'required|accepted',
        ]);

        $business = GmeBusinessForm::findOrFail($validated['business_id']);

        // Save contact request
        $contactRequest = ContactRequest::create([
            'business_id' => $validated['business_id'],
            'requester_name' => $validated['full_name'],
            'requester_email' => $validated['email'],
            'requester_phone' => $validated['phone'],
            'requester_company' => $validated['company'],
            'requester_designation' => $validated['designation'],
            'requester_country' => $validated['country'],
            'purpose' => $validated['purpose'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        // Send notification to business owner
        // Notification::send($business->customer, new ContactRequestNotification($contactRequest));

        return redirect()->back()->with('success', 'Your contact request has been submitted successfully! The business owner will review and respond soon.');
    }
}
