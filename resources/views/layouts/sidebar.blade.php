<!-- Sidebar -->

<style>

    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        border-left: 3px solid #9C7D2D !important;
        padding-left: calc(0.5rem - 3px);
        border-radius: 5px;
        font-weight: 600;
    }
</style>
{{-- <nav class="text-white position-fixed h-100" style="width:260px; top:0; left:0; overflow-y:auto; z-index:1000;background-color: #576829"> --}}
    <nav class="text-white position-fixed h-100 d-flex flex-column"
     style="width:260px; top:0; left:0; overflow-y:auto; z-index:1000; background-color:#576829">

    <div class="p-3  d-flex flex-column h-100">

        <!-- Branding -->
        {{-- <img src="{{ asset('assets/image/logo.webp') }}" alt="Gme Network Logo" class="img-fluid mb-2" style="max-width: 100%; height: auto;"> --}}
        <div class="p-3 text-center">
        <!-- Logo and Title -->
            <img src="{{ asset('assets/image/front-logo.png') }}" 
                alt="Gme Network Logo" 
                class="img-fluid mb-2" 
                style="max-width: 60%; height: auto;">
        </div>

        {{-- <h4 class="text-center py-3 border-bottom">
            Gme Network
        </h4> --}}

        <!-- Menu -->
        <ul class="nav flex-column mt-3">

            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link text-white fw-bold {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-home me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('gme-business-admin.index') }}"
                    class="nav-link text-white {{ request()->routeIs('gme-business-admin.index') ? 'active' : '' }}">
                    <i class="fa fa-list me-2"></i> All Business
                </a>
            </li>



            <!-- Categories Dropdown -->
            {{-- <li class="nav-item mt-3">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#categoriesMenu"
                   role="button"
                   aria-expanded="{{ request()->routeIs('business-categories.*') ? 'true' : 'false' }}"
                   aria-controls="categoriesMenu"
                   style="cursor: pointer;">
                    <span>
                        <i class="fa fa-folder me-2"></i>
                        <span class="text-uppercase small fw-bold">Categories</span>
                    </span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('business-categories.*') ? 'show' : '' }}" id="categoriesMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{ route('business-categories.index') }}"
                               class="nav-link text-white {{ request()->routeIs('business-categories.index') ? 'active' : '' }}">
                                <i class="fa fa-list me-2"></i> Category Index
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('business-categories.create') }}"
                               class="nav-link text-white {{ request()->routeIs('business-categories.create') ? 'active' : '' }}">
                                <i class="fa fa-plus-circle me-2"></i> Category Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <!-- Services/Products Dropdown -->
            {{-- <li class="nav-item mt-3">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#servicesMenu"
                   role="button"
                   aria-expanded="{{ request()->routeIs('services.*') ? 'true' : 'false' }}"
                   aria-controls="servicesMenu"
                   style="cursor: pointer;">
                    <span>
                        <i class="fa fa-box me-2"></i>
                        <span class="text-uppercase small fw-bold">Services/Products</span>
                    </span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="collapse {{ request()->routeIs('services.*') ? 'show' : '' }}" id="servicesMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{ route('services.index') }}"
                               class="nav-link text-white {{ request()->routeIs('services.index') ? 'active' : '' }}">
                                <i class="fa fa-list me-2"></i> Services Index
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('services.create') }}"
                               class="nav-link text-white {{ request()->routeIs('services.create') ? 'active' : '' }}">
                                <i class="fa fa-plus-circle me-2"></i> Services Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <!-- User Channel Dropdown (Commented) -->
            {{-- <li class="nav-item mt-3">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                   data-bs-toggle="collapse"
                   href="#userChannelMenu"
                   role="button"
                   aria-expanded="false"
                   aria-controls="userChannelMenu"
                   style="cursor: pointer;">
                    <span>
                        <i class="fa fa-users me-2"></i>
                        <span class="text-uppercase small fw-bold">User Channel</span>
                    </span>
                    <i class="fa fa-chevron-down"></i>
                </a>
                <div class="collapse" id="userChannelMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="{{ route('gme-business.index') }}" class="nav-link text-white">
                                <i class="fa fa-list me-2"></i> Index
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gme-business.create') }}" class="nav-link text-white">
                                <i class="fa fa-plus-circle me-2"></i> Create
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            <!-- Logout -->
            {{-- <li class="nav-item mt-4">
                <a href="#" class="nav-link fw-bold" style="color: #fff"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </li> --}}
            </ul>
            <div class="mt-auto" style="margin-left: 1rem; margin-bottom:3rem;">
                <a href="#" class="nav-link fw-bold text-white"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>

        
    </div>
</nav>

<style>
    /* Smooth dropdown animations */
    .collapse {
        transition: height 0.3s ease;
    }

    /* Hover effects for nav links */
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
    }

    /* Active link highlighting */
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        border-left: 3px solid #007bff;
        padding-left: calc(0.5rem - 3px);
        border-radius: 5px;
        font-weight: 600;
    }

    /* Rotate chevron on dropdown open */
    .nav-link[aria-expanded="true"] .fa-chevron-down {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
    }

    .nav-link .fa-chevron-down {
        transition: transform 0.3s ease;
    }
</style>
