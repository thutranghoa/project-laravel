<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        return view('quizzes.create');
    }

    /*public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'duration' => 'required|integer',
            'total_questions' => 'required|integer',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }*/

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'total_questions' => 'required|integer',
            'name' => 'nullable|string|max:255',
        ]);
    
        $quiz = new Quiz;
        $quiz->title = $request->title;
        $quiz->description = $request->description;
        $quiz->duration = $request->duration;
        $quiz->total_questions = $request->total_questions;
        $quiz->name = $request->name;
        $quiz->save();
    
        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully');
    }
    


    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|integer',
            'total_questions' => 'required|integer',
            'name' => 'nullable|string|max:255',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'total_questions' => $request->total_questions,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function createExam(Quiz $quiz)
    {
        return view('admin.quizzes.create_exam', compact('quiz'));    
    }
}
