@extends('layouts.master')

@section('content')
<style>
    .font-color {
        color: #9C7D2D;
        /* background-color: ; */
    }
</style>
<div class="container-fluid py-4">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        {{-- <!-- Total Customers Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="card-title">Total Customers</h5>
                        <h2 class="card-text">{{ $totalCustomers }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-people-fill" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <small class="text-white-50">Verified and active customers</small>
                </div>
            </div>
        </div> --}}

        <!-- Total Businesses Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h5 class="card-title font-color">Total Businesses</h5>
                        <h2 class="card-text font-color">{{ $totalBusinesses }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-building font-color" style="font-size: 2.5rem;"></i>
                    </div>
                </div>

            </div>
        </div>
            <!-- Pending Businesses Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h5 class="card-title font-color">Pending Businesses</h5>
                        <h2 class="card-text font-color">{{ $totalPendingBusinesses }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-hourglass-split font-color" style="font-size: 2.5rem;"></i>
                    </div>
                </div>

            </div>
        </div>

        <!-- Approved Businesses Card -->
        <div class="col-md-4 mb-4">
            <div class="card text-white h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="text-center">
                        <h5 class="card-title font-color">Approved Businesses</h5>
                        <h2 class="card-text font-color">{{ $approvedBusinesses }}</h2>
                    </div>
                    <div>
                        <i class="bi bi-check-circle-fill font-color" style="font-size: 2.5rem;"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional: Add charts or tables below -->
    {{-- <div class="row mt-4">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Quick Stats / Reports</h5>
                </div>
                <div class="card-body">
                    <p>Here you can add charts, tables, or recent activities.</p>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
