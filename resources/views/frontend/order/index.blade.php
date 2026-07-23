@extends('frontend.app')
@section('title', 'My Orders — FlexiPay Store')

@push('styles')
<style>
.fp-ord-hero {
    position: relative; padding: 40px 0 20px; overflow: hidden;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-ord-orb {
    position: absolute; width: 500px; height: 500px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.05) 0%, transparent 60%);
    top: -200px; right: -100px; pointer-events: none;
    animation: ordPulse 4s ease-in-out infinite;
}
.fp-ord-orb2 {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.03) 0%, transparent 60%);
    bottom: -150px; left: -100px; pointer-events: none;
    animation: ordPulse 5s ease-in-out infinite reverse;
}
@keyframes ordPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-ord-section { padding-bottom: 80px; min-height: 60vh; }

.fp-filter-tabs {
    display: flex; gap: 8px; flex-wrap: wrap;
    padding: 6px; background: var(--surface-dark);
    border: 1px solid var(--card-border); border-radius: var(--radius-sm);
}
.fp-tab {
    padding: 8px 20px; border-radius: 6px;
    color: var(--text-muted); font-size: 13px; font-weight: 500;
    transition: all 0.3s; text-decoration: none;
}
.fp-tab:hover, .fp-tab.active { background: rgba(234,179,8,0.1); color: var(--gold-400); }
.fp-tab.active { background: var(--gold-500); color: var(--near-black); }

.fp-order-card {
    background: var(--card-dark); border: 1px solid var(--card-border);
    border-radius: var(--radius); overflow: hidden; margin-bottom: 16px;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.fp-order-card:hover {
    border-color: rgba(234,179,8,0.2); transform: translateY(-3px);
    box-shadow: var(--shadow-card-hover);
}
.fp-order-header, .fp-order-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 20px; background: var(--surface-dark);
}
.fp-order-header { border-bottom: 1px solid var(--card-border); }
.fp-oh-left, .fp-oh-right { display: flex; align-items: center; gap: 16px; }
.fp-order-id { font-weight: 700; color: var(--text-primary); font-size: 14px; }
.fp-order-date { color: var(--text-dim); font-size: 12px; }
.fp-order-status {
    padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase;
}
.fp-order-status.processing, .fp-order-status.partial_paid { background: rgba(234,179,8,0.15); color: var(--gold-400); }
.fp-order-status.completed { background: rgba(34,197,94,0.15); color: #4ade80; }
.fp-order-status.cancelled { background: rgba(239,68,68,0.15); color: #ef4444; }
.fp-order-status.shipped { background: rgba(59,130,246,0.15); color: #60a5fa; }
.fp-order-amount { font-weight: 700; color: var(--gold-400); font-family: 'Syne', sans-serif; font-size: 16px; }

.fp-order-body { padding: 16px 20px; }
.fp-order-item { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }
.fp-order-item:last-child { margin-bottom: 0; }
.fp-order-item img { width: 48px; height: 48px; border-radius: 6px; object-fit: cover; background: var(--dark-900); }
.fp-oi-no-img { width: 48px; height: 48px; border-radius: 6px; background: var(--dark-900); display: flex; align-items: center; justify-content: center; color: var(--card-border); }
.fp-oi-info span { display: block; color: var(--text-primary); font-size: 13px; font-weight: 500; }
.fp-oi-info small { color: var(--text-dim); font-size: 12px; }
.fp-order-more { color: var(--text-dim); font-size: 12px; padding-left: 60px; font-weight: 500; }

.fp-order-footer { border-top: 1px solid var(--card-border); flex-wrap: wrap; gap: 12px; }
.fp-of-progress { display: flex; align-items: center; gap: 10px; }
.fp-of-progress span { font-size: 12px; color: var(--text-dim); white-space: nowrap; }
.fp-progress-bar { width: 120px; height: 6px; background: var(--card-border); border-radius: 99px; overflow: hidden; }
.fp-progress-fill { height: 100%; background: linear-gradient(90deg, var(--gold-500), var(--gold-600)); border-radius: 99px; transition: width 0.5s; }
.fp-of-actions { display: flex; gap: 8px; }
.fp-btn-sm {
    padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600;
    border: 1px solid var(--card-border); color: var(--text-muted);
    transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
}
.fp-btn-sm:hover { border-color: var(--gold-400); color: var(--gold-400); }
.fp-btn-sm.gold { background: linear-gradient(135deg, var(--gold-500), var(--gold-600)); color: var(--near-black); border-color: var(--gold-500); }
.fp-btn-sm.gold:hover { box-shadow: 0 4px 16px rgba(234,179,8,0.3); }

.fp-ord-empty {
    text-align: center; padding: 80px 20px;
}
.fp-ord-empty-icon {
    width: 100px; height: 100px; border-radius: 50%;
    background: var(--card-dark); border: 2px solid var(--card-border);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px; font-size: 40px; color: var(--text-dim);
}
.fp-ord-empty h3 { font-family: 'Syne', sans-serif; color: var(--text-primary); font-size: 24px; margin-bottom: 8px; }
.fp-ord-empty p { color: var(--text-muted); font-size: 15px; margin-bottom: 24px; }

@media (max-width: 576px) {
    .fp-order-header, .fp-order-footer { flex-direction: column; align-items: flex-start; gap: 8px; }
}
</style>
@endpush

@section('content')
<section class="fp-ord-hero">
    <div class="fp-ord-orb"></div>
    <div class="fp-ord-orb2"></div>
    <div class="container">
        <div class="section-head reveal-up">
            <div class="section-badge"><i class="bi bi-box-seam-fill"></i> My Orders</div>
            <h2>Order History</h2>
            <p>Track and manage all your purchases</p>
        </div>
    </div>
</section>

<section class="fp-ord-section">
    <div class="container">
        @if(isset($orders) && $orders->count() > 0)
        <div class="fp-filter-tabs reveal-up mb-4">
            <a href="{{ route('orders.index') }}" class="fp-tab {{ !request('status') ? 'active' : '' }}">All</a>
            <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="fp-tab {{ request('status') == 'processing' ? 'active' : '' }}">Processing</a>
            <a href="{{ route('orders.index', ['status' => 'shipped']) }}" class="fp-tab {{ request('status') == 'shipped' ? 'active' : '' }}">Shipped</a>
            <a href="{{ route('orders.index', ['status' => 'completed']) }}" class="fp-tab {{ request('status') == 'completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('orders.index', ['status' => 'cancelled']) }}" class="fp-tab {{ request('status') == 'cancelled' ? 'active' : '' }}">Cancelled</a>
        </div>

        @foreach($orders as $index => $order)
        <div class="fp-order-card reveal-up" style="transition-delay:{{ $index * 0.05 }}s;">
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
                        <img src="{{ asset('storage/'.$item->product->primaryImage->image_path) }}" alt="{{ $item->product->name }}">
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
                    <a href="{{ route('orders.show', $order) }}" class="fp-btn-sm" aria-label="View details for order #{{ $order->id }}"><i class="bi bi-eye"></i> View Details</a>
                    @if($order->status == 'processing' || $order->status == 'partial_paid')
                    <a href="{{ route('payment.gateway', $order) }}" class="fp-btn-sm gold" aria-label="Pay now for order #{{ $order->id }}"><i class="bi bi-credit-card"></i> Pay Now</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        @if(method_exists($orders, 'links'))
        <div class="mt-4">{{ $orders->links() }}</div>
        @endif
        @else
        <div class="fp-ord-empty reveal-up">
            <div class="fp-ord-empty-icon"><i class="bi bi-inbox"></i></div>
            <h3>No Orders Yet</h3>
            <p>You haven't placed any orders yet. Start shopping and your orders will appear here!</p>
            <a href="{{ url('/shop') }}" class="btn-primary-gold" style="display:inline-flex;"><i class="bi bi-grid-fill"></i> Start Shopping</a>
        </div>
        @endif
    </div>
</section>

@include('frontend.partials.footer')
@stop
@endsection
