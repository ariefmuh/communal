@extends('dashboardmaster')
@section('title', 'Create Community Program')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Community Program Proposal</h3>
                </div>
                <form action="{{ route('dashboard.programs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="program_name">Program Name</label>
                            <input type="text" class="form-control @error('program_name') is-invalid @enderror"
                                   id="program_name" name="program_name" value="{{ old('program_name') }}" required>
                            @error('program_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Program Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="support_needed">Support Needed</label>
                            <textarea class="form-control @error('support_needed') is-invalid @enderror"
                                      id="support_needed" name="support_needed" rows="3"
                                      placeholder="Describe what kind of support you need (e.g., funding, equipment, volunteers, etc.)" required>{{ old('support_needed') }}</textarea>
                            @error('support_needed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="event_date">Event Date & Time</label>
                            <input type="datetime-local" class="form-control @error('event_date') is-invalid @enderror"
                                   id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Event Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                   id="location" name="location" value="{{ old('location') }}"
                                   placeholder="Enter the event location" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="proposal">Program Proposal (PDF)</label>
                            <input type="file" class="form-control-file @error('proposal') is-invalid @enderror"
                                   id="proposal" name="proposal" accept=".pdf" required>
                            <small class="form-text text-muted">Upload your program proposal in PDF format (Max: 10MB)</small>
                            @error('proposal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit Proposal</button>
                        <a href="{{ route('dashboard.programs') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
