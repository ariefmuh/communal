@extends('dashboardmaster')

@section('title', 'Quizzes')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        @if(auth()->user()->role == 'Team Leader')
                        My Team Quizzes
                        @elseif(auth()->user()->role == 'Admin')
                        All Quizzes
                        @else
                        Available Quizzes
                        @endif
                    </h3>
                    @if(auth()->user()->role == 'Team Leader' || auth()->user()->role == 'Admin')
                    <a href="{{ route('dashboard.quizzes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Create Quiz
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    @if($quizzes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quiz Title</th>
                                    <th>Owner</th>
                                    <th>Questions</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $index => $quiz)
                                <tr>
                                    <td>{{ $quizzes->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $quiz->title }}</strong>
                                        @if($quiz->questions->count() < 20)
                                            <br>
                                            <small class="text-warning">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Minimum 20 questions required
                                            </small>
                                            @else
                                            <br>
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i>
                                                Ready for use
                                            </small>
                                            @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ml-2">
                                                <strong>{{ $quiz->user->name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $quiz->user->role }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $quiz->questions->count() >= 20 ? 'badge-success' : 'badge-warning' }}">
                                            {{ $quiz->questions->count() }} questions
                                        </span>
                                    </td>
                                    <td>{{ $quiz->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- See Quizzes Button -->
                                            <a href="{{ route('dashboard.quizzes.show', $quiz->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>

                                            @if(auth()->user()->role == 'Team Leader')
                                            <!-- Team Leader: Can request quiz if not own quiz -->
                                            @if($quiz->user_id != auth()->user()->id && $quiz->questions->count() >= 20)
                                            <form action="{{ route('dashboard.quizzes.request', $quiz->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('Are you sure you want to request this quiz?')">
                                                    <i class="fas fa-hand-paper"></i> Request
                                                </button>
                                            </form>
                                            @endif

                                            <!-- Export quiz if has enough questions -->
                                            @if($quiz->questions->count() >= 20)
                                            <a href="{{ route('dashboard.quizzes.export', $quiz->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Export
                                            </a>
                                            @endif
                                            @elseif(auth()->user()->role == 'Admin')
                                            <!-- Admin: Can delete and export -->
                                            @if($quiz->questions->count() >= 20)
                                            <a href="{{ route('dashboard.quizzes.export', $quiz->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Export
                                            </a>
                                            @endif

                                            <form action="{{ route('dashboard.quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this quiz? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            @else
                                            <!-- Regular User: Can only view details and export -->
                                            @if($quiz->questions->count() >= 20)
                                            <a href="{{ route('dashboard.quizzes.export', $quiz->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i> Export
                                            </a>
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $quizzes->links() }}
                    </div>

                    <!-- Summary Information -->
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Total Quizzes:</strong> {{ $quizzes->total() }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i>
                                    <strong>Ready Quizzes:</strong> {{ $quizzes->where('questions_count', '>=', 20)->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-clipboard-question fa-3x text-muted mb-3"></i>
                        @if(auth()->user()->role == 'Team Leader')
                        <h5 class="text-muted">No quizzes found</h5>
                        <p class="text-muted">Start creating quizzes for your team.</p>
                        <a href="{{ route('dashboard.quizzes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create Your First Quiz
                        </a>
                        @elseif(auth()->user()->role == 'Admin')
                        <h5 class="text-muted">No quizzes found</h5>
                        <p class="text-muted">No quizzes have been created yet.</p>
                        <a href="{{ route('dashboard.quizzes.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create First Quiz
                        </a>
                        @else
                        <h5 class="text-muted">No quizzes available</h5>
                        <p class="text-muted">No quizzes are currently available for you.</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .badge {
        font-size: 0.75em;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875em;
        }

        .btn-group {
            flex-direction: column;
        }

        .btn-group .btn {
            margin-bottom: 2px;
            margin-right: 0;
        }

        .card-header {
            flex-direction: column;
            align-items: stretch !important;
        }

        .card-header .btn {
            margin-top: 10px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush
@endsection