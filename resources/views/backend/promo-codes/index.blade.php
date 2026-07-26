@extends('backend.app')
@section('title', 'Promo Codes — FlexiPay Admin')
@section('page_title', 'Promo Codes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $promoCodes->count() ?? 0 }} codes</p>
    <a href="{{ route('admin.promo-codes.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> Add Promo Code</a>
</div>
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Promo Codes</h5></div>
    <table class="fp-table">
        <thead><tr><th>Code</th><th>Type</th><th>Value</th><th>Min Order</th><th>Uses</th><th>Valid</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($promoCodes ?? [] as $p)
            <tr>
                <td><strong style="color:var(--gold-400);font-family:monospace;">{{ $p->code }}</strong></td>
                <td>{{ $p->type == 'percentage' ? '%' : '₦' }}</td>
                <td>{{ $p->type == 'percentage' ? $p->value.'%' : '₦'.number_format($p->value, 0) }}</td>
                <td>₦{{ number_format($p->min_order_amount, 0) }}</td>
                <td>{{ $p->used_count }}{{ $p->max_uses ? '/'.$p->max_uses : '' }}</td>
                <td>
                    @if($p->starts_at || $p->expires_at)
                        {{ $p->starts_at?->format('M d') }} - {{ $p->expires_at?->format('M d, Y') ?? '∞' }}
                    @else
                        <span style="color:var(--text-dim);">Always</span>
                    @endif
                </td>
                <td><span class="fp-badge {{ $p->isValid() ? 'fp-badge-active' : 'fp-badge-inactive' }}">{{ $p->isValid() ? 'Active' : 'Inactive' }}</span></td>
                <td>
                    <a href="{{ route('admin.promo-codes.edit', $p) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ route('admin.promo-codes.delete', $p) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete this promo code?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center py-4" style="color:var(--text-dim);">No promo codes</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
