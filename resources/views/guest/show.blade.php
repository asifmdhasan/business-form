@extends('layouts.guest-master')

@section('content')
<style>
    .hero-section.text-center.text-white.islamic-bg {
        display: none;
    }
        /* Gallery Card Hover Effects */
    .gallery-card-wrapper .card {
        transition: all 0.3s ease;
    }

    .gallery-card-wrapper:hover .card {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* Image Zoom on Hover */
    .gallery-img-container:hover .gallery-main-img {
        transform: scale(1.05);
    }

    .gallery-img-container:hover .gallery-gradient {
        opacity: 1;
    }

    .gallery-img-container:hover .gallery-icon {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1) !important;
    }

    /* Shadow Hover Effect */
    .shadow-hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    /* Card body padding creates space around image */
    .card-body {
        transition: background-color 0.3s ease;
    }

    .gallery-card-wrapper:hover .card-body {
        background-color: #e9ecef !important;
    }

    /* Modal backdrop */
    .modal-backdrop.show {
        opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .gallery-img-container {
            height: 200px !important;
        }
    }

    @media (max-width: 768px) {
        .gallery-img-container {
            height: 180px !important;
        }

        .featured-business {
            font-size: 26px !important;
        }

        .card-body {
            padding: 0.75rem !important;
        }
    }

    @media (max-width: 576px) {
        .gallery-img-container {
            height: 200px !important;
        }

        .featured-business {
            font-size: 22px !important;
        }
    }
</style>

@php
    $countries = is_string($business->countries_of_operation)
        ? json_decode($business->countries_of_operation, true)
        : ($business->countries_of_operation ?? []);

    $photos = is_string($business->photos)
        ? json_decode($business->photos, true)
        : ($business->photos ?? []);

    function badgeColor($value) {
        return match($value) {
            'yes' => 'text-success',
            'no' => 'text-danger',
            'maybe', 'mostly', 'partially_compliant', 'partially_transitioning' => 'text-warning',
            default => 'text-muted',
        };
    }

    function badgeIcon($value) {
        return match($value) {
            'yes' => 'fa-check-circle',
            'no' => 'fa-times-circle',
            'maybe', 'mostly', 'partially_compliant', 'partially_transitioning' => 'fa-exclamation-circle',
            default => 'fa-minus-circle',
        };
    }
@endphp

<style>
    /* Custom Colors */
    :root {
        --primary-color: #22cece;
        --primary-hover: #1db8b8;
        --text-muted: #519494;
        --bg-light: #f6f8f8;
        --border-light: #e5e7eb;
    }

    /* Hero Section */
    .hero-section-2 {
        margin-top: 5rem;
        background-size: cover;
        background-position: center;
        border-radius: 1rem;
        padding: 6rem 5rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        min-height: 280px;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        border-radius: 1rem;
    }

    .hero-section-2::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('https://www.transparenttextures.com/patterns/subtle-prism.png');
        opacity: 0.15;
        /* z-index: 1; */
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .hero-content h1,
    .hero-content .section-title {
        color: white;
    }

    .hero-content .text-muted {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .hero-buttons {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        z-index: 3;
    }
    .section-title.mb-0{
        font-size: 2.5rem;
    }
    .logo-box {
        width: 150px;
        height: 150px;
        background: white;
        padding: 0.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .verified-badge {
        position: unset;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: #9C7D2D;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
    }


    .btn-primary-custom {
        background-color: #9b7d2d;
        color: #fff;
        font-weight: 600;
        border: none;
        transition: transform 0.2s;
    }

    .btn-primary-custom:hover {
        background-color: #9b7d2d;
        color: #fff;
        transform: scale(1.05);
    }

    .btn-outline-custom {
        background-color: #9b7d2d;
        color: #fff;
        border: 1px solid #fff;
        font-weight: 600;
        transition: transform 0.2s;
    }

    .btn-outline-custom:hover {
         background-color: #9C7D2D;
        color: #fff;
        transform: scale(1.05);
    }

    /* About Section */
    .about-card {
        border: 1px solid var(--border-light);
        border-radius: 1rem;
        background: white;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        align-items: start;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .info-item i {
        color: #9b7d2d;
        font-size: 1.5rem;
        /* margin-top: 0.25rem; */
    }

    .info-label {
        font-size: 0.875rem;
        color: #9b7d2d;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 500;
        color: #0e1a1a;
    }

    /* Faith Compliance Section */
    .faith-section {
        background: linear-gradient(135deg, #9b7d2d 0%, #9b7d2d 100%);
        border-radius: 1rem;
        padding: 2rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .faith-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('https://www.transparenttextures.com/patterns/gplay.png');
        opacity: 0.1;
    }

    .faith-content {
        position: relative;
        z-index: 1;
    }

    .faith-card {
        background: white;
        border-radius: 0.5rem;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .faith-card i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    /* Products Section */
    .product-card {
        border: 1px solid #9b7d2d;
        border-radius: 1rem;
        background: white;
        padding: 1.5rem;
        text-align: center;
        transition: box-shadow 0.3s;
        margin-bottom: 1.5rem;
    }

    .product-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .product-icon {
        width: 64px;
        height: 64px;
        background: rgba(34, 206, 206, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: var(--primary-color);
        font-size: 1.75rem;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem; 
    }

    .gallery-img {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        border-radius: 0.5rem;
        transition: transform 0.3s;
    }

    .gallery-img:hover {
        transform: scale(1.05);
    }



    /* Contact Section */
    .contact-card {
        border: 1px solid var(--border-light);
        border-radius: 1rem;
        background: white;
        padding: 1.5rem;
    }

    .social-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #f3f4f6;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        transition: all 0.3s;
        text-decoration: none;
    }

    .social-icon:hover {
        background: #e5e7eb;
        color: #374151;
    }

    .whatsapp-btn {
        background: #25d366;
        color: white;
        font-weight: 600;
        border: none;
    }

    .whatsapp-btn:hover {
        background: #20ba5a;
        color: white;
        transform: scale(1.05);
    }

    /* Section Headers */
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0e1a1a;
        margin-bottom: 0.25rem;
    }

    .section-subtitle {
        font-size: 1rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .justi-center {
            justify-content: center;
        }

        .hero-buttons {
            position: absolute;
            bottom: 1rem;       /* keeps it at the bottom */
            transform: translateX(7%); /* shift back by half width to center */
            display: flex;      /* optional, if buttons inside should be in a row */
            gap: 0.5rem;        /* optional spacing between buttons */
        }


    }

    .islamic-bg {
        border-radius: 0rem;
    }
    .text-success{
        color: green !important;
    }
















    /* Collaboration Section Styles */
    .collaboration-section {
        background:  #9C7D2D;
        padding: 60px 30px;
        margin: 40px 0;
        border-radius: 15px;
        /* box-shadow: 0 10px 40px rgba(156, 125, 45, 0.2); */
        /* position: relative; */
        /* overflow: hidden; */
    }

    /* Decorative Pattern Overlay */
    .collaboration-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255,255,255,.03) 20px, rgba(255,255,255,.03) 40px); */
        pointer-events: none;
    }

    .collaboration-content {
        position: relative;
        z-index: 1;
    }

    /* Collaboration Card */
    .collaboration-card {
        background: rgba(255, 255, 255, 0.95);
        padding: 25px 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .collaboration-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        background: rgba(255, 255, 255, 1);
    }

    /* Collaboration Icon */
    .collaboration-icon {
        font-size: 2.5rem;
        color: #9C7D2D;
        margin-bottom: 10px;
        transition: all 0.3s ease;
    }

    .collaboration-card:hover .collaboration-icon {
        transform: scale(1.1);
        color: #7A6324;
    }

    /* Card Text */
    .collaboration-card .fw-semibold {
        color: #333;
        font-size: 0.95rem;
        text-align: center;
        line-height: 1.4;
    }

    /* CTA Button */
    .btn-collaboration-cta {
        background-color: #fff;
        color: #9C7D2D;
        border: 2px solid #fff;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
    }

    .btn-collaboration-cta:hover {
        background-color: transparent;
        color: #fff;
        border-color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(255, 255, 255, 0.3);
    }

    /* Section Subtitle */
    .section-subtitle {
        font-size: 1.1rem;
        line-height: 1.6;
        opacity: 0.95;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .collaboration-section {
            padding: 40px 20px;
            margin: 30px 0;
        }

        .featured-business {
            font-size: 28px !important;
        }

        .section-subtitle {
            font-size: 1rem;
        }

        .collaboration-card {
            padding: 20px 10px;
        }

        .collaboration-icon {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .featured-business {
            font-size: 24px !important;
        }

        .collaboration-icon {
            font-size: 1.8rem;
        }
    }


    /* Privacy Notice Box */
    .privacy-notice {
        background: linear-gradient(135deg, #F5EFE0 0%, #FDF8EC 100%);
        border-left: 4px solid #9C7D2D;
        padding: 1.5rem;
        border-radius: 8px;
    }

    /* Request Contact Button */
    .btn-request-contact {
        background-color: #9C7D2D;
        color: white;
        border: none;
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-request-contact:hover {
        background-color: #7A6324;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(156, 125, 45, 0.3);
        color: white;
    }

    /* Submit Button in Modal */
    .btn-submit-request {
        background-color: #9C7D2D;
        color: white;
        border: none;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-submit-request:hover {
        background-color: #7A6324;
        color: white;
    }

    /* Modal Form Styling */
    .modal-body .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        border: 1px solid #ddd;
        padding: 0.6rem 0.75rem;
        border-radius: 6px;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 0 0.2rem rgba(156, 125, 45, 0.15);
    }

    /* Form Check Styling */
    .form-check-input:checked {
        background-color: #9C7D2D;
        border-color: #9C7D2D;
    }

    .form-check-input:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 0 0.2rem rgba(156, 125, 45, 0.15);
    }

    .form-check-label {
        font-size: 0.95rem;
        line-height: 1.5;
    }

    /* Section Headers in Modal */
    .modal-body h6 {
        border-bottom: 2px solid #9C7D2D;
        padding-bottom: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .privacy-notice {
            padding: 1rem;
        }
        
        .btn-request-contact {
            width: 100%;
            margin-top: 1rem;
        }
    }



        /* Privacy Notice Box */
    .privacy-notice {
        background: linear-gradient(135deg, #F5EFE0 0%, #FDF8EC 100%);
        border-left: 4px solid #9C7D2D;
        padding: 1.5rem;
        border-radius: 8px;
    }

    /* Request Contact Button */
    .btn-request-contact {
        background-color: #9C7D2D;
        color: white;
        border: none;
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-request-contact:hover {
        background-color: #7A6324;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(156, 125, 45, 0.3);
        color: white;
    }

    /* Submit Button in Modal */
    .btn-submit-request {
        background-color: #9C7D2D;
        color: white;
        border: none;
        padding: 10px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-submit-request:hover {
        background-color: #7A6324;
        color: white;
    }

    /* Modal Scrollable Body */
    .modal-body {
        padding: 1.5rem;
    }

    /* Modal Form Styling */
    .modal-body .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        border: 1px solid #ddd;
        padding: 0.6rem 0.75rem;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 0 0.2rem rgba(156, 125, 45, 0.15);
    }

    /* Form Check Styling */
    .form-check-input:checked {
        background-color: #9C7D2D;
        border-color: #9C7D2D;
    }

    .form-check-input:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 0 0.2rem rgba(156, 125, 45, 0.15);
    }

    .form-check-label {
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Section Headers in Modal */
    .modal-body h6 {
        border-bottom: 2px solid #9C7D2D;
        padding-bottom: 0.5rem;
    }

    /* Modal Footer */
    .modal-footer {
        padding: 1rem 1.5rem;
    }

    /* Responsive Modal */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 0.5rem;
        }
        
        .modal-body {
            max-height: 60vh !important;
            padding: 1rem;
        }
        
        .privacy-notice {
            padding: 1rem;
        }
        
        .btn-request-contact {
            width: 100%;
            margin-top: 1rem;
        }
        
        .modal-footer {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .modal-footer .btn {
            width: 100%;
        }
    }

    /* Ensure Modal Shows Properly */
    .modal-dialog-scrollable .modal-body {
        overflow-y: auto;
    }

    .modal-dialog-scrollable .modal-footer {
        flex-shrink: 0;
    }






    /* Faith Section */
    .faith-section {
        background: linear-gradient(135deg, #9C7D2D 0%, #7A6324 100%);
        padding: 60px 30px;
        margin: 40px 0;
        border-radius: 15px;
        position: relative;
        overflow: hidden;
    }

    .faith-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            repeating-linear-gradient(45deg, transparent, transparent 20px, rgba(255,255,255,.03) 20px, rgba(255,255,255,.03) 40px);
        pointer-events: none;
    }

    .faith-content {
        position: relative;
        z-index: 1;
    }

    /* Faith Card - Center Aligned */
    .faith-card {
        background: rgba(255, 255, 255, 0.95);
        padding: 8px 10px;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        /* min-height: 150px; */
    }

    .faith-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Primary Color Icon */
    .icon-primary {
        color: #9C7D2D !important;
        font-size: 2.5rem;
        margin-bottom: 15px;
    }

    .faith-card .fw-semibold {
        color: #333;
        font-size: 0.95rem;
        line-height: 1.4;
        margin-bottom: 0;
    }

    .faith-section h6 {
        border-bottom: 2px solid rgba(255,255,255,0.3);
        padding-bottom: 0.5rem;
        display: inline-block;
    }

    /* Row Centering - ensures cards stay centered */
    .row.justify-content-center {
        display: flex;
        justify-content: center;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .faith-card {
            min-height: 130px;
        }
    }

    @media (max-width: 768px) {
        .faith-section {
            padding: 40px 20px;
        }

        .icon-primary {
            font-size: 2rem;
        }

        .faith-card {
            min-height: 120px;
            padding: 20px 10px;
        }

        .faith-card .fw-semibold {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .faith-card .fw-semibold {
            font-size: 0.85rem;
        }
    }
    .padding-bottom-2rem{
        padding-bottom: 1.2rem;
    }

















        /* Contact Section Styling */
    .contact-section {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 10px;
        height: 100%;
        border-left: 4px solid #9C7D2D;
    }

    .contact-heading {
        color: #9C7D2D;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e0e0e0;
    }

    .contact-details {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .contact-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .contact-label {
        font-weight: 600;
        color: #666;
        font-size: 0.9rem;
    }

    .contact-value {
        color: #333;
        font-size: 1rem;
        word-break: break-word;
    }

    /* Social Links */
    .social-links {
        margin-top: 0.5rem;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: white;
        color: #9C7D2D;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        text-decoration: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .social-icon:hover {
        background: #9C7D2D;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(156, 125, 45, 0.3);
    }

    /* Website Link */
    .website-link {
        color: #9C7D2D;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        word-break: break-all;
    }

    .website-link:hover {
        color: #7A6324;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .contact-section {
            margin-bottom: 1rem;
        }
    }
</style>

<div class="container my-4">
    <!-- HERO SECTION -->
    <section class="hero-section-2" style="background-image: url('{{ $business->cover_photo ? asset('assets/'.$business->cover_photo) : 'https://images.unsplash.com/photo-1497366216548-37526070297c' }}');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="logo-box">
                        <img src="{{ $business->logo ? asset('assets/'.$business->logo) : 'https://ui-avatars.com/api/?name='.urlencode($business->business_name) }}"
                             alt="{{ $business->business_name }}">
                    </div>
                </div>
                <div class="col p-8">
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                        <h1 class="section-title mb-0">{{ $business->business_name }}</h1>
                        @if($business->status === 'approved' && $business->is_verified === 1)
                            <span class="verified-badge">
                                <i class="fas fa-check-circle"></i>
                                GME Verified
                            </span>
                        @else
                            {{-- <span class="unverified-badge">

                                ({{ $business->status }})
                            </span> --}}
                        @endif
                    </div>
                    <p class="text-muted mb-0" style="color: rgba(255,255,255,0.9) !important;">{{ $business->short_introduction }}</p>
                </div>
            </div>
        </div>

        <!-- Buttons positioned at bottom-right -->
        <div class="hero-buttons">
            <div class="d-flex flex-wrap gap-2">
                @if($business->business_profile)
                    <a href="{{ asset('assets/'.$business->business_profile) }}"
                       class="btn btn-primary-custom" target="_blank">
                        <i class="fas fa-download me-2"></i>Download Company Profile
                    </a>
                @endif
                @if($business->product_catalogue)
                    <a href="{{ asset('assets/'.$business->product_catalogue) }}"
                       class="btn btn-outline-custom" target="_blank">
                        <i class="fas fa-book me-2"></i>Download Product Catalogue
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- ABOUT THE BUSINESS -->
    <section class="about-card">
        {{-- <h2 class="section-title">About the Business</h2> --}}
        <h4 class="fw-bold mb-4 featured-business "
            style="
                font-size: 34px;
                text-transform: uppercase;
                line-height: 1.3em;">
            <span style=" font-weight: 300;">About the </span>
            <span style="color:#9b7d2d;font-weight: 900;">{{ $business->business_name }}</span>
        </h4>

        <p class="mb-4">{{ $business->business_overview }}</p>

        <div class="row pt-3" style="border-top: 1px solid var(--border-light);">
            <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <div>
                        <p class="info-label mb-0">Year Established</p>
                        <p class="info-value mb-0">{{ $business->year_established ?? '—' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-globe"></i>
                    <div>
                        <p class="info-label mb-0">Country & City</p>
                        <p class="info-value mb-0">{{ $countries ? implode(', ', $countries) : '—' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-th-large"></i>
                    <div>
                        <p class="info-label mb-0">Business Category</p>
                        <p class="info-value mb-0">{{ optional($business->category)->name ?? '—' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-chart-line"></i>
                    <div>
                        <p class="info-label mb-0">Operational Scale</p>
                        <p class="info-value mb-0">{{ $business->operational_scale ? ucfirst(str_replace('_',' ',$business->operational_scale)) : '—' }}</p>
                    </div>
                </div>
            </div>
            {{-- @dd($business) --}}
            {{-- // Founder Name --}}
            {{-- <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-user-tie"></i>
                    <div>
                        <p class="info-label mb-0">Founder Name</p>
                            @php
                                $founders = is_string($business->founders)
                                    ? json_decode($business->founders, true)
                                    : ($business->founders ?? []);
                                $founderNames = collect($founders)->pluck('name')->filter()->implode(', ');
                            @endphp
                            {{ $founderNames ?: '—' }}
                        </p>

                    </div>
                </div>
            </div> --}}
            @php
                $founders = is_string($business->founders)
                    ? json_decode($business->founders, true)
                    : ($business->founders ?? []);
            @endphp
            @forelse($founders as $founder)
                <div class="col-md-6 mb-3">
                    <div class="info-item">
                        <i class="fas fa-user-tie"></i>
                        <div>
                            <p class="info-label mb-1 fw-bold">Founder Information</p>

                            <p class=" mb-0">
                                {{-- <span>Name:</span> --}}
                                <span class="info-value">  {{ $founder['name'] ?? '—' }}</span>
                            </p>

                            <p class=" mb-0">
                                {{-- <span>Designation:</span> --}}
                                <span class="info-value">{{ $founder['designation'] ?? '—' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-6">
                    <p>—</p>
                </div>
            @endforelse

        </div>

        @if($business->ethical_description)
            <div class="pt-3 mt-3" style="border-top: 1px solid var(--border-light);">
                <p class="mb-0">{{ $business->ethical_description }}</p>
            </div>
        @endif
    </section>

    <!-- PRODUCTS & SERVICES -->

    <section class="contact-card  mt-4">
        <div class="text-start mb-4">
            {{-- <h2 class="section-title">Products & Services</h2> --}}
            <h4 class="fw-bold mb-4 featured-business "
            style="
                font-size: 34px;
                text-transform: uppercase;
                line-height: 1.3em;">
            <span style=" font-weight: 300;">Products & </span>
            <span style="color:#9b7d2d;font-weight: 900;">Services </span>
        </h4>
            <p class="section-subtitle"style="color:#414141;font-weight: 600; font-size: 24px;">What They Offer</p>
        </div>

        <div class="row">
            @foreach($services as $service)
            <div class="col-md-4">
                <div class="product-card">
                    {{-- <div class="product-icon">
                        <i class="fas fa-star"></i>
                    </div> --}}
                    <h3 class="h5 fw-bold">{{ $service->name }}</h3>
                    <p class="text-muted small mb-0">
                        {{ $service->description ?? '' }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <div class="text-center">
            <button class="btn btn-secondary">View All Products & Services</button>
        </div> --}}
    </section>

    {{-- Collaboration Open --}}
    @if($business->collaboration_open === 'yes')
        <section class="collaboration-section">
            <div class="collaboration-content text-center">
                <h4 class="fw-bold mb-4 featured-business"
                    style="
                        font-size: 34px;
                        text-transform: uppercase;
                        line-height: 1.3em;">
                    <span style="color:#fff; font-weight: 300;">{{ $business->business_name }}</span>
                    <span style="color:#fff; font-weight: 900;"> Open for Collaboration</span>
                </h4>
                <p class="section-subtitle mx-auto" style="max-width: 600px; color:#fff;">
                    {{ $business->business_name }} is actively seeking partnership opportunities in the following areas.
                </p>

                @php
                    $collaborationTypes = is_string($business->collaboration_types)
                        ? json_decode($business->collaboration_types, true)
                        : ($business->collaboration_types ?? []);
                    
                    // Collaboration type icons mapping
                    $collaborationIcons = [
                        'Partnerships' => 'fa-handshake',
                        'Investment Oportunities' => 'fa-chart-line',
                        'Vendor Supply Chain' => 'fa-truck',
                        'Marketing Promotion' => 'fa-bullhorn',
                        'Networking' => 'fa-users',
                        'Training Workshops' => 'fa-graduation-cap',
                        'Community Charity Projects' => 'fa-heart',
                        'Not Sure Yet' => 'fa-question-circle'
                    ];
                @endphp

                <div class="row g-3 mt-4 justify-content-center">
                    @foreach($collaborationTypes as $type)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="collaboration-card">
                                <i class="fas {{ $collaborationIcons[$type] ?? 'fa-handshake' }} collaboration-icon"></i>
                                <div class="fw-semibold mt-2">{{ $type }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <p class="mt-4 mb-0 mx-auto" style="max-width: 700px; color:#fff;">
                    We believe in the power of collaboration to drive growth and create meaningful impact. 
                    Whether you're looking to partner, invest, or network, we're open to exploring opportunities 
                    that align with our values and vision for mutual success.
                </p>

                <div class="mt-4">
                    
                    <a href="#" 
                    class="btn btn-collaboration-cta">
                        <i class="fas fa-envelope me-2"></i>
                        Get in Touch
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- ELEGANT GALLERY with Centered Images in Cards -->
    @if($business->businessPhotos && $business->businessPhotos->count() > 0)
        <section class="mt-5 mb-5 contact-card">
            <div class=" mb-4">
                <h4 class="fw-bold featured-business"
                    style="font-size: 34px; text-transform: uppercase; line-height: 1.3em;">
                    <span style="font-weight: 300;">Photos & </span>
                    <span style="color:#9b7d2d; font-weight: 900;">Media</span>
                </h4>
                <p class="text-muted">Click on any image to view in full size</p>
            </div>

            <div class="row g-3">
                @foreach($business->businessPhotos as $index => $photo)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="gallery-card-wrapper">
                        <div class="card border-0 shadow-hover h-100" style="border-radius: 12px;">
                            <div class="card-body p-3" style="background: #f8f9fa;">
                                <div class="position-relative gallery-img-container"
                                    style="height: 220px; overflow: hidden; border-radius: 8px; cursor: pointer; background: white; display: flex; align-items: center; justify-content: center;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#photoModal{{ $photo->id }}">

                                    <img src="{{ asset('assets/' . $photo->image_url) }}"
                                        class="gallery-main-img"
                                        alt="Business photo {{ $index + 1 }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain; transition: all 0.4s ease;"
                                        loading="lazy">

                                    <!-- Gradient Overlay -->
                                    <div class="gallery-gradient position-absolute top-0 start-0 w-100 h-100"
                                        style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent); opacity: 0; transition: opacity 0.4s ease; border-radius: 8px;">
                                    </div>

                                    <!-- Icon Overlay -->
                                    <div class="gallery-icon position-absolute top-50 start-50 translate-middle"
                                        style="opacity: 0; transition: all 0.4s ease; transform: translate(-50%, -50%) scale(0.5);">
                                        <div class="text-center">
                                            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                                                <i class="fa fa-search-plus" style="font-size: 20px; color: #9b7d2d;"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photo Number Badge -->
                                    {{-- <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge" style="background: rgba(155, 125, 45, 0.9); padding: 5px 10px; font-size: 11px; border-radius: 15px;">
                                            {{ $index + 1 }} / {{ $business->businessPhotos->count() }}
                                        </span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Optimized Modal -->
                    <div class="modal fade" id="photoModal{{ $photo->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content" style="background: rgba(0,0,0,0.95); border: none;">
                                <div class="modal-header border-0 py-2 px-3">
                                    <h6 class="modal-title text-white mb-0">
                                        <i class="fa fa-image me-2"></i>
                                        Photo {{ $index + 1 }} of {{ $business->businessPhotos->count() }}
                                    </h6>
                                    <button type="button"
                                            class="btn-close btn-close-white"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-2">
                                    <img src="{{ asset('assets/' . $photo->image_url) }}"
                                        class="img-fluid rounded"
                                        alt="Business photo {{ $index + 1 }}"
                                        style="max-height: 70vh; width: auto; object-fit: contain;">
                                </div>
                                <div class="modal-footer border-0 justify-content-between py-2 px-3">
                                    <a href="{{ asset('assets/' . $photo->image_url) }}"
                                    target="_blank"
                                    class="btn btn-outline-light btn-sm">
                                        <i class="fa fa-external-link-alt me-1"></i>Open Full Size
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    @endif


    <!-- FAITH COMPLIANCE -->
    {{-- <section class="faith-section">
        <div class="faith-content text-center">
            <h4 class="fw-bold mb-4 featured-business "
                style="
                    font-size: 34px;
                    text-transform: uppercase;
                    line-height: 1.3em;">
                <span style="color:#fff; font-weight: 300;">Faith-Compliant </span>
                <span style="color:#fff;font-weight: 900;">Business </span>
            </h4>
            <p class="section-subtitle mx-auto" style="max-width: 600px;color:#fff;">
                This business is verified to operate under Islamic ethical principles.
            </p>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="faith-card">
                        <i class="fas fa-check-circle {{ badgeColor($business->avoid_riba) }}"></i>
                        <div class="fw-semibold">Riba-free Financing</div>
                        <small class="text-muted">{{ ucfirst(str_replace('_',' ',$business->avoid_riba ?? 'n/a')) }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faith-card">
                        <i class="fas {{ badgeIcon($business->avoid_haram_products) }} {{ badgeColor($business->avoid_haram_products) }}"></i>
                        <div class="fw-semibold">Ethical & Halal Conduct</div>
                        <small class="text-muted">{{ ucfirst(str_replace('_',' ',$business->avoid_haram_products ?? 'n/a')) }}</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="faith-card">
                        <i class="fas {{ badgeIcon($business->fair_pricing) }} {{ badgeColor($business->fair_pricing) }}"></i>
                        <div class="fw-semibold">Honest Pricing & Marketing</div>
                        <small class="text-muted">{{ ucfirst(str_replace('_',' ',$business->fair_pricing ?? 'n/a')) }}</small>
                    </div>
                </div>
            </div>

            <p class="mt-4 mb-0 mx-auto" style="max-width: 700px;color:#fff;">
                Our commitment is to uphold the highest standards of integrity. We ensure all operations,
                from financing to product development and marketing, are fully aligned with ethical principles,
                fostering trust and transparency with our valued customers and partners.
            </p>
        </div>
    </section> --}}

    <!-- FAITH COMPLIANCE -->
    <section class="faith-section">
        <div class="faith-content text-center">
            <h4 class="fw-bold mb-4 featured-business"
                style="font-size: 34px; text-transform: uppercase; line-height: 1.3em;">
                <span style="color:#fff; font-weight: 300;">Faith-Compliant </span>
                <span style="color:#fff;font-weight: 900;">Business</span>
            </h4>
            <p class="section-subtitle mx-auto" style="max-width: 600px;color:#fff;">
                This business commits to Islamic ethical principles and community responsibility.
            </p>

            @php
                $financePractices = is_string($business->finance_practices)
                    ? json_decode($business->finance_practices, true)
                    : ($business->finance_practices ?? []);
                    
                $productPractices = is_string($business->product_practices)
                    ? json_decode($business->product_practices, true)
                    : ($business->product_practices ?? []);
                    
                $communityPractices = is_string($business->community_practices)
                    ? json_decode($business->community_practices, true)
                    : ($business->community_practices ?? []);

                $hasPractices = !empty($financePractices) || !empty($productPractices) || !empty($communityPractices);

                // Practice icons mapping - using full text as keys
                $practiceIcons = [
                    // Finance
                    'I do not deal in riba or interest-based transactions' => 'fa-ban',
                    'I do not engage in unethical or exploitative trade' => 'fa-shield-alt',
                    'I follow Shariah-compliant financial practices' => 'fa-check-circle',
                    'I am honest and transparent in all dealings' => 'fa-handshake',
                    
                    // Products
                    'My products/services are halal' => 'fa-check-circle',
                    'I avoid selling haram or prohibited items' => 'fa-ban',
                    'I maintain high quality and honesty in offerings' => 'fa-star',
                    'I provide accurate information of my products and services' => 'fa-info-circle',
                    
                    // Community
                    'I pay fair wages and treat employees with respect' => 'fa-money-bill-wave',
                    'I support local communities and charitable initiatives' => 'fa-heart',
                    'I practice environmental responsibility in my operations' => 'fa-leaf',
                    'I collaborate ethically with other Muslim businesses' => 'fa-handshake',
                ];
            @endphp

            @if($hasPractices)
                {{-- Finance & Business Practices --}}
                @if(!empty($financePractices))
                    <div class="mb-4">
                        <h4 class="text-white fw-bold mb-3">
                            <i class="fas fa-coins me-2"></i>Finance & Business Practices
                        </h4>
                        <div class="row g-3 justify-content-center">
                            @foreach($financePractices as $practice)
                                <div class="col-md-6 col-lg-3">
                                    <div class="faith-card">
                                        <i class="fas {{ $practiceIcons[$practice] ?? 'fa-check' }} icon-primary"></i>
                                        <div class="fw-semibold">{{ $practice }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Product & Services Practices --}}
                @if(!empty($productPractices))
                    <div class="mb-4">
                        <h4 class="text-white fw-bold mb-3">
                            <i class="fas fa-box-open me-2"></i>Product & Services Practices
                        </h4>
                        <div class="row g-3 justify-content-center">
                            @foreach($productPractices as $practice)
                                <div class="col-md-6 col-lg-3">
                                    <div class="faith-card">
                                        <i class="fas {{ $practiceIcons[$practice] ?? 'fa-check' }} icon-primary"></i>
                                        <div class="fw-semibold">{{ $practice }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Community & Responsibility Practices --}}
                @if(!empty($communityPractices))
                    <div class="mb-4">
                        <h4 class="text-white fw-bold mb-3">
                            <i class="fas fa-users me-2"></i>Community & Responsibility
                        </h4>
                        <div class="row g-3 justify-content-center">
                            @foreach($communityPractices as $practice)
                                <div class="col-md-6 col-lg-3">
                                    <div class="faith-card">
                                        <i class="fas {{ $practiceIcons[$practice] ?? 'fa-check' }} icon-primary"></i>
                                        <div class="fw-semibold">{{ $practice }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Ethical Description --}}
                @if($business->ethical_description)
                    <div class="mt-4">
                        <h4 class="text-white fw-bold mb-2">Ethical Description (Optional)</h4>
                        <p class="mb-0 mx-auto text-white" style="max-width: 700px;">
                            {{ $business->ethical_description }}
                        </p>
                    </div>
                @endif

            @else
                <div class="alert alert-light d-inline-block mx-auto mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    Ethics information not provided yet.
                </div>
            @endif

        </div>
    </section>



    <!-- CONTACT INFORMATION -->

    {{-- <section class="contact-card mt-4">
        <h4 class="fw-bold mb-4 featured-business "
                    style="
                        font-size: 34px;
                        text-transform: uppercase;
                        line-height: 1.3em;">
                    <span style=" font-weight: 300;">Contact </span>
                    <span style="color:#9b7d2d;font-weight: 900;">Information </span>
                </h4>
                <br>

        <div class="row g-3 pt-3" style="border-top: 1px solid var(--border-light);">
            <div class="col-md-4">
                <div class="info-item">
                    <i class="fas fa-user"></i>
                    <div>
                        <p class="info-label">Primary Contact</p>
                        <p class="mb-0" style="font-size: .9rem"> Name: <span class=""> {{ $business->business_contact_person_name ?? '——' }}</span></p>
                        <p class="mb-0" style="font-size: .9rem"> Contact: {{ $business->whatsapp_number ?? '——' }}</p>
                        <p class="mb-0" style="font-size: .9rem"> Email: {{ $business->email ?? '——' }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <p class="info-label mb-0">Social Media</p>
                        <div class="d-flex flex-wrap gap-2 pt-3" style="margin-left: -1rem;">
                            @if($business->whatsapp_number)
                                <a href="https://wa.me/{{ $business->whatsapp_number }}"
                                class="social-icon" target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            @endif
                            @if($business->facebook)
                                <a href="{{ $business->facebook }}" class="social-icon" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if($business->instagram)
                                <a href="{{ $business->instagram }}" class="social-icon" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($business->linkedin)
                                <a href="{{ $business->linkedin }}" class="social-icon" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-item">
                    <i class="fas fa-globe"></i>
                    <div>
                        <p class="info-label mb-0">Website</p>
                        @if($business->website)
                            <a href="{{ $business->website }}" target="_blank" class="info-value text-decoration-none">
                                {{ $business->website }}
                            </a>
                        @else
                            <p class="info-value mb-0">——</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
    </section> --}}
    <section class="contact-card mt-4">
        <h4 class="fw-bold mb-4 featured-business"
            style="font-size: 34px; text-transform: uppercase; line-height: 1.3em;">
            <span style="font-weight: 300;">Contact </span>
            <span style="color:#9b7d2d; font-weight: 900;">Information</span>
        </h4>

        <!-- Privacy Protected Notice -->
        <div class="privacy-notice mb-4">
            <div class="d-flex align-items-start">
                <i class="fas fa-shield-alt text-primary me-3" style="font-size: 2rem; color: #9C7D2D !important;"></i>
                <div>
                    <h5 class="fw-bold mb-2" style="color: #9C7D2D;"> Privacy Protected</h5>
                    <p class="mb-3 text-muted">
                        To ensure high-quality professional connections, this entrepreneur's direct contact details 
                        are available upon request.
                    </p>
                    <button type="button" class="btn btn-request-contact" data-bs-toggle="modal" data-bs-target="#contactRequestModal">
                        <i class="fas fa-user-check me-2"></i>
                        Request Contact Information
                    </button>
                </div>
            </div>
        </div>

        <div class="pt-3" style="border-top: 1px solid var(--border-light);">
            
            <!-- Row 1: Primary Contact - Name, Contact, Email in 3 columns -->
            <div class="row g-4 mb-4">
                <div class="col-md-12">
                    <div class="contact-section">
                        <h5 class="contact-heading">
                            <i class="fas fa-user me-2"></i>
                            Primary Contact
                        </h5>
                        <div class="contact-details">
                            <div class="contact-item">
                                 <p class="fw-bold mb-2" style="color: #9C7D2D;"> Privacy Protected</p>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <!-- Row 2: Social Media -->
            <div class="row g-4 mb-4">
                <div class="col-6">
                    <div class="contact-section">
                        <h5 class="contact-heading">
                            <i class="fas fa-share-alt me-2"></i>
                            Social Media
                        </h5>
                        <div class="contact-details">
                            @if($business->whatsapp_number || $business->facebook || $business->instagram || $business->linkedin)
                                <div class="social-links d-flex flex-wrap gap-2">
                                    @if($business->whatsapp_number)
                                        <a href="https://wa.me/{{ $business->whatsapp_number }}"
                                        class="social-icon" target="_blank" title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    @endif
                                    @if($business->facebook)
                                        <a href="{{ $business->facebook }}" class="social-icon" target="_blank" title="Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if($business->instagram)
                                        <a href="{{ $business->instagram }}" class="social-icon" target="_blank" title="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($business->linkedin)
                                        <a href="{{ $business->linkedin }}" class="social-icon" target="_blank" title="LinkedIn">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                </div>
                            @else
                                <p class="text-muted mb-0">Not Available</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="contact-section">
                        <h5 class="contact-heading">
                            <i class="fas fa-globe me-2"></i>
                            Website
                        </h5>
                        <div class="contact-details">
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" class="website-link">
                                    {{ $business->website }}
                                    <i class="fas fa-external-link-alt ms-2"></i>
                                </a>
                            @else
                                <p class="text-muted mb-0">Not Available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Request Modal -->
    <div class="modal fade" id="contactRequestModal" tabindex="-1" aria-labelledby="contactRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0" style="background: linear-gradient(135deg, #9C7D2D 0%, #7A6324 100%);">
                    <h5 class="modal-title text-white fw-bold" id="contactRequestModalLabel">
                        <i class="fas fa-user-check me-2"></i>
                        Request Contact Information
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('contact.request.submit') }}" method="POST" id="contactRequestForm">
                    @csrf
                    <input type="hidden" name="business_id" value="{{ $business->id }}">
                    
                    <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                        
                        <!-- Section 1: Your Profile -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: #9C7D2D;">
                                <i class="fas fa-user-circle me-2"></i>
                                1. Your Profile
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="full_name" required 
                                        placeholder="Enter your full name">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required 
                                        placeholder="your@email.com">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="phone" required 
                                        placeholder="+1234567890">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Company/Organization</label>
                                    <input type="text" class="form-control" name="company" 
                                        placeholder="Your company name">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Designation/Role</label>
                                    <input type="text" class="form-control" name="designation" 
                                        placeholder="Your job title">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Location <span class="text-danger">*</span></label>
                                    <select class="form-select" name="country" required>
                                        <option value="">Select Country</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Australia">Australia</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="India">India</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Purpose of Request -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: #9C7D2D;">
                                <i class="fas fa-bullseye me-2"></i>
                                2. Purpose of Request
                            </h6>
                            
                            <label class="form-label">Why do you wish to connect? <span class="text-danger">*</span></label>
                            <select class="form-select" name="purpose" required>
                                <option value="">Select Purpose</option>
                                <option value="Direct Business Inquiry">Direct Business Inquiry (Purchasing/Sales)</option>
                                <option value="Collaboration or Partnership">Collaboration or Partnership Proposal</option>
                                <option value="Investment Discussion">Investment Discussion</option>
                                <option value="Professional Networking">Professional Networking</option>
                                <option value="Media/Press Inquiry">Media/Press Inquiry</option>
                            </select>
                            
                            <div class="mt-3">
                                <label class="form-label">Additional Message (Optional)</label>
                                <textarea class="form-control" name="message" rows="3" 
                                        placeholder="Provide more details about your inquiry..."></textarea>
                            </div>
                        </div>

                        <!-- Section 3: Verification & Trust -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-3" style="color: #9C7D2D;">
                                <i class="fas fa-shield-check me-2"></i>
                                3. Verification & Trust
                            </h6>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="agreementCheck" 
                                    name="agreement" value="1" required>
                                <label class="form-check-label" for="agreementCheck">
                                    <strong>Agreement:</strong> I understand that my profile details will be shared 
                                    with the entrepreneur to facilitate this connection.
                                </label>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ethicsCheck" 
                                    name="ethics_pledge" value="1" required>
                                <label class="form-check-label" for="ethicsCheck">
                                    <strong>Ethics Pledge:</strong> I commit to using this information solely for 
                                    professional purposes and will not add this contact to any marketing mailing lists.
                                </label>
                            </div>
                        </div>

                        <!-- Privacy Notice -->
                        {{-- <div class="alert alert-info border-0 mb-0" style="background-color: #F5EFE0;">
                            <i class="fas fa-info-circle me-2" style="color: #9C7D2D;"></i>
                            <small>
                                Your information will be reviewed before being shared. The business owner will 
                                receive your request and may contact you directly.
                            </small>
                        </div> --}}

                    </div>
                    
                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-submit-request">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactRequestForm');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                const agreement = document.getElementById('agreementCheck');
                const ethics = document.getElementById('ethicsCheck');
                
                if (!agreement.checked || !ethics.checked) {
                    e.preventDefault();
                    alert('Please agree to both checkboxes before submitting.');
                    return false;
                }
            });
        }
    });
</script>
@endsection
