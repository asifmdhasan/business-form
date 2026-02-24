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

        /* HEADER */
        .gme-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
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

        /* LOGIN CARD */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 6rem 1rem 2rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        /* .login-logo {
            max-width: 50%;
            height: auto;
            display: block;
            margin: 0 auto 1.5rem;
        } */
        .login-logo {
            max-width: 15rem;
            height: auto;
            padding-right: 3rem;
            padding-top: 3rem;
            margin: 0 auto 1.5rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(87, 104, 41, 0.15);
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
            box-shadow: 0 10px 25px rgba(87, 104, 41, 0.35);
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
    </style>
</head>
<body>

    <!-- HEADER -->
    <header id="mainHeader" class="gme-header">
        <div class="container gme-header-inner">

            <!-- LEFT NAV -->
            <nav class="gme-nav gme-nav-left">
                <ul>
                    <li><a class="active" href="{{ route('guest.index') }}">Home</a></li>
                    <li><a href="https://gme.network/get-involved/">Get Involved</a></li>
                </ul>
            </nav>

            <!-- LOGO -->
            <div class="gme-logo">
                <a href="https://gme.network/">
                    <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
                </a>
            </div>

            <!-- RIGHT NAV -->
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
                {{-- <ul class="d-flex align-items-center">
                    @auth('customer')
                        <li>
                            <a href="{{ route('customer.gme-business-form.index') }}" style="border:1px solid #9C7D2D; padding:0.7rem; border-radius:6px;">
                                <i class="fa fa-home me-2"></i>Dashboard
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('customer.login') }}" style="border:1px solid #9C7D2D; padding:0.7rem; border-radius:6px;">
                                <i class="fa fa-user me-2"></i>Login
                            </a>
                        </li>
                    @endauth
                </ul> --}}
            </nav>
        </div>
    </header>

    <!-- LOGIN SECTION -->
    <div class="login-wrapper">

        <img src="{{ asset('assets/image/front-logo.png') }}"
             alt="GME Network Logo"
             class="login-logo">

        <div class="login-card">

            {{-- Validation Errors --}}
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
                    <input type="email" name="email" class="form-control" placeholder="Enter email" required value="{{ old('email') }}">
                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-medium">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-login">
                        <i class="fa fa-sign-in-alt me-2"></i>{{ __('login.sign_in_button') }}
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('customer.forget.password') }}" class="link-gold">
                        Forgot Password?
                    </a>
                    <a href="{{ route('customer.register') }}" class="link-gold">
                        <i class="fa fa-user-plus me-1"></i>Create new account
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sticky header on scroll
        window.addEventListener('scroll', function () {
            const header = document.getElementById('mainHeader');
            header.classList.toggle('scrolled', window.scrollY > 10);
        });
    </script>
</body>
</html>