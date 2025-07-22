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
                    <h1>Blogs</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content-header">
        <table id="requestTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $b)
                    <tr>
                        <td>{{ $b->id }}</td>
                        <td>{{ Str::limit($b->title, 20, '...') }}</td>
                        <td>{{ Str::limit($b->opening, 50, '...')}}</td>
                        <td>
                            <button
                                class="btn btn-primary btn-sm view-pdf"
                                data-bs-toggle="modal"
                                data-bs-target="#pdfModal{{$b->id}}"
                                data-file="{{ asset('assets/dashboard/request/' . $b->request_file) }}">
                                View Picture
                            </button>
                        </td>
                        <td class="align-middle">
                            {{-- Form untuk Tombol Delete. Diberi style "display: inline;" agar sejajar. --}}
                            <form action="{{ route('dashboard.request.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline;">
                                @csrf
                                {{-- Penting: Gunakan method DELETE untuk route destroy --}}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">Delete</button>
                            </form>

                            {{-- Tombol untuk See Blog --}}
                            <a href="{{ route('blogs', $b->id) }}" class="btn btn-success">
                                See Blog
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($blogs as $b)
            <div class="modal fade" id="pdfModal{{$b->id}}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" style="max-width: 90%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Preview File</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="PictureViewer" src="{{ asset('assets/img/blogs/' . $b->picture) }}" width="100%" height="600px" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection

