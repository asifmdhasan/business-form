@extends('layouts.frontend-master')

@section('content')
@php
    $countries = is_string($business->countries_of_operation)
        ? json_decode($business->countries_of_operation, true)
        : ($business->countries_of_operation ?? []);

    // $photos = is_string($business->photos)
    //     ? json_decode($business->photos, true)
    //     : ($business->photos ?? []);

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
    .hero-section {
        background-size: cover;
        background-position: center;
        border-radius: 1rem;
        padding: 5rem 4rem;
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

    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('https://www.transparenttextures.com/patterns/subtle-prism.png');
        opacity: 0.15;
        z-index: 1;
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

    .logo-box {
        width: 96px;
        height: 96px;
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

    /* Gallery */
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

<div class="container my-4">
    <!-- HERO SECTION -->
    <section class="hero-section" style="background-image: url('{{ $business->cover_photo ? asset('assets/'.$business->cover_photo) : 'https://images.unsplash.com/photo-1497366216548-37526070297c' }}');">
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
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <i class="fas fa-briefcase"></i>
                    <div>
                        <p class="info-label mb-0">Founder Designation</p>
                        @php
                            $founderDesignations = collect($founders)->pluck('designation')->filter()->implode(', ');
                        @endphp
                        <p class="info-value mb-0">{{ $founderDesignations ?: '—' }}
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
    @if($services->count())
        <section class="contact-card mt-4">
            <div class="text-start mb-4">
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
    @endif

    {{-- Collaboration Open --}}
    @if($business->collaboration_open === 'yes' || $business->collaboration_open === 'maybe')
        {{-- collaboration_types --}}
        <section class="about-card mt-4">
            <h4 class="fw-bold mb-4 featured-business "
                style="
                    font-size: 34px;
                    text-transform: uppercase;
                    line-height: 1.3em;">
                
                <span style="color:#9b7d2d;font-weight: 900;">{{ $business->business_name }}  </span>
                <span style=" font-weight: 300;"> Open for Collaboration </span>
            </h4>
            <p class="mb-3">This business is open to collaboration opportunities in the following areas:</p>
            @php
                $collaborationTypes = is_string($business->collaboration_types)
                    ? json_decode($business->collaboration_types, true)
                    : ($business->collaboration_types ?? []);
            @endphp
            <ul>
                @foreach($collaborationTypes as $type)
                    <li>{{ ucfirst(str_replace('_', ' ', $type)) }}</li>
                @endforeach
            </ul>
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
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge" style="background: rgba(155, 125, 45, 0.9); padding: 5px 10px; font-size: 11px; border-radius: 15px;">
                                            {{ $index + 1 }} / {{ $business->businessPhotos->count() }}
                                        </span>
                                    </div>
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
    <section class="faith-section">
        <div class="faith-content text-center">
            {{-- <i class="fas fa-shield-alt text-primary-custom" style="font-size: 2.5rem;"></i> --}}
            {{-- <h2 class="section-title mt-2">Faith-Compliant Business</h2> --}}
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
    </section>

    
    <!-- CONTACT INFORMATION -->
    <section class="contact-card mt-4">
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
                        {{-- <a href="mailto:{{ $business->email }}" class="info-value text-decoration-none">
                            {{ $business->email }}
                        </a> --}}
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

        
    </section>
</div>
@endsection
