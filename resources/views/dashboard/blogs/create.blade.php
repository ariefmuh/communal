@extends('adminblogmaster')
@section('title')
    Blog Title
@endsection
@section('styles')
    <link href="{{ asset('invent/assets/css/main.css') }}" rel="stylesheet">
@endsection

@section('content')
@php use Illuminate\Support\Carbon;
@endphp
<article style="text-align: justify;">
    <img id="blogImage" src="https://dummyimage.com/500x600/ced4da/6c757d.jpg"
         alt="..."
         style="float: left; width: 500px; height: auto; margin-right: 20px; margin-bottom: 10px; border: 2px solid black; border-radius: 8px;"
         data-bs-toggle="modal" data-bs-target="#editImageModal" />

    <header class="mb-4">
        <h1 class="fw-bolder mb-1"><span id="title">Blog Title</span> <a class="badge bg-secondary text-decoration-none link-light fs-5" href="#!" data-bs-toggle="modal" data-bs-target="#editTitleModal"><i class="fas fa-pencil-alt"></i></a> </h1>

        <div class="text-muted fst-italic mb-2">Posted on {{$today}} by <span id="author">{{ $author }}</span> <a class="badge bg-secondary text-decoration-none link-light" href="#!" data-bs-toggle="modal" data-bs-target="#editAuthorModal"><i class="fas fa-pencil-alt"></i></a></div>
        <div class="mb-2">
            <span id="tags">
                <a class="badge bg-secondary text-decoration-none link-light" href="#!">#tag1</a>
                <a class="badge bg-secondary text-decoration-none link-light" href="#!">#tag2</a>
            </span>
            <a class="badge bg-success text-decoration-none link-light" href="#!" data-bs-toggle="modal" data-bs-target="#addTagsModal">Add Tags +</a>
        </div>
    </header>
    <p class="mb-4"><span id="blog_description">Blogs description here</span> <a class="badge bg-secondary text-decoration-none link-light" href="#!" data-bs-toggle="modal" data-bs-target="#editDescriptionModal"><i class="fas fa-pencil-alt"></i></a></p>

    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSectioneModal">Add New Section</button>
    </div>
    <div class="mb-4" id="sections">
        <div>
            <h2 class="fw-bold mt-4 fs-5">Section Title</h2>
            <p class="mb-4">Section Description</p>
        </div>
    </div>

</article>

<div class="modal fade" id="editImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="file" class="form-control" id="newImage" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewImage">Save Image</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTitleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTitle" class="form-label">New Title</label>
                    <input type="text" class="form-control" id="newTitle" placeholder="Enter new title">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewTitle">Save Title</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editAuthorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newAuthor" class="form-label">New Author</label>
                    <input type="text" class="form-control" id="newAuthor" placeholder="Enter new author">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewAuthor">Save Author</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editDescriptionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newDescription" class="form-label">New Description</label>
                    <textarea class="form-control" id="newDescription" placeholder="Enter new description" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewDescription">Save Description</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTagsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Tags</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTags" class="form-label">New Tags</label>
                    <input type="text" class="form-control" id="newTags" placeholder="Enter new tags (comma separated)">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewTags">Save Tags</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSectioneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTitle" class="form-label">New Title</label>
                    <input type="text" class="form-control" id="newSectionTitle" placeholder="Enter new title">
                </div>
                <div class="mb-3">
                    <label for="newDescription" class="form-label">New Description</label>
                    <textarea class="form-control" id="newSectionDescription" placeholder="Enter new description" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewSection">Add New Section</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('invent/assets/js/main.js') }}"></script>
    <script>
        function removeSection(sectionId) {
            $(`#section-${sectionId}`).remove();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#saveNewImage').click(function() {
                var newImageUrl = $('#newImage')[0].files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blogImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(newImageUrl);
                $('#editImageModal').modal('hide');
            });
            $('#saveNewTitle').click(function() {
                var newTitle = $('#newTitle').val();
                if (newTitle !== '') {
                    $('#title').text(newTitle);
                    $('#editTitleModal').modal('hide');
                }
            });
            $('#saveNewAuthor').click(function() {
                var newAuthor = $('#newAuthor').val();
                if (newAuthor !== '') {
                    $('#author').text(newAuthor);
                    $('#editAuthorModal').modal('hide');
                }
            });
            $('#saveNewDescription').click(function() {
                var newDescription = $('#newDescription').val();
                if (newDescription !== '') {
                    $('#blog_description').text(newDescription);
                    $('#editDescriptionModal').modal('hide');
                }
            });
            $('#saveNewTags').click(function() {
                var newTags = $('#newTags').val();
                if (newTags !== '') {
                    var tagsArray = newTags.split(',').map(tag => tag.trim());
                    var tagsHtml = tagsArray.map(tag => `<a class="badge bg-secondary text-decoration-none link-light" href="#!">${tag}</a>`).join(' ');
                    $('#tags').html(tagsHtml);
                    $('#addTagsModal').modal('hide');
                }
            });
            newSectionId = 0;
            $('#saveNewSection').click(function() {
                var newSectionTitle = $('#newSectionTitle').val();
                var newSectionDescription = $('#newSectionDescription').val();
                if (newSectionTitle !== '' && newSectionDescription !== '') {
                    var newSectionHtml = `
                        <div class="blog-section" id="section-${newSectionId}">
                            <h2 class="fw-bold mt-4 fs-5 blog-section-title">${newSectionTitle}</h2>
                            <p class="mb-4 blog-section-description">${newSectionDescription}</p>
                            <button class="btn btn-danger" onclick="removeSection(${newSectionId++})">Remove</button>
                        </div>
                    `;
                    $('#sections').append(newSectionHtml);
                    $('#addSectioneModal').modal('hide');
                }
            });
            $('#saveChanges').click(function() {
                var newImageUrl = $('#newImage')[0].files[0];
                var newTitle = $('#newTitle').val();
                var newAuthor = $('#newAuthor').val();
                var newDescription = $('#newDescription').val();
                var tagsArray = $('#newTags').val().split(',').map(tag => tag.trim());
                var sections = [];

                $('.blog-section').each(function() {
                    sections.push({
                        title: $(this).find('.blog-section-title').text(),
                        description: $(this).find('.blog-section-description').text()
                    });
                });

                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('image', newImageUrl);
                formData.append('title', newTitle);
                formData.append('author', newAuthor);
                formData.append('description', newDescription);
                formData.append('tags', JSON.stringify(tagsArray));
                formData.append('sections', JSON.stringify(sections));
                console.log(formData);
                $.ajax({
                    url: '{{ route("dashboard.blog.store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert('Changes saved successfully!');
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while saving changes.');
                    }
                });
            });
        });
    </script>
@endsection


