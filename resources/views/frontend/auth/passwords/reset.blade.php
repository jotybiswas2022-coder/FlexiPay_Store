@extends('frontend.auth_layout')
@section('title', 'Reset Password')

@section('content')
<style>
#rpParticles {
    position: fixed; inset: 0; z-index: 0;
    pointer-events: none; opacity: 0.3;
}

.fp-rp-bg {
    position: fixed; inset: 0; z-index: 0; overflow: hidden;
    background: linear-gradient(135deg, #0A0A0B 0%, #121214 50%, #0A0A0B 100%);
}
.fp-rp-blob {
    position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.25;
    animation: rpBlob 8s ease-in-out infinite alternate;
    will-change: transform;
}
.fp-rp-blob-1 { width: 500px; height: 500px; background: radial-gradient(circle, #EAB30833, transparent); top: -100px; right: -100px; }
.fp-rp-blob-2 { width: 350px; height: 350px; background: radial-gradient(circle, #CA8A0422, transparent); bottom: -80px; left: -80px; animation-delay: -4s; }
@keyframes rpBlob {
    0% { transform: translate(0,0) scale(1); }
    100% { transform: translate(25px,30px) scale(1.06); }
}

.fp-rp-wrap {
    position: relative; z-index: 1;
    min-height: calc(100vh - 68px);
    display: flex; align-items: center; justify-content: center;
    padding: 40px 16px;
}

.fp-rp-card {
    width: 100%; max-width: 460px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: 24px;
    box-shadow: 0 16px 60px rgba(0,0,0,0.4);
    overflow: hidden; contain: layout style; min-width: 0;
    animation: rpFadeUp 0.8s cubic-bezier(.22,.68,0,1.2) 0.1s both;
}
@keyframes rpFadeUp { from { opacity: 0; transform: translateY(40px) scale(0.97); } to { opacity: 1; transform: translateY(0) scale(1); } }

.fp-rp-strip {
    background: linear-gradient(105deg, var(--gold-500) 0%, var(--gold-600) 60%, var(--gold-700) 100%);
    padding: 22px 28px 20px;
    position: relative; overflow: hidden;
}
.fp-rp-strip::before {
    content: ''; position: absolute;
    top: -40px; right: -40px; width: 140px; height: 140px;
    border-radius: 50%; background: rgba(0,0,0,0.08);
}
.fp-rp-strip::after {
    content: ''; position: absolute;
    bottom: -50px; left: 30%; width: 180px; height: 180px;
    border-radius: 50%; background: rgba(0,0,0,0.04);
}
.fp-rp-strip-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; }
.fp-rp-strip-left h2 { font-family: 'Syne', sans-serif; font-size: 20px; font-weight: 700; color: var(--near-black); margin-bottom: 3px; }
.fp-rp-strip-left p { font-size: 13px; color: rgba(0,0,0,0.6); }
.fp-rp-strip-badge {
    display: flex; align-items: center; gap: 7px;
    background: rgba(0,0,0,0.12);
    border: 1px solid rgba(0,0,0,0.2);
    border-radius: 30px; padding: 6px 14px;
    font-size: 12px; color: rgba(0,0,0,0.8); font-weight: 500;
    -webkit-backdrop-filter: blur(4px);
    backdrop-filter: blur(4px);
}

.fp-rp-body { padding: 28px 32px 24px; }

.fp-rp-icon {
    width: 56px; height: 56px; border-radius: 50%; margin: 0 auto 16px;
    background: rgba(234,179,8,0.1); display: flex;
    align-items: center; justify-content: center;
}
.fp-rp-icon i { font-size: 24px; color: var(--gold-500); }

.fp-rp-field { margin-bottom: 18px; }
.fp-rp-field label { display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 8px; }
.fp-rp-field label i { color: var(--gold-500); font-size: 14px; }
.fp-rp-input-wrap { position: relative; }
.fp-rp-input {
    width: 100%; height: 48px;
    padding: 0 46px 0 16px;
    border: 1.5px solid var(--card-border);
    border-radius: 10px;
    background: var(--surface-dark);
    font-family: 'Space Grotesk', sans-serif;
    font-size: 14px; color: var(--text-primary);
    outline: none; transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
}
.fp-rp-input::placeholder { color: var(--text-dim); }
.fp-rp-input:focus { border-color: var(--gold-500); background: rgba(234,179,8,0.04); box-shadow: 0 0 0 4px rgba(234,179,8,0.08); }
.fp-rp-input.is-invalid { border-color: #ef4444; box-shadow: 0 0 0 4px rgba(239,68,68,0.08); }
.fp-rp-input-icon { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-dim); font-size: 16px; pointer-events: none; }
.fp-rp-toggle-btn {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer;
    color: var(--text-dim); font-size: 16px;
    display: flex; align-items: center; padding: 8px; border-radius: 6px;
    touch-action: manipulation;
}
.fp-rp-toggle-btn:hover { color: var(--gold-500); }
.fp-rp-field .invalid-feedback { display: flex; align-items: center; gap: 5px; font-size: 12px; color: #ef4444; margin-top: 6px; font-weight: 500; }

.fp-rp-btn {
    width: 100%; height: 50px; border: none;
    border-radius: 10px;
    background: linear-gradient(105deg, var(--gold-500), var(--gold-600));
    color: var(--near-black);
    font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700;
    cursor: pointer; display: flex; align-items: center;
    justify-content: center; gap: 10px;
    box-shadow: 0 6px 24px rgba(234,179,8,0.3);
    transition: transform 0.2s, box-shadow 0.2s; position: relative; overflow: hidden;
    letter-spacing: 0.3px; margin-top: 8px;
}
.fp-rp-btn::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(105deg, transparent 20%, rgba(255,255,255,0.15) 50%, transparent 80%);
    transform: translateX(-100%); transition: transform 0.6s;
}
.fp-rp-btn:hover::before { transform: translateX(100%); }
.fp-rp-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 32px rgba(234,179,8,0.4); }
.fp-rp-btn:active { transform: translateY(0); }
.fp-rp-btn.loading .btn-main-icon { display: none; }
.fp-rp-btn.loading .btn-spinner { display: inline-block; }
.btn-spinner { display: none; animation: rpSpin 0.7s linear infinite; }
@keyframes rpSpin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

.fp-rp-back {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    margin-top: 20px; font-size: 13px; font-weight: 500; color: var(--gold-400); transition: color 0.2s;
}
.fp-rp-back:hover { color: var(--gold-300); }

@media (max-width: 520px) {
    .fp-rp-body { padding: 22px 20px 20px; }
    .fp-rp-strip { padding: 18px 20px 16px; }
}

@media (prefers-reduced-motion: reduce) {
    .fp-rp-blob, .fp-rp-card, .fp-rp-btn::before {
        animation: none !important;
    }
    #rpParticles { display: none; }
}
</style>

<canvas id="rpParticles" aria-hidden="true"></canvas>

<div class="fp-rp-bg">
    <div class="fp-rp-blob fp-rp-blob-1"></div>
    <div class="fp-rp-blob fp-rp-blob-2"></div>
</div>

<div class="fp-rp-wrap">
    <div class="fp-rp-card" id="rpCard">
        <div class="fp-rp-strip">
            <div class="fp-rp-strip-inner">
                <div class="fp-rp-strip-left">
                    <h2>New Password</h2>
                    <p>Choose a strong password for your account</p>
                </div>
                <div class="fp-rp-strip-badge">
                    <i class="bi bi-lock-fill" style="font-size:12px;"></i> Reset
                </div>
            </div>
        </div>

        <div class="fp-rp-body">
            <div class="fp-rp-icon"><i class="bi bi-shield-lock-fill"></i></div>

            <form method="POST" action="{{ route('password.update') }}" id="rpForm" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="fp-rp-field">
                    <label for="email"><i class="bi bi-envelope-fill"></i> Email Address</label>
                    <div class="fp-rp-input-wrap">
                        <input id="email" type="email"
                               class="fp-rp-input @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ $email ?? old('email') }}"
                               required autofocus autocomplete="email"
                               inputmode="email" placeholder="you@example.com"
                               aria-describedby="email-error">
                        <i class="bi bi-envelope fp-rp-input-icon" aria-hidden="true"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" id="email-error" role="alert"><i class="bi bi-exclamation-circle-fill"></i> <strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="fp-rp-field">
                    <label for="password"><i class="bi bi-key-fill"></i> New Password</label>
                    <div class="fp-rp-input-wrap">
                        <input id="password" type="password"
                               class="fp-rp-input @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" spellcheck="false"
                               aria-describedby="password-error">
                        <button type="button" class="fp-rp-toggle-btn" id="togglePassword1" aria-label="Toggle new password visibility">
                            <i class="bi bi-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback" id="password-error" role="alert"><i class="bi bi-exclamation-circle-fill"></i> <strong>{{ $message }}</strong></div>
                    @enderror
                </div>

                <div class="fp-rp-field">
                    <label for="password-confirm"><i class="bi bi-check2-circle"></i> Confirm Password</label>
                    <div class="fp-rp-input-wrap">
                        <input id="password-confirm" type="password"
                               class="fp-rp-input"
                               name="password_confirmation" required
                               autocomplete="new-password"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" spellcheck="false">
                        <button type="button" class="fp-rp-toggle-btn" id="togglePassword2" aria-label="Toggle confirm password visibility">
                            <i class="bi bi-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="fp-rp-btn" id="rpBtn">
                    <i class="bi bi-check2-circle btn-main-icon"></i>
                    <i class="bi bi-arrow-repeat btn-spinner"></i>
                    Reset Password
                </button>
            </form>

            <a href="{{ route('login') }}" class="fp-rp-back">
                <i class="bi bi-arrow-left"></i> Back to Login
            </a>
        </div>
    </div>
</div>

<script>
(function() {
    // Password visibility toggles
    function setupToggle(btnId, inputId, iconId) {
        var btn = document.getElementById(btnId);
        if (!btn) return;
        btn.addEventListener('click', function() {
            var input = document.getElementById(inputId);
            var icon = document.getElementById(iconId);
            var isText = input.type === 'text';
            input.type = isText ? 'password' : 'text';
            icon.className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
        });
    }
    setupToggle('togglePassword1', 'password', 'toggleIcon1');
    setupToggle('togglePassword2', 'password-confirm', 'toggleIcon2');

    // Form loading state
    document.getElementById('rpForm')?.addEventListener('submit', function() {
        var btn = document.getElementById('rpBtn');
        if (btn) {
            btn.classList.add('loading');
            btn.disabled = true;
        }
    });

    // Particle canvas (lightweight)
    var canvas = document.getElementById('rpParticles');
    if (canvas) {
        var ctx = canvas.getContext('2d');
        var W, H, animId;
        var particles = [];
        var COUNT = 20;

        function resize() {
            W = canvas.width = window.innerWidth;
            H = canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        for (var i = 0; i < COUNT; i++) {
            particles.push({
                x: Math.random() * W,
                y: Math.random() * H,
                vx: (Math.random() - 0.5) * 0.25,
                vy: (Math.random() - 0.5) * 0.25,
                r: Math.random() * 1.5 + 0.5,
                o: Math.random() * 0.25 + 0.1
            });
        }

        function draw() {
            ctx.clearRect(0, 0, W, H);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > W) p.vx *= -1;
                if (p.y < 0 || p.y > H) p.vy *= -1;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(234,179,8,' + p.o + ')';
                ctx.fill();
            }
            animId = requestAnimationFrame(draw);
        }

        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (animId) cancelAnimationFrame(animId);
            } else {
                draw();
            }
        });

        draw();
    }
})();
</script>
@endsection
