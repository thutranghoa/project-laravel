@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Create New Question</h1>

    <form action="{{ route('quizzes.exercises.questions.store', [$quiz->id, $exercise->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="content">Question Content:</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="difficulty_level">Difficulty Level:</label>
            <input type="number" class="form-control" id="difficulty_level" name="difficulty_level" required>
        </div>

        <div class="form-group">
            <label for="answer1">Answer 1:</label>
            <input type="text" class="form-control" id="answer1" name="answers[]" required>
            <input type="radio" name="correct_answer" value="0" required> Correct Answer
        </div>

        <div class="form-group">
            <label for="answer2">Answer 2:</label>
            <input type="text" class="form-control" id="answer2" name="answers[]" required>
            <input type="radio" name="correct_answer" value="1" required> Correct Answer
        </div>

        <div class="form-group">
            <label for="answer3">Answer 3:</label>
            <input type="text" class="form-control" id="answer3" name="answers[]" required>
            <input type="radio" name="correct_answer" value="2" required> Correct Answer
        </div>

        <div class="form-group">
            <label for="answer4">Answer 4:</label>
            <input type="text" class="form-control" id="answer4" name="answers[]" required>
            <input type="radio" name="correct_answer" value="3" required> Correct Answer
        </div>

        <div class="form-group">
            <label for="audio_file">Audio File:</label>
            <input type="file" class="form-control-file" id="audio_file" name="audio_file">
        </div>

        <button type="submit" class="btn btn-primary">Create Question</button>
    </form>

</div>

@endsection
