@extends('dashboardmaster')

@section('title', 'Team Leader Gallery')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        Gallery of {{ $teamLeader->name }}
                    </h3>
                    <div>
                        <a href="{{ route('dashboard.gallery') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Team Leaders
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Team Leader Info -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <h5><i class="fas fa-user-tie"></i> Team Leader Information</h5>
                                <div class="row">
                                    <div class="col-md-3"><strong>Name:</strong> {{ $teamLeader->name }}</div>
                                    <div class="col-md-3"><strong>Email:</strong> {{ $teamLeader->email }}</div>
                                    <div class="col-md-3"><strong>Phone:</strong> {{ $teamLeader->no_wa ?? 'N/A' }}</div>
                                    <div class="col-md-3"><strong>Address:</strong> {{ $teamLeader->alamat ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($galleries->count() > 0)
                        <div class="row">
                            @foreach($galleries as $gallery)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $gallery->photo_path) }}"
                                             class="card-img-top"
                                             alt="{{ $gallery->caption }}"
                                             style="height: 200px; object-fit: cover;"
                                             data-bs-toggle="modal"
                                             data-bs-target="#imageModal{{ $gallery->id }}"
                                             style="cursor: pointer;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $gallery->caption }}</h5>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    Added on {{ $gallery->created_at->format('M d, Y H:i') }}
                                                </small>
                                            </p>
                                            @if(auth()->user()->role == 'superuser')
                                                <form action="{{ route('dashboard.gallery.destroy', $gallery->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this photo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal for full image view -->
                                <div class="modal fade" id="imageModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $gallery->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $gallery->id }}">{{ $gallery->caption }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $gallery->photo_path) }}"
                                                     class="img-fluid"
                                                     alt="{{ $gallery->caption }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <div class="alert alert-success">
                                <i class="fas fa-info-circle"></i>
                                <strong>Total Photos:</strong> {{ $galleries->count() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No photos found</h5>
                            <p class="text-muted">This team leader hasn't added any photos yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
