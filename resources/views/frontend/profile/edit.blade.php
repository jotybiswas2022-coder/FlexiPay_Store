@extends('frontend.app')
@section('title', 'Edit Profile — FlexiPay Store')

@section('content')
<section class="fp-profile-section" style="background:var(--near-black);padding:60px 0;min-height:100vh;">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-gear-fill"></i> Settings</div>
            <h2>Account Settings</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="fp-profile-sidebar" style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;position:sticky;top:100px;">
                    <div class="fp-avatar-circle" style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,var(--gold-500),var(--gold-600));color:var(--near-black);display:flex;align-items:center;justify-content:center;font-size:24px;font-weight:800;font-family:'Syne',sans-serif;margin:0 auto 12px;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <h5 style="text-align:center;color:var(--text-primary);font-size:16px;">{{ auth()->user()->name ?? 'User' }}</h5>
                    <nav class="fp-profile-nav mt-3" style="display:flex;flex-direction:column;gap:4px;">
                        <a href="{{ route('profile.index') }}" style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:var(--text-muted);font-size:13px;transition:all 0.2s;"><i class="bi bi-person-fill"></i> Profile</a>
                        <a href="{{ route('profile.edit') }}" style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;background:rgba(234,179,8,0.08);color:var(--gold-400);font-size:13px;"><i class="bi bi-gear-fill"></i> Settings</a>
                        <a href="{{ route('orders.index') }}" style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:var(--text-muted);font-size:13px;transition:all 0.2s;"><i class="bi bi-box-seam-fill"></i> My Orders</a>
                        <a href="{{ route('wallet.index') }}" style="display:flex;align-items:center;gap:8px;padding:10px 12px;border-radius:6px;color:var(--text-muted);font-size:13px;transition:all 0.2s;"><i class="bi bi-wallet2"></i> Wallet</a>
                    </nav>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="fp-card" style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;">
                    <div class="fp-card-header" style="padding:18px 24px;border-bottom:1px solid var(--card-border);">
                        <h4 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:var(--text-primary);display:flex;align-items:center;gap:8px;">
                            <i class="bi bi-pencil-fill" style="color:var(--gold-500);"></i> Edit Personal Information
                        </h4>
                    </div>
                    <div class="fp-card-body" style="padding:24px;">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="fp-form-group">
                                        <label><i class="bi bi-person-fill"></i> Full Name</label>
                                        <input type="text" name="name" class="fp-input" value="{{ auth()->user()->name }}" placeholder="Your full name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fp-form-group">
                                        <label><i class="bi bi-envelope-fill"></i> Email *</label>
                                        <input type="email" class="fp-input" value="{{ auth()->user()->email }}" disabled style="opacity:0.6;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fp-form-group">
                                        <label><i class="bi bi-phone-fill"></i> Phone</label>
                                        <input type="text" name="phone" class="fp-input" value="{{ auth()->user()->phone }}" placeholder="+234 801 234 5678">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-primary-gold"><i class="bi bi-check-lg"></i> Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="fp-card mt-4" style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;">
                    <div class="fp-card-header" style="padding:18px 24px;border-bottom:1px solid var(--card-border);">
                        <h4 style="font-family:'Syne',sans-serif;font-size:16px;font-weight:700;color:var(--text-primary);display:flex;align-items:center;gap:8px;">
                            <i class="bi bi-shield-lock-fill" style="color:var(--gold-500);"></i> Change Password
                        </h4>
                    </div>
                    <div class="fp-card-body" style="padding:24px;">
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="fp-form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="fp-input" placeholder="••••••••">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fp-form-group">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="fp-input" placeholder="••••••••">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fp-form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" name="password_confirmation" class="fp-input" placeholder="••••••••">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn-primary-gold"><i class="bi bi-check-lg"></i> Update Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.fp-alert {
    display: flex; align-items: center; gap: 8px;
    background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
    color: #4ade80; padding: 12px 16px; border-radius: var(--radius-sm);
    font-weight: 500; font-size: 13px; margin-bottom: 24px;
}
.fp-form-group label {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 600; color: var(--text-primary);
    margin-bottom: 8px;
}
.fp-form-group label i { color: var(--gold-500); font-size: 13px; }
.fp-input {
    width: 100%; padding: 12px 16px;
    background: var(--surface-dark); border: 1.5px solid var(--card-border);
    border-radius: var(--radius-sm); color: var(--text-primary);
    font-size: 14px; font-family: 'Space Grotesk', sans-serif;
    outline: none; transition: all 0.2s;
}
.fp-input:focus {
    border-color: var(--gold-500);
    box-shadow: 0 0 0 3px rgba(234,179,8,0.08);
}
.fp-input::placeholder { color: var(--text-dim); }

@media (max-width: 991px) {
    .fp-profile-sidebar { position: static; margin-bottom: 24px; }
}
</style>
@endsection