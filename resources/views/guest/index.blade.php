@extends('layouts.guest-master')

@section('content')
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>
    .featured-business{
        text-align: left;
    }
    
    .featuredSwiper {
        padding-bottom: 40px;
    }

    .swiper-slide {
        height: auto;
        display: flex;
    }

    .business-card {
        width: 100%;
        height: 100%;
    }

    @media (max-width: 768px) {
        .featured-business{
            text-align: center;
        }
        .filter-box{
            display: none;
        }
    }

</style>

{{--
    Word-alternating title helper:
    takes a title string from the DB and renders it word-by-word,
    alternating light (odd words: 1st, 3rd, 5th...) and bold/gold (even words: 2nd, 4th, 6th...).
--}}
@php
    $featuredTitle = \App\Models\SiteSetting::get('featured_title', 'Featured Businesses');
    $filterTitle   = \App\Models\SiteSetting::get('filter_title', 'Filter Businesses');
    $featuredWords = preg_split('/\s+/', trim($featuredTitle));
    $filterWords   = preg_split('/\s+/', trim($filterTitle));
@endphp

{{-- FEATURED BUSINESSES --}}
<section class="py-5">
    <div class="container">
        <h4 class="fw-bold mb-4 featured-business"
            style="font-size:34px;text-transform:uppercase;line-height:1.3em;">
            @foreach ($featuredWords as $i => $word)
                @if ($i % 2 === 0)
                    <span style="font-weight:300;">{{ $word }} </span>
                @else
                    <span style="color:#9b7d2d;font-weight:900;">{{ $word }} </span>
                @endif
            @endforeach
        </h4>

        <div class="swiper featuredSwiper" dir="ltr">
            <div class="swiper-wrapper" id="featuredGrid"></div>

            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

            <!-- Pagination (optional) -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<div class="container py-5 ">
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-lg-3 filter-box">
            <div class="filter-sidebar">
                <div class="filter-header">
                    <i class="fas fa-filter filter-icon"></i>
                    <h4 class="fw-bold mb-4 featured-business "
                        style="
                            font-size: 34px;
                            text-transform: uppercase;
                            line-height: 1.3em;">
                        @foreach ($filterWords as $i => $word)
                            @if ($i % 2 === 0)
                                <span style=" font-weight: 300;">{{ $word }} </span>
                            @else
                                <span style="color:#9b7d2d;font-weight: 900;">{{ $word }} </span>
                            @endif
                        @endforeach
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

                        <input type="radio" name="status" id="statusVerified" value="1">
                        <label for="statusVerified">GME Verified</label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <button class="btn-apply-filter" id="applyFilters">{{ \App\Models\SiteSetting::get('filter_apply_button_text', 'Apply Filters') }}</button>
                <button class="btn-reset" id="resetFilters">{{ \App\Models\SiteSetting::get('filter_reset_button_text', 'Reset') }}</button>
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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
const swiper = new Swiper('.featuredSwiper', {
    direction: 'horizontal',   // left ↔ right
    slidesPerView: 4,
    spaceBetween: 20,
    loop: true,
    speed: 800,                // smooth left movement

    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
        reverseDirection: false, // 🔴 IMPORTANT → slide LEFT
    },

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    breakpoints: {
        320:  { slidesPerView: 1 },
        576:  { slidesPerView: 2 },
        768:  { slidesPerView: 3 },
        992:  { slidesPerView: 4 },
    }
});
</script>
@endsection