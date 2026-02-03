@extends('layouts.master')

@section('content')
<style>
    .export-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .export-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        border-left: 4px solid #667eea;
    }
    
    .stat-card h3 {
        font-size: 2rem;
        margin: 0;
        color: #667eea;
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
        <h2><i class="fas fa-file-export"></i> Export All Businesses</h2>
        <p>Export all businesses excluding drafts in CSV format</p>
    </div>
    
    {{-- Statistics Cards --}}
    <div class="stats-cards">
        <div class="stat-card">
            <h3>{{ $totalCount }}</h3>
            <p>Total Businesses (Excluding Drafts)</p>
        </div>
        <div class="stat-card">
            <h3>{{ $pendingCount }}</h3>
            <p>Pending Businesses</p>
        </div>
        <div class="stat-card">
            <h3>{{ $approvedCount }}</h3>
            <p>Approved Businesses</p>
        </div>
        <div class="stat-card">
            <h3>{{ $rejectedCount }}</h3>
            <p>Rejected Businesses</p>
        </div>
    </div>
    
    {{-- Export Actions --}}
    <div class="export-actions">
        <h4><i class="fas fa-download"></i> Download Options</h4>
        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('exportAll') }}" class="btn btn-success btn-export">
                <i class="fas fa-file-csv"></i> Download All as CSV
            </a>
            <a href="{{ route('exportPendingPage') }}" class="btn btn-info btn-export">
                <i class="fas fa-clock"></i> Download Pending Only
            </a>
            <a href="{{ route('exportApprovedPage') }}" class="btn btn-primary btn-export">
                <i class="fas fa-check-circle"></i> Download Approved Only
            </a>
        </div>
        
        <div class="alert alert-info mt-3">
            <i class="fas fa-info-circle"></i>
            <strong>Note:</strong> The CSV file will include all business details including contact information, 
            social media links, business overview, and ethical compliance information.
        </div>
    </div>
    
    {{-- Data Preview --}}
    <div class="data-preview">
        <h4><i class="fas fa-eye"></i> Data Preview (Latest 10 Businesses)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Countries</th>
                        <th>Created</th>
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
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                                     style="width:40px;height:40px;border-radius:5px;">
                                    {{ strtoupper(substr($business->business_name ?? 'N', 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>{{ $business->business_name ?? '-' }}</td>
                        <td>{{ $business->category->name ?? '-' }}</td>
                        <td>
                            <span class="badge 
                                @if($business->status == 'approved') bg-success
                                @elseif($business->status == 'pending') bg-info
                                @elseif($business->status == 'rejected') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ strtoupper($business->status) }}
                            </span>
                        </td>
                        <td>{{ $business->email ?? '-' }}</td>
                        <td>
                            @if($business->countries_of_operation)
                                {{ is_array($business->countries_of_operation) 
                                    ? implode(', ', $business->countries_of_operation) 
                                    : implode(', ', json_decode($business->countries_of_operation, true) ?? []) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $business->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No businesses found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</div>

@endsection