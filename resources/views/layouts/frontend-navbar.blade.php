<style>

    .home-btn a:hover {
        background-color: #9C7D2D;
        text-decoration: none;
        color: #fff;
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
                        {{-- <li class="">
                            <a href="#" class="nav-link text-danger fw-bold"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt me-2"></i> Cus Logout 
                            </a> 

                            <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        </li> --}}
                    </ul>
                </li>

            </ul>
        </div>

    </div>
</nav>

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
