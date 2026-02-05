@extends('layouts.master')

@section('content')
<style>
    :root {
        --primary-color: #576829;
        --secondary-color: #2C3E50;
        --text-muted: #7F8C8D;
        --border-color: #e0e0e0;
    }

    body {
        background-color: #F8F9FA;
    }

    .section-title {
        color: var(--primary-color);
        border-bottom: 3px solid var(--primary-color);
        padding-bottom: .5rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        font-size: 1.4rem;
        text-transform: uppercase;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .card-header {
        background: var(--primary-color) !important;
        color: white !important;
        font-weight: 600;
        font-size: 1.15rem;
        padding: 1rem 1.5rem;
        border: none;
    }

    .card-header.bg-warning {
        background: #f39c12 !important;
    }

    .card-header-ad {
        background: #9C7D2D  !important;
        color: white !important;
        font-weight: 600;
        font-size: 1.15rem;
        padding: 1rem 1.5rem;
        border: none;
    }

    .card-header-ad.bg-warning {
        background: #f39c12 !important;
    }

    .card-body {
        padding: 2rem;
        background: white;
    }

    .info-row {
        display: grid;
        grid-template-columns: 250px 20px 1fr;
        gap: 0.5rem;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
        align-items: start;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 0.95rem;
    }

    .info-separator {
        color: var(--primary-color);
        font-weight: 700;
        text-align: center;
    }

    .info-value {
        color: #333;
        word-wrap: break-word;
        font-size: 0.95rem;
    }

    .info-value a {
  
        text-decoration: none;
        transition: all 0.2s;
    }

    .info-value a:hover {
        text-decoration: underline;
        color: #3a4a1b;
    }

    .two-column-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .two-column-grid {
            grid-template-columns: 1fr;
        }
        
        .info-row {
            grid-template-columns: 200px 15px 1fr;
        }
    }

    .section-divider {
        background: #f8f9fa;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        margin: 1.5rem 0 1rem 0;
        font-weight: 600;
        color: var(--secondary-color);
        border-left: 4px solid var(--primary-color);
        font-size: 1.05rem;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-yes {
        background: #27ae60;
        color: white;
    }

    .badge-no {
        background: #e74c3c;
        color: white;
    }

    .badge-maybe {
        background: #f39c12;
        color: white;
    }

    .badge-partial {
        background: #3498db;
        color: white;
    }

    .image-gallery {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 0.5rem;
    }

    .image-preview {
        position: relative;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .image-preview:hover {
        transform: scale(1.05);
        border-color: var(--primary-color);
    }

    .image-preview img {
        display: block;
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
    }

    .founder-card {
        background: #f8f9fa;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 1.25rem;
        margin-bottom: 1rem;
    }

    .founder-name {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: #3a4a1b;
        transform: translateY(-1px);
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.625rem 0.75rem;
        transition: border-color 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(87, 104, 41, 0.15);
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .alert {
        border-radius: 8px;
        border: none;
    }

    .editable-section {
        background: #fff9e6;
        border: 2px dashed var(--primary-color);
        border-radius: 10px;
        padding: 1.5rem;
    }

    .editable-section-ad {
        background: #fff9e6; 
        border: 2px dashed #9C7D2D;
        border-radius: 10px;
        padding: 1.5rem;
    }


    .readonly-badge {
        display: inline-block;
        background: #e0e0e0;
        color: #666;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-left: 0.5rem;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #3a4a1b 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .page-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .text-empty {
        color: #999;
        font-style: italic;
    }
    .bg-primary {
        background-color: #576829 !important;
    }
</style>

<div class="container-fluid py-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fa fa-exclamation-triangle"></i> Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3>
                    <i class="fa fa-building"></i> {{ $business->business_name }}
                    {{-- <span class="readonly-badge">READ ONLY VIEW</span> --}}
                </h3>
                <p class="mb-0 mt-2" style="opacity: 0.9;">View business details and update verification status</p>
            </div>
            <a href="{{ route('gme-business-admin.index') }}" class="btn btn-light">
                <i class="fa fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <form action="{{ route('gme-business-admin.update', $business->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Hidden fields to pass validation --}}
        <input type="hidden" name="business_name" value="{{ $business->business_name }}">
        <input type="hidden" name="business_category_id" value="{{ $business->business_category_id }}">
        <input type="hidden" name="short_introduction" value="{{ $business->short_introduction }}">
        <input type="hidden" name="year_established" value="{{ $business->year_established }}">
        <input type="hidden" name="business_address" value="{{ $business->business_address }}">
        <input type="hidden" name="email" value="{{ $business->email }}">
        <input type="hidden" name="whatsapp_number" value="{{ $business->whatsapp_number }}">
        <input type="hidden" name="website" value="{{ $business->website }}">
        
        {{-- Social Media --}}
        <input type="hidden" name="facebook" value="{{ $business->facebook }}">
        <input type="hidden" name="instagram" value="{{ $business->instagram }}">
        <input type="hidden" name="linkedin" value="{{ $business->linkedin }}">
        <input type="hidden" name="youtube" value="{{ $business->youtube }}">
        <input type="hidden" name="online_store" value="{{ $business->online_store }}">
        
        {{-- Founders --}}
        @php
            $foundersData = is_array($business->founders)
                ? $business->founders
                : json_decode($business->founders ?? '[]', true);
        @endphp
        @if(is_array($foundersData) && count($foundersData) > 0)
            @foreach($foundersData as $index => $founder)
                <input type="hidden" name="founders[{{ $index }}][name]" value="{{ $founder['name'] ?? '' }}">
                <input type="hidden" name="founders[{{ $index }}][designation]" value="{{ $founder['designation'] ?? '' }}">
                <input type="hidden" name="founders[{{ $index }}][whatsapp_number]" value="{{ $founder['whatsapp_number'] ?? '' }}">
                <input type="hidden" name="founders[{{ $index }}][linkedin]" value="{{ $founder['linkedin'] ?? '' }}">
            @endforeach
        @endif
        
        {{-- Business Size --}}
        <input type="hidden" name="registration_status" value="{{ $business->registration_status }}">
        <input type="hidden" name="employee_count" value="{{ $business->employee_count }}">
        <input type="hidden" name="operational_scale" value="{{ $business->operational_scale }}">
        <input type="hidden" name="annual_revenue" value="{{ $business->annual_revenue }}">
        <input type="hidden" name="business_overview" value="{{ $business->business_overview }}">
        
        {{-- Services --}}
        @php
            $serviceIds = is_array($business->services_id)
                ? $business->services_id
                : json_decode($business->services_id ?? '[]', true);
        @endphp
        @if(is_array($serviceIds) && count($serviceIds) > 0)
            @foreach($serviceIds as $serviceId)
                <input type="hidden" name="services_id[]" value="{{ $serviceId }}">
            @endforeach
        @endif
        
        {{-- Countries --}}
        @php
            $countries = is_array($business->countries_of_operation)
                ? $business->countries_of_operation
                : json_decode($business->countries_of_operation ?? '[]', true);
        @endphp
        @if(is_array($countries) && count($countries) > 0)
            @foreach($countries as $country)
                <input type="hidden" name="countries_of_operation[]" value="{{ $country }}">
            @endforeach
        @endif
        
        {{-- Ethics --}}
        <input type="hidden" name="avoid_riba" value="{{ $business->avoid_riba }}">
        <input type="hidden" name="avoid_haram_products" value="{{ $business->avoid_haram_products }}">
        <input type="hidden" name="fair_pricing" value="{{ $business->fair_pricing }}">
        <input type="hidden" name="ethical_description" value="{{ $business->ethical_description }}">
        <input type="hidden" name="open_for_guidance" value="{{ $business->open_for_guidance }}">
        
        {{-- Collaboration --}}
        <input type="hidden" name="collaboration_open" value="{{ $business->collaboration_open }}">
        @php
            $collaborationTypesData = is_array($business->collaboration_types)
                ? $business->collaboration_types
                : json_decode($business->collaboration_types ?? '[]', true);
        @endphp
        @if(is_array($collaborationTypesData) && count($collaborationTypesData) > 0)
            @foreach($collaborationTypesData as $type)
                <input type="hidden" name="collaboration_types[]" value="{{ $type }}">
            @endforeach
        @endif

        {{-- Business Identity --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-building"></i> Business Identity
            </div>
            <div class="card-body">
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Business Name</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->business_name }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Category</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->category->name ?? '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Year Established</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->year_established ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Countries of Operation</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $countriesDisplay = is_array($business->countries_of_operation)
                                        ? $business->countries_of_operation
                                        : json_decode($business->countries_of_operation ?? '[]', true);
                                @endphp
                                {{ is_array($countriesDisplay) && count($countriesDisplay) > 0 ? implode(', ', $countriesDisplay) : '-' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="info-row">
                            <div class="info-label">Website</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->website)
                                    <a href="{{ $business->website }}" target="_blank">{{ $business->website }}</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Email</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->email)
                                    <a href="mailto:{{ $business->email }}">{{ $business->email }}</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Contact Person Number</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->whatsapp_number ?: '-' }}</div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Business Address</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->business_address ?: '-' }}</div>
                        </div>
                    </div>
                </div>

                @if($business->short_introduction)
                <div class="section-divider mt-3">
                    <i class="fa fa-info-circle"></i> Short Introduction
                </div>
                <div class="info-value" style="padding: 0 0.5rem;">
                    {{ $business->short_introduction }}
                </div>
                @endif

                <div class="section-divider">
                    <i class="fa fa-share-alt"></i> Social Media Links
                </div>
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Facebook</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->facebook)
                                    <a href="{{ $business->facebook }}" target="_blank">View Profile</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Instagram</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->instagram)
                                    <a href="{{ $business->instagram }}" target="_blank">View Profile</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">LinkedIn</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->linkedin)
                                    <a href="{{ $business->linkedin }}" target="_blank">View Profile</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="info-row">
                            <div class="info-label">YouTube</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->youtube)
                                    <a href="{{ $business->youtube }}" target="_blank">View Channel</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Online Store</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->online_store)
                                    <a href="{{ $business->online_store }}" target="_blank">Visit Store</a>
                                @else
                                    <span class="text-empty">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider">
                    <i class="fa fa-users"></i> Founder & Contact Information
                </div>
                @php
                    $founders = is_array($business->founders)
                        ? $business->founders
                        : json_decode($business->founders ?? '[]', true);
                @endphp

                @if(is_array($founders) && count($founders) > 0)
                    @foreach($founders as $founder)
                        <div class="founder-card">
                            <div class="founder-name">{{ $founder['name'] ?? 'N/A' }}</div>
                            <div class="two-column-grid" style="gap: 0.5rem;">
                                <div class="info-row" style="border: none; padding: 0.25rem 0;">
                                    <div class="info-label">Designation</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $founder['designation'] ?? '-' }}</div>
                                </div>
                                <div class="info-row" style="border: none; padding: 0.25rem 0;">
                                    <div class="info-label">WhatsApp</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">{{ $founder['whatsapp_number'] ?? '-' }}</div>
                                </div>
                                <div class="info-row" style="border: none; padding: 0.25rem 0;">
                                    <div class="info-label">LinkedIn</div>
                                    <div class="info-separator">:</div>
                                    <div class="info-value">
                                        @if(!empty($founder['linkedin']))
                                            <a href="{{ $founder['linkedin'] }}" target="_blank">View Profile</a>
                                        @else
                                            <span class="text-empty">-</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-muted">No founder information available</div>
                @endif
            </div>
        </div>

        {{-- Business Size & Structure --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-chart-line"></i> Business Size & Structure
            </div>
            <div class="card-body">
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Registration Status</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                {{ ucwords(str_replace('_', ' ', $business->registration_status ?? '-')) }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Employee Count</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->employee_count ?: '-' }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="info-row">
                            <div class="info-label">Operational Scale</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                {{ ucwords(str_replace('_', ' ', $business->operational_scale ?? '-')) }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">Annual Revenue</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->annual_revenue ?: '-' }}</div>
                        </div>
                    </div>
                </div>

                @if($business->business_overview)
                    <div class="section-divider">
                        <i class="fa fa-align-left"></i> Business Overview
                    </div>
                    <div class="info-value" style="padding: 0 0.5rem;">
                        {{ $business->business_overview }}
                    </div>
                @endif
                @if($business->services && $business->services->count() > 0)
                    <div class="section-divider">
                        <i class="fa fa-briefcase"></i> Products / Services
                    </div>
                    <div style="padding: 0 0.5rem;">
                        @foreach($business->services as $service)
                            <span class="badge bg-secondary me-2 mb-2">{{ $service->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Media & Documents --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-image"></i> Business Media & Documents
            </div>
            <div class="card-body">
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Logo</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $logoPath = $business->getRawOriginal('logo');
                                    $logoPath = is_string($logoPath) ? str_replace(['\\/', '\\'], '/', $logoPath) : $logoPath;
                                @endphp
                                @if($logoPath)
                                    <div class="image-preview">
                                        <a href="{{ asset('assets/' . $logoPath) }}" target="_blank">
                                            <img src="{{ asset('assets/' . $logoPath) }}" alt="Logo">
                                        </a>
                                    </div>
                                @else
                                    <span class="text-empty">No logo uploaded</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Cover Photo</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $coverPath = $business->getRawOriginal('cover_photo');
                                    $coverPath = is_string($coverPath) ? str_replace(['\\/', '\\'], '/', $coverPath) : $coverPath;
                                @endphp
                                @if($coverPath)
                                    <div class="image-preview">
                                        <a href="{{ asset('assets/' . $coverPath) }}" target="_blank">
                                            <img src="{{ asset('assets/' . $coverPath) }}" alt="Cover">
                                        </a>
                                    </div>
                                @else
                                    <span class="text-empty">No cover photo uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="info-row">
                            <div class="info-label">Registration Document</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->registration_document)
                                    <a href="{{ asset('assets/' . $business->registration_document) }}" 
                                       target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fa fa-file-pdf"></i> View Document
                                    </a>
                                @else
                                    <span class="text-empty">Not uploaded</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Business Profile</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->business_profile)
                                    <a href="{{ asset('assets/' . $business->business_profile) }}" 
                                       target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fa fa-file"></i> View File
                                    </a>
                                @else
                                    <span class="text-empty">Not uploaded</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Product Catalogue</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @if($business->product_catalogue)
                                    <a href="{{ asset('assets/' . $business->product_catalogue) }}" 
                                       target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fa fa-file"></i> View File
                                    </a>
                                @else
                                    <span class="text-empty">Not uploaded</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($business->businessPhotos->count() > 0)
                <div class="section-divider">
                    <i class="fa fa-images"></i> Business Photos Gallery
                </div>
                <div class="image-gallery">
                    @foreach($business->businessPhotos as $photo)
                        <div class="image-preview">
                            <a href="{{ asset('assets/' . $photo->image_url) }}" target="_blank">
                                <img src="{{ asset('assets/' . $photo->image_url) }}" alt="Business Photo">
                            </a>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Ethics & Collaboration --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-handshake"></i> Ethics & Collaboration
            </div>
            <div class="card-body">
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Avoid Interest (Riba)</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $badgeClass = match($business->avoid_riba) {
                                        'yes' => 'badge-yes',
                                        'no' => 'badge-no',
                                        'partially_transitioning' => 'badge-partial',
                                        default => 'badge-maybe'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucwords(str_replace('_', ' ', $business->avoid_riba ?? '-')) }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Avoid Haram Products</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $badgeClass = match($business->avoid_haram_products) {
                                        'yes' => 'badge-yes',
                                        'no' => 'badge-no',
                                        'partially_compliant' => 'badge-partial',
                                        default => 'badge-maybe'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucwords(str_replace('_', ' ', $business->avoid_haram_products ?? '-')) }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Fair Pricing</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $badgeClass = match($business->fair_pricing) {
                                        'yes' => 'badge-yes',
                                        'mostly' => 'badge-partial',
                                        'needs_improvement' => 'badge-no',
                                        default => 'badge-maybe'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucwords(str_replace('_', ' ', $business->fair_pricing ?? '-')) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="info-row">
                            <div class="info-label">Open for Guidance</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $badgeClass = match($business->open_for_guidance) {
                                        'yes' => 'badge-yes',
                                        'no' => 'badge-no',
                                        default => 'badge-maybe'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($business->open_for_guidance ?? '-') }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Collaboration Open</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                @php
                                    $badgeClass = match($business->collaboration_open) {
                                        'yes' => 'badge-yes',
                                        'no' => 'badge-no',
                                        default => 'badge-maybe'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($business->collaboration_open ?? '-') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $collaborationTypes = is_array($business->collaboration_types ?? null)
                        ? $business->collaboration_types
                        : json_decode($business->collaboration_types ?? '[]', true);
                @endphp

                @if(is_array($collaborationTypes) && count($collaborationTypes) > 0)
                <div class="section-divider">
                    <i class="fa fa-handshake"></i> Collaboration Interests
                </div>
                <div style="padding: 0 0.5rem;">
                    @foreach($collaborationTypes as $type)
                        <span class="badge bg-primary me-2 mb-2">{{ $type }}</span>
                    @endforeach
                </div>
                @endif

                @if($business->ethical_description)
                <div class="section-divider">
                    <i class="fa fa-align-left"></i> Ethical Description
                </div>
                <div class="info-value" style="padding: 0 0.5rem;">
                    {{ $business->ethical_description }}
                </div>
                @endif
            </div>
        </div>

        {{-- Consent & Approval --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-check-circle"></i> Consent & Approval
            </div>
            <div class="card-body">
                <div class="two-column-grid">
                    <div>
                        <div class="info-row">
                            <div class="info-label">Info Accuracy</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                <span class="badge {{ $business->info_accuracy ? 'badge-yes' : 'badge-no' }}">
                                    {{ $business->info_accuracy ? 'Confirmed' : 'Not Confirmed' }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Allow Publish</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                <span class="badge {{ $business->allow_publish ? 'badge-yes' : 'badge-no' }}">
                                    {{ $business->allow_publish ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="info-row">
                            <div class="info-label">Allow Contact</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">
                                <span class="badge {{ $business->allow_contact ? 'badge-yes' : 'badge-no' }}">
                                    {{ $business->allow_contact ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Digital Signature</div>
                            <div class="info-separator">:</div>
                            <div class="info-value">{{ $business->digital_signature ?: '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- EDITABLE SECTION - Admin Controls --}}
        <div class="card">
            <div class="card-header-ad">
                <i class="fa fa-edit"></i> Admin Controls - EDITABLE SECTION
            </div>
            <div class="card-body editable-section-ad">
                <div class="alert alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> <strong>Note:</strong> Only the fields in this section can be modified. All other information is read-only.
                </div>

                <div class="row">
                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label fw-bold">
                            <i class="fa fa-check-circle"></i> GME Verified
                        </label>
                        <div class="form-check form-switch" style="padding-left: 2.5rem;">
                            <input type="checkbox" 
                                   name="is_verified" 
                                   value="1" 
                                   class="form-check-input" 
                                   id="is_verified"
                                   style="width: 3rem; height: 1.5rem; cursor: pointer;"
                                   {{ old('is_verified', $business->is_verified) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_verified" style="margin-left: 0.5rem; cursor: pointer;">
                                Mark as verified
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label fw-bold">
                            <i class="fa fa-star"></i> Featured Business
                        </label>
                        <div class="form-check form-switch" style="padding-left: 2.5rem;">
                            <input type="checkbox" 
                                   name="is_featured" 
                                   value="1" 
                                   class="form-check-input" 
                                   id="is_featured"
                                   style="width: 3rem; height: 1.5rem; cursor: pointer;"
                                   {{ old('is_featured', $business->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured" style="margin-left: 0.5rem; cursor: pointer;">
                                Mark as featured
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label fw-bold">
                            <i class="fa fa-cog"></i> Business Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-select" required>
                            <option value="draft" {{ old('status', $business->status) == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>
                            <option value="pending" {{ old('status', $business->status) == 'pending' ? 'selected' : '' }}>
                                Pending Review
                            </option>
                            <option value="approved" {{ old('status', $business->status) == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="rejected" {{ old('status', $business->status) == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Update Status
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection