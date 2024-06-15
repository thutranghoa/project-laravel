<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Quiz $quiz)
    {
        $exercises = $quiz->exercises;
        return view('exercises.index', compact('quiz', 'exercises'));
    }

    public function create(Quiz $quiz)
    {
        return view('exercises.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'exercise_name' => 'required',
            'ma_de' => 'required|integer',
            'time' => 'required|integer',
        ]);

        $quiz->exercises()->create([
            'exercise_name' => $request->exercise_name,
            'ma_de' => $request->ma_de,
            'time' => $request->time,
        ]);

        return redirect()->route('quizzes.exercises.index', $quiz->id)->with('success', 'Exercise created successfully.');
    }

    public function show(Quiz $quiz, Exercise $exercise)
    {
        return view('exercises.show', compact('quiz', 'exercise'));
    }

    public function edit(Quiz $quiz, Exercise $exercise)
    {
        return view('exercises.edit', compact('quiz', 'exercise'));
    }

    public function update(Request $request, Quiz $quiz, Exercise $exercise)
    {
        $request->validate([
            'exercise_name' => 'required',
            'ma_de' => 'required|integer',
            'time' => 'required|integer',
        ]);

        $exercise->update([
            'exercise_name' => $request->exercise_name,
            'ma_de' => $request->ma_de,
            'time' => $request->time,
        ]);

        return redirect()->route('quizzes.exercises.index', $quiz->id)->with('success', 'Exercise updated successfully.');
    }

    public function destroy(Quiz $quiz, Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('quizzes.exercises.index', $quiz->id)->with('success', 'Exercise deleted successfully.');
    }
}

