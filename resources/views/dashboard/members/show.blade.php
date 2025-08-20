@extends('dashboardmaster')

@section('title', 'Team Leader Members')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        Members of {{ $teamLeader->name }}
                    </h3>
                    <div>
                        <a href="{{ route('dashboard.members') }}" class="btn btn-secondary">
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

                    @if($members->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member Name</th>
                                        <th>Phone Number</th>
                                        <th>Added Date</th>
                                        @if(auth()->user()->role == 'superuser')
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $member->name }}</td>
                                            <td>{{ $member->phone_number }}</td>
                                            <td>{{ $member->created_at->format('M d, Y H:i') }}</td>
                                            @if(auth()->user()->role == 'superuser')
                                                <td>
                                                    <form action="{{ route('dashboard.members.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this member?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            <div class="alert alert-success">
                                <i class="fas fa-info-circle"></i>
                                <strong>Total Members:</strong> {{ $members->count() }}
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No members found</h5>
                            <p class="text-muted">This team leader hasn't added any members yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
