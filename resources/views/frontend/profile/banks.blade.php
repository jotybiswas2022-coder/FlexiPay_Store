@extends('frontend.app')
@section('title', 'My Bank Accounts — FlexiPay Store')

@push('styles')
<style>
.fp-bk-hero {
    position: relative; padding: 30px 0 20px; overflow: hidden;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-bk-orb {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.04) 0%, transparent 60%);
    top: -150px; right: -80px; pointer-events: none;
    animation: bkPulse 4s ease-in-out infinite;
}
@keyframes bkPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-bk-section { padding-bottom: 80px; min-height: 60vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);color:#4ade80;padding:14px 18px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-bank-card { background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;position:relative;transition:all 0.3s;height:100%; }
.fp-bank-card:hover { border-color:rgba(234,179,8,0.2);transform:translateY(-3px);box-shadow:var(--shadow-card-hover); }
.fp-bank-icon { width:44px;height:44px;border-radius:10px;background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-500);font-size:20px;margin-bottom:12px; }
.fp-bank-card h5 { color:var(--text-primary);font-size:16px;font-weight:600; }
.fp-bank-account { font-family:'Syne',sans-serif;color:var(--gold-400);font-size:18px;font-weight:700;margin:4px 0; }
.fp-bank-name { color:var(--text-dim);font-size:13px; }
.fp-bank-delete { position:absolute;top:12px;right:12px;color:var(--text-dim);padding:4px;transition:color 0.2s; }
.fp-bank-delete:hover { color:#ef4444; }
.fp-input { width:100%;padding:12px 16px;background:var(--surface-dark);border:1.5px solid var(--card-border);border-radius:var(--radius-sm);color:var(--text-primary);font-size:14px;font-family:inherit;outline:none;transition:all 0.2s; }
.fp-input:focus { border-color:var(--gold-500);box-shadow:0 0 0 3px rgba(234,179,8,0.08); }
.fp-input::placeholder { color:var(--text-dim); }
.fp-modal .modal-content { background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius); }
.fp-modal .modal-header { border-bottom-color:var(--card-border); }
.fp-modal .modal-title { color:var(--text-primary);font-family:'Syne',sans-serif;font-size:16px;font-weight:700;display:flex;align-items:center;gap:8px; }
.fp-modal .modal-title i { color:var(--gold-500); }
.fp-modal .modal-footer { border-top-color:var(--card-border); }
</style>
@endpush

@section('content')
<section class="fp-bk-hero">
    <div class="fp-bk-orb"></div>
    <div class="container">
        <div class="section-head reveal-up" style="text-align:left;">
            <div class="section-badge" style="display:inline-flex;"><i class="bi bi-bank"></i> Bank Accounts</div>
            <h2>My Bank Accounts</h2>
            <p>Manage your saved bank accounts for withdrawals</p>
        </div>
    </div>
</section>

<section class="fp-bk-section">
    <div class="container">
        @if(session('success'))
        <div class="fp-alert reveal-up"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-4 reveal-up">
            <a href="#" class="btn-primary-gold" data-bs-toggle="modal" data-bs-target="#addBankModal"><i class="bi bi-plus-lg"></i> Add Bank</a>
        </div>

        <div class="row g-4">
            @forelse($banks ?? [] as $bank)
            <div class="col-lg-4 col-md-6">
                <div class="fp-bank-card reveal-up">
                    <div class="fp-bank-icon"><i class="bi bi-bank2"></i></div>
                    <h5>{{ $bank->bank_name }}</h5>
                    <p class="fp-bank-account">{{ $bank->account_number }}</p>
                    <span class="fp-bank-name">{{ $bank->account_name }}</span>
                    <a href="{{ route('profile.banks.delete', $bank) }}" class="fp-bank-delete" onclick="return confirm('Remove this bank account?')" aria-label="Remove bank account {{ $bank->account_number }}">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 reveal-up">
                    <i class="bi bi-bank" style="font-size:48px;color:var(--text-dim);display:block;margin-bottom:12px;"></i>
                    <p style="color:var(--text-muted);">No bank accounts added yet.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<div class="modal fade" id="addBankModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content fp-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-bank"></i> Add Bank Account</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.banks.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12"><input type="text" name="bank_name" class="fp-input" placeholder="Bank Name" required></div>
                        <div class="col-12"><input type="text" name="account_name" class="fp-input" placeholder="Account Name" required></div>
                        <div class="col-12"><input type="text" name="account_number" class="fp-input" placeholder="Account Number" required></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary-gold w-100 justify-content-center">Save Bank Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('frontend.partials.footer')
@stop
@endsection
