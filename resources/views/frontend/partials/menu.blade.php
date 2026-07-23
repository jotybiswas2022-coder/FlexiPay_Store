<!-- ===== TOP INFO BAR ===== -->
<div class="fp-topbar">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <span class="fp-topbar-item"><i class="bi bi-telephone-fill"></i> +234 800-FLEXIPAY</span>
                <span class="fp-topbar-item d-none d-md-inline"><i class="bi bi-envelope-fill"></i> support@flexipay.store</span>
                <span class="fp-topbar-item d-none d-lg-inline"><i class="bi bi-clock-fill"></i> Mon–Sat: 8AM–6PM</span>
            </div>
            <div class="d-flex align-items-center gap-1">
                <a href="#" title="Facebook" class="fp-social-top"><i class="bi bi-facebook"></i></a>
                <a href="#" title="Twitter/X" class="fp-social-top"><i class="bi bi-twitter-x"></i></a>
                <a href="#" title="Instagram" class="fp-social-top"><i class="bi bi-instagram"></i></a>
                <a href="#" title="WhatsApp" class="fp-social-top"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- ===== MAIN NAVBAR ===== -->
<nav class="fp-navbar navbar navbar-expand-lg sticky-top" id="fpMainNav" aria-label="Main navigation">
    <div class="container-fluid px-4">
        <a class="navbar-brand fp-brand" href="{{ url('/') }}">
            <div class="fp-brand-icon">
                <i class="bi bi-currency-exchange"></i>
            </div>
            <div>
                <span class="fp-brand-text">Flexi<span class="fp-brand-accent">Pay</span></span>
                <small class="fp-brand-sub d-block">Buy Now, Pay in Installments</small>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2 d-lg-none">
            <a href="{{ url('/cart') }}" class="fp-mobile-cart position-relative">
                <i class="bi bi-cart-fill"></i>
                @php
                    $cartItems = session('cart', []);
                    $cartCount = is_array($cartItems) ? count($cartItems) : (is_object($cartItems) && method_exists($cartItems, 'count') ? $cartItems->count() : 0);
                @endphp
                @if($cartCount > 0)
                    <span class="fp-cart-badge-mobile">{{ $cartCount }}</span>
                @endif
            </a>
            <button class="navbar-toggler fp-toggler border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#fpNavCollapse"
                    aria-controls="fpNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <div class="fp-toggler-icon">
                    <span></span><span></span><span></span>
                </div>
            </button>
        </div>

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

                <li class="nav-item d-none d-lg-block">
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
                        <a class="nav-link fp-nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="fp-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                            <span class="d-none d-lg-inline">{{ auth()->user()->name ?: 'Account' }}</span>
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
.fp-topbar {
    background: var(--dark-900);
    color: var(--text-dim);
    padding: 5px 0;
    font-size: 12px;
    font-weight: 500;
    border-bottom: 1px solid var(--card-border);
    position: relative;
    z-index: 1041;
}
.fp-topbar i { color: var(--gold-500); margin-right: 4px; font-size: 11px; }
.fp-topbar-item { display: inline-flex; align-items: center; }
.fp-social-top {
    color: var(--text-dim);
    font-size: 14px;
    transition: all 0.3s;
    padding: 2px 5px;
    border-radius: 4px;
}
.fp-social-top:hover { color: var(--gold-400); background: rgba(234,179,8,0.06); }

.fp-navbar {
    padding: 0 !important;
    z-index: 1040;
    background: var(--surface-dark);
    border-bottom: 1px solid var(--card-border);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    animation: navSlideDown 0.6s ease-out;
    transition: all 0.3s ease;
}
.fp-navbar.scrolled {
    background: rgba(18,18,20,0.92);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border-bottom-color: rgba(234,179,8,0.15);
    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
}

@keyframes navSlideDown {
    from { transform: translateY(-100%); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.fp-brand {
    display: flex !important;
    align-items: center;
    gap: 10px;
    padding: 6px 0 !important;
    text-decoration: none;
    transition: transform 0.3s;
}
.fp-brand:hover { transform: translateY(-1px); }
.fp-brand-icon {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: var(--near-black); font-size: 20px;
    box-shadow: var(--shadow-gold);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-brand:hover .fp-brand-icon {
    transform: rotate(-8deg) scale(1.08);
    box-shadow: var(--shadow-gold-lg);
}
.fp-brand-text {
    font-family: 'Syne', sans-serif;
    font-size: 20px; font-weight: 800;
    color: var(--text-primary); line-height: 1;
    display: block;
}
.fp-brand-accent { color: var(--gold-500); }
.fp-brand-sub { font-size: 9px; color: var(--text-dim); font-weight: 500; margin-top: 1px; letter-spacing: 0.3px; }

.fp-nav-link {
    color: var(--text-muted) !important;
    font-weight: 600; font-size: 13px;
    padding: 20px 12px !important;
    display: flex; align-items: center; gap: 6px;
    position: relative; transition: all 0.3s;
    white-space: nowrap;
}
.fp-nav-link::after {
    content: ''; position: absolute; bottom: 0;
    left: 50%; transform: translateX(-50%);
    width: 0; height: 2px;
    background: linear-gradient(90deg, var(--gold-500), var(--gold-400));
    transition: width 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border-radius: 2px 2px 0 0;
    box-shadow: 0 0 8px rgba(234,179,8,0.3);
}
.fp-nav-link:hover { color: var(--gold-400) !important; }
.fp-nav-link:hover::after { width: 70%; }
.fp-active { color: var(--gold-400) !important; font-weight: 700; }
.fp-active::after { width: 70% !important; }

.fp-cart-badge {
    position: absolute; top: 10px; right: 0;
    background: var(--gold-500); color: var(--near-black);
    font-size: 10px; font-weight: 800;
    min-width: 18px; height: 18px;
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    line-height: 1;
    box-shadow: 0 0 8px rgba(234,179,8,0.3);
}
.fp-wallet-badge {
    font-size: 9px; color: var(--gold-400);
    background: rgba(234,179,8,0.12);
    padding: 2px 5px; border-radius: 4px;
    font-weight: 600;
    margin-left: 2px;
}

.fp-avatar {
    width: 32px; height: 32px; border-radius: 8px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-700));
    color: var(--near-black);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 800;
    margin-right: 6px;
    flex-shrink: 0;
}

.fp-toggler {
    padding: 6px !important;
    background: transparent !important;
    box-shadow: none !important;
}
.fp-toggler:focus { outline: none; }
.fp-toggler-icon {
    width: 24px; height: 18px; position: relative;
    display: flex; flex-direction: column; justify-content: space-between;
}
.fp-toggler-icon span {
    display: block; height: 2px; width: 100%;
    background: var(--text-primary);
    border-radius: 2px;
    transition: all 0.3s;
    transform-origin: center;
}
.fp-toggler[aria-expanded="true"] .fp-toggler-icon span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
.fp-toggler[aria-expanded="true"] .fp-toggler-icon span:nth-child(2) { opacity: 0; }
.fp-toggler[aria-expanded="true"] .fp-toggler-icon span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

.fp-mobile-cart {
    color: var(--text-primary); font-size: 20px;
    padding: 6px; transition: color 0.3s;
}
.fp-mobile-cart:hover { color: var(--gold-400); }
.fp-cart-badge-mobile {
    position: absolute; top: 0; right: 0;
    background: var(--gold-500); color: var(--near-black);
    font-size: 9px; font-weight: 800;
    min-width: 16px; height: 16px;
    border-radius: 50%; display: flex;
    align-items: center; justify-content: center;
    line-height: 1;
}

.fp-dropdown-menu {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    padding: 6px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    min-width: 200px;
    animation: dropdownFade 0.2s ease-out;
}
@keyframes dropdownFade {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
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
.fp-dropdown-menu .dropdown-divider { border-color: var(--card-border); }
.fp-logout-item { background: none !important; border: none; width: 100%; cursor: pointer; font-family: inherit; }
.fp-logout-item:hover { background: rgba(239,68,68,0.1) !important; color: #ef4444 !important; }

.fp-register-btn {
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black) !important;
    padding: 10px 22px; border-radius: 10px;
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
    .fp-nav-link { padding: 12px 16px !important; border-radius: 8px; margin: 2px 8px; }
    .fp-nav-link::after { display: none; }
    .fp-active { background: rgba(234,179,8,0.08); }
    .fp-navbar .navbar-collapse {
        padding: 8px 0 16px;
        border-top: 1px solid var(--card-border);
        margin-top: 4px;
        max-height: calc(100vh - 80px);
        overflow-y: auto;
    }
    .fp-register-btn { margin: 4px 16px; display: flex; justify-content: center; }
    .fp-navbar .dropdown-menu {
        background: transparent; border: none;
        box-shadow: none; padding: 0 0 0 16px;
        animation: none;
    }
    .fp-navbar .dropdown-menu .dropdown-item {
        padding: 8px 12px;
        font-size: 12px;
    }
    .fp-navbar .dropdown-menu .dropdown-divider { display: none; }
    .fp-brand { padding: 4px 0 !important; }
    .fp-brand-icon { width: 36px; height: 36px; font-size: 17px; }
    .fp-brand-text { font-size: 17px; }
    .fp-brand-sub { font-size: 8px; }
}
</style>

<script>
(function() {
    const nav = document.getElementById('fpMainNav');
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                nav.classList.toggle('scrolled', window.scrollY > 20);
                ticking = false;
            });
            ticking = true;
        }
    });

    document.querySelectorAll('.fp-dropdown-menu .dropdown-item, .fp-nav-link').forEach(item => {
        item.addEventListener('click', () => {
            const collapse = document.getElementById('fpNavCollapse');
            if (collapse.classList.contains('show')) {
                const toggler = document.querySelector('.fp-toggler');
                if (toggler) toggler.click();
            }
        });
    });

    document.querySelectorAll('.fp-navbar .dropdown').forEach(dd => {
        dd.addEventListener('show.bs.dropdown', () => {
            dd.querySelector('.dropdown-toggle')?.setAttribute('aria-expanded', 'true');
        });
        dd.addEventListener('hide.bs.dropdown', () => {
            dd.querySelector('.dropdown-toggle')?.setAttribute('aria-expanded', 'false');
        });
    });
})();
</script>