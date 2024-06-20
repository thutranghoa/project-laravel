@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Exercises for Quiz: {{ $quiz->title }}</h1>
    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary mb-3">Back to Quizzes</a>
    <a href="{{ route('quizzes.exercises.create', $quiz->id) }}" class="btn btn-primary mb-3">Create New Exercise</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($exercises->isEmpty())
        <p>No exercises found for this quiz.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Exercise Name</th>
                    <th>Exercise Code (ma_de)</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->id }}</td>
                        <td>{{ $exercise->exercise_name }}</td>
                        <td>{{ $exercise->ma_de }}</td>
                        <td>{{ $exercise->time }}</td>
                        <td>
                            <a href="{{ route('quizzes.exercises.show', [$quiz->id, $exercise->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('quizzes.exercises.edit', [$quiz->id, $exercise->id]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('quizzes.exercises.destroy', [$quiz->id, $exercise->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this exercise?')" style="display:inline-block; ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
