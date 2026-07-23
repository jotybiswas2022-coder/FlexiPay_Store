@extends('frontend.app')
@section('title', 'My Cards — FlexiPay Store')

@push('styles')
<style>
.fp-cr-hero {
    position: relative; padding: 30px 0 20px; overflow: hidden;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-cr-orb {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.04) 0%, transparent 60%);
    top: -150px; right: -80px; pointer-events: none;
    animation: crPulse 4s ease-in-out infinite;
}
@keyframes crPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-cr-section { padding-bottom: 80px; min-height: 60vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);color:#4ade80;padding:14px 18px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-card-item { background: linear-gradient(135deg,#1a1a2e,#16213e); border:1px solid var(--card-border); border-radius:var(--radius); padding:24px; display:flex; align-items:center; gap:14px; transition:all 0.3s; }
.fp-card-item:hover { border-color:rgba(234,179,8,0.2); transform:translateY(-3px); box-shadow:var(--shadow-card-hover); }
.fp-card-type { width:48px;height:48px;border-radius:10px;background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-500);font-size:22px;flex-shrink:0; }
.fp-card-details { flex:1; }
.fp-card-details strong { display:block;color:var(--text-primary);font-size:15px; }
.fp-card-details span { color:var(--text-dim);font-size:12px; }
.fp-card-delete { color:var(--text-dim);font-size:16px;padding:4px;transition:color 0.2s; }
.fp-card-delete:hover { color:#ef4444; }
</style>
@endpush

@section('content')
<section class="fp-cr-hero">
    <div class="fp-cr-orb"></div>
    <div class="container">
        <div class="section-head reveal-up">
            <div class="section-badge"><i class="bi bi-credit-card-fill"></i> Payment Cards</div>
            <h2>Saved Cards</h2>
            <p>Cards saved from your previous payments</p>
        </div>
    </div>
</section>

<section class="fp-cr-section">
    <div class="container">
        @if(session('success'))
        <div class="fp-alert reveal-up"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @forelse($cards ?? [] as $card)
            <div class="col-lg-4 col-md-6">
                <div class="fp-card-item reveal-up">
                    <div class="fp-card-type"><i class="bi bi-credit-card-2-front-fill"></i></div>
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
            <div class="col-12">
                <div class="text-center py-5 reveal-up">
                    <i class="bi bi-credit-card" style="font-size:48px;color:var(--text-dim);display:block;margin-bottom:12px;"></i>
                    <p style="color:var(--text-muted);">No saved cards yet. Cards are saved automatically after your first payment.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@include('frontend.partials.footer')
@stop
@endsection
