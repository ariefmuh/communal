<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\TeamMember;
use App\Models\User;
use App\Exports\QuizExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuizController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'Team Leader') {
            // Team leaders can only see quizzes they created themselves
            // Since team members are not User records, they can't create quizzes
            $quizzes = Quiz::with(['user', 'questions'])
                ->where('user_id', $user->id)
                ->paginate(10);
        } elseif ($user->role == 'Admin') {
            // Admin can see all quizzes
            $quizzes = Quiz::with(['user', 'questions'])
                ->paginate(10);
        } else {
            // Regular users can see all quizzes (but with limited actions)
            $quizzes = Quiz::with(['user', 'questions'])
                ->paginate(10);
        }

        return view('dashboard.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['Team Leader', 'Admin'])) {
            return redirect()->back()->with('error', 'Only Team Leaders and Admins can create quizzes');
        }

        return view('dashboard.quizzes.create');
    }

    public function show($id)
    {
        $quiz = Quiz::with(['user', 'questions'])->findOrFail($id);

        return view('dashboard.quizzes.show', compact('quiz'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['Team Leader', 'Admin'])) {
            return redirect()->back()->with('error', 'Only Team Leaders and Admins can create quizzes');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'questions' => 'required|array|min:20',
            'questions.*.question_text' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_answer' => 'required|in:A,B,C,D',
        ], [
            'questions.min' => 'A quiz must have at least 20 questions',
            'questions.*.question_text.required' => 'Question text is required',
            'questions.*.option_a.required' => 'Option A is required',
            'questions.*.option_b.required' => 'Option B is required',
            'questions.*.option_c.required' => 'Option C is required',
            'questions.*.option_d.required' => 'Option D is required',
            'questions.*.correct_answer.required' => 'Correct answer is required',
            'questions.*.correct_answer.in' => 'Correct answer must be A, B, C, or D',
        ]);

        // Create the quiz
        $quiz = Quiz::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
        ]);

        // Create the questions
        foreach ($request->questions as $questionData) {
            Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionData['question_text'],
                'option_a' => $questionData['option_a'],
                'option_b' => $questionData['option_b'],
                'option_c' => $questionData['option_c'],
                'option_d' => $questionData['option_d'],
                'correct_answer' => $questionData['correct_answer'],
            ]);
        }

        return redirect()->route('dashboard.quizzes')->with('success', 'Quiz created successfully with ' . count($request->questions) . ' questions');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'Only Admins can delete quizzes');
        }

        $quiz = Quiz::findOrFail($id);

        // Delete associated questions first
        $quiz->questions()->delete();

        // Delete the quiz
        $quiz->delete();

        return redirect()->back()->with('success', 'Quiz deleted successfully');
    }

    public function requestQuiz($id)
    {
        if (auth()->user()->role !== 'Team Leader') {
            return redirect()->back()->with('error', 'Only Team Leaders can request quizzes');
        }

        $quiz = Quiz::with('questions')->findOrFail($id);

        // Check if quiz has minimum questions
        if ($quiz->questions->count() < 20) {
            return redirect()->back()->with('error', 'Quiz must have at least 20 questions to be requested');
        }

        // Check if user is trying to request their own quiz
        if ($quiz->user_id == auth()->user()->id) {
            return redirect()->back()->with('error', 'You cannot request your own quiz');
        }

        // Here you would implement the request logic
        // For example, creating a quiz request record, sending notification, etc.

        return redirect()->back()->with('success', 'Quiz request submitted successfully');
    }

    public function export($id)
    {
        $quiz = Quiz::with(['questions', 'user'])->findOrFail($id);

        // Check if quiz has minimum questions
        if ($quiz->questions->count() < 20) {
            return redirect()->back()->with('error', 'Quiz must have at least 20 questions to be exported');
        }

        try {
            // Generate filename with quiz title and current date
            $filename = 'quiz_' . str_replace(' ', '_', strtolower($quiz->title)) . '_' . date('Y-m-d_H-i-s') . '.xlsx';

            // Export to Excel
            return Excel::download(new QuizExport($quiz), $filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to export quiz: ' . $e->getMessage());
        }
    }
}
