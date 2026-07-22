@extends('frontend.auth_layout')
@section('title', 'Reset Password')

@section('content')
<div class="fp-wrapper" style="min-height:calc(100vh - 68px);display:flex;align-items:center;justify-content:center;padding:40px 16px;">
    <div class="fp-card" style="max-width:440px;width:100%;">
        <div class="fp-card-strip">
            <div class="fp-strip-inner">
                <div class="fp-strip-left"><h2>Reset Password</h2><p>Enter your email to receive a reset link</p></div>
                <div class="fp-strip-badge"><div class="fp-live-dot"></div> Secure</div>
            </div>
        </div>
        <div class="fp-card-body">
            @if(session('status'))
            <div class="fp-alert-success" style="display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#4ade80;padding:12px 16px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:20px;">
                <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
            </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="fp-field">
                    <label class="fp-label"><i class="bi bi-envelope-fill"></i> Email Address</label>
                    <div class="fp-input-wrap">
                        <input type="email" name="email" class="fp-input @error('email') is-invalid @enderror" placeholder="you@example.com" required value="{{ old('email') }}">
                        <i class="bi bi-envelope fp-input-icon"></i>
                    </div>
                    @error('email')<div class="invalid-feedback"><strong>{{ $message }}</strong></div>@enderror
                </div>
                <button type="submit" class="fp-submit-btn"><i class="bi bi-send-fill"></i> Send Reset Link</button>
            </form>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" style="color:var(--gold-400);font-size:13px;"><i class="bi bi-arrow-left"></i> Back to Login</a>
            </div>
        </div>
    </div>
</div>
<style>
.fp-wrapper .fp-card { animation: fadeUp 0.8s cubic-bezier(.22,.68,0,1.2) 0.1s both; }
</style>
@endsection