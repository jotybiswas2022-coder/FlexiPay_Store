@extends('frontend.auth_layout')
@section('title', 'Confirm Password')

@push('styles')
<style>
.fp-cp-wrap {
    flex:1; display:flex; align-items:center; justify-content:center;
    padding:40px 20px; position:relative; overflow:hidden; width:100%;
}
.fp-cp-canvas {
    position:fixed; top:0; left:0; width:100%; height:100%; z-index:0;
    pointer-events:none;
}
.fp-cp-orb {
    position:absolute; width:450px; height:450px; border-radius:50%;
    background:radial-gradient(circle,rgba(234,179,8,0.03) 0%,transparent 60%);
    top:-180px; right:-120px; animation:cpPulse 5s ease-in-out infinite;
}
@keyframes cpPulse { 0%,100%{transform:scale(1);opacity:0.4} 50%{transform:scale(1.12);opacity:0.8} }

.fp-cp-card {
    position:relative; z-index:1; width:100%; max-width:440px;
    background:var(--card-dark); border:1px solid var(--card-border);
    border-radius:16px; overflow:hidden;
    transition:transform 0.3s;
}
.fp-cp-card:hover{transform:translateY(-2px)}
.fp-cp-strip{
    height:4px;background:linear-gradient(90deg,var(--gold-500),var(--gold-400),var(--gold-500));
    background-size:200% 100%;animation:cpShine 2s linear infinite;
}
@keyframes cpShine{0%{background-position:200% 0}100%{background-position:-200% 0}}
.fp-cp-body{padding:32px 28px}
.fp-cp-icon{
    width:60px;height:60px;border-radius:50%;margin:0 auto 16px;
    background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;
}
.fp-cp-icon i{font-size:26px;color:var(--gold-500)}
.fp-cp-body h3{font-family:'Syne',sans-serif;font-size:20px;font-weight:700;color:var(--text-primary);text-align:center;margin-bottom:6px}
.fp-cp-body>p{text-align:center;color:var(--text-muted);font-size:13px;margin-bottom:24px}
.fp-cp-field{margin-bottom:16px}
.fp-cp-field label{display:block;color:var(--text-muted);font-size:13px;font-weight:600;margin-bottom:6px}
.fp-cp-field .fp-cp-input{
    width:100%;padding:11px 14px;border-radius:var(--radius-sm);
    border:1px solid var(--card-border);background:var(--surface-dark);
    color:var(--text-primary);font-size:14px;outline:none;transition:all 0.2s;
}
.fp-cp-field .fp-cp-input:focus{border-color:var(--gold-500);box-shadow:0 0 0 3px rgba(234,179,8,0.1)}
.fp-cp-field .invalid-feedback{color:#f87171;font-size:12px;margin-top:4px;display:block}
.fp-cp-field .is-invalid{border-color:#f87171}
.fp-cp-btn{
    width:100%;padding:13px;margin-top:8px;
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600));
    color:var(--near-black);border:none;border-radius:10px;
    font-size:15px;font-weight:700;font-family:'Syne',sans-serif;
    cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
    transition:all 0.3s;
}
.fp-cp-btn:hover{transform:translateY(-2px);box-shadow:var(--shadow-gold)}
.fp-cp-link{display:block;text-align:center;margin-top:14px;color:var(--gold-400);font-size:13px;font-weight:600}
.fp-cp-link:hover{color:var(--gold-500)}
</style>
@endpush

@section('content')
<canvas class="fp-cp-canvas" id="cpCanvas"></canvas>
<div class="fp-cp-wrap">
    <div class="fp-cp-orb"></div>
    <div class="fp-cp-card" id="cpCard">
        <div class="fp-cp-strip"></div>
        <div class="fp-cp-body">
            <div class="fp-cp-icon"><i class="bi bi-shield-fill-check"></i></div>
            <h3>Confirm Password</h3>
            <p>Please confirm your password before continuing</p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="fp-cp-field">
                    <label for="password">Password</label>
                    <input id="password" type="password"
                           class="fp-cp-input @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <button type="submit" class="fp-cp-btn">
                    <i class="bi bi-check2-circle"></i> Confirm Password
                </button>

                @if (Route::has('password.request'))
                    <a class="fp-cp-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    var c=document.getElementById('cpCanvas'),ctx=c.getContext('2d');
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
