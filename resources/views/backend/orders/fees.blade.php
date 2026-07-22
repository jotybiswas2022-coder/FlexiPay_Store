@extends('backend.app')
@section('title', 'Product Fees — FlexiPay Admin')
@section('page_title', 'Product Fees')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Manage Fees</h5></div>
    <table class="fp-table">
        <thead><tr><th>Fee Type</th><th>Amount (₦)</th><th>Percentage (%)</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($fees ?? [] as $fee)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $fee->name }}</strong></td>
                <td>₦{{ number_format($fee->amount ?? 0, 0) }}</td>
                <td>{{ $fee->percentage ?? 0 }}%</td>
                <td>
                    <form action="{{ route('admin.orders.fees.update', $fee) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="number" name="amount" class="fp-form-control" value="{{ $fee->amount ?? 0 }}" style="width:100px;" step="0.01">
                        <input type="number" name="percentage" class="fp-form-control" value="{{ $fee->percentage ?? 0 }}" style="width:80px;" step="0.01">
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:8px 16px;">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-4" style="color:var(--text-dim);">No fees configured</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection