@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Question</h1>

    <form action="{{ route('quizzes.exercises.questions.update', [$quiz->id, $exercise->id, $question->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="content">Question Content:</label>
            <textarea class="form-control" id="content" name="content" rows="3" required>{{ $question->content }}</textarea>
        </div>

        <div class="form-group">
            <label for="difficulty_level">Difficulty Level:</label>
            <input type="number" class="form-control" id="difficulty_level" name="difficulty_level" value="{{ $question->difficulty_level }}" required>
        </div>

        @foreach ($question->answers as $key => $answer)
        <div class="form-group">
            <label for="answer{{ $key + 1 }}">Answer {{ $key + 1 }}:</label>
            <input type="text" class="form-control" id="answer{{ $key + 1 }}" name="answers[]" value="{{ $answer->content }}" required>
            <input type="radio" name="correct_answer" value="{{ $key }}" {{ $answer->is_correct ? 'checked' : '' }}> Correct Answer
        </div>
        @endforeach

        <div class="form-group">
            <label for="audio_file">Audio File:</label>
            <input type="file" class="form-control-file" id="audio_file" name="audio_file">
        </div>

        <button type="submit" class="btn btn-primary">Update Question</button>
        <a href="{{ route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
