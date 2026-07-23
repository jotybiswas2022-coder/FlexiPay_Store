@extends('frontend.app')
@section('title', 'My Profile — FlexiPay Store')

@push('styles')
<style>
.fp-prof-hero {
    position: relative; padding: 30px 0 20px; overflow: hidden;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-prof-orb {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.04) 0%, transparent 60%);
    top: -150px; right: -80px; pointer-events: none;
    animation: prfPulse 4s ease-in-out infinite;
}
@keyframes prfPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-prof-section { padding-bottom: 80px; min-height: 60vh; }

.fp-alert {
    display: flex; align-items: center; gap: 8px;
    background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.2);
    color: #4ade80; padding: 14px 18px; border-radius: var(--radius-sm);
    font-weight: 500; font-size: 13px; margin-bottom: 24px;
}

.fp-profile-sidebar {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); padding: 24px; position: sticky; top: 100px;
    transition: all 0.3s;
}
.fp-profile-sidebar:hover { border-color: rgba(234,179,8,0.15); }
.fp-profile-avatar { text-align: center; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid var(--card-border); }
.fp-avatar-circle {
    width: 64px; height: 64px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); display: flex; align-items: center; justify-content: center;
    font-size: 24px; font-weight: 800; font-family: 'Syne', sans-serif;
    margin: 0 auto 12px;
}
.fp-profile-avatar h5 { color: var(--text-primary); font-size: 16px; font-weight: 600; }
.fp-avatar-email { color: var(--text-dim); font-size: 12px; word-break: break-all; }

.fp-profile-nav { display: flex; flex-direction: column; gap: 4px; }
.fp-profile-nav a {
    display: flex; align-items: center; gap: 8px;
    padding: 10px 12px; border-radius: 6px;
    color: var(--text-muted); font-size: 13px; font-weight: 500;
    transition: all 0.2s; text-decoration: none;
}
.fp-profile-nav a:hover, .fp-profile-nav a.active { background: rgba(234,179,8,0.08); color: var(--gold-400); }
.fp-profile-nav a i { width: 18px; font-size: 14px; }

.fp-logout-btn {
    width: 100%; margin-top: 16px; padding: 10px;
    background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);
    color: #ef4444; border-radius: 6px;
    font-size: 13px; font-weight: 500; cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    transition: all 0.2s; font-family: inherit;
}
.fp-logout-btn:hover { background: rgba(239,68,68,0.15); }

.fp-stat-mini {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius-sm); padding: 16px;
    display: flex; align-items: center; gap: 14px;
    transition: all 0.3s;
}
.fp-stat-mini:hover { border-color: rgba(234,179,8,0.2); transform: translateY(-2px); }
.fp-stat-mini i { font-size: 28px; color: var(--gold-500); }
.fp-stat-mini strong { display: block; color: var(--text-primary); font-size: 18px; font-weight: 700; }
.fp-stat-mini span { color: var(--text-dim); font-size: 12px; }

.fp-profile-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); overflow: hidden;
    transition: all 0.3s;
}
.fp-profile-card:hover { border-color: rgba(234,179,8,0.15); }
.fp-profile-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 18px 24px; border-bottom: 1px solid var(--card-border);
}
.fp-profile-card-header h4 {
    font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700;
    color: var(--text-primary); display: flex; align-items: center; gap: 8px; margin: 0;
}
.fp-profile-card-header h4 i { color: var(--gold-500); }
.btn-edit { font-size: 12px; color: var(--gold-400); font-weight: 600; display: flex; align-items: center; gap: 4px; text-decoration: none; }
.btn-edit:hover { color: var(--gold-300); }
.fp-profile-card-body { padding: 24px; }

.fp-info-item label { display: block; font-size: 12px; color: var(--text-dim); font-weight: 500; margin-bottom: 4px; }
.fp-info-item span { color: var(--text-primary); font-size: 15px; font-weight: 500; }

.fp-order-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 24px; border-bottom: 1px solid var(--card-border);
    transition: background 0.2s;
}
.fp-order-row:last-child { border-bottom: none; }
.fp-order-row:hover { background: rgba(234,179,8,0.03); }
.fp-order-status-badge {
    padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase;
}
.fp-order-status-badge.processing, .fp-order-status-badge.partial_paid { background: rgba(234,179,8,0.15); color: var(--gold-400); }
.fp-order-status-badge.completed { background: rgba(34,197,94,0.15); color: #4ade80; }
.fp-order-status-badge.cancelled { background: rgba(239,68,68,0.15); color: #ef4444; }
.fp-order-status-badge.shipped { background: rgba(59,130,246,0.15); color: #60a5fa; }

@media (max-width: 991px) {
    .fp-profile-sidebar { position: static; margin-bottom: 24px; }
}
</style>
@endpush

@section('content')
<section class="fp-prof-hero">
    <div class="fp-prof-orb" aria-hidden="true"></div>
    <div class="container">
        <div class="section-head reveal-up">
            <div class="section-badge"><i class="bi bi-person-circle"></i> My Profile</div>
            <h2>Welcome, {{ auth()->user()->name ?? auth()->user()->email }}</h2>
            <p>Manage your account settings and view your activity</p>
        </div>
    </div>
</section>

<section class="fp-prof-section">
    <div class="container">
        @if(session('success'))
        <div class="fp-alert reveal-up"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-3">
                <div class="fp-profile-sidebar reveal-left">
                    <div class="fp-profile-avatar">
                        <div class="fp-avatar-circle">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <h5>{{ auth()->user()->name ?? 'User' }}</h5>
                        <span class="fp-avatar-email">{{ auth()->user()->email }}</span>
                    </div>
                    <nav class="fp-profile-nav" aria-label="Profile navigation">
                        <a href="{{ route('profile.index') }}" class="active" aria-current="page"><i class="bi bi-person-fill"></i> Profile</a>
                        <a href="{{ route('profile.edit') }}"><i class="bi bi-gear-fill"></i> Settings</a>
                        <a href="{{ route('orders.index') }}"><i class="bi bi-box-seam-fill"></i> My Orders</a>
                        <a href="{{ route('wallet.index') }}"><i class="bi bi-wallet2"></i> Wallet</a>
                        <a href="{{ route('wishlist.index') }}"><i class="bi bi-heart-fill"></i> Wishlist</a>
                        <a href="{{ route('profile.addresses') }}"><i class="bi bi-geo-alt-fill"></i> Addresses</a>
                        <a href="{{ route('profile.cards') }}"><i class="bi bi-credit-card-fill"></i> Cards</a>
                        <a href="{{ route('profile.banks') }}"><i class="bi bi-bank"></i> Bank Accounts</a>
                        <a href="{{ route('profile.verification') }}"><i class="bi bi-patch-check-fill"></i> Verification</a>
                    </nav>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="fp-logout-btn"><i class="bi bi-box-arrow-right"></i> Logout</button>
                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row g-3 mb-4 reveal-up">
                    <div class="col-md-4 col-6">
                        <div class="fp-stat-mini">
                            <i class="bi bi-box-seam-fill"></i>
                            <div>
                                <strong>{{ auth()->user()->orders()->count() }}</strong>
                                <span>Orders</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="fp-stat-mini">
                            <i class="bi bi-coin"></i>
                            <div>
                                <strong>{{ auth()->user()->installmentPayments()->count() }}</strong>
                                <span>Installments</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="fp-stat-mini">
                            <i class="bi bi-wallet2"></i>
                            <div>
                                <strong>₦{{ number_format(auth()->user()->wallet?->balance ?? 0, 0) }}</strong>
                                <span>Wallet Balance</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fp-profile-card reveal-left" style="transition-delay:0.1s;">
                    <div class="fp-profile-card-header">
                        <h4><i class="bi bi-person-fill"></i> Personal Information</h4>
                        <a href="{{ route('profile.edit') }}" class="btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                    </div>
                    <div class="fp-profile-card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="fp-info-item">
                                    <label>Full Name</label>
                                    <span>{{ auth()->user()->name ?? '—' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp-info-item">
                                    <label>Email Address</label>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp-info-item">
                                    <label>Phone Number</label>
                                    <span>{{ auth()->user()->phone ?? '—' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp-info-item">
                                    <label>Member Since</label>
                                    <span>{{ auth()->user()->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fp-profile-card mt-4 reveal-left" style="transition-delay:0.2s;">
                    <div class="fp-profile-card-header">
                        <h4><i class="bi bi-box-seam-fill"></i> Recent Orders</h4>
                        <a href="{{ route('orders.index') }}" class="btn-edit">View All</a>
                    </div>
                    <div class="fp-profile-card-body p-0">
                        @php $recentOrders = auth()->user()->orders()->latest()->take(5)->get(); @endphp
                        @forelse($recentOrders as $order)
                        <div class="fp-order-row">
                            <div class="d-flex align-items-center gap-3">
                                <div class="fp-order-status-badge {{ $order->status }}">{{ ucfirst($order->status) }}</div>
                                <div>
                                    <strong style="color:var(--text-primary);">Order #{{ $order->id }}</strong>
                                    <small style="color:var(--text-dim);display:block;">{{ $order->created_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                            <span style="color:var(--gold-400);font-weight:700;font-family:'Syne',sans-serif;">₦{{ number_format($order->total, 0) }}</span>
                        </div>
                        @empty
                        <div class="text-center py-4" style="color:var(--text-dim);">
                            <i class="bi bi-inbox" style="font-size:32px;display:block;margin-bottom:8px;"></i>
                            No orders yet. <a href="{{ url('/shop') }}" style="color:var(--gold-400);">Start shopping!</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@endsection
