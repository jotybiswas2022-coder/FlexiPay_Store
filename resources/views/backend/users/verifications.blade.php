@extends('backend.app')
@section('title', 'Verifications — FlexiPay Admin')
@section('page_title', 'User Verifications')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Pending Verifications</h5></div>
    <table class="fp-table">
        <thead><tr><th>User</th><th>Type</th><th>Submitted</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($verifications ?? [] as $v)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $v->user?->name ?? 'N/A' }}</strong></td>
                <td>{{ str_replace('_', ' ', ucfirst($v->type)) }}</td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $v->created_at->format('M d, Y') }}</td>
                <td><span class="fp-badge fp-badge-{{ $v->status == 'approved' ? 'active' : ($v->status == 'rejected' ? 'inactive' : 'pending') }}">{{ ucfirst($v->status) }}</span></td>
                <td>
                    <form action="{{ route('admin.users.verifications.update', $v->id) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <select name="status" class="fp-form-control" style="width:auto;">
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                            <option value="pending">Pending</option>
                        </select>
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:6px 12px;">Update</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No verification requests</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection