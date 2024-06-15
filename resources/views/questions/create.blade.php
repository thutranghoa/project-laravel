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
            <label for="answers">Answers:</label>
            @foreach(range(1, 4) as $index)
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" name="correct_answer" value="{{ $index - 1 }}" required>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="answers[]" placeholder="Answer {{ $index }}" required>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="audio_file">Audio File:</label>
            <input type="file" class="form-control-file" id="audio_file" name="audio_file">
        </div>

        <button type="submit" class="btn btn-primary">Create Question</button>
    </form>

</div>

@endsection
