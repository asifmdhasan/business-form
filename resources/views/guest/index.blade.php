@extends('layouts.guest-master')

@section('content')


<style>
    .featured-business{
        text-align: left;
    }
    @media (max-width: 768px) {
        .featured-business{
            text-align: center;
        }
    }
</style>

<section class="py-5 bg-white">
    <div class="container">
        <h4 class="fw-bold mb-4 featured-business "
            style="
                font-size: 34px;
                text-transform: uppercase;
                line-height: 1.3em;">
            <span style=" font-weight: 300;">Browse by </span>
            <span style="color:#9b7d2d;font-weight: 900;">Category </span> 
        </h4>
        <div class="row g-4 pt-4" id="categoryBrowse">
            {{-- Dynamically populated --}}
        </div>
    </div>
</section>



{{-- FEATURED BUSINESSES --}}
<section class="py-5">
    <div class="container">
        {{-- <h4 class="fw-bold mb-4 featured-business">Featured Businesses</h4> --}}
        <h4 class="fw-bold mb-4 featured-business "
            style="
                font-size: 34px;
                text-transform: uppercase;
                line-height: 1.3em;">
            <span style=" font-weight: 300;">Featured </span>
            <span style="color:#9b7d2d;font-weight: 900;">Businesses </span> 
        </h4>
        <div class="row" id="featuredGrid"></div>
    </div>
</section>

<div class="container py-5">
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <div class="filter-header">
                    <i class="fas fa-filter filter-icon"></i>
                    {{-- Filter Businesses --}}
                    <h4 class="fw-bold mb-4 featured-business "
                        style="
                            font-size: 34px;
                            text-transform: uppercase;
                            line-height: 1.3em;">
                        <span style=" font-weight: 300;"> Filter </span>
                        <span style="color:#9b7d2d;font-weight: 900;">Businesses </span> 
                    </h4>
                </div>

                <!-- Search Box -->
                <div class="search-box">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search businesses...">
                </div>

                <!-- Category Filter -->
                <div class="filter-section">
                    <div class="filter-label">Category</div>
                    <select class="form-select" id="categoryFilter" style="width: 100%;">
                        <option value="">All Categories</option>
                    </select>

                    {{-- <select class="form-select" id="categoryFilter" style="width: 100%;">
                        <option value="">All Categories</option>
                    </select> --}}
                </div>

                <!-- Location Filter -->
                <div class="filter-section">
                    <div class="filter-label">Location</div>
                    <select class="form-select" id="locationFilter" style="width: 100%;" multiple>
                    </select>
                </div>

                <!-- Verification Status -->
                <div class="filter-section">
                    <div class="filter-label">Verification Status</div>
                    <div class="radio-option">
                        <input type="radio" name="status" id="statusAll" value="" checked>
                        <label for="statusAll">All Businesses</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="status" id="statusVerified" value="approved">
                        <label for="statusVerified">GME Verified</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="status" id="statusPending" value="pending">
                        <label for="statusPending">Pending</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" name="status" id="statusRejected" value="rejected">
                        <label for="statusRejected">Rejected</label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <button class="btn-apply-filter" id="applyFilters">Apply Filters</button>
                <button class="btn-reset" id="resetFilters">Reset</button>
            </div>
        </div>

        <!-- Business Listings -->
        <div class="col-lg-9">
            <!-- Content Header -->
            <div class="content-header">
                <div class="results-count">
                    Showing <strong id="showingCount">0</strong> of <strong id="totalCount">0</strong> businesses
                </div>
                <div class="sort-section">
                    <label class="sort-label">Sort by:</label>
                    <select class="sort-dropdown" id="sortBy">
                        <option value="relevant">Most Relevant</option>
                        <option value="newest">New Business</option>
                        <option value="asc">Sort by Ascending</option>
                        <option value="desc">Sort by Descending</option>
                    </select>
                </div>
            </div>

            <!-- Business Cards Grid -->
            <div class="row" id="businessGrid">
                <div class="col-12 loading-spinner">
                    <i class="fas fa-spinner fa-spin fa-3x"></i>
                    <p class="mt-3">Loading businesses...</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <nav>
                        <ul class="pagination" id="pagination"></ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</div>




@endsection

