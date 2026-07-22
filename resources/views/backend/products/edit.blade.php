@extends('backend.app')
@section('title', 'Edit Product — FlexiPay Admin')
@section('page_title', 'Edit Product')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Edit: {{ $product->name }}</h5></div>
    <div style="padding:24px;">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Product Name</label><input type="text" name="name" class="fp-form-control" value="{{ $product->name }}" required></div>
                <div class="col-md-3"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Category</label><select name="category_id" class="fp-form-control" required>@foreach($categories ?? [] as $c)<option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach</select></div>
                <div class="col-md-3"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Brand</label><select name="brand_id" class="fp-form-control">@foreach($brands ?? [] as $b)<option value="{{ $b->id }}" {{ $product->brand_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>@endforeach</select></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Price (₦)</label><input type="number" name="price" class="fp-form-control" step="0.01" value="{{ $product->price }}" required></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Compare Price (₦)</label><input type="number" name="compare_price" class="fp-form-control" step="0.01" value="{{ $product->compare_price }}"></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Supplier</label><select name="supplier_id" class="fp-form-control">@foreach($suppliers ?? [] as $s)<option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>@endforeach</select></div>
                <div class="col-12"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Description</label><textarea name="description" class="fp-form-control" rows="4">{{ $product->description }}</textarea></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Stock</label><input type="number" name="stock" class="fp-form-control" value="{{ $product->stock ?? 0 }}"></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Status</label><select name="status" class="fp-form-control"><option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option><option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option></select></div>
                <div class="col-md-4"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Featured</label><select name="featured" class="fp-form-control"><option value="1" {{ $product->featured ? 'selected' : '' }}>Yes</option><option value="0" {{ !$product->featured ? 'selected' : '' }}>No</option></select></div>
                <div class="col-md-6"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">New Images</label><input type="file" name="images[]" class="fp-form-control" multiple accept="image/*"></div>
                <div class="col-12"><button type="submit" class="fp-btn fp-btn-gold"><i class="bi bi-check-lg"></i> Update Product</button></div>
            </div>
        </form>
    </div>
</div>
@endsection