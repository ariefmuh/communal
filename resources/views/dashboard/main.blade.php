@extends('dashboardmaster')

@section('title')
Dashboard Communal
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/img/profile/'.Auth::user()->image) }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->category }}</p>
                        {{-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b>
                                <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b>
                                <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b>
                                <a class="float-right">13,287</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block">
                            <b>Follow</b>
                        </a> --}}
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- About Me Box -->
                {{-- <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>
                            <i class="fas fa-book mr-1"></i> Education </strong>
                            <p class="text-muted"> B.S. in Computer Science from the University of Tennessee at Knoxville </p>
                            <hr>
                        <strong>
                            <i class="fas fa-map-marker-alt mr-1"></i> Location </strong>
                            <p class="text-muted">{{ Auth::user()->alamat }}</p>
                <hr>
                <strong>
                    <i class="fas fa-pencil-alt mr-1"></i> Skills </strong>
                <p class="text-muted">
                    <span class="tag tag-danger">UI Design</span>
                    <span class="tag tag-success">Coding</span>
                    <span class="tag tag-info">Javascript</span>
                    <span class="tag tag-warning">PHP</span>
                    <span class="tag tag-primary">Node.js</span>
                </p>
                <hr>
                <strong>
                    <i class="far fa-file-alt mr-1"></i> Notes </strong>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.card-body -->
        </div> --}}
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#profile" data-toggle="tab">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                    </li>
                    @if (Auth::user()->role == 'guest')
                    <li class="nav-item">
                        <a class="nav-link" href="#request" data-toggle="tab">Request</a>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="profile">
                        <div class="row mb-3">
                            <div class="col-3 fw-bold">Nama</div>
                            <div class="col-6">: {{ Auth::user()->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 fw-bold">Nomor PIC</div>
                            <div class="col-6">: {{ Auth::user()->no_wa }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 fw-bold">Alamat</div>
                            <div class="col-6">: {{ Auth::user()->alamat }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 fw-bold">Role</div>
                            <div class="col-6">: {{ Auth::user()->role }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-3 fw-bold">Kategori</div>
                            <div class="col-6">: {{ Auth::user()->category }}</div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form id="update-profile-form" class="form-horizontal" action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_wa" class="col-sm-2 col-form-label">Nomor PIC</label>
                                <div class="col-sm-10">
                                    <input type="text" name="no_wa" class="form-control" id="no_wa" placeholder="08xxxxxxxxxx" value="{{ Auth::user()->no_wa }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Name" value="{{ Auth::user()->alamat }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Profile Picture</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" id="image" value="{{ Auth::user()->image }}" accept="image/*">
                                    @if(Auth::user()->image)
                                    <img src="{{ asset('assets/img/profile/'.Auth::user()->image) }}" width="100">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="button" class="btn btn-danger" id="btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if (Auth::user()->role == 'guest')
                    <div class="tab-pane" id="request">
                        <form id="store-request-form" class="form-horizontal" action="{{ route('dashboard.request.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="Kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('kategori') is-invalid @enderror" id="Kategori" name="kategori" required>
                                        <option value="">Select Category</option>
                                        <option value="Arts" {{ old('kategori') == 'Arts' ? 'selected' : '' }}>Arts</option>
                                        <option value="Sports" {{ old('kategori') == 'Sports' ? 'selected' : '' }}>Sports</option>
                                        <option value="Music" {{ old('kategori') == 'Music' ? 'selected' : '' }}>Music</option>
                                        <option value="Others" {{ old('kategori') == 'Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    @error('kategori')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="proposal" class="col-sm-2 col-form-label">Proposal</label>
                                <div class="col-sm-10">
                                    <input type="file" name="proposal" class="form-control" id="proposal" accept="application/pdf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="button" class="btn btn-danger" id="btn-submit-request">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btn-submit').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Update Profile',
            text: "Apakah kamu yakin ingin menyimpan perubahan?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('update-profile-form').submit();
            }
        });
    });
    document.getElementById('btn-submit-request').addEventListener('click', function(e) {
        Swal.fire({
            title: 'Request Proposal',
            text: "Apakah kamu yakin ingin mengirim proposal?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Ya, Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('store-request-form').submit();
            }
        });
    });
</script>

@endsection
