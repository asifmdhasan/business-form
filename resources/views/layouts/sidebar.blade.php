<!-- Sidebar -->
<nav class="bg-dark text-white position-fixed h-100" style="width:260px; top:0; left:0; overflow-y:auto;">
    <div class="p-3">

        <!-- Branding -->
        <h4 class="text-center py-3 border-bottom">
            {{ config('app.name', 'Dashboard') }}
        </h4>

        <!-- Menu -->
        <ul class="nav flex-column mt-3">

            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">
                    <i class="fa fa-home me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link text-white">
                    <i class="fa fa-users me-2"></i> Users
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('gme-business.index') }}" class="nav-link text-white">
                    <i class="fa fa-box me-2"></i> Index
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('gme-business.create') }}" class="nav-link text-white">
                    <i class="fa fa-shopping-basket me-2"></i> Create
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="{{ route('settings.index') }}" class="nav-link text-white">
                    <i class="fa fa-cog me-2"></i> Settings
                </a>
            </li> --}}

            <li class="nav-item mt-3">
                <a href="{{ route('logout') }}" class="nav-link text-danger">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>

        </ul>
    </div>
</nav>
