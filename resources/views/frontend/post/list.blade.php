@extends('frontend.app')

@section('content')

{{-- ========== SHEBAFINDER CUSTOM STYLES ========== --}}
<style>
  @import url('https://fonts.googleapis.com/css2?family=Tiro+Bangla&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

  :root {
    --sf-primary:    #2563EB;
    --sf-primary-dk: #1d4ed8;
    --sf-primary-lt: #dbeafe;
    --sf-accent:     #22C55E;
    --sf-accent-dk:  #16a34a;
    --sf-accent-lt:  #dcfce7;
    --sf-white:      #ffffff;
    --sf-gray-50:    #f8fafc;
    --sf-gray-100:   #f1f5f9;
    --sf-gray-200:   #e2e8f0;
    --sf-gray-400:   #94a3b8;
    --sf-gray-600:   #475569;
    --sf-gray-800:   #1e293b;
    --sf-shadow-sm:  0 1px 3px rgba(37,99,235,.08), 0 1px 2px rgba(37,99,235,.06);
    --sf-shadow-md:  0 4px 20px rgba(37,99,235,.12), 0 2px 8px rgba(37,99,235,.08);
    --sf-shadow-lg:  0 10px 40px rgba(37,99,235,.16), 0 4px 16px rgba(37,99,235,.10);
    --sf-radius:     16px;
    --sf-radius-sm:  10px;
    --sf-radius-pill:50px;
  }

  /* ── Base ── */
  body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--sf-gray-50); }

  /* ── Alert ── */
  .sf-alert {
    display: flex; align-items: center; gap: .6rem;
    margin: 1rem 1.5rem; padding: .85rem 1.2rem;
    border-radius: var(--sf-radius-sm); font-size: .9rem;
    font-weight: 500; animation: sfSlideDown .35s ease both;
  }
  .sf-alert-success { background: var(--sf-accent-lt); color: var(--sf-accent-dk); border-left: 4px solid var(--sf-accent); }
  .sf-alert-danger  { background: #fee2e2; color: #b91c1c; border-left: 4px solid #ef4444; }
  .sf-alert .btn-close { margin-left: auto; filter: none; opacity: .6; }
  @keyframes sfSlideDown { from { opacity: 0; transform: translateY(-12px); } to { opacity: 1; transform: none; } }

  /* ── Breaking bar ── */
  .sf-breaking-bar {
    display: flex; align-items: center;
    background: linear-gradient(90deg, var(--sf-primary) 0%, var(--sf-primary-dk) 100%);
    color: var(--sf-white); overflow: hidden; min-height: 42px;
  }
  .sf-breaking-label {
    flex-shrink: 0; display: flex; align-items: center; gap: .45rem;
    padding: 0 1.1rem; background: var(--sf-accent); font-weight: 700;
    font-size: .8rem; letter-spacing: .06em; text-transform: uppercase;
    height: 42px; clip-path: polygon(0 0,calc(100% - 10px) 0,100% 50%,calc(100% - 10px) 100%,0 100%);
    padding-right: 1.5rem;
  }
  .sf-ticker-wrap { flex: 1; overflow: hidden; padding: 0 1rem; }
  .sf-ticker-content {
    display: inline-flex; gap: 3rem; white-space: nowrap;
    animation: sfTicker 28s linear infinite; font-size: .82rem; font-weight: 500; opacity: .92;
  }
  .sf-ticker-content span::before { content: '●'; margin-right: .8rem; color: var(--sf-accent); font-size: .5rem; vertical-align: middle; }
  @keyframes sfTicker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

  /* ── Search / Filter ── */
  .sf-search-wrap {
    background: var(--sf-white);
    border-bottom: 1px solid var(--sf-gray-200);
    padding: 1.1rem 0;
  }
  .sf-search-inner { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }
  .sf-search-inner .form-control,
  .sf-search-inner .form-select {
    border: 1.5px solid var(--sf-gray-200); border-radius: var(--sf-radius-sm);
    padding: .65rem 1rem; font-size: .88rem; font-family: inherit;
    transition: border-color .2s, box-shadow .2s; background: var(--sf-gray-50);
  }
  .sf-search-inner .form-control:focus,
  .sf-search-inner .form-select:focus {
    border-color: var(--sf-primary); box-shadow: 0 0 0 3px rgba(37,99,235,.12); background: var(--sf-white);
  }
  .sf-search-inner .btn-primary {
    background: var(--sf-primary); border-color: var(--sf-primary);
    border-radius: var(--sf-radius-sm); font-weight: 600; padding: .65rem 1.2rem;
    transition: background .2s, transform .15s, box-shadow .2s;
  }
  .sf-search-inner .btn-primary:hover {
    background: var(--sf-primary-dk); transform: translateY(-1px); box-shadow: var(--sf-shadow-md);
  }

  /* ── Section wrapper ── */
  .sf-main-section { padding: 2.5rem 0 4rem; }
  .sf-container { max-width: 1100px; margin: 0 auto; padding: 0 1.5rem; }

  /* ── Section header ── */
  .sf-section-header { text-align: center; margin-bottom: 2.5rem; }
  .sf-badge-label {
    display: inline-flex; align-items: center; gap: .45rem;
    background: var(--sf-primary-lt); color: var(--sf-primary);
    border-radius: var(--sf-radius-pill); padding: .35rem 1rem;
    font-size: .78rem; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
    margin-bottom: .9rem;
  }
  .sf-section-title {
    font-size: clamp(1.6rem, 4vw, 2.2rem); font-weight: 800; color: var(--sf-gray-800);
    margin-bottom: .5rem; line-height: 1.2;
  }
  .sf-section-title span { color: var(--sf-primary); }
  .sf-section-sub { color: var(--sf-gray-600); font-size: .95rem; margin-bottom: 1.4rem; }
  .sf-divider { display: flex; align-items: center; justify-content: center; gap: .5rem; }
  .sf-divider-line { height: 2px; width: 40px; background: var(--sf-gray-200); border-radius: 2px; }
  .sf-divider-line.thick { width: 18px; background: var(--sf-primary); }
  .sf-divider-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--sf-accent); }

  /* ── Service Cards Grid ── */
  .sf-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(310px, 1fr));
    gap: 1.5rem;
  }

  /* ── Single Card ── */
  .sf-card {
    background: var(--sf-white); border-radius: var(--sf-radius);
    box-shadow: var(--sf-shadow-sm); border: 1.5px solid var(--sf-gray-200);
    overflow: hidden; position: relative;
    transition: transform .3s cubic-bezier(.34,1.56,.64,1), box-shadow .3s;
    opacity: 0; transform: translateY(28px);
  }
  .sf-card.sf-visible { opacity: 1; transform: translateY(0); }
  .sf-card:hover {
    transform: translateY(-6px) scale(1.015);
    box-shadow: var(--sf-shadow-lg); border-color: var(--sf-primary-lt);
  }

  /* Accent bar */
  .sf-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
    background: linear-gradient(90deg, var(--sf-primary), var(--sf-accent));
  }

  /* ── Card Media ── */
  .sf-card-media { position: relative; aspect-ratio: 16/9; overflow: hidden; background: var(--sf-gray-100); }
  .sf-card-media img,
  .sf-card-media video { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .4s ease; }
  .sf-card:hover .sf-card-media img,
  .sf-card:hover .sf-card-media video { transform: scale(1.05); }

  /* category badge */
  .sf-cat-badge {
    position: absolute; top: .75rem; left: .75rem;
    background: var(--sf-primary); color: var(--sf-white);
    border-radius: var(--sf-radius-pill); padding: .28rem .8rem;
    font-size: .72rem; font-weight: 700; letter-spacing: .04em;
    display: flex; align-items: center; gap: .35rem;
    backdrop-filter: blur(4px); box-shadow: 0 2px 8px rgba(37,99,235,.3);
  }

  /* hover overlay */
  .sf-card-overlay {
    position: absolute; inset: 0; background: linear-gradient(to top, rgba(37,99,235,.88) 0%, transparent 55%);
    display: flex; align-items: flex-end; justify-content: center; padding-bottom: 1rem;
    opacity: 0; transition: opacity .3s;
  }
  .sf-card:hover .sf-card-overlay { opacity: 1; }
  .sf-read-btn {
    display: inline-flex; align-items: center; gap: .5rem;
    background: var(--sf-white); color: var(--sf-primary);
    border-radius: var(--sf-radius-pill); padding: .5rem 1.2rem;
    font-size: .82rem; font-weight: 700; text-decoration: none;
    transform: translateY(8px); transition: transform .25s, background .2s;
  }
  .sf-card:hover .sf-read-btn { transform: translateY(0); }
  .sf-read-btn:hover { background: var(--sf-accent); color: var(--sf-white); }

  /* placeholder */
  .sf-media-placeholder {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    height: 100%; color: var(--sf-gray-400); gap: .5rem;
  }
  .sf-media-placeholder .bi { font-size: 2rem; }
  .sf-media-placeholder p { font-size: .78rem; margin: 0; }

  /* ── Card Body ── */
  .sf-card-body { padding: 1.1rem 1.25rem 1.3rem; }
  .sf-card-title { font-size: 1rem; font-weight: 700; color: var(--sf-gray-800); margin-bottom: .75rem; }

  .sf-meta-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: .5rem; }
  .sf-meta-item {
    display: flex; align-items: center; gap: .55rem;
    font-size: .83rem; color: var(--sf-gray-600); line-height: 1.35;
  }
  .sf-meta-icon {
    flex-shrink: 0; width: 28px; height: 28px; border-radius: 8px;
    background: var(--sf-primary-lt); color: var(--sf-primary);
    display: flex; align-items: center; justify-content: center; font-size: .82rem;
  }
  .sf-meta-icon.green { background: var(--sf-accent-lt); color: var(--sf-accent-dk); }
  .sf-meta-label { font-weight: 500; }

  /* ── Pulse dot animation (availability) ── */
  .sf-avail-dot {
    display: inline-block; width: 8px; height: 8px; border-radius: 50%;
    background: var(--sf-accent); margin-right: .35rem;
    animation: sfPulse 1.8s ease-in-out infinite;
  }
  @keyframes sfPulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,.5); }
    50%       { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
  }

  /* ── Empty state ── */
  .sf-empty {
    grid-column: 1 / -1; text-align: center; padding: 4rem 2rem;
    background: var(--sf-white); border-radius: var(--sf-radius);
    border: 1.5px dashed var(--sf-gray-200);
    animation: sfSlideDown .5s ease both;
  }
  .sf-empty-icon {
    width: 80px; height: 80px; border-radius: 50%;
    background: var(--sf-primary-lt); color: var(--sf-primary);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; margin: 0 auto 1rem;
    animation: sfBounce 2.5s ease-in-out infinite;
  }
  @keyframes sfBounce { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-8px);} }
  .sf-empty h5 { font-weight: 700; color: var(--sf-gray-800); margin-bottom: .4rem; }
  .sf-empty p  { color: var(--sf-gray-400); font-size: .88rem; margin: 0; }

  /* ── Service type icon mapping ── */
  .sf-service-icon { font-size: 1.1rem; }

  /* ── Floating particles background ── */
  .sf-particles { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
  .sf-particle {
    position: absolute; border-radius: 50%;
    background: var(--sf-primary); opacity: .04;
    animation: sfFloat linear infinite;
  }
  @keyframes sfFloat {
    0%   { transform: translateY(100vh) scale(0); opacity: 0; }
    10%  { opacity: .05; }
    90%  { opacity: .05; }
    100% { transform: translateY(-120px) scale(1); opacity: 0; }
  }

  /* stagger delays for cards */
  .sf-card:nth-child(1){transition-delay:.05s}
  .sf-card:nth-child(2){transition-delay:.1s}
  .sf-card:nth-child(3){transition-delay:.15s}
  .sf-card:nth-child(4){transition-delay:.2s}
  .sf-card:nth-child(5){transition-delay:.25s}
  .sf-card:nth-child(6){transition-delay:.3s}
  .sf-card:nth-child(7){transition-delay:.35s}
  .sf-card:nth-child(8){transition-delay:.4s}
  .sf-card:nth-child(9){transition-delay:.45s}

  @media (max-width: 576px) {
    .sf-grid { grid-template-columns: 1fr; }
    .sf-breaking-label { font-size: .7rem; padding: 0 .8rem .0 1rem; }
  }
</style>

{{-- ── Floating BG particles ── --}}
<div class="sf-particles" id="sfParticles"></div>

{{-- ========== ALERTS ========== --}}
@if (session('success'))
  <div class="alert alert-dismissible fade show sf-alert sf-alert-success">
    <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif
@if (session('error'))
  <div class="alert alert-dismissible fade show sf-alert sf-alert-danger">
    <i class="bi bi-exclamation-triangle-fill"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- ========== BREAKING / UPDATE BAR ========== --}}
<div class="sf-breaking-bar">
  <div class="sf-breaking-label">
    <i class="bi bi-lightning-charge-fill"></i> লাইভ আপডেট
  </div>
  <div class="sf-ticker-wrap">
    <div class="sf-ticker-content">
      <span>ShebaFinder-এ আপনার পছন্দের সেবা এখন আরও সহজে খুঁজুন</span>
      <span>বিশ্বস্ত প্লাম্বার, ইলেকট্রিশিয়ান, ক্লিনার সব এক জায়গায়</span>
      <span>আজই রেজিস্ট্রেশন করুন এবং আপনার সেবা তালিকাভুক্ত করুন</span>
      <span>বাংলাদেশের সেরা লোকাল সার্ভিস ফাইন্ডার প্ল্যাটফর্ম</span>
      <span>ShebaFinder-এ আপনার পছন্দের সেবা এখন আরও সহজে খুঁজুন</span>
      <span>বিশ্বস্ত প্লাম্বার, ইলেকট্রিশিয়ান, ক্লিনার সব এক জায়গায়</span>
      <span>আজই রেজিস্ট্রেশন করুন এবং আপনার সেবা তালিকাভুক্ত করুন</span>
      <span>বাংলাদেশের সেরা লোকাল সার্ভিস ফাইন্ডার প্ল্যাটফর্ম</span>
    </div>
  </div>
</div>

{{-- ========== SEARCH / FILTER BAR ========== --}}
<div class="sf-search-wrap">
  <div class="sf-search-inner">
    <form method="GET" action="">
      <div class="row g-2 align-items-center">

        {{-- Name --}}
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border:1.5px solid #e2e8f0; border-right:0; border-radius:10px 0 0 10px;">
              <i class="bi bi-search text-primary"></i>
            </span>
            <input type="text" name="name" class="form-control border-start-0"
                   placeholder="সার্ভিস বা নাম খুঁজুন..."
                   value="{{ request('name') }}"
                   style="border-radius:0 10px 10px 0; border-left:0;">
          </div>
        </div>

        {{-- Category --}}
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border:1.5px solid #e2e8f0; border-right:0; border-radius:10px 0 0 10px;">
              <i class="bi bi-grid-3x3-gap text-primary"></i>
            </span>
            <select name="category_id" class="form-select border-start-0" style="border-radius:0 10px 10px 0; border-left:0;">
              <option value="">সব ক্যাটাগরি</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Division --}}
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0" style="border:1.5px solid #e2e8f0; border-right:0; border-radius:10px 0 0 10px;">
              <i class="bi bi-geo-alt text-primary"></i>
            </span>
            <select name="division" class="form-select border-start-0" style="border-radius:0 10px 10px 0; border-left:0;">
              <option value="">সব বিভাগ</option>
              @foreach (['Khulna','Dhaka','Chittagong','Rajshahi','Sylhet','Barishal','Rangpur','Mymensingh'] as $div)
                <option value="{{ $div }}" {{ request('division') == $div ? 'selected' : '' }}>{{ $div }}</option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Search Button --}}
        <div class="col-md-2 d-grid">
          <button class="btn btn-primary d-flex align-items-center justify-content-center gap-2" type="submit">
            <i class="bi bi-search"></i>
            <span class="d-none d-sm-inline">খুঁজুন</span>
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

{{-- ========== MAIN LISTING SECTION ========== --}}
<main>
  <section class="sf-main-section">
    <div class="sf-container">

      {{-- Section Header --}}
      <div class="sf-section-header">
        <div class="sf-badge-label">
          <i class="bi bi-geo-alt-fill"></i>
          বাংলাদেশের লোকাল সার্ভিস ডিরেক্টরি
        </div>
        <h2 class="sf-section-title">
          আপনার কাছের <span>বিশ্বস্ত সেবা</span> খুঁজুন
        </h2>
        <p class="sf-section-sub">
          দক্ষ ও যাচাইকৃত সার্ভিস প্রভাইডারদের সাথে সরাসরি যোগাযোগ করুন
        </p>
        <div class="sf-divider">
          <span class="sf-divider-line"></span>
          <span class="sf-divider-line thick"></span>
          <span class="sf-divider-dot"></span>
          <span class="sf-divider-line thick"></span>
          <span class="sf-divider-line"></span>
        </div>
      </div>

      {{-- Cards Grid --}}
      <div class="sf-grid">

        @forelse(($posts ?? collect())->sortByDesc('created_at') as $post)
          <div class="sf-card">

            {{-- Media --}}
            <div class="sf-card-media">

              @php
                $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                $isVideo = in_array($ext, ['mp4','webm','ogg','avi','mkv']);
              @endphp

              @if($post->file)
                @if($isImage)
                  <img src="{{ config('app.storage_url') }}{{ $post->file }}"
                       alt="{{ $post->title }}" loading="lazy">
                @elseif($isVideo)
                  <video controls>
                    <source src="{{ config('app.storage_url') }}{{ $post->file }}" type="video/mp4">
                  </video>
                @else
                  <div class="sf-media-placeholder">
                    <i class="bi bi-file-earmark-x"></i>
                    <p>Unsupported Media</p>
                  </div>
                @endif
              @else
                <div class="sf-media-placeholder">
                  <i class="bi bi-person-workspace"></i>
                  <p>No Photo</p>
                </div>
              @endif

              {{-- Category badge --}}
              <span class="sf-cat-badge">
                <i class="bi bi-tools sf-service-icon"></i>
                {{ $post->PostCategory->name ?? 'সার্ভিস' }}
              </span>

              {{-- Hover overlay --}}
              <div class="sf-card-overlay">
                <a href="{{ url('/post/'.$post->id) }}" class="sf-read-btn">
                  <i class="bi bi-eye-fill"></i> বিস্তারিত দেখুন
                </a>
              </div>

            </div>

            {{-- Card Body --}}
            <div class="sf-card-body">
              <h3 class="sf-card-title">
                <i class="bi bi-person-badge-fill text-primary me-1"></i>
                {{ $post->title }}
              </h3>

              <ul class="sf-meta-list">
                <li class="sf-meta-item">
                  <span class="sf-meta-icon">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                  </span>
                  <span>
                    <span class="sf-meta-label">ক্যাটাগরি:</span>
                    {{ $post->PostCategory->name ?? 'অনির্ধারিত' }}
                  </span>
                </li>
                <li class="sf-meta-item">
                  <span class="sf-meta-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                  </span>
                  <span>
                    <span class="sf-meta-label">বিভাগ:</span>
                    {{ $post->division ?? 'অনির্ধারিত' }}
                  </span>
                </li>
                <li class="sf-meta-item">
                  <span class="sf-meta-icon green">
                    <i class="bi bi-telephone-fill"></i>
                  </span>
                  <span>
                    <span class="sf-avail-dot"></span>
                    <span class="sf-meta-label">যোগাযোগ:</span>
                    {{ $post->contact_number ?? 'পাওয়া যায়নি' }}
                  </span>
                </li>
              </ul>
            </div>

          </div>
        @empty
          <div class="sf-empty">
            <div class="sf-empty-icon">
              <i class="bi bi-search-heart"></i>
            </div>
            <h5>কোনো সার্ভিস পাওয়া যায়নি</h5>
            <p>অনুসন্ধানের মানদণ্ড পরিবর্তন করুন অথবা পরে আবার চেষ্টা করুন।</p>
          </div>
        @endforelse

      </div>
    </div>
  </section>
</main>

{{-- ========== SCRIPTS ========== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

  /* ── Scroll-reveal for cards ── */
  const cards = document.querySelectorAll('.sf-card');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) {
          e.target.classList.add('sf-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });
    cards.forEach(function (c) { io.observe(c); });
  } else {
    cards.forEach(function (c) { c.classList.add('sf-visible'); });
  }

  /* ── Auto-dismiss alerts ── */
  document.querySelectorAll('.sf-alert').forEach(function (a) {
    setTimeout(function () {
      var inst = bootstrap.Alert.getOrCreateInstance(a);
      if (inst) inst.close();
    }, 5000);
  });

  /* ── Floating particles ── */
  var container = document.getElementById('sfParticles');
  if (container) {
    var colors = ['#2563EB','#22C55E','#1d4ed8'];
    for (var i = 0; i < 18; i++) {
      (function(){
        var p = document.createElement('div');
        p.className = 'sf-particle';
        var size = Math.random() * 40 + 12;
        p.style.cssText = [
          'width:'  + size + 'px',
          'height:' + size + 'px',
          'left:'   + Math.random() * 100 + '%',
          'background:' + colors[Math.floor(Math.random() * colors.length)],
          'animation-duration:' + (Math.random() * 18 + 14) + 's',
          'animation-delay:' + (Math.random() * 12) + 's',
        ].join(';');
        container.appendChild(p);
      })();
    }
  }

});
</script>

@endsection