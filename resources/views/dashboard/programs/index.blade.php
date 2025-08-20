@extends('dashboardmaster')

@section('title', 'Community Programs')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Community Programs</h3>
                    @if(auth()->user()->role == 'Team Leader')
                        <a href="{{ route('dashboard.programs.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Program Proposal
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($programs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Program Name</th>
                                        <th>Team Leader</th>
                                        <th>Event Date</th>
                                        <th>Location</th>
                                        <th>Proposal</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programs as $program)
                                        <tr>
                                            <td>{{ $program->program_name }}</td>
                                            <td>{{ $program->teamLeader->name ?? auth()->user()->name }}</td>
                                            <td>{{ $program->event_date->format('M d, Y H:i') }}</td>
                                            <td>{{ $program->location }}</td>
                                            <td>
                                                @if($program->proposal)
                                                    <a href="{{ asset('storage/' . $program->proposal) }}"
                                                       target="_blank"
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-pdf"></i> PDF
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-{{ $program->status == 'approved' ? 'success' : ($program->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($program->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboard.programs.show', $program->id) }}" class="btn btn-sm btn-info">View</a>
                                                @if(auth()->user()->role == 'superuser' && $program->status == 'pending')
                                                    <form action="{{ route('dashboard.programs.approve', $program->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                    </form>
                                                    <form action="{{ route('dashboard.programs.reject', $program->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">No community programs found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
