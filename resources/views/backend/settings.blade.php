@extends('backend.app')
@section('title', 'Settings — FlexiPay Admin')
@section('page_title', 'Settings')

@section('content')

@if(session('success'))
<div class="fp-table-wrap mb-4" style="border-left:3px solid #4ade80;">
    <div class="p-3" style="color:#4ade80;font-size:14px;">
        <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
    </div>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="fp-table-wrap">
            <div class="fp-table-header"><h5><i class="bi bi-gear-fill"></i> General Settings</h5></div>
            <div style="padding:24px;">
                <form action="{{ url('admin/settings') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">
                                <i class="bi bi-envelope-fill" style="color:var(--gold-500);"></i> Email
                            </label>
                            <input type="email" name="email" class="fp-form-control" value="{{ $settings?->email ?? '' }}" placeholder="Enter email">
                        </div>
                        <div class="col-md-6">
                            <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">
                                <i class="bi bi-telephone-fill" style="color:var(--gold-500);"></i> Phone
                            </label>
                            <input type="text" name="phone" class="fp-form-control" value="{{ $settings?->phone ?? '' }}" placeholder="Enter phone number">
                        </div>
                        <div class="col-md-6">
                            <label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">
                                <i class="bi bi-geo-alt-fill" style="color:var(--gold-500);"></i> Location
                            </label>
                            <input type="text" name="location" class="fp-form-control" value="{{ $settings?->location ?? '' }}" placeholder="Enter location">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="fp-btn fp-btn-gold"><i class="bi bi-check-lg"></i> Save Settings</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection