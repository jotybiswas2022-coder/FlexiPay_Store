@extends('backend.app')
@section('title', 'Analytics — FlexiPay Admin')
@section('page_title', 'Analytics')

@push('styles')
<style>
.an-chart { position: relative; height: 240px; width: 100%; min-width: 0; }
.an-chart-sm { position: relative; height: 200px; width: 100%; min-width: 0; }
.an-grid { display: grid; gap: 18px; }
.an-two { grid-template-columns: 1fr 1fr; }
.an-three { grid-template-columns: 1fr 1fr 1fr; }
@media (max-width: 992px) { .an-two, .an-three { grid-template-columns: 1fr; } }

.an-stat-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 18px 20px;
    transition: all 0.3s;
    contain: layout style;
}
.an-stat-card:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.25);
}
.an-stat-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px; margin-bottom: 10px;
}
.an-stat-icon.gold { background: rgba(234,179,8,0.12); color: var(--gold-500); }
.an-stat-icon.blue { background: rgba(59,130,246,0.12); color: #60a5fa; }
.an-stat-icon.green { background: rgba(34,197,94,0.12); color: #4ade80; }
.an-stat-icon.purple { background: rgba(168,85,247,0.12); color: #c084fc; }
.an-stat-num { font-family: 'Syne', sans-serif; font-size: 24px; font-weight: 800; color: var(--text-primary); line-height: 1.2; }
.an-stat-label { font-size: 11px; color: var(--text-dim); margin-top: 2px; }

.an-section {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    contain: layout style;
}
.an-section-head {
    padding: 14px 20px;
    border-bottom: 1px solid var(--card-border);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;
}
.an-section-head h5 {
    font-family: 'Syne', sans-serif;
    font-size: 13px; font-weight: 700; color: var(--text-primary); margin: 0;
    display: flex; align-items: center; gap: 8px;
}
.an-section-head h5 i { color: var(--gold-500); font-size: 15px; }
.an-section-body { padding: 16px 20px; }
</style>
@endpush

@section('content')

<!-- STATS ROW -->
<div class="an-grid an-three mb-4">
    <div class="an-stat-card">
        <div class="an-stat-icon gold"><i class="bi bi-currency-exchange"></i></div>
        <div class="an-stat-num">₦{{ number_format($totalRevenue ?? 0, 0) }}</div>
        <div class="an-stat-label">Total Revenue</div>
    </div>
    <div class="an-stat-card">
        <div class="an-stat-icon blue"><i class="bi bi-receipt"></i></div>
        <div class="an-stat-num">{{ number_format($totalOrders ?? 0) }}</div>
        <div class="an-stat-label">Total Orders</div>
    </div>
    <div class="an-stat-card">
        <div class="an-stat-icon green"><i class="bi bi-people-fill"></i></div>
        <div class="an-stat-num">{{ number_format($totalUsers ?? 0) }}</div>
        <div class="an-stat-label">Total Customers</div>
    </div>
    <div class="an-stat-card">
        <div class="an-stat-icon purple"><i class="bi bi-box-seam-fill"></i></div>
        <div class="an-stat-num">{{ number_format($totalProducts ?? 0) }}</div>
        <div class="an-stat-label">Total Products</div>
    </div>
</div>

<!-- CHART ROW 1: Revenue + Orders Trend -->
<div class="an-grid an-two mb-4">
    <!-- Revenue Bar Chart -->
    <div class="an-section">
        <div class="an-section-head">
            <h5><i class="bi bi-graph-up"></i> Monthly Revenue ({{ now()->year }})</h5>
        </div>
        <div class="an-section-body">
            <div class="an-chart"><canvas id="revChart"></canvas></div>
        </div>
    </div>
    <!-- Orders Trend Line -->
    <div class="an-section">
        <div class="an-section-head">
            <h5><i class="bi bi-bar-chart-line"></i> Orders Trend ({{ now()->year }})</h5>
        </div>
        <div class="an-section-body">
            <div class="an-chart"><canvas id="ordersChart"></canvas></div>
        </div>
    </div>
</div>

<!-- CHART ROW 2: User Growth + Status Doughnut + Payment Methods -->
<div class="an-grid an-three mb-4">
    <!-- User Growth -->
    <div class="an-section">
        <div class="an-section-head">
            <h5><i class="bi bi-person-plus-fill"></i> Customer Growth</h5>
        </div>
        <div class="an-section-body">
            <div class="an-chart-sm"><canvas id="usersChart"></canvas></div>
        </div>
    </div>
    <!-- Orders by Status Doughnut -->
    <div class="an-section">
        <div class="an-section-head">
            <h5><i class="bi bi-pie-chart-fill"></i> Orders by Status</h5>
        </div>
        <div class="an-section-body">
            <div class="an-chart-sm"><canvas id="statusChart"></canvas></div>
        </div>
    </div>
    <!-- Payment Methods Distribution -->
    <div class="an-section">
        <div class="an-section-head">
            <h5><i class="bi bi-credit-card"></i> Payment Methods</h5>
        </div>
        <div class="an-section-body">
            <div class="an-chart-sm"><canvas id="paymentChart"></canvas></div>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
Chart.defaults.color = '#A1A1AA';
Chart.defaults.borderColor = 'rgba(42,42,46,0.5)';
Chart.defaults.font.family = "'Space Grotesk', sans-serif";

function grad(ctx, c1, c2) {
    const g = ctx.createLinearGradient(0, 0, 0, 240);
    g.addColorStop(0, c1);
    g.addColorStop(1, c2);
    return g;
}

const labels = @json($monthLabels ?? []);

// ---- Revenue Bar Chart ----
const rCtx = document.getElementById('revChart')?.getContext('2d');
if (rCtx) {
    new Chart(rCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue',
                data: @json($revenueByMonth ?? []),
                backgroundColor: grad(rCtx, 'rgba(234,179,8,0.6)', 'rgba(234,179,8,0.05)'),
                borderColor: '#EAB308',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1A1A1E', titleColor: '#F4F4F5', bodyColor: '#EAB308',
                    borderColor: '#2A2A2E', borderWidth: 1, padding: 10,
                    callbacks: { label: ctx => '₦' + ctx.parsed.y.toLocaleString() }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#71717A', font: { size: 10 } } },
                y: {
                    grid: { color: 'rgba(42,42,46,0.3)' },
                    ticks: { color: '#71717A', font: { size: 10 }, callback: v => '₦' + (v/1000).toFixed(0) + 'k' },
                    beginAtZero: true
                }
            }
        }
    });
}

// ---- Orders Trend Line ----
const oCtx = document.getElementById('ordersChart')?.getContext('2d');
if (oCtx) {
    new Chart(oCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders',
                data: @json($ordersByMonth ?? []),
                borderColor: '#60A5FA',
                backgroundColor: grad(oCtx, 'rgba(59,130,246,0.4)', 'rgba(59,130,246,0.02)'),
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#60A5FA',
                pointBorderColor: '#121214',
                pointBorderWidth: 2,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1A1A1E', titleColor: '#F4F4F5', bodyColor: '#60A5FA',
                    borderColor: '#2A2A2E', borderWidth: 1, padding: 10
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#71717A', font: { size: 10 } } },
                y: {
                    grid: { color: 'rgba(42,42,46,0.3)' },
                    ticks: { color: '#71717A', font: { size: 10 }, stepSize: 1 },
                    beginAtZero: true
                }
            }
        }
    });
}

// ---- User Growth Line ----
const uCtx = document.getElementById('usersChart')?.getContext('2d');
if (uCtx) {
    new Chart(uCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'New Users',
                data: @json($usersByMonth ?? []),
                borderColor: '#4ADE80',
                backgroundColor: grad(uCtx, 'rgba(34,197,94,0.35)', 'rgba(34,197,94,0.02)'),
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#4ADE80',
                pointBorderColor: '#121214',
                pointBorderWidth: 2,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1A1A1E', titleColor: '#F4F4F5', bodyColor: '#4ADE80',
                    borderColor: '#2A2A2E', borderWidth: 1, padding: 10
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#71717A', font: { size: 9 } } },
                y: {
                    grid: { color: 'rgba(42,42,46,0.3)' },
                    ticks: { color: '#71717A', font: { size: 9 }, stepSize: 1 },
                    beginAtZero: true
                }
            }
        }
    });
}

// ---- Orders Status Doughnut ----
const sCtx = document.getElementById('statusChart')?.getContext('2d');
if (sCtx) {
    const sd = @json($ordersByStatus ?? []);
    const sLabels = Object.keys(sd).map(s => s.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase()));
    const sValues = Object.values(sd);
    const sColors = ['#4ADE80','#60A5FA','#EAB308','#EF4444','#C084FC','#F472B6'];
    if (sValues.length > 0) {
        new Chart(sCtx, {
            type: 'doughnut',
            data: {
                labels: sLabels,
                datasets: [{ data: sValues, backgroundColor: sColors.slice(0,sLabels.length), borderColor: '#121214', borderWidth: 2, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#A1A1AA', font: { size: 9, family: "'Space Grotesk', sans-serif" }, padding: 8, usePointStyle: true, pointStyle: 'circle' }
                    },
                    tooltip: {
                        backgroundColor: '#1A1A1E', titleColor: '#F4F4F5', bodyColor: '#A1A1AA',
                        borderColor: '#2A2A2E', borderWidth: 1, padding: 8,
                        callbacks: { label: ctx => ctx.parsed + ' orders' }
                    }
                }
            }
        });
    } else {
        sCtx.canvas.parentElement.innerHTML = '<div class="db-empty-state"><i class="bi bi-inbox"></i> No data</div>';
    }
}

// ---- Payment Methods Doughnut ----
const pCtx = document.getElementById('paymentChart')?.getContext('2d');
if (pCtx) {
    const pm = @json($paymentMethods ?? []);
    const pLabels = Object.keys(pm).map(s => s.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase()));
    const pValues = Object.values(pm);
    const pColors = ['#FACC15','#60A5FA'];
    if (pValues.length > 0) {
        // Also add gateway data as a secondary dataset label
        const gw = @json($paymentsByGateway ?? []);
        const gwLabels = Object.keys(gw).map(s => s.replace(/_/g,' ').replace(/\b\w/g,c=>c.toUpperCase()));
        const gwValues = Object.values(gw);

        const chart = new Chart(pCtx, {
            type: 'doughnut',
            data: {
                labels: pLabels,
                datasets: [{ data: pValues, backgroundColor: pColors.slice(0,pLabels.length), borderColor: '#121214', borderWidth: 2, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#A1A1AA', font: { size: 9, family: "'Space Grotesk', sans-serif" }, padding: 8, usePointStyle: true, pointStyle: 'circle' }
                    },
                    tooltip: {
                        backgroundColor: '#1A1A1E', titleColor: '#F4F4F5', bodyColor: '#A1A1AA',
                        borderColor: '#2A2A2E', borderWidth: 1, padding: 8,
                        callbacks: {
                            label: ctx => ctx.parsed.toFixed(0) + ' orders'
                        }
                    }
                }
            }
        });
    } else {
        pCtx.canvas.parentElement.innerHTML = '<div class="db-empty-state"><i class="bi bi-inbox"></i> No data</div>';
    }
}
</script>
@endsection
