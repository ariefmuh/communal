@extends('dashboardmaster')

@section('title', 'Team Members')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        @if(auth()->user()->role == 'Team Leader')
                            My Team Members
                        @else
                            All Team Leaders
                        @endif
                    </h3>
                    @if(auth()->user()->role == 'Team Leader')
                        <a href="{{ route('dashboard.members.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Members
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($members->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if(auth()->user()->role == 'Team Leader')
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Added Date</th>
                                            <th>Actions</th>
                                        @else
                                            <th>#</th>
                                            <th>Team Leader Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Joined Date</th>
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            @if(auth()->user()->role == 'Team Leader')
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->phone_number }}</td>
                                                <td>{{ $member->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <form action="{{ route('dashboard.members.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to remove this member?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->no_wa ?? 'N/A' }}</td>
                                                <td>{{ $member->alamat ?? 'N/A' }}</td>
                                                <td>{{ $member->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('dashboard.members.show', $member->id) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-users"></i> See Members
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(auth()->user()->role == 'Team Leader')
                            <div class="mt-3">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Total Members:</strong> {{ $members->count() }}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            @if(auth()->user()->role == 'Team Leader')
                                <h5 class="text-muted">No team members found</h5>
                                <p class="text-muted">Start building your team by adding members.</p>
                                <a href="{{ route('dashboard.members.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Add Your First Member
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
