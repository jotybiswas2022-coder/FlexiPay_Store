@extends('frontend.auth_layout')
@section('title', 'Verify Email')

@section('content')
<style>
#veParticles { position:fixed; inset:0; z-index:0; pointer-events:none; opacity:0.35; }

.fp-bg { position:fixed; inset:0; z-index:0; overflow:hidden; background:linear-gradient(135deg,#0A0A0B 0%,#121214 50%,#0A0A0B 100%); }
.fp-grid { position:absolute; inset:0; background-image:linear-gradient(rgba(234,179,8,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(234,179,8,0.03) 1px,transparent 1px); background-size:48px 48px; animation:veDrift 20s linear infinite; will-change:transform; }
@keyframes veDrift { 0%{transform:translate(0,0)} 100%{transform:translate(48px,48px)} }
.fp-blob { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.25; animation:veBlob 8s ease-in-out infinite alternate; will-change:transform; }
.fp-blob-1 { width:500px; height:500px; background:radial-gradient(circle,#EAB30833,transparent); top:-150px; right:-100px; }
.fp-blob-2 { width:400px; height:400px; background:radial-gradient(circle,#CA8A0422,transparent); bottom:-120px; left:-100px; animation-delay:-4s; }
@keyframes veBlob { 0%{transform:translate(0,0) scale(1)} 100%{transform:translate(25px,30px) scale(1.06)} }

.fp-wrap { position:relative; z-index:1; min-height:calc(100vh - 68px); display:flex; flex-direction:column; align-items:center; justify-content:center; padding:40px 16px; }
.fp-logo { display:flex; align-items:center; gap:10px; margin-bottom:32px; animation:veDown 0.6s ease both; }
@keyframes veDown { from{opacity:0;transform:translateY(-20px)} to{opacity:1;transform:translateY(0)} }
.fp-logo-icon { width:44px; height:44px; border-radius:12px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); display:flex; align-items:center; justify-content:center; font-size:20px; color:var(--near-black); }
.fp-logo-text { font-family:'Syne',sans-serif; font-size:24px; font-weight:800; color:var(--text-primary); }
.fp-logo-text span { color:var(--gold-500); }

.fp-card { width:100%; max-width:420px; background:var(--card-dark); border:1px solid var(--card-border); border-radius:20px; box-shadow:0 20px 60px rgba(0,0,0,0.5); overflow:hidden; animation:veUp 0.7s cubic-bezier(.22,.68,0,1.2) 0.1s both; }
@keyframes veUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }

.fp-header { padding:36px 28px 0; text-align:center; }
.fp-header-icon { width:72px; height:72px; border-radius:50%; margin:0 auto 18px; background:rgba(234,179,8,0.1); display:flex; align-items:center; justify-content:center; }
.fp-header-icon i { font-size:30px; color:var(--gold-500); }
.fp-header h2 { font-family:'Syne',sans-serif; font-size:22px; font-weight:700; color:var(--text-primary); }
.fp-header p { font-size:14px; color:var(--text-muted); margin-top:6px; line-height:1.5; }

.fp-body { padding:20px 28px 36px; text-align:center; }
.fp-alert { display:flex; align-items:center; gap:10px; background:rgba(74,222,128,0.1); border:1px solid rgba(74,222,128,0.3); border-radius:10px; padding:14px 18px; margin-bottom:20px; color:#4ade80; font-size:13px; text-align:left; }
.fp-alert i { font-size:16px; flex-shrink:0; }

.fp-btn { width:100%; height:48px; border:none; border-radius:10px; margin-top:18px; background:linear-gradient(135deg,var(--gold-500),var(--gold-600)); color:var(--near-black); font-family:'Syne',sans-serif; font-size:15px; font-weight:700; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 6px 24px rgba(234,179,8,0.3); transition:transform 0.2s,box-shadow 0.2s; letter-spacing:0.3px; }
.fp-btn:hover { transform:translateY(-2px); box-shadow:0 10px 32px rgba(234,179,8,0.4); }
.fp-btn:active { transform:translateY(0); }

.fp-note { font-size:13px; color:var(--text-dim); margin-top:18px; }
.fp-back { display:flex; align-items:center; justify-content:center; gap:5px; margin-top:20px; font-size:13px; color:var(--text-muted); transition:color 0.2s; }
.fp-back:hover { color:var(--gold-400); }

@media (max-width:480px) { .fp-body { padding:16px 20px 28px; } .fp-header { padding:28px 20px 0; } }
@media (prefers-reduced-motion:reduce) { .fp-grid,.fp-blob,.fp-logo,.fp-card { animation:none!important; } #veParticles { display:none; } }
</style>

<canvas id="veParticles" aria-hidden="true"></canvas>

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
            <div class="fp-header-icon"><i class="bi bi-envelope-fill"></i></div>
            <h2>Verify Your Email</h2>
            <p>We sent a verification link to your email address.<br>Please check your inbox and click the link.</p>
        </div>

        <div class="fp-body">
            @if (session('resent'))
            <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> A fresh verification link has been sent to your email.</div>
            @endif

            <p class="fp-note">Didn't receive the email?</p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="fp-btn"><i class="bi bi-send-fill"></i> Resend Verification Link</button>
            </form>

            <a href="{{ route('login') }}" class="fp-back"><i class="bi bi-arrow-left"></i> Back to Login</a>
        </div>
    </div>
</div>

<script>
(function(){
    var c=document.getElementById('veParticles');
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
