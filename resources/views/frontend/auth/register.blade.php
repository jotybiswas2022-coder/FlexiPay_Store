@extends('frontend.auth_layout')
@section('title', 'Create Account')

@section('content')
<style>
#reParticles { position:fixed; inset:0; z-index:0; pointer-events:none; opacity:0.35; }

.fp-bg { position:fixed; inset:0; z-index:0; overflow:hidden; background:linear-gradient(135deg,#0A0A0B 0%,#121214 50%,#0A0A0B 100%); }
.fp-grid { position:absolute; inset:0; background-image:linear-gradient(rgba(234,179,8,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(234,179,8,0.03) 1px,transparent 1px); background-size:48px 48px; animation:reDrift 20s linear infinite; will-change:transform; }
@keyframes reDrift { 0%{transform:translate(0,0)} 100%{transform:translate(48px,48px)} }
.fp-blob { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.25; animation:reBlob 8s ease-in-out infinite alternate; will-change:transform; }
.fp-blob-1 { width:500px; height:500px; background:radial-gradient(circle,#EAB30833,transparent); top:-150px; right:-100px; }
.fp-blob-2 { width:400px; height:400px; background:radial-gradient(circle,#CA8A0422,transparent); bottom:-120px; left:-100px; animation-delay:-4s; }
@keyframes reBlob { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(25px,30px) scale(1.06)} }

.fp-wrap { position:relative; z-index:1; min-height:calc(100vh - 68px); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 16px; }
.fp-logo { display:flex; align-items:center; gap:10px; margin-bottom:32px; animation:reDown 0.6s ease both; }
@keyframes reDown { from{opacity:0;transform:translateY(-20px)} to{opacity:1;transform:translateY(0)} }
.fp-logo-icon { width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); display:flex; align-items:center; justify-content:center; font-size:20px; color:var(--near-black); }
.fp-logo-text { font-family:'Syne',sans-serif; font-size:24px; font-weight:800; color:var(--text-primary); }
.fp-logo-text span { color:var(--gold-500); }

.fp-card { width:100%; max-width:420px; background:var(--card-dark); border:1px solid var(--card-border); border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.5); overflow:hidden; animation:reUp 0.7s cubic-bezier(.22,.68,0,1.2) 0.1s both; }
@keyframes reUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

.fp-header { padding:28px 28px 0; text-align:center; }
.fp-header-icon { width:52px; height:52px; border-radius:50%; margin:0 auto 14px; background:rgba(234,179,8,0.12); display:flex; align-items:center; justify-content:center; }
.fp-header-icon i { font-size:22px; color:var(--gold-500); }
.fp-header h2 { font-family:'Syne',sans-serif; font-size:20px; font-weight:700; color:var(--text-primary); }
.fp-header p { font-size:13px; color:var(--text-muted); margin-top:4px; }

.fp-body { padding:24px 28px 28px; }

.fp-field { margin-bottom:16px; }
.fp-field label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.fp-input-wrap { position:relative; }
.fp-input { width:100%; height:46px; padding:0 44px 0 14px; border:1.5px solid var(--card-border); border-radius:10px; background:var(--surface-dark); font-size:14px; color:var(--text-primary); outline:none; transition:border-color 0.25s,box-shadow 0.25s; }
.fp-input::placeholder { color:var(--text-dim); }
.fp-input:focus { border-color:var(--gold-500); box-shadow:0 0 0 3px rgba(234,179,8,0.1); }
.fp-input.is-invalid { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
.fp-input-icon { position:absolute; right:14px; top:50%; transform:translateY(-50%); color:var(--text-dim); font-size:15px; pointer-events:none; }
.fp-toggle-btn { position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--text-dim); font-size:16px; padding:8px; border-radius:6px; }
.fp-toggle-btn:hover { color:var(--gold-500); }
.invalid-feedback { font-size:12px; color:#ef4444; margin-top:5px; font-weight:500; }
.fp-hint { font-size:11px; color:var(--text-dim); margin-top:4px; display:flex; align-items:center; gap:4px; }

.fp-checks { margin-bottom:16px; }
.fp-check { display:flex; align-items:flex-start; gap:8px; }
.fp-check input[type=checkbox] { width:16px; height:16px; accent-color:var(--gold-500); cursor:pointer; flex-shrink:0; margin-top:2px; }
.fp-check label { font-size:13px; color:var(--text-muted); cursor:pointer; }
.fp-check label a { color:var(--gold-500); text-decoration:underline; }

.fp-btn { width:100%; height:48px; border:none; border-radius:10px; margin-top:6px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); color:var(--near-black); font-family:'Syne',sans-serif; font-size:15px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 6px 24px rgba(234,179,8,0.3); transition:transform 0.2s,box-shadow 0.2s; letter-spacing:0.3px; }
.fp-btn:hover { transform:translateY(-2px); box-shadow:0 10px 32px rgba(234,179,8,0.4); }
.fp-btn:active { transform:translateY(0); }
.fp-btn.loading .btn-main-icon { display:none; }
.fp-btn.loading .btn-spinner { display:inline-block; }
.btn-spinner { display:none; animation:reSpin 0.7s linear infinite; }
@keyframes reSpin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

.fp-divider { display:flex; align-items:center; gap:10px; font-size:12px; color:var(--text-dim); margin:20px 0; font-weight:500; }
.fp-divider::before,.fp-divider::after { content:''; flex:1; height:1px; background:var(--card-border); }

.fp-social { display:flex; gap:10px; }
.fp-social-btn { flex:1; display:flex; align-items:center; justify-content:center; gap:8px; padding:10px; border-radius:10px; background:var(--surface-dark); border:1px solid var(--card-border); color:var(--text-muted); font-size:13px; font-weight:600; cursor:pointer; transition:border-color 0.2s; font-family:inherit; text-decoration:none; }
.fp-social-btn i { font-size:18px; }
.fp-social-btn:hover { border-color:rgba(234,179,8,0.2); background:rgba(234,179,8,0.04); }

.fp-login-box { background:rgba(234,179,8,0.04); border:1px solid rgba(234,179,8,0.15); border-radius:12px; padding:16px 20px; text-align:center; margin-top:20px; }
.fp-login-box p { font-size:13px; color:var(--text-muted); margin-bottom:10px; display:flex; align-items:center; justify-content:center; gap:6px; }
.fp-login-box p i { color:var(--gold-500); }
.fp-login-btn { display:inline-flex; align-items:center; gap:8px; padding:10px 22px; border-radius:10px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); color:var(--near-black); font-family:'Syne',sans-serif; font-size:14px; font-weight:700; box-shadow:var(--shadow-gold); transition:transform 0.18s,box-shadow 0.18s; }
.fp-login-btn:hover { transform:translateY(-2px); box-shadow:var(--shadow-gold-lg); color:var(--near-black); }

.fp-trust { display:flex; align-items:center; justify-content:center; gap:8px; flex-wrap:wrap; margin-top:20px; }
.fp-trust-item { display:flex; align-items:center; gap:5px; font-size:11.5px; font-weight:500; color:var(--text-dim); background:var(--surface-dark); border:1px solid var(--card-border); border-radius:20px; padding:5px 12px; }
.fp-trust-item i { color:var(--gold-500); font-size:12px; }

@media (max-width:520px) {
    .fp-body { padding:20px 20px 24px; }
    .fp-header { padding:24px 20px 0; }
    .fp-social { flex-direction:column; }
}
@media (prefers-reduced-motion:reduce) { .fp-grid,.fp-blob,.fp-logo,.fp-card { animation:none!important; } #reParticles { display:none; } }
</style>

<canvas id="reParticles" aria-hidden="true"></canvas>

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
            <div class="fp-header-icon"><i class="bi bi-person-plus-fill"></i></div>
            <h2>Create Account</h2>
            <p>Join thousands shopping on installments</p>
        </div>

        <div class="fp-body">
            <form method="POST" action="{{ route('register') }}" id="reForm" novalidate>
                @csrf

                <div class="fp-field">
                    <label for="name">Full Name</label>
                    <div class="fp-input-wrap">
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="fp-input @error('name') is-invalid @enderror"
                               placeholder="Enter your full name" required autocomplete="name">
                        <i class="bi bi-person fp-input-icon" aria-hidden="true"></i>
                    </div>
                    @error('name')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="email">Email Address</label>
                    <div class="fp-input-wrap">
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="fp-input @error('email') is-invalid @enderror"
                               placeholder="you@example.com" required autocomplete="email" inputmode="email">
                        <i class="bi bi-envelope fp-input-icon" aria-hidden="true"></i>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password">Password</label>
                    <div class="fp-input-wrap">
                        <input id="password" type="password" name="password"
                               class="fp-input @error('password') is-invalid @enderror"
                               placeholder="Create a strong password" required autocomplete="new-password" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="reToggle" aria-label="Toggle visibility">
                            <i class="bi bi-eye" id="reIcon"></i>
                        </button>
                    </div>
                    <div class="fp-hint"><i class="bi bi-info-circle-fill"></i> At least 8 characters</div>
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="fp-field">
                    <label for="password-confirm">Confirm Password</label>
                    <div class="fp-input-wrap">
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="fp-input" placeholder="Re-enter password" required autocomplete="new-password" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="reToggle2" aria-label="Toggle visibility">
                            <i class="bi bi-eye" id="reIcon2"></i>
                        </button>
                    </div>
                </div>

                <div class="fp-checks">
                    <div class="fp-check">
                        <input type="checkbox" name="agree_terms" id="agreeTerms" value="1" required>
                        <label for="agreeTerms">I agree to the <a href="{{ url('/terms') }}" target="_blank">Terms &amp; Conditions</a> and <a href="{{ url('/terms/privacy') }}" target="_blank">Privacy Policy</a></label>
                    </div>
                </div>

                <button type="submit" class="fp-btn" id="reBtn">
                    <i class="bi bi-person-plus-fill btn-main-icon"></i>
                    <i class="bi bi-arrow-repeat btn-spinner"></i>
                    Create Free Account
                </button>
            </form>

            <div class="fp-divider" role="separator" aria-label="or sign up with">Sign up faster</div>

            <div class="fp-social">
                <a href="{{ url('/auth/google') }}" class="fp-social-btn"><i class="bi bi-google"></i> Google</a>
                <a href="{{ url('/auth/apple') }}" class="fp-social-btn"><i class="bi bi-apple"></i> Apple</a>
            </div>

            <div class="fp-login-box">
                <p><i class="bi bi-box-arrow-in-right"></i> Already have an account?</p>
                <a href="{{ route('login') }}" class="fp-login-btn"><i class="bi bi-shield-lock-fill"></i> Sign In</a>
            </div>

            <div class="fp-trust">
                <div class="fp-trust-item"><i class="bi bi-shield-fill-check"></i> Secured</div>
                <div class="fp-trust-item"><i class="bi bi-patch-check-fill"></i> Verified</div>
                <div class="fp-trust-item"><i class="bi bi-lock-fill"></i> Encrypted</div>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    function t(b,i,c){document.getElementById(b)?.addEventListener('click',function(){var e=document.getElementById(i),n=document.getElementById(c),s=e.type==='text';e.type=s?'password':'text';n.className=s?'bi bi-eye':'bi bi-eye-slash'})}
    t('reToggle','password','reIcon');t('reToggle2','password-confirm','reIcon2');

    document.getElementById('reForm')?.addEventListener('submit',function(){var b=document.getElementById('reBtn');if(b){b.classList.add('loading');b.disabled=true;}});

    var c=document.getElementById('reParticles');
    if(c){
        var ctx=c.getContext('2d'),W,H,animId,ps=[];
        function r(){W=c.width=window.innerWidth;H=c.height=window.innerHeight}
        r();window.addEventListener('resize',r);
        for(var i=0;i<20;i++){ps.push({x:Math.random()*W,y:Math.random()*H,s:Math.random()*1.5+0.5,vx:(Math.random()-0.5)*0.25,vy:(Math.random()-0.5)*0.25,o:Math.random()*0.25+0.1})}
        function d(){ctx.clearRect(0,0,W,H);for(var i=0;i<ps.length;i++){var p=ps[i];p.x+=p.vx;p.y+=p.vy;if(p.x<0||p.x>W)p.vx*=-1;if(p.y<0||p.y>H)p.vy*=-1;ctx.beginPath();ctx.arc(p.x,p.y,p.s,0,Math.PI*2);ctx.fillStyle='rgba(234,179,8,'+p.o+')';ctx.fill()}animId=requestAnimationFrame(d)}
        document.addEventListener('visibilitychange',function(){if(document.hidden){if(animId)cancelAnimationFrame(animId)}else{d()}});
        d();
    }
})();
</script>
@endsection
