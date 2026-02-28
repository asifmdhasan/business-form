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

    @media (max-width: 768px) {
        .hide-for-mobile {
            display: none;
        }
    }

    /* ==============================
       MOBILE TOP NAV
    ================================ */
    .mob-top-nav {
        display: none;
    }

    @media (max-width: 991px) {

        footer {
            display: none;
        }

        nav.bg-dark {
            display: none !important;
        }

        .mob-top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 16px;
            background: #fff;
            border-bottom: 1px solid #e8dcc8;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .mob-top-nav .mob-logo img {
            height: 34px;
        }

        .mob-top-nav-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mob-search-icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9C7D2D;
            font-size: 16px;
            transition: background 0.2s;
        }

        .mob-search-icon-btn:hover {
            background: rgba(156,125,45,0.1);
        }
    }

    /* ==============================
       HAMBURGER BUTTON
    ================================ */
    .gme-hamburger {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        flex-direction: column;
        gap: 5px;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }

    .gme-hamburger span {
        display: block;
        width: 24px;
        height: 2px;
        background: #9C7D2D;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    @media (max-width: 991px) {
        .gme-hamburger { display: flex; }
    }

    @media (min-width: 992px) {
        .gme-hamburger { display: none !important; }
    }

    /* ==============================
       MOBILE SEARCH OVERLAY
    ================================ */
    .mob-search-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 4000;
        background: rgba(0,0,0,0.5);
    }

    .mob-search-box {
        background: #fff;
        padding: 16px;
    }

    @media (min-width: 992px) {
        .mob-search-overlay { display: none !important; }
    }

    /* ==============================
       DRAWER MENU
    ================================ */
    #mobDrawerMenu {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
    }

    .gme-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.45);
    }

    .gme-drawer {
        position: absolute;
        top: 0;
        right: 0;
        width: min(300px, 85vw);
        height: 100%;
        background: #fdfaf2;
        box-shadow: -10px 0 40px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        animation: drawerIn 0.3s cubic-bezier(0.16,1,0.3,1);
    }

    @keyframes drawerIn {
        from { transform: translateX(100%); }
        to   { transform: translateX(0); }
    }

    .gme-drawer-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid #f0ead8;
    }

    .gme-drawer-top img {
        height: 32px;
    }

    .gme-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #9C7D2D;
        transition: background 0.2s;
    }

    .gme-close-btn:hover {
        background: rgba(156,125,45,0.1);
    }

    .gme-drawer-links {
        flex: 1;
        padding: 8px 0;
        overflow-y: auto;
    }

    .gme-drawer-links a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 24px;
        text-decoration: none;
        font-weight: 500;
        font-size: 15px;
        color: #3a2e10;
        border-left: 3px solid transparent;
        transition: all 0.2s;
    }

    .gme-drawer-links a i {
        width: 18px;
        text-align: center;
        color: #9C7D2D;
    }

    .gme-drawer-links a:hover,
    .gme-drawer-links a.active {
        background: #fdf5e0;
        color: #9C7D2D;
        border-left-color: #9C7D2D;
    }

    .gme-drawer-divider {
        height: 1px;
        background: #f0ead8;
        margin: 6px 24px;
    }

    .gme-drawer-footer {
        padding: 16px 20px;
        border-top: 1px solid #f0ead8;
    }

    .gme-drawer-footer a {
        display: block;
        text-align: center;
        background: linear-gradient(135deg, #9C7D2D, #e6b83a);
        color: #fff !important;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .gme-drawer-footer a:hover {
        opacity: 0.9;
    }

    /* ==============================
       MOBILE BOTTOM NAV
    ================================ */
    @media (max-width: 991px) {
        body {
            padding-bottom: 70px !important;
        }

        .mob-bottom-nav {
            display: flex;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 3000;
            background: #fff;
            border-top: 1px solid #e8dcc8;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.10);
            height: 62px;
        }

        .mob-bottom-nav .mob-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 3px;
            font-size: 10px;
            font-weight: 600;
            color: #888;
            text-decoration: none;
            border: none;
            background: none;
        }

        .mob-bottom-nav .mob-nav-item i {
            font-size: 20px;
        }

        .mob-bottom-nav .mob-nav-item:hover {
            color: #9C7D2D;
        }

        .mob-bottom-nav .mob-nav-add i {
            background: linear-gradient(135deg, #9C7D2D, #e6b83a);
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 4px 14px rgba(156,125,45,0.35);
        }
    }

    @media (min-width: 992px) {
        .mob-bottom-nav { display: none !important; }
    }

    /* Mobile sidebar */
    @media (max-width: 991px) {
        nav.bg-dark {
            left: -260px;
            transition: 0.3s;
            z-index: 2000;
        }
    }
</style>


{{-- ========================================
     DESKTOP NAVBAR
======================================== --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 hide-for-mobile">
    <div class="container-fluid">

        <button class="btn btn-outline-secondary d-lg-none" id="menuToggle">
            <i class="fa fa-bars"></i>
        </button>

        <span class="navbar-brand ms-2"></span>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <div class="d-flex justify-content-center" style="margin-right: 2rem;">
                    <div class="position-relative w-100" style="max-width:600px;">
                        <div class="input-group input-group-lg">
                            <input type="text"
                                id="heroSearchInput"
                                class="form-control"
                                placeholder="Search by business name ...">
                            <button class="btn" id="heroSearchBtn" style="background: #9C7D2D;">
                                <span style="font-weight: 400;color: #fff; font-size: 16px;"> Search</span>
                            </button>
                        </div>
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


{{-- ========================================
     MOBILE TOP BAR
======================================== --}}
<div class="mob-top-nav">
    <div class="mob-logo">
        <a href="{{ route('guest.index') }}">
            <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
        </a>
    </div>
    <div class="mob-top-nav-actions">
        <button class="mob-search-icon-btn" id="mobTopSearchBtn" aria-label="Search">
            <i class="fa fa-search"></i>
        </button>
        <button class="gme-hamburger" id="mobHamburgerBtn" aria-label="Open menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</div>


{{-- ========================================
     MOBILE SEARCH OVERLAY
======================================== --}}
<div class="mob-search-overlay" id="mobSearchOverlay">
    <div class="mob-search-box">
        <div class="position-relative">
            <input type="text" id="mobSearchInput" class="form-control form-control-lg" placeholder="Search by business name...">
            <div id="mobSearchResults"
                class="position-absolute w-100 bg-white shadow rounded mt-2 d-none"
                style="z-index:999; max-height:260px; overflow-y:auto;">
            </div>
        </div>
    </div>
</div>


{{-- ========================================
     MOBILE DRAWER MENU
======================================== --}}
<div id="mobDrawerMenu">
    <div class="gme-backdrop" id="mobDrawerBackdrop"></div>
    <div class="gme-drawer">

        <div class="gme-drawer-top">
            <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
            <button class="gme-close-btn" id="mobDrawerClose" aria-label="Close menu">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <nav class="gme-drawer-links">
            <a class="active" href="{{ route('guest.index') }}">
                <i class="fa fa-home"></i> Home
            </a>
            @auth('customer')
                <a href="{{ route('customer.profile') }}">
                    <i class="fa fa-user"></i> Profile
                </a>
            @endauth

            {{-- <a href="https://gme.network/get-involved/">
                <i class="fa fa-hands-helping"></i> Get Involved
            </a>
            <div class="gme-drawer-divider"></div>
            <a href="https://gme.network/events/">
                <i class="fa fa-calendar-alt"></i> Events
            </a>
            <a href="https://gme.network/news/">
                <i class="fa fa-newspaper"></i> News
            </a> --}}
            {{-- Profile --}}
            {{-- customer.profile --}}


            
            <a href="{{ route('gme.business.register') }}">
                <i class="fa fa-plus-circle"></i> Add Your Business
            </a>
        </nav>

        <div class="gme-drawer-footer">
            @auth('customer')
                <a href="{{ route('customer.logout') }}">
                    <i class="fa fa-plus-circle me-2"></i> Logout
                </a>
            @else
                <a href="{{ route('customer.login') }}">
                    <i class="fa fa-plus-circle me-2"></i> Login
                </a>
            @endauth
        </div>

    </div>
</div>


{{-- ========================================
     MOBILE BOTTOM NAV
======================================== --}}
<div class="mob-bottom-nav">
    <button class="mob-nav-item" id="mobSearchBtn">
        <i class="fa fa-search"></i>
        <span>Search</span>
    </button>
    <a href="{{ route('gme.business.register') }}" class="mob-nav-item mob-nav-add">
        <i class="fa fa-plus"></i>
        <span>Add</span>
    </a>
    <a href="{{ route('customer.gme-business-form.index') }}" class="mob-nav-item">
        <i class="fa fa-store"></i>
        <span>My Business</span>
    </a>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    if (document.getElementById('menuToggle')) {
        document.getElementById('menuToggle').addEventListener('click', function () {
            const sidebar = document.querySelector('nav.bg-dark');
            if (sidebar) {
                sidebar.style.left = sidebar.style.left === "0px" ? "-260px" : "0px";
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        let allBusinesses = [];

        function fetchBusinesses() {
            $.ajax({
                url: '{{ route("guest.gme-business.ajax") }}',
                method: 'GET',
                success: function (response) {
                    allBusinesses = response.businesses;
                }
            });
        }

        function renderResults(matches, $container, baseUrl) {
            $container.empty();
            if (!matches.length) {
                $container.removeClass('d-none').html(`<div class="p-3 text-muted">No results found</div>`);
                return;
            }
            matches.forEach(business => {
                const image = business.cover_photo
                    ? `{{ asset('assets') }}/${business.cover_photo}`
                    : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp';
                $container.append(`
                    <div class="hero-search-item"
                        onclick="location.href='${baseUrl}/${business.id}'">
                        <img src="${image}" class="hero-search-img">
                        <div>
                            <div class="hero-search-title">${business.business_name}</div>
                            <div class="hero-search-category">${business.category?.name ?? ''}</div>
                        </div>
                    </div>
                `);
            });
            $container.removeClass('d-none');
        }

        $('#heroSearchInput').on('keyup', function () {
            const query = $(this).val().toLowerCase().trim();
            const $results = $('#heroSearchResults').empty();
            if (!query || query.length < 2) { $results.addClass('d-none'); return; }
            const matches = allBusinesses
                .filter(b => b.business_name?.toLowerCase().includes(query) || b.short_introduction?.toLowerCase().includes(query))
                .slice(0, 3);
            renderResults(matches, $results, '{{ url("guest-gme-business-form") }}');
        });

        $('#mobSearchInput').on('keyup', function () {
            const query = $(this).val().toLowerCase().trim();
            const $results = $('#mobSearchResults').empty();
            if (!query || query.length < 2) { $results.addClass('d-none'); return; }
            const matches = allBusinesses
                .filter(b => b.business_name?.toLowerCase().includes(query) || b.short_introduction?.toLowerCase().includes(query))
                .slice(0, 3);
            renderResults(matches, $results, '{{ url("guest-gme-business-form") }}');
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#heroSearchInput, #heroSearchResults').length) {
                $('#heroSearchResults').addClass('d-none');
            }
        });

        $('#heroSearchBtn').on('click', function () {
            const searchQuery = $('#heroSearchInput').val();
            if (searchQuery) {
                window.location.href = '{{ route("guest.index") }}?search=' + encodeURIComponent(searchQuery);
            }
        });

        fetchBusinesses();
    });
</script>

<script>
(function () {
    var drawerMenu     = document.getElementById('mobDrawerMenu');
    var hamburgerBtn   = document.getElementById('mobHamburgerBtn');
    var drawerClose    = document.getElementById('mobDrawerClose');
    var drawerBackdrop = document.getElementById('mobDrawerBackdrop');
    var searchOverlay  = document.getElementById('mobSearchOverlay');
    var searchBtn      = document.getElementById('mobSearchBtn');
    var topSearchBtn   = document.getElementById('mobTopSearchBtn');

    function openDrawer() {
        drawerMenu.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
        drawerMenu.style.display = 'none';
        document.body.style.overflow = '';
    }
    function openSearch() {
        searchOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
        setTimeout(function() {
            var inp = document.getElementById('mobSearchInput');
            if (inp) inp.focus();
        }, 100);
    }
    function closeSearch() {
        searchOverlay.style.display = 'none';
        document.body.style.overflow = '';
    }

    if (hamburgerBtn)   hamburgerBtn.addEventListener('click', openDrawer);
    if (drawerClose)    drawerClose.addEventListener('click', closeDrawer);
    if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

    if (searchBtn) searchBtn.addEventListener('click', openSearch);
    if (topSearchBtn) topSearchBtn.addEventListener('click', openSearch);
    if (searchOverlay) searchOverlay.addEventListener('click', function(e) {
        if (e.target === searchOverlay) closeSearch();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeDrawer(); closeSearch(); }
    });
})();
</script>