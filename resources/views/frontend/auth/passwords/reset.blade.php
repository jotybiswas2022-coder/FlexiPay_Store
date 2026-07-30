@extends('frontend.auth_layout')
@section('title', 'Reset Password')

@section('content')
<style>
#rpParticles {
    position: fixed; inset: 0; z-index: 0;
    pointer-events: none; opacity: 0.35;
}

.fp-bg {
    position: fixed; inset: 0; z-index: 0; overflow: hidden;
    background: linear-gradient(135deg, #0A0A0B 0%, #121214 50%, #0A0A0B 100%);
}
.fp-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(234,179,8,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(234,179,8,0.03) 1px, transparent 1px);
    background-size: 48px 48px;
    animation: gridDrift 20s linear infinite;
    will-change: transform;
}
@keyframes gridDrift {
    0% { transform: translate(0,0); }
    100% { transform: translate(48px, 48px); }
}
.fp-blob {
    position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.25;
    animation: blobFloat 8s ease-in-out infinite alternate;
    will-change: transform;
}
.fp-blob-1 { width: 500px; height: 500px; background: radial-gradient(circle, #EAB30833, transparent); top: -150px; right: -100px; }
.fp-blob-2 { width: 400px; height: 400px; background: radial-gradient(circle, #CA8A0422, transparent); bottom: -120px; left: -100px; animation-delay: -4s; }
@keyframes blobFloat {
    0% { transform: translate(0,0) scale(1); }
    100% { transform: translate(25px,30px) scale(1.06); }
}

.fp-wrap {
    position: relative; z-index: 1;
    min-height: calc(100vh - 68px);
    display: flex; flex-direction: column; align-items: center;
    justify-content: center; padding: 40px 16px;
}

.fp-logo {
    display: flex; align-items: center; gap: 10px; margin-bottom: 32px;
    animation: fpFadeDown 0.6s ease both;
}
@keyframes fpFadeDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
.fp-logo-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: var(--near-black);
}
.fp-logo-text { font-family: 'Syne', sans-serif; font-size: 24px; font-weight: 800; color: var(--text-primary); }
.fp-logo-text span { color: var(--gold-500); }

.fp-card {
    width: 100%; max-width: 420px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    overflow: hidden;
    animation: fpFadeUp 0.7s cubic-bezier(.22,.68,0,1.2) 0.1s both;
}
@keyframes fpFadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

.fp-header {
    padding: 28px 28px 0;
    text-align: center;
}
.fp-header-icon {
    width: 52px; height: 52px; border-radius: 50%; margin: 0 auto 14px;
    background: rgba(234,179,8,0.12); display: flex;
    align-items: center; justify-content: center;
}
.fp-header-icon i { font-size: 22px; color: var(--gold-500); }
.fp-header h2 { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 700; color: var(--text-primary); }
.fp-header p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }

.fp-body { padding: 24px 28px 28px; }

.fp-field { margin-bottom: 18px; }
.fp-field label { display: block; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 7px; }
.fp-input-wrap { position: relative; }
.fp-input {
    width: 100%; height: 46px;
    padding: 0 44px 0 14px;
    border: 1.5px solid var(--card-border);
    border-radius: 10px;
    background: var(--surface-dark);
    font-size: 14px; color: var(--text-primary);
    outline: none; transition: border-color 0.25s, box-shadow 0.25s;
}
.fp-input::placeholder { color: var(--text-dim); }
.fp-input:focus { border-color: var(--gold-500); box-shadow: 0 0 0 3px rgba(234,179,8,0.1); }
.fp-input.is-invalid { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }
.fp-input-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-dim); font-size: 15px; pointer-events: none; }
.fp-toggle-btn {
    position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    color: var(--text-dim); font-size: 16px;
    padding: 8px; border-radius: 6px;
}
.fp-toggle-btn:hover { color: var(--gold-500); }
.invalid-feedback { font-size: 12px; color: #ef4444; margin-top: 5px; font-weight: 500; }

.fp-btn {
    width: 100%; height: 48px; border: none;
    border-radius: 10px; margin-top: 6px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black);
    font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700;
    cursor: pointer; display: flex; align-items: center;
    justify-content: center; gap: 8px;
    box-shadow: 0 6px 24px rgba(234,179,8,0.3);
    transition: transform 0.2s, box-shadow 0.2s;
    letter-spacing: 0.3px;
}
.fp-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(234,179,8,0.4); }
.fp-btn:active { transform: translateY(0); }
.fp-btn.loading .btn-main-icon { display: none; }
.fp-btn.loading .btn-spinner { display: inline-block; }
.btn-spinner { display: none; animation: fpSpin 0.7s linear infinite; }
@keyframes fpSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

.fp-back {
    display: flex; align-items: center; justify-content: center; gap: 5px;
    margin-top: 20px; font-size: 13px; color: var(--text-muted); transition: color 0.2s;
}
.fp-back:hover { color: var(--gold-400); }

@media (max-width: 480px) {
    .fp-body { padding: 20px 20px 24px; }
    .fp-header { padding: 24px 20px 0; }
}

@media (prefers-reduced-motion: reduce) {
    .fp-grid, .fp-blob, .fp-logo, .fp-card { animation: none !important; }
    #rpParticles { display: none; }
}
</style>

<canvas id="rpParticles" aria-hidden="true"></canvas>

<div class="fp-bg">
    <div class="fp-grid"></div>
    <div class="fp-blob fp-blob-1"></div>
    <div class="fp-blob fp-blob-2"></div>
</div>

<div class="fp-wrap">
    <a href="{{ url('/') }}" class="fp-logo">
        <div class="fp-logo-icon"><i class="bi bi-currency-exchange"></i></div>
        <div class="fp-logo-text"><span>Flexi</span>Pay</div>
    </a>

    <div class="fp-card">
        <div class="fp-header">
            <div class="fp-header-icon"><i class="bi bi-shield-lock-fill"></i></div>
            <h2>Reset Password</h2>
            <p>Choose a strong password for your account</p>
        </div>

        <div class="fp-body">
            <form method="POST" action="{{ route('password.update') }}" id="rpForm" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="fp-field">
                    <label for="email">Email Address</label>
                    <div class="fp-input-wrap">
                        <input id="email" type="email" name="email"
                               class="fp-input @error('email') is-invalid @enderror"
                               value="{{ $email ?? old('email') }}"
                               placeholder="you@example.com" required autofocus autocomplete="email"
                               inputmode="email">
                        <i class="bi bi-envelope fp-input-icon" aria-hidden="true"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password">New Password</label>
                    <div class="fp-input-wrap">
                        <input id="password" type="password" name="password"
                               class="fp-input @error('password') is-invalid @enderror"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required autocomplete="new-password" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="togglePassword1" aria-label="Toggle visibility">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password-confirm">Confirm Password</label>
                    <div class="fp-input-wrap">
                        <input id="password-confirm" type="password"
                               class="fp-input"
                               name="password_confirmation" required
                               autocomplete="new-password"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="togglePassword2" aria-label="Toggle visibility">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="fp-btn" id="rpBtn">
                    <i class="bi bi-check2-circle btn-main-icon"></i>
                    <i class="bi bi-arrow-repeat btn-spinner"></i>
                    Reset Password
                </button>
            </form>

            <a href="{{ route('login') }}" class="fp-back">
                <i class="bi bi-arrow-left"></i> Back to Login
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    function setupToggle(btnId, inputId, iconId) {
        document.getElementById(btnId)?.addEventListener('click', function() {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            var isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            icon.className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    }
    setupToggle('togglePassword1', 'password', 'toggleIcon1');
    setupToggle('togglePassword2', 'password-confirm', 'toggleIcon2');

    document.getElementById('rpForm')?.addEventListener('submit', function() {
        var btn = document.getElementById('rpBtn');
        if (btn) { btn.classList.add('loading'); btn.disabled = true; }
    });

    var canvas = document.getElementById('rpParticles');
    if (canvas) {
        var ctx = canvas.getContext('2d');
        var W, H, animId;
        var particles = [];

        function resize() { W = canvas.width = window.innerWidth; H = canvas.height = window.innerHeight; }
        resize();
        window.addEventListener('resize', resize);

        for (var i = 0; i < 20; i++) {
            particles.push({
                x: Math.random() * W, y: Math.random() * H,
                size: Math.random() * 1.5 + 0.5,
                speedX: (Math.random() - 0.5) * 0.25,
                speedY: (Math.random() - 0.5) * 0.25,
                opacity: Math.random() * 0.25 + 0.1
            });
        }

        function animate() {
            ctx.clearRect(0, 0, W, H);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.speedX; p.y += p.speedY;
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
            if (document.hidden) { if (animId) cancelAnimationFrame(animId); }
            else { animate(); }
        });
        animate();
    }
})();
</script>
@endsection
