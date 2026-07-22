@extends('backend.app')
@section('title', 'New Campaign — FlexiPay Admin')
@section('page_title', 'New Campaign')

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Create Campaign</h5></div>
    <div style="padding:24px;">
        <form action="{{ route('admin.campaigns.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-6"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Campaign Title</label><input type="text" name="title" class="fp-form-control" required></div>
                <div class="col-md-6"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Type</label><select name="type" class="fp-form-control"><option value="email">Email</option><option value="sms">SMS</option><option value="both">Both</option></select></div>
                <div class="col-12"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Message Content</label><textarea name="message" class="fp-form-control" rows="6" required></textarea></div>
                <div class="col-md-6"><label style="display:block;font-size:12px;color:var(--text-dim);margin-bottom:6px;">Target Segment</label><select name="segment" class="fp-form-control"><option value="all">All Customers</option><option value="active">Active Customers</option><option value="overdue">Overdue Payments</option></select></div>
                <div class="col-12"><button type="submit" class="fp-btn fp-btn-gold"><i class="bi bi-check-lg"></i> Save Campaign</button></div>
            </div>
        </form>
    </div>
</div>
@endsection