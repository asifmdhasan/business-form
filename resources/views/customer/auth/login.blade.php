<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{ __('layouts.projectName') }}</title> --}}
    <title>GME Network Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #9C7D2D 0%, #FFD700 100%);
        }


        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }

        .btn-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .floating-label {
            transition: all 0.2s ease;
        }

        .floating-label.active {
            transform: translateY(-1.5rem) scale(0.85);
            color: #667eea;
        }
        .to-indigo-500 {
            --tw-gradient-to: #576829  !important;
        }
        .to-purple-500 {
            --tw-gradient-to: #576829 !important;
        }











        /* HEADER BASE */
        .gme-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 9999;
            background: #fdfaf2;
            transition: all 0.3s ease;

        }
        /* .gme-header {
            transition: all 0.3s ease;
        }

        #mainNavbar.scrolled {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(240, 235, 223, 0.6);
        } */

        /* INNER GRID */
        .gme-header-inner {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            padding: 18px 0;
        }

        /* STICKY EFFECT */
        .gme-header.scrolled {
            padding: 0;
            background: #f9f6ef;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }

        .gme-header.scrolled .gme-header-inner {
            padding: 12px 0;
        }

        /* LOGO */
        .gme-logo img {
            height: 42px;
            display: block;
            margin: auto;
        }

        /* NAV */
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
            color: #1c1c1c;
            position: relative;
        }

        .gme-nav a:hover,
        .gme-nav a.active {
            color: #b08d2f;
        }

        /* DROPDOWN */
        .has-dropdown {
            position: relative;
        }

        .dropdown {
            position: absolute;
            top: 130%;
            left: 0;
            background: #fff;
            min-width: 220px;
            border-radius: 8px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: 0.25s ease;
            padding: 10px 0;
        }

        .dropdown li {
            padding: 0;
        }

        .dropdown a {
            display: block;
            padding: 10px 18px;
            font-size: 14px;
            color: #333;
        }

        .dropdown a:hover {
            background: #f5f2ea;
        }

        /* SHOW DROPDOWN */
        .has-dropdown:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }


            @media (max-width: 768px) {
                .hero-section h1 {
                    font-size: 2rem;
                }
                .filter-sidebar {
                    position: relative;
                    top: 0;
                    margin-bottom: 2rem;
                }
            }
            @media (max-width: 768px) {
                .filter-sidebar {
                    margin-bottom: 30px;
                }
            }
            @media (max-width: 768px) {
            .hero-section {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
            .hero-section h1 {
                font-size: 1.5rem;
            }
            .hero-section p {
                font-size: 0.875rem;
            }
            .position-relative.w-100 {
                max-width: 100% !important;
                padding: 0 0.5rem;
            }
            #heroSearchResults {
                max-height: 200px;
            }

            #businessGrid {
                grid-template-columns: 1fr;
            }

            .business-card {
                flex-direction: column;
            }

            .business-header {
                flex-direction: row;
                align-items: center;
                gap: 10px;
            }

            .business-content {
                padding: 15px;
            }

            .business-name {
                font-size: 16px;
            }
        }
    </style>
</head>

<body class="min-h-screen gradient-bg">
    <header id="mainHeader" class="gme-header">
        <div class="container gme-header-inner">

            <!-- LEFT MENU -->
            <nav class="gme-nav gme-nav-left">
                <ul>
                    <li><a class="active" href="{{ route('guest.index') }}">Home</a></li>
                    {{-- <li><a href="#">About GME</a></li> --}}
                    {{-- <li class="has-dropdown">
                        <a href="#">Get Involved</a>
                        <ul class="dropdown" style="display: inline-block;">
                            <li><a href="#">Become a Member</a></li>
                            <li><a href="#">Become a Partner</a></li>
                            <li><a href="#">Become a Volunteer</a></li>
                            <li><a href="#">Country Convenor</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li><a href="#">Business</a></li> --}}
                </ul>
            </nav>

            <!-- CENTER LOGO -->
            <div class="gme-logo">
                <a href="https://gme.network/">
                    <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
                </a>
            </div>

            <!-- RIGHT MENU -->
            <nav class="gme-nav gme-nav-right">
                <ul>
                    @auth('customer')
                        <li><a href="{{ route('gme.business.register') }}">Join Network</a></li>
                    @else
                        <li><a href="{{ route('customer.login') }}">Join Network</a></li>
                    @endauth
                </ul>
                
            </nav>
        </div>
    </header>
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;">
        </div>
    </div>
    
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 relative">
        <!-- Header Section -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md flex items-center justify-center">
            

            
            <img src="{{ asset('assets/image/front-logo.png') }}" 
                alt="Gme Network Logo" 
                class="img-fluid mb-2 mx-auto" 
                style="    max-width: 50%;height: auto;padding-right: 3rem; padding-top: 3rem;">
        </div>

        <!-- Form Section -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="glass-effect py-10 px-8 shadow-2xl sm:rounded-3xl relative overflow-hidden">
                <!-- Decorative elements -->
                <div
                    {{-- class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full opacity-10 transform translate-x-16 -translate-y-16" --}}
                    >
                </div>
                <div
                    {{-- class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-400 to-indigo-500 rounded-full opacity-10 transform -translate-x-12 translate-y-12"  --}}
                    >
                </div>

                @if ($errors->any())
                    <div class="mb-6 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('customer.login.submit') }}" method="POST">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" class="w-full border p-2 rounded"
                            placeholder="Enter email" required>
                        @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1">Password</label>
                        <input type="password" name="password" class="w-full border p-2 rounded"
                            placeholder="Enter password" required>
                    </div>

                    {{-- <button type="submit"
                            class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                        Login
                    </button> --}}
                    <div class="mb-6" style="margin-top: 2rem;">
                        <button type="submit"
                            class="w-full flex justify-center items-center py-2 px-6 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 btn-hover transition-all duration-400 shadow-lg"
                            style="background: linear-gradient(135deg, #576829 0%, #758c39 100%);"
                            >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            {{ __('login.sign_in_button') }}
                        </button>
                    </div>
                    <div class="row text-center" style="display: flex;justify-content: space-between;">
                        <a href='{{ route('customer.forget.password') }}'
                            class=" text-sm" style="color:#576829 ; ">
                            Forgot Password !!!
                        </a>

                    
                        <a href="{{ route('customer.register') }}" class=" text-sm"style="color:#576829; display:flex">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Create new account
                        </a>
                    
                    </div>

                    

                </form>

                
            </div>
        </div>

        <!-- Footer -->
        {{-- <div class="mt-8 text-center">
            <p class="text-sm text-indigo-100 opacity-75">
                &copy; 2024 Inventory Management System. All rights reserved.
            </p>
        </div> --}}
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>

</html>
