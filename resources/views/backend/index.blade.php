@extends('backend.app')
@section('title', 'Dashboard — FlexiPay Admin')
@section('page_title', 'Dashboard')

@section('content')
<style>
/* ===== DASHBOARD SPECIFIC STYLES ===== */
.db-grid { display: grid; gap: 18px; }

/* Stats Row */
.db-stats { grid-template-columns: repeat(4, 1fr); margin-bottom: 6px; }
@media (max-width: 1200px) { .db-stats { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 640px) { .db-stats { grid-template-columns: 1fr; gap: 12px; } }

.db-stat-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 18px 20px;
    position: relative;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(.22,.68,0,1);
    contain: layout style;
}
.db-stat-card:hover {
    border-color: rgba(234,179,8,0.25);
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}
.db-stat-card .stat-glow {
    position: absolute; top: -60px; right: -60px;
    width: 140px; height: 140px; border-radius: 50%;
    transition: all 0.4s;
}
.db-stat-card:hover .stat-glow { width: 180px; height: 180px; top: -80px; right: -80px; }
.db-stat-card .stat-glow.glow-gold { background: radial-gradient(circle, rgba(234,179,8,0.12), transparent); }
.db-stat-card .stat-glow.glow-blue { background: radial-gradient(circle, rgba(59,130,246,0.12), transparent); }
.db-stat-card .stat-glow.glow-green { background: radial-gradient(circle, rgba(34,197,94,0.12), transparent); }
.db-stat-card .stat-glow.glow-purple { background: radial-gradient(circle, rgba(168,85,247,0.12), transparent); }

.db-stat-top { display: flex; align-items: flex-start; justify-content: space-between; position: relative; z-index: 1; }
.db-stat-icon {
    width: 42px; height: 42px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; margin-bottom: 10px;
}
.db-stat-icon.icon-gold { background: rgba(234,179,8,0.12); color: var(--gold-500); }
.db-stat-icon.icon-blue { background: rgba(59,130,246,0.12); color: #60a5fa; }
.db-stat-icon.icon-green { background: rgba(34,197,94,0.12); color: #4ade80; }
.db-stat-icon.icon-purple { background: rgba(168,85,247,0.12); color: #c084fc; }
.db-stat-change {
    font-size: 11px; font-weight: 600; padding: 3px 8px; border-radius: 6px;
    display: flex; align-items: center; gap: 3px;
}
.db-stat-change.up { background: rgba(34,197,94,0.12); color: #4ade80; }
.db-stat-change.down { background: rgba(239,68,68,0.12); color: #ef4444; }

.db-stat-value {
    font-family: 'Syne', sans-serif;
    font-size: 26px; font-weight: 800; color: var(--text-primary);
    line-height: 1.2; position: relative; z-index: 1;
}
.db-stat-label { font-size: 12px; color: var(--text-dim); margin-top: 2px; position: relative; z-index: 1; }

/* Mini Sparkline Bar */
.db-sparkline { display: flex; align-items: flex-end; gap: 2px; height: 28px; margin-top: 10px; position: relative; z-index: 1; }
.db-sparkline .bar {
    flex: 1; border-radius: 2px 2px 0 0; min-height: 3px;
    animation: barRise 0.8s ease both;
}
@keyframes barRise { from { height: 0% !important; } }
.db-sparkline .bar.gold { background: linear-gradient(to top, rgba(234,179,8,0.3), rgba(234,179,8,0.7)); }
.db-sparkline .bar.blue { background: linear-gradient(to top, rgba(59,130,246,0.3), rgba(59,130,246,0.7)); }
.db-sparkline .bar.green { background: linear-gradient(to top, rgba(34,197,94,0.3), rgba(34,197,94,0.7)); }
.db-sparkline .bar.purple { background: linear-gradient(to top, rgba(168,85,247,0.3), rgba(168,85,247,0.7)); }

/* Two-column layout */
.db-two-col { grid-template-columns: 2fr 1fr; }
@media (max-width: 992px) { .db-two-col { grid-template-columns: 1fr; } }

/* Section Card */
.db-section {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    overflow: hidden;
    transition: border-color 0.3s;
    contain: layout style;
}
.db-section:hover { border-color: rgba(234,179,8,0.15); }
.db-section-head {
    padding: 16px 20px;
    border-bottom: 1px solid var(--card-border);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;
}
.db-section-head h5 {
    font-family: 'Syne', sans-serif;
    font-size: 14px; font-weight: 700; color: var(--text-primary); margin: 0;
    display: flex; align-items: center; gap: 8px;
}
.db-section-head h5 i { color: var(--gold-500); font-size: 16px; }
.db-section-body { padding: 0; }

/* Dashboard Table */
.db-table { width: 100%; border-collapse: collapse; }
.db-table th {
    padding: 10px 20px; text-align: left;
    font-size: 11px; font-weight: 600; color: var(--text-dim);
    text-transform: uppercase; letter-spacing: 0.5px;
    border-bottom: 1px solid var(--card-border);
    background: rgba(0,0,0,0.15);
}
.db-table td {
    padding: 10px 20px;
    font-size: 13px;
    color: var(--text-muted);
    border-bottom: 1px solid rgba(42,42,46,0.5);
    vertical-align: middle;
}
.db-table tr:last-child td { border-bottom: none; }
.db-table tr { transition: background 0.2s; }
.db-table tbody tr:hover { background: rgba(234,179,8,0.03); }
.db-table .user-cell { display: flex; align-items: center; gap: 8px; }
.db-table .user-avatar {
    width: 30px; height: 30px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700;
}
.db-table .user-avatar.av-gold { background: rgba(234,179,8,0.15); color: var(--gold-400); }
.db-table .user-avatar.av-blue { background: rgba(59,130,246,0.15); color: #60a5fa; }
.db-table .user-avatar.av-green { background: rgba(34,197,94,0.15); color: #4ade80; }
.db-table .user-avatar.av-purple { background: rgba(168,85,247,0.15); color: #c084fc; }
.db-table .user-avatar.av-pink { background: rgba(236,72,153,0.15); color: #f472b6; }
.db-table .user-avatar.av-orange { background: rgba(249,115,22,0.15); color: #fb923c; }
.db-table .user-name { color: var(--text-primary); font-weight: 600; }
.db-table .order-id { color: var(--gold-400); font-weight: 600; font-size: 12px; font-family: monospace; }
.db-table .amount-cell { font-weight: 600; color: var(--text-primary); }
.db-table .time-cell { font-size: 12px; color: var(--text-dim); }

/* Status Badges for Dashboard */
.db-badge {
    display: inline-flex; align-items: center; gap: 4px;
    padding: 3px 10px; border-radius: 20px;
    font-size: 11px; font-weight: 600;
}
.db-badge i { font-size: 8px; }
.db-badge-success { background: rgba(34,197,94,0.12); color: #4ade80; }
.db-badge-warning { background: rgba(234,179,8,0.12); color: var(--gold-400); }
.db-badge-danger { background: rgba(239,68,68,0.12); color: #ef4444; }
.db-badge-info { background: rgba(59,130,246,0.12); color: #60a5fa; }
.db-badge-neutral { background: rgba(161,161,170,0.12); color: var(--text-muted); }

/* User List (compact) */
.db-user-list { padding: 4px 0; }
.db-user-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 20px;
    transition: background 0.2s;
    border-bottom: 1px solid rgba(42,42,46,0.4);
}
.db-user-item:last-child { border-bottom: none; }
.db-user-item:hover { background: rgba(234,179,8,0.03); }
.db-user-item .ui-avatar {
    width: 34px; height: 34px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 700; flex-shrink: 0;
}
.db-user-item .ui-info { flex: 1; min-width: 0; }
.db-user-item .ui-info .ui-name { font-size: 13px; font-weight: 600; color: var(--text-primary); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.db-user-item .ui-info .ui-email { font-size: 11px; color: var(--text-dim); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.db-user-item .ui-time { font-size: 11px; color: var(--text-dim); white-space: nowrap; }

/* Pending Request Cards Row */
.db-requests { grid-template-columns: repeat(3, 1fr); margin-top: 4px; }
@media (max-width: 992px) { .db-requests { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 540px) { .db-requests { grid-template-columns: 1fr; } }

.db-req-card {
    background: var(--card-dark);
    border: 1px solid var(--card-border);
    border-radius: var(--radius);
    padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
    transition: all 0.3s;
    contain: layout style;
}
.db-req-card:hover {
    border-color: rgba(234,179,8,0.2);
    transform: translateY(-2px);
    box-shadow: 0 6px 24px rgba(0,0,0,0.2);
}
.db-req-icon {
    width: 44px; height: 44px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; flex-shrink: 0;
}
.db-req-icon.req-orange { background: rgba(249,115,22,0.12); color: #fb923c; }
.db-req-icon.req-blue { background: rgba(59,130,246,0.12); color: #60a5fa; }
.db-req-icon.req-purple { background: rgba(168,85,247,0.12); color: #c084fc; }
.db-req-info { flex: 1; }
.db-req-info .req-label { font-size: 12px; color: var(--text-dim); margin-bottom: 2px; }
.db-req-info .req-count { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; color: var(--text-primary); line-height: 1.2; }
.db-req-info .req-link { font-size: 11px; color: var(--gold-400); margin-top: 3px; display: inline-flex; align-items: center; gap: 4px; transition: gap 0.2s; }
.db-req-info .req-link:hover { gap: 6px; color: var(--gold-300); }

/* Quick Actions */
.db-quick-actions { margin-top: 4px; }
.db-qa-grid { display: flex; flex-wrap: wrap; gap: 8px; padding: 16px 20px; }
.db-qa-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 8px;
    background: var(--surface-dark);
    border: 1px solid var(--card-border);
    color: var(--text-muted);
    font-size: 12px; font-weight: 600;
    transition: all 0.2s; font-family: inherit;
}
.db-qa-btn i { font-size: 14px; }
.db-qa-btn:hover {
    background: rgba(234,179,8,0.06);
    border-color: rgba(234,179,8,0.2);
    color: var(--gold-400);
    transform: translateY(-1px);
}

/* Welcome Strip */
.db-welcome {
    background: linear-gradient(135deg, rgba(234,179,8,0.06), rgba(202,138,4,0.03));
    border: 1px solid rgba(234,179,8,0.12);
    border-radius: var(--radius);
    padding: 18px 22px;
    margin-bottom: 18px;
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
    contain: layout style;
}
.db-welcome-left { display: flex; align-items: center; gap: 14px; }
.db-welcome-icon {
    width: 44px; height: 44px; border-radius: 12px;
    background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; color: var(--near-black);
}
.db-welcome-text h4 { font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 0; }
.db-welcome-text p { font-size: 12px; color: var(--text-muted); margin: 2px 0 0; }
.db-welcome-time {
    display: flex; align-items: center; gap: 8px;
    background: rgba(234,179,8,0.08);
    border: 1px solid rgba(234,179,8,0.15);
    padding: 8px 14px; border-radius: 10px;
    font-size: 13px; color: var(--gold-400); font-weight: 600;
}

/* Scrollable table wrapper */
.db-scroll-x { overflow-x: auto; -webkit-overflow-scrolling: touch; }
.db-scroll-x::-webkit-scrollbar { height: 4px; }
.db-scroll-x::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 99px; }

/* Animations */
.anim-fade-in { animation: animFadeIn 0.6s ease both; }
.anim-fade-up { animation: animFadeUp 0.6s cubic-bezier(.22,.68,0,1) both; }
@keyframes animFadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes animFadeUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
.anim-delay-1 { animation-delay: 0.05s; }
.anim-delay-2 { animation-delay: 0.1s; }
.anim-delay-3 { animation-delay: 0.15s; }
.anim-delay-4 { animation-delay: 0.2s; }
.anim-delay-5 { animation-delay: 0.25s; }
.anim-delay-6 { animation-delay: 0.3s; }
.anim-delay-7 { animation-delay: 0.35s; }
.anim-delay-8 { animation-delay: 0.4s; }

/* Empty states */
.db-empty-state {
    padding: 32px 20px; text-align: center;
    color: var(--text-dim); font-size: 13px;
}
.db-empty-state i { font-size: 28px; color: var(--card-border); margin-bottom: 8px; display: block; }
</style>

<!-- WELCOME STRIP -->
<div class="db-welcome anim-fade-in">
    <div class="db-welcome-left">
        <div class="db-welcome-icon"><i class="bi bi-lightning-charge-fill"></i></div>
        <div class="db-welcome-text">
            <h4>Good {{ now()->format('H') < 12 ? 'Morning' : (now()->format('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ auth()->user()->name ?? 'Admin' }}! 👋</h4>
            <p>Here's what's happening with your store today</p>
        </div>
    </div>
    <div class="db-welcome-time">
        <i class="bi bi-calendar3"></i> {{ now()->format('l, F j, Y') }}
    </div>
</div>

<!-- STATS ROW -->
<div class="db-grid db-stats">
    @php
        $sparkGen = function($max = 80) { return array_map(fn() => rand(15, $max), range(1, 12)); };
        $revSpark = $sparkGen(100);
        $ordSpark = $sparkGen(70);
        $usrSpark = $sparkGen(60);
        $prdSpark = $sparkGen(50);
    @endphp

    <div class="db-stat-card anim-fade-up anim-delay-1">
        <div class="stat-glow glow-gold"></div>
        <div class="db-stat-top">
            <div class="db-stat-icon icon-gold"><i class="bi bi-currency-exchange"></i></div>
            <span class="db-stat-change up"><i class="bi bi-arrow-up-short"></i> +12.5%</span>
        </div>
        <div class="db-stat-value">₦{{ number_format($totalRevenue ?? 0, 0) }}</div>
        <div class="db-stat-label">Total Revenue</div>
        <div class="db-sparkline">@foreach($revSpark as $v)<div class="bar gold" style="height:{{$v}}%;"></div>@endforeach</div>
    </div>

    <div class="db-stat-card anim-fade-up anim-delay-2">
        <div class="stat-glow glow-blue"></div>
        <div class="db-stat-top">
            <div class="db-stat-icon icon-blue"><i class="bi bi-receipt"></i></div>
            <span class="db-stat-change up"><i class="bi bi-arrow-up-short"></i> +8.2%</span>
        </div>
        <div class="db-stat-value">{{ number_format($totalOrders ?? 0) }}</div>
        <div class="db-stat-label">Total Orders</div>
        <div class="db-sparkline">@foreach($ordSpark as $v)<div class="bar blue" style="height:{{$v}}%;"></div>@endforeach</div>
    </div>

    <div class="db-stat-card anim-fade-up anim-delay-3">
        <div class="stat-glow glow-green"></div>
        <div class="db-stat-top">
            <div class="db-stat-icon icon-green"><i class="bi bi-people-fill"></i></div>
            <span class="db-stat-change up"><i class="bi bi-arrow-up-short"></i> +5.7%</span>
        </div>
        <div class="db-stat-value">{{ number_format($totalUsers ?? 0) }}</div>
        <div class="db-stat-label">Registered Customers</div>
        <div class="db-sparkline">@foreach($usrSpark as $v)<div class="bar green" style="height:{{$v}}%;"></div>@endforeach</div>
    </div>

    <div class="db-stat-card anim-fade-up anim-delay-4">
        <div class="stat-glow glow-purple"></div>
        <div class="db-stat-top">
            <div class="db-stat-icon icon-purple"><i class="bi bi-box-seam-fill"></i></div>
            <span class="db-stat-change up"><i class="bi bi-arrow-up-short"></i> +3.4%</span>
        </div>
        <div class="db-stat-value">{{ number_format($totalProducts ?? 0) }}</div>
        <div class="db-stat-label">Products Listed</div>
        <div class="db-sparkline">@foreach($prdSpark as $v)<div class="bar purple" style="height:{{$v}}%;"></div>@endforeach</div>
    </div>
</div>

<!-- PENDING REQUESTS -->
<div class="db-grid db-requests anim-fade-up anim-delay-5">
    <a href="{{ route('admin.requests.plan-changes') }}" class="db-req-card">
        <div class="db-req-icon req-orange"><i class="bi bi-arrow-repeat"></i></div>
        <div class="db-req-info">
            <div class="req-label">Pending Plan Changes</div>
            <div class="req-count">{{ $pendingPlanChanges ?? 0 }}</div>
            <div class="req-link">Review <i class="bi bi-chevron-right"></i></div>
        </div>
    </a>
    <a href="{{ route('admin.requests.product-requests') }}" class="db-req-card">
        <div class="db-req-icon req-blue"><i class="bi bi-plus-circle"></i></div>
        <div class="db-req-info">
            <div class="req-label">Product Requests</div>
            <div class="req-count">{{ $pendingProductRequests ?? 0 }}</div>
            <div class="req-link">Review <i class="bi bi-chevron-right"></i></div>
        </div>
    </a>
    <a href="{{ route('admin.requests.exchange-requests') }}" class="db-req-card">
        <div class="db-req-icon req-purple"><i class="bi bi-arrow-left-right"></i></div>
        <div class="db-req-info">
            <div class="req-label">Exchange Requests</div>
            <div class="req-count">{{ $pendingExchanges ?? 0 }}</div>
            <div class="req-link">Review <i class="bi bi-chevron-right"></i></div>
        </div>
    </a>
</div>

<!-- TWO-COLUMN: Recent Orders + Recent Users -->
<div class="db-grid db-two-col" style="margin-top: 18px;">

    <!-- RECENT ORDERS -->
    <div class="db-section anim-fade-up anim-delay-6">
        <div class="db-section-head">
            <h5><i class="bi bi-clock-history"></i> Recent Orders</h5>
            <a href="{{ route('admin.orders.index') }}" class="fp-btn fp-btn-ghost" style="padding:5px 12px;font-size:11px;">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="db-section-body">
            <div class="db-scroll-x">
                <table class="db-table">
                    <thead><tr><th>Order</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        @forelse($recentOrders ?? [] as $o)
                        <tr>
                            <td><span class="order-id">#{{ $o->id }}</span></td>
                            <td>
                                <div class="user-cell">
                                    @php
                                        $colors = ['av-gold','av-blue','av-green','av-purple','av-pink','av-orange'];
                                        $avC = $colors[crc32($o->user?->name ?? '') % 6];
                                        $init = strtoupper(substr($o->user?->name ?? '?', 0, 1));
                                    @endphp
                                    <div class="user-avatar {{ $avC }}">{{ $init }}</div>
                                    <span class="user-name">{{ $o->user?->name ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td><span class="amount-cell">₦{{ number_format($o->grand_total ?? 0, 0) }}</span></td>
                            <td>
                                @php
                                    $map = ['completed'=>'success','processing'=>'info','pending'=>'warning','cancelled'=>'danger','partial_paid'=>'info','fully_paid'=>'success'];
                                    $bc = $map[$o->status] ?? 'neutral';
                                @endphp
                                <span class="db-badge db-badge-{{ $bc }}"><i class="bi bi-circle-fill"></i> {{ ucwords(str_replace('_', ' ', $o->status)) }}</span>
                            </td>
                            <td class="time-cell">{{ $o->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5"><div class="db-empty-state"><i class="bi bi-inbox"></i> No orders yet</div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RECENT USERS -->
    <div class="db-section anim-fade-up anim-delay-7">
        <div class="db-section-head">
            <h5><i class="bi bi-person-plus-fill"></i> New Customers</h5>
            <a href="{{ route('admin.users.index') }}" class="fp-btn fp-btn-ghost" style="padding:5px 12px;font-size:11px;">
                View All <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="db-section-body">
            <div class="db-user-list">
                @forelse($recentUsers ?? [] as $u)
                <div class="db-user-item">
                    @php
                        $colors = ['av-gold','av-blue','av-green','av-purple','av-pink','av-orange'];
                        $avC = $colors[crc32($u->name ?? '') % 6];
                        $init = strtoupper(substr($u->name ?? '?', 0, 1));
                    @endphp
                    <div class="ui-avatar {{ $avC }}">{{ $init }}</div>
                    <div class="ui-info">
                        <div class="ui-name">{{ $u->name ?? 'N/A' }}</div>
                        <div class="ui-email">{{ $u->email }}</div>
                    </div>
                    <div class="ui-time">{{ $u->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <div class="db-empty-state"><i class="bi bi-people"></i> No users yet</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="db-section db-quick-actions anim-fade-up anim-delay-8">
    <div class="db-section-head">
        <h5><i class="bi bi-lightning-fill"></i> Quick Actions</h5>
    </div>
    <div class="db-qa-grid">
        <a href="{{ route('admin.products.create') }}" class="db-qa-btn"><i class="bi bi-plus-lg"></i> Add Product</a>
        <a href="{{ route('admin.category.create') }}" class="db-qa-btn"><i class="bi bi-tag"></i> New Category</a>
        <a href="{{ route('admin.brands.create') }}" class="db-qa-btn"><i class="bi bi-building"></i> Add Brand</a>
        <a href="{{ route('admin.suppliers.create') }}" class="db-qa-btn"><i class="bi bi-truck"></i> New Supplier</a>
        <a href="{{ route('admin.campaigns.create') }}" class="db-qa-btn"><i class="bi bi-megaphone"></i> Create Campaign</a>
        <a href="{{ route('admin.analytics') }}" class="db-qa-btn"><i class="bi bi-graph-up"></i> View Analytics</a>
        <a href="{{ route('admin.settings') }}" class="db-qa-btn"><i class="bi bi-gear"></i> Settings</a>
        <a href="{{ route('admin.orders.export') }}" class="db-qa-btn"><i class="bi bi-download"></i> Export Orders</a>
    </div>
</div>

<!-- COUNTER ANIMATION -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const els = document.querySelectorAll('.db-stat-value');
    els.forEach(el => {
        const txt = el.textContent;
        const m = txt.match(/[\d,]+/);
        if (!m) return;
        const target = parseInt(m[0].replace(/,/g, ''));
        if (target === 0) return;
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                obs.unobserve(el);
                const prefix = txt.startsWith('\u20A6') ? '\u20A6' : '';
                const steps = 75;
                const inc = target / steps;
                let cur = 0;
                const t = setInterval(() => {
                    cur += inc;
                    if (cur >= target) { cur = target; clearInterval(t); }
                    el.textContent = prefix + Math.floor(cur).toLocaleString();
                }, 16);
            });
        }, { threshold: 0.3 });
        obs.observe(el);
    });
});
</script>
@endsection