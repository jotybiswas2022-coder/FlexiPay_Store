@extends('frontend.app')
@section('title', 'My Wallet — FlexiPay Store')

@push('styles')
<style>
.fp-wa-hero {
    position: relative; padding: 30px 0 20px; overflow: hidden; isolation: isolate;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-wa-orb {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.04) 0%, transparent 60%);
    top: -150px; right: -80px; pointer-events: none;
    animation: waPulse 4s ease-in-out infinite;
}
@keyframes waPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-wa-section { padding-bottom: 80px; min-height: 60vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);color:#4ade80;padding:14px 18px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px;contain:layout style; }

.fp-wallet-balance-card {
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600),var(--gold-700));
    border-radius:var(--radius-lg);padding:32px;text-align:center;
    position:relative;overflow:hidden;transition:transform 0.3s;
    transform:translateZ(0);contain:layout style;
}
.fp-wallet-balance-card:hover { transform:translateY(-3px); }
.fp-wallet-balance-card::before {
    content:'';position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:rgba(0,0,0,0.06);
}
.fp-wallet-balance-card::after {
    content:'';position:absolute;bottom:-60px;left:20%;width:200px;height:200px;border-radius:50%;background:rgba(0,0,0,0.04);
}
.fp-wb-icon { width:56px;height:56px;border-radius:14px;background:rgba(0,0,0,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:rgba(0,0,0,0.6);position:relative;z-index:1; }
.fp-wallet-balance-card h4 { font-family:'Syne',sans-serif;color:rgba(0,0,0,0.7);font-size:16px;margin-bottom:8px;position:relative;z-index:1; }
.fp-wb-amount { font-family:'Syne',sans-serif;font-size:42px;font-weight:800;color:var(--near-black);margin-bottom:8px;position:relative;z-index:1; }
.fp-wallet-balance-card p { color:rgba(0,0,0,0.5);font-size:13px;margin-bottom:20px;position:relative;z-index:1; }
.fp-fund-btn { display:inline-flex;align-items:center;gap:8px;background:var(--near-black);color:var(--gold-400);padding:12px 28px;border-radius:var(--radius-sm);font-weight:700;font-size:14px;transition:all 0.3s;position:relative;z-index:1; }
.fp-fund-btn:hover { transform:translateY(-2px);color:var(--gold-300);box-shadow:0 4px 16px rgba(0,0,0,0.3); }

.fp-ws-item { display:flex;align-items:center;gap:12px;background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:14px 16px;transition:all 0.3s;cursor:pointer;contain:layout style; }
.fp-ws-item:hover { border-color:rgba(234,179,8,0.2);transform:translateY(-2px); }
.fp-ws-item i { font-size:24px; }
.fp-ws-item strong { display:block;color:var(--text-primary);font-size:15px; }
.fp-ws-item span { color:var(--text-dim);font-size:12px; }

.fp-wallet-transactions { background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;transition:all 0.3s;contain:layout style; }
.fp-wallet-transactions:hover { border-color:rgba(234,179,8,0.15); }
.fp-wt-header { display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--card-border); }
.fp-wt-header h4 { font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text-primary);display:flex;align-items:center;gap:8px;margin:0; }
.fp-wt-header h4 i { color:var(--gold-500); }
.fp-view-all { color:var(--gold-400);font-size:12px;font-weight:600;text-decoration:none; }
.fp-view-all:hover { color:var(--gold-300); }
.fp-txn-item { display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid var(--card-border);transition:background 0.2s; }
.fp-txn-item:last-child { border-bottom:none; }
.fp-txn-item:hover { background:rgba(234,179,8,0.02); }
.fp-txn-icon { font-size:20px; }
.fp-txn-icon.credit { color:#4ade80; }
.fp-txn-icon.debit { color:#ef4444; }
.fp-txn-info { flex:1; }
.fp-txn-info strong { display:block;color:var(--text-primary);font-size:13px;font-weight:500; }
.fp-txn-info small { color:var(--text-dim);font-size:11px; }
.fp-txn-amount { font-weight:700;font-size:15px; }
.fp-txn-amount.credit { color:#4ade80; }
.fp-txn-amount.debit { color:#ef4444; }
</style>
@endpush

@section('content')
<section class="fp-wa-hero">
    <div class="fp-wa-orb" aria-hidden="true"></div>
    <div class="container">
        <div class="section-head reveal-up">
            <div class="section-badge"><i class="bi bi-wallet2"></i> My Wallet</div>
            <h2>Wallet Dashboard</h2>
            <p>Manage your funds and view transactions</p>
        </div>
    </div>
</section>

<section class="fp-wa-section">
    <div class="container">
        @if(session('success'))
        <div class="fp-alert reveal-up"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="fp-wallet-balance-card reveal-left">
                    <div class="fp-wb-icon"><i class="bi bi-wallet2"></i></div>
                    <h4>Your Balance</h4>
                    <div class="fp-wb-amount">₦{{ number_format($wallet->balance ?? 0, 0) }}</div>
                    <p>Available for purchases &amp; installments</p>
                    <a href="{{ route('wallet.fund') }}" class="fp-fund-btn"><i class="bi bi-plus-circle-fill"></i> Fund Wallet</a>
                </div>

                <div class="fp-wallet-stats mt-3">
                    <div class="fp-ws-item reveal-left" style="transition-delay:0.1s;">
                        <i class="bi bi-arrow-down-circle-fill" style="color:#4ade80;"></i>
                        <div>
                            <strong>₦{{ number_format($wallet->total_credited ?? 0, 0) }}</strong>
                            <span>Total Credited</span>
                        </div>
                    </div>
                    <div class="fp-ws-item reveal-left" style="transition-delay:0.2s;">
                        <i class="bi bi-arrow-up-circle-fill" style="color:#ef4444;"></i>
                        <div>
                            <strong>₦{{ number_format($wallet->total_debited ?? 0, 0) }}</strong>
                            <span>Total Debited</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="fp-wallet-transactions reveal-right">
                    <div class="fp-wt-header">
                        <h4><i class="bi bi-clock-history"></i> Recent Transactions</h4>
                        <a href="{{ route('wallet.history') }}" class="fp-view-all">View All</a>
                    </div>
                    <div class="fp-wt-body">
                        @forelse($transactions ?? [] as $txn)
                        <div class="fp-txn-item">
                            <div class="fp-txn-icon {{ $txn->type }}">
                                <i class="bi {{ $txn->type == 'credit' ? 'bi-arrow-down-circle-fill' : 'bi-arrow-up-circle-fill' }}"></i>
                            </div>
                            <div class="fp-txn-info">
                                <strong>{{ $txn->description ?? ucfirst($txn->type) }}</strong>
                                <small>{{ $txn->created_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <div class="fp-txn-amount {{ $txn->type }}">
                                {{ $txn->type == 'credit' ? '+' : '-' }}₦{{ number_format($txn->amount, 0) }}
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4" style="color:var(--text-dim);font-size:13px;">No transactions yet</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')
@stop
@endsection
