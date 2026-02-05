@extends('layouts.frontend-master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.min.css"/>

<style>
    /* Fixed width for labels so all buttons align */
    .question-label {
        display: inline-block;
        width: 220px; /* Adjust width as needed */
        margin-bottom: 0;
    }
    .btn-outline-secondary {
        min-width: 140px;
    text-align: center;
    }
    #pageLoader {
        transition: opacity 0.2s ease;
    }
    .existing-photo:hover .photo-overlay {
        opacity: 1 !important;
    }

    .photo-overlay {
        z-index: 10;
    }

    .existing-photo.marked-for-deletion {
        opacity: 0.4;
    }

    .existing-photo.marked-for-deletion img {
        filter: grayscale(100%);
    }

    .existing-photo.marked-for-deletion .photo-overlay {
        opacity: 1 !important;
        background: rgba(220, 53, 69, 0.8) !important;
    }


    .whatsapp-wrapper {
        display: flex;
        border: 1px solid #ced4da;
        border-radius: 6px;
        overflow: hidden;
    }

    .prefix-dropdown {
        padding: 10px 12px;
        background: #f8f9fa;
        cursor: pointer;
        min-width: 80px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .whatsapp-input {
        border: none;
        flex: 1;
    }
    .whatsapp-input:focus {
        outline: none;
        box-shadow: none;
    }

    .prefix-list {
        border: 1px solid #ced4da;
        max-height: 240px;
        overflow-y: auto;
        margin-top: 5px;
        border-radius: 6px;
        background: #fff;
    }

    .prefix-list input {
        width: 100%;
        padding: 8px;
        border: none;
        border-bottom: 1px solid #ddd;
    }

    .prefix-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .prefix-list li {
        padding: 8px 12px;
        cursor: pointer;
    }
    .prefix-list li:hover {
        background: #f1f1f1;
    }

    .d-none {
        display: none;
    }

    #gallery-container {
        align-items: center;
    }

    .gallery-item,
    .gallery-upload {
        width: 10rem;
        height: 10rem;
        border-radius: 8px;
        border: 1px dashed #ccc;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .gallery-upload {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .gallery-upload i {
        font-size: 2rem;
        color: rgba(0,0,0,0.5);
    }

    .gallery-upload input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .remove-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(0,0,0,0.7);
        color: #fff;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        font-size: 18px;
        display: none;
        cursor: pointer;
    }

    .gallery-item:hover .remove-btn {
        display: block;
    }

    .btn-outline{
        min-width: 100px;
        text-align: left;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6 class="alert-heading"><i class="fa fa-exclamation-triangle me-2"></i>Please fix the following errors:</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="fw-bold mb-4">
                        <i class="fa fa-building me-2"></i> Business Registration
                    </h3>

                    {{-- Progress Steps --}}
                    <div class="mb-4">
                        <div class="d-flex align-items-center justify-content-between text-center">

                            @php
                                $steps = [
                                    1 => 'Business & Founder Identity',
                                    2 => 'Business Size & Structure',
                                    3 => 'Islamic Ethical Alignment',
                                    4 => 'Consent & Approval'
                                ];
                            @endphp

                            @foreach($steps as $i => $label)
                                <div class="flex-fill">
                                    <div class="rounded-circle mx-auto mb-1
                                        {{ $step >= $i ? 'bg-primary text-white' : 'bg-light border' }}"
                                        style="width:40px;height:40px;line-height:40px;">
                                        {{ $i }}
                                    </div>
                                    <small class="fw-semibold">{{ $label }}</small>
                                </div>
                                @if(!$loop->last)
                                    <div class="flex-fill border-top mx-2
                                        {{ $step > $i ? 'border-primary' : 'border-secondary' }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <form method="POST" action="{{ route('gme.business.save-step') }}" enctype="multipart/form-data" class="pt-3">
                        @csrf
                        <input type="hidden" name="step" value="{{ $step }}">

                        {{-- ================= STEP 1 ================= --}}

                        @if($step == 1)

                            <h5 class="fw-bold mb-3">Business & Founder Identity</h5>

                            <div class="mb-3">
                                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                                <input type="text" name="business_name" class="form-control"
                                    value="{{ old('business_name', $business->business_name ?? '') }}" required>

                                <!-- Error Message -->
                                @error('business_name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Short Introduction</label>
                                <textarea class="form-control" rows="3" name="short_introduction">{{ old('short_introduction', $business->short_introduction ?? '') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Year Established</label>
                                    <input type="text" name="year_established" class="form-control"
                                        value="{{ old('year_established', $business->year_established ?? '') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Business Category <span class="text-danger">*</span></label>
                                    <select class="form-select" name="business_category_id" id="business_category" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('business_category_id', $business->business_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- Error Message -->
                                    @error('business_category_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Countries of Operation <span class="text-danger">*</span></label>
                                        <select class="form-select search_select" name="countries_of_operation[]" multiple required>
                                            @foreach($countries as $country)
                                                <option value="{{ $country }}"
                                                    {{ in_array($country, old('countries_of_operation', json_decode($business->countries_of_operation ?? '[]', true))) ? 'selected' : '' }}>
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    <!-- Error Message -->
                                    @error('countries_of_operation')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $business->email ?? '') }}" required>
                                    <!-- Error Message -->
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                                

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Website</label>
                                    <input type="website" name="website" class="form-control"
                                        value="{{ old('website', $business->website ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Business Address</label>
                                <textarea class="form-control" rows="2" name="business_address">{{ old('business_address', $business->business_address ?? '') }}</textarea>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">Social Media Links</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- facebook url -->
                                    <label class="form-label">Facebook URL</label>
                                    <input type="string" name="facebook" class="form-control"
                                        value="{{ old('facebook', $business->facebook ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <!-- instagram url -->
                                    <label class="form-label">Instagram URL</label>
                                    <input type="string" name="instagram" class="form-control"
                                        value="{{ old('instagram', $business->instagram ?? '') }}">
                                </div>
                                <!-- linkedin url -->
                                <div class="col-md-6">
                                    <label class="form-label">LinkedIn URL</label>
                                    <input type="string" name="linkedin" class="form-control"
                                        value="{{ old('linkedin', $business->linkedin ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <!-- Youtube url -->
                                    <label class="form-label">YouTube URL</label>
                                    <input type="string" name="youtube" class="form-control"
                                        value="{{ old('youtube', $business->youtube ?? '') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!-- Online Store url -->
                                    <label class="form-label">Online Store URL</label>
                                    <input type="string" name="online_store" class="form-control"
                                        value="{{ old('online_store', $business->online_store ?? '') }}">
                                </div>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">Business Contact Person</h6>

                            
                            <div class="border rounded p-3 mb-3 founder-item">
                                <div class="row">
                                {{-- add business_contact_person_name --}}

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Contact Name</label>
                                        <input type="text" name="business_contact_person_name" class="form-control"
                                            value="{{ old('business_contact_person_name', $business->business_contact_person_name ?? '') }}">
                                        <!-- Error Message -->
                                        @error('business_contact_person_name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Contact Number</label>

                                        @php
                                            // Split the stored business WhatsApp number
                                            $storedBusinessWhatsApp = $business->whatsapp_number ?? '';
                                            $businessWhatsappPrefix = '+880';
                                            $businessWhatsappNumber = '';
                                            
                                            // Check if we have old input (from validation error)
                                            if (old('whatsapp_number')) {
                                                $businessWhatsappPrefix = old('whatsapp_prefix', '+880');
                                                $businessWhatsappNumber = old('whatsapp_number', '');
                                            } elseif ($storedBusinessWhatsApp) {
                                                // Split from database
                                                if (preg_match('/^(\+\d{1,4})(.*)$/', $storedBusinessWhatsApp, $matches)) {
                                                    $businessWhatsappPrefix = $matches[1];
                                                    $businessWhatsappNumber = $matches[2];
                                                } else {
                                                    $businessWhatsappNumber = $storedBusinessWhatsApp;
                                                }
                                            }
                                        @endphp

                                        <div class="whatsapp-wrapper">
                                            <div class="prefix-dropdown" id="prefixDropdown">
                                                <span id="selectedPrefix">{{ $businessWhatsappPrefix }}</span>
                                                <span class="arrow">▼</span>
                                            </div>

                                            <!-- Add hidden prefix input -->
                                            <input type="hidden"
                                                name="whatsapp_prefix"
                                                id="whatsappPrefix"
                                                value="{{ $businessWhatsappPrefix }}">

                                            <input type="text"
                                                name="whatsapp_number"
                                                class="form-control whatsapp-input"
                                                placeholder="Enter number"
                                                value="{{ $businessWhatsappNumber }}">
                                        </div>

                                        <!-- dropdown list -->
                                        <div class="prefix-list d-none" id="prefixList">
                                            <input type="text" id="prefixSearch" placeholder="Search country...">
                                            <ul id="prefixItems">
                                                <!-- JS will inject -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h6 class="fw-bold mb-3">Founder Information</h6>

                            <div id="founders-container">
                                @php
                                    $founders = old('founders', json_decode($business->founders ?? '[]', true)) ?: [['name'=>'','designation'=>'']];
                                @endphp

                                @foreach($founders as $index => $founder)
                                @php
                                    // Split the stored WhatsApp number into prefix and number
                                    $storedWhatsApp = $founder['whatsapp_number'] ?? '';
                                    $whatsappPrefix = '+880'; // default
                                    $whatsappNumber = '';
                                    
                                    if ($storedWhatsApp) {
                                        // Extract prefix (matches +880, +1, +44, etc.)
                                        if (preg_match('/^(\+\d{1,4})(.*)$/', $storedWhatsApp, $matches)) {
                                            $whatsappPrefix = $matches[1]; // e.g., +880
                                            $whatsappNumber = $matches[2]; // e.g., 1925272409
                                        } else {
                                            // If no prefix found, treat entire string as number
                                            $whatsappNumber = $storedWhatsApp;
                                        }
                                    }
                                @endphp
                                
                                <div class="border rounded p-3 mb-3 founder-item">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Founder / Owner Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][name]"
                                                value="{{ $founder['name'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Designation <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][designation]"
                                                value="{{ $founder['designation'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">WhatsApp Number</label>

                                            <div class="whatsapp-wrapper" data-index="{{ $index }}">
                                                <div class="prefix-dropdown">
                                                    <span class="selectedPrefix">{{ $whatsappPrefix }}</span>
                                                    <span class="arrow">▼</span>
                                                </div>

                                                <!-- hidden prefix -->
                                                <input type="hidden"
                                                    name="founders[{{ $index }}][whatsapp_prefix]"
                                                    class="whatsapp-prefix"
                                                    value="{{ $whatsappPrefix }}">

                                                <!-- number -->
                                                <input type="text"
                                                    name="founders[{{ $index }}][whatsapp_number]"
                                                    class="form-control whatsapp-input"
                                                    placeholder="Enter number"
                                                    value="{{ $whatsappNumber }}">
                                            </div>

                                            <!-- dropdown list -->
                                            <div class="prefix-list d-none">
                                                <input type="text" class="prefixSearch" placeholder="Search country...">
                                                <ul class="prefixItems"></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Linkedin URL</label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][linkedin]"
                                                value="{{ $founder['linkedin'] ?? '' }}">
                                        </div>
                                        @if($index > 0)
                                        <div class="col-12 mb-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-founder">
                                                <i class="fa fa-trash"></i> Remove Founder
                                            </button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-success btn-sm" id="addFounderBtn">
                                <i class="fa fa-plus"></i> Add Founder
                            </button>


                        @endif


                        {{-- ================= STEP 2 ================= --}}

                        @if($step == 2)
                            <h5 class="fw-bold mb-3">Business Size & Structure</h5>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Registration Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('registration_status') is-invalid @enderror" name="registration_status" required>
                                        <option value="">Select</option>
                                        <option value="registered_company" {{ old('registration_status', $business->registration_status ?? '') == 'registered_company' ? 'selected' : '' }}>Registered Company</option>
                                        <option value="sole_proprietorship" {{ old('registration_status', $business->registration_status ?? '') == 'sole_proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
                                        <option value="partnership" {{ old('registration_status', $business->registration_status ?? '') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                                        <option value="startup_early_stage" {{ old('registration_status', $business->registration_status ?? '') == 'startup_early_stage' ? 'selected' : '' }}>Startup Early Stage</option>
                                        <option value="home_based" {{ old('registration_status', $business->registration_status ?? '') == 'home_based' ? 'selected' : '' }}>Home Based</option>
                                        <option value="not_registered_yet" {{ old('registration_status', $business->registration_status ?? '') == 'not_registered_yet' ? 'selected' : '' }}>Not Registered Yet</option>
                                    </select>
                                    @error('registration_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Employees <span class="text-danger">*</span></label>
                                    <select class="form-select @error('employee_count') is-invalid @enderror" name="employee_count" required>
                                        <option value="">Select</option>
                                        <option value="1-3" {{ old('employee_count', $business->employee_count ?? '') == '1-3' ? 'selected' : '' }}>1–3</option>
                                        <option value="4-10" {{ old('employee_count', $business->employee_count ?? '') == '4-10' ? 'selected' : '' }}>4–10</option>
                                        <option value="11-25" {{ old('employee_count', $business->employee_count ?? '') == '11-25' ? 'selected' : '' }}>11–25</option>
                                        <option value="26-50" {{ old('employee_count', $business->employee_count ?? '') == '26-50' ? 'selected' : '' }}>26–50</option>
                                        <option value="51+" {{ old('employee_count', $business->employee_count ?? '') == '51+' ? 'selected' : '' }}>51+</option>
                                    </select>
                                    @error('employee_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Operational Scale <span class="text-danger">*</span></label>
                                    <select class="form-select @error('operational_scale') is-invalid @enderror" name="operational_scale" required>
                                        <option value="">Select</option>
                                        <option value="local" {{ old('operational_scale', $business->operational_scale ?? '') == 'local' ? 'selected' : '' }}>Local</option>
                                        <option value="nationwide" {{ old('operational_scale', $business->operational_scale ?? '') == 'nationwide' ? 'selected' : '' }}>Nationwide</option>
                                        <option value="international" {{ old('operational_scale', $business->operational_scale ?? '') == 'international' ? 'selected' : '' }}>International</option>
                                        <option value="online_only" {{ old('operational_scale', $business->operational_scale ?? '') == 'online_only' ? 'selected' : '' }}>Online Only</option>
                                        <option value="hybrid" {{ old('operational_scale', $business->operational_scale ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                    @error('operational_scale')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Annual Revenue (Optional)</label>
                                    <select class="form-select @error('annual_revenue') is-invalid @enderror" name="annual_revenue">
                                        <option value="">Select</option>
                                        <option value="under_10k" {{ old('annual_revenue', $business->annual_revenue ?? '') == 'under_10k' ? 'selected' : '' }}>Under $10K</option>
                                        <option value="10k-50k" {{ old('annual_revenue', $business->annual_revenue ?? '') == '10k-50k' ? 'selected' : '' }}>$10K – $50K</option>
                                        <option value="50k-200k" {{ old('annual_revenue', $business->annual_revenue ?? '') == '50k-200k' ? 'selected' : '' }}>$50K – $200K</option>
                                        <option value="200k-1m" {{ old('annual_revenue', $business->annual_revenue ?? '') == '200k-1m' ? 'selected' : '' }}>$200K – $1M</option>
                                        <option value="above_1m" {{ old('annual_revenue', $business->annual_revenue ?? '') == 'above_1m' ? 'selected' : '' }}>Above $1M</option>
                                    </select>
                                    @error('annual_revenue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- DEBUG: Remove after testing --}}
                                @php
                                    $savedServices = old('services_id',
                                        is_array($business->services_id ?? null)
                                            ? $business->services_id
                                            : json_decode($business->services_id ?? '[]', true)
                                    );
                                    // dd($savedServices, $business->services_id); // Uncomment to debug
                                @endphp

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Products / Services <span class="text-danger">*</span></label>
                                    <select class="form-select search_select @error('services_id') is-invalid @enderror"
                                            multiple name="services_id[]" id="services" required>
                                        <!-- Options will be loaded by JavaScript -->
                                    </select>
                                    @error('services_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            {{-- Collaboration Open --}}
                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label question-label">Collaboration Open <span class="text-danger">*</span></label>
                                @php $value = old('collaboration_open', $business->collaboration_open ?? ''); @endphp
                                <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                    @foreach ([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                        'maybe' => 'Maybe'
                                    ] as $key => $label)
                                        <label class="btn btn-outline {{ $value === $key ? 'active' : '' }}">
                                            <input type="radio" name="collaboration_open" value="{{ $key }}" autocomplete="off" {{ $value === $key ? 'checked' : '' }} required> {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('collaboration_open')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <hr>

                            <div id="collaborationTypesWrapper">
                                <h6 class="fw-bold">Collaboration Interest</h6>

                                @php
                                    $savedCollaborationTypes = old('collaboration_types',
                                        is_array($business->collaboration_types ?? null)
                                            ? $business->collaboration_types
                                            : json_decode($business->collaboration_types ?? '[]', true)
                                    );
                                @endphp

                                @foreach([
                                    'Partnerships',
                                    'Investment Oportunities',
                                    'Vendor Supply Chain',
                                    'Marketing Promotion',
                                    'Networking',
                                    'Training Workshops',
                                    'Community Charity Projects',
                                    'Not Sure Yet'
                                ] as $type)
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="collaboration_types[]"
                                            value="{{ $type }}"
                                            {{ in_array($type, $savedCollaborationTypes) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $type }}</label>
                                    </div>
                                @endforeach

                                @error('collaboration_types')
                                    <div class="text-danger mt-2"><small>{{ $message }}</small></div>
                                @enderror
                            </div>





                            <h5 class="fw-bold mt-4 mb-3">Business Media Uploads</h5>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Upload Business Logo</label>

                                    <!-- Upload Container -->
                                    <div class="rounded p-2 text-center position-relative @error('logo') border-danger @enderror"
                                        style="width: 10rem; height: 10rem; cursor: pointer; border: 1px dashed #ccc; overflow: hidden;">

                                        <!-- Preview Image -->
                                        <img id="logoPreview"
                                            src="{{ !empty($business->logo) ? asset('assets/' . $business->logo) : asset('assets/uploads/placeholder.png') }}"
                                            class="img-fluid w-100 h-100"
                                            style="object-fit: cover;">

                                        <!-- Hidden File Input -->
                                        <input type="file"
                                            name="logo"
                                            accept="image/*"
                                            onchange="previewLogo(this)"
                                            style="opacity:0; position:absolute; top:0; left:0; width:100%; height:100%; cursor:pointer;">
                                    </div>

                                    <small class="text-muted d-block mt-1">PNG, JPG, JPEG (Max 2MB)</small>
                                    @if(!empty($business->logo))
                                        <small class="text-success d-block"><i class="fa fa-check"></i> Logo uploaded</small>
                                    @endif
                                    @error('logo')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Upload Cover Photo</label>

                                    <!-- Upload Container -->
                                    <div class="rounded p-2 text-center position-relative @error('cover_photo') border-danger @enderror"
                                        style="width: 10rem; height: 10rem; cursor: pointer; border: 1px dashed #ccc; overflow: hidden;">

                                        <!-- Cover Photo Preview -->
                                        <img id="coverPhotoPreview"
                                            src="{{ !empty($business->cover_photo) ? asset('assets/' . $business->cover_photo) : asset('assets/uploads/placeholder.png') }}"
                                            class="img-fluid w-100 h-100"
                                            style="object-fit: cover;">

                                        <!-- Hidden File Input -->
                                        <input type="file"
                                            name="cover_photo"
                                            accept="image/*"
                                            onchange="previewCoverPhoto(this)"
                                            style="opacity:0; position:absolute; top:0; left:0; width:100%; height:100%; cursor:pointer;">
                                    </div>

                                    <small class="text-muted d-block mt-1">PNG, JPG, JPEG (Max 2MB)</small>
                                    @if(!empty($business->cover_photo))
                                        <small class="text-success d-block"><i class="fa fa-check"></i> Cover uploaded</small>
                                    @endif
                                    @error('cover_photo')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Business Photos Gallery</label>

                                    <div class="d-flex flex-wrap gap-2" id="gallery-container">

                                        <!-- Existing Images -->
                                        @foreach($business->businessPhotos ?? [] as $photo)
                                            <div class="gallery-item existing-photo"
                                                data-photo-id="{{ $photo->id }}"
                                                style="background-image:url('{{ asset('assets/'.$photo->image_url) }}')">

                                                <button type="button"
                                                        class="remove-btn"
                                                        onclick="removeExistingPhoto(this, {{ $photo->id }})">
                                                    &times;
                                                </button>

                                                <input type="checkbox"
                                                    name="delete_photos[]"
                                                    value="{{ $photo->id }}"
                                                    class="d-none">
                                            </div>
                                        @endforeach

                                        <!-- Upload Button -->
                                        <div class="gallery-upload" id="upload-box">
                                            <i class="fa fa-plus"></i>
                                            <input type="file"
                                                id="photo-input"
                                                name="photos[]"
                                                accept="image/*"
                                                multiple
                                                onchange="addNewPhotos(this)">
                                        </div>

                                    </div>

                                    <small class="text-muted">Max 6 images (PNG, JPG, JPEG | 5MB each)</small>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Registration Document -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Upload Registration Document</label>
                                    <input type="file" name="registration_document" class="form-control @error('registration_document') is-invalid @enderror">
                                    <!-- Document Links -->
                                    @if(!empty($business->registration_document))
                                        <small class="text-success d-block mt-1">
                                            <i class="fa fa-check"></i> Document uploaded:
                                            <a href="{{ asset('assets/' .$business->registration_document) }}" target="_blank">View</a>
                                        </small>
                                    @endif
                                    @error('registration_document')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Business Profile -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Business Profile</label>
                                    <input type="file" name="business_profile" class="form-control @error('business_profile') is-invalid @enderror">
                                    @if(!empty($business->business_profile))
                                        <small class="text-success d-block mt-1">
                                            <i class="fa fa-check"></i> Profile uploaded:
                                            <a href="{{ asset('assets/' .$business->business_profile) }}" target="_blank">View</a>
                                        </small>
                                    @endif
                                    @error('business_profile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Product Catalogue -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Product Catalogue</label>
                                    <input type="file" name="product_catalogue" class="form-control @error('product_catalogue') is-invalid @enderror">
                                    @if(!empty($business->product_catalogue))
                                        <small class="text-success d-block mt-1">
                                            <i class="fa fa-check"></i> Catalogue uploaded:
                                            <a href="{{ asset('assets/' .$business->product_catalogue) }}" target="_blank">View</a>
                                        </small>
                                    @endif
                                    @error('product_catalogue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Business Overview</label>
                                    <textarea class="form-control @error('business_overview') is-invalid @enderror"
                                            rows="6"
                                            name="business_overview"
                                            placeholder="Describe your business, mission, vision, products/services in detail...">{{ old('business_overview', $business->business_overview ?? '') }}</textarea>
                                    @error('business_overview')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Maximum 1800 characters</small>
                                </div>
                            </div>

                        @endif

                        {{-- ================= STEP 3 ================= --}}

                        @if($step == 3)
                            <h5 class="fw-bold mb-3">Islamic Ethics & Community</h5>

                            {{-- Avoid Interest (Riba)? --}}
                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label question-label">Avoid Interest (Riba)? <span class="text-danger">*</span></label>
                                @php $value = old('avoid_riba', $business->avoid_riba ?? ''); @endphp
                                <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                    @foreach ([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                        'partially_transitioning' => 'Partially Transitioning',
                                        'prefer_not_to_say' => 'Prefer Not to Say'
                                    ] as $key => $label)
                                        <label class="btn btn-outline {{ $value === $key ? 'active' : '' }}">
                                            <input type="radio" name="avoid_riba" value="{{ $key }}" autocomplete="off" {{ $value === $key ? 'checked' : '' }} required> {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('avoid_riba')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            {{-- Avoid Haram Products? --}}
                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label question-label">Avoid Haram Products? <span class="text-danger">*</span></label>
                                @php $value = old('avoid_haram_products', $business->avoid_haram_products ?? ''); @endphp
                                <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                    @foreach ([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                        'partially_compliant' => 'Partially Compliant',
                                    ] as $key => $label)
                                        <label class="btn btn-outline {{ $value === $key ? 'active' : '' }}">
                                            <input type="radio" name="avoid_haram_products" value="{{ $key }}" autocomplete="off" {{ $value === $key ? 'checked' : '' }} required> {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('avoid_haram_products')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            {{-- Fair Pricing --}}
                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label question-label">Fair Pricing <span class="text-danger">*</span></label>
                                @php $value = old('fair_pricing', $business->fair_pricing ?? ''); @endphp
                                <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                    @foreach ([
                                        'yes' => 'Yes',
                                        'mostly' => 'Mostly',
                                        'needs_improvement' => 'Needs Improvement'
                                    ] as $key => $label)
                                        <label class="btn btn-outline {{ $value === $key ? 'active' : '' }}">
                                            <input type="radio" name="fair_pricing" value="{{ $key }}" autocomplete="off" {{ $value === $key ? 'checked' : '' }} required> {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('fair_pricing')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            {{-- Open for Guidance --}}
                            <div class="mb-3 d-flex align-items-center">
                                <label class="form-label question-label">Open for Guidance <span class="text-danger">*</span></label>
                                @php $value = old('open_for_guidance', $business->open_for_guidance ?? ''); @endphp
                                <div class="btn-group btn-group-toggle" data-bs-toggle="buttons">
                                    @foreach ([
                                        'yes' => 'Yes',
                                        'no' => 'No',
                                        'maybe' => 'Maybe'
                                    ] as $key => $label)
                                        <label class="btn btn-outline {{ $value === $key ? 'active' : '' }}">
                                            <input type="radio" name="open_for_guidance" value="{{ $key }}" autocomplete="off" {{ $value === $key ? 'checked' : '' }} required> {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @error('open_for_guidance')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror






                            <div class="mb-3">
                                <label class="form-label">Ethical Description</label>
                                <textarea class="form-control @error('ethical_description') is-invalid @enderror"
                                        rows="4"
                                        name="ethical_description"
                                        placeholder="Describe your business ethics and values...">{{ old('ethical_description', $business->ethical_description ?? '') }}</textarea>
                                @error('ethical_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maximum 1200 characters</small>
                            </div>


                        @endif

                        {{-- ================= STEP 4 ================= --}}

                        @if($step == 4)
                            <h5 class="fw-bold mb-3">Consent & Approval <span class="text-danger">*</span></h5>

                            <div class="alert alert-warning">
                                <div class="form-check">
                                    <input class="form-check-input @error('info_accuracy') is-invalid @enderror"
                                        type="checkbox"
                                        name="info_accuracy"
                                        value="1"
                                        {{ old('info_accuracy', $business->info_accuracy ?? false) ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label">
                                        I confirm all provided information is accurate
                                    </label>
                                    @error('info_accuracy')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="allow_publish"
                                        value="1"
                                        required
                                        {{ old('allow_publish', $business->allow_publish ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Allow GME to publish my business profile
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <div class="form-check">
                                    <input class="form-check-input"
                                        type="checkbox"
                                        name="allow_contact"
                                        value="1"
                                        required
                                        {{ old('allow_contact', $business->allow_contact ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label">
                                        Allow GME to contact me for verification
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Digital Signature <span class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('digital_signature') is-invalid @enderror"
                                    name="digital_signature"
                                    value="{{ old('digital_signature', $business->digital_signature ?? '') }}"
                                    placeholder="Type your full name as digital signature"
                                    required>
                                @error('digital_signature')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="alert alert-success">
                                <strong>✓ Ready to submit</strong><br>
                                Our team will review your application.
                            </div>


                        @endif

                        <!-- Navigation -->
                        <div class="d-flex justify-content-between mt-4">
                            @if($step > 1)
                                <a href="{{ route('gme.business.register', ['step' => $step - 1, 'business_id' => $business->id ?? '']) }}"
                                class="btn btn-secondary">← Previous</a>
                            @else
                                <span></span>
                            @endif

                            <button type="submit" class="btn {{ $step < 4 ? 'btn-primary' : 'btn-success' }}">
                                {{ $step < 4 ? 'Save & Next →' : 'Submit Application' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Global Loader -->
<div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-none"
     style="background: rgba(255,255,255,0.8); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status"></div>
            <div class="fw-semibold">Please wait, loading next step...</div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"></script>

<script>
$(document).ready(function () {
    $('form').on('submit', function () {
        // Show loader
        $('#pageLoader').removeClass('d-none');

        // Disable submit button to prevent double click
        $(this).find('button[type="submit"]').prop('disabled', true);
    });

    // Initialize WhatsApp dropdowns on page load
    initializeWhatsAppDropdowns();
});
</script>

<script>
    const MAX_IMAGES = 6;
    const input = document.getElementById('photo-input');
    const container = document.getElementById('gallery-container');
    const uploadBox = document.getElementById('upload-box');

    // Keep track of files to send to Laravel
    let fileStore = new DataTransfer();

    // Toggle + button visibility
    function toggleUploadBox() {
        uploadBox.style.display = document.querySelectorAll('.gallery-item').length >= MAX_IMAGES ? 'none' : 'flex';
    }

    // Add new files
    input.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            if (document.querySelectorAll('.gallery-item').length >= MAX_IMAGES) return;

            if (!file.type.startsWith('image/')) {
                alert(file.name + ' is not an image.');
                return;
            }

            if (file.size > 5 * 1024 * 1024) {
                alert(file.name + ' is larger than 5MB.');
                return;
            }

            fileStore.items.add(file);
            input.files = fileStore.files;

            const reader = new FileReader();
            reader.onload = function(event) {
                const div = document.createElement('div');
                div.className = 'gallery-item new-photo';
                div.style.backgroundImage = `url(${event.target.result})`;
                div.innerHTML = `<button type="button" class="remove-btn" onclick="removeNewPhoto(this, '${file.name}')">&times;</button>`;
                container.insertBefore(div, uploadBox);
                toggleUploadBox();
            };
            reader.readAsDataURL(file);
        });
    });

    // Remove new photo
    function removeNewPhoto(btn, fileName) {
        btn.closest('.gallery-item').remove();

        const newStore = new DataTransfer();
        Array.from(fileStore.files).forEach(f => {
            if (f.name !== fileName) newStore.items.add(f);
        });
        fileStore = newStore;
        input.files = fileStore.files;

        toggleUploadBox();
    }

    // Remove existing photo
    function removeExistingPhoto(btn, photoId) {
        const item = btn.closest('.gallery-item');
        item.querySelector('input[type="checkbox"]').checked = true;
        item.remove();
        toggleUploadBox();
    }

    // Init
    toggleUploadBox();
</script>
<script>
    // Country codes data
    const topCountries = [
        { name: "Bangladesh", code: "+880" },
        { name: "India", code: "+91" },
        { name: "United States", code: "+1" },
        { name: "United Kingdom", code: "+44" },
        { name: "Saudi Arabia", code: "+966" }
    ];

    const allCountries = [
        { name: "Afghanistan", code: "+93" },
        { name: "Albania", code: "+355" },
        { name: "Algeria", code: "+213" },
        { name: "Argentina", code: "+54" },
        { name: "Australia", code: "+61" },
        { name: "Austria", code: "+43" },
        { name: "Bangladesh", code: "+880" },
        { name: "Belgium", code: "+32" },
        { name: "Brazil", code: "+55" },
        { name: "Canada", code: "+1" },
        { name: "China", code: "+86" },
        { name: "Denmark", code: "+45" },
        { name: "Egypt", code: "+20" },
        { name: "France", code: "+33" },
        { name: "Germany", code: "+49" },
        { name: "India", code: "+91" },
        { name: "Indonesia", code: "+62" },
        { name: "Italy", code: "+39" },
        { name: "Japan", code: "+81" },
        { name: "Malaysia", code: "+60" },
        { name: "Nepal", code: "+977" },
        { name: "Netherlands", code: "+31" },
        { name: "New Zealand", code: "+64" },
        { name: "Norway", code: "+47" },
        { name: "Pakistan", code: "+92" },
        { name: "Philippines", code: "+63" },
        { name: "Qatar", code: "+974" },
        { name: "Russia", code: "+7" },
        { name: "Singapore", code: "+65" },
        { name: "South Africa", code: "+27" },
        { name: "South Korea", code: "+82" },
        { name: "Spain", code: "+34" },
        { name: "Sri Lanka", code: "+94" },
        { name: "Sweden", code: "+46" },
        { name: "Switzerland", code: "+41" },
        { name: "Thailand", code: "+66" },
        { name: "Turkey", code: "+90" },
        { name: "UAE", code: "+971" },
        { name: "United Kingdom", code: "+44" },
        { name: "United States", code: "+1" },
        { name: "Vietnam", code: "+84" },
        { name: "Zimbabwe", code: "+263" }
    ];

    // Global founder index counter
    let founderIndex = $('#founders-container .founder-item').length;

    // Initialize WhatsApp Dropdowns for ALL instances (Business + Founders)
    function initializeWhatsAppDropdowns() {
        $('.whatsapp-wrapper').each(function() {
            const $wrapper = $(this);
            const $dropdown = $wrapper.find('.prefix-dropdown');
            const $prefixList = $wrapper.next('.prefix-list');
            const $selectedPrefix = $wrapper.find('.selectedPrefix, #selectedPrefix');
            const $hiddenInput = $wrapper.find('.whatsapp-prefix, #whatsappPrefix');
            const $searchInput = $prefixList.find('.prefixSearch, #prefixSearch');
            const $itemsList = $prefixList.find('.prefixItems, #prefixItems');

            // Skip if already initialized
            if ($wrapper.data('initialized')) return;
            $wrapper.data('initialized', true);

            // Populate country codes if not already done
            if ($itemsList.children().length === 0) {
                // Top countries first
                topCountries.forEach(country => {
                    $itemsList.append(`
                        <li data-code="${country.code}" style="font-weight: 600; cursor: pointer; padding: 8px 12px;">
                            ${country.name} (${country.code})
                        </li>
                    `);
                });

                // Divider
                $itemsList.append('<li class="divider" style="border-top: 1px solid #ddd; padding: 0; cursor: default;"></li>');

                // All countries
                allCountries.forEach(country => {
                    $itemsList.append(`
                        <li data-code="${country.code}" style="cursor: pointer; padding: 8px 12px;">
                            ${country.name} (${country.code})
                        </li>
                    `);
                });
            }

            // Toggle dropdown
            $dropdown.off('click').on('click', function(e) {
                e.stopPropagation();
                
                // Close other dropdowns
                $('.prefix-list').not($prefixList).addClass('d-none');
                
                // Toggle current
                $prefixList.toggleClass('d-none');
                
                // Clear search when opening
                if (!$prefixList.hasClass('d-none')) {
                    $searchInput.val('');
                    $itemsList.find('li').show();
                }
            });

            // Search functionality
            $searchInput.off('input').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                
                $itemsList.find('li').each(function() {
                    const $li = $(this);
                    
                    // Skip divider
                    if ($li.hasClass('divider')) {
                        $li.toggle(searchTerm === '');
                        return;
                    }
                    
                    const text = $li.text().toLowerCase();
                    $li.toggle(text.includes(searchTerm));
                });
            });

            // Select country code
            $itemsList.off('click', 'li').on('click', 'li', function(e) {
                e.stopPropagation();
                
                const $li = $(this);
                const selectedCode = $li.data('code');
                
                // Skip if clicking on divider
                if (!selectedCode || $li.hasClass('divider')) return;
                
                $selectedPrefix.text(selectedCode);
                $hiddenInput.val(selectedCode);
                $prefixList.addClass('d-none');
                $searchInput.val('');
                $itemsList.find('li').show();
            });
        });

        // Close dropdowns when clicking outside
        $(document).off('click.whatsappDropdown').on('click.whatsappDropdown', function(e) {
            if (!$(e.target).closest('.whatsapp-wrapper, .prefix-list').length) {
                $('.prefix-list').addClass('d-none');
            }
        });
    }

    // Add Founder Function
    function addFounder() {
        const newFounderHtml = `
            <div class="border rounded p-3 mb-3 founder-item">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Founder / Owner Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][name]" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][designation]" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">WhatsApp Number</label>

                        <div class="whatsapp-wrapper" data-index="${founderIndex}">
                            <div class="prefix-dropdown">
                                <span class="selectedPrefix">+880</span>
                                <span class="arrow">▼</span>
                            </div>

                            <input type="hidden"
                                name="founders[${founderIndex}][whatsapp_prefix]"
                                class="whatsapp-prefix"
                                value="+880">

                            <input type="text"
                                name="founders[${founderIndex}][whatsapp_number]"
                                class="form-control whatsapp-input"
                                placeholder="Enter number">
                        </div>

                        <div class="prefix-list d-none">
                            <input type="text" class="prefixSearch" placeholder="Search country...">
                            <ul class="prefixItems"></ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Linkedin URL</label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][linkedin]">
                    </div>
                    <div class="col-12 mb-2">
                        <button type="button" class="btn btn-danger btn-sm remove-founder">
                            <i class="fa fa-trash"></i> Remove Founder
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('#founders-container').append(newFounderHtml);
        founderIndex++;
        
        // Re-initialize WhatsApp dropdowns for the new founder
        initializeWhatsAppDropdowns();
    }

    // Document Ready
    $(document).ready(function() {
        // Initialize all existing WhatsApp dropdowns on page load
        initializeWhatsAppDropdowns();

        // Add Founder button click
        $('#addFounderBtn').off('click').on('click', function() {
            addFounder();
        });

        // Remove Founder
        $(document).on('click', '.remove-founder', function() {
            $(this).closest('.founder-item').remove();
        });
    });
</script>
{{-- <script>
    // Country codes data
    const topCountries = [
        { name: "Bangladesh", code: "+880" },
        { name: "India", code: "+91" },
        { name: "United States", code: "+1" },
        { name: "United Kingdom", code: "+44" },
        { name: "Saudi Arabia", code: "+966" }
    ];

    const allCountries = [
        { name: "Afghanistan", code: "+93" },
        { name: "Albania", code: "+355" },
        { name: "Algeria", code: "+213" },
        { name: "Argentina", code: "+54" },
        { name: "Australia", code: "+61" },
        { name: "Austria", code: "+43" },
        { name: "Bangladesh", code: "+880" },
        { name: "Belgium", code: "+32" },
        { name: "Brazil", code: "+55" },
        { name: "Canada", code: "+1" },
        { name: "China", code: "+86" },
        { name: "Denmark", code: "+45" },
        { name: "Egypt", code: "+20" },
        { name: "France", code: "+33" },
        { name: "Germany", code: "+49" },
        { name: "India", code: "+91" },
        { name: "Indonesia", code: "+62" },
        { name: "Italy", code: "+39" },
        { name: "Japan", code: "+81" },
        { name: "Malaysia", code: "+60" },
        { name: "Nepal", code: "+977" },
        { name: "Netherlands", code: "+31" },
        { name: "New Zealand", code: "+64" },
        { name: "Norway", code: "+47" },
        { name: "Pakistan", code: "+92" },
        { name: "Philippines", code: "+63" },
        { name: "Qatar", code: "+974" },
        { name: "Russia", code: "+7" },
        { name: "Singapore", code: "+65" },
        { name: "South Africa", code: "+27" },
        { name: "South Korea", code: "+82" },
        { name: "Spain", code: "+34" },
        { name: "Sri Lanka", code: "+94" },
        { name: "Sweden", code: "+46" },
        { name: "Switzerland", code: "+41" },
        { name: "Thailand", code: "+66" },
        { name: "Turkey", code: "+90" },
        { name: "UAE", code: "+971" },
        { name: "United Kingdom", code: "+44" },
        { name: "United States", code: "+1" },
        { name: "Vietnam", code: "+84" },
        { name: "Zimbabwe", code: "+263" }
    ];

    // Business WhatsApp dropdown (single instance)
    const dropdown = document.getElementById("prefixDropdown");
    const list = document.getElementById("prefixList");
    const ul = document.getElementById("prefixItems");
    const search = document.getElementById("prefixSearch");
    const selected = document.getElementById("selectedPrefix");
    const hiddenPrefix = document.getElementById("whatsappPrefix");

    function renderList(filter = "") {
        if (!ul) return;
        
        ul.innerHTML = "";

        // Always show top 5 first
        topCountries.forEach(c => {
            if (c.name.toLowerCase().includes(filter.toLowerCase())) {
                const li = document.createElement("li");
                li.textContent = `${c.name} (${c.code})`;
                li.style.fontWeight = "600";
                li.onclick = () => {
                    selected.textContent = c.code;
                    hiddenPrefix.value = c.code;
                    list.classList.add("d-none");
                };
                ul.appendChild(li);
            }
        });

        // Divider
        const divider = document.createElement("li");
        divider.style.borderTop = "1px solid #ddd";
        ul.appendChild(divider);

        // All countries (FULL scroll)
        allCountries
            .filter(c => c.name.toLowerCase().includes(filter.toLowerCase()))
            .forEach(c => {
                const li = document.createElement("li");
                li.textContent = `${c.name} (${c.code})`;
                li.onclick = () => {
                    selected.textContent = c.code;
                    hiddenPrefix.value = c.code;
                    list.classList.add("d-none");
                };
                ul.appendChild(li);
            });
    }

    if (dropdown) {
        dropdown.onclick = () => {
            list.classList.toggle("d-none");
            renderList();
        };
    }

    if (search) {
        search.onkeyup = () => {
            renderList(search.value);
        };
    }

    // Close business WhatsApp dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (list && dropdown && !dropdown.contains(e.target) && !list.contains(e.target)) {
            list.classList.add('d-none');
        }
    });
</script> --}}

{{-- <script>
    // Initialize WhatsApp Dropdowns for Founders (works for existing and new founders)
    function initializeWhatsAppDropdowns() {
        $('.whatsapp-wrapper').each(function() {
            const $wrapper = $(this);
            const $dropdown = $wrapper.find('.prefix-dropdown');
            const $prefixList = $wrapper.next('.prefix-list');
            const $selectedPrefix = $wrapper.find('.selectedPrefix');
            const $hiddenInput = $wrapper.find('.whatsapp-prefix');
            const $searchInput = $prefixList.find('.prefixSearch');
            const $itemsList = $prefixList.find('.prefixItems');

            // Skip if already initialized
            if ($wrapper.data('initialized')) return;
            $wrapper.data('initialized', true);

            // Populate country codes if not already done
            if ($itemsList.children().length === 0) {
                // Top countries first
                topCountries.forEach(country => {
                    $itemsList.append(`
                        <li data-code="${country.code}" style="font-weight: 600;">
                            ${country.name} (${country.code})
                        </li>
                    `);
                });

                // Divider
                $itemsList.append('<li style="border-top: 1px solid #ddd;"></li>');

                // All countries
                allCountries.forEach(country => {
                    $itemsList.append(`
                        <li data-code="${country.code}">
                            ${country.name} (${country.code})
                        </li>
                    `);
                });
            }

            // Toggle dropdown
            $dropdown.off('click').on('click', function(e) {
                e.stopPropagation();
                
                // Close other dropdowns
                $('.prefix-list').not($prefixList).addClass('d-none');
                
                // Toggle current
                $prefixList.toggleClass('d-none');
            });

            // Search functionality
            $searchInput.off('input').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                $itemsList.find('li').each(function() {
                    const text = $(this).text().toLowerCase();
                    const hasBorder = $(this).css('border-top') !== '0px none rgb(0, 0, 0)';
                    
                    if (hasBorder) {
                        $(this).hide(); // Hide divider during search
                    } else {
                        $(this).toggle(text.includes(searchTerm));
                    }
                });

                // Show divider only if search is empty
                if (searchTerm === '') {
                    $itemsList.find('li[style*="border-top"]').show();
                }
            });

            // Select country code
            $itemsList.off('click').on('click', 'li', function() {
                const selectedCode = $(this).data('code');
                if (!selectedCode) return; // Skip if clicking on divider
                
                $selectedPrefix.text(selectedCode);
                $hiddenInput.val(selectedCode);
                $prefixList.addClass('d-none');
                $searchInput.val('');
                $itemsList.find('li').show();
            });
        });

        // Close dropdowns when clicking outside
        $(document).off('click.whatsappFounder').on('click.whatsappFounder', function(e) {
            if (!$(e.target).closest('.whatsapp-wrapper, .prefix-list').length) {
                $('.whatsapp-wrapper').next('.prefix-list').addClass('d-none');
            }
        });
    }
</script> --}}

{{-- <script>
    // Founder Management
        const founderIndex = $('#founders-container .border.rounded').length;


    function addFounder() {
        const newFounderHtml = `
            <div class="border rounded p-3 mb-3 founder-item">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Founder / Owner Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][name]" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Designation <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][designation]" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">WhatsApp Number</label>

                        <div class="whatsapp-wrapper" data-index="${founderIndex}">
                            <div class="prefix-dropdown">
                                <span class="selectedPrefix">+880</span>
                                <span class="arrow">▼</span>
                            </div>

                            <input type="hidden"
                                name="founders[${founderIndex}][whatsapp_prefix]"
                                class="whatsapp-prefix"
                                value="+880">

                            <input type="text"
                                name="founders[${founderIndex}][whatsapp_number]"
                                class="form-control whatsapp-input"
                                placeholder="Enter number"
                                value="">
                        </div>

                        <div class="prefix-list d-none">
                            <input type="text" class="prefixSearch" placeholder="Search country...">
                            <ul class="prefixItems"></ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Linkedin URL</label>
                        <input type="text" class="form-control" name="founders[${founderIndex}][linkedin]">
                    </div>
                    <div class="col-12 mb-2">
                        <button type="button" class="btn btn-danger btn-sm remove-founder">
                            <i class="fa fa-trash"></i> Remove Founder
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        $('#founders-container').append(newFounderHtml);
        founderIndex++;
        
        // Re-initialize WhatsApp dropdowns for the new founder
        initializeWhatsAppDropdowns();
    }

    // Remove Founder
    $(document).on('click', '.remove-founder', function() {
        $(this).closest('.founder-item').remove();
    });

    // Add Founder button click
    $(document).on('click', '#addFounderBtn', function() {
        addFounder();
    });
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="collaboration_open"]');
        const wrapper = document.getElementById('collaborationTypesWrapper');

        function toggleCollaborationTypes() {
            const selected = document.querySelector('input[name="collaboration_open"]:checked')?.value;

            if (selected === 'yes' || selected === 'maybe') {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';

                // clear checked checkboxes when "No"
                wrapper.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            }
        }

        radios.forEach(radio => {
            radio.addEventListener('change', toggleCollaborationTypes);
        });

        // run on page load (edit + validation error case)
        toggleCollaborationTypes();
    });
</script>

@if($step == 2)
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



    </script>
@endif



@endsection
