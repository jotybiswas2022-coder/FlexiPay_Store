@extends('backend.app')
@section('title', 'Suppliers — FlexiPay Admin')
@section('page_title', 'Suppliers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $suppliers->count() ?? 0 }} suppliers</p>
    <a href="{{ route('admin.suppliers.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> Add Supplier</a>
</div>
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Suppliers</h5></div>
    <table class="fp-table">
        <thead><tr><th>Name</th><th>Contact</th><th>Email</th><th>Products</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($suppliers ?? [] as $s)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $s->name }}</strong></td>
                <td>{{ $s->contact_person ?? '—' }}</td>
                <td>{{ $s->email ?? '—' }}</td>
                <td>{{ $s->products->count() }}</td>
                <td>
                    <a href="{{ route('admin.suppliers.edit', $s) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ route('admin.suppliers.delete', $s) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete this supplier?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No suppliers</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection