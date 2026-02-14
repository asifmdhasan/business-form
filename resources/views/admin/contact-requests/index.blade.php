@extends('layouts.master')
@section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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

    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .stats-card .stats-number {
        font-size: 2rem;
        font-weight: bold;
        color: var(--primary-color);
    }

    .stats-card .stats-label {
        color: #666;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #000;
    }

    .badge-approved {
        background-color: #28a745;
        color: white;
    }

    .badge-rejected {
        background-color: #dc3545;
        color: white;
    }

    /* DataTables Custom Styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--primary-light) !important;
        border-color: var(--primary-light) !important;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid var(--primary-color);
        border-radius: 5px;
        padding: 0.375rem 0.75rem;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(87, 104, 41, 0.25);
    }

    .btn-view {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: 0.375rem 0.75rem;
        border-radius: 5px;
        font-size: 0.875rem;
    }

    .btn-view:hover {
        background-color: var(--primary-dark);
        color: white;
    }

    .table thead th {
        background-color: #f2f2f2;
        color: #000;
        border: none;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(87, 104, 41, 0.05);
    }

    .card {
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 1rem 1.5rem;
    }
</style>


<div class="container-fluid py-4">
    



    <!-- Contact Requests Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>All Contact Requests
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="contactRequestsTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Requester Name</th>
                            <th>Requester Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Business Name</th>
                            {{-- <th>Purpose</th> --}}
                            <th>Status</th>
                           
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                        <tr>
                             <td>
                                <small>{{ $request->created_at->format('d M Y') }}</small>
                                <br>
                            </td>
                            <td>
                                {{ $request->requester_name  ?? '-' }}
                               
                            </td>
                            <td>{{ $request->requester_company ?? '-' }}</td>
                            <td>{{ $request->requester_email ?? '-' }}</td>
                            <td>{{ $request->requester_phone ?? '-' }}</td>
                            <td>
                                <a href="{{ route('gme-business-admin.show', $request->business_id) }}" 
                                   class="text-decoration-none" style="color: var(--primary-color);">
                                    {{ $request->business->business_name ?? 'N/A' }}
                                </a>
                            </td>
                            <td>
                                @if($request->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($request->status === 'approved')
                                    <span class="badge badge-approved">Approved</span>
                                @elseif($request->status === 'rejected')
                                    <span class="badge badge-rejected">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($request->status) }}</span>
                                @endif
                            </td>

                           
                            <td>
                                <a href="{{ route('contact-requests.show', $request->id) }}" 
                                   class="btn btn-view btn-sm">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#contactRequestsTable').DataTable({
        order: [[0, 'desc']], // Sort by ID descending
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ requests",
            infoEmpty: "No requests available",
            infoFiltered: "(filtered from _MAX_ total requests)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        columnDefs: [
            { orderable: false, targets: [8] } // Disable sorting on Actions column
        ]
    });
});
</script>
@endsection