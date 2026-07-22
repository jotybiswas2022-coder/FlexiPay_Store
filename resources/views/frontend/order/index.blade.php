@extends('frontend.app')
@section('title', 'My Orders — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-box-seam-fill"></i> My Orders</div>
            <h2>Order History</h2>
        </div>

        @if(isset($orders) && $orders->count() > 0)
        <div class="fp-filter-tabs mb-4">
            <a href="{{ route('orders.index') }}" class="fp-tab {{ !request('status') ? 'active' : '' }}">All</a>
            <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="fp-tab {{ request('status') == 'processing' ? 'active' : '' }}">Processing</a>
            <a href="{{ route('orders.index', ['status' => 'shipped']) }}" class="fp-tab {{ request('status') == 'shipped' ? 'active' : '' }}">Shipped</a>
            <a href="{{ route('orders.index', ['status' => 'completed']) }}" class="fp-tab {{ request('status') == 'completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('orders.index', ['status' => 'cancelled']) }}" class="fp-tab {{ request('status') == 'cancelled' ? 'active' : '' }}">Cancelled</a>
        </div>

        @foreach($orders as $order)
        <div class="fp-order-card">
            <div class="fp-order-header">
                <div class="fp-oh-left">
                    <span class="fp-order-id">Order #{{ $order->id }}</span>
                    <span class="fp-order-date">{{ $order->created_at->format('M d, Y') }}</span>
                </div>
                <div class="fp-oh-right">
                    <span class="fp-order-status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                    <span class="fp-order-amount">₦{{ number_format($order->total, 0) }}</span>
                </div>
            </div>
            <div class="fp-order-body">
                @foreach($order->items->take(3) as $item)
                <div class="fp-order-item">
                    @if($item->product && $item->product->primaryImage)
                        <img src="{{ asset('storage/'.$item->product->primaryImage->image_path) }}" alt="">
                    @else
                        <div class="fp-oi-no-img"><i class="bi bi-image"></i></div>
                    @endif
                    <div class="fp-oi-info">
                        <span>{{ $item->product?->name ?? 'Product' }}</span>
                        <small>Qty: {{ $item->quantity }} × ₦{{ number_format($item->price, 0) }}</small>
                    </div>
                </div>
                @endforeach
                @if($order->items->count() > 3)
                <div class="fp-order-more">+{{ $order->items->count() - 3 }} more items</div>
                @endif
            </div>
            <div class="fp-order-footer">
                <div class="fp-of-progress">
                    @php
                        $paid = $order->total - ($order->remaining_balance ?? $order->total);
                        $pct = $order->total > 0 ? round(($paid / $order->total) * 100) : 0;
                    @endphp
                    <span>{{ $pct }}% paid</span>
                    <div class="fp-progress-bar"><div class="fp-progress-fill" style="width:{{ $pct }}%"></div></div>
                </div>
                <div class="fp-of-actions">
                    <a href="{{ route('orders.show', $order) }}" class="fp-btn-sm">View Details</a>
                    @if($order->status == 'processing' || $order->status == 'partial_paid')
                    <a href="{{ route('payment.gateway', $order) }}" class="fp-btn-sm gold">Pay Now</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        @if(method_exists($orders, 'links'))
        <div class="mt-4">{{ $orders->links() }}</div>
        @endif
        @else
        <div class="fp-empty text-center py-5">
            <i class="bi bi-inbox" style="font-size:64px;color:var(--text-dim);display:block;margin-bottom:16px;"></i>
            <h3 style="color:var(--text-primary);font-family:'Syne',sans-serif;">No Orders Yet</h3>
            <p style="color:var(--text-muted);">Start shopping and your orders will appear here.</p>
            <a href="{{ url('/shop') }}" class="btn-primary-gold mt-3"><i class="bi bi-grid-fill"></i> Start Shopping</a>
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')
<style>
.fp-section {
    background: linear-gradient(135deg, var(--near-black), var(--surface-dark));
    padding: 60px 0; min-height: 100vh;
}
.fp-filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
.fp-tab {
    padding: 8px 18px; border-radius: 8px;
    border: 1px solid var(--card-border); color: var(--text-muted);
    font-size: 13px; font-weight: 500; transition: all 0.2s;
}
.fp-tab:hover, .fp-tab.active { background: rgba(234,179,8,0.1); border-color: rgba(234,179,8,0.3); color: var(--gold-400); }
.fp-order-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); overflow: hidden; margin-bottom: 16px;
    transition: border-color 0.3s;
}
.fp-order-card:hover { border-color: rgba(234,179,8,0.2); }
.fp-order-header, .fp-order-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 20px; background: var(--surface-dark);
}
.fp-order-header { border-bottom: 1px solid var(--card-border); }
.fp-oh-left, .fp-oh-right { display: flex; align-items: center; gap: 16px; }
.fp-order-id { font-weight: 700; color: var(--text-primary); font-size: 14px; }
.fp-order-date { color: var(--text-dim); font-size: 12px; }
.fp-order-status {
    padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase;
}
.fp-order-status.processing, .fp-order-status.partial_paid { background: rgba(234,179,8,0.15); color: var(--gold-400); }
.fp-order-status.completed { background: rgba(34,197,94,0.15); color: #4ade80; }
.fp-order-status.cancelled { background: rgba(239,68,68,0.15); color: #ef4444; }
.fp-order-status.shipped { background: rgba(59,130,246,0.15); color: #60a5fa; }
.fp-order-amount { font-weight: 700; color: var(--gold-400); font-family: 'Syne', sans-serif; font-size: 16px; }
.fp-order-body { padding: 16px 20px; }
.fp-order-item { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
.fp-order-item img { width: 48px; height: 48px; border-radius: 6px; object-fit: cover; background: var(--dark-900); }
.fp-oi-no-img { width: 48px; height: 48px; border-radius: 6px; background: var(--dark-900); display: flex; align-items: center; justify-content: center; color: var(--card-border); }
.fp-oi-info span { display: block; color: var(--text-primary); font-size: 13px; font-weight: 500; }
.fp-oi-info small { color: var(--text-dim); font-size: 12px; }
.fp-order-more { color: var(--text-dim); font-size: 12px; padding-left: 60px; font-weight: 500; }
.fp-order-footer { border-top: 1px solid var(--card-border); flex-wrap: wrap; gap: 12px; }
.fp-of-progress { display: flex; align-items: center; gap: 10px; }
.fp-of-progress span { font-size: 12px; color: var(--text-dim); white-space: nowrap; }
.fp-progress-bar { width: 120px; height: 6px; background: var(--card-border); border-radius: 99px; overflow: hidden; }
.fp-progress-fill { height: 100%; background: linear-gradient(90deg, var(--gold-500), var(--gold-600)); border-radius: 99px; }
.fp-of-actions { display: flex; gap: 8px; }
.fp-btn-sm {
    padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600;
    border: 1px solid var(--card-border); color: var(--text-muted);
    transition: all 0.2s;
}
.fp-btn-sm:hover { border-color: var(--gold-400); color: var(--gold-400); }
.fp-btn-sm.gold { background: var(--gold-500); color: var(--near-black); border-color: var(--gold-500); }
.fp-btn-sm.gold:hover { background: var(--gold-600); }
@media (max-width: 576px) {
    .fp-order-header, .fp-order-footer { flex-direction: column; align-items: flex-start; gap: 8px; }
}
</style>
@endsection