@extends('frontend.app')
@section('title', 'FAQs — FlexiPay Store')

@section('content')
<section class="fp-faq-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-question-circle-fill"></i> FAQs</div>
            <h2>Frequently Asked Questions</h2>
            <p>Everything you need to know about shopping with FlexiPay</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                @if(isset($faqs) && $faqs->count() > 0)
                    @foreach($faqs as $category => $faqGroup)
                    <div class="fp-faq-category">
                        <h3 class="fp-faq-cat-title">{{ $category }}</h3>
                        <div class="accordion fp-accordion" id="faqAccordion">
                            @foreach($faqGroup as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                        <i class="bi bi-question-circle"></i>
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse"
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @else
                <!-- Default FAQs -->
                <div class="fp-faq-category">
                    <h3 class="fp-faq-cat-title">Payments &amp; Plans</h3>
                    <div class="accordion fp-accordion" id="faqDefault">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="bi bi-question-circle"></i> How does FlexiPay installment work?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqDefault">
                                <div class="accordion-body">FlexiPay allows you to purchase products and pay over time. Choose from weekly (4–40 weeks) or monthly (1–12 months) plans. Pay 70% upfront to get your item shipped, then complete the remaining balance in installments.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="bi bi-question-circle"></i> What payment methods do you accept?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqDefault">
                                <div class="accordion-body">We accept credit/debit cards, bank transfers, USSD, and wallet payments. We integrate with Paystack, Flutterwave, and Korapay for secure transactions.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="bi bi-question-circle"></i> Can I pay off my plan early?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqDefault">
                                <div class="accordion-body">Yes! You can pay your next installment before the due date, pay any specific amount of your choice, or pay off the entire balance at once with no early payment penalty.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="bi bi-question-circle"></i> Can I change my installment plan?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqDefault">
                                <div class="accordion-body">Absolutely! You can request to change your installment type/duration. Simply go to your orders page, request a plan change with a reason, and our admin team will review and approve it.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fp-faq-category mt-4">
                    <h3 class="fp-faq-cat-title">Delivery &amp; Shipping</h3>
                    <div class="accordion fp-accordion" id="faqDelivery">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    <i class="bi bi-question-circle"></i> When will my item be delivered?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                                <div class="accordion-body">Your item will be shipped once you've paid at least 70% of the total order. Delivery times vary by location, typically 3–7 business days within major cities.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                    <i class="bi bi-question-circle"></i> Can I track my delivery?
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                                <div class="accordion-body">Yes! You can view your delivery timeline and tracking information from your orders page. We'll also send you notifications when your item is ready to ship.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                    <i class="bi bi-question-circle"></i> Can someone else receive my delivery?
                                </button>
                            </h2>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqDelivery">
                                <div class="accordion-body">Yes, you can assign a proxy (a registered store user) to receive your delivery if you're unavailable. You can manage this in your delivery settings.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="fp-faq-category mt-4">
                    <h3 class="fp-faq-cat-title">Insurance &amp; Returns</h3>
                    <div class="accordion fp-accordion" id="faqInsurance">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                                    <i class="bi bi-question-circle"></i> Can I insure my product?
                                </button>
                            </h2>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqInsurance">
                                <div class="accordion-body">Yes! You can add insurance to any product for 10% of the total order. This covers your product against damage, loss, or theft during the installment period.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                                    <i class="bi bi-question-circle"></i> Can I cancel my installment plan?
                                </button>
                            </h2>
                            <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqInsurance">
                                <div class="accordion-body">Yes, you can request to cancel your installment plan. A 10% cancellation charge applies. The remaining amount will be refunded to your wallet for future purchases.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                                    <i class="bi bi-question-circle"></i> Can I exchange my product?
                                </button>
                            </h2>
                            <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqInsurance">
                                <div class="accordion-body">Yes! You can request to exchange your product for one from your wishlist. Submit an exchange request with your reason, and our admin team will review and approve it.</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="fp-faq-cta text-center mt-5">
                    <p style="color:var(--text-muted);">Still have questions? We're here to help!</p>
                    <a href="{{ url('/contact') }}" class="btn-primary-gold">
                        <i class="bi bi-headset"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-faq-section {
    background: linear-gradient(135deg, var(--near-black), var(--surface-dark));
    padding: 80px 0;
    min-height: 100vh;
}
.fp-faq-category { margin-bottom: 24px; }
.fp-faq-cat-title {
    font-family: 'Syne', sans-serif;
    font-size: 18px; font-weight: 700;
    color: var(--gold-400);
    margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.fp-accordion .accordion-item {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm) !important;
    margin-bottom: 8px;
    overflow: hidden;
}
.fp-accordion .accordion-button {
    background: var(--card-dark);
    color: var(--text-primary);
    font-weight: 600;
    font-size: 14px;
    padding: 16px 20px;
    box-shadow: none;
    font-family: 'Space Grotesk', sans-serif;
}
.fp-accordion .accordion-button i {
    color: var(--gold-500);
    margin-right: 10px;
    font-size: 16px;
}
.fp-accordion .accordion-button:not(.collapsed) {
    background: rgba(234,179,8,0.05);
    color: var(--gold-400);
}
.fp-accordion .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23A1A1AA'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z'/%3e%3c/svg%3e");
}
.fp-accordion .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23EAB308'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 01.708 0L8 10.293l5.646-5.647a.5.5 0 01.708.708l-6 6a.5.5 0 01-.708 0l-6-6a.5.5 0 010-.708z'/%3e%3c/svg%3e");
}
.fp-accordion .accordion-body {
    color: var(--text-muted);
    font-size: 14px;
    line-height: 1.7;
    padding: 0 20px 20px;
}
</style>
@endsection