@extends('frontend.app')
@section('title', 'Verification — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-patch-check-fill"></i> Account Verification</div>
            <h2>Verification Status</h2>
        </div>

        @if(session('success'))
        <div class="fp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="row g-4">
            @php
                $vTypes = [
                    ['key' => 'identity_card', 'icon' => 'bi-person-badge-fill', 'label' => 'Identity Card'],
                    ['key' => 'payment_card', 'icon' => 'bi-credit-card-2-front-fill', 'label' => 'Payment Card'],
                    ['key' => 'bank_account', 'icon' => 'bi-bank2', 'label' => 'Bank Account'],
                    ['key' => 'email', 'icon' => 'bi-envelope-fill', 'label' => 'Email Address'],
                    ['key' => 'store_terms', 'icon' => 'bi-file-earmark-text-fill', 'label' => 'Store Terms'],
                    ['key' => 'delivery_address', 'icon' => 'bi-geo-alt-fill', 'label' => 'Delivery Address'],
                ];
            @endphp

            @foreach($vTypes as $vt)
            @php
                $verification = $verifications->firstWhere('type', $vt['key']);
                $status = $verification?->status ?? 'unsubmitted';
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="fp-verification-card status-{{ $status }}">
                    <div class="fp-v-icon"><i class="bi {{ $vt['icon'] }}"></i></div>
                    <h5>{{ $vt['label'] }}</h5>
                    <span class="fp-v-status {{ $status }}">
                        @if($status == 'approved') <i class="bi bi-check-circle-fill"></i> Approved
                        @elseif($status == 'pending') <i class="bi bi-clock-fill"></i> Pending Review
                        @elseif($status == 'rejected') <i class="bi bi-x-circle-fill"></i> Rejected
                        @else <i class="bi bi-dash-circle-fill"></i> Not Submitted
                        @endif
                    </span>
                    @if($status == 'unsubmitted' && $vt['key'] != 'email')
                        <form action="{{ route('profile.verification.submit') }}" method="POST" class="mt-3" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="{{ $vt['key'] }}">
                            <input type="file" name="file" class="fp-v-file" required>
                            <button type="submit" class="fp-v-submit mt-2">Upload & Submit</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.25);color:#4ade80;padding:12px 16px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-verification-card { background: var(--card-dark); border: 1px solid var(--card-border); border-radius: var(--radius); padding: 24px; text-align: center; transition: all 0.3s; height: 100%; }
.fp-verification-card.status-approved { border-color: rgba(34,197,94,0.3); }
.fp-verification-card.status-pending { border-color: rgba(234,179,8,0.3); }
.fp-verification-card.status-rejected { border-color: rgba(239,68,68,0.3); }
.fp-v-icon { width: 52px; height: 52px; border-radius: 12px; margin: 0 auto 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.status-approved .fp-v-icon { background: rgba(34,197,94,0.1); color: #4ade80; }
.status-pending .fp-v-icon { background: rgba(234,179,8,0.1); color: var(--gold-400); }
.status-rejected .fp-v-icon { background: rgba(239,68,68,0.1); color: #ef4444; }
.fp-verification-card h5 { color: var(--text-primary); font-size: 15px; font-weight: 600; margin-bottom: 8px; }
.fp-v-status { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 500; }
.fp-v-status.approved { background: rgba(34,197,94,0.15); color: #4ade80; }
.fp-v-status.pending { background: rgba(234,179,8,0.15); color: var(--gold-400); }
.fp-v-status.rejected { background: rgba(239,68,68,0.15); color: #ef4444; }
.fp-v-file { width: 100%; padding: 6px; font-size: 12px; color: var(--text-muted); }
.fp-v-submit { width: 100%; padding: 8px; background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.2); border-radius: 6px; color: var(--gold-400); font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; font-family: inherit; }
.fp-v-submit:hover { background: rgba(234,179,8,0.2); }
</style>
@endsection