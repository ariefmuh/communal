@extends('dashboardmaster')

@section('title')
Request Dashboard
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Homepages Layout</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

{{-- Flash Messages --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<section class="content-header">
    <div class="mb-3">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createHomepageModal">
            <i class="fas fa-plus"></i> Create Homepage
        </button>
    </div>
    <div style="overflow-x:auto;">
    <table id="requestTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Title</th>
                <th>Picture</th>
                <th>Link</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($homepages as $h)
            <tr>
                <td>{{ $h->id }}</td>
                <td>{{ $h->name }}</td>
                <td>{{ $h->title }}</td>
                <td>{{ $h->picture }}</td>
                <td>{{ $h->link }}</td>
                <td>
                    @php
                        $desc = strip_tags($h->description);
                    @endphp
                    @if(strlen($desc) > 50)
                        {{ substr($desc, 0, 50) }}... <a href="#" data-bs-toggle="modal" data-bs-target="#descModal{{$h->id}}">see more</a>
                        <!-- Modal for full description -->
                        <div class="modal fade" id="descModal{{$h->id}}" tabindex="-1" aria-labelledby="descModalLabel{{$h->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="descModalLabel{{$h->id}}">Full Description</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $desc }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{ $desc }}
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('dashboard.request.edit', $h->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.request.destroy', $h->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>

    @foreach ($homepages as $h)
    <div class="modal fade" id="pdfModal{{$h->id}}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Preview File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="{{ asset('assets/pdf/requests/' . $h->picture) }}" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Create Homepage Modal -->
    <div class="modal fade" id="createHomepageModal" tabindex="-1" aria-labelledby="createHomepageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createHomepageModalLabel">Create Homepage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.homepage.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="picture" class="form-label">Picture (PDF or Image)</label>
                            <input type="file" class="form-control" id="picture" name="picture" accept=".pdf,image/*">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" class="form-control" id="link" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    $(document).ready(function() {
        $('#requestTable').DataTable({
            "pageLength": 5
        });
    });
</script>
@endsection
@endsection
