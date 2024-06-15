<?php

namespace App\Http\Controllers;

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

    public function storeExam(Request $request, Quiz $quiz)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

            Quiz::create([
                'quiz_id' => $quiz->id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Exam created successfully.');
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
            'title' => 'required',
            'duration' => 'required|integer',
            'total_questions' => 'required|integer',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function createExam(Quiz $quiz)
    {
        return view('quizzes.create_exam', compact('quiz'));    
    }
}
