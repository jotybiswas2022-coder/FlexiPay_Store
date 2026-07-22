@extends('frontend.app')
@section('title', 'About Us — FlexiPay Store')

@section('content')
<section style="background:var(--near-black);padding:80px 0;min-height:100vh;">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-info-circle-fill"></i> About Us</div>
            <h2>Why FlexiPay?</h2>
            <p>We're on a mission to make shopping accessible for everyone</p>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-lg);padding:40px;">
                    <h3 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;">Buy Now, Pay Comfortably</h3>
                    <p style="color:var(--text-muted);line-height:1.8;margin-bottom:16px;">FlexiPay Store is Nigeria's premier installment payment platform. We believe everyone deserves access to quality products without financial strain.</p>
                    <p style="color:var(--text-muted);line-height:1.8;margin-bottom:16px;">Our platform allows you to shop thousands of products and pay over time with flexible weekly or monthly plans that fit your budget.</p>
                    <p style="color:var(--text-muted);line-height:1.8;">With features like insurance coverage, wallet system, delivery tracking, and 24/7 support, we're here to make your shopping experience seamless and enjoyable.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:24px;text-align:center;">
                            <i class="bi bi-people-fill" style="font-size:32px;color:var(--gold-500);display:block;margin-bottom:8px;"></i>
                            <div class="counter-num" data-count="5000" style="font-size:28px;">0</div>
                            <div style="color:var(--text-dim);font-size:13px;">Products</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:24px;text-align:center;">
                            <i class="bi bi-emoji-smile-fill" style="font-size:32px;color:var(--gold-500);display:block;margin-bottom:8px;"></i>
                            <div class="counter-num" data-count="15000" style="font-size:28px;">0</div>
                            <div style="color:var(--text-dim);font-size:13px;">Happy Customers</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:24px;text-align:center;">
                            <i class="bi bi-coin" style="font-size:32px;color:var(--gold-500);display:block;margin-bottom:8px;"></i>
                            <div class="counter-num" data-count="36" style="font-size:28px;">0</div>
                            <div style="color:var(--text-dim);font-size:13px;">Payment Plans</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius-sm);padding:24px;text-align:center;">
                            <i class="bi bi-building" style="font-size:32px;color:var(--gold-500);display:block;margin-bottom:8px;"></i>
                            <div class="counter-num" data-count="36" style="font-size:28px;">0</div>
                            <div style="color:var(--text-dim);font-size:13px;">States Covered</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
@endsection