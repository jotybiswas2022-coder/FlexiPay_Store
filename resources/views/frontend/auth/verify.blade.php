@extends('frontend.auth_layout')
@section('title', 'Verify Email')

@push('styles')
<style>
.fp-verify-wrap {
    flex:1; display:flex; align-items:center; justify-content:center;
    padding:40px 20px; position:relative; overflow:hidden; width:100%;
}
.fp-verify-canvas {
    position:fixed; top:0; left:0; width:100%; height:100%; z-index:0;
    pointer-events:none;
}
.fp-verify-orb {
    position:absolute; width:500px; height:500px; border-radius:50%;
    background:radial-gradient(circle,rgba(234,179,8,0.03) 0%,transparent 60%);
    top:-200px; right:-150px; animation:vrPulse 5s ease-in-out infinite;
}
@keyframes vrPulse { 0%,100%{transform:scale(1);opacity:0.4} 50%{transform:scale(1.12);opacity:0.8} }

.fp-verify-card {
    position:relative; z-index:1; width:100%; max-width:440px;
    background:var(--card-dark); border:1px solid var(--card-border);
    border-radius:16px; padding:40px 32px; text-align:center;
    transition:transform 0.3s, border-color 0.3s, box-shadow 0.3s;
}
.fp-verify-card:hover{transform:translateY(-3px);border-color:rgba(234,179,8,0.2);box-shadow:var(--shadow-card-hover)}
.fp-verify-icon {
    width:72px; height:72px; border-radius:50%; margin:0 auto 20px;
    background:rgba(234,179,8,0.1); display:flex; align-items:center; justify-content:center;
}
.fp-verify-icon i{font-size:32px;color:var(--gold-500)}
.fp-verify-card h3{font-family:'Syne',sans-serif;font-size:22px;font-weight:700;color:var(--text-primary);margin-bottom:12px}
.fp-verify-card p{color:var(--text-muted);font-size:14px;line-height:1.6;margin-bottom:6px}
.fp-verify-alert{
    background:rgba(74,222,128,0.1);border:1px solid rgba(74,222,128,0.3);
    border-radius:10px;padding:14px 18px;margin-bottom:20px;
    color:#4ade80;font-size:13px;display:flex;align-items:center;gap:10px;
}
.fp-verify-alert i{font-size:16px}
.fp-vr-btn{
    width:100%;padding:13px;margin-top:18px;
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600));
    color:var(--near-black);border:none;border-radius:10px;
    font-size:15px;font-weight:700;font-family:'Syne',sans-serif;
    cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
    transition:all 0.3s;
}
.fp-vr-btn:hover{transform:translateY(-2px);box-shadow:var(--shadow-gold)}
.fp-verify-footer{margin-top:24px;font-size:13px;color:var(--text-dim)}
.fp-verify-footer a{color:var(--gold-400);font-weight:600}
.fp-verify-footer a:hover{color:var(--gold-500)}
</style>
@endpush

@section('content')
<canvas class="fp-verify-canvas" id="particleCanvas"></canvas>
<div class="fp-verify-wrap">
    <div class="fp-verify-orb"></div>
    <div class="fp-verify-card" id="verifyCard">
        <div class="fp-verify-icon"><i class="bi bi-envelope-fill"></i></div>
        <h3>Verify Your Email</h3>
        <p>We sent a verification link to your email address.</p>
        <p>Please check your inbox and click the link to activate your account.</p>

        @if (session('resent'))
            <div class="fp-verify-alert">
                <i class="bi bi-check-circle-fill"></i>
                A fresh verification link has been sent to your email.
            </div>
        @endif

        <p style="margin-top:16px;color:var(--text-dim);font-size:13px">Didn't receive the email?</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="fp-vr-btn">
                <i class="bi bi-send-fill"></i> Resend Verification Link
            </button>
        </form>

        <div class="fp-verify-footer">
            <a href="{{ route('frontend.index') }}"><i class="bi bi-arrow-left"></i> Back to Home</a>
        </div>
    </div>
</div>

<script>
(function(){
    var c=document.getElementById('particleCanvas'),ctx=c.getContext('2d');
    var particles=[],mouse={x:null,y:null};
    function resize(){c.width=window.innerWidth;c.height=window.innerHeight}
    resize();window.addEventListener('resize',resize);
    window.addEventListener('mousemove',function(e){mouse.x=e.clientX;mouse.y=e.clientY});
    var colors=['rgba(234,179,8,','rgba(250,204,21,','rgba(202,138,4,'];
    for(var i=0;i<70;i++){
        particles.push({
            x:Math.random()*c.width,y:Math.random()*c.height,
            vx:(Math.random()-0.5)*0.5,vy:(Math.random()-0.5)*0.5,
            r:Math.random()*2+1,
            c:colors[Math.floor(Math.random()*colors.length)]
        });
    }
    function draw(){
        ctx.clearRect(0,0,c.width,c.height);
        for(var i=0;i<particles.length;i++){
            var p=particles[i];
            p.x+=p.vx;p.y+=p.vy;
            if(p.x<0||p.x>c.width)p.vx*=-1;
            if(p.y<0||p.y>c.height)p.vy*=-1;
            if(mouse.x){var dx=mouse.x-p.x,dy=mouse.y-p.y,dist=Math.sqrt(dx*dx+dy*dy);
            if(dist<120){p.vx+=dx*0.0001;p.vy+=dy*0.0001}}
            ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
            ctx.fillStyle=p.c+(0.3+Math.sin(Date.now()/2000+i)*0.15)+')';
            ctx.fill();
        }
        requestAnimationFrame(draw);
    }
    draw();
})();
</script>
@endsection
