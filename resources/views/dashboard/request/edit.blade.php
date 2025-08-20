@extends('dashboardmaster')

@section('title')
Edit Request
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Request</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.request') }}">Request</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Request Details</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.request.update', $request->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="kategori">Category <span class="text-danger">*</span></label>
                                <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    <option value="">Select Category</option>
                                    <option value="Arts" {{ old('kategori', $request->category) == 'Arts' ? 'selected' : '' }}>Arts</option>
                                    <option value="Sports" {{ old('kategori', $request->category) == 'Sports' ? 'selected' : '' }}>Sports</option>
                                    <option value="Music" {{ old('kategori', $request->category) == 'Music' ? 'selected' : '' }}>Music</option>
                                    <option value="Tambah Social Movement" {{ old('kategori') == 'Tambah Social Movement' ? 'selected' : '' }}>Tambah Social Movement</option>
                                    <option value="Education" {{ old('kategori') == 'Education' ? 'selected' : '' }}>Education</option>
                                    <option value="Games" {{ old('kategori') == 'Games' ? 'selected' : '' }}>Games</option>
                                    <option value="Others" {{ old('kategori', $request->category) == 'Others' ? 'selected' : '' }}>Others</option>
                                </select>
                                @error('kategori')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="proposal">Current Proposal File:</label>
                                <div class="mb-2">
                                    <a href="{{ asset('assets/pdf/requests/' . $request->proposal) }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Current File
                                    </a>
                                    <span class="ml-2 text-muted">{{ $request->proposal }}</span>
                                </div>

                                <label for="proposal">Upload New Proposal (PDF) <span class="text-muted">(optional)</span></label>
                                <input type="file" class="form-control @error('proposal') is-invalid @enderror" id="proposal" name="proposal" accept=".pdf">
                                <small class="form-text text-muted">Leave empty to keep current file. Maximum file size: 32MB</small>
                                @error('proposal')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Request
                                </button>
                                <a href="{{ route('dashboard.request') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Request Information</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">ID:</dt>
                            <dd class="col-sm-8">{{ $request->id }}</dd>

                            <dt class="col-sm-4">Status:</dt>
                            <dd class="col-sm-8">
                                @if ($request->progress == 0)
                                <span class="badge badge-warning">Pending</span>
                                @else
                                <span class="badge badge-success">Accepted</span>
                                @endif
                            </dd>

                            <dt class="col-sm-4">Created:</dt>
                            <dd class="col-sm-8">{{ $request->created_at->format('d M Y H:i') }}</dd>

                            <dt class="col-sm-4">Updated:</dt>
                            <dd class="col-sm-8">{{ $request->updated_at->format('d M Y H:i') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
