@extends('frontend.app')
@section('title', 'Wallet History — FlexiPay Store')

@section('content')
<section class="fp-section">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <div class="section-badge"><i class="bi bi-clock-history"></i> Transaction History</div>
                <h2 style="font-family:'Syne',sans-serif;font-size:28px;font-weight:800;color:var(--text-primary);">Wallet History</h2>
            </div>
            <a href="{{ route('wallet.index') }}" class="btn-primary-gold"><i class="bi bi-wallet2"></i> Wallet</a>
        </div>

        @if(isset($transactions) && $transactions->count() > 0)
        <div class="fp-txn-table-wrap">
            <table class="fp-txn-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $txn)
                    <tr>
                        <td style="color:var(--text-dim);font-size:12px;">{{ $txn->created_at->format('M d, Y') }}</td>
                        <td style="color:var(--text-primary);font-weight:500;">{{ $txn->description ?? ucfirst($txn->type) }}</td>
                        <td>
                            <span class="fp-txn-type {{ $txn->type }}">{{ ucfirst($txn->type) }}</span>
                        </td>
                        <td class="text-end fp-txn-val {{ $txn->type }}">
                            {{ $txn->type == 'credit' ? '+' : '-' }}₦{{ number_format($txn->amount, 0) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-clock-history" style="font-size:48px;color:var(--text-dim);display:block;margin-bottom:12px;"></i>
            <p style="color:var(--text-muted);">No transaction history yet.</p>
        </div>
        @endif
    </div>
</section>
@include('frontend.partials.footer')
<style>
.fp-section { background: linear-gradient(135deg,var(--near-black),var(--surface-dark)); padding: 60px 0; min-height: 100vh; }
.fp-txn-table-wrap { background: var(--card-dark); border: 1px solid var(--card-border); border-radius: var(--radius); overflow: hidden; }
.fp-txn-table { width: 100%; border-collapse: collapse; }
.fp-txn-table th { padding: 14px 20px; text-align: left; font-size: 12px; font-weight: 600; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--card-border); background: var(--surface-dark); }
.fp-txn-table td { padding: 14px 20px; border-bottom: 1px solid var(--card-border); font-size: 13px; }
.fp-txn-table tr:last-child td { border-bottom: none; }
.fp-txn-table tr:hover td { background: rgba(234,179,8,0.02); }
.fp-txn-type { padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
.fp-txn-type.credit { background: rgba(34,197,94,0.15); color: #4ade80; }
.fp-txn-type.debit { background: rgba(239,68,68,0.15); color: #ef4444; }
.fp-txn-val { font-weight: 700; font-size: 14px; }
.fp-txn-val.credit { color: #4ade80; }
.fp-txn-val.debit { color: #ef4444; }
</style>
@endsection