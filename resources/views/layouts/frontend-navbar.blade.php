<style>
    .home-btn a:hover {
        background-color: #9C7D2D;
        text-decoration: none;
        color: #fff;
    }
    .input-group-lg>.btn, .input-group-lg>.form-control, .input-group-lg>.form-select, .input-group-lg>.input-group-text {
        padding: .4rem 1rem;
        font-size: 1rem;
        border-radius: var(--bs-border-radius-lg);
    }
    
    /* Search Results Styling */
    .hero-search-item {
        display: flex;
        gap: 12px;
        padding: 10px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
    }

    .hero-search-item:hover {
        background: #f8f9fa;
    }

    .hero-search-img {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .hero-search-title {
        font-weight: 600;
        font-size: 14px;
        color: #191970;
    }

    .hero-search-category {
        font-size: 12px;
        color: #777;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
    <div class="container-fluid">

        <!-- Toggle button (for mobile sidebar) -->
        <button class="btn btn-outline-secondary d-lg-none" id="menuToggle">
            <i class="fa fa-bars"></i>
        </button>

        <span class="navbar-brand ms-2">
            {{-- {{ __('layouts.siteTitle') }} --}}
        </span>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <!-- Search box -->
                <div class="d-flex justify-content-center" style="margin-right: 2rem;">
                    <!-- 🔹 Relative wrapper (IMPORTANT) -->
                    <div class="position-relative w-100" style="max-width:600px;">

                        <!-- Search box -->
                        <div class="input-group input-group-lg">
                            <input type="text"
                                id="heroSearchInput"
                                class="form-control"
                                placeholder="Search by business name ...">
                            <button class="btn" id="heroSearchBtn" style="background: #9C7D2D;">
                                <span style="font-weight: 400;color: #fff; font-size: 16px;"> Search</span>
                            </button>
                        </div>

                        <!-- 🔽 Live Search Results Dropdown -->
                        <div id="heroSearchResults"
                            class="position-absolute w-100 bg-white shadow rounded mt-2 d-none"
                            style="z-index:999; max-height:260px; overflow-y:auto;">
                        </div>

                    </div>
                </div>

                <li class="nav-item home-btn" style="border: 2px solid #9C7D2D;border-radius: 6px;">
                    <a href="{{ route('guest.index') }}" class="nav-link" target="_blank">
                        <i class="fa fa-home me-2"></i> Home
                    </a>
                </li>

                <!-- User Menu -->
                <li class="nav-item dropdown ms-3">
                    <a class="nav-link dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown">
                        <i class="fa fa-user"></i> {{ Auth::guard('customer')->user()->name ?? 'Customer' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('customer.logout') }}">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>

    </div>
</nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Mobile Sidebar Script -->
<script>
    document.getElementById('menuToggle').addEventListener('click', function () {
        const sidebar = document.querySelector('nav.bg-dark');
        if (sidebar.style.left === "0px") {
            sidebar.style.left = "-260px";
        } else {
            sidebar.style.left = "0px";
        }
    });
</script>

<style>
    /* Mobile sidebar */
    @media (max-width: 991px) {
        nav.bg-dark {
            left: -260px;
            transition: 0.3s;
            z-index: 2000;
        }
    }
</style>

<!-- Search Functionality Script -->
<script>
    $(document).ready(function() {
        let allBusinesses = [];

        // Fetch businesses for search
        function fetchBusinesses() {
            $.ajax({
                url: '{{ route("guest.gme-business.ajax") }}',
                method: 'GET',
                success: function (response) {
                    allBusinesses = response.businesses;
                }
            });
        }

        // Live search on keyup
        $('#heroSearchInput').on('keyup', function () {
            const query = $(this).val().toLowerCase().trim();
            const $results = $('#heroSearchResults').empty();

            if (!query || query.length < 2) {
                $results.addClass('d-none');
                return;
            }

            const matches = allBusinesses
                .filter(business => {
                    return (
                        business.business_name?.toLowerCase().includes(query) ||
                        business.short_introduction?.toLowerCase().includes(query)
                    );
                })
                .slice(0, 3);

            if (!matches.length) {
                $results
                    .removeClass('d-none')
                    .html(`<div class="p-3 text-muted">No results found</div>`);
                return;
            }

            matches.forEach(business => {
                const image = business.cover_photo
                    ? `{{ asset('assets') }}/${business.cover_photo}`
                    : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp';

                $results.append(`
                    <div class="hero-search-item"
                        onclick="location.href='{{ url('guest-gme-business-form') }}/${business.id}'">
                        <img src="${image}" class="hero-search-img">
                        <div>
                            <div class="hero-search-title">
                                ${business.business_name}
                            </div>
                            <div class="hero-search-category">
                                ${business.category?.name ?? ''}
                            </div>
                        </div>
                    </div>
                `);
            });

            $results.removeClass('d-none');
        });

        // Close search results when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#heroSearchInput, #heroSearchResults').length) {
                $('#heroSearchResults').addClass('d-none');
            }
        });

        // Search button click - redirect to home page with search
        $('#heroSearchBtn').on('click', function () {
            const searchQuery = $('#heroSearchInput').val();
            if (searchQuery) {
                // Redirect to home page and trigger search there
                window.location.href = '{{ route("guest.index") }}?search=' + encodeURIComponent(searchQuery);
            }
        });

        // Initialize
        fetchBusinesses();
    });
</script>