@extends('layouts.frontend-master')

@section('content')



    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        .active>.page-link, .page-link.active {
            z-index: 3;
            color: var(--bs-pagination-active-color);
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .page-link {
            color: #000;
        }
        :root {
            --primary-color: #D4AF37;
            --secondary-color: #2C3E50;
            --success-color: #27AE60;
            --text-muted: #7F8C8D;
        }

        body {
            background-color: #F8F9FA;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .filter-sidebar {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            position: sticky;
            top: 20px;
        }

        .filter-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
            font-size: 20px;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .filter-icon {
            color: var(--primary-color);
        }

        .search-box {
            margin-bottom: 25px;
        }

        .search-box input {
            border-radius: 8px;
            border: 1px solid #DDD;
            padding: 12px 15px;
            font-size: 14px;
        }

        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.15);
        }

        .filter-section {
            margin-bottom: 25px;
        }

        .filter-label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 10px;
            font-size: 14px;
        }

        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 8px;
            border-color: #DDD;
        }

        .radio-option {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .radio-option:hover {
            background: #F8F9FA;
        }

        .radio-option input[type="radio"] {
            margin-right: 10px;
            cursor: pointer;
            width: 18px;
            height: 18px;
            accent-color: var(--primary-color);
        }

        .radio-option label {
            cursor: pointer;
            margin: 0;
            flex: 1;
            font-size: 14px;
        }

        .btn-apply-filter {
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            margin-bottom: 10px;
            transition: all 0.3s;
        }

        .btn-apply-filter:hover {
            background: #C4A037;
            transform: translateY(-1px);
        }

        .btn-reset {
            background: white;
            color: var(--secondary-color);
            border: 1px solid #DDD;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-reset:hover {
            background: #F8F9FA;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .results-count {
            color: var(--text-muted);
            font-size: 15px;
        }

        .sort-section {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sort-label {
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 14px;
        }

        .sort-dropdown {
            border-radius: 8px;
            border: 1px solid #DDD;
            padding: 8px 35px 8px 12px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .sort-dropdown:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .business-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
            margin-bottom: 25px;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #9b7d2d;
            cursor: pointer;
        }

        .business-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            transform: translateY(-3px);
            border: 1px solid #9b7d2d;
            cursor: pointer;
        }

        .business-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            position: relative;
        }

        .verified-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: white;
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: var(--success-color);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .verified-icon {
            color: var(--success-color);
        }

        .business-content {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .business-header {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .business-logo {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #EEE;
        }

        .business-info {
            flex: 1;
        }

        .business-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 3px;
        }

        .business-category {
            color: var(--text-muted);
            font-size: 13px;
        }

        .business-tagline {
            color: #555;
            font-size: 14px;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .business-location {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            font-size: 13px;
            margin-top: auto;
        }

        .location-icon {
            color: var(--primary-color);
        }
        #businessGrid .col-md-6{
            padding-top: 1.5rem;
        }

        @media (max-width: 768px) {
            .filter-sidebar {
                margin-bottom: 30px;
            }
        }






        /* Delete Button Styles */
        .draft-delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;

            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            cursor: pointer;

            background: rgba(220, 38, 38, 0.92);
            color: #fff;
            font-size: 0.75rem;

            display: flex;
            align-items: center;
            justify-content: center;

            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        }

        .draft-delete-btn:hover {
            background: #b91c1c;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(185, 28, 28, 0.4);
        }

        .draft-delete-btn:active {
            transform: scale(0.96);
        }









    </style>


    <div class="container py-5">
        <div class="row">
            <!-- Business Listings -->
            <div class="col-lg-12">

                <!-- Business Cards Grid -->
                <div class="row" id="businessGrid">
                    <div class="col-12 loading-spinner">
                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                        <p class="mt-3">Loading businesses...</p>
                    </div>
                </div>


                <div id="businessContainer"></div>

                <div id="emptyState" class="text-center d-none" style="margin-top: 60px; height: 50vh;">
                    <h4 class="mb-3">You haven’t added any business yet</h4>

                    <a href="{{ route('gme.business.register') }}"
                    class="btn text-white px-4 py-2"
                    style="background-color:#9C7D2D;">
                        + Add Your Business
                    </a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>







<script>
    $(document).ready(function () {

        let allBusinesses = [];
        let filteredBusinesses = [];

        /* =========================
        Select2 Init
        ========================== */
        $('#categoryFilter').select2({
            theme: 'bootstrap-5',
            placeholder: 'All Categories',
            allowClear: true
        });

        $('#locationFilter').select2({
            theme: 'bootstrap-5',
            placeholder: 'Select Location(s)',
            allowClear: true
        });

        function fetchBusinesses(page = 1) {
            $.ajax({
                url: '{{ route("customer.gme-business.ajax") }}',
                method: 'GET',
                data: { page: page }, // ✅ Send page number
                success: function (response) {
                    const businesses = response.businesses.data;
                    // ✅ If no data
                    if (!businesses || businesses.length === 0) {
                        
                        $('#businessGrid').addClass('d-none');
                        $('#businessContainer').empty();
                        $('#emptyState').removeClass('d-none');
                        return;
                    }
                    // ✅ If data exists
                    $('#emptyState').addClass('d-none');

                    // console.log(response);
                    // ✅ Access the data array from paginated response
                    allBusinesses = response.businesses.data.map(business => {
                        try {
                            business.countries_of_operation = Array.isArray(business.countries_of_operation)
                                ? business.countries_of_operation
                                : JSON.parse(business.countries_of_operation || '[]');
                        } catch(e) {
                            business.countries_of_operation = [];
                        }
                        return business;
                    });

                    filteredBusinesses = [...allBusinesses];
                    renderBusinesses();
                    renderPagination(response.businesses); // ✅ Render pagination links
                }
            });
        }

        // ✅ Add pagination renderer
        function renderPagination(paginationData) {
            const $pagination = $('#pagination').empty();
            
            if (paginationData.last_page <= 1) return;
            
            // Previous button
            if (paginationData.current_page > 1) {
                $pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="${paginationData.current_page - 1}">Previous</a>
                    </li>
                `);
            }
            
            // Page numbers
            for (let i = 1; i <= paginationData.last_page; i++) {
                $pagination.append(`
                    <li class="page-item ${i === paginationData.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `);
            }
            
            // Next button
            if (paginationData.current_page < paginationData.last_page) {
                $pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="${paginationData.current_page + 1}">Next</a>
                    </li>
                `);
            }
        }

        // ✅ Handle pagination clicks
        $(document).on('click', '#pagination a', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            fetchBusinesses(page);
        });

        /* =========================
        Fetch Categories
        ========================== */
        function fetchCategories() {
            $.ajax({
                url: '{{ route("customer.get-category.ajax") }}',
                method: 'GET',
                success: function (response) {
                    const $category = $('#categoryFilter').empty()
                        .append('<option value="">All Categories</option>');

                    response.categories.forEach(cat => {
                        $category.append(new Option(cat.name, cat.id));
                    });

                    $category.trigger('change');
                }
            });
        }

        /* =========================
        Fetch Locations
        ========================== */
        function fetchLocations() {
            $.ajax({
                url: '{{ route("customer.get-locations.ajax") }}',
                method: 'GET',
                success: function (response) {
                    const $location = $('#locationFilter').empty();

                    response.locations.forEach(country => {
                        $location.append(new Option(country, country));
                    });

                    $location.trigger('change');
                }
            });
        }

        /* =========================
        Filter Businesses
        ========================== */
        function filterBusinesses() {

            const searchText = $('#searchInput').val().toLowerCase();
            const selectedCategory = $('#categoryFilter').val();
            const selectedLocations = $('#locationFilter').val() || [];
            const status = $('input[name="status"]:checked').val();
            // console.log('Selected Status:', status);

            filteredBusinesses = allBusinesses.filter(business => {

                // Search
                if (searchText) {
                    const text = [
                        business.business_name,
                        business.short_introduction,
                        business.category?.name
                    ].join(' ').toLowerCase();

                    if (!text.includes(searchText)) return false;
                }

                // Category
                if (selectedCategory && business.business_category_id != selectedCategory) {
                    return false;
                }

                // ✅ Location Filter (handle JSON array)
                if (selectedLocations.length > 0) {
                    const countries = business.countries_of_operation || [];
                    const match = selectedLocations.some(loc => countries.includes(loc));
                    if (!match) return false;
                }

                if (status !== "") {
                        if (Number(business.is_verified) !== Number(status)) {
                            return false;
                        }
                    }
                // Status
                // if (status && business.is_verified !== status) {
                //     return false;
                // }

                return true;
            });

            renderBusinesses();
        }

        /* =========================
        Sort
        ========================== */
        function sortBusinesses() {
            const sortBy = $('#sortBy').val();

            if (sortBy === 'newest') {
                filteredBusinesses.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            } else if (sortBy === 'asc') {
                filteredBusinesses.sort((a, b) => a.business_name.localeCompare(b.business_name));
            } else if (sortBy === 'desc') {
                filteredBusinesses.sort((a, b) => b.business_name.localeCompare(a.business_name));
            }

            renderBusinesses();
        }

        /* =========================
        Render Cards
        ========================== */
        function renderBusinesses() {

            const $grid = $('#businessGrid').empty();

            if (!filteredBusinesses.length) {
                $grid.html(`
                    <div class="col-12 no-results">
                        <i class="fas fa-search"></i>
                        <p>No businesses found.</p>
                    </div>
                `);
                updateResultsCount(0);
                return;
            }

            filteredBusinesses.forEach(business => {
                $grid.append(createBusinessCard(business));
            });

            updateResultsCount(filteredBusinesses.length);
        }

        // createBusinessCard — draft delete button + data-business-id on card
         function createBusinessCard(business) {
            const capitalizeFirstLetter = (str) => str ? str.charAt(0).toUpperCase() + str.slice(1) : '';

            const category = business.category?.name ?? '';
            // const logo = `{{ asset('assets') }}/${business.logo}`;
            const logo = business.logo
                ? `{{ asset('assets') }}/${business.logo}`
                : `https://ui-avatars.com/api/?name=${encodeURIComponent(business.business_name)}`;


            // const photo = business.cover_photo
            //     ? `{{ asset('assets') }}/${business.cover_photo}`
            //     : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp?w=500&h=300&fit=crop';
            const gradients = [
                'linear-gradient(135deg, #917F2D, #C6B75E)',
                'linear-gradient(135deg, #808181, #B4B5B6)',
                'linear-gradient(135deg, #566828, #8FAF3C)',
                'linear-gradient(135deg, #03045D, #4361EE)'
            ];

            let photoSection;

            if (business.cover_photo) {
                const photo = `{{ asset('assets') }}/${business.cover_photo}`;
                photoSection = `<img src="${photo}" class="business-image">`;
            } else {
                const gradientIndex = business.id % gradients.length;
                const gradient = gradients[gradientIndex];

                photoSection = `
                    <div class="business-image"
                        style="
                            background:${gradient};
                            height:200px;
                            width:100%;
                            border-radius:8px 8px 0 0;
                        ">
                    </div>`;
            }

            const verified = (business.status === 'approved' && business.is_verified === 1)
                ? `<div class="verified-badge">
                        <i class="fas fa-check-circle"></i> GME Verified
                   </div>`
                : '';

            const shortIntro = business.short_introduction
                ? (business.short_introduction.length > 100
                    ? business.short_introduction.substring(0, 100) + '...'
                    : business.short_introduction)
                : '';

            // ── link stored in data-link, NO onclick on card ──
            const link = (business.status === 'draft')
                ? '{{ route("gme.business.register") }}'
                : `{{ url('gme-business-form') }}/${business.slug}`;

            // ── delete button only for draft, NO onclick, uses data-business-id ──
            const deleteBtn = (business.status === 'draft')
                ? `<button
                        class="draft-delete-btn"
                        data-business-id="${business.id}"
                        title="Delete Draft">
                        <i class="fas fa-trash-alt"></i>
                   </button>`
                : '';

            return `
            <div class="col-md-6 col-lg-3">
                <div class="business-card"
                     data-business-id="${business.id}"
                     data-link="${link}"
                     style="position:relative; cursor:pointer;">
                    ${deleteBtn}
                    <div style="position:relative">
                        ${photoSection}
                        ${verified}
                    </div>
                    <div class="business-content">
                        <div class="business-header" style="display: flex; align-items: center;">
                            <img src="${logo}" class="business-logo">
                            <div>
                                <div class="business-name">${business.business_name} - (${capitalizeFirstLetter(business.status)})</div>
                                <div class="business-category">${category}</div>
                            </div>
                        </div>
                        ${shortIntro}
                    </div>
                </div>
            </div>`;
        }


        // ── Delete handler ──

        document.addEventListener('click', function (e) {

            // 1. Delete button
            const deleteBtn = e.target.closest('.draft-delete-btn');
            if (deleteBtn) {
                e.stopPropagation();
                e.preventDefault();

                const businessId = deleteBtn.dataset.businessId;

                if (!confirm('Warning: All data for this business will be permanently deleted and cannot be recovered.\n\nAre you sure you want to delete this draft?')) {
                    return;
                }

                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfMeta) {
                    alert('CSRF token not found. Please refresh the page.');
                    return;
                }

                fetch(`/gme-business/${businessId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfMeta.getAttribute('content'),
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ _method: 'DELETE' })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        deleteBtn.closest('.col-md-6').remove();
                    } else {
                        alert(data.message ?? 'Could not delete. Please try again.');
                    }
                })
                .catch(() => alert('Something went wrong. Please try again.'));

                return;
            }

            // 2. Card click → redirect
            const card = e.target.closest('.business-card');
            if (card) {
                const link = card.dataset.link;
                if (link) window.location.href = link;
            }
        });
       
        /* =========================
        Count
        ========================== */
        function updateResultsCount(count) {
            $('#showingCount').text(count);
            $('#totalCount').text(allBusinesses.length);
        }

        /* =========================
        Events
        ========================== */
        $('#applyFilters').on('click', filterBusinesses);
        $('#searchInput').on('keyup', filterBusinesses);
        $('#sortBy').on('change', sortBusinesses);
        $('#categoryFilter, #locationFilter').on('change', filterBusinesses);

        $('#resetFilters').on('click', function () {
            $('#searchInput').val('');
            $('#categoryFilter').val('').trigger('change');
            $('#locationFilter').val(null).trigger('change');
            $('#statusAll').prop('checked', true);
            filteredBusinesses = [...allBusinesses];
            renderBusinesses();
        });

        /* =========================
        Init
        ========================== */
        fetchBusinesses();
        fetchCategories();
        fetchLocations();

    });
</script>


@endsection

