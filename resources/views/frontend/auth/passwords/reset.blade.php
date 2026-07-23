@extends('frontend.auth_layout')
@section('title', 'Reset Password')

@push('styles')
<style>
.fp-rp-wrap {
    flex:1; display:flex; align-items:center; justify-content:center;
    padding:40px 20px; position:relative; overflow:hidden; width:100%;
}
.fp-rp-canvas {
    position:fixed; top:0; left:0; width:100%; height:100%; z-index:0;
    pointer-events:none;
}
.fp-rp-orb {
    position:absolute; width:450px; height:450px; border-radius:50%;
    background:radial-gradient(circle,rgba(234,179,8,0.03) 0%,transparent 60%);
    top:-180px; left:-120px; animation:rpPulse 5s ease-in-out infinite;
}
@keyframes rpPulse { 0%,100%{transform:scale(1);opacity:0.4} 50%{transform:scale(1.12);opacity:0.8} }

.fp-rp-card {
    position:relative; z-index:1; width:100%; max-width:460px;
    background:var(--card-dark); border:1px solid var(--card-border);
    border-radius:16px; overflow:hidden;
    transition:transform 0.3s;
}
.fp-rp-card:hover{transform:translateY(-2px)}
.fp-rp-strip{
    height:4px;background:linear-gradient(90deg,var(--gold-500),var(--gold-400),var(--gold-500));
    background-size:200% 100%;animation:rpShine 2s linear infinite;
}
@keyframes rpShine{0%{background-position:200% 0}100%{background-position:-200% 0}}
.fp-rp-body{padding:32px 28px}
.fp-rp-icon{
    width:60px;height:60px;border-radius:50%;margin:0 auto 16px;
    background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;
}
.fp-rp-icon i{font-size:26px;color:var(--gold-500)}
.fp-rp-body h3{font-family:'Syne',sans-serif;font-size:20px;font-weight:700;color:var(--text-primary);text-align:center;margin-bottom:6px}
.fp-rp-body>p{text-align:center;color:var(--text-muted);font-size:13px;margin-bottom:24px}
.fp-rp-field{margin-bottom:16px}
.fp-rp-field label{display:block;color:var(--text-muted);font-size:13px;font-weight:600;margin-bottom:6px}
.fp-rp-field .fp-rp-input{
    width:100%;padding:11px 14px;border-radius:var(--radius-sm);
    border:1px solid var(--card-border);background:var(--surface-dark);
    color:var(--text-primary);font-size:14px;outline:none;transition:all 0.2s;
}
.fp-rp-field .fp-rp-input:focus{border-color:var(--gold-500);box-shadow:0 0 0 3px rgba(234,179,8,0.1)}
.fp-rp-field .invalid-feedback{color:#f87171;font-size:12px;margin-top:4px;display:block}
.fp-rp-field .is-invalid{border-color:#f87171}
.fp-rp-btn{
    width:100%;padding:13px;margin-top:8px;
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600));
    color:var(--near-black);border:none;border-radius:10px;
    font-size:15px;font-weight:700;font-family:'Syne',sans-serif;
    cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
    transition:all 0.3s;
}
.fp-rp-btn:hover{transform:translateY(-2px);box-shadow:var(--shadow-gold)}
</style>
@endpush

@section('content')
<canvas class="fp-rp-canvas" id="rpCanvas"></canvas>
<div class="fp-rp-wrap">
    <div class="fp-rp-orb"></div>
    <div class="fp-rp-card" id="rpCard">
        <div class="fp-rp-strip"></div>
        <div class="fp-rp-body">
            <div class="fp-rp-icon"><i class="bi bi-lock-fill"></i></div>
            <h3>Reset Password</h3>
            <p>Enter your email and choose a new password</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="fp-rp-field">
                    <label for="email">Email</label>
                    <input id="email" type="email"
                           class="fp-rp-input @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ $email ?? old('email') }}"
                           required autofocus>
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="fp-rp-field">
                    <label for="password">New Password</label>
                    <input id="password" type="password"
                           class="fp-rp-input @error('password') is-invalid @enderror"
                           name="password" required>
                    @error('password')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="fp-rp-field">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password"
                           class="fp-rp-input"
                           name="password_confirmation" required>
                </div>

                <button type="submit" class="fp-rp-btn">
                    <i class="bi bi-check2-circle"></i> Reset Password
                </button>
            </form>
        </div>
    </div>
</div>

<script>
(function(){
    var c=document.getElementById('rpCanvas'),ctx=c.getContext('2d');
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
