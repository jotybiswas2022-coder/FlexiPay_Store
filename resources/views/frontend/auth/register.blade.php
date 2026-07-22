@extends('frontend.auth_layout')
@section('title', 'Create Account')

@section('content')
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'Space Grotesk',sans-serif;background:linear-gradient(135deg,#0A0A0B,#121214,#0A0A0B);min-height:100vh;overflow-x:hidden;overflow-y:auto}

.fp-page{position:relative;min-height:calc(100vh - 68px);padding:2rem 1rem 3rem;overflow:hidden}

/* Floating product icons */
.fp-product-float{
    position:fixed;background:var(--card-dark);border:1px solid var(--card-border);
    border-radius:12px;padding:8px 14px;font-size:12px;color:var(--gold-400);
    font-weight:500;white-space:nowrap;animation:floatAnim linear infinite;
    opacity:0.7;display:flex;align-items:center;gap:6px;
    pointer-events:none;box-shadow:0 4px 16px rgba(0,0,0,0.3);z-index:0;
}
.fp-product-float i{color:var(--gold-500);font-size:13px}
@keyframes floatAnim{
    0%{transform:translateY(0) translateX(0) rotate(-2deg)}
    25%{transform:translateY(-18px) translateX(8px) rotate(1deg)}
    50%{transform:translateY(-8px) translateX(-5px) rotate(-1deg)}
    75%{transform:translateY(-22px) translateX(4px) rotate(2deg)}
    100%{transform:translateY(0) translateX(0) rotate(-2deg)}
}
.f1{top:6%;left:2%;animation-duration:7s}
.f2{top:12%;right:2%;animation-duration:9s;animation-delay:-2s}
.f3{top:38%;left:1%;animation-duration:8s;animation-delay:-4s}
.f4{top:55%;right:2%;animation-duration:10s;animation-delay:-1s}
.f5{top:72%;left:3%;animation-duration:6.5s;animation-delay:-3s}
.f6{top:82%;right:3%;animation-duration:8.5s;animation-delay:-5s}

.fp-wrapper{max-width:500px;margin:0 auto;position:relative;z-index:10}

/* Card */
.fp-card{background:var(--card-dark);border-radius:20px;border:1px solid var(--card-border);overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.4)}

.fp-header{
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600),var(--gold-700));
    padding:2rem 2rem 1.5rem;text-align:center;position:relative;overflow:hidden;
}
.fp-header::before{content:'';position:absolute;top:-30px;right:-30px;width:120px;height:120px;border-radius:50%;background:rgba(0,0,0,0.07)}
.fp-header::after{content:'';position:absolute;bottom:-20px;left:-20px;width:80px;height:80px;border-radius:50%;background:rgba(0,0,0,0.1)}

.fp-edition{
    display:flex;align-items:center;justify-content:space-between;
    background:rgba(0,0,0,0.1);border-radius:8px;padding:6px 12px;
    margin-bottom:1rem;font-size:11px;color:rgba(0,0,0,0.7);position:relative;z-index:1;
}
.fp-edition i{color:rgba(0,0,0,0.5)}

.fp-logo-wrap{display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:0.75rem;position:relative;z-index:1}
.fp-logo-icon{width:48px;height:48px;background:rgba(0,0,0,0.1);border-radius:14px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(0,0,0,0.1)}
.fp-logo-icon i{font-size:24px;color:rgba(0,0,0,0.8)}
.fp-brand{font-family:'Syne',sans-serif;font-size:22px;font-weight:700;color:rgba(0,0,0,0.9);letter-spacing:-0.5px}
.fp-brand span{color:rgba(0,0,0,0.6)}

.fp-separator{display:flex;align-items:center;gap:8px;margin-bottom:1rem;position:relative;z-index:1}
.fp-sep-line{flex:1;height:1px;background:rgba(0,0,0,0.15)}
.fp-sep-icons{display:flex;gap:6px;color:rgba(0,0,0,0.4);font-size:10px}

.fp-plan-badges{display:flex;flex-wrap:wrap;gap:6px;justify-content:center;margin-bottom:1rem;position:relative;z-index:1}
.fp-pb{display:flex;align-items:center;gap:4px;background:rgba(0,0,0,0.08);border:1px solid rgba(0,0,0,0.12);border-radius:20px;padding:4px 10px;font-size:11px;color:rgba(0,0,0,0.7);font-weight:500}
.fp-pb i{color:rgba(0,0,0,0.5);font-size:11px}

.fp-tagline{font-size:14px;color:rgba(0,0,0,0.8);font-weight:500;position:relative;z-index:1}
.fp-tagline strong{color:rgba(0,0,0,0.9)}

/* Body */
.fp-body{padding:1.75rem}
.fp-section-title{display:flex;align-items:center;justify-content:center;gap:8px;font-size:13px;font-weight:600;color:var(--gold-500);letter-spacing:0.5px;text-transform:uppercase;margin-bottom:1.25rem}
.fp-section-title i{color:var(--gold-400);font-size:14px}

.fp-field{margin-bottom:1rem}
.fp-label{display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:var(--text-primary);margin-bottom:6px}
.fp-label i{color:var(--gold-500);font-size:13px}

.fp-input-wrap{position:relative}
.fp-input-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:var(--gold-500);font-size:14px;pointer-events:none}
.fp-input{
    width:100%;padding:11px 40px 11px 38px;
    border:1.5px solid var(--card-border);border-radius:10px;
    font-size:14px;color:var(--text-primary);
    background:var(--surface-dark);outline:none;
    font-family:'Space Grotesk',sans-serif;transition:all 0.2s;
}
.fp-input:focus{border-color:var(--gold-500);background:rgba(234,179,8,0.04);box-shadow:0 0 0 3px rgba(234,179,8,0.08)}
.fp-input::placeholder{color:var(--text-dim)}
.is-invalid{border-color:#ef4444 !important}

.fp-toggle{
    position:absolute;right:10px;top:50%;transform:translateY(-50%);
    background:none;border:none;cursor:pointer;color:var(--text-dim);
    padding:4px;font-size:14px;display:flex;align-items:center;
}
.fp-toggle:hover{color:var(--gold-500)}

.fp-divider{display:flex;align-items:center;gap:10px;margin:1.25rem 0}
.fp-div-line{flex:1;height:1px;background:var(--card-border)}
.fp-div-text{font-size:12px;color:var(--text-dim);display:flex;align-items:center;gap:5px;white-space:nowrap}
.fp-div-text i{color:var(--gold-500);font-size:11px}

.fp-btn{
    width:100%;padding:12px;
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600));
    color:var(--near-black);border:none;border-radius:12px;
    font-size:15px;font-weight:700;cursor:pointer;
    display:flex;align-items:center;justify-content:center;gap:8px;
    font-family:'Syne',sans-serif;transition:all 0.2s;
    box-shadow:0 4px 16px rgba(234,179,8,0.3);
}
.fp-btn:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(234,179,8,0.4)}
.fp-btn:active{transform:scale(0.98)}
.fp-btn i{font-size:16px}

.fp-link-wrap{text-align:center;margin-top:1rem}
.fp-link{color:var(--gold-400);text-decoration:none;font-size:13px;display:inline-flex;align-items:center;gap:5px;font-weight:500}
.fp-link:hover{color:var(--gold-300);text-decoration:underline}

.fp-error{display:block;font-size:12px;color:#ef4444;margin-top:4px;display:flex;align-items:center;gap:4px}

.fp-footer-bar{
    background:var(--surface-dark);border-top:1px solid var(--card-border);
    padding:12px 1.75rem;text-align:center;font-size:12px;color:var(--text-dim);
    display:flex;align-items:center;justify-content:center;gap:6px;
}
.fp-footer-bar i{color:var(--gold-500);font-size:11px}
.fp-footer-bar strong{color:var(--gold-400);font-weight:700}

.fp-pulse-dot{width:8px;height:8px;background:var(--gold-500);border-radius:50%;display:inline-block;animation:pulse 2s infinite}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.5;transform:scale(1.4)}}

@media(max-width:520px){
    .fp-body{padding:1.25rem}
    .fp-header{padding:1.5rem 1.25rem 1.25rem}
}
</style>

<div class="fp-page">
    <div class="fp-product-float f1"><i class="bi bi-phone"></i> iPhone 15 Pro</div>
    <div class="fp-product-float f2"><i class="bi bi-laptop"></i> MacBook Air M3</div>
    <div class="fp-product-float f3"><i class="bi bi-tv"></i> Samsung 65" TV</div>
    <div class="fp-product-float f4"><i class="bi bi-headphones"></i> AirPods Pro</div>
    <div class="fp-product-float f5"><i class="bi bi-watch"></i> Apple Watch</div>
    <div class="fp-product-float f6"><i class="bi bi-speaker"></i> JBL Speaker</div>

    <div class="fp-wrapper">
        <div class="fp-card">
            <div class="fp-header">
                <div class="fp-edition">
                    <span><i class="bi bi-geo-alt-fill"></i> Nigeria</span>
                    <span style="display:flex;align-items:center;gap:5px"><span class="fp-pulse-dot"></span> Secure</span>
                    <span>Est. 2025</span>
                </div>
                <div class="fp-logo-wrap">
                    <div class="fp-logo-icon"><i class="bi bi-currency-exchange"></i></div>
                    <div class="fp-brand">Flexi<span>Pay</span></div>
                </div>
                <div class="fp-separator">
                    <div class="fp-sep-line"></div>
                    <div class="fp-sep-icons">
                        <i class="bi bi-diamond-fill"></i>
                        <i class="bi bi-hexagon-fill"></i>
                        <i class="bi bi-diamond-fill"></i>
                    </div>
                    <div class="fp-sep-line"></div>
                </div>
                <div class="fp-plan-badges">
                    <span class="fp-pb"><i class="bi bi-coin"></i> Weekly Plans</span>
                    <span class="fp-pb"><i class="bi bi-calendar-check"></i> Monthly Plans</span>
                    <span class="fp-pb"><i class="bi bi-shield-check"></i> Insured</span>
                </div>
                <div class="fp-tagline"><strong>Create Your Account</strong> — Start Shopping on Installments</div>
            </div>

            <div class="fp-body">
                <div class="fp-section-title">
                    <i class="bi bi-person-plus-fill"></i>
                    Customer Registration
                    <i class="bi bi-person-plus-fill"></i>
                </div>

                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf

                    <div class="fp-field">
                        <label for="name" class="fp-label"><i class="bi bi-person"></i> Full Name</label>
                        <div class="fp-input-wrap">
                            <i class="bi bi-person-fill fp-input-icon"></i>
                            <input id="name" type="text" class="fp-input @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus>
                        </div>
                        @error('name')<span class="fp-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>@enderror
                    </div>

                    <div class="fp-field">
                        <label for="email" class="fp-label"><i class="bi bi-envelope"></i> Email Address</label>
                        <div class="fp-input-wrap">
                            <i class="bi bi-envelope-fill fp-input-icon"></i>
                            <input id="email" type="email" class="fp-input @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="you@flexipay.store" required>
                        </div>
                        @error('email')<span class="fp-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>@enderror
                    </div>

                    <div class="fp-field">
                        <label for="password" class="fp-label"><i class="bi bi-shield-lock"></i> Password</label>
                        <div class="fp-input-wrap">
                            <i class="bi bi-lock-fill fp-input-icon"></i>
                            <input id="password" type="password" class="fp-input @error('password') is-invalid @enderror"
                                   name="password" placeholder="••••••••" required>
                            <button type="button" class="fp-toggle" onclick="togglePW('password',this)"><i class="bi bi-eye-slash"></i></button>
                        </div>
                        @error('password')<span class="fp-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span>@enderror
                    </div>

                    <div class="fp-field">
                        <label for="password-confirm" class="fp-label"><i class="bi bi-shield-check"></i> Confirm Password</label>
                        <div class="fp-input-wrap">
                            <i class="bi bi-lock-fill fp-input-icon"></i>
                            <input id="password-confirm" type="password" class="fp-input" name="password_confirmation" placeholder="••••••••" required>
                            <button type="button" class="fp-toggle" onclick="togglePW('password-confirm',this)"><i class="bi bi-eye-slash"></i></button>
                        </div>
                    </div>

                    <div class="fp-divider">
                        <div class="fp-div-line"></div>
                        <div class="fp-div-text"><i class="bi bi-currency-exchange"></i> Flexible Payments</div>
                        <div class="fp-div-line"></div>
                    </div>

                    <button type="submit" class="fp-btn">
                        <i class="bi bi-person-plus-fill"></i> Create Account
                    </button>

                    <div class="fp-link-wrap">
                        <a href="{{ route('login') }}" class="fp-link">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Already have an account? Sign In
                        </a>
                    </div>
                </form>
            </div>

            <div class="fp-footer-bar">
                <i class="bi bi-geo-alt-fill"></i>
                <strong>FlexiPay Store</strong>
                <i class="bi bi-heart-fill" style="color:#ef4444;"></i>
                Buy Now, Pay in Installments &middot; Nigeria
            </div>
        </div>
    </div>
</div>

<script>
function togglePW(id, btn) {
    const input = document.getElementById(id);
    const isPw = input.type === 'password';
    input.type = isPw ? 'text' : 'password';
    btn.querySelector('i').className = isPw ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
@endsection