@extends('backend.app')
@section('title', 'Categories — FlexiPay Admin')
@section('page_title', 'Categories')

@section('content')

@if (session('success'))
<div class="fp-table-wrap mb-4" style="border-left:3px solid #4ade80;">
    <div class="p-3" style="color:#4ade80;font-size:14px;">
        <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
    </div>
</div>
@endif

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <p class="mb-0" style="color:var(--text-muted);">{{ $categories->count() ?? 0 }} categories</p>
    </div>
    <a href="{{ url('admin/category/create') }}" class="fp-btn fp-btn-gold"><i class="bi bi-plus-lg"></i> Add Category</a>
</div>

<div class="fp-table-wrap">
    <div class="fp-table-header">
        <h5>All Categories</h5>
        <input type="text" id="categorySearch" class="fp-form-control" placeholder="Search..." style="width:220px;padding:6px 12px;font-size:13px;">
    </div>
    <div class="table-responsive">
        <table class="fp-table">
            <thead><tr><th>#</th><th>Name</th><th>Created</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td style="color:var(--text-dim);">{{ $loop->iteration }}</td>
                        <td><strong style="color:var(--text-primary);">{{ $category->name }}</strong></td>
                        <td style="color:var(--text-dim);font-size:12px;">{{ $category->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="fp-btn fp-btn-ghost" style="padding:4px 10px;" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="fp-btn fp-btn-ghost" style="padding:4px 10px;color:#ef4444;" onclick="confirmation({{ $category->id }})">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content" style="background:var(--card-dark);border:1px solid var(--card-border);border-radius:16px;">
                                        <div class="modal-header" style="border-bottom:1px solid var(--card-border);padding:18px 24px;">
                                            <h5 class="modal-title fw-semibold" style="color:var(--text-primary);font-family:'Syne',sans-serif;font-size:15px;">
                                                <i class="bi bi-pencil-square me-2" style="color:var(--gold-500);"></i>Edit Category
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="filter:invert(0.6);"></button>
                                        </div>
                                        <form action="{{ url('admin/category/update/'.$category->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body p-4">
                                                <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Category Name <span style="color:#ef4444;">*</span></label>
                                                <input type="text" class="fp-form-control" name="name" value="{{ $category->name }}" required>
                                            </div>
                                            <div class="modal-footer" style="border-top:1px solid var(--card-border);padding:16px 24px;">
                                                <button type="button" class="fp-btn fp-btn-ghost" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Cancel</button>
                                                <button type="submit" class="fp-btn fp-btn-gold"><i class="bi bi-check-lg me-1"></i> Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4" style="color:var(--text-dim);">No categories found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmation(id) {
    Swal.fire({
        title: 'Delete Category?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#71717A',
        confirmButtonText: 'Yes, delete it',
        background: '#1A1A1E',
        color: '#F4F4F5'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/admin/category/delete/' + id;
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('categorySearch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const filter = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() ?? '';
                row.style.display = name.includes(filter) ? '' : 'none';
            });
        });
    }
});
</script>
@endsection