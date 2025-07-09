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
                <h1>Request</h1>
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
    <table id="requestTable" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor WA</th>
                <th>Alamat</th>
                <th>Category</th>
                <th>File PDF</th>
                <th>Progress</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->email }}</td>
                <td>{{ $r->no_wa }}</td>
                <td>{{ $r->alamat }}</td>
                <td>{{ $r->category }}</td>
                <td>
                    <button
                        class="btn btn-primary btn-sm view-pdf"
                        data-bs-toggle="modal"
                        data-bs-target="#pdfModal{{$r->id}}"
                        data-file="{{ asset('assets/pdf/requests/' . $r->proposal) }}">
                        View PDF
                    </button>
                </td>
                <td>
                    @if ($r->progress == 0)
                    <span class="badge bg-warning">Pending</span>
                    @else
                    <span class="badge bg-success">Accepted</span>
                    @endif
                </td>
                <td>
                    @if(auth()->user()->role == "guest")
                    {{-- Guest can edit and delete their own requests if not accepted --}}
                    @if($r->progress == 0)
                    <div class="d-flex gap-1">
                        <a href="{{ route('dashboard.request.edit', $r->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dashboard.request.destroy', $r->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    @else
                    <span class="text-muted">No action available</span>
                    @endif
                    @else
                    {{-- Superuser can accept/deny requests --}}
                    <div class="d-flex gap-1">
                        @if($r->progress == 0)
                        <form action="{{ route('dashboard.request.accept', $r->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i> Accept
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('dashboard.request.destroy', $r->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this request?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($requests as $r)
    <div class="modal fade" id="pdfModal{{$r->id}}" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" style="max-width: 90%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Preview File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="pdfViewer" src="{{ asset('assets/pdf/requests/' . $r->proposal) }}" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection