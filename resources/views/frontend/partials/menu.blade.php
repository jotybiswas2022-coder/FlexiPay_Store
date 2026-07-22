<!-- ===== TOP INFO BAR ===== -->
<div class="fp-topbar">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <span><i class="bi bi-telephone-fill"></i> +234 800-FLEXIPAY</span>
                <span class="d-none d-md-inline"><i class="bi bi-envelope-fill"></i> support@flexipay.store</span>
                <span class="d-none d-lg-inline"><i class="bi bi-clock-fill"></i> Mon–Sat: 8AM–6PM</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="#" title="Facebook" class="fp-social-top"><i class="bi bi-facebook"></i></a>
                <a href="#" title="Twitter/X" class="fp-social-top"><i class="bi bi-twitter-x"></i></a>
                <a href="#" title="Instagram" class="fp-social-top"><i class="bi bi-instagram"></i></a>
                <a href="#" title="WhatsApp" class="fp-social-top"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- ===== MAIN NAVBAR ===== -->
<nav class="fp-navbar navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-4">
        <!-- Brand -->
        <a class="navbar-brand fp-brand" href="{{ url('/') }}">
            <div class="fp-brand-icon">
                <i class="bi bi-currency-exchange"></i>
            </div>
            <div>
                <span class="fp-brand-text">Flexi<span class="fp-brand-accent">Pay</span></span>
                <small class="fp-brand-sub d-block">Buy Now, Pay in Installments</small>
            </div>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler fp-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#fpNavCollapse">
            <i class="bi bi-list"></i>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="fpNavCollapse">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link fp-nav-link {{ request()->is('/') ? 'fp-active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fp-nav-link {{ request()->is('shop') ? 'fp-active' : '' }}" href="{{ url('/shop') }}">
                        <i class="bi bi-grid-fill"></i> Shop
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link fp-nav-link {{ request()->is('orders*') ? 'fp-active' : '' }}" href="{{ url('/orders') }}">
                        <i class="bi bi-box-seam-fill"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fp-nav-link position-relative {{ request()->is('wallet*') ? 'fp-active' : '' }}" href="{{ url('/wallet') }}">
                        <i class="bi bi-wallet2"></i> Wallet
                        @php $wallet = optional(auth()->user()->wallet); @endphp
                        @if($wallet && $wallet->balance > 0)
                            <small class="fp-wallet-badge">₦{{ number_format($wallet->balance, 0) }}</small>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fp-nav-link position-relative {{ request()->is('wishlist*') ? 'fp-active' : '' }}" href="{{ url('/wishlist') }}">
                        <i class="bi bi-heart-fill"></i> Wishlist
                    </a>
                </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link fp-nav-link position-relative" href="{{ url('/cart') }}">
                        <i class="bi bi-cart-fill"></i> Cart
                        @php
                            $cartItems = session('cart', []);
                            $cartCount = is_array($cartItems) ? count($cartItems) : (is_object($cartItems) && method_exists($cartItems, 'count') ? $cartItems->count() : 0);
                        @endphp
                        @if($cartCount > 0)
                            <span class="fp-cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>

                @auth
                    @if(auth()->user()->is_admin == 1)
                    <li class="nav-item">
                        <a class="nav-link fp-nav-link {{ request()->is('admin') ? 'fp-active' : '' }}" href="{{ url('/admin') }}">
                            <i class="bi bi-speedometer2"></i> Admin
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link fp-nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name ?: 'Account' }}
                        </a>
                        <ul class="dropdown-menu fp-dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/profile') }}"><i class="bi bi-person-fill"></i> My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ url('/profile/edit') }}"><i class="bi bi-gear-fill"></i> Settings</a></li>
                            <li><a class="dropdown-item" href="{{ url('/orders') }}"><i class="bi bi-box-seam-fill"></i> My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ url('/wallet') }}"><i class="bi bi-wallet2"></i> Wallet</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item fp-logout-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fp-nav-link" href="{{ url('/login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="fp-register-btn" href="{{ url('/register') }}">
                            <i class="bi bi-person-plus-fill"></i> Get Started
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
/* ===== TOP BAR ===== */
.fp-topbar {
    background: var(--dark-900);
    color: var(--text-dim);
    padding: 6px 0;
    font-size: 12px;
    font-weight: 500;
    border-bottom: 1px solid var(--card-border);
}
.fp-topbar i { color: var(--gold-500); margin-right: 4px; font-size: 11px; }
.fp-social-top {
    color: var(--text-dim);
    font-size: 14px;
    transition: all 0.3s;
    padding: 2px 6px;
}
.fp-social-top:hover { color: var(--gold-400); }

/* ===== NAVBAR ===== */
.fp-navbar {
    background: var(--surface-dark);
    border-bottom: 2px solid var(--gold-500);
    padding: 0 !important;
    z-index: 1040;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    transition: all 0.3s;
    animation: navSlideDown 0.6s ease-out;
}
.fp-navbar.scrolled {
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
    background: rgba(18,18,20,0.95);
    backdrop-filter: blur(12px);
}
@keyframes navSlideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* ===== BRAND ===== */
.fp-brand {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 8px 0 !important;
    text-decoration: none;
    transition: transform 0.3s;
}
.fp-brand:hover { transform: translateY(-1px); }
.fp-brand-icon {
    width: 46px; height: 46px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: var(--near-black); font-size: 22px;
    box-shadow: var(--shadow-gold);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-brand:hover .fp-brand-icon {
    transform: rotate(-8deg) scale(1.08);
    box-shadow: var(--shadow-gold-lg);
}
.fp-brand-text {
    font-family: 'Syne', sans-serif;
    font-size: 22px; font-weight: 800;
    color: var(--text-primary); line-height: 1;
    display: block;
}
.fp-brand-accent { color: var(--gold-500); }
.fp-brand-sub { font-size: 10px; color: var(--text-dim); font-weight: 500; margin-top: 1px; }

/* ===== NAV LINKS ===== */
.fp-nav-link {
    color: var(--text-muted) !important;
    font-weight: 600; font-size: 13px;
    padding: 22px 14px !important;
    display: flex; align-items: center; gap: 6px;
    position: relative; transition: all 0.3s;
    white-space: nowrap;
}
.fp-nav-link::after {
    content: ''; position: absolute; bottom: 0;
    left: 50%; transform: translateX(-50%);
    width: 0; height: 2px; background: var(--gold-500);
    transition: width 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 2px 2px 0 0;
}
.fp-nav-link:hover { color: var(--gold-400) !important; }
.fp-nav-link:hover::after { width: 70%; }
.fp-active { color: var(--gold-400) !important; font-weight: 700; }
.fp-active::after { width: 70% !important; }

/* Badges */
.fp-cart-badge {
    position: absolute; top: 12px; right: 2px;
    background: var(--gold-500); color: var(--near-black);
    font-size: 10px; font-weight: 800;
    min-width: 18px; height: 18px;
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    line-height: 1;
}
.fp-wallet-badge {
    font-size: 10px; color: var(--gold-400);
    background: rgba(234,179,8,0.12);
    padding: 2px 6px; border-radius: 4px;
    font-weight: 600;
}

/* Toggler */
.fp-toggler {
    padding: 8px !important; font-size: 24px;
    color: var(--text-primary);
}
.fp-toggler:focus { box-shadow: 0 0 0 3px rgba(234,179,8,0.2) !important; }

/* Dropdown */
.fp-dropdown-menu {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    padding: 8px;
    box-shadow: var(--shadow-card);
    min-width: 200px;
}
.fp-dropdown-menu .dropdown-item {
    color: var(--text-muted);
    font-size: 13px;
    font-weight: 500;
    padding: 10px 14px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}
.fp-dropdown-menu .dropdown-item:hover {
    background: rgba(234,179,8,0.1);
    color: var(--gold-400);
}
.fp-dropdown-menu .dropdown-divider {
    border-color: var(--card-border);
}
.fp-logout-item { background: none !important; border: none; width: 100%; cursor: pointer; font-family: inherit; }
.fp-logout-item:hover { background: rgba(239,68,68,0.1) !important; color: #ef4444 !important; }

/* Register Button */
.fp-register-btn {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black) !important;
    padding: 10px 22px; border-radius: var(--radius-sm);
    font-weight: 700; font-size: 13px;
    display: inline-flex; align-items: center; gap: 6px;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: var(--shadow-gold);
    white-space: nowrap;
}
.fp-register-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-gold-lg);
    color: var(--near-black) !important;
}

@media (max-width: 991px) {
    .fp-nav-link { padding: 12px 8px !important; }
    .fp-navbar .navbar-collapse { padding: 12px 0; border-top: 1px solid var(--card-border); margin-top: 8px; }
    .fp-register-btn { margin: 8px 0; display: inline-flex; }
}
</style>

<script>
// Navbar scroll effect
const fpNavbar = document.querySelector('.fp-navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) fpNavbar.classList.add('scrolled');
    else fpNavbar.classList.remove('scrolled');
});

// Dropdown close on mobile after click
document.querySelectorAll('.fp-dropdown-menu .dropdown-item').forEach(item => {
    item.addEventListener('click', () => {
        const collapse = document.getElementById('fpNavCollapse');
        if (collapse.classList.contains('show')) {
            const toggler = document.querySelector('.fp-toggler');
            if (toggler) toggler.click();
        }
    });
});
</script>