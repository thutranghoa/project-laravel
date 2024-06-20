<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(Question $question)
    {
        $answers = $question->answers()->get();
        return view('answers.index', compact('question', 'answers'));
    }

    public function create(Question $question)
    {
        return view('answers.create', compact('question'));
    }

    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required',
            'is_correct' => 'required|boolean',
        ]);

        $answer = $question->answers()->create([
            'content' => $request->content,
            'is_correct' => $request->is_correct,
        ]);

        return redirect()->route('questions.answers.index', $question->id)
                         ->with('success', 'Answer created successfully.');
    }

    public function edit(Question $question, Answer $answer)
    {
        return view('answers.edit', compact('question', 'answer'));
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $request->validate([
            'content' => 'required',
            'is_correct' => 'required|boolean',
        ]);

        $answer->update([
            'content' => $request->content,
            'is_correct' => $request->is_correct,
        ]);

        return redirect()->route('questions.answers.index', $question->id)
                         ->with('success', 'Answer updated successfully.');
    }

    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();

        return redirect()->route('questions.answers.index', $question->id)
                         ->with('success', 'Answer deleted successfully.');
    }
}
