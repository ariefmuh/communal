@extends('dashboardmaster')

@section('title', 'Program Details')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Program Details</h3>
                    <a href="{{ route('dashboard.programs') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Programs
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>{{ $program->program_name }}</h4>
                            <hr>

                            <div class="form-group">
                                <label><strong>Program Description:</strong></label>
                                <p>{{ $program->description }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Support Needed:</strong></label>
                                <p>{{ $program->support_needed }}</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Event Date & Time:</strong></label>
                                        <p>{{ $program->event_date->format('l, M d, Y - H:i') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><strong>Location:</strong></label>
                                        <p>{{ $program->location }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Team Leader:</strong></label>
                                <p>{{ $program->teamLeader->name ?? 'N/A' }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Submitted Date:</strong></label>
                                <p>{{ $program->created_at->format('M d, Y H:i') }}</p>
                            </div>

                            <div class="form-group">
                                <label><strong>Program Proposal:</strong></label>
                                @if($program->proposal)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $program->proposal) }}"
                                           target="_blank"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-file-pdf"></i> View Proposal PDF
                                        </a>
                                        <a href="{{ asset('storage/' . $program->proposal) }}"
                                           download
                                           class="btn btn-outline-secondary btn-sm ml-2">
                                            <i class="fas fa-download"></i> Download PDF
                                        </a>
                                    </div>
                                @else
                                    <p class="text-muted">No proposal file uploaded</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h5>Program Status</h5>
                                    <span class="badge badge-{{ $program->status == 'approved' ? 'success' : ($program->status == 'rejected' ? 'danger' : 'warning') }} badge-lg">
                                        {{ ucfirst($program->status) }}
                                    </span>

                                    @if(auth()->user()->role == 'superuser' && $program->status == 'pending')
                                        <hr>
                                        <h6>Admin Actions</h6>
                                        <form action="{{ route('dashboard.programs.approve', $program->id) }}" method="POST" class="mb-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block"
                                                    onclick="return confirm('Are you sure you want to approve this program?')">
                                                <i class="fas fa-check"></i> Approve Program
                                            </button>
                                        </form>
                                        <form action="{{ route('dashboard.programs.reject', $program->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Are you sure you want to reject this program?')">
                                                <i class="fas fa-times"></i> Reject Program
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge-lg {
    font-size: 1.1em;
    padding: 8px 12px;
}
</style>
@endsection
