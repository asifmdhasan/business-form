<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GME Network Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #9C7D2D 0%, #FFD700 100%);
            min-height: 100vh;
            margin: 0;
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
            color: #9C7D2D;
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

        .gme-drawer-top img { height: 32px; }

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

        .gme-close-btn:hover { background: rgba(156,125,45,0.1); }

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

        .gme-drawer-footer a:hover { opacity: 0.9; }

        /* ── PAGE WRAPPER ─────────────────────────── */
        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 7rem 1rem 3rem;
        }

        .register-logo {
            max-width: 220px;
            height: auto;
            padding-right: 3rem;
            display: block;
            margin: 0 auto 1.5rem;
        }

        /* ── REGISTER CARD ────────────────────────── */
        .register-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .register-card h2 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #3a2e10;
            margin-bottom: 0.25rem;
        }

        .register-card .subtitle {
            font-size: 0.85rem;
            color: #9a8a6a;
            margin-bottom: 1.5rem;
        }

        /* Form fields */
        .field-group {
            margin-bottom: 1.1rem;
        }

        .field-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #4a3a1a;
            margin-bottom: 0.4rem;
        }

        .field-group .optional {
            font-weight: 400;
            color: #aaa;
            font-size: 0.78rem;
            margin-left: 4px;
        }

        .field-group input {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1.5px solid #e5dcc8;
            border-radius: 10px;
            font-size: 0.9rem;
            color: #3a2e10;
            background: #fdfaf5;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .field-group input:focus {
            border-color: #9C7D2D;
            box-shadow: 0 0 0 3px rgba(156,125,45,0.12);
            background: #fff;
        }

        .field-group input::placeholder { color: #c0b090; }

        .field-error {
            font-size: 0.78rem;
            color: #dc2626;
            margin-top: 4px;
        }

        /* Password wrapper */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 2.8rem;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9C7D2D;
            font-size: 15px;
            padding: 0;
            line-height: 1;
        }

        /* Submit button */
        .btn-register {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, #576829 0%, #758c39 100%);
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
            margin-top: 0.5rem;
        }

        .btn-register:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(87,104,41,0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .login-link a {
            color: #576829;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            color: #9C7D2D;
            text-decoration: underline;
        }

        /* Error alert */
        .error-alert {
            background: #fef2f2;
            border: 1px solid #fca5a5;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
        }

        .error-alert ul {
            margin: 0;
            padding-left: 1.2rem;
            color: #dc2626;
            font-size: 0.85rem;
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

            .page-wrapper {
                padding: 5.5rem 1rem 2rem;
                justify-content: flex-start;
            }

            .register-logo {
                display: none;
                max-width: 140px;
                padding-right: 1.5rem;
                margin-bottom: 1.25rem;
            }

            .register-card {

                padding: 1.75rem 1.25rem;
                border-radius: 1.25rem;
            }
        }

        @media (max-width: 400px) {
            .register-logo { max-width: 110px; }
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

    <!-- MOBILE MENU -->
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

    <!-- PAGE CONTENT -->
    <div class="page-wrapper">

        <img src="{{ asset('assets/image/front-logo.png') }}"
             alt="GME Network Logo"
             class="register-logo">

        <div class="register-card">

            <h2>Create Account</h2>
            <p class="subtitle">Join the Global Muslim Business Directory</p>

            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('/register') }}" method="POST">
                @csrf

                <div class="field-group">
                    <label>Full Name</label>
                    <input type="text" name="name"
                           placeholder="Enter your full name"
                           value="{{ old('name') }}" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           placeholder="Enter your email"
                           value="{{ old('email') }}" required>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label>Phone <span class="optional">(optional)</span></label>
                    <input type="text" name="phone"
                           placeholder="Enter your phone number"
                           value="{{ old('phone') }}">
                    @error('phone')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="field-group">
                    <label>Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password"
                               id="passwordInput"
                               placeholder="Create a password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-register">
                    <i class="fa fa-user-plus me-2"></i> Create Account
                </button>

                <div class="login-link">
                    Already have an account?
                    <a href="{{ route('customer.login') }}">Sign In</a>
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

        // Mobile menu
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

        // Password toggle
        function togglePassword() {
            var input = document.getElementById('passwordInput');
            var icon  = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fa fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fa fa-eye';
            }
        }
    </script>
</body>
</html>