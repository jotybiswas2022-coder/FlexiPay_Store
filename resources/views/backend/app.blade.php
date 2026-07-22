<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin — FlexiPay Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold-400: #FACC15;
            --gold-500: #EAB308;
            --gold-600: #CA8A04;
            --dark-900: #18181B;
            --dark-950: #09090B;
            --near-black: #0A0A0B;
            --surface-dark: #121214;
            --card-dark: #1A1A1E;
            --card-border: #2A2A2E;
            --text-primary: #F4F4F5;
            --text-muted: #A1A1AA;
            --text-dim: #71717A;
            --shadow-card: 0 4px 24px rgba(0,0,0,0.3);
            --radius: 14px;
            --radius-sm: 8px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--near-black);
            color: var(--text-muted);
            overflow-x: hidden;
        }
        ::selection { background: var(--gold-500); color: var(--near-black); }

        /* Sidebar */
        .fp-admin-wrapper { display: flex; min-height: 100vh; }

        .fp-sidebar {
            width: 250px;
            background: var(--surface-dark);
            border-right: 1px solid var(--card-border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0;
            z-index: 1050;
            transition: transform 0.3s;
        }
        .fp-sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid var(--card-border);
            display: flex; align-items: center; gap: 10px;
        }
        .fp-sidebar-brand-icon {
            width: 36px; height: 36px; border-radius: 8px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-600));
            display: flex; align-items: center; justify-content: center;
            color: var(--near-black); font-size: 18px;
        }
        .fp-sidebar-brand-text {
            font-family: 'Syne', sans-serif;
            font-size: 16px; font-weight: 800;
            color: var(--text-primary);
        }
        .fp-sidebar-brand-text span { color: var(--gold-500); }

        .fp-sidebar-nav { flex: 1; padding: 12px; overflow-y: auto; display: flex; flex-direction: column; gap: 2px; }
        .fp-sidebar-nav a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 14px; border-radius: 8px;
            color: var(--text-muted); font-size: 13px; font-weight: 500;
            transition: all 0.2s;
        }
        .fp-sidebar-nav a i { width: 20px; font-size: 15px; }
        .fp-sidebar-nav a:hover, .fp-sidebar-nav a.active {
            background: rgba(234,179,8,0.08);
            color: var(--gold-400);
        }
        .fp-sidebar-nav a.active { border-left: 3px solid var(--gold-500); }
        .fp-sidebar-nav .nav-section {
            font-size: 10px; font-weight: 700; color: var(--text-dim);
            text-transform: uppercase; letter-spacing: 1px;
            padding: 16px 14px 6px;
        }

        .fp-sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--card-border);
        }
        .fp-sidebar-footer a {
            display: flex; align-items: center; gap: 8px;
            padding: 10px 14px; border-radius: 8px;
            color: var(--text-dim); font-size: 13px;
            transition: all 0.2s;
        }
        .fp-sidebar-footer a:hover { background: rgba(239,68,68,0.08); color: #ef4444; }

        /* Main Content */
        .fp-main {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .fp-topbar {
            background: var(--surface-dark);
            border-bottom: 1px solid var(--card-border);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .fp-topbar-left { display: flex; align-items: center; gap: 12px; }
        .fp-sidebar-toggle {
            display: none;
            background: none; border: none;
            color: var(--text-primary); font-size: 20px;
            cursor: pointer;
        }
        .fp-topbar h5 { font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700; color: var(--text-primary); margin: 0; }
        .fp-topbar-right { display: flex; align-items: center; gap: 12px; }
        .fp-topbar-user {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: var(--text-muted);
        }
        .fp-topbar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--gold-500); color: var(--near-black);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px;
        }

        .fp-content { flex: 1; padding: 24px; }

        /* Stat Card */
        .fp-stat-card {
            background: var(--card-dark);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            padding: 20px;
            transition: all 0.3s;
        }
        .fp-stat-card:hover { border-color: rgba(234,179,8,0.2); }
        .fp-stat-card .stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            background: rgba(234,179,8,0.1);
            display: flex; align-items: center; justify-content: center;
            color: var(--gold-500); font-size: 20px;
            margin-bottom: 12px;
        }
        .fp-stat-card .stat-num { font-family: 'Syne', sans-serif; font-size: 28px; font-weight: 800; color: var(--text-primary); }
        .fp-stat-card .stat-label { font-size: 13px; color: var(--text-dim); }

        /* Table */
        .fp-table-wrap {
            background: var(--card-dark);
            border: 1px solid var(--card-border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .fp-table-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--card-border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .fp-table-header h5 { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; color: var(--text-primary); margin: 0; }
        .fp-table { width: 100%; border-collapse: collapse; }
        .fp-table th {
            padding: 12px 20px; text-align: left;
            font-size: 12px; font-weight: 600; color: var(--text-dim);
            text-transform: uppercase; letter-spacing: 0.5px;
            border-bottom: 1px solid var(--card-border);
            background: var(--surface-dark);
        }
        .fp-table td {
            padding: 12px 20px;
            font-size: 13px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--card-border);
        }
        .fp-table tr:hover td { background: rgba(234,179,8,0.02); }
        .fp-table tr:last-child td { border-bottom: none; }

        .fp-badge {
            display: inline-flex; padding: 3px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 600;
        }
        .fp-badge-active { background: rgba(34,197,94,0.15); color: #4ade80; }
        .fp-badge-pending { background: rgba(234,179,8,0.15); color: var(--gold-400); }
        .fp-badge-inactive { background: rgba(239,68,68,0.15); color: #ef4444; }

        .fp-btn {
            padding: 8px 16px; border-radius: 6px;
            font-size: 12px; font-weight: 600; border: none; cursor: pointer;
            display: inline-flex; align-items: center; gap: 5px;
            font-family: inherit; transition: all 0.2s;
        }
        .fp-btn-gold { background: var(--gold-500); color: var(--near-black); }
        .fp-btn-gold:hover { background: var(--gold-600); }
        .fp-btn-ghost { background: transparent; color: var(--text-muted); border: 1px solid var(--card-border); }
        .fp-btn-ghost:hover { border-color: var(--gold-400); color: var(--gold-400); }
        .fp-btn-danger { background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); }
        .fp-btn-danger:hover { background: rgba(239,68,68,0.2); }

        .fp-form-control {
            background: var(--surface-dark);
            border: 1.5px solid var(--card-border);
            color: var(--text-primary);
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: inherit;
            outline: none;
            width: 100%;
            transition: all 0.2s;
        }
        .fp-form-control:focus { border-color: var(--gold-500); box-shadow: 0 0 0 3px rgba(234,179,8,0.08); }
        .fp-form-control::placeholder { color: var(--text-dim); }
        .fp-form-control option { background: var(--card-dark); color: var(--text-primary); }

        @media (max-width: 768px) {
            .fp-sidebar { transform: translateX(-100%); }
            .fp-sidebar.open { transform: translateX(0); }
            .fp-main { margin-left: 0; }
            .fp-sidebar-toggle { display: block; }
            .fp-overlay {
                position: fixed; inset: 0; background: rgba(0,0,0,0.5);
                z-index: 1040; display: none;
            }
            .fp-overlay.open { display: block; }
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--near-black); }
        ::-webkit-scrollbar-thumb { background: var(--card-border); border-radius: 99px; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="fp-admin-wrapper">
        <!-- Sidebar -->
        <aside class="fp-sidebar" id="adminSidebar">
            <div class="fp-sidebar-brand">
                <div class="fp-sidebar-brand-icon"><i class="bi bi-currency-exchange"></i></div>
                <div class="fp-sidebar-brand-text">Flexi<span>Pay</span></div>
            </div>

            <nav class="fp-sidebar-nav">
                <div class="nav-section">Main</div>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <div class="nav-section">Shop</div>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i> Products
                </a>
                <a href="{{ route('admin.category.index') }}" class="{{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <i class="bi bi-tag-fill"></i> Categories
                </a>
                <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Brands
                </a>
                <a href="{{ route('admin.suppliers.index') }}" class="{{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                    <i class="bi bi-truck"></i> Suppliers
                </a>

                <div class="nav-section">Orders</div>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Orders
                </a>
                <a href="{{ route('admin.orders.fees') }}" class="{{ request()->routeIs('admin.orders.fees*') ? 'active' : '' }}">
                    <i class="bi bi-cash-coin"></i> Product Fees
                </a>

                <div class="nav-section">Users</div>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Customers
                </a>
                <a href="{{ route('admin.users.verifications') }}" class="{{ request()->routeIs('admin.users.verifications*') ? 'active' : '' }}">
                    <i class="bi bi-patch-check-fill"></i> Verifications
                </a>

                <div class="nav-section">Requests</div>
                <a href="{{ route('admin.requests.plan-changes') }}" class="{{ request()->routeIs('admin.requests.plan-changes*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-repeat"></i> Plan Changes
                </a>
                <a href="{{ route('admin.requests.product-requests') }}" class="{{ request()->routeIs('admin.requests.product-requests*') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> Product Requests
                </a>
                <a href="{{ route('admin.requests.exchange-requests') }}" class="{{ request()->routeIs('admin.requests.exchange-requests*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Exchanges
                </a>

                <div class="nav-section">Marketing</div>
                <a href="{{ route('admin.campaigns.index') }}" class="{{ request()->routeIs('admin.campaigns.*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone-fill"></i> Campaigns
                </a>

                <div class="nav-section">Content</div>
                <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Sliders
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <i class="bi bi-question-circle"></i> FAQs
                </a>
                <a href="{{ route('admin.terms.index') }}" class="{{ request()->routeIs('admin.terms.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Terms
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Contacts
                </a>

                <div class="nav-section">Settings</div>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="bi bi-gear-fill"></i> Settings
                </a>
                <a href="{{ route('admin.analytics') }}" class="{{ request()->routeIs('admin.analytics*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up"></i> Analytics
                </a>
            </nav>

            <div class="fp-sidebar-footer">
                <a href="{{ url('/') }}"><i class="bi bi-house-fill"></i> Back to Store</a>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div class="fp-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="fp-main">
            <div class="fp-topbar">
                <div class="fp-topbar-left">
                    <button class="fp-sidebar-toggle" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>
                    <h5>@yield('page_title', 'Dashboard')</h5>
                </div>
                <div class="fp-topbar-right">
                    <div class="fp-topbar-user">
                        <div class="fp-topbar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                        <span>{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-ghost"><i class="bi bi-box-arrow-right"></i></button>
                    </form>
                </div>
            </div>

            <div class="fp-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('adminSidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
    </script>
    @stack('scripts')
</body>
</html>