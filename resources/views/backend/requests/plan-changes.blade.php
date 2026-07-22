@extends('backend.app')
@section('title', 'Plan Changes — FlexiPay Admin')
@section('page_title', 'Plan Change Requests')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Plan Change Requests</h5></div>
    <table class="fp-table">
        <thead><tr><th>User</th><th>Order</th><th>Current Plan</th><th>Reason</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($requests ?? [] as $r)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $r->user?->name ?? 'N/A' }}</strong></td>
                <td>#{{ $r->order_id }}</td>
                <td>{{ $r->current_plan ?? 'N/A' }}</td>
                <td style="max-width:200px;">{{ Str::limit($r->reason, 50) }}</td>
                <td><span class="fp-badge {{ $r->status == 'approved' ? 'fp-badge-active' : ($r->status == 'rejected' ? 'fp-badge-inactive' : 'fp-badge-pending') }}">{{ ucfirst($r->status) }}</span></td>
                <td>
                    <form action="{{ route('admin.requests.plan-changes.approve', $r) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:4px 10px;font-size:11px;">Approve</button>
                    </form>
                    <form action="{{ route('admin.requests.plan-changes.reject', $r) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-danger" style="padding:4px 10px;font-size:11px;">Reject</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-4" style="color:var(--text-dim);">No requests</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection