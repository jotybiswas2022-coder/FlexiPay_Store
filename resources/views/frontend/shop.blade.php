@extends('frontend.app')
@section('title', 'Shop — FlexiPay Store')

@section('content')
<section class="fp-shop-hero">
    <div class="fp-shop-hero-bg">
        <div class="fp-shop-grid"></div>
        <div class="fp-shop-orb sorb1"></div>
        <div class="fp-shop-orb sorb2"></div>
    </div>
    <div class="container position-relative">
        <div class="text-center">
            <div class="section-badge reveal-up" style="margin:0 auto 14px;display:inline-flex;">
                <i class="bi bi-grid-fill"></i> Shop
            </div>
            <h1 class="fp-shop-title reveal-up">
                Browse Our Products
            </h1>
            <p class="fp-shop-desc reveal-up">
                Find everything you need with flexible payment plans
            </p>
        </div>

        <div class="fp-shop-filters-wrap reveal-up">
            <div class="fp-shop-filters-header">
                <span class="fp-filters-label"><i class="bi bi-sliders2"></i> Filters</span>
                <button type="button" class="fp-filters-toggle d-lg-none" onclick="toggleFilters()">
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>
            <form method="GET" action="{{ url('/shop') }}" class="fp-shop-filters" id="fpFilterForm">
                <div class="row g-3 align-items-end">
                    <div class="col-lg-4 col-md-6">
                        <div class="fp-filter-group">
                            <label><i class="bi bi-search"></i> Search</label>
                            <div class="fp-filter-input-wrap">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" class="fp-filter-input" placeholder="Search products..." value="{{ request('search') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="fp-filter-group">
                            <label><i class="bi bi-tag-fill"></i> Category</label>
                            <div class="fp-select-wrap">
                                <select name="category_id" class="fp-filter-input fp-select-input">
                                    <option value="">All Categories</option>
                                    @foreach($categories ?? [] as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="fp-filter-group">
                            <label><i class="bi bi-building"></i> Brand</label>
                            <div class="fp-select-wrap">
                                <select name="brand_id" class="fp-filter-input fp-select-input">
                                    <option value="">All Brands</option>
                                    @foreach($brands ?? [] as $brand)
                                        <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="fp-filter-group">
                            <label><i class="bi bi-sort-down"></i> Sort By</label>
                            <div class="fp-select-wrap">
                                <select name="sort" class="fp-filter-input fp-select-input">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low</option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A–Z</option>
                                </select>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <button type="submit" class="fp-filter-apply w-100">
                            <i class="bi bi-funnel-fill"></i> Apply
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(request('search') || request('category_id') || request('brand_id'))
        <div class="fp-active-filters reveal-up">
            <span class="fp-active-label"><i class="bi bi-funnel-fill"></i> Active filters:</span>
            @if(request('search'))
                <span class="fp-active-tag">"{{ request('search') }}" <a href="{{ url('/shop?'.http_build_query(array_merge(request()->except('search','page')))) }}"><i class="bi bi-x"></i></a></span>
            @endif
            @if(request('category_id'))
                <span class="fp-active-tag">{{ $categories->firstWhere('id', request('category_id'))?->name ?? 'Category' }} <a href="{{ url('/shop?'.http_build_query(array_merge(request()->except('category_id','page')))) }}"><i class="bi bi-x"></i></a></span>
            @endif
            @if(request('brand_id'))
                <span class="fp-active-tag">{{ $brands->firstWhere('id', request('brand_id'))?->name ?? 'Brand' }} <a href="{{ url('/shop?'.http_build_query(array_merge(request()->except('brand_id','page')))) }}"><i class="bi bi-x"></i></a></span>
            @endif
            <a href="{{ url('/shop') }}" class="fp-active-clear"><i class="bi bi-x-lg"></i> Clear All</a>
        </div>
        @endif
    </div>
</section>

<section class="section-padding" style="background:var(--near-black);padding-top:0;">
    <div class="container">
        <div class="fp-toolbar reveal-up">
            <div class="fp-toolbar-left">
                <span class="fp-result-count"><i class="bi bi-box-seam-fill"></i> {{ $products->total() ?? 0 }} product{{ ($products->total() ?? 0) !== 1 ? 's' : '' }} found</span>
            </div>
            <div class="fp-toolbar-right">
                <div class="fp-view-toggle">
                    <button type="button" class="fp-view-btn fp-view-btn--active" data-view="grid" title="Grid View" aria-label="Grid View"><i class="bi bi-grid-3x3-gap-fill"></i></button>
                    <button type="button" class="fp-view-btn" data-view="list" title="List View" aria-label="List View"><i class="bi bi-list-ul"></i></button>
                </div>
            </div>
        </div>

        <div class="row g-4 fp-products-grid" id="fpProductsGrid">
            @forelse($products ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6 fp-product-col">
                <div class="fp-shop-card reveal-up" data-tilt="6">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-shop-card-link">
                        <div class="fp-shop-card-img">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="fp-shop-card-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            @if($product->installment_from)
                                <span class="fp-shop-card-badge">₦{{ number_format($product->installment_from, 0) }}/mo</span>
                            @endif
                            @if($product->compare_price && $product->compare_price > $product->price)
                                @php $discount = round((($product->compare_price - $product->price) / $product->compare_price) * 100); @endphp
                                @if($discount > 0)
                                    <span class="fp-shop-card-discount">-{{ $discount }}%</span>
                                @endif
                            @endif
                            <div class="fp-shop-card-overlay">
                                <span class="fp-shop-card-quickview"><i class="bi bi-eye-fill"></i> Quick View</span>
                            </div>
                        </div>
                        <div class="fp-shop-card-body">
                            @if($product->brand)
                                <span class="fp-shop-card-brand">{{ $product->brand->name }}</span>
                            @endif
                            <h6>{{ Str::limit($product->name, 50) }}</h6>
                            <div class="fp-shop-card-price">
                                <span class="fp-shop-current-price">₦{{ number_format($product->price, 0) }}</span>
                                @if($product->compare_price)
                                    <span class="fp-shop-old-price">₦{{ number_format($product->compare_price, 0) }}</span>
                                @endif
                            </div>
                            <div class="fp-shop-card-meta">
                                <span><i class="bi bi-coin"></i> Installments available</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="fp-shop-empty">
                    <div class="fp-shop-empty-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h4>No Products Found</h4>
                    <p>Try adjusting your filters or search terms.</p>
                    <a href="{{ url('/shop') }}" class="btn-primary-gold"><i class="bi bi-arrow-counterclockwise"></i> Reset Filters</a>
                </div>
            </div>
            @endforelse
        </div>

        @if(method_exists($products ?? [], 'links'))
        <div class="fp-pagination-wrap reveal-up">
            {{ $products->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<style>
/* ===== SHOP HERO ===== */
.fp-shop-hero {
    background: linear-gradient(135deg, #0A0A0B 0%, #1A1A1E 30%, #0A0A0B 70%);
    padding: 70px 0 40px;
    position: relative; overflow: hidden;
    border-bottom: 1px solid var(--card-border);
}
.fp-shop-hero-bg { position: absolute; inset: 0; pointer-events: none; }
.fp-shop-grid {
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(234,179,8,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(234,179,8,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
}
.fp-shop-orb {
    position: absolute; border-radius: 50%; filter: blur(80px);
    animation: shopOrbFloat 8s ease-in-out infinite alternate;
}
.sorb1 { width: 350px; height: 350px; background: rgba(234,179,8,0.06); top: -150px; left: 10%; }
.sorb2 { width: 250px; height: 250px; background: rgba(234,179,8,0.04); bottom: -100px; right: 15%; animation-delay: 4s; }
@keyframes shopOrbFloat { 0%{transform:translate(0,0)scale(1)} 100%{transform:translate(30px,20px)scale(1.1)} }

.fp-shop-title {
    font-family: 'Syne', sans-serif;
    font-size: clamp(28px, 3.5vw, 42px);
    font-weight: 800; color: var(--text-primary);
    margin-bottom: 10px;
}
.fp-shop-desc { color: var(--text-muted); font-size: 16px; max-width: 500px; margin: 0 auto 32px; }

/* ===== FILTERS ===== */
.fp-shop-filters-wrap {
    max-width: 960px; margin: 0 auto;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all 0.3s;
}
.fp-shop-filters-wrap:focus-within { border-color: rgba(234,179,8,0.2); }
.fp-shop-filters-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid var(--card-border);
    background: rgba(255,255,255,0.02);
}
.fp-filters-label {
    font-size: 13px; font-weight: 700; color: var(--text-primary);
    display: flex; align-items: center; gap: 6px;
}
.fp-filters-label i { color: var(--gold-500); font-size: 14px; }
.fp-filters-toggle {
    background: none; border: none; color: var(--text-muted);
    font-size: 18px; cursor: pointer; padding: 4px 8px;
    transition: transform 0.3s;
}
.fp-filters-toggle.active { transform: rotate(180deg); }

.fp-shop-filters { padding: 20px; }
.fp-filter-group label {
    display: flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 600; color: var(--text-dim);
    margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;
}
.fp-filter-group label i { color: var(--gold-500); font-size: 11px; }
.fp-filter-input-wrap {
    display: flex; align-items: center; gap: 8px;
    padding: 0 12px;
    background: var(--surface-dark); border: 1.5px solid var(--card-border);
    border-radius: var(--radius-sm);
    transition: all 0.2s;
}
.fp-filter-input-wrap:focus-within { border-color: var(--gold-500); box-shadow: 0 0 0 3px rgba(234,179,8,0.08); }
.fp-filter-input-wrap i { color: var(--text-dim); font-size: 14px; }
.fp-filter-input-wrap input {
    flex: 1; padding: 9px 0; border: none; outline: none;
    background: transparent; color: var(--text-primary);
    font-size: 14px; font-family: inherit;
}
.fp-filter-input-wrap input::placeholder { color: var(--text-dim); }

.fp-select-wrap { position: relative; }
.fp-select-wrap i {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    color: var(--text-dim); font-size: 12px; pointer-events: none;
}
.fp-select-input {
    width: 100%; padding: 9px 32px 9px 12px;
    background: var(--surface-dark); border: 1.5px solid var(--card-border);
    border-radius: var(--radius-sm); color: var(--text-primary);
    font-size: 14px; font-family: inherit; outline: none;
    -webkit-appearance: none; appearance: none;
    cursor: pointer; transition: all 0.2s;
}
.fp-select-input:focus { border-color: var(--gold-500); box-shadow: 0 0 0 3px rgba(234,179,8,0.08); }
.fp-select-input option { background: var(--card-dark); color: var(--text-primary); }

.fp-filter-apply {
    display: inline-flex; align-items: center; justify-content: center; gap: 8px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); border: none;
    padding: 10px 20px; border-radius: var(--radius-sm);
    font-weight: 700; font-size: 14px; cursor: pointer;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    font-family: inherit; position: relative; overflow: hidden;
}
.fp-filter-apply::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(135deg, transparent 20%, rgba(255,255,255,0.15) 50%, transparent 80%);
    transform: translateX(-100%); transition: transform 0.6s;
}
.fp-filter-apply:hover::before { transform: translateX(100%); }
.fp-filter-apply:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold-lg); }

/* Active Filters */
.fp-active-filters {
    display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
    margin-top: 16px; padding: 10px 16px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-sm);
    max-width: 960px; margin-left: auto; margin-right: auto;
}
.fp-active-label {
    font-size: 12px; color: var(--text-muted); font-weight: 600;
    display: flex; align-items: center; gap: 5px;
}
.fp-active-label i { color: var(--gold-500); font-size: 11px; }
.fp-active-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(234,179,8,0.1);
    border: 1px solid rgba(234,179,8,0.2);
    color: var(--gold-400); padding: 4px 10px;
    border-radius: 6px; font-size: 12px; font-weight: 600;
}
.fp-active-tag a { color: var(--gold-400); text-decoration: none; display: flex; }
.fp-active-tag a:hover { color: var(--gold-300); }
.fp-active-clear {
    font-size: 12px; color: var(--text-dim); text-decoration: none;
    display: flex; align-items: center; gap: 4px;
    margin-left: auto; transition: color 0.3s;
}
.fp-active-clear:hover { color: #ef4444; }

/* ===== TOOLBAR ===== */
.fp-toolbar {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 0; flex-wrap: wrap; gap: 12px;
}
.fp-toolbar-left { display: flex; align-items: center; gap: 12px; }
.fp-result-count {
    font-size: 14px; color: var(--text-muted);
    display: flex; align-items: center; gap: 6px;
}
.fp-result-count i { color: var(--gold-500); font-size: 13px; }
.fp-view-toggle {
    display: flex; gap: 4px;
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: 8px; padding: 3px; margin-left: 12px;
}
.fp-view-btn {
    background: transparent; border: none; color: var(--text-dim);
    width: 34px; height: 34px; border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; cursor: pointer; transition: all 0.3s;
}
.fp-view-btn--active { background: rgba(234,179,8,0.1); color: var(--gold-400); }
.fp-view-btn:not(.fp-view-btn--active):hover { color: var(--text-muted); }

/* ===== SHOP CARDS ===== */
.fp-shop-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    will-change: transform;
}
.fp-shop-card:hover {
    border-color: rgba(234,179,8,0.3);
    box-shadow: 0 12px 48px rgba(234,179,8,0.08);
}
.fp-shop-card-link { display: block; text-decoration: none; height: 100%; }

.fp-shop-card-img {
    position: relative; height: 200px;
    background: var(--dark-900);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.fp-shop-card-img::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.3));
    pointer-events: none;
}
.fp-shop-card-img img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform 0.5s ease;
}
.fp-shop-card:hover .fp-shop-card-img img { transform: scale(1.08); }
.fp-shop-card-no-img { color: var(--card-border); font-size: 36px; }

.fp-shop-card-badge {
    position: absolute; bottom: 8px; left: 8px; z-index: 2;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px;
}
.fp-shop-card-discount {
    position: absolute; top: 8px; right: 8px; z-index: 2;
    background: #ef4444; color: white;
    font-size: 11px; font-weight: 700;
    padding: 3px 8px; border-radius: 6px;
}

.fp-shop-card-overlay {
    position: absolute; inset: 0; z-index: 2;
    background: rgba(0,0,0,0.5);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity 0.3s;
}
.fp-shop-card:hover .fp-shop-card-overlay { opacity: 1; }
.fp-shop-card-quickview {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(234,179,8,0.9); color: var(--near-black);
    padding: 8px 16px; border-radius: 8px;
    font-size: 12px; font-weight: 700;
    transform: translateY(10px); transition: transform 0.3s;
}
.fp-shop-card:hover .fp-shop-card-quickview { transform: translateY(0); }

.fp-shop-card-body { padding: 14px 16px 16px; }
.fp-shop-card-brand {
    font-size: 11px; color: var(--gold-400); font-weight: 600;
    display: block; margin-bottom: 4px;
}
.fp-shop-card-body h6 {
    font-size: 14px; font-weight: 600; color: var(--text-primary);
    margin-bottom: 8px;
    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
    overflow: hidden; line-height: 1.4;
}
.fp-shop-card-price { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; }
.fp-shop-current-price { font-size: 16px; font-weight: 700; color: var(--gold-400); font-family: 'Syne', sans-serif; }
.fp-shop-old-price { font-size: 13px; color: var(--text-dim); text-decoration: line-through; }
.fp-shop-card-meta { font-size: 12px; color: var(--text-dim); display: flex; align-items: center; gap: 4px; }
.fp-shop-card-meta i { color: var(--gold-400); font-size: 11px; }

/* ===== LIST VIEW ===== */
.fp-products-grid.list-view .fp-product-col { width: 100%; }
.fp-products-grid.list-view .fp-shop-card { display: flex; }
.fp-products-grid.list-view .fp-shop-card-link { display: flex; flex-direction: row; }
.fp-products-grid.list-view .fp-shop-card-img {
    width: 220px; height: auto; min-height: 160px; flex-shrink: 0;
}
.fp-products-grid.list-view .fp-shop-card-body {
    display: flex; flex-direction: column; justify-content: center; flex: 1;
}
.fp-products-grid.list-view .fp-shop-card-body h6 {
    -webkit-line-clamp: 1; font-size: 16px;
}
.fp-products-grid.list-view .fp-shop-card-meta { margin-top: auto; }

/* ===== EMPTY ===== */
.fp-shop-empty {
    text-align: center; padding: 80px 20px;
}
.fp-shop-empty-icon {
    width: 80px; height: 80px; border-radius: 20px;
    background: var(--card-dark); border: 1px solid var(--card-border);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 24px; font-size: 32px; color: var(--text-dim);
}
.fp-shop-empty h4 {
    font-family: 'Syne', sans-serif;
    font-size: 24px; font-weight: 700; color: var(--text-primary);
    margin-bottom: 8px;
}
.fp-shop-empty p { color: var(--text-muted); font-size: 15px; margin-bottom: 24px; }

/* ===== PAGINATION ===== */
.fp-pagination-wrap { margin-top: 40px; }

/* ===== RESPONSIVE ===== */
@media (max-width: 991px) {
    .fp-shop-filters { display: none; }
    .fp-shop-filters.open { display: block; }
}
@media (max-width: 768px) {
    .fp-shop-hero { padding: 50px 0 28px; }
    .fp-shop-card-img { height: 160px; }
    .fp-products-grid.list-view .fp-shop-card-img { width: 140px; min-height: 120px; }
    .fp-products-grid.list-view .fp-shop-card-body h6 { font-size: 14px; }
}
</style>

<script>
function toggleFilters() {
    const form = document.getElementById('fpFilterForm');
    const btn = document.querySelector('.fp-filters-toggle');
    form.classList.toggle('open');
    btn.classList.toggle('active');
}

// View toggle
document.querySelectorAll('.fp-view-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.fp-view-btn').forEach(b => b.classList.remove('fp-view-btn--active'));
        this.classList.add('fp-view-btn--active');
        const grid = document.getElementById('fpProductsGrid');
        if (this.dataset.view === 'list') {
            grid.classList.add('list-view');
        } else {
            grid.classList.remove('list-view');
        }
    });
});
</script>
@endsection