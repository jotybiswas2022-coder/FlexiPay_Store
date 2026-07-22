@extends('backend.app')
@section('title', 'Posts — FlexiPay Admin')
@section('page_title', 'Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="mb-0" style="color:var(--text-muted);">{{ $posts->count() ?? 0 }} posts</p>
    <a href="{{ route('admin.posts.create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> New Post</a>
</div>
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All Posts</h5></div>
    <table class="fp-table">
        <thead><tr><th>#</th><th>Title</th><th>Category</th><th>Date</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($posts ?? [] as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong style="color:var(--text-primary);">{{ Str::limit($p->title, 50) }}</strong></td>
                <td>{{ $p->PostCategory?->name ?? '—' }}</td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $p->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ url('admin/posts/edit/'.$p->id) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ url('admin/posts/delete/'.$p->id) }}" class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="return confirm('Delete?')"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No posts</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection