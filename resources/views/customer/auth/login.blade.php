<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GME Network Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #9C7D2D 0%, #FFD700 100%);
            min-height: 100vh;
        }

        /* ── HEADER ───────────────────────────────── */
        .gme-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            background: #fdfaf2;
            transition: all 0.3s ease;
        }

        .gme-header-inner {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 18px 0;
        }

        .gme-header.scrolled {
            background: #f9f6ef;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .gme-header.scrolled .gme-header-inner {
            padding: 12px 0;
        }

        .gme-logo img {
            height: 42px;
            display: block;
            margin: auto;
        }

        .gme-nav ul {
            list-style: none;
            display: flex;
            gap: 28px;
            margin: 0;
            padding: 0;
        }

        .gme-nav-left {
            display: flex;
            justify-content: flex-end;
            padding-right: 2.5rem;
        }

        .gme-nav-right {
            display: flex;
            justify-content: space-between;
            padding-left: 2.5rem;
        }

        .gme-nav a {
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            color: #9b7d2d;
        }

        .gme-nav a:hover,
        .gme-nav a.active {
            color: #b08d2f;
        }

        /* ── HAMBURGER ────────────────────────────── */
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

        /* ── MOBILE OVERLAY ───────────────────────── */
        #mobileMenu {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
        }

        #mobileMenu.open {
            display: block;
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

        /* ── LOGIN CARD ───────────────────────────── */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 6rem 1rem 2rem;
        }

        .login-card {
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .login-logo {
            max-width: 15rem;
            height: auto;
            padding-right: 3rem;
            padding-top: 3rem;
            display: block;
            margin: 0 auto 1.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(87,104,41,0.15);
            border-color: #576829;
        }

        .btn-login {
            background: linear-gradient(135deg, #576829 0%, #758c39 100%);
            border: none;
            color: #fff;
            font-weight: 500;
            padding: 0.65rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.25s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(87,104,41,0.35);
            color: #fff;
        }

        .link-gold {
            color: #576829;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .link-gold:hover {
            color: #9C7D2D;
            text-decoration: underline;
        }

        /* ── MOBILE (≤768px) ──────────────────────── */
        @media (max-width: 768px) {
            .gme-nav-left,
            .gme-nav-right { display: none; }

            .gme-hamburger { display: flex; }

            .gme-header-inner {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 14px 16px;
            }

            .gme-logo {
                flex: 1;
                display: flex;
                justify-content: center;
            }

            .login-wrapper { padding: 5rem 1rem 2rem; }

            .login-logo {
                max-width: 10rem;
                padding-right: 1.5rem;
                padding-top: 0;
            }

            .login-card {
                padding: 1.75rem 1.25rem;
                border-radius: 1.25rem;
            }
            .mob-margin{
                margin-top: -1rem;
            }
            .mob-pad{
                padding-top: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header id="mainHeader" class="gme-header">
        <div class="container gme-header-inner">

            <nav class="gme-nav gme-nav-left">
                <ul>
                    <li><a class="active" href="{{ route('guest.index') }}">Home</a></li>
                    <li><a href="https://gme.network/get-involved/">Get Involved</a></li>
                </ul>
            </nav>

            <div class="gme-logo">
                <a href="https://gme.network/">
                    <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
                </a>
            </div>

            <nav class="gme-nav gme-nav-right">
                <ul>
                    <li><a href="https://gme.network/events/">Events</a></li>
                    <li><a href="https://gme.network/news/">News</a></li>
                    <li>
                        @auth('customer')
                            <a style="color:#9C7D2D" href="{{ route('gme.business.register') }}">Add Your Business</a>
                        @else
                            <a style="color:#9C7D2D" href="{{ route('customer.register') }}">Add Your Business</a>
                        @endauth
                    </li>
                </ul>
            </nav>

            <!-- HAMBURGER (mobile only) -->
            <button class="gme-hamburger" id="hamburgerBtn" aria-label="Open menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </header>

    <!-- MOBILE MENU — backdrop + drawer in one fixed container -->
    <div id="mobileMenu">
        <div class="gme-backdrop" id="menuBackdrop"></div>

        <div class="gme-drawer">
            <div class="gme-drawer-top">
                <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
                <button class="gme-close-btn" id="closeBtn" aria-label="Close menu">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <nav class="gme-drawer-links">
                <a class="active" href="{{ route('guest.index') }}">
                    <i class="fa fa-home"></i> Home
                </a>
                <a href="https://gme.network/get-involved/">
                    <i class="fa fa-hands-helping"></i> Get Involved
                </a>
                <div class="gme-drawer-divider"></div>
                <a href="https://gme.network/events/">
                    <i class="fa fa-calendar-alt"></i> Events
                </a>
                <a href="https://gme.network/news/">
                    <i class="fa fa-newspaper"></i> News
                </a>
            </nav>

            <div class="gme-drawer-footer">
                @auth('customer')
                    <a href="{{ route('gme.business.register') }}">
                        <i class="fa fa-plus-circle me-2"></i> Add Your Business
                    </a>
                @else
                    <a href="{{ route('customer.register') }}">
                        <i class="fa fa-plus-circle me-2"></i> Add Your Business
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- LOGIN -->
    <div class="login-wrapper">
        <img src="{{ asset('assets/image/front-logo.png') }}"
             alt="GME Network Logo"
             class="login-logo">

        <div class="login-card">

            @if ($errors->any())
                <div class="alert alert-danger py-2 mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="Enter email" required value="{{ old('email') }}">
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter password" required>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-login">
                        <i class="fa fa-sign-in-alt me-2"></i>{{ __('login.sign_in_button') }}
                    </button>
                </div>

                <div class="row justify-content-between align-items-center">
                    <div class="col-md-6 mob-margin">
                        <a href="{{ route('customer.forget.password') }}" class="link-gold">
                            Forgot Password?
                        </a>
                    </div>
                    <div class="col-md-6 mob-pad">
                        <a href="{{ route('customer.register') }}" class="link-gold">
                            <i class="fa fa-user-plus me-1"></i>Create new account
                        </a>
                    </div>
                    
                    
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sticky header
        window.addEventListener('scroll', function () {
            document.getElementById('mainHeader')
                .classList.toggle('scrolled', window.scrollY > 10);
        });

        // Mobile menu — vanilla JS, no classes needed
        var menu      = document.getElementById('mobileMenu');
        var hamburger = document.getElementById('hamburgerBtn');
        var closeBtn  = document.getElementById('closeBtn');
        var backdrop  = document.getElementById('menuBackdrop');

        function openMenu() {
            menu.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menu.style.display = 'none';
            document.body.style.overflow = '';
        }

        hamburger.addEventListener('click', openMenu);
        closeBtn.addEventListener('click', closeMenu);
        backdrop.addEventListener('click', closeMenu);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeMenu();
        });
    </script>
</body>
</html>