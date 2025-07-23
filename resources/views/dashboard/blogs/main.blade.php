@extends('dashboardmaster')

@section('title')
Blog Dashboard
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blogs Management</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{ route('dashboard.blog.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Blog
                    </a>
                </div>
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
    <div class="table-responsive">
        <table id="blogTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ Str::limit($b->title, 30, '...') }}</td>
                    <td>{{ $b->author }}</td>
                    <td>{{ Str::limit($b->opening, 50, '...')}}</td>
                    <td>
                        <button
                            class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal{{$b->id}}">
                            <i class="fas fa-eye"></i> View Picture
                        </button>
                    </td>
                    <td>{{ $b->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            {{-- View Blog Button --}}
                            <a href="{{ route('blogs', $b->id) }}" class="btn btn-success btn-sm" target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>

                            {{-- Edit Blog Button --}}
                            <a href="{{ route('dashboard.blog.edit', $b->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            {{-- Delete Blog Button --}}
                            <form action="{{ route('dashboard.blog.destroy', $b->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this blog? This action cannot be undone.');"
                                style="display: inline;">
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

    {{-- Image Preview Modals --}}
    @foreach ($blogs as $b)
    <div class="modal fade" id="imageModal{{$b->id}}" tabindex="-1" aria-labelledby="imageModalLabel{{$b->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel{{$b->id}}">{{ $b->title }} - Blog Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('assets/img/blogs/' . $b->picture) }}"
                        alt="{{ $b->title }}"
                        class="img-fluid"
                        style="max-height: 500px;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#blogTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#blogTable_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection