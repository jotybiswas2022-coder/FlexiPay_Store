@extends('backend.app')
@section('title', 'Order #'.$order->id.' — FlexiPay Admin')
@section('page_title', 'Order #'.$order->id)

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="fp-table-wrap">
            <div class="fp-table-header"><h5>Order Details</h5></div>
            <div style="padding:20px;">
                <div class="row g-3">
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Customer</label><strong style="color:var(--text-primary);">{{ $order->user?->name ?? 'N/A' }}</strong><br><small style="color:var(--text-dim);">{{ $order->user?->email }}</small></div>
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Total</label><strong style="color:var(--gold-400);font-size:20px;">₦{{ number_format($order->total, 0) }}</strong></div>
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Status</label>
                        <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <select name="status" class="fp-form-control" style="width:auto;">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="fp-btn fp-btn-gold" style="padding:8px 16px;">Update</button>
                        </form>
                    </div>
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Payment Plan</label><strong style="color:var(--text-primary);">{{ $order->installmentPlan?->duration ?? 'N/A' }} {{ $order->installmentPlan?->duration_unit ?? '' }}</strong></div>
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Paid Amount</label><strong style="color:#4ade80;">₦{{ number_format($order->paid_amount ?? 0, 0) }}</strong></div>
                    <div class="col-md-4"><label style="display:block;font-size:11px;color:var(--text-dim);text-transform:uppercase;">Delivery Status</label>
                        <form action="{{ route('admin.orders.delivery', $order) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <select name="delivery_status" class="fp-form-control" style="width:auto;">
                                <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->delivery_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->delivery_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                            <button type="submit" class="fp-btn fp-btn-gold" style="padding:8px 16px;">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="fp-table-wrap mt-4">
            <div class="fp-table-header"><h5>Order Items</h5></div>
            <table class="fp-table">
                <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td><strong style="color:var(--text-primary);">{{ $item->product?->name ?? 'Product' }}</strong></td>
                        <td>₦{{ number_format($item->price, 0) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="color:var(--gold-400);font-weight:600;">₦{{ number_format($item->quantity * $item->price, 0) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr><td colspan="3" class="text-end" style="font-weight:700;color:var(--text-primary);">Total</td><td style="font-weight:700;color:var(--gold-500);font-size:16px;">₦{{ number_format($order->total, 0) }}</td></tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="fp-table-wrap">
            <div class="fp-table-header"><h5>Installment Payments</h5></div>
            <div style="padding:16px;">
                @forelse($order->installmentPayments ?? [] as $ip)
                <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid var(--card-border);">
                    <div><strong style="color:var(--text-primary);font-size:13px;">#{{ $ip->installment_number }}</strong><small style="display:block;color:var(--text-dim);font-size:11px;">Due: {{ $ip->due_date->format('M d') }}</small></div>
                    <div class="text-end"><span style="font-weight:600;color:var(--gold-400);">₦{{ number_format($ip->amount, 0) }}</span><br><span class="fp-badge fp-badge-{{ $ip->status == 'paid' ? 'active' : 'pending' }}" style="font-size:10px;">{{ ucfirst($ip->status) }}</span></div>
                </div>
                @empty
                <p style="color:var(--text-dim);font-size:13px;">No installment records</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection