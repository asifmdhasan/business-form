@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16 max-w-2xl">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Registration Successful!</h1>
        
        <p class="text-gray-600 mb-6">
            Thank you for registering your business with GME. Your application has been submitted successfully and is now pending review.
        </p>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8 text-left">
            <h2 class="font-semibold text-blue-900 mb-3">What happens next?</h2>
            <ul class="space-y-2 text-blue-800 text-sm">
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Our team will review your application within 3-5 business days</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>You will receive an email notification once your profile is approved</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>We may contact you if additional information is needed</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span>Once approved, your business profile will be published on the GME website</span>
                </li>
            </ul>
        </div>
        
        <div class="space-y-3">
            <a href="{{ route('home') }}" class="block w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Return to Home
            </a>
            <a href="{{ route('gme.business.register') }}" class="block w-full px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Register Another Business
            </a>
        </div>
        
        <div class="mt-8 pt-6 border-t text-sm text-gray-500">
            <p>Questions? Contact us at <a href="mailto:support@gme.com" class="text-blue-600 hover:underline">support@gme.com</a></p>
        </div>
    </div>
</div>
@endsection