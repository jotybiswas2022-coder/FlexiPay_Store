@extends('backend.app')
@section('title', 'Verifications — FlexiPay Admin')
@section('page_title', 'User Verifications')

@push('styles')
<style>
.fp-v-doc { display:flex;align-items:center;gap:8px;color:var(--text-muted);font-size:12px; }
.fp-v-doc i { font-size:18px;color:var(--gold-400); }
.fp-v-doc a { color:var(--gold-400);text-decoration:none; }
.fp-v-doc a:hover { text-decoration:underline; }
.fp-v-num { font-size:11px;color:var(--text-dim);margin-top:2px; }
</style>
@endpush

@section('content')
<div class="fp-table-wrap">
    <div class="fp-table-header"><h5>Pending Verifications</h5></div>
    <table class="fp-table">
        <thead><tr><th>User</th><th>Type</th><th>Document</th><th>Submitted</th><th>Actions</th></tr></thead>
        <tbody>
            @forelse($verifications ?? [] as $v)
            <tr>
                <td>
                    <strong style="color:var(--text-primary);">{{ $v->user?->name ?? 'N/A' }}</strong>
                    <div style="font-size:11px;color:var(--text-dim);">{{ $v->user?->email }}</div>
                </td>
                <td><span class="fp-badge fp-badge-pending">{{ str_replace('_', ' ', ucfirst($v->type)) }}</span></td>
                <td>
                    @if($v->document_path)
                        <div class="fp-v-doc">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                            <a href="{{ asset('storage/'.$v->document_path) }}" target="_blank">View Document</a>
                        </div>
                    @else
                        <span style="color:var(--text-dim);font-size:12px;">No file</span>
                    @endif
                    @if($v->document_number)
                        <div class="fp-v-num">#: {{ $v->document_number }}</div>
                    @endif
                </td>
                <td style="color:var(--text-dim);font-size:12px;">{{ $v->created_at->format('M d, Y h:i A') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <button type="button" class="fp-btn fp-btn-success" style="padding:6px 14px;" onclick="approveVerification({{ $v->id }})">
                            <i class="bi bi-check-lg"></i> Approve
                        </button>
                        <button type="button" class="fp-btn fp-btn-danger" style="padding:6px 14px;" onclick="rejectVerification({{ $v->id }})">
                            <i class="bi bi-x-lg"></i> Reject
                        </button>
                    </div>

                    <form id="approve-form-{{ $v->id }}" action="{{ route('admin.users.verifications.update', $v->id) }}" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="status" value="verified">
                    </form>

                    <form id="reject-form-{{ $v->id }}" action="{{ route('admin.users.verifications.update', $v->id) }}" method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <textarea name="rejection_reason" id="rejection_reason_{{ $v->id }}" style="display:none;"></textarea>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function approveVerification(id) {
    Swal.fire({
        title: 'Approve Verification?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4ade80',
        cancelButtonColor: '#52525B',
        confirmButtonText: 'Yes, approve',
        cancelButtonText: 'Cancel',
        background: '#1A1A1E',
        color: '#F4F4F5',
    }).then((r) => {
        if (r.isConfirmed) {
            document.getElementById('approve-form-' + id).submit();
        }
    });
}

function rejectVerification(id) {
    Swal.fire({
        title: 'Reject Verification?',
        input: 'textarea',
        inputPlaceholder: 'Reason for rejection (required)',
        inputAttributes: { required: true },
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#52525B',
        confirmButtonText: 'Reject',
        cancelButtonText: 'Cancel',
        background: '#1A1A1E',
        color: '#F4F4F5',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Please enter a rejection reason';
            }
        },
        customClass: {
            input: 'swal-dark-input'
        }
    }).then((r) => {
        if (r.isConfirmed) {
            document.getElementById('rejection_reason_' + id).value = r.value;
            document.getElementById('reject-form-' + id).submit();
        }
    });
}
</script>
<style>
.swal-dark-input { background:#121214 !important;color:#F4F4F5 !important;border:1px solid #3A3A3E !important;border-radius:8px !important;padding:10px 12px !important;font-family:inherit !important;font-size:14px !important; }
.swal-dark-input:focus { border-color:#EAB308 !important;box-shadow:0 0 0 2px rgba(234,179,8,0.15) !important; }
</style>
@endpush