@extends('layouts.master')

@section('content')
<style>
    /* ---------- Premium Theme ---------- */
    body {
        font-family: 'Inter', sans-serif;
        color: #2E2E2E;
        background-color: #F7F6F3;
    }

    .card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        background: #fff;
        margin-bottom: 2rem;
    }

    .card-header {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        background: linear-gradient(120deg, #9C7D2D, #C6A560);
        letter-spacing: 0.5px;
    }

    label {
        font-weight: 500;
        color: #2E2E2E;
    }

    input.form-control, select.form-control, select.form-select, textarea.form-control {
        border: 1px solid #D1C7A1;
        border-radius: 0.5rem;
        padding: 0.625rem 0.75rem;
        transition: 0.3s;
        background-color: #FAF8F3;
        color: #2E2E2E;
    }

    input.form-control:focus, select.form-control:focus, select.form-select:focus, textarea.form-control:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 8px rgba(156, 125, 45, 0.4);
        outline: none;
        background-color: #FFFDF8;
    }

    .btn-primary {
        background-color: #9C7D2D;
        border-color: #9C7D2D;
        border-radius: 0.5rem;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(120deg, #C6A560, #9C7D2D);
        box-shadow: 0 5px 15px rgba(156, 125, 45, 0.4);
    }

    .btn-secondary {
        background-color: #ECE6D9;
        border-color: #D1C7A1;
        color: #2E2E2E;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .btn-outline-secondary {
        border-color: #D1C7A1;
        color: #2E2E2E;
        min-width: 140px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary.active, .btn-outline-secondary:hover {
        background-color: #9C7D2D;
        color: #fff;
        border-color: #9C7D2D;
    }

    .question-label {
        display: inline-block;
        width: 220px;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #2E2E2E;
    }

    #pageLoader {
        transition: opacity 0.2s ease;
        background: rgba(255,255,255,0.85);
    }

    .image-preview-wrapper {
        position: relative;
        display: inline-block;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .image-preview-wrapper img {
        border-radius: 0.5rem;
        border: 1px solid #D1C7A1;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 0.5rem;
    }

    .image-preview-wrapper:hover .image-overlay {
        opacity: 1;
    }

    .view-image-btn {
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        color: #fff;
        font-weight: 500;
        border-radius: 0.25rem;
    }

    .view-image-btn:hover {
        transform: scale(1.05);
    }

    .form-check-label {
        color: #2E2E2E;
        font-weight: 500;
    }

    .form-check-input:checked {
        background-color: #9C7D2D;
        border-color: #9C7D2D;
    }

    .form-check-input:focus {
        border-color: #9C7D2D;
        box-shadow: 0 0 8px rgba(156,125,45,0.4);
    }

    textarea.form-control {
        background-color: #FAF8F3;
        resize: none;
    }

    hr {
        border-top: 1px solid #D1C7A1;
    }

    .text-right button, .text-right a {
        border-radius: 0.5rem;
    }

    #pageLoader .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.35rem;
    }

</style>

<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('gme-business-admin.update', $business->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- ================= Step 1: Business Identity ================= --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Step 1: Business Identity</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Business Name <span class="text-danger">*</span></label>
                        <input type="text" name="business_name" class="form-control" value="{{ old('business_name', $business->business_name) }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Year Established</label>
                        <input type="text" name="year_established" class="form-control" value="{{ old('year_established', $business->year_established) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Business Category</label>
                        <select name="business_category_id" id="business_category" class="form-control @error('business_category_id') is-invalid @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('business_category_id', $business->business_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('business_category_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label">Countries of Operation *</label>
                        @php
                            $savedCountries = old('countries_of_operation', is_array($business->countries_of_operation) ? $business->countries_of_operation : (is_string($business->countries_of_operation) ? json_decode($business->countries_of_operation, true) : []));
                        @endphp
                        <select class="form-select search_select" name="countries_of_operation[]" multiple required>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ in_array($country, $savedCountries) ? 'selected' : '' }}> {{ $country }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Short Introduction</label>
                        <textarea name="short_introduction" class="form-control" rows="2">{{ old('short_introduction', $business->short_introduction) }}</textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Business Address</label>
                        <textarea name="business_address" class="form-control" rows="2">{{ old('business_address', $business->business_address) }}</textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $business->email) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Website</label>
                        <input type="text" name="website" class="form-control" value="{{ old('website', $business->website) }}">
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="row mt-3">
                    <div class="card-header mt-2">Social Media:</div>
                    <div class="col-md-6 mt-2 form-group">
                        <label>Facebook</label>
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $business->facebook) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Instagram</label>
                        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $business->instagram) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>LinkedIn</label>
                        <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $business->linkedin) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>YouTube</label>
                        <input type="text" name="youtube" class="form-control" value="{{ old('youtube', $business->youtube) }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Online Store</label>
                        <input type="text" name="online_store" class="form-control" value="{{ old('online_store', $business->online_store) }}">
                    </div>
                </div>

                {{-- Founder & Contact --}}
                <div class="card-header">Founder & Contact:</div>
                <div class="card-body" id="founders-container">
                    @php
                        $founders = old('founders', is_array($business->founders) ? $business->founders : (is_string($business->founders) ? json_decode($business->founders, true) : []));
                    @endphp

                    @if(count($founders) > 0)
                        @foreach($founders as $index => $founder)
                            <div class="row founder-row mb-2">
                                <div class="col-md-3 form-group">
                                    <label>Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="founders[{{ $index }}][name]" class="form-control" value="{{ $founder['name'] ?? '' }}" required>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>Designation</label>
                                    <input type="text" name="founders[{{ $index }}][designation]" class="form-control" value="{{ $founder['designation'] ?? '' }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>WhatsApp</label>
                                    <input type="text" name="founders[{{ $index }}][whatsapp]" class="form-control" value="{{ $founder['whatsapp'] ?? '' }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>LinkedIn</label>
                                    <input type="url" name="founders[{{ $index }}][linkedin]" class="form-control" value="{{ $founder['linkedin'] ?? '' }}">
                                </div>
                                <div class="col-md-12 mt-2 text-end">
                                    <button type="button" class="btn btn-danger remove-founder">Remove</button>
                                </div>
                                <hr class="my-2">
                            </div>
                        @endforeach
                    @else
                        <div class="row founder-row mb-2">
                            <div class="col-md-3 form-group">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="founders[0][name]" class="form-control" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Designation</label>
                                <input type="text" name="founders[0][designation]" class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>WhatsApp</label>
                                <input type="text" name="founders[0][whatsapp]" class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>LinkedIn</label>
                                <input type="url" name="founders[0][linkedin]" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 text-end">
                                <button type="button" class="btn btn-danger remove-founder">Remove</button>
                            </div>
                            <hr class="my-2">
                        </div>
                    @endif
                </div>
                <button type="button" id="add-founder" class="btn btn-primary mt-2">Add Founder</button>
            </div>
        </div>

        {{-- ================= Step 2: Business Size, Structure, Description & Files ================= --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Step 2: Business Size, Structure, Description & Files</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label>Registration Status</label>
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
                                <option value="{{ $key }}" {{ old('registration_status', $business->registration_status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Employee Count</label>
                        <select name="employee_count" class="form-control">
                            @php $employeeCounts = ['1-3','4-10','11-25','26-50','51+']; @endphp
                            @foreach($employeeCounts as $count)
                                <option value="{{ $count }}" {{ old('employee_count', $business->employee_count) == $count ? 'selected' : '' }}>{{ $count }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Operational Scale</label>
                        <select name="operational_scale" class="form-control">
                            @php $operationalScales = ['local','nationwide','international','online_only','hybrid']; @endphp
                            @foreach($operationalScales as $scale)
                                <option value="{{ $scale }}" {{ old('operational_scale', $business->operational_scale) == $scale ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$scale)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Annual Revenue</label>
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
                                <option value="{{ $key }}" {{ old('annual_revenue', $business->annual_revenue) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Business Overview --}}
                    <div class="col-md-12 form-group mt-3">
                        <label>Business Overview</label>
                        <textarea name="business_overview" class="form-control" rows="3">{{ old('business_overview', $business->business_overview) }}</textarea>
                    </div>

                    {{-- Products/Services --}}
                    <div class="col-md-12 form-group">
                        <label class="form-label">Products / Services</label>
                        <select class="form-select search_select @error('services_id') is-invalid @enderror" multiple name="services_id[]" id="services">
                            <!-- Options loaded via JS -->
                        </select>
                    </div>

                    {{-- Logo, Cover, Photos, Documents --}}
                    <div class="row mt-4">
                        <div class="col-md-6">
                            {{-- Logo --}}
                            <div class="col-md-6 form-group">
                                <label>Logo</label>
                                <div class="mb-2 position-relative image-preview-wrapper">
                                    @php
                                        $logoPath = $business->getRawOriginal('logo');
                                        $logoPath = is_string($logoPath) ? str_replace(['\\/', '\\'], '/', $logoPath) : $logoPath;
                                    @endphp
                                    @if($logoPath)
                                        <img id="logoPreview" src="{{ asset('assets/' . $logoPath) }}" class="img-thumbnail" style="max-width:100px; max-height:100px; object-fit: cover;" alt="Business Logo">
                                        <div class="image-overlay">
                                            <a href="{{ asset('assets/' . $logoPath) }}" target="_blank" class="btn btn-sm btn-primary view-image-btn">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </div>
                                    @else
                                        <img id="logoPreview" src="" class="img-thumbnail d-none" style="max-width:100px; max-height:100px; object-fit: cover;">
                                        <div class="text-muted small">No logo uploaded</div>
                                    @endif
                                </div>
                                <input type="file" name="logo" class="form-control-file" accept="image/*" onchange="previewImage(this, 'logoPreview')">
                            </div>

                            {{-- Cover Photo --}}
                            <div class="col-md-6 form-group">
                                <label>Cover Photo</label>
                                <div class="mb-2 position-relative image-preview-wrapper">
                                    @php
                                        $coverPath = $business->getRawOriginal('cover_photo');
                                        $coverPath = is_string($coverPath) ? str_replace(['\\/', '\\'], '/', $coverPath) : $coverPath;
                                    @endphp
                                    @if($coverPath)
                                        <img id="coverPreview" src="{{ asset('assets/' . $coverPath) }}" class="img-thumbnail" style="max-width:100px; max-height:100px; object-fit: cover;" alt="Cover Photo">
                                        <div class="image-overlay">
                                            <a href="{{ asset('assets/' . $coverPath) }}" target="_blank" class="btn btn-sm btn-primary view-image-btn">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                        </div>
                                    @else
                                        <img id="coverPreview" src="" class="img-thumbnail d-none" style="max-width:100px; max-height:100px; object-fit: cover;">
                                        <div class="text-muted small">No cover photo uploaded</div>
                                    @endif
                                </div>
                                <input type="file" name="cover_photo" class="form-control-file" accept="image/*" onchange="previewImage(this, 'coverPreview')">
                            </div>

                            {{-- Business Photos --}}
                            <div class="col-md-12 mt-3 form-group">
                                <label>Business Photos</label>
                                <div class="mb-2 d-flex flex-wrap gap-2" id="photosPreview">
                                    @if($business->businessPhotos->count())
                                        @foreach($business->businessPhotos as $index => $photo)
                                            @php $fullPath = asset('assets/' . $photo->image_url); @endphp
                                            <div class="position-relative image-preview-wrapper">
                                                <img src="{{ $fullPath }}" class="img-thumbnail" style="max-width:100px; max-height:100px; object-fit: cover;" alt="Business Photo {{ $index + 1 }}">
                                                <div class="image-overlay">
                                                    <a href="{{ $fullPath }}" target="_blank" class="btn btn-sm btn-primary view-image-btn">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-muted small">No photos uploaded</div>
                                    @endif
                                </div>
                                <input type="file" name="photos[]" class="form-control-file" multiple accept="image/*" onchange="previewMultipleImages(this, 'photosPreview')">
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Registration Document --}}
                            <div class="col-md-12 form-group">
                                <label>Registration Document</label>
                                <div class="mb-2">
                                    @if($business->registration_document)
                                        <a href="{{ asset('assets/' . $business->registration_document) }}" target="_blank" class="btn btn-info btn-sm">View Document</a>
                                    @endif
                                </div>
                                <input type="file" name="registration_document" class="form-control-file">
                            </div>

                            {{-- Business Profile --}}
                            <div class="col-md-12 form-group mt-3">
                                <label>Business Profile</label>
                                <div class="mb-2">
                                    @if($business->business_profile)
                                        <a href="{{ asset('assets/' . $business->business_profile) }}" target="_blank" class="btn btn-info btn-sm">View Profile</a>
                                    @endif
                                </div>
                                <input type="file" name="business_profile" class="form-control-file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= Step 3: Ethics & Collaboration ================= --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Step 3: Ethics & Collaboration</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Ethics & Compliance</label>
                    <textarea name="ethics_compliance" class="form-control" rows="3">{{ old('ethics_compliance', $business->ethics_compliance) }}</textarea>
                </div>
                <div class="form-group mt-2">
                    <label>Collaboration Opportunities</label>
                    <textarea name="collaboration_opportunities" class="form-control" rows="3">{{ old('collaboration_opportunities', $business->collaboration_opportunities) }}</textarea>
                </div>
            </div>
        </div>

        {{-- ================= Step 4: Consent & Approval ================= --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Step 4: Consent & Approval</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="consent" name="consent" {{ old('consent', $business->consent) ? 'checked' : '' }}>
                    <label class="form-check-label" for="consent">
                        I consent to share my business information.
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" value="1" id="approved" name="approved" {{ old('approved', $business->approved) ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">
                        My business information has been approved.
                    </label>
                </div>
            </div>
        </div>

        {{-- ================= Step 5: Status ================= --}}
        <div class="card mb-3">
            <div class="card-header bg-success text-white">Step 5: Status</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        @php
                            $statuses = ['Active'=>'Active','Inactive'=>'Inactive','Pending'=>'Pending'];
                        @endphp
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $business->status) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Submit --}}
        <div class="text-right mb-5 mt-5" style="margin-left: 1rem;">
            <button type="submit" class="btn btn-primary">Update Business</button>
            <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

{{-- Loader --}}
<div id="pageLoader" class="position-fixed top-0 start-0 w-100 h-100 d-none" style="background: rgba(255,255,255,0.8); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center">
            <div class="spinner-border text-primary mb-3" role="status"></div>
            <div class="fw-semibold">Please wait, Status has been updated...</div>
        </div>
    </div>
</div>

{{-- JS --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
let founderIndex = {{ count($founders) }};

document.getElementById('add-founder').addEventListener('click', function() {
    const container = document.getElementById('founders-container');
    const row = document.createElement('div');
    row.classList.add('row', 'founder-row', 'mb-2');
    row.innerHTML = `
        <div class="col-md-3 form-group">
            <label>Full Name <span class="text-danger">*</span></label>
            <input type="text" name="founders[${founderIndex}][name]" class="form-control" required>
        </div>
        <div class="col-md-3 form-group">
            <label>Designation</label>
            <input type="text" name="founders[${founderIndex}][designation]" class="form-control">
        </div>
        <div class="col-md-3 form-group">
            <label>WhatsApp</label>
            <input type="text" name="founders[${founderIndex}][whatsapp]" class="form-control">
        </div>
        <div class="col-md-3 form-group">
            <label>LinkedIn</label>
            <input type="url" name="founders[${founderIndex}][linkedin]" class="form-control">
        </div>
        <div class="col-md-12 mt-2 text-end">
            <button type="button" class="btn btn-danger remove-founder">Remove</button>
        </div>
        <hr class="my-2">
    `;
    container.appendChild(row);
    founderIndex++;
});

document.addEventListener('click', function(e) {
    if(e.target.classList.contains('remove-founder')) {
        e.target.closest('.founder-row').remove();
    }
});

// Form loader
$(document).ready(function () {
    $('form').on('submit', function () {
        $('#pageLoader').removeClass('d-none');
        $(this).find('button[type="submit"]').prop('disabled', true);
    });
});

// Preview functions
function previewImage(input, previewId) {
    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = function(e){
            let img = document.getElementById(previewId);
            img.src = e.target.result;
            img.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewMultipleImages(input, containerId){
    let container = document.getElementById(containerId);
    container.innerHTML = '';
    if(input.files){
        Array.from(input.files).forEach(file=>{
            let reader = new FileReader();
            reader.onload = function(e){
                let wrapper = document.createElement('div');
                wrapper.classList.add('position-relative','image-preview-wrapper','me-2','mb-2');
                wrapper.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width:100px; max-height:100px; object-fit: cover;">`;
                container.appendChild(wrapper);
            }
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endsection
