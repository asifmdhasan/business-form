<!-- Sidebar -->
<style>
    .bg-dark{
        background-color: #9C7D2D !important;
    }
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15);
        border-left: 3px solid #576829;
        padding-left: calc(0.5rem - 3px);
        border-radius: 5px;
        font-weight: 600;
    }
    @media (max-width: 768px) {
        .hide-for-mobile {
            display: none;
        }
    }
</style>
<nav class="bg-dark text-white position-fixed h-100 d-flex flex-column hide-for-mobile" style="width:260px; top:0; left:0; overflow-y:auto;">
    <div class="p-3">
        <div class="p-3 text-center">
            <!-- Logo -->
            <a href="{{ route('customer.gme-business-form.index') }}">
                <img src="{{ asset('assets/image/front-logo.png') }}" 
                    alt="Gme Network Logo" 
                    class="img-fluid mb-2" 
                    style="max-width: 60%; height: auto;">
            </a>
        </div>

        <!-- Menu -->
        <ul class="nav flex-column mt-3">

            
            {{-- <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link text-white fw-bold {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-home me-2"></i> Dashboard
                </a>
            </li> --}}

            <li class="nav-item">
                <a href="{{ route('customer.gme-business-form.index') }}" 
                    class="nav-link text-white {{ request()->routeIs('customer.gme-business-form.index') ? 'active' : '' }}" style="font-weight: 600; font-size:1rem">
                    <i class="fa fa-users me-2"></i> My Business
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('gme.business.register') }}" 
                class="nav-link text-white {{ request()->routeIs('gme.business.register') ? 'active' : '' }}" style="font-weight: 600; font-size:1rem">
                    <i class="fa fa-plus-circle me-2"></i> Add New Business
                </a>
            </li>
        </ul>
    </div>
    <!-- Logout at bottom -->
    <div class="mt-auto p-3">
        <a class="d-flex align-items-center" style="font-weight: 600; font-size:1rem; color: #fff; margin-bottom:3rem; margin-left: 1rem" href="{{ route('customer.logout') }}">
            <i class="fa fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
    
</nav>
