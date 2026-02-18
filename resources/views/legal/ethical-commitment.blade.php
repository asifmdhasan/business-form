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
<div class="legal-hero">
    <div class="legal-hero-overlay"></div>
    <div class="container position-relative">
        <h1 class="legal-hero-title">{{ $title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: rgba(255,255,255,0.75);">Home</a></li>
                <li class="breadcrumb-item active text-white">{{ $breadcrumb }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="legal-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="legal-card">

                    <p class="legal-intro">
                        All listed businesses agree to uphold ethical business principles, including honesty, 
                        transparency, fairness, and respect for agreements.
                    </p>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">1.</span> Our Commitment</h2>
                        <p>
                            This commitment reflects shared values and aims to promote trust and responsible 
                            conduct within the global Muslim business community.
                        </p>
                    </div>

                    <div class="legal-section-block">
                        <h2 class="legal-heading"><span class="legal-num">2.</span> Consequences of Violation</h2>
                        <p>
                            Violation of these principles may result in review or removal from the directory. 
                            We take ethical compliance seriously to protect the integrity of our community.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
