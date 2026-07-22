<div class="sf-admin-brand">
    <div class="sf-admin-brand-icon"><i class="bi bi-search-heart-fill"></i></div>
    <div>
        <div class="sf-admin-brand-text">Sheba<span>Finder</span></div>
        <small>Admin Dashboard</small>
    </div>
</div>

<nav class="sf-sidebar-nav">
    <div class="sf-nav-section">
        <span class="sf-nav-label">মূল মেনু</span>
        <a href="{{ url('/admin') }}" class="sf-sidebar-link {{ request()->is('admin') && !request()->is('admin/*') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> ড্যাশবোর্ড
        </a>
        <a href="{{ url('/admin/workers') }}" class="sf-sidebar-link {{ request()->is('admin/workers*') ? 'active' : '' }}">
            <i class="bi bi-grid-3x3-gap-fill"></i> কর্মচারী
        </a>
        <a href="{{ url('/admin/category') }}" class="sf-sidebar-link {{ request()->is('admin/category*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> ক্যাটাগরি
        </a>
    </div>
    <div class="sf-nav-section">
        <span class="sf-nav-label">ব্যবস্থাপনা</span>
        <a href="{{ url('/admin/contacts') }}" class="sf-sidebar-link {{ request()->is('admin/contacts*') ? 'active' : '' }}">
            <i class="bi bi-envelope-fill"></i> যোগাযোগ বার্তা
        </a>
        <a href="{{ url('/admin/sliders') }}" class="sf-sidebar-link {{ request()->is('admin/sliders*') ? 'active' : '' }}">
            <i class="bi bi-images"></i> স্লাইডার
        </a>
        <a href="{{ url('/admin/settings') }}" class="sf-sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> সেটিংস
        </a>
    </div>
    <div class="sf-nav-section">
        <a href="{{ url('/') }}" class="sf-sidebar-link">
            <i class="bi bi-house-fill"></i> ওয়েবসাইট
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sf-sidebar-link sf-logout-btn w-100">
                <i class="bi bi-box-arrow-right"></i> লগআউট
            </button>
        </form>
    </div>
</nav>

<style>
.sf-sidebar-nav { padding: 16px 12px; display: flex; flex-direction: column; gap: 4px; }
.sf-nav-section { margin-bottom: 8px; padding-bottom: 8px; border-bottom: 1px solid rgba(255,255,255,0.06); }
.sf-nav-section:last-child { border-bottom: none; }
.sf-nav-label { display: block; font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1px; padding: 8px 12px 4px; }
.sf-sidebar-link {
    display: flex; align-items: center; gap: 10px;
    padding: 11px 14px; border-radius: 10px;
    color: rgba(255,255,255,0.55); font-size: 14px; font-weight: 600;
    text-decoration: none; transition: all 0.3s;
    margin-bottom: 2px; border: none; background: transparent; cursor: pointer;
    font-family: inherit; width: 100%; text-align: left;
}
.sf-sidebar-link:hover { background: rgba(37,99,235,0.15); color: white; padding-left: 18px; }
.sf-sidebar-link.active { background: linear-gradient(135deg, #2563EB, #1d4ed8); color: white; box-shadow: 0 4px 14px rgba(37,99,235,0.4); }
.sf-sidebar-link i { font-size: 16px; width: 20px; }
.sf-logout-btn:hover { background: rgba(239,68,68,0.15) !important; color: #f87171 !important; }
</style>
