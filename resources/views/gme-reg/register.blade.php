@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-2 rounded mb-3">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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

                    <form method="POST" action="{{ route('gme.business.save-step') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="step" value="{{ $step }}">
                        <input type="hidden" name="business_id" value="{{ $business->id ?? '' }}">

                        {{-- ================= STEP 1 ================= --}}
                        @if($step == 1)
                            <h5 class="fw-bold mb-3">Business & Founder Identity</h5>

                            <div class="mb-3">
                                <label class="form-label">Business Name *</label>
                                <input type="text" name="business_name" class="form-control"
                                    value="{{ old('business_name', $business->business_name ?? '') }}" required>
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
                                    <label class="form-label">Business Category *</label>
                                    <select class="form-select" name="business_category_id" id="business_category" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('business_category_id', $business->business_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Countries of Operation *</label>
                                        <select class="form-select search_select" name="countries_of_operation[]" multiple required>
                                            @foreach($countries as $country)
                                                <option value="{{ $country }}"
                                                    {{ in_array($country, old('countries_of_operation', json_decode($business->countries_of_operation ?? '[]', true))) ? 'selected' : '' }}>
                                                    {{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $business->email ?? '') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">WhatsApp Number *</label>
                                    <input type="text" name="whatsapp_number" class="form-control"
                                        value="{{ old('whatsapp_number', $business->whatsapp_number ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Website</label>
                                    <input type="website" name="website" class="form-control"
                                        value="{{ old('website', $business->website ?? '') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Business Address</label>
                                <textarea class="form-control" rows="2" name="business_address">{{ old('business_address', $business->business_address ?? '') }}</textarea>
                            </div>

                            

                            <hr>
                            <h6 class="fw-bold mb-3">Founder Information</h6>

                            <div id="founders-container">
                                @php
                                    $founders = old('founders', json_decode($business->founders ?? '[]', true)) ?: [['name'=>'','designation'=>'']];
                                @endphp

                                @foreach($founders as $index => $founder)
                                <div class="border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label"> Founder / Owner Full Name *</label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][name]"
                                                value="{{ $founder['name'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Designation *</label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][designation]"
                                                value="{{ $founder['designation'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">WhatsApp Number </label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][whatsapp_number]"
                                                value="{{ $founder['whatsapp_number'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label">Linkedin </label>
                                            <input type="text" class="form-control"
                                                name="founders[{{ $index }}][linkedin]"
                                                value="{{ $founder['linkedin'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-success btn-sm" onclick="addFounder()">
                                <i class="fa fa-plus"></i> Add Founder
                            </button>
                        @endif


                        {{-- ================= STEP 2 ================= --}}
                        @if($step == 2)
                            <h5 class="fw-bold mb-3">Business Size & Structure</h5>

                            <div class="mb-3">
                                <label class="form-label">Registration Status</label>
                                <select class="form-select" name="registration_status">
                                    <option value="">Select</option>
                                    <option value="registered_company">Registered Company</option>
                                    <option value="sole_proprietorship">Sole Proprietorship</option>
                                    <option value="partnership">Partnership</option>
                                    <option value="startup_early_stage">Startup Early Stage</option>
                                    <option value="home_based"> Home Based </option>
                                    <option value="not_registered_yet">Not Registered Yet</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Number of Employees</label>
                                    <select class="form-select" name="employee_count">
                                        <option value="">Select</option>
                                        <option value="1-3">1–3</option>
                                        <option value="4-10">4–10</option>
                                        <option value="11-25">11–25</option>
                                        <option value="26-50">26–50</option>
                                        <option value="51+">51+</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Operational Scale</label>
                                    <select class="form-select" name="operational_scale">
                                        <option value="">Select</option>
                                        <option value="local">Local</option>
                                        <option value="nationwide">Nationwide</option>
                                        <option value="international">International</option>
                                        <option value="online_only">Online Only</option>
                                        <option value="hybrid">Hybrid</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Annual Revenue (Optional)</label>
                                <select class="form-select" name="annual_revenue">
                                    <option value="">Select</option>
                                    <option value="under_10k">Under $10K</option>
                                    <option value="10k-50k">$10K – $50K</option>
                                    <option value="50k-200k">$50K – $200K</option>
                                    <option value="200k-1m">$200K – $1M</option>
                                    <option value="above_1m"> Above $1M</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Business Overview</label>
                                <textarea class="form-control" rows="4" name="business_overview"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Products / Services</label>
                                <select class="form-select search_select" multiple name="services_id[]" id="services">
                                    <option value="">Select category first</option>
                                </select>
                                {{-- <select class="form-select search_select" multiple name="services_id[]">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select> --}}
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Business Logo</label>
                                <input type="file" class="form-control" name="logo">
                            </div>
                        @endif

                        {{-- ================= STEP 3 ================= --}}
                        @if($step == 3)
                            <h5 class="fw-bold mb-3">Islamic Ethics & Community</h5>

                            <div class="mb-3">
                                <label class="form-label">Avoid Interest (Riba)? *</label>
                                <select class="form-select" name="avoid_riba" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="partially_transitioning">Partially Transitioning</option>
                                    <option value="no">No</option>
                                    <option value="prefer_not_to_say"> Prefer Not to Say </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Avoid Haram Products? *</label>
                                <select class="form-select" name="avoid_haram_products" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="partially_compliant">Partially Compliant</option>
                                    <option value="no">No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fair Pricing</label>
                                <select class="form-select" name="fair_pricing" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="mostly">Mostly</option>
                                    <option value="needs_improvement">Needs Improvement</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Open for Guidance</label>
                                <select class="form-select" name="open_for_guidance" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                    <option value="maybe">Maybe</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Collaboration Open</label>
                                <select class="form-select" name="collaboration_open" required>
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                    <option value="maybe">Maybe</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ethical Description</label>
                                <textarea class="form-control" rows="4" name="ethical_description"></textarea>
                            </div>

                            

                            {{-- <div class="mb-3">
                                <label class="form-label">Ethical Description</label>
                                <textarea class="form-control" rows="4" name="ethical_description"></textarea>
                            </div> --}}
                            

                            <hr>
                            <h6 class="fw-bold">Collaboration Interest</h6>

                            @foreach(['Partnerships','Investment','Marketing','Supply Chain','Training'] as $type)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="collaboration_types[]" value="{{ $type }}">
                                <label class="form-check-label">{{ $type }}</label>
                            </div>
                            @endforeach
                        @endif

                        {{-- ================= STEP 4 ================= --}}
                        @if($step == 4)
                            <h5 class="fw-bold mb-3">Consent & Approval</h5>

                            <div class="alert alert-warning">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="info_accuracy" required>
                                    <label class="form-check-label">
                                        I confirm all provided information is accurate *
                                    </label>
                                </div>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="allow_publish">
                                <label class="form-check-label">
                                    Allow GME to publish my business profile
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Digital Signature *</label>
                                <input type="text" class="form-control" name="digital_signature" required>
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

                        {{-- ================= STEP 4 (example) =================
                        @if($step == 4)
                        <h5 class="fw-bold mb-3">Consent & Approval</h5>

                        <div class="alert alert-info">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="info_accuracy" required>
                                <label class="form-check-label">
                                    I confirm all information is accurate *
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Digital Signature *</label>
                            <input type="text" class="form-control" name="digital_signature" required>
                        </div>
                        @endif

                        <div class="d-flex justify-content-between mt-4">
                            @if($step > 1)
                                <a href="{{ route('gme.business.register', ['step' => $step - 1, 'business_id' => $business->id ?? '']) }}"
                                   class="btn btn-secondary">
                                    ← Previous
                                </a>
                            @else
                                <span></span>
                            @endif

                            <button type="submit"
                                    class="btn {{ $step < 4 ? 'btn-primary' : 'btn-success' }}">
                                {{ $step < 4 ? 'Save & Next →' : 'Submit Application' }}
                            </button>
                        </div>

                    </form> --}}

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
let founderIndex = {{ count($founders ?? []) }};

function addFounder() {
    $('#founders-container').append(`
        <div class="border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" name="founders[${founderIndex}][name]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Designation *</label>
                    <input type="text" class="form-control" name="founders[${founderIndex}][designation]" required>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Whatsapp Number</label>
                    <input type="text" class="form-control" name="founders[${founderIndex}][whatsapp_number]" >
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Linkedin</label>
                    <input type="text" class="form-control" name="founders[${founderIndex}][linkedin]" >
                </div>
            </div>
        </div>
    `);
    founderIndex++;
}
</script>







@if($step == 2)
<script>
$(document).ready(function () {

    let categoryId = "{{ $business->business_category_id ?? '' }}";
    let $services = $('#services');

    if (!categoryId || !$services.length) {
        return;
    }

    $.ajax({
        url: '/get-services/' + categoryId,
        type: 'GET',
        success: function (data) {
            $services.empty();

            if (data.length === 0) {
                $services.append('<option value="">No services found</option>');
                return;
            }

            $.each(data, function (index, service) {
                $services.append(
                    `<option value="${service.id}">${service.name}</option>`
                );
            });
        }
    });

});
</script>
@endif



@endsection
