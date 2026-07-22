@extends('frontend.app')
@section('title', 'Payment — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="fp-pay-card">
                    <div class="fp-pay-header">
                        <i class="bi bi-lock-fill"></i>
                        <h4>Secure Payment</h4>
                        <p>Complete your payment for Order #{{ $order->id }}</p>
                    </div>

                    <div class="fp-pay-summary">
                        <div class="fp-ps-row"><span>Order Amount</span><span>₦{{ number_format($order->total, 0) }}</span></div>
                        <div class="fp-ps-row"><span>Paid</span><span class="green">₦{{ number_format($order->paid_amount ?? 0, 0) }}</span></div>
                        <div class="fp-ps-divider"></div>
                        <div class="fp-ps-row fp-ps-total"><span>Due Now</span><span>₦{{ number_format(($order->remaining_balance ?? $order->total) - ($order->paid_amount ?? 0), 0) }}</span></div>
                    </div>

                    <form action="{{ route('checkout.process') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="fp-pay-methods">
                            <label class="fp-pm-option">
                                <input type="radio" name="gateway" value="paystack" checked>
                                <div class="fp-pm-content">
                                    <i class="bi bi-credit-card-fill"></i>
                                    <div><strong>Paystack</strong><small>Card, Bank, USSD</small></div>
                                </div>
                            </label>
                            <label class="fp-pm-option">
                                <input type="radio" name="gateway" value="flutterwave">
                                <div class="fp-pm-content">
                                    <i class="bi bi-globe"></i>
                                    <div><strong>Flutterwave</strong><small>Card, Bank, Mobile Money</small></div>
                                </div>
                            </label>
                            <label class="fp-pm-option">
                                <input type="radio" name="gateway" value="korapay">
                                <div class="fp-pm-content">
                                    <i class="bi bi-shield-fill-check"></i>
                                    <div><strong>Korapay</strong><small>Card, Bank Transfer, USSD</small></div>
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="fp-pay-btn mt-4">
                            <i class="bi bi-lock-fill"></i> Pay Now
                        </button>
                    </form>

                    <div class="fp-pay-secure mt-3">
                        <span><i class="bi bi-shield-fill-check"></i> SSL Encrypted</span>
                        <span><i class="bi bi-lock-fill"></i> 256-bit Secure</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-pay-card { background: var(--card-dark); border: 1px solid var(--card-border); border-radius: var(--radius-lg); padding: 32px; max-width: 500px; margin: 0 auto; }
.fp-pay-header { text-align: center; margin-bottom: 24px; }
.fp-pay-header i { font-size: 40px; color: var(--gold-500); background: rgba(234,179,8,0.1); width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; }
.fp-pay-header h4 { font-family:'Syne',sans-serif; color: var(--text-primary); font-size: 20px; font-weight: 700; }
.fp-pay-header p { color: var(--text-muted); font-size: 13px; }
.fp-pay-summary { background: var(--surface-dark); border-radius: var(--radius-sm); padding: 20px; }
.fp-ps-row { display: flex; justify-content: space-between; font-size: 14px; color: var(--text-muted); margin-bottom: 8px; }
.fp-ps-row.green { color: #4ade80; }
.fp-ps-divider { height: 1px; background: var(--card-border); margin: 12px 0; }
.fp-ps-total { font-size: 18px; font-weight: 700; color: var(--text-primary); }
.fp-ps-total span:last-child { color: var(--gold-400); }
.fp-pay-methods { display: flex; flex-direction: column; gap: 10px; }
.fp-pm-option { cursor: pointer; }
.fp-pm-option input[type="radio"] { display: none; }
.fp-pm-content { display: flex; align-items: center; gap: 14px; padding: 14px 16px; border: 2px solid var(--card-border); border-radius: var(--radius-sm); transition: all 0.2s; background: var(--surface-dark); }
.fp-pm-option input[type="radio"]:checked + .fp-pm-content { border-color: var(--gold-500); background: rgba(234,179,8,0.05); }
.fp-pm-content i { font-size: 24px; color: var(--gold-500); }
.fp-pm-content strong { display: block; color: var(--text-primary); font-size: 14px; }
.fp-pm-content small { color: var(--text-dim); font-size: 12px; }
.fp-pay-btn { width: 100%; padding: 14px; background: linear-gradient(135deg,var(--gold-500),var(--gold-600)); color: var(--near-black); border: none; border-radius: var(--radius-sm); font-size: 16px; font-weight: 700; font-family:'Syne',sans-serif; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; }
.fp-pay-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold); }
.fp-pay-secure { display: flex; justify-content: center; gap: 24px; }
.fp-pay-secure span { display: flex; align-items: center; gap: 6px; color: var(--text-dim); font-size: 12px; }
.fp-pay-secure i { color: var(--gold-500); font-size: 13px; }
</style>
@endsection