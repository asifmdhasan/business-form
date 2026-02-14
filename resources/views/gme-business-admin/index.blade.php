@extends('layouts.master')

@section('content')
<style>
    #businessTabs .nav-link{
        color: #576829;
        width: 10rem;
        text-align: center;
        font-weight: bold;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #fff !important;
        background-color: #576829;
        border-color: #576829;
        width: 10rem;
        border-left: 3px solid #576829 !important;
    }

    #businessTabs{
        padding-bottom: 1rem;
        justify-content: center;
    }
    .bg-dark{
        background: #121212 !important;
    }

    /* Export buttons styling */
    .export-section {
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .export-section h5 {
        margin-bottom: 0.75rem;
        color: #576829;
        font-weight: bold;
    }

    .export-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .export-buttons .btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">GME Businesses</h3>
                </div>

                <div class="card-body">

                   

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs" id="businessTabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-status="" href="#">
                                All - {{ \App\Models\GmeBusinessForm::where('status','!=','draft')->count() }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="pending" href="#">
                                Pending - {{ \App\Models\GmeBusinessForm::where('status','pending')->count() }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="approved" href="#">
                                Approved - {{ \App\Models\GmeBusinessForm::where('status','approved')->count() }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="rejected" href="#">
                                Rejected - {{ \App\Models\GmeBusinessForm::where('status','rejected')->count() }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-status="request_for_delete" href="#">
                                Delete - {{ \App\Models\GmeBusinessForm::where('status','request_for_delete')->count() }}
                            </a>
                        </li>
                    </ul>

                    {{-- Table --}}
                    <table id="businessesTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Logo</th>
                                <th>Business Name</th>
                                <th>Category</th>
                                <th>Countries</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script>
$(function () {

    /* ----------------------------------------
     * 1. Read status from URL (?status=pending)
     * ---------------------------------------- */
    let selectedStatus = new URLSearchParams(window.location.search).get('status') || '';

    /* ----------------------------------------
     * 2. Initialize DataTable
     * ---------------------------------------- */
    let table = $('#businessesTable').DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('gme-business-admin.index') }}",
            data: function (d) {
                d.status = selectedStatus;
            },
            dataSrc: 'businesses'
        },
        columns: [

            {
                data: null,
                render: (d, t, r, m) => m.row + 1
            },

            {
                data: 'logo',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    if (data) {
                        return `<img src="{{ asset('assets') }}/${data}"
                            class="img-thumbnail"
                            style="width:50px;height:50px;object-fit:cover;">`;
                    }
                    return `<div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                        style="width:50px;height:50px;">
                        ${row.business_name?.charAt(0).toUpperCase() ?? '?'}
                    </div>`;
                }
            },

            { data: 'business_name', defaultContent: '-' },

            {
                data: 'category',
                render: (d, t, row) => row.category?.name ?? '-'
            },

            {
                data: 'countries_of_operation',
                render: function (data) {
                    if (!data) return '-';
                    try {
                        let parsed = typeof data === 'string' ? JSON.parse(data) : data;
                        return Array.isArray(parsed) ? parsed.join(', ') : '-';
                    } catch {
                        return '-';
                    }
                }
            },

            {
                data: 'status',
                render: function (data) {
                    const map = {
                        approved: 'bg-success',
                        pending: 'bg-info',
                        draft: 'bg-warning',
                        rejected: 'bg-danger'
                    };
                    return `<span class="badge ${map[data] ?? 'bg-secondary'}">
                        ${data.toUpperCase()}
                    </span>`;
                }
            },

            {
                data: 'created_at',
                render: d => new Date(d).toLocaleDateString()
            },

            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {

                    let editBtn = `
                        <a href="{{ url('gme-business-admin') }}/${row.id}/edit"
                           class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>`;

                    let showBtn = `
                        <a href="{{ url('gme-business-admin') }}/${row.id}/show"
                           class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>`;

                    let deleteBtn = '';

                    if (selectedStatus === 'rejected' && row.status === 'rejected') {
                        deleteBtn = `
                            <button class="btn btn-sm btn-danger delete-btn"
                                data-id="${row.id}">
                                <i class="fas fa-trash"></i>
                            </button>`;
                    }

                    return editBtn + ' ' + deleteBtn + ' ' + showBtn;
                }
            }
        ],
        pageLength: 25
    });

    /* ----------------------------------------
     * 3. Activate tab on PAGE LOAD
     * ---------------------------------------- */
    $('#businessTabs a').removeClass('active');

    if (selectedStatus) {
        $('#businessTabs a[data-status="' + selectedStatus + '"]').addClass('active');
    } else {
        $('#businessTabs a[data-status=""]').addClass('active');
    }

    /* ----------------------------------------
     * 4. Handle tab click
     * ---------------------------------------- */
    $('#businessTabs a').on('click', function (e) {
        e.preventDefault();

        $('#businessTabs a').removeClass('active');
        $(this).addClass('active');

        selectedStatus = $(this).data('status') ?? '';

        // Update URL (no reload)
        let url = new URL(window.location);
        if (selectedStatus) {
            url.searchParams.set('status', selectedStatus);
        } else {
            url.searchParams.delete('status');
        }
        window.history.pushState({}, '', url);

        table.ajax.reload();
    });

    /* ----------------------------------------
     * 5. Delete (Rejected only)
     * ---------------------------------------- */
    $(document).on('click', '.delete-btn', function () {
        if (!confirm('Are you sure you want to delete this business?')) return;

        let id = $(this).data('id');

        $.ajax({
            url: "{{ url('gme-business-admin') }}/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    table.ajax.reload();
                }
            },
            error: function () {
                alert('Something went wrong while deleting the business!');
            }
        });
    });

});
</script>

@endsection