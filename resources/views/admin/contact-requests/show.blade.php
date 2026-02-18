@extends('layouts.master')
@section('content')

<style>
    :root {
        --primary-color: #576829;
        --primary-dark: #3d4a1c;
        --primary-light: #6e8233;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        color: white;
    }

    .detail-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .detail-card .card-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 1rem 1.5rem;
        font-weight: 600;
    }

    .detail-card .card-body {
        padding: 1.5rem;
    }

    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #666;
        min-width: 180px;
    }

    .info-value {
        color: #333;
        flex: 1;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #000;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    .badge-approved {
        background-color: #28a745;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    .badge-rejected {
        background-color: #dc3545;
        color: white;
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }

    .btn-approve {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-approve:hover {
        background-color: #218838;
        color: white;
    }

    .btn-reject {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-reject:hover {
        background-color: #c82333;
        color: white;
    }

    .btn-back {
        background-color: var(--primary-color);
        color: white;
        border: none;
    }

    .btn-back:hover {
        background-color: var(--primary-dark);
        color: white;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }
</style>


<div class="container-fluid py-4">
    
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-2">
                    <i class="fas fa-envelope-open me-2"></i>
                    Contact Request Details
                </h2>
                <p class="mb-0 opacity-75">Request ID: #{{ $request->id }}</p>
            </div>
            <div>
                <a href="{{ route('contact-requests.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Requester Information -->
        <div class="col-md-6">
            <div class="detail-card">
                <div class="card-header">
                    <i class="fas fa-user me-2"></i>Requester Information
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label">Full Name:</div>
                        <div class="info-value">{{ $request->requester_name }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Email:</div>
                        <div class="info-value">
                            <a href="mailto:{{ $request->requester_email }}">{{ $request->requester_email }}</a>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Phone:</div>
                        <div class="info-value">
                            <a href="tel:{{ $request->requester_phone }}">{{ $request->requester_phone }}</a>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Company:</div>
                        <div class="info-value">{{ $request->requester_company ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Designation:</div>
                        <div class="info-value">{{ $request->requester_designation ?? 'N/A' }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Country:</div>
                        <div class="info-value">{{ $request->requester_country }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Business & Request Information -->
        <div class="col-md-6">
            <div class="detail-card">
                <div class="card-header">
                    <i class="fas fa-building me-2"></i>Business & Request Information
                </div>
                <div class="card-body">
                    <div class="info-row">
                        <div class="info-label">Business Name:</div>
                        <div class="info-value">
                            <a href="{{ route('gme-business-admin.show', $request->business_id) }}" 
                               style="color: var(--primary-color);">
                                {{ $request->business->business_name ?? 'N/A' }}
                            </a>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Purpose:</div>
                        <div class="info-value">{{ $request->purpose }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Status:</div>
                        <div class="info-value">
                            @php
                                $badgeClass = match($request->status) {
                                    'pending' => 'badge-pending',
                                    'approved' => 'badge-approved',
                                    'rejected' => 'badge-rejected',
                                    default => 'badge-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Requested On:</div>
                        <div class="info-value">{{ $request->created_at->format('d M Y, h:i A') }}</div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Last Updated:</div>
                        <div class="info-value">{{ $request->updated_at->format('d M Y, h:i A') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Message -->
    @if($request->message)
    <div class="row">
        <div class="col-12">
            <div class="detail-card">
                <div class="card-header">
                    <i class="fas fa-comment-alt me-2"></i>Additional Message
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $request->message }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    @if($request->status === 'pending')
    <div class="row">
        <div class="col-12">
            <div class="detail-card">
                <div class="card-body">
                    <h5 class="mb-3">Actions</h5>
                    <div class="action-buttons">
                        <form action="{{ route('contact-requests.approve', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-approve btn-lg" 
                                    onclick="return confirm('Are you sure you want to approve this request?')">
                                <i class="fas fa-check me-2"></i>Approve Request
                            </button>
                        </form>

                        <form action="{{ route('contact-requests.reject', $request->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-reject btn-lg"
                                    onclick="return confirm('Are you sure you want to reject this request?')">
                                <i class="fas fa-times me-2"></i>Reject Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection