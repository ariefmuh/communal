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
    <section class="content-header">
        <table id="requestTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nomor WA</th>
                    <th>Alamat</th>
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
                        <td>{{ $r->no_wa }}</td>
                        <td>{{ $r->alamat }}</td>
                        <td>{{ $r->email }}</td>
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
                            <form action="{{ route('dashboard.request.destroy', $r->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form action="{{ route('dashboard.request.update', $r->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
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

