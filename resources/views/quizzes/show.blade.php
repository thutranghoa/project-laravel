@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Question Details</h1>
        </div>
        <div class="card-body">
            <p><strong>Content:</strong> {{ $question->content }}</p>
            <p><strong>Difficulty Level:</strong> {{ $question->difficulty_level }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary">Back to Questions</a>
            <a href="{{ route('quizzes.exercises.questions.edit', [$quiz->id, $exercise->id, $question->id]) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('quizzes.exercises.questions.destroy', [$quiz->id, $exercise->id, $question->id]) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
