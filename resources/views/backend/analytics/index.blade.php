@extends('backend.app')
@section('title', 'Analytics — FlexiPay Admin')
@section('page_title', 'Analytics')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="fp-stat-card">
            <div class="stat-icon"><i class="bi bi-cart"></i></div>
            <div class="stat-num">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="fp-stat-card">
            <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
            <div class="stat-num">₦{{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="fp-stat-card">
            <div class="stat-icon"><i class="bi bi-people"></i></div>
            <div class="stat-num">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="fp-stat-card">
            <div class="stat-icon"><i class="bi bi-box"></i></div>
            <div class="stat-num">{{ $totalProducts }}</div>
            <div class="stat-label">Total Products</div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="fp-table-wrap">
            <div class="fp-table-header"><h5>Orders by Status</h5></div>
            <table class="fp-table">
                <thead><tr><th>Status</th><th>Count</th></tr></thead>
                <tbody>
                    @forelse($ordersByStatus ?? [] as $status => $count)
                    <tr>
                        <td><span class="fp-badge fp-badge-{{ $status == 'completed' ? 'active' : ($status == 'cancelled' ? 'inactive' : 'pending') }}">{{ ucfirst($status) }}</span></td>
                        <td>{{ $count }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-4" style="color:var(--text-dim);">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="fp-table-wrap">
            <div class="fp-table-header"><h5>Monthly Revenue</h5></div>
            <table class="fp-table">
                <thead><tr><th>Month</th><th>Revenue</th></tr></thead>
                <tbody>
                    @forelse($monthlyRevenue ?? [] as $month => $total)
                    <tr>
                        <td>{{ DateTime::createFromFormat('!m', $month)->format('F') }}</td>
                        <td style="color:var(--gold-400);font-weight:600;">₦{{ number_format($total, 0) }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center py-4" style="color:var(--text-dim);">No completed orders yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="fp-table-wrap">
    <div class="fp-table-header">
        <h5>Recent Orders</h5>
        <a href="{{ route('admin.analytics.export') }}" class="fp-btn fp-btn-ghost"><i class="bi bi-download"></i> Export CSV</a>
    </div>
    <table class="fp-table">
        <thead><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
        <tbody>
            @forelse($recentOrders ?? [] as $o)
            <tr>
                <td><strong style="color:var(--text-primary);">#{{ $o->id }}</strong></td>
                <td>{{ $o->user?->name ?? 'N/A' }}</td>
                <td style="color:var(--gold-400);font-weight:600;">₦{{ number_format($o->grand_total, 0) }}</td>
                <td><span class="fp-badge fp-badge-{{ $o->status == 'completed' ? 'active' : ($o->status == 'cancelled' ? 'inactive' : 'pending') }}">{{ ucfirst($o->status) }}</span></td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $o->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No orders yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
