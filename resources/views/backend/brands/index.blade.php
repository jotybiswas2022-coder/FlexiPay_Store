@extends('backend.app')
@section('title', 'Brands — FlexiPay Admin')
@section('page_title', 'Brands')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $brands->count() ?? 0 }} brands</p>
    <a href="{{ route('admin.brands.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> Add Brand</a>
</div>
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Brands</h5></div>
    <table class="fp-table">
        <thead><tr><th>Name</th><th>Description</th><th>Products</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($brands ?? [] as $b)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $b->name }}</strong></td>
                <td>{{ Str::limit($b->description, 50) ?? '—' }}</td>
                <td>{{ $b->products->count() }}</td>
                <td>
                    <a href="{{ route('admin.brands.edit', $b) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ route('admin.brands.delete', $b) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete this brand?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-4" style="color:var(--text-dim);">No brands</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
