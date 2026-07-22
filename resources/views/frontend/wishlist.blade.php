@extends('frontend.app')
@section('title', 'My Wishlist — FlexiPay Store')

@section('content')
<section class="fp-wishlist-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-heart-fill"></i> My Wishlist</div>
            <h2>Saved Items</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        @if(isset($wishlist) && $wishlist->count() > 0)
        <div class="row g-4">
            @foreach($wishlist as $item)
            @php $product = $item->product; @endphp
            @if($product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-wl-card">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-wl-link">
                        <div class="fp-wl-img-wrap">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="fp-wl-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <form action="{{ route('wishlist.toggle') }}" method="POST" class="fp-wl-remove-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="fp-wl-remove"><i class="bi bi-x-lg"></i></button>
                            </form>
                        </div>
                        <div class="fp-wl-body">
                            <h6>{{ Str::limit($product->name, 40) }}</h6>
                            <div class="fp-wl-price">₦{{ number_format($product->price, 0) }}</div>
                        </div>
                    </a>
                    <div class="fp-wl-footer">
                        <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="fp-wl-cart-btn"><i class="bi bi-cart-plus-fill"></i> Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="fp-empty text-center py-5">
            <i class="bi bi-heartbreak-fill" style="font-size:64px;color:var(--text-dim);display:block;margin-bottom:16px;"></i>
            <h3 style="color:var(--text-primary);font-family:'Syne',sans-serif;">Your Wishlist is Empty</h3>
            <p style="color:var(--text-muted);">Save items you love to your wishlist!</p>
            <a href="{{ url('/shop') }}" class="btn-primary-gold mt-3"><i class="bi bi-grid-fill"></i> Browse Products</a>
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-wishlist-section {
    background: linear-gradient(135deg, var(--near-black), var(--surface-dark));
    padding: 60px 0; min-height: 100vh;
}
.fp-alert {
    display: flex; align-items: center; gap: 8px;
    background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25);
    color: #4ade80; padding: 12px 16px; border-radius: var(--radius-sm);
    font-weight: 500; font-size: 13px; margin-bottom: 24px;
}
.fp-wl-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); overflow: hidden;
    transition: all 0.3s; height: 100%;
}
.fp-wl-card:hover { border-color: rgba(234,179,8,0.25); transform: translateY(-4px); box-shadow: 0 8px 32px rgba(0,0,0,0.3); }
.fp-wl-link { display: block; text-decoration: none; }
.fp-wl-img-wrap {
    position: relative; height: 180px;
    background: var(--dark-900); display: flex; align-items: center; justify-content: center; overflow: hidden;
}
.fp-wl-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
.fp-wl-no-img { color: var(--card-border); font-size: 32px; }
.fp-wl-remove-form { position: absolute; top: 8px; right: 8px; }
.fp-wl-remove {
    width: 32px; height: 32px; border-radius: 50%;
    background: rgba(0,0,0,0.5); border: none; color: white;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.2s; font-size: 12px;
}
.fp-wl-remove:hover { background: #ef4444; }
.fp-wl-body { padding: 14px 16px; }
.fp-wl-body h6 { color: var(--text-primary); font-size: 14px; font-weight: 600; margin-bottom: 6px; }
.fp-wl-price { color: var(--gold-400); font-weight: 700; font-size: 16px; }
.fp-wl-footer { padding: 0 16px 14px; }
.fp-wl-cart-btn {
    width: 100%; padding: 10px;
    background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.2);
    color: var(--gold-400); border-radius: var(--radius-sm);
    font-size: 13px; font-weight: 600; cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 6px;
    transition: all 0.2s; font-family: inherit;
}
.fp-wl-cart-btn:hover { background: var(--gold-500); color: var(--near-black); border-color: var(--gold-500); }
</style>
@endsection