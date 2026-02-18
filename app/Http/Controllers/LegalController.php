<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function privacyPolicy()
    {
        return view('legal.privacy-policy', [
            'title' => 'Privacy Policy',
            'breadcrumb' => 'Privacy Policy',
        ]);
    }

    public function cookiePolicy()
    {
        return view('legal.cookie-policy', [
            'title' => 'Cookie Policy',
            'breadcrumb' => 'Cookie Policy',
        ]);
    }

    public function terms()
    {
        return view('legal.terms', [
            'title' => 'Terms and Conditions',
            'breadcrumb' => 'Terms & Conditions',
        ]);
    }

    public function ethicalCommitment()
    {
        return view('legal.ethical-commitment', [
            'title' => 'Ethical Business Commitment',
            'breadcrumb' => 'Ethical Commitment',
        ]);
    }

    public function disclaimer()
    {
        return view('legal.disclaimer', [
            'title' => 'Disclaimer',
            'breadcrumb' => 'Disclaimer',
        ]);
    }
}
