@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>Exercise Details: {{ $exercise->exercise_name }}</h1>
    <div class="card">
        <div class="card-header">
            {{ $exercise->exercise_name }}
        </div>
        <div class="card-body">
            <p><strong>Exercise Code (ma_de):</strong> {{ $exercise->ma_de }}</p>
            <p><strong>Time:</strong> {{ $exercise->time }} minutes</p>
            <a href="{{ route('admin.quizzes.exercises.index', $quiz->id) }}" class="btn btn-secondary">Back to Exercises</a>
            <a href="{{ route('admin.quizzes.exercises.edit', [$quiz->id, $exercise->id]) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('admin.quizzes.exercises.destroy', [$quiz->id, $exercise->id]) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('admin.quizzes.exercises.questions.index', [$quiz->id, $exercise->id]) }}" class="btn btn-primary">View Questions</a>
        </div>
    </div>
</div>
@endsection
