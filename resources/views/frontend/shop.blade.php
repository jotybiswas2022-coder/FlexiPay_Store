@extends('frontend.app')
@section('title', 'Shop — FlexiPay Store')

@section('content')
<section class="fp-shop-hero">
    <div class="container">
        <div class="section-badge text-center" style="margin:0 auto 14px;display:inline-flex;"><i class="bi bi-grid-fill"></i> Shop</div>
        <h1 class="text-center" style="font-family:'Syne',sans-serif;font-size:clamp(28px,3.5vw,42px);font-weight:800;color:var(--text-primary);margin-bottom:12px;">
            Browse Our Products
        </h1>
        <p class="text-center" style="color:var(--text-muted);font-size:16px;max-width:500px;margin:0 auto 32px;">
            Find everything you need with flexible payment plans
        </p>

        <!-- Filters -->
        <form method="GET" action="{{ url('/shop') }}" class="fp-shop-filters">
            <div class="row g-2 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <div class="fp-filter-group">
                        <label><i class="bi bi-search"></i> Search</label>
                        <input type="text" name="search" class="fp-filter-input" placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="fp-filter-group">
                        <label><i class="bi bi-tag-fill"></i> Category</label>
                        <select name="category_id" class="fp-filter-input">
                            <option value="">All Categories</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="fp-filter-group">
                        <label><i class="bi bi-building"></i> Brand</label>
                        <select name="brand_id" class="fp-filter-input">
                            <option value="">All Brands</option>
                            @foreach($brands ?? [] as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="fp-filter-group">
                        <label><i class="bi bi-sort-down"></i> Sort By</label>
                        <select name="sort" class="fp-filter-input">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A–Z</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <button type="submit" class="btn-primary-gold w-100 justify-content-center">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="section-padding" style="background:var(--near-black);padding-top:0;">
    <div class="container">
        @if(request('search') || request('category_id') || request('brand_id'))
        <div class="d-flex align-items-center gap-3 mb-4">
            <span style="color:var(--text-muted);font-size:14px;">
                <i class="bi bi-funnel-fill" style="color:var(--gold-500);"></i>
                Showing results for
                @if(request('search')) "{{ request('search') }}" @endif
                @if(request('category_id')) in {{ $categories->firstWhere('id', request('category_id'))?->name ?? 'selected category' }} @endif
            </span>
            <a href="{{ url('/shop') }}" class="btn btn-sm" style="color:var(--text-dim);border:1px solid var(--card-border);border-radius:6px;padding:4px 12px;">
                <i class="bi bi-x-lg"></i> Clear
            </a>
        </div>
        @endif

        <div class="row g-4">
            @forelse($products ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="fp-product-card reveal-up">
                    <a href="{{ url('/product/'.$product->slug) }}" class="fp-product-link">
                        <div class="fp-product-img-wrap">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/'.$product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <div class="fp-product-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            @if($product->installment_from)
                                <span class="fp-product-badge">₦{{ number_format($product->installment_from, 0) }}/mo</span>
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
                                <span><i class="bi bi-coin"></i> Installments available</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-search" style="font-size:48px;color:var(--text-dim);"></i>
                <h4 class="mt-3" style="color:var(--text-primary);font-family:'Syne',sans-serif;">No Products Found</h4>
                <p style="color:var(--text-muted);">Try adjusting your filters or search terms.</p>
            </div>
            @endforelse
        </div>

        @if(method_exists($products ?? [], 'links'))
        <div class="mt-4">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')

<style>
.fp-shop-hero {
    background: linear-gradient(135deg, var(--surface-dark), var(--near-black));
    padding: 60px 0 32px;
    border-bottom: 1px solid var(--card-border);
}
.fp-shop-filters {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 24px;
    max-width: 960px;
    margin: 0 auto;
}
.fp-filter-group label {
    display: flex; align-items: center; gap: 5px;
    font-size: 12px; font-weight: 600; color: var(--text-muted);
    margin-bottom: 6px;
}
.fp-filter-group label i { color: var(--gold-500); font-size: 11px; }
.fp-filter-input {
    width: 100%; padding: 10px 14px;
    background: var(--surface-dark); border: 1.5px solid var(--card-border);
    border-radius: var(--radius-sm); color: var(--text-primary);
    font-size: 14px; font-family: inherit; outline: none;
    transition: all 0.2s;
}
.fp-filter-input:focus {
    border-color: var(--gold-500);
    box-shadow: 0 0 0 3px rgba(234,179,8,0.08);
}
.fp-filter-input option { background: var(--card-dark); color: var(--text-primary); }

.fp-product-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
}
.fp-product-card:hover {
    transform: translateY(-6px);
    border-color: rgba(234,179,8,0.3);
    box-shadow: 0 8px 40px rgba(0,0,0,0.3);
}
.fp-product-link { display: block; text-decoration: none; height: 100%; }
.fp-product-img-wrap {
    position: relative; height: 200px;
    background: var(--dark-900);
    display: flex; align-items: center; justify-content: center;
    overflow: hidden;
}
.fp-product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
.fp-product-card:hover .fp-product-img-wrap img { transform: scale(1.08); }
.fp-product-no-img { color: var(--card-border); font-size: 36px; }
.fp-product-badge {
    position: absolute; bottom: 8px; left: 8px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    color: var(--near-black); font-size: 11px; font-weight: 700;
    padding: 4px 10px; border-radius: 6px;
}
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

/* Pagination */
.page-link {
    background: var(--card-dark);
    border-color: var(--card-border);
    color: var(--text-muted);
    padding: 8px 14px;
    font-size: 13px;
}
.page-link:hover {
    background: rgba(234,179,8,0.1);
    border-color: rgba(234,179,8,0.3);
    color: var(--gold-400);
}
.page-item.active .page-link {
    background: var(--gold-500);
    border-color: var(--gold-500);
    color: var(--near-black);
}

@media (max-width: 768px) {
    .fp-product-img-wrap { height: 160px; }
}
</style>
@endsection