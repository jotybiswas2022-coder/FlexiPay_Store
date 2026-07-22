@extends('frontend.app')
@section('title', $product->name . ' — FlexiPay Store')

@section('content')
<section class="fp-product-section">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="fp-breadcrumb">
            <a href="{{ url('/') }}">Home</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ url('/shop') }}">Shop</a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ url('/shop?category_id='.$product->category_id) }}">{{ $product->category?->name }}</a>
            <i class="bi bi-chevron-right"></i>
            <span>{{ Str::limit($product->name, 30) }}</span>
        </nav>

        <div class="row g-5 mt-2">
            <!-- Images -->
            <div class="col-lg-6">
                <div class="fp-product-gallery">
                    <div class="fp-main-image">
                        @if($product->primaryImage)
                            <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}" id="mainProductImg">
                        @else
                            <div class="fp-no-image"><i class="bi bi-image"></i></div>
                        @endif
                        @if($product->installment_from)
                            <div class="fp-image-badge">From ₦{{ number_format($product->installment_from, 0) }}/mo</div>
                        @endif
                    </div>
                    @if($product->images && $product->images->count() > 1)
                    <div class="fp-thumbnails">
                        @foreach($product->images as $img)
                        <div class="fp-thumb {{ $img->is_primary ? 'active' : '' }}" onclick="changeImage(this, '{{ asset('storage/'.$img->image_path) }}')">
                            <img src="{{ asset('storage/'.$img->image_path) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <!-- Info -->
            <div class="col-lg-6">
                <div class="fp-product-info">
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <span class="fp-brand-tag">{{ $product->brand?->name ?? 'FlexiPay' }}</span>
                        @if($product->category)
                            <span class="fp-category-tag">{{ $product->category->name }}</span>
                        @endif
                    </div>

                    <h1 class="fp-product-title">{{ $product->name }}</h1>

                    <div class="fp-product-rating mb-3">
                        @php $avgRating = $product->reviews->avg('rating') ?? 0; @endphp
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}" style="color:var(--gold-500);"></i>
                        @endfor
                        <span>({{ $product->reviews->count() }} reviews)</span>
                    </div>

                    <div class="fp-price-box">
                        <div class="fp-main-price">₦{{ number_format($product->price, 0) }}</div>
                        @if($product->compare_price)
                            <div class="fp-compare-price">₦{{ number_format($product->compare_price, 0) }}</div>
                            <div class="fp-discount-badge">
                                -{{ round((1 - $product->price / $product->compare_price) * 100) }}%
                            </div>
                        @endif
                    </div>

                    @if($product->installment_plans && $product->installment_plans->count() > 0)
                    <div class="fp-plan-pills">
                        <div class="fp-plan-label"><i class="bi bi-coin"></i> Available Payment Plans:</div>
                        <div class="d-flex gap-2 flex-wrap">
                            @foreach($product->installment_plans->take(4) as $plan)
                                <span class="fp-plan-pill">{{ $plan->duration }} {{ $plan->duration_unit }}</span>
                            @endforeach
                            @if($product->installment_plans->count() > 4)
                                <span class="fp-plan-pill">+{{ $product->installment_plans->count() - 4 }} more</span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <p class="fp-product-desc mt-3">{{ Str::limit($product->description, 300) }}</p>

                    <div class="fp-product-actions mt-4">
                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn-primary-gold btn-lg">
                                <i class="bi bi-cart-plus-fill"></i> Add to Cart
                            </button>
                        </form>

                        @auth
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="fp-wishlist-btn {{ $inWishlist ? 'active' : '' }}">
                                <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                            </button>
                        </form>
                        @endauth
                    </div>

                    <div class="fp-product-trust mt-4">
                        <span><i class="bi bi-shield-fill-check"></i> Secure checkout</span>
                        <span><i class="bi bi-arrow-repeat"></i> Flexible installments</span>
                        <span><i class="bi bi-truck-front-fill"></i> Free delivery*</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="fp-product-tabs mt-5">
            <ul class="nav nav-tabs fp-tabs" id="productTabs">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#description">Description</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#plans">Payment Plans</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#reviews">Reviews ({{ $product->reviews->count() }})</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="description">
                    <div class="fp-tab-content">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="plans">
                    <div class="fp-tab-content">
                        <h5>Available Installment Plans</h5>
                        @if($product->installment_plans && $product->installment_plans->count() > 0)
                        <div class="table-responsive mt-3">
                            <table class="fp-plan-table">
                                <thead>
                                    <tr>
                                        <th>Duration</th>
                                        <th>Interest Rate</th>
                                        <th>Monthly Payment</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->installment_plans as $plan)
                                    @php
                                        $totalInterest = $product->price * ($plan->interest_rate / 100);
                                        $totalPayment = $product->price + $totalInterest;
                                        $installmentAmount = $totalPayment / $plan->duration;
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $plan->duration }} {{ $plan->duration_unit }}</strong></td>
                                        <td>{{ $plan->interest_rate }}%</td>
                                        <td>₦{{ number_format($installmentAmount, 0) }}</td>
                                        <td>₦{{ number_format($totalPayment, 0) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p style="color:var(--text-muted);">Payment plans will be available at checkout.</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews">
                    <div class="fp-tab-content">
                        @forelse($product->reviews as $review)
                        <div class="fp-review-item">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <div class="fp-review-avatar">{{ substr($review->user?->name ?? 'A', 0, 1) }}</div>
                                <div>
                                    <strong style="color:var(--text-primary);">{{ $review->user?->name ?? 'Anonymous' }}</strong>
                                    <div style="color:var(--gold-500);font-size:12px;">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <small style="color:var(--text-dim);margin-left:auto;">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            <p style="color:var(--text-muted);">{{ $review->comment }}</p>
                        </div>
                        @empty
                        <p style="color:var(--text-muted);">No reviews yet. Be the first to review!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts && $relatedProducts->count() > 0)
        <section class="mt-5">
            <div class="section-head" style="text-align:left;">
                <div class="section-badge"><i class="bi bi-link-45deg"></i> Related Products</div>
                <h2>You Might Also Like</h2>
            </div>
            <div class="row g-4">
                @foreach($relatedProducts as $rp)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="fp-product-card">
                        <a href="{{ url('/product/'.$rp->slug) }}" class="fp-product-link">
                            <div class="fp-product-img-wrap">
                                @if($rp->primaryImage)
                                    <img src="{{ asset('storage/'.$rp->primaryImage->image_path) }}" alt="{{ $rp->name }}">
                                @else
                                    <div class="fp-product-no-img"><i class="bi bi-image"></i></div>
                                @endif
                            </div>
                            <div class="fp-product-body">
                                <h6>{{ Str::limit($rp->name, 40) }}</h6>
                                <div class="fp-product-price">
                                    <span class="fp-current-price">₦{{ number_format($rp->price, 0) }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-product-section {
    background: var(--near-black);
    padding: 40px 0 60px;
    min-height: 100vh;
}
.fp-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: var(--text-dim); flex-wrap: wrap;
    margin-bottom: 32px;
}
.fp-breadcrumb a { color: var(--gold-400); transition: color 0.2s; }
.fp-breadcrumb a:hover { color: var(--gold-300); }
.fp-breadcrumb i { font-size: 12px; color: var(--card-border); }
.fp-breadcrumb span { color: var(--text-muted); }

/* Gallery */
.fp-product-gallery { position: sticky; top: 100px; }
.fp-main-image {
    position: relative;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-lg);
    overflow: hidden; height: 420px;
    display: flex; align-items: center; justify-content: center;
}
.fp-main-image img { width: 100%; height: 100%; object-fit: contain; }
.fp-no-image { color: var(--card-border); font-size: 64px; }
.fp-image-badge {
    position: absolute; bottom: 16px; left: 16px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black);
    padding: 8px 16px; border-radius: 8px;
    font-weight: 700; font-size: 14px;
}
.fp-thumbnails {
    display: flex; gap: 8px; margin-top: 12px;
}
.fp-thumb {
    width: 72px; height: 72px; border-radius: 8px;
    border: 2px solid var(--card-border); overflow: hidden;
    cursor: pointer; transition: all 0.2s;
    background: var(--card-dark);
}
.fp-thumb img { width: 100%; height: 100%; object-fit: cover; }
.fp-thumb.active, .fp-thumb:hover { border-color: var(--gold-500); }

/* Info */
.fp-product-info {}
.fp-brand-tag {
    background: rgba(234,179,8,0.1); color: var(--gold-400);
    padding: 4px 10px; border-radius: 6px;
    font-size: 12px; font-weight: 600;
}
.fp-category-tag {
    background: var(--card-dark); color: var(--text-muted);
    border: 1px solid var(--card-border);
    padding: 4px 10px; border-radius: 6px;
    font-size: 12px; font-weight: 600;
}
.fp-product-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(24px, 3vw, 32px);
    font-weight: 800; color: var(--text-primary);
    margin-bottom: 12px; line-height: 1.2;
}
.fp-product-rating { font-size: 14px; }
.fp-product-rating span { color: var(--text-dim); margin-left: 6px; }

.fp-price-box {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 20px;
}
.fp-main-price {
    font-family: 'Syne', sans-serif;
    font-size: 32px; font-weight: 800; color: var(--gold-400);
}
.fp-compare-price {
    font-size: 20px; color: var(--text-dim); text-decoration: line-through;
}
.fp-discount-badge {
    background: #ef4444; color: white;
    padding: 4px 10px; border-radius: 6px;
    font-size: 12px; font-weight: 700;
}

.fp-plan-pills {
    background: rgba(234,179,8,0.04);
    border: 1px solid rgba(234,179,8,0.15);
    border-radius: var(--radius-sm); padding: 16px;
    margin-bottom: 16px;
}
.fp-plan-label { font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
.fp-plan-label i { color: var(--gold-500); }
.fp-plan-pill {
    background: var(--card-dark); border: 1px solid var(--card-border);
    color: var(--text-muted); padding: 6px 14px; border-radius: 99px;
    font-size: 12px; font-weight: 500;
}

.fp-product-desc { color: var(--text-muted); font-size: 15px; line-height: 1.7; }

.fp-product-actions { display: flex; align-items: center; gap: 12px; }
.fp-wishlist-btn {
    width: 50px; height: 50px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    background: var(--card-dark); border: 1px solid var(--card-border);
    color: var(--text-dim); font-size: 20px; cursor: pointer;
    transition: all 0.3s;
}
.fp-wishlist-btn:hover { border-color: rgba(239,68,68,0.3); color: #ef4444; }
.fp-wishlist-btn.active { background: rgba(239,68,68,0.1); color: #ef4444; border-color: rgba(239,68,68,0.3); }

.fp-product-trust {
    display: flex; gap: 16px; flex-wrap: wrap;
    padding: 16px 0; border-top: 1px solid var(--card-border);
}
.fp-product-trust span {
    display: flex; align-items: center; gap: 6px;
    font-size: 13px; color: var(--text-muted);
}
.fp-product-trust i { color: var(--gold-500); }

/* Tabs */
.fp-tabs { border-bottom-color: var(--card-border); }
.fp-tabs .nav-link {
    color: var(--text-muted); border: none;
    padding: 12px 20px; font-weight: 600; font-size: 14px;
}
.fp-tabs .nav-link.active {
    color: var(--gold-500); background: transparent;
    border-bottom: 2px solid var(--gold-500);
}
.fp-tab-content { padding: 24px 0; color: var(--text-muted); line-height: 1.8; }

.fp-plan-table { width: 100%; border-collapse: collapse; }
.fp-plan-table th, .fp-plan-table td {
    padding: 12px 16px; text-align: left;
    border-bottom: 1px solid var(--card-border);
}
.fp-plan-table th { color: var(--text-primary); font-weight: 600; font-size: 13px; }
.fp-plan-table td { color: var(--text-muted); font-size: 14px; }
.fp-plan-table tr:hover td { background: rgba(234,179,8,0.03); }

.fp-review-item {
    padding: 20px; border-bottom: 1px solid var(--card-border);
}
.fp-review-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--gold-500); color: var(--near-black);
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 16px;
}

@media (max-width: 991px) {
    .fp-main-image { height: 300px; }
    .fp-product-gallery { position: static; }
}
</style>

<script>
function changeImage(el, src) {
    document.getElementById('mainProductImg').src = src;
    document.querySelectorAll('.fp-thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
}
</script>
@endsection