@extends('backend.app')
@section('title', 'Product Requests — FlexiPay Admin')
@section('page_title', 'Product Requests')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>New Product Requests</h5></div>
    <table class="fp-table">
        <thead><tr><th>Customer</th><th>Product Name</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($requests ?? [] as $r)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $r->user?->name ?? 'N/A' }}</strong></td>
                <td>{{ $r->product_name }}</td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $r->created_at->format('M d, Y') }}</td>
                <td><span class="fp-badge {{ $r->status == 'approved' ? 'fp-badge-active' : ($r->status == 'rejected' ? 'fp-badge-inactive' : 'fp-badge-pending') }}">{{ ucfirst($r->status) }}</span></td>
                <td>
                    <form action="{{ route('admin.requests.product-requests.update', $r) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <select name="status" class="fp-form-control" style="width:auto;">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                            <option value="pending">Pending</option>
                        </select>
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:6px 12px;">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No requests</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection