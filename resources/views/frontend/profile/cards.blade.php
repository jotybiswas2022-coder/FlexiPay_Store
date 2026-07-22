@extends('frontend.app')
@section('title', 'My Cards — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-credit-card-fill"></i> Payment Cards</div>
            <h2>Saved Cards</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse($cards ?? [] as $card)
            <div class="col-lg-4 col-md-6">
                <div class="fp-card-item">
                    <div class="fp-card-type">
                        <i class="bi bi-credit-card-2-front-fill"></i>
                    </div>
                    <div class="fp-card-details">
                        <strong>•••• {{ $card->last_four }}</strong>
                        <span>Expires {{ $card->expiry_month }}/{{ $card->expiry_year }}</span>
                    </div>
                    <a href="{{ route('profile.cards.delete', $card) }}" class="fp-card-delete" onclick="return confirm('Remove this card?')">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-credit-card" style="font-size:48px;color:var(--text-dim);display:block;margin-bottom:12px;"></i>
                <p style="color:var(--text-muted);">No saved cards. Cards are saved after your first payment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#4ade80;padding:12px 16px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-card-item { background: linear-gradient(135deg,#1a1a2e,#16213e); border: 1px solid var(--card-border); border-radius: var(--radius); padding: 24px; display: flex; align-items: center; gap: 14px; transition: all 0.3s; }
.fp-card-item:hover { border-color: rgba(234,179,8,0.2); transform: translateY(-2px); }
.fp-card-type { width: 48px; height: 48px; border-radius: 10px; background: rgba(234,179,8,0.1); display: flex; align-items: center; justify-content: center; color: var(--gold-500); font-size: 22px; flex-shrink: 0; }
.fp-card-details { flex: 1; }
.fp-card-details strong { display: block; color: var(--text-primary); font-size: 15px; }
.fp-card-details span { color: var(--text-dim); font-size: 12px; }
.fp-card-delete { color: var(--text-dim); font-size: 16px; padding: 4px; transition: color 0.2s; }
.fp-card-delete:hover { color: #ef4444; }
</style>
@endsection