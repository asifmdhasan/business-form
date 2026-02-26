@extends('layouts.master')

@section('content')
<style>
    :root {
        --gold: #9C7D2D;
        --secondary-color: #2C3E50;
        --text-muted: #7F8C8D;
    }

    body {
        background-color: #F8F9FA;
    }

    .section-title {
        color: var(--gold);
        border-bottom: 2px solid var(--gold);
        padding-bottom: .5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 1.5rem;
    }

    .card-header {
        background: var(--gold) !important;
        color: white !important;
        border-radius: 12px 12px 0 0 !important;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 1rem 1.25rem;
    }

    .card-header.bg-info {
        background: #17a2b8 !important;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.625rem 0.75rem;
        transition: border-color 0.2s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 0.2rem rgba(156, 125, 45, 0.15);
    }

    textarea.form-control {
        resize: vertical;
    }

    .btn-primary {
        background: var(--gold);
        border: none;
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background: #806522;
        transform: translateY(-1px);
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
    }

    .btn-danger {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
    }

    .question-label {
        display: inline-block;
        width: 220px;
        margin-bottom: 0;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .btn-outline-secondary {
        min-width: 140px;
        text-align: center;
        border-radius: 8px;
        border: 2px solid #ddd;
        transition: all 0.2s;
    }

    .btn-outline-secondary:hover {
        border-color: var(--gold);
        background: rgba(156, 125, 45, 0.1);
    }

    .btn-outline-secondary.active {
        background: var(--gold);
        border-color: var(--gold);
        color: white;
    }

    .founder-row {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        border: 1px solid #e9ecef;
    }

    .founder-row hr {
        margin: 1rem 0;
        opacity: 0.5;
    }

    #pageLoader {
        transition: opacity 0.2s ease;
    }

    .image-preview-wrapper {
        position: relative;
        display: inline-block;
        margin-top: 0.5rem;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 0.25rem;
    }

    .image-preview-wrapper:hover .image-overlay {
        opacity: 1;
    }

    .view-image-btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        white-space: nowrap;
    }

    .view-image-btn:hover {
        transform: scale(1.05);
    }

    .form-check-input:checked {
        background-color: var(--gold);
        border-color: var(--gold);
    }

    .alert {
        border-radius: 8px;
        border: none;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .info-section-header {
        background: #f8f9fa;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        margin: 1.5rem 0 1rem 0;
        font-weight: 600;
        color: var(--secondary-color);
        border-left: 4px solid var(--gold);
    }
</style>

<div class="container-fluid py-4">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-uppercase mb-0" style="color: var(--secondary-color);">
            Edit Business: <span style="color: var(--gold);">{{ $business->business_name }}</span>
        </h3>
        <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to List
        </a>
    </div>

    <form action="{{ route('gme-business-admin.update', $business->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Step 1: Business Identity --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-building"></i> Step 1: Business Identity
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Business Name <span class="text-danger">*</span></label>
                        <input type="text" name="business_name" class="form-control" 
                               value="{{ old('business_name', $business->business_name) }}" required>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Year Established</label>
                        <input type="text" name="year_established" class="form-control" 
                               value="{{ old('year_established', $business->year_established) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Business Category</label>
                        <select name="business_category_id" class="form-control @error('business_category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('business_category_id', $business->business_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('business_category_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Countries of Operation <span class="text-danger">*</span></label>
                        @php
                            $savedCountries = old(
                                'countries_of_operation',
                                is_array($business->countries_of_operation)
                                    ? $business->countries_of_operation
                                    : (is_string($business->countries_of_operation)
                                        ? json_decode($business->countries_of_operation, true)
                                        : [])
                            );
                        @endphp
                        <select class="form-select search_select" name="countries_of_operation[]" multiple required>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ in_array($country, $savedCountries) ? 'selected' : '' }}>
                                    {{ $country }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Short Introduction</label>
                        <textarea name="short_introduction" class="form-control" rows="2">{{ old('short_introduction', $business->short_introduction) }}</textarea>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Business Address</label>
                        <textarea name="business_address" class="form-control" rows="2">{{ old('business_address', $business->business_address) }}</textarea>
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ old('email', $business->email) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Website</label>
                        <input type="text" name="website" class="form-control" 
                               value="{{ old('website', $business->website) }}">
                    </div>
                </div>

                <div class="info-section-header">
                    <i class="fa fa-share-alt"></i> Social Media Links
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Facebook</label>
                        <input type="string" name="facebook" class="form-control" 
                               value="{{ old('facebook', $business->facebook) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Instagram</label>
                        <input type="string" name="instagram" class="form-control" 
                               value="{{ old('instagram', $business->instagram) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">LinkedIn</label>
                        <input type="string" name="linkedin" class="form-control" 
                               value="{{ old('linkedin', $business->linkedin) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">YouTube</label>
                        <input type="string" name="youtube" class="form-control" 
                               value="{{ old('youtube', $business->youtube) }}">
                    </div>

                    <div class="col-md-6 form-group mb-3">
                        <label class="form-label">Online Store</label>
                        <input type="string" name="online_store" class="form-control" 
                               value="{{ old('online_store', $business->online_store) }}">
                    </div>
                </div>

                <div class="info-section-header">
                    <i class="fa fa-users"></i> Founder & Contact Information
                </div>

                <div id="founders-container">
                    @php
                        $founders = old(
                            'founders',
                            is_array($business->founders)
                                ? $business->founders
                                : (is_string($business->founders)
                                    ? json_decode($business->founders, true)
                                    : [])
                        );
                    @endphp

                    @if(count($founders) > 0)
                        @foreach($founders as $index => $founder)
                        <div class="founder-row">
                            <div class="row">
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="founders[{{ $index }}][name]" class="form-control" 
                                           value="{{ old("founders.$index.name", $founder['name'] ?? '') }}" required>
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="founders[{{ $index }}][designation]" class="form-control" 
                                           value="{{ old("founders.$index.designation", $founder['designation'] ?? '') }}">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" name="founders[{{ $index }}][whatsapp]" class="form-control" 
                                           value="{{ old("founders.$index.whatsapp", $founder['whatsapp'] ?? '') }}">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="string" name="founders[{{ $index }}][linkedin]" class="form-control" 
                                           value="{{ old("founders.$index.linkedin", $founder['linkedin'] ?? '') }}">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-sm remove-founder">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="founder-row">
                            <div class="row">
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="founders[0][name]" class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="founders[0][designation]" class="form-control">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="text" name="founders[0][whatsapp]" class="form-control">
                                </div>
                                <div class="col-md-3 form-group mb-3">
                                    <label class="form-label">LinkedIn</label>
                                    <input type="url" name="founders[0][linkedin]" class="form-control">
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-sm remove-founder">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" id="add-founder" class="btn btn-primary mt-2">
                    <i class="fa fa-plus"></i> Add Founder
                </button>
            </div>
        </div>

        {{-- Step 2: Business Size, Structure, Description & Files --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-chart-line"></i> Step 2: Business Size, Structure, Description & Files
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label">Registration Status</label>
                        <select name="registration_status" class="form-control">
                            @php
                                $registrationStatuses = [
                                    'registered_company' => 'Registered Company',
                                    'sole_proprietorship' => 'Sole Proprietorship',
                                    'partnership' => 'Partnership',
                                    'startup_early_stage' => 'Startup (Early Stage)',
                                    'home_based' => 'Home Based',
                                    'not_registered_yet' => 'Not Registered Yet'
                                ];
                            @endphp
                            @foreach($registrationStatuses as $key => $label)
                                <option value="{{ $key }}" {{ old('registration_status', $business->registration_status) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label">Employee Count</label>
                        <select name="employee_count" class="form-control">
                            @php $employeeCounts = ['1-3','4-10','11-25','26-50','51+']; @endphp
                            @foreach($employeeCounts as $count)
                                <option value="{{ $count }}" {{ old('employee_count', $business->employee_count) == $count ? 'selected' : '' }}>
                                    {{ $count }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label">Operational Scale</label>
                        <select name="operational_scale" class="form-control">
                            @php $operationalScales = ['local','nationwide','international','online_only','hybrid']; @endphp
                            @foreach($operationalScales as $scale)
                                <option value="{{ $scale }}" {{ old('operational_scale', $business->operational_scale) == $scale ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_',' ',$scale)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 form-group mb-3">
                        <label class="form-label">Annual Revenue</label>
                        <select name="annual_revenue" class="form-control">
                            @php
                                $annualRevenues = [
                                    'under_10k'=>'Under 10k',
                                    '10k-50k'=>'10k-50k',
                                    '50k-200k'=>'50k-200k',
                                    '200k-1m'=>'200k-1m',
                                    'above_1m'=>'Above 1m'
                                ];
                            @endphp
                            @foreach($annualRevenues as $key => $label)
                                <option value="{{ $key }}" {{ old('annual_revenue', $business->annual_revenue) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 form-group mb-3">
                        <label class="form-label">Business Overview</label>
                        <textarea name="business_overview" class="form-control" rows="4">{{ old('business_overview', $business->business_overview) }}</textarea>
                    </div>

                    @php
                        $savedServices = old('services_id',
                            is_array($business->services_id ?? null)
                                ? $business->services_id
                                : json_decode($business->services_id ?? '[]', true)
                        );
                    @endphp

                    <div class="col-md-12 form-group mb-3">
                        <label class="form-label">Products / Services</label>
                        <select class="form-select search_select @error('services_id') is-invalid @enderror"
                                multiple name="services_id[]" id="services">
                        </select>
                    </div>
                </div>

                <div class="info-section-header mt-4">
                    <i class="fa fa-image"></i> Business Media & Documents
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label">Logo</label>
                                <div class="mb-2 position-relative image-preview-wrapper">
                                    @php
                                        $logoPath = $business->getRawOriginal('logo');
                                        $logoPath = is_string($logoPath) ? str_replace(['\\/', '\\'], '/', $logoPath) : $logoPath;
                                    @endphp

                                    @if($logoPath)
                                        <img id="logoPreview"
                                            src="{{ asset('assets/' . $logoPath) }}"
                                            class="img-thumbnail"
                                            style="max-width:120px; max-height:120px; object-fit: cover;"
                                            alt="Business Logo">
                                        <div class="image-overlay">
                                            <a href="{{ asset('assets/' . $logoPath) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary view-image-btn">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </div>
                                    @else
                                        <img id="logoPreview"
                                            src=""
                                            class="img-thumbnail d-none"
                                            style="max-width:120px; max-height:120px; object-fit: cover;">
                                        <div class="text-muted small">No logo uploaded</div>
                                    @endif
                                </div>
                                <input type="file"
                                    name="logo"
                                    class="form-control"
                                    accept="image/*"
                                    onchange="previewImage(this, 'logoPreview')">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label class="form-label">Cover Photo</label>
                                <div class="mb-2 position-relative image-preview-wrapper">
                                    @php
                                        $coverPath = $business->getRawOriginal('cover_photo');
                                        $coverPath = is_string($coverPath) ? str_replace(['\\/', '\\'], '/', $coverPath) : $coverPath;
                                    @endphp

                                    @if($coverPath)
                                        <img id="coverPreview"
                                            src="{{ asset('assets/' . $coverPath) }}"
                                            class="img-thumbnail"
                                            style="max-width:120px; max-height:120px; object-fit: cover;"
                                            alt="Cover Photo">
                                        <div class="image-overlay">
                                            <a href="{{ asset('assets/' . $coverPath) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary view-image-btn">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </div>
                                    @else
                                        <img id="coverPreview"
                                            src=""
                                            class="img-thumbnail d-none"
                                            style="max-width:120px; max-height:120px; object-fit: cover;">
                                        <div class="text-muted small">No cover photo uploaded</div>
                                    @endif
                                </div>
                                <input type="file"
                                    name="cover_photo"
                                    class="form-control"
                                    accept="image/*"
                                    onchange="previewImage(this, 'coverPreview')">
                            </div>
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Business Photos</label>
                            <div class="mb-2 d-flex flex-wrap gap-2" id="photosPreview">
                                @if($business->businessPhotos->count())
                                    @foreach($business->businessPhotos as $index => $photo)
                                        <input type="hidden" name="existing_photos[]" value="{{ $photo->id }}">
                                        <div class="position-relative image-preview-wrapper">
                                            <img src="{{ asset('assets/' . $photo->image_url) }}"
                                                class="img-thumbnail"
                                                style="max-width:100px; max-height:100px; object-fit: cover;">
                                            <div class="image-overlay">
                                                <a href="{{ asset('assets/' . $photo->image_url) }}"
                                                target="_blank"
                                                class="btn btn-sm btn-primary">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-muted small">No photos uploaded</div>
                                @endif
                            </div>
                            <input type="file"
                                name="photos[]"
                                class="form-control"
                                multiple
                                accept="image/*"
                                onchange="previewMultipleImages(this, 'photosPreview')">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Registration Document</label>
                            <div class="mb-2">
                                @if($business->registration_document)
                                    <a href="{{ asset('assets/' . $business->registration_document) }}" 
                                       target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-file-pdf"></i> View Document
                                    </a>
                                @endif
                            </div>
                            <input type="file" name="registration_document" class="form-control">
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Business Profile</label>
                            <div class="mb-2">
                                @if($business->business_profile)
                                    <a href="{{ asset('assets/' . $business->business_profile) }}" 
                                       target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-file"></i> View File
                                    </a>
                                @endif
                            </div>
                            <input type="file" name="business_profile" class="form-control">
                        </div>

                        <div class="col-md-12 form-group mb-3">
                            <label class="form-label">Product Catalogue</label>
                            <div class="mb-2">
                                @if($business->product_catalogue)
                                    <a href="{{ asset('assets/' . $business->product_catalogue) }}" 
                                       target="_blank" class="btn btn-info btn-sm">
                                        <i class="fa fa-file"></i> View File
                                    </a>
                                @endif
                            </div>
                            <input type="file" name="product_catalogue" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 3: Ethics & Collaboration --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-handshake"></i> Step 3: Ethics & Collaboration
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-4">
                            <label class="form-label question-label">Avoid Interest (Riba)? <span class="text-danger">*</span></label>
                            @php $value = old('avoid_riba', $business->avoid_riba ?? ''); @endphp
                            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                @foreach([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                    'partially_transitioning' => 'Partially Transitioning',
                                    'prefer_not_to_say' => 'Prefer Not to Say'
                                ] as $key => $label)
                                    <label class="btn btn-outline-secondary {{ $value === $key ? 'active' : '' }}">
                                        <input type="radio" name="avoid_riba" value="{{ $key }}" autocomplete="off" 
                                               {{ $value === $key ? 'checked' : '' }}> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label question-label">Avoid Haram Products? <span class="text-danger">*</span></label>
                            @php $value = old('avoid_haram_products', $business->avoid_haram_products ?? ''); @endphp
                            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                @foreach([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                    'partially_compliant' => 'Partially Compliant',
                                ] as $key => $label)
                                    <label class="btn btn-outline-secondary {{ $value === $key ? 'active' : '' }}">
                                        <input type="radio" name="avoid_haram_products" value="{{ $key }}" autocomplete="off" 
                                               {{ $value === $key ? 'checked' : '' }}> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label question-label">Fair Pricing <span class="text-danger">*</span></label>
                            @php $value = old('fair_pricing', $business->fair_pricing ?? ''); @endphp
                            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                @foreach([
                                    'yes' => 'Yes',
                                    'mostly' => 'Mostly',
                                    'needs_improvement' => 'Needs Improvement'
                                ] as $key => $label)
                                    <label class="btn btn-outline-secondary {{ $value === $key ? 'active' : '' }}">
                                        <input type="radio" name="fair_pricing" value="{{ $key }}" autocomplete="off" 
                                               {{ $value === $key ? 'checked' : '' }}> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label question-label">Open for Guidance <span class="text-danger">*</span></label>
                            @php $value = old('open_for_guidance', $business->open_for_guidance ?? ''); @endphp
                            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                @foreach([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                    'maybe' => 'Maybe'
                                ] as $key => $label)
                                    <label class="btn btn-outline-secondary {{ $value === $key ? 'active' : '' }}">
                                        <input type="radio" name="open_for_guidance" value="{{ $key }}" autocomplete="off" 
                                               {{ $value === $key ? 'checked' : '' }}> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label question-label">Collaboration Open <span class="text-danger">*</span></label>
                            @php $value = old('collaboration_open', $business->collaboration_open ?? ''); @endphp
                            <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                @foreach([
                                    'yes' => 'Yes',
                                    'no' => 'No',
                                    'maybe' => 'Maybe'
                                ] as $key => $label)
                                    <label class="btn btn-outline-secondary {{ $value === $key ? 'active' : '' }}">
                                        <input type="radio" name="collaboration_open" value="{{ $key }}" autocomplete="off" 
                                               {{ $value === $key ? 'checked' : '' }}> {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div style="background: #f8f9fa; padding: 1.25rem; border-radius: 8px; border-left: 4px solid var(--gold);">
                            <h6 class="mb-3" style="color: var(--secondary-color); font-weight: 600;">
                                <i class="fa fa-handshake"></i> Collaboration Interest
                            </h6>
                            @php
                                $savedCollaborationTypes = old('collaboration_types',
                                    is_array($business->collaboration_types ?? null)
                                        ? $business->collaboration_types
                                        : json_decode($business->collaboration_types ?? '[]', true)
                                );
                            @endphp

                            @foreach(['Partnerships','Investment Oportunities','Vendor Supply Chain','Marketing Promotion','Networking','Mentorship or Growth Coaching','Community Charity Projects','Not Sure Yet'] as $type)
                                <div class="form-check mb-2">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="collaboration_types[]"
                                        value="{{ $type }}"
                                        id="collab_{{ str_replace(' ', '_', $type) }}"
                                        {{ in_array($type, $savedCollaborationTypes) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="collab_{{ str_replace(' ', '_', $type) }}">
                                        {{ $type }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12 form-group mt-4">
                        <label class="form-label">Ethical Description</label>
                        <textarea name="ethical_description" class="form-control" rows="4">{{ old('ethical_description', $business->ethical_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 4: Consent & Approval --}}
        <div class="card">
            <div class="card-header">
                <i class="fa fa-check-circle"></i> Step 4: Consent & Approval
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="info_accuracy" value="1" class="form-check-input" id="info_accuracy"
                                {{ old('info_accuracy', $business->info_accuracy) ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="info_accuracy">
                                Info Accuracy
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="allow_publish" value="1" class="form-check-input" id="allow_publish"
                                {{ old('allow_publish', $business->allow_publish) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="allow_publish">
                                Allow Publish (Yes/No)
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="allow_contact" value="1" class="form-check-input" id="allow_contact"
                                {{ old('allow_contact', $business->allow_contact) ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="allow_contact">
                                Allow Contact 
                            </label>
                        </div>
                    </div>

                    <div class="col-md-12 form-group mt-3">
                        <label class="form-label">Digital Signature (Full Name + Date)</label>
                        <input type="text" name="digital_signature" class="form-control"
                            value="{{ old('digital_signature', $business->digital_signature) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Step 5: Status - Admin Only --}}
<div class="card">
    <div class="card-header bg-info">
        <i class="fa fa-cog"></i> Step 5: Status - Admin Only
    </div>
    <div class="card-body">
        <div class="alert alert-warning">
            @if($business->updatedBy)
                <span>Last Updated By: <strong>{{ $business->updatedBy->name }}</strong></span>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3 form-group mb-3">
                <div class="form-check pt-2">
                    {{-- ❌ REMOVE THIS: <input type="hidden" name="is_verified" value="0"> --}}
                    <input type="checkbox" name="is_verified" value="1" class="form-check-input" id="is_verified"
                        {{ old('is_verified', $business->is_verified) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_verified">
                        <i class="fa fa-check-circle"></i> GME Verified
                    </label>
                </div>
            </div>

            <div class="col-md-3 form-group mb-3">
                <div class="form-check pt-2">
                    {{-- ❌ REMOVE THIS: <input type="hidden" name="is_featured" value="0"> --}}
                    <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured"
                        {{ old('is_featured', $business->is_featured) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_featured">
                        <i class="fa fa-star"></i> Featured Business
                    </label>
                </div>
            </div>

            <div class="col-md-4 form-group">
                <label class="form-label">Business Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ old('status', $business->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $business->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status', $business->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="request_for_delete" {{ old('status', $business->status) == 'request_for_delete' ? 'selected' : '' }}>Request for Delete</option>
                </select>
            </div>
        </div>
    </div>
</div>

        <div class="d-flex justify-content-end gap-2 mb-5">
            <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">
                <i class="fa fa-times"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Update Business
            </button>
        </div>
    </form>
</div>

<!-- Global Loader -->
<div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-none"
     style="background: rgba(255,255,255,0.9); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem; color: var(--gold) !important;"></div>
            <div class="fw-semibold" style="color: var(--secondary-color);">Please wait, updating business...</div>
        </div>
    </div>
</div>

{{-- JS for dynamic founder fields --}}
<script>
    let founderIndex = {{ count($founders) }};

    document.getElementById('add-founder').addEventListener('click', function() {
        const container = document.getElementById('founders-container');
        const row = document.createElement('div');
        row.classList.add('founder-row');
        row.innerHTML = `
            <div class="row">
                <div class="col-md-3 form-group mb-3">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="founders[${founderIndex}][name]" class="form-control" required>
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label class="form-label">Designation</label>
                    <input type="text" name="founders[${founderIndex}][designation]" class="form-control">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label class="form-label">WhatsApp</label>
                    <input type="text" name="founders[${founderIndex}][whatsapp]" class="form-control">
                </div>
                <div class="col-md-3 form-group mb-3">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" name="founders[${founderIndex}][linkedin]" class="form-control">
                </div>
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-danger btn-sm remove-founder">
                    <i class="fa fa-trash"></i> Remove
                </button>
            </div>
        `;
        container.appendChild(row);
        founderIndex++;
    });

    // Remove founder row
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-founder') || e.target.closest('.remove-founder')) {
            e.target.closest('.founder-row').remove();
        }
    });
</script>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const wrapper = preview.closest('.image-preview-wrapper');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');

                // Create or update overlay
                let overlay = wrapper.querySelector('.image-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'image-overlay';
                    wrapper.appendChild(overlay);
                }

                overlay.innerHTML = `
                    <a href="${e.target.result}"
                    target="_blank"
                    class="btn btn-sm btn-primary view-image-btn">
                        <i class="fa fa-eye"></i> View
                    </a>
                `;
            };

            reader.readAsDataURL(file);
        }
    }

    function previewMultipleImages(input, previewContainerId) {
        const container = document.getElementById(previewContainerId);
        container.innerHTML = '';

        if(input.files && input.files.length > 0){
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'position-relative image-preview-wrapper';

                    wrapper.innerHTML = `
                        <img src="${e.target.result}"
                            class="img-thumbnail"
                            style="max-width:100px; max-height:100px; object-fit: cover;">
                        <div class="image-overlay">
                            <a href="${e.target.result}"
                            target="_blank"
                            class="btn btn-sm btn-primary view-image-btn">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </div>
                    `;

                    container.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
        } else {
            container.innerHTML = '<div class="text-muted small">No photos uploaded</div>';
        }
    }
</script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function () {

        let categoryId = "{{ $business->business_category_id ?? '' }}";
        let $services = $('#services');

        // Get selected services
        let selectedServices = @json(
            old(
                'services_id',
                is_array($business->services_id ?? null)
                    ? $business->services_id
                    : json_decode($business->services_id ?? '[]', true)
            ) ?? []
        );

        console.log('Category ID:', categoryId);
        console.log('Selected Services:', selectedServices);

        // Initial load
        if (categoryId && $services.length) {
            loadServices(categoryId, selectedServices);
        }

        // On category change
        $('#business_category').on('change', function () {
            const newCategoryId = $(this).val();

            if (newCategoryId) {
                loadServices(newCategoryId, []);
            } else {
                $services.empty().append('<option value="">Select category first</option>');
            }
        });

        function loadServices(catId, selected = []) {

            if (!Array.isArray(selected)) {
                selected = [];
            }

            $.ajax({
                url: '/get-services/' + catId,
                type: 'GET',
                success: function (data) {

                    $services.empty();

                    if (!Array.isArray(data) || data.length === 0) {
                        $services.append('<option value="">No services found</option>');
                        return;
                    }

                    $.each(data, function (index, service) {

                        const serviceId   = service?.id ?? null;
                        const serviceName = service?.name ?? '';

                        if (!serviceId || !serviceName) {
                            return;
                        }

                        const isSelected = selected.some(function (val) {
                            return val != null && val.toString() === serviceId.toString();
                        });

                        $services.append(`
                            <option value="${serviceId}" ${isSelected ? 'selected' : ''}>
                                ${serviceName}
                            </option>
                        `);
                    });
                },
                error: function () {
                    $services.empty().append('<option value="">Error loading services</option>');
                }
            });
        }
    });

    /* ================= LOGO PREVIEW ================= */
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.size > 2048 * 1024) {
                alert('Logo file size must be less than 2MB');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('logoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    /* ================= COVER PHOTO PREVIEW ================= */
    function previewCoverPhoto(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.size > 5120 * 1024) {
                alert('Cover photo file size must be less than 5MB');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('coverPhotoPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    /* ================= GALLERY ================= */
    let galleryFiles = new DataTransfer();

    function previewGallery(input) {
        const container = document.getElementById('gallery-container');
        const uploadBox = container.querySelector('.gallery-upload');
        const existingPhotos = container.querySelectorAll('.existing-photo').length;

        Array.from(input.files).forEach(file => {

            if (galleryFiles.files.length + existingPhotos >= 5) {
                alert('Maximum 5 photos allowed');
                return;
            }

            if (file.size > 5120 * 1024) {
                alert('Each photo must be less than 5MB');
                return;
            }

            galleryFiles.items.add(file);

            const reader = new FileReader();
            reader.onload = e => {
                const div = document.createElement('div');
                div.className = 'position-relative rounded new-photo';
                div.style.cssText = 'width:10rem;height:10rem;border:1px dashed #ccc;overflow:hidden;';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-100 h-100" style="object-fit:cover;">
                    <button type="button"
                        class="btn btn-sm btn-danger position-absolute top-0 end-0"
                        onclick="removeNewPhoto(this)">×</button>
                `;
                container.insertBefore(div, uploadBox);
            };
            reader.readAsDataURL(file);
        });

        input.files = galleryFiles.files;
    }

    function removeNewPhoto(btn) {
        const photos = document.querySelectorAll('.new-photo');
        const index = [...photos].indexOf(btn.parentElement);

        if (index > -1) {
            galleryFiles.items.remove(index);
        }

        btn.parentElement.remove();
        document.querySelector('input[name="photos[]"]').files = galleryFiles.files;
    }

    function removeGalleryImage(btn) {
        if (confirm('Are you sure you want to remove this image?')) {
            btn.closest('.existing-photo').remove();
        }
    }
</script>

<script>
    $(document).ready(function () {

        $('form').on('submit', function () {
            // Show loader
            $('#pageLoader').removeClass('d-none');

            // Disable submit button to prevent double click
            $(this).find('button[type="submit"]').prop('disabled', true);
        });

    });
</script>
@endsection