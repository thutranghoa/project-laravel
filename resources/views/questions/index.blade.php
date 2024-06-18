@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Questions for Exercise: {{ $exercise->exercise_name }}</h1>

    <a href="{{ route('quizzes.exercises.show', [$quiz->id, $exercise->id]) }}" class="btn btn-secondary mb-3">Back to Exercise Details</a>
    <a href="{{ route('quizzes.exercises.questions.create', [$quiz->id, $exercise->id]) }}" class="btn btn-primary mb-3">Create New Question</a>

    <form action="{{ route('quizzes.exercises.questions.search', [$quiz->id, $exercise->id]) }}" method="GET" class="form-inline mb-3">
        <input type="text" name="query" class="form-control mr-sm-2" placeholder="Search questions by name..." value="{{ request('query') }}">
        <button type="submit" class="btn btn-outline-success">Search</button>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($questions->isEmpty())
        <p>No questions found for this exercise.</p>
    @else
        <table class="table table-bordered">
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
                            <a href="{{ route('quizzes.exercises.questions.show', [$quiz->id, $exercise->id, $question->id]) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('quizzes.exercises.questions.edit', [$quiz->id, $exercise->id, $question->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('quizzes.exercises.questions.destroy', [$quiz->id, $exercise->id, $question->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this question?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
