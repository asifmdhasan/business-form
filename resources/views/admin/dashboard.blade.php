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
        <!-- Total Businesses -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('gme-business-admin.index') }}" class="text-decoration-none">
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
            </a>
        </div>

        <!-- Pending Businesses -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('gme-business-admin.index', ['status' => 'pending']) }}" class="text-decoration-none">
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
            </a>
        </div>

        <!-- Approved Businesses -->
        <div class="col-md-4 mb-4">
            <a href="{{ route('gme-business-admin.index', ['status' => 'approved']) }}" class="text-decoration-none">
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
            </a>
        </div>

    </div>
</div>
@endsection
