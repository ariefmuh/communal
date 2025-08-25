<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use the quiz_id from QuizzesTableSeeder
        $quizId = \Database\Seeders\QuizzesTableSeeder::$quizId;

        $questions = [
            [
                'question_text' => 'What is 2 + 2?',
                'option_a' => '3',
                'option_b' => '4',
                'option_c' => '5',
                'option_d' => '6',
                'correct_answer' => 'b'
            ],
            [
                'question_text' => 'What is the capital of France?',
                'option_a' => 'Berlin',
                'option_b' => 'Madrid',
                'option_c' => 'Paris',
                'option_d' => 'Rome',
                'correct_answer' => 'c'
            ],
            [
                'question_text' => 'Which planet is known as the Red Planet?',
                'option_a' => 'Earth',
                'option_b' => 'Mars',
                'option_c' => 'Venus',
                'option_d' => 'Jupiter',
                'correct_answer' => 'b'
            ],
            [
                'question_text' => 'Who wrote "Romeo and Juliet"?',
                'option_a' => 'William Shakespeare',
                'option_b' => 'Charles Dickens',
                'option_c' => 'Mark Twain',
                'option_d' => 'Jane Austen',
                'correct_answer' => 'a'
            ],
            [
                'question_text' => 'What is the largest mammal on Earth?',
                'option_a' => 'Elephant',
                'option_b' => 'Blue Whale',
                'option_c' => 'Giraffe',
                'option_d' => 'Hippopotamus',
                'correct_answer' => 'b'
            ],
            // Add more until you have 20 questions...
        ];

        // Fill up to 20 if needed
        while (count($questions) < 20) {
            $questions[] = [
                'question_text' => 'Placeholder Question ' . (count($questions) + 1),
                'option_a' => 'Option A',
                'option_b' => 'Option B',
                'option_c' => 'Option C',
                'option_d' => 'Option D',
                'correct_answer' => 'a'
            ];
        }

        foreach ($questions as $question) {
            Question::create(array_merge($question, ['quiz_id' => $quizId]));
        }
    }
}
