@extends('backend.app')
@section('title', 'Products — FlexiPay Admin')
@section('page_title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $products->count() ?? 0 }} products total</p>
    <a href="{{ route('admin.products.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> Add Product</a>
</div>

<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Products</h5></div>
    <table class="fp-table">
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($products ?? [] as $p)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ Str::limit($p->name, 40) }}</strong></td>
                <td>{{ $p->category?->name ?? '—' }}</td>
                <td style="color:var(--gold-400);font-weight:600;">₦{{ number_format($p->price, 0) }}</td>
                <td>{{ $p->stock ?? 'N/A' }}</td>
                <td><span class="fp-badge {{ $p->status == 'active' ? 'fp-badge-active' : 'fp-badge-inactive' }}">{{ ucfirst($p->status) }}</span></td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ route('admin.products.delete', $p) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete this product?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-4" style="color:var(--text-dim);">No products yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection