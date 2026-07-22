@extends('backend.app')
@section('title', 'Campaigns — FlexiPay Admin')
@section('page_title', 'Campaigns')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $campaigns->count() ?? 0 }} campaigns</p>
    <a href="{{ route('admin.campaigns.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> New Campaign</a>
</div>
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Campaigns</h5></div>
    <table class="fp-table">
        <thead><tr><th>Title</th><th>Type</th><th>Recipients</th><th>Sent</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($campaigns ?? [] as $c)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $c->title }}</strong></td>
                <td>{{ ucfirst($c->type) }}</td>
                <td>{{ $c->recipient_count ?? 0 }}</td>
                <td>{{ $c->sent_count ?? 0 }}</td>
                <td><span class="fp-badge {{ $c->status == 'sent' ? 'fp-badge-active' : 'fp-badge-pending' }}">{{ ucfirst($c->status) }}</span></td>
                <td>
                    @if($c->status != 'sent')
                    <form action="{{ route('admin.campaigns.send', $c) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:4px 10px;font-size:11px;">Send Now</button>
                    </form>
                    @endif
                    <a href="{{ route('admin.campaigns.delete', $c) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-4" style="color:var(--text-dim);">No campaigns yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection