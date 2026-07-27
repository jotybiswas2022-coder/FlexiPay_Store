@extends('frontend.app')
@section('title', 'FlexiPay Store — Buy Now, Pay in Installments')

@section('content')

@if(session('success'))
<div class="alert-success-custom" role="status">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert-danger-custom" role="status">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
</div>
@endif

<!-- ===== HERO ===== -->
<section class="fp-hero">
    <div class="fp-hero-bg">
        <div class="fp-hero-glow g1"></div>
        <div class="fp-hero-glow g2"></div>
    </div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="fp-hero-content">
                    <div class="fp-hero-badge">
                        <i class="bi bi-shield-fill-check"></i>
                        100% Secure — 0% Interest Installments
                    </div>
                    <h1 class="fp-hero-title">
                        Shop What You Love,<br>
                        <span class="fp-hero-highlight">Pay in Easy Pieces</span>
                    </h1>
                    <p class="fp-hero-desc">
                        Thousands of products from trusted brands. Choose weekly or monthly installments 
                        that fit your budget — no hidden fees, no surprises.
                    </p>
                    <div class="fp-hero-actions">
                        <a href="{{ url('/shop') }}" class="fp-btn-primary">
                            <i class="bi bi-grid-fill"></i> Start Shopping
                        </a>
                        <a href="{{ url('/register') }}" class="fp-btn-secondary">
                            <i class="bi bi-person-plus"></i> Create Account
                        </a>
                    </div>
                    <div class="fp-hero-search">
                        <form action="{{ url('/shop') }}" method="GET" class="fp-hs-form" role="search">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Search products, brands, categories..." aria-label="Search products" autocomplete="off">
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    <div class="fp-hero-trust">
                        <div class="fp-ht-item">
                            <i class="bi bi-people-fill"></i>
                            <strong data-count="10000">0</strong><span>+ Customers</span>
                        </div>
                        <div class="fp-ht-divider"></div>
                        <div class="fp-ht-item">
                            <i class="bi bi-box-seam-fill"></i>
                            <strong data-count="5000">0</strong><span>+ Products</span>
                        </div>
                        <div class="fp-ht-divider"></div>
                        <div class="fp-ht-item">
                            <i class="bi bi-star-fill"></i>
                            <strong>4.8</strong><span>Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TRUST BAR ===== -->
<section class="fp-trust-bar">
    <div class="container">
        <div class="fp-trust-inner">
            <div class="fp-trust-item">
                <i class="bi bi-truck"></i>
                <span>Free delivery on orders over ₦50,000</span>
            </div>
            <span class="fp-trust-dot"></span>
            <div class="fp-trust-item">
                <i class="bi bi-arrow-repeat"></i>
                <span>30-day easy exchange</span>
            </div>
            <span class="fp-trust-dot"></span>
            <div class="fp-trust-item">
                <i class="bi bi-shield-check"></i>
                <span>256-bit SSL secure payments</span>
            </div>
            <span class="fp-trust-dot"></span>
            <div class="fp-trust-item">
                <i class="bi bi-headset"></i>
                <span>24/7 customer support</span>
            </div>
            <span class="fp-trust-dot"></span>
            <div class="fp-trust-item">
                <i class="bi bi-coin"></i>
                <span>0% interest plans available</span>
            </div>
        </div>
    </div>
</section>

<!-- ===== MARQUEE ===== -->
<section class="fp-marquee-section">
    <div class="fp-marquee-track">
        <div class="fp-marquee-content">
            <span class="fp-marquee-item"><i class="bi bi-shield-fill-check"></i> 100% Secure</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-coin"></i> 0% Interest</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-truck"></i> Free Delivery</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-arrow-repeat"></i> Easy Exchange</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-headset"></i> 24/7 Support</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-clock"></i> Instant Approval</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-shield-fill-check"></i> 100% Secure</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-coin"></i> 0% Interest</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-truck"></i> Free Delivery</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-arrow-repeat"></i> Easy Exchange</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-headset"></i> 24/7 Support</span>
            <span class="fp-marquee-dot">✦</span>
            <span class="fp-marquee-item"><i class="bi bi-clock"></i> Instant Approval</span>
            <span class="fp-marquee-dot">✦</span>
        </div>
    </div>
</section>

<!-- ===== FEATURED PRODUCTS ===== -->
<section class="fp-section">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-star-fill"></i> Featured Products</span>
            <h2>Popular Items You'll Love</h2>
            <p>Top-rated products with flexible installment plans starting from 4 weeks</p>
        </div>
        <div class="row g-3">
            @forelse($featuredProducts ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-card">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-card-link">
                        <div class="fp-card-img">
                            @php $img = $product->primaryImage ?? $product->images->first(); @endphp
                            @if($img)
                                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="fp-card-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            @if($product->installment_from)
                                <span class="fp-card-badge">From ₦{{ number_format($product->installment_from, 0) }}/mo</span>
                            @endif
                            @if($product->compare_price && $product->compare_price > $product->price)
                                @php $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100); @endphp
                                @if($discount > 0)
                                    <span class="fp-card-discount">-{{ $discount }}%</span>
                                @endif
                            @endif
                        </div>
                        <div class="fp-card-body">
                            <h3>{{ Str::limit($product->name, 40) }}</h3>
                            <div class="fp-card-price">
                                <span class="fp-price-current">₦{{ number_format($product->price, 0) }}</span>
                                @if($product->compare_price)
                                    <span class="fp-price-old">₦{{ number_format($product->compare_price, 0) }}</span>
                                @endif
                            </div>
                            <div class="fp-card-meta">
                                <span><i class="bi bi-coin"></i> {{ $product->installment_plans_count ?? 'Flexible' }} plans</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty">
                    <i class="bi bi-box"></i>
                    <p>Featured products coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>
        <div class="fp-section-cta">
            <a href="{{ url('/shop') }}" class="fp-btn-primary">
                <i class="bi bi-grid-fill"></i> Browse All Products
            </a>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="fp-section fp-section-alt">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-info-circle"></i> How It Works</span>
            <h2>Three Simple Steps</h2>
            <p>Get started in minutes — no paperwork, no delays</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="fp-step">
                    <div class="fp-step-num">01</div>
                    <div class="fp-step-icon"><i class="bi bi-hand-index-thumb"></i></div>
                    <h3>Choose Product</h3>
                    <p>Browse thousands of items from trusted brands and find what you need.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fp-step fp-step-accent">
                    <div class="fp-step-num">02</div>
                    <div class="fp-step-icon"><i class="bi bi-calendar-check"></i></div>
                    <h3>Pick Your Plan</h3>
                    <p>Weekly, bi-weekly, or monthly — choose the payment schedule that works for you.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fp-step">
                    <div class="fp-step-num">03</div>
                    <div class="fp-step-icon"><i class="bi bi-truck"></i></div>
                    <h3>Get Delivered</h3>
                    <p>Pay 70% upfront and your item ships immediately. Pay the rest at your pace.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="fp-section">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-shield-check"></i> Why FlexiPay</span>
            <h2>Built for Your Convenience</h2>
            <p>Everything you need in one seamless platform</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h3>Flexible Plans</h3>
                    <p>Change your plan anytime, hassle-free</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-shield-check"></i></div>
                    <h3>Insurance</h3>
                    <p>Protect items for just 10% of the value</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-wallet2"></i></div>
                    <h3>Wallet</h3>
                    <p>Fund and earn cashback rewards</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-truck"></i></div>
                    <h3>Fast Delivery</h3>
                    <p>Track your order every step of the way</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <h3>Easy Exchanges</h3>
                    <p>Request exchanges with quick approval</p>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-headset"></i></div>
                    <h3>24/7 Support</h3>
                    <p>Always here when you need us</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="fp-stats">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <div class="fp-stat">
                    <i class="bi bi-box-seam-fill"></i>
                    <div class="fp-stat-num counter-num" data-count="5000">0</div>
                    <span>Products Available</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="fp-stat">
                    <i class="bi bi-emoji-smile-fill"></i>
                    <div class="fp-stat-num counter-num" data-count="15000">0</div>
                    <span>Happy Customers</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="fp-stat">
                    <i class="bi bi-coin"></i>
                    <div class="fp-stat-num counter-num" data-count="36">0</div>
                    <span>Payment Plans</span>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="fp-stat">
                    <i class="bi bi-building"></i>
                    <div class="fp-stat-num counter-num" data-count="100">0</div>
                    <span>Trusted Brands</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CATEGORIES ===== -->
<section class="fp-section fp-section-alt">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-grid"></i> Categories</span>
            <h2>Shop by Category</h2>
            <p>Find exactly what you're looking for</p>
        </div>
        <div class="row g-2">
            @forelse($categories ?? [] as $category)
            <div class="col-lg-3 col-md-4 col-6">
                <a href="{{ url('/shop?category_id='.$category->id) }}" class="fp-cat">
                    <i class="bi {{ ['bi-phone','bi-laptop','bi-tv','bi-watch','bi-headphones','bi-speaker','bi-camera','bi-printer','bi-joystick','bi-house-gear','bi-car-front','bi-tshirt'][$loop->index % 12] }}"></i>
                    <span>{{ $category->name }}</span>
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty">
                    <i class="bi bi-grid"></i>
                    <p>Categories coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="fp-section">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-chat-quote"></i> Testimonials</span>
            <h2>What Our Customers Say</h2>
            <p>Real stories from real people</p>
        </div>
        <div class="row g-3">
            @php
                $testimonials = [
                    ['name' => 'Amara O.', 'role' => 'Lagos', 'text' => 'I got my dream laptop without breaking the bank. The installment plan was super flexible and the process was seamless!', 'rating' => 5],
                    ['name' => 'Chidi E.', 'role' => 'Abuja', 'text' => 'Finally a platform that understands budgeting. I\'ve recommended FlexiPay to all my friends and family.', 'rating' => 5],
                    ['name' => 'Zainab K.', 'role' => 'Kano', 'text' => 'The delivery was faster than expected and setting up the payment plan took less than 5 minutes. Absolutely love it!', 'rating' => 4],
                ];
            @endphp
            @foreach($testimonials as $t)
            <div class="col-md-4">
                <div class="fp-testi">
                    <div class="fp-testi-stars">
                        @for($s = 0; $s < 5; $s++)
                            <i class="bi {{ $s < $t['rating'] ? 'bi-star-fill' : 'bi-star' }}"></i>
                        @endfor
                    </div>
                    <p>"{{ $t['text'] }}"</p>
                    <div class="fp-testi-author">
                        <div class="fp-testi-avatar">{{ substr($t['name'], 0, 1) }}</div>
                        <div>
                            <strong>{{ $t['name'] }}</strong>
                            <small>{{ $t['role'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== NEW ARRIVALS ===== -->
<section class="fp-section fp-section-alt">
    <div class="container">
        <div class="fp-section-header">
            <span class="fp-section-tag"><i class="bi bi-clock-history"></i> New Arrivals</span>
            <h2>Just Dropped</h2>
            <p>The latest additions to our catalog</p>
        </div>
        <div class="row g-3">
            @forelse($newArrivals ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-card">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-card-link">
                        <div class="fp-card-img">
                            @php $img = $product->primaryImage ?? $product->images->first(); @endphp
                            @if($img)
                                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="fp-card-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <span class="fp-card-badge fp-card-badge-new">New</span>
                        </div>
                        <div class="fp-card-body">
                            <h3>{{ Str::limit($product->name, 40) }}</h3>
                            <div class="fp-card-price">
                                <span class="fp-price-current">₦{{ number_format($product->price, 0) }}</span>
                            </div>
                            <div class="fp-card-meta">
                                <span><i class="bi bi-coin"></i> Flexible plans</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty">
                    <i class="bi bi-clock-history"></i>
                    <p>New arrivals coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="fp-cta">
    <div class="fp-cta-glow g1"></div>
    <div class="fp-cta-glow g2"></div>
    <div class="container text-center">
        <span class="fp-cta-tag"><i class="bi bi-gift-fill"></i> Limited Time</span>
        <h2 class="fp-cta-title">Ready to Start Shopping?</h2>
        <p class="fp-cta-desc">Create your free account in minutes. No credit check required, no hidden fees, cancel anytime.</p>
        <div class="fp-cta-actions">
            <a href="{{ url('/register') }}" class="fp-btn-primary">
                <i class="bi bi-person-plus"></i> Create Free Account
            </a>
            <a href="{{ url('/shop') }}" class="fp-btn-secondary">
                <i class="bi bi-grid-fill"></i> Browse Products
            </a>
        </div>
        <div class="fp-cta-features">
            <span><i class="bi bi-check-circle-fill"></i> No credit check</span>
            <span><i class="bi bi-check-circle-fill"></i> Instant approval</span>
            <span><i class="bi bi-check-circle-fill"></i> Cancel anytime</span>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<style>
/* ============================================================
   HERO — Minimal, Clean, Readable
   ============================================================ */
.fp-hero {
    background: linear-gradient(160deg, #0d0d11 0%, #16161d 40%, #0d0d11 100%);
    min-height: calc(100vh - 80px);
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    padding: 80px 0 100px;
}
.fp-hero-bg { position: absolute; inset: 0; pointer-events: none; }
.fp-hero-glow {
    position: absolute; border-radius: 50%;
    filter: blur(120px);
}
.g1 { width: 450px; height: 450px; background: rgba(234,179,8,0.06); top: -180px; right: 10%; }
.g2 { width: 350px; height: 350px; background: rgba(234,179,8,0.03); bottom: -100px; left: 5%; }

.fp-hero-content { max-width: 580px; }
.fp-hero-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(234,179,8,0.1);
    border: 1px solid rgba(234,179,8,0.15);
    color: #fbbf24;
    padding: 6px 14px; border-radius: 20px;
    font-size: 12px; font-weight: 600;
    margin-bottom: 24px;
    letter-spacing: 0.2px;
}
.fp-hero-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(34px, 5vw, 58px);
    font-weight: 800;
    color: #f4f4f5;
    line-height: 1.12;
    margin-bottom: 18px;
}
.fp-hero-highlight {
    background: linear-gradient(135deg, #fbbf24, #eab308, #ca8a04);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.fp-hero-desc {
    font-size: 16px;
    color: #a1a1aa;
    line-height: 1.75;
    margin-bottom: 28px;
    max-width: 480px;
}
.fp-hero-actions {
    display: flex; gap: 12px; flex-wrap: wrap;
    margin-bottom: 20px;
}
.fp-btn-primary, .fp-btn-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 14px 28px; border-radius: 10px;
    font-weight: 700; font-size: 15px;
    transition: all 0.25s ease;
    touch-action: manipulation;
    font-family: inherit;
}
.fp-btn-primary {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    box-shadow: 0 4px 16px rgba(234,179,8,0.15);
}
.fp-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(234,179,8,0.25);
    color: #0A0A0B;
}
.fp-btn-secondary {
    background: rgba(255,255,255,0.05);
    color: #f4f4f5;
    border: 1px solid rgba(255,255,255,0.08);
}
.fp-btn-secondary:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-2px);
    color: #f4f4f5;
}
/* Hero Search */
.fp-hero-search { margin-bottom: 24px; }
.fp-hs-form {
    display: flex; align-items: center;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    overflow: hidden;
    max-width: 480px;
    transition: border-color 0.25s, background 0.25s;
}
.fp-hs-form:focus-within {
    border-color: rgba(234,179,8,0.25);
    background: rgba(255,255,255,0.06);
}
.fp-hs-form i {
    color: #71717a;
    padding-left: 16px;
    font-size: 15px;
}
.fp-hs-form input {
    flex: 1;
    border: none; outline: none;
    background: transparent;
    color: #f4f4f5;
    padding: 12px 12px;
    font-size: 14px;
    font-family: inherit;
}
.fp-hs-form input::placeholder { color: #52525b; }
.fp-hs-form button {
    background: transparent;
    color: #a1a1aa;
    border: none;
    padding: 12px 18px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: color 0.25s;
    font-family: inherit;
    white-space: nowrap;
}
.fp-hs-form button:hover { color: #eab308; }

.fp-hero-trust {
    display: flex; align-items: center; gap: 24px;
}
.fp-ht-item {
    display: flex; align-items: center; gap: 6px;
    font-size: 14px; color: #a1a1aa;
}
.fp-ht-item i {
    color: #eab308;
    font-size: 15px;
}
.fp-ht-item strong {
    font-family: 'Syne', sans-serif;
    font-weight: 800; color: #f4f4f5; font-size: 18px;
}
.fp-ht-divider {
    width: 1px; height: 24px;
    background: rgba(255,255,255,0.08);
}

/* ============================================================
   TRUST BAR
   ============================================================ */
.fp-trust-bar {
    background: #0d0d11;
    border-top: 1px solid rgba(255,255,255,0.04);
    border-bottom: 1px solid rgba(255,255,255,0.04);
    padding: 12px 0;
}
.fp-trust-inner {
    display: flex; align-items: center; justify-content: center;
    gap: 16px; flex-wrap: wrap;
}
.fp-trust-item {
    display: flex; align-items: center; gap: 6px;
    color: #a1a1aa; font-size: 13px; font-weight: 500;
}
.fp-trust-item i { color: #eab308; font-size: 14px; }
.fp-trust-dot {
    width: 4px; height: 4px; background: rgba(234,179,8,0.3);
    border-radius: 50%;
}

/* ============================================================
   MARQUEE
   ============================================================ */
.fp-marquee-section {
    background: #0d0d11;
    padding: 14px 0;
    border-top: 1px solid rgba(255,255,255,0.04);
    border-bottom: 1px solid rgba(255,255,255,0.04);
    overflow: hidden;
}
.fp-marquee-track {
    overflow: hidden;
    mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
}
.fp-marquee-content {
    display: flex; align-items: center;
    animation: marqueeScroll 30s linear infinite;
    width: max-content;
}
.fp-marquee-item {
    display: inline-flex; align-items: center; gap: 6px;
    color: #a1a1aa; font-size: 13px; font-weight: 500;
    white-space: nowrap;
}
.fp-marquee-item i { color: #eab308; font-size: 14px; }
.fp-marquee-dot {
    color: #eab308; margin: 0 24px;
    font-size: 8px; opacity: 0.3;
}
@keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ============================================================
   SECTIONS
   ============================================================ */
.fp-section { padding: 70px 0; }
.fp-section-alt { background: #0d0d11; }
.fp-section-header {
    text-align: center; margin-bottom: 40px;
}
.fp-section-tag {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(234,179,8,0.08);
    border: 1px solid rgba(234,179,8,0.12);
    color: #fbbf24;
    padding: 5px 14px; border-radius: 20px;
    font-size: 11px; font-weight: 700; letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 12px;
}
.fp-section-header h2 {
    font-family: 'Syne', sans-serif;
    font-size: clamp(26px, 3.5vw, 36px);
    font-weight: 800; color: #f4f4f5;
    margin-bottom: 8px;
}
.fp-section-header p {
    color: #a1a1aa; font-size: 15px;
    max-width: 560px; margin: 0 auto;
}
.fp-section-cta {
    text-align: center; margin-top: 36px;
}

/* ============================================================
   PRODUCT CARDS
   ============================================================ */
.fp-card {
    background: #16161d;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.25s ease;
    height: 100%;
}
.fp-card:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.3);
}
.fp-card-link { display: block; text-decoration: none; height: 100%; }
.fp-card-img {
    position: relative; height: 200px;
    background: rgba(0,0,0,0.3);
    overflow: hidden;
    display: flex; align-items: center; justify-content: center;
}
.fp-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.fp-card:hover .fp-card-img img { transform: scale(1.08); }
.fp-card-no-img { color: rgba(255,255,255,0.06); font-size: 36px; }
.fp-card-badge {
    position: absolute; bottom: 8px; left: 8px;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B; font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.fp-card-badge-new { background: linear-gradient(135deg, #eab308, #f97316); }
.fp-card-discount {
    position: absolute; top: 8px; right: 8px;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    color: white; font-size: 11px; font-weight: 700;
    padding: 4px 8px; border-radius: 6px;
    box-shadow: 0 2px 8px rgba(220,38,38,0.2);
}
.fp-card-body { padding: 14px 14px 16px; }
.fp-card-body h3 {
    font-size: 14px; font-weight: 600; color: #f4f4f5;
    margin-bottom: 8px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; line-height: 1.4;
}
.fp-card-price { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
.fp-price-current {
    font-size: 16px; font-weight: 700; color: #eab308;
    font-family: 'Syne', sans-serif;
}
.fp-price-old { font-size: 13px; color: #71717a; text-decoration: line-through; }
.fp-card-meta { font-size: 12px; color: #71717a; display: flex; align-items: center; gap: 4px; }
.fp-card-meta i { color: #eab308; font-size: 11px; }

/* ============================================================
   HOW IT WORKS
   ============================================================ */
.fp-step {
    background: #16161d;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 32px 24px;
    text-align: center;
    height: 100%;
    transition: all 0.25s ease;
    position: relative;
}
.fp-step:hover {
    border-color: rgba(234,179,8,0.15);
    transform: translateY(-3px);
}
.fp-step-accent { border-color: rgba(234,179,8,0.08); }
.fp-step-num {
    font-family: 'Syne', sans-serif;
    font-size: 40px; font-weight: 900;
    color: rgba(234,179,8,0.06);
    line-height: 1;
    margin-bottom: 12px;
}
.fp-step-icon {
    width: 60px; height: 60px;
    background: rgba(234,179,8,0.08);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    color: #eab308; font-size: 24px;
    margin: 0 auto 16px;
    transition: all 0.3s;
}
.fp-step:hover .fp-step-icon {
    background: #eab308;
    color: #0A0A0B;
}
.fp-step h3 {
    font-family: 'Syne', sans-serif;
    font-size: 18px; font-weight: 700; color: #f4f4f5;
    margin-bottom: 8px;
}
.fp-step p { color: #a1a1aa; font-size: 14px; line-height: 1.65; margin: 0; }

/* ============================================================
   FEATURE CARDS
   ============================================================ */
.fp-fcard {
    background: #16161d;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 12px;
    padding: 22px 18px;
    transition: all 0.25s ease;
    height: 100%;
}
.fp-fcard:hover {
    border-color: rgba(234,179,8,0.12);
    transform: translateY(-2px);
}
.fp-fcard-icon {
    width: 40px; height: 40px;
    background: rgba(234,179,8,0.08);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #eab308; font-size: 17px;
    margin-bottom: 12px;
    transition: all 0.3s;
}
.fp-fcard:hover .fp-fcard-icon {
    background: #eab308;
    color: #0A0A0B;
}
.fp-fcard h3 {
    font-size: 15px; font-weight: 700; color: #f4f4f5;
    margin-bottom: 4px;
}
.fp-fcard p { color: #a1a1aa; font-size: 13px; margin: 0; line-height: 1.5; }

/* ============================================================
   STATS
   ============================================================ */
.fp-stats {
    background: linear-gradient(135deg, #5c3d0e, #0d0d11 40%, #0d0d11 100%);
    padding: 60px 0;
}
.fp-stat {
    text-align: center; padding: 28px 16px;
    background: rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.04);
    border-radius: 12px;
    backdrop-filter: blur(8px);
    transition: all 0.25s ease;
}
.fp-stat:hover {
    border-color: rgba(234,179,8,0.1);
    background: rgba(0,0,0,0.3);
}
.fp-stat i {
    font-size: 28px; color: rgba(255,255,255,0.12); display: block; margin-bottom: 8px;
}
.fp-stat:hover i { color: #eab308; }
.fp-stat-num {
    font-family: 'Syne', sans-serif;
    font-size: 32px; font-weight: 800;
    background: linear-gradient(135deg, #fbbf24, #eab308);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}
.fp-stat span {
    display: block; font-size: 14px; color: rgba(255,255,255,0.5); font-weight: 500;
    margin-top: 4px;
}

/* ============================================================
   CATEGORIES
   ============================================================ */
.fp-cat {
    display: flex; align-items: center; gap: 10px;
    background: #16161d;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 10px;
    padding: 14px 16px;
    text-decoration: none;
    transition: all 0.25s ease;
    height: 100%;
}
.fp-cat:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateX(4px);
}
.fp-cat i:first-child {
    font-size: 18px; color: #eab308;
    width: 24px; text-align: center;
}
.fp-cat span {
    flex: 1; font-size: 14px; font-weight: 600; color: #f4f4f5;
}
.fp-cat i:last-child {
    font-size: 12px; color: rgba(255,255,255,0.15);
    transition: all 0.25s;
}
.fp-cat:hover i:last-child { color: #eab308; transform: translateX(3px); }

/* ============================================================
   TESTIMONIALS
   ============================================================ */
.fp-testi {
    background: #16161d;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 12px;
    padding: 24px 20px;
    height: 100%;
    display: flex; flex-direction: column;
    transition: all 0.25s ease;
}
.fp-testi:hover {
    border-color: rgba(234,179,8,0.1);
    transform: translateY(-2px);
}
.fp-testi-stars { color: #eab308; font-size: 13px; margin-bottom: 12px; letter-spacing: 1px; }
.fp-testi p {
    color: #a1a1aa; font-size: 14px; line-height: 1.7;
    flex: 1; font-style: italic;
}
.fp-testi-author {
    display: flex; align-items: center; gap: 10px;
    margin-top: 16px; padding-top: 14px;
    border-top: 1px solid rgba(255,255,255,0.06);
}
.fp-testi-avatar {
    width: 36px; height: 36px; border-radius: 10px;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 14px;
    flex-shrink: 0;
}
.fp-testi-author strong { display: block; font-size: 14px; color: #f4f4f5; }
.fp-testi-author small { font-size: 12px; color: #71717a; }

/* ============================================================
   EMPTY STATE
   ============================================================ */
.fp-empty {
    text-align: center; padding: 50px 20px;
}
.fp-empty i {
    font-size: 40px; color: rgba(255,255,255,0.08);
    display: block; margin-bottom: 12px;
}
.fp-empty p { color: #71717a; font-size: 14px; margin: 0; }

/* ============================================================
   CTA
   ============================================================ */
.fp-cta {
    padding: 80px 0;
    background: linear-gradient(160deg, #0d0d11 0%, #1a1a1e 50%, #0d0d11 100%);
    position: relative; overflow: hidden;
}
.fp-cta-glow {
    position: absolute; border-radius: 50%; filter: blur(100px);
    pointer-events: none;
}
.fp-cta .g1 { width: 350px; height: 350px; background: rgba(234,179,8,0.05); top: -100px; left: 10%; }
.fp-cta .g2 { width: 250px; height: 250px; background: rgba(234,179,8,0.03); bottom: -80px; right: 20%; }

.fp-cta-tag {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(234,179,8,0.08);
    border: 1px solid rgba(234,179,8,0.12);
    color: #fbbf24;
    padding: 5px 14px; border-radius: 20px;
    font-size: 11px; font-weight: 700; letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 16px;
}
.fp-cta-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(28px, 4vw, 42px);
    font-weight: 800; color: #f4f4f5;
    margin-bottom: 12px;
}
.fp-cta-desc {
    color: #a1a1aa; font-size: 15px;
    max-width: 500px; margin: 0 auto 28px;
    line-height: 1.7;
}
.fp-cta-actions {
    display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;
    margin-bottom: 24px;
}
.fp-cta-features {
    display: flex; gap: 24px; justify-content: center; flex-wrap: wrap;
}
.fp-cta-features span {
    display: flex; align-items: center; gap: 6px;
    color: #71717a; font-size: 14px;
}
.fp-cta-features i {
    color: #22c55e; font-size: 15px;
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 991px) {
    .fp-hero { min-height: auto; padding: 50px 0 70px; text-align: center; }
    .fp-hero-content { max-width: 100%; }
    .fp-hero-actions { justify-content: center; }
    .fp-hero-search { display: flex; justify-content: center; }
    .fp-hs-form { width: 100%; max-width: 440px; }
    .fp-hero-trust { justify-content: center; }
    .fp-hero-desc { margin-left: auto; margin-right: auto; max-width: 100%; }
    .fp-section { padding: 50px 0; }
    .fp-card-img { height: 180px; }
}
@media (max-width: 768px) {
    .fp-hero { padding: 35px 0 50px; }
    .fp-hero-title { font-size: 26px; }
    .fp-hero-desc { font-size: 14px; margin-bottom: 20px; }
    .fp-hero-badge { font-size: 11px; padding: 5px 12px; }
    .fp-hero-actions { flex-direction: column; gap: 10px; }
    .fp-hero-actions .fp-btn-primary,
    .fp-hero-actions .fp-btn-secondary { width: 100%; justify-content: center; }
    .fp-hero-search { margin-bottom: 18px; }
    .fp-hs-form input { padding: 10px 10px; font-size: 13px; }
    .fp-hs-form button { padding: 10px 14px; font-size: 12px; }
    .fp-hero-trust { gap: 12px; justify-content: center; }
    .fp-ht-item { font-size: 12px; }
    .fp-ht-item strong { font-size: 15px; }
    .fp-card-img { height: 150px; }
    .fp-section-header { margin-bottom: 24px; }
    .fp-section-header h2 { font-size: 22px; }
    .fp-section { padding: 40px 0; }
    .fp-stats { padding: 35px 0; }
    .fp-stat { padding: 20px 12px; }
    .fp-stat-num { font-size: 24px; }
    .fp-stat i { font-size: 24px; }
    .fp-cta { padding: 45px 0; }
    .fp-cta-title { font-size: 24px; }
    .fp-cta-desc { font-size: 14px; margin-bottom: 20px; }
    .fp-cta-actions { flex-direction: column; gap: 10px; }
    .fp-cta-actions .fp-btn-primary,
    .fp-cta-actions .fp-btn-secondary { width: 100%; justify-content: center; }
    .fp-cta-features { gap: 10px; flex-direction: column; align-items: center; }
    .fp-trust-inner { gap: 8px; flex-direction: column; align-items: center; }
    .fp-trust-item { font-size: 12px; }
    .fp-trust-dot { display: none; }
    .fp-marquee-item { font-size: 12px; }
    .fp-marquee-dot { margin: 0 16px; }
    .fp-step { padding: 24px 16px; }
    .fp-step h3 { font-size: 16px; }
    .fp-step p { font-size: 13px; }
    .fp-step-icon { width: 50px; height: 50px; font-size: 20px; }
    .fp-fcard { padding: 16px 14px; }
    .fp-fcard h3 { font-size: 14px; }
    .fp-fcard p { font-size: 12px; }
    .fp-cat { padding: 12px 14px; }
    .fp-cat span { font-size: 13px; }
    .fp-testi { padding: 20px 16px; }
    .fp-testi p { font-size: 13px; }
    .fp-testi-stars { font-size: 12px; }
    .fp-empty { padding: 40px 16px; }
    .fp-empty i { font-size: 32px; }
}
@media (max-width: 576px) {
    .fp-hero { padding: 30px 0 40px; }
    .fp-hero-title { font-size: 22px; }
    .fp-hero-desc { font-size: 13px; margin-bottom: 16px; }
    .fp-hero-badge { font-size: 10px; padding: 4px 10px; margin-bottom: 16px; }
    .fp-hero-actions { gap: 8px; margin-bottom: 16px; }
    .fp-hero-actions .fp-btn-primary,
    .fp-hero-actions .fp-btn-secondary { padding: 12px 20px; font-size: 14px; }
    .fp-hero-search { margin-bottom: 14px; }
    .fp-hs-form { border-radius: 10px; }
    .fp-hs-form i { font-size: 13px; padding-left: 12px; }
    .fp-hs-form input { padding: 10px 8px; font-size: 13px; }
    .fp-hs-form button { padding: 10px 14px; font-size: 12px; }
    .fp-ht-item { font-size: 11px; }
    .fp-ht-item strong { font-size: 14px; }
    .fp-ht-item i { font-size: 13px; }
    .fp-ht-divider { height: 18px; }
    .fp-card-img { height: 130px; }
    .fp-card-body { padding: 10px 12px 14px; }
    .fp-card-body h3 { font-size: 13px; margin-bottom: 6px; }
    .fp-price-current { font-size: 14px; }
    .fp-price-old { font-size: 12px; }
    .fp-card-meta { font-size: 11px; }
    .fp-card-badge { font-size: 10px; padding: 3px 8px; }
    .fp-card-discount { font-size: 10px; padding: 3px 6px; }
    .fp-section { padding: 35px 0; }
    .fp-section-header { margin-bottom: 20px; }
    .fp-section-header h2 { font-size: 20px; }
    .fp-section-header p { font-size: 13px; }
    .fp-section-tag { font-size: 10px; padding: 4px 10px; }
    .fp-stats { padding: 30px 0; }
    .fp-stat { padding: 18px 10px; }
    .fp-stat-num { font-size: 22px; }
    .fp-stat span { font-size: 12px; }
    .fp-stat i { font-size: 22px; }
    .fp-cta { padding: 35px 0; }
    .fp-cta-title { font-size: 22px; }
    .fp-cta-desc { font-size: 13px; margin-bottom: 18px; max-width: 100%; }
    .fp-cta-tag { font-size: 10px; padding: 4px 10px; }
    .fp-cta-actions { gap: 8px; margin-bottom: 18px; }
    .fp-cta-actions .fp-btn-primary,
    .fp-cta-actions .fp-btn-secondary { padding: 12px 20px; font-size: 14px; }
    .fp-cta-features span { font-size: 13px; }
    .fp-cta-features i { font-size: 14px; }
    .fp-step { padding: 20px 14px; }
    .fp-step h3 { font-size: 15px; }
    .fp-step p { font-size: 13px; }
    .fp-step-icon { width: 46px; height: 46px; font-size: 18px; margin-bottom: 12px; }
    .fp-step-num { font-size: 32px; }
    .fp-fcard { padding: 14px 12px; }
    .fp-fcard-icon { width: 36px; height: 36px; font-size: 15px; margin-bottom: 8px; }
    .fp-fcard h3 { font-size: 13px; }
    .fp-fcard p { font-size: 12px; }
    .fp-cat { padding: 10px 12px; }
    .fp-cat i:first-child { font-size: 16px; width: 20px; }
    .fp-cat span { font-size: 13px; }
    .fp-testi { padding: 18px 14px; }
    .fp-testi p { font-size: 13px; }
    .fp-testi-stars { font-size: 11px; }
    .fp-testi-author strong { font-size: 13px; }
    .fp-testi-author small { font-size: 11px; }
    .fp-testi-avatar { width: 32px; height: 32px; font-size: 12px; }
    .fp-empty { padding: 30px 16px; }
    .fp-empty i { font-size: 28px; }
    .fp-empty p { font-size: 13px; }
}

/* === Very small screens (under 400px) === */
@media (max-width: 400px) {
    .fp-hero { padding: 24px 0 34px; }
    .fp-hero-title { font-size: 20px; }
    .fp-hero-desc { font-size: 12px; }
    .fp-hero-badge { font-size: 9px; padding: 3px 8px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100%; }
    .fp-hero-actions .fp-btn-primary,
    .fp-hero-actions .fp-btn-secondary { padding: 10px 16px; font-size: 13px; }
    .fp-hs-form input { font-size: 12px; }
    .fp-hs-form button { font-size: 11px; padding: 8px 10px; }
    .fp-ht-item strong { font-size: 13px; }
    .fp-ht-item { font-size: 10px; }
    .fp-card-img { height: 110px; }
    .fp-card-body h3 { font-size: 12px; }
    .fp-price-current { font-size: 13px; }
    .fp-section-header h2 { font-size: 18px; }
    .fp-stat-num { font-size: 20px; }
    .container { padding-left: 12px; padding-right: 12px; }
}

/* === Counter animation helpers (re-use app.blade.js) === */
[data-count] { display: inline-block; }
</style>



@endsection
