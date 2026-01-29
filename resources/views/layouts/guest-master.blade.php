<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('layouts.siteTitle') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/tooltips.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/choices.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet" />




    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<style>
.bg-primary {
    --bs-bg-opacity: 1;
    background-color: #9C7D2D !important;
}
.hero-section {
    position: relative;
    padding: 120px 0;
    overflow: hidden;
    background:
        linear-gradient(
            rgba(156, 125, 45, 0.9),
            rgba(156, 125, 45, 0.9)
        );
}

/* Islamic background enhancement */
.islamic-bg {
    background-color: #9C7D2D;
}


.hero-ornament {
    position: absolute;
    top: 56%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.8;
    z-index: 1;
    pointer-events: none;
}

.hero-ornament img {
    width: 500px;
    max-width: 70vw;
    animation: rotatePattern 60s linear infinite;
}

/* Rotation animation */
@keyframes rotatePattern {
    from {
        transform: rotate(360deg);
    }
    to {
        transform: rotate(0deg);
    }
}

/* ===============================
   CONTENT ABOVE BACKGROUND
================================ */

.hero-section .container {
    position: relative;
    z-index: 2;
}

/* ===============================
   TEXT STYLING
================================ */

.hero-section h1 {
    font-size: clamp(2rem, 4vw, 3.2rem);
    letter-spacing: 1px;
}

.hero-section p {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* ===============================
   SEARCH BOX STYLING
================================ */

#heroSearchInput {
    border-radius: 999px 0 0 999px;
    padding-left: 22px;
    border: none;
}

#heroSearchBtn {
    border-radius: 0 999px 999px 0;
    font-weight: 600;
}

/* ===============================
   MOBILE OPTIMIZATION
================================ */

@media (max-width: 768px) {
    .hero-section {
        padding: 90px 0;
    }

    .hero-ornament img {
        width: 280px;
    }
}



    :root {
        --primary-color: #D4AF37;
        --secondary-color: #2C3E50;
        --success-color: #27AE60;
        --text-muted: #7F8C8D;
         --primary-navy: #191970;
        --primary-gold: #FFD700;
        --dark-navy: #1f1f7a;
        --light-bg: #F8F8F8;
        --card-bg: #ffffff;
        --text-primary: #333333;
        --text-muted: #666666;
    }

    /* body {
        background-color: #F8F9FA;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    } */
    body {
        font-family: 'Exo 2', 'Segoe UI', sans-serif;
        background-color: var(--light-bg);
        color: var(--text-primary);
    }

        /* Category Cards */
    .category-card {
        background: white;
        border-radius: 12px;
        padding: 2rem 1rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s;
        cursor: pointer;
        border: 2px solid var(--primary-color);

    }

    .category-card:hover {
        background: var(--primary-color);
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        color: #fff;
    }

    .category-card .material-symbols-outlined {
        font-size: 3rem;
        color: var(--primary-color);
        transition: color 0.3s;
    }

    .category-card:hover .material-symbols-outlined {
        color: var(--primary-navy);
    }

    .category-card p {
        margin-top: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        transition: color 0.3s;
    }

    .category-card:hover p {
        color: var(--primary-navy);
    }

        /* Islamic Pattern Background */
    .islamic-bg {
        /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23FFD700' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h16v9h1v-9h9v9h1v-9h9v9h1v-9h9v9h1v-9h9v9h1v-9h9v9h1v-9h9v9h1v-9h9v9h1v-9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm-90-10v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm-90-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm-90-10v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm-90-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm-90-10v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm-90-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm-90-10v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9zm10 0v-9h-9v9h9z'/%3E%3Cpath d='M6 5V0h1v5h94V0h1v5h-1v90h1v5H95v-5H6v5H5v-5H0V5h5V0h1v5h94V0h1v5z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); */
        background-image: url('{{ asset('assets/image/bg.webp') }}');
        background-size: cover;
        padding-top:10rem; 
        padding-bottom:8rem;


    }
    .btn-login {
        
        background: var(--primary-color);
        color: var(--primary-navy);
        font-weight: 700;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .btn-login:hover {
        transform: scale(1.05);
        background: var(--primary-color);
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
        height: auto;
        object-fit: cover;
        display: block;
        margin: 0 auto;
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
        width: 50px;
        height: 50px;
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


    /* Footer */
    .footer {
        background: var(--primary-navy);
        color: white;
        padding: 4rem 0 2rem;
    }

    .footer h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    /* .footer a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer a:hover {
        color: var(--primary-gold);
    }

    .footer-cta {
        background: var(--dark-navy);
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 3rem;
    } */
    .grow-business{
        text-align: left;
    }

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
    .logo-box {
        width: 60px;
        height: 60px;
        background: white;
        padding: 0.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .page-link {
        color: #000;
    }

    .active>.page-link, .page-link.active {
        z-index: 3;
        color: var(--bs-pagination-active-color);
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .category-image{
        width: 10rem;

        object-fit: cover;
        display: block;
        margin: 0 auto 10px auto;
    }
    .category-image img{
        width: 100%;
        height: 100%;
    }














    /* =========================
   FOOTER BASE
========================= */
.footer {
    position: relative;
    color: #fff;
    padding: 90px 0 40px;
    overflow: hidden;

    background: 
        linear-gradient(rgba(0, 0, 0, 0.95), rgba(0, 0, 0, 0.95)), /* super dark overlay */
        url('/assets/image/foo.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}



/* =========================
   ISLAMIC PATTERN OVERLAY
========================= */

.footer::before {
    content: "";
    position: absolute;
    inset: 0;
    background: url('/assets/image/islamic-arch.png') center/cover no-repeat;
    opacity: 0.15;
    z-index: 0;
}

/* =========================
   FOOTER CONTENT ABOVE
========================= */

.footer .container {
    position: relative;
    z-index: 2;
}

/* =========================
   CTA BAR
========================= */

.footer-cta {
    background: rgba(180, 150, 60, 0.15);
    border-radius: 20px;
    padding: 28px 32px;
    border: 1px solid rgba(180, 150, 60, 0.25);
}

.footer-cta h2 {
    color: #f3e7b0;
}

.footer-cta p {
    color: rgba(255,255,255,0.75);
}

/* CTA Button */
.join-network {
    background: linear-gradient(135deg, #c9a23a, #9c7d2d);
    color: #191970 !important;
    font-weight: 600;
    border-radius: 999px;
    padding: 12px 26px;
}
.join-network-white {
    background: linear-gradient(135deg, #fff, #fff);
    color: #191970 !important;
    font-weight: 600;
    border-radius: 999px;
    padding: 12px 26px;
}
/* =========================
   FOOTER HEADINGS
========================= */

.footer h3 {
    font-size: 1.1rem;
    margin-bottom: 14px;
    color: #e6d48a;
    letter-spacing: 0.5px;
}

/* =========================
   LINKS
========================= */

.footer a {
    color: rgba(255,255,255,0.75);
    text-decoration: none;
}

.footer a:hover {
    color: #e6d48a;
}

/* =========================
   SOCIAL ICONS
========================= */

.footer .fab {
    color: #c9a23a;
    transition: transform 0.3s ease, color 0.3s ease;
}

.footer .fab:hover {
    transform: translateY(-2px);
    color: #fff;
}

/* =========================
   COPYRIGHT
========================= */

.footer .text-center {
    color: rgba(255,255,255,0.5);
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
    justify-content: flex-start;
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

    .business-category,
    .business-location {
        font-size: 12px;
    }

    .logo-box {
        width: 50px;
        height: 50px;
    }
    #categoryBrowse {
        grid-template-columns: repeat(2, 1fr);
    }
    .filter-sidebar {
        position: relative;
        top: 0;
        margin-bottom: 2rem;
    }
    .input-group-lg>.btn, .input-group-lg>.form-control, .input-group-lg>.form-select, .input-group-lg>.input-group-text {
        padding: .5rem 0.5rem;
        font-size: 1rem;
        border-radius: var(--bs-border-radius-lg);
    }
    .category-image {
        width: 100%;
    }
    .results-count{
        display: none;
    }
    .grow-business{
        text-align: center;
    }
    .islamic-bg {
        padding-top:7rem; 
        padding-bottom:7rem;
    }
    .footer.islamic-bg {
        padding-top:0rem; 
        padding-bottom:1.5rem;
    }
}

    .join-network:hover {
        color: #fff;
    }
    .join-network-white:hover {
        color: #fff !important;
    }


    .gme-btn {
    background-color: #EDEDED;
    font-family: "SF Ui Display", Sans-serif;
    font-size: 18px;
    font-weight: 700;
    fill: #9C7D2D;
    color: #9C7D2D;
    border-style: solid;
    border-width: 1px 1px 1px 1px;
    border-radius: 30px 30px 30px 30px;
    padding: 14px 10px 14px 22px;

}

.gme-btn:hover, .gme-btn:focus {
    background-color: #414141;
    color: #FFFFFF;
    border-color: #9C7D2D;
}

.gme-btn-inner {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.gme-btn-icon  {
    /* font-size: 14px; */
    transition: transform 0.25s ease;
}

/* Hover effect (Elementor-like) */
/* .gme-btn:hover {
    background-color: #9c7a24;
    color: #fff;
} */

.gme-btn:hover .gme-btn-icon i {
    transform: translateX(4px);
}

</style>
</head>

<body class="bg-light">
<header id="mainHeader" class="gme-header">
    <div class="container gme-header-inner">

        <!-- LEFT MENU -->
        <nav class="gme-nav gme-nav-left">
            <ul>
                <li><a class="active" href="#">Home</a></li>
                <li><a href="#">About GME</a></li>
                <li class="has-dropdown">
                    <a href="#">Get Involved</a>
                    <ul class="dropdown" style="display: inline-block;">
                        <li><a href="#">Become a Member</a></li>
                        <li><a href="#">Become a Partner</a></li>
                        <li><a href="#">Become a Volunteer</a></li>
                        <li><a href="#">Country Convenor</a></li>
                    </ul>
                </li>
                <li><a href="#">Business</a></li>
            </ul>
        </nav>

        <!-- CENTER LOGO -->
        <div class="gme-logo">
            <a href="/">
                <img src="{{ asset('assets/image/logo.webp') }}" alt="GME">
            </a>
        </div>

        <!-- RIGHT MENU -->
        <nav class="gme-nav gme-nav-right">
            <ul>
                <li class="has-dropdown">
                    <a href="#">Events</a>
                    <ul class="dropdown" style="display: inline-block;">
                        <li><a href="#">Upcoming Events</a></li>
                        <li><a href="#">Previous Events</a></li>
                    </ul>
                </li>
                <li><a href="#">News</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

    </div>
</header>


    <!-- Main Content -->
    <main class="main-content" style="">
        
        <div class="container-fluid py-0 px-0">
            <section class="hero-section text-center text-white islamic-bg"
                {{-- style="background:linear-gradient(135deg,#1E2A78,#283593); " --}}
                >
                <div class="hero-ornament">
                    <img src="{{ asset('assets/image/round.webp') }}" alt="Islamic Pattern">
                </div>
                <div class="container">
                    <h1 class="fw-bold mb-3">Find a Muslim Entrepreneur Near You</h1>
                    <p class="mb-4">Discover Muslim entrepreneurs in your area</p>

                    <div class="d-flex justify-content-center">
                        <!-- 🔹 Relative wrapper (IMPORTANT) -->
                        <div class="position-relative w-100" style="max-width:600px;">

                            <!-- Search box -->
                            <div class="input-group input-group-lg">
                                <input type="text"
                                    id="heroSearchInput"
                                    class="form-control"
                                    placeholder="Search by business name ...">
                                <button class="btn btn-warning" id="heroSearchBtn">
                                    <span style="font-weight: 400;color: #191970; font-size: 18px;"> Search
                                </button>
                            </div>
                            <a href="{{ route('customer.login') }}" class="btn btn-login join-network-white" style=" color: #191970; margin-top: 3rem;;">
                                Join the Network
                            </a>
                            {{-- <a href="{{ route('guest.form') }}" class="gme-btn">
                                <span class="gme-btn-inner">
                                    <span class="gme-btn-icon">
                                        <i class="icon icon-arrow-right"></i>
                                    </span>
                                    <span class="gme-btn-text">Join the Network</span>
                                </span>
                            </a> --}}

                            <!-- 🔽 Live Search Results Dropdown -->
                            <div id="heroSearchResults"
                                class="position-absolute w-100 bg-white shadow rounded mt-2 d-none"
                                style="z-index:999; max-height:260px; overflow-y:auto;">
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            @yield('content')

            {{-- FOOTER --}}
            <footer class="footer islamic-bg">
                <div class="container">
                    <div class="footer-cta text-center mb-4 d-md-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-md-0">
                            <h2 class="h4 mb-1 grow-business">Grow Your Business</h2>
                            <p class="mb-0" style="color: rgba(255,255,255,0.8);">
                                Join our network of talented Muslim entrepreneurs.
                            </p>
                        </div>
                        <a href="{{ route('customer.login') }}" class="btn btn-login join-network" style=" color: #191970;">
                            Join the Network
                        </a>
                    </div>

                    <div class="row g-4 pb-4 border-bottom border-white border-opacity-25 pt-4">
                        <div class="col-md-3">
                            <h3>GME Directory</h3>
                            <p style="color: rgba(255,255,255,0.7); font-size: 0.875rem;">Connecting communities, one business at a time.</p>
                        </div>
                        <div class="col-md-3">
                            <h3>Quick Links</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#">About Us</a></li>
                                <li class="mb-2"><a href="#">Blog</a></li>
                                <li class="mb-2"><a href="#">Contact</a></li>
                                <li class="mb-2"><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h3>Categories</h3>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#">Food & Drink</a></li>
                                <li class="mb-2"><a href="#">Retail</a></li>
                                <li class="mb-2"><a href="#">Services</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <h3>Follow Us</h3>
                            <div class="d-flex gap-3">
                                <a href="#"><i class="fab fa-facebook fa-lg"></i></a>
                                <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
                                <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="text-center pt-4" style="color: rgba(255,255,255,0.5); font-size: 0.875rem;">
                        © 2024 GME Business Directory. All Rights Reserved.
                    </div> --}}
                </div>
            </footer>
        </div>
    </main>

    <!-- Core JS -->

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Choices.js -->
    <script src="{{ asset('assets/js/choices.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('assets/js/plugins/flatpickr.min.js') }}"></script>

    <!-- Custom -->
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>
    <script src="{{ asset('assets/js/accordion.js') }}"></script>

    <!-- Global Select2 -->
    <script>
        $(document).ready(function() {
            $('.search_select').select2();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {

        let allBusinesses = [];
        let filteredBusinesses = [];

        let currentPage = 1;
        const perPage = 6;

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

        /* =========================
        Fetch Businesses
        ========================== */
        function fetchBusinesses() {
            $.ajax({
                url: '{{ route("guest.gme-business.ajax") }}',
                method: 'GET',
                success: function (response) {
                    // console.log(response);
                        allBusinesses = response.businesses;

                    // ✅ Parse countries_of_operation JSON
                    // allBusinesses = response.businesses.map(business => {
                    //     try {
                    //         business.countries_of_operation = Array.isArray(business.countries_of_operation)
                    //             ? business.countries_of_operation
                    //             : JSON.parse(business.countries_of_operation || '[]');
                    //     } catch(e) {
                    //         business.countries_of_operation = [];
                    //     }
                    //     return business;
                    // });

                    filteredBusinesses = [...allBusinesses];
                    renderFeatured(response.featured);

                    renderBusinesses();
                }
            });
        }

        /* =========================
        Fetch Categories
        ========================== */
        function fetchCategories() {
            $.ajax({
                url: '{{ route("guest.get-category.ajax") }}',
                method: 'GET',
                success: function (response) {
                        renderBrowseCategories(response.categories);

                        const $category = $('#categoryFilter').empty()
                        .append('<option value="">All Categories</option>');

                        response.categories.forEach(cat => {
                            $category.append(new Option(cat.name, cat.id));
                        });
                    // const $category = $('#categoryFilter').empty()
                    //     .append('<option value="">All Categories</option>');

                    // response.categories.forEach(cat => {
                    //     $category.append(new Option(cat.name, cat.id));
                    // });

                    // $category.trigger('change');
                }
            });
        }

        /* =========================
        Fetch Locations
        ========================== */
        function fetchLocations() {
            $.ajax({
                url: '{{ route("guest.get-locations.ajax") }}',
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

                // Status
                if (status && business.status !== status) {
                    return false;
                }

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
        // function renderBusinesses() {

        //     const $grid = $('#businessGrid').empty();

        //     if (!filteredBusinesses.length) {
        //         $grid.html(`
        //             <div class="col-12 no-results">
        //                 <i class="fas fa-search"></i>
        //                 <p>No businesses found.</p>
        //             </div>
        //         `);
        //         updateResultsCount(0);
        //         return;
        //     }

        //     filteredBusinesses.forEach(business => {
        //         $grid.append(createBusinessCard(business));
        //     });

        //     updateResultsCount(filteredBusinesses.length);
        // }

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
                $('#pagination').empty();
                return;
            }

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;
            const pageItems = filteredBusinesses.slice(start, end);

            pageItems.forEach(business => {
                $grid.append(createBusinessCard(business));
            });

            updateResultsCount(filteredBusinesses.length);
            renderPagination();
        }

        function renderPagination() {

            const totalPages = Math.ceil(filteredBusinesses.length / perPage);
            const $pagination = $('#pagination').empty();

            if (totalPages <= 1) return;

            // Prev
            $pagination.append(`
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}">Previous</a>
                </li>
            `);

            for (let i = 1; i <= totalPages; i++) {
                $pagination.append(`
                    <li class="page-item ${currentPage === i ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `);
            }

            // Next
            $pagination.append(`
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}">Next</a>
                </li>
            `);
        }



        /* =========================
        Card HTML
        ========================== */
        // function createBusinessCard(business) {

        //     const capitalizeFirstLetter = (str) => str ? str.charAt(0).toUpperCase() + str.slice(1) : '';

        //     const category = business.category?.name ?? '';
        //     // const logo = `{{ asset('assets') }}/${business.logo}`;
        //         const logo = business.logo
        //         ? `{{ asset('assets') }}/${business.logo}`
        //         : `https://ui-avatars.com/api/?name=${encodeURIComponent(business.business_name)}`;

        //     const photo = business.photos?.length
        //         ? `{{ asset('assets') }}/${business.photos[0]}`
        //         : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp?w=500&h=300&fit=crop';
        //     const verified = (business.status === 'approved' && business.is_verified === 1)
        //         ? `<div class="verified-badge">
        //                 <i class="fas fa-check-circle"></i> GME Verified
        //         </div>`
        //         : '';


        //     const countries = business.countries_of_operation && business.countries_of_operation.length > 0
        //         ? business.countries_of_operation.join(', ')
        //         : 'Location not specified';

        //     return `
        //     <div class="col-md-4 col-lg-4 p-2">
        //         <div class="business-card" onclick="location.href='{{ url('guest-gme-business-form') }}/${business.id}'">
        //             <div style="position:relative">
        //                 <img src="${photo}" class="business-image">
        //                 ${verified}
        //             </div>
        //             <div class="business-content">
        //                 <div class="business-header">
                            

        //                     <div class="logo-box">
        //                         <img src="${logo}" alt="${business.business_name}">
        //                     </div>


        //                     <div>
        //                         <div class="business-name">${business.business_name}</div>
        //                         <div class="business-category">${category}</div>
        //                     </div>
        //                 </div>
        //                 ${business.short_introduction ?? ''}
        //                 <div class="business-location">
        //                     <i class="fas fa-map-marker-alt location-icon"></i>
        //                     <div>${countries}</div>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>`;
        // }

        function createBusinessCard(business) {

            const capitalizeFirstLetter = (str) => str ? str.charAt(0).toUpperCase() + str.slice(1) : '';

            const category = business.category?.name ?? '';
            
            // Logo - use avatar if not available
            const logo = business.logo
                ? `{{ asset('assets') }}/${business.logo}`
                : `https://ui-avatars.com/api/?name=${encodeURIComponent(business.business_name)}`;

            // Cover Photo - use default if not available
            const photo = business.cover_photo
                ? `{{ asset('assets') }}/${business.cover_photo}`
                : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp?w=500&h=300&fit=crop';
            
            const verified = (business.status === 'approved' && business.is_verified === 1)
                ? `<div class="verified-badge">
                        <i class="fas fa-check-circle"></i> GME Verified
                    </div>`
                : '';

            const countries = business.countries_of_operation && business.countries_of_operation.length > 0
                ? business.countries_of_operation.join(', ')
                : 'Location not specified';

            return `
            <div class="col-md-4 col-lg-4 p-2">
                <div class="business-card" onclick="location.href='{{ url('guest-gme-business-form') }}/${business.id}'">
                    <div style="position:relative">
                        <img src="${photo}" class="business-image">
                        ${verified}
                    </div>
                    <div class="business-content">
                        <div class="business-header">
                            <div class="logo-box">
                                <img src="${logo}" alt="${business.business_name}">
                            </div>
                            <div>
                                <div class="business-name">${business.business_name}</div>
                                <div class="business-category">${category}</div>
                            </div>
                        </div>
                        ${business.short_introduction ?? ''}
                        <div class="business-location">
                            <i class="fas fa-map-marker-alt location-icon"></i>
                            <div>${countries}</div>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        function renderBrowseCategories(categories) {
            const $wrap = $('#categoryBrowse').empty();

            categories.slice(0, 5).forEach(cat => {

                const image = cat.image
                    ? `{{ asset('assets') }}/${cat.image}`
                    : `https://ui-avatars.com/api/?name=${encodeURIComponent(cat.name)}&background=1E2A78&color=ffffff`;

                $wrap.append(`
                    <div class="col-6 col-md-3">
                        <div class="card p-3 shadow-sm category-card text-center"
                            style="cursor:pointer"
                            onclick="filterByCategory(${cat.id})">

                            <div class="category-image mb-2">
                                <img src="${image}" alt="${cat.name}">
                            </div>

                            <div class="fw-semibold">${cat.name}</div>
                        </div>
                    </div>
                `);
            });
        }

        // function renderBrowseCategories(categories) {
        //     const $wrap = $('#categoryBrowse').empty();

        //     categories.slice(0,5).forEach(cat => {
        //         $wrap.append(`
        //             <div class="col-6 col-md-2">
        //                 <div class="card p-3 shadow-sm category-card"
        //                     style="cursor:pointer"
        //                     onclick="filterByCategory(${cat.id})">
        //                     <div class="fw-semibold">${cat.name}</div>
        //                 </div>
        //             </div>
        //         `);
        //     });
        // }



        function filterByCategory(id) {
            $('#categoryFilter').val(id).trigger('change');
            $('html,body').animate({
                scrollTop: $('#businessGrid').offset().top - 100
            }, 400);
        }

        // function renderFeatured(businesses) {
        //     const $grid = $('#featuredGrid').empty();

        //     businesses.forEach(business => {
        //         $grid.append(createBusinessCard(business));
        //     });
        // }
        function renderFeatured(businesses) {
            // console.log(businesses);
            const $grid = $('#featuredGrid').empty();

            if (!Array.isArray(businesses) || !businesses.length) {
                $grid.html(`
                    <div class="col-12 text-muted">
                        No featured businesses available.
                    </div>
                `);
                return;
            }

            businesses.forEach(business => {
                $grid.append(createBusinessCard(business));
            });
        }


        $('#heroSearchInput').on('keyup', function () {

            const query = $(this).val().toLowerCase().trim();
            const $results = $('#heroSearchResults').empty();

            if (!query || query.length < 2) {
                $results.addClass('d-none');
                return;
            }

            const matches = allBusinesses
                .filter(business => {
                    return (
                        business.business_name?.toLowerCase().includes(query) ||
                        business.short_introduction?.toLowerCase().includes(query)
                    );
                })
                .slice(0, 3);

            if (!matches.length) {
                $results
                    .removeClass('d-none')
                    .html(`<div class="p-3 text-muted">No results found</div>`);
                return;
            }

            matches.forEach(business => {

                const image = business.photos?.length
                    ? `{{ asset('assets') }}/${business.photos[0]}`
                    : 'http://gme.network/wp-content/uploads/2025/08/GME-Logo-1-01.webp';

                $results.append(`
                    <div class="hero-search-item"
                        onclick="location.href='{{ url('guest-gme-business-form') }}/${business.id}'">
                        <img src="${image}" class="hero-search-img">
                        <div>
                            <div class="hero-search-title">
                                ${business.business_name}
                            </div>
                            <div class="hero-search-category">
                                ${business.category?.name ?? ''}
                            </div>
                        </div>
                    </div>
                `);
            });

            $results.removeClass('d-none');
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

        $(document).on('click', '#pagination a', function (e) {
            e.preventDefault();

            const page = $(this).data('page');
            const totalPages = Math.ceil(filteredBusinesses.length / perPage);

            if (page < 1 || page > totalPages) return;

            currentPage = page;
            renderBusinesses();

            $('html,body').animate({
                scrollTop: $('#businessGrid').offset().top - 100
            }, 300);
        });


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

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#heroSearchInput, #heroSearchResults').length) {
                $('#heroSearchResults').addClass('d-none');
            }
        });


        $('#heroSearchBtn').on('click', function () {
            $('#searchInput').val($('#heroSearchInput').val());
            filterBusinesses();
        });


        
        /* =========================
        Init
        ========================== */
        fetchBusinesses();
        fetchCategories();
        fetchLocations();

    });
</script>

    
    <!-- DataTable Language -->
    <script>
        window.dataTableLanguage = {
            sProcessing: "{{ __('layouts.sProcessing') }}",
            sLengthMenu: "{{ __('layouts.sLengthMenu') }}",
            sZeroRecords: "{{ __('layouts.sZeroRecords') }}",
            sInfo: "{{ __('layouts.sInfo') }}",
            sInfoEmpty: "{{ __('layouts.sInfoEmpty') }}",
            sInfoFiltered: "{{ __('layouts.sInfoFiltered') }}",
            sSearch: "{{ __('layouts.sSearch') }}",
            oPaginate: {
                sFirst: "{{ __('layouts.sFirst') }}",
                sPrevious: "{{ __('layouts.sPrevious') }}",
                sNext: "{{ __('layouts.sNext') }}",
                sLast: "{{ __('layouts.sLast') }}"
            }
        };

        $(document).ready(function() {
            $('#allDataTable').DataTable({
                "language": window.dataTableLanguage
            });
        });
    </script>

    <!-- Delete Confirmation -->
    <script>
        function confirmDelete() {
            Swal.fire({
                title: "{{ __('layouts.delete_confirm') }}",
                text: "{{ __('layouts.not_revert') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: "{{ __('layouts.delete_confirm') }}",
                cancelButtonText: "{{ __('layouts.cancel_btn') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                }
            });
        }

        function prepareDelete(el) {
            const url = el.getAttribute('href');
            document.getElementById('deleteForm').setAttribute('action', url);
            confirmDelete();
        }
    </script>

{{-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 80) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
</script> --}}


</body>
</html>
