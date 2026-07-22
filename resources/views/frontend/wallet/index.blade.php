@extends('frontend.app')
@section('title', 'My Wallet — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-wallet2"></i> My Wallet</div>
            <h2>Wallet Dashboard</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="fp-wallet-balance-card">
                    <div class="fp-wb-icon"><i class="bi bi-wallet2"></i></div>
                    <h4>Your Balance</h4>
                    <div class="fp-wb-amount">₦{{ number_format($wallet->balance ?? 0, 0) }}</div>
                    <p>Available for purchases &amp; installments</p>
                    <a href="{{ route('wallet.fund') }}" class="fp-fund-btn"><i class="bi bi-plus-circle-fill"></i> Fund Wallet</a>
                </div>

                <div class="fp-wallet-stats mt-3">
                    <div class="fp-ws-item">
                        <i class="bi bi-arrow-down-circle-fill" style="color:#4ade80;"></i>
                        <div>
                            <strong>₦{{ number_format($wallet->total_credited ?? 0, 0) }}</strong>
                            <span>Total Credited</span>
                        </div>
                    </div>
                    <div class="fp-ws-item">
                        <i class="bi bi-arrow-up-circle-fill" style="color:#ef4444;"></i>
                        <div>
                            <strong>₦{{ number_format($wallet->total_debited ?? 0, 0) }}</strong>
                            <span>Total Debited</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="fp-wallet-transactions">
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
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#4ade80;padding:12px 16px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-wallet-balance-card { background:linear-gradient(135deg,var(--gold-600),var(--gold-700));border-radius:var(--radius-lg);padding:32px;text-align:center; }
.fp-wb-icon { width:56px;height:56px;border-radius:14px;background:rgba(0,0,0,0.15);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:26px;color:rgba(0,0,0,0.6); }
.fp-wallet-balance-card h4 { font-family:'Syne',sans-serif;color:rgba(0,0,0,0.7);font-size:16px;margin-bottom:8px; }
.fp-wb-amount { font-family:'Syne',sans-serif;font-size:42px;font-weight:800;color:var(--near-black);margin-bottom:8px; }
.fp-wallet-balance-card p { color:rgba(0,0,0,0.5);font-size:13px;margin-bottom:20px; }
.fp-fund-btn { display:inline-flex;align-items:center;gap:8px;background:var(--near-black);color:var(--gold-400);padding:12px 28px;border-radius:var(--radius-sm);font-weight:700;font-size:14px;transition:all 0.3s; }
.fp-fund-btn:hover { transform:translateY(-2px);color:var(--gold-300); }
.fp-wallet-stats { display:flex;flex-direction:column;gap:8px; }
.fp-ws-item { display:flex;align-items:center;gap:12px;background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:14px 16px; }
.fp-ws-item i { font-size:24px; }
.fp-ws-item strong { display:block;color:var(--text-primary);font-size:15px; }
.fp-ws-item span { color:var(--text-dim);font-size:12px; }
.fp-wallet-transactions { background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden; }
.fp-wt-header { display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--card-border); }
.fp-wt-header h4 { font-family:'Syne',sans-serif;font-size:15px;font-weight:700;color:var(--text-primary);display:flex;align-items:center;gap:8px; }
.fp-wt-header h4 i { color:var(--gold-500); }
.fp-view-all { color:var(--gold-400);font-size:12px;font-weight:600; }
.fp-txn-item { display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid var(--card-border); }
.fp-txn-item:last-child { border-bottom:none; }
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
@endsection