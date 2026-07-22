@extends('frontend.app')
@section('title', 'Order Confirmed — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="fp-confirm-card">
                    <div class="fp-confirm-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2>Order Confirmed!</h2>
                    <p style="color:var(--text-muted);">Thank you for your purchase. Your order has been placed successfully.</p>
                    <div class="fp-confirm-details">
                        <div><span>Order ID</span><strong>#{{ $order->id }}</strong></div>
                        <div><span>Total</span><strong style="color:var(--gold-400);">₦{{ number_format($order->total, 0) }}</strong></div>
                        <div><span>Status</span><strong style="color:#4ade80;">{{ ucfirst($order->status) }}</strong></div>
                    </div>
                    <div class="fp-confirm-actions">
                        <a href="{{ route('orders.show', $order) }}" class="btn-primary-gold"><i class="bi bi-eye-fill"></i> View Order</a>
                        <a href="{{ url('/shop') }}" class="fp-btn-ghost mt-2"><i class="bi bi-grid-fill"></i> Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 80px 0; min-height: 100vh; }
.fp-confirm-card { background: var(--card-dark); border: 1px solid var(--card-border); border-radius: var(--radius-lg); padding: 48px 32px; animation: fadeUp 0.5s ease both; }
.fp-confirm-icon { width: 80px; height: 80px; border-radius: 50%; background: rgba(34,197,94,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 40px; color: #4ade80; animation: scaleIn 0.5s cubic-bezier(.34,1.56,.64,1); }
@keyframes scaleIn { from {transform:scale(0);} to {transform:scale(1);} }
.fp-confirm-card h2 { font-family:'Syne',sans-serif; color: var(--text-primary); font-size: 28px; font-weight: 800; margin-bottom: 8px; }
.fp-confirm-details { background: var(--surface-dark); border-radius: var(--radius-sm); padding: 20px; margin: 24px 0; }
.fp-confirm-details div { display: flex; justify-content: space-between; padding: 8px 0; }
.fp-confirm-details div span { color: var(--text-muted); font-size: 14px; }
.fp-confirm-details div strong { color: var(--text-primary); font-size: 14px; }
.fp-btn-ghost { display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:var(--radius-sm);font-weight:600;font-size:14px;border:1px solid var(--card-border);color:var(--text-muted);transition:all 0.2s; }
.fp-btn-ghost:hover { border-color:var(--gold-400);color:var(--gold-400); }
</style>
@endsection