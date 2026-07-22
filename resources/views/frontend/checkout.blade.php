@extends('frontend.app')
@section('title', 'Checkout — FlexiPay Store')

@section('content')
<section style="background:var(--near-black);padding:60px 0;min-height:100vh;">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-credit-card-fill"></i> Checkout</div>
            <h2>Complete Your Purchase</h2>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:32px;text-align:center;">
                    <i class="bi bi-credit-card" style="font-size:64px;color:var(--gold-500);display:block;margin-bottom:16px;"></i>
                    <h4 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:8px;">Checkout Page</h4>
                    <p style="color:var(--text-muted);">Your checkout details and payment options will appear here once you've added items to your cart.</p>
                    <a href="{{ url('/cart') }}" class="btn-primary-gold mt-3"><i class="bi bi-cart-fill"></i> View Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
@endsection