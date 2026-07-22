@extends('frontend.app')

@section('content')

{{-- ===== Alert Messages ===== --}}
@if (session('success'))
    <div class="alert sf-alert sf-alert-success alert-dismissible fade show m-3">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert sf-alert sf-alert-danger alert-dismissible fade show m-3">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<style>
/* ============================================================
   SHEBAFINDER — Local Service Finder | Post Detail Page CSS
   Primary: #2563EB | Background: #FFFFFF | Accent: #22C55E
   ============================================================ */

@import url('https://fonts.googleapis.com/css2?family=Tiro+Bangla&family=Hind+Siliguri:wght@400;500;600;700&family=Syne:wght@700;800&display=swap');

:root {
    --sf-primary:       #2563EB;
    --sf-primary-dark:  #1D4ED8;
    --sf-primary-light: #DBEAFE;
    --sf-primary-xlight:#EFF6FF;
    --sf-accent:        #22C55E;
    --sf-accent-dark:   #16A34A;
    --sf-accent-light:  #DCFCE7;
    --sf-white:         #FFFFFF;
    --sf-bg:            #F8FAFF;
    --sf-card:          #FFFFFF;
    --sf-border:        #E2E8F0;
    --sf-border-blue:   #BFDBFE;
    --sf-text:          #1E293B;
    --sf-text-muted:    #64748B;
    --sf-text-light:    #94A3B8;
    --sf-shadow-sm:     0 1px 3px rgba(37,99,235,.08), 0 1px 2px rgba(37,99,235,.06);
    --sf-shadow:        0 4px 16px rgba(37,99,235,.12), 0 2px 8px rgba(37,99,235,.06);
    --sf-shadow-lg:     0 12px 40px rgba(37,99,235,.15), 0 4px 16px rgba(37,99,235,.08);
    --sf-radius:        14px;
    --sf-radius-sm:     8px;
    --sf-radius-lg:     20px;
    --sf-transition:    all .28s cubic-bezier(.4,0,.2,1);
}

/* ── Base Reset for this page ── */
.sf-post-page *,
.sf-post-page *::before,
.sf-post-page *::after { box-sizing: border-box; }

.sf-post-page {
    background: var(--sf-bg);
    font-family: 'Hind Siliguri', sans-serif;
    color: var(--sf-text);
    min-height: 100vh;
    overflow-x: hidden;
}

/* ── Alerts ── */
.sf-alert {
    border: none;
    border-radius: var(--sf-radius-sm);
    font-weight: 500;
    font-size: .9rem;
}
.sf-alert-success { background: var(--sf-accent-light); color: var(--sf-accent-dark); }
.sf-alert-danger  { background: #FEE2E2; color: #B91C1C; }

/* ============================================================
   HERO STRIP — animated service finder bar
   ============================================================ */
.sf-hero-strip {
    background: var(--sf-primary);
    padding: 0;
    overflow: hidden;
    position: relative;
}

.sf-hero-strip::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 10% 50%, rgba(34,197,94,.18) 0%, transparent 60%),
        radial-gradient(ellipse 50% 90% at 90% 50%, rgba(255,255,255,.06) 0%, transparent 60%);
    pointer-events: none;
}

/* floating service icons bg */
.sf-strip-icons-bg {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}
.sf-strip-icons-bg span {
    position: absolute;
    color: rgba(255,255,255,.07);
    font-size: 3.5rem;
    animation: sfFloatBg 12s ease-in-out infinite;
}
.sf-strip-icons-bg span:nth-child(1)  { left:  4%; top: 10%; animation-delay: 0s;    font-size:2.8rem; }
.sf-strip-icons-bg span:nth-child(2)  { left: 12%; top: 60%; animation-delay: 1.5s;  font-size:2.2rem; }
.sf-strip-icons-bg span:nth-child(3)  { left: 22%; top: 25%; animation-delay: 3s;    font-size:3rem; }
.sf-strip-icons-bg span:nth-child(4)  { left: 35%; top: 70%; animation-delay: 0.8s;  font-size:2rem; }
.sf-strip-icons-bg span:nth-child(5)  { left: 50%; top: 15%; animation-delay: 2s;    font-size:3.2rem; }
.sf-strip-icons-bg span:nth-child(6)  { left: 62%; top: 60%; animation-delay: 4s;    font-size:2.5rem; }
.sf-strip-icons-bg span:nth-child(7)  { left: 74%; top: 30%; animation-delay: 1s;    font-size:2.8rem; }
.sf-strip-icons-bg span:nth-child(8)  { left: 85%; top: 65%; animation-delay: 3.5s;  font-size:2rem; }
.sf-strip-icons-bg span:nth-child(9)  { left: 93%; top: 20%; animation-delay: 2.5s;  font-size:2.6rem; }

@keyframes sfFloatBg {
    0%,100% { transform: translateY(0) rotate(0deg); opacity:.07; }
    50%      { transform: translateY(-14px) rotate(8deg); opacity:.13; }
}

.sf-hero-inner {
    position: relative;
    z-index: 1;
    padding: 18px 0;
}

.sf-brand-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.sf-brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.sf-brand-icon {
    width: 46px;
    height: 46px;
    background: rgba(255,255,255,.15);
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.4rem;
    backdrop-filter: blur(6px);
    animation: sfPulseIcon 3s ease-in-out infinite;
}
@keyframes sfPulseIcon {
    0%,100% { box-shadow: 0 0 0 0 rgba(34,197,94,0); }
    50%      { box-shadow: 0 0 0 8px rgba(34,197,94,.2); }
}

.sf-brand-text { color: #fff; }
.sf-brand-text .sf-brand-name {
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.4rem;
    line-height: 1;
    letter-spacing: -.5px;
}
.sf-brand-text .sf-brand-name span { color: #A7F3D0; }
.sf-brand-text .sf-brand-tagline {
    font-size: .72rem;
    color: rgba(255,255,255,.7);
    font-weight: 400;
    margin-top: 2px;
    letter-spacing: .3px;
}

.sf-strip-badges {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.sf-badge-pill {
    display: flex;
    align-items: center;
    gap: 5px;
    background: rgba(255,255,255,.12);
    border: 1px solid rgba(255,255,255,.2);
    color: #fff;
    font-size: .75rem;
    font-weight: 500;
    padding: 5px 11px;
    border-radius: 100px;
    backdrop-filter: blur(4px);
    transition: var(--sf-transition);
}
.sf-badge-pill:hover {
    background: rgba(255,255,255,.22);
    transform: translateY(-1px);
}
.sf-badge-pill i { color: #A7F3D0; font-size: .8rem; }

/* ============================================================
   BREADCRUMB BAR
   ============================================================ */
.sf-breadcrumb-bar {
    background: var(--sf-white);
    border-bottom: 1px solid var(--sf-border);
    padding: 10px 0;
}
.sf-breadcrumb {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: .8rem;
    color: var(--sf-text-muted);
    flex-wrap: wrap;
}
.sf-breadcrumb a {
    color: var(--sf-primary);
    text-decoration: none;
    font-weight: 500;
    transition: var(--sf-transition);
}
.sf-breadcrumb a:hover { color: var(--sf-primary-dark); }
.sf-breadcrumb .sep { color: var(--sf-text-light); font-size: .7rem; }
.sf-breadcrumb .current { color: var(--sf-text); font-weight: 600; }

/* ============================================================
   MAIN CONTENT AREA
   ============================================================ */
.sf-main-content {
    padding: 32px 0 48px;
}

/* ── Service Title Card ── */
.sf-title-card {
    background: var(--sf-white);
    border: 1px solid var(--sf-border);
    border-radius: var(--sf-radius-lg);
    padding: 28px 32px 24px;
    margin-bottom: 24px;
    position: relative;
    overflow: hidden;
    box-shadow: var(--sf-shadow-sm);
    animation: sfSlideDown .5s cubic-bezier(.4,0,.2,1) both;
}
@keyframes sfSlideDown {
    from { opacity:0; transform:translateY(-20px); }
    to   { opacity:1; transform:translateY(0); }
}

.sf-title-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 5px;
    background: linear-gradient(180deg, var(--sf-primary) 0%, var(--sf-accent) 100%);
    border-radius: 4px 0 0 4px;
}
.sf-title-card::after {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 120px; height: 120px;
    background: radial-gradient(circle, var(--sf-primary-xlight) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.sf-category-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: var(--sf-primary-light);
    color: var(--sf-primary);
    font-size: .72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 100px;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 10px;
}

.sf-post-title {
    font-family: 'Syne', sans-serif;
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--sf-text);
    line-height: 1.25;
    margin: 0 0 14px;
    letter-spacing: -.3px;
}

.sf-meta-row {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}
.sf-meta-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: var(--sf-bg);
    color: var(--sf-text-muted);
    font-size: .75rem;
    font-weight: 500;
    padding: 4px 10px;
    border-radius: 100px;
    border: 1px solid var(--sf-border);
}
.sf-meta-chip i { color: var(--sf-primary); font-size: .8rem; }

/* ── Grid Layout ── */
.sf-detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    align-items: start;
}

@media (max-width: 991px) {
    .sf-detail-grid { grid-template-columns: 1fr; }
}

/* ── Media Card ── */
.sf-media-card {
    background: var(--sf-white);
    border: 1px solid var(--sf-border);
    border-radius: var(--sf-radius-lg);
    overflow: hidden;
    box-shadow: var(--sf-shadow);
    animation: sfFadeUp .55s cubic-bezier(.4,0,.2,1) .1s both;
}
@keyframes sfFadeUp {
    from { opacity:0; transform:translateY(24px); }
    to   { opacity:1; transform:translateY(0); }
}

.sf-media-wrap {
    position: relative;
    background: var(--sf-primary-xlight);
    min-height: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.sf-media-wrap img,
.sf-media-wrap video {
    width: 100%;
    height: 320px;
    object-fit: cover;
    display: block;
    transition: transform .5s ease;
}
.sf-media-card:hover .sf-media-wrap img { transform: scale(1.03); }

.sf-media-badge {
    position: absolute;
    bottom: 12px;
    left: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: rgba(37,99,235,.92);
    color: #fff;
    font-size: .72rem;
    font-weight: 600;
    padding: 5px 11px;
    border-radius: 100px;
    backdrop-filter: blur(6px);
    letter-spacing: .3px;
}

.sf-no-media {
    min-height: 280px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: var(--sf-text-light);
    padding: 32px;
}
.sf-no-media i {
    font-size: 3rem;
    color: var(--sf-border-blue);
    animation: sfBobble 3s ease-in-out infinite;
}
@keyframes sfBobble {
    0%,100% { transform: translateY(0); }
    50%      { transform: translateY(-8px); }
}
.sf-no-media p { font-size: .85rem; font-weight: 500; margin: 0; }

/* Share strip */
.sf-share-strip {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 14px 18px;
    border-top: 1px solid var(--sf-border);
    background: var(--sf-bg);
    flex-wrap: wrap;
}
.sf-share-label {
    font-size: .75rem;
    font-weight: 700;
    color: var(--sf-text-muted);
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-right: 4px;
}
.sf-share-btn {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: 1.5px solid var(--sf-border);
    background: var(--sf-white);
    color: var(--sf-text-muted);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .95rem;
    cursor: pointer;
    transition: var(--sf-transition);
    text-decoration: none;
}
.sf-share-btn:hover {
    transform: translateY(-3px) scale(1.1);
    border-color: var(--sf-primary);
    color: var(--sf-primary);
    box-shadow: 0 4px 12px rgba(37,99,235,.2);
}

/* ── Info Card ── */
.sf-info-card {
    background: var(--sf-white);
    border: 1px solid var(--sf-border);
    border-radius: var(--sf-radius-lg);
    overflow: hidden;
    box-shadow: var(--sf-shadow);
    animation: sfFadeUp .55s cubic-bezier(.4,0,.2,1) .2s both;
}

.sf-info-header {
    background: linear-gradient(135deg, var(--sf-primary) 0%, var(--sf-primary-dark) 100%);
    padding: 18px 22px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
}
.sf-info-header::after {
    content: '';
    position: absolute;
    right: -20px; top: -20px;
    width: 80px; height: 80px;
    background: rgba(255,255,255,.06);
    border-radius: 50%;
}
.sf-info-header-icon {
    width: 40px; height: 40px;
    background: rgba(255,255,255,.15);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.sf-info-header-title {
    color: #fff;
    font-family: 'Syne', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    margin: 0;
}
.sf-info-header-sub {
    color: rgba(255,255,255,.7);
    font-size: .72rem;
    margin: 0;
}

.sf-info-body { padding: 6px 0; }

/* Info row items */
.sf-info-row {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 22px;
    border-bottom: 1px solid var(--sf-border);
    transition: var(--sf-transition);
    animation: sfSlideRight .4s cubic-bezier(.4,0,.2,1) both;
}
.sf-info-row:last-child { border-bottom: none; }
.sf-info-row:hover { background: var(--sf-primary-xlight); }

.sf-info-row:nth-child(1) { animation-delay: .15s; }
.sf-info-row:nth-child(2) { animation-delay: .22s; }
.sf-info-row:nth-child(3) { animation-delay: .29s; }
.sf-info-row:nth-child(4) { animation-delay: .36s; }

@keyframes sfSlideRight {
    from { opacity:0; transform:translateX(-16px); }
    to   { opacity:1; transform:translateX(0); }
}

.sf-info-icon-wrap {
    width: 38px; height: 38px;
    background: var(--sf-primary-light);
    border-radius: var(--sf-radius-sm);
    display: flex; align-items: center; justify-content: center;
    color: var(--sf-primary);
    font-size: 1rem;
    flex-shrink: 0;
    transition: var(--sf-transition);
}
.sf-info-row:hover .sf-info-icon-wrap {
    background: var(--sf-primary);
    color: #fff;
    transform: scale(1.08);
}

.sf-info-content { flex: 1; min-width: 0; }
.sf-info-label {
    font-size: .68rem;
    font-weight: 700;
    color: var(--sf-text-light);
    text-transform: uppercase;
    letter-spacing: .6px;
    margin-bottom: 2px;
}
.sf-info-value {
    font-size: .95rem;
    font-weight: 600;
    color: var(--sf-text);
    word-break: break-word;
}
.sf-info-value.sf-contact {
    color: var(--sf-accent-dark);
    font-family: 'Syne', sans-serif;
    font-size: 1.05rem;
}

/* CTA Button */
.sf-cta-wrap {
    padding: 18px 22px;
    background: var(--sf-accent-light);
    border-top: 1px solid var(--sf-border);
}
.sf-cta-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px;
    background: var(--sf-accent);
    color: #fff;
    font-weight: 700;
    font-size: .9rem;
    border: none;
    border-radius: var(--sf-radius-sm);
    text-decoration: none;
    cursor: pointer;
    transition: var(--sf-transition);
    letter-spacing: .3px;
    position: relative;
    overflow: hidden;
}
.sf-cta-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
    transform: translateX(-100%);
    transition: transform .6s ease;
}
.sf-cta-btn:hover::before { transform: translateX(100%); }
.sf-cta-btn:hover {
    background: var(--sf-accent-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(34,197,94,.35);
    color: #fff;
}

/* ============================================================
   RELATED LISTINGS SECTION
   ============================================================ */
.sf-related-section {
    padding: 0 0 48px;
}

.sf-section-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 22px;
}
.sf-section-head-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Syne', sans-serif;
    font-weight: 800;
    font-size: 1.15rem;
    color: var(--sf-text);
    white-space: nowrap;
}
.sf-section-head-label i { color: var(--sf-primary); font-size: 1.1rem; }
.sf-section-line {
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, var(--sf-primary-light) 0%, transparent 100%);
    border-radius: 2px;
}
.sf-section-badge {
    background: var(--sf-primary-light);
    color: var(--sf-primary);
    font-size: .72rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 100px;
    white-space: nowrap;
}

/* Related Cards */
.sf-related-card {
    background: var(--sf-white);
    border: 1px solid var(--sf-border);
    border-radius: var(--sf-radius);
    overflow: hidden;
    transition: var(--sf-transition);
    text-decoration: none;
    display: block;
    position: relative;
    animation: sfFadeUp .5s cubic-bezier(.4,0,.2,1) both;
    height: 100%;
}
.sf-related-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--sf-shadow-lg);
    border-color: var(--sf-border-blue);
    text-decoration: none;
}

.sf-related-card:nth-child(1) { animation-delay: .05s; }
.sf-related-card:nth-child(2) { animation-delay: .12s; }
.sf-related-card:nth-child(3) { animation-delay: .19s; }
.sf-related-card:nth-child(4) { animation-delay: .26s; }

.sf-related-img-wrap {
    position: relative;
    height: 170px;
    background: var(--sf-primary-xlight);
    overflow: hidden;
}
.sf-related-img-wrap img,
.sf-related-img-wrap video {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .5s ease;
}
.sf-related-card:hover .sf-related-img-wrap img { transform: scale(1.07); }

.sf-rel-no-img {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--sf-border-blue);
    font-size: 2.8rem;
}

.sf-rel-num {
    position: absolute;
    top: 10px; left: 10px;
    width: 28px; height: 28px;
    background: var(--sf-primary);
    color: #fff;
    border-radius: 50%;
    font-size: .72rem;
    font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Syne', sans-serif;
    box-shadow: 0 2px 8px rgba(37,99,235,.4);
}

.sf-related-body {
    padding: 14px 16px 16px;
}
.sf-related-title {
    font-size: .88rem;
    font-weight: 700;
    color: var(--sf-text);
    line-height: 1.4;
    margin: 0 0 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: var(--sf-transition);
}
.sf-related-card:hover .sf-related-title { color: var(--sf-primary); }

.sf-rel-meta {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.sf-rel-meta span {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: .7rem;
    color: var(--sf-text-light);
    font-weight: 500;
}
.sf-rel-meta i { color: var(--sf-primary); font-size: .72rem; }

/* Hover accent bar */
.sf-related-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--sf-primary), var(--sf-accent));
    transform: scaleX(0);
    transition: transform .3s ease;
    transform-origin: left;
}
.sf-related-card:hover::after { transform: scaleX(1); }

/* ============================================================
   DIVIDER
   ============================================================ */
.sf-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--sf-border), transparent);
    margin: 8px 0;
}

/* ============================================================
   BACK TO TOP BUTTON
   ============================================================ */
.sf-back-top {
    position: fixed;
    bottom: 28px; right: 24px;
    z-index: 999;
    width: 44px; height: 44px;
    border-radius: 50%;
    background: var(--sf-primary);
    color: #fff;
    border: none;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 4px 16px rgba(37,99,235,.35);
    transition: var(--sf-transition);
    animation: sfFadeIn .3s ease both;
}
.sf-back-top:hover {
    background: var(--sf-primary-dark);
    transform: translateY(-3px) scale(1.08);
    box-shadow: 0 8px 24px rgba(37,99,235,.45);
}

/* ── Pulse ring on back-to-top ── */
.sf-back-top::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid var(--sf-primary);
    animation: sfPulseRing 2.5s ease-out infinite;
    opacity: 0;
}
@keyframes sfPulseRing {
    0%   { transform: scale(1); opacity:.6; }
    100% { transform: scale(1.5); opacity:0; }
}

/* ============================================================
   LIVE INDICATOR (top decoration)
   ============================================================ */
.sf-live-dot {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: .7rem;
    font-weight: 700;
    color: var(--sf-accent);
    text-transform: uppercase;
    letter-spacing: .5px;
}
.sf-live-dot::before {
    content: '';
    width: 7px; height: 7px;
    background: var(--sf-accent);
    border-radius: 50%;
    animation: sfLivePulse 1.4s ease-in-out infinite;
    flex-shrink: 0;
}
@keyframes sfLivePulse {
    0%,100% { opacity:1; transform:scale(1); }
    50%      { opacity:.5; transform:scale(.6); }
}

/* ── Responsive ── */
@media (max-width: 576px) {
    .sf-post-title    { font-size: 1.3rem; }
    .sf-title-card    { padding: 20px 18px 18px; }
    .sf-info-header   { padding: 14px 16px; }
    .sf-info-row      { padding: 13px 16px; }
    .sf-cta-wrap      { padding: 14px 16px; }
}
</style>

<div class="sf-post-page">

    <!-- ============ HERO STRIP ============ -->
    <div class="sf-hero-strip">
        <div class="sf-strip-icons-bg">
            <span><i class="bi bi-tools"></i></span>
            <span><i class="bi bi-house-fill"></i></span>
            <span><i class="bi bi-lightning-charge-fill"></i></span>
            <span><i class="bi bi-wrench-adjustable"></i></span>
            <span><i class="bi bi-droplet-fill"></i></span>
            <span><i class="bi bi-truck"></i></span>
            <span><i class="bi bi-scissors"></i></span>
            <span><i class="bi bi-brush-fill"></i></span>
            <span><i class="bi bi-shield-fill-check"></i></span>
        </div>
        <div class="container sf-hero-inner">
            <div class="sf-brand-row">
                <div class="sf-brand">
                    <div class="sf-brand-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="sf-brand-text">
                        <div class="sf-brand-name">Sheba<span>Finder</span></div>
                        <div class="sf-brand-tagline">Bangladesh's Local Service Discovery Platform</div>
                    </div>
                </div>
                <div class="sf-strip-badges">
                    <span class="sf-live-dot">লাইভ</span>
                    <span class="sf-badge-pill"><i class="bi bi-geo-alt-fill"></i> সারা বাংলাদেশ</span>
                    <span class="sf-badge-pill"><i class="bi bi-patch-check-fill"></i> যাচাইকৃত সেবা</span>
                    <span class="sf-badge-pill"><i class="bi bi-telephone-fill"></i> সরাসরি যোগাযোগ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ BREADCRUMB ============ -->
    <div class="sf-breadcrumb-bar">
        <div class="container">
            <div class="sf-breadcrumb">
                <a href="/"><i class="bi bi-house-fill me-1"></i>হোম</a>
                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                <a href="/services">সকল সেবা</a>
                <span class="sep"><i class="bi bi-chevron-right"></i></span>
                <span class="current">{{ $post->PostCategory->name ?? 'সেবা বিস্তারিত' }}</span>
            </div>
        </div>
    </div>

    <!-- ============ MAIN CONTENT ============ -->
    <div class="sf-main-content">
        <div class="container">

            <!-- Title Card -->
            <div class="sf-title-card">
                <div class="sf-category-tag">
                    <i class="bi bi-tag-fill"></i>
                    {{ $post->PostCategory->name ?? 'সেবা' }}
                </div>
                <h1 class="sf-post-title">{{ $post->title }}</h1>
                <div class="sf-meta-row">
                    <span class="sf-meta-chip">
                        <i class="bi bi-calendar3"></i>
                        {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('d M Y') }}
                    </span>
                    <span class="sf-meta-chip">
                        <i class="bi bi-clock-fill"></i>
                        {{ \Carbon\Carbon::parse($post->created_at)->timezone('Asia/Dhaka')->format('h:i A') }}
                    </span>
                    <span class="sf-meta-chip">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ $post->division ?? 'বাংলাদেশ' }}
                    </span>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="sf-detail-grid">

                <!-- LEFT: Media -->
                <div class="sf-media-card">
                    <div class="sf-media-wrap">
                        @if($post->file)
                            @php
                                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                $videoExtensions = ['mp4','webm','ogg','avi','mkv'];
                                $imageExtensions = ['jpg','jpeg','png','gif','webp'];
                                $isImage = in_array($ext,$imageExtensions);
                                $isVideo = in_array($ext,$videoExtensions);
                            @endphp
                            @if($isImage)
                                <img src="{{ config('app.storage_url') }}{{ $post->file }}" alt="{{ $post->title }}">
                                <span class="sf-media-badge"><i class="bi bi-camera-fill"></i> ছবি</span>
                            @elseif($isVideo)
                                <video controls class="w-100" style="max-height:320px;object-fit:cover;">
                                    <source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
                                </video>
                                <span class="sf-media-badge"><i class="bi bi-play-circle-fill"></i> ভিডিও</span>
                            @else
                                <div class="sf-no-media">
                                    <i class="bi bi-file-earmark-x"></i>
                                    <p>অসমর্থিত ফাইল ফরম্যাট</p>
                                </div>
                            @endif
                        @else
                            <div class="sf-no-media">
                                <i class="bi bi-image"></i>
                                <p>কোনো মিডিয়া নেই</p>
                            </div>
                        @endif
                    </div>

                    <!-- Share Strip -->
                    <div class="sf-share-strip">
                        <span class="sf-share-label"><i class="bi bi-share-fill me-1"></i> শেয়ার</span>
                        <a href="#" class="sf-share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="sf-share-btn" title="Twitter / X"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="sf-share-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="sf-share-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <button class="sf-share-btn" title="লিঙ্ক কপি" onclick="navigator.clipboard.writeText(window.location.href)"><i class="bi bi-link-45deg"></i></button>
                    </div>
                </div>

                <!-- RIGHT: Info Card -->
                <div class="sf-info-card">
                    <div class="sf-info-header">
                        <div class="sf-info-header-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div>
                            <p class="sf-info-header-title">সেবা বিস্তারিত তথ্য</p>
                            <p class="sf-info-header-sub">Service Details & Contact Info</p>
                        </div>
                    </div>

                    <div class="sf-info-body">

                        <!-- Name -->
                        <div class="sf-info-row">
                            <div class="sf-info-icon-wrap">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="sf-info-content">
                                <div class="sf-info-label">নাম / Name</div>
                                <div class="sf-info-value">{{ $post->title ?? 'তথ্য নেই' }}</div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="sf-info-row">
                            <div class="sf-info-icon-wrap">
                                <i class="bi bi-grid-fill"></i>
                            </div>
                            <div class="sf-info-content">
                                <div class="sf-info-label">বিভাগ / Category</div>
                                <div class="sf-info-value">{{ $post->PostCategory->name ?? 'ক্যাটাগরি নেই' }}</div>
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="sf-info-row">
                            <div class="sf-info-icon-wrap">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="sf-info-content">
                                <div class="sf-info-label">বিভাগ / Division</div>
                                <div class="sf-info-value">{{ $post->division ?? 'তথ্য নেই' }}</div>
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="sf-info-row">
                            <div class="sf-info-icon-wrap">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="sf-info-content">
                                <div class="sf-info-label">যোগাযোগ / Contact</div>
                                <div class="sf-info-value sf-contact">{{ $post->contact_number ?? 'নম্বর নেই' }}</div>
                            </div>
                        </div>

                    </div>

                    <!-- CTA -->
                    <div class="sf-cta-wrap">
                        <a href="tel:{{ $post->contact_number }}" class="sf-cta-btn">
                            <i class="bi bi-telephone-fill"></i>
                            এখনই যোগাযোগ করুন
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- ============ RELATED LISTINGS ============ -->
    @if($otherPosts->count() > 0)
    <div class="sf-related-section">
        <div class="container">

            <div class="sf-divider"></div>

            <div class="sf-section-head mt-4">
                <div class="sf-section-head-label">
                    <i class="bi bi-grid-3x2-gap-fill"></i>
                    সম্পর্কিত সেবাসমূহ
                </div>
                <div class="sf-section-line"></div>
                <span class="sf-section-badge">Related Services</span>
            </div>

            <div class="row g-3 g-lg-4">
                @foreach($otherPosts->take(4) as $index => $otherpost)
                <div class="col-lg-3 col-md-6 col-12">
                    <a href="{{ url('/post/'.$otherpost->id) }}" class="sf-related-card">

                        <div class="sf-related-img-wrap">
                            @if($otherpost->file)
                                @php
                                    $ext2 = strtolower(pathinfo($otherpost->file, PATHINFO_EXTENSION));
                                    $isImg2 = in_array($ext2,['jpg','jpeg','png','gif','webp']);
                                    $isVid2 = in_array($ext2,['mp4','webm','ogg','avi','mkv']);
                                @endphp
                                @if($isImg2)
                                    <img src="{{ config('app.storage_url') }}{{ $otherpost->file }}" alt="{{ $otherpost->title }}">
                                @elseif($isVid2)
                                    <video class="w-100" muted style="height:100%;object-fit:cover;">
                                        <source src="{{ config('app.storage_url') }}{{ $otherpost->file }}">
                                    </video>
                                @else
                                    <div class="sf-rel-no-img"><i class="bi bi-image"></i></div>
                                @endif
                            @else
                                <div class="sf-rel-no-img"><i class="bi bi-image"></i></div>
                            @endif
                            <span class="sf-rel-num">{{ $index + 1 }}</span>
                        </div>

                        <div class="sf-related-body">
                            <h6 class="sf-related-title">{{ $otherpost->title }}</h6>
                            <div class="sf-rel-meta">
                                <span>
                                    <i class="bi bi-tag"></i>
                                    {{ $otherpost->PostCategory->name ?? 'ক্যাটাগরি নেই' }}
                                </span>
                            </div>
                        </div>

                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    @endif

    <!-- Final divider -->
    <div class="container">
        <div class="sf-divider mb-4"></div>
    </div>

</div>

<!-- Back to Top -->
<button class="sf-back-top" id="sfBackTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" title="উপরে যান">
    <i class="bi bi-chevron-up"></i>
</button>

<script>
(function(){
    const btn = document.getElementById('sfBackTop');
    if(!btn) return;
    btn.style.display = 'none';
    window.addEventListener('scroll', function(){
        btn.style.display = window.scrollY > 300 ? 'flex' : 'none';
    });
})();
</script>

@endsection