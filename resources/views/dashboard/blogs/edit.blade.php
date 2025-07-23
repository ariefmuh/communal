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
    <img id="blogImage" src="{{ asset('assets/img/blogs/' . $blog->picture) }}"
        alt="..."
        style="float: left; width: 500px; height: auto; margin-right: 20px; margin-bottom: 10px; border: 2px solid black; border-radius: 8px;"
        data-bs-toggle="modal" data-bs-target="#editImageModal" />

    <header class="mb-4">
        <h1 class="fw-bolder mb-1"><span id="title">{{ $blog->title }}</span> <a class="badge bg-secondary text-decoration-none link-light fs-5" href="#!" data-bs-toggle="modal" data-bs-target="#editTitleModal"><i class="fas fa-pencil-alt"></i></a> </h1>

        <div class="text-muted fst-italic mb-2">Posted on {{ Carbon::parse($blog->created_at)->format('M d, Y')}} by {{ $blog->author }}</div>
        <div class="mb-2">
            <span id="tags">
                @foreach ($tags as $t)
                <span class="badge bg-secondary me-1 tag-item" data-tag-name="{{ $t->name_tag }}">
                    #{{ $t->name_tag }}
                    <button type="button" class="btn btn-sm btn-outline-light ms-1 edit-tag-btn"
                        data-tag-name="{{ $t->name_tag }}"
                        style="font-size: 0.75em; padding: 2px 4px; border: none;"
                        title="Edit tag">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="button" class="btn-close btn-close-white btn-sm ms-1 delete-tag-btn"
                        data-tag-name="{{ $t->name_tag }}"
                        style="font-size: 0.75em;"
                        title="Delete tag">×</button>
                </span>
                @endforeach
            </span>
            <a class="badge bg-success text-decoration-none link-light" href="#!" data-bs-toggle="modal" data-bs-target="#addTagModal">Add Tag +</a>
        </div>
    </header>
    <p class="mb-4"><span id="blog_description">{{ $blog->opening }}</span> <a class="badge bg-secondary text-decoration-none link-light" href="#!" data-bs-toggle="modal" data-bs-target="#editDescriptionModal"><i class="fas fa-pencil-alt"></i></a></p>

    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSectioneModal">Add New Section</button>
    </div>
    <div class="blog-section" id="sections">
        @foreach ($section as $s)
        <div class="mb-4" id="sections-{{ $s->id }}">
            <h2 class="fw-bold mt-4 fs-5 blog-section-title">{{ $s->title }}</h2>
            <p class="mb-4 blog-section-description">{{ $s->description }}</p>
            <div class="btn-group">
                <button class="btn btn-warning btn-sm edit-section-btn"
                    data-section-id="{{ $s->id }}"
                    data-section-title="{{ $s->title }}"
                    data-section-description="{{ $s->description }}">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="removeSection({{ $s->id }})">Remove</button>
            </div>
        </div>
        @endforeach
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
                    <input type="file" class="form-control" id="newImage" accept="image/*" value="{{ asset('assets/img/blogs/' . $blog->picture) }}">
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
                    <input type="text" class="form-control" id="newTitle" placeholder="Enter new title" value="{{ $blog->title }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewTitle">Save Title</button>
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
                    <textarea class="form-control" id="newDescription" placeholder="Enter new description" rows="3">{{ $blog->opening }}</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewDescription">Save Description</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newTagName" class="form-label">Tag Name</label>
                    <input type="text" class="form-control" id="newTagName" placeholder="Enter tag name">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveNewTag">Add Tag</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editTagName" class="form-label">Tag Name</label>
                    <input type="text" class="form-control" id="editTagName" placeholder="Enter tag name">
                </div>
                <input type="hidden" id="originalTagName">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditTag">Save Changes</button>
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
                    <label for="newSectionTitle" class="form-label">New Title</label>
                    <input type="text" class="form-control" id="newSectionTitle" placeholder="Enter new title">
                </div>
                <div class="mb-3">
                    <label for="newSectionDescription" class="form-label">New Description</label>
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

<div class="modal fade" id="editSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editSectionTitle" class="form-label">Section Title</label>
                    <input type="text" class="form-control" id="editSectionTitle" placeholder="Enter section title">
                </div>
                <div class="mb-3">
                    <label for="editSectionDescription" class="form-label">Section Description</label>
                    <textarea class="form-control" id="editSectionDescription" placeholder="Enter section description" rows="3"></textarea>
                </div>
                <input type="hidden" id="editSectionId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditSection">Save Changes</button>
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
        if (sectionId.toString().startsWith('new-')) {
            $(`#section-${sectionId}`).remove();
        } else {
            $(`#sections-${sectionId}`).remove();
        }
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

        $('#saveNewDescription').click(function() {
            var newDescription = $('#newDescription').val();
            if (newDescription !== '') {
                $('#blog_description').text(newDescription);
                $('#editDescriptionModal').modal('hide');
            }
        });

        $('#saveNewTag').click(function() {
            var newTagName = $('#newTagName').val().trim();
            if (newTagName !== '') {
                var tagHtml = `
                    <span class="badge bg-secondary me-1 tag-item" data-tag-name="${newTagName}">
                        #${newTagName}
                        <button type="button" class="btn btn-sm btn-outline-light ms-1 edit-tag-btn"
                                data-tag-name="${newTagName}"
                                style="font-size: 0.75em; padding: 2px 4px; border: none;"
                                title="Edit tag">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn-close btn-close-white btn-sm ms-1 delete-tag-btn"
                                data-tag-name="${newTagName}"
                                style="font-size: 0.75em;"
                                title="Delete tag">×</button>
                    </span>
                `;
                $('#tags').append(tagHtml);
                $('#addTagModal').modal('hide');
                $('#newTagName').val('');
            }
        });

        // Handle individual tag editing
        $(document).on('click', '.edit-tag-btn', function() {
            var tagName = $(this).data('tag-name');
            $('#originalTagName').val(tagName);
            $('#editTagName').val(tagName);
            $('#editTagModal').modal('show');
        });

        // Handle individual tag deletion
        $(document).on('click', '.delete-tag-btn', function() {
            if (confirm('Are you sure you want to delete this tag?')) {
                var tagName = $(this).data('tag-name');
                $(`.tag-item[data-tag-name="${tagName}"]`).remove();
            }
        });

        // Save edited tag
        $('#saveEditTag').click(function() {
            var originalTagName = $('#originalTagName').val();
            var newTagName = $('#editTagName').val().trim();

            if (newTagName !== '' && newTagName !== originalTagName) {
                var tagElement = $(`.tag-item[data-tag-name="${originalTagName}"]`);
                tagElement.attr('data-tag-name', newTagName);
                tagElement.find('.edit-tag-btn').attr('data-tag-name', newTagName);
                tagElement.find('.delete-tag-btn').attr('data-tag-name', newTagName);
                tagElement.contents().first()[0].textContent = `#${newTagName}`;

                $('#editTagModal').modal('hide');
            }
        });

        // Clear form when modals close
        $('#addTagModal').on('hidden.bs.modal', function() {
            $('#newTagName').val('');
        });

        $('#editTagModal').on('hidden.bs.modal', function() {
            $('#editTagName').val('');
            $('#originalTagName').val('');
        });

        $('#editSectionModal').on('hidden.bs.modal', function() {
            $('#editSectionTitle').val('');
            $('#editSectionDescription').val('');
            $('#editSectionId').val('');
        });

        $('#addSectioneModal').on('hidden.bs.modal', function() {
            $('#newSectionTitle').val('');
            $('#newSectionDescription').val('');
        });

        // Handle edit section buttons
        $(document).on('click', '.edit-section-btn', function() {
            var sectionId = $(this).data('section-id');
            var sectionTitle = $(this).data('section-title');
            var sectionDescription = $(this).data('section-description');

            $('#editSectionId').val(sectionId);
            $('#editSectionTitle').val(sectionTitle);
            $('#editSectionDescription').val(sectionDescription);
            $('#editSectionModal').modal('show');
        });

        // Save edited section
        $('#saveEditSection').click(function() {
            var sectionId = $('#editSectionId').val();
            var newTitle = $('#editSectionTitle').val();
            var newDescription = $('#editSectionDescription').val();

            if (newTitle !== '' && newDescription !== '') {
                var sectionSelector = sectionId.toString().startsWith('new-') ? `#section-${sectionId}` : `#sections-${sectionId}`;

                $(`${sectionSelector} .blog-section-title`).text(newTitle);
                $(`${sectionSelector} .blog-section-description`).text(newDescription);

                // Update data attributes for future edits
                $(`${sectionSelector} .edit-section-btn`).attr('data-section-title', newTitle);
                $(`${sectionSelector} .edit-section-btn`).attr('data-section-description', newDescription);

                $('#editSectionModal').modal('hide');
            }
        });

        newSectionId = 0;
        $('#saveNewSection').click(function() {
            var newSectionTitle = $('#newSectionTitle').val();
            var newSectionDescription = $('#newSectionDescription').val();
            if (newSectionTitle !== '' && newSectionDescription !== '') {
                var newSectionHtml = `
                    <div class="mb-4" id="section-new-${newSectionId}">
                        <h2 class="fw-bold mt-4 fs-5 blog-section-title">${newSectionTitle}</h2>
                        <p class="mb-4 blog-section-description">${newSectionDescription}</p>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm edit-section-btn"
                                data-section-id="new-${newSectionId}"
                                data-section-title="${newSectionTitle}"
                                data-section-description="${newSectionDescription}">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="removeSection('new-${newSectionId}')">Remove</button>
                        </div>
                    </div>
                `;
                $('#sections').append(newSectionHtml);
                $('#addSectioneModal').modal('hide');
                $('#newSectionTitle').val('');
                $('#newSectionDescription').val('');
                newSectionId++;
            }
        });
        $('#saveChanges').click(function() {
            var newImageUrl = $('#newImage')[0].files[0];
            var newTitle = $('#newTitle').val() || $('#title').text();
            var newDescription = $('#newDescription').val() || $('#blog_description').text();

            // Get tags from the individual tag elements
            var tagsArray = [];
            $('.tag-item').each(function() {
                var tagName = $(this).data('tag-name');
                if (tagName) {
                    tagsArray.push(tagName);
                }
            });

            var sections = [];
            $('.blog-section div[id^="sections-"], .blog-section div[id^="section-new-"]').each(function() {
                var title = $(this).find('.blog-section-title').text().trim();
                var description = $(this).find('.blog-section-description').text().trim();
                if (title && description) {
                    sections.push({
                        title: title,
                        description: description
                    });
                }
            });

            // Validation
            if (!newTitle) {
                alert('Please enter a blog title');
                return;
            }
            if (!newDescription) {
                alert('Please enter a blog description');
                return;
            }
            if (tagsArray.length === 0) {
                alert('Please add at least one tag');
                return;
            }
            if (sections.length === 0) {
                alert('Please add at least one section');
                return;
            }

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            if (newImageUrl) {
                formData.append('image', newImageUrl);
            }
            formData.append('title', newTitle);
            formData.append('description', newDescription);
            formData.append('tags', JSON.stringify(tagsArray));
            formData.append('sections', JSON.stringify(sections));

            console.log('Sending data:', {
                title: newTitle,
                description: newDescription,
                tags: tagsArray,
                sections: sections
            });

            $.ajax({
                url: '{{ route("dashboard.blog.update", $blog->id) }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Blog updated successfully!');
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error response:', xhr.responseText);
                    var errorMessage = 'An error occurred while saving changes.';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        errorMessage = 'Validation errors:\n';
                        for (var field in errors) {
                            errorMessage += '- ' + errors[field].join('\n- ') + '\n';
                        }
                    } else if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }

                    alert(errorMessage);
                }
            });
        });
    });
</script>
@endsection