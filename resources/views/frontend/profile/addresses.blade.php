@extends('frontend.app')
@section('title', 'My Addresses — FlexiPay Store')

@push('styles')
<style>
.fp-ad-hero {
    position: relative; padding: 30px 0 20px; overflow: hidden;
    background: linear-gradient(180deg, rgba(234,179,8,0.03) 0%, transparent 100%);
}
.fp-ad-orb {
    position: absolute; width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(234,179,8,0.04) 0%, transparent 60%);
    top: -150px; right: -80px; pointer-events: none;
    animation: adPulse 4s ease-in-out infinite;
}
@keyframes adPulse { 0%,100%{transform:scale(1);opacity:0.5} 50%{transform:scale(1.1);opacity:1} }

.fp-ad-section { padding-bottom: 80px; min-height: 60vh; }
.fp-alert { display:flex;align-items:center;gap:8px;background:rgba(34,197,94,0.08);border:1px solid rgba(34,197,94,0.2);color:#4ade80;padding:14px 18px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px; }
.fp-address-card { background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;position:relative;transition:all 0.3s;height:100%; }
.fp-address-card.default { border-color:rgba(234,179,8,0.3); }
.fp-address-card:hover { border-color:rgba(234,179,8,0.2);transform:translateY(-3px);box-shadow:var(--shadow-card-hover); }
.fp-addr-default-badge { position:absolute;top:10px;right:10px;background:var(--gold-500);color:var(--near-black);padding:3px 10px;border-radius:6px;font-size:11px;font-weight:600;display:flex;align-items:center;gap:4px; }
.fp-addr-icon { width:44px;height:44px;border-radius:10px;background:rgba(234,179,8,0.1);display:flex;align-items:center;justify-content:center;color:var(--gold-500);font-size:20px;margin-bottom:12px; }
.fp-address-card h5 { color:var(--text-primary);font-size:16px;font-weight:600;margin-bottom:6px; }
.fp-address-card p { color:var(--text-muted);font-size:13px;line-height:1.6;margin-bottom:4px; }
.fp-addr-phone { color:var(--text-dim);font-size:12px; }
.fp-addr-actions { margin-top:14px;display:flex;gap:6px; }
.fp-addr-btn { width:34px;height:34px;border-radius:6px;display:flex;align-items:center;justify-content:center;border:1px solid var(--card-border);color:var(--text-dim);font-size:14px;transition:all 0.2s;text-decoration:none; }
.fp-addr-btn.edit:hover { border-color:var(--gold-400);color:var(--gold-400); }
.fp-addr-btn.delete:hover { border-color:rgba(239,68,68,0.3);color:#ef4444; }
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
<section class="fp-ad-hero">
    <div class="fp-ad-orb"></div>
    <div class="container">
        <div class="section-head reveal-up" style="text-align:left;">
            <div class="section-badge" style="display:inline-flex;"><i class="bi bi-geo-alt-fill"></i> Delivery Addresses</div>
            <h2>My Addresses</h2>
            <p>Manage your saved delivery addresses</p>
        </div>
    </div>
</section>

<section class="fp-ad-section">
    <div class="container">
        @if(session('success'))
        <div class="fp-alert reveal-up"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <div class="d-flex justify-content-end mb-4 reveal-up">
            <a href="#" class="btn-primary-gold" data-bs-toggle="modal" data-bs-target="#addAddressModal"><i class="bi bi-plus-lg"></i> Add Address</a>
        </div>

        <div class="row g-4">
            @forelse($addresses ?? [] as $address)
            <div class="col-lg-4 col-md-6">
                <div class="fp-address-card {{ $address->is_default ? 'default' : '' }} reveal-up">
                    @if($address->is_default)<span class="fp-addr-default-badge"><i class="bi bi-pin-fill"></i> Default</span>@endif
                    <div class="fp-addr-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <h5>{{ $address->label ?? 'Address' }}</h5>
                    <p>{{ $address->address }}, {{ $address->city }}, {{ $address->state }}</p>
                    <span class="fp-addr-phone">{{ $address->phone }}</span>
                    <div class="fp-addr-actions">
                        <a href="#" class="fp-addr-btn edit" data-bs-toggle="modal" data-bs-target="#editAddress{{ $address->id }}"><i class="bi bi-pencil-fill"></i></a>
                        <a href="{{ route('profile.addresses.delete', $address) }}" class="fp-addr-btn delete" onclick="return confirm('Delete this address?')"><i class="bi bi-trash-fill"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5 reveal-up">
                    <i class="bi bi-geo-alt" style="font-size:48px;color:var(--text-dim);display:block;margin-bottom:12px;"></i>
                    <p style="color:var(--text-muted);">No addresses saved yet. Add a delivery address!</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<div class="modal fade" id="addAddressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content fp-modal">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-geo-alt-fill"></i> Add New Address</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.addresses.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-6"><input type="text" name="recipient_name" class="fp-input" placeholder="Recipient name" required></div>
                        <div class="col-6"><input type="text" name="label" class="fp-input" placeholder="Label (e.g. Home, Office)"></div>
                        <div class="col-12"><input type="text" name="address_line1" class="fp-input" placeholder="Street address" required></div>
                        <div class="col-6"><input type="text" name="city" class="fp-input" placeholder="City" required></div>
                        <div class="col-6"><input type="text" name="state" class="fp-input" placeholder="State" required></div>
                        <div class="col-12"><input type="text" name="phone" class="fp-input" placeholder="Phone number" required></div>
                        <div class="col-12">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                                <input type="checkbox" name="is_default" value="1" style="width:16px;height:16px;accent-color:var(--gold-500);">
                                <span style="color:var(--text-muted);font-size:13px;">Set as default address</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-primary-gold w-100 justify-content-center">Save Address</button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('frontend.partials.footer')
@stop
@endsection
