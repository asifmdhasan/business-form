@extends('layouts.master')

@section('content')

<style>
:root {
    --gold: #9C7D2D;
}

.section-title {
    color: var(--gold);
    border-bottom: 2px solid var(--gold);
    padding-bottom: .4rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.info-label {
    font-weight: 600;
    color: #555;
}

.info-value {
    color: #222;
}

.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
}

.badge-status {
    font-size: .9rem;
    padding: .4rem .75rem;
}

.print-btn {
    background: var(--gold);
    border: none;
    color: #fff;
}
.print-btn:hover {
    background: #806522;
}

@media print {
    .no-print {
        display: none !important;
    }
}
</style>

<div class="container-fluid mb-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h3 class="fw-bold text-uppercase">{{ $business->business_name }}</h3>
        <div>
            {{-- <a href="{{ route('gme-business-admin.print', $business->id) }}"
               class="btn print-btn">
                <i class="fa fa-print"></i> Print
            </a> --}}
            <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">
                Back
            </a>
        </div>
    </div>

    {{-- STATUS --}}
    <div class="mb-3">
        <span class="badge badge-status bg-{{
            $business->status === 'approved' ? 'success' :
            ($business->status === 'pending' ? 'info' :
            ($business->status === 'rejected' ? 'danger' : 'secondary'))
        }}">
            {{ strtoupper($business->status) }}
        </span>
    </div>

    {{-- BUSINESS IDENTITY --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Business Identity</h5>
            <div class="row">
                <div class="col-md-6"><span class="info-label">Category:</span> <span class="info-value">{{ $business->category->name ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">Year Established:</span> <span class="info-value">{{ $business->year_established ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">Countries of Operation:</span> <span class="info-value">
                    {{ is_array($business->countries_of_operation) ? implode(', ', $business->countries_of_operation) : '-' }}
                </span></div>
                <div class="col-md-6"><span class="info-label">Website:</span> <span class="info-value">{{ $business->website ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">Email:</span> <span class="info-value">{{ $business->email ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">WhatsApp:</span> <span class="info-value">{{ $business->whatsapp_number ?? '-' }}</span></div>
            </div>
        </div>
    </div>

    {{-- SOCIAL LINKS --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Social & Online Presence</h5>
            <div class="row">
                <div class="col-md-6"><span class="info-label">Facebook:</span> <span class="info-value">{{ $business->facebook ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">Instagram:</span> <span class="info-value">{{ $business->instagram ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">LinkedIn:</span> <span class="info-value">{{ $business->linkedin ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">YouTube:</span> <span class="info-value">{{ $business->youtube ?? '-' }}</span></div>
                <div class="col-md-6"><span class="info-label">Online Store:</span> <span class="info-value">{{ $business->online_store ?? '-' }}</span></div>
            </div>
        </div>
    </div>

    {{-- FOUNDERS --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Founders</h5>
            <div class="row">
                @php
                    $founders = is_array($business->founders)
                        ? $business->founders
                        : json_decode($business->founders ?? '[]', true);
                @endphp

                @forelse($founders as $f)
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 h-100">
                            <strong>{{ $f['name'] ?? '-' }}</strong><br>
                            {{ $f['designation'] ?? '-' }}<br>
                            WhatsApp: {{ $f['whatsapp'] ?? '-' }}<br>
                            LinkedIn: {{ $f['linkedin'] ?? '-' }}
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-muted">No founders added.</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- BUSINESS DETAILS --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Business Overview</h5>
            <p>{{ $business->business_overview ?? '-' }}</p>
            <div class="row">
                <div class="col-md-6"><span class="info-label">Registration:</span> <span class="info-value">{{ ucfirst(str_replace('_',' ',$business->registration_status)) }}</span></div>
                <div class="col-md-6"><span class="info-label">Employees:</span> <span class="info-value">{{ $business->employee_count }}</span></div>
                <div class="col-md-6"><span class="info-label">Annual Revenue:</span> <span class="info-value">{{ $business->annual_revenue }}</span></div>
                <div class="col-md-6"><span class="info-label">Operational Scale:</span> <span class="info-value">{{ ucfirst($business->operational_scale ?? '-') }}</span></div>
            </div>
        </div>
    </div>

    {{-- ETHICS --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Ethics & Values</h5>
            <div class="row">
                <div class="col-md-6"><span class="info-label">Avoid Riba:</span> <span class="info-value">{{ ucfirst($business->avoid_riba) }}</span></div>
                <div class="col-md-6"><span class="info-label">Avoid Haram Products:</span> <span class="info-value">{{ ucfirst($business->avoid_haram_products) }}</span></div>
                <div class="col-md-6"><span class="info-label">Fair Pricing:</span> <span class="info-value">{{ ucfirst($business->fair_pricing) }}</span></div>
                <div class="col-md-6"><span class="info-label">Open for Guidance:</span> <span class="info-value">{{ ucfirst($business->open_for_guidance) }}</span></div>
            </div>
            <p class="mt-2">{{ $business->ethical_description ?? '-' }}</p>
        </div>
    </div>

    {{-- COLLABORATION --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Collaboration & Community</h5>
            <div class="row">
                <div class="col-md-6"><span class="info-label">Collaboration Open:</span> <span class="info-value">{{ ucfirst($business->collaboration_open) }}</span></div>
                <div class="col-md-6"><span class="info-label">Collaboration Types:</span>
                    <span class="info-value">
                        {{ is_array($business->collaboration_types) ? implode(', ', $business->collaboration_types) : '-' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- FILES --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="section-title">Documents & Media</h5>

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        {{-- Logo --}}
                        <div class="col-md-12 mb-3">
                            <span class="info-label">Logo:</span>
                            @if($business->logo)
                            <div class="position-relative" style="width:200px;">
                                <img src="{{ asset('assets/'.$business->logo) }}" class="img-fluid rounded" style="width:100%;height:auto;">
                                <a href="{{ asset('assets/'.$business->logo) }}" target="_blank"
                                class="btn btn-sm btn-primary position-absolute top-50 start-50 translate-middle d-none view-btn">
                                    View
                                </a>
                            </div>
                            @else
                                <p>-</p>
                            @endif
                        </div>
                        {{-- Cover Photo --}}
                        <div class="col-md-12 mb-3">
                            <span class="info-label">Cover Photo:</span>
                            @if($business->cover_photo)
                            <div class="position-relative" style="width:200px;">
                                <img src="{{ asset('assets/'.$business->cover_photo) }}" class="img-fluid rounded" style="width:100%;height:auto;">
                                <a href="{{ asset('assets/'.$business->cover_photo) }}" target="_blank"
                                class="btn btn-sm btn-primary position-absolute top-50 start-50 translate-middle d-none view-btn">
                                    View
                                </a>
                            </div>
                            @else
                                <p>-</p>
                            @endif
                        </div>



                    </div>
                </div>
                <div class="col-md-6" style="padding-top: 6rem;">
                    {{-- Business Profile --}}
                    <div class="col-md-12 mb-3">
                        <span class="info-label">Business Profile:</span>
                        @if($business->business_profile)
                            <a href="{{ asset('assets/'.$business->business_profile) }}" target="_blank" class="btn btn-sm btn-primary">
                                View
                            </a>
                        @else
                            <p>-</p>
                        @endif
                    </div>

                    {{-- Product Catalogue --}}
                    <div class="col-md-12 mb-3">
                        <span class="info-label">Product Catalogue:</span>
                        @if($business->product_catalogue)
                            <a href="{{ asset('assets/'.$business->product_catalogue) }}" target="_blank" class="btn btn-sm btn-primary">
                                View
                            </a>
                        @else
                            <p>-</p>
                        @endif
                    </div>

                    {{-- Registration Document --}}
                    <div class="col-md-12 mb-3">
                        <span class="info-label">Registration Document:</span>
                        @if($business->registration_document)
                            <a href="{{ asset('assets/'.$business->registration_document) }}" target="_blank" class="btn btn-sm btn-primary">
                                View
                            </a>
                        @else
                            <p>-</p>
                        @endif
                    </div>
                </div>

                {{-- Gallery Photos --}}
                        <div class="col-12 mt-3">
                            <span class="info-label">Photos:</span>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                @foreach($business->businessPhotos as $photo)
                                    <div class="position-relative" style="width:120px; height:120px;">
                                        <img src="{{ asset('assets/'.$photo->image_url) }}"
                                            style="width:100%; height:100%; object-fit:cover; border-radius:8px;">
                                        <a href="{{ asset('assets/'.$photo->image_url) }}" target="_blank"
                                        class="btn btn-sm btn-primary position-absolute top-50 start-50 translate-middle d-none view-btn">
                                            View
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

            </div>
        </div>
    </div>


</div>
<script>
document.querySelectorAll('.position-relative').forEach(function(container) {
    const btn = container.querySelector('.view-btn');
    const img = container.querySelector('img');

    container.addEventListener('mouseenter', function() {
        btn.classList.remove('d-none');
    });
    container.addEventListener('mouseleave', function() {
        btn.classList.add('d-none');
    });
});
</script>
@endsection
