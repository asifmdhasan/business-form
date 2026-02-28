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
    .active > .page-link, .page-link.active {
        background-color: #9C7D2D;
        border-color: #9C7D2D;
        color: #fff;
    }
    .page-link { color: #000; }
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

<!-- Business Grid Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold" style="color:#2C3E50;">My Businesses</h4>
                <a href="{{ route('gme.business.register') }}"
                   class="btn text-white px-4 py-2"
                   style="background-color:#9C7D2D; border-radius:8px;">
                    + Add Business
                </a>
            </div>

            <!-- Cards -->
            <div class="row" id="businessGrid">
                <div class="col-12 text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x" style="color:#9C7D2D;"></i>
                    <p class="mt-3 text-muted">Loading businesses...</p>
                </div>
            </div>

            <!-- Empty State -->
            <div id="emptyState" class="text-center d-none" style="margin-top:60px;">
                <i class="fas fa-store fa-4x mb-3" style="color:#DDD;"></i>
                <h5 class="text-muted mb-3">You haven't added any business yet</h5>
                <a href="{{ route('gme.business.register') }}"
                   class="btn text-white px-4 py-2"
                   style="background-color:#9C7D2D;">
                    + Add Your Business
                </a>
            </div>

            <!-- Pagination -->
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Desktop sidebar toggle (unchanged) --}}
{{-- <script>
    document.getElementById('menuToggle').addEventListener('click', function () {
        const sidebar = document.querySelector('nav.bg-dark');
        if (sidebar) {
            sidebar.style.left = sidebar.style.left === "0px" ? "-260px" : "0px";
        }
    });
</script> --}}

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
<script>
/* ══════════════════════════════
   My Business Cards — Home Page
══════════════════════════════ */
$(document).ready(function () {

    /* ── Pagination click ── */
    $(document).on('click', '#pagination a', function (e) {
        e.preventDefault();
        fetchMyBusinesses($(this).data('page'));
    });

    /* ── Fetch ── */
    function fetchMyBusinesses(page = 1) {
        $.ajax({
            url: '{{ route("customer.gme-business.ajax") }}',
            method: 'GET',
            data: { page: page },
            success: function (response) {
                const businesses = response.businesses.data;

                if (!businesses || businesses.length === 0) {
                    $('#businessGrid').addClass('d-none');
                    $('#emptyState').removeClass('d-none');
                    $('#pagination').empty();
                    return;
                }

                $('#emptyState').addClass('d-none');
                $('#businessGrid').removeClass('d-none');

                renderMyBusinesses(businesses);
                renderMyPagination(response.businesses);
            },
            error: function () {
                $('#businessGrid').html(`
                    <div class="col-12 text-center py-4 text-danger">
                        <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                        <p>Failed to load businesses. Please refresh.</p>
                    </div>
                `);
            }
        });
    }

    /* ── Render Cards ── */
    function renderMyBusinesses(businesses) {
        const $grid = $('#businessGrid').empty();

        businesses.forEach(function (business) {
            $grid.append(createMyBusinessCard(business));
        });
    }

    /* ── Create Card ── */
    function createMyBusinessCard(business) {
        const capitalize = s => s ? s.charAt(0).toUpperCase() + s.slice(1) : '';

        const logo = business.logo
            ? `{{ asset('assets') }}/${business.logo}`
            : `https://ui-avatars.com/api/?name=${encodeURIComponent(business.business_name)}&background=9C7D2D&color=fff`;

        const gradients = [
            'linear-gradient(135deg, #917F2D, #C6B75E)',
            'linear-gradient(135deg, #808181, #B4B5B6)',
            'linear-gradient(135deg, #566828, #8FAF3C)',
            'linear-gradient(135deg, #03045D, #4361EE)'
        ];

        const photoSection = business.cover_photo
            ? `<img src="{{ asset('assets') }}/${business.cover_photo}"
                    style="width:100%;height:180px;object-fit:cover;">`
            : `<div style="
                    background:${gradients[business.id % gradients.length]};
                    height:180px;width:100%;
                "></div>`;

        const verified = (business.status === 'approved' && business.is_verified === 1)
            ? `<div style="
                    position:absolute;top:12px;left:12px;
                    background:white;padding:5px 10px;
                    border-radius:20px;font-size:11px;
                    font-weight:600;color:#27AE60;
                    box-shadow:0 2px 8px rgba(0,0,0,0.15);
                    display:flex;align-items:center;gap:4px;">
                    <i class="fas fa-check-circle"></i> GME Verified
               </div>`
            : '';

        const shortIntro = business.short_introduction
            ? (business.short_introduction.length > 90
                ? business.short_introduction.substring(0, 90) + '...'
                : business.short_introduction)
            : '';

        const link = (business.status === 'draft')
            ? '{{ route("gme.business.register") }}'
            : `{{ url('gme-business-form') }}/${business.slug}`;

        const deleteBtn = (business.status === 'draft')
            ? `<button class="draft-delete-btn" data-business-id="${business.id}" title="Delete Draft"
                    style="position:absolute;top:10px;right:10px;z-index:10;
                           width:34px;height:34px;border-radius:50%;border:none;
                           background:rgba(220,38,38,0.92);color:#fff;font-size:12px;
                           display:flex;align-items:center;justify-content:center;
                           box-shadow:0 2px 8px rgba(0,0,0,0.2);cursor:pointer;">
                    <i class="fas fa-trash-alt"></i>
               </button>`
            : '';

        return `
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <div data-link="${link}"
                 style="background:white;border-radius:12px;overflow:hidden;
                        box-shadow:0 2px 8px rgba(0,0,0,0.08);
                        border:1px solid #9b7d2d;cursor:pointer;
                        transition:all 0.3s;height:100%;position:relative;"
                 class="my-biz-card">
                ${deleteBtn}
                <div style="position:relative;">
                    ${photoSection}
                    ${verified}
                </div>
                <div style="padding:15px;">
                    <div style="display:flex;gap:10px;align-items:center;margin-bottom:10px;">
                        <img src="${logo}"
                             style="width:48px;height:48px;border-radius:6px;
                                    object-fit:cover;border:1px solid #EEE;flex-shrink:0;">
                        <div>
                            <div style="font-size:14px;font-weight:700;color:#2C3E50;line-height:1.3;">
                                ${business.business_name}
                                <span style="font-size:11px;color:#9C7D2D;font-weight:600;">
                                    (${capitalize(business.status)})
                                </span>
                            </div>
                            <div style="font-size:12px;color:#7F8C8D;">
                                ${business.category?.name ?? ''}
                            </div>
                        </div>
                    </div>
                    <p style="font-size:13px;color:#555;margin:0;line-height:1.5;">
                        ${shortIntro}
                    </p>
                </div>
            </div>
        </div>`;
    }

    /* ── Pagination ── */
    function renderMyPagination(data) {
        const $p = $('#pagination').empty();
        if (data.last_page <= 1) return;

        if (data.current_page > 1)
            $p.append(`<li class="page-item">
                <a class="page-link" href="#" data-page="${data.current_page - 1}">Previous</a>
            </li>`);

        for (let i = 1; i <= data.last_page; i++)
            $p.append(`<li class="page-item ${i === data.current_page ? 'active' : ''}">
                <a class="page-link" href="#" data-page="${i}">${i}</a>
            </li>`);

        if (data.current_page < data.last_page)
            $p.append(`<li class="page-item">
                <a class="page-link" href="#" data-page="${data.current_page + 1}">Next</a>
            </li>`);
    }

    /* ── Card Click + Delete ── */
    $(document).on('click', '.my-biz-card', function (e) {
        const deleteBtn = $(e.target).closest('.draft-delete-btn');

        if (deleteBtn.length) {
            e.stopPropagation();
            const id = deleteBtn.data('business-id');

            if (!confirm('Warning: All data will be permanently deleted.\n\nDelete this draft?')) return;

            const csrf = $('meta[name="csrf-token"]').attr('content');

            fetch(`/gme-business/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ _method: 'DELETE' })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    deleteBtn.closest('.col-6').remove();
                } else {
                    alert(data.message ?? 'Could not delete.');
                }
            })
            .catch(() => alert('Something went wrong.'));

            return;
        }

        const link = $(this).data('link');
        if (link) window.location.href = link;
    });

    /* ── Init ── */
    fetchMyBusinesses();
});
</script>