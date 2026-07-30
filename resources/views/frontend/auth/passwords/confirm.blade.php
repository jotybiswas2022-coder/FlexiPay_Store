@extends('frontend.auth_layout')
@section('title', 'Confirm Password')

@section('content')
<style>
#cpParticles { position:fixed; inset:0; z-index:0; pointer-events:none; opacity:0.35; }

.fp-bg { position:fixed; inset:0; z-index:0; overflow:hidden; background:linear-gradient(135deg,#0A0A0B 0%,#121214 50%,#0A0A0B 100%); }
.fp-grid { position:absolute; inset:0; background-image:linear-gradient(rgba(234,179,8,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(234,179,8,0.03) 1px,transparent 1px); background-size:48px 48px; animation:cpDrift 20s linear infinite; will-change:transform; }
@keyframes cpDrift { 0%{transform:translate(0,0)} 100%{transform:translate(48px,48px)} }
.fp-blob { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.25; animation:cpBlob 8s ease-in-out infinite alternate; will-change:transform; }
.fp-blob-1 { width:500px; height:500px; background:radial-gradient(circle,#EAB30833,transparent); top:-150px; right:-100px; }
.fp-blob-2 { width:400px; height:400px; background:radial-gradient(circle,#CA8A0422,transparent); bottom:-120px; left:-100px; animation-delay:-4s; }
@keyframes cpBlob { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(25px,30px) scale(1.06)} }

.fp-wrap { position:relative; z-index:1; min-height:calc(100vh - 68px); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 16px; }
.fp-logo { display:flex; align-items:center; gap:10px; margin-bottom:32px; animation:cpDown 0.6s ease both; }
@keyframes cpDown { from{opacity:0;transform:translateY(-20px)} to{opacity:1;transform:translateY(0)} }
.fp-logo-icon { width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); display:flex; align-items:center; justify-content:center; font-size:20px; color:var(--near-black); }
.fp-logo-text { font-family:'Syne',sans-serif; font-size:24px; font-weight:800; color:var(--text-primary); }
.fp-logo-text span { color:var(--gold-500); }

.fp-card { width:100%; max-width:420px; background:var(--card-dark); border:1px solid var(--card-border); border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.5); overflow:hidden; animation:cpUp 0.7s cubic-bezier(.22,.68,0,1.2) 0.1s both; }
@keyframes cpUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

.fp-header { padding:28px 28px 0; text-align:center; }
.fp-header-icon { width:52px; height:52px; border-radius:50%; margin:0 auto 14px; background:rgba(234,179,8,0.12); display:flex; align-items:center; justify-content:center; }
.fp-header-icon i { font-size:22px; color:var(--gold-500); }
.fp-header h2 { font-family:'Syne',sans-serif; font-size:20px; font-weight:700; color:var(--text-primary); }
.fp-header p { font-size:13px; color:var(--text-muted); margin-top:4px; }

.fp-body { padding:24px 28px 28px; }

.fp-field { margin-bottom:18px; }
.fp-field label { display:block; font-size:13px; font-weight:600; color:var(--text-primary); margin-bottom:7px; }
.fp-input-wrap { position:relative; }
.fp-input { width:100%; height:46px; padding:0 44px 0 14px; border:1.5px solid var(--card-border); border-radius:10px; background:var(--surface-dark); font-size:14px; color:var(--text-primary); outline:none; transition:border-color 0.25s,box-shadow 0.25s; }
.fp-input::placeholder { color:var(--text-dim); }
.fp-input:focus { border-color:var(--gold-500); box-shadow:0 0 0 3px rgba(234,179,8,0.1); }
.fp-input.is-invalid { border-color:#ef4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
.fp-toggle-btn { position:absolute; right:10px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--text-dim); font-size:16px; padding:8px; border-radius:6px; }
.fp-toggle-btn:hover { color:var(--gold-500); }
.invalid-feedback { font-size:12px; color:#ef4444; margin-top:5px; font-weight:500; }

.fp-btn { width:100%; height:48px; border:none; border-radius:10px; margin-top:6px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); color:var(--near-black); font-family:'Syne',sans-serif; font-size:15px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 6px 24px rgba(234,179,8,0.3); transition:transform 0.2s,box-shadow 0.2s; letter-spacing:0.3px; }
.fp-btn:hover { transform:translateY(-2px); box-shadow:0 10px 32px rgba(234,179,8,0.4); }
.fp-btn:active { transform:translateY(0); }

.fp-link { display:block; text-align:center; margin-top:16px; font-size:13px; color:var(--gold-400); font-weight:500; transition:color 0.2s; }
.fp-link:hover { color:var(--gold-300); }

@media (max-width:480px) { .fp-body { padding:20px 20px 24px; } .fp-header { padding:24px 20px 0; } }
@media (prefers-reduced-motion:reduce) { .fp-grid,.fp-blob,.fp-logo,.fp-card { animation:none!important; } #cpParticles { display:none; } }
</style>

<canvas id="cpParticles" aria-hidden="true"></canvas>

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
            <div class="fp-header-icon"><i class="bi bi-shield-fill-check"></i></div>
            <h2>Confirm Password</h2>
            <p>Please confirm your password before continuing</p>
        </div>

        <div class="fp-body">
            <form method="POST" action="{{ route('password.confirm') }}" id="cpForm" novalidate>
                @csrf
                <div class="fp-field">
                    <label for="password">Password</label>
                    <div class="fp-input-wrap">
                        <input id="password" type="password" name="password"
                               class="fp-input @error('password') is-invalid @enderror"
                               required autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" spellcheck="false">
                        <button type="button" class="fp-toggle-btn" id="cpToggle" aria-label="Toggle visibility">
                            <i class="bi bi-eye" id="cpIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="fp-btn"><i class="bi bi-check2-circle"></i> Confirm Password</button>
            </form>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="fp-link">Forgot Your Password?</a>
            @endif
        </div>
    </div>
</div>

<script>
(function(){
    document.getElementById('cpToggle')?.addEventListener('click',function(){var i=document.getElementById('password'),c=document.getElementById('cpIcon'),t=i.type==='text';i.type=t?'password':'text';c.className=t?'bi bi-eye':'bi bi-eye-slash'});
    document.getElementById('cpForm')?.addEventListener('submit',function(){var b=this.querySelector('.fp-btn');if(b){b.classList.add('loading');b.disabled=true;}});

    var c=document.getElementById('cpParticles');
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
