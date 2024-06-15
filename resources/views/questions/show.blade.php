@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Question Details</h1>

    <div>
        <strong>ID:</strong> {{ $question->id }}
    </div>
    <div>
        <strong>Content:</strong> {{ $question->content }}
    </div>
    <div>
        <strong>Difficulty Level:</strong> {{ $question->difficulty_level }}
    </div>

    <div class="mt-3">
        <h4>Answers:</h4>
        <ul>
            @foreach ($question->answers as $answer)
                <li>{{ $answer->content }} @if ($answer->is_correct) (Correct Answer) @endif</li>
            @endforeach
        </ul>
    </div>

    <!-- Additional details as needed -->

    <div class="mt-3">
        <a href="{{ route('quizzes.exercises.questions.index', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary">Back to Questions List</a>
    </div>
</div>
@endsection
