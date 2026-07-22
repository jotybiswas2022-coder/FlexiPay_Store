@extends('frontend.app')
@section('title', 'Contact Us — FlexiPay Store')

@section('content')
<section class="fp-contact-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-badge"><i class="bi bi-headset"></i> Contact Us</div>
                <h1 class="fp-contact-title">We're Here to Help</h1>
                <p class="fp-contact-desc">Have questions about payments, delivery, or your account? Reach out to our team and we'll get back to you within 24 hours.</p>

                <div class="fp-contact-info">
                    <div class="fp-ci-card">
                        <div class="fp-ci-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <strong>Email</strong>
                            <span>support@flexipay.store</span>
                        </div>
                    </div>
                    <div class="fp-ci-card">
                        <div class="fp-ci-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <strong>Phone</strong>
                            <span>+234 800-FLEXIPAY</span>
                        </div>
                    </div>
                    <div class="fp-ci-card">
                        <div class="fp-ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <strong>Location</strong>
                            <span>Lagos, Nigeria</span>
                        </div>
                    </div>
                    <div class="fp-ci-card">
                        <div class="fp-ci-icon"><i class="bi bi-clock-fill"></i></div>
                        <div>
                            <strong>Working Hours</strong>
                            <span>Mon–Sat: 8AM – 6PM (WAT)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="fp-contact-form-card">
                    <h3>Send Us a Message</h3>
                    <p>Fill in the form and we'll respond promptly.</p>

                    @if(session('success'))
                        <div class="fp-alert-success">
                            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="fp-form-group">
                                    <label><i class="bi bi-person-fill"></i> Full Name</label>
                                    <input type="text" name="name" class="fp-form-control" placeholder="John Doe" required value="{{ auth()->user()->name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fp-form-group">
                                    <label><i class="bi bi-envelope-fill"></i> Email</label>
                                    <input type="email" name="email" class="fp-form-control" placeholder="john@example.com" required value="{{ auth()->user()->email ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fp-form-group">
                                    <label><i class="bi bi-chat-dots-fill"></i> Subject</label>
                                    <select name="subject" class="fp-form-control" required>
                                        <option value="">Select a topic...</option>
                                        <option value="Payment">Payment Issue</option>
                                        <option value="Delivery">Delivery Question</option>
                                        <option value="Installment">Installment Plan</option>
                                        <option value="Account">Account Support</option>
                                        <option value="Product">Product Inquiry</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="fp-form-group">
                                    <label><i class="bi bi-pencil-fill"></i> Message</label>
                                    <textarea name="message" class="fp-form-control fp-textarea" rows="4" placeholder="Describe your issue or question..." required></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="fp-submit-btn w-100">
                                    <i class="bi bi-send-fill"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-contact-hero {
    padding: 80px 0 60px;
    background: linear-gradient(135deg, var(--near-black), var(--surface-dark));
    min-height: 100vh;
}
.fp-contact-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(32px, 4vw, 48px);
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 16px;
}
.fp-contact-desc {
    color: var(--text-muted);
    font-size: 16px;
    line-height: 1.7;
    margin-bottom: 36px;
    max-width: 480px;
}
.fp-contact-info {
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.fp-ci-card {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    padding: 16px 20px;
    transition: all 0.3s;
}
.fp-ci-card:hover {
    border-color: rgba(234,179,8,0.25);
    transform: translateX(4px);
}
.fp-ci-icon {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: rgba(234,179,8,0.1);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-500); font-size: 18px;
    flex-shrink: 0;
}
.fp-ci-card strong {
    display: block;
    font-size: 13px;
    color: var(--text-primary);
    margin-bottom: 2px;
}
.fp-ci-card span {
    font-size: 14px;
    color: var(--text-muted);
}

/* Form Card */
.fp-contact-form-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-lg);
    padding: 36px 32px;
}
.fp-contact-form-card h3 {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 6px;
}
.fp-contact-form-card > p {
    color: var(--text-muted);
    font-size: 14px;
    margin-bottom: 24px;
}

.fp-alert-success {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(34,197,94,0.1);
    border: 1px solid rgba(34,197,94,0.25);
    color: #4ade80;
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    font-weight: 500;
    font-size: 13px;
    margin-bottom: 20px;
}

.fp-form-group { margin-bottom: 4px; }
.fp-form-group label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}
.fp-form-group label i { color: var(--gold-500); font-size: 13px; }
.fp-form-control {
    width: 100%;
    padding: 12px 16px;
    background: var(--surface-dark);
    border: 1.5px solid var(--card-border);
    border-radius: var(--radius-sm);
    color: var(--text-primary);
    font-family: 'Space Grotesk', sans-serif;
    font-size: 14px;
    outline: none;
    transition: all 0.2s;
}
.fp-form-control:focus {
    border-color: var(--gold-500);
    box-shadow: 0 0 0 3px rgba(234,179,8,0.08);
}
.fp-form-control::placeholder { color: var(--text-dim); }
.fp-form-control option { background: var(--card-dark); color: var(--text-primary); }
.fp-textarea { resize: vertical; min-height: 120px; }

@media (max-width: 991px) {
    .fp-contact-hero { padding: 50px 0; }
    .fp-contact-form-card { margin-top: 32px; }
}
</style>
@endsection