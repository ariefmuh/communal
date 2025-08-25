@extends('dashboardmaster')

@section('title', 'Create Quiz')

@section('content')
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Create New Quiz</h3>
                    <a href="{{ route('dashboard.quizzes') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Quizzes
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('dashboard.quizzes.store') }}" method="POST" id="quizForm">
                        @csrf

                        <!-- Quiz Title -->
                        <div class="form-group mb-4">
                            <label for="title" class="form-label">Quiz Title <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Enter quiz title"
                                required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Questions Section -->
                        <div class="form-group mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label">
                                    Questions <span class="text-danger">*</span>
                                    <small class="text-muted">(Minimum 20 questions required)</small>
                                </label>
                                <div>
                                    <span class="badge badge-info" id="questionCount">0 questions</span>
                                    <button type="button" class="btn btn-sm btn-success" id="addQuestion">
                                        <i class="fas fa-plus"></i> Add Question
                                    </button>
                                </div>
                            </div>

                            <div id="questionsContainer">
                                <!-- Questions will be added here dynamically -->
                            </div>

                            @error('questions')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                            @error('questions.min')
                            <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                                <i class="fas fa-save"></i> Create Quiz
                            </button>
                            <a href="{{ route('dashboard.quizzes') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    .question-card {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
        background-color: #f8f9fa;
    }

    .question-header {
        background-color: #e9ecef;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .question-body {
        padding: 1rem;
    }

    .option-group {
        margin-bottom: 0.75rem;
    }

    .option-input {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .correct-answer-radio {
        margin-right: 0.5rem;
    }

    .question-number {
        font-weight: bold;
        color: #495057;
    }

    .remove-question {
        color: #dc3545;
        border: none;
        background: none;
        font-size: 1.1rem;
    }

    .remove-question:hover {
        color: #c82333;
    }

    @media (max-width: 768px) {
        .question-header {
            flex-direction: column;
            align-items: stretch;
        }

        .remove-question {
            margin-top: 0.5rem;
            align-self: flex-end;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let questionCount = 0;

        // Add question functionality
        $('#addQuestion').on('click', function(e) {
            e.preventDefault();
            addQuestion();
        });

        function addQuestion() {
            questionCount++;

            const questionHtml = `
            <div class="question-card" data-question="${questionCount}">
                <div class="question-header">
                    <span class="question-number">Question ${questionCount}</span>
                    <button type="button" class="remove-question" onclick="removeQuestion(${questionCount})" title="Remove Question">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="question-body">
                    <!-- Question Text Input -->
                    <div class="form-group mb-3">
                        <label class="form-label">Question Text <span class="text-danger">*</span></label>
                        <textarea class="form-control" 
                                  name="questions[${questionCount-1}][question_text]" 
                                  rows="3" 
                                  placeholder="Enter your question here..."
                                  required></textarea>
                    </div>
                    
                    <!-- Answer Options Row 1 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="option-group">
                                <label class="form-label">Option A <span class="text-danger">*</span></label>
                                <div class="option-input">
                                    <input type="radio" 
                                           name="questions[${questionCount-1}][correct_answer]" 
                                           value="A" 
                                           class="correct-answer-radio" 
                                           required>
                                    <input type="text" 
                                           class="form-control" 
                                           name="questions[${questionCount-1}][option_a]" 
                                           placeholder="Enter option A"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="option-group">
                                <label class="form-label">Option B <span class="text-danger">*</span></label>
                                <div class="option-input">
                                    <input type="radio" 
                                           name="questions[${questionCount-1}][correct_answer]" 
                                           value="B" 
                                           class="correct-answer-radio" 
                                           required>
                                    <input type="text" 
                                           class="form-control" 
                                           name="questions[${questionCount-1}][option_b]" 
                                           placeholder="Enter option B"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Answer Options Row 2 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="option-group">
                                <label class="form-label">Option C <span class="text-danger">*</span></label>
                                <div class="option-input">
                                    <input type="radio" 
                                           name="questions[${questionCount-1}][correct_answer]" 
                                           value="C" 
                                           class="correct-answer-radio" 
                                           required>
                                    <input type="text" 
                                           class="form-control" 
                                           name="questions[${questionCount-1}][option_c]" 
                                           placeholder="Enter option C"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="option-group">
                                <label class="form-label">Option D <span class="text-danger">*</span></label>
                                <div class="option-input">
                                    <input type="radio" 
                                           name="questions[${questionCount-1}][correct_answer]" 
                                           value="D" 
                                           class="correct-answer-radio" 
                                           required>
                                    <input type="text" 
                                           class="form-control" 
                                           name="questions[${questionCount-1}][option_d]" 
                                           placeholder="Enter option D"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Instruction Text -->
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> 
                            Select the radio button next to the correct answer option.
                        </small>
                    </div>
                </div>
            </div>
            `;

            $('#questionsContainer').append(questionHtml);
            updateQuestionCount();
            updateSubmitButton();

            // Scroll to the new question smoothly
            $('html, body').animate({
                scrollTop: $(`.question-card[data-question="${questionCount}"]`).offset().top - 100
            }, 500);

            // Focus on the question text area for better UX
            setTimeout(function() {
                $(`.question-card[data-question="${questionCount}"] textarea`).focus();
            }, 600);
        }

        window.removeQuestion = function(questionNum) {
            if (questionCount > 0) {
                $(`.question-card[data-question="${questionNum}"]`).remove();
                questionCount--;
                renumberQuestions();
                updateQuestionCount();
                updateSubmitButton();
            } else {
                alert('You must have at least one question to remove.');
            }
        }

        function renumberQuestions() {
            let newCount = 0;
            $('.question-card').each(function(index) {
                newCount++;
                $(this).attr('data-question', newCount);
                $(this).find('.question-number').text(`Question ${newCount}`);

                // Update input names
                $(this).find('textarea, input[type="text"]').each(function() {
                    let name = $(this).attr('name');
                    if (name) {
                        name = name.replace(/questions\[\d+\]/, `questions[${index}]`);
                        $(this).attr('name', name);
                    }
                });

                // Update radio button names
                $(this).find('input[type="radio"]').each(function() {
                    $(this).attr('name', `questions[${index}][correct_answer]`);
                });

                // Update remove button onclick
                $(this).find('.remove-question').attr('onclick', `removeQuestion(${newCount})`);
            });
            questionCount = newCount;
        }

        function updateQuestionCount() {
            $('#questionCount').text(`${questionCount} question${questionCount !== 1 ? 's' : ''}`);

            if (questionCount >= 20) {
                $('#questionCount').removeClass('badge-warning badge-danger').addClass('badge-success');
            } else if (questionCount >= 10) {
                $('#questionCount').removeClass('badge-success badge-danger').addClass('badge-warning');
            } else {
                $('#questionCount').removeClass('badge-success badge-warning').addClass('badge-danger');
            }
        }

        function updateSubmitButton() {
            if (questionCount >= 20) {
                $('#submitBtn').prop('disabled', false).removeClass('btn-secondary').addClass('btn-primary');
            } else {
                $('#submitBtn').prop('disabled', true).removeClass('btn-primary').addClass('btn-secondary');
            }
        }

        // Form validation before submit
        $('#quizForm').submit(function(e) {
            if (questionCount < 20) {
                e.preventDefault();
                alert('You must have at least 20 questions to create a quiz.');
                return false;
            }

            // Check if all questions have correct answers selected
            let hasErrors = false;
            $('.question-card').each(function() {
                let correctAnswerSelected = $(this).find('input[type="radio"]:checked').length > 0;
                if (!correctAnswerSelected) {
                    hasErrors = true;
                    $(this).find('.question-header').addClass('bg-danger text-white');
                } else {
                    $(this).find('.question-header').removeClass('bg-danger text-white');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                alert('Please select the correct answer for all questions.');
                return false;
            }
        });
    });
</script>
@endsection
@endsection