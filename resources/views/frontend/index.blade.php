@extends('frontend.app')
@section('title', 'FlexiPay Store — Buy Now, Pay in Installments')

@section('content')

@if(session('success'))
<div class="alert-success-custom">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert-danger-custom">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
</div>
@endif

<!-- ===== HERO SECTION ===== -->
<section class="fp-hero" id="fpHero">
    <div id="particles-canvas" aria-hidden="true"></div>
    <div class="fp-hero-bg">
        <div class="fp-grid-lines"></div>
        <div class="fp-glow-orb orbl" aria-hidden="true"></div>
        <div class="fp-glow-orb orb2" aria-hidden="true"></div>
        <div class="fp-glow-orb orb3" aria-hidden="true"></div>
        <div class="fp-float-icon" style="top:12%;left:6%;animation-delay:0s;"><i class="bi bi-phone-fill"></i></div>
        <div class="fp-float-icon" style="top:30%;right:8%;animation-delay:1.2s;"><i class="bi bi-laptop-fill"></i></div>
        <div class="fp-float-icon" style="top:55%;left:4%;animation-delay:2.1s;"><i class="bi bi-watch-fill"></i></div>
        <div class="fp-float-icon" style="top:70%;right:6%;animation-delay:0.8s;"><i class="bi bi-tv-fill"></i></div>
        <div class="fp-float-icon" style="top:45%;left:14%;animation-delay:1.8s;"><i class="bi bi-speaker-fill"></i></div>
        <div class="fp-float-icon" style="top:50%;right:16%;animation-delay:3s;"><i class="bi bi-headphones"></i></div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="fp-hero-badge">
                    <span class="fp-live-dot"></span>
                    <i class="bi bi-lightning-charge-fill"></i> Flexible Payment Plans Available
                </div>

                <h1 class="fp-hero-title">
                    <span class="fp-hero-line">Shop What You Love,</span><br>
                    <span class="fp-highlight-wrap">
                        <span class="fp-highlight">Pay in Installments</span>
                    </span>
                </h1>

                <p class="fp-hero-desc">
                    Choose from thousands of products and pay over time with flexible weekly or monthly plans.
                    No hidden fees, zero stress — just easy payments that fit your budget.
                </p>

                <div class="fp-hero-search">
                    <form action="{{ url('/shop') }}" method="GET" class="fp-hero-search-box">
                        <div class="fp-hs-field">
                            <i class="bi bi-search"></i>
                            <input type="text" name="search" placeholder="Search for products, brands, categories..." required>
                        </div>
                        <div class="fp-hs-divider"></div>
                        <button type="submit" class="fp-hs-btn">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                    <div class="fp-hero-tags">
                        <span class="fp-tag-label"><i class="bi bi-lightning-charge-fill"></i> Popular:</span>
                        <span class="fp-quick-tag" onclick="quickSearch('iPhone')">iPhone</span>
                        <span class="fp-quick-tag" onclick="quickSearch('Laptop')">Laptop</span>
                        <span class="fp-quick-tag" onclick="quickSearch('Sneakers')">Sneakers</span>
                        <span class="fp-quick-tag" onclick="quickSearch('TV')">Smart TV</span>
                    </div>
                </div>

                <div class="fp-hero-stats">
                    <div class="fp-stat-item">
                        <strong class="fp-stat-num fp-hero-stat-num" data-count="5000">0</strong>
                        <span>+ Products</span>
                    </div>
                    <div class="fp-stat-divider"></div>
                    <div class="fp-stat-item">
                        <strong class="fp-stat-num fp-hero-stat-num" data-count="15000">0</strong>
                        <span>+ Happy Customers</span>
                    </div>
                    <div class="fp-stat-divider"></div>
                    <div class="fp-stat-item">
                        <strong class="fp-stat-num fp-hero-stat-num" data-count="36">0</strong>
                        <span>+ Payment Plans</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                <div class="fp-hero-visual" data-tilt="10">
                    <div class="fp-visual-card fp-vc-main">
                        <div class="fp-vc-header">
                            <div class="fp-vc-img">
                                <i class="bi bi-laptop-fill"></i>
                            </div>
                            <div>
                                <div class="fp-vc-name">MacBook Air M3</div>
                                <div class="fp-vc-price">₦850,000</div>
                            </div>
                            <div class="fp-vc-badge ms-auto"><i class="bi bi-tag-fill"></i> -40%</div>
                        </div>
                        <div class="fp-vc-plan">
                            <div class="fp-vc-plan-header">
                                <i class="bi bi-coin"></i> Payment Plan
                            </div>
                            <div class="fp-vc-plan-detail">
                                <span>₦70,833<span class="fp-vc-period">/month</span></span>
                                <span class="fp-vc-plan-meta">12 months · 0% interest</span>
                            </div>
                        </div>
                        <div class="fp-vc-progress">
                            <div class="fp-vc-progress-label">
                                <span><i class="bi bi-check-circle-fill"></i> 70% paid</span>
                                <span>₦595,000 paid</span>
                            </div>
                            <div class="fp-vc-progress-bar">
                                <div class="fp-vc-progress-fill" style="width:70%"></div>
                            </div>
                        </div>
                        <div class="fp-vc-footer">
                            <div class="fp-vc-rating">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <span>4.8 (312 reviews)</span>
                            </div>
                            <button class="fp-vc-btn">Buy Now</button>
                        </div>
                    </div>

                    <div class="fp-visual-card fp-vc-notify">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>
                            <strong>Order Confirmed!</strong>
                            <small>Delivery by Mar 15</small>
                        </div>
                    </div>

                    <div class="fp-visual-card fp-vc-trust">
                        <i class="bi bi-shield-fill-check"></i>
                        <div>
                            <strong>Secured Payment</strong>
                            <small>256-bit SSL encrypted</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fp-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none"><path fill="#0A0A0B" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z"/></svg>
    </div>
</section>

<!-- ===== BRAND MARQUEE ===== -->
<section class="fp-marquee-section">
    <div class="fp-marquee-track">
        <div class="fp-marquee-content">
            <span class="fp-marquee-item"><i class="bi bi-shield-fill-check"></i> 100% Secure</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-coin"></i> 0% Interest Plans</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-truck"></i> Free Delivery</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-arrow-repeat"></i> Easy Exchange</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-headset"></i> 24/7 Support</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-shield-fill-check"></i> 100% Secure</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-coin"></i> 0% Interest Plans</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-truck"></i> Free Delivery</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-arrow-repeat"></i> Easy Exchange</span>
            <span class="fp-marquee-dot">•</span>
            <span class="fp-marquee-item"><i class="bi bi-headset"></i> 24/7 Support</span>
            <span class="fp-marquee-dot">•</span>
        </div>
    </div>
</section>

<!-- ===== FEATURED PRODUCTS ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-star-fill"></i> Featured Products</div>
            <h2 class="reveal-up">Popular Items You'll Love</h2>
            <p class="reveal-up">Top-rated products with flexible installment plans starting from 4 weeks</p>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-product-card reveal-up" data-tilt="6" style="transition-delay:{{ ($loop->index % 4) * 0.08 }}s">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-product-link">
                        <div class="fp-product-img-wrap">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="fp-product-no-img">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                            @if($product->installment_from)
                                <span class="fp-product-badge">From ₦{{ number_format($product->installment_from, 0) }}/mo</span>
                            @endif
                        </div>
                        <div class="fp-product-body">
                            <h6>{{ Str::limit($product->name, 40) }}</h6>
                            <div class="fp-product-price">
                                <span class="fp-current-price">₦{{ number_format($product->price, 0) }}</span>
                                @if($product->compare_price)
                                    <span class="fp-old-price">₦{{ number_format($product->compare_price, 0) }}</span>
                                @endif
                            </div>
                            <div class="fp-product-meta">
                                <span><i class="bi bi-coin"></i> {{ $product->installment_plans_count ?? 'Flexible' }} plans</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam" style="font-size:48px;color:var(--text-dim);"></i>
                <p class="mt-3" style="color:var(--text-muted);">Featured products coming soon!</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4 reveal-up">
            <a href="{{ url('/shop') }}" class="btn-primary-gold"><i class="bi bi-grid-fill"></i> View All Products</a>
        </div>
    </div>
</section>

<!-- ===== HOW IT WORKS ===== -->
<section class="section-padding" style="background:var(--near-black);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-info-circle-fill"></i> How It Works</div>
            <h2 class="reveal-up">Get Your Dream Item in 3 Easy Steps</h2>
            <p class="reveal-up">No stress, no rush — pay at your own pace</p>
        </div>
        <div class="fp-how-steps">
            <div class="fp-how-step-line"></div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 reveal-up">
                    <div class="fp-how-card">
                        <div class="fp-how-card-glow"></div>
                        <div class="fp-how-num">01</div>
                        <div class="fp-how-icon"><i class="bi bi-hand-index-thumb"></i></div>
                        <h4>Choose Your Product</h4>
                        <p>Browse thousands of items from trusted brands and select what you want</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-up" style="transition-delay:0.15s">
                    <div class="fp-how-card fp-how-card--accent">
                        <div class="fp-how-card-glow"></div>
                        <div class="fp-how-num">02</div>
                        <div class="fp-how-icon"><i class="bi bi-calendar-check"></i></div>
                        <h4>Pick Your Plan</h4>
                        <p>Choose from 4 to 40 weeks or 1 to 12 months — whatever suits your budget</p>
                    </div>
                </div>
                <div class="col-md-4 reveal-up" style="transition-delay:0.3s">
                    <div class="fp-how-card">
                        <div class="fp-how-card-glow"></div>
                        <div class="fp-how-num">03</div>
                        <div class="fp-how-icon"><i class="bi bi-truck"></i></div>
                        <h4>Pay & Get Delivered</h4>
                        <p>Pay 70% and get your item shipped. Continue paying the balance comfortably</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-shield-fill-check"></i> Why FlexiPay</div>
            <h2 class="reveal-up">We Make Payments Painless</h2>
            <p class="reveal-up">Designed for real people with real budgets</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4 reveal-up">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h4>Flexible Plans</h4>
                    <p>Choose from weekly, bi-weekly, or monthly installments. Change your plan anytime.</p>
                </div>
            </div>
            <div class="col-md-4 reveal-up" style="transition-delay:0.1s">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-shield-check"></i></div>
                    <h4>Insurance Covered</h4>
                    <p>Insure your product for just 10% of the total order — complete peace of mind.</p>
                </div>
            </div>
            <div class="col-md-4 reveal-up" style="transition-delay:0.2s">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-wallet2"></i></div>
                    <h4>Wallet System</h4>
                    <p>Fund your wallet and enjoy instant payments, cashback rewards, and exclusive discounts.</p>
                </div>
            </div>
            <div class="col-md-4 reveal-up" style="transition-delay:0.3s">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-truck-front"></i></div>
                    <h4>Fast Delivery</h4>
                    <p>Items are shipped once 70% is paid. Track your delivery every step of the way.</p>
                </div>
            </div>
            <div class="col-md-4 reveal-up" style="transition-delay:0.4s">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <h4>Easy Exchanges</h4>
                    <p>Request a product exchange from your wishlist with admin approval — hassle-free.</p>
                </div>
            </div>
            <div class="col-md-4 reveal-up" style="transition-delay:0.5s">
                <div class="fp-feature-card">
                    <div class="fp-feature-icon"><i class="bi bi-headset"></i></div>
                    <h4>24/7 Support</h4>
                    <p>Our team is always here to help with payments, deliveries, or any questions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CATEGORIES ===== -->
<section class="section-padding" style="background:var(--near-black);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-grid-3x3-gap-fill"></i> Shop by Category</div>
            <h2 class="reveal-up">Explore Our Categories</h2>
            <p class="reveal-up">Find exactly what you need</p>
        </div>

        <div class="row g-3">
            @forelse($categories ?? [] as $category)
            <div class="col-lg-3 col-md-4 col-6">
                <a href="{{ url('/shop?category_id='.$category->id) }}" class="fp-cat-card reveal-up" style="transition-delay:{{ ($loop->index % 8) * 0.06 }}s">
                    <div class="fp-cat-icon">
                        <i class="bi {{ ['bi-phone-fill','bi-laptop-fill','bi-tv-fill','bi-watch-fill','bi-headphones','bi-speaker-fill','bi-camera-fill','bi-printer-fill','bi-joystick','bi-house-gear-fill','bi-car-front-fill','bi-tshirt'][$loop->index % 12] }}"></i>
                    </div>
                    <h6>{{ $category->name }}</h6>
                    <i class="bi bi-chevron-right fp-cat-arrow"></i>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p style="color:var(--text-muted);">Categories coming soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== STATS SECTION ===== -->
<section class="fp-stats-section section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="fp-stat-card reveal-up">
                    <i class="bi bi-box-seam-fill"></i>
                    <div class="counter-num" data-count="5000">0</div>
                    <div class="fp-stat-label">Products Available</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.1s">
                <div class="fp-stat-card">
                    <i class="bi bi-emoji-smile-fill"></i>
                    <div class="counter-num" data-count="15000">0</div>
                    <div class="fp-stat-label">Happy Customers</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.2s">
                <div class="fp-stat-card">
                    <i class="bi bi-coin"></i>
                    <div class="counter-num" data-count="36">0</div>
                    <div class="fp-stat-label">Payment Plans</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.3s">
                <div class="fp-stat-card">
                    <i class="bi bi-building"></i>
                    <div class="counter-num" data-count="100">0</div>
                    <div class="fp-stat-label">Trusted Brands</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-chat-square-quote-fill"></i> Testimonials</div>
            <h2 class="reveal-up">What Our Customers Say</h2>
            <p class="reveal-up">Hear from people who love shopping with FlexiPay</p>
        </div>
        <div class="row g-4">
            @php
                $testimonials = [
                    ['name' => 'Amara O.', 'role' => 'Lagos', 'text' => 'I got my dream laptop without breaking the bank. The installment plan was super flexible and the process was seamless!', 'rating' => 5],
                    ['name' => 'Chidi E.', 'role' => 'Abuja', 'text' => 'Finally a platform that understands budgeting. I\'ve recommended FlexiPay to all my friends and family.', 'rating' => 5],
                    ['name' => 'Zainab K.', 'role' => 'Kano', 'text' => 'The delivery was faster than expected and the payment plan was easy to set up. Absolutely love it!', 'rating' => 4],
                ];
            @endphp
            @foreach($testimonials as $i => $t)
            <div class="col-md-4 reveal-up" style="transition-delay:{{ $i * 0.1 }}s">
                <div class="fp-testimonial-card">
                    <div class="fp-testi-stars">
                        @for($s = 0; $s < $t['rating']; $s++)
                            <i class="bi bi-star-fill"></i>
                        @endfor
                        @for($s = $t['rating']; $s < 5; $s++)
                            <i class="bi bi-star"></i>
                        @endfor
                    </div>
                    <p class="fp-testi-text">"{{ $t['text'] }}"</p>
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
<section class="section-padding" style="background:var(--near-black);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-clock-history"></i> New Arrivals</div>
            <h2 class="reveal-up">Just Dropped</h2>
            <p class="reveal-up">The latest products added to our catalog</p>
        </div>
        <div class="row g-4">
            @forelse($newArrivals ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-product-card reveal-up" data-tilt="6" style="transition-delay:{{ ($loop->index % 4) * 0.06 }}s">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-product-link">
                        <div class="fp-product-img-wrap">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="fp-product-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <span class="fp-product-badge fp-product-badge-new">New</span>
                        </div>
                        <div class="fp-product-body">
                            <h6>{{ Str::limit($product->name, 40) }}</h6>
                            <div class="fp-product-price">
                                <span class="fp-current-price">₦{{ number_format($product->price, 0) }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <p style="color:var(--text-muted);">New arrivals coming soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== CTA ===== -->
<section class="fp-cta-section">
    <div class="fp-cta-bg">
        <div class="fp-cta-circle c1"></div>
        <div class="fp-cta-circle c2"></div>
        <div class="fp-cta-circle c3"></div>
    </div>
    <div class="container text-center position-relative">
        <div class="fp-cta-icon-wrap">
            <i class="bi bi-gift-fill fp-cta-icon"></i>
        </div>
        <h2 class="fp-cta-title reveal-up">Ready to Start Shopping?</h2>
        <p class="fp-cta-desc reveal-up">Create your account in minutes and get access to thousands of products with flexible payment plans tailored to your budget.</p>
        <div class="fp-cta-btns reveal-up">
            <a href="{{ url('/register') }}" class="fp-cta-btn-primary">
                <i class="bi bi-person-plus-fill"></i> Create Free Account
            </a>
            <a href="{{ url('/shop') }}" class="fp-cta-btn-outline">
                <i class="bi bi-grid-fill"></i> Browse Products
            </a>
        </div>
        <div class="fp-cta-trust reveal-up">
            <span><i class="bi bi-shield-fill-check"></i> No hidden fees</span>
            <span><i class="bi bi-clock-fill"></i> Instant approval</span>
            <span><i class="bi bi-arrow-repeat"></i> Flexible payments</span>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<style>
/* ===== HERO ===== */
.fp-hero {
    background: linear-gradient(135deg, #0A0A0B 0%, #1A1A1E 30%, #0A0A0B 70%, #121214 100%);
    min-height: 92vh;
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    padding: 100px 0 140px;
}
#particles-canvas {
    position: absolute; inset: 0;
    pointer-events: none; z-index: 1;
    opacity: 0.5;
}
.fp-hero-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; }
.fp-grid-lines {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(234,179,8,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(234,179,8,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
}
.fp-glow-orb {
    position: absolute; border-radius: 50%; filter: blur(80px);
    animation: orbFloat 8s ease-in-out infinite alternate;
}
.orbl { width: 400px; height: 400px; background: rgba(234,179,8,0.08); top: -100px; left: -100px; }
.orb2 { width: 300px; height: 300px; background: rgba(234,179,8,0.05); bottom: -80px; right: 20%; animation-delay: 3s; }
.orb3 { width: 250px; height: 250px; background: rgba(234,179,8,0.04); top: 40%; right: -60px; animation-delay: 5s; }
@keyframes orbFloat {
    0% { transform: translate(0,0) scale(1); }
    100% { transform: translate(40px,30px) scale(1.15); }
}
.fp-float-icon {
    position: absolute; font-size: 28px;
    color: rgba(234,179,8,0.08);
    animation: floatUpDown 6s ease-in-out infinite;
}
@keyframes floatUpDown {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-18px) rotate(8deg); }
}
.fp-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(234,179,8,0.12); color: var(--gold-400);
    border: 1px solid rgba(234,179,8,0.25);
    padding: 8px 18px; border-radius: 99px;
    font-size: 13px; font-weight: 600;
    margin-bottom: 28px;
    animation: slideInLeft 0.8s ease-out both;
}
.fp-live-dot {
    width: 8px; height: 8px; background: var(--gold-500);
    border-radius: 50%; display: inline-block;
    animation: liveGlow 1.5s ease-in-out infinite;
    box-shadow: 0 0 6px var(--gold-400);
}
@keyframes liveGlow { 0%,100%{opacity:1;transform:scale(1);} 50%{opacity:0.4;transform:scale(1.4);} }
.fp-hero-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(36px, 5vw, 58px);
    font-weight: 800; color: var(--text-primary); line-height: 1.2;
    margin-bottom: 20px;
    animation: slideInLeft 0.9s ease-out 0.1s both;
}
.fp-hero-line { display: inline-block; }
.fp-highlight-wrap { position: relative; display: inline-block; }
.fp-highlight {
    background: linear-gradient(135deg, var(--gold-400), var(--gold-600));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}
.fp-highlight::after {
    content: ''; position: absolute; bottom: 2px; left: 0; right: 0;
    height: 6px; background: rgba(234,179,8,0.15);
    border-radius: 3px; z-index: -1;
}
.fp-hero-desc {
    font-size: 17px; color: var(--text-muted);
    line-height: 1.8; margin-bottom: 30px; max-width: 540px;
    animation: slideInLeft 0.9s ease-out 0.2s both;
}
@keyframes slideInLeft { from{opacity:0;transform:translateX(-40px);} to{opacity:1;transform:translateX(0);} }
@keyframes slideInRight { from{opacity:0;transform:translateX(40px);} to{opacity:1;transform:translateX(0);} }

.fp-hero-search { animation: slideInLeft 0.9s ease-out 0.3s both; }
.fp-hero-search-box {
    background: var(--card-dark); border-radius: 14px; display: flex;
    align-items: center; overflow: hidden;
    border: 1px solid var(--card-border);
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    transition: border-color 0.3s, box-shadow 0.3s;
}
.fp-hero-search-box:focus-within {
    border-color: rgba(234,179,8,0.3);
    box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(234,179,8,0.1);
}
.fp-hs-field { display: flex; align-items: center; gap: 10px; padding: 0 20px; flex: 1; }
.fp-hs-field i { color: var(--text-dim); font-size: 18px; }
.fp-hs-field input {
    border: none; outline: none; width: 100%;
    padding: 16px 0; font-size: 15px; font-family: inherit;
    background: transparent; color: var(--text-primary);
}
.fp-hs-field input::placeholder { color: var(--text-dim); }
.fp-hs-divider { width: 1px; height: 36px; background: var(--card-border); flex-shrink: 0; }
.fp-hs-btn {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); border: none;
    padding: 16px 32px; font-size: 15px;
    font-weight: 700; cursor: pointer;
    display: flex; align-items: center; gap: 8px;
    transition: all 0.3s; white-space: nowrap;
    font-family: inherit;
}
.fp-hs-btn:hover { background: linear-gradient(135deg, var(--gold-600), var(--gold-700)); }

.fp-hero-tags { margin-top: 14px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.fp-tag-label { color: var(--text-dim); font-size: 12px; display: flex; align-items: center; gap: 4px; }
.fp-tag-label i { color: var(--gold-400); }
.fp-quick-tag {
    background: rgba(234,179,8,0.08); cursor: pointer;
    color: var(--text-muted);
    padding: 4px 12px; border-radius: 99px;
    font-size: 12px; font-weight: 500;
    border: 1px solid rgba(234,179,8,0.15);
    transition: all 0.3s;
}
.fp-quick-tag:hover { background: rgba(234,179,8,0.15); border-color: rgba(234,179,8,0.3); color: var(--gold-400); }

.fp-hero-stats {
    display: flex; align-items: center; gap: 24px;
    margin-top: 36px;
    animation: slideInLeft 0.9s ease-out 0.4s both;
}
.fp-hero-stat-num {
    font-size: 28px; font-weight: 800; display: block;
    color: var(--text-primary); font-family: 'Syne', sans-serif;
}
.fp-stat-item span { font-size: 13px; color: var(--text-muted); }
.fp-stat-divider { width: 1px; height: 40px; background: var(--card-border); }

.fp-hero-visual { position: relative; height: 460px; animation: slideInRight 0.9s ease-out 0.3s both; }
.fp-visual-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: 16px; padding: 20px; position: absolute;
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    animation: cardFloat 4s ease-in-out infinite;
    transition: transform 0.3s ease;
}
@keyframes cardFloat { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-10px);} }
.fp-vc-main { width: 300px; top: 40px; right: 0; animation-delay: 0s; }
.fp-vc-notify {
    width: 240px; bottom: 80px; left: 0;
    display: flex; align-items: center; gap: 12px;
    font-size: 14px; animation-delay: 0.5s;
    border-left: 4px solid var(--gold-500);
}
.fp-vc-notify i { font-size: 28px; color: var(--gold-500); }
.fp-vc-notify strong { display: block; font-weight: 700; color: var(--text-primary); }
.fp-vc-notify small { color: var(--text-dim); }
.fp-vc-trust {
    width: 220px; bottom: 180px; right: -20px;
    display: flex; align-items: center; gap: 12px;
    font-size: 13px; animation-delay: 1s;
    border-left: 4px solid var(--gold-500);
}
.fp-vc-trust i { font-size: 26px; color: var(--gold-500); }
.fp-vc-trust strong { display: block; font-weight: 700; color: var(--text-primary); font-size: 13px; }
.fp-vc-trust small { color: var(--text-dim); }
.fp-vc-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
.fp-vc-img {
    width: 50px; height: 50px; border-radius: 12px;
    background: linear-gradient(135deg, var(--card-border), var(--dark-800));
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-400); font-size: 24px; flex-shrink: 0;
}
.fp-vc-name { font-weight: 700; font-size: 15px; color: var(--text-primary); }
.fp-vc-price { font-size: 14px; color: var(--gold-400); font-weight: 700; font-family: 'Syne', sans-serif; }
.fp-vc-badge {
    font-size: 11px; color: var(--near-black);
    background: var(--gold-500); padding: 3px 8px; border-radius: 6px;
    font-weight: 700; display: flex; align-items: center; gap: 3px;
}
.fp-vc-plan {
    background: rgba(234,179,8,0.06); border: 1px solid rgba(234,179,8,0.15);
    border-radius: 10px; padding: 12px; margin-bottom: 12px;
}
.fp-vc-plan-header { font-size: 11px; color: var(--text-dim); font-weight: 600; display: flex; align-items: center; gap: 5px; margin-bottom: 6px; }
.fp-vc-plan-header i { color: var(--gold-500); }
.fp-vc-plan-detail { display: flex; justify-content: space-between; align-items: flex-end; }
.fp-vc-plan-detail span:first-child { font-size: 20px; font-weight: 800; color: var(--gold-400); font-family: 'Syne', sans-serif; }
.fp-vc-period { font-size: 12px; font-weight: 500; color: var(--text-dim); }
.fp-vc-plan-meta { font-size: 11px; color: var(--text-dim); }
.fp-vc-progress { margin-bottom: 12px; }
.fp-vc-progress-label { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-dim); margin-bottom: 6px; }
.fp-vc-progress-label i { color: var(--gold-500); font-size: 10px; }
.fp-vc-progress-bar {
    height: 6px; background: var(--card-border); border-radius: 99px; overflow: hidden;
}
.fp-vc-progress-fill { height: 100%; background: linear-gradient(90deg, var(--gold-500), var(--gold-600)); border-radius: 99px; }
.fp-vc-footer { display: flex; align-items: center; justify-content: space-between; }
.fp-vc-rating { color: var(--gold-400); font-size: 12px; }
.fp-vc-rating span { color: var(--text-dim); font-size: 11px; margin-left: 4px; }
.fp-vc-btn {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); border: none;
    padding: 7px 16px; border-radius: 8px; font-size: 13px;
    font-weight: 700; cursor: pointer; transition: all 0.3s;
}
.fp-vc-btn:hover { transform: scale(1.05); box-shadow: var(--shadow-gold); }

.fp-wave { position: absolute; bottom: -1px; left: 0; right: 0; z-index: 2; }
.fp-wave svg { display: block; width: 100%; height: 80px; }

/* ===== MARQUEE ===== */
.fp-marquee-section {
    background: var(--dark-900);
    padding: 12px 0;
    border-top: 1px solid var(--card-border);
    border-bottom: 1px solid var(--card-border);
    overflow: hidden;
}
.fp-marquee-track {
    overflow: hidden;
    mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
}
.fp-marquee-content {
    display: flex; align-items: center; gap: 0;
    animation: marqueeScroll 28s linear infinite;
    width: max-content;
}
.fp-marquee-item {
    display: inline-flex; align-items: center; gap: 6px;
    color: var(--text-muted); font-size: 13px; font-weight: 600;
    white-space: nowrap;
}
.fp-marquee-item i { color: var(--gold-500); font-size: 14px; }
.fp-marquee-dot {
    color: var(--gold-500); margin: 0 24px;
    font-size: 8px; opacity: 0.4;
}
@keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ===== PRODUCT CARD ===== */
.fp-product-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    will-change: transform;
}
.fp-product-card:hover {
    border-color: rgba(234,179,8,0.3);
    box-shadow: 0 12px 48px rgba(234,179,8,0.08);
}
.fp-product-link { display: block; text-decoration: none; height: 100%; }
.fp-product-img-wrap {
    position: relative; height: 200px;
    background: var(--dark-900);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.fp-product-img-wrap::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.3));
    pointer-events: none;
}
.fp-product-img-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.fp-product-card:hover .fp-product-img-wrap img { transform: scale(1.08); }
.fp-product-no-img { color: var(--card-border); font-size: 36px; }
.fp-product-badge {
    position: absolute; bottom: 8px; left: 8px; z-index: 1;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px;
}
.fp-product-badge-new { background: var(--gold-500); }
.fp-product-body { padding: 14px 16px 16px; }
.fp-product-body h6 {
    font-size: 14px; font-weight: 600; color: var(--text-primary);
    margin-bottom: 8px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; line-height: 1.4;
}
.fp-product-price { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.fp-current-price { font-size: 16px; font-weight: 700; color: var(--gold-400); font-family: 'Syne', sans-serif; }
.fp-old-price { font-size: 13px; color: var(--text-dim); text-decoration: line-through; }
.fp-product-meta { font-size: 12px; color: var(--text-dim); display: flex; align-items: center; gap: 4px; }
.fp-product-meta i { color: var(--gold-400); font-size: 11px; }

/* ===== HOW IT WORKS ===== */
.fp-how-steps { position: relative; }
.fp-how-step-line {
    display: none;
}
@media (min-width: 768px) {
    .fp-how-step-line {
        display: block;
        position: absolute; top: 80px; left: 16.66%; right: 16.66%;
        height: 2px;
        background: linear-gradient(90deg, var(--gold-500), var(--gold-400), var(--gold-500));
        opacity: 0.15;
    }
}
.fp-how-card {
    background: var(--card-dark); border-radius: var(--radius-lg);
    padding: 36px 28px; text-align: center;
    border: 1px solid var(--card-border);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative; overflow: hidden; height: 100%;
}
.fp-how-card-glow {
    position: absolute; top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle at 50% 0%, rgba(234,179,8,0.03) 0%, transparent 50%);
    transition: opacity 0.4s;
    opacity: 0;
}
.fp-how-card:hover .fp-how-card-glow { opacity: 1; }
.fp-how-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, var(--gold-500), var(--gold-700));
    transform: scaleX(0); transform-origin: left;
    transition: transform 0.4s;
}
.fp-how-card:hover { transform: translateY(-8px); border-color: rgba(234,179,8,0.25); box-shadow: 0 20px 48px rgba(0,0,0,0.3); }
.fp-how-card:hover::before { transform: scaleX(1); }
.fp-how-card--accent { border-color: rgba(234,179,8,0.2); }
.fp-how-num {
    position: absolute; top: 16px; right: 20px;
    font-size: 48px; font-weight: 900; color: rgba(234,179,8,0.06); line-height: 1;
    font-family: 'Syne', sans-serif;
}
.fp-how-icon {
    width: 72px; height: 72px; border-radius: 18px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    display: flex; align-items: center; justify-content: center;
    color: var(--near-black); font-size: 28px; margin: 0 auto 20px;
    transition: transform 0.3s;
}
.fp-how-card:hover .fp-how-icon { transform: rotate(-8deg) scale(1.1); }
.fp-how-card h4 { font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 10px; font-family: 'Syne', sans-serif; }
.fp-how-card p { color: var(--text-muted); font-size: 15px; line-height: 1.7; }

/* ===== FEATURE CARD ===== */
.fp-feature-card {
    background: var(--card-dark); border-radius: var(--radius);
    padding: 32px 24px;
    border: 1px solid var(--card-border);
    transition: all 0.4s;
    height: 100%; text-align: center;
}
.fp-feature-card:hover {
    border-color: rgba(234,179,8,0.25);
    transform: translateY(-4px);
    box-shadow: var(--shadow-card-hover);
}
.fp-feature-icon {
    width: 56px; height: 56px; border-radius: 14px;
    background: rgba(234,179,8,0.1);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-500); font-size: 24px;
    margin: 0 auto 16px;
    transition: all 0.3s;
}
.fp-feature-card:hover .fp-feature-icon {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    color: var(--near-black); transform: scale(1.1);
}
.fp-feature-card h4 { font-size: 18px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px; }
.fp-feature-card p { color: var(--text-muted); font-size: 14px; line-height: 1.7; }

/* ===== CATEGORY CARD ===== */
.fp-cat-card {
    display: flex; align-items: center; gap: 12px;
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    padding: 16px 18px;
    transition: all 0.3s; height: 100%;
    text-decoration: none; position: relative;
}
.fp-cat-card:hover {
    border-color: rgba(234,179,8,0.3);
    background: rgba(234,179,8,0.04);
    transform: translateX(4px);
}
.fp-cat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    background: rgba(234,179,8,0.1);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-500); font-size: 20px;
    flex-shrink: 0;
}
.fp-cat-card h6 { font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0; flex: 1; }
.fp-cat-arrow { color: var(--card-border); font-size: 12px; transition: all 0.3s; }
.fp-cat-card:hover .fp-cat-arrow { color: var(--gold-500); transform: translateX(3px); }

/* ===== STATS ===== */
.fp-stats-section {
    background: linear-gradient(135deg, var(--gold-700), #0d0d0e 40%, var(--dark-900) 100%);
    position: relative;
}
.fp-stats-section::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at 30% 50%, rgba(234,179,8,0.05) 0%, transparent 60%);
    pointer-events: none;
}
.fp-stat-card {
    text-align: center; padding: 32px 20px;
    background: rgba(0,0,0,0.2); border-radius: var(--radius);
    border: 1px solid rgba(255,255,255,0.05);
    backdrop-filter: blur(4px);
    position: relative;
    transition: all 0.3s;
}
.fp-stat-card:hover {
    border-color: rgba(234,179,8,0.15);
    background: rgba(0,0,0,0.3);
}
.fp-stat-card i { font-size: 36px; color: rgba(255,255,255,0.2); display: block; margin-bottom: 12px; transition: color 0.3s; }
.fp-stat-card:hover i { color: var(--gold-400); }
.fp-stat-label { font-size: 14px; color: rgba(255,255,255,0.6); font-weight: 500; }

/* ===== TESTIMONIALS ===== */
.fp-testimonial-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 28px 24px;
    transition: all 0.4s;
    height: 100%;
    display: flex; flex-direction: column;
}
.fp-testimonial-card:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-4px);
    box-shadow: var(--shadow-card-hover);
}
.fp-testi-stars { color: var(--gold-500); font-size: 14px; margin-bottom: 16px; }
.fp-testi-text {
    color: var(--text-muted);
    font-size: 15px;
    line-height: 1.8;
    flex: 1;
    font-style: italic;
}
.fp-testi-author {
    display: flex; align-items: center; gap: 12px;
    margin-top: 20px; padding-top: 16px;
    border-top: 1px solid var(--card-border);
}
.fp-testi-avatar {
    width: 40px; height: 40px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    color: var(--near-black);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 16px;
    flex-shrink: 0;
}
.fp-testi-author strong { display: block; font-size: 14px; color: var(--text-primary); }
.fp-testi-author small { font-size: 12px; color: var(--text-dim); }

/* ===== CTA ===== */
.fp-cta-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #0A0A0B 0%, #1A1A1E 50%, #0A0A0B 100%);
    position: relative; overflow: hidden;
}
.fp-cta-bg { position: absolute; inset: 0; pointer-events: none; }
.fp-cta-circle {
    position: absolute; border-radius: 50%; background: rgba(234,179,8,0.04);
    animation: ctaFloat 8s ease-in-out infinite;
}
.c1 { width: 300px; height: 300px; top: -100px; left: -80px; }
.c2 { width: 200px; height: 200px; bottom: -60px; right: 15%; animation-delay: 2s; }
.c3 { width: 150px; height: 150px; top: 30%; right: -40px; animation-delay: 4s; }
@keyframes ctaFloat { 0%,100%{transform:scale(1);} 50%{transform:scale(1.1);} }

.fp-cta-icon-wrap {
    display: inline-block;
    position: relative;
    margin-bottom: 20px;
}
.fp-cta-icon {
    font-size: 52px;
    background: linear-gradient(135deg, var(--gold-400), var(--gold-600));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: iconBounce 2s ease-in-out infinite;
    display: block;
}
@keyframes iconBounce { 0%,100%{transform:translateY(0) rotate(0deg);} 50%{transform:translateY(-12px) rotate(-5deg);} }
.fp-cta-title { font-family: 'Syne', sans-serif; font-size: clamp(28px, 4vw, 44px); font-weight: 800; color: var(--text-primary); margin-bottom: 16px; }
.fp-cta-desc { color: var(--text-muted); font-size: 17px; max-width: 520px; margin: 0 auto 40px; line-height: 1.7; }
.fp-cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
.fp-cta-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black);
    padding: 16px 36px; border-radius: 12px; font-weight: 700; font-size: 16px;
    transition: all 0.3s;
    box-shadow: var(--shadow-gold);
    position: relative; overflow: hidden;
}
.fp-cta-btn-primary::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.15) 50%, transparent 80%);
    transform: translateX(-100%); transition: transform 0.6s;
}
.fp-cta-btn-primary:hover::before { transform: translateX(100%); }
.fp-cta-btn-primary:hover { transform: translateY(-3px); box-shadow: var(--shadow-gold-lg); color: var(--near-black); }
.fp-cta-btn-outline {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.05); color: var(--text-primary);
    padding: 16px 36px; border-radius: 12px; font-weight: 700; font-size: 16px;
    border: 2px solid rgba(234,179,8,0.3);
    transition: all 0.3s;
}
.fp-cta-btn-outline:hover { background: rgba(234,179,8,0.1); color: var(--gold-400); transform: translateY(-3px); }
.fp-cta-trust {
    display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; margin-top: 36px;
}
.fp-cta-trust span {
    display: flex; align-items: center; gap: 6px;
    color: var(--text-dim); font-size: 14px;
}
.fp-cta-trust i { color: var(--gold-500); }

@media (max-width: 768px) {
    .fp-hero { padding: 80px 0 120px; min-height: auto; }
    .fp-hero-search-box { flex-direction: column; }
    .fp-hs-divider { display: none; }
    .fp-hs-btn { width: 100%; justify-content: center; padding: 14px; }
    .fp-hero-stats { gap: 16px; }
    .fp-hero-stat-num { font-size: 22px; }
    .fp-product-img-wrap { height: 160px; }
    .fp-marquee-item { font-size: 11px; }
}
</style>

<script>
function quickSearch(term) {
    window.location.href = '{{ url("/shop") }}?search=' + encodeURIComponent(term);
}

// Lightweight particle system (canvas-based)
(function() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let W, H;
    const particles = [];
    const COUNT = 80;

    function resize() {
        const hero = document.getElementById('fpHero');
        if (!hero) return;
        const rect = hero.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
        W = rect.width;
        H = rect.height;
    }

    class Particle {
        constructor() { this.reset(); }
        reset() {
            this.x = Math.random() * W;
            this.y = Math.random() * H;
            this.size = Math.random() * 2 + 0.5;
            this.speedX = (Math.random() - 0.5) * 0.3;
            this.speedY = (Math.random() - 0.5) * 0.3;
            this.opacity = Math.random() * 0.5 + 0.1;
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            if (this.x < 0 || this.x > W || this.y < 0 || this.y > H) this.reset();
        }
        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(234, 179, 8, ${this.opacity})`;
            ctx.fill();
        }
    }

    function initParticles() {
        particles.length = 0;
        for (let i = 0; i < COUNT; i++) particles.push(new Particle());
    }

    function drawLines() {
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 120) {
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.strokeStyle = `rgba(234, 179, 8, ${0.04 * (1 - dist / 120)})`;
                    ctx.stroke();
                }
            }
        }
    }

    function animate() {
        ctx.clearRect(0, 0, W, H);
        particles.forEach(p => { p.update(); p.draw(); });
        drawLines();
        requestAnimationFrame(animate);
    }

    resize();
    initParticles();
    animate();

    window.addEventListener('resize', () => {
        resize();
        initParticles();
    });
})();
</script>
@endsection