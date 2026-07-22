@extends('frontend.app')
@section('title', 'Fund Wallet — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="section-head">
            <div class="section-badge"><i class="bi bi-plus-circle-fill"></i> Fund Wallet</div>
            <h2>Add Funds to Your Wallet</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="fp-fund-card">
                    <div class="fp-fund-balance">
                        <span>Current Balance</span>
                        <strong>₦{{ number_format(auth()->user()->wallet?->balance ?? 0, 0) }}</strong>
                    </div>

                    <form action="{{ route('wallet.fund') }}" method="POST" class="mt-4">
                        @csrf
                        <div class="fp-form-group">
                            <label><i class="bi bi-cash-coin"></i> Amount to Add (₦)</label>
                            <div class="fp-amount-presets">
                                <button type="button" class="fp-preset" data-amount="1000">₦1,000</button>
                                <button type="button" class="fp-preset" data-amount="5000">₦5,000</button>
                                <button type="button" class="fp-preset" data-amount="10000">₦10,000</button>
                                <button type="button" class="fp-preset" data-amount="20000">₦20,000</button>
                                <button type="button" class="fp-preset" data-amount="50000">₦50,000</button>
                            </div>
                            <input type="number" name="amount" id="fundAmount" class="fp-input mt-2"
                                   placeholder="Enter custom amount" min="100" step="100" required>
                        </div>

                        <div class="fp-form-group mt-3">
                            <label><i class="bi bi-credit-card-fill"></i> Payment Method</label>
                            <select name="gateway" class="fp-input" required>
                                <option value="paystack">Paystack (Card, Bank, USSD)</option>
                                <option value="flutterwave">Flutterwave (Card, Bank, Mobile Money)</option>
                                <option value="korapay">Korapay (Card, Bank Transfer, USSD)</option>
                            </select>
                        </div>

                        <button type="submit" class="fp-fund-submit mt-4">
                            <i class="bi bi-wallet2"></i> Fund Wallet
                        </button>
                    </form>

                    <div class="fp-fund-note mt-3">
                        <i class="bi bi-info-circle-fill"></i>
                        Funds are non-withdrawable and can only be used for purchases on FlexiPay Store.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-fund-card { background: var(--card-dark); border: 1px solid var(--card-border); border-radius: var(--radius-lg); padding: 32px; max-width: 520px; margin: 0 auto; }
.fp-fund-balance { text-align: center; padding: 20px; background: var(--surface-dark); border-radius: var(--radius-sm); }
.fp-fund-balance span { display: block; color: var(--text-dim); font-size: 13px; margin-bottom: 4px; }
.fp-fund-balance strong { font-family:'Syne',sans-serif; font-size: 32px; font-weight: 800; color: var(--gold-400); }
.fp-form-group label { display: flex; align-items: center; gap: 6px; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 8px; }
.fp-form-group label i { color: var(--gold-500); }
.fp-amount-presets { display: flex; gap: 8px; flex-wrap: wrap; }
.fp-preset { padding: 8px 16px; border-radius: 8px; background: var(--surface-dark); border: 1px solid var(--card-border); color: var(--text-muted); font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.2s; font-family: inherit; }
.fp-preset:hover, .fp-preset.active { background: rgba(234,179,8,0.1); border-color: rgba(234,179,8,0.3); color: var(--gold-400); }
.fp-input { width: 100%; padding: 12px 16px; background: var(--surface-dark); border: 1.5px solid var(--card-border); border-radius: var(--radius-sm); color: var(--text-primary); font-size: 14px; font-family: inherit; outline: none; transition: all 0.2s; }
.fp-input:focus { border-color: var(--gold-500); box-shadow: 0 0 0 3px rgba(234,179,8,0.08); }
.fp-input option { background: var(--card-dark); color: var(--text-primary); }
.fp-fund-submit { width: 100%; padding: 14px; background: linear-gradient(135deg,var(--gold-500),var(--gold-600)); color: var(--near-black); border: none; border-radius: var(--radius-sm); font-weight: 700; font-size: 15px; font-family:'Syne',sans-serif; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: all 0.3s; }
.fp-fund-submit:hover { transform: translateY(-2px); box-shadow: var(--shadow-gold); }
.fp-fund-note { display: flex; align-items: center; gap: 8px; padding: 12px 16px; background: rgba(234,179,8,0.05); border: 1px solid rgba(234,179,8,0.15); border-radius: var(--radius-sm); font-size: 12px; color: var(--text-dim); }
.fp-fund-note i { color: var(--gold-500); font-size: 14px; }
</style>
<script>
document.querySelectorAll('.fp-preset').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.fp-preset').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('fundAmount').value = this.dataset.amount;
    });
});
</script>
@endsection