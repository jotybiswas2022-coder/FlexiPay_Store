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

<!-- ===== HERO SECTION ===== -->
<section class="fp-hero" id="fpHero">
    <canvas id="particles-canvas" aria-hidden="true"></canvas>
    <div class="fp-hero-bg">
        <div class="fp-grid-lines"></div>
        <div class="fp-glow-orb orb1" aria-hidden="true"></div>
        <div class="fp-glow-orb orb2" aria-hidden="true"></div>
        <div class="fp-glow-orb orb3" aria-hidden="true"></div>
        <div class="fp-float-icon fi1"><i class="bi bi-phone-fill"></i></div>
        <div class="fp-float-icon fi2"><i class="bi bi-laptop-fill"></i></div>
        <div class="fp-float-icon fi3"><i class="bi bi-watch-fill"></i></div>
        <div class="fp-float-icon fi4"><i class="bi bi-tv-fill"></i></div>
        <div class="fp-float-icon fi5"><i class="bi bi-speaker-fill"></i></div>
        <div class="fp-float-icon fi6"><i class="bi bi-headphones"></i></div>
    </div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="fp-hero-content">
                    <div class="fp-hero-badge">
                        <span class="fp-live-dot"></span>
                        <i class="bi bi-lightning-charge-fill"></i> 0% Interest Installments Available
                    </div>

                    <h1 class="fp-hero-title">
                        <span class="fp-hero-line">Shop Now,</span>
                        <span class="fp-highlight-wrap">
                            <span class="fp-highlight">Pay Over Time</span>
                            <span class="fp-highlight-underline"></span>
                        </span>
                    </h1>

                    <p class="fp-hero-desc">
                        Get the products you love today with flexible payment plans that fit your budget. 
                        Weekly or monthly installments — no hidden fees, no stress.
                    </p>

                    <div class="fp-hero-search">
                        <form action="{{ url('/shop') }}" method="GET" class="fp-hero-search-box" role="search">
                            <div class="fp-hs-field">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" placeholder="What are you looking for?" required aria-label="Search products">
                            </div>
                            <button type="submit" class="fp-hs-btn">
                                <i class="bi bi-search"></i> Search
                            </button>
                        </form>
                        <div class="fp-hero-tags">
                            <span class="fp-tag-label"><i class="bi bi-lightning-charge-fill"></i> Popular:</span>
                            <span class="fp-quick-tag" onclick="quickSearch('iPhone')">iPhone</span>
                            <span class="fp-quick-tag" onclick="quickSearch('Laptop')">Laptop</span>
                            <span class="fp-quick-tag" onclick="quickSearch('Sneakers')">Sneakers</span>
                            <span class="fp-quick-tag" onclick="quickSearch('TV')">TV</span>
                        </div>
                    </div>

                    <div class="fp-hero-stats">
                        <div class="fp-stat-item">
                            <strong class="fp-stat-num fp-hero-stat-num" data-count="5000">0</strong>
                            <span class="fp-stat-label">Products</span>
                        </div>
                        <div class="fp-stat-dot"></div>
                        <div class="fp-stat-item">
                            <strong class="fp-stat-num fp-hero-stat-num" data-count="15000">0</strong>
                            <span class="fp-stat-label">Happy Customers</span>
                        </div>
                        <div class="fp-stat-dot"></div>
                        <div class="fp-stat-item">
                            <strong class="fp-stat-num fp-hero-stat-num" data-count="36">0</strong>
                            <span class="fp-stat-label">Payment Plans</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="fp-hero-visual">
                    <!-- Main Product Card -->
                    <div class="fp-vc-card fp-vc-main" data-tilt="8">
                        <div class="fp-vc-bg-pattern"></div>
                        <div class="fp-vc-top">
                            <div class="fp-vc-product-img">
                                <i class="bi bi-laptop-fill"></i>
                            </div>
                            <div class="fp-vc-product-info">
                                <h5>MacBook Air M3</h5>
                                <div class="fp-vc-price-row">
                                    <span class="fp-vc-price-current">₦850,000</span>
                                    <span class="fp-vc-price-old">₦1,200,000</span>
                                    <span class="fp-vc-badge">Save 29%</span>
                                </div>
                            </div>
                        </div>
                        <div class="fp-vc-plan">
                            <div class="fp-vc-plan-header">
                                <i class="bi bi-coin"></i>
                                <span>Installment Plan</span>
                                <span class="fp-vc-plan-badge">0% Interest</span>
                            </div>
                            <div class="fp-vc-plan-detail">
                                <span class="fp-vc-plan-amount">₦70,833<small>/month</small></span>
                                <span class="fp-vc-plan-meta">12 months · No hidden fees</span>
                            </div>
                        </div>
                        <div class="fp-vc-progress">
                            <div class="fp-vc-progress-top">
                                <span><i class="bi bi-check-circle-fill"></i> 70% funded</span>
                                <span>₦595,000 raised</span>
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
                                <span>4.8 <span class="d-none d-sm-inline">(312 reviews)</span></span>
                            </div>
                            <button class="fp-vc-btn"><i class="bi bi-cart-plus"></i> Add to Cart</button>
                        </div>
                    </div>

                    <!-- Mini Cards -->
                    <div class="fp-vc-card fp-vc-mini fp-vc-delivery">
                        <div class="fp-vc-mini-icon"><i class="bi bi-truck"></i></div>
                        <div>
                            <strong>Free Delivery</strong>
                            <small>On orders over ₦50,000</small>
                        </div>
                    </div>

                    <div class="fp-vc-card fp-vc-mini fp-vc-secure">
                        <div class="fp-vc-mini-icon"><i class="bi bi-shield-check"></i></div>
                        <div>
                            <strong>Secure Payments</strong>
                            <small>256-bit SSL encrypted</small>
                        </div>
                    </div>

                    <div class="fp-vc-card fp-vc-mini fp-vc-support">
                        <div class="fp-vc-mini-icon"><i class="bi bi-headset"></i></div>
                        <div>
                            <strong>24/7 Support</strong>
                            <small>We're here to help</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fp-hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none"><path fill="#0A0A0B" d="M0,40 C360,80 1080,0 1440,40 L1440,80 L0,80 Z"/></svg>
    </div>
</section>

<!-- ===== BRAND MARQUEE ===== -->
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
            <span class="fp-marquee-item"><i class="bi bi-wallet2"></i> Wallet Rewards</span>
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
            <span class="fp-marquee-item"><i class="bi bi-wallet2"></i> Wallet Rewards</span>
            <span class="fp-marquee-dot">✦</span>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== FEATURED PRODUCTS ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-star-fill"></i> Best Sellers</div>
            <h2 class="reveal-up">Trending Products</h2>
            <p class="reveal-up">Top-rated items our customers love with flexible payment options</p>
        </div>

        <div class="row g-4">
            @forelse($featuredProducts ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-pcard reveal-up" style="transition-delay:{{ ($loop->index % 4) * 0.08 }}s">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-pcard-link">
                        <div class="fp-pcard-img-wrap">
                            @php $img = $product->primaryImage ?? $product->images->first(); @endphp
                            @if($img)
                                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="fp-pcard-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <div class="fp-pcard-overlay">
                                <span class="fp-pcard-quickview"><i class="bi bi-eye"></i> Quick View</span>
                            </div>
                            @if($product->installment_from)
                                <span class="fp-pcard-badge">From ₦{{ number_format($product->installment_from, 0) }}/mo</span>
                            @endif
                            @if($product->compare_price && $product->compare_price > $product->price)
                                @php $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100); @endphp
                                @if($discount > 0)
                                    <span class="fp-pcard-discount">-{{ $discount }}%</span>
                                @endif
                            @endif
                        </div>
                        <div class="fp-pcard-body">
                            <h6>{{ Str::limit($product->name, 40) }}</h6>
                            <div class="fp-pcard-price">
                                <span class="fp-pcard-current">₦{{ number_format($product->price, 0) }}</span>
                                @if($product->compare_price)
                                    <span class="fp-pcard-old">₦{{ number_format($product->compare_price, 0) }}</span>
                                @endif
                            </div>
                            <div class="fp-pcard-meta">
                                <span><i class="bi bi-coin"></i> 
                                    @if($product->installment_plans_count)
                                        {{ $product->installment_plans_count }} plans
                                    @else
                                        Flexible plans
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty-section">
                    <i class="bi bi-box-seam-fill"></i>
                    <p>Featured products coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-5 reveal-up">
            <a href="{{ url('/shop') }}" class="btn-primary-gold btn-lg-custom"><i class="bi bi-grid-fill"></i> Browse All Products</a>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== HOW IT WORKS ===== -->
<section class="section-padding" style="background:var(--near-black);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-info-circle-fill"></i> Simple Process</div>
            <h2 class="reveal-up">Three Easy Steps</h2>
            <p class="reveal-up">Get your dream item without breaking the bank</p>
        </div>

        <div class="fp-steps">
            <div class="fp-steps-line"></div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 reveal-up">
                    <div class="fp-step-card">
                        <div class="fp-step-card-glow"></div>
                        <div class="fp-step-num">
                            <span>01</span>
                            <div class="fp-step-num-line"></div>
                        </div>
                        <div class="fp-step-icon">
                            <i class="bi bi-hand-index-thumb"></i>
                            <div class="fp-step-ripple"></div>
                        </div>
                        <h4>Choose Product</h4>
                        <p>Browse thousands of products from top brands and find exactly what you need</p>
                        <div class="fp-step-arrow"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-md-4 reveal-up" style="transition-delay:0.15s">
                    <div class="fp-step-card fp-step-card--accent">
                        <div class="fp-step-card-glow"></div>
                        <div class="fp-step-num">
                            <span>02</span>
                            <div class="fp-step-num-line"></div>
                        </div>
                        <div class="fp-step-icon">
                            <i class="bi bi-calendar-check"></i>
                            <div class="fp-step-ripple"></div>
                        </div>
                        <h4>Select Plan</h4>
                        <p>Pick weekly, bi-weekly, or monthly installments — whatever works for your budget</p>
                        <div class="fp-step-arrow"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
                <div class="col-md-4 reveal-up" style="transition-delay:0.3s">
                    <div class="fp-step-card">
                        <div class="fp-step-card-glow"></div>
                        <div class="fp-step-num">
                            <span>03</span>
                            <div class="fp-step-num-line"></div>
                        </div>
                        <div class="fp-step-icon">
                            <i class="bi bi-truck"></i>
                            <div class="fp-step-ripple"></div>
                        </div>
                        <h4>Get Delivered</h4>
                        <p>Pay 70% upfront and your item ships immediately. Pay the rest at your pace</p>
                        <div class="fp-step-arrow"><i class="bi bi-arrow-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== WHY CHOOSE US ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-trophy-fill"></i> Why FlexiPay</div>
            <h2 class="reveal-up">Built for Your Convenience</h2>
            <p class="reveal-up">Everything you need in one platform</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6 reveal-up">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h4>Flexible Plans</h4>
                    <p>Choose from weekly, bi-weekly, or monthly payments. Change your plan anytime hassle-free.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 reveal-up" style="transition-delay:0.08s">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-shield-check"></i></div>
                    <h4>Insurance Covered</h4>
                    <p>Protect your purchase for just 10% of the order value. Complete peace of mind included.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 reveal-up" style="transition-delay:0.16s">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-wallet2"></i></div>
                    <h4>Wallet System</h4>
                    <p>Fund your wallet for instant payments, earn cashback rewards, and unlock exclusive deals.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 reveal-up" style="transition-delay:0.24s">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-truck-front"></i></div>
                    <h4>Fast Delivery</h4>
                    <p>Items ship once you've paid 70%. Track your delivery from warehouse to doorstep.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 reveal-up" style="transition-delay:0.32s">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-arrow-left-right"></i></div>
                    <h4>Easy Exchanges</h4>
                    <p>Not satisfied? Request a product exchange easily. Admin approval is quick and straightforward.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 reveal-up" style="transition-delay:0.4s">
                <div class="fp-fcard">
                    <div class="fp-fcard-icon"><i class="bi bi-headset"></i></div>
                    <h4>24/7 Support</h4>
                    <p>Our team is always ready to assist with payments, deliveries, or any questions you have.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== CATEGORIES ===== -->
<section class="section-padding" style="background:var(--near-black);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-grid-3x3-gap-fill"></i> Categories</div>
            <h2 class="reveal-up">Shop by Category</h2>
            <p class="reveal-up">Find exactly what you're looking for</p>
        </div>

        <div class="row g-3">
            @forelse($categories ?? [] as $category)
            <div class="col-lg-3 col-md-4 col-6">
                <a href="{{ url('/shop?category_id='.$category->id) }}" class="fp-ccard reveal-up" style="transition-delay:{{ ($loop->index % 8) * 0.06 }}s">
                    <div class="fp-ccard-icon">
                        <i class="bi {{ ['bi-phone-fill','bi-laptop-fill','bi-tv-fill','bi-watch-fill','bi-headphones','bi-speaker-fill','bi-camera-fill','bi-printer-fill','bi-joystick','bi-house-gear-fill','bi-car-front-fill','bi-tshirt'][$loop->index % 12] }}"></i>
                        <div class="fp-ccard-icon-bg"></div>
                    </div>
                    <div class="fp-ccard-info">
                        <h6>{{ $category->name }}</h6>
                        <span>Shop Now <i class="bi bi-chevron-right"></i></span>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty-section">
                    <i class="bi bi-grid"></i>
                    <p>Categories coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ===== STATS ===== -->
<section class="fp-stats-section section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="fp-scard reveal-up">
                    <div class="fp-scard-shine"></div>
                    <div class="fp-scard-icon"><i class="bi bi-box-seam-fill"></i></div>
                    <div class="counter-num" data-count="5000">0</div>
                    <div class="fp-scard-label">Products Available</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.1s">
                <div class="fp-scard">
                    <div class="fp-scard-shine"></div>
                    <div class="fp-scard-icon"><i class="bi bi-emoji-smile-fill"></i></div>
                    <div class="counter-num" data-count="15000">0</div>
                    <div class="fp-scard-label">Happy Customers</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.2s">
                <div class="fp-scard">
                    <div class="fp-scard-shine"></div>
                    <div class="fp-scard-icon"><i class="bi bi-coin"></i></div>
                    <div class="counter-num" data-count="36">0</div>
                    <div class="fp-scard-label">Payment Plans</div>
                </div>
            </div>
            <div class="col-md-3 col-6 reveal-up" style="transition-delay:0.3s">
                <div class="fp-scard">
                    <div class="fp-scard-shine"></div>
                    <div class="fp-scard-icon"><i class="bi bi-building"></i></div>
                    <div class="counter-num" data-count="100">0</div>
                    <div class="fp-scard-label">Trusted Brands</div>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== TESTIMONIALS ===== -->
<section class="section-padding" style="background:var(--surface-dark);">
    <div class="container">
        <div class="section-head">
            <div class="section-badge reveal-up"><i class="bi bi-chat-square-quote-fill"></i> Testimonials</div>
            <h2 class="reveal-up">What Our Customers Say</h2>
            <p class="reveal-up">Real stories from real people who love shopping with FlexiPay</p>
        </div>

        <div class="row g-4">
            @php
                $testimonials = [
                    ['name' => 'Amara O.', 'role' => 'Lagos', 'text' => 'I got my dream laptop without breaking the bank. The installment plan was super flexible and the process was seamless from start to finish!', 'rating' => 5],
                    ['name' => 'Chidi E.', 'role' => 'Abuja', 'text' => 'Finally, a platform that truly understands budgeting. I\'ve recommended FlexiPay to all my friends and family. Absolutely love it!', 'rating' => 5],
                    ['name' => 'Zainab K.', 'role' => 'Kano', 'text' => 'The delivery was faster than I expected and setting up the payment plan took less than 5 minutes. Such a game-changer!', 'rating' => 4],
                    ['name' => 'Michael A.', 'role' => 'Port Harcourt', 'text' => 'FlexiPay made it possible for me to get a new phone without waiting months. The weekly plan fits perfectly with my budget.', 'rating' => 5],
                ];
            @endphp
            @foreach($testimonials as $i => $t)
            <div class="col-md-3 reveal-up" style="transition-delay:{{ $i * 0.08 }}s">
                <div class="fp-tcard">
                    <div class="fp-tcard-stars">
                        @for($s = 0; $s < 5; $s++)
                            <i class="bi {{ $s < $t['rating'] ? 'bi-star-fill' : 'bi-star' }}"></i>
                        @endfor
                    </div>
                    <p class="fp-tcard-text">"{{ $t['text'] }}"</p>
                    <div class="fp-tcard-author">
                        <div class="fp-tcard-avatar">{{ substr($t['name'], 0, 1) }}</div>
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

<hr class="section-divider">

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
                <div class="fp-pcard reveal-up" style="transition-delay:{{ ($loop->index % 4) * 0.06 }}s">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-pcard-link">
                        <div class="fp-pcard-img-wrap">
                            @php $img = $product->primaryImage ?? $product->images->first(); @endphp
                            @if($img)
                                <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="fp-pcard-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <div class="fp-pcard-overlay">
                                <span class="fp-pcard-quickview"><i class="bi bi-eye"></i> View</span>
                            </div>
                            <span class="fp-pcard-badge fp-pcard-badge-new">New</span>
                        </div>
                        <div class="fp-pcard-body">
                            <h6>{{ Str::limit($product->name, 40) }}</h6>
                            <div class="fp-pcard-price">
                                <span class="fp-pcard-current">₦{{ number_format($product->price, 0) }}</span>
                            </div>
                            <div class="fp-pcard-meta">
                                <span><i class="bi bi-coin"></i> Flexible plans</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-empty-section">
                    <i class="bi bi-clock-history"></i>
                    <p>New arrivals coming soon!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<hr class="section-divider">

<!-- ===== CTA SECTION ===== -->
<section class="fp-cta-section">
    <div class="fp-cta-bg">
        <div class="fp-cta-circle c1"></div>
        <div class="fp-cta-circle c2"></div>
        <div class="fp-cta-circle c3"></div>
        <div class="fp-cta-grid"></div>
    </div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal-left">
                <div class="fp-cta-badge"><i class="bi bi-gift-fill"></i> Limited Time Offer</div>
                <h2 class="fp-cta-title">Ready to Start <span class="text-gradient-gold">Shopping?</span></h2>
                <p class="fp-cta-desc">Create your free account in minutes and unlock thousands of products with flexible payment plans designed for your budget.</p>
                <div class="fp-cta-benefits">
                    <div class="fp-cta-benefit">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>No credit check required</span>
                    </div>
                    <div class="fp-cta-benefit">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Instant account approval</span>
                    </div>
                    <div class="fp-cta-benefit">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Cancel anytime, no fees</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 reveal-right">
                <div class="fp-cta-card">
                    <div class="fp-cta-card-header">
                        <div class="fp-cta-card-avatar"><i class="bi bi-person-plus-fill"></i></div>
                        <h4>Get Started Free</h4>
                        <p>Join thousands of happy customers</p>
                    </div>
                    <div class="fp-cta-card-actions">
                        <a href="{{ url('/register') }}" class="fp-cta-btn-primary">
                            <i class="bi bi-person-plus-fill"></i> Create Free Account
                        </a>
                        <a href="{{ url('/shop') }}" class="fp-cta-btn-outline">
                            <i class="bi bi-grid-fill"></i> Browse Products
                        </a>
                    </div>
                    <div class="fp-cta-card-trust">
                        <span><i class="bi bi-shield-fill-check"></i> SSL Secure</span>
                        <span><i class="bi bi-clock-fill"></i> Instant Access</span>
                        <span><i class="bi bi-arrow-repeat"></i> Flexible Plans</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<style>
/* ============================================================
   HERO SECTION — Complete Redesign
   ============================================================ */
.fp-hero {
    background: linear-gradient(135deg, #0A0A0B 0%, #151518 25%, #0A0A0B 50%, #121214 75%, #0A0A0B 100%);
    min-height: 100vh;
    display: flex; align-items: center;
    position: relative; overflow: hidden;
    padding: 130px 0 150px;
}
#particles-canvas {
    position: absolute; inset: 0;
    pointer-events: none; z-index: 1;
    opacity: 0.5;
    width: 100%; height: 100%;
}
.fp-hero-bg { position: absolute; inset: 0; pointer-events: none; z-index: 0; }
.fp-grid-lines {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(234,179,8,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(234,179,8,0.025) 1px, transparent 1px);
    background-size: 70px 70px;
}
.fp-glow-orb {
    position: absolute; border-radius: 50%; filter: blur(120px);
    animation: orbFloat 12s ease-in-out infinite alternate;
}
.orb1 { width: 550px; height: 550px; background: rgba(234,179,8,0.07); top: -200px; left: -200px; }
.orb2 { width: 400px; height: 400px; background: rgba(234,179,8,0.04); bottom: -150px; right: 15%; animation-delay: 3s; }
.orb3 { width: 300px; height: 300px; background: rgba(234,179,8,0.03); top: 35%; right: -100px; animation-delay: 6s; }
@keyframes orbFloat {
    0% { transform: translate(0,0) scale(1); }
    100% { transform: translate(60px,50px) scale(1.25); }
}
.fp-float-icon {
    position: absolute; font-size: 30px;
    color: rgba(234,179,8,0.06);
    animation: floatUpDown 7s ease-in-out infinite;
}
.fi1 { top: 12%; left: 5%; animation-delay: 0s; }
.fi2 { top: 28%; right: 7%; animation-delay: 1.5s; }
.fi3 { top: 55%; left: 3%; animation-delay: 2.5s; }
.fi4 { top: 72%; right: 5%; animation-delay: 1s; }
.fi5 { top: 45%; left: 12%; animation-delay: 2s; }
.fi6 { top: 60%; right: 14%; animation-delay: 3.5s; }
@keyframes floatUpDown {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

.fp-hero-content { position: relative; z-index: 2; }

.fp-hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: linear-gradient(135deg, rgba(234,179,8,0.15), rgba(234,179,8,0.05));
    color: var(--gold-400);
    border: 1px solid rgba(234,179,8,0.25);
    padding: 8px 20px; border-radius: 99px;
    font-size: 13px; font-weight: 600;
    margin-bottom: 28px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
}
.fp-live-dot {
    width: 8px; height: 8px; background: #22c55e;
    border-radius: 50%; display: inline-block;
    animation: livePulse 1.5s ease-in-out infinite;
    box-shadow: 0 0 8px rgba(34,197,94,0.5);
}
@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1);} 50%{opacity:0.4;transform:scale(1.5);} }

.fp-hero-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(38px, 5.5vw, 68px);
    font-weight: 800; color: var(--text-primary); line-height: 1.1;
    margin-bottom: 20px;
    animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.1s both;
}
.fp-hero-line { display: inline-block; }
.fp-highlight-wrap { position: relative; display: inline-block; }
.fp-highlight {
    background: linear-gradient(135deg, #fbbf24, #eab308, #ca8a04);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
}
.fp-highlight-underline {
    position: absolute; bottom: 6px; left: 0; right: 0;
    height: 12px; background: rgba(234,179,8,0.15);
    border-radius: 6px; z-index: -1;
    transform: skewX(-8deg);
}

.fp-hero-desc {
    font-size: 17px; color: var(--text-muted);
    line-height: 1.8; margin-bottom: 30px; max-width: 520px;
    animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.15s both;
}

.fp-hero-search { animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both; }
.fp-hero-search-box {
    background: rgba(26,26,30,0.8);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 16px; display: flex;
    align-items: center; overflow: hidden;
    border: 1px solid rgba(234,179,8,0.15);
    box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    transition: border-color 0.3s, box-shadow 0.4s ease, background 0.3s;
}
.fp-hero-search-box:focus-within {
    border-color: rgba(234,179,8,0.35);
    box-shadow: 0 20px 60px rgba(0,0,0,0.4), 0 0 0 3px rgba(234,179,8,0.06);
    background: rgba(26,26,30,0.95);
}
.fp-hs-field { display: flex; align-items: center; gap: 10px; padding: 0 20px; flex: 1; }
.fp-hs-field i { color: var(--text-dim); font-size: 16px; }
.fp-hs-field input {
    border: none; outline: none; width: 100%;
    padding: 16px 0; font-size: 15px; font-family: inherit;
    background: transparent; color: var(--text-primary);
}
.fp-hs-field input::placeholder { color: var(--text-dim); }
.fp-hs-btn {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B; border: none;
    padding: 16px 28px; font-size: 15px;
    font-weight: 700; cursor: pointer;
    display: flex; align-items: center; gap: 8px;
    transition: all 0.3s; white-space: nowrap;
    font-family: inherit;
    margin: 4px;
    border-radius: 12px;
    position: relative; overflow: hidden;
}
.fp-hs-btn::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.2) 50%, transparent 80%);
    transform: translateX(-100%); transition: transform 0.5s;
}
.fp-hs-btn:hover::before { transform: translateX(100%); }
.fp-hs-btn:hover { background: linear-gradient(135deg, #facc15, #eab308); transform: scale(1.02); }

.fp-hero-tags { margin-top: 14px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
.fp-tag-label { color: var(--text-dim); font-size: 12px; display: flex; align-items: center; gap: 4px; }
.fp-tag-label i { color: var(--gold-400); }
.fp-quick-tag {
    background: rgba(234,179,8,0.06); cursor: pointer;
    color: var(--text-muted);
    padding: 4px 14px; border-radius: 99px;
    font-size: 12px; font-weight: 500;
    border: 1px solid rgba(234,179,8,0.12);
    transition: all 0.3s; touch-action: manipulation;
    backdrop-filter: blur(4px);
}
.fp-quick-tag:hover { background: rgba(234,179,8,0.15); border-color: rgba(234,179,8,0.3); color: var(--gold-400); }

.fp-hero-stats {
    display: flex; align-items: center; gap: 20px;
    margin-top: 36px;
    animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.25s both;
}
.fp-stat-item { display: flex; flex-direction: column; gap: 2px; }
.fp-hero-stat-num {
    font-size: 30px; font-weight: 800; line-height: 1;
    background: linear-gradient(135deg, #fbbf24, #eab308);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    font-family: 'Syne', sans-serif;
}
.fp-stat-item .fp-stat-label { font-size: 13px; color: var(--text-dim); }
.fp-stat-dot {
    width: 5px; height: 5px; background: rgba(234,179,8,0.3);
    border-radius: 50%; flex-shrink: 0;
}

@keyframes fadeSlideUp { from{opacity:0;transform:translateY(30px);} to{opacity:1;transform:translateY(0);} }

/* ===== HERO VISUAL CARDS ===== */
.fp-hero-visual {
    position: relative;
    min-height: 500px;
    animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s both;
}
.fp-vc-card {
    position: absolute;
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    animation: vcFloat 5s ease-in-out infinite;
}
.fp-vc-main {
    width: 340px;
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(234,179,8,0.15);
    box-shadow: 0 24px 80px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);
    padding: 22px;
    top: 20px; right: 0; z-index: 3;
}
.fp-vc-main::before {
    content: ''; position: absolute; inset: 0;
    border-radius: 16px;
    background: linear-gradient(135deg, rgba(234,179,8,0.06) 0%, transparent 50%);
    pointer-events: none;
}
.fp-vc-main::after {
    content: ''; position: absolute; inset: -1px;
    border-radius: 17px;
    background: linear-gradient(135deg, rgba(234,179,8,0.2), transparent 40%, transparent 60%, rgba(234,179,8,0.1));
    z-index: -1;
    /* mask composite for gradient border - fallback for Firefox */
    mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    padding: 1px;
    pointer-events: none;
    /* Fallback: subtle solid border for browsers that don't support mask-composite */
}
.fp-vc-main {
    border: 1px solid rgba(234,179,8,0.12);
    box-shadow: 0 24px 80px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);
    position: relative;
    overflow: hidden;
}
.fp-vc-main::after {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 17px;
    background: linear-gradient(135deg, rgba(234,179,8,0.2), transparent 40%, transparent 60%, rgba(234,179,8,0.1));
    z-index: -1;
    /* mask composite for gradient border - fallback for Firefox */
    mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    padding: 1px;
    pointer-events: none;
    /* Fallback: subtle solid border for browsers that don't support mask-composite */
}
.fp-vc-bg-pattern {
    position: absolute; inset: 0; opacity: 0.03;
    background-image: radial-gradient(circle at 1px 1px, var(--gold-500) 1px, transparent 0);
    background-size: 20px 20px;
    pointer-events: none;
}
.fp-vc-top { display: flex; gap: 12px; margin-bottom: 14px; position: relative; z-index: 1; }
.fp-vc-product-img {
    width: 58px; height: 58px; border-radius: 14px;
    background: linear-gradient(135deg, rgba(234,179,8,0.15), rgba(234,179,8,0.05));
    display: flex; align-items: center; justify-content: center;
    color: #eab308; font-size: 28px; flex-shrink: 0;
    border: 1px solid rgba(234,179,8,0.2);
}
.fp-vc-product-info h5 {
    font-size: 16px; font-weight: 700; color: var(--text-primary);
    margin: 0 0 6px; font-family: 'Syne', sans-serif;
}
.fp-vc-price-row { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.fp-vc-price-current { font-size: 18px; font-weight: 800; color: #eab308; font-family: 'Syne', sans-serif; }
.fp-vc-price-old { font-size: 13px; color: var(--text-dim); text-decoration: line-through; }
.fp-vc-badge {
    font-size: 10px; color: white;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    padding: 2px 8px; border-radius: 4px;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(220,38,38,0.3);
}

.fp-vc-plan {
    background: rgba(234,179,8,0.05);
    border: 1px solid rgba(234,179,8,0.12);
    border-radius: 10px; padding: 12px; margin-bottom: 12px;
    position: relative; z-index: 1;
    transition: border-color 0.3s;
}
.fp-vc-card:hover .fp-vc-plan { border-color: rgba(234,179,8,0.25); }
.fp-vc-plan-header {
    font-size: 11px; color: var(--text-dim); font-weight: 600;
    display: flex; align-items: center; gap: 5px; margin-bottom: 6px;
}
.fp-vc-plan-header i { color: #eab308; }
.fp-vc-plan-badge {
    margin-left: auto; font-size: 10px;
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white; padding: 2px 8px; border-radius: 4px;
    font-weight: 700;
}
.fp-vc-plan-detail { display: flex; justify-content: space-between; align-items: flex-end; }
.fp-vc-plan-amount { font-size: 20px; font-weight: 800; color: #eab308; font-family: 'Syne', sans-serif; }
.fp-vc-plan-amount small { font-size: 12px; font-weight: 500; color: var(--text-dim); }
.fp-vc-plan-meta { font-size: 11px; color: var(--text-dim); }

.fp-vc-progress { margin-bottom: 12px; position: relative; z-index: 1; }
.fp-vc-progress-top { display: flex; justify-content: space-between; font-size: 11px; color: var(--text-dim); margin-bottom: 6px; }
.fp-vc-progress-top i { color: #eab308; font-size: 10px; }
.fp-vc-progress-bar {
    height: 6px; background: rgba(234,179,8,0.08); border-radius: 99px; overflow: hidden;
    border: 1px solid rgba(234,179,8,0.05);
}
.fp-vc-progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #eab308, #fbbf24);
    border-radius: 99px;
    transition: width 0.8s ease;
    position: relative;
}
.fp-vc-progress-fill::after {
    content: ''; position: absolute; right: 0; top: 0; bottom: 0;
    width: 20px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3));
    border-radius: 99px;
}

.fp-vc-footer { display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
.fp-vc-rating { color: #eab308; font-size: 12px; }
.fp-vc-rating span { color: var(--text-dim); font-size: 11px; margin-left: 4px; }
.fp-vc-btn {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B; border: none;
    padding: 8px 16px; border-radius: 8px; font-size: 13px;
    font-weight: 700; cursor: pointer;
    transition: all 0.3s;
    display: flex; align-items: center; gap: 5px;
}
.fp-vc-btn:hover { transform: scale(1.05); box-shadow: 0 4px 20px rgba(234,179,8,0.3); }

@keyframes vcFloat {
    0%,100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

.fp-vc-mini {
    width: 200px; display: flex; align-items: center; gap: 10px;
    padding: 12px 16px;
    background: rgba(26,26,30,0.85);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.06);
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}
.fp-vc-mini:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-3px) scale(1.02);
}
.fp-vc-delivery { bottom: 80px; left: -20px; z-index: 2; animation-delay: 0.5s; }
.fp-vc-secure { bottom: 200px; right: 20px; z-index: 1; animation-delay: 1s; }
.fp-vc-support { top: 120px; left: -30px; z-index: 0; animation-delay: 1.5s; }
.fp-vc-mini-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; flex-shrink: 0;
}
.fp-vc-delivery .fp-vc-mini-icon { background: rgba(234,179,8,0.12); color: #eab308; }
.fp-vc-secure .fp-vc-mini-icon { background: rgba(34,197,94,0.12); color: #22c55e; }
.fp-vc-support .fp-vc-mini-icon { background: rgba(59,130,246,0.12); color: #3b82f6; }
.fp-vc-mini strong { display: block; font-weight: 700; color: var(--text-primary); font-size: 13px; }
.fp-vc-mini small { color: var(--text-dim); font-size: 11px; }

.fp-hero-wave { position: absolute; bottom: -1px; left: 0; right: 0; z-index: 2; }
.fp-hero-wave svg { display: block; width: 100%; height: 100px; }

/* ===== MARQUEE ===== */
.fp-marquee-section {
    background: linear-gradient(180deg, var(--near-black), var(--dark-900));
    padding: 16px 0;
    border-top: 1px solid rgba(234,179,8,0.06);
    border-bottom: 1px solid rgba(234,179,8,0.06);
    overflow: hidden;
    position: relative;
}
.fp-marquee-section::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(234,179,8,0.08), transparent);
}
.fp-marquee-track {
    overflow: hidden;
    mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, black 5%, black 95%, transparent);
}
.fp-marquee-content {
    display: flex; align-items: center; gap: 0;
    animation: marqueeScroll 35s linear infinite;
    width: max-content;
}
.fp-marquee-item {
    display: inline-flex; align-items: center; gap: 7px;
    color: var(--text-muted); font-size: 14px; font-weight: 600;
    white-space: nowrap;
    padding: 6px 0;
    transition: color 0.3s;
}
.fp-marquee-item:hover { color: var(--gold-400); }
.fp-marquee-item i { color: var(--gold-500); font-size: 15px; filter: drop-shadow(0 0 4px rgba(234,179,8,0.2)); }
.fp-marquee-dot {
    color: var(--gold-500); margin: 0 32px;
    font-size: 10px; opacity: 0.3;
}
@keyframes marqueeScroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* ===== PRODUCT CARDS (pcard) — Glassmorphism ===== */
.fp-pcard {
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    will-change: transform;
    position: relative;
}
.fp-pcard::before {
    content: ''; position: absolute; inset: -1px;
    border-radius: calc(var(--radius) + 1px);
    background: linear-gradient(135deg, rgba(234,179,8,0.08), transparent 50%, transparent 50%, rgba(234,179,8,0.04));
    z-index: -1;
    opacity: 0;
    transition: opacity 0.4s;
}
.fp-pcard:hover::before { opacity: 1; }
.fp-pcard:hover {
    border-color: rgba(234,179,8,0.25);
    box-shadow: 0 16px 48px rgba(234,179,8,0.08);
    transform: translateY(-6px);
}
.fp-pcard-link { display: block; text-decoration: none; height: 100%; }
.fp-pcard-img-wrap {
    position: relative; height: 200px;
    background: var(--dark-900);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; flex-shrink: 0;
}
.fp-pcard-img-wrap::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 50%, rgba(0,0,0,0.5));
    pointer-events: none;
}
.fp-pcard-img-wrap img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-pcard:hover .fp-pcard-img-wrap img { transform: scale(1.12); }
.fp-pcard-no-img { color: var(--card-border); font-size: 36px; }

.fp-pcard-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 2;
}
.fp-pcard:hover .fp-pcard-overlay { opacity: 1; }
.fp-pcard-quickview {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    padding: 8px 20px; border-radius: 8px;
    font-size: 13px; font-weight: 700;
    display: flex; align-items: center; gap: 6px;
    transform: scale(0.9);
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-pcard:hover .fp-pcard-quickview { transform: scale(1); }

.fp-pcard-badge {
    position: absolute; bottom: 8px; left: 8px; z-index: 1;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B; font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px; white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}
.fp-pcard-badge-new { background: linear-gradient(135deg, #eab308, #f97316); }
.fp-pcard-discount {
    position: absolute; top: 8px; right: 8px; z-index: 1;
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    color: white; font-size: 11px; font-weight: 700;
    padding: 4px 8px; border-radius: 6px; white-space: nowrap;
    box-shadow: 0 2px 8px rgba(220,38,38,0.3);
}

.fp-pcard-body { padding: 14px 16px 16px; position: relative; }
.fp-pcard-body h6 {
    font-size: 14px; font-weight: 600; color: var(--text-primary);
    margin-bottom: 8px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; line-height: 1.4;
}
.fp-pcard-price { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
.fp-pcard-current { font-size: 16px; font-weight: 700; color: #eab308; font-family: 'Syne', sans-serif; white-space: nowrap; }
.fp-pcard-old { font-size: 13px; color: var(--text-dim); text-decoration: line-through; }
.fp-pcard-meta { font-size: 12px; color: var(--text-dim); display: flex; align-items: center; gap: 4px; }
.fp-pcard-meta i { color: #eab308; font-size: 11px; }

/* ===== STEPS (How It Works) ===== */
.fp-steps { position: relative; }
.fp-steps-line { display: none; }
@media (min-width: 768px) {
    .fp-steps-line {
        display: block;
        position: absolute; top: 85px; left: 16.66%; right: 16.66%;
        height: 2px;
        background: linear-gradient(90deg, rgba(234,179,8,0.08), rgba(234,179,8,0.15), rgba(234,179,8,0.08));
    }
}
.fp-step-card {
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border-radius: var(--radius-lg);
    padding: 40px 28px 32px;
    text-align: center;
    border: 1px solid var(--card-border);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative; overflow: hidden; height: 100%;
}
.fp-step-card-glow {
    position: absolute; top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle at 50% 0%, rgba(234,179,8,0.04) 0%, transparent 50%);
    transition: opacity 0.5s ease;
    opacity: 0;
}
.fp-step-card:hover .fp-step-card-glow { opacity: 1; }
.fp-step-card::before {
    content: ''; position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, #eab308, #ca8a04);
    transform: scaleX(0); transform-origin: left;
    transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-step-card:hover { transform: translateY(-8px); border-color: rgba(234,179,8,0.2); box-shadow: 0 20px 48px rgba(0,0,0,0.3); }
.fp-step-card:hover::before { transform: scaleX(1); }
.fp-step-card--accent { border-color: rgba(234,179,8,0.15); }

.fp-step-num {
    display: flex; align-items: center; justify-content: center; gap: 8px;
    margin-bottom: 20px;
}
.fp-step-num span {
    font-family: 'Syne', sans-serif;
    font-size: 36px; font-weight: 900;
    color: rgba(234,179,8,0.1);
    line-height: 1;
    transition: color 0.3s;
}
.fp-step-card:hover .fp-step-num span { color: rgba(234,179,8,0.2); }
.fp-step-num-line {
    height: 1px; width: 40px;
    background: linear-gradient(90deg, rgba(234,179,8,0.2), transparent);
}

.fp-step-icon {
    width: 80px; height: 80px; border-radius: 20px;
    background: linear-gradient(135deg, rgba(234,179,8,0.12), rgba(234,179,8,0.04));
    display: flex; align-items: center; justify-content: center;
    color: #eab308; font-size: 30px;
    margin: 0 auto 20px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    border: 1px solid rgba(234,179,8,0.15);
}
.fp-step-ripple {
    position: absolute; inset: -4px;
    border: 1px solid rgba(234,179,8,0.08);
    border-radius: 22px;
    animation: ripplePulse 3s ease-in-out infinite;
}
@keyframes ripplePulse {
    0%,100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0; }
}
.fp-step-card:hover .fp-step-icon {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 0 8px 24px rgba(234,179,8,0.2);
}

.fp-step-card h4 { font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 10px; font-family: 'Syne', sans-serif; }
.fp-step-card p { color: var(--text-muted); font-size: 14px; line-height: 1.7; margin-bottom: 0; }
.fp-step-arrow {
    position: absolute; bottom: 16px; right: 20px;
    color: rgba(234,179,8,0.08);
    font-size: 28px;
    transition: all 0.3s;
}
.fp-step-card:hover .fp-step-arrow { color: rgba(234,179,8,0.2); transform: translateX(4px); }

/* ===== FEATURE CARDS (fcard) ===== */
.fp-fcard {
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border-radius: var(--radius);
    padding: 28px 24px;
    border: 1px solid var(--card-border);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    position: relative;
    overflow: hidden;
}
.fp-fcard::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #eab308, transparent);
    transform: scaleX(0); transition: transform 0.4s;
}
.fp-fcard:hover::after { transform: scaleX(1); }
.fp-fcard:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-4px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
}
.fp-fcard-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: rgba(234,179,8,0.08);
    display: flex; align-items: center; justify-content: center;
    color: #eab308; font-size: 20px;
    margin-bottom: 14px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-fcard:hover .fp-fcard-icon {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    transform: scale(1.1) rotate(-5deg);
    box-shadow: 0 4px 12px rgba(234,179,8,0.2);
}
.fp-fcard h4 { font-size: 17px; font-weight: 700; color: var(--text-primary); margin-bottom: 6px; }
.fp-fcard p { color: var(--text-muted); font-size: 14px; line-height: 1.7; margin: 0; }

/* ===== CATEGORY CARDS (ccard) ===== */
.fp-ccard {
    display: flex; align-items: center; gap: 14px;
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    padding: 16px 18px;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    text-decoration: none; position: relative;
    overflow: hidden;
}
.fp-ccard::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(234,179,8,0.04), transparent);
    opacity: 0;
    transition: opacity 0.3s;
}
.fp-ccard:hover::before { opacity: 1; }
.fp-ccard:hover {
    border-color: rgba(234,179,8,0.25);
    transform: translateX(6px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}
.fp-ccard-icon {
    position: relative;
    width: 44px; height: 44px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: #eab308;
    flex-shrink: 0;
    z-index: 1;
}
.fp-ccard-icon-bg {
    position: absolute; inset: 0; border-radius: 10px;
    background: rgba(234,179,8,0.08);
    transition: all 0.3s;
}
.fp-ccard:hover .fp-ccard-icon-bg {
    background: linear-gradient(135deg, #eab308, #ca8a04);
    transform: scale(1.15);
}
.fp-ccard:hover .fp-ccard-icon i { color: #0A0A0B; z-index: 2; position: relative; }
.fp-ccard-info { z-index: 1; flex: 1; }
.fp-ccard-info h6 { font-size: 14px; font-weight: 600; color: var(--text-primary); margin: 0 0 2px; }
.fp-ccard-info span { font-size: 12px; color: var(--text-dim); display: flex; align-items: center; gap: 4px; transition: all 0.3s; }
.fp-ccard-info span i { font-size: 10px; }
.fp-ccard:hover .fp-ccard-info span { color: #eab308; }
.fp-ccard:hover .fp-ccard-info span i { transform: translateX(4px); }

/* ===== STATS ===== */
.fp-stats-section {
    background: linear-gradient(135deg, #713f12, #0d0d0e 35%, #0A0A0B 100%);
    position: relative;
    overflow: hidden;
}
.fp-stats-section::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse at 30% 50%, rgba(234,179,8,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 70% 50%, rgba(234,179,8,0.04) 0%, transparent 50%);
    pointer-events: none;
}
.fp-scard {
    text-align: center; padding: 36px 20px;
    background: rgba(0,0,0,0.3);
    border-radius: var(--radius);
    border: 1px solid rgba(255,255,255,0.06);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    position: relative;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
}
.fp-scard-shine {
    position: absolute; top: 0; left: -100%;
    width: 60%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.02), transparent);
    transform: skewX(-25deg);
    transition: left 0.5s;
}
.fp-scard:hover .fp-scard-shine { left: 200%; }
.fp-scard:hover {
    border-color: rgba(234,179,8,0.15);
    background: rgba(0,0,0,0.4);
    transform: translateY(-4px);
}
.fp-scard-icon { font-size: 32px; color: rgba(255,255,255,0.12); display: block; margin-bottom: 10px; transition: all 0.3s; }
.fp-scard:hover .fp-scard-icon { color: #eab308; transform: scale(1.15); }
.fp-scard-label { font-size: 14px; color: rgba(255,255,255,0.55); font-weight: 500; margin-top: 4px; }

/* ===== TESTIMONIALS ===== */
.fp-tcard {
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 28px 22px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    display: flex; flex-direction: column;
    position: relative;
}
.fp-tcard::before {
    content: '"'; position: absolute; top: 12px; right: 18px;
    font-size: 56px; line-height: 1;
    color: rgba(234,179,8,0.05);
    font-family: 'Syne', sans-serif;
    font-weight: 900;
}
.fp-tcard:hover {
    border-color: rgba(234,179,8,0.15);
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}
.fp-tcard-stars { color: #eab308; font-size: 13px; margin-bottom: 14px; letter-spacing: 1px; }
.fp-tcard-text {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.8;
    flex: 1;
    font-style: italic;
}
.fp-tcard-author {
    display: flex; align-items: center; gap: 10px;
    margin-top: 16px; padding-top: 14px;
    border-top: 1px solid var(--card-border);
}
.fp-tcard-avatar {
    width: 38px; height: 38px; border-radius: 10px;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 15px;
    flex-shrink: 0;
}
.fp-tcard-author strong { display: block; font-size: 14px; color: var(--text-primary); }
.fp-tcard-author small { font-size: 12px; color: var(--text-dim); }

/* ===== EMPTY SECTION ===== */
.fp-empty-section {
    text-align: center; padding: 60px 20px;
}
.fp-empty-section i {
    font-size: 48px; color: var(--text-dim);
    display: block; margin-bottom: 16px;
    transition: color 0.3s, transform 0.3s;
}
.fp-empty-section:hover i { color: #eab308; transform: scale(1.12); }
.fp-empty-section p { color: var(--text-muted); font-size: 15px; margin: 0; }

/* ===== CTA ===== */
.fp-cta-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #0A0A0B 0%, #151518 50%, #0A0A0B 100%);
    position: relative; overflow: hidden;
}
.fp-cta-bg { position: absolute; inset: 0; pointer-events: none; }
.fp-cta-circle {
    position: absolute; border-radius: 50%; background: rgba(234,179,8,0.04);
    animation: ctaFloat 10s ease-in-out infinite;
}
.c1 { width: 400px; height: 400px; top: -150px; left: -100px; }
.c2 { width: 250px; height: 250px; bottom: -100px; right: 10%; animation-delay: 3s; }
.c3 { width: 200px; height: 200px; top: 25%; right: -80px; animation-delay: 6s; }
@keyframes ctaFloat { 0%,100%{transform:scale(1);} 50%{transform:scale(1.2);} }
.fp-cta-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(234,179,8,0.025) 1px, transparent 1px),
        linear-gradient(90deg, rgba(234,179,8,0.025) 1px, transparent 1px);
    background-size: 50px 50px;
}

.fp-cta-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: linear-gradient(135deg, rgba(234,179,8,0.12), rgba(234,179,8,0.05));
    color: #eab308;
    border: 1px solid rgba(234,179,8,0.2);
    padding: 6px 16px; border-radius: 99px;
    font-size: 12px; font-weight: 700;
    margin-bottom: 20px;
}
.fp-cta-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(30px, 4.5vw, 48px);
    font-weight: 800; color: var(--text-primary);
    margin-bottom: 16px;
}
.fp-cta-desc {
    color: var(--text-muted);
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 24px;
}
.fp-cta-benefits { display: flex; flex-direction: column; gap: 12px; }
.fp-cta-benefit {
    display: flex; align-items: center; gap: 10px;
    color: var(--text-muted); font-size: 15px;
}
.fp-cta-benefit i { color: #22c55e; font-size: 18px; }

.fp-cta-card {
    background: linear-gradient(145deg, rgba(26,26,30,0.95), rgba(22,22,26,0.9));
    border: 1px solid rgba(234,179,8,0.12);
    border-radius: 20px;
    padding: 36px 32px;
    text-align: center;
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    box-shadow: 0 24px 80px rgba(0,0,0,0.3);
    position: relative;
    overflow: hidden;
}
.fp-cta-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #eab308, #fbbf24, #eab308);
}
.fp-cta-card::after {
    content: ''; position: absolute; inset: -1px;
    border-radius: 21px;
    background: linear-gradient(135deg, rgba(234,179,8,0.15), transparent 40%, transparent 60%, rgba(234,179,8,0.08));
    z-index: -1;
    /* mask composite for gradient border - fallback for Firefox */
    mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    padding: 1px;
    /* Fallback: browsers that don't support mask-composite fall back to the ":before" solid border */
}
.fp-cta-card {
    border: 1px solid rgba(234,179,8,0.12);
    box-shadow: 0 24px 80px rgba(0,0,0,0.3);
    position: relative;
    overflow: hidden;
}
.fp-cta-card::after {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 21px;
    background: linear-gradient(135deg, rgba(234,179,8,0.15), transparent 40%, transparent 60%, rgba(234,179,8,0.08));
    z-index: -1;
    /* mask composite for gradient border */
    mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    padding: 1px;
    pointer-events: none;
}
.fp-cta-card-avatar {
    width: 64px; height: 64px; border-radius: 16px;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    display: flex; align-items: center; justify-content: center;
    color: #0A0A0B; font-size: 28px;
    margin: 0 auto 16px;
    box-shadow: 0 8px 24px rgba(234,179,8,0.2);
}
.fp-cta-card-header h4 { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; color: var(--text-primary); margin-bottom: 4px; }
.fp-cta-card-header p { color: var(--text-dim); font-size: 14px; margin-bottom: 24px; }

.fp-cta-card-actions { display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px; }
.fp-cta-btn-primary {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    background: linear-gradient(135deg, #eab308, #ca8a04);
    color: #0A0A0B;
    padding: 16px 32px; border-radius: 12px; font-weight: 700; font-size: 16px;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 4px 20px rgba(234,179,8,0.15);
    position: relative; overflow: hidden;
}
.fp-cta-btn-primary::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.15) 50%, transparent 80%);
    transform: translateX(-100%); transition: transform 0.6s;
}
.fp-cta-btn-primary:hover::before { transform: translateX(100%); }
.fp-cta-btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(234,179,8,0.3); color: #0A0A0B; }
.fp-cta-btn-outline {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    background: rgba(255,255,255,0.04); color: var(--text-primary);
    padding: 16px 32px; border-radius: 12px; font-weight: 700; font-size: 16px;
    border: 2px solid rgba(234,179,8,0.25);
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-cta-btn-outline:hover { background: rgba(234,179,8,0.08); color: #eab308; transform: translateY(-3px); }

.fp-cta-card-trust {
    display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;
}
.fp-cta-card-trust span {
    display: flex; align-items: center; gap: 6px;
    color: var(--text-dim); font-size: 13px;
}
.fp-cta-card-trust i { color: #eab308; font-size: 14px; }

/* ===== BUTTONS ===== */
.btn-lg-custom {
    padding: 14px 34px !important;
    font-size: 15px !important;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .fp-hero { padding: 100px 0 120px; min-height: auto; }
    .fp-hero-search-box { flex-direction: row; }
    .fp-pcard-img-wrap { height: 180px; }
    .fp-cta-section { padding: 70px 0; }
}
@media (max-width: 768px) {
    .fp-hero { padding: 80px 0 100px; }
    .fp-hero-search-box { flex-direction: column; }
    .fp-hs-btn { width: 100%; justify-content: center; padding: 14px; margin: 0; border-radius: 0 0 12px 12px; }
    .fp-hero-stats { gap: 16px; }
    .fp-hero-stat-num { font-size: 22px; }
    .fp-pcard-img-wrap { height: 160px; }
    .fp-marquee-item { font-size: 12px; }
    .fp-cta-section { padding: 60px 0; }
    .fp-cta-card { padding: 28px 20px; }
    .fp-step-card { padding: 32px 20px 28px; }
    .fp-stats-section.section-padding { padding: 40px 0; }
    .fp-scard { padding: 28px 16px; }
}
@media (max-width: 576px) {
    .fp-hero-title { font-size: 30px; }
    .fp-hero-desc { font-size: 15px; }
    .fp-hero-tags { gap: 4px; }
    .fp-quick-tag { font-size: 11px; padding: 3px 10px; }
    .fp-pcard-img-wrap { height: 140px; }
    .fp-pcard-body h6 { font-size: 13px; }
    .fp-pcard-current { font-size: 14px; }
    .fp-cta-title { font-size: 26px; }
}
</style>

<script>
    // Quick search navigation
    function quickSearch(query) {
        window.location.href = '{{ url("/shop") }}?search=' + encodeURIComponent(query);
    }

    // Particles animation
    document.addEventListener('DOMContentLoaded', () => {
        const canvas = document.getElementById('particles-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let w, h, particles = [];

        function resize() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        const count = Math.min(80, Math.floor((w * h) / 12000));
        for (let i = 0; i < count; i++) {
            particles.push({
                x: Math.random() * w,
                y: Math.random() * h,
                vx: (Math.random() - 0.5) * 0.4,
                vy: (Math.random() - 0.5) * 0.4,
                r: Math.random() * 1.8 + 0.5
            });
        }

        function animate() {
            ctx.clearRect(0, 0, w, h);
            for (let p of particles) {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0) p.x = w;
                if (p.x > w) p.x = 0;
                if (p.y < 0) p.y = h;
                if (p.y > h) p.y = 0;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(234,179,8,0.3)';
                ctx.fill();
            }
            // Draw connections
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 150) {
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.strokeStyle = `rgba(234,179,8,${0.08 * (1 - dist / 150)})`;
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animate);
        }
        animate();
    });
</script>

@endsection
