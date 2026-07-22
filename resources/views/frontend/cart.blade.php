@extends('frontend.app')
@section('title', 'Shopping Cart — FlexiPay Store')

@section('content')
<section class="fp-cart-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-cart-fill"></i> Shopping Cart</div>
            <h2>Your Cart</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        @if(isset($cart) && count($cart) > 0)
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="fp-cart-items">
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                    @php
                        $product = \App\Models\Product::with('primaryImage')->find($item['product_id']);
                        if(!$product) continue;
                        $subtotal = $product->price * ($item['quantity'] ?? 1);
                        $total += $subtotal;
                    @endphp
                    <div class="fp-cart-item">
                        <div class="fp-ci-image">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="fp-ci-no-img"><i class="bi bi-image"></i></div>
                            @endif
                        </div>
                        <div class="fp-ci-info">
                            <a href="{{ url('/product/'.$product->slug) }}" class="fp-ci-name">{{ $product->name }}</a>
                            <div class="fp-ci-price">₦{{ number_format($product->price, 0) }}</div>
                        </div>
                        <div class="fp-ci-qty">
                            <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] ?? 1 }}" min="1" class="fp-qty-input">
                                <button type="submit" class="fp-qty-btn"><i class="bi bi-check-lg"></i></button>
                            </form>
                        </div>
                        <div class="fp-ci-total">₦{{ number_format($subtotal, 0) }}</div>
                        <a href="{{ route('cart.remove', $product->id) }}" class="fp-ci-remove"><i class="bi bi-trash-fill"></i></a>
                    </div>
                    @endforeach
                </div>
                <div class="mt-3">
                    <a href="{{ route('cart.clear') }}" class="fp-btn-ghost-sm" onclick="return confirm('Clear all items?')">
                        <i class="bi bi-trash-fill"></i> Clear Cart
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="fp-cart-summary">
                    <h4>Order Summary</h4>
                    <div class="fp-cs-row">
                        <span>Subtotal</span>
                        <span>₦{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="fp-cs-row">
                        <span>Shipping</span>
                        <span style="color:var(--gold-400);">Calculated at checkout</span>
                    </div>
                    <div class="fp-cs-divider"></div>
                    <div class="fp-cs-row fp-cs-total">
                        <span>Estimated Total</span>
                        <span>₦{{ number_format($total, 0) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="fp-checkout-btn">
                        <i class="bi bi-credit-card-fill"></i> Proceed to Checkout
                    </a>
                    <a href="{{ url('/shop') }}" class="fp-continue-btn">
                        <i class="bi bi-arrow-left"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="fp-empty-cart text-center py-5">
            <i class="bi bi-cart-x" style="font-size:64px;color:var(--text-dim);display:block;margin-bottom:16px;"></i>
            <h3 style="color:var(--text-primary);font-family:'Syne',sans-serif;">Your Cart is Empty</h3>
            <p style="color:var(--text-muted);">Looks like you haven't added anything yet.</p>
            <a href="{{ url('/shop') }}" class="btn-primary-gold mt-3"><i class="bi bi-grid-fill"></i> Start Shopping</a>
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-cart-section {
    background: linear-gradient(135deg, var(--near-black), var(--surface-dark));
    padding: 60px 0;
    min-height: 100vh;
}
.fp-alert-success {
    display: flex; align-items: center; gap: 8px;
    background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
    color: #4ade80; padding: 12px 16px; border-radius: var(--radius-sm);
    font-weight: 500; font-size: 13px; margin-bottom: 24px;
}
.fp-cart-items { display: flex; flex-direction: column; gap: 12px; }
.fp-cart-item {
    display: flex; align-items: center; gap: 16px;
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius-sm); padding: 16px;
    transition: border-color 0.3s;
}
.fp-cart-item:hover { border-color: rgba(234,179,8,0.2); }
.fp-ci-image {
    width: 80px; height: 80px; border-radius: 8px;
    background: var(--dark-900); overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
}
.fp-ci-image img { width: 100%; height: 100%; object-fit: cover; }
.fp-ci-no-img { color: var(--card-border); font-size: 24px; }
.fp-ci-info { flex: 1; min-width: 0; }
.fp-ci-name { color: var(--text-primary); font-weight: 600; font-size: 14px; display: block; margin-bottom: 4px; }
.fp-ci-name:hover { color: var(--gold-400); }
.fp-ci-price { color: var(--gold-400); font-weight: 700; font-size: 15px; }
.fp-ci-qty { flex-shrink: 0; }
.fp-qty-input {
    width: 60px; padding: 6px 8px;
    background: var(--surface-dark); border: 1px solid var(--card-border);
    border-radius: 6px; color: var(--text-primary); font-size: 14px;
    text-align: center; font-family: inherit;
}
.fp-qty-btn {
    background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.2);
    color: var(--gold-400); padding: 6px 8px; border-radius: 6px;
    cursor: pointer; transition: all 0.2s;
}
.fp-qty-btn:hover { background: rgba(234,179,8,0.2); }
.fp-ci-total { font-weight: 700; color: var(--text-primary); font-size: 16px; min-width: 80px; text-align: right; }
.fp-ci-remove { color: var(--text-dim); font-size: 18px; transition: color 0.2s; padding: 4px; }
.fp-ci-remove:hover { color: #ef4444; }

.fp-btn-ghost-sm {
    color: var(--text-dim); font-size: 13px; font-weight: 500;
    padding: 8px 14px; border: 1px solid var(--card-border); border-radius: 6px;
    display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s;
}
.fp-btn-ghost-sm:hover { border-color: rgba(239,68,68,0.3); color: #ef4444; }

.fp-cart-summary {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); padding: 24px;
    position: sticky; top: 100px;
}
.fp-cart-summary h4 { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 20px; }
.fp-cs-row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; color: var(--text-muted); }
.fp-cs-total { font-size: 18px; font-weight: 700; color: var(--text-primary); }
.fp-cs-total span:last-child { color: var(--gold-400); }
.fp-cs-divider { height: 1px; background: var(--card-border); margin: 16px 0; }
.fp-checkout-btn {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 14px; margin-top: 20px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); border-radius: var(--radius-sm);
    font-weight: 700; font-size: 15px; transition: all 0.3s;
}
.fp-checkout-btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold); color: var(--near-black); }
.fp-continue-btn {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    width: 100%; padding: 12px; margin-top: 10px;
    color: var(--text-muted); border: 1px solid var(--card-border); border-radius: var(--radius-sm);
    font-size: 14px; font-weight: 500; transition: all 0.2s;
}
.fp-continue-btn:hover { border-color: var(--gold-400); color: var(--gold-400); }

@media (max-width: 768px) {
    .fp-cart-item { flex-wrap: wrap; }
    .fp-ci-total { min-width: auto; }
}
</style>
@endsection