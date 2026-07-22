@extends('backend.app')
@section('title', 'Customers — FlexiPay Admin')
@section('page_title', 'Customers')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Users</h5></div>
    <table class="fp-table">
        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Orders</th><th>Status</th><th>Role</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($users ?? [] as $u)
            <tr>
                <td><strong style="color:var(--text-primary);">{{ $u->name ?? 'N/A' }}</strong></td>
                <td style="color:var(--text-dim);">{{ $u->email }}</td>
                <td>{{ $u->phone ?? '—' }}</td>
                <td>{{ $u->orders()->count() }}</td>
                <td><span class="fp-badge {{ $u->is_suspended ? 'fp-badge-inactive' : 'fp-badge-active' }}">{{ $u->is_suspended ? 'Suspended' : 'Active' }}</span></td>
                <td>{{ $u->is_admin ? 'Admin' : 'User' }}</td>
                <td>
                    <a href="{{ route('admin.users.show', $u) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-eye"></i></a>
                    @if($u->is_suspended)
                    <form action="{{ route('admin.users.unsuspend', $u) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#4ade80;"><i class="bi bi-unlock-fill"></i></button>
                    </form>
                    @else
                    <form action="{{ route('admin.users.suspend', $u) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:var(--gold-400);"><i class="bi bi-lock-fill"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-4" style="color:var(--text-dim);">No users yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection