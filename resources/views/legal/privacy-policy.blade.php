@extends('layouts.guest-master')

@section('title', $title)

@section('content')
<style>
    .hero-section.text-center.text-white.islamic-bg, .partner-section, .community-section{
        display: none;
    }
/* ── Legal Hero ── */
.legal-hero {
    position: relative;
    background: linear-gradient(135deg, #9C7D2D 0%, #7A6324 100%);
    padding: 12% 0px 8%;
    text-align: center;
    overflow: hidden;
    background-image: url('{{ asset('assets/image/bg.webp') }}');
    background-size: cover;
    background-position: center;
}

.legal-hero-title {
    font-size: 2.4rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}

/* ── Legal Body ── */
.legal-section {
    padding: 60px 0 80px;
    background: #f8f5f0;
    min-height: 60vh;
}

.legal-card {
    background: #fff;
    border-radius: 10px;
    padding: 50px 55px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.06);
}

.legal-intro {
    font-size: 15.5px;
    color: #555;
    line-height: 1.8;
    border-left: 4px solid #9C7D2D;
    padding-left: 18px;
    margin-bottom: 38px;
}

.legal-section-block {
    margin-bottom: 36px;
    padding-bottom: 36px;
    border-bottom: 1px solid #f0ece4;
}

.legal-section-block:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.legal-heading {
    font-size: 1.15rem;
    font-weight: 700;
    color: #3a2e1a;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.legal-num {
    color: #9C7D2D;
    font-weight: 800;
}

.legal-section-block p {
    font-size: 15px;
    color: #555;
    line-height: 1.85;
    margin-bottom: 10px;
}

.legal-list {
    padding-left: 20px;
    margin-bottom: 14px;
}

.legal-list li {
    font-size: 15px;
    color: #555;
    line-height: 1.9;
    margin-bottom: 4px;
}

.legal-list li::marker {
    color: #9C7D2D;
}

.legal-footer-note {
    margin-top: 36px;
    padding: 18px 22px;
    background: #faf7f0;
    border-radius: 8px;
    font-size: 14px;
    color: #666;
    border: 1px solid #ede7d5;
}

.legal-footer-note a {
    color: #9C7D2D;
    text-decoration: none;
    font-weight: 600;
}

.legal-footer-note a:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
    .legal-card {
        padding: 30px 22px;
    }
    .legal-hero-title {
        font-size: 1.7rem;
    }
}
</style>
<!-- Hero Banner -->
<div class="legal-hero">
    <div class="legal-hero-overlay"></div>
    <div class="container position-relative">
        <h1 class="legal-hero-title">{{ $title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" style="color: rgba(255,255,255,0.75);">Home</a>
                </li>
                <li class="breadcrumb-item active text-white">{{ $breadcrumb }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Content -->
<section class="legal-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="legal-card">

                    <p class="legal-intro">
                        The Global Muslim Business Directory respects your privacy and is committed to protecting 
                        your personal and business information. This Privacy Policy explains how we collect, use, 
                        store, and safeguard information shared with us.
                    </p>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">1.</span> Information We Collect</h2>
                        <p>We may collect the following information:</p>
                        <ul class="legal-list">
                            <li>Business details including name, category, location, and services</li>
                            <li>Founder or representative name and role</li>
                            <li>Contact information such as email address and phone number</li>
                            <li>Certification details if provided</li>
                            <li>Account login information</li>
                            <li>Contribution and payment related information where applicable</li>
                        </ul>
                        <p>We only collect information that is necessary to operate and improve the directory.</p>
                    </div>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">2.</span> How We Use Your Information</h2>
                        <p>Your information is used to:</p>
                        <ul class="legal-list">
                            <li>Display business listings within the directory</li>
                            <li>Verify business ownership and ethical alignment</li>
                            <li>Communicate updates related to your listing or account</li>
                            <li>Improve platform quality and user experience</li>
                            <li>Maintain security and prevent misuse</li>
                        </ul>
                        <p>We do not sell or rent user data to third parties.</p>
                    </div>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">3.</span> Data Sharing</h2>
                        <p>
                            Information may be shared internally with the Global Muslim Entrepreneurs Network team 
                            for verification and platform management purposes. We may also share limited data with 
                            trusted service providers strictly for operational needs.
                        </p>
                    </div>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">4.</span> Data Security</h2>
                        <p>
                            We take reasonable measures to protect your information from unauthorized access, 
                            misuse, or disclosure. While no system is completely secure, we act with care and 
                            responsibility in handling all data entrusted to us.
                        </p>
                    </div>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">5.</span> Your Rights</h2>
                        <p>
                            You may request access, correction, or removal of your data by contacting us. 
                            We aim to respond to all requests in a timely and respectful manner.
                        </p>
                    </div>

                    <div class="legal-footer-note">
                        <i class="fas fa-envelope me-2"></i>
                        For questions, contact us at <a href="mailto:support@gme.network">support@gme.network</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

