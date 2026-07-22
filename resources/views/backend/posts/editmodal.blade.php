@if ($errors->any())
<div class="alert alert-danger mb-2">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <!-- Header -->
            <div class="modal-header bg-gradient-primary text-white rounded-top-4">
                <h5 class="modal-title fw-semibold">
                    <i class="bi bi-pencil-square me-2"></i> Edit Worker
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form id="editForm{{ $post->id }}" action="{{ route('workers.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Contact Number (FIXED name) -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Contact Number</label>
                            <input type="number" class="form-control" name="contact_number" value="{{ $post->contact_number }}" required>
                        </div>

                        <!-- Division (IMPROVED) -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Division</label>
                            <select name="division" class="form-select" required>
                                <option value="">Select Division</option>
                                <option value="Khulna" {{ $post->division == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                <option value="Dhaka" {{ $post->division == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                <option value="Chittagong" {{ $post->division == 'Chittagong' ? 'selected' : '' }}>Chittagong</option>
                                <option value="Rajshahi" {{ $post->division == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                <option value="Sylhet" {{ $post->division == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                <option value="Barishal" {{ $post->division == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                <option value="Mymensingh" {{ $post->division == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                <option value="Rangpur" {{ $post->division == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- File Upload -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold"> Profile Image </label>
                            <input type="file" class="form-control" id="editFile{{ $post->id }}" name="file" accept="image/*">

                            @if($post->file)
                            <div class="mt-2">
                                <small class="text-muted">Current File</small><br>

                                @php
                                    $ext = strtolower(pathinfo($post->file, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                    $isVideo = $ext === 'mp4';
                                @endphp

                                @if($isImage)
                                    <a href="#" class="media-preview"
                                       data-bs-toggle="modal"
                                       data-bs-target="#mediaModal"
                                       data-type="image"
                                       data-src="{{ config('app.storage_url') }}{{ $post->file }}">
                                        <img src="{{ config('app.storage_url') }}{{ $post->file }}"
                                             class="img-thumbnail"
                                             style="width:50px;height:50px;object-fit:cover;">
                                    </a>
                                @elseif($isVideo)
                                    <a href="#" class="media-preview"
                                       data-bs-toggle="modal"
                                       data-bs-target="#mediaModal"
                                       data-type="video"
                                       data-src="{{ config('app.storage_url') }}{{ $post->file }}">
                                        <video class="img-thumbnail"
                                               style="width:50px;height:50px;object-fit:cover;"
                                               src="{{ config('app.storage_url') }}{{ $post->file }}"
                                               muted></video>
                                    </a>
                                @endif
                            </div>
                            @endif

                            <div class="mt-2">
                                <img id="editPreview{{ $post->id }}" class="img-fluid rounded shadow-sm d-none" style="max-height:120px;">
                            </div>
                        </div>

                        <!-- Progress -->
                        <div class="col-12">
                            <div class="progress d-none" id="progressBox{{ $post->id }}">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                     id="progressBar{{ $post->id }}"
                                     style="width:0%">0%</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary rounded-pill" id="submitBtn{{ $post->id }}">
                        <i class="bi bi-save me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    const form = document.getElementById('editForm{{ $post->id }}');
    const btn = document.getElementById('submitBtn{{ $post->id }}');
    const progressBox = document.getElementById('progressBox{{ $post->id }}');
    const progressBar = document.getElementById('progressBar{{ $post->id }}');

    form.addEventListener('submit', function(e){

        let formData = new FormData(form);

        // 🔥 IMPORTANT (PUT spoof fix)
        formData.append('_method', 'PUT');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);

        btn.disabled = true;
        progressBox.classList.remove('d-none');

        xhr.upload.onprogress = function(e){
            if(e.lengthComputable){
                let percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.innerHTML = percent + '%';
            }
        };

        xhr.onload = function(){
            btn.disabled = false;
            progressBox.classList.add('d-none');

            let res = JSON.parse(xhr.responseText);

            if(res.status){
                location.reload(); // ✅ reload
            } else {
                alert(res.message || 'Update failed!');
            }
        };

        xhr.onerror = function(){
            alert('Server error!');
            btn.disabled = false;
        };

        xhr.send(formData);
    });

});

    // Media Preview
    document.querySelectorAll('.media-preview').forEach(el=>{
        el.addEventListener('click', function(){
            const type = this.dataset.type;
            const src = this.dataset.src;

            const img = document.getElementById('mediaImage');
            const video = document.getElementById('mediaVideo');
            const videoSrc = document.getElementById('mediaVideoSource');

            img.classList.add('d-none');
            video.classList.add('d-none');

            if(type === 'image'){
                img.src = src;
                img.classList.remove('d-none');
            } else {
                videoSrc.src = src;
                video.load();
                video.classList.remove('d-none');
            }
        });
    });

});
</script>

<style>
.bg-gradient-primary{
    background: linear-gradient(45deg,#4f46e5,#6366f1);
}
.progress{
    height:20px;
    margin-top:10px;
}
</style>