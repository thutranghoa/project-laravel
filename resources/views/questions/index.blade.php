@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Questions for Exercise: {{ $exercise->exercise_name }}</h1>

    <div class="card-body">
        <a href="{{ route('quizzes.exercises.show', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary">Back to Exercise Details</a>
        <a href="{{ route('quizzes.exercises.questions.create', [$quiz->id, $exercise->id]) }}" class="btn btn-primary">Create New Question</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($questions->isEmpty())
        <p>No questions found for this exercise.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Content</th>
                    <th>Difficulty Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->content }}</td>
                        <td>{{ $question->difficulty_level }}</td>
                        <td class="d-flex justify-content-around">
                            <a href="{{ route('quizzes.exercises.questions.show', [$quiz->id, $exercise->id, $question->id]) }}" class="btn btn-info btn-sm mx-1">View</a>
                            <a href="{{ route('quizzes.exercises.questions.edit', [$quiz->id, $exercise->id, $question->id]) }}" class="btn btn-warning btn-sm mx-1">Edit</a>
                            <form action="{{ route('quizzes.exercises.questions.destroy', [$quiz->id, $exercise->id, $question->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mx-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
