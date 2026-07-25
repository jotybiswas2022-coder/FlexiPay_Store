@extends('backend.app')
@section('title', 'Sliders — FlexiPay Admin')
@section('page_title', 'Sliders')

@section('content')

@if(session('success'))
<div class="fp-table-wrap mb-4" style="border-left:3px solid #4ade80;">
    <div class="p-3" style="color:#4ade80;font-size:14px;">
        <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
    </div>
</div>
@endif

<div class="fp-table-wrap">
    <div class="fp-table-header"><h5><i class="bi bi-images"></i> Manage Sliders</h5></div>
    <div style="padding:24px;">
        <form action="/admin/sliders/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-6">
                    <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:8px;">
                        <i class="bi bi-image" style="color:var(--gold-500);"></i> Slider Image 1
                    </label>
                    <input type="file" accept="image/*" class="fp-form-control" name="slider1" id="slider1" onchange="previewImage(event, 'preview1')">
                    <div class="mt-3 text-center">
                        <img id="preview1"
                             src="{{ $slider && $slider->slider1 ? config('app.storage_url').$slider->slider1 : '' }}"
                             class="rounded-4 {{ $slider && $slider->slider1 ? '' : 'd-none' }}"
                             style="max-height:180px;border:1px solid var(--card-border);transition:all 0.3s;">
                    </div>
                </div>
                <div class="col-md-6">
                    <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:8px;">
                        <i class="bi bi-image" style="color:var(--gold-500);"></i> Slider Image 2
                    </label>
                    <input type="file" accept="image/*" class="fp-form-control" name="slider2" id="slider2" onchange="previewImage(event, 'preview2')">
                    <div class="mt-3 text-center">
                        <img id="preview2"
                             src="{{ $slider && $slider->slider2 ? config('app.storage_url').$slider->slider2 : '' }}"
                             class="rounded-4 {{ $slider && $slider->slider2 ? '' : 'd-none' }}"
                             style="max-height:180px;border:1px solid var(--card-border);transition:all 0.3s;">
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="fp-btn fp-btn-gold"><i class="bi bi-check-lg"></i> Save Sliders</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event, previewId) {
    const preview = document.getElementById(previewId);
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    }
}
</script>
@endsection