@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Question</h1>
    <form action="{{ route('quizzes.exercises.questions.update', [$quiz->id, $exercise->id, $question->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Question Content:</label>
            <textarea class="form-control" id="content" name="content" required>{{ $question->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="difficulty_level">Difficulty Level:</label>
            <input type="number" class="form-control" id="difficulty_level" name="difficulty_level" value="{{ $question->difficulty_level }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Question</button>
        <a href="{{ route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
