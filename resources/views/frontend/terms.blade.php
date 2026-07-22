@extends('frontend.app')
@section('title', 'Terms & Conditions — FlexiPay Store')

@section('content')
<section style="background:var(--near-black);padding:60px 0;min-height:100vh;">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-file-earmark-text-fill"></i> Legal</div>
            <h2>{{ $type == 'payment' ? 'Payment Terms' : ($type == 'delivery' ? 'Delivery Policy' : ($type == 'privacy' ? 'Privacy Policy' : 'Terms & Conditions')) }}</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:36px;">
                    @if(isset($terms) && $terms)
                        {!! nl2br(e($terms->content)) !!}
                    @else
                        <div style="color:var(--text-muted);line-height:1.8;">
                            <h4 style="color:var(--text-primary);font-family:'Syne',sans-serif;margin-bottom:16px;">General Terms</h4>
                            <p>By using FlexiPay Store, you agree to the following terms and conditions. Please read them carefully.</p>

                            <h5 style="color:var(--text-primary);margin-top:24px;">1. Payment Plans</h5>
                            <p>FlexiPay offers flexible installment payment plans ranging from 4 to 40 weeks or 1 to 12 months. Interest rates vary by plan. By selecting a plan, you commit to making timely payments as agreed.</p>

                            <h5 style="color:var(--text-primary);margin-top:24px;">2. Delivery</h5>
                            <p>Products will be shipped once 70% of the total order is paid. Delivery fees are calculated and included in the initial payment. Delivery timelines vary by location.</p>

                            <h5 style="color:var(--text-primary);margin-top:24px;">3. Cancellation</h5>
                            <p>You may cancel your installment plan at any time. A 10% cancellation fee applies. Refunds are credited to your FlexiPay wallet for future purchases.</p>

                            <h5 style="color:var(--text-primary);margin-top:24px;">4. Insurance</h5>
                            <p>Insurance is optional and costs 10% of the total order. It covers damage, loss, or theft during the installment period.</p>

                            <h5 style="color:var(--text-primary);margin-top:24px;">5. Account</h5>
                            <p>You are responsible for maintaining the confidentiality of your account credentials. FlexiPay reserves the right to suspend or terminate accounts for violation of terms.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
@endsection