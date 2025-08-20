@extends('dashboardmaster')

@section('title', 'Gallery')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        @if(auth()->user()->role == 'Team Leader')
                            My Gallery
                        @else
                            All Team Leaders Gallery
                        @endif
                    </h3>
                    @if(auth()->user()->role == 'Team Leader')
                        <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Photos
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($galleries->count() > 0)
                        @if(auth()->user()->role == 'Team Leader')
                            <!-- Team Leader's own gallery photos -->
                            <div class="row">
                                @foreach($galleries as $gallery)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $gallery->photo_path) }}"
                                                 class="card-img-top"
                                                 alt="{{ $gallery->caption }}"
                                                 style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $gallery->caption }}</h5>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        Added on {{ $gallery->created_at->format('M d, Y') }}
                                                    </small>
                                                </p>
                                                <form action="{{ route('dashboard.gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this photo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-3">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Total Photos:</strong> {{ $galleries->count() }}
                                </div>
                            </div>
                        @else
                            <!-- List of Team Leaders for non-Team Leader users -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Team Leader Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Joined Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($galleries as $index => $teamLeader)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $teamLeader->name }}</td>
                                                <td>{{ $teamLeader->email }}</td>
                                                <td>{{ $teamLeader->no_wa ?? 'N/A' }}</td>
                                                <td>{{ $teamLeader->alamat ?? 'N/A' }}</td>
                                                <td>{{ $teamLeader->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.gallery.show', $teamLeader->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-images"></i> See Gallery
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                            @if(auth()->user()->role == 'Team Leader')
                                <h5 class="text-muted">No photos found</h5>
                                <p class="text-muted">Start building your gallery by adding photos.</p>
                                <a href="{{ route('dashboard.gallery.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Your First Photo
                                </a>
                            @else
                                <h5 class="text-muted">No team leaders found</h5>
                                <p class="text-muted">No team leaders have been registered yet.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
