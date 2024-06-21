@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Quizzes</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Add New Quiz</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>
                        <a href="{{ route('quizzes.exercises.index', $quiz->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quizz?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
