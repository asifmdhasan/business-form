@extends('layouts.frontend-master')

@section('content')



    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    
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

    /* ═══════════════════════════════════════════
       MOBILE ONLY — bottom nav + overlays
       Everything below is wrapped in max-width:991px
    ═══════════════════════════════════════════ */
    @media (max-width: 991px) {
        footer{
            display: none;
        }

        /* Hide desktop left sidebar on mobile */
        nav.bg-dark {
            display: none !important;
        }

        /* Push page content above bottom nav */
        body {
            padding-bottom: 70px !important;
        }

        /* ── BOTTOM NAV BAR ── */
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
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            color: #888;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: color 0.2s;
            text-decoration: none;
        }

        .mob-bottom-nav .mob-nav-item i {
            font-size: 20px;
            line-height: 1;
        }

        .mob-bottom-nav .mob-nav-item:hover,
        .mob-bottom-nav .mob-nav-item.active {
            color: #9C7D2D;
        }

        /* Add business item special style */
        .mob-bottom-nav .mob-nav-add i {
            background: linear-gradient(135deg, #9C7D2D, #e6b83a);
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 14px rgba(156,125,45,0.35);
            margin-bottom: 2px;
        }

        /* ── MENU DRAWER (slide up from bottom) ── */
        .mob-menu-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 4000;
        }

        .mob-menu-overlay.open {
            display: block;
        }

        .mob-menu-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
        }

        .mob-menu-sheet {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fdfaf2;
            border-radius: 20px 20px 0 0;
            padding: 0 0 20px;
            animation: sheetUp 0.3s cubic-bezier(0.16,1,0.3,1);
        }

        @keyframes sheetUp {
            from { transform: translateY(100%); }
            to   { transform: translateY(0); }
        }

        .mob-sheet-handle {
            width: 40px;
            height: 4px;
            background: #ddd;
            border-radius: 2px;
            margin: 12px auto 20px;
        }

        .mob-sheet-links a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 24px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            color: #3a2e10;
            border-left: 3px solid transparent;
            transition: all 0.2s;
        }

        .mob-sheet-links a i {
            width: 20px;
            text-align: center;
            color: #9C7D2D;
            font-size: 16px;
        }

        .mob-sheet-links a:hover,
        .mob-sheet-links a.active {
            background: #fdf5e0;
            color: #9C7D2D;
            border-left-color: #9C7D2D;
        }

        .mob-sheet-divider {
            height: 1px;
            background: #f0ead8;
            margin: 6px 24px;
        }

        .mob-sheet-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 24px 8px;
            margin-bottom: 4px;
        }

        .mob-sheet-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #9C7D2D, #e6b83a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        .mob-sheet-user-name {
            font-weight: 700;
            font-size: 15px;
            color: #3a2e10;
        }

        .mob-sheet-user-role {
            font-size: 12px;
            color: #9a8a6a;
        }

        /* ── SEARCH OVERLAY ── */
        .mob-search-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 4000;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
        }

        .mob-search-overlay.open {
            display: block;
        }

        .mob-search-box {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background: #fff;
            padding: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            animation: slideDown 0.25s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to   { transform: translateY(0); }
        }

        .mob-search-inner {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mob-search-inner input {
            flex: 1;
            padding: 0.65rem 1rem;
            border: 1.5px solid #e5dcc8;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            color: #3a2e10;
        }

        .mob-search-inner input:focus {
            border-color: #9C7D2D;
            box-shadow: 0 0 0 3px rgba(156,125,45,0.12);
        }

        .mob-search-cancel {
            background: none;
            border: none;
            font-size: 14px;
            font-weight: 600;
            color: #9C7D2D;
            cursor: pointer;
            white-space: nowrap;
            padding: 0;
        }

        .mob-search-results {
            max-height: 55vh;
            overflow-y: auto;
            margin-top: 10px;
        }

        .mob-search-results .hero-search-item {
            border-radius: 8px;
        }
    }

    /* Hide bottom nav on desktop */
    @media (min-width: 992px) {
        .mob-bottom-nav,
        .mob-menu-overlay,
        .mob-search-overlay { display: none !important; }
    }
</style>



{{-- ═══════════════════════════════════════
     MOBILE BOTTOM NAV (≤991px only)
═══════════════════════════════════════ --}}

{{-- Menu Drawer --}}
<div class="mob-menu-overlay" id="mobMenuOverlay">
    <div class="mob-menu-backdrop" id="mobMenuBackdrop"></div>
    <div class="mob-menu-sheet">
        <div class="mob-sheet-handle"></div>

        {{-- User info --}}
        <div class="mob-sheet-user">
            <div class="mob-sheet-user-avatar">
                {{ strtoupper(substr(Auth::guard('customer')->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div>
                <div class="mob-sheet-user-name">{{ Auth::guard('customer')->user()->name ?? 'Customer' }}</div>
                <div class="mob-sheet-user-role">GME Member</div>
            </div>
        </div>

        <div class="mob-sheet-links">
            <a href="{{ route('guest.index') }}" target="_blank">
                <i class="fa fa-globe"></i> GME Network Home
            </a>
            <a href="https://gme.network/get-involved/">
                <i class="fa fa-hands-helping"></i> Get Involved
            </a>
            <a href="https://gme.network/events/">
                <i class="fa fa-calendar-alt"></i> Events
            </a>
            <a href="https://gme.network/news/">
                <i class="fa fa-newspaper"></i> News
            </a>

            <div class="mob-sheet-divider"></div>

            <a href="{{ route('customer.profile') }}">
                <i class="fa fa-user-circle"></i> My Profile
            </a>
            <a href="{{ route('customer.logout') }}" style="color:#dc2626;">
                <i class="fa fa-sign-out-alt" style="color:#dc2626;"></i> Logout
            </a>
        </div>
    </div>
</div>

{{-- Search Overlay --}}
<div class="mob-search-overlay" id="mobSearchOverlay">
    <div class="mob-search-box">
        <div class="mob-search-inner">
            <input type="text"
                   id="mobSearchInput"
                   placeholder="Search businesses..."
                   autocomplete="off">
            <button class="mob-search-cancel" id="mobSearchCancel">Cancel</button>
        </div>
        <div class="mob-search-results" id="mobSearchResults"></div>
    </div>
    {{-- clicking outside the box closes overlay --}}
    <div style="position:absolute;inset:0;z-index:-1;" id="mobSearchBackdrop"></div>
</div>

{{-- Bottom Nav --}}
<div class="mob-bottom-nav">

    {{-- Menu --}}
    <button class="mob-nav-item" id="mobMenuBtn" aria-label="Menu">
        <i class="fa fa-bars"></i>
        <span>Menu</span>
    </button>

    {{-- Search --}}
    <button class="mob-nav-item" id="mobSearchBtn" aria-label="Search">
        <i class="fa fa-search"></i>
        <span>Search</span>
    </button>

    {{-- My Business --}}
    <a href="{{ route('customer.gme-business-form.index') }}" class="mob-nav-item" aria-label="My Business">
        <i class="fa fa-store"></i>
        <span>My Business</span>
    </a>

    {{-- Add Business --}}
    <a href="{{ route('gme.business.register') }}" class="mob-nav-item mob-nav-add" aria-label="Add Business">
        <i class="fa fa-plus"></i>
        <span>Add</span>
    </a>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Desktop sidebar toggle (unchanged) --}}
<script>
    document.getElementById('menuToggle').addEventListener('click', function () {
        const sidebar = document.querySelector('nav.bg-dark');
        if (sidebar) {
            sidebar.style.left = sidebar.style.left === "0px" ? "-260px" : "0px";
        }
    });
</script>

<style>
    @media (max-width: 991px) {
        nav.bg-dark { left: -260px; transition: 0.3s; z-index: 2000; }
    }
</style>

{{-- Desktop search (unchanged) --}}
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

        /* ── Desktop search ── */
        $('#heroSearchInput').on('keyup', function () {
            const query = $(this).val().toLowerCase().trim();
            const $results = $('#heroSearchResults').empty();

            if (!query || query.length < 2) {
                $results.addClass('d-none');
                return;
            }

            const matches = allBusinesses
                .filter(b => b.business_name?.toLowerCase().includes(query) ||
                             b.short_introduction?.toLowerCase().includes(query))
                .slice(0, 3);

            if (!matches.length) {
                $results.removeClass('d-none').html(`<div class="p-3 text-muted">No results found</div>`);
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
                            <div class="hero-search-title">${business.business_name}</div>
                            <div class="hero-search-category">${business.category?.name ?? ''}</div>
                        </div>
                    </div>
                `);
            });

            $results.removeClass('d-none');
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#heroSearchInput, #heroSearchResults').length) {
                $('#heroSearchResults').addClass('d-none');
            }
        });

        $('#heroSearchBtn').on('click', function () {
            const q = $('#heroSearchInput').val();
            if (q) window.location.href = '{{ route("guest.index") }}?search=' + encodeURIComponent(q);
        });

        fetchBusinesses();

        /* ── Mobile search ── */
        function renderMobResults(query) {
            const $r = $('#mobSearchResults').empty();
            if (!query || query.length < 2) return;

            const matches = allBusinesses
                .filter(b => b.business_name?.toLowerCase().includes(query) ||
                             b.short_introduction?.toLowerCase().includes(query))
                .slice(0, 6);

            if (!matches.length) {
                $r.html(`<div class="p-3 text-muted text-center">No results found</div>`);
                return;
            }

            matches.forEach(b => {
                const img = b.cover_photo
                    ? `{{ asset('assets') }}/${b.cover_photo}`
                    : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp';

                $r.append(`
                    <div class="hero-search-item"
                         onclick="location.href='{{ url('guest-gme-business-form') }}/${b.id}'">
                        <img src="${img}" class="hero-search-img">
                        <div>
                            <div class="hero-search-title">${b.business_name}</div>
                            <div class="hero-search-category">${b.category?.name ?? ''}</div>
                        </div>
                    </div>
                `);
            });
        }

        $('#mobSearchInput').on('keyup', function () {
            renderMobResults($(this).val().toLowerCase().trim());
        });
    });
</script>

{{-- Mobile menu / search JS --}}
<script>
    (function () {
        var menuOverlay  = document.getElementById('mobMenuOverlay');
        var menuBackdrop = document.getElementById('mobMenuBackdrop');
        var menuBtn      = document.getElementById('mobMenuBtn');

        var searchOverlay  = document.getElementById('mobSearchOverlay');
        var searchBackdrop = document.getElementById('mobSearchBackdrop');
        var searchBtn      = document.getElementById('mobSearchBtn');
        var searchCancel   = document.getElementById('mobSearchCancel');
        var searchInput    = document.getElementById('mobSearchInput');

        function openMenu() {
            menuOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menuOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }

        function openSearch() {
            searchOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
            setTimeout(function () { searchInput.focus(); }, 100);
        }

        function closeSearch() {
            searchOverlay.style.display = 'none';
            document.body.style.overflow = '';
            searchInput.value = '';
            document.getElementById('mobSearchResults').innerHTML = '';
        }

        menuBtn.addEventListener('click', openMenu);
        menuBackdrop.addEventListener('click', closeMenu);

        searchBtn.addEventListener('click', openSearch);
        searchCancel.addEventListener('click', closeSearch);
        searchBackdrop.addEventListener('click', closeSearch);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { closeMenu(); closeSearch(); }
        });
    })();
</script>