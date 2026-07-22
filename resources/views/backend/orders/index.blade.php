@extends('backend.app')
@section('title', 'Orders — FlexiPay Admin')
@section('page_title', 'Orders')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Orders</h5></div>
    <table class="fp-table">
        <thead><tr><th>ID</th><th>Customer</th><th>Amount</th><th>Plan</th><th>Status</th><th>Delivery</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($orders ?? [] as $o)
            <tr>
                <td><strong style="color:var(--text-primary);">#{{ $o->id }}</strong></td>
                <td>{{ $o->user?->name ?? 'N/A' }}</td>
                <td style="color:var(--gold-400);font-weight:600;">₦{{ number_format($o->total, 0) }}</td>
                <td>{{ $o->installmentPlan?->duration ?? 'N/A' }} {{ $o->installmentPlan?->duration_unit ?? '' }}</td>
                <td><span class="fp-badge fp-badge-{{ $o->status == 'completed' ? 'active' : ($o->status == 'cancelled' ? 'inactive' : 'pending') }}">{{ ucfirst($o->status) }}</span></td>
                <td>{{ ucfirst($o->delivery_status ?? 'pending') }}</td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $o->created_at->format('M d, Y') }}</td>
                <td><a href="{{ route('admin.orders.show', $o) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-eye"></i></a></td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center py-4" style="color:var(--text-dim);">No orders yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3"><a href="{{ route('admin.orders.export') }}" class="fp-btn fp-btn-ghost"><i class="bi bi-download"></i> Export CSV</a></div>
@endsection