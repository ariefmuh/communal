@extends('dashboardmaster')

@section('title', 'Add Gallery Photos')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Gallery Photos</h3>
                </div>
                <form action="{{ route('dashboard.gallery.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
                    @csrf
                    <div class="card-body">
                        <div id="galleries-container">
                            <!-- Gallery items will be added here dynamically -->
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-success" id="add-photo">Add Photo</button>
                            <button type="button" class="btn btn-info" id="add-bulk">Add 5 Photos</button>
                            <span class="ml-3 text-muted">Photos added: <span id="photo-count">0</span></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="submit-btn" disabled>Submit Photos</button>
                        <a href="{{ route('dashboard.gallery') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let photoIndex = 0;
    const container = document.getElementById('galleries-container');
    const countSpan = document.getElementById('photo-count');
    const submitBtn = document.getElementById('submit-btn');

    function addPhoto() {
        const photoDiv = document.createElement('div');
        photoDiv.className = 'row mb-3 photo-row border p-3 rounded';
        photoDiv.innerHTML = `
            <div class="col-md-5">
                <label class="form-label">Photo</label>
                <input type="file" class="form-control" name="galleries[${photoIndex}][photo]" accept="image/*" required>
                <small class="text-muted">Max size: 2MB (JPEG, PNG, JPG, GIF)</small>
            </div>
            <div class="col-md-5">
                <label class="form-label">Caption</label>
                <input type="text" class="form-control" name="galleries[${photoIndex}][caption]" placeholder="Photo Caption" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-photo">Remove</button>
            </div>
        `;

        container.appendChild(photoDiv);
        photoIndex++;
        updateCount();
    }

    function updateCount() {
        const count = container.querySelectorAll('.photo-row').length;
        countSpan.textContent = count;
        submitBtn.disabled = count < 1;
    }

    document.getElementById('add-photo').addEventListener('click', addPhoto);

    document.getElementById('add-bulk').addEventListener('click', function() {
        for (let i = 0; i < 5; i++) {
            addPhoto();
        }
    });

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-photo')) {
            e.target.closest('.photo-row').remove();
            updateCount();
        }
    });

    // Add initial photo
    addPhoto();
});
</script>
@endsection
