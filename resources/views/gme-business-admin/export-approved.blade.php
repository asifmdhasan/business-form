@extends('layouts.master')

@section('content')
<style>
    .export-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .export-header {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .export-header h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: bold;
    }
    
    .export-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
    }
    
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border-left: 4px solid #28a745;
    }
    
    .stat-card h3 {
        font-size: 2rem;
        margin: 0;
        color: #28a745;
        font-weight: bold;
    }
    
    .stat-card p {
        margin: 0.5rem 0 0 0;
        color: #666;
        font-size: 0.9rem;
    }
    
    .export-actions {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }
    
    .export-actions h4 {
        margin-bottom: 1rem;
        color: #333;
    }
    
    .btn-export {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s;
    }
    
    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-export i {
        font-size: 1.3rem;
    }
    
    .data-preview {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .data-preview h4 {
        margin-bottom: 1.5rem;
        color: #333;
    }
    
    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }
    
    .back-btn {
        margin-bottom: 1rem;
    }
    
    .approved-badge {
        background: #28a745;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
    }
    
    .verified-icon {
        color: #28a745;
        font-size: 1.2rem;
    }
</style>

<div class="export-container">
    
    {{-- Back Button --}}
    <div class="back-btn">
        <a href="{{ route('gme-business-admin.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Businesses
        </a>
    </div>
    
    {{-- Header --}}
    <div class="export-header">
        <h2><i class="fas fa-check-circle"></i> Export Approved Businesses</h2>
        <p>Export all verified and approved businesses in your directory</p>
    </div>
    
    {{-- Statistics Cards --}}
    <div class="stats-cards">
        <div class="stat-card">
            <h3>{{ $approvedCount }}</h3>
            <p>Total Approved Businesses</p>
        </div>
        <div class="stat-card">
            <h3>{{ $recentlyApprovedCount }}</h3>
            <p>Approved in Last 30 Days</p>
        </div>
        <div class="stat-card">
            <h3>{{ $categoriesCount }}</h3>
            <p>Business Categories</p>
        </div>
        <div class="stat-card">
            <h3>{{ $countriesCount }}</h3>
            <p>Countries Represented</p>
        </div>
    </div>
    
    {{-- Export Actions --}}
    <div class="export-actions">
        <h4><i class="fas fa-download"></i> Download Options</h4>
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('exportApproved') }}" class="btn btn-success btn-export">
                <i class="fas fa-file-csv"></i> Download Approved as CSV
            </a>
            <a href="{{ route('exportAll') }}" class="btn btn-primary btn-export">
                <i class="fas fa-download"></i> Download All Businesses
            </a>
            <a href="{{ route('exportPendingPage') }}" class="btn btn-info btn-export">
                <i class="fas fa-clock"></i> Download Pending Only
            </a>
        </div>
        
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i>
            <strong>Approved & Verified:</strong> These businesses have been reviewed and approved. 
            They are ready for publishing and promotion.
        </div>
    </div>
    
    {{-- Data Preview --}}
    <div class="data-preview">
        <h4><i class="fas fa-eye"></i> Approved Businesses Preview (Latest 10)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Countries</th>
                        <th>Approved On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($businesses as $business)
                    <tr>
                        <td>{{ $business->id }}</td>
                        <td>
                            @if($business->logo)
                                <img src="{{ asset('assets/' . $business->logo) }}" 
                                     class="img-thumbnail" 
                                     style="width:40px;height:40px;object-fit:cover;">
                            @else
                                <div class="bg-success text-white d-flex align-items-center justify-content-center" 
                                     style="width:40px;height:40px;border-radius:5px;">
                                    {{ strtoupper(substr($business->business_name ?? 'N', 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $business->business_name ?? '-' }}</strong>
                            <i class="fas fa-check-circle verified-icon ms-2" title="Verified"></i>
                            @if($business->updated_at->diffInDays(now()) <= 7)
                                <span class="badge bg-success ms-2">Recently Approved</span>
                            @endif
                        </td>
                        <td>{{ $business->category->name ?? '-' }}</td>
                        <td>
                            <span class="approved-badge">
                                <i class="fas fa-check"></i> APPROVED
                            </span>
                        </td>
                        <td>{{ $business->email ?? '-' }}</td>
                        <td>
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-external-link-alt"></i> Visit
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($business->countries_of_operation)
                                @php
                                    $countries = is_array($business->countries_of_operation) 
                                        ? $business->countries_of_operation 
                                        : json_decode($business->countries_of_operation, true) ?? [];
                                @endphp
                                <span class="badge bg-light text-dark">{{ implode(', ', $countries) }}</span>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $business->updated_at->format('d M Y') }}<br>
                            <small class="text-muted">{{ $business->updated_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <a href="{{ url('gme-business-admin/' . $business->id . '/edit') }}" 
                               class="btn btn-sm btn-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ url('gme-business-admin/' . $business->id . '/show') }}" 
                               class="btn btn-sm btn-info" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No approved businesses found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($businesses->count() > 0)
        <div class="mt-3">
            <p class="text-muted">
                <i class="fas fa-info-circle"></i> 
                Showing latest 10 approved businesses. Download CSV to view all {{ $approvedCount }} approved businesses.
            </p>
        </div>
        @endif
    </div>
    
    {{-- Additional Info --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-pie"></i> Top Categories</h5>
                    <ul class="list-unstyled">
                        @forelse($topCategories as $category)
                        <li class="mb-2">
                            <span class="badge bg-success">{{ $category->businesses_count }}</span>
                            <strong class="ms-2">{{ $category->name }}</strong>
                        </li>
                        @empty
                        <li class="text-muted">No data available</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-globe"></i> Top Countries</h5>
                    <ul class="list-unstyled">
                        @forelse($topCountries as $countryData)
                        <li class="mb-2">
                            <span class="badge bg-success">{{ $countryData['count'] }}</span>
                            <strong class="ms-2">{{ $countryData['country'] }}</strong>
                        </li>
                        @empty
                        <li class="text-muted">No data available</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection