<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Exercise;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index($quizId, $exerciseId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
        $questions = Question::where('exercise_id', $exerciseId)->get();

        return view('questions.index', compact('quiz', 'exercise', 'questions'));
    }

    public function create(Exercise $exercise)
    {
        return view('questions.create', compact('exercise'));
    }

    public function store(Request $request, Exercise $exercise)
    {
        $request->validate([
            'content' => 'required',
            'difficulty_level' => 'required|integer',
        ]);

        $question = $exercise->questions()->create([
            'quiz_id' => $exercise->quiz_id,
            'content' => $request->content,
            'difficulty_level' => $request->difficulty_level,
        ]);

        return redirect()->route('quizzes.exercises.questions.index', [$exercise->quiz_id, $exercise->id])
                         ->with('success', 'Question created successfully.');
    }

    public function show($quizId, $exerciseId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
        $question = Question::with('answers')->findOrFail($questionId);

        return view('questions.show', compact('quiz', 'exercise', 'question'));
    }

    public function edit(Exercise $exercise, Question $question)
    {
        return view('questions.edit', compact('exercise', 'question'));
    }

    public function update(Request $request, Exercise $exercise, Question $question)
    {
        $request->validate([
            'content' => 'required',
            'difficulty_level' => 'required|integer',
        ]);

        $question->update([
            'content' => $request->content,
            'difficulty_level' => $request->difficulty_level,
        ]);

        return redirect()->route('quizzes.exercises.questions.index', [$exercise->quiz_id, $exercise->id])
                         ->with('success', 'Question updated successfully.');
    }

    public function destroy(Exercise $exercise, Question $question)
    {
        $question->delete();

        return redirect()->route('quizzes.exercises.questions.index', [$exercise->quiz_id, $exercise->id])
                         ->with('success', 'Question deleted successfully.');
    }
}
