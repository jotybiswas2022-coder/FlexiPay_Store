@extends('backend.app')
@section('title', 'FAQs — FlexiPay Admin')
@section('page_title', 'FAQs')

@push('styles')
<style>
    .faq-textarea { min-height: 100px; resize: vertical; }
</style>
@endpush

@section('content')
<div class="fp-table-wrap mb-4">
    <div class="fp-table-header"><h5>Add New FAQ</h5></div>
    <div class="p-3">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="question" class="fp-form-control" placeholder="Question" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="category" class="fp-form-control" placeholder="Category (optional)">
                </div>
                <div class="col-md-3">
                    <input type="number" name="sort_order" class="fp-form-control" placeholder="Sort Order" value="0" min="0">
                </div>
                <div class="col-12">
                    <textarea name="answer" class="fp-form-control faq-textarea" placeholder="Answer" required></textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" class="form-check-input" id="new_faq_active" value="1" checked style="accent-color:var(--gold-500);">
                        <label for="new_faq_active" style="color:var(--text-muted);font-size:13px;">Active</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="fp-btn fp-btn-gold">Add FAQ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>All FAQs</h5></div>
    <table class="fp-table">
        <thead><tr><th>Question</th><th>Category</th><th>Order</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($faqs ?? [] as $faq)
            <tr>
                <td>
                    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                        @csrf
                        <input type="text" name="question" class="fp-form-control" value="{{ $faq->question }}" style="width:250px;padding:6px 10px;" required>
                </td>
                <td>
                    <input type="text" name="category" class="fp-form-control" value="{{ $faq->category }}" style="width:130px;padding:6px 10px;">
                </td>
                <td>
                    <input type="number" name="sort_order" class="fp-form-control" value="{{ $faq->sort_order }}" style="width:70px;padding:6px 10px;" min="0">
                </td>
                <td>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" class="form-check-input" id="active_{{ $faq->id }}" value="1" {{ $faq->is_active ? 'checked' : '' }} style="accent-color:var(--gold-500);">
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <button type="submit" class="fp-btn fp-btn-gold" style="padding:6px 12px;">Save</button>
                    </form>
                    <a href="{{ route('admin.faqs.delete', $faq) }}" class="fp-btn fp-btn-danger" style="padding:6px 12px;" onclick="return confirm('Delete this FAQ?')">Delete</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-4" style="color:var(--text-dim);">No FAQs yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
