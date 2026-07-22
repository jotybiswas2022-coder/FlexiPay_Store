@php
use App\Models\Setting;
$settings = Setting::first();
$email = $settings?->email ?? 'support@flexipay.store';
$phone = $settings?->phone ?? '+234 800-FLEXIPAY';
$location = $settings?->location ?? 'Lagos, Nigeria';
@endphp

<!-- ===== FOOTER ===== -->
<footer class="fp-footer">
    <!-- Newsletter -->
    <div class="fp-newsletter">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <div class="fp-nl-content">
                        <i class="bi bi-envelope-paper-fill fp-nl-icon"></i>
                        <div>
                            <h4>Stay in the Loop</h4>
                            <p>Get exclusive deals, payment tips, and new arrivals</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form class="fp-nl-form" onsubmit="handleNLSubmit(event)">
                        <input type="email" placeholder="Enter your email address" required>
                        <button type="submit"><i class="bi bi-send-fill"></i> Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div class="fp-footer-main">
        <div class="container">
            <div class="row g-5">
                <!-- Brand Column -->
                <div class="col-lg-4 col-md-6">
                    <div class="fp-footer-brand">
                        <div class="fp-footer-logo">
                            <div class="fp-footer-logo-icon"><i class="bi bi-currency-exchange"></i></div>
                            <span>Flexi<span>Pay</span></span>
                        </div>
                        <p>Nigeria's premier installment payment platform. Shop what you love today and pay over time with flexible plans designed for your budget.</p>
                        <div class="fp-footer-info">
                            <div class="fp-fi-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $location }}</span>
                            </div>
                            <div class="fp-fi-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>{{ $phone }}</span>
                            </div>
                            <div class="fp-fi-item">
                                <i class="bi bi-envelope-fill"></i>
                                <span>{{ $email }}</span>
                            </div>
                            <div class="fp-fi-item">
                                <i class="bi bi-clock-fill"></i>
                                <span>Mon–Sat: 8AM – 6PM (WAT)</span>
                            </div>
                        </div>
                        <div class="fp-social-links">
                            <a href="#" class="fp-social-btn facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="fp-social-btn twitter"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" class="fp-social-btn instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="fp-social-btn whatsapp"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="fp-social-btn youtube"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="fp-footer-col">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/shop') }}">Shop</a></li>
                            <li><a href="{{ url('/about') }}">About Us</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                            <li><a href="{{ url('/faq') }}">FAQs</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Customer Service -->
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="fp-footer-col">
                        <h5>Customer Service</h5>
                        <ul>
                            <li><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                            <li><a href="{{ url('/terms/payment') }}">Payment Plans</a></li>
                            <li><a href="{{ url('/terms/delivery') }}">Delivery Policy</a></li>
                            <li><a href="{{ url('/terms/returns') }}">Returns & Exchanges</a></li>
                            <li><a href="{{ url('/terms/privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Payment & Trust -->
                <div class="col-lg-3 col-md-6">
                    <div class="fp-footer-col">
                        <h5>Pay With</h5>
                        <div class="fp-payment-methods">
                            <span class="fp-pm-item"><i class="bi bi-credit-card-fill"></i> Credit/Debit</span>
                            <span class="fp-pm-item"><i class="bi bi-bank"></i> Bank Transfer</span>
                            <span class="fp-pm-item"><i class="bi bi-phone-fill"></i> USSD</span>
                            <span class="fp-pm-item"><i class="bi bi-wallet2"></i> Wallet</span>
                        </div>
                        <div class="fp-trust-badges mt-3">
                            <div class="fp-trust-badge"><i class="bi bi-shield-fill-check"></i> Secured Payments</div>
                            <div class="fp-trust-badge"><i class="bi bi-patch-check-fill"></i> Verified Store</div>
                            <div class="fp-trust-badge"><i class="bi bi-clock-history"></i> Flexible Plans</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="fp-footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; {{ date('Y') }} <span>FlexiPay Store</span> — All rights reserved. Made with <i class="bi bi-heart-fill" style="color:#ef4444;"></i> in Nigeria</p>
                </div>
                <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                    <a href="{{ url('/terms/privacy') }}">Privacy</a>
                    <span class="fp-sep">|</span>
                    <a href="{{ url('/terms') }}">Terms</a>
                    <span class="fp-sep">|</span>
                    <a href="{{ url('/contact') }}">Support</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.fp-footer { background: var(--dark-950); }

/* Newsletter */
.fp-newsletter {
    background: linear-gradient(135deg, var(--gold-600), var(--gold-700));
    padding: 36px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}
.fp-nl-content { display: flex; align-items: center; gap: 16px; color: var(--near-black); }
.fp-nl-icon { font-size: 38px; color: rgba(0,0,0,0.4); flex-shrink: 0; }
.fp-nl-content h4 { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; margin-bottom: 4px; color: var(--near-black); }
.fp-nl-content p { font-size: 14px; color: rgba(0,0,0,0.6); margin: 0; }
.fp-nl-form { display: flex; gap: 0; border-radius: var(--radius-sm); overflow: hidden; box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
.fp-nl-form input {
    flex: 1; padding: 14px 20px; border: none;
    background: rgba(0,0,0,0.2); color: white;
    font-size: 14px; outline: none; font-family: inherit;
    border: 1px solid rgba(255,255,255,0.15);
    border-right: none;
}
.fp-nl-form input::placeholder { color: rgba(255,255,255,0.5); }
.fp-nl-form button {
    background: var(--near-black); color: var(--gold-400); border: none;
    padding: 14px 28px; font-weight: 700; font-size: 14px;
    cursor: pointer; display: flex; align-items: center; gap: 8px;
    transition: all 0.3s; font-family: inherit; white-space: nowrap;
}
.fp-nl-form button:hover { background: var(--dark-900); color: var(--gold-300); }

/* Main Footer */
.fp-footer-main { padding: 72px 0 48px; }

.fp-footer-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
.fp-footer-logo-icon {
    width: 44px; height: 44px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    display: flex; align-items: center; justify-content: center;
    color: var(--near-black); font-size: 20px;
}
.fp-footer-logo span { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; color: var(--text-primary); }
.fp-footer-logo span span { color: var(--gold-500); }
.fp-footer-brand p { color: var(--text-dim); font-size: 14px; line-height: 1.8; margin-bottom: 24px; max-width: 360px; }

.fp-footer-info { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
.fp-fi-item { display: flex; align-items: center; gap: 10px; color: var(--text-dim); font-size: 13.5px; }
.fp-fi-item i { color: var(--gold-500); font-size: 13px; width: 16px; }

.fp-social-links { display: flex; gap: 10px; }
.fp-social-btn {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; color: var(--text-muted); transition: all 0.3s;
    border: 1px solid var(--card-border);
}
.fp-social-btn:hover { transform: translateY(-3px); color: white; }
.fp-social-btn.facebook:hover { background: #1877f2; border-color: #1877f2; }
.fp-social-btn.twitter:hover { background: #000; border-color: #333; }
.fp-social-btn.instagram:hover { background: linear-gradient(135deg,#f58529,#dd2a7b,#8134af); border-color: transparent; }
.fp-social-btn.whatsapp:hover { background: #25d366; border-color: #25d366; }
.fp-social-btn.youtube:hover { background: #ff0000; border-color: #ff0000; }

.fp-footer-col h5 {
    color: var(--text-primary); font-size: 15px; font-weight: 700;
    margin-bottom: 20px; padding-bottom: 10px;
    border-bottom: 2px solid rgba(234,179,8,0.2);
    position: relative;
}
.fp-footer-col h5::after {
    content: ''; position: absolute; bottom: -2px; left: 0;
    width: 32px; height: 2px; background: var(--gold-500);
}
.fp-footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 8px; }
.fp-footer-col ul li a {
    color: var(--text-dim); font-size: 14px;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.3s; padding: 2px 0;
}
.fp-footer-col ul li a::before { content: '›'; color: var(--gold-500); font-size: 16px; font-weight: 700; transition: transform 0.3s; }
.fp-footer-col ul li a:hover { color: var(--gold-400); padding-left: 4px; }
.fp-footer-col ul li a:hover::before { transform: translateX(3px); }

.fp-payment-methods { display: flex; flex-wrap: wrap; gap: 8px; }
.fp-pm-item {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--card-dark); border: 1px solid var(--card-border);
    color: var(--text-muted); padding: 8px 14px; border-radius: var(--radius-sm);
    font-size: 12.5px; font-weight: 500;
}
.fp-pm-item i { color: var(--gold-500); }

.fp-trust-badges { display: flex; flex-direction: column; gap: 6px; }
.fp-trust-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 12.5px; font-weight: 500; color: var(--text-dim);
}
.fp-trust-badge i { color: var(--gold-500); font-size: 13px; }

/* Bottom */
.fp-footer-bottom {
    border-top: 1px solid var(--card-border);
    padding: 20px 0;
    background: rgba(0,0,0,0.3);
}
.fp-footer-bottom p { color: var(--text-dim); font-size: 13px; margin: 0; }
.fp-footer-bottom p span { color: var(--gold-500); font-weight: 700; }
.fp-footer-bottom a { color: var(--text-dim); font-size: 13px; transition: color 0.3s; }
.fp-footer-bottom a:hover { color: var(--gold-400); }
.fp-sep { color: var(--card-border); margin: 0 8px; }

@media (max-width: 991px) {
    .fp-nl-content { margin-bottom: 8px; }
}
@media (max-width: 576px) {
    .fp-nl-form { flex-direction: column; }
    .fp-nl-form button { justify-content: center; }
}
</style>

<script>
function handleNLSubmit(e) {
    e.preventDefault();
    const btn = e.target.querySelector('button');
    btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Subscribed!';
    btn.style.background = 'var(--gold-600)';
    btn.style.color = '#000';
    setTimeout(() => {
        btn.innerHTML = '<i class="bi bi-send-fill"></i> Subscribe';
        btn.style.background = '';
        btn.style.color = '';
        e.target.querySelector('input').value = '';
    }, 3000);
}

// Animate footer columns on scroll
const footerObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.style.animation = 'fadeInUp 0.6s ease-out both';
            footerObs.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.fp-footer-col, .fp-footer-brand').forEach(el => footerObs.observe(el));
</script>