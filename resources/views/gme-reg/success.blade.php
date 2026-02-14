@extends('layouts.frontend-master')

@section('content')
<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            
            <!-- Success Card -->
            <div class="card shadow-lg border-0 overflow-hidden">
                
                <!-- Header with GME Brand Colors -->
                <div class="card-header gme-gradient text-white text-center py-5 position-relative">
                    
                    <!-- Animated Background Pattern -->
                    <div class="position-absolute w-100 h-100 top-0 start-0" style="opacity: 0.1;">
                        <div class="pattern-overlay"></div>
                    </div>
                    
                    <!-- Success Icon -->
                    <div class="mb-4 position-relative">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-lg animate-bounce" 
                             style="width: 100px; height: 100px;">
                            <i class="fas fa-check-circle" style="font-size: 4rem; color: #9C7D2D;"></i>
                        </div>
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-3">JazakAllah Khair for Joining</h1>
                    <h2 class="h4 mb-2">Global Muslim Business Directory</h2>
                    <p class="lead mb-0 mt-3">Your venture is one step away from the global stage.</p>
                </div>

                <div class="card-body p-5">
                    
                    <!-- Status Message -->
                    <div class="text-center mb-5">
                        <div class="alert gme-alert border-0 shadow-sm" role="alert">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <i class="fas fa-hourglass-half me-2" style="color: #9C7D2D; font-size: 1.5rem;"></i>
                                <h5 class="mb-0 fw-bold" style="color: #9C7D2D;">Application Under Review</h5>
                            </div>
                            <p class="mb-0 text-muted">
                                Your application has been submitted successfully and is currently being reviewed by our team 
                                to ensure it meets our community standards.
                            </p>
                        </div>
                    </div>

                    <!-- What's Next Section -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 40px; height: 40px; background-color: #9C7D2D;">
                                <i class="fas fa-lightbulb text-white"></i>
                            </div>
                            <h5 class="mb-0 fw-bold" style="color: #9C7D2D;">What Happens Next?</h5>
                        </div>
                        
                        <ul class="list-unstyled mb-0">
                            <li class="mb-4 d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                                     style="width: 35px; height: 35px; background-color: #9C7D2D;">
                                    <i class="fas fa-search text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <strong style="color: #9C7D2D;">Review:</strong>
                                    <span class="text-muted"> 3-5 business days for our team to approve your listing</span>
                                </div>
                            </li>
                            
                            <li class="mb-4 d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                                     style="width: 35px; height: 35px; background-color: #9C7D2D;">
                                    <i class="fas fa-envelope text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <strong style="color: #9C7D2D;">Approval:</strong>
                                    <span class="text-muted"> We'll notify you via email the second you're live</span>
                                </div>
                            </li>
                            
                            <li class="mb-4 d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                                     style="width: 35px; height: 35px; background-color: #9C7D2D;">
                                    <i class="fas fa-phone text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <strong style="color: #9C7D2D;">Support:</strong>
                                    <span class="text-muted"> We'll contact you directly if any additional info is needed</span>
                                </div>
                            </li>
                            
                            <li class="d-flex align-items-start">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0" 
                                     style="width: 35px; height: 35px; background-color: #9C7D2D;">
                                    <i class="fas fa-globe text-white" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <strong style="color: #9C7D2D;">Live Stage:</strong>
                                    <span class="text-muted"> Once approved, your business becomes part of the Global Muslim Business Directory</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Benefits Section -->
                    <div class="row g-3 mb-5">
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-4 gme-card-1">
                                <div class="mb-3">
                                    <i class="fas fa-users fa-3x text-white"></i>
                                </div>
                                <h6 class="fw-bold text-white">Connect with Community</h6>
                                <p class="small text-white mb-0">Join a network of ethical Muslim businesses</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-4 gme-card-2">
                                <div class="mb-3">
                                    <i class="fas fa-handshake fa-3x text-white"></i>
                                </div>
                                <h6 class="fw-bold text-white">Collaboration Opportunities</h6>
                                <p class="small text-white mb-0">Find partners and grow together</p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm text-center p-4 gme-card-3">
                                <div class="mb-3">
                                    <i class="fas fa-chart-line fa-3x text-white"></i>
                                </div>
                                <h6 class="fw-bold text-white">Business Growth</h6>
                                <p class="small text-white mb-0">Access resources and support</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <a href="{{ route('customer.gme-business-form.index') }}" 
                               class="btn btn-gme btn-lg w-100 shadow-sm">
                                <i class="fas fa-home me-2"></i>
                                Return to Dashboard
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('gme.business.register') }}" 
                               class="btn btn-outline-gme btn-lg w-100">
                                <i class="fas fa-plus-circle me-2"></i>
                                Register Another Business
                            </a>
                        </div>
                    </div>

                    <!-- Contact Section -->
                    <div class="text-center pt-4 border-top">
                        <p class="text-muted mb-3">
                            <i class="fas fa-question-circle me-2"></i>
                            Have questions or need assistance?
                        </p>
                        <a href="mailto:help@gme.network" class="btn btn-outline-gme">
                            <i class="fas fa-envelope me-2"></i>
                            help@gme.network
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
    
    <!-- Confetti Canvas -->
    <canvas id="confetti-canvas" style="position: fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index: 9999;"></canvas>

</div>

<!-- Custom CSS with GME Brand Colors -->
<style>
:root {
    --gme-primary: #9C7D2D;
    --gme-secondary: #B89A4F;
    --gme-dark: #7A6324;
    --gme-light: #F5EFE0;
}

/* GME Gradient Background */
.gme-gradient {
    background: linear-gradient(135deg, var(--gme-primary) 0%, var(--gme-dark) 100%);
}

/* GME Alert Box */
.gme-alert {
    background: linear-gradient(135deg, var(--gme-light) 0%, #FDF8EC 100%);
    border-left: 4px solid var(--gme-primary) !important;
}

/* GME Benefit Cards */
.gme-card-1 {
    background: linear-gradient(135deg, var(--gme-primary) 0%, var(--gme-secondary) 100%);
}

.gme-card-2 {
    background: linear-gradient(135deg, var(--gme-secondary) 0%, var(--gme-primary) 100%);
}

.gme-card-3 {
    background: linear-gradient(135deg, var(--gme-dark) 0%, var(--gme-primary) 100%);
}

/* GME Buttons */
.btn-gme {
    background-color: var(--gme-primary);
    border-color: var(--gme-primary);
    color: white;
    font-weight: 600;
}

.btn-gme:hover {
    background-color: var(--gme-dark);
    border-color: var(--gme-dark);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(156, 125, 45, 0.3);
}

.btn-outline-gme {
    border: 2px solid var(--gme-primary);
    color: var(--gme-primary);
    font-weight: 600;
}

.btn-outline-gme:hover {
    background-color: var(--gme-primary);
    border-color: var(--gme-primary);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(156, 125, 45, 0.3);
}

/* Animations */
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animate-bounce {
    animation: bounce 2s infinite;
}

/* Pattern Overlay */
.pattern-overlay {
    background-image: 
        repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.05) 10px, rgba(255,255,255,.05) 20px);
    width: 100%;
    height: 100%;
}

/* Hover Effects */
.card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
}

/* Shadow Effects */
.shadow-lg {
    box-shadow: 0 10px 30px rgba(156, 125, 45, 0.15) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .display-6 {
        font-size: 1.8rem;
    }
    
    .h4 {
        font-size: 1.3rem;
    }
}
</style>

<!-- Confetti Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('confetti-canvas');
    const ctx = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const confettiCount = 120;
    const confetti = [];
    const colors = ['#9C7D2D', '#B89A4F', '#7A6324', '#F5EFE0', '#D4AF37'];

    for (let i = 0; i < confettiCount; i++) {
        confetti.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height - canvas.height,
            r: Math.random() * 6 + 4,
            d: Math.random() * confettiCount,
            color: colors[Math.floor(Math.random() * colors.length)],
            tilt: Math.random() * 10 - 10,
            tiltAngleIncremental: Math.random() * 0.07 + 0.05,
            tiltAngle: 0
        });
    }

    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let i = 0; i < confettiCount; i++) {
            const c = confetti[i];
            ctx.beginPath();
            ctx.lineWidth = c.r / 2;
            ctx.strokeStyle = c.color;
            ctx.moveTo(c.x + c.tilt + c.r / 4, c.y);
            ctx.lineTo(c.x + c.tilt, c.y + c.tilt + c.r / 4);
            ctx.stroke();
        }
        update();
    }

    function update() {
        for (let i = 0; i < confettiCount; i++) {
            const c = confetti[i];
            c.tiltAngle += c.tiltAngleIncremental;
            c.y += (Math.cos(c.d) + 3 + c.r / 2) / 2;
            c.x += Math.sin(c.d);
            c.tilt = Math.sin(c.tiltAngle - i / 3) * 15;

            if (c.y > canvas.height) {
                c.x = Math.random() * canvas.width;
                c.y = -20;
            }
        }
    }

    function animate() {
        draw();
        requestAnimationFrame(animate);
    }

    animate();

    // Remove confetti after 8 seconds
    setTimeout(() => {
        canvas.style.opacity = '0';
        canvas.style.transition = 'opacity 1s';
        setTimeout(() => canvas.remove(), 1000);
    }, 8000);
});
</script>

@endsection