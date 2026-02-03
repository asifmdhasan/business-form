@extends('layouts.master')

@section('content')
<style>
    .export-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .export-header {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
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
        border-left: 4px solid #17a2b8;
    }
    
    .stat-card h3 {
        font-size: 2rem;
        margin: 0;
        color: #17a2b8;
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
    
    .pending-badge {
        background: #17a2b8;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
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
        <h2><i class="fas fa-clock"></i> Export Pending Businesses</h2>
        <p>Export all businesses with pending status awaiting review</p>
    </div>
    
    {{-- Statistics Cards --}}
    <div class="stats-cards">
        <div class="stat-card">
            <h3>{{ $pendingCount }}</h3>
            <p>Total Pending Businesses</p>
        </div>
        <div class="stat-card">
            <h3>{{ $recentCount }}</h3>
            <p>Submitted in Last 7 Days</p>
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
            <a href="{{ route('exportPending') }}" class="btn btn-info btn-export">
                <i class="fas fa-file-csv"></i> Download Pending as CSV
            </a>
            <a href="{{ route('exportAll') }}" class="btn btn-success btn-export">
                <i class="fas fa-download"></i> Download All Businesses
            </a>
            <a href="{{ route('exportApprovedPage') }}" class="btn btn-primary btn-export">
                <i class="fas fa-check-circle"></i> Download Approved Only
            </a>
        </div>
        
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Pending Review:</strong> These businesses are awaiting approval. 
            The CSV will include all submission details for your review process.
        </div>
    </div>
    
    {{-- Data Preview --}}
    <div class="data-preview">
        <h4><i class="fas fa-eye"></i> Pending Businesses Preview (Latest 10)</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Business Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>WhatsApp</th>
                        <th>Submitted</th>
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
                                <div class="bg-info text-white d-flex align-items-center justify-content-center" 
                                     style="width:40px;height:40px;border-radius:5px;">
                                    {{ strtoupper(substr($business->business_name ?? 'N', 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $business->business_name ?? '-' }}</strong>
                            @if($business->created_at->diffInDays(now()) <= 3)
                                <span class="badge bg-danger ms-2">NEW</span>
                            @endif
                        </td>
                        <td>{{ $business->category->name ?? '-' }}</td>
                        <td>
                            <span class="pending-badge">
                                <i class="fas fa-clock"></i> PENDING
                            </span>
                        </td>
                        <td>{{ $business->email ?? '-' }}</td>
                        <td>{{ $business->whatsapp_number ?? '-' }}</td>
                        <td>
                            {{ $business->created_at->format('d M Y') }}<br>
                            <small class="text-muted">{{ $business->created_at->diffForHumans() }}</small>
                        </td>
                        <td>
                            <a href="{{ url('gme-business-admin/' . $business->id . '/edit') }}" 
                               class="btn btn-sm btn-primary" title="Review">
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
                        <td colspan="9" class="text-center">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No pending businesses found</p>
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
                Showing latest 10 pending businesses. Download CSV to view all {{ $pendingCount }} pending businesses.
            </p>
        </div>
        @endif
    </div>
    
</div>

@endsection