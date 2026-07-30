@extends('frontend.auth_layout')
@section('title', 'Reset Password')

@section('content')
<style>
#rpParticles {
    position: fixed; inset: 0; z-index: 0;
    pointer-events: none; opacity: 0.4;
}
</style>

<canvas id="rpParticles" aria-hidden="true"></canvas>

<div class="fp-bg">
    <div class="fp-grid"></div>
    <div class="fp-blob fp-blob-1"></div>
    <div class="fp-blob fp-blob-2"></div>
    <div class="fp-blob fp-blob-3"></div>
    <div class="fp-ring"></div>
    <div class="fp-ring"></div>
    <div class="fp-ring"></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-phone"></i></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-laptop"></i></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-tv"></i></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-headphones"></i></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-watch"></i></div>
    <div class="fp-float-icon" aria-hidden="true"><i class="bi bi-camera"></i></div>
</div>

<div class="fp-wrapper">
    <div class="fp-brand-top">
        <a href="{{ url('/') }}" class="fp-logo-wrap">
            <div class="fp-logo-icon"><i class="bi bi-currency-exchange"></i></div>
            <div class="fp-logo-text"><span>Flexi</span>Pay</div>
        </a>
        <div class="fp-tagline"><i class="bi bi-lightning-charge-fill"></i> Buy Now, Pay in Installments <i class="bi bi-lightning-charge-fill"></i></div>
    </div>

    <div class="fp-card" id="rpCard">
        <div class="fp-card-strip">
            <div class="fp-strip-shine"></div>
            <div class="fp-strip-inner">
                <div class="fp-strip-left">
                    <h2>Reset Password</h2>
                    <p>Choose a strong password for your account</p>
                </div>
                <div class="fp-strip-badge">
                    <div class="fp-live-dot"></div>
                    Secure Reset
                </div>
            </div>
        </div>

        <div class="fp-card-body">
            <div class="fp-section-label">New Password</div>

            <form method="POST" action="{{ route('password.update') }}" id="rpForm" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="fp-field">
                    <label for="email" class="fp-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
                    <div class="fp-input-wrap">
                        <input id="email" type="email" name="email"
                               class="fp-input @error('email') is-invalid @enderror"
                               value="{{ $email ?? old('email') }}"
                               placeholder="you@example.com" required autofocus autocomplete="email"
                               inputmode="email" aria-describedby="email-error">
                        <i class="bi bi-envelope fp-input-icon" aria-hidden="true"></i>
                        <div class="fp-input-focus-glow"></div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" id="email-error" role="alert"><i class="bi bi-exclamation-circle-fill"></i> <strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password" class="fp-label"><i class="bi bi-key-fill"></i> New Password</label>
                    <div class="fp-input-wrap">
                        <input id="password" type="password" name="password"
                               class="fp-input @error('password') is-invalid @enderror"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required autocomplete="new-password" spellcheck="false"
                               aria-describedby="password-error">
                        <button type="button" class="fp-toggle-btn" id="togglePassword1" aria-label="Toggle new password visibility">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                        <div class="fp-input-focus-glow"></div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback" id="password-error" role="alert"><i class="bi bi-exclamation-circle-fill"></i> <strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password-confirm" class="fp-label"><i class="bi bi-check2-circle"></i> Confirm Password</label>
                    <div class="fp-input-wrap">
                        <input id="password-confirm" type="password"
                               class="fp-input"
                               name="password_confirmation" required
                               autocomplete="new-password"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="togglePassword2" aria-label="Toggle confirm password visibility">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                        <div class="fp-input-focus-glow"></div>
                    </div>
                </div>

                <button type="submit" class="fp-submit-btn" id="rpBtn">
                    <i class="bi bi-check2-circle btn-main-icon"></i>
                    <i class="bi bi-arrow-repeat btn-spinner"></i>
                    Reset Password
                </button>
            </form>

            <div style="text-align:center;margin-top:18px;">
                <a href="{{ route('login') }}" class="fp-forgot" style="display:inline-flex;">
                    <i class="bi bi-arrow-left"></i> Back to Login
                </a>
            </div>
        </div>

        <div class="fp-card-footer">
            <div class="fp-footer-branding"><i class="bi bi-currency-exchange"></i> FlexiPay &copy; 2025</div>
            <div class="fp-footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Support</a>
            </div>
        </div>
    </div>

    <div class="fp-stats-row">
        <div class="fp-stat"><div class="fp-stat-num" data-count="5000">0<span>+</span></div><div class="fp-stat-label">Products</div></div>
        <div class="fp-stat"><div class="fp-stat-num" data-count="15000">0<span>+</span></div><div class="fp-stat-label">Happy Customers</div></div>
        <div class="fp-stat"><div class="fp-stat-num" data-count="36">0<span>+</span></div><div class="fp-stat-label">Payment Plans</div></div>
    </div>

    <div class="fp-location-tag">
        <i class="bi bi-geo-alt-fill"></i> Serving all across Nigeria — Lagos, Abuja, Port Harcourt &amp; more
    </div>
</div>

<script>
(function() {
    function setupToggle(btnId, inputId, iconId) {
        document.getElementById(btnId)?.addEventListener('click', function() {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            icon.className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    }
    setupToggle('togglePassword1', 'password', 'toggleIcon1');
    setupToggle('togglePassword2', 'password-confirm', 'toggleIcon2');

    document.getElementById('rpForm')?.addEventListener('submit', function() {
        const btn = document.getElementById('rpBtn');
        if (btn) {
            btn.classList.add('loading');
            btn.disabled = true;
        }
    });

    const canvas = document.getElementById('rpParticles');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let W, H, animId;
        const particles = [];
        const COUNT = 25;

        function resize() {
            W = canvas.width = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        for (let i = 0; i < COUNT; i++) {
            particles.push({
                x: Math.random() * W, y: Math.random() * H,
                size: Math.random() * 1.5 + 0.5,
                speedX: (Math.random() - 0.5) * 0.3,
                speedY: (Math.random() - 0.5) * 0.3,
                opacity: Math.random() * 0.3 + 0.1
            });
        }

        function animate() {
            ctx.clearRect(0, 0, W, H);
            for (let i = 0; i < particles.length; i++) {
                const p = particles[i];
                p.x += p.speedX;
                p.y += p.speedY;
                if (p.x < 0 || p.x > W) p.speedX *= -1;
                if (p.y < 0 || p.y > H) p.speedY *= -1;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(234,179,8,' + p.opacity + ')';
                ctx.fill();
            }
            animId = requestAnimationFrame(animate);
        }

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (animId) cancelAnimationFrame(animId);
            } else {
                animate();
            }
        });

        animate();
    }
})();
</script>
@endsection
