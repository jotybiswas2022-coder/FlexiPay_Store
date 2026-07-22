@extends('frontend.app')
@section('title', 'Checkout — FlexiPay Store')

@section('content')
<section style="background:var(--near-black);padding:60px 0;min-height:100vh;">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-credit-card-fill"></i> Checkout</div>
            <h2>Complete Your Purchase</h2>
        </div>

        @if(session('error'))
        <div style="display:flex;align-items:center;gap:8px;background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.25);color:#ef4444;padding:12px 16px;border-radius:var(--radius-sm);font-weight:500;font-size:13px;margin-bottom:24px;">
            <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row g-4">
                <div class="col-lg-7">
                    <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;margin-bottom:20px;">
                        <h5 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;"><i class="bi bi-geo-alt-fill" style="color:var(--gold-500);"></i> Delivery Address</h5>
                        @if($addresses && $addresses->count() > 0)
                            @foreach($addresses as $addr)
                            <label style="display:flex;align-items:flex-start;gap:12px;padding:12px;border:2px solid {{ old('delivery_address_id') == $addr->id ? 'var(--gold-500)' : 'var(--card-border)' }};border-radius:var(--radius-sm);margin-bottom:8px;cursor:pointer;transition:border-color 0.2s;" onclick="this.querySelector('input[type=radio]').checked=true;this.style.borderColor='var(--gold-500)';document.querySelectorAll('.addr-label').forEach(l=>{if(l!=this)l.style.borderColor='var(--card-border)'})" class="addr-label">
                                <input type="radio" name="delivery_address_id" value="{{ $addr->id }}" {{ old('delivery_address_id') == $addr->id ? 'checked' : '' }} required style="margin-top:3px;accent-color:var(--gold-500);">
                                <div>
                                    <strong style="color:var(--text-primary);display:block;">{{ $addr->label ?? 'Address' }}</strong>
                                    <span style="color:var(--text-muted);font-size:13px;">{{ $addr->address }}, {{ $addr->city }}, {{ $addr->state }}</span>
                                </div>
                            </label>
                            @endforeach
                        @else
                            <p style="color:var(--text-dim);font-size:14px;">No saved addresses. <a href="{{ route('profile.addresses') }}" style="color:var(--gold-500);">Add one here</a></p>
                        @endif
                        @error('delivery_address_id')<small style="color:#ef4444;">{{ $message }}</small>@enderror
                    </div>

                    <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;margin-bottom:20px;">
                        <h5 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;"><i class="bi bi-coin" style="color:var(--gold-500);"></i> Payment Method</h5>
                        <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:16px;">
                            <label style="flex:1;padding:16px;border:2px solid {{ old('payment_type') == 'full' ? 'var(--gold-500)' : 'var(--card-border)' }};border-radius:var(--radius-sm);text-align:center;cursor:pointer;transition:all 0.2s;" onclick="this.querySelector('input').checked=true;document.getElementById('planSelect').style.display='none';document.querySelectorAll('.pm-label').forEach(l=>l.style.borderColor='var(--card-border)');this.style.borderColor='var(--gold-500')" class="pm-label">
                                <input type="radio" name="payment_type" value="full" {{ old('payment_type') == 'full' ? 'checked' : '' }} required style="display:none;">
                                <i class="bi bi-cash-stack" style="font-size:24px;color:var(--gold-500);display:block;margin-bottom:6px;"></i>
                                <strong style="color:var(--text-primary);font-size:14px;">Pay in Full</strong>
                            </label>
                            <label style="flex:1;padding:16px;border:2px solid {{ old('payment_type') == 'installment' ? 'var(--gold-500)' : 'var(--card-border)' }};border-radius:var(--radius-sm);text-align:center;cursor:pointer;transition:all 0.2s;" onclick="this.querySelector('input').checked=true;document.getElementById('planSelect').style.display='block';document.querySelectorAll('.pm-label').forEach(l=>l.style.borderColor='var(--card-border)');this.style.borderColor='var(--gold-500')" class="pm-label">
                                <input type="radio" name="payment_type" value="installment" {{ old('payment_type') == 'installment' ? 'checked' : '' }} required style="display:none;">
                                <i class="bi bi-calendar-check" style="font-size:24px;color:var(--gold-500);display:block;margin-bottom:6px;"></i>
                                <strong style="color:var(--text-primary);font-size:14px;">Pay in Installments</strong>
                            </label>
                        </div>
                        @error('payment_type')<small style="color:#ef4444;display:block;margin-bottom:8px;">{{ $message }}</small>@enderror

                        <div id="planSelect" style="display:{{ old('payment_type') == 'installment' ? 'block' : 'none' }};">
                            <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Select Installment Plan</label>
                            <select name="installment_plan_id" class="fp-form-control">
                                <option value="">Choose a plan</option>
                                @foreach($installmentPlans as $plan)
                                <option value="{{ $plan->id }}" {{ old('installment_plan_id') == $plan->id ? 'selected' : '' }}>{{ $plan->name }} ({{ $plan->interest_rate }}% interest)</option>
                                @endforeach
                            </select>
                            @error('installment_plan_id')<small style="color:#ef4444;">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;margin-bottom:20px;">
                        <h5 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;"><i class="bi bi-shield-fill-check" style="color:var(--gold-500);"></i> Extras</h5>
                        @if($insurance && $insurance->is_enabled)
                        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                            <input type="checkbox" name="has_insurance" value="1" {{ old('has_insurance') ? 'checked' : '' }} style="width:18px;height:18px;accent-color:var(--gold-500);">
                            <span style="color:var(--text-muted);font-size:14px;">Add Insurance ({{ $insurance->rate }}% of total)</span>
                        </label>
                        @endif
                    </div>

                    <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;margin-bottom:20px;">
                        <h5 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;"><i class="bi bi-credit-card-2-front" style="color:var(--gold-500);"></i> Pay Using</h5>
                        <div style="display:flex;gap:12px;flex-wrap:wrap;">
                            <label style="flex:1;padding:16px;border:2px solid {{ old('payment_method') == 'wallet' ? 'var(--gold-500)' : 'var(--card-border)' }};border-radius:var(--radius-sm);text-align:center;cursor:pointer;transition:all 0.2s;" onclick="this.querySelector('input').checked=true;document.querySelectorAll('.gw-label').forEach(l=>l.style.borderColor='var(--card-border)');this.style.borderColor='var(--gold-500')" class="gw-label">
                                <input type="radio" name="payment_method" value="wallet" {{ old('payment_method') == 'wallet' ? 'checked' : '' }} required style="display:none;">
                                <i class="bi bi-wallet2" style="font-size:24px;color:var(--gold-500);display:block;margin-bottom:6px;"></i>
                                <strong style="color:var(--text-primary);font-size:14px;">Wallet</strong>
                                <small style="color:var(--text-dim);display:block;">₦{{ number_format($wallet->balance ?? 0, 0) }}</small>
                            </label>
                            <label style="flex:1;padding:16px;border:2px solid {{ old('payment_method') == 'gateway' ? 'var(--gold-500)' : 'var(--card-border)' }};border-radius:var(--radius-sm);text-align:center;cursor:pointer;transition:all 0.2s;" onclick="this.querySelector('input').checked=true;document.querySelectorAll('.gw-label').forEach(l=>l.style.borderColor='var(--card-border)');this.style.borderColor='var(--gold-500')" class="gw-label">
                                <input type="radio" name="payment_method" value="gateway" {{ old('payment_method') == 'gateway' ? 'checked' : '' }} required style="display:none;">
                                <i class="bi bi-bank" style="font-size:24px;color:var(--gold-500);display:block;margin-bottom:6px;"></i>
                                <strong style="color:var(--text-primary);font-size:14px;">Card / Bank</strong>
                                <small style="color:var(--text-dim);display:block;">Paystack, Flutterwave</small>
                            </label>
                        </div>
                        @error('payment_method')<small style="color:#ef4444;display:block;margin-top:8px;">{{ $message }}</small>@enderror
                    </div>

                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;padding:12px 0;">
                        <input type="checkbox" name="agree_terms" value="1" required style="width:18px;height:18px;accent-color:var(--gold-500);">
                        <span style="color:var(--text-muted);font-size:13px;">I agree to the <a href="{{ url('/terms') }}" target="_blank" style="color:var(--gold-500);">Terms & Conditions</a></span>
                    </label>
                    @error('agree_terms')<small style="color:#ef4444;">{{ $message }}</small>@enderror
                </div>

                <div class="col-lg-5">
                    <div style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:var(--radius);padding:24px;position:sticky;top:100px;">
                        <h5 style="font-family:'Syne',sans-serif;color:var(--text-primary);margin-bottom:16px;">Order Summary</h5>
                        @foreach($cart as $item)
                        <div style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--card-border);">
                            @if($item['thumbnail'])
                            <img src="{{ asset('storage/'.$item['thumbnail']) }}" alt="" style="width:50px;height:50px;border-radius:6px;object-fit:cover;background:var(--surface-dark);">
                            @else
                            <div style="width:50px;height:50px;border-radius:6px;background:var(--surface-dark);display:flex;align-items:center;justify-content:center;color:var(--card-border);"><i class="bi bi-image"></i></div>
                            @endif
                            <div style="flex:1;min-width:0;">
                                <div style="color:var(--text-primary);font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item['name'] }}</div>
                                <div style="color:var(--text-dim);font-size:12px;">Qty: {{ $item['quantity'] }}</div>
                            </div>
                            <div style="color:var(--gold-400);font-weight:700;font-size:14px;">₦{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                        </div>
                        @endforeach

                        <div style="margin-top:16px;">
                            <div style="display:flex;justify-content:space-between;font-size:14px;color:var(--text-muted);margin-bottom:8px;">
                                <span>Subtotal</span>
                                <span>₦{{ number_format($total, 0) }}</span>
                            </div>
                            <div style="display:flex;justify-content:space-between;font-size:14px;color:var(--text-muted);margin-bottom:8px;">
                                <span>Shipping</span>
                                <span style="color:var(--gold-400);">Calculated at checkout</span>
                            </div>
                            <div style="height:1px;background:var(--card-border);margin:12px 0;"></div>
                            <div style="display:flex;justify-content:space-between;font-size:18px;font-weight:700;color:var(--text-primary);">
                                <span>Total</span>
                                <span style="color:var(--gold-400);">₦{{ number_format($total, 0) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary-gold btn-lg" style="width:100%;margin-top:20px;padding:14px;">
                            <i class="bi bi-shield-lock-fill"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@include('frontend.partials.footer')

<style>
.fp-form-control {
    width:100%;padding:10px 12px;
    background:var(--surface-dark);border:1px solid var(--card-border);
    border-radius:6px;color:var(--text-primary);font-size:14px;font-family:inherit;
}
.fp-form-control:focus { outline:none;border-color:var(--gold-500); }
.btn-primary-gold {
    display:inline-flex;align-items:center;justify-content:center;gap:8px;
    background:linear-gradient(135deg,var(--gold-500),var(--gold-600));
    color:var(--near-black);padding:10px 24px;border-radius:var(--radius-sm);
    font-weight:700;font-size:14px;border:none;cursor:pointer;transition:all 0.3s;
    text-decoration:none;
}
.btn-primary-gold:hover { transform:translateY(-2px);box-shadow:var(--shadow-gold);color:var(--near-black); }
.btn-lg { padding:14px 32px;font-size:16px; }
</style>
@endsection
