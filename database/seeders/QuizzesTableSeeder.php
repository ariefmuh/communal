<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample quiz
        $quiz = Quiz::create([
            'user_id' => 1, // adjust based on your users table
            'title' => 'Sample Quiz'
        ]);

        // Optionally, store quiz ID in a static property for QuestionsTableSeeder
        self::$quizId = $quiz->id;
    }

    // Make quiz_id accessible in QuestionsTableSeeder
    public static int $quizId;
}
