@extends('dashboardmaster')

@section('title', 'Quiz Details')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <!-- Quiz Header -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Quiz Details</h3>
                    <div class="btn-group">
                        <a href="{{ route('dashboard.quizzes') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Quizzes
                        </a>

                        @if($quiz->questions->count() >= 20)
                        <a href="{{ route('dashboard.quizzes.export', $quiz->id) }}" class="btn btn-success">
                            <i class="fas fa-download"></i> Export Quiz
                        </a>
                        @endif

                        @if(auth()->user()->role == 'Admin')
                        <form action="{{ route('dashboard.quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this quiz? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete Quiz
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mb-3">{{ $quiz->title }}</h2>
                            <div class="quiz-meta">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Created by:</strong> {{ $quiz->user->name }}</p>
                                        <p><strong>Role:</strong>
                                            <span class="badge badge-info">{{ $quiz->user->role }}</span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Created on:</strong> {{ $quiz->created_at->format('F d, Y \a\t g:i A') }}</p>
                                        <p><strong>Last updated:</strong> {{ $quiz->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="quiz-stats text-center">
                                <div class="stat-card p-3 mb-3 bg-light rounded">
                                    <h3 class="mb-1 {{ $quiz->questions->count() >= 20 ? 'text-success' : 'text-warning' }}">
                                        {{ $quiz->questions->count() }}
                                    </h3>
                                    <p class="mb-0 text-muted">Total Questions</p>
                                </div>

                                @if($quiz->questions->count() >= 20)
                                <div class="alert alert-success mb-0">
                                    <i class="fas fa-check-circle"></i>
                                    <strong>Ready for use!</strong><br>
                                    <small>This quiz meets the minimum requirement of 20 questions.</small>
                                </div>
                                @else
                                <div class="alert alert-warning mb-0">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <strong>Needs more questions</strong><br>
                                    <small>{{ 20 - $quiz->questions->count() }} more questions needed</small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Questions List -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-list"></i> Questions
                        <span class="badge badge-primary ml-2">{{ $quiz->questions->count() }}</span>
                    </h4>
                </div>
                <div class="card-body">
                    @if($quiz->questions->count() > 0)
                    <div class="questions-list">
                        @foreach($quiz->questions as $index => $question)
                        <div class="question-item mb-4">
                            <div class="question-card border rounded">
                                <div class="question-header bg-light p-3">
                                    <h5 class="mb-0">
                                        <span class="question-number badge badge-secondary mr-2">{{ $index + 1 }}</span>
                                        {{ $question->question_text }}
                                    </h5>
                                </div>
                                <div class="question-body p-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="option {{ $question->correct_answer == 'A' ? 'correct-answer' : '' }}">
                                                <strong>A.</strong> {{ $question->option_a }}
                                                @if($question->correct_answer == 'A')
                                                <i class="fas fa-check-circle text-success ml-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="option {{ $question->correct_answer == 'B' ? 'correct-answer' : '' }}">
                                                <strong>B.</strong> {{ $question->option_b }}
                                                @if($question->correct_answer == 'B')
                                                <i class="fas fa-check-circle text-success ml-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="option {{ $question->correct_answer == 'C' ? 'correct-answer' : '' }}">
                                                <strong>C.</strong> {{ $question->option_c }}
                                                @if($question->correct_answer == 'C')
                                                <i class="fas fa-check-circle text-success ml-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="option {{ $question->correct_answer == 'D' ? 'correct-answer' : '' }}">
                                                <strong>D.</strong> {{ $question->option_d }}
                                                @if($question->correct_answer == 'D')
                                                <i class="fas fa-check-circle text-success ml-2"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="correct-answer-info mt-2">
                                        <small class="text-muted">
                                            <strong>Correct Answer:</strong>
                                            <span class="badge badge-success">{{ $question->correct_answer }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Question Navigation -->
                    @if($quiz->questions->count() > 5)
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            <strong>Navigation Tip:</strong> Use <kbd>Ctrl + F</kbd> to search for specific questions or terms.
                        </div>
                    </div>
                    @endif
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No questions added yet</h5>
                        <p class="text-muted">This quiz doesn't have any questions. Add some questions to make it complete.</p>
                        @if(auth()->user()->id == $quiz->user_id || auth()->user()->role == 'Admin')
                        <a href="{{ route('dashboard.quizzes.edit', $quiz->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Add Questions
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons for Team Leaders -->
            @if(auth()->user()->role == 'Team Leader' && $quiz->user_id != auth()->user()->id && $quiz->questions->count() >= 20)
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5>Interested in this quiz?</h5>
                    <p class="text-muted">You can request this quiz to use with your team.</p>
                    <form action="{{ route('dashboard.quizzes.request', $quiz->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-info btn-lg" onclick="return confirm('Are you sure you want to request this quiz for your team?')">
                            <i class="fas fa-hand-paper"></i> Request This Quiz
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .quiz-meta p {
        margin-bottom: 0.5rem;
    }

    .stat-card {
        border: 1px solid #dee2e6;
    }

    .question-item {
        position: relative;
    }

    .question-card {
        transition: box-shadow 0.15s ease-in-out;
    }

    .question-card:hover {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .question-header {
        border-bottom: 1px solid #dee2e6;
    }

    .question-number {
        font-size: 0.875rem;
    }

    .option {
        padding: 0.5rem;
        border-radius: 0.25rem;
        transition: background-color 0.15s ease-in-out;
    }

    .option.correct-answer {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .correct-answer-info {
        padding-top: 0.75rem;
        border-top: 1px solid #dee2e6;
    }

    .btn-group .btn {
        margin-left: 0.25rem;
    }

    .btn-group .btn:first-child {
        margin-left: 0;
    }

    @media (max-width: 768px) {
        .card-header .btn-group {
            flex-direction: column;
            width: 100%;
        }

        .card-header .btn-group .btn {
            margin: 0.125rem 0;
        }

        .card-header {
            flex-direction: column;
            align-items: stretch !important;
        }

        .card-header .btn-group {
            margin-top: 1rem;
        }

        .option {
            margin-bottom: 0.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Smooth scrolling for question navigation
        $('.question-number').click(function() {
            const questionNumber = $(this).text();
            $('html, body').animate({
                scrollTop: $(this).closest('.question-item').offset().top - 100
            }, 500);
        });

        // Highlight search results
        function highlightSearchTerm() {
            const urlParams = new URLSearchParams(window.location.search);
            const searchTerm = urlParams.get('search');

            if (searchTerm) {
                $('.question-item').each(function() {
                    const questionText = $(this).text().toLowerCase();
                    if (questionText.includes(searchTerm.toLowerCase())) {
                        $(this).addClass('highlighted');
                    }
                });
            }
        }

        highlightSearchTerm();

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').not('.alert-info, .alert-success').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush
@endsection