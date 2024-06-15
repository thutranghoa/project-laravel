<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Exercise;
use App\Models\Question;
use App\Models\Answer;
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

    public function create($quizId, $exerciseId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
        return view('questions.create', compact('quiz', 'exercise'));
    }

    public function store(Request $request, $quizId, $exerciseId)
    {
        $request->validate([
            'content' => 'required',
            'difficulty_level' => 'required|integer',
            'answers' => 'required|array',
            'correct_answer' => 'required|integer',
        ]);
    
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
    
        $question = new Question();
        $question->content = $request->input('content');
        $question->difficulty_level = $request->input('difficulty_level');
        $question->exercise_id = $exercise->id; 
        $question->save();
    
        foreach ($request->input('answers') as $key => $answerContent) {
            $answer = new Answer();
            $answer->content = $answerContent;
            $answer->question_id = $question->id;
            $answer->is_correct = $key === (int)$request->input('correct_answer');
            $answer->save();
        }
    
        return redirect()->route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id])
                         ->with('success', 'Question created successfully.');
    }    

    public function show($quizId, $exerciseId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
        $question = Question::with('answers')->findOrFail($questionId);

        return view('questions.show', compact('quiz', 'exercise', 'question'));
    }

    public function edit($quizId, $exerciseId, $questionId)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
        $question = Question::findOrFail($questionId);
        return view('questions.edit', compact('quiz', 'exercise', 'question'));
    }

    public function update(Request $request, Quiz $quiz, Exercise $exercise, Question $question)
    {
        $request->validate([
            'content' => 'required',
            'difficulty_level' => 'required|integer',
            'answers' => 'required|array',
            'correct_answer' => 'required|integer',
        ]);
    
        $question->update([
            'content' => $request->content,
            'difficulty_level' => $request->difficulty_level,
        ]);
    
        foreach ($request->answers as $key => $answerContent) {
            $isCorrect = $key == $request->correct_answer;
    
            $answer = $question->answers()->where('id', $key)->first();
            if (!$answer) {
                $answer = new Answer();
            }
    
            $answer->content = $answerContent;
            $answer->is_correct = $isCorrect;
            $answer->save();
        }
    
        return redirect()->route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id])->with('success', 'Question updated successfully.');
    }    

    public function destroy($quizId, $exerciseId, Question $question)
    {
        $quiz = Quiz::findOrFail($quizId);
        $exercise = Exercise::findOrFail($exerciseId);
    
        $question->delete();
    
        return redirect()->route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id])
                         ->with('success', 'Question deleted successfully.');
    }

}
